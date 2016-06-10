<?php
require('header.php');
?>
<div id="popup" onclick="hide('popup')">
<p id="demo"></p>

<?php
require ("connection.php");
//session_start();
$user = $_SESSION['user'];
$initial = $_SESSION['initial'];
echo "<h1>Welcome ".$user."!</h1><br>";


//echo CURDATE();
//Retrieves Jobs for User and Reminders
$sqlJobs = "SELECT project_name FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id WHERE mail_data.processed_by = '$initial' AND job_ticket.due_date = CURDATE()";
$resultJobs = mysqli_query($conn, $sqlJobs);
$num_rows_Jobs = mysqli_num_rows($resultJobs);

echo "<h3 style = 'color: #ffffff'>Jobs For Today: " . $num_rows_Jobs . "</h3>";

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
<div class="content">
<p>Sales info for <b id = "month"></b> <b id = "year"> </b>:</p><br>
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
<div>Estimates given: <?php echo "$num_rows \n"; ?></div></br>

<div>Job Tickets in Process: <?php echo "$num_rows2 \n"; ?></div></br>

<div><p>Assigned PM Jobs:</p>
Kevin: <?php echo "$num_rows3 \n"; ?><br>
Anna: <?php echo "$num_rows4 \n"; ?><br>
Femina: <?php echo "$num_rows5 \n"; ?><br>
</div></br>

<div>Jobs in Production: <?php echo "$num_rows6 \n"; ?><br></div></br>

<div>Jobs Invoiced: <?php echo "$num_rows7 \n"; ?></div></br>



<?php

require ("connection.php");
$result8 = mysqli_query($conn,"SELECT job_id,client_name,project_name,due_date,job_status FROM job_ticket");

// all current jobs
echo " <div id='table-scroll'><table id='table' border='1' cellspacing='2' cellpadding='2' class='paginated' >"; // start a table tag in the HTML
echo "<thead>";
echo "<tr><th>  </th><th> Job Id </th><th> Client </th><th> Project Name </th><th> Due Date </th><th> Job Status </th><th> Records Total </th><th> Assigned To </th></tr>";
echo "</thead>";
echo "<tbody>";


if ($result8->num_rows > 0) {
    // output data of each row
	
    while($row8 = $result8->fetch_assoc()) {
		
		$foo=$row8['job_id'];
		
		$result9 = mysqli_query($conn,"SELECT * FROM mail_data WHERE job_id = $foo");
		$row9 = $result9->fetch_assoc();
		
		echo "<tr><th>"."<a href='http://localhost/crst_dashboard/edit_job.php?job_id=$foo'>"."Edit"."</a></th><td>".$row8["job_id"]."</td><td>".  $row8["client_name"]."</td><td>". $row8["project_name"]. "</td><td>". $row8["due_date"]. "</td><td>". $row8["job_status"]."</td><td>". $row9["records_total"]."</td><td>". $row9["processed_by"]."</td></tr>";
    }
	echo "</tbody></table></div><br>";
} else {
    echo "0 results";
}

//most recent timestamps

$result = mysqli_query($conn,"SELECT * FROM timestamp ORDER BY time DESC LIMIT 10");

$sql_time_query = "SELECT date_trunc('second', now()::timestamp) FROM timestamp ORDER BY time DESC LIMIT 10";
$result_time_query = mysqli_query($conn, $sql_time_query);


echo "<table  border='1' cellspacing='2' cellpadding='2'>"; // start a table tag in the HTML
echo "<tr><th> User </th><th> Job </th><th> Time </th></tr>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['user'] . "</td><td>" . $row['job'] ."</td><td>".$row['time']."</td></tr>"; 
    }
	echo "<br>";
} else {
    echo "0 results from jobticket";
}
echo "</table>"; //Close the table in HTML
$conn->close();

?>



</div>

<script src="jquery.js"></script>
<script>
var d = new Date();
var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
document.getElementById("demo").innerHTML = "Today's date: "+ d;
document.getElementById("month").innerHTML = monthNames[d.getMonth()];
document.getElementById("year").innerHTML = d.getFullYear();
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