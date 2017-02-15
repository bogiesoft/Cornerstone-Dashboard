<?php
	require("connection.php");
	//setting tasks select for add_employee_data
	if(isset($_POST["id"])){
		$job_id = $_POST["id"];
		$result = mysqli_query($conn, "SELECT tasks FROM production WHERE job_id = '$job_id'");
		$row = $result->fetch_assoc();
		$arr = explode(",", $row["tasks"]);
		echo json_encode($arr);
		exit();
	}
	else if(isset($_POST["id_name"])){ //setting tasks select for employee_statistics 
		$employee_name = $_POST["id_name"];
		$result = mysqli_query($conn, "SELECT DISTINCT task FROM employee_data WHERE employee_name = '$employee_name'");
		$arr = array();
		while($row = $result->fetch_assoc()){
			array_push($arr, $row["task"]);
		}
		
		echo json_encode($arr);
		exit();
	}
	else if(isset($_POST["info"])){ //preparing graphing data for employee_statistics
		$data = $_POST["info"];
		$employee_name = $data[0];
		$task = $data[1];
		$result = mysqli_query($conn, "SELECT * FROM employee_data WHERE employee_name = '$employee_name' AND task = '$task'");
		$result_data = mysqli_query($conn, "SELECT recs_per_min FROM production_data WHERE job = '$task'");
		$row_data = $result_data->fetch_assoc();
		$data_recs_per_min = $row_data["recs_per_min"];
		
		$arr_employee = array();
		$arr_data = array();
		$labels = array();
		while($row = $result->fetch_assoc()){
			$job_id = $row["job_id"];
			$employee_recs_per_min = $row["recs_per_min"];
			$result_job = mysqli_query($conn, "SELECT records_total FROM job_ticket WHERE job_id = '$job_id'");
			$row_job = $result_job->fetch_assoc();
			
			$records_total = $row_job["records_total"];
			
			$total_hours_data = $records_total / $data_recs_per_min / 60;
			$total_hours_employee = $records_total / $employee_recs_per_min / 60;
			
			array_push($labels, $job_id);
			array_push($arr_employee, $total_hours_employee);
			array_push($arr_data, $total_hours_data);
		}
		
		$arr = array($labels, $arr_employee, $arr_data);
		echo json_encode($arr);
		exit();
	}
?>