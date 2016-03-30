<?php
require ("header.php");
?>
<div class="content">
<div class="contacts-title">
	<h2>New Client</h2>
	<a class="save-button" href="#">Save</a>
</div>
<div class="dashboard-detail">
	<div class="newcontacts-outer">
		<div class="tab-content">
			<form action="addclient.php" method="post">
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Client Name</label>
					<input name="client_name" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Contact Name</label>
					<input name="contact_name" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Contact Address</label>
					<input name="client_add" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Phone Number</label>
					<input name="contact_phone" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Email</label>
					<input name="contact_email" type="text" class="contact-prefix">
					</div>
				</div>
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Category</label>
					<input name="category" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Title</label>
					<input name="title" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Phone Number 2</label>
					<input name="sec1" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Website</label>
					<input name="website" type="text" class="contact-prefix">
					</div>
				</div>
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Notes</label>
					<textarea name="notes" class="contact-notes"></textarea>
					</div>
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form">
				</div>
			</form>
		</div>
	</div>
	
</div>
</div>
				
