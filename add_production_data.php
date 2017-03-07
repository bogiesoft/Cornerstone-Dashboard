<?php
	
	require("connection.php");
	
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
	
	
	$recs_min_id = "recs_per_min";
	$job_id = "job";
	$special_id = "special";
	$count = 1;
	
	while(isset($_POST[$recs_min_id])){
		
		$recs_min = 0;
		$job = "";
		$hours = 0;
		
		if($_POST[$recs_min_id] != "" && is_numeric($_POST[$recs_min_id])){ //Records/Minute
			$recs_min = (float)$_POST[$recs_min_id]; 
		}
		
		if(!(isset($_POST[$job_id]))){ //job
			$job = "Mail Merge";
		}
		else{
			$job = $_POST[$job_id];
		}
		
		if($recs_min != 0){
			$hours = $total_records / $recs_min / 60;
		}
		
		$special = "None";
		if(isset($_POST[$special_id])){
			$special = $_POST[$special_id];
		}
		
		$recs_min_id = "recs_per_min" . $count;
		$job_id = "job" . $count;
		$special_id = "special" . $count;
		$count = $count + 1;
		
		$result_check = mysqli_query($conn, "SELECT job FROM production_data WHERE job = '$job' AND special = '$special'");
		if(mysqli_num_rows($result_check) > 0){
			mysqli_query($conn, "UPDATE production_data SET total_records = '$total_records', recs_per_min = '$recs_min', hours = '$hours' WHERE job = '$job' AND special = '$special'");
		}
		else{
			mysqli_query($conn, "INSERT INTO production_data (total_records, recs_per_min, hours, job, special) VALUES ('$total_records', '$recs_min', '$hours', '$job', '$special')");
		}
		
	}

	header("location: production_data.php");
?>