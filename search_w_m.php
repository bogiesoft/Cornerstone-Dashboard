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
	if (!empty($_REQUEST['frmSearch'])){
		
		$term = mysql_real_escape_string($_REQUEST['frmSearch']);
		

		$sql = "SELECT * FROM w_and_m WHERE vendor = '$term' or material = '$term'"; 
		$result = mysqli_query($conn,$sql); 
		
		
		
		if ($result->num_rows > 0) {

			$row = $result->fetch_assoc();	
		

			$vendor = $row['vendor'];
			$material = $row['material'];
			$size = $row['size'];
			$height = $row['height'];
			$weight = $row['weight'];
			$based_on = $row['based_on'];
		
		} 
		else {
			echo "No results found";
			$display = "no";
		}
	}

?>
<div class = "content" >
	<form action="update_vendor.php" id="form" method="POST">
		<div class="newclienttab-inner">
			<div class="tabinner detail">					
			<label>Vendor</label>
			<input name="vendor" type="text" value="<?php echo $vendor; ?>" class="contact-prefix">
			</div>
			<div class="tabinner detail">
			<label>Material</label>					
			<input name="material" type="text" value="<?php echo $material; ?>" class="contact-prefix">
			</div>
			<div class="tabinner detail">
			<label>Size</label>
			<input name="size" type="text" value="<?php echo $size; ?>" class="contact-prefix">
			</div>
			<div class="tabinner detail">
			<label>Height</label>
			<input name="height" type="text" value="<?php echo $height; ?>" class="contact-prefix">
			</div>
			<div class="tabinner detail">
			<label>Weight</label>
			<input name="weight" type="text" value="<?php echo $weight; ?>" class="contact-prefix">
			</div>
			<div class="tabinner detail">
			<label>Based On</label>
			<input name="based_on" type="text" value="<?php echo $based_on; ?>" class="contact-prefix">
			</div>
		</div>
		<div class="form-bottom">
			<input id="btn" type="submit" value="Save" name="submit_form">
		</div>
	</form>
</div>
			

