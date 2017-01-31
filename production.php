<?php
	require("header.php");
	require("connection.php");
?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Production</h1>
	<a class="pull-right" href="production_data.php">Time Tracking</a>
	<a class="pull-right" href="inventory.php" style="margin-right:20px; background-color:#d14700;">Inventory</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="searchbox" name="frmSearch" type="text" placeholder="Search for a job">
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
		$sql = $sql . "SELECT * FROM job_ticket WHERE processed_by = '$user'";
	}
	else{
		$sql = $sql . " UNION SELECT * FROM job_ticket WHERE processed_by = '$user'";
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
		$user_name = $_SESSION['user'];
		date_default_timezone_set('America/New_York');
		$today = date("Y-m-d G:i:s");
		$a_p = date("A");
		$job = "updated job ticket " . $job_id;
		$user = $_POST['assign_to' . $job_count];
		mysqli_query($conn, "UPDATE job_ticket SET processed_by = '$user' WHERE job_id = '$job_id'");
		$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM job_ticket WHERE job_id = '$job_id'");
		$row_processed_by = $result_processed_by->fetch_assoc();
		$processed_by = $row_processed_by['processed_by'];
		$sql100 = "INSERT INTO timestamp (user,time,job, a_p,processed_by,viewed) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by','no')";
		$result100 = $conn->query($sql100) or die('Error querying database 101.');
	}
	$job_count = $job_count + 1;
}

//----------------------------------------------------------
$result = mysqli_query($conn,$sql);


if ($result->num_rows > 0) {
    // output data of each row
	$job_count = 1;
	echo "<div class='block_area'>";
    while($row = $result->fetch_assoc()) {

		$job_id = $row["job_id"];
		$result1 = mysqli_query($conn, "SELECT records_total, processed_by FROM job_ticket WHERE job_id = '$job_id'");
		$row1 = $result1->fetch_assoc();
		$records_total = (int)$row1['records_total'];
		$assigned_to = $row1["processed_by"];
		$result2 = mysqli_query($conn, "SELECT department, first_name, last_name FROM users WHERE user = '$assigned_to'");
		$row2 = $result2->fetch_assoc();

		if($row2["department"] == "Production"){

			$result_priority = mysqli_query($conn, "SELECT priority FROM job_ticket WHERE job_id = '$job_id'");
			$prow = $result_priority->fetch_assoc();
			$level = $prow['priority'];

			$color_priority = "#4da6ff";
			$value = "None";

			if($level == 1){
				$color_priority = "#00b33c";
				$value = "Low";
			}
			else if($level == 2){
				$value = "Medium";
				$color_priority = "#e68a00";
			}
			else if($level == 3){
				$color_priority = "#cc2900";
				$value = "High";
			}
			echo "<div class='project_block'>";
				echo "<div class= 'priority_bar'>";
					echo "<p style='width:100%; background-color:" . $color_priority . "; text-align:center; color:white;'>$value</p>";
					echo "</div>";
				echo "<div class='project_block_left'>";
					$x = $row["job_id"];
					echo "<div class = 'project_row1'>";
					echo "<p>".$row["client_name"]."</p>";
					echo "<p>".$row["project_name"]."</p>";
				   echo "</div>";
				echo "<div class='project_row2'>";
					echo "<p><a href = 'edit_job.php?job_id=$x'>" . $x . "</a></p>";
					echo "<p>Records total: ".$row1["records_total"]."</p>";
					echo "<p>Due date: ".$row["due_date"]."</p>";
					echo "</div>";
					$sql = "SELECT * FROM production_data";
					$result4 = mysqli_query($conn, $sql);
					
					$result3 = mysqli_query($conn, "SELECT tasks FROM production WHERE job_id = '$job_id'");
					$row3 = $result3->fetch_assoc();
					//echo "<p>" . $row3["tasks"] . "</p>";
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
								$hours = 0;
								//$job_count = 1;

								for($i = 0; $i < count($time_unit_array); $i++){
									if((int)$records_per_array[$i] != 0 && (int)$time_number_array[$i] != 0){
										if($time_unit_array[$i] == "hr."){

												$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i];
												$hours = $hours + $add_hours;

										}
										else if($time_unit_array[$i] == "min."){

												$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 60;
												$hours = $hours + $add_hours;

										}
										else if($time_unit_array[$i] == "sec."){


												$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 3600;
												$hours = $hours + $add_hours;

										}
									}
								}
								//$job_count = 1;
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
								$people_id = "people" . $job_count;
								echo "<div class='graph_block'>
									<canvas height = '200' width = '200' id='canvas_prod" . $job_count . "'></canvas>
									<select id = '" . $people_id . "' onchange = changePeople('" . $people_id . "')>
									<option select='selected' value='0'># of People</option>
									<option value='1'>1</option>
									<option value='2'>2</option>
								</select></div>";
								$count = $count + 1;
								//$job_count = $job_count + 1;
							}
						}


				echo '<div class="project_row3">';
				echo "<form action = '' method = 'post'>";
				echo "<select onchange = 'this.form.submit()' name = 'assign_to" . $job_count . "'><option selected disabled value = 'None'>--Assign To--</option>";
				$result_users = mysqli_query($conn, "SELECT user FROM users");
				while($row_users = $result_users->fetch_assoc()){
					$user = $row_users['user'];
					$get_name = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user = '$user'");
					$row_name = $get_name->fetch_assoc();
					$name = $row_name['first_name'] . " " . $row_name['last_name'];
					echo "<option value = '" . $user . "'>" . $name . "</option>";
				}
				echo "</select></form>";
				echo "<form action = '' method = 'post'>";
				echo '<select onchange = "this.form.submit()" name = "priority' . $job_count . '">
						<option select="selected" value="0">Priority</option>
						<option value="3">High</option>
						<option value="2">Medium</option>
						<option value="1">Low</option>
						<option value = "0">None</option>
					</select>';
				echo "</form>";
				echo "</div>";
				echo "</div>";
				echo '<div class="project_row4">
					<a href="#" style="width:100%; background-color:#356CAC; text-align:center; color:white;">SPECIAL INSTRUCTIONS</a>
				</div>';
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
<script>
	var previous_people = new Array();
	$(document).ready(function(){
		$("#searchbox").on("keyup input paste cut", function() {
			//searchbox value
			var search_val = $(this).val();
			//compare the searchbox value with each job id
			$("a[id=jobid]").each(function(){
				if($(this).text().search(search_val)!=-1){
					//show div
					$(this).parent().parent().parent().show();
				}
				else{
					//hide div
					$(this).parent().parent().parent().hide();
				}
			});
		});
	});
		var hours = <?php echo json_encode($hours_array); ?>;
		var id = <?php echo json_encode($canvas_id_array); ?>;
		var maxHours = 40;
		var data = [];

		for(var i = 0; i < hours.length; i++){
			var efficiency = hours[i] / 40 * 100;
			var percent = 100 - efficiency;
			if(percent < 0){
				percent = 0;
			}
			else if(percent > 100){
				percent = 100;
			}
			var leftover = 100 - percent;

			var color = "#FFFFFF";
			var highlight = "#FFFFFF";

			if(percent >= 70){
				color = "#80ff80";
				highlight = "#99ff99";
			}
			else if(percent >= 37.5){
				color = "#ffe066";
				highlight = "#ffe680";
			}
			else{
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

function changePeople(id){
	var number_people = $("#" + id).val();
	var last_character = id.substr(id.length-1);
	var index = parseInt(last_character);
	
	var efficiency = hours[index-1] / number_people / 40 * 100;
	var percent = 100 - efficiency;
			if(percent < 0){
				percent = 0;
			}
			else if(percent > 100){
				percent = 100;
			}
			var leftover = 100 - percent;

			var color = "#FFFFFF";
			var highlight = "#FFFFFF";

			if(percent >= 70){
				color = "#80ff80";
				highlight = "#99ff99";
			}
			else if(percent >= 37.5){
				color = "#ffe066";
				highlight = "#ffe680";
			}
			else{
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
				alert(id[0]);
				//var ctx = document.getElementById(id[index-1]).getContext("2d");
				//alert(ctx);
				//window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
}

</script>
