<?php
require ("connection.php");

session_start();
$user_name = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d G:i:s");
$a_p = date("A");
$job_id = $_SESSION["job_id"]; 
$wm = $_POST["wm"];
$records_total = $_POST['records_total'];
$record_change = $_SESSION["current_records_total"] - $records_total;
if(isset($_POST['submit_form'])){
			$array_old = explode(",", $_SESSION["old_wm"]);
			for($i = 0; $i < count($wm); $i++){
				$id = $wm[$i];
				$result = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$id'");
				$row = $result->fetch_assoc();
				$vendor = $row["vendor"];
				if(in_array($wm[$i], $array_old) && $vendor == "CRST Inventory"){
					$material = $row["material"];
					$type = $row["type"];
					$result_match = mysqli_query($conn, "SELECT * FROM inventory WHERE material = '$material' AND type = '$type'");
					if($result_match->num_rows > 0){
						$row2 = $result_match->fetch_assoc();
						$quantity = $row2["quantity"];
						$material_id = $row2["material_id"];
						$quantity = $quantity + $record_change;
						mysqli_query($conn, "UPDATE inventory SET quantity = '$quantity' WHERE material_id = '$material_id'");
						if($quantity < 50){
							$inventory_alert = " depleted inventory";
							$production_users = mysqli_query($conn, "SELECT user FROM users WHERE department = 'Production'");
							while($row_users = $production_users->fetch_assoc()){
								$production_user = $row_users["user"];
								mysqli_query($conn, "INSERT INTO timestamp (user, time, job, a_p, processed_by, viewed) VALUES ('$user_name', '$today', '$inventory_alert', '$a_p', '$production_user', 'no')") or die("noooo");
							}
						}
					}
				}
				else if(!in_array($wm[$i], $array_old) && $vendor == "CRST Inventory"){
					$material = $row["material"];
					$type = $row["type"];
					$result_match = mysqli_query($conn, "SELECT * FROM inventory WHERE material = '$material' AND type = '$type'");
					if($result_match->num_rows > 0){
						$row2 = $result_match->fetch_assoc();
						$quantity = $row2["quantity"];
						$material_id = $row2["material_id"];
						$quantity = $quantity - $records_total;
						mysqli_query($conn, "UPDATE inventory SET quantity = '$quantity' WHERE material_id = '$material_id'");
						if($quantity < 50){
							$inventory_alert = " depleted inventory";
							$production_users = mysqli_query($conn, "SELECT user FROM users WHERE department = 'Production'");
							while($row_users = $production_users->fetch_assoc()){
								$production_user = $row_users["user"];
								mysqli_query($conn, "INSERT INTO timestamp (user, time, job, a_p, processed_by, viewed) VALUES ('$user_name', '$today', '$inventory_alert', '$a_p', '$production_user', 'no')") or die("noooo");
							}
						}
					}
				}
			}
			for($ii = 0; $ii < count($array_old); $ii++){
						$id = $array_old[$ii];
						$result2 = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$id'");
						$row2 = $result2->fetch_assoc();
						$vendor2 = $row2["vendor"];
						if(!in_array($array_old[$ii], $wm) && $vendor2 == "CRST Inventory"){
							$material = $row2["material"];
							$type = $row2["type"];
							$result_match = mysqli_query($conn, "SELECT * FROM inventory WHERE material = '$material' AND type = '$type'");
							if($result_match->num_rows > 0){
								$row3 = $result_match->fetch_assoc();
								$quantity = $row3["quantity"];
								$material_id = $row3["material_id"];
								$quantity = $quantity + $records_total;
								mysqli_query($conn, "UPDATE inventory SET quantity = '$quantity' WHERE material_id = '$material_id'");
								if($quantity < 50){
									$inventory_alert = " depleted inventory";
									$production_users = mysqli_query($conn, "SELECT user FROM users WHERE department = 'Production'");
									while($row_users = $production_users->fetch_assoc()){
										$production_user = $row_users["user"];
										mysqli_query($conn, "INSERT INTO timestamp (user, time, job, a_p, processed_by, viewed) VALUES ('$user_name', '$today', '$inventory_alert', '$a_p', '$production_user', 'no')") or die("noooo");
									}
								}
							}
						}
						if(!in_array($array_old[$ii], $wm)){
							$wm_id = $array_old[$ii];
							mysqli_query($conn, "DELETE FROM production_receipts WHERE job_id = '$job_id' AND wm_id = '$wm_id'");
						}
			}
			$job = "updated job ticket " . $job_id;
			
			$client_name = $_POST['client_name'];			
			$project_name = $_POST['project_name'];
			$ticket_date = date("Y-m-d", strtotime($_POST['ticket_date']));
			$due_date = date("Y-m-d", strtotime($_POST['due_date']));
			$created_by = $_POST['created_by'];
			$estimate_number = $_POST['estimate_number'];
			$estimate_date = $_POST['estimate_date'];
			$estimate_created_by = $_POST['estimate_created_by'];
			$special_instructions = $_POST['special_instructions'];
			$materials_ordered = date("Y-m-d", strtotime($_POST['materials_ordered']));
			$materials_expected = date("Y-m-d", strtotime($_POST['materials_expected']));
			$expected_quantity = $_POST['expected_quantity'];
			$job_status = $_POST['job_status'];
			
			$mail_class = $_POST['mail_class'];
			$rate = $_POST['rate'];
			$processing_category = $_POST['processing_category'];
			$mail_dim = $_POST['mail_dim'];
			$weights_measures = implode(',',$_POST['wm']);
			$permit = $_POST['permit'];
			$bmeu = $_POST['bmeu'];
			$based_on = $_POST['based_on'];
			$non_profit_number = $_POST['non_profit_number'];
			
			$data_source = $_POST['data_source'];
			$data_received = date("Y-m-d", strtotime($_POST['data_received']));
			$data_completed = date("Y-m-d", strtotime($_POST['data_completed']));
			$data_location = str_replace('"', '\"', $_POST["data_location"]);
			$data_location = str_replace("'", "\'", $data_location);
			$data_location = str_replace("\\", "\\\\", $data_location);
			$data_processed_by = $_POST["data_processed_by"];
			
			$processed_by = $_POST['processed_by'];
			$dqr_sent = date("Y-m-d", strtotime($_POST['dqr_sent']));
			
			$hold_postage = $_POST['hold_postage'];
			$postage_paid = $_POST['postage_paid'];
			$print_template = $_POST['print_template'];
			$special_address = $_POST['special_address'];
			$delivery = $_POST['delivery'];
			//$completed = $_POST['completed'];
			$tasks_array = $_POST['tasks']; 
			$tasks = "";
			for($i = 0; $i < count($tasks_array); $i++){
				if($tasks_array[$i] == "Mail Merge"){
					$tasks.="Mail Merge^" . $_POST["special_mail_merge"] . ",";
				}
				else if($tasks_array[$i] == "Letter Printing"){
					$tasks.="Letter Printing^" . $_POST["special_letter_printing"] . ",";
				}
				else if($tasks_array[$i] == "Tabbing"){
					$tasks.="Tabbing^" . $_POST["special_tabbing"] . ",";
				}
				else if($tasks_array[$i] == "Folding"){
					$tasks.="Folding^" . $_POST["special_folding"] . ",";
				}
				else if($tasks_array[$i] == "Inserting"){
					$tasks.="Inserting^" . $_POST["special_inserting"] . ",";
				}
				else if($tasks_array[$i] == "Collating"){
					$tasks.="Collating^" . $_POST["special_collating"]. ",";
				}
				else if($tasks_array[$i] == "Sealing"){
					$tasks.="Sealing^" . $_POST["special_sealing"] . ",";
				}
				else if($tasks_array[$i] == "Inkjet Printing"){
					$tasks.="Inkjet Printing^" . $_POST["special_inkjet_printing"] . ",";
				}
				else{
					$tasks.=$tasks_array[$i] . ",";
				}
			}
			
			$tasks = substr($tasks, 0, -1);
			
			$completed_date = date("Y-m-d", strtotime($_POST['completed_date']));
			$data_hrs = $_POST['data_hrs'];
			$gd_hrs = $_POST['gd_hrs'];
			$initialrec_count = $_POST['initialrec_count'];
			$manual = $_POST['manual'];
			$uncorrected = $_POST['uncorrected'];
			$unverifiable = $_POST['unverifiable'];
			$bs_foreigns = $_POST['bs_foreigns'];
			$bs_exact = $_POST['bs_exact'];
			$loose = $_POST['loose'];
			$householded = $_POST['householded'];
			$basic = $_POST['basic'];
			$ncoa_errors = $_POST['ncoa_errors'];
			$bs_ncoa = $_POST['bs_ncoa'];
			$final_count = $_POST['final_count'];
			$bs_domestic = $_POST['bs_domestic'];
			
			$sql = 'UPDATE job_ticket SET processed_by = "' . $processed_by . '", client_name = "' . $client_name . '", project_name = "' . $project_name . '",ticket_date = "' . $ticket_date . '",due_date = "' . $due_date . '",created_by = "' . $created_by . '",estimate_number = "' . $estimate_number . '",estimate_date = "' . $estimate_date . '",estimate_created_by = "' . $estimate_created_by . '", special_instructions = "' . $special_instructions . '",materials_ordered = "' . $materials_ordered . '",materials_expected = "' . $materials_expected . '",expected_quantity = "' . $expected_quantity . '",records_total = "' . $records_total . '",job_status = "' . $job_status . '", mail_class = "' . $mail_class . '", rate = "' . $rate . '", processing_category = "' . $processing_category . '", mail_dim = "' . $mail_dim . '", weights_measures = "' . $weights_measures . '", permit = "' . $permit . '", bmeu = "' . $bmeu . '", based_on = "' . $based_on . '", non_profit_number = "' . $non_profit_number . '"  WHERE job_id = "' . $job_id . '"';
			$result = $conn->query($sql) or die(date('Y-m-d', strtotime($ticket_date)));
			
			$sql2 = 'UPDATE project_management SET data_source = "' . $data_source . '",data_received = "' . $data_received . '",data_completed = "' . $data_completed . '", data_location = "' . $data_location . '", data_processed_by = "' . $data_processed_by . '", dqr_sent = "' . $dqr_sent . '" WHERE job_id = "' . $job_id . '"';
			$result2 = $conn->query($sql2) or die('Error querying database 2.');
			
			
			$sql3 = 'UPDATE production SET  hold_postage = "' . $hold_postage . '",postage_paid = "' . $postage_paid . '",print_template = "' . $print_template . '" , special_address = "' . $special_address . '",delivery = "' . $delivery . '",tasks = "' . $tasks . '" WHERE job_id = "' . $job_id . '"';
			$result3 = $conn->query($sql3) or die('Error querying database 3.');
			
			$sql4 = 'UPDATE customer_service SET  completed_date = "' . $completed_date . '",data_hrs = "' . $data_hrs . '",gd_hrs = "' . $gd_hrs . '",initialrec_count = "' . $initialrec_count . '",manual = "' . $manual . '",uncorrected = "' . $uncorrected . '",unverifiable = "' . $unverifiable . '",bs_foreigns = "' . $bs_foreigns . '",bs_exact = "' . $bs_exact . '",loose = "' . $loose . '",householded = "' . $householded . '",basic = "' . $basic . '",ncoa_errors = "' . $ncoa_errors . '",bs_ncoa = "' . $bs_ncoa . '",final_count = "' . $final_count . '",bs_domestic = "' . $bs_domestic . '" WHERE job_id = "' . $job_id . '"';
			$result4 = $conn->query($sql4) or die('Error querying database 4.');
			
			$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM job_ticket WHERE job_id = '$job_id'");
			$row_processed_by = $result_processed_by->fetch_assoc();
			$processed_by = $row_processed_by['processed_by'];
			
			$sql5 = "INSERT INTO timestamp (user,time,job, a_p,processed_by,viewed) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by','no')";
			$result5 = $conn->query($sql5) or die('Error querying database 5.');
			
			for($i = 0; $i < count($wm); $i++){
				$material_id = $wm[$i];
				$result_wm = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$material_id'");
				$row_wm = $result_wm->fetch_assoc();
				$vendor = $row_wm["vendor"];
				$index = $i + 1;
				$date_expected = $_POST["expected_date" . $index];
				$crst_pickup = $_POST["crst_pickup" . $index];
				if($crst_pickup == "on"){
					$crst_pickup = 1;
				}
				$initial = $_POST["initial" . $index];
				$location = $_POST["location" . $index];
				
				$check_dup = mysqli_query($conn, "SELECT * FROM production_receipts WHERE job_id = '$job_id' AND wm_id = '$material_id'");
				if(mysqli_num_rows($check_dup) > 0){
					mysqli_query($conn, "UPDATE production_receipts SET date_expected = '$date_expected', crst_pickup = '$crst_pickup', initial = '$initial', location = '$location' WHERE job_id = '$job_id' AND wm_id = '$material_id'");
				}
				else{
					mysqli_query($conn, "INSERT INTO production_receipts (job_id, wm_id, date_expected, crst_pickup, initial, location, vendor) VALUES ('$job_id', '$material_id', '$date_expected', '$crst_pickup', '$initial', '$location', '$vendor')");
				}
			}
	 
			$conn->close();
			header("location: dashboard.php");
			exit();
}
else if(isset($_POST['delete_form'])){
	for($i = 0; $i < count($wm); $i++){
		$id = $wm[$i];
		$result = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$id'");
		$row = $result->fetch_assoc();
		$vendor_name = $row["vendor"];
		if($vendor_name == "CRST Inventory"){
			$material = $row["material"];
			$type = $row["type"];
			$result_match = mysqli_query($conn, "SELECT * FROM inventory WHERE material = '$material' AND type = '$type'");
			if($result_match->num_rows > 0){
				$row2 = $result_match->fetch_assoc();
				$quantity = $row2["quantity"];
				$material_id = $row2["material_id"];
				$quantity = $quantity + $records_total;
				mysqli_query($conn, "UPDATE inventory SET quantity = '$quantity' WHERE material_id = '$material_id'");
			}
		}
	}
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "deleted job ticket " . $job_id;
	
	$sql1 = "DELETE FROM job_ticket WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	
	$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM job_ticket WHERE job_id = '$job_id'");
	$row_processed_by = $result_processed_by->fetch_assoc();
	$processed_by = $row_processed_by['processed_by'];
	
	$sql5 = "INSERT INTO timestamp (user,time,job, a_p,processed_by,viewed) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by', 'no')";
	$result5 = $conn->query($sql5) or die('Error querying database 5.');
	
	$sql1 = "DELETE FROM project_management WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	$sql1 = "DELETE FROM production WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	$sql1 = "DELETE FROM customer_service WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	mysqli_query($conn, "DELETE FROM production_receipts WHERE job_id = '$job_id'");
	$conn->close();
	header("location: dashboard.php");
	exit();
}
?>