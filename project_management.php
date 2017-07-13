<?php
require('header.php');

//project management

$percent_array = array();
$id_array = array();

?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Project Management</h1>
	<a class="pull-right" href="dqr_index.php">DQR Generator</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="searchbox" name="frmSearch" type="text" placeholder="Search by job or priority(use # plus priority)">
				<select class = "job_selector" style = "float: right; margin-top: 0.5%;" onchange = "jobFilter()">
				<option value = "pmJobs">Project Management Jobs</option>
				<?php
				$result_prod_users = mysqli_query($conn, "SELECT * FROM users WHERE department = 'Project Management'");
				while($row = $result_prod_users->fetch_assoc()){
					echo "<option value = '" . $row["user"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
				}
				?>
				</select>
				<select class = "current_view" style = "float: right; margin-top: 0.5%;" onchange = "changeView()">
				<option value = "block">Block View</option>
				<option value = "list">List View</option>
				</select>
		</div>
	</div>
	</div>
<div class="clear"></div>
<div class = "block_area">
<?php
require ("connection.php");

$result_prod_users = mysqli_query($conn, "SELECT user FROM users WHERE department = 'Project Management'");
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
if($count > 1){
	$job_result =  mysqli_query($conn,$sql) or die("error");
	$job_count = 1;
	while($row = $job_result->fetch_assoc()){
		$job_id = $row['job_id'];
		if(isset($_POST['priority' . $job_count])){
			$priority = $_POST['priority' . $job_count];
			mysqli_query($conn, "UPDATE job_ticket SET priority = '$priority' WHERE job_id = '$job_id'");
		}
		if(isset($_POST['assign_to' . $job_count])){
			$result_percent = mysqli_query($conn, "SELECT percent FROM project_management WHERE job_id = '$job_id'");
			$row_percent = $result_percent->fetch_assoc();
			if($row_percent['percent'] == 100){
				$user_name = $_SESSION['user'];
				date_default_timezone_set('America/New_York');
				$today = date("Y-m-d G:i:s");
				$a_p = date("A");
				$job = "assigned job ticket " . $job_id;
				$user = $_POST['assign_to' . $job_count];
				mysqli_query($conn, "UPDATE job_ticket SET processed_by = '$user' WHERE job_id = '$job_id'") or die("error");
				$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM job_ticket WHERE job_id = '$job_id'");
				$row_processed_by = $result_processed_by->fetch_assoc();
				$processed_by = $row_processed_by['processed_by'];
				$sql100 = "INSERT INTO timestamp (user,time,job, a_p,processed_by,viewed) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by','no')";
				$result100 = $conn->query($sql100) or die('Error querying database 101.');
			}
		}
		$job_count = $job_count + 1;
	}
}

//----------------------------------------------------------


$result = mysqli_query($conn,$sql);
$job_id_array = array();

if ($result->num_rows > 0) {
    // output data of each row
	$job_count = 1;
    while($row = $result->fetch_assoc()) {
		$job_id = $row["job_id"];
		array_push($job_id_array, $job_id);
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
		echo "<div class = 'project_block'>";
		echo "<div class= 'priority_bar'>";
					echo "<p style='width:100%; background-color:" . $color_priority . "; text-align:center; color:white;'>$value</p>";
					echo "</div>";
		$result1 = mysqli_query($conn, "SELECT * FROM job_ticket WHERE job_id = '$job_id'");
		$result_blue_sheet = mysqli_query($conn, "SELECT * FROM customer_service WHERE job_id = '$job_id'");
		$row_blue_sheet = $result_blue_sheet->fetch_assoc();
		$row1 = $result1->fetch_assoc();
		$records_total = (int)$row1['records_total'];
		$assigned_to = $row1["processed_by"];
		$result2 = mysqli_query($conn, "SELECT department, first_name, last_name FROM users WHERE user = '$assigned_to'");
		$row2 = $result2->fetch_assoc();

		if($row2["department"] == "Project Management"){

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
			echo "<div class = 'project_block_left'>";
				echo "<div class = 'project_row1'>";
					if(strlen($row["client_name"]) > 34){
						$row["client_name"] = substr($row["client_name"],0,34);
						$row["client_name"] .= "...";
					}
					$x = $row["job_id"];
					if($row["client_name"] == ""){
						echo "<p style = 'color: #d11010'>Client Name Needed</p>";
					}
					else{
						echo "<p>" . $row["client_name"] ."</p>";
					}
					if(strlen($row["project_name"]) > 34){
						$row["project_name"] = substr($row["project_name"],0,34);
						$row["project_name"] .= "...";
					}
					if($row["project_name"] == ""){
						echo "<p style = 'color: #d11010'>$x - Project Name Needed</p>";
					}
					else{
						echo "<p>$x - " . $row["project_name"] ."</p>";
					}
					echo "</div>";
					
					$id = "show" . $job_count;
					$id2 = "button" . $job_count;
					
				echo "<div class='project_row2'>";
					echo "<p>Records total: ".$row1["records_total"]. "</p>";
					echo "<p>Due date: ".$row["due_date"]."</p>";
				echo "</div>";
					$result_ys_percent = mysqli_query($conn, "SELECT percent FROM project_management WHERE job_id = '$job_id'");
					$row_ys_percent = $result_ys_percent->fetch_assoc();
					$percent = $row_ys_percent["percent"];

					$form_id = "assigned_to" . $job_count;
					

					$result_users = mysqli_query($conn, "SELECT user FROM users");
					

					
					echo "
					<a href = 'yellow_sheet.php?job_id=$x'><div class = 'graph_block'>
						<canvas id='canvas_pm" . $job_count . "' width='100' height='75'>
					</div></a>";

					array_push($id_array, 'canvas_pm' . $job_count);
					array_push($percent_array, $percent);
					
					echo '<div class="project_row3">';
					$current_user = $row["processed_by"];
				    $result_current_assign = mysqli_query($conn, "SELECT * FROM users WHERE user = '$current_user'");
				    $row_current_assign = $result_current_assign->fetch_assoc();
					echo "<form id = 'assign_to" . $job_count . "' action = '' method = 'post'>";
				echo "<select class = 'assign_to' name = 'assign_to" . $job_count . "' onchange = 'checkPercent($percent, \"assign_to" . $job_count . "\")'><option selected disabled value = '" . $row["processed_by"] . "'>" . $row_current_assign["first_name"] . " " . $row_current_assign["last_name"] . "</option>";
				echo '<option select="selected">Assign to</option>';
				
				$result_users = mysqli_query($conn, 'SELECT * FROM users');
				while($row_user = $result_users->fetch_assoc()){
					echo "<option value = '" . $row_user["user"] . "'>" . $row_user["first_name"] . " " . $row_user["last_name"] . "</option>";
				}
				
				echo '</select></form>';
				echo "<form action = '' method = 'post'>";
				echo '<select name = "priority' . $job_count . '" onchange = "this.form.submit()">
					<option select="selected" value="0">Priority</option>
					<option value="3">High</option>
					<option value="2">Medium</option>
					<option value="1">Low</option>
				</select></form>
			</div></div>';
			
			echo "<div class='project_row4'>
					<a href='#null' onclick = 'displayWorksheet(" . $job_count . ")' style='width:80%; background-color:#356CAC; float:left; text-align:center; color:white;'>WORKSHEET</a><a href='edit_job.php?job_id=$x' style='width:20%; background-color:#D14700; float:right; text-align:center; color:white;'>EDIT</a>
				</div></div>";
				
			echo '<div id = "myModal' . $job_count . '" class = "worksheet-background"><div class="worksheet-content">
					<span class="close" onclick = "closeWorksheet(' . $job_count . ')">&times;</span>';
					
					$result_blue_sheet = mysqli_query($conn, "SELECT * FROM customer_service WHERE job_id = '$job_id'");
					$row_blue_sheet = $result_blue_sheet->fetch_assoc();
					
					echo "<h3><i>Blue Sheet</i></h3>";
					echo "<form action = 'update_blue_sheet.php' method = 'post'>";
						echo "<div class = 'worksheet_div'>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Starting records</label>";
								echo "<input class = 'input_fields' name = 'initialrec_count' value = '" . $row_blue_sheet['initialrec_count'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Domestic</label>";
								echo "<input class = 'input_fields' name = 'bs_domestic' value = '" . $row_blue_sheet['bs_domestic'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Foreigns</label>";
								echo "<input class = 'input_fields' name = 'bs_foreigns' value = '" . $row_blue_sheet['bs_foreigns'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Manual</label>";
								echo "<input class = 'input_fields' name = 'manual' value = '" . $row_blue_sheet['manual'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Uncorrected</label>";
								echo "<input class = 'input_fields' name = 'uncorrected' value = '" . $row_blue_sheet['uncorrected'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Unverifiable</label>";
								echo "<input class = 'input_fields' name = 'unverifiable' value = '" . $row_blue_sheet['unverifiable'] . "'>";
							echo "</div>";
						echo "</div>";
						
						echo "<div class = 'worksheet_div'>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Exact</label>";
								echo "<input class = 'input_fields' name = 'bs_exact' value = '" . $row_blue_sheet['bs_exact'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Loose</label>";
								echo "<input class = 'input_fields' name = 'loose' value = '" . $row_blue_sheet['loose'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Householded</label>";
								echo "<input class = 'input_fields' name = 'householded' value = '" . $row_blue_sheet['householded'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>Basic</label>";
								echo "<input class = 'input_fields' name = 'basic' value = '" . $row_blue_sheet['basic'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>NCOA errors</label>";
								echo "<input class = 'input_fields' name = 'ncoa_errors' value = '" . $row_blue_sheet['ncoa_errors'] . "'>";
							echo "</div>";
							echo "<div class = 'worksheet_column'>";
								echo "<label>NCOA</label>";
								echo "<input class = 'input_fields' name = 'ncoa_errors' value = '" . $row_blue_sheet['bs_ncoa'] . "'>";
							echo "</div>";
						echo "</div>";
					
					echo "<div class = 'worksheet_div'>";
						echo "<div class = 'worksheet_column'>";
							echo "<label>Final Count</label>";
							echo "<input class = 'input_fields' name = 'final_count' value = '" . $row_blue_sheet['final_count'] . "'>";
						echo "</div>";
						echo "<div class = 'worksheet_column'>";
							echo "<label>Graphic Design Hours</label>";
							echo "<input class = 'input_fields' name = 'gd_hrs' value = '" . $row_blue_sheet['gd_hrs'] . "'>";
						echo "</div>";
						echo "<div class = 'worksheet_column'>";
							echo "<label>Data Hours</label>";
							echo "<input class = 'input_fields' name = 'data_hrs' value = '" . $row_blue_sheet['data_hrs'] . "'>";
						echo "</div>";
						echo "<div class = 'worksheet_column'>";
							echo "<label>Completed Date</label>";
							echo "<input type = 'date' class = 'input_fields' name = 'completed_date' value = '" . $row_blue_sheet['completed_date'] . "'>";
						echo "</div>";
					echo "</div>";
					echo '<div class="newcontact-tabbtm">
					<input class="save-btn store-btn" type="submit" value="Save" name="submit_form' . $job_count . '" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					</div>';
					echo "</form>";
			echo '</div></div>';
		}
		
		$job_count = $job_count + 1;
	}

	$_SESSION['blue_sheet_job_ids'] = $job_id_array;
}
?>
</div>
</div>
<script src="PMSweetAlert.js"></script>

<script type="text/javascript" src="jquery.tablesorter.js"></script>
<script>

$("#searchbox").on("keyup input paste cut submit", function() {
			//searchbox value
			var search_val = $(this).val();
			//compare the searchbox value with each job id
			if(view == "block"){
				$("div.project_block").each(function(){
					if($(this).text().toLowerCase().search(search_val)!=-1){
						$(this).show();
					}
					else if(search_val == "#low"){
						if($(this).children(".priority_bar").text().toLowerCase().search("low") != -1){
							$(this).show();
						}
					}
					else if(search_val == "#medium"){
						if($(this).children(".priority_bar").text().toLowerCase().search("medium") != -1){
							$(this).show();
						}
					}
					else if(search_val == "#high"){
						if($(this).children(".priority_bar").text().toLowerCase().search("high") != -1){
							$(this).show();
						}
					}
					else if(search_val == "#none"){
						if($(this).children(".priority_bar").text().toLowerCase().search("none") != -1){
							$(this).show();
						}
					}
					else if(search_val.indexOf(":") > -1){
						var username = search_val.split(":");
						if($(this).find(".assign_to option:first-child").val() == username[1]){
							$(this).show();
						}
						else{
							$(this).hide();
						}
					}
					else{
						//hide div
						$(this).hide();
					}
				});
			}
			else{
				var count = 1;
				$("#job_table tr").each(function(){
					if($(this).text().search(search_val)!=-1 || $(this).text().toLowerCase().search(search_val)!=-1){
						$(this).show();
					}
					else{
						//hide div
						if(count != 1){
							$(this).hide();
						}
					}
					count++;
				});
			}
		});

$(document).ready(function()
    {
			$("#searchbox").on("keyup input paste cut submit", function() {
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
        $("#w_m_table").tablesorter();
    }
);
function showJob(div, button){
	if(document.getElementById(button).innerHTML == "Info"){
		document.getElementById(div).style.display = "block";
		document.getElementById(button).innerHTML = "Hide";
	}
	else{
		document.getElementById(div).style.display = "none";
		document.getElementById(button).innerHTML = "Info";
	}
}


var percent = <?php echo json_encode($percent_array); ?>;
var id = <?php echo json_encode($id_array); ?>;
var data = [];

for(var i = 0; i < percent.length; i++){

	var toDo = 100 - percent[i];
	var color = "#FFFFFF";
	var highlight = "#FFFFFF";

	if(percent[i] < 30){
		color = "#ff4d4d";
		highlight = "#ff6666";
	}
	else if(percent[i] < 70){
		color = "#ffe066";
		highlight = "#ffe680";
	}
	else if(percent[i] < 100){
		color = "#80ff80";
		highlight = "#99ff99";
	}
	else{
		color = "#ccffcc";
		highlight = "#e6ffe6";
	}

	var doughnutData = [
					{
						value: toDo,
						color: "#d9d9d9",
						highlight: "#d9d9d9",
						label: "% To do"
					},
					{
						value: percent[i],
						color: color,
						highlight: highlight,
						label: "% Complete"
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

function displayWorksheet(number){
	$('#myModal' + number).show();
}

function closeWorksheet(number){
		$('#myModal' + number).hide();
}
var view = $(".current_view").val();
function changeView(){
	view = $(".current_view").val();
	var job_id = "";
	var project_name = "";
	var client_name = "";
	var due_date = "";
	var job_status = "";
	if(view == "list"){
		$.ajax({
        url: 'production_list_view.php',
        type: 'post',
		data: {id: "pm_jobs"},
		dataType: "json",
        success: function(data){
			$(".block_area").html("<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'><tbody><tr valign='top'><th class='allcontacts-title'>Job Tickets<span class='allcontacts-subtitle'></span></th></tr><tr valign='top'><td colspan='2'><table id = 'job_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Job ID</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Client Name</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Project Name</th><th class='maintable-thtwo data-header' data-name='based_on' data-index='12'>Due Date</th><th class='maintable-thtwo data-header' data-name='height' data-index='9'>Job Status</th></tr></thead><tbody class = 'job_data'></tbody></table></td></tr></tbody></table></div>");
			for(var i = 0; i < data[0].length; i++){
				var job_id = data[0][i];
				var project_name = data[1][i];
				var client_name = data[2][i];
				var due_date = data[3][i];
				var job_status = data[4][i];
				$("#job_table tr:last").after("<tr><td><a href = 'edit_job.php?job_id=" + job_id + "'>"+ job_id + "</a></td><td>"+ client_name + "</td><td>"+ project_name + "</td><td>"+ due_date +  "</td><td>"+ job_status + "</td></tr>");
			}
			$(".job_selector").append($('<option>', {value: 'allJobs', text: "All Jobs"}));
    	}
    });
	}
	else{
		location.reload();
	}
}
function jobFilter(){
	var jobFilterVal = $(".job_selector").val();
	if(jobFilterVal == "pmJobs" && view == "list"){
		$.ajax({
        url: 'production_list_view.php',
        type: 'post',
		data: {id: "pm_jobs"},
		dataType: "json",
        success: function(data){
			$(".block_area").html("<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'><tbody><tr valign='top'><th class='allcontacts-title'>Job Tickets<span class='allcontacts-subtitle'></span></th></tr><tr valign='top'><td colspan='2'><table id = 'job_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Job ID</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Client Name</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Project Name</th><th class='maintable-thtwo data-header' data-name='based_on' data-index='12'>Due Date</th><th class='maintable-thtwo data-header' data-name='height' data-index='9'>Job Status</th></tr></thead><tbody></tbody></table></td></tr></tbody></table></div>");
			for(var i = 0; i < data[0].length; i++){
				var job_id = data[0][i];
				var project_name = data[1][i];
				var client_name = data[2][i];
				var due_date = data[3][i];
				var job_status = data[4][i];
				$("#job_table tr:last").after("<tr><td><a href = 'edit_job.php?job_id=" + job_id + "'>"+ job_id + "</a></td><td>"+ client_name + "</td><td>"+ project_name + "</td><td>"+ due_date +  "</td><td>"+ job_status + "</td></tr>");
			}
    	}
    });
	}
	else if(jobFilterVal == "allJobs" && view == "list"){
		$.ajax({
        url: 'production_list_view.php',
        type: 'post',
		data: {id: "all_jobs"},
		dataType: "json",
        success: function(data){
			$(".block_area").html("<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'><tbody><tr valign='top'><th class='allcontacts-title'>Job Tickets<span class='allcontacts-subtitle'></span></th></tr><tr valign='top'><td colspan='2'><table id = 'job_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Job ID</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Client Name</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Project Name</th><th class='maintable-thtwo data-header' data-name='based_on' data-index='12'>Due Date</th><th class='maintable-thtwo data-header' data-name='height' data-index='9'>Job Status</th></tr></thead><tbody></tbody></table></td></tr></tbody></table></div>");
			for(var i = 0; i < data[0].length; i++){
				var job_id = data[0][i];
				var project_name = data[1][i];
				var client_name = data[2][i];
				var due_date = data[3][i];
				var job_status = data[4][i];
				$("#job_table tr:last").after("<tr><td><a href = 'edit_job.php?job_id=" + job_id + "'>"+ job_id + "</a></td><td>"+ client_name + "</td><td>"+ project_name + "</td><td>"+ due_date +  "</td><td>"+ job_status + "</td></tr>");
			}
    	}
    });
	}
	else if(jobFilterVal != "allJobs" && jobFilterVal != "pmJobs" && view == "list"){
		$.ajax({
        url: 'production_list_view.php',
        type: 'post',
		data: {id: jobFilterVal},
		dataType: "json",
        success: function(data){
			$(".block_area").html("<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'><tbody><tr valign='top'><th class='allcontacts-title'>Job Tickets<span class='allcontacts-subtitle'></span></th></tr><tr valign='top'><td colspan='2'><table id = 'job_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Job ID</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Client Name</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Project Name</th><th class='maintable-thtwo data-header' data-name='based_on' data-index='12'>Due Date</th><th class='maintable-thtwo data-header' data-name='height' data-index='9'>Job Status</th></tr></thead><tbody class = 'job_data'></tbody></table></td></tr></tbody></table></div>");
			for(var i = 0; i < data[0].length; i++){
				var job_id = data[0][i];
				var project_name = data[1][i];
				var client_name = data[2][i];
				var due_date = data[3][i];
				var job_status = data[4][i];
				$("#job_table tr:last").after("<tr class = 'job_data'><td><a href = 'edit_job.php?job_id=" + job_id + "'>"+ job_id + "</a></td><td>"+ client_name + "</td><td>"+ project_name + "</td><td>"+ due_date +  "</td><td>"+ job_status + "</td></tr>");
			}
    	}
    });
	}
	else if(jobFilterVal != "pmJobs" && view == "block"){
		var job_selector = $(".job_selector").val();
		$("#searchbox").val("assign:" + job_selector);
		$("#searchbox").submit();
	}
	else if(jobFilterVal == "pmJobs" && view == "block"){
		$("#searchbox").val("");
		$("#searchbox").submit();
	}
}
</script>
<style>
.worksheet-background {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.worksheet-content {
    background-color: #fefefe;
    margin: auto;
    border: 1px solid #888;
    width: 50%;
    margin: 0 auto;
}
.worksheet_column{
	display: inline-block; 
	margin: 0 0 10px 0
}
</style>