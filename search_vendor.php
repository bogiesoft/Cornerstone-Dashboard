<?php


						require ("connection.php");
							$temp = unserialize($_GET['vendor_info']);
							$vendor_name = $temp[0];
							$vendor_add = $temp[1];
							$sql = "SELECT * FROM vendors WHERE vendor_name = '$vendor_name' AND vendor_add = '$vendor_add'"; 
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
								$name_squeezed = str_replace(" ", "", $vendor_name);
								$address_squeezed = str_replace(" ", "", $vendor_add);
								$name_squeezed = strtolower($name_squeezed);
								$address_squeezed = strtolower($address_squeezed);
						}
						if(isset($_POST['submit_form'])){
							session_start();
							$user_name = $_SESSION['user'];
							$result_previous = mysqli_query($conn, "SELECT vendor_name, vendor_add FROM vendors WHERE vendor_name = '$vendor_name' AND vendor_add = '$vendor_add'");
							$row_previous = $result_previous->fetch_assoc();
							$prev_name = $row_previous['vendor_name'];
							$prev_add = $row_previous['vendor_add'];
							$name_squeezed_old = str_replace(" ", "", $prev_name);
							$address_squeezed_old = str_replace(" ", "", $prev_add);
							$name_squeezed_old = strtolower($name_squeezed_old);
							$address_squeezed_old = strtolower($address_squeezed_old);
							$old_name = $name_squeezed_old . $address_squeezed_old;
							date_default_timezone_set('America/New_York');
							$today = date("Y-m-d G:i:s");
							$a_p = date("A");
							$job = "updated vendor";
							$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
							$result7 = $conn->query($sql6) or die('Error querying database 5.');
							$vendor_name = $_POST['client_name'];
							$vendor_contact = $_POST['contact_name'];
							$vendor_phone = $_POST['contact_phone'];
							$vendor_email = $_POST['contact_email'];
							$vendor_website = $_POST['website'];		
							$vendor_add = $_POST['client_add'];
							$name_squeezed_new = str_replace(" ", "", $vendor_name);
							$address_squeezed_new = str_replace(" ", "", $vendor_add);
							$name_squeezed_new = strtolower($name_squeezed_new);
							$address_squeezed_new = strtolower($address_squeezed_new);
							$new_name = $name_squeezed_new . $address_squeezed_new;
							$old_location = "images/vendor-logos/" . $old_name;
							$new_location = "images/vendor-logos/" . $new_name;
							if(file_exists($old_location . ".jpg")){
								$old_location = $old_location . ".jpg";
							}
							else{
								$old_location = $old_location . ".png";
							}
							
							if(file_exists($new_location . ".jpg")){
								$new_location = $new_location . ".jpg";
							}
							else{
								$new_location = $new_location . ".png";
							}
							
							rename($old_location, $new_location);
					
							$sql = "UPDATE vendors SET vendor_name='$vendor_name',vendor_phone='$vendor_phone',vendor_add='$vendor_add',vendor_contact='$vendor_contact',vendor_email='$vendor_email',vendor_website='$vendor_website' WHERE vendor_name='$prev_name' AND vendor_add = '$prev_add'";

							$result = $conn->query($sql) or die('Error querying database.');
							if(isset($_FILES["fileToUpload"])){
								$info = pathinfo($_FILES['fileToUpload']['name']);
								$ext = "." . $info["extension"];
								$newname = $new_location;
								$target_Path = $newname;
								//$target_Path = $target_Path.basename( $_FILES['fileToUpload']['name'] );
								move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_Path);
							}
							
							//die($old_location);
							 
							$conn->close();

							header("location: vendors.php ");

							exit();
						}
						if(isset($_POST['delete_form'])){
							session_start();
							$user_name = $_SESSION['user'];
							date_default_timezone_set('America/New_York');
							$today = date("Y-m-d G:i:s");
							$a_p = date("A");
							$job = "deleted vendor";
							$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
							$result7 = $conn->query($sql6) or die('Error querying database 5.');
							$sql_delete = "DELETE FROM vendors WHERE vendor_name='$vendor_name'";
							mysqli_query($conn, $sql_delete);
							$sql_delete_WM = "DELETE FROM materials WHERE vendor='$vendor_name'";
							mysqli_query($conn, $sql_delete_WM);
							$conn->close();
							header("location: vendors.php");
							exit();
						}
					require ("header.php");
					?>
					<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Edit Vendor</h1>
	<a class="pull-right" href="vendors.php">Back to Vendors</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Primary Contact</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<form action="" method="post" enctype='multipart/form-data'>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Vendor Name</label>
					<input name="client_name" type="text" value="<?php echo $vendor_name; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Vendor Contact</label>
					<input name="contact_name" type="text" value="<?php echo $vendor_contact; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Vendor Address</label>
					<input name="client_add" type="text" value="<?php echo $vendor_add; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Website</label>
					<input name="website" type="text" value="<?php echo $vendor_website; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Phone Number</label>
					<input name="contact_phone" type="text" value="<?php echo $vendor_phone; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Email</label>
					<input name="contact_email" type="text" value="<?php echo $vendor_email; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<input type='file' name='fileToUpload' id='fileToUpload'>
					</div>
					<div class ="tabinner-detail">
					<img width = '400' height = '400' src="<?php
						$temp = $name_squeezed . $address_squeezed;
						if(file_exists("images/vendor-logos/" . $temp . ".jpg")){
							echo "images/vendor-logos/" . $temp . ".jpg";
						}
						else if(file_exists("images/vendor-logos/" . $temp . ".png")){
							echo "images/vendor-logos/" . $temp . ".png";
						}
						else{
							echo "images/vendor-logos/default-logo.png";
						}
					?>">
					</div>
				</div>
			</div>
				<div class="newcontact-tabbtm">
					<input class="save-btn store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					<input class="save-btn delete-btn" type = "submit" value = "Delete" name = "delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
				</div>
			</form>
			</div>
		</div>
	</div>
	</div>
</div>
</div>
<script src="VendorSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>			

