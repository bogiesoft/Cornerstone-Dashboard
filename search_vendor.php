<?php


						require ("connection.php");

							$temp = unserialize($_GET['vendor_info']);
							$vendor_name = $temp[0];
							$vendor_add = $temp[1];
							$sql = "SELECT * FROM vendors WHERE vendor_name = '$vendor_name'"; 
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
						
						if(isset($_POST['submit_form'])){
							$user_name = $_SESSION['user'];
							$result_previous = mysqli_query($conn, "SELECT vendor_name, vendor_add FROM vendors WHERE vendor_name = '$vendor_name'");
							$row_previous = $result_previous->fetch_assoc();
							$prev_name = $row_previous['vendor_name'];
							$prev_add = $row_previous['vendor_add'];
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
					
							$sql = "UPDATE vendors SET vendor_name='$vendor_name',vendor_phone='$vendor_phone',vendor_add='$vendor_add',vendor_contact='$vendor_contact',vendor_email='$vendor_email',vendor_website='$vendor_website' WHERE vendor_name='$prev_name'";

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
	<a class="pull-right" href="vendors.php" style="margin-right:20px; background-color:#d14700;">Back to Vendors</a>
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
			<form action="" method="post">
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

