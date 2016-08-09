<script>
	$(function() {
		$(".delete").click(function() {
			var commentContainer = $(this).parent();
			var id = $(this).attr("id");
			var string = 'id='+ id ;

			$.ajax({
				type: "POST",
				url: "deleteNotification.php",
				data: string,
				cache: false,
				success: function(){
					commentContainer.slideUp('slow', function() {$(this).remove();});
				}
			});
			return false;
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
        echo "<div class='notifications' style = 'font-size: 10px'>" . $row['user'] . " " . $row['job'] ."  <button class='delete' id='".$row['time']."'>Delete</button></div>"; 
    }
} else {
    echo "0 results from jobticket";
}
?>

