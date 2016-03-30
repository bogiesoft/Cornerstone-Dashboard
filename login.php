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

$user = $_POST['user'];
$password = $_POST['password'];

//$reqFields = compact("user", "password");


   
$sql="SELECT * FROM users WHERE user='$user' and password='$password'";

$result=mysqli_query($conn,$sql);

// Mysql_num_row is counting table row

// If result matched $username and $password, table row must be 1 row
if ($result->num_rows == 1) {
	
    header("location: dashboard.php");
	
} else {
    echo "Unsuccessful!";
}


   
$conn->close();

exit();
?>
