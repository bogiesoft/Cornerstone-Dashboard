<?php

require ("connection.php");
if(isset($_POST['submit_form'])){
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "created job ticket";
	$_SESSION['date'] = $today;

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
	$special_instructions = $_POST['special_instructions'];
	$materials_ordered = date("Y-m-d", strtotime($_POST['materials_ordered']));
	$materials_expected = date("Y-m-d", strtotime($_POST['materials_expected']));
	$expected_quantity = $_POST['expected_quantity'];
	$job_status = "none";
	if(isset($_POST['job_status'])){
		$job_status = $_POST['job_status'];
	}

	$mail_class = $_POST['mail_class'];
	$rate = $_POST['rate'];
	$processing_category = $_POST['processing_category'];
	$mail_dim = $_POST['mail_dim'];
	$weights_measures = $_POST['weights_measures'];
	$permit = $_POST['permit'];
	$bmeu = $_POST['bmeu'];
	$based_on = $_POST['based_on'];
	$non_profit_number = $_POST['non_profit_number'];

	$data_loc = $_POST['data_loc'];
	$records_total = $_POST['records_total'];
	$domestic = $_POST['domestic'];
	$foreigns = $_POST['foreigns'];
	$data_source = $_POST['data_source'];
	$data_received = date("Y-m-d", strtotime($_POST['data_received']));
	$data_completed = date("Y-m-d", strtotime($_POST['data_completed']));
	$processed_by = "";
	if(isset($_POST['processed_by'])){
		$processed_by = $_POST['processed_by'];
	}
	if($processed_by != ""){
		$sql = "SELECT department FROM users WHERE user = '$processed_by'";
		$result10 = mysqli_query($conn, $sql);
		
		$row10 = $result10->fetch_assoc();
		
		$job = "job assigned to " . $row10['department'];
		
	}
	$dqr_sent = date("Y-m-d", strtotime($_POST['dqr_sent']));
	$exact = $_POST['exact'];
	$mail_foreigns = $_POST['mail_foreigns'];
	$household = $_POST['household'];
	$ncoa = $_POST['ncoa'];

	$hold_postage = (isset($_POST['hold_postage'])) ? "yes" : "no";
	$postage_paid = (isset($_POST['postage_paid'])) ? "yes" : "no";
	$print_template = $_POST['print_template'];
	$special_address = $_POST['special_address'];
	$delivery = $_POST['delivery'];
	//$completed = $_POST['completed']; commented because not needed
	@$tasks_array= $_POST['tasks']; 
	$tasks = "";
	if( is_array($tasks_array)){
	$tasks = implode(',', $_POST['tasks']);
	}
	$task1 = $_POST['task1'];
	$task2 = $_POST['task2'];
	$task3 = $_POST['task3'];

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


	

	$sql = "INSERT INTO job_ticket(client_name,project_name,ticket_date,due_date,created_by,special_instructions,materials_ordered,materials_expected,estimate_number,expected_quantity,job_status) VALUES ('$client_name', '$project_name', '$ticket_date', '$due_date','$created_by','$special_instructions','$materials_ordered','$materials_expected','$estimate_number','$expected_quantity','$job_status')";
	$result = $conn->query($sql) or die('Error querying database 0.');


	$result1 = mysqli_query($conn,"SELECT job_id from job_ticket WHERE client_name='$client_name' and project_name='$project_name' ORDER BY job_id DESC");
	$row1 = $result1->fetch_assoc();
	
	$_SESSION["job_id"] = $row1["job_id"];
	$job_id = $_SESSION["job_id"];
	

	$sql1 = "INSERT INTO mail_info(job_id,mail_class,rate,processing_category,mail_dim,weights_measures,permit,bmeu,based_on,non_profit_number) VALUES ('$job_id', '$mail_class', '$rate', '$processing_category','$mail_dim','$weights_measures','$permit','$bmeu','$based_on','$non_profit_number')";
	$result2 = $conn->query($sql1) or die($job_id);

	$sql2 = "INSERT INTO mail_data(job_id,data_loc,records_total,domestic,foreigns,data_source,data_received,data_completed,processed_by,dqr_sent,exact,mail_foreigns,household,ncoa) VALUES ('$job_id', '$data_loc', '$records_total', '$domestic','$foreigns','$data_source','$data_received','$data_completed','$processed_by','$dqr_sent','$exact','$mail_foreigns','$household','$ncoa')";
	$result3 = $conn->query($sql2) or die("error");

	$sql3 = "INSERT INTO production(job_id,hold_postage,postage_paid,print_template,special_address ,delivery,task1,task2,task3,tasks) VALUES ('$job_id', '$hold_postage', '$postage_paid', '$print_template','$special_address','$delivery','$task1','$task2','$task3','$tasks')";
	$result4 = $conn->query($sql3) or die('Error querying database 3.');

	$sql4 = "INSERT INTO blue_sheet(job_id,completed_date,data_hrs,gd_hrs,initialrec_count,manual,uncorrected,unverifiable,bs_foreigns,bs_exact,loose,
	householded,basic, ncoa_errors,bs_ncoa,final_count,bs_domestic) VALUES ('$job_id','$completed_date','$data_hrs','$gd_hrs','$initialrec_count','$manual','$uncorrected','$unverifiable','$bs_foreigns','$bs_exact','$loose','$householded','$basic','$ncoa_errors','$bs_ncoa','$final_count','$bs_domestic' )";
	$result5 = $conn->query($sql4) or die('Error querying database 4.');

	$sql5 = "INSERT INTO invoice(job_id) VALUES ('$job_id')";
	$result6 = $conn->query($sql5) or die('Error querying database 5.');

	$sql6 = "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6) or die('Error querying database 6.');

	$sql8 = "INSERT INTO yellow_sheet (job_id) VALUES ('$job_id')";
	$result9= $conn->query($sql8) or die('Error querying database 8.');
	
	$sql9 = "INSERT INTO priority_level (job_id) VALUES ('$job_id')";
	mysqli_query($conn, $sql9);

	$conn->close();

	header("location: job_ticket.php");
	exit();
}
else{
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "deleted archive job";
	$temp = $_GET['job_id'];
	mysqli_query($conn, "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user_name', '$today','$job', '$a_p')");
	mysqli_query($conn, "DELETE FROM archive_jobs WHERE job_id = '$temp'");
	$conn->close();

	header("location: archive.php");
	exit();
	
}

?>

