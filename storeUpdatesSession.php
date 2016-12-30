<?php
	session_start();
	require("connection.php");
	$updates = $_POST["updates_array"];
	$_SESSION["test"] = $updates;
	
	for($i = 0; $i < count($updates); $i++){
		mysqli_query($conn, $updates[$i]) or die("error");
	}
?>