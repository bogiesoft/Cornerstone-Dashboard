<?php
require('header.php');
?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Yellow Sheet</h1>
	<a class="pull-right" href="project_management.php">Back to PM</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Yellow Sheet Options</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
<form action="update_yellow_sheet.php" method="post">
<div class="newcontacttab-inner" style="width:700px;">
	<div class="tabinner-detail">
	<input name="job_id" type="text" value="<?php echo $_GET['job_id'] ; ?>" class="contact-prefix" style="width:150px;">
	<div class="clear"></div>
	</div>			
	<div class="tabinner-detail">
	<label style="width:50%; float:left">Permit is correct</label><input type="checkbox" name="1" class="contact-prefix" style="width:50%; float:right;">
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="2" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Non-profit verified</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="3" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Move Update/NCOA</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="4" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Manual Duplicate review</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="5" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Foreign Address Formatting</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="6" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Blue Sheet Completed</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="7" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Actual Postage verified against Estimate</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="8" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">NCOA checked off</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="9" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Save mail.dat</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="10" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Double checked job</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="11" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Update job ticket</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="12" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Are examples printed out?</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="13" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Sign job ticket</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:50%; float:right" name="14" type="checkbox" class="contact-prefix"><label style="width:50%; float:left">Manually checked data for errors?</label>
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
