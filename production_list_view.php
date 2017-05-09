<?php
require("connection.php");
if($_POST["id"] == "production_jobs"){
	$result_prod_users = mysqli_query($conn, "SELECT user FROM users WHERE department = 'Production'");
	$sql = "";
	$count = 1;
	while($prod_row = $result_prod_users->fetch_assoc()){
		$user = $prod_row['user'];
		if($count == 1){
			$sql = $sql . "SELECT * FROM job_ticket WHERE processed_by = '$user'";
		}
		else{
			$sql = $sql . " UNION SELECT * FROM job_ticket WHERE processed_by = '$user'";
		}

		$count = $count + 1;
	}

	$sql = $sql . " ORDER BY priority DESC, due_date ASC";
	$result = mysqli_query($conn, $sql);
	$job_id = array();
	$project_name = array();
	$client_name = array();
	$due_date = array();
	$job_status = array();
	while($row = $result->fetch_assoc()){
		array_push($job_id, $row["job_id"]);
		array_push($project_name, $row["project_name"]);
		array_push($client_name, $row["client_name"]);
		array_push($due_date, $row["due_date"]);
		array_push($job_status, $row["job_status"]);
	}
	$info = array($job_id, $project_name, $client_name, $due_date, $job_status);
	echo json_encode($info);
}
else if($_POST["id"] == "pm_jobs"){
	$result_prod_users = mysqli_query($conn, "SELECT user FROM users WHERE department = 'Project Management'");
	$sql = "";
	$count = 1;
	while($prod_row = $result_prod_users->fetch_assoc()){
		$user = $prod_row['user'];
		if($count == 1){
			$sql = $sql . "SELECT * FROM job_ticket WHERE processed_by = '$user'";
		}
		else{
			$sql = $sql . " UNION SELECT * FROM job_ticket WHERE processed_by = '$user'";
		}

		$count = $count + 1;
	}

	$sql = $sql . " ORDER BY priority DESC, due_date ASC";
	$result = mysqli_query($conn, $sql);
	$job_id = array();
	$project_name = array();
	$client_name = array();
	$due_date = array();
	$job_status = array();
	while($row = $result->fetch_assoc()){
		array_push($job_id, $row["job_id"]);
		array_push($project_name, $row["project_name"]);
		array_push($client_name, $row["client_name"]);
		array_push($due_date, $row["due_date"]);
		array_push($job_status, $row["job_status"]);
	}
	$info = array($job_id, $project_name, $client_name, $due_date, $job_status);
	echo json_encode($info);
}
else if($_POST["id"] == "all_jobs"){
	$result = mysqli_query($conn, "SELECT * FROM job_ticket");
	$job_id = array();
	$project_name = array();
	$client_name = array();
	$due_date = array();
	$job_status = array();
	while($row = $result->fetch_assoc()){
		array_push($job_id, $row["job_id"]);
		array_push($project_name, $row["project_name"]);
		array_push($client_name, $row["client_name"]);
		array_push($due_date, $row["due_date"]);
		array_push($job_status, $row["job_status"]);
	}
	$info = array($job_id, $project_name, $client_name, $due_date, $job_status);
	echo json_encode($info);
}
else{
	$processed_by = $_POST["id"];
	$result = mysqli_query($conn, "SELECT * FROM job_ticket WHERE processed_by = '$processed_by'");
	$job_id = array();
	$project_name = array();
	$client_name = array();
	$due_date = array();
	$job_status = array();
	while($row = $result->fetch_assoc()){
		array_push($job_id, $row["job_id"]);
		array_push($project_name, $row["project_name"]);
		array_push($client_name, $row["client_name"]);
		array_push($due_date, $row["due_date"]);
		array_push($job_status, $row["job_status"]);
	}
	$info = array($job_id, $project_name, $client_name, $due_date, $job_status);
	echo json_encode($info);
}
?>