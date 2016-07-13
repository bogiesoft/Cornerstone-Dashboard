<?php
require ("header.php");
require ("connection.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Add Reminders</h1>
	<a class="pull-right" href="reminders.php" style="margin-right:20px; background-color:#d14700;">Back to Reminders</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">New Reminder</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<form action="add_reminder.php" method="post">
				<div class="newdoctab-inner">
					<div class="tabinner-detail">
					<label>Occurence</label>
					<select id = "occurence" name = "occurence" onchange = "showInfo();">
					<option selected = 'selected' value = "Once">Once</option>
					<option value = "Weekly">Weekly</option>
					<option value = "Monthly">Monthly</option>
					<option value = "Yearly">Yearly</option>
					</select>
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label id = "date_label">Date</label>
					<input id = "date" name="date" type="date" class="contact-prefix" style="width:95%;">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label id = "day_label" style = "display: none">Day</label>
					<select style = "display: none" id = "day" name = "day">
					<option selected = 'selected' value = "Mon">Monday</option>
					<option value = "Tue">Tuesday</option>
					<option value = "Wed">Wednesday</option>
					<option value = "Thu">Thursday</option>
					<option value = "Fri">Friday</option>
					<option value = "Sat">Saturday</option>
					<option value = "Sun">Sunday</option>
					</select>
					<div class="clear"></div>
					</div>
					<div class = "tabinner-detail">
					<label>Client</label>
					<select name = "client">
					<option selected = 'selected' value = "None">None</option>
					<?php
						$sql = "SELECT client_name FROM client_info";
						$result = mysqli_query($conn, $sql);
						
						while($row = $result->fetch_assoc()){
							echo "<option>" . $row['client_name'] . "</option>";
						}
					?>
					</select>
					<div class = "clear"></div>
					</div>
					<div class = "tabinner-detail">
					<label>Vendor</label>
					<select name = "vendor">
					<option selected = 'selected' value = "None">None</option>
					<?php
						$sql = "SELECT vendor_name FROM vendors";
						$result = mysqli_query($conn, $sql);
						
						while($row = $result->fetch_assoc()){
							echo "<option>" . $row['vendor_name'] . "</option>";
						}
					?>
					</select>
					<div class = "clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Text</label>
					<textarea name="text" style="float:left; width:600px; height:300px;"></textarea>
					<div class="clear"></div>
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
<script>
function showInfo(){
	var currentSel = document.getElementById("occurence").value;
	
	if(currentSel == "Once"){
		document.getElementById("day_label").style.display = "none";
		document.getElementById("day").style.display = "none";
		document.getElementById("date_label").style.display = "block";
		document.getElementById("date").style.display = "block";
	}
	else if(currentSel == "Weekly"){
		document.getElementById("day_label").style.display = "block";
		document.getElementById("day").style.display = "block";
		document.getElementById("date_label").style.display = "none";
		document.getElementById("date").style.display = "none";
	}
	else{
		document.getElementById("day_label").style.display = "none";
		document.getElementById("day").style.display = "none";
		document.getElementById("date_label").style.display = "none";
		document.getElementById("date").style.display = "none";
	}
}
</script>