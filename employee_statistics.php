<?php
	require("header.php");
	require("connection.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
<div class="contacts-title">
<h1 class="pull-left">Production Statistics</h1>
</div>
<div class="dashboard-detail">
<select id = "job" onchange = "generateEmployees()">
<option select = "selected" value = "0">--Choose Job--</option>
<?php
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
while($row = $job_result->fetch_assoc()){
	$job_id = $row["job_id"];
	$project_name = $row["project_name"];
	echo "<option value = '$job_id'>$job_id - $project_name</option>";
}
?>
</select>
<select id = "employee_name" onchange = "generateTasks()">
<option value = "0" select = "selected">--Choose Employee--</option>
</select>

<select id = "task" onchange = "generateGraphOptions()">
<option select = "selected" value = "0">--Choose Task--</option>
</select>
<select id = "graph_options" onchange = "generateGraph()">
<option select = "selected" value = "0">--Choose Graph--</option>
</select>
<div class = 'clear'></div>
	<div style="width:30%">
			<div id = "chart_container">
				<canvas id="canvas" height="450" width="600"></canvas>
			</div>
	</div>
</div>
</div>
<script>

var barChartData = {
		labels : ["N/A"],
		datasets : [
			{
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [0]
			},
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : [0]
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}
function generateEmployees(){
	$("#task").empty();
	$('#task').append($('<option>', {select: "selected", value:0, text:"--Choose Task--"}));
	$("#graph_options").empty();
	$('#graph_options').append($('<option>', {select: "selected", value:0, text:"--Choose Graph--"}));
	var this_id = $("#job").val();
	$.ajax({
    type: "POST",
    url: "create_task_list.php",
    data: 'id_job=' + this_id,
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
        $("#employee_name").empty();
		$('#employee_name').append($('<option>', {select: "selected", value:0, text:"--Choose Employee--"}));
		$('#employee_name').append($('<option>', {value:"123all", text:"All"}));
		for(var i = 0; i < data.length; i++){
			$('#employee_name').append($('<option>', {value:data[i], text:data[i]}));
		}
    }
});
}
function generateTasks(){
	var this_id = $("#employee_name").val();
	var this_job = $("#job").val();
	var info = [this_id, this_job];
	$("#graph_options").empty();
	$('#graph_options').append($('<option>', {select: "selected", value:0, text:"--Choose Graph--"}));
	$.ajax({
    type: "POST",
    url: "create_task_list.php",
    data: {id_name: info},
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
        $("#task").empty();
		$('#task').append($('<option>', {select: "selected", value:0, text:"--Choose Task--"}));
		if(this_id != "123all"){
			$('#task').append($('<option>', {value:"123all", text:"All"}));
		}
		for(var i = 0; i < data.length; i++){
			$('#task').append($('<option>', {value:data[i], text:data[i]}));
		}
    }
});
}
function generateGraphOptions(){
	$("#graph_options").empty();
	$('#graph_options').append($('<option>', {select: "selected", value:0, text:"--Choose Graph--"}));
	$('#graph_options').append($('<option>', {value:"line", text:"Line"}));
	$('#graph_options').append($('<option>', {value:"bar", text:"Bar"}));
}
function generateGraph(){
	var this_task = $("#task").val();
	var this_employee = $("#employee_name").val();
	var this_job = $("#job").val();
	var info = [this_employee, this_task, this_job];
	if(this_task != "123all" && this_employee != "123all"){	
			$.ajax({
			type: "POST",
			url: "create_task_list.php",
			data: {info: info},
			dataType: "json", // Set the data type so jQuery can parse it for you
			success: function (averages) {
				var employee_average = averages[0].toFixed(2) / 40 * 100;
				var data_average = averages[1].toFixed(2) / 40 * 100;
				var employee_percent = 100 - employee_average;
				if(employee_percent < 0){
					employee_percent = 0;
				}
				else if(employee_percent > 100){
					employee_percent = 100;
				}
				var data_percent = 100 - data_average;
				if(data_percent < 0){
					data_percent = 0;
				}
				else if(data_percent > 100){
					data_percent = 100;
				}
				var task = averages[2];
				
				data_percent = data_percent.toFixed(2);
				employee_percent = employee_percent.toFixed(2);
				var graph_option = $("#graph_options").val();
				if(graph_option == "bar"){
					var barChartData = {
						labels : ["Employee Efficiency Vs. Average"],
						datasets : [
							{
								fillColor : "rgba(66, 161, 244, 0.5)",
								strokeColor : "rgba(220,220,220,0.8)",
								highlightFill: "rgba(220,220,220,0.75)",
								highlightStroke: "rgba(220,220,220,1)",
								data : [employee_percent]
							},
							{
								fillColor : "rgba(244, 200, 66, 0.5)",
								strokeColor : "rgba(151,187,205,0.8)",
								highlightFill : "rgba(151,187,205,0.75)",
								highlightStroke : "rgba(151,187,205,1)",
								data : [data_percent]
							}
						]

					}
					$('#chart_container').html('');
					$('#chart_container').html('<canvas id="canvas" height="450" width="600"></canvas>');
					var ctx = document.getElementById("canvas").getContext("2d");
					window.myBar = new Chart(ctx).Bar(barChartData, {
						responsive : true
					});
				}
				else if(graph_option == "line"){
					var lineChartData = {
						labels : ["Employee Efficiency Vs. Average"],
						datasets : [
							{
								label: "My First dataset",
								fillColor : "rgba(66, 161, 244, 0.5)",
								strokeColor : "rgba(66, 161, 244, 0.5)",
								pointColor : "rgba(66, 161, 244, 0.5)",
								pointStrokeColor : "#fff",
								pointHighlightFill : "#fff",
								pointHighlightStroke : "rgba(220,220,220,1)",
								data : [employee_percent]
							},
							{
								label: "My Second dataset",
								fillColor : "rgba(244, 200, 66, 0.5)",
								strokeColor : "rgba(244, 200, 66, 0.5)",
								pointColor : "rgba(244, 200, 66, 0.5)",
								pointStrokeColor : "#fff",
								pointHighlightFill : "#fff",
								pointHighlightStroke : "rgba(151,187,205,1)",
								data : [data_percent]
							}
						]

					}
					$('#chart_container').html('');
					$('#chart_container').html('<canvas id="canvas" height="450" width="600"></canvas>');
					var ctx = document.getElementById("canvas").getContext("2d");
					window.myLine = new Chart(ctx).Line(lineChartData, {
						responsive: true
					});
				}
			}
		});
	}
	else if(this_employee == "123all"){
			$.ajax({
				type: "POST",
				url: "create_task_list.php",
				data: {info_all_employees: info},
				dataType: "json", // Set the data type so jQuery can parse it for you
				success: function (averages) {
					
					var names = averages[2];
					var employee_percents = [];
					var data_percents = [];
					for(var i = 0; i < averages[0].length; i++){
						employee_efficiency = (averages[0][i] / 40 * 100).toFixed(2);
						data_efficiency = (averages[1][i] / 40 * 100).toFixed(2);
						employee_percents[i] = 100 - employee_efficiency;
						data_percents[i] = 100 - data_efficiency;
					}
					var graph_option = $("#graph_options").val();
					if(graph_option == "bar"){
						var barChartData = {
							labels : names,
							datasets : [
								{
									fillColor : "rgba(66, 161, 244, 0.5)",
									strokeColor : "rgba(66, 161, 244, 0.5)",
									highlightFill: "rgba(66, 161, 244, 0.5)",
									highlightStroke: "rgba(220,220,220,1)",
									data : employee_percents
								},
								{
									fillColor : "rgba(244, 200, 66, 0.5)",
									strokeColor : "rgba(244, 200, 66, 0.5)",
									highlightFill : "rgba(244, 200, 66, 0.5)",
									highlightStroke : "rgba(151,187,205,1)",
									data : data_percents
								}
							]

						}
						$('#chart_container').html('');
						$('#chart_container').html('<canvas id="canvas" height="450" width="600"></canvas>');
						var ctx = document.getElementById("canvas").getContext("2d");
						window.myBar = new Chart(ctx).Bar(barChartData, {
							responsive : true
						});
					}
					else if(graph_option == "line"){
						var lineChartData = {
							labels : names,
							datasets : [
								{
									label: "My First dataset",
									fillColor : "rgba(66, 161, 244, 0.5)",
									strokeColor : "rgba(66, 161, 244, 0.5)",
									pointColor : "rgba(66, 161, 244, 0.5)",
									pointStrokeColor : "#fff",
									pointHighlightFill : "#fff",
									pointHighlightStroke : "rgba(220,220,220,1)",
									data : employee_percents
								},
								{
									label: "My Second dataset",
									fillColor : "rgba(244, 200, 66, 0.5)",
									strokeColor : "rgba(244, 200, 66, 0.5)",
									pointColor : "rgba(244, 200, 66, 0.5)",
									pointStrokeColor : "#fff",
									pointHighlightFill : "#fff",
									pointHighlightStroke : "rgba(151,187,205,1)",
									data : data_percents
								}
							]

						}
						$('#chart_container').html('');
						$('#chart_container').html('<canvas id="canvas" height="450" width="600"></canvas>');
						var ctx = document.getElementById("canvas").getContext("2d");
						window.myLine = new Chart(ctx).Line(lineChartData, {
							responsive: true
						});
					}
				}
			});
	}
	else if(this_task == "123all"){
			$.ajax({
				type: "POST",
				url: "create_task_list.php",
				data: {info_all_tasks: info},
				dataType: "json", // Set the data type so jQuery can parse it for you
				success: function (averages) {
					var tasks = averages[2];
					var employee_percents = [];
					var data_percents = [];
					for(var i = 0; i < averages[0].length; i++){
						employee_efficiency = (averages[0][i] / 40 * 100).toFixed(2);
						data_efficiency = (averages[1][i] / 40 * 100).toFixed(2);
						employee_percents[i] = 100 - employee_efficiency;
						data_percents[i] = 100 - data_efficiency;
					}
					var graph_option = $("#graph_options").val();
					if(graph_option == "bar"){
						var barChartData = {
							labels : tasks,
							datasets : [
								{
									fillColor : "rgba(66, 161, 244, 0.5)",
									strokeColor : "rgba(220,220,220,0.8)",
									highlightFill: "rgba(220,220,220,0.75)",
									highlightStroke: "rgba(220,220,220,1)",
									data : employee_percents
								},
								{
									fillColor : "rgba(244, 200, 66, 0.5)",
									strokeColor : "rgba(151,187,205,0.8)",
									highlightFill : "rgba(151,187,205,0.75)",
									highlightStroke : "rgba(151,187,205,1)",
									data : data_percents
								}
							]

						}
						$('#chart_container').html('');
						$('#chart_container').html('<canvas id="canvas" height="450" width="600"></canvas>');
						var ctx = document.getElementById("canvas").getContext("2d");
						window.myBar = new Chart(ctx).Bar(barChartData, {
							responsive : true
						});
					}
					else if(graph_option == "line"){
						var lineChartData = {
							labels : tasks,
							datasets : [
								{
									label: "My First dataset",
									fillColor : "rgba(66, 161, 244, 0.5)",
									strokeColor : "rgba(220,220,220,1)",
									pointColor : "rgba(220,220,220,1)",
									pointStrokeColor : "#fff",
									pointHighlightFill : "#fff",
									pointHighlightStroke : "rgba(220,220,220,1)",
									data : employee_percents
								},
								{
									label: "My Second dataset",
									fillColor : "rgba(244, 200, 66, 0.5)",
									strokeColor : "rgba(151,187,205,1)",
									pointColor : "rgba(151,187,205,1)",
									pointStrokeColor : "#fff",
									pointHighlightFill : "#fff",
									pointHighlightStroke : "rgba(151,187,205,1)",
									data : data_percents
								}
							]

						}
						$('#chart_container').html('');
						$('#chart_container').html('<canvas id="canvas" height="450" width="600"></canvas>');
						var ctx = document.getElementById("canvas").getContext("2d");
						window.myLine = new Chart(ctx).Line(lineChartData, {
							responsive: true
						});
					}
				}
			});
	}
}
</script>