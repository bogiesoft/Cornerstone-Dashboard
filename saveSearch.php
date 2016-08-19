<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$field1 = $_POST['field1'];
$value1 = $_POST['value1'];
$field2 = $_POST['field2'];
$value2 = $_POST['value2'];
$field3 = $_POST['field3'];
$value3 = $_POST['value3'];
$sql="INSERT INTO saved_search (field1,value1,field2,value2,field3,value3) VALUES ('$field1','$value1','$field2','$value2','$field3','$value3')";
$result=mysqli_query($conn,$sql) or die("error");
?>