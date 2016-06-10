<?php
require('header.php');
?>
<div class="content">
<div class="content-box">
<div class="topbar">
<h1>Reminders</h1>
<a href="add_rem.php" class="add_button">Add Reminders</a>
</div>
<?php
require ("connection.php");
//session_start();


$result = mysqli_query($conn,"SELECT * FROM reminder WHERE date = CURDATE() ");
$result1 = mysqli_query($conn,"SELECT * FROM reminder WHERE date BETWEEN DATE_ADD(CURDATE(),INTERVAL 1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 5 DAY)");
if ($result->num_rows > 0) {
    // output data of each row
	echo "<br><br><br>"."Today's Reminders: "." <br><br>";
	
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
	echo "<br><br><br>"."Upcoming Reminders: "." <br><br>";
	
    while($row = $result1->fetch_assoc()) {
		
		if($row['user'] == $_SESSION['user'] ){
			
			echo $row['date'].":  ".$row['text']."<br>";
		}
		
		
    }
	echo "<br>";
}
$conn->close();
?>

</div>
</div>		