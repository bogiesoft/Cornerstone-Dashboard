<?php
require ("header.php");
require ("connection.php");

	
	$term = $_GET['job_id'];
	$job_id = $term;
	
	$sql = "SELECT * FROM materials WHERE job_id = '$term'"; 
	$result = mysqli_query($conn,$sql); 
	
	
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();	
	
		$job_id = $row['job_id'];
		$received = $row['received'];
		$location = $row['location'];
		$checked_in = $row['checked_in'];
		$material = $row['material'];
		$type = $row['type'];
		$vendor = $row['vendor'];
		$quantity = $row['quantity'];
		$height = $row['height'];
		$weight = $row['weight'];
		$size = $row['size'];
		$based_on = $row['based_on'];
		$display = "yes";
    
	} 
	else {
		echo "No results found";
		$display = "no";
	}
	if(isset($_POST['submit_form'])){
		session_start();
		$user_name = $_SESSION['user'];
		date_default_timezone_set('America/New_York');
		$today = date("Y-m-d g:i:s");
		$_SESSION['date'] = $today;
		$job = "updated w&m"; 


		$job_id = $_POST['job_id'];
		$received = $_POST['received'];
		$location = $_POST['location'];
		$checked_in = $_POST['checked_in'];
		$material = $_POST['material'];
		$type = $_POST['type'];
		$vendor = $_POST['vendor'];
		$quantity = $_POST['quantity'];
		$height = $_POST['height'];
		$weight = $_POST['weight'];
		$size = $_POST['size'];
		$based_on = $_POST['based_on'];
		$sql = "UPDATE materials SET location='$location',received='$received',checked_in='$checked_in',material='$material',type='$type',vendor='$vendor',quantity='$quantity',height='$height',weight='$weight',size='$size', based_on = '$based_on' 
		 WHERE job_id ='$job_id'";
		$result = $conn->query($sql) or die('Error querying database.');

		$sql6 = "INSERT INTO timestamp (user,time,job) VALUES ('$user_name', '$today','$job')";
		$result7 = $conn->query($sql6) or die('Error querying database 5.');
		 
		$conn->close();
		header("location: http://localhost/crst_dashboard/weights_and_measure.php");
		exit();
	}
	if(isset($_POST['delete_form'])){
		$sql_delete = "DELETE FROM materials WHERE '$job_id' = job_id";
		mysqli_query($conn, $sql_delete);
		$conn->close();
		header("location: http://localhost/crst_dashboard/weights_and_measure.php");
	}
	
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    if($display = "no"){
        $("form").hide();
    }
	if($display = "yes"){
        $("form").show();
    }
});
</script>

<div class="content">
<form action="" method="post">
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Job Id</label>
					<input name="job_id" type="text" class="contact-prefix" value="<?php echo $job_id; ?>">
					</div>
					
					
					<div class="tabinner detail">
					<label>Received Date</label>
					<input name="received" type="date" class="contact-prefix" value="<?php echo $received; ?>">
					</div>
					<div class="tabinner detail">
					<label>Location</label>
					<input name="location" type="text" class="contact-prefix" value="<?php echo $location; ?>">
					</div>
				</div>
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Checked In</label>
					<input name="checked_in" type="text" class="contact-prefix" value="<?php echo $checked_in; ?>">
					</div>
					<div class="tabinner detail">
					<label>Material</label>
					<input name="material" type="text" class="contact-prefix" value="<?php echo $material; ?>">
					</div>
					<div class="tabinner detail">
					<label>Type</label>
					<input name="type" type="text" class="contact-prefix"value="<?php echo $type; ?>">
					</div>
					<div class="tabinner detail">
					<label>Quantity</label>
					<input name="quantity" type="text" class="contact-prefix" value="<?php echo $quantity; ?>">
					</div>
					<div class="tabinner detail">
					<label>Vendor</label>
					<input name="vendor" type="text" class="contact-prefix" value="<?php echo $vendor; ?>">
					</div>
					
					<div class="tabinner detail">
					<label>Height</label>
					<input name="height" type="text" class="contact-prefix" value="<?php echo $height; ?>">
					</div>
					<div class="tabinner detail">
					<label>Weight</label>
					<input name="weight" type="text" class="contact-prefix" value="<?php echo $weight; ?>">
					</div>
					<div class="tabinner detail">
					<label>Size</label>
					<input name="size" type="text" class="contact-prefix" value="<?php echo $size; ?>">
					</div>
					<div class="tabinner detail">
					<label>Based On</label>
					<input name="based_on" type="text" class="contact-prefix" value="<?php echo $based_on; ?>">
					</div>
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form" onclick = "return confirm('Save changes?')">
					<input id="delete" type="submit" value="Delete" name="delete_form" onclick = "return confirm('Are you sure you want to delete client?')">
				</div>
			</form>
		</div>