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
if(isset($_POST['submit_form'])){
	$title = $_POST['title'];
	$text = $_POST['text'];
	session_start();
	$user = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "updated doc";

	$sql = "UPDATE documentation SET title='$title',text='$text', user='$user', timestamp='$today' WHERE title ='$title'";
	$result = $conn->query($sql) or die('Error querying database.');

	$sql6 = "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6) or die('Error querying database 5.');
	 
	$conn->close();
	header("location: documentation.php ");
	exit();
}
if(isset($_POST['delete_form'])){
	$title = $_POST['title'];
	$text = $_POST['text'];
	session_start();
	$user = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "deleted doc";
	
	$sql = "DELETE FROM documentation WHERE title = '$title' AND text = '$text'";
	$result = $conn->query($sql) or die("error");
	
	$sql6 = "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6)or die("error");
	
	$conn->close();
	header("location: documentation.php");
	exit();
}
?>