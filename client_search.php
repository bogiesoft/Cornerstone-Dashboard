<?php
require ("header.php");
?>
<?php
//not using this page anymore
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";
// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if (!empty($_REQUEST['frmSearch'])){
	
	$term = mysql_real_escape_string($_REQUEST['frmSearch']);
	
	$sql = "SELECT * FROM client_info WHERE client_name LIKE '%".$term."%'"; 
	$result = mysqli_query($conn,$sql); 
	echo "<div class='content'>";
	echo "<table  border='1' cellspacing='2' cellpadding='2'>"; // start a table tag in the HTML
	echo "<tr><th> Client name </th><th> Contact name </th><th> Address </th><th> Contact Phone </th><th> Email </th><th> Website </th><th> Category </th><th> Title </th><th> Notes </th></tr>";
	
	if ($result->num_rows > 0) {
	
    while($row = $result->fetch_assoc()) {
		echo "<tr><td>"."<a href='http://localhost/crst_dashboard/client_info.php'>".$row["client_name"]."</a>"."</td><td>".  $row["contact_name"]."</td><td>". $row["client_add"]. "</td><td>". $row["contact_phone"]. "</td><td>". $row["contact_email"]."</td><td>". $row["website"]. "</td><td>". $row["category"]. "</td><td>". $row["title"]. "</td><td>". $row["notes"]. "</td></tr>";
    }
	echo "<br>";
	echo "</div>";
} else {
    echo "No results found";
}
}
?>