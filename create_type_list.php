<?php
	require("connection.php");
	
	$material = $_POST["material"];
	$result = mysqli_query($conn, "SELECT DISTINCT type FROM materials WHERE material = '$material' AND vendor = 'CRST Inventory'");
	$arr = array();
	while($row = $result->fetch_assoc()){
		array_push($arr, $row["type"]);
	}
	
	echo json_encode($arr);
	exit();
?>