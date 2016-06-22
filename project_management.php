<?php
require('header.php');
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Project Management</h1>
	</div>
<div class="dashboard-detail">
	
<div class="clear"></div>
<?php
require ("connection.php");
	
$sql = "SELECT * FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id AND (mail_data.processed_by = 'KM' OR mail_data.processed_by = 'MB')"; 
$result = mysqli_query($conn,$sql); 

if ($result->num_rows > 0) {
	
echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>All Active Jobs<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='job_id' data-index='0'>Job ID</th><th class='maintable-thtwo data-header' data-name='client_name' data-index='1'>Client Name</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='2'>Job Name</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='3'>Total Records</th><th class='maintable-thtwo data-header' data-name='job_status' data-index='4'>Status</th><th class='maintable-thtwo data-header' data-name='percent' data-index='5'>% Complete</th><th class='maintable-thtwo data-header' data-name='due_date' data-index='6'>Due Date</th><th class='maintable-thtwo data-header' data-name='processed_by' data-index='7'>Processed By</th></tr>";
    
	while($row = $result->fetch_assoc()) {
		
		$temp = $row['job_id'];
		$sql1 = "SELECT * FROM mail_data WHERE job_id = '$temp'"; 
		$result1 = mysqli_query($conn,$sql1);
		$row1 = $result1->fetch_assoc();
		$foo = $row['client_name'];
		$sql3 = "SELECT * FROM yellow_sheet WHERE job_id = '$temp'"; 
		$result3 = mysqli_query($conn,$sql3);
		$row3 = $result3->fetch_assoc();
		

		echo "<tr><td><a href='http://localhost/crst_dashboard/edit_job.php?job_id=$temp'>".$temp."</a></td><td><a href='http://localhost/crst_dashboard/edit_client.php?client_name=$foo'>".$row["client_name"]."</a></td><td>".  $row["project_name"]."</td><td>". $row1['records_total']. "</td><td>". $row['job_status']. "</td><td><a href='http://localhost/crst_dashboard/yellow_sheet.php?job_id=$temp'>". $row3['percent']."</a></td><td>". $row['due_date']. "</td><td>". $row1['processed_by']. "</td></tr>";
	}
	
	echo "</tbody></table></td></tr></tbody></table></div>";
	
}
?>
</div>
</div>
<script src="ddtf.js"></script>
<script>
$('#myTable').ddTableFilter();
</script>