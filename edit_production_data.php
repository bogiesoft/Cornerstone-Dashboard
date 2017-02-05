<?php
require('connection.php');
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM production_data WHERE job = '$id'");
$row = $result->fetch_assoc();
$job = $row['job'];
$recs_per_min = $row["recs_per_min"];
$total_records = $row["total_records"];

if(isset($_POST['save_form'])){
	$hours = 0;
	$job = "Mail Merge";
	$recs_min = 0;
	$total_records = 0;				//total_records
	
	if($_POST['records'] != "" && preg_match("/[0-9]/", $_POST['records'])){
		$total_records = (int)$_POST['records']; 
	}
		
	if($_POST["recs_per_min"] != "" && preg_match("/[0-9]/", $_POST["recs_per_min"])){ //time_number
		$recs_min = (int)$_POST["recs_per_min"]; 
	}

	if((isset($_POST["job"]))){ //job
		$job = $_POST["job"];
	}
		
	if($recs_min != 0){ //hours
		$hours = $total_records / $recs_min / 60;
	}
	
	$result_check = mysqli_query($conn, "SELECT job FROM production_data WHERE job = '$job'");
	
	if(mysqli_num_rows($result_check) > 0){
		mysqli_query($conn, "UPDATE production_data SET total_records = '$total_records', recs_per_min = '$recs_min', hours = '$hours' WHERE job = '$job'") or die("error");
	}
	else{
		mysqli_query($conn, "DELETE FROM production_data WHERE job = '$id'");
		mysqli_query($conn, "INSERT INTO production_data (total_records, recs_per_min, hours, job) VALUES ('$total_records', '$recs_min', '$hours', '$job')");
	}
	
	header("location: production_data.php");
}
else if(isset($_POST['delete_form'])){
	mysqli_query($conn, "DELETE FROM production_data WHERE job = '$id'");
	header("location: production_data.php");
}
require('header.php');

?>

<div class="dashboard-cont" style="padding-top:110px;">
<div class="contacts-title">
	<h1 class="pull-left">Edit Production Data</h1>
	<a class="pull-right" href="production_data.php" >Back to Time Tracking</a>
	</div><br><br><br><br>
<form action="" method="post">
<div>Total Records &nbsp; <br><input name = "records" type = "text" id = "records" style = "width: 80px" value = <?php echo $total_records; ?>></input></div><p id = "recs_error" style = "color:red;"></p><br><br>
  <div class = "prod_info">
	<h1>Task: </h1>
	<label style = "float: left;">Records/Minute</label> &nbsp; <input name = "recs_per_min" type = "text" id = "recs_per_min" style = "float: left; margin-right: 10px; width: 40px; font-size = 18px;" value = <?php echo $recs_per_min; ?>></input>
<label style = "float: left;">Job</label> &nbsp; <select style = "float: left; width: 200px" name = "job" id = "job">
	<option selected = 'selected' value = '<?php echo $job; ?>'><?php echo $job; ?></option>
	<option value="Mail Merge">Mail Merge</option>
					  <option value="Letter Printing">Letter Printing</option>
					  <option value="In-House Envelope Printing">In-House Envelope Printing</option>
					  <option value="Tabbing">Tabbing</option>
					  <option value="Folding">Folding</option>
					  <option value="Inserting">Inserting</option>
					  <option value="Sealing">Sealing</option>
					  <option value="Collating">Collating</option>
					  <option value="Labeling">Labeling</option>
					  <option value="Print Permit">Print Permit</option>
					  <option value="Correct Permit">Correct Permit</option>
					  <option value="Carrier Route">Carrier Route</option>
					  <option value="Endorsement line">Endorsement line</option>
					  <option value="Address Printing">Address Printing</option>
					  <option value="Tag as Political">Tag as Political</option>
					  <option value="Inkjet Printing">Inkjet Printing</option>
					  <option value="Glue Dots">Glue Dots</option>
</select><br><br>

<p id = "error" style = "color: red;"></p>
</div><br>
<h1><progress id = "progress_bar" value = "1" max = "40" style = "background-color: red"></progress></h1><br>
<h2 id = "display_time">Hours: 0</h2><br>
<h2 id = "eff">Efficiency: </h2><br>
<input class = 'save-btn' type = "submit" value = "Save Data" name = "save_form"></input>
<input class = 'delete-btn' type = "submit" value = "Delete" name = "delete_form"></input>
</form>
<button type = "button" onclick = "changeBar();">Calculate</button>
<style>
progress[value]::-webkit-progress-value {
  background-image:
	   -webkit-linear-gradient(-45deg, 
	                           transparent 33%, rgba(0, 0, 0, .1) 33%, 
	                           rgba(0,0, 0, .1) 66%, transparent 66%),
	   -webkit-linear-gradient(top, 
	                           rgba(255, 255, 255, .25), 
	                           rgba(0, 0, 0, .25)),
	   -webkit-linear-gradient(left, #09c, #f44);

    border-radius: 2px; 
    background-size: 35px 20px, 100% 100%, 100% 100%;
}
</style>
<script src="TimeTrackingSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>

<script type = "text/javascript">
$(document).ready(function() 
    { 
		var recs_min = <?php echo json_encode($recs_per_min); ?>;
		var job = <?php echo json_encode($job); ?>;
		
		changeBar();
    } 
); 
	function changeBar(){
		var bar = document.getElementById("progress_bar");
		var recordsNum = document.getElementById("records").value;
		var displayTime = document.getElementById("display_time");
		var displayEff = document.getElementById("eff");
		var totalCalculation = 0;
		var error = false;
		var errorMessage = "";
			
			var recs_min = document.getElementById("recs_per_min").value;
			var errorId = document.getElementById("error");
			errorId.innerHTML = "";
			document.getElementById("recs_error").innerHTML = "";
			
			
			
			if(/^[0-9]*$/.test(recs_min) == false || recs_min.length == 0){
				displayTime.innerHTML =  "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				document.getElementById("recs_error").innerHTML = "Invalid Input";
				error = true;
			}
			else if(recs_min == 0)
			{
				totalCalculation = totalCalculation + 0;
			}
			else
			{
				totalCalculation = parseInt(recordsNum) / parseInt(recs_min) / 60;
			}
			
			bar.value = 40 - totalCalculation;
			displayTime.innerHTML = "Hours: " + totalCalculation;
			
			if(totalCalculation <= 12)
			{
				displayEff.innerHTML = "Efficiency: High";
				displayEff.style.color = "green";
			}
			else if(totalCalculation <= 36)
			{
				displayEff.innerHTML = "Efficiency: Medium";
				displayEff.style.color = "orange";
			}
			else
			{
				displayEff.innerHTML = "Efficiency: Low";
				displayEff.style.color = "red";
			}
}
</script>