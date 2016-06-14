<?php
require ("header.php");
?>
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
//session_start();
$date = $_POST['date'];
$text = $_POST['text'];

$user = $_SESSION['user'];

$sql = "INSERT INTO reminder(user,date,text) VALUES ('$user','$date','$text')";
$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();
header("location: reminders.php ");
exit();
?>