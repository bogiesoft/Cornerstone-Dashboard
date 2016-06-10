<?php
require ("header.php");
?>
<div class="content">
	<div class="contacts-title">
		<h2>New Weights and Measure</h2>
		
	</div>
	<div class="dashboard-detail">
		<div class="newcontacts-outer">
			<div class="tab-content">
				<form action="add_w_m.php" method="post">
					<div class="newclienttab-inner">
						<div class="tabinner detail">
						<label>Job Id</label><select name='job_id' class="contact-prefix">
						<?php
						require ("connection.php");

						
						$result = $conn->query("SELECT job_id FROM job_ticket WHERE job_ticket.job_id NOT IN (SELECT job_id FROM materials)");
						
						while ($row = $result->fetch_assoc()) {
									  unset($job_id);
									  $job_id = $row['job_id']; 
									  echo '<option value="'.$job_id.'">'.$job_id.'</option>';
									 
						}
						echo "</select>";
						echo "</div>";
						?>

						<div class="tabinner detail">
						<label>Received Date</label>
						<input name="received" type="date" class="contact-prefix">
						</div>
						<div class="tabinner detail">
						<label>Location</label>
						<input name="location" type="text" class="contact-prefix">
						</div>
						<div class="tabinner detail">
						<label>Checked In</label>
						<input name="checked_in" type="text" class="contact-prefix">
						</div>
						<div class="tabinner detail">
						<label>Material</label>
						<input name="material" type="text" class="contact-prefix">
						</div>
						<div class="tabinner detail">
						<label>Type</label>
						<input name="type" type="text" class="contact-prefix">
						</div>
						<div class="tabinner detail">
						<label>Quantity</label>
						<input name="quantity" type="text" class="contact-prefix">
						</div>
						<?php
						require ("connection.php");
						$result = $conn->query("select vendor_name from vendors");
						echo("<div class='tabinner detail'>");
						echo "<label>Vendor</label><select name='vendor'>";
						while ($row = $result->fetch_assoc()) {
									  unset($vendor_name);
									  $vendor_name = $row['vendor_name']; 
									  echo '<option value="'.$vendor_name.'">'.$vendor_name.'</option>';
									 
						}
						echo "</select>";
						echo "</div>";
						?>
						
						<div class="tabinner detail">
						<label>Height</label>
						<input name="height" type="text" class="contact-prefix">
						</div>
						<div class="tabinner detail">
						<label>Weight</label>
						<input name="weight" type="text" class="contact-prefix">
						</div>
						<div class="tabinner detail">
						<label>Size</label>
						<input name="size" type="text" class="contact-prefix">
						</div>
						<div class="tabinner detail">
						<label>Based On</label>
						<input name="based_on" type="text" class="contact-prefix">
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