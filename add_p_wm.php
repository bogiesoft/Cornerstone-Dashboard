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

$vendor = $_POST['vendor'];
$material = $_POST['material'];
$size = $_POST['size'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$based_on = $_POST['based_on'];
session_start();

$user_name = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d G:i:s");
$a_p = date("A");
$_SESSION['date'] = $today;
$job = "added new weights and measure";

$sql = "INSERT INTO w_and_m (vendor,material,size,height,weight,based_on) VALUES ('$vendor', '$material', '$size', '$height','$weight','$based_on')";
$result = $conn->query($sql) or die('Error querying database.');
 
$sql6 = "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
$result7 = $conn->query($sql6) or die('Error querying database 5.');

$conn->close();

header("location: vendors.php ");

exit();

?>
