<?php
	require("connection.php");
	session_start();
	$date = $_POST['date'];
	$text = $_POST['text'];
	$id = $_SESSION['id_rem'];
	
	if(isset($_POST['submit_form'])){
	
		if(isset($_POST['vendor_info']) && isset($_POST['client_info']))
		{
			$vendor_name = $_POST['vendor_info'];
			$client_name = $_POST['client_info'];
			$sql = "UPDATE reminder SET date='$date', text='$text',client_name='$client_name', vendor_name = '$vendor_name' WHERE id = '$id'";
			mysqli_query($conn, $sql) or die("ERROR");
			$conn->close();
			header("location: reminders.php");
			exit();
		}
		else if(isset($_POST['vendor_info'])){
			
			$vendor_name = $_POST['vendor_info'];
			$sql = "UPDATE reminder SET date='$date', text='$text',vendor_name='$vendor_name' WHERE id = '$id'";
			mysqli_query($conn, $sql) or die("ERROR");
			$conn->close();
			header("location: reminders.php");
		}
		else if(isset($_POST['client_info']))
		{
			$client_name = $_POST['client_info'];
			$sql = "UPDATE reminder SET date='$date', text='$text',client_name='$client_name' WHERE id = '$id'";
			mysqli_query($conn, $sql) or die("ERROR");
			$conn->close();
			header("location: reminders.php");
			exit();
		}
		else
		{
			$sql = "UPDATE reminder SET date='$date', text='$text' WHERE id = '$id'";
			mysqli_query($conn, $sql) or die("ERROR");
			$conn->close();
			header("location: reminders.php");
			exit();
		}
	}
	else
	{
		$sql = "DELETE FROM reminder WHERE id = '$id'";
		mysqli_query($conn, $sql) or die("ERROR");
		$conn->close();
		header("location: reminders.php");
		exit();
	}
?>