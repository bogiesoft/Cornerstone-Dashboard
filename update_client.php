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

$sql = "UPDATE client_info SET contact_name='$contact_name',client_add='$client_add',contact_phone='$contact_phone',contact_email='$contact_email',sec1='$sec1',website='$website',notes='$notes',category='$category',title='$title' WHERE client_name='$client_name'";

$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();

header("location: http://localhost/crst_dashboard/clients.php ");
exit();

?>

