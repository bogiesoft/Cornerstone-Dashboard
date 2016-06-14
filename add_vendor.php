<?php
require ("header.php");
?>
<div class="content">
<div class="contacts-title">
	<h2>New Vendor</h2>
	<a class="save-button" href="#">Save</a>
</div>
<div class="dashboard-detail">
	<div class="newcontacts-outer">
		<div class="tab-content">
			<form action="addvendor.php" method="post">
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Vendor Name</label>
					<input name="vendor_name" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Contact Name</label>
					<input name="vendor_contact" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Contact Address</label>
					<input name="vendor_add" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Phone Number</label>
					<input name="vendor_phone" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Email</label>
					<input name="vendor_email" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Website</label>
					<input name="vendor_website" type="text" class="contact-prefix">
					</div>
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form" onclick = "return confirm('Add new vendor?')">
				</div>
			</form>
		</div>
	</div>
	
</div>
</div>
				
