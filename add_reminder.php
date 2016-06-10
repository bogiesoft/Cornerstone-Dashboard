<?php
require ("header.php");
?>
<?php
require ("connection.php");

session_start();
$date = $_POST['date'];
$text = $_POST['text'];

$user = $_SESSION['user'];

$sql = "INSERT INTO reminder(user,date,text) VALUES ('$user','$date','$text')";
$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();
header("location: http://localhost/crst_dashboard/reminders.php ");
exit();
?>