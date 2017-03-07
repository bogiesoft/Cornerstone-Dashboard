<?php
require("connection.php");
$record_id = $_GET["record_id"];

if(isset($_POST["submit_form"])){
	$job_id = $_POST["job_id"];
	$sack_number = $_POST["sack_number"];
	$user = $_POST["employee_name"];
	
	$result = mysqli_query($conn, "SELECT * FROM users WHERE user = '$user'");
	$row = $result->fetch_assoc();
	$full_name = $row["first_name"] . " " . $row["last_name"];
	
	$employee_name = $user . "-" . $full_name;
	$recs_per_min = $_POST["recs_per_min"];
	if(!is_numeric($recs_per_min)){
		$recs_per_min = 1;
	}
	$hours = $_POST["hours"];
	if(!is_numeric($hours)){
		$hours = 1;
	}
	$task = $_POST["task"];
	
	mysqli_query($conn, "UPDATE employee_data SET job_id = '$job_id', sack_number = '$sack_number', employee_name = '$employee_name', recs_per_min = '$recs_per_min', hours = '$hours', task = '$task' WHERE record_id = '$record_id'");
	header("location: employee_data.php");
	
}

require("header.php");

$result = mysqli_query($conn, "SELECT * FROM employee_data WHERE record_id = '$record_id'");
$row = $result->fetch_assoc();

$job_id = $row["job_id"];
$sack_number = $row["sack_number"];
$employee_name_full = $row["employee_name"];
$employee_username = explode("-", $employee_name_full);
$user_name = $employee_username[0];
$full_name = $employee_username[1];
$employee_name = $full_name;
$recs_per_min = $row["recs_per_min"];
$hours = $row["hours"];
$task = $row["task"];
$job = $task;
$special = "None";
if(strpos($task, "^") !== FALSE){
	$split_job = explode("^", $task);
	$job = $split_job[0];
	$special = $split_job[1];
	$job = $job . "(" . $special . ")";
}
?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Edit Employee Record</h1>
	<a class="pull-right" href="employee_data.php">Back to Employee Data</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<form action="" method="post">
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Job Id</label>
					<select id = "job_id" name = "job_id" onchange = "loadTaskSelect()">
					<option select = "selected" value = "<?php echo $row["job_id"]; ?>"><?php echo $row["job_id"]; ?></option>
					<?php
							$result = mysqli_query($conn, "SELECT user FROM users WHERE department = 'Production'");
							$sql = "";
							$count = 1;
							while($prod_row = $result->fetch_assoc()){
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
						$result_ids = mysqli_query($conn, $sql);
						while($row = $result_ids->fetch_assoc()){
							$id = $row["job_id"];
							echo "<option value = '$id'>$id</option>";
						}
					?>
					</select>
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Sack/Tray #</label>
					<input name="sack_number" type="text" class="contact-prefix" value = "<?php echo $sack_number; ?>">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Employee Name</label>
					<select name = "employee_name">
					<option select = "selected" value = "<?php echo $user_name; ?>"><?php echo $employee_name; ?></option>
					<?php
					
					$result = mysqli_query($conn, "SELECT * FROM users");
					while($row = $result->fetch_assoc()){
						$full_name = $row["first_name"] . " " . $row["last_name"];
						$user = $row["user"];
						echo "<option value = '$user'>$full_name</option>";
					}
					
					?>
					</select>
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Records/Minute</label>
					<input name="recs_per_min" type="text" class="contact-prefix" value = "<?php echo $recs_per_min; ?>">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Hours</label>
					<input name="hours" type="text" class="contact-prefix" value = "<?php echo $hours; ?>">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Task</label>
					<select name = "task" id = "task">
					<option select = "selected" value = "<?php echo $task; ?>"><?php echo $job; ?></option>
					<?php
						$result_select_tasks = mysqli_query($conn, "SELECT tasks FROM production WHERE job_id = '$job_id'");
						$row_select_tasks = $result_select_tasks->fetch_assoc();
						$tasks = $row_select_tasks["tasks"];
						$tasks_array = explode(",", $tasks);
						
						for($i = 0; $i < count($tasks_array); $i++){
							$job = $tasks_array[$i];
							$special = "None";
							$task = $job;
							if(strpos($tasks_array[$i], "^") !== FALSE){
								$split_job = explode("^", $tasks_array[$i]);
								$job = $split_job[0];
								$special = $split_job[1];
							}
							if($special != "None"){
								echo "<option value = '" . $task . "'>" . $job . "(" . $special . ")</option>";
							}
							else{
								echo "<option value = '" . $task . "'>" . $task . "</option>";
							}
						}
					?>
					</select>
					<div class="clear"></div>
					</div>
				</div>
				</div>
				<div class="newcontact-tabbtm">
					<input class="save-btn store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
				</div>
			</form>
			
			</div>
		</div>
	</div>
	</div>
</div>
</div>
<script>
function loadTaskSelect(){
	var this_id = $("#job_id").val();
	$.ajax({
    type: "POST",
    url: "create_task_list.php",
    data: 'id=' + this_id,
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
        $("#task").empty();
		for(var i = 0; i < data.length; i++){
			var job = data[i];
			var special = "None";
			if(job.indexOf('^') > -1){
				var split_job = job.split("^");
				job = split_job[0];
				special = split_job[1];
			}
			if(i == 0){
				$('#task').append($('<option>', {select: "selected", value:job + "^" + special, text:job + "(" + special + ")"}));
			}
			else{
				$('#task').append($('<option>', {value:data[i], text:data[i]}));
			}
		}
    }
});
}
</script>