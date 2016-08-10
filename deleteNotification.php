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

$id = $_POST['id'];
$sql="UPDATE timestamp SET viewed='yes' WHERE id='$id'";
$result=mysqli_query($conn,$sql) or die("error");
?>