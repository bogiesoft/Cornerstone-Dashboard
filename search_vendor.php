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
						
							
							$temp = $_GET['vendor_name'];
							$sql = "SELECT * FROM vendors WHERE vendor_name = '$temp' "; 
							$result = mysqli_query($conn,$sql); 
							
							
							
							if ($result->num_rows > 0) {

								$row = $result->fetch_assoc();	
							

								$vendor_name = $row["vendor_name"];
								$vendor_contact = $row["vendor_contact"];
								$vendor_phone = $row["vendor_phone"];
								$vendor_email = $row["vendor_email"];
								$vendor_website = $row["vendor_website"];		
								$vendor_add = $row["vendor_add"];
								$display = "yes";
						}

					?>
					<div class = "content" >
			<form action="update_vendor.php" id="form" method="POST">
				<div class="newclienttab-inner">
					<div class="tabinner detail">					
					<label>Vendor Name</label>
					<input name="vendor_name" type="text" value="<?php echo $vendor_name; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Contact Name</label>					
					<input name="vendor_contact" type="text" value="<?php echo $vendor_contact; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Vendor Address</label>
					<input name="vendor_add" type="text" value="<?php echo $vendor_add; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Phone Number</label>
					<input name="vendor_phone" type="text" value="<?php echo $vendor_phone; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Email</label>
					<input name="vendor_email" type="text" value="<?php echo $vendor_email; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Website</label>
					<input name="vendor_website" type="text" value="<?php echo $vendor_website; ?>" class="contact-prefix">
					</div>
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form">
				</div>
			</form>
			</div>
			

