<?php
require('header.php');
require ("connection.php");
	
$sql = "SELECT * FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id AND (mail_data.processed_by = 'KM' OR mail_data.processed_by = 'MB' OR mail_data.processed_by = 'FP')"; 
$result = mysqli_query($conn,$sql); 

echo "<div class='content'>";

if ($result->num_rows > 0) {
	
	echo " <div id='table-scroll'><table id='myTable' border='1' cellspacing='2' cellpadding='2' class='sortable' >"; // start a table tag in the HTML
	echo "<thead>";
	echo "<tr><th> Job Id </th><th> Client name </th><th> Job name </th><th> Records Total </th><th> Status </th><th> % Complete </th><th>Due Date</th><th> User </th></tr>";
	echo "</thead>";
	echo "<tbody>";
    
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
	
	echo "</tbody></table></div><br>";
	
	echo "<br>";
	
}
echo "</div>"; 
?>
<script src="ddtf.js"></script>
<script>
$('#myTable').ddTableFilter();
</script>