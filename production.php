<?php
require('header.php');
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Production</h1>
	<a class="pull-right" href="#" class="add_button">TimeTracking</a>
	</div>
<div class="dashboard-detail">

	<div class="clear"></div>
<?php
require ("connection.php");
	
$sql = "SELECT * FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id AND mail_data.processed_by = 'RP'"; 
$result = mysqli_query($conn,$sql); 


if ($result->num_rows > 0) {
	
echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Jobs in Production<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Client Name</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='1'>Job Name</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='2'>Total Records</th><th class='maintable-thtwo data-header' data-name='quantity' data-index='3'>Quantity</th><th class='maintable-thtwo data-header' data-name='based_on' data-index='4'>Based On</th><th class='maintable-thtwo data-header' data-name='tasks' data-index='5'>Tasks</th><th class='maintable-thtwo data-header' data-name='special_instructions' data-index='6'>Special Instructions</th><th class='maintable-thnine'>Job ID</th></tr>";

    
	while($row = $result->fetch_assoc()) {
		
		$temp = $row['job_id'];
		$sql1 = "SELECT * FROM mail_data WHERE job_id = '$temp'"; 
		$result1 = mysqli_query($conn,$sql1);
		$row1 = $result1->fetch_assoc();
		$foo = $row['client_name'];
		$sql3 = "SELECT * FROM yellow_sheet WHERE job_id = '$temp'"; 
		$result3 = mysqli_query($conn,$sql3);
		$row3 = $result3->fetch_assoc();
		$sql2 = "SELECT * FROM materials WHERE job_id = '$temp'"; 
		$result2 = mysqli_query($conn,$sql2);
		$row2 = $result2->fetch_assoc();
		$sql4 = "SELECT * FROM mail_info WHERE job_id = '$temp'"; 
		$result4 = mysqli_query($conn,$sql4);
		$row4 = $result4->fetch_assoc();
		$sql5 = "SELECT * FROM production WHERE job_id = '$temp'"; 
		$result5 = mysqli_query($conn,$sql5);
		$row5 = $result5->fetch_assoc();
		

		echo "<tr><td>".  $row["client_name"]."</td><td>".  $row["project_name"]."</td><td>". $row1['records_total']. "</td><td>". $row2['quantity']. "</td><td>". $row2['based_on']. "</td><td>". $row5['tasks']. "</td><td><a href = 'http://localhost/crst_dashboard/special_instructions.php?job_id=$temp' >"."view". "</a></td><td><a href='http://localhost/crst_dashboard/edit_job.php?job_id=$temp'>".$temp."</a></td></tr>";
	}
	
	echo "</tbody></table></td></tr></tbody></table></div>";
	
}
?>
<script src="ddtf.js"></script>
<script>
$('#myTable').ddTableFilter();
</script>