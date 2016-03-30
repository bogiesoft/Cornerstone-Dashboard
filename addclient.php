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

$client_name = $_POST['client_name'];
$client_add = $_POST['client_add'];
$contact_name = $_POST['contact_name'];
$contact_phone = $_POST['contact_phone'];
$contact_email = $_POST['contact_email'];
$category = $_POST['category'];
$sec1 = $_POST['sec1'];
$website = $_POST['website'];
$notes = $_POST['notes'];
$title = $_POST['title'];

$sql = "INSERT INTO client_info(client_name,client_add,contact_name,contact_phone,contact_email,sec1,website,notes,category,title) VALUES ('$client_name', '$client_add', '$contact_name', '$contact_phone','$contact_email','$sec1','$website','$notes','$category','$title')";
$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();

header("location: http://localhost/crst_dashboard/clients.php ");
exit();
//
//
//
?>

