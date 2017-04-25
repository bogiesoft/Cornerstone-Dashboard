<?php

require ("connection.php");

$job_id = $_POST["job_id"];

if(isset($_POST['submit_form'])){
	$postage = $_POST["postage"];
	$invoice_number = $_POST["invoice_number"];
	$residual_returned = $_POST["residual_returned"];
	$week_followup = $_POST["2week_followup"];
	$notes=$_POST["notes"];
	$status = $_POST["status"];
	$reason = $_POST["reason"];
	$invoice_date = $_POST["invoice_date"];
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$_SESSION['date'] = $today;
	$job = $status . " job ticket" . $job_id;

	$sql = 'UPDATE customer_service SET postage="' . $postage . '",invoice_number="' . $invoice_number . '", invoice_date = "' . $invoice_date . '", residual_returned="' . $residual_returned . '",2week_followup="' . $week_followup . '",notes="' . $notes . '",status="' . $status . '",reason="' . $reason . '" WHERE job_id = "' . $job_id . '"';

	$result0 = $conn->query($sql) or die('Error querying database.');

	if($status != NULL){
	
	$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM job_ticket WHERE job_id = '$job_id'");
	$row_processed_by = $result_processed_by->fetch_assoc();
	$processed_by = $row_processed_by['processed_by'];
	$sql100 = "INSERT INTO timestamp (user,time,job, a_p,processed_by,viewed) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by','no')";
	$result100 = $conn->query($sql100) or die('Error querying database 101.');
	
	$material = "";
	$type = "";
	$vendor = "";
	$height = "";
	$weight = "";
	$size = "";
	
	$result_wm = mysqli_query($conn, "SELECT weights_measures FROM job_ticket WHERE job_id = '$job_id'");
	$row_wm = $result_wm->fetch_assoc();
	
	if($row_wm['weights_measures'] != ""){
		$material_array = array();
		$type_array = array();
		$vendor_array = array();
		$height_array = array();
		$weight_array = array();
		$size_array = array();
		$array_material_ids = explode(",", $row_wm['weights_measures']);
		for($i = 0; $i < count($array_material_ids); $i++){
			$material_id = $array_material_ids[$i];
			$result_info = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$material_id'");
			$row_info = $result_info->fetch_assoc();
			array_push($material_array, $row_info['material']);
			array_push($type_array, $row_info['type']);
			array_push($vendor_array, $row_info['vendor']);
			array_push($height_array, $row_info['height']);
			array_push($weight_array, $row_info['weight']);
			array_push($size_array, $row_info['size']);
		}
		
		$material = implode(",", $material_array);
		$type = implode(",", $type_array);
		$vendor = implode(",", $vendor_array);
		$height = implode(",", $height_array);
		$weight = implode(",", $weight_array);
		$size = implode(",", $size_array);
	}

	$sql1 = "INSERT INTO archive_jobs ( job_id,processed_by,client_name,project_name,ticket_date,due_date,created_by,estimate_number,estimate_date,estimate_created_by,special_instructions,materials_ordered,materials_expected,expected_quantity,records_total,job_status, mail_class, rate, processing_category, mail_dim, weights_measures, permit, bmeu, based_on, non_profit_number)  SELECT job_id,processed_by,client_name,project_name,ticket_date,due_date,created_by,estimate_number,estimate_date,estimate_created_by,special_instructions,materials_ordered,materials_expected,expected_quantity,records_total,job_status, mail_class, rate, processing_category, mail_dim, weights_measures, permit, bmeu, based_on, non_profit_number FROM job_ticket WHERE job_id = '$job_id'";
	$result = $conn->query($sql1) or die('Error querying database 100.') ;
	
	
	
	$result1 = mysqli_query($conn,"DELETE FROM job_ticket WHERE job_id = '$job_id'");

	$sql = 'UPDATE archive_jobs SET material = "' . $material . '", type = "' . $type . '", vendor = "' . $vendor . '", height = "' . $height . '", weight = "' . $weight . '", size = "' . $size . '" WHERE job_id = "' . $job_id . '"';
	mysqli_query($conn, $sql) or die("materials error");

	
	
	$sql2 = "UPDATE archive_jobs, project_management SET archive_jobs.data_source = project_management.data_source ,archive_jobs.data_received = project_management.data_received , archive_jobs.data_location = project_management.data_location, archive_jobs.data_processed_by = project_management.data_processed_by, archive_jobs.data_completed = project_management.data_completed,archive_jobs.dqr_sent = project_management.dqr_sent WHERE archive_jobs.job_id = project_management.job_id AND project_management.job_id = '$job_id'";	
	$result2 = $conn->query($sql2) or die('Error querying database 1.') ;
	$result3 = mysqli_query($conn,"DELETE FROM project_management WHERE job_id = '$job_id'");


	$sql4 = "UPDATE archive_jobs, customer_service SET 
	archive_jobs.completed_date = customer_service.completed_date,
	archive_jobs.data_hrs = customer_service.data_hrs,
	archive_jobs.gd_hrs = customer_service.gd_hrs,
	archive_jobs.initialrec_count = customer_service.initialrec_count,
	archive_jobs.manual = customer_service.manual,
	archive_jobs.uncorrected = customer_service.uncorrected,
	archive_jobs.unverifiable = customer_service.unverifiable,
	archive_jobs.loose = customer_service.loose,
	archive_jobs.householded = customer_service.householded,
	archive_jobs.basic = customer_service.basic,
	archive_jobs.ncoa_errors = customer_service.ncoa_errors,
	archive_jobs.final_count = customer_service.final_count,
	archive_jobs.bs_foreigns = customer_service.bs_foreigns,
	archive_jobs.bs_exact = customer_service.bs_exact,
	archive_jobs.bs_ncoa = customer_service.bs_ncoa,
	archive_jobs.bs_domestic = customer_service.bs_domestic
	 WHERE archive_jobs.job_id = customer_service.job_id AND customer_service.job_id = '$job_id'";
	 $result8 = $conn->query($sql4) or die('Error querying database 3.');
	$result10 = mysqli_query($conn,"UPDATE archive_jobs, customer_service SET 
	archive_jobs.postage = customer_service.postage,
	archive_jobs.invoice_number = customer_service.invoice_number,
	archive_jobs.invoice_date = customer_service.invoice_date,
	archive_jobs.residual_returned = customer_service.residual_returned,
	archive_jobs.2week_followup = customer_service.2week_followup,
	archive_jobs.notes = customer_service.notes,
	archive_jobs.status = customer_service.status,
	archive_jobs.reason = customer_service.reason
	 WHERE archive_jobs.job_id = customer_service.job_id AND customer_service.job_id = '$job_id'");
	$result11 = mysqli_query($conn,"DELETE FROM customer_service WHERE job_id = '$job_id'");

	$result12 = mysqli_query($conn,"UPDATE archive_jobs, production SET 
	archive_jobs.hold_postage = production.hold_postage,
	archive_jobs.postage_paid = production.postage_paid,
	archive_jobs.print_template = production.print_template,
	archive_jobs.special_address = production.special_address,
	archive_jobs.delivery = production.delivery,
	archive_jobs.completed = production.completed,
	archive_jobs.tasks = production.tasks
	 WHERE archive_jobs.job_id = production.job_id AND production.job_id = '$job_id'");
	$result13 = mysqli_query($conn,"DELETE FROM production WHERE job_id = '$job_id'");
	$today = date("Y-m-d");
	$result14 = mysqli_query($conn,"UPDATE archive_jobs SET archive_date = '$today' WHERE job_id = '$job_id'");

	
	}
	 
	$conn->close();

	header("location: customer_service.php ");
	exit();
}
if(isset($_POST['delete_form'])){
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "deleted job ticket";
	mysqli_query($conn, "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')") or die("error8");
	mysqli_query($conn,"DELETE FROM customer_service WHERE job_id = '$job_id'")or die("error1");
	mysqli_query($conn,"DELETE FROM job_ticket WHERE job_id = '$job_id'")or die("error3");
	mysqli_query($conn,"DELETE FROM project_management WHERE job_id = '$job_id'")or die("error4");
	mysqli_query($conn,"DELETE FROM production WHERE job_id = '$job_id'")or die("error6");
	
	$conn->close();

	header("location: customer_service.php");
	exit();
}
?>