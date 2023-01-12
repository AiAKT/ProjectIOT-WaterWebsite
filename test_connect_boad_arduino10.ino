int data1;
int data2;
float data3;
float data4;
int16_t dataVoltage;
float dataCurrent, depth;
#define SensorPin A1
unsigned long int avgValue;
int buf[10],temp;
unsigned long timepoint_measure;
#include <Wire.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <LiquidCrystal_I2C.h>
#include <SoftwareSerial.h>
#define ONE_WIRE_BUS A2
#define ANALOG_PIN A3
#define RANGE 5000
#define CURRENT_INIT 4.00
#define DENSITY_WATER 1
#define DENSITY_GASOLINE 0.74
#define PRINT_INTERVAL 1000
SoftwareSerial UnoSerial(3, 2); // RX | TX
OneWire oneWire(ONE_WIRE_BUS); 
DallasTemperature sensors(&oneWire);
LiquidCrystal_I2C lcd(0x27, 16, 2);

void setup()
{
  pinMode(A0,INPUT);
  pinMode(3, INPUT);
  pinMode(2, OUTPUT);
  pinMode(ANALOG_PIN, INPUT);
  timepoint_measure = millis();
  Serial.begin(9600);
  sensors.begin();
  UnoSerial.begin(57600);
  lcd.begin();
  lcd.backlight();
}

void loop() {
  //temp
  sensors.requestTemperatures();
  data1=sensors.getTempCByIndex(0);
  Serial.println(sensors.getTempCByIndex(0));
  lcd.setCursor(0, 0);
  lcd.print("TP:");
  lcd.setCursor(3, 0);
  lcd.print(data1);
  delay(5000);
  
  //cloudy
  int a = analogRead(A0);
  data2 = map (a,0,615,100,0);
  if(data2<0){
    data2=0;
  }
  if(data2>100){
    data2=100;
  }
  Serial.println(data2);
  lcd.setCursor(0, 1);
  lcd.print("TB:");
  lcd.setCursor(3, 1);
  lcd.print(data2);
  delay(5000);

  //level
  if (millis() - timepoint_measure > PRINT_INTERVAL) {
    timepoint_measure = millis();
    dataVoltage = analogRead(ANALOG_PIN);
    dataCurrent = dataVoltage / 120.0;
    depth = (dataCurrent - CURRENT_INIT) * (RANGE/ DENSITY_WATER / 16.0);
    if (depth < 0) depth = 0.0;
      //Serial.print(depth/1000);
      data3=depth/1000;
      if(data3<0){
        data3=0;
      }
      Serial.println(data3);
  }
  lcd.setCursor(8, 0);
  lcd.print("LV:");
  lcd.setCursor(12, 0);
  lcd.print(data3);
  delay(5000);

  //PH
  for(int i=0;i<10;i++)
  { 
    buf[i]=analogRead(SensorPin);
  }
  for(int i=0;i<9;i++)
  {
    for(int j=i+1;j<10;j++)
    {
      if(buf[i]>buf[j])
      {
        temp=buf[i];
        buf[i]=buf[j];
        buf[j]=temp;
      }
    }
  }
  avgValue=0;
  for(int i=2;i<8;i++)
    avgValue+=buf[i];
  float phValue=(float)avgValue*5.0/1024/6;
  phValue=3.5*phValue;
  data4=phValue;
  Serial.println(data4);
  lcd.setCursor(8, 1);
  lcd.print("PH :");
  lcd.setCursor(12, 1);
  lcd.print(phValue);
  delay(5000);

  //send serial
  //Serial.print("\t");
  UnoSerial.print(data1);
  UnoSerial.print(" ");
  UnoSerial.print(data2);
  UnoSerial.print(" ");
  UnoSerial.print(data3);
  UnoSerial.print(" ");
  UnoSerial.print(data4);
  UnoSerial.print("\n");
  delay(5000);
}
