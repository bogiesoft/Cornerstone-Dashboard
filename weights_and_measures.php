<?php
require ("header.php");
?>
<div class="content">
<div class="content-box">
<div class="topbar">
<h1>Weights and Measures</h1>
<a href="add_w_m.php" class="add_button">Add</a>
</div>
<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form action="search_w_m.php" method="POST" >
				<label>Quick Search</label>
				<input name="frmSearch" type="text" placeholder="Search for a specific client">
				<input id="SubmitBtn" type="submit" value="SUBMIT" >
			</form>
		</div>
	</div>
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


$result = mysqli_query($conn,"SELECT * FROM w_and_m");


if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		
		echo "<div data-role='main' class='ui-content'>";
			echo "<div><br><br><br>";
				echo "Vendor: ".$row["vendor"]."<br>";
				echo "Material: ".$row["material"]."<br>";
				echo "Size: ".$row["size"]."<br>";
				echo "Height: ".$row["height"]."<br>";
				echo "Weight: ".$row["weight"]."<br>";
				echo "Based On: ".$row["based_on"];
			echo "</div>";
		echo "</div>";
    }
	echo "<br>";
} else {
    echo "0 results";
}

$conn->close();

?>
</div>
</div>
