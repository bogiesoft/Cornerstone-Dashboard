<?php
//not using this page anymore
require ("connection.php");
if (!empty($_REQUEST['frmSearch'])){
	
	$term = mysql_real_escape_string($_REQUEST['frmSearch']);
	

	$sql = "SELECT * FROM vendors WHERE vendor_name = '$term'"; 
	$result = mysqli_query($conn,$sql); 
	
	
	
	if ($result->num_rows > 0) {

		$row = $result->fetch_assoc();	
	

		$vendor_name = $row['vendor_name'];
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


<form action="update_vendor.php" id="form" method="POST">
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<?php echo $vendor_name; ?>
					<label>Vendor Name</label>
					<input name="vendor_name" type="text" value="<?php echo $vendor_name; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Contact Name</label>
					<?php echo $vendor_contact; ?>
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
