<?php
require('header.php');
require('connection.php');
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Statistics</h1>
	<a class="pull-right" href="sales.php" class="add_button">Back to Sales</a>
	</div>
<div class="dashboard-detail">

<div style="width: 50%;">
			<h4>Estimates Created: <?php echo date("M Y"); ?></h4>
			<canvas id="estimates-area" height="315" width="700"></canvas>
		<?php 
			$array_users = array();
			$array_estimates = array();
			
			$result = mysqli_query($conn, "SELECT * FROM users WHERE department = 'Sales'");
			while($row = $result->fetch_assoc())
			{
				$user = $row['user'];
				$date = date("Y-m");
				$result_estimates_archived = mysqli_query($conn, "SELECT * FROM archive_jobs WHERE estimate_number != 0 AND estimate_date LIKE '%{$date}%' AND estimate_created_by = '$user'");
				$result_estimates_current = mysqli_query($conn, "SELECT * FROM job_ticket WHERE estimate_number != 0 AND estimate_date LIKE '%{$date}%' AND estimate_created_by = '$user'");
				$number = mysqli_num_rows($result_estimates_archived) + mysqli_num_rows($result_estimates_current);
				array_push($array_users, $row['first_name']);
				array_push($array_estimates, $number);
			}
		?>
</div>
<div style="width: 70%; ">
			<h4>Job Tickets Created</h4>
			<canvas id="tickets_created" height="215" width="300"></canvas>
			<?php
			$array_users_1 = array();
			$array_created_1 = array();
			
			$result = mysqli_query($conn, "SELECT * FROM users WHERE department = 'Sales'");
			while($row = $result->fetch_assoc())
			{
				$user = $row['user'];
				$date = date("Y-m");
				$result_created_archived = mysqli_query($conn, "SELECT * FROM archive_jobs WHERE ticket_date LIKE '%{$date}%' AND created_by = '$user'");
				$result_created_current = mysqli_query($conn, "SELECT * FROM job_ticket WHERE ticket_date LIKE '%{$date}%' AND created_by = '$user'");
				$number = mysqli_num_rows($result_created_archived) + mysqli_num_rows($result_created_current);
				array_push($array_users_1, $row['first_name']);
				array_push($array_created_1, $number);
			}
				
			?>
</div>

<script>
var users = <?php echo json_encode($array_users); ?>;
var estimates = <?php echo json_encode($array_estimates); ?>;

	var barChartData = {
		labels : users,
		datasets : [
			{
				fillColor : "rgba(135,231,135,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : estimates
			},
		]

	}

var created = <?php echo json_encode($array_created_1); ?>;
var users = <?php echo json_encode($array_users_1) ?>;
var created_colors = ["#00ffff", "#3399ff", "#66ff66"];
var created_highlights = ["#1affff", "#4da6ff", "#80ff80"];
var pieData = [];

for(var i = 0; i < created.length; i++){
	pieData[i] = {
		value: created[i],
		color: created_colors[i],
		highlight: created_highlights[i],
		label: users[i]
	};
}
	window.onload = function(){
				var ctx = document.getElementById("tickets_created").getContext("2d");
				window.myPie = new Chart(ctx).Pie(pieData);
				var ctx2 = document.getElementById("estimates-area").getContext("2d");
				window.myBar = new Chart(ctx2).Bar(barChartData, {
					responsive : true
				});
			};
</script>