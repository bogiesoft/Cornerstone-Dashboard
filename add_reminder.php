<?php
session_start();
require ("connection.php");
$user = $_SESSION['user'];
if(isset($_POST['submit_form'])){
	$date = $_POST['date'];
	$text = $_POST['text'];
	$occurence = $_POST['occurence'];
	if($occurence == 'Day'){
		mysqli_query($conn, 'INSERT INTO reminder (user, text, date, occurence) VALUES ("' . $user . '", "' . $text . '", "' . $date . '", "' . $occurence . '")');
	}
	else if($occurence == 'DT'){
		$time = $_POST['time'];
		mysqli_query($conn, 'INSERT INTO reminder (user, text, date, occurence, time) VALUES ("' . $user . '", "' . $text . '", "' . $date . '", "' . $occurence . '", "' . $time . '")');
	}
	else{
		$end_date = $_POST['end_date'];
		mysqli_query($conn, 'INSERT INTO reminder (user, text, date, occurence, end_date) VALUES ("' . $user . '", "' . $text . '", "' . $date . '", "' . $occurence . '", "' . $end_date . '")');
	}
}

$conn->close();
header("location: reminders.php");
exit();
?>