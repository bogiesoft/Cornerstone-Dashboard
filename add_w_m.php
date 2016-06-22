<?php
require ("header.php");
?>
<div class="content">
<?php
require ("connection.php");


session_start();

$user_name = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("F j, Y, g:i a");
$_SESSION['date'] = $today;
$job = "added new w&m";

$job_id = $_POST['job_id'];
$received = $_POST['received'];
$location = $_POST['location'];
$checked_in = $_POST['checked_in'];
$material = $_POST['material'];
$type = $_POST['type'];
$vendor = $_POST['vendor'];
$quantity = $_POST['quantity'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$size = $_POST['size'];
$based_on = $_POST['based_on'];

$sql = "INSERT INTO materials(job_id,received,location,checked_in,material,type,vendor,quantity,height,weight,size,based_on) VALUES ('$job_id','$received','$location','$checked_in','$material','$type','$vendor','$quantity','$height','$weight','$size','$based_on')";
$result = $conn->query($sql) or die('Error querying database.');

$sql6 = "INSERT INTO timestamp (user,time,job) VALUES ('$user_name', '$today','$job')";
$result7 = $conn->query($sql6) or die('Error querying database 5.');
 
$conn->close();
header("location: http://localhost/crst_dashboard/weights_and_measure.php ");
exit();
?>
</div>