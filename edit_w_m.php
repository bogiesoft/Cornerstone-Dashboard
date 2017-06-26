<?php
require ("header.php");
require ("connection.php");

	
	$term = $_GET['material_id'];
	//$job_id = $term;
	
	$sql = "SELECT * FROM materials WHERE material_id = '$term'"; 
	$result = mysqli_query($conn,$sql); 
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();	
		$material = $row['material'];
		$type = $row['type'];
		$vendor = $row['vendor'];
		$height = $row['height'];
		$weight = $row['weight'];
		$size = $row['size'];
		$based_on = $row['based_on'];
		$display = "yes";
    
	} 
	else {
		echo "No results found";
		$display = "no";
	}
	if(isset($_POST['submit_form'])){
		foreach(array_keys($_POST) as $input){
			if(!is_array($input)){
				$_POST[$input] = str_replace('"', '', $_POST[$input]);
				$_POST[$input] = str_replace("'", "", $_POST[$input]);
			}
		}
		session_start();
		$user_name = $_SESSION['user'];
		date_default_timezone_set('America/New_York');
		$today = date("Y-m-d G:i:s");
		$a_p = date("A");
		$_SESSION['date'] = $today; 
		$job = "updated weights and measure";
		$material = $_POST['material'];
		$type = $_POST['type'];
		$vendor = $_POST['vendor'];
		$height = $_POST['height'];
		$weight = $_POST['weight'];
		$size = $_POST['size'];
		$based_on = $_POST['based_on'];
		$sql = "UPDATE materials SET material='$material',type='$type',vendor='$vendor',height='$height',weight='$weight',size='$size', based_on = '$based_on' WHERE material_id ='$term'";
		$result = $conn->query($sql) or die('Error querying database.');
		$sql6 = "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
		$result7 = $conn->query($sql6) or die('Error querying database 5.');
		 
		$conn->close();
		header("location: weights_and_measure.php");
		exit();
	}
	if(isset($_POST['delete_form'])){
		session_start();
		$user_name = $_SESSION['user'];
		date_default_timezone_set('America/New_York');
		$today = date("Y-m-d G:i:s");
		$a_p = date("A");
		$job = "deleted weights and measure"; 
		$sql6 = "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
		$result7 = $conn->query($sql6) or die('Error querying database 5.');
		$sql_delete = "DELETE FROM materials WHERE material_id = '$term'";
		mysqli_query($conn, $sql_delete);
		$conn->close();
		header("location: weights_and_measure.php");
		exit();
	}
	
?>