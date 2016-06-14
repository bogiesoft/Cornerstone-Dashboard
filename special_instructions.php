<?php
require('header.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";
// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$temp = $_GET['job_id'];
$sql = "SELECT * FROM job_ticket WHERE job_id = $temp "; 
$result = mysqli_query($conn,$sql); 
$row = $result->fetch_assoc();
echo "<div class='content'>";
echo "<textarea name='special_instructions' class='contact-prefix' cols='80' rows='25'>".$row['special_instructions']."</textarea>";
echo "</div>";

$conn->close();	
?>