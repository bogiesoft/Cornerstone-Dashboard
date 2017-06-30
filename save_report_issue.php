<?php
	require("connection.php");
	$data = $_POST["report_info"];
	$user = $data[0];
	$description = $data[1];
	mysqli_query($conn, "INSERT INTO issues (user, description) VALUES ('$user', '$description')");
	echo json_encode("success");
	return;
?>