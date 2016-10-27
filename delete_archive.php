<?php
	require("connection.php");
	session_start();
	$user = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "deleted archived job";
	$_SESSION['date'] = $today;
	$job_id = $_SESSION["deleted_archived_job_id"];
	
	mysqli_query($conn, "DELETE FROM archive_jobs WHERE job_id = '$job_id'");
	mysqli_query($conn, "INSERT INTO timestamp (user, time, job, a_p) VALUES ('$user', '$today', '$job', '$a_p')");
	header("location: archive.php");
	exit();