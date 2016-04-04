<?php
require ("header.php");
?>
<div class="content">
<div class="contacts-title">
	<h2>New Weights and Measure</h2>
	<a class="save-button" href="#">Save</a>
</div>
<div class="dashboard-detail">
	<div class="newcontacts-outer">
		<div class="tab-content">
			<form action="add_wm.php" method="post">
				<div class="newclienttab-inner">
					
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
					echo "<select name='vendor'>";
					$sql = mysqli_query($conn,"SELECT vendor_name FROM vendors");
					while ($row = mysql_fetch_array($sql)){
						echo "<option value=vendor>" . $row['vendor_name'] . "</option>";
					}
					echo "</select>";

					//$sql="SELECT vendor_name FROM vendors order by name";
					
					//echo "<label>Vendor</label>";
					//echo "<option select name=vendor value=''>Vendor Name</option>";
					//echo "<input name="vendor" type="text" class="contact-prefix">";
					//foreach ($conn->query($sql) as $row){//Array or records stored in $row

					//echo "<option value=$row[vendor_name]>$row[vendor_name]</option>"; 

					/* Option values are added by looping through the array */ 

					//}
					//echo "</div>";
					//echo "<div class='tabinner detail'>";
					//echo "<label>Job ID</label>";
					//echo "<input name='job_id' type='text' class='contact-prefix'>";
					//echo "</div>";
					?>
					<!--<div class="tabinner detail">
					<label>Size</label>
					<input name="size" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Height</label>
					<input name="height" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Weight</label>
					<input name="weight" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Based On</label>
					<input name="based_on" type="text" class="contact-prefix">
					</div>-->
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form">
				</div>
			</form>
		</div>
	</div>
	
</div>
</div>