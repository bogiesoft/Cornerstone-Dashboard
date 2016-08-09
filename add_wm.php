<?php
require ("header.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Add Weights and Measures</h1>
	<a class="pull-right" href="weights_and_measure.php" style="margin-right:20px; background-color:#d14700;">Back to W/M</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">New Weights and Measures</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
				<form action="add_w_m.php" method="post">
					<div class="newcontacttab-inner">
						<div class="tabinner-detail">
						<label>Job Id</label><select name='job_id' class="contact-prefix" style="width:220px;">
						<?php
						require ("connection.php");

						
						$result = $conn->query("SELECT job_id FROM job_ticket");
						
						while ($row = $result->fetch_assoc()) {
									  unset($job_id);
									  $job_id = $row['job_id']; 
									  echo '<option value="'.$job_id.'">'.$job_id.'</option>';
									 
						}
						echo "</select>";
						?>
						</div>
						<div class="tabinner-detail">
						<label>Received Date</label>
						<input name="received" type="date" class="contact-birthday" style="width:220px;">
						</div>
						<?php
						require ("connection.php");
						$result = $conn->query("select vendor_name from vendors");
						echo("<div class='tabinner-detail' >");
						echo "<label>Vendor</label><select name='vendor' style=width:220px;'>";
						while ($row = $result->fetch_assoc()) {
									  unset($vendor_name);
									  $vendor_name = $row['vendor_name']; 
									  echo '<option value="'.$vendor_name.'">'.$vendor_name.'</option>';
									 
						}
						echo "</select>";
						echo "</div>";
						?>
					</div>
					<div class="newcontacttab-inner">
						<div class="tabinner-detail">
						<label>Checked In (initials)</label>
						<input name="checked_in" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Material</label>
						<input name="material" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Type</label>
						<input name="type" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Quantity</label>
						<input name="quantity" type="text" class="contact-prefix">
						</div>
					</div>
					<div class="newcontacttab-inner">
						<div class="tabinner-detail">
						<label>Height "in"</label>
						<input name="height" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Weight "lbs"</label>
						<input name="weight" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Size "in"</label>
						<input name="size" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Based On</label>
						<input name="based_on" type="text" class="contact-prefix">
						</div>
					</div>
			</div>
					<div class="newcontact-tabbtm">
					<input class="save-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
	
	</div>
</div>