<?php
require ("header.php");
?>
<div class="content">
<div class="contacts-title">
	<h2>New Documentation</h2>
	
</div>
<div class="dashboard-detail">
	<div class="newcontacts-outer">
		<div class="tab-content">
			<form action="add_new_doc.php" method="post">
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Title</label>
					<input name="title" type="text" class="contact-prefix">
					</div>
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Text</label>
					<textarea name="text" class="contact-notes"></textarea>
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
				
