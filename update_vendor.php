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
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "updated vendor";
	$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6) or die('Error querying database 5.');
	$vendor_name = $_POST['client_name'];
	$vendor_contact = $_POST['contact_name'];
	$vendor_phone = $_POST['contact_phone'];
	$vendor_email = $_POST['contact_email'];
	$vendor_website = $_POST['website'];		
	$vendor_add = $_POST['client_add'];

	$sql = "UPDATE vendors SET vendor_name='$vendor_name',vendor_phone='$vendor_phone',vendor_add='$vendor_add',vendor_contact='$vendor_contact',vendor_email='$vendor_email',vendor_website='$vendor_website' WHERE vendor_name='$vendor_name'";

	$result = $conn->query($sql) or die('Error querying database.');
	 
	$conn->close();

	header("location: http://localhost/crst_dashboard/vendors.php ");

	exit();
}
else
{
	echo "hello";
}

?>