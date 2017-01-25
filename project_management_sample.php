<?php
require('header.php');

//project management

$percent_array = array();
$id_array = array();

?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Project Management</h1>
	<a class="pull-right" href="DQR/index.php">DQR Generator</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="searchbox" name="frmSearch" type="text" placeholder="Search for a specific job">
		</div>
	</div>
	</div>
<div class="clear"></div>
	<div class="project_block">
		<div class="project_block_left">
			<div class="project_row1">
				<h3>Project Name</h3>
				<h3 style="float:right">Client Name</h3>
			</div>
			<div class="project_row2">
				<p>Job ID</p>
				<p style="float:right;">Records Total</p>
				<p style="float:right;">Due Date</p>
			</div>
			<div class="project_row3">
				<select>
					<option select="selected" value="0">Assign to</option>
					<option value="1">2</option>
					<option value="2">3</option>
				</select>
				<select>
					<option select="selected" value="0">Priority</option>
					<option value="1">High</option>
					<option value="2">Medium</option>
					<option value="3">Low</option>
				</select>
				<select>
					<option select="selected" value="0"># of People</option>
					<option value="1">2</option>
					<option value="2">3</option>
				</select>
			</div>
		</div>
		<div class="project_block_right">
			<p>Insert Yellow Sheet Graph Here</p>
		</div>
	</div>
</div>
</div>
<script src="PMSweetAlert.js"></script>

<script type="text/javascript" src="jquery.tablesorter.js"></script>
<script>

$("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#w_m_table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();
        });
    });

$(document).ready(function()
    {
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
        $("#w_m_table").tablesorter();
		pageCreator();
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
</script>