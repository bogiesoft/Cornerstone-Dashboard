<?php
	require("header.php");
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
h1{ margin: 0; text-transform: uppercase;text-shadow: 0 0 0.5em black;}
h2 { font-weight: 300}
input { border: 1px solid #666; background: #333; color: #fff; padding: 0.5em; box-shadow: none; outline: none !important; margin: 1em  auto; text-align: center;}
</style>
<div class="dashboard-cont" style="padding-top:110px;">
<div class="contacts-title">
	<h1 class="pull-left">Data Summary</h1>
	<a class="pull-right" href="production.php" >Back to Production</a>
	</div><br><br><br><br>
<?php
	require("connection.php");
	
	$job_id = $_GET['job_id'];
	
	$sql = "SELECT tasks FROM production WHERE job_id = '$job_id'";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();  //production
	$job_tasks = $row['tasks'];
	
	$sql = "SELECT * FROM job_ticket WHERE job_id = '$job_id'";
	$result = mysqli_query($conn, $sql);
	$row1 = $result->fetch_assoc(); //mail data
	$records_total = $row1['records_total'];
	
	$sql = "SELECT * FROM job_ticket WHERE job_id = '$job_id'";
	$result = mysqli_query($conn, $sql);
	$row2= $result->fetch_assoc();
	
	echo "<div data-role='main' class='ui-content'>";
			echo "<div class='vendor-left'>";
				$x = $job_id;
				echo "<h3><a href='edit_job.php?job_id=$x'>".$row2["project_name"]."</a></h1>";
				echo "<p>Total Records: ".$row1["records_total"]."</p>";
				echo "<p>Due Date: ".$row2["due_date"]."</p>";
			echo "</div>";
			echo "<div class='vendor-right'>";
			
			$user = $row1['processed_by'];
			$result = mysqli_query($conn, "SELECT * FROM users WHERE user = '$user'");
			$row3 = $result->fetch_assoc();
			$name = $row3['first_name'] . " " . $row3['last_name'];
			
				echo "<p>Processed by: ".$name."</p>";
				echo "<p>Client Name: ".$row2["client_name"]."</p>";
				echo "<p>Job Status: ".$row2["job_status"]."</p>";
	echo "</div><br><br>";
	
	$sql = "SELECT * FROM production_data";
	$result = mysqli_query($conn, $sql);
	
	$match = FALSE;
	$count = 1;
	
	
	while($row2 = $result->fetch_assoc()){
		$production_record = (int)$row2['total_records'];
		$match = FALSE;
		
		$job_tasks_array = explode(",", $job_tasks);
		$production_tasks_array = explode(",", $row2['job']);
		$sameSize = FALSE;
			
		if(sizeOf($production_tasks_array) == sizeOf($job_tasks_array)){
			$sameSize = TRUE;
		}
		sort($job_tasks_array);
		$production_tasks_array2 = $production_tasks_array;
		sort($production_tasks_array2);
			
			
		if($production_tasks_array2 == $job_tasks_array && $sameSize == TRUE){
			echo "<h1>Data</h1>";
			if($count == 1 && count($production_tasks_array2) > 1){
				echo "<h1 style = 'float: right; margin-top: -100px'>Efficiency</h1>";
			}
			else if($count == 1 && count($production_tasks_array2) == 1){
				echo "<h1 style = 'float: right; margin-top: -130px'>Efficiency</h1>";
			}
			$records_per_array = explode(",", $row2['records_per']);
			$time_unit_array = explode(",", $row2['time_unit']);
			$time_number_array = explode(",", $row2['time_number']);
			$people_array = explode(",", $row2['people']);
			$hours = 0;
			$job_count = 1;
			
			for($i = 0; $i < count($time_unit_array); $i++){
				if((int)$records_per_array[$i] != 0 && (int)$time_number_array[$i] != 0){
					if($time_unit_array[$i] == "hr."){
						if(isset($_POST["job" . $job_count])){
							$temp = (int)$_POST["job" . $job_count];
							$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / (int)$temp;
							$hours = $hours + $add_hours;
						}
						else{
							$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / (int)$people_array[$i];
							$hours = $hours + $add_hours;
						}
					}
					else if($time_unit_array[$i] == "min."){
						if(isset($_POST["job" . $job_count])){
							$temp = (int)$_POST["job" . $job_count];
							$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 60 / (int)$temp;
							$hours = $hours + $add_hours;
						}
						else{
							$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 60 / (int)$people_array[$i];
							$hours = $hours + $add_hours;
						}
					}
					else if($time_unit_array[$i] == "sec."){
						if(isset($_POST["job" . $job_count])){
							$temp = (int)$_POST["job" . $job_count];
							$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 3600 / (int)$temp;
							$hours = $hours + $add_hours;
						}
						else{
							$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 3600 / (int)$people_array[$i];
							$hours = $hours + $add_hours;
						}
					}
				}
				
				$job_count = $job_count + 1;
			}
				
			echo "<ul style = 'list-style-type: none;'>";
			$job_count = 1;
			echo "<form action = '' method = 'post'>";
			for($i = 0; $i < count($records_per_array); $i++){
				echo "<li style = 'margin-left: 75px'>" . $production_tasks_array[$i] . ": " . $records_per_array[$i] . " record(s) in " . $time_number_array[$i] . " " . $time_unit_array[$i];
				echo "<select style = 'margin-right: 500px;' name = 'job" . $job_count . "' onchange = 'this.form.submit()'>";
				if(!isset($_POST["job" . $job_count])){
					echo "<option selected = 'selected' value = '" . (int)$people_array[$i] . "'>" . (int)$people_array[$i] . "</option>";
				}
				else{
					$temp = $_POST["job" . $job_count];
					echo "<option selected = 'selected' value = '" . (int)$temp . "'>" . (int)$temp . "</option>";
				}
				$people_count = 1;
				while($people_count < 11){
					echo "<option value = '" . $people_count . "'>" . $people_count . "</option>";
					$people_count = $people_count + 1;
				}
				echo "</select></li>";
				$job_count = $job_count + 1;
			}
			echo "</form>";
			echo "<li style = 'margin-left: 75px'><h2 value = '" . $hours . "'>Total Hours: " . $hours . "</h2></li>";
			$efficiency = "High";
			$color = "#FFFFFF";
			if($hours <= 12){
				$efficiency = "High";
			}
			else if($hours <= 24){
				$efficiency = "Medium";
			}
			else{
				$efficiency = "Low";
			}
			echo "<li style = 'margin-left: 75px'><h2>Efficiency: " . $efficiency . "</h2></li>";
			
			$percent = (int)($hours/40 * 100);
			$efficiency = 100 - $percent;

			if($efficiency > 100){
				$percent = 100;
			}
			if($efficiency < 0){
				$percent = 0;
			}
			echo "
					<li><div id='canvas-holder' style = 'width: 15%; float: right; margin-top:-200px'>
						<canvas id='canvas_prod' width='1' height='1'/>
					</div></li>";
			echo "</ul><br><br><br>";
			$count = $count + 1;
		}
	}
	
	if($count == 1){
		echo "<i>0 results</i>";
	}
?>
</div>
<script>
var percent = <?php echo json_encode($efficiency); ?>;
	if(percent > 100){
		percent = 100;
	}
	else if(percent < 0){
		percent = 0;
	}
	var toDo = 100 - percent;
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
	else{
		color = "#ff4d4d";
		highlight = "#ff6666";
	}
	
	var doughnutData = [
					{
						value: toDo,
						color: "#d9d9d9",
						highlight: "#d9d9d9",
						label: "%Leftover"
					},
					{
						value: percent,
						color: color,
						highlight: highlight,
						label: "%Efficiency"
					}
				];

window.onload = function(){
	var ctx = document.getElementById("canvas_prod").getContext("2d");
	window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
};
</script>