<?php
require ("header.php");
?>

<div class="content">
<div class="content-box">
<div class="topbar">
<h1>Clients</h1>
<a href="add_client.php" class="add_button">Add Client</a>
</div>
<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form action="v.php" method="get" >
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


$result = mysqli_query($conn,"SELECT * FROM vendors");


if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		
		echo "<div data-role='main' class='ui-content'>";
			echo "<div><br>";
				$x = $row["vendor_name"];
				echo "<B>".$row["vendor_name"]."</B>"."<br>";
				echo "Contact Name: ".$row["vendor_contact"]."<br>";
				echo "Address: ".$row["vendor_add"]."<br>";
				echo "Email: ".$row["vendor_email"]."<br>";
				echo "Phone: ".$row["vendor_phone"]."<br>";
				echo "Website: ".$row["vendor_website"]."<br><br>";
			echo "</div>";
				
			
			echo "<div data-role='collapsible'>";
				echo "<h1>Material Info</h1>";					
					$result1 = mysqli_query($conn,"SELECT * FROM w_and_m WHERE vendor='$x'");
					
					if ($result1->num_rows > 0) {
						echo "<table  border='1' cellspacing='2' cellpadding='2'>"; 
						echo "<tr><th> Material </th><th> Size </th><th> Height </th><th> Weight </th><th> Based On </th></tr>";
						while($row1 = $result1->fetch_assoc()) {
							
							echo "<tr><td>".$row1["material"]."</td><td>".  $row1["size"]."</td><td>". $row1["height"]. "</td><td>". $row1["weight"]. "</td><td>". $row1["based_on"]."</td></tr>";
							
							
						}
						echo "</table>";
					} 
				
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
				
</div>


<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>	


	

						