<?php
require('header.php');
require ("connection.php");
$temp = $_GET['job_id'];
$sql = "SELECT * FROM job_ticket WHERE job_id = $temp "; 
$result = mysqli_query($conn,$sql); 
$row = $result->fetch_assoc();
echo "<div class='content'>";
echo "<textarea name='special_instructions' class='contact-prefix' cols='80' rows='25'>".$row['special_instructions']."</textarea>";
echo "</div>";

$conn->close();	
?>