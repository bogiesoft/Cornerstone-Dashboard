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
require('connection.php');
session_start();
$user = $_SESSION['user'];

$result = mysqli_query($conn,"SELECT * FROM timestamp WHERE processed_by='$user' and viewed='no' ORDER BY time DESC LIMIT 5");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='notifications' style = 'font-size: 14px; text-align:center; color:#cc0000; padding-bottom:5px;'>" . $row['user'] . " " . $row['job'] ."  <img src='images/multiply-1.png' style='height:20px; width:20px; cursor:pointer;' class='delete' id='".$row['id']."'></img></div>"; 
    }
} else {
    echo "<p style='text-align:center; color:#356CAC; font-weight:bold; '>0 unread updates</p>";
}
?>

