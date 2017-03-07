<?php
	require("connection.php");
	$client_name = $_POST["id_name"];
	$result = mysqli_query($conn, "SELECT full_name FROM sales WHERE full_name LIKE '%$client_name%' AND type = 'Client' LIMIT 3");
	$arr = array();
	while($row = $result->fetch_assoc()){
		array_push($arr, $row["full_name"]);
	}
	
	echo json_encode($arr);
?>