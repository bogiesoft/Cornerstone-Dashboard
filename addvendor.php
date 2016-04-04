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
$vendor_add = $_POST['vendor_add'];
$vendor_contact = $_POST['vendor_contact'];
$vendor_phone = $_POST['vendor_phone'];
$vendor_email = $_POST['vendor_email'];
$vendor_website = $_POST['vendor_website'];


$sql = "INSERT INTO vendors(vendor_name,vendor_add,vendor_contact,vendor_phone,vendor_email,vendor_website) VALUES ('$vendor_name', '$vendor_add', '$vendor_contact', '$vendor_phone','$vendor_email','$vendor_website')";
$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();

header("location: http://localhost/crst_dashboard/vendors.php ");

exit();

?>

