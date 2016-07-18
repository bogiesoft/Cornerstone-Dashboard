<?php
	require("header.php");
	require("connection.php");
?>
<style>
	#svg circle {
  transition: stroke-dashoffset 1s linear;
  stroke: #666;
  stroke-width: 1em;
}
#svg #bar {
  stroke: #FF9F1E;
}
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

$compare = $_POST['frmSearch'];
$result = mysqli_query($conn,"SELECT job_id, client_name, project_name, due_date FROM job_ticket WHERE job_id LIKE '%{$compare}%' OR project_name LIKE '%{$compare}%' OR due_date LIKE '%{$compare}%' OR client_name LIKE '%{$compare}%'");


if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
		
		$job_id = $row["job_id"];
		$result1 = mysqli_query($conn, "SELECT records_total, processed_by FROM mail_data WHERE job_id = '$job_id'");
		$row1 = $result1->fetch_assoc();
		$records_total = (int)$row1['records_total'];
		$assigned_to = $row1["processed_by"];
		$result2 = mysqli_query($conn, "SELECT department, first_name, last_name FROM users WHERE user = '$assigned_to'");
		$row2 = $result2->fetch_assoc();
		$job_count = 1;
		
		if($row2["department"] == "Production"){
			echo "<div data-role='main' class='ui-content'>";
				echo "<div class='vendor-left'>";
					$x = $row["job_id"];
					echo "<h3><a href='edit_job.php?job_id=$x'>".$row["job_id"]."</a></h1>";
					echo "<p>Client name: ".$row["client_name"]."</p>";
					echo "<p>Project name: ".$row["project_name"]."</p>";
				echo "</div>";
				echo "<div class='vendor-right'>";
					echo "<p>Due date: ".$row["due_date"]."</p>";
					echo "<p>Records total: ".$row1["records_total"]."</p>";
					$name = $row2["first_name"] . " " . $row2["last_name"];
					echo "<p>Assigned to: ".$name."</p>";
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
									echo "<li style = 'margin-left: 75px'>" . $production_tasks_array[$i] . ": " . $records_per_array[$i] . " record(s) in " . $time_number_array[$i] . " " . $time_unit_array[$i] . " with " . $people_array[$i] . " person/people";
									//$job_count = $job_count + 1;
								}
								echo "</form>";
								echo "<li style = 'margin-left: 75px'><h2 value = '" . $hours . "'>Total Hours: " . $hours . "</h2></li>";
								echo "<li style = 'margin-left: 75px;'><a href = 'job_data.php?job_id=$job_id'>add people</a></li>";
								$efficiency = "High";
								$color = "#FFFFFF";
								if($hours < 50){
									$efficiency = "High";
									$color = "#349F1E";
								}
								else if($hours < 150){
									$efficiency = "Medium";
									$color = "#FF9F1E";
								}
								else{
									$efficiency = "Low";
									$color = "#FF4000";
								}
								echo "<li style = 'margin-left: 750px; margin-top: -100px;'><h2 style = 'margin-bottom: 135px;'>Efficiency: " . $efficiency . "</h2></li>";
								
								$hours2 = $hours + 50;
									
								$percent = (int)(100 - (($hours2 / 568.48) * 100));
								if($percent > 100){
									$percent = 100;
									$hours2 = 0;
								}
								if($percent < 0){
									$percent = 0;
									$hours2 = 568.48;
								}
								if($hours < 1){
									$percent = 100;
									$hours2 = 0;
								}
									
								echo "<li style = 'margin-left: 500px; margin-top: -125px;'><div id='cont' data-pct='" . $percent . "'>
								<svg id='svg' width='200' height='200' viewPort='0 0 100 100' version='1.1' xmlns='http://www.w3.org/2000/svg'>
								<circle r='90' cx='100' cy='100' fill='transparent' stroke-dasharray='565.48' stroke-dashoffset='0'></circle>
								<circle style = 'stroke: " . $color . "' id='bar' r='90' cx='100' cy='100' fill='transparent' stroke-dasharray='565.48' stroke-dashoffset='" . $hours2 . "'></circle>
								</svg>
								</div></li>";
								echo "</ul>";
								$count = $count + 1;
							}
						}
	
						if($count == 1){
							echo "<i>0 results</i>";
						}
				echo "</div>";
		}
		
		$job_count = $job_count + 1;
    }
} else {
    echo "0 results";
}

$conn->close();

?>

</div>
</div>