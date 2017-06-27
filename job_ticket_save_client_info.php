<?php
	$info = $_POST["id"];
	require("connection.php");
	$id = $info[9];
	$contact_name = $info[0];
	$phone = $info[1];
	$email = $info[2];
	$address = $info[3];
	$city = $info[4];
	$state = $info[5];
	$zip = $info[6];
	$second_contact = $info[7];
	$fax = $info[8];
	$non_profit = $info[10];
	$crid = $info[11];
	$email2 = $info[12];
	$address_line_2 = $info[13];
	$sql = "UPDATE sales SET contact_name = '$contact_name', phone = '$phone', email1 = '$email', address_line_1 = '$address', city = '$city', state = '$state', zipcode = '$zip', second_contact = '$second_contact', fax = '$fax', non_profit =  '$non_profit', crid = '$crid', email2 = '$email2', address_line_2 = '$address_line_2' WHERE client_id = '$id'";
	echo $sql;
	mysqli_query($conn, "UPDATE sales SET contact_name = '$contact_name', phone = '$phone', email1 = '$email', address_line_1 = '$address', city = '$city', state = '$state', zipcode = '$zip', second_contact = '$second_contact', fax = '$fax', non_profit =  '$non_profit', crid = '$crid', email2 = '$email2', address_line_2 = '$address_line_2' WHERE client_id = '$id'");
?>