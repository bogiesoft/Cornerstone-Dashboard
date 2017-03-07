<?php
	require("header.php");
	require("connection.php");
?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Production</h1>
	<a class="pull-right" href="production_data.php">Time Tracking</a>
	<a class="pull-right" href="inventory.php" style="margin-right:20px; background-color:#d14700;">Inventory</a>
	<a class="pull-right" href="employee_data.php" style="margin-right:20px; background-color:#0e0926;">Employee Data</a>
	<a class="pull-right" href="production_receipts.php" style="margin-right:20px; background-color:#0e0926;">Receipts</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="searchbox" name="frmSearch" type="text" placeholder="Search by job or priority(use # plus priority)">
		</div>
	</div>
	</div>
<div class="clear"></div>

<?php
//global data arrays

$hours_array = array();
$canvas_id_array = array();
$production_data_job_array = array();
$special_instructions_array = array();
$result_production_data = mysqli_query($conn, "SELECT job FROM production_data");
while($row = $result_production_data->fetch_assoc()){
	array_push($production_data_job_array, $row["job"]);
}

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
	$graph_count = 0;
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
			$x = $row["job_id"];
			echo "<div class='project_block'>";
				echo "<div class= 'priority_bar'>";
					echo "<p style='width:100%; background-color:" . $color_priority . "; text-align:center; color:white;'>$value</p>";
					echo "</div>";
				echo "<div class='project_block_left'>";
					echo "<div class = 'project_row1'>";
					if($row["client_name"] != ""){
						echo "<p>".$row["client_name"]."</p>";
					}
					else{
						echo "<p>Client Needed</p>";
					}
					if($row["project_name"] != ""){
						echo "<p>".$row["project_name"]."</p>";
					}
					else{
						echo "<p>Project Name Needed</p>";
					}
				   echo "</div>";
				echo "<div class='project_row2'>";
					echo "<a href = 'edit_job.php?job_id=$x' style = 'text-decoration: none'><p>" . $x . "</p></a>";
					echo "<p>Records total: ".$row1["records_total"]."</p>";
					echo "<p>Due date: ".$row["due_date"]."</p>";
					
					$result3 = mysqli_query($conn, "SELECT tasks FROM production WHERE job_id = '$job_id'");
					$row3 = $result3->fetch_assoc();
					$job_tasks_array = explode(",", $row3['tasks']);
					
					echo "<p>";
					for($ii = 0; $ii < count($job_tasks_array); $ii++){
									$job = $job_tasks_array[$ii];
									$special = "None";
									if(strpos($job_tasks_array[$ii], "^") !== FALSE){
										$split_job = explode("^", $job_tasks_array[$ii]);
										$job = $split_job[0];
										$special = $split_job[1];
									}
									if($job == "Labeling"){
										echo "<img src = 'images/task_icons/labeling.png' width = '20' height = '20' onmouseover = showTask('tooltiptext1') onmouseout = hideTask('tooltiptext1')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext1'>Labeling</span>";
									}
									if($job == "Letter Printing"){
										echo "<img src = 'images/task_icons/letter_printing.png' width = '20' height = '20' onmouseover = showTask('tooltiptext2') onmouseout = hideTask('tooltiptext2')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext2'>Letter Printing(" . $special . ")</span>";
									}
									if($job == "Tabbing"){
										echo "<img src = 'images/task_icons/tabbing.jpg' width = '20' height = '20' onmouseover = showTask('tooltiptext3') onmouseout = hideTask('tooltiptext3')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext3'>Tabbing(" . $special . ")</span>";
									}
									if($job == "Mail Merge"){
										echo "<img src = 'images/task_icons/mail_merge.png' width = '20' height = '20' onmouseover = showTask('tooltiptext4') onmouseout = hideTask('tooltiptext4')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext4'>Mail Merge(" . $special . ")</span>";
									}
									if($job == "In-House Envelope Printing"){
										echo "<img src = 'images/task_icons/in-house_letter_printing.png' width = '20' height = '20' onmouseover = showTask('tooltiptext5') onmouseout = hideTask('tooltiptext5')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext5'>In-House Envelope Printing</span>";
									}
									if($job == "Folding"){
										echo "<img src = 'images/task_icons/folding.png' width = '20' height = '20' onmouseover = showTask('tooltiptext6') onmouseout = hideTask('tooltiptext6')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext6'>Folding(" . $special . ")</span>";
									}
									if($job == "Inserting"){
										echo "<img src = 'images/task_icons/inserting.png' width = '20' height = '20' onmouseover = showTask('tooltiptext7') onmouseout = hideTask('tooltiptext7')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext7'>Inserting(" . $special . ")</span>";
									}
									if($job == "Sealing"){
										echo "<img src = 'images/task_icons/sealing.png' width = '20' height = '20' onmouseover = showTask('tooltiptext8') onmouseout = hideTask('tooltiptext8')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext8'>Sealing(" . $special . ")</span>";
									}
									if($job == "Collating"){
										echo "<img src = 'images/task_icons/collating.png' width = '20' height = '20' onmouseover = showTask('tooltiptext9') onmouseout = hideTask('tooltiptext9')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext9'>Collating(" . $special . ")</span>";
									}
									if($job == "Print Permit"){
										echo "<img src = 'images/task_icons/print_permit.png' width = '20' height = '20' onmouseover = showTask('tooltiptext10') onmouseout = hideTask('tooltiptext10')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext10'>Print Permit</span>";
									}
									if($job == "Correct Permit"){
										echo "<img src = 'images/task_icons/correct_permit.png' width = '20' height = '20' onmouseover = showTask('tooltiptext11') onmouseout = hideTask('tooltiptext11')>";
										echo "<span style = 'background-color: black; color: #fff; text-align: center; border-radius: 6px; visibility: hidden; z-index: 1; position: absolute' class = 'tooltiptext11'>Correct Permit</span>";
									}
								}
					echo "</p>";
					echo "</div>";
					$hours = 0;
					
					$count_out_table = 0;
					for($i = 0; $i < count($job_tasks_array); $i++){
							$job = $job_tasks_array[$i];
							$special = "None";
							if(strpos($job_tasks_array[$i], "^") !== FALSE){
								$split_job = explode("^", $job_tasks_array[$i]);
								$job = $split_job[0];
								$special = $split_job[1];
							}
							$result_data_job = mysqli_query($conn, "SELECT recs_per_min FROM production_data WHERE job = '$job' AND special = '$special'");
							if($result_data_job->num_rows > 0){
								$row4 = $result_data_job->fetch_assoc();
								$recs_min = $row4['recs_per_min'];
								if((int)$recs_min != 0){
									$add_hours = $records_total / (float)$recs_min / 60;
									$hours = $hours + $add_hours;
								}
								
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
								//$job_count = $job_count + 1;
							}
							else{
								$count_out_table = $count_out_table + 1;
							}
						}
						if($count_out_table == 0){
								array_push($hours_array, $hours);
								array_push($canvas_id_array, "canvas_prod" . $job_count);
								
								$people_id = "people" . $job_count;
								echo "<div class='graph_block'>
									<canvas height = '200' width = '200' id='canvas_prod" . $job_count . "'></canvas>
									<select id = '" . $people_id . "' onchange = 'changePeople($people_id, $graph_count)'>";
									echo "<option select='selected' value='0'># of People</option>";
									echo "<option value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
									<option value='4'>4</option>
									<option value='5'>5</option>
									<option value='6'>6</option>
									<option value='7'>7</option></select>
									<p class = 'hours_display" . $graph_count . "' style = 'float: right'>Hours: " . round($hours, 2) . "</p></div>";
								$count = $count + 1;
								$graph_count = $graph_count + 1;
						}
						else{
							
							echo "<div class='graph_block'>
									<h1>Time Tracking Needed</h1>
									<p class = 'hours_display" . $graph_count . "' style = 'float: right'>Hours: Unavailable</p></div>";
							
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
				$special_instructions = $row['special_instructions'];
				array_push($special_instructions_array, $special_instructions);
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
				echo '<div class="project_row4">';
				echo "<a onclick = displayInstr($job_count) href = '#null' style='width:100%; background-color:#356CAC; text-align:center; color:white;'>SPECIAL INSTRUCTIONS</a></div>";
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<script>
	var previous_people = new Array();
	$(document).ready(function(){
		$("#searchbox").on("keyup input paste cut", function() {
			//searchbox value
			var search_val = $(this).val();
			//compare the searchbox value with each job id
			$("div.project_block").each(function(){
				if($(this).text().toLowerCase().search(search_val)!=-1){
					$(this).show();
				}
				else if(search_val == "#low"){
					if($(this).children("a").text().toLowerCase().search("low") != -1){
						$(this).show();
					}
				}
				else if(search_val == "#medium"){
					if($(this).children("a").text().toLowerCase().search("medium") != -1){
						$(this).show();
					}
				}
				else if(search_val == "#high"){
					if($(this).children("a").text().toLowerCase().search("high") != -1){
						$(this).show();
					}
				}
				else if(search_val == "#none"){
					if($(this).children("a").text().toLowerCase().search("none") != -1){
						$(this).show();
					}
				}
				else{
					//hide div
					$(this).hide();
				}
			});
		});
	});
		var hours = <?php echo json_encode($hours_array); ?>;
		var id = <?php echo json_encode($canvas_id_array); ?>;
		var maxHours = 40;
		var data = [];

		for(var i = 0; i < hours.length; i++){
			var efficiency = (hours[i] / 40 * 100).toFixed(2);
			var percent = 100 - efficiency;
			if(percent < 0){
				percent = 0;
			}
			else if(percent > 100){
				percent = 100;
			}
			var leftover = (100 - percent).toFixed(2);

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

//function for changing people per job
function changePeople(id_people, graph_index){
	var number_people = id_people.options[id_people.selectedIndex].value;
	if(number_people == 0){
		number_people = 1;
	}
	var index = graph_index;
	
	var new_hours = (hours[index] / number_people).toFixed(2);
	$(".hours_display" + graph_index).text("Hours: " + new_hours);
	
	var efficiency = (hours[index] / number_people / 40 * 100).toFixed(2);
	var percent = 100 - efficiency;
			if(percent < 0){
				percent = 0;
			}
			else if(percent > 100){
				percent = 100;
			}
			var leftover = (100 - percent).toFixed(2);

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
				var ctx = document.getElementById(id[index]).getContext("2d");
				window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
				
}
function showTask(id){
	$("." + id).css("visibility", "visible");
}
function hideTask(id){
	$("." + id).css("visibility", "hidden");
}

var special_instructions = <?php echo json_encode($special_instructions_array); ?>;

function displayInstr(index){
	showSaveMessage();
	function showSaveMessage(){
		swal({   title: "Special Instructions",   text: special_instructions[index-1],   type: "info",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
			function(){ saveNotClicked=false; $( ".save-btn" ).click();});  
	};
}

</script>