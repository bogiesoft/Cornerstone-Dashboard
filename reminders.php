<?php
require('header.php');
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Reminders</h1>
	<a class="pull-right" href="add_rem.php" class="add_button">Add Reminder</a>
	</div>
<div class="dashboard-detail">
<div class="clear"></div>
<div class="reminders">
<?php
require ("connection.php");
//session_start();


$result = mysqli_query($conn,"SELECT * FROM reminder WHERE date = CURDATE() ");
$result1 = mysqli_query($conn,"SELECT * FROM reminder WHERE date BETWEEN DATE_ADD(CURDATE(),INTERVAL 1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 5 DAY)");
if ($result->num_rows > 0) {
    // output data of each row
	echo "<h2>Today's Reminders:</h2>";
	
    while($row = $result->fetch_assoc()) {
		
		if($row['user'] == $_SESSION['user'] ){
			
			echo $row['text']."<br>";
		}
		
		
    }
	echo "<br>";
} else {
    echo "0 results";
}
if ($result1->num_rows > 0) {
    // output data of each row
	echo "<h2>Upcoming Reminders:</h2>";
	
    while($row = $result1->fetch_assoc()) {
		
		if($row['user'] == $_SESSION['user'] ){
			$time = strtotime($row['date']);
			$myFormatForView = date("M d, Y", $time);
			echo $myFormatForView.":  ".$row['text']."<br>";
		}
		
		
    }
}
$conn->close();
?>
</div>
</div>
</div>		