<?php
require ("header.php");
?>
<div class="content">
	<div class="contacts-title">
		<h2>Reminders</h2>
		
	</div>
	<div class="dashboard-detail">
		<div class="newcontacts-outer">
			<div class="tab-content">
				<form action="add_reminder.php" method="post">
					<div class="newclienttab-inner">
						<div class="tabinner detail">
						<label>Date</label>
						<input name="date" type="date" class="contact-prefix">
						</div>
						<div class="tabinner detail">
						<label>Text</label>
						<textarea name="text" type="date" class="contact-prefix"></textarea>
						</div>
					</div>
					<div class="form-bottom">
						<input id="btn" type="submit" value="Save" name="submit_form" onclick = "return confirm('Add reminder?')">
					</div>
				</form>
			</div>
		</div>
	
	</div>
</div>