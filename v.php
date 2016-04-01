<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

<form action="update_vendor.php" id="form" method="POST">
				<div class="newclienttab-inner">
					<div class="tabinner detail">					
					<label>Vendor Name</label>
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
	

	$sql = "SELECT * FROM vendors WHERE vendor_name = '$term'"; 
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
	else {
		echo "No results found";
		$display = "no";
	}
}

?>
					<input name="vendor_name" type="text" value="<?php echo $vendor_name; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Contact Name</label>					
					<input name="vendor_contact" type="text" value="<?php echo $vendor_contact; ?>" class="contact-prefix">
					</div>
					<!--<div class="tabinner detail">
					<label>Contact Address</label>
					<input name="client_add" type="text" value="<?php echo $client_add; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Phone Number</label>
					<input name="contact_phone" type="text" value="<?php echo $contact_phone; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Email</label>
					<input name="contact_email" type="text" value="<?php echo $contact_email; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Email</label>
					<input name="contact_email" type="text" value="<?php echo $contact_email; ?>" class="contact-prefix">
					</div>--->
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form">
				</div>
			</form>

