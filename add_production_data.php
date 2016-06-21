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
	
	
	$time_number_id = "time_number";
	$time_unit_id = "time_unit";
	$per_rec_id = "per_rec";
	$people_id = "people";
	$employee_id = "employee";
	$job_id = "job";
	$count = 1;
	
	
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
		if($_POST[$per_rec_id] != "" && preg_match("/[0-9]/", $_POST[$per_rec_id])){ //records_per
			$per_rec = (int)$_POST[$per_rec_id]; 
		}
		
		if(!(isset($_POST[$employee_id]))){ //employees
			$employees = "NONE";
		}
		else{
			for($i = 0; $i < count($_POST[$employee_id]); $i++){
				$employees = $employees . $$_POST[$employee_id][$i] . ", ";
			}
		}
		
		if(!(isset($_POST[$time_unit_id]))){ //time_unit
			$time_unit = "min.";
		}
		else{
			$time_unit = $_POST[$time_unit_id];
		}
		
		if(!(isset($_POST[$people_id]))){ //people
			$people = "1";
		}
		else{
			$people = $_POST[$people_id];
		}
		
		if(!(isset($_POST[$job_id]))){ //job
			$job = "Insertion";
		}
		else{
			$job = $_POST[$job_id];
		}
		
		$hours = 12312.4;   //hours
		
		$sql = "INSERT INTO production_data (total_records, records_per, time_number, time_unit, people, employees, job, hours) VALUES ('$total_records', '$per_rec', '$time_number', '$time_unit', '$people', '$employees', '$job', '$hours')";
		mysqli_query($conn, $sql) or die("ERROR");
		
		$time_number_id = "time_number" . $count;
		$time_unit_id = "time_unit" . $count;
		$per_rec_id = "per_rec" . $count;
		$people_id = "people" . $count;
		$employee_id = "employee" . $count;
		$job_id = "job" . $count;
		$count = $count + 1;
		
	}
	header("location: production_data.php");
?>