<?php
require('connection.php');
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM production_data WHERE id = '$id'");
$row = $result->fetch_assoc();
$time_number_array = explode(",", $row['time_number']);
$time_unit_array = explode(",", $row['time_unit']);
$records_per_array = explode(",", $row['records_per']);
$job_array = explode(",", $row['job']);
$total_records = $row["total_records"];

if(isset($_POST['save_form'])){
	
	$total_records = 0;				//total_records
	
	if($_POST['records'] != "" && preg_match("/[0-9]/", $_POST['records'])){
		$total_records = (int)$_POST['records']; 
	}
	
	
	$time_number_id = "time_number";
	$time_unit_id = "time_unit";
	$per_rec_id = "per_rec";
	$job_id = "job";
	$count = 1;
	
	$records_per_array = array();
	$time_number_array = array();
	$time_unit_array = array();
	$job_array = array();
	$hours = 0;
	
	$time_number = 0;	
	$per_rec = 0;
	
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
		
		
		if(!(isset($_POST[$job_id]))){ //job
			$job = "Mail Merge";
		}
		else{
			$job = $_POST[$job_id];
		}
		array_push($job_array, $job);
		
		if($time_number != 0 && $per_rec != 0 && $total_records != 0){
			if($time_unit == "hr."){     //hours
				$add_hours = $total_records / $per_rec * $time_number;
				$hours = $hours + $add_hours;
			}
			else if($time_unit == "min."){
				$add_hours = $total_records / $per_rec * $time_number / 60;
				$hours = $hours + $add_hours;
			}
			else if($time_unit == "sec."){
				$add_hours = $total_records / $per_rec * $time_number / 3600;
				$hours = $hours + $add_hours;
			}
		}
		
		$time_number_id = "time_number" . $count;
		$time_unit_id = "time_unit" . $count;
		$per_rec_id = "per_rec" . $count;
		
		$job_id = "job" . $count;
		$count = $count + 1;
		
	}
	
	$records_per = implode(",", $records_per_array);
	$time_number = implode(",", $time_number_array);
	$time_unit = implode(",", $time_unit_array);
	
	$sql = "SELECT * FROM production_data";
	$result = mysqli_query($conn, $sql);
	$insert = FALSE;
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
			$insert = TRUE;
		}
	}
	
	
	
	$job = implode(",", $job_array);
	if($insert == FALSE){
		mysqli_query($conn, "UPDATE production_data SET total_records = '$total_records', records_per = '$records_per', time_number = '$time_number', time_unit = '$time_unit', job = '$job', hours = '$hours' WHERE id = '$id'") or die("ERROR");
	}
	else{
		mysqli_query($conn, "INSERT INTO production_data (id, total_records, records_per, time_number, time_unit, job, hours) VALUES ('$id', '$total_records', '$records_per', '$time_number', '$time_unit', '$job', '$hours')") or die("ERROR");
	}
	
	header("location: production_data.php");
}
else if(isset($_POST['delete_form'])){
	mysqli_query($conn, "DELETE FROM production_data WHERE id = '$id'");
	header("location: production_data.php");
}
require('header.php');

?>
<script>
	var time_number = ["time_number"];
	var time_unit = ["time_unit"];
	var recs_comp = ["per_rec"];
	
	var job = ["job"];
	var errors = ["error"];
	var jobList = ["Mail Merge", "Letter Printing", "In-House Envelope Printing", "Sealing", "Collating", "Labeling", "Print Permit", "Correct Permit", "Carrier Route", "Endorsement Line", "Address Printing", "Tag as Political", "Inkjet Printing", "Glue Dots", "Inserting", "Printing", "Folding", "Tabbing", "Packaging"];
	var count = 1;
	var Task = 2;
	
	function addTask(){
		$(".prod_info").append("<div class = 'new_task" + count + "'><h1>Task " + Task + ":</h1><label style = 'float: left;'>Time/Unit</label> &nbsp; <input name = 'time_number" + count + "' type = 'text' id = 'time_number" + count + "' style = 'float: left; width: 40px; font-size = 18px;' value = '1'> &nbsp; </input><select style = 'float: left;' name = 'time_unit" + count + "' id = 'time_unit" + count + "'><option>min.</option><option>sec.</option><option>hr.</option></select> <label style = 'float: left;'>Records Complete in Time<label> &nbsp; <input name = 'per_rec" + count + "' type = 'text' id = 'per_rec" + count + "' style = 'float: left; width: 40px' value = '1'></input> &nbsp; &nbsp; &nbsp; <label style = 'float: left;'>Job</label> &nbsp; <select style = 'float: left;width: 200px;' name = 'job" + count + "' id = 'job" + count + "'></select><br><p id = 'error" + count + "' style = 'color:red;'></p></div>");
		//$(".prod_info").append("&nbsp;<label style = 'float:left'>Number of People</label> &nbsp;<select style = 'float:left;' name = 'people" + count + "' id = 'people" + count + "'>");
		//$(".prod_info").append("</select>");
		//$(".prod_info").append("&nbsp; <label style = 'float: left;'>Job</label> &nbsp; <select style = 'float: left;width: 200px;' name = 'job" + count + "' id = 'job" + count + "'>");
		for(var i = 0; i < jobList.length; i++){
			var opt = document.createElement('option');
			opt.value = jobList[i];
			opt.innerHTML = jobList[i];
			document.getElementById("job" + count).appendChild(opt);
		}
		//$(".prod_info").append("</select><br>");
		//$(".prod_info").append("<p id = 'error" + count + "' style = 'color:red;'></p><br>");
		time_number.push("time_number" + count);
		time_unit.push("time_unit" + count);
		recs_comp.push("per_rec" + count);
		
		job.push("job" + count);
		errors.push("error" + count);
		Task = Task + 1;
		count = count + 1;
	}
function removeTask(){
	count = count - 1;
	Task = Task - 1;
	if(count != 0){
		$(".new_task" + count).remove();
	}
	else{
		count = count + 1;
		Task = Task + 1;
	}
}
</script>

<div class="dashboard-cont" style="padding-top:110px;">
<div class="contacts-title">
	<h1 class="pull-left">Edit Production Data</h1>
	<a class="pull-right" href="production_data.php" >Back to Time Tracking</a>
	</div><br><br><br><br>
<form action="" method="post">
<div>Total Records &nbsp; <br><input name = "records" type = "text" id = "records" style = "width: 80px" value = <?php echo $total_records; ?>></input></div><p id = "recs_error" style = "color:red;"></p><br><br>
  <div class = "prod_info">
	<h1>Task 1: </h1>
	<label style = "float: left;">Time/Unit</label> &nbsp; <input name = "time_number" type = "text" id = "time_number" style = "float: left; margin-right: 10px; width: 40px; font-size = 18px;" value = <?php echo $time_number_array[0]; ?>></input><select style = "float:left;" name = "time_unit" id = "time_unit"><option selected = 'selected'><?php echo $time_unit_array[0]; ?></option><option>min.</option><option>sec.</option><option>hr.</option></select>
	<label style = "float: left;">Records Complete in Time</label> &nbsp; <input style = "float: left; width: 40px" name = "per_rec" type = "text" id = "per_rec" value = "<?php echo $records_per_array[0]; ?>"></input> &nbsp; &nbsp;
<label style = "float: left;">Job</label> &nbsp; <select style = "float: left; width: 200px" name = "job" id = "job">
	<option selected = 'selected' value = '<?php echo $job_array[0]; ?>'><?php echo $job_array[0]; ?></option>
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
<button type = "button" onclick = "changeBar();">Submit Data</button><button type = "button" onclick = "addTask();">Add Task</button><button style = 'float: right' type = "button" onclick = "removeTask();">Remove Task</button>
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
		var time_number_array = <?php echo json_encode($time_number_array); ?>;
		var time_unit_array = <?php echo json_encode($time_unit_array); ?>;
		var records_per_array = <?php echo json_encode($records_per_array); ?>;
		var job_array = <?php echo json_encode($job_array); ?>;
		
		for(var i = 1; i < time_number_array.length; i++){
			addEditableTask(time_number_array[i], time_unit_array[i], records_per_array[i], job_array[i]);
		}
		
		changeBar();
    } 
); 
	function addEditableTask(time, unit, records_per, job_single){
		$(".prod_info").append("<div class = 'new_task" + count + "'><h1>Task " + Task + ":</h1><label style = 'float: left;'>Time/Unit</label> &nbsp; <input name = 'time_number" + count + "' type = 'text' id = 'time_number" + count + "' style = 'float: left; width: 40px; font-size = 18px;' value = '" + time + "'> &nbsp; </input><select style = 'float: left;' name = 'time_unit" + count + "' id = 'time_unit" + count + "'><option select = 'selected'>" + unit + "</option><option>min.</option><option>sec.</option><option>hr.</option></select> <label style = 'float: left;'>Records Complete in Time<label> &nbsp; <input name = 'per_rec" + count + "' type = 'text' id = 'per_rec" + count + "' style = 'float: left; width: 40px' value = '" + records_per + "'></input> &nbsp; &nbsp; &nbsp; <label style = 'float: left;'>Job</label> &nbsp; <select style = 'float: left;width: 200px;' name = 'job" + count + "' id = 'job" + count + "'><option select = 'selected'>" + job_single + "</select><br><p id = 'error" + count + "' style = 'color:red;'></p></div>");
		for(var i = 0; i < jobList.length; i++){
			var opt = document.createElement('option');
			opt.value = jobList[i];
			opt.innerHTML = jobList[i];
			document.getElementById("job" + count).appendChild(opt);
		}
		time_number.push("time_number" + count);
		time_unit.push("time_unit" + count);
		recs_comp.push("per_rec" + count);
		
		job.push("job" + count);
		errors.push("error" + count);
		Task = Task + 1;
		count = count + 1;
	}
	function changeBar(){
		var bar = document.getElementById("progress_bar");
		var recordsNum = document.getElementById("records").value;
		var displayTime = document.getElementById("display_time");
		var displayEff = document.getElementById("eff");
		var totalCalculation = 0;
		var error = false;
		var errorMessage = "";
		
		for(var i = 0; i < time_number.length; i++){
			
			var recsPer = document.getElementById(recs_comp[i]).value;
			var time = document.getElementById(time_number[i]).value;
			var unit = document.getElementById(time_unit[i]);
			var errorId = document.getElementById(errors[i]);
			errorId.innerHTML = "";
			document.getElementById("recs_error").innerHTML = "";
			
			
			
			if(/^[0-9]*$/.test(recordsNum) == false || recordsNum.length == 0){
				displayTime.innerHTML =  "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				document.getElementById("recs_error").innerHTML = "Invalid Input";
				error = true;
				break;
			}
			else if(/^[0-9]*$/.test(recsPer) == false || /^[0-9]*$/.test(time) == false){
				
				displayTime.innerHTML =  "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				var TaskNum = i + 1;
				errorMessage = "Character error in Task " + TaskNum;
				errorId.innerHTML = errorMessage;
				error = true;
				break;
			}
			else if(recsPer.length == 0 || time.length == 0)
			{
				displayTime.innerHTML = "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				var TaskNum = i + 1;
				errorMessage = "Field left blank in Task " + TaskNum;
				errorId.innerHTML = errorMessage;
				error = true;
				break;
			}
			else if(recordsNum == 0 || recsPer == 0 || time == 0)
			{
				totalCalculation = totalCalculation + 0;
			}
			else
			{
				if(unit.value == "min."){
					var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time) / 60;
					totalCalculation = totalCalculation + calculation;
				}
				else if(unit.value == "sec.")
				{
					var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time) / 3600;
					totalCalculation = totalCalculation + calculation;
				}
				else if(unit.value == "hr.")
				{
					var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time);
					totalCalculation = totalCalculation + calculation;
				}
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
}
</script>