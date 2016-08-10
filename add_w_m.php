<?php
require ("connection.php");


session_start();
$user_name = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d G:i:s");
$a_p = date("A");

$job = "added weights and measure";
$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
$result7 = $conn->query($sql6) or die('Error querying database 5.');
$received = $_POST['received'];
//$location = $_POST['location'];
$checked_in = $_POST['checked_in'];
$material = $_POST['material'];
$type = $_POST['type'];
$vendor = $_POST['vendor'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$size = $_POST['size'];
$based_on = $_POST['based_on'];

$sql = "INSERT INTO materials(received,location,checked_in,material,type,vendor,height,weight,size,based_on) VALUES ('$received',' ','$checked_in','$material','$type','$vendor','$height','$weight','$size','$based_on')";
$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();
header("location: weights_and_measure.php");
exit();
?>
</div>