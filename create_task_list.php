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
		$employee_name = $_POST["id_name"][0];
		$job_id = $_POST["id_name"][1];
		if($employee_name == "123all"){
			$result = mysqli_query($conn, "SELECT DISTINCT task FROM employee_data WHERE job_id = '$job_id'");
		}
		else{
			$result = mysqli_query($conn, "SELECT DISTINCT task FROM employee_data WHERE employee_name = '$employee_name' AND job_id = '$job_id'");
		}
		$arr = array();
		while($row = $result->fetch_assoc()){
			array_push($arr, $row["task"]);
		}
		
		echo json_encode($arr);
		exit();
	}
	else if(isset($_POST["id_job"])){
		$arr = array();
		$job_id = $_POST["id_job"];
		$result = mysqli_query($conn, "SELECT DISTINCT employee_name FROM employee_data WHERE job_id = '$job_id'");
		while($row = $result->fetch_assoc()){
			array_push($arr, $row["employee_name"]);
		}
		echo json_encode($arr);
		exit();
	}
	else if(isset($_POST["info"])){ //preparing graphing data for employee_statistics
		$data = $_POST["info"];
		$employee_name = $data[0];
		$task = $data[1];
		$job = $task;
		$special = "None";
		if(strpos($task, "^") !== FALSE){
			$split_job = explode("^", $task);
			$job = $split_job[0];
			$special = $split_job[1];
		}
		$job_id = $data[2];
		$result = mysqli_query($conn, "SELECT * FROM employee_data WHERE employee_name = '$employee_name' AND task = '$task' AND job_id = '$job_id'");
		$result_data = mysqli_query($conn, "SELECT recs_per_min FROM production_data WHERE job = '$job' AND special = '$special'");
		$result_job = mysqli_query($conn, "SELECT records_total FROM job_ticket WHERE job_id = '$job_id'");
		$row_job = $result_job->fetch_assoc();
		$records_total = $row_job["records_total"];
		
		$row_data = $result_data->fetch_assoc();
		$data_recs_per_min = $row_data["recs_per_min"];
		
		$arr_employee = array();
		$total_hours_employee = 0;
		
		while($row = $result->fetch_assoc()){
			$job_id = $row["job_id"];
			$employee_recs_per_min = $row["recs_per_min"];
			
			$hours_employee = $records_total / $employee_recs_per_min / 60;
			$total_hours_employee = $total_hours_employee + $hours_employee;
			
			array_push($arr_employee, $hours_employee);
		}
		
		$average_employee = $total_hours_employee / count($arr_employee);
		$average_data = $records_total / $data_recs_per_min / 60;
		
		$arr = array($average_employee, $average_data, $task);
		echo json_encode($arr);
		exit();
	}
	else if(isset($_POST["info_all_employees"])){ //finding all employee data to prepare for graph in employee_statistics
		$data = $_POST["info_all_employees"];
		$task = $data[1];
		$job_id = $data[2];
		$job = $task;
		$special = "None";
		if(strpos($task, "^") !== FALSE){
			$split_job = explode("^", $task);
			$job = $split_job[0];
			$special = $split_job[1];
		}
		$result_unique_employees = mysqli_query($conn, "SELECT DISTINCT employee_name FROM employee_data WHERE task = '$task' AND job_id = '$job_id'");
		//arrays to pass back
		$array_name = array();
		$array_averages = array();
		$array_data_averages = array();
		//------------------------------
		$result_production_data = mysqli_query($conn, "SELECT recs_per_min FROM production_data WHERE job = '$job' AND special = '$special'");
		$row_production_data = $result_production_data->fetch_assoc();
		$result_job = mysqli_query($conn, "SELECT records_total FROM job_ticket WHERE job_id = '$job_id'");
		$row_job = $result_job->fetch_assoc();
		
		//-----------------------
		$recs_per_min_data = $row_production_data["recs_per_min"];
		$records_total = $row_job["records_total"];
		$average_data = $records_total / $recs_per_min_data / 60;
		//-----------------------
		while($row = $result_unique_employees->fetch_assoc()){
			$employee_name = $row["employee_name"];
			$result_employee_data = mysqli_query($conn, "SELECT * FROM employee_data WHERE employee_name = '$employee_name' AND task = '$task' AND job_id = '$job_id'");
			$total_hours_employee = 0;
			$total_count = 0;
			while($row_employee_data = $result_employee_data->fetch_assoc()){
				$recs_per_min_employee = $row_employee_data["recs_per_min"];
				
				
				$hours_employee = $records_total / $recs_per_min_employee / 60;
				$total_hours_employee = $total_hours_employee + $hours_employee;
				$total_count = $total_count + 1;
			}
			
			$average_employee = $total_hours_employee / $total_count;
			array_push($array_averages, $average_employee);
			array_push($array_data_averages, $average_data);
			array_push($array_name, $employee_name);
		}
		
		$arr = array($array_averages, $array_data_averages, $array_name);
		echo json_encode($arr);
		exit();
	}
	else if(isset($_POST["info_all_tasks"])){
		$data = $_POST["info_all_tasks"];
		$employee_name = $data[0];
		$job_id = $data[2];
		
		$result_distinct_task = mysqli_query($conn, "SELECT DISTINCT task FROM employee_data WHERE employee_name = '$employee_name' AND job_id = '$job_id'");
		//arrays to pass back
		$array_task = array();
		$array_averages = array();
		$array_data_averages = array();
		//-------------------------------
		$result_job = mysqli_query($conn, "SELECT records_total FROM job_ticket WHERE job_id = '$job_id'");
		$row_job = $result_job->fetch_assoc();
		$records_total = $row_job["records_total"];
		while($row = $result_distinct_task->fetch_assoc()){
			$task = $row["task"];
			$job = $task;
			$special = "None";
			if(strpos($task, "^") !== FALSE){
				$split_job = explode("^", $task);
				$job = $split_job[0];
				$special = $split_job[1];
			}
			$result_employee_data = mysqli_query($conn, "SELECT * FROM employee_data WHERE employee_name = '$employee_name' AND task = '$task' AND job_id = '$job_id'");
			$total_hours_employee = 0;
			$total_count = 0;
			while($row_employee_data = $result_employee_data->fetch_assoc()){
				$recs_per_min_employee = $row_employee_data["recs_per_min"];
				
				$hours_employee = $records_total / $recs_per_min_employee / 60;
				$total_hours_employee = $total_hours_employee + $hours_employee;
				$total_count = $total_count + 1;
			}
			
			$result_production_data = mysqli_query($conn, "SELECT recs_per_min FROM production_data WHERE job = '$job' AND special = '$special'");
			$row_production_data = $result_production_data->fetch_assoc();
			$recs_per_min_data = $row_production_data["recs_per_min"];
			
			$average_data = $records_total / $recs_per_min_data / 60;
			$average_employee = $total_hours_employee / $total_count;
			array_push($array_averages, $average_employee);
			array_push($array_data_averages, $average_data);
			array_push($array_task, $job . "(" . $special . ")");
		}
		$arr = array($array_averages, $array_data_averages, $array_task);
		echo json_encode($arr);
		exit();
	}
?>