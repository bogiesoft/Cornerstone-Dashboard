<script src="jquery.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
	$(function(){
		$(".test").click(function(){
			alert('gklhkj');

		});
	});
</script>

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

$result = mysqli_query($conn,"SELECT * FROM timestamp WHERE processed_by='$user' and viewed='no' ORDER BY time DESC LIMIT 5");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$time = strtotime($row['time']);
		$myFormatForView = date("M d, Y g:i", $time);
        echo "<li class='notifications' style = 'font-size: 10px'>" . $row['user'] . " " . $row['job'] ." on ".$myFormatForView. " ". $row['a_p']. "<button id='".$$row['time']."'>delete</button></li>"; 
    }
} else {
    echo "0 results from jobticket";
}
?>

