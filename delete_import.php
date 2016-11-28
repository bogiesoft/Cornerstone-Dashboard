<?php
	require("connection.php");
	session_start();
	$id = $_GET["id"];
	mysqli_query($conn, "DELETE FROM sales WHERE import_id = '$id'");
	$job = "deleted import from CRM";
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$sql_timestamp = "INSERT INTO timestamp (user, time, job, a_p) VALUES ('$user_name', '$today', '$job', '$a_p')";
	mysqli_query($conn, $sql_timestamp);
	header("location: uploadForm.php");
?>