<?php
require('header.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";
// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id AND mail_data.processed_by = 'RP'"; 
$result = mysqli_query($conn,$sql); 

echo "<div class='content'>";
?>
<form action = "production_data.php" method = "POST">
	<input class="add_button" type = "submit" name = "submit_form" value = "Production Data Manager">
</form><br>
<?php

if ($result->num_rows > 0) {
	
	echo " <div id='table-scroll'><table id='myTable' border='1' cellspacing='2' cellpadding='2' class='sortable' >"; // start a table tag in the HTML
	echo "<thead>";
	echo "<tr><th> Job Id </th><th> Client name </th><th> Job name </th><th> Records Total </th><th> Quantity </th><th> Based On </th><th> Tasks </th><th> Foreigns </th><th> Domestic </th><th> Special Instructions </th></tr>";
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
		$sql2 = "SELECT * FROM materials WHERE job_id = '$temp'"; 
		$result2 = mysqli_query($conn,$sql2);
		$row2 = $result2->fetch_assoc();
		$sql4 = "SELECT * FROM mail_info WHERE job_id = '$temp'"; 
		$result4 = mysqli_query($conn,$sql4);
		$row4 = $result4->fetch_assoc();
		$sql5 = "SELECT * FROM production WHERE job_id = '$temp'"; 
		$result5 = mysqli_query($conn,$sql5);
		$row5 = $result5->fetch_assoc();
		

		echo "<tr><td><a href='http://localhost/crst_dashboard/edit_job.php?job_id=$temp'>".$temp."</a></td><td><a href='http://localhost/crst_dashboard/edit_client.php?client_name=$foo'>".$row["client_name"]."</a></td><td>".  $row["project_name"]."</td><td>". $row1['records_total']. "</td><td>". $row2['quantity']. "</td><td>". $row2['based_on']. "</td><td>". $row5['tasks']. "</td><td>". $row1['foreigns']. "</td><td>". $row1['domestic']. "</td><td><a href = 'http://localhost/crst_dashboard/special_instructions.php?job_id=$temp' >"."view". "</a></td></tr>";
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