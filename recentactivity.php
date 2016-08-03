<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";
session_start();
$user = $_SESSION['user'];

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn,"SELECT * FROM timestamp WHERE processed_by='$user' ORDER BY time DESC LIMIT 5");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$time = strtotime($row['time']);
		$myFormatForView = date("M d, Y g:i", $time);
        echo "<tr><td>  " . $row['user'] . " " . $row['job'] ." at ".$myFormatForView. " ". $row['a_p']. "</td></tr>"; 
    }
	
} else {
    echo "0 results from jobticket";
}
?>




<div class='allcontacts-table'><table style = 'width: 100%' border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >
<tbody>
<tr valign='top'><th class='allcontacts-title'>Notifications<span class='allcontacts-subtitle'></span></th></tr>
<tr id=edkoma>

<script type="text/javascript">
$(document).ready(function(){
		setInterval(function(){
			$('#edkoma').load('recentactivity.php')
		},3000);
});
</script>
</tbody>
</table>
</div>