<?php
require ("header.php");
?>
<?php


						require ("connection.php");
							$user_name = $_SESSION['user'];
							date_default_timezone_set('America/New_York');
							$_SESSION['date'] = $today;
							$today = date("Y-m-d g:i:s");
							$job = "updated vendor"; 
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
								$vendor_name = $_POST['vendor_name'];
								$vendor_contact = $_POST['vendor_contact'];
								$vendor_phone = $_POST['vendor_phone'];
								$vendor_email = $_POST['vendor_email'];
								$vendor_website = $_POST['vendor_website'];		
								$vendor_add = $_POST['vendor_add'];

								$sql = "UPDATE vendors SET vendor_name='$vendor_name',vendor_phone='$vendor_phone',vendor_add='$vendor_add',vendor_contact='$vendor_contact',vendor_email='$vendor_email',vendor_website='$vendor_website' WHERE vendor_name='$vendor_name'";

								$result = $conn->query($sql) or die('Error querying database.');
								 
								$conn->close();

								header("location: http://localhost/crst_dashboard/vendors.php ");

								exit();
							}
						}
						
						if(isset($_POST['submit_form'])){
							$vendor_name = $_POST['vendor_name'];
							$vendor_contact = $_POST['vendor_contact'];
							$vendor_phone = $_POST['vendor_phone'];
							$vendor_email = $_POST['vendor_email'];
							$vendor_website = $_POST['vendor_website'];		
							$vendor_add = $_POST['vendor_add'];
							
							$sql_update = "INSERT INTO timestamp (user,time,job) VALUES ('$user_name', '$today','$job')";
							mysqli_query($conn, $sql_update);
							
							$job = "updated vendor";
							$sql = "UPDATE vendors SET vendor_name='$vendor_name',vendor_phone='$vendor_phone',vendor_add='$vendor_add',vendor_contact='$vendor_contact',vendor_email='$vendor_email',vendor_website='$vendor_website' WHERE vendor_name='$vendor_name'";

							$result = $conn->query($sql) or die('Error querying database.');
							 
							$conn->close();

							header("location: http://localhost/crst_dashboard/vendors.php ");

							exit();
						}
						if(isset($_POST['delete_form'])){
							$sql_delete = "DELETE FROM vendors WHERE '$vendor_name' = vendor_name";
							mysqli_query($conn, $sql_delete);
							$conn->close();
							header("location: http://localhost/crst_dashboard/vendors.php");
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
			

