#include "File.h"
#include "http.h"
#include "TEE_UC20.h"
#include "SoftwareSerial.h"
#include <AltSoftSerial.h>
#include "internet.h"
#include <SoftwareSerial.h>
SoftwareSerial NodeSerial(2, 3);

String url="https://monitor.enviton.com/inputdata.php?PH=";

INTERNET net;
UC_FILE file;
HTTP http;

//SIM AIS  internet
#define APN "internet"
#define USER ""
#define PASS ""

AltSoftSerial mySerial;

void debug(String data)
{
  Serial.println(data);
}

void setup() 
{
  Serial.begin(9600);
  gsm.begin(&mySerial,9600);
  gsm.Event_debug = debug;
  Serial.println(F("UC20"));
  gsm.PowerOn(); 
  while(gsm.WaitReady()){}
 
  Serial.print(F("GetOperator --> "));
  Serial.println(gsm.GetOperator());
  Serial.print(F("SignalQuality --> "));
  Serial.println(gsm.SignalQuality());
  
  Serial.println(F("Disconnect net"));
  net.DisConnect();
  Serial.println(F("Set APN and Password"));
  net.Configure(APN,USER,PASS);
  Serial.println(F("Connect net"));
  net.Connect();
  Serial.println(F("Show My IP"));
  Serial.println(net.GetIP());
  pinMode(2, INPUT);
  pinMode(3, OUTPUT);
  Serial.begin(9600);
  Serial.println("Starting...");
  NodeSerial.begin(57600);
}

void loop() 
{
   if (gsm.available())
  {
    Serial.write(gsm.read());
  } 
  if (Serial.available())
  {
    char c = Serial.read();
    gsm.write(c);
  }
  Sending_To_phpmyadmindatabase() ;
}

void Sending_To_phpmyadmindatabase()
{
  while (NodeSerial.available() > 0)
    {
      int sensorTp = NodeSerial.parseInt();
      int sensorTb = NodeSerial.parseInt();
      float level = NodeSerial.parseFloat();
      float phValue = NodeSerial.parseFloat();
      if (NodeSerial.read() == '\n')
        {
          Serial.println("Ardino water");
          Serial.print(" TP : ");
          Serial.println(sensorTp);
          Serial.print(" TB : ");
          Serial.println(sensorTb);
          Serial.print(" LV : ");
          Serial.println(level);
          Serial.print(" PH : ");
          Serial.println(phValue);

          Serial.println(F("Start HTTP"));
          http.begin(1);
          Serial.println(F("Send HTTP POST"));
          String data = String(phValue, 2) + "&temp=" + sensorTp + "&cloudy=" + sensorTb + "&level=" + String(level,2);
          String fullUrl = url + data;
          Serial.println("begin");
          Serial.println(fullUrl);
          http.url(fullUrl);
          Serial.println("after");
          Serial.println(http.post());
          Serial.println(F("Clear data in RAM"));
          file.Delete(RAM,"*");
          Serial.println(F("Save HTTP Response To RAM"));
          http.SaveResponseToMemory(RAM,"web.hml");
          Serial.println(F("Read data in RAM"));
          read_file(RAM,"web.hml");
          //delay(1800000);
          //delay(60000);
          delay(30000);
        }
     }
}
  
void data_out(char data)
  {
    Serial.write(data);
  }
   
void read_file(String pattern,String file_name)
  {
    file.DataOutput =  data_out;
    file.ReadFile(pattern,file_name);
  }
