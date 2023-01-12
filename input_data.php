<?php

$servername = "27.254.152.182:3306";

$dbname = "envitonc_monitor";
$username = "envitonc_monitor";
$password = "0u63RaqXks";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $PH = $temp = $cloudy = $level = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $PH = test_input($_POST["PH"]);
        $temp = test_input($_POST["temp"]);
        $cloudy = test_input($_POST["cloudy"]);
        $level = test_input($_POST["level"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO water_quality(PH, temp, cloudy, level)
        VALUES ('" . $PH . "', '" . $temp . "', '" . $cloudy . "', '" . $level . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }
}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}