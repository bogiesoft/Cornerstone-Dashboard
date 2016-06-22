<?php

require ("connection.php");


date_default_timezone_set('America/New_York');
$today1 = date("F j, Y, g:i a");
$job = "added new doc";

$text = $_POST['text'];
$title = $_POST['title'];
session_start();
$user = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");

$sql = "INSERT INTO documentation(title,text,user,timestamp) VALUES ('$title', '$text','$user','$today')";
$result = $conn->query($sql) or die('Error querying database.');

$sql6 = "INSERT INTO timestamp (user,time,job) VALUES ('$user', '$today1','$job')";
$result7 = $conn->query($sql6) or die('Error querying database 5.');


$conn->close();

header("location: http://localhost/crst_dashboard/documentation.php ");
exit();

?>