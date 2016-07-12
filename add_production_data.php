<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname= "crst_dashboard";

	// Create Connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$total_records = 0;				//total_records
	
	if($_POST['records'] != "" && preg_match("/[0-9]/", $_POST['records'])){
		$total_records = (int)$_POST['records']; 
	}
	
	$id_1 = 5000;
	
	$sql = "SELECT * FROM production_data";
	$result = mysqli_query($conn, $sql);
	
	while($row = $result->fetch_assoc()){
		if((int)$row['id'] > $id_1){
			$id_1 = (int)$row['id'];
		}
	}
	
	$id_1 = $id_1 + 1;
	
	
	$time_number_id = "time_number";
	$time_unit_id = "time_unit";
	$per_rec_id = "per_rec";
	$people_id = "people";
	$employee_id = "employee";
	$job_id = "job";
	$count = 1;
	
	$records_per_array = array();
	$time_number_array = array();
	$time_unit_array = array();
	$people_array = array();
	$job_array = array();
	$hours = 0;
	
	$time_number = 0;	
	$per_rec = 0;
	$employees = "";
	$people = "";
	$time_unit = "";
	$job = "";
	
	while(isset($_POST[$time_number_id])){
		
		$time_number = 0;
		$per_rec = 0;
		
		if($_POST[$time_number_id] != "" && preg_match("/[0-9]/", $_POST[$time_number_id])){ //time_number
			$time_number = (int)$_POST[$time_number_id]; 
		}
		array_push($time_number_array, $time_number);
		
		
		if($_POST[$per_rec_id] != "" && preg_match("/[0-9]/", $_POST[$per_rec_id])){ //records_per
			$per_rec = (int)$_POST[$per_rec_id]; 
		}
		array_push($records_per_array, $per_rec);
		
		if(!(isset($_POST[$time_unit_id]))){ //time_unit
			$time_unit = "min.";
		}
		else{
			$time_unit = $_POST[$time_unit_id];
		}
		array_push($time_unit_array, $time_unit);
		
		if(!(isset($_POST[$people_id]))){ //people
			$people = "1";
		}
		else{
			$people = $_POST[$people_id];
		}
		array_push($people_array, $people);
		
		if(!(isset($_POST[$job_id]))){ //job
			$job = "Mail Merge";
		}
		else{
			$job = $_POST[$job_id];
		}
		array_push($job_array, $job);
		
		if($time_number != 0 && $per_rec != 0 && $total_records != 0){
			if($time_unit == "hr."){     //hours
				$add_hours = $total_records / $per_rec * $time_number / (int)$people;
				$hours = $hours + $add_hours;
			}
			else if($time_unit == "min."){
				$add_hours = $total_records / $per_rec * $time_number / 60 / (int)$people;
				$hours = $hours + $add_hours;
			}
			else if($time_unit == "sec."){
				$add_hours = $total_records / $per_rec * $time_number / 3600 / (int)$people;
				$hours = $hours + $add_hours;
			}
		}
		
		$time_number_id = "time_number" . $count;
		$time_unit_id = "time_unit" . $count;
		$per_rec_id = "per_rec" . $count;
		$people_id = "people" . $count;
		$employee_id = "employee" . $count;
		$job_id = "job" . $count;
		$count = $count + 1;
		
	}
	
	$records_per = implode(",", $records_per_array);
	$time_number = implode(",", $time_number_array);
	$time_unit = implode(",", $time_unit_array);
	$people = implode(",", $people_array);
	
	$sql = "SELECT * FROM production_data";
	$result = mysqli_query($conn, $sql);
	
	while($row = $result->fetch_assoc()){
		$match = FALSE;
		$production_array = explode(",", $row['job']);
		if(count($production_array) == count($job_array)){
			$contains = TRUE;
			for($i = 0; $i < count($production_array); $i++){
				if(!in_array($production_array[$i], $job_array)){
					$contains = FALSE;
					break;
				}
			}
			if($contains == TRUE){
				$match = TRUE;
			}
		}
		if($match == TRUE){
			$job = $row['job'];
			mysqli_query($conn, "DELETE FROM production_data WHERE job = '$job'");
		}
	}
	
	
	
	$job = implode(",", $job_array);
	
	mysqli_query($conn, "INSERT INTO production_data (id, total_records, records_per, time_number, time_unit, people, job, hours) VALUES ('$id_1', '$total_records', '$records_per', '$time_number', '$time_unit', '$people', '$job', '$hours')") or die("ERROR");
	
	header("location: production_data.php");
?>