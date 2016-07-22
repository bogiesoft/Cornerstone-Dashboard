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
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$_SESSION['date'] = $today;
	$job = "archived job";

	$sql = "UPDATE invoice SET postage='$postage',invoice_number='$invoice_number',residual_returned='$residual_returned',2week_followup='$week_followup',notes='$notes',status='$status',reason='$reason' WHERE job_id = '$job_id'";

	$result0 = $conn->query($sql) or die('Error querying database.');

	if($status != NULL){
		
	$sql100 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	$result100 = $conn->query($sql100) or die('Error querying database 101.');
	
	$sql3 = "SELECT job_id FROM archive_jobs";
	$result3 = mysqli_query($conn, $sql3);
	$count = 0;
	while($row3 = $result3->fetch_assoc()){
		if((int)$row3['job_id'] > $count){
			$count = (int)$row3['job_id'];
		}
	}

	if($count == 0){
		$temp = 5001;
	}
	else{
		$temp = $count + 1;
	}
	
	$sql1 = "INSERT INTO archive_jobs ( job_id,client_name,project_name,ticket_date,due_date,created_by,estimate_number,special_instructions,materials_ordered,materials_expected,expected_quantity,job_status)  SELECT job_id,client_name,project_name,ticket_date,due_date,created_by,estimate_number,special_instructions,materials_ordered,materials_expected,expected_quantity,job_status FROM job_ticket WHERE job_id = '$job_id'";
	$result = $conn->query($sql1) or die('Error querying database 100.') ;
	$result1 = mysqli_query($conn,"DELETE FROM job_ticket WHERE job_id = '$job_id'");


	$sql2 = "UPDATE archive_jobs, mail_data SET archive_jobs.ncoa = mail_data.ncoa ,archive_jobs.data_loc = mail_data.data_loc ,archive_jobs.records_total = mail_data.records_total ,archive_jobs.domestic = mail_data.domestic ,archive_jobs.foreigns = mail_data.foreigns ,archive_jobs.data_source = mail_data.data_source ,archive_jobs.data_received = mail_data.data_received ,archive_jobs.data_completed = mail_data.data_completed ,archive_jobs.processed_by = mail_data.processed_by ,archive_jobs.dqr_sent = mail_data.dqr_sent ,archive_jobs.exact = mail_data.exact ,archive_jobs.mail_foreigns = mail_data.mail_foreigns ,archive_jobs.household = mail_data.household WHERE archive_jobs.job_id = mail_data.job_id AND mail_data.job_id = '$temp'";	
	$result2 = $conn->query($sql2) or die('Error querying database 1.') ;
	$result3 = mysqli_query($conn,"DELETE FROM mail_data WHERE job_id = '$job_id'");

	$result4 = mysqli_query($conn,"UPDATE archive_jobs, mail_info SET archive_jobs.mail_class = mail_info.mail_class,archive_jobs.rate = mail_info.rate,archive_jobs.processing_category = mail_info.processing_category,archive_jobs.mail_dim = mail_info.mail_dim,archive_jobs.weights_measures = mail_info.weights_measures,archive_jobs.permit = mail_info.permit,archive_jobs.bmeu = mail_info.bmeu,archive_jobs.based_on = mail_info.based_on,archive_jobs.non_profit_number = mail_info.non_profit_number WHERE archive_jobs.job_id = mail_info.job_id AND mail_info.job_id = '$temp'");
	$result5 = mysqli_query($conn,"DELETE FROM mail_info WHERE job_id = '$job_id'");

	$sql3 = "UPDATE archive_jobs, materials SET 
	archive_jobs.received = materials.received,
	archive_jobs.location = materials.location,
	archive_jobs.checked_in = materials.checked_in,
	archive_jobs.material = materials.material,
	archive_jobs.type = materials.type,
	archive_jobs.quantity = materials.quantity,
	archive_jobs.vendor = materials.vendor,
	archive_jobs.height = materials.height,
	archive_jobs.weight = materials.weight,
	archive_jobs.size = materials.size
	 WHERE archive_jobs.job_id = materials.job_id AND materials.job_id = '$temp'";
	 $result6 = $conn->query($sql3) or die('Error querying database 2.') ;
	 
	$result7 = mysqli_query($conn,"DELETE FROM materials WHERE job_id = '$job_id'");

	$sql4 = "UPDATE archive_jobs, blue_sheet SET 
	archive_jobs.completed_date = blue_sheet.completed_date,
	archive_jobs.data_hrs = blue_sheet.data_hrs,
	archive_jobs.gd_hrs = blue_sheet.gd_hrs,
	archive_jobs.initialrec_count = blue_sheet.initialrec_count,
	archive_jobs.manual = blue_sheet.manual,
	archive_jobs.uncorrected = blue_sheet.uncorrected,
	archive_jobs.unverifiable = blue_sheet.unverifiable,
	archive_jobs.loose = blue_sheet.loose,
	archive_jobs.householded = blue_sheet.householded,
	archive_jobs.basic = blue_sheet.basic,
	archive_jobs.ncoa_errors = blue_sheet.ncoa_errors,
	archive_jobs.final_count = blue_sheet.final_count,
	archive_jobs.bs_foreigns = blue_sheet.bs_foreigns,
	archive_jobs.bs_exact = blue_sheet.bs_exact,
	archive_jobs.bs_ncoa = blue_sheet.bs_ncoa,
	archive_jobs.bs_domestic = blue_sheet.bs_domestic
	 WHERE archive_jobs.job_id = blue_sheet.job_id AND blue_sheet.job_id = '$temp'";
	 $result8 = $conn->query($sql4) or die('Error querying database 3.');
	$result9 = mysqli_query($conn,"DELETE FROM blue_sheet WHERE job_id = '$job_id'");

	$result10 = mysqli_query($conn,"UPDATE archive_jobs, invoice SET 
	archive_jobs.postage = invoice.postage,
	archive_jobs.invoice_number = invoice.invoice_number,
	archive_jobs.residual_returned = invoice.residual_returned,
	archive_jobs.2week_followup = invoice.2week_followup,
	archive_jobs.notes = invoice.notes,
	archive_jobs.status = invoice.status,
	archive_jobs.reason = invoice.reason
	 WHERE archive_jobs.job_id = invoice.job_id AND invoice.job_id = '$temp'");
	$result11 = mysqli_query($conn,"DELETE FROM invoice WHERE job_id = '$job_id'");

	$result12 = mysqli_query($conn,"UPDATE archive_jobs, production SET 
	archive_jobs.hold_postage = production.hold_postage,
	archive_jobs.postage_paid = production.postage_paid,
	archive_jobs.print_template = production.print_template,
	archive_jobs.special_address = production.special_address,
	archive_jobs.delivery = production.delivery,
	archive_jobs.completed = production.completed,
	archive_jobs.tasks = production.tasks,
	archive_jobs.task1 = production.task1,
	archive_jobs.task2 = production.task2,
	archive_jobs.task3 = production.task3
	 WHERE archive_jobs.job_id = production.job_id AND production.job_id = '$temp'");
	$result13 = mysqli_query($conn,"DELETE FROM production WHERE job_id = '$job_id'");
	$result15 = mysqli_query($conn,"DELETE FROM yellow_sheet WHERE job_id = '$job_id'");
	$today = date("Y-m-d");
	$result14 = mysqli_query($conn,"UPDATE archive_jobs SET archive_date = '$today' WHERE job_id = '$temp'");

	
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
	mysqli_query($conn,"DELETE FROM blue_sheet WHERE job_id = '$job_id'")or die("error1");
	mysqli_query($conn,"DELETE FROM invoice WHERE job_id = '$job_id'")or die("error2");
	mysqli_query($conn,"DELETE FROM job_ticket WHERE job_id = '$job_id'")or die("error3");
	mysqli_query($conn,"DELETE FROM mail_data WHERE job_id = '$job_id'")or die("error4");
	mysqli_query($conn,"DELETE FROM mail_info WHERE job_id = '$job_id'")or die("error5");
	mysqli_query($conn,"DELETE FROM production WHERE job_id = '$job_id'")or die("error6");
	mysqli_query($conn,"DELETE FROM yellow_sheet WHERE job_id = '$job_id'")or die("error7");
	mysqli_query($conn,"DELETE FROM priority_level WHERE job_id = '$job_id'") or die("error8");
	
	$conn->close();

	header("location: customer_service.php");
	exit();
}
?>