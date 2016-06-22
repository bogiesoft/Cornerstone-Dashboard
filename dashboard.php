<?php
require('header.php');
?>

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

		$result3=mysqli_query($conn,"SELECT * FROM mail_data WHERE processed_by = 'KM'  ");
		$num_rows3 = mysqli_num_rows($result3);

		$result4=mysqli_query($conn,"SELECT * FROM mail_data WHERE processed_by = 'AB'  ");
		$num_rows4 = mysqli_num_rows($result4);

		$result5=mysqli_query($conn,"SELECT * FROM mail_data WHERE processed_by = 'FP'  ");
		$num_rows5 = mysqli_num_rows($result5);

		$result6=mysqli_query($conn,"SELECT * FROM mail_data WHERE processed_by = 'RP'  ");
		$num_rows6 = mysqli_num_rows($result6);

		$result7=mysqli_query($conn,"SELECT * FROM invoice WHERE invoice_number != 0  ");
		$num_rows7 = mysqli_num_rows($result7);


		$conn->close();

		?>
		<h3>Estimates given: <span><?php echo "$num_rows"; ?></span></h3>
		<h4>Job Tickets in Process: <span><?php echo "$num_rows2"; ?></span></h4>
	</div>
	<div class="dashboardtop-box fundraising-stats">
		<div class="dashboardbox-title"><h2>Project Management - Current:</h2></div>
		<h3>Kevin: <span><?php echo "$num_rows3 \n"; ?></span></h3>
		<h4>Michael: <span><?php echo "$num_rows4 \n"; ?></span></h4>
	</div>
	<div class="dashboardtop-box fundraising-stats">
		<div class="dashboardbox-title"><h2>Production - :</h2></div>
		<h3>Jobs in Production: <span><?php echo "$num_rows6 \n"; ?></span></h3>
		<h4>Total Manhours:<span></span></h4>
	</div>
	<div class="dashboardtop-box fundraising-stats">
		<div class="dashboardbox-title"><h2>Customer Service - :</h2></div>
		<h3>Jobs Invoiced: <span><?php echo "$num_rows7 \n"; ?></span></h3>
		<h4>Jobs Closed: <span></span></h4>
	</div>
	<div class="clear"></div>
	</div>
<?php

require ("connection.php");
$result8 = mysqli_query($conn,"SELECT job_id,client_name,project_name,due_date,job_status FROM job_ticket");

// all current jobs
echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Active Jobs<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='job_id' data-index='0'>Job ID</th><th class='maintable-thtwo data-header' data-name='client' data-index='1'>Client Name</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='2'>Project Name</th><th class='maintable-thtwo data-header' data-name='due_date' data-index='3'>Due Date</th><th class='maintable-thtwo data-header' data-name='job_status' data-index='4'>Job Status</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='5'>Records Total</th><th class='maintable-thtwo data-header' data-name='processed_by' data-index='6'>User</th><th class='maintable-thnine'>Actions</th></tr>";


if ($result8->num_rows > 0) {
    // output data of each row
	
    while($row8 = $result8->fetch_assoc()) {
		
		$foo=$row8['job_id'];
		
		$result9 = mysqli_query($conn,"SELECT * FROM mail_data WHERE job_id = $foo");
		$row9 = $result9->fetch_assoc();
		
		echo "<tr><td>".$row8["job_id"]."</td><td>".  $row8["client_name"]."</td><td>". $row8["project_name"]. "</td><td>". $row8["due_date"]. "</td><td>". $row8["job_status"]."</td><td>". $row9["records_total"]."</td><td>". $row9["processed_by"]."</td><th>"."<a href='http://localhost/crst_dashboard/edit_job.php?job_id=$foo'>"."Edit"."</a></th></tr>";
    }
	echo "</tbody></table></td></tr></tbody></table></div>";
} else {
    echo "0 results";
}

//most recent timestamps

$result = mysqli_query($conn,"SELECT * FROM timestamp ORDER BY time DESC LIMIT 5");

$sql_time_query = "SELECT date_trunc('second', now()::timestamp) FROM timestamp ORDER BY time DESC LIMIT 5";
$result_time_query = mysqli_query($conn, $sql_time_query);

echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Recent Activities<span class='allcontacts-subtitle'></span></th><th class='column-editorbtn'>View All</th></tr>";
echo "<tr valign='top'><td colspan='2'><table border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='user' data-index='0'>User</th><th class='maintable-thtwo data-header' data-name='job' data-index='1'>Description</th><th class='maintable-thtwo data-header' data-name='time' data-index='2'>Time</th></tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['user'] . "</td><td>" . $row['job'] ."</td><td>".$row['time']."</td></tr>"; 
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