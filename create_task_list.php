<?php
	require("connection.php");
	$job_id = $_POST["id"];
	$result = mysqli_query($conn, "SELECT tasks FROM production WHERE job_id = '$job_id'");
	$row = $result->fetch_assoc();
	$arr = explode(",", $row["tasks"]);
	echo json_encode($arr);
	exit();
?>