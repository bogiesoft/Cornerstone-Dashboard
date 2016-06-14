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
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";
// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//session_start();


$result = mysqli_query($conn,"SELECT * FROM reminder WHERE date = CURDATE() ");
$result1 = mysqli_query($conn,"SELECT * FROM reminder WHERE date BETWEEN DATE_ADD(CURDATE(),INTERVAL 1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 5 DAY)");
echo " <div id='table-scroll'><table id='table' border='1' cellspacing='2' cellpadding='2' class='sortable' >"; // start a table tag in the HTML
echo "<thead>";
echo "<tr><th>  </th><th> Date </th><th> Reminder </th><th> Vendor Info</th><th> Client Info </th></tr>";
echo "</thead>";
echo "<tbody>";

$curUser = $_SESSION['user'];
$reminders = "SELECT * FROM reminder WHERE user = '$curUser' ORDER BY date ASC";

$resultRem = mysqli_query($conn, $reminders);

while($row = $resultRem->fetch_assoc()){
	$foo=$row['id'];
	echo "<tr><th>"."<a href='edit_reminder.php?id=$foo'>"."Edit"."</a></th><td>".$row["date"]."</td><td>".  $row["text"]."</td>";
	if($row['vendor_name'] == "")
	{
		echo "<td></td>";
	}
	else
	{
		$foo = $row["vendor_name"];
		echo "<td><a href='search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a></td>";
	}
	
	if($row['client_name'] == "")
	{
		echo "<td></td>";
	}
	else
	{
		$foo = $row["client_name"];
		echo "<td><a href='edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a></td>";
	}
	
	echo "<tr>";
}

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