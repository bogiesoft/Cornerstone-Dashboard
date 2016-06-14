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
							$vendor_name = $temp;
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
								
								if(isset($_POST['submit_form'])){
									$user_name = $_SESSION['user'];
									date_default_timezone_set('America/New_York');
									$today = date("Y-m-d G:i:s");
									$a_p = date("A");
									$_SESSION['date'] = $today;
									$job = "updated vendor";
									
									$sql_update_vendor_time = "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
									mysqli_query($conn, $sql_update_vendor_time) or die("update vendor error");
									
									$vendor_name = $_POST['vendor_name'];
									$vendor_contact = $_POST['vendor_contact'];
									$vendor_phone = $_POST['vendor_phone'];
									$vendor_email = $_POST['vendor_email'];
									$vendor_website = $_POST['vendor_website'];		
									$vendor_add = $_POST['vendor_add'];

									$sql = "UPDATE vendors SET vendor_name='$vendor_name',vendor_phone='$vendor_phone',vendor_add='$vendor_add',vendor_contact='$vendor_contact',vendor_email='$vendor_email',vendor_website='$vendor_website' WHERE vendor_name='$vendor_name'";

									$result = $conn->query($sql) or die('Error querying database.');
									 
									$conn->close();

									header("location: vendors.php ");

									exit();
								}
								if(isset($_POST['delete_form'])){
									$user_name = $_SESSION['user'];
									date_default_timezone_set('America/New_York');
									$today = date("Y-m-d G:i:s");
									$a_p = date("A");
									$_SESSION['date'] = $today;
									$job = "deleted vendor";
									
									$sql_delete_vendor_time = "INSERT INTO timestamp (user,time,job,a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
									mysqli_query($conn, $sql_delete_vendor_time) or die(" delete vendor error");
									
									$sql_delete = "DELETE FROM vendors WHERE '$vendor_name' = vendor_name";
									mysqli_query($conn, $sql_delete);
									$conn->close();
									header("location: vendors.php");
								}
						}

					?>
					<div class = "content" >
			<form action="" id="form" method="POST">
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
					<input id="btn" type="submit" value="Save" name="submit_form" onclick = "return confirm('Save changes?')">
					<input id = "delete" type = "submit" value = "Delete" name = "delete_form" onclick = "return confirm('Are you sure you want to delete client?')">
				</div>
			</form>
			</div>
			

