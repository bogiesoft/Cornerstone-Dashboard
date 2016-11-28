<?php

require ("connection.php");


date_default_timezone_set('America/New_York');
$description = $_POST['description'];
$text = $_POST['text'];
$title = $_POST['title'];
session_start();
$user_name = $_SESSION['user'];
$user = $_SESSION['user'];
$today = date("Y-m-d G:i:s");
$a_p = date("A");
$job = "added documentation";
$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
$result7 = $conn->query($sql6) or die('Error querying database 5.');

$sql = "INSERT INTO documentation(title,text,user,timestamp,description) VALUES ('$title', '$text','$user','$today','$description')";
$result = $conn->query($sql) or die('Error querying database.');


$conn->close();

header("location: documentation.php?p=1");
exit();

?>