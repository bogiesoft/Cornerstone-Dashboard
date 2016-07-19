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

		$result7=mysqli_query($conn,"SELECT * FROM invoice WHERE invoice_number != 0  ");
		$num_rows7 = mysqli_num_rows($result7);

		$result8=mysqli_query($conn, "SELECT * FROM archive_jobs WHERE status = 'Closed'");
		$num_rows8 = mysqli_num_rows($result8);	
		
		$conn->close();

		?>
		<h3>Estimates given: <span><?php echo "$num_rows"; ?></span></h3>
		<h4>Job Tickets in Process: <span><?php echo "$num_rows2"; ?></span></h4>
	</div>
	<div class="dashboardtop-box fundraising-stats">
		<div class="dashboardbox-title"><h2>Project Management - Current:</h2></div>
		<?php
			require('connection.php');
			$count = 1;
			while($row3 = $result3->fetch_assoc()){
				
				$temp = $row3['user'];
				$result4 = mysqli_query($conn, "SELECT * FROM mail_data WHERE processed_by = '$temp'");
				$num_rows4 = mysqli_num_rows($result4);
				if($count % 2 != 0){
					echo "<h3>" . $row3['first_name'] . ": <span>" . $num_rows4 . "</span></h3>";
				}
				else{
					echo "<h4>" . $row3['first_name'] . ": <span>" . $num_rows4 . "</span></h4>";
				}
				
				$count = $count + 1;
			}
			$conn->close();
		?>
	</div>
	<div class="dashboardtop-box fundraising-stats">
		<div class="dashboardbox-title"><h2>Production - :</h2></div>
		<h3>Jobs in Production: <span><?php echo "$count_prod \n"; ?></span></h3>
		<h4>Total Manhours:<span></span></h4>
	</div>
	<div class="dashboardtop-box fundraising-stats">
		<div class="dashboardbox-title"><h2>Customer Service - :</h2></div>
		<h3>Jobs Invoiced: <span><?php echo "$num_rows7 \n"; ?></span></h3>
		<h4>Jobs Closed: <span><?php echo "$num_rows8 \n"; ?></span></h4>
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
	
</script>