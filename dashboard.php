<?php
require('header.php');
require('connection.php');
?>
<div id="popup" onclick="hide('popup')">
<p id="demo"></p>
<?php
//session_start();

$user = $_SESSION['user'];
$initial = $_SESSION['initial'];
$sql_name = "SELECT * FROM users WHERE user = '$user'";

$result = mysqli_query($conn, $sql_name);

$row = $result->fetch_assoc();

echo "<h1>Welcome ".$row['first_name'] ."!</h1><br>";

//project management pie data

$number_jobs_pm = array();
$names_pm = array();

//customer service closed jobs data

$jobs_closed_monthly = array();
$jobs_invoiced_monthly = array();

//production manhours data

$hours = 0;
$free_hours = 0;

//sales date

$monthly_estimates = array();
$clients_added_monthly = array();

//echo CURDATE();
//Retrieves Jobs for User and Reminders
$sqlJobs = "SELECT project_name FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id WHERE mail_data.processed_by = '$user'";
$resultJobs = mysqli_query($conn, $sqlJobs);
$num_rows_Jobs = mysqli_num_rows($resultJobs);

echo "<h3 style = 'color: #ffffff'>Jobs Due: " . $num_rows_Jobs . "</h3>";

$sql="SELECT text FROM reminder WHERE user='$user' and date = CURDATE()  ";
$result=mysqli_query($conn,$sql);



echo "<br><br><h4 style = 'color: #ffffff';>Reminders</h4>";

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
        echo  $row["text"]. "<br>";
    } 
} 
$conn->close();

//exit();
?>
</div>
<div class="dashboard-cont" style="padding-top: 110px;">
	<h1>Dashboard</h1>
	<div class="dashboard-detail">
	<div class="dashboard-top">
	<div class="dashboardtop-box contact-stats">
		<div class="dashboardbox-title"><h2>Sales - :</h2></div>
		<?php
		require ("connection.php");
		
		$result1=mysqli_query($conn,"SELECT * FROM job_ticket WHERE estimate_number != 0  ");
		$num_rows = mysqli_num_rows($result1);

		$result2=mysqli_query($conn,"SELECT * FROM mail_data WHERE processed_by = ''  ");
		$num_rows2 = mysqli_num_rows($result2);

		$result3=mysqli_query($conn, "SELECT * FROM users WHERE department = 'Project Management'");
		
		$result5=mysqli_query($conn, "SELECT * FROM users WHERE department = 'Production'");
		
		$count_prod = 0;
		while($row5 = $result5->fetch_assoc()){
			$temp = $row5['user'];
			$result6 = mysqli_query($conn,"SELECT * FROM mail_data WHERE processed_by = '$temp'");
			$num_rows6 = mysqli_num_rows($result6);
			$count_prod = $count_prod + $num_rows6;
		}

		$result7=mysqli_query($conn,"SELECT * FROM invoice WHERE invoice_number != 0");
		$num_rows7 = mysqli_num_rows($result7);

		//$result8=mysqli_query($conn, "SELECT * FROM archive_jobs WHERE status = 'Closed'");
		//$num_rows8 = mysqli_num_rows($result8);	
		

		?>
		<div style = 'float: right'>
			<ul>
				<li style = 'font-size: 11px'>Estimates = Blue</li>
				<li style = 'font-size: 11px'>New Clients = Purple</li>
			</ul>
		</div>
		<?php
			$currentMonth = date("m");
			$currentYear = date("Y");
			$count = 0;
			while($count < 5){
				$date = $currentYear . "-" . $currentMonth;
				$result1=mysqli_query($conn,"SELECT * FROM archive_jobs WHERE estimate_number != 0 AND archive_date LIKE '%{$date}%'") or die("error");
				$result2=mysqli_query($conn, "SELECT * FROM client_info WHERE date_added LIKE '%{$date}%'");
				$estimates = mysqli_num_rows($result1);
				$clients_added = mysqli_num_rows($result2);
				array_push($monthly_estimates, $estimates);
				array_push($clients_added_monthly, $clients_added);
				$count = $count + 1;
				
				if($currentMonth == 0){
					$currentMonth = 12;
					$currentYear = $currentYear - 1;
				}
				if($currentMonth < 10){
					$currentMonth = 0 . $currentMonth;
				}
			}
		?>
		
		<div style="width: 70%; ">
			<canvas id="canvas_sales" height="315" width="700"></canvas>
		</div>
		
		<!--<h3>Estimates given: <span><?php echo "$num_rows"; ?></span></h3>!-->
		<!--<h4>Job Tickets in Process: <span><?php echo "$num_rows2"; ?></span></h4> !-->
	</div>
	<div id = "project_management_box" class="dashboardtop-box fundraising-stats">
		<div class="dashboardbox-title"><h2>Project Management - Current:</h2></div>
		<?php
			require('connection.php');
			while($row3 = $result3->fetch_assoc()){
				
				$temp = $row3['user'];
				$result4 = mysqli_query($conn, "SELECT * FROM mail_data WHERE processed_by = '$temp'");
				$num_rows4 = mysqli_num_rows($result4);
				$result_name = mysqli_query($conn, "SELECT first_name FROM users WHERE user = '$temp'");
				$row_name = $result_name->fetch_assoc();
				$name = $row_name['first_name'];
				if($num_rows4 > 0){
					array_push($number_jobs_pm, $num_rows4);
					array_push($names_pm, $name);
				}
			}
		?>
		<div class = "pm_labels" style = "float: right">
		</div>
		<div id="canvas-holder" style = "width: 50%; margin: 0 auto;">
			<canvas id="chart-area" width="150" height="150"/>
		</div>
	</div>
	<div class="dashboardtop-box fundraising-stats">
		<div class="dashboardbox-title"><h2>Production - :</h2></div>
		<h5>Jobs in Production: <span><?php echo "$count_prod \n"; ?></span></h5><br>
		<h5>Total Manhours:<span id = "manhours"></span></h5>
		
		<?php
			
			$result_prod_users = mysqli_query($conn, "SELECT * FROM users WHERE department = 'Production'");
			$sql_prod_jobs = "";
			$count = 1;
			while($row_prod_users = $result_prod_users->fetch_assoc()){ //get all jobs in production
				$temp = $row_prod_users['user'];
				if($count == 1){
					$sql_prod_jobs = $sql_prod_jobs . "SELECT * FROM mail_data WHERE processed_by = '$temp'";
				}
				else{
					$sql_prod_jobs = $sql_prod_jobs . "UNION SELECT * FROM mail_data WHERE processed_by = '$temp'";
				}
				
				$count = $count + 1;
			}
			
			$records_total_array = array();
			$result_mail_data_prod = mysqli_query($conn, $sql_prod_jobs) or die("error 1");
			
			while($row_mail_data_prod = $result_mail_data_prod->fetch_assoc()){ //all records total found
				array_push($records_total_array, $row_mail_data_prod['records_total']);
			}
			
			$result_mail_data_prod = mysqli_query($conn, $sql_prod_jobs) or die("error 2");
			$sql_prod_tasks = "";
			$count = 1;
			while($row_mail_data_prod = $result_mail_data_prod->fetch_assoc()){ //get all jobs in production
				$temp = $row_mail_data_prod['job_id'];
				if($count == 1){
					$sql_prod_tasks = $sql_prod_tasks . "SELECT * FROM production WHERE job_id = '$temp'";
				}
				else{
					$sql_prod_tasks = $sql_prod_tasks . "UNION SELECT * FROM production WHERE job_id = '$temp'";
				}
				
				$count = $count + 1;
			}
			
			$result_tasks = mysqli_query($conn, $sql_prod_tasks) or die("error 3");
			$index = 0;
			
			//calculate hours
			
			while($row_tasks = $result_tasks->fetch_assoc()){
				$records_total = $records_total_array[$index];
				$result_data_tasks = mysqli_query($conn, "SELECT * FROM production_data");
				while($data_tasks = $result_data_tasks->fetch_assoc()){
					$job_task_array = explode(",", $row_tasks['tasks']);
					$data_task_array = explode(",", $data_tasks['job']);
					$data_array = $data_task_array;
					sort($job_task_array);
					sort($data_task_array);
					if($job_task_array == $data_task_array){
						$records_per_array = explode(",", $data_tasks['records_per']);
						$time_unit_array = explode(",", $data_tasks['time_unit']);
						$time_number_array = explode(",", $data_tasks['time_number']);
						$people_array = explode(",", $data_tasks['people']);

						for($i = 0; $i < count($time_unit_array); $i++){
							if((int)$records_per_array[$i] != 0 && (int)$time_number_array[$i] != 0){
								if($time_unit_array[$i] == "hr."){
									$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / (int)$people_array[$i];
									$hours = $hours + $add_hours;
											
								}
								else if($time_unit_array[$i] == "min."){
											
									$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 60 / (int)$people_array[$i];
									$hours = $hours + $add_hours;
											
								}
								else if($time_unit_array[$i] == "sec."){
											
											
									$add_hours = $records_total / (int)$records_per_array[$i] * (int)$time_number_array[$i] / 3600 / (int)$people_array[$i];
									$hours = $hours + $add_hours;
											
								}
							}
						}
					}
				}
				
				$index = $index + 1;
			}
			
			$hours = (int)$hours;
			
		?>
		
		<div id="canvas-holder" style = "width: 40%; margin-left: 185px; margin-top: -115px">
			<canvas id="canvas_prod" width="500" height="500"/>
		</div>
	</div>
	<div class="dashboardtop-box fundraising-stats">
		<div class="dashboardbox-title"><h2>Jobs Closed vs Jobs Invoiced</h2></div>
		<div style = 'float: right'>
			<ul>
				<li>Closed = Green</li>
				<li>Invoiced = Red</li>
			</ul>
		</div>
		<?php
			$currentMonth = date("m");
			$currentYear = date("Y");
			$count = 0;
			while($count < 5){
				$date = $currentYear . "-" . $currentMonth;
				$result_closed_jobs = mysqli_query($conn, "SELECT * FROM archive_jobs WHERE status = 'Closed' AND archive_date LIKE '%{$date}%'");
				$result_invoiced_jobs = mysqli_query($conn, "SELECT * FROM archive_jobs WHERE invoice_number != 0 AND archive_date LIKE '%{$date}%'");
				$count = $count + 1;
				$currentMonth = $currentMonth - 1;
				$jobs_closed = mysqli_num_rows($result_closed_jobs);
				$jobs_invoiced = mysqli_num_rows($result_invoiced_jobs);
				array_push($jobs_closed_monthly, $jobs_closed);
				array_push($jobs_invoiced_monthly, $jobs_invoiced);
				
				if($currentMonth == 0){
					$currentMonth = 12;
					$currentYear = $currentYear - 1;
				}
				if($currentMonth < 10){
					$currentMonth = 0 . $currentMonth;
				}
			}
		?>
		<div style="width: 70%; ">
			<canvas id="canvas_cs" height="315" width="700"></canvas>
		</div>
	</div>
	<div class="clear"></div>
	</div>
<?php

require ("connection.php");
$result9 = mysqli_query($conn,"SELECT * FROM mail_data WHERE processed_by != ''");

// all current jobs
echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Active Jobs<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='job_id' data-index='0'>Job ID</th><th class='maintable-thtwo data-header' data-name='client' data-index='1'>Client Name</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='2'>Project Name</th><th class='maintable-thtwo data-header' data-name='due_date' data-index='3'>Due Date</th><th class='maintable-thtwo data-header' data-name='job_status' data-index='4'>Job Status</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='5'>Records Total</th><th class='maintable-thtwo data-header' data-name='processed_by' data-index='6'>User</th></tr>";


if ($result9->num_rows > 0) {
    // output data of each row
	
    while($row9 = $result9->fetch_assoc()) {
		
		$foo=$row9['job_id'];
		
		$result8 = mysqli_query($conn,"SELECT job_id,client_name,project_name,due_date,job_status FROM job_ticket WHERE job_id = '$foo'");
		$row8 = $result8->fetch_assoc();
		$user_name = $row9['processed_by'];
		
		$sql = "SELECT first_name, last_name FROM users WHERE user = '$user_name'";
		$result10 = mysqli_query($conn, $sql) or die("error");
		
		$name = "";
		
		if($result10->num_rows > 0){
			$row10 = $result10->fetch_assoc();
			$name = $row10['first_name'] . ' ' . $row10['last_name'];
		}
		
		echo "<tr><td><a href='edit_job.php?job_id=$foo'>".$row8["job_id"]."</a></td><td>".  $row8["client_name"]."</td><td>". $row8["project_name"]. "</td><td>". $row8["due_date"]. "</td><td>". $row8["job_status"]."</td><td>". $row9["records_total"]."</td><td>". $name."</td></tr>";
    }
	echo "</tbody></table></td></tr></tbody></table></div>";
} else {
    echo "0 results";
}

//most recent timestamps

$result = mysqli_query($conn,"SELECT * FROM timestamp ORDER BY time DESC LIMIT 5");

$sql_time_query = "SELECT date_trunc('second', now()::timestamp) FROM timestamp ORDER BY time DESC LIMIT 5";
$result_time_query = mysqli_query($conn, $sql_time_query);

echo " <div class='allcontacts-table'><table style = 'width: 850px' border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Recent Activities<span class='allcontacts-subtitle'></span></th><th class='column-editorbtn'><a href = 'view_timestamps.php'>View All</a></th></tr>";
echo "<tr valign='top'><td colspan='2'><table border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list' style = 'width: 850px'><tbody><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='user' data-index='0'>User</th><th class='maintable-thtwo data-header' data-name='job' data-index='1'>Description</th><th class='maintable-thtwo data-header' data-name='time' data-index='2'>Time</th></tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$time = strtotime($row['time']);
		$myFormatForView = date("M d, Y g:i", $time);
        echo "<tr><td>" . $row['user'] . "</td><td>" . $row['job'] ."</td><td>".$myFormatForView. " ". $row['a_p']. "</td></tr>"; 
    }
	echo "</tbody></table></td></tr></tbody></table></div>";
} else {
    echo "0 results from jobticket";
}
echo "</table>"; //Close the table in HTML
$conn->close();

?>

	</div>
	</div>
</div>
<script src="jquery.js"></script>
<script>
var d = new Date();
document.getElementById("demo").innerHTML = "Today's date: "+ d;
function hide(target) {
    document.getElementById(target).style.display = 'none';
}


var firstTime = localStorage.getItem("first_time");

$(document).ready(function(e)
{		
	if (!sessionStorage.alreadyClicked) {
		$('#popup').animate({"top":"50%","marginTop":"-200px"},1000);
		sessionStorage.alreadyClicked = 1;
}
});

var date = new Date();
var currentMonth = date.getMonth();
var monthLabels = [];
var count = 0;

while(count < 5){
	if(currentMonth == -1){
		currentMonth = 11;
	}
	if(currentMonth == 0){
		monthLabels[count] = "Jan";
	}
	if(currentMonth == 1){
		monthLabels[count] = "Feb";
	}
	if(currentMonth == 2){
		monthLabels[count] = "Mar";
	}
	if(currentMonth == 3){
		monthLabels[count] = "Apr";
	}
	if(currentMonth == 4){
		monthLabels[count] = "May";
	}
	if(currentMonth == 5){
		monthLabels[count] = "Jun";
	}
	if(currentMonth == 6){
		monthLabels[count] = "Jul";
	}
	if(currentMonth == 7){
		monthLabels[count] = "Aug";
	}
	if(currentMonth == 8){
		monthLabels[count] = "Sep";
	}
	if(currentMonth == 9){
		monthLabels[count] = "Oct";
	}
	if(currentMonth == 10){
		monthLabels[count] = "Nov";
	}
	if(currentMonth == 11){
		monthLabels[count] = "Dec";
	}
	
	count++;
	currentMonth = currentMonth - 1;
}

var estimates_monthly = <?php echo json_encode($monthly_estimates); ?>;
var clients_added_monthly = <?php echo json_encode($clients_added_monthly); ?>;

	var barChartData_sales = {
		labels : [monthLabels[4],monthLabels[3],monthLabels[2],monthLabels[1],monthLabels[0]],
		datasets : [
			{
				fillColor : "rgba(110,155,200,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [estimates_monthly[4],estimates_monthly[3],estimates_monthly[2],estimates_monthly[1],estimates_monthly[0]]
			},
			{
				fillColor : "rgba(205,163,209,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [clients_added_monthly[4],clients_added_monthly[3],clients_added_monthly[2],clients_added_monthly[1],clients_added_monthly[0]]
			}
		]

	}

var jobs_pm = <?php echo json_encode($number_jobs_pm); ?>;
var names_pm = <?php echo json_encode($names_pm) ?>;
var jobs_pm_colors = ["#ff4d4d", "#3399ff", "#66ff66"];
var jobs_pm_highlights = ["#ff6666", "#4da6ff", "#80ff80"];
var pieData = [];

for(var i = 0; i < jobs_pm.length; i++){
	pieData[i] = {
		value: jobs_pm[i],
		color: jobs_pm_colors[i],
		highlight: jobs_pm_highlights[i],
		label: names_pm[i]
	};
}
$(".pm_labels").append("<ul>");
for(var i = 0; i < jobs_pm.length; i++){
	$(".pm_labels").append("<li style = 'color: " + jobs_pm_colors[i] + "'>" + names_pm[i] + "</li>");
}
$(".pm_labels").append("</ul>");


var jobs_closed_monthly = <?php echo json_encode($jobs_closed_monthly); ?>;
var jobs_invoiced_monthly = <?php echo json_encode($jobs_invoiced_monthly); ?>;

	var barChartData = {
		labels : [monthLabels[4],monthLabels[3],monthLabels[2],monthLabels[1],monthLabels[0]],
		datasets : [
			{
				fillColor : "rgba(135,231,135,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [jobs_closed_monthly[4],jobs_closed_monthly[3],jobs_closed_monthly[2],jobs_closed_monthly[1],jobs_closed_monthly[0]]
			},
			{
				fillColor : "rgba(226,79,79,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [jobs_invoiced_monthly[4],jobs_invoiced_monthly[3],jobs_invoiced_monthly[2],jobs_invoiced_monthly[1],jobs_invoiced_monthly[0]]
			}
		]

	}
	
	
	var hours = <?php echo json_encode($hours); ?>;
	if(hours > 40){
		document.getElementById("manhours").innerHTML = " 40+";
	}
	else{
		document.getElementById("manhours").innerHTML = " " + hours;
	}
	var free_hours = 40 - hours;
	var manhours_color = "#ffffff";
	var manhours_highlight = "#ffffff";
	
	if(hours <= 15){
		manhours_color = "#80ff80";
		manhours_highlight = "#99ff99";
	}
	else if(hours <= 30){
		manhours_color = "#ffe066";
		manhours_highlight = "#ffe680";
	}
	else if(hours <= 40){
		manhours_color = "#ff4d4d";
		manhours_highlight = "#ff6666";
	}
	else{
		manhours_color = "#cc3300";
		manhours_highlight = "#e63900";
		free_hours = 0;
	}
	
	var doughnutData = [
				{
					value: free_hours,
					color:"#d9d9d9",
					highlight: "#d9d9d9",
					label: "Free Hours"
				},
				{
					value: hours,
					color: manhours_color,
					highlight: manhours_highlight,
					label: "Manhours"
				}

			];

			window.onload = function(){
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myPie = new Chart(ctx).Pie(pieData);
				var ctx2 = document.getElementById("canvas_cs").getContext("2d");
				window.myBar = new Chart(ctx2).Bar(barChartData, {
					responsive : true
				});
				var ctx3 = document.getElementById("canvas_prod").getContext("2d");
				window.myDoughnut = new Chart(ctx3).Doughnut(doughnutData, {responsive : true});
				var ctx4 = document.getElementById("canvas_sales").getContext("2d");
				window.myBar = new Chart(ctx4).Bar(barChartData_sales, {
					responsive : true
				});
			};

</script>