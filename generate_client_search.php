<?php
	require("connection.php");
	if(isset($_POST["id_name_info"])){
		$business_and_full_name = explode("(", $_POST["id_name_info"]);
		$full_name = explode(")", $business_and_full_name[1]);
		$business = $business_and_full_name[0];
		$full_name = $full_name[0];
		$result = mysqli_query($conn, "SELECT * FROM sales WHERE business = '$business' AND full_name = '$full_name'");
		$row = $result->fetch_assoc();
		$arr_info = array($row["contact_name"], $row["phone"], $row["email1"], $row["address_line_1"], $row["city"], $row["state"], $row["zipcode"], $row["second_contact"], $row["fax"]);
		echo json_encode($arr_info);
	}
	else{
		$client_name = $_POST["id_name"];
		$result = mysqli_query($conn, "SELECT business, full_name FROM sales WHERE (full_name LIKE '%$client_name%' OR business LIKE '%$client_name%') AND type = 'Client' LIMIT 3");
		$arr_business = array();
		while($row = $result->fetch_assoc()){
			array_push($arr_business, $row["business"] . "(" . $row["full_name"] . ")");
		}	
		
		echo json_encode($arr_business);
	}
?>