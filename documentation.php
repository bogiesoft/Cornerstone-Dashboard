<?php
require ("header.php");
?>
<div class="content">
<div class="content-box">
<div class="topbar">
<h1>Documentation</h1>
<a href="add_doc.php" class="add_button">Add Doc</a>
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

$result = mysqli_query($conn,"SELECT * FROM documentation");

if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		$temp = $row['title'];
		echo "<a href='edit_doc.php?title=$temp'><h2>".$row['title']."</h2></a>"."User: ".$row['user']."  Time: ".$row['timestamp']."<br><br>";
		echo nl2br($row['text'])."<br><br>";
		
    }
	echo "<br>";
} else {
    echo "0 results";
}

$conn->close();

?>

</div>
</div>			
				
</div>	
