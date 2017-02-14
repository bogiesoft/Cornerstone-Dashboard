<?php
require ("connection.php");

if(isset($_POST["submit_form"])){
	$job_id = $_POST["job_id"];
	$sack_number = $_POST["sack_number"];
	$employee_name = $_POST["employee_name"];
	
	$result = mysqli_query($conn, "SELECT * FROM users WHERE user = '$employee_name'");
	$row = $result->fetch_assoc();
	$full_name = $row["first_name"] . " " . $row["last_name"];
	$employee_name = $employee_name . "-" . $full_name;
	
	$recs_per_min = $_POST["recs_per_min"];
	$hours = $_POST["hours"];
	$task = $_POST["task"];
	
	mysqli_query($conn, "INSERT INTO employee_data (job_id, sack_number, employee_name, recs_per_min, hours, task) VALUES ('$job_id', '$sack_number', '$employee_name', '$recs_per_min', '$hours', '$task')");
	header("location: employee_data.php");
}

require ("header.php");
?>
<script src="VendorSweetAlert.js"></script>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Add Employee Record</h1>
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
					<option select = "selected" value = "0">--Select Job Id--</option>
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
					<input name="sack_number" type="text" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Employee Name</label>
					<select name = "employee_name">
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
					<input name="recs_per_min" type="text" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Hours</label>
					<input name="hours" type="text" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Task</label>
					<select name = "task" id = "task">
						<option select = "selected" value = "0">--Enter Job Id--</option>
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
			if(i == 0){
				$('#task').append($('<option>', {select: "selected", value:data[i], text:data[i]}));
			}
			else{
				$('#task').append($('<option>', {value:data[i], text:data[i]}));
			}
		}
    }
});
}
</script>