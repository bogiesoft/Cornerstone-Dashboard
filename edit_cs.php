<?php
require ("header.php");
?>
<?php
require ("connection.php");

	$temp=$_GET['job_id'];
	
	$sql = "SELECT * FROM customer_service WHERE job_id = '$temp'"; 
	$result = mysqli_query($conn,$sql); 
	
	
	
	if ($result->num_rows > 0) {

		$row = $result->fetch_assoc();	
	

		$job_id = $row["job_id"];
		$postage = $row["postage"];
		$invoice_number = $row["invoice_number"];
		$invoice_date = $row["invoice_date"];
		$residual_returned = $row["residual_returned"];
		$week_followup = $row["2week_followup"];
		$notes=$row["notes"];
		$status = $row["status"];
		$reason = $row["reason"];
}

?>
<script src="C_SSweetAlert.js"></script>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Edit Invoiced Job</h1>
	<a class="pull-right" href="customer_service.php" >Back to CS</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Invoice & Close</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
<form action="update_cs.php" id="form" method="POST">
				<div class="newcontacttab-inner">
					<div class="tabinner-detail" style = "display: none">
					<label>Job Id: </label>
					<input name="job_id" type="text" value="<?php echo $job_id; ?>" class="contact-prefix">
					</div>
					<div class="tabinner-detail">
					<label>Postage</label>
					<input name="postage" type="text" value="<?php echo $postage; ?>" class="contact-prefix">
					</div>
					<div class="tabinner-detail">
					<label>Invoice</label>
					<input name="invoice_number" type="text" value="<?php echo $invoice_number; ?>" class="contact-prefix">
					</div>
					<div class="tabinner-detail">
					<label>Invoice date</label>
					<input id = "invoice_date" name="invoice_date" type="date" value="<?php echo $invoice_date; ?>" class="contact-prefix">
					</div>
					<div class="tabinner-detail">
					<label>Residual Returned</label>
					<input name="residual_returned" type="text" value="<?php echo $residual_returned; ?>" class="contact-prefix">
					</div>
					<div class="tabinner-detail">
					<label>Follow up notes</label>
					<input name="2week_followup" type="text" value="<?php echo $week_followup; ?>" class="contact-prefix">
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Status</label>
					<select name='status'>
					<option disabled selected value> -- select an option -- </option>
					<option value="Cancelled">Cancelled</option>
					<option value="Closed">Closed</option>
					</select>
					</div>
					<div class="tabinner-detail">
					<label>Reason</label>
					<input name="reason" type="text" value="<?php echo $reason; ?>" class="contact-prefix">
					</div>
					<div class="tabinner-detail">
					<label>Completed Date</label>
					<input id = "completed_date" name="completed_date" type="date" class="contact-prefix">
					</div>
				</div>
				<div class="newcontacttab-inner" >
					<div class="tabinner-detail-notes">
					<label>Notes</label>
					<div class="clear"></div>
					<textarea name="notes"><?php echo $notes; ?></textarea>
					
					</div>
				</div>
			</div>
				<div class="newcontact-tabbtm">
					<input class="save-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					<input class="delete-btn" type = "submit" value = "Delete" name = "delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
<script src="C_SSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
	var date = new Date();
	document.getElementById("invoice_date").valueAsDate = date;
	document.getElementById("completed_date").valueAsDate = date;
</script>