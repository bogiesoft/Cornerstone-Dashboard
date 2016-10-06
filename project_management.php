<?php
require('header.php');

//project management

$percent_array = array();
$id_array = array();

?>
<style>
#blue_sheet_labels p{
	margin-right: 380px;
}
.input_fields{
	height: 20px;
}
.label_margin_bottom{
	margin-bottom: 5px;
}

.tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 11000;
	position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.hover_info:hover .tooltiptext{
    visibility: visible;
}
</style>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Project Management</h1>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific job">
		</div>
	</div>
	</div>
<div class="clear"></div>
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
			mysqli_query($conn, "UPDATE job_ticket SET processed_by = '$user' WHERE job_id = '$job_id'");
			$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM job_ticket WHERE job_id = '$job_id'");
			$row_processed_by = $result_processed_by->fetch_assoc();
			$processed_by = $row_processed_by['processed_by'];
			$sql100 = "INSERT INTO timestamp (user,time,job, a_p,processed_by,viewed) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by','no')";
			$result100 = $conn->query($sql100) or die('Error querying database 101.');
		}
	}
	$job_count = $job_count + 1;
}

//----------------------------------------------------------
$result = mysqli_query($conn,$sql);
$job_id_array = array();

if ($result->num_rows > 0) {
    // output data of each row
	$job_count = 1;
    while($row = $result->fetch_assoc()) {
		
		$job_id = $row["job_id"];
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
			echo "<div data-role='main' class='ui-content'>";
				echo "<div class='vendor-left' style = 'background: " . $color_priority . "'>";
					$x = $row["job_id"];
					echo "<h3><a href='edit_job.php?job_id=$x'>".$row["job_id"]."</a></h1>";
					echo "<p>Client name: ".$row["client_name"]."</p>";
					echo "<p>Job name: ".$row["project_name"]."</p>";
					echo "<p style = 'margin-bottom: -80px;'><form action = '' method = 'post'><select style = 'width: 95px' name = 'priority" . $job_count . "' onchange = 'this.form.submit()'>";
					echo "<option selected = 'selected' value = '" . $level . "'>" . $value . "<option value = '0'>None</option><option value = '1'>Low</option><option value = '2'>Medium</option><option value = '3'>High</option></select></form>";
					$id = "show" . $job_count;
					$id2 = "button" . $job_count;
					echo "<p style = 'margin-right: 400px'><button id = 'button" . $job_count . "' style = 'width: 30px; height: 50px' onclick = 'showJob(\"" . $id . "\", \"" . $id2 . "\")'>Info</button></p>";
				echo "</div>";
				echo "<div class='vendor-right' style = 'background: " . $color_priority . "'>";
					echo "<p style = 'margin-right: 215px'>Due date: ".$row["due_date"]."</p>";
					echo "<p class = 'hover_info'>Records total: ".$row1["records_total"]."<span style = 'height: 20px; width: 250px' class = 'tooltiptext'>Foreigns: " . $row_blue_sheet['bs_foreigns'] . ", Domestic: " . $row_blue_sheet['bs_domestic'] . "</span></p>";
					$name = $row2["first_name"] . " " . $row2["last_name"];
					echo "<p style = 'margin-right: 190px'>Assigned to: ".$name."</p><br>";
					
					$result_ys_percent = mysqli_query($conn, "SELECT percent FROM project_management WHERE job_id = '$job_id'");
					$row_ys_percent = $result_ys_percent->fetch_assoc();
					$percent = $row_ys_percent["percent"];
					
					$form_id = "assigned_to" . $job_count;
					echo "<form id = 'assigned_to" . $job_count . "' style = 'margin-left: 750px;' action = '' method = 'post'><select onchange = 'checkPercent(" . $percent . ", \"" . $form_id . "\");' name = 'assign_to" . $job_count . "' style = 'width: 120px'><option selected disabled value = 'None'>--Assign To--</option>";
					$processed_by = $name;
					
					$result_users = mysqli_query($conn, "SELECT user FROM users");
					while($row_users = $result_users->fetch_assoc()){
						$user = $row_users['user'];
						$get_name = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user = '$user'");
						$row_name = $get_name->fetch_assoc();
						$name = $row_name['first_name'] . " " . $row_name['last_name'];
						echo "<option value = '" . $user . "'>" . $name . "</option>";
					}
					
					echo "</select></form>";
					echo "
					<a href='yellow_sheet.php?job_id=$job_id'><div id='canvas-holder' style = 'width: 15%; float: right; margin-top:-200px'>
						<canvas id='canvas_pm" . $job_count . "' width='1' height='1'/>
					</div></a>";
					
					array_push($id_array, 'canvas_pm' . $job_count);
					array_push($percent_array, $percent);
					
					
				echo "<div id = 'show" . $job_count . "' style = 'display: none'>";	
				
				$result_mail_info = mysqli_query($conn, "SELECT * FROM job_ticket WHERE job_id = '$job_id'");
				$row_mail_info = $result_mail_info->fetch_assoc();
				
				echo "<div class='vendor-left' style = 'background: " . $color_priority . "; '>";
					echo "<h3 style = 'margin-right: 200px'><p><i>Job Info:</i></p></h3>";
					echo "<p>Class: ".$row_mail_info["mail_class"]."</p>";
					echo "<p>Category: ".$row_mail_info["processing_category"]."</p>";
					echo "<p>BMEU: ".$row_mail_info["bmeu"]."</p>";
					
				echo "</div>";
				echo "<div class='vendor-right' style = 'background: " . $color_priority . "; '>";
					echo "<p style = 'visibility: hidden;'>Here</p>";
					echo "<p>Rate: ".$row_mail_info["rate"]."</p>";
					echo "<p>Permit: ".$row_mail_info["permit"]."</p>";
					echo "<p>Non-Profit: ".$row_mail_info["non_profit_number"]."</p>";
				echo "</div><br>";
				$result_pm = mysqli_query($conn, "SELECT * FROM project_management WHERE job_id = '$job_id'");
				$row_pm = $result_pm->fetch_assoc();
				echo "<div class='vendor-left' style = 'background: " . $color_priority . "; '>";
					echo "<h3 style = 'margin-right: 200px'><p><i>Data Info:</i></p></h3>";
					echo "<p>Source: ".$row_pm["data_source"]."</p>";
					echo "<p>Processed by: ".$processed_by."</p>";
					echo "<p style = 'visibility:hidden'>   </p>";
					
				echo "</div>";
				echo "<div class='vendor-right' style = 'background: " . $color_priority . "; '>";
					echo "<p style = 'visibility: hidden;'>Here</p>";
					echo "<p>Received: ".$row_pm["data_received"]."</p>";
					echo "<p>Date complete: ".$row_pm["data_completed"]."</p>";
					echo "<p>DQR date: ".$row_pm["dqr_sent"]."</p>";
				echo "</div><br>";
				
				require ("connection.php");
				$result_wm = mysqli_query($conn, "SELECT weights_measures FROM job_ticket WHERE job_id = '$job_id'");
				$row_wm = "";
				if(mysqli_num_rows($result_wm) > 0){
					$row_wm = $result_wm->fetch_assoc();
				}
				
				$materials_array = array();
				
				if($row_wm != ""){
					$materials_array = explode(",", $row_wm['weights_measures']);
				}
					echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
					echo "<tbody>";
					echo "<tr valign='top'><th class='allcontacts-title'>Weights and Measures<span class='allcontacts-subtitle'></span></th></tr>";
					echo "<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Vendor</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Material</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Type</th><th class='maintable-thtwo data-header' data-name='based_on' data-index='12'>Based On</th><th class='maintable-thtwo data-header' data-name='height' data-index='9'>Height 'in'</th><th class='maintable-thtwo data-header' data-name='weight' data-index='10'>Weight 'lbs'</th><th class='maintable-thtwo data-header' data-name='size' data-index='11'>Size 'in'</th></tr></thead><tbody>";

					for($i = 0; $i < count($materials_array); $i++){
							$material_id = $materials_array[$i];
							$result_wm = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$material_id'");
							if(mysqli_num_rows($result_wm) > 0){
								$row = $result_wm->fetch_assoc();
								echo "<tr><td><a href = 'edit_wm.php?material_id=$material_id'>". $row["vendor"]. "</a></td><td>". $row["material"]. "</td><td>". $row["type"]. "</td><td>". $row["based_on"]. "</td><td>". $row["height"]. "</td><td>". $row["weight"]. "</td><td>". $row["size"]. "</td></tr>";
							}
					}
						echo "</tbody></table></td></tr></tbody></table></div>";
				 
				$result_blue_sheet = mysqli_query($conn, "SELECT * FROM customer_service WHERE job_id = '$job_id'");
				$row_blue_sheet = $result_blue_sheet->fetch_assoc();
				
				echo "<div id = 'blue_sheet_inputs' class='vendor-left' style = 'background: " . $color_priority . "; width: 40% '>";
					echo "<h3 style = 'margin-right: 200px'><p><i>Blue Sheet</i></p></h3>";
					echo "<form style = 'margin-left: 50px' action = 'update_blue_sheet.php' method = 'post'>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'initialrec_count' value = '" . $row_blue_sheet['initialrec_count'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'bs_domestic' value = '" . $row_blue_sheet['bs_domestic'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'bs_foreigns' value = '" . $row_blue_sheet['bs_foreigns'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'manual' value = '" . $row_blue_sheet['manual'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'uncorrected' value = '" . $row_blue_sheet['uncorrected'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'unverifiable' value = '" . $row_blue_sheet['unverifiable'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'bs_exact' value = '" . $row_blue_sheet['bs_exact'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'loose' value = '" . $row_blue_sheet['loose'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'householded' value = '" . $row_blue_sheet['householded'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'basic' value = '" . $row_blue_sheet['basic'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'ncoa_errors' value = '" . $row_blue_sheet['ncoa_errors'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'bs_ncoa' value = '" . $row_blue_sheet['bs_ncoa'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'final_count' value = '" . $row_blue_sheet['final_count'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'gd_hrs' value = '" . $row_blue_sheet['gd_hrs'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input class = 'input_fields' name = 'data_hrs' value = '" . $row_blue_sheet['data_hrs'] . "'></p>";
					echo "<p style = 'margin-bottom: 5px'><input type = 'date' class = 'input_fields' name = 'completed_date' value = '" . $row_blue_sheet['completed_date'] . "'></p>";
					echo "<input type = 'submit' name = 'submit_form" . $job_count . "' value = 'Save'>";
					echo "</form>";
					
				echo "</div>";
				echo "<div id = 'blue_sheet_labels' class='vendor-right' style = 'background: " . $color_priority . "'>";
					echo "<p style = 'visibility: hidden;'>Here</p>";
					echo "<p class = 'label_margin_bottom'>Starting records</p>";
					echo "<p class = 'label_margin_bottom'>Domestic</p>";
					echo "<p class = 'label_margin_bottom'>Foreigns</p>";
					echo "<p class = 'label_margin_bottom'>Manual</p>";
					echo "<p class = 'label_margin_bottom'>Uncorrected</p>";
					echo "<p class = 'label_margin_bottom'>Unverifiable</p>";
					echo "<p class = 'label_margin_bottom'>Exact</p>";
					echo "<p class = 'label_margin_bottom'>Loose</p>";
					echo "<p class = 'label_margin_bottom'>House Holded</p>";
					echo "<p class = 'label_margin_bottom'>Basic</p>";
					echo "<p class = 'label_margin_bottom'>NCOA errors</p>";
					echo "<p class = 'label_margin_bottom'>NCOA</p>";
					echo "<p class = 'label_margin_bottom'>Final count</p>";
					echo "<p class = 'label_margin_bottom'>Graphic Des. hrs.</p>";
					echo "<p class = 'label_margin_bottom'>Data hrs.</p>";
					echo "<p class = 'label_margin_bottom'>Completed</p>";
					echo "<div class='contacts-title'>
					</div>";
				echo "</div>";
				echo "</div><br>";
				echo "</div>";
				echo "</div>";
				$job_count = $job_count + 1;
				array_push($job_id_array, $job_id);
		}
	}
	
	$_SESSION['blue_sheet_job_ids'] = $job_id_array;
}
?>
</div>
</div>
<script src="PMSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="sorttable.js"></script>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<script>
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
</script>