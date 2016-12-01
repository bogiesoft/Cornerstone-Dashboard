<?php
	require("connection.php");
	$updates = $_POST["updates_array"];
	for($i = 0; $i < count($updates); $i++){
		mysqli_query($conn, $updates[$i]);
	}
?>