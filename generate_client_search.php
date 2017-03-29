<?php
	require("connection.php");
	$client_name = $_POST["id_name"];
	$result = mysqli_query($conn, "SELECT business FROM sales WHERE (full_name LIKE '%$client_name%' OR business LIKE '%$client_name%') AND type = 'Client' LIMIT 3");
	$arr = array();
	while($row = $result->fetch_assoc()){
		array_push($arr, $row["business"]);
	}
	
	echo json_encode($arr);
?>