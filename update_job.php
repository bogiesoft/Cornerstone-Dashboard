<?php
require ("connection.php");

session_start();
$job_id = $_SESSION["job_id"]; 

if(isset($_POST['submit_form'])){
			//session_start();
			
			$user_name = $_SESSION['user'];
			date_default_timezone_set('America/New_York');
			$today = date("Y-m-d G:i:s");
			$a_p = date("A");
			$job = "updated job ticket " . $job_id;
			
			$client_name = $_POST['client_name'];			
			$project_name = $_POST['project_name'];
			$ticket_date = date("Y-m-d", strtotime($_POST['ticket_date']));
			$due_date = date("Y-m-d", strtotime($_POST['due_date']));
			$created_by = $_POST['created_by'];
			$estimate_number = $_POST['estimate_number'];
			$special_instructions = $_POST['special_instructions'];
			$materials_ordered = date("Y-m-d", strtotime($_POST['materials_ordered']));
			$materials_expected = date("Y-m-d", strtotime($_POST['materials_expected']));
			$expected_quantity = $_POST['expected_quantity'];
			$job_status = $_POST['job_status'];
			{
			$mail_class = $_POST['mail_class'];
			$rate = $_POST['rate'];
			$processing_category = $_POST['processing_category'];
			$mail_dim = $_POST['mail_dim'];
			$weights_measures = $_POST['weights_measures'];
			$permit = $_POST['permit'];
			$bmeu = $_POST['bmeu'];
			$based_on = $_POST['based_on'];
			$non_profit_number = $_POST['non_profit_number'];
			}
			$records_total = $_POST['records_total'];
			$data_source = $_POST['data_source'];
			$data_received = date("Y-m-d", strtotime($_POST['data_received']));
			$data_completed = date("Y-m-d", strtotime($_POST['data_completed']));
			$processed_by = $_POST['processed_by'];
			$dqr_sent = date("Y-m-d", strtotime($_POST['dqr_sent']));
			{
			$hold_postage = $_POST['hold_postage'];
			$postage_paid = $_POST['postage_paid'];
			$print_template = $_POST['print_template'];
			$special_address = $_POST['special_address'];
			$delivery = $_POST['delivery'];
			//$completed = $_POST['completed'];
			$tasks = implode(',', $_POST['tasks']); 
			}
			{$completed_date = date("Y-m-d", strtotime($_POST['completed_date']));
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
			}
			$sql = "UPDATE job_ticket SET processed_by = '$processed_by', client_name = '$client_name', project_name = '$project_name',ticket_date = '$ticket_date',due_date = '$due_date',created_by = '$created_by',estimate_number = '$estimate_number',special_instructions = '$special_instructions',materials_ordered = '$materials_ordered',materials_expected = '$materials_expected',expected_quantity = '$expected_quantity',records_total = '$records_total',job_status = '$job_status', mail_class = '$mail_class', rate = '$rate', processing_category = '$processing_category', mail_dim = '$mail_dim', weights_measures = '$weights_measures', permit = '$permit', bmeu = '$bmeu', based_on = '$based_on', non_profit_number = '$non_profit_number'  WHERE job_id = '$job_id' ";
			$result = $conn->query($sql) or die(date('Y-m-d', strtotime($ticket_date)));
			
			$sql2 = "UPDATE project_management SET data_source = '$data_source',data_received = '$data_received',data_completed = '$data_completed', dqr_sent = '$dqr_sent' WHERE job_id = '$job_id' ";
			$result2 = $conn->query($sql2) or die('Error querying database 2.');
			
			
			$sql3 = "UPDATE production SET  hold_postage = '$hold_postage',postage_paid = '$postage_paid',print_template = '$print_template' , special_address = '$special_address',delivery = '$delivery',tasks = '$tasks' WHERE job_id = '$job_id' ";
			$result3 = $conn->query($sql3) or die('Error querying database 3.');
			
			$sql4 = "UPDATE blue_sheet SET  completed_date = '$completed_date',data_hrs = '$data_hrs',gd_hrs = '$gd_hrs',initialrec_count = '$initialrec_count',manual = '$manual',uncorrected = '$uncorrected',unverifiable = '$unverifiable',bs_foreigns = '$bs_foreigns',bs_exact = '$bs_exact',loose = '$loose',householded = '$householded',basic = '$basic',ncoa_errors = '$ncoa_errors',bs_ncoa = '$bs_ncoa',final_count = '$final_count',bs_domestic = '$bs_domestic' WHERE job_id = '$job_id' ";
			$result4 = $conn->query($sql4) or die('Error querying database 4.');
			
			$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM job_ticket WHERE job_id = '$job_id'");
			$row_processed_by = $result_processed_by->fetch_assoc();
			$processed_by = $row_processed_by['processed_by'];
			
			$sql5 = "INSERT INTO timestamp (user,time,job, a_p,processed_by) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by')";
			$result5 = $conn->query($sql5) or die('Error querying database 5.');
			
			
	 
			$conn->close();
			header("location: dashboard.php");
			exit();
}
else if(isset($_POST['delete_form'])){
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "deleted job ticket " . $job_id;
	
	$sql1 = "DELETE FROM job_ticket WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	$sql1 = "DELETE FROM blue_sheet WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	$sql1 = "DELETE FROM invoice WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	
	$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM mail_data WHERE job_id = '$job_id'");
	$row_processed_by = $result_processed_by->fetch_assoc();
	$processed_by = $row_processed_by['processed_by'];
	
	$sql5 = "INSERT INTO timestamp (user,time,job, a_p,processed_by) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by')";
	$result5 = $conn->query($sql5) or die('Error querying database 5.');
	
	$sql1 = "DELETE FROM mail_data WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	$sql1 = "DELETE FROM production WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	$sql1 = "DELETE FROM yellow_sheet WHERE job_id = '$job_id'";
	mysqli_query($conn, $sql1);
	$sql1 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	mysqli_query($conn, $sql1);
	$conn->close();
	header("location: dashboard.php");
	exit();
}
?>