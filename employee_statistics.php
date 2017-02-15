<?php
	require("header.php");
	require("connection.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
<div class="contacts-title">
<h1 class="pull-left">Production Statistics</h1>
</div>
<div class="dashboard-detail">
<select id = "employee_name" onchange = "generateTasks()">
<option select = "selected">--Choose Employee--</option>
<?php
	$result = mysqli_query($conn, "SELECT DISTINCT employee_name FROM employee_data");
	while($row = $result->fetch_assoc()){
		$name = $row["employee_name"];
		echo "<option value = '$name'>$name</option>";
	}
?>
</select>

<select id = "task" onchange = "generateGraph()">
<option select = "selected" value = "0">--Choose Task--</option>
</select>
<div class = 'clear'></div>
	<div style="width:30%">
			<div>
				<canvas id="canvas" height="450" width="600"></canvas>
			</div>
	</div>
</div>
</div>
<script>

function generateTasks(){
	var this_id = $("#employee_name").val();
	$.ajax({
    type: "POST",
    url: "create_task_list.php",
    data: 'id_name=' + this_id,
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
        $("#task").empty();
		$('#task').append($('<option>', {select: "selected", value:0, text:"--Choose Task--"}));
		$('#task').append($('<option>', {value:"all", text:"All"}));
		for(var i = 0; i < data.length; i++){
			$('#task').append($('<option>', {value:data[i], text:data[i]}));
		}
    }
});
}

function generateGraph(){
	var this_task = $("#task").val();
	if(this_task != "all"){	
			var this_id = $("#employee_name").val();
			var info = [this_id, this_task];
			$.ajax({
			type: "POST",
			url: "create_task_list.php",
			data: {info: info},
			dataType: "json", // Set the data type so jQuery can parse it for you
			success: function (data_table) {
				var lineChartData = {
					labels : data_table[0],
					datasets : [
						{
							label: "Employee Data",
							fillColor : "rgba(244, 191, 66, 0.4)",
							strokeColor : "rgba(220,220,220,1)",
							pointColor : "rgba(220,220,220,1)",
							pointStrokeColor : "#d14700",
							pointHighlightFill : "#f4b642",
							pointHighlightStroke : "rgba(220,220,220,1)",
							data : data_table[1]
						},
						{
							label: "Average Data",
							fillColor : "rgba(66, 170, 244, 0.1)",
							strokeColor : "rgba(151,187,205,1)",
							pointColor : "rgba(151,187,205,1)",
							pointStrokeColor : "#fff",
							pointHighlightFill : "#fff",
							pointHighlightStroke : "rgba(151,187,205,1)",
							data : data_table[2]
						}
					]

				}

				//$("#canvas").beginPath();
				var ctx = document.getElementById("canvas").getContext("2d");
				ctx.clearRect(0,0,600,450);
				window.myLine = new Chart(ctx).Line(lineChartData, {
					responsive: false
				});
			}
		});
	}
}
</script>