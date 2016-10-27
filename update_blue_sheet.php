<?php
require("connection.php");
session_start();

$id = "submit_form";
$count = 1;
$index = 0;

while(TRUE){
	if(isset($_POST[$id . $count])){
		$job_id = $_SESSION['blue_sheet_job_ids'][$index];
		$initialrec_count = $_POST['initialrec_count'];
		$manual = $_POST['manual'];
		$uncorrected = $_POST['uncorrected'];
		$unverifiable = $_POST['unverifiable'];
		$completed_date = date("Y-m-d", strtotime($_POST['completed_date']));
		$data_hrs = $_POST['data_hrs'];
		$gd_hrs = $_POST['gd_hrs'];
		$bs_foreigns = $_POST['bs_foreigns'];
		$bs_exact = $_POST['bs_exact'];
		$loose = $_POST['loose'];
		$householded = $_POST['householded'];
		$basic = $_POST['basic'];
		$ncoa_errors = $_POST['ncoa_errors'];
		$bs_ncoa = $_POST['bs_ncoa'];
		$final_count = $_POST['final_count'];
		$bs_domestic = $_POST['bs_domestic'];
		mysqli_query($conn, 'UPDATE customer_service SET initialrec_count = "' . $initialrec_count . '", manual = "' . $manual . '", uncorrected = "' . $uncorrected . '", unverifiable = "' . $unverifiable . '", completed_date = "' . $completed_date . '", data_hrs = "' . $data_hrs . '", gd_hrs = "' . $gd_hrs . '", bs_foreigns = "' . $bs_foreigns . '", bs_exact = "' . $bs_exact . '", loose = "' . $loose . '", householded = "' . $householded . '", basic = "' . $basic . '", ncoa_errors = "' . $ncoa_errors . '", bs_ncoa = "' . $bs_ncoa . '", final_count = "' . $final_count . '", bs_domestic = "' . $bs_domestic . '" WHERE job_id = "' . $job_id . '"');
		break;
	}
	else{
		$count = $count + 1;
		$index = $index + 1;
	}
}

header("location: project_management.php");

?>