<?php
	require("connection.php");
	session_start();
	$date = $_POST['date'];
	$text = $_POST['text'];
	
	
	else
	{
		$sql = "DELETE FROM reminder WHERE id = '$id'";
		mysqli_query($conn, $sql) or die("ERROR");
		$conn->close();
		header("location: reminders.php");
		exit();
	}
?>