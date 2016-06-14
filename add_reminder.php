<?php
require ("header.php");
?>
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
$date = $_POST['date'];
$text = $_POST['text'];
$client_info = $_POST['client_info'];
$vendor_info = $_POST['vendor_info'];

$user = $_SESSION['user'];

$sql = "SELECT id FROM reminder";
$resultSize = mysqli_query($conn, $sql);
$count = 0;

if($resultSize->num_rows == 0)
{
	$count = 1;
}
else
{
	$count = 0;
	
	while($row = $resultSize->fetch_assoc())
	{
		if(intval($row['id']) > $count)
		{
			$count = intval($row['id']);
		}
	}
	
	$count = $count + 1;
}

$sql = "INSERT INTO reminder(id,user,date,text,vendor_name,client_name) VALUES ('$count','$user','$date','$text','$vendor_info','$client_info')";
$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();
header("location: reminders.php ");
exit();
?>