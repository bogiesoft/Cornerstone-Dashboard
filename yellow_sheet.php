<?php
require('header.php');
?>

<div class="content">

<form action="update_yellow_sheet.php" method="post">

	<div class="tabinner detail">
	Job ID <input name="job_id" type="text" value="<?php echo $_GET['job_id'] ; ?>" class="contact-prefix">
	</div>			
	<div class="tabinner detail">
	<input type="checkbox" name="1" class="contact-prefix" ><label>Permit is correct</label>
	</div>
	<div class="tabinner detail">
	<input name="2" type="checkbox" class="contact-prefix"><label>Non-profit verified</label>
	</div>
	<div class="tabinner detail">
	<input name="3" type="checkbox" class="contact-prefix"><label>Move Update/NCOA</label>
	</div>
	<div class="tabinner detail">
	<input name="4" type="checkbox" class="contact-prefix"><label>Manual Duplicate review</label>
	</div>
	<div class="tabinner detail">
	<input name="5" type="checkbox" class="contact-prefix"><label>Foreign Address Formatting</label>
	</div>
	<div class="tabinner detail">
	<input name="6" type="checkbox" class="contact-prefix"><label>Blue Sheet Completed</label>
	</div>
	<div class="tabinner detail">
	<input name="7" type="checkbox" class="contact-prefix"><label>Actual Postage verified against Estimate</label>
	</div>
	<div class="tabinner detail">
	<input name="8" type="checkbox" class="contact-prefix"><label>NCOA checked off</label>
	</div>
	<div class="tabinner detail">
	<input name="9" type="checkbox" class="contact-prefix"><label>Save mail.dat</label>
	</div>
	<div class="tabinner detail">
	<input name="10" type="checkbox" class="contact-prefix"><label>Double checked job</label>
	</div>
	<div class="tabinner detail">
	<input name="11" type="checkbox" class="contact-prefix"><label>Update job ticket</label>
	</div>
	<div class="tabinner detail">
	<input name="12" type="checkbox" class="contact-prefix"><label>Are examples printed out?</label>
	</div>
	<div class="tabinner detail">
	<input name="13" type="checkbox" class="contact-prefix"><label>Sign job ticket</label>
	</div>
	<div class="tabinner detail">
	<input name="14" type="checkbox" class="contact-prefix"><label>Manually checked data for errors?</label>
	</div>	
					
				
	<div class="form-bottom">
		<input id="btn" type="submit" value="Save" name="submit_form">
	</div>
</form>

</div>