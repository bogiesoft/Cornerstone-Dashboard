
<?php
require('header.php');
require ("connection.php");

if(isset($_POST['submit_form'])){
	$special_instructions = $_POST['special_instructions'];
	$job_id = $_GET['job_id'];
	
	mysqli_query($conn, "UPDATE job_ticket SET special_instructions = '$special_instructions' WHERE job_id = '$job_id'") or die("error");
	$conn->close();
	header("location: production.php");
	
}

$temp = $_GET['job_id'];
$sql = "SELECT * FROM job_ticket WHERE job_id = $temp "; 
$result = mysqli_query($conn,$sql); 
$row = $result->fetch_assoc();
$text = $row['special_instructions'];

$conn->close();	
?>

<div class='dashboard-cont' style='padding-top: 110px;'>
<form action = "" method = "post">
<div>
<textarea name='special_instructions' class='contact-prefix' cols='80' rows='20'> <?php echo $text;?> </textarea>
</div>
<div class = "clear"></div>
	<div class="newcontact-tabbtm" style = "width: 100px">
			<input class="save-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float: left">
	</div><br><br>
</form>
</div>