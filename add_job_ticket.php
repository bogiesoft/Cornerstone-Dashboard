<?php
require ("connection.php");
if(isset($_POST['submit_form'])){
	foreach(array_keys($_POST) as $input){
		if(!is_array($input)){
			$_POST[$input] = str_replace('"', '', $_POST[$input]);
			$_POST[$input] = str_replace("'", "", $_POST[$input]);
		}
	}
	foreach($_POST as $input){
		if(!is_array($input)){
			echo $input;
		}
	}
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$processed_by = "";
	if(isset($_POST['processed_by'])){
		$processed_by = $_POST['processed_by'];
	}
	$job = "assigned job ticket";
	$_SESSION['date'] = $today;
    $records_total = $_POST['records_total'];
	if(!is_numeric($records_total)){
		$records_total = 0;
	}
	$client_name = $_POST['client_name'];
	
	$project_name = $_POST['project_name'];
	$_SESSION["client_name"] = $client_name;
	$_SESSION["project_name"] = $project_name;
	$ticket_date = date("Y-m-d", strtotime($_POST['ticket_date']));
	$due_date = date("Y-m-d", strtotime($_POST['due_date']));
	$created_by = "";
	if(isset($_POST['created_by'])){
		$created_by = $_POST['created_by'];
	}
	$estimate_number = $_POST['estimate_number'];
	$estimate_date = $_POST['estimate_date'];
	$estimate_created_by = $_POST['estimate_created_by'];
	$special_instructions = $_POST['special_instructions'];
	$materials_ordered = date("Y-m-d", strtotime($_POST['materials_ordered']));
	$materials_expected = date("Y-m-d", strtotime($_POST['materials_expected']));
	$expected_quantity = $_POST['expected_quantity'];
	$data_location = str_replace('"', '\"', $_POST["data_location"]);
	$data_location = str_replace("'", "\'", $data_location);
	$data_location = str_replace("\\", "\\\\", $data_location);
	$data_processed_by = $_POST["data_processed_by"];
	$job_status = "none";
	if(isset($_POST['job_status'])){
		$job_status = $_POST['job_status'];
	}
	@$wm_array = $_POST['wm'];
	$wm = "";
	if(is_array($wm_array)){
		$wm = implode(",", $_POST['wm']);
	}
	for($i = 0; $i < count($wm_array); $i++){
		$id = $wm_array[$i];
		$result = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$id'");
		$row = $result->fetch_assoc();
		$vendor = $row["vendor"];
		if($vendor == "CRST Inventory"){
			$material = $row["material"];
			$type = $row["type"];
			$result_match = mysqli_query($conn, "SELECT * FROM inventory WHERE material = '$material' AND type = '$type'");
			if($result_match->num_rows > 0){
				$row2 = $result_match->fetch_assoc();
				$quantity = $row2["quantity"];
				$material_id = $row2["material_id"];
				$quantity = $quantity - $records_total;
				if($quantity < 50){
					$inventory_alert = " depleted inventory";
					$production_users = mysqli_query($conn, "SELECT user FROM users WHERE department = 'Production'");
					while($row_users = $production_users->fetch_assoc()){
						$production_user = $row_users["user"];
						mysqli_query($conn, "INSERT INTO timestamp (user, time, job, a_p, processed_by, viewed) VALUES ('$user_name', '$today', '$inventory_alert', '$a_p', '$production_user', 'no')") or die("noooo");
					}
				}
				mysqli_query($conn, "UPDATE inventory SET quantity = '$quantity' WHERE material_id = '$material_id'");
			}
			else{
				mysqli_query($conn, "INSERT INTO inventory (material, type, vendor, location, material_color, quantity, per_box) VALUES ('$material', '$type', 'CRST Inventory', '', '', 0, 0)");
			}
		}
	}
	$mail_class = $_POST['mail_class'];
	$rate = $_POST['rate'];
	$processing_category = $_POST['processing_category'];
	$mail_dim = $_POST['mail_dim'];
	//$weights_measures = $_POST['weights_measures'];
	$permit = $_POST['permit'];
	$bmeu = $_POST['bmeu'];
	$based_on = $_POST['based_on'];

	$data_source = $_POST['data_source'];
	$data_received = date("Y-m-d", strtotime($_POST['data_received']));
	$data_completed = date("Y-m-d", strtotime($_POST['data_completed']));
	$dqr_sent = date("Y-m-d", strtotime($_POST['dqr_sent']));

	$hold_postage = (isset($_POST['hold_postage'])) ? "yes" : "no";
	$postage_paid = (isset($_POST['postage_paid'])) ? "yes" : "no";
	$print_template = $_POST['print_template'];
	$special_address = $_POST['special_address'];
	$delivery = $_POST['delivery'];
	//$completed = $_POST['completed']; commented because not needed
	@$tasks_array= $_POST['tasks']; 
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


	

	$sql = 'INSERT INTO job_ticket(processed_by,client_name,project_name,ticket_date,due_date,created_by,special_instructions,materials_ordered,materials_expected,estimate_number,estimate_date,estimate_created_by,expected_quantity,records_total,job_status,mail_class,rate,processing_category,
	mail_dim,weights_measures,permit,bmeu,based_on) VALUES ("' . $processed_by . '","' . $client_name . '", "' . $project_name . '", "' . $ticket_date . '", "' . $due_date . '","' . $created_by . '","' . $special_instructions . '","' . $materials_ordered . '","' . $materials_expected . '","' . $estimate_number . '","' . $estimate_date . '","' . $estimate_created_by . '","' . $expected_quantity . '","' . $records_total . '","' . $job_status . '", "' . $mail_class . '", "' . $rate . '", "' . $processing_category . '", "' . $mail_dim . '", "' . $wm . '", "' . $permit . '", "' . $bmeu . '", "' . $based_on . '")';
	$result = $conn->query($sql) or die('Error querying database 0.');


	$result1 = mysqli_query($conn,'SELECT job_id from job_ticket WHERE client_name="' . $client_name . '" and project_name="' . $project_name . '" ORDER BY job_id DESC');
	$row1 = $result1->fetch_assoc();
	
	$_SESSION["job_id"] = $row1["job_id"];
	$job_id = $_SESSION["job_id"];

	$sql2 = 'INSERT INTO project_management(job_id, data_location, data_processed_by, data_source,data_received,data_completed,dqr_sent) VALUES ("' . $job_id . '", "' . $data_location . '", "' . $data_processed_by . '", "'  . $data_source . '","' . $data_received . '","' . $data_completed . '","' . $dqr_sent . '")';
	$result3 = $conn->query($sql2) or die("error");

	$sql3 = 'INSERT INTO production(job_id,hold_postage,postage_paid,print_template,special_address ,delivery,tasks) VALUES ("' . $job_id . '", "' . $hold_postage . '", "' . $postage_paid . '", "' . $print_template . '","' . $special_address . '","' . $delivery . '","' . $tasks . '")';
	$result4 = $conn->query($sql3) or die('Error querying database 3.');

	$sql4 = 'INSERT INTO customer_service(job_id,completed_date,data_hrs,gd_hrs,initialrec_count,manual,uncorrected,unverifiable,bs_foreigns,bs_exact,loose,
	householded,basic, ncoa_errors,bs_ncoa,final_count,bs_domestic) VALUES ("' . $job_id . '","' . $completed_date . '","' . $data_hrs . '","' . $gd_hrs . '","' . $initialrec_count . '","' . $manual . '","' . $uncorrected . '","' . $unverifiable . '","' . $bs_foreigns . '","' . $bs_exact . '","' . $loose . '","' . $householded . '","' . $basic . '","' . $ncoa_errors . '","' . $bs_ncoa . '","' . $final_count . '","' . $bs_domestic . '")';
	$result5 = $conn->query($sql4) or die('Error querying database 4.');

	$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM job_ticket WHERE job_id = '$job_id'");
	$row_processed_by = $result_processed_by->fetch_assoc();
	$processed_by = $row_processed_by['processed_by'];
	$job = $job . " " . $job_id;
	$sql100 = "INSERT INTO timestamp (user,time,job, a_p,processed_by,viewed) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by','no')";

	$result7 = $conn->query($sql100) or die('Error querying database 6.');
	
	@$wm_array = $_POST['wm'];
	
	for($i = 0; $i < count($wm_array); $i++){
		$material_id = $wm_array[$i];
		$result_wm = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$material_id'");
		$index = $i + 1;
		
		$expected_date = $_POST["expected_date" . $index];
		$crst_pickup = $_POST["crst_pickup" . $index];
		if($crst_pickup == "on"){
			$crst_pickup = 1;
		}
		$initial = $_POST["initial" . $index];
		$location = $_POST["location" . $index];
		
		//echo $initial . " " . $index;
		
		$result_material = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$material_id'");
		$row_material = $result_material->fetch_assoc();
		
		
		$vendor = $row_material["vendor"];
		
		mysqli_query($conn, "INSERT INTO production_receipts (job_id, wm_id, date_expected, crst_pickup, initial, location, vendor) VALUES ('$job_id', '$material_id', '$expected_date', '$crst_pickup', '$initial', '$location', '$vendor')") or die("error");
	}

	$conn->close();

	header("location: job_ticket.php");
	exit();
}
?>

