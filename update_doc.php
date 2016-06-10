<?php
require ("connection.php");
$title = $_POST['title'];
$text = $_POST['text'];
session_start();
$user = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("F j, Y, g:i a");
$job = "updated doc";

$sql = "UPDATE documentation SET title='$title',text='$text', user='$user', timestamp='$today' WHERE title ='$title'";
$result = $conn->query($sql) or die('Error querying database.');

$sql6 = "INSERT INTO timestamp (user,time,job) VALUES ('$user', '$today','$job')";
$result7 = $conn->query($sql6) or die('Error querying database 5.');
 
$conn->close();
header("location: http://localhost/crst_dashboard/documentation.php ");
exit();
?>