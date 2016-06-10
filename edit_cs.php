<?php
require ("header.php");
?>
<?php
require ("connection.php");

	$temp=$_GET['job_id'];
	
	$sql = "SELECT * FROM invoice WHERE job_id = '$temp'"; 
	$result = mysqli_query($conn,$sql); 
	
	
	
	if ($result->num_rows > 0) {

		$row = $result->fetch_assoc();	
	

		$job_id = $row["job_id"];
		$postage = $row["postage"];
		$invoice_number = $row["invoice_number"];
		$residual_returned = $row["residual_returned"];
		$week_followup = $row["2week_followup"];
		$notes=$row["notes"];
		$status = $row["status"];
		$reason = $row["reason"];
}

?>
<div class="content">
<form action="update_cs.php" id="form" method="POST">
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Job Id: </label>
					<input name="job_id" type="text" value="<?php echo $job_id; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Postage</label>
					<input name="postage" type="text" value="<?php echo $postage; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Invoice</label>
					<input name="invoice_number" type="text" value="<?php echo $invoice_number; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Residual Retured</label>
					<input name="residual_returned" type="text" value="<?php echo $residual_returned; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Follow up notes</label>
					<input name="2week_followup" type="text" value="<?php echo $week_followup; ?>" class="contact-prefix">
					</div>
				</div>
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Status</label>
					<select name='status'>
					<option disabled selected value> -- select an option -- </option>
					<option value="Finished">Finished</option>
					<option value="Cancelled">Cancelled</option>
					<option value="Closed">Closed</option>
					</select>
					</div>
					<div class="tabinner detail">
					<label>Reason</label>
					<input name="reason" type="text" value="<?php echo $reason; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Notes</label>
					<textarea name="notes" class="contact-notes" ><?php echo $notes; ?></textarea>
					</div>
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form">
				</div>
</form>
</div>
