<?php
	require("header.php");
	require("connection.php");
?>
<style>
#cont {
  display: block;
  height: 200px;
  width: 200px;
  margin: 2em auto;
  box-shadow: 0 0 1em black;
  border-radius: 100%;
  position: relative;
  text-align: center;
}
#cont:after {
  position: absolute;
  display: block;
  height: 160px;
  width: 160px;
  left: 50%;
  top: 50%;
  box-shadow: inset 0 0 1em black;
  content: attr(data-pct)"%";
  margin-top: -80px;
  margin-left: -80px;
  border-radius: 100%;
  line-height: 160px;
  font-size: 2em;
  text-shadow: 0 0 0.5em black;
}

input {
  color: #000;
}


/* Make things perty */
html {  height: 100%;}
</style>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Production</h1>
	<a class="pull-right" href="production_data.php" style="margin-right:20px; background-color:#d14700;">Time Tracking</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form id = "search_form" action="production_job_search.php" method="post">
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a job">
			</form>
			<div class="search-boxright pull-right"><a href="#" onclick = "document.getElementById('search_form').submit()">Submit</a></div>
		</div>
	</div>
	</div>
<div class="clear"></div>

<?php
//global data arrays

$hours_array = array();
$canvas_id_array = array();

//change priorities here

$result_prod_users = mysqli_query($conn, "SELECT user FROM users WHERE department = 'Production'");
$sql = "";
$count = 1;
while($prod_row = $result_prod_users->fetch_assoc()){
	$user = $prod_row['user'];
	if($count == 1){
		$sql = $sql . "SELECT * FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id WHERE processed_by = '$user'";
	}
	else{
		$sql = $sql . " UNION SELECT * FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id WHERE processed_by = '$user'";
	}
	
	$count = $count + 1;
}

$sql = $sql . " ORDER BY priority DESC, due_date ASC";

$job_result =  mysqli_query($conn,$sql) or die("error");
$job_count = 1;
while($row = $job_result->fetch_assoc()){
	$job_id = $row['job_id'];
	if(isset($_POST['priority' . $job_count])){
		$priority = $_POST['priority' . $job_count];
		mysqli_query($conn, "UPDATE job_ticket SET priority = '$priority' WHERE job_id = '$job_id'");
	}
	if(isset($_POST['assign_to' . $job_count])){
		$user = $_POST['assign_to' . $job_count];
		mysqli_query($conn, "UPDATE mail_data SET processed_by = '$user' WHERE job_id = '$job_id'");
	}
	$job_count = $job_count + 1;
}

//----------------------------------------------------------
$result = mysqli_query($conn,$sql);


if ($result->num_rows > 0) {
    // output data of each row
	$job_count = 1;
    while($row = $result->fetch_assoc()) {
		
		$job_id = $row["job_id"];
		$result1 = mysqli_query($conn, "SELECT records_total, processed_by FROM mail_data WHERE job_id = '$job_id'");
		$row1 = $result1->fetch_assoc();
		$records_total = (int)$row1['records_total'];
		$assigned_to = $row1["processed_by"];
		$result2 = mysqli_query($conn, "SELECT department, first_name, last_name FROM users WHERE user = '$assigned_to'");
		$row2 = $result2->fetch_assoc();
		
		if($row2["department"] == "Production"){
			
			$result_priority = mysqli_query($conn, "SELECT priority FROM job_ticket WHERE job_id = '$job_id'");
			$prow = $result_priority->fetch_assoc();
			$level = $prow['priority'];
			
			$color_priority = "#e9eced";
			$value = "None";
			
			if($level == 1){
				$color_priority = "#80ff80";
				$value = "Low";
			}
			else if($level == 2){
				$value = "Medium";
				$color_priority = "#ffdb4d";
			}
			else if($level == 3){
				$color_priority = "#ffb3b3";
				$value = "High";
			}
			echo "<div data-role='main' class='ui-content'>";
				echo "<div class='vendor-left' style = 'background: " . $color_priority . "'>";
					$x = $row["job_id"];
					echo "<h3><a href='edit_job.php?job_id=$x'>".$row["job_id"]."</a></h1>";
					echo "<p>Client name: ".$row["client_name"]."</p>";
					echo "<p>Project name: ".$row["project_name"]."</p>";
					echo "<p style = 'margin-bottom: -80px;'><form action = '' method = 'post'><select style = 'width: 95px' name = 'priority" . $job_count . "' onchange = 'this.form.submit()'>";
					echo "<option selected = 'selected' value = '" . $level . "'>" . $value . "<option value = '0'>None</option><option value = '1'>Low</option><option value = '2'>Medium</option><option value = '3'>High</option></select></form>";
				echo "</div>";
				echo "<div class='vendor-right' style = 'background: " . $color_priority . "'>";
					echo "<p>Due date: ".$row["due_date"]."</p>";
					echo "<p>Records total: ".$row1["records_total"]."</p>";
					$name = $row2["first_name"] . " " . $row2["last_name"];
					echo "<p>Assigned to: ".$name."</p>";
					echo "<form style = 'margin-left: 650px;' action = '' method = 'post'><select onchange = 'this.form.submit()' name = 'assign_to" . $job_count . "' style = 'width: 150px'><option selected disabled value = 'None'>--Assign To--</option>";
					
					$result_users = mysqli_query($conn, "SELECT user FROM users");
					while($row_users = $result_users->fetch_assoc()){
						$user = $row_users['user'];
						$get_name = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user = '$user'");
						$row_name = $get_name->fetch_assoc();
						$name = $row_name['first_name'] . " " . $row_name['last_name'];
						echo "<option value = '" . $user . "'>" . $name . "</option>";
					}
					
					echo "</select></form>";
				echo "</div>";
					
		
						echo "<div>";
								
						//put efficiency code here
						
						$result3 = mysqli_query($conn, "SELECT tasks FROM production WHERE job_id = '$job_id'");
						$row3 = $result3->fetch_assoc();
						
						$sql = "SELECT * FROM production_data";
						$result4 = mysqli_query($conn, $sql);
						
						$match = FALSE;
						$count = 1;
						
						while($row4 = $result4->fetch_assoc()){
							$production_record = (int)$row4['total_records'];
							$match = FALSE;
							
							$job_tasks_array = explode(",", $row3['tasks']);
							$production_tasks_array = explode(",", $row4['job']);
							$sameSize = FALSE;
								
							if(sizeOf($production_tasks_array) == sizeOf($job_tasks_array)){
								$sameSize = TRUE;
							}
							sort($job_tasks_array);
							$production_tasks_array2 = $production_tasks_array;
							sort($production_tasks_array2);
								
								
							if($production_tasks_array2 == $job_tasks_array && $sameSize == TRUE){
								$records_per_array = explode(",", $row4['records_per']);
								$time_unit_array = explode(",", $row4['time_unit']);
								$time_number_array = explode(",", $row4['time_number']);
								$people_array = explode(",", $row4['people']);
								$hours = 0;
								//$job_count = 1;
								
								for($i = 0; $i < count($time_unit_array); $i++){
									if((int)$records_per_array[$i] != 0 && (int)$time_number_array[$i] != 0){
										if($time_unit_array[$i] == "hr."){
											
												$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / (int)$people_array[$i];
												$hours = $hours + $add_hours;
											
										}
										else if($time_unit_array[$i] == "min."){
											
												$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 60 / (int)$people_array[$i];
												$hours = $hours + $add_hours;
											
										}
										else if($time_unit_array[$i] == "sec."){
											
											
												$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 3600 / (int)$people_array[$i];
												$hours = $hours + $add_hours;
											
										}
									}
								}
									
								echo "<ul style = 'list-style-type: none;'>";
								//$job_count = 1;
								for($i = 0; $i < count($records_per_array); $i++){
									echo "<li style = 'margin-left: 75px'>" . $production_tasks_array[$i] . ": " . $records_per_array[$i] . " record(s) in " . $time_number_array[$i] . " " . $time_unit_array[$i] . " with " . $people_array[$i] . " person/people";
									//$job_count = $job_count + 1;
								}
								echo "<li style = 'margin-left: 75px'><h2 value = '" . $hours . "'>Total Hours: " . $hours . "</h2></li>";
								echo "<li style = 'margin-left: 75px; margin-top: 30px'><div class='search-boxright'><a href='job_data.php?job_id=$job_id'>Add People</a></div></li>";
								$efficiency = "High";
								if($hours <= 12){
									$efficiency = "High";
								}
								else if($hours <= 36){
									$efficiency = "Medium";
								}
								else{
									$efficiency = "Low";
								}
								
								array_push($hours_array, $hours);
								array_push($canvas_id_array, "canvas_prod" . $job_count);
								echo "<li style = 'margin-left: 580px; margin-top: -100px;'><h2 style = 'margin-bottom: 135px;'>Efficiency: " . $efficiency . "</h2></li>";
									
								echo "<li style = 'margin-left: 500px; margin-top: -125px;'><div id='canvas-holder' style = 'width: 40%; margin-left: 185px; margin-top: -115px'>
									<canvas id='canvas_prod" . $job_count . "' width='500' height='500'/>
									</div></li>";
								echo "</ul>";
								$count = $count + 1;
								$job_count = $job_count + 1;
							}
						}
	
						if($count == 1){
							echo "<i>0 results</i>";
						}
				echo "</div>";
		}
		
		//$job_count = $job_count + 1;
    }
} else {
    echo "0 results";
}

$conn->close();

?>

</div>
</div>
<script>
		var hours = <?php echo json_encode($hours_array); ?>;
		var id = <?php echo json_encode($canvas_id_array); ?>;
		var maxHours = 40;
		var data = [];
		
		for(var i = 0; i < hours.length; i++){
			var efficiency = hours[i] / 40 * 100;
			var percent = 100 - efficiency;
			var leftover = 100 - percent;
			
			var color = "#FFFFFF";
			var highlight = "#FFFFFF";
			
			if(percent > 70){
				color = "#80ff80";
				highlight = "#99ff99";
			}
			else if(percent > 40){
				color = "#ffe066";
				highlight = "#ffe680";
			}
			else if(percent > 10){
				color = "#ff4d4d";
				highlight = "#ff6666";
			}
		
			var doughnutData = [
					{
						value: leftover,
						color:"#d9d9d9",
						highlight: "#d9d9d9",
						label: "Leftover"
					},
					{
						value: percent,
						color: color,
						highlight: highlight,
						label: "Efficiency"
					}
				];
				
				data[i] = doughnutData;
		}

			window.onload = function(){
				
				for(var i = 0; i < id.length; i++){
					var ctx = document.getElementById(id[i]).getContext("2d");
					window.myDoughnut = new Chart(ctx).Doughnut(data[i], {responsive : true});
				}
			};



</script>