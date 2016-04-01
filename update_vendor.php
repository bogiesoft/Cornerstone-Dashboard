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

$vendor_name = $_POST['vendor_name'];
$vendor_contact = $_POST['vendor_contact'];
/*$vendor_phone = $_POST['vendor_phone'];
$vendor_email = $_POST['vendor_email'];
$vendor_website = $_POST['vendor_website'];		
$vendor_add = $_POST['vendor_add'];*/

//$sql = "UPDATE vendors SET contact_name='$contact_name',client_add='$client_add',contact_phone='$contact_phone',contact_email='$contact_email',sec1='$sec1',website='$website',notes='$notes',category='$category',title='$title' WHERE client_name='$client_name'";

$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();

header("location: http://localhost/crst_dashboard/vendors.php ");
exit();

?>