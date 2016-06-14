<?php
require ("header.php");
require("connection.php");

$sql1 = "SELECT vendor_name FROM vendors";
$sql2 = "SELECT client_name FROM client_info";

$vendors = mysqli_query($conn, $sql1);
$clients = mysqli_query($conn, $sql2);

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
						<textarea name="text" type="date" class="contact-prefix"></textarea><br>
						<label>Client Name</label>
						<select name = "client_info">
							<?php 
								echo "<option></option>";
								while($row = $clients->fetch_assoc()){
									echo("<option>" . $row['client_name'] . "</option>");
								}
							?>
						</select><br>
						<label>Vendor Name</label>
						<select name = "vendor_info">
							<?php
								echo "<option></option>";
								while($row = $vendors->fetch_assoc()){
									echo("<option>" .$row['vendor_name'] . "</option>");
								}
							?>
						</select>
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