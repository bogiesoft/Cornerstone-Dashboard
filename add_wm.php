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
/*$size = $_POST['size'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$based_on = $_POST['based_on'];*/


$sql = "INSERT INTO materials(vendor,job_id) VALUES ('$vendor', '$job_id')";
$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();

header("location: http://localhost/crst_dashboard/weights_and_measures.php ");
exit();

?>