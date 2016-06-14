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

date_default_timezone_set('America/New_York');
$today1 = date("Y-m-d G:i:s");
$a_p = date("A");
$job = "added new doc";

$text = $_POST['text'];
$title = $_POST['title'];
session_start();
$user = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");

$sql = "INSERT INTO documentation(title,text,user,timestamp) VALUES ('$title', '$text','$user','$today')";
$result = $conn->query($sql) or die('Error querying database.');

$sql6 = "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user', '$today1','$job', '$a_p')";
$result7 = $conn->query($sql6) or die('Error querying database 5.');


$conn->close();

header("location: documentation.php ");
exit();

?>