<?php
class dht11{
 public $link='';
 function __construct($PH, $temp, $cloudy, $level){
  $this->connect();
  $this->storeInDB($PH, $temp, $cloudy, $level);
 }
 
 function connect(){
  $this->link = mysqli_connect('localhost','envitonc_monitor','0u63RaqXks') or die('Cannot connect to the DB');
  mysqli_select_db($this->link,'envitonc_monitor') or die('Cannot select the DB');
 }
 
 function storeInDB($PH, $temp, $cloudy, $level){
  $query = "insert into water_quality set PH ='" .$PH. "', temp='" .$temp. "', cloudy='" .$cloudy. "', level='" .$level. "'";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
 }
 
}
if($_GET['PH'] != '' and  $_GET['temp'] != '' and  $_GET['cloudy'] != '' and  $_GET['level'] != ''){
 $dht11=new dht11($_GET['PH'],$_GET['temp'],$_GET['cloudy'],$_GET['level']);
}


?>