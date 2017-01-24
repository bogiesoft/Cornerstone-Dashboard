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
			<form action="update_vendor.php" method="post">
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Vendor Name</label>
					<input name="client_name" type="text" value="<?php echo $vendor_name; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Contact</label>
					<input name="contact_name" type="text" value="<?php echo $vendor_contact; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Address</label>
					<input name="client_add" type="text" value="<?php echo $vendor_add; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>City</label>
					<input name="v_city" type="text" value="<?php echo $v_city; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>State</label>
					<select name="v_state" type="text" value="<?php echo $v_state; ?>" class="contact-prefix"></select>
					<div class="clear"></div>
					</div>
					<label>ZIP Code</label>
					<input name="v_zip" type="text" value="<?php echo $v_zip; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Website</label>
					<input name="website" type="text" value="<?php echo $website; ?>" class="contact-prefix">
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
					<input class="save-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					<input class="save-btn" type = "submit" value = "Delete" name = "delete_form" onClick = "return confirm('Are you sure you want to delete vendor?')" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
				</div>
			</form>
			</div>
		</div>
	</div>
	</div>
</div>
</div>