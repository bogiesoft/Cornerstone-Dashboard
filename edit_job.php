<?php
require ("header.php");
?>
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('height=400,width=600');
        mywindow.document.write('<html><head><title>CRST JOB TICKET</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>


<?php
require ("connection.php");

	
	//$term = mysqli_real_escape_string($conn,$_REQUEST['frmSearch']);
	$temp = $_GET['job_id'];
	// (job_id = '$term') OR
	$sql = "SELECT * FROM job_ticket WHERE job_id = '$temp'"; 
	$result = mysqli_query($conn,$sql); 
	
	$client_name = "";
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();	
		$job_id = $row['job_id'];
		$_SESSION["job_id"] = $job_id;
		$client_name = $row['client_name'];
		$project_name = $row['project_name'];
		$ticket_date = $row['ticket_date'];
		$due_date = $row['due_date'];
		$created_by = $row['created_by'];
		$estimate_number = $row['estimate_number'];
		$special_instructions = $row['special_instructions'];
		$materials_ordered = $row['materials_ordered'];
		$materials_expected = $row['materials_expected'];
		$expected_quantity = $row['expected_quantity'];
		$job_status = $row['job_status'];
		$display = "yes";
		$mail_class = $row['mail_class'];
		$rate = $row['rate'];
		$processing_category = $row['processing_category'];
		$mail_dim = $row['mail_dim'];
		$weights_measures = $row['weights_measures'];
		$permit = $row['permit'];
		$bmeu = $row['bmeu'];
		$based_on = $row['based_on'];
		$non_profit_number = $row['non_profit_number'];
		$processed_by = $row['processed_by'];
		$records_total = $row['records_total'];
				
		
		$sql2 = "SELECT * FROM project_management WHERE job_id = '$job_id'"; 
		$result2 = mysqli_query($conn,$sql2);
		if ($result2->num_rows > 0) {
			$row2 = $result2->fetch_assoc();	
				$data_source = $row2['data_source'];
				$data_received = $row2['data_received'];
				$data_completed = $row2['data_completed'];
				$dqr_sent = $row2['dqr_sent'];

		}
		
		$sql3 = "SELECT * FROM production WHERE job_id = '$job_id'"; 
		$result3 = mysqli_query($conn,$sql3);
		if ($result3->num_rows > 0) {
			$row3 = $result3->fetch_assoc();	
		
				$hold_postage = $row3['hold_postage'];
				$postage_paid = $row3['postage_paid'];
				$print_template = $row3['print_template'];
				$special_address = $row3['special_address'];
				$delivery = $row3['delivery'];
				$tasks = $row3['tasks']; 
		}
		
		$sql4 = "SELECT * FROM customer_service WHERE job_id = '$job_id'"; 
		$result4 = mysqli_query($conn,$sql4);
		if ($result4->num_rows > 0) {
			$row4 = $result4->fetch_assoc();	
		
				$completed_date = $row4['completed_date'];
				$data_hrs = $row4['data_hrs'];
				$gd_hrs = $row4['gd_hrs'];
				$initialrec_count = $row4['initialrec_count'];
				$manual = $row4['manual'];
				$uncorrected = $row4['uncorrected'];
				$unverifiable = $row4['unverifiable'];
				$bs_foreigns = $row4['bs_foreigns'];
				$bs_exact = $row4['bs_exact'];
				$loose = $row4['loose'];
				$householded = $row4['householded'];
				$basic = $row4['basic'];
				$ncoa_errors = $row4['ncoa_errors'];
				$bs_ncoa = $row4['bs_ncoa'];
				$final_count = $row4['final_count'];
				$bs_domestic = $row4['bs_domestic'];
				
				
				
		}
		
    
	} 
	else {
		echo "No results found";
		$display = "no";
	
	}
	
	$select_client = "";
	
	if($client_name != ""){
		
		$sql = "SELECT client_name FROM client_info WHERE client_name = '$client_name'";
		$result = mysqli_query($conn, $sql);
		
		$row = $result->fetch_assoc();
		$select_client = $row['client_name'];
	}
	

?>
<div id="dialog-confirm" title="Empty the recycle bin?">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span> Are you sure you want to delete this?</p>
</div>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Edit Job Ticket</h1>
	<a class="pull-right" href="dashboard.php">Back to Dashboard</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Edit Current Job</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
				<form action="update_job.php" method="post">
				<div class="tabinner-detail">
				<label>Client Name</label>
				<select name = "client_name">
					<?php
						echo "<option selected = 'selected'>" . $select_client . "</option>";
						
						$sql = "SELECT client_name FROM client_info WHERE client_name != '$select_client'";
						$result = mysqli_query($conn, $sql);
						
						while($row = $result->fetch_assoc())
						{
							echo "<option>" . $row['client_name'] . "</option>";
						}
					?>
				</select>
				</div>
				<div class="tabinner-detail">
				<label>Job Name</label>
				<input name="project_name" type="text" value="<?php echo $project_name ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Ticket Date</label>
				<input name="ticket_date" type="date" value="<?php echo $ticket_date ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Due Date</label>
				<input name="due_date" type="date" value="<?php echo $due_date ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Created By</label>
				<?php
					echo "<select name = 'created_by'>";
					$sql = "SELECT first_name, last_name, user FROM users WHERE user = '$created_by'";
					$result = mysqli_query($conn, $sql);
					 if($result->num_rows > 0){
						 $row = $result->fetch_assoc();
						 echo "<option selected = 'selected' value = '" . $row['user'] . "'>" . $row['first_name'] . ' ' . $row['last_name'] . "</option>";
					 }
					 else{
						 echo "<option selected = 'selected'></option>";
					 }
					 
					 $sql = "SELECT first_name, last_name, user FROM users";
					$result = mysqli_query($conn, $sql);
				
					while($row = $result->fetch_assoc()){
						echo "<option value = '" . $row['user'] . "'>" . $row['first_name'] . ' ' . $row['last_name'] . "</option>";
					}
				
					echo "</select>";
				?>
				</div>
				<div class="tabinner-detail">
				<label>Estimate Number</label>
				<input name="estimate_number" type="text" value="<?php echo $estimate_number ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Materials Ordered</label>
				<input name="materials_ordered" type="date" value="<?php echo $materials_ordered ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Materials Expected</label>
				<input name="materials_expected" type="date" value="<?php echo $materials_expected ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Expected Quantity</label>
				<input name="expected_quantity" type="text"value="<?php echo $expected_quantity ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Job Status</label>
				<select name='job_status'>
					<option selected  = "selected"><?php echo $job_status;?></option>
					<option value="in P.M.">in P.M.</option>
					<option value="in Production">in Production</option>
					<option value="on hold">on hold</option>
					<option value="waiting for materials">waiting for materials</option>
					<option value="waiting for data">waiting for data</option>
					<option value="waiting for postage">waiting for postage</option>
				</select>
				</div>
				
				
				<div class="tabinner-detail">
				<label>Mail Class</label>
				<input name="mail_class" type="text" value="<?php echo $mail_class ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Rate</label>
				<input name="rate" type="text" value="<?php echo $rate ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Processing Category</label>
				<input name="processing_category" type="text" value="<?php echo $processing_category ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Mail Dimensions</label>
				<input name="mail_dim" type="text" value="<?php echo $mail_dim ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Weights and Measures</label>
				<input name="weights_measures" type="text" value="<?php echo $weights_measures ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Permit</label>
				<input name="permit" type="text" value="<?php echo $permit ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Bmeu</label>
				<input name="bmeu" type="text" value="<?php echo $bmeu ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Based On</label>
				<input name="based_on" type="text" value="<?php echo $based_on ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Non Profit Number</label>
				<input name="non_profit_number" type="text" value="<?php echo $non_profit_number ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Records Total</label>
				<input name="records_total" type="text" value="<?php echo $records_total ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Data Source</label>
				<input name="data_source" type="text" value="<?php echo $data_source ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Data Received</label>
				<input name="data_received" type="date" value="<?php echo $data_received ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Data Completed</label>
				<input name="data_completed" type="date" value="<?php echo $data_completed ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Assigned to</label>
				<?php
				echo "<select name='processed_by'>";
				$sql1 = "SELECT first_name, last_name, user FROM users WHERE user = '$processed_by'";
				$result = mysqli_query($conn, $sql1);
				if($result->num_rows > 0){
					$row = $result->fetch_assoc();
					echo "<option selected = 'selected' value = '" . $row['user'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>";
				}
				else{
					echo "<option selected = 'selected'></option>";
				}
				
				$sql = "SELECT first_name, last_name, user FROM users";
				$result = mysqli_query($conn, $sql);
				while($row = $result->fetch_assoc()){
						echo "<option value = '" . $row['user'] . "'>" . $row['first_name'] . ' ' .  $row['last_name'] . "</option>";
					
				}
				echo "</select>"
				?>
				<div class="tabinner-detail">
				<label>DQR Sent</label>
				<input name="dqr_sent" type="date" value="<?php echo $dqr_sent ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Hold Postage</label>
				<input type="text" name="hold_postage" value="<?php echo $hold_postage ; ?>" class="contact-prefix" >
				</div>
				<div class="tabinner-detail">
				<label>Postage Paid</label>
				<input name="postage_paid" type="text" value="<?php echo $postage_paid ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Print Template</label>
				<input name="print_template" type="text" value="<?php echo $print_template ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Special Address Formatting</label>
				<input name="special_address" type="text" value="<?php echo $special_address ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Method of Delivery</label>
				<input name="delivery" type="text" value="<?php echo $delivery ; ?>" class="contact-prefix">
				</div>
				
				<div class="tabinner-detail">
				<label>Tasks</label>
				<select name="tasks[]" multiple>
					  <option selected = "selected" value = "<?php echo $tasks;?>"><?php echo $tasks; ?></option>
					  <option value="Mail Merge">Mail Merge</option>
					  <option value="Letter Printing">Letter Printing</option>
					  <option value="In-House Envelope Printing">In-House Envelope Printing</option>
					  <option value="Tabbing">Tabbing</option>
					  <option value="Folding">Folding</option>
					  <option value="Inserting">Inserting</option>
					  <option value="Sealing">Sealing</option>
					  <option value="Collating">Collating</option>
					  <option value="Labeling">Labeling</option>
					  <option value="Print Permit">Print Permit</option>
					  <option value="Correct Permit">Correct Permit</option>
					  <option value="Carrier Route">Carrier Route</option>
					  <option value="Endorsement line">Endorsement line</option>
					  <option value="Address Printing">Address Printing</option>
					  <option value="Tag as Political">Tag as Political</option>
					  <option value="Inkjet Printing">Inkjet Printing</option>
					  <option value="Glue Dots">Glue Dots</option>
					</select>
				</div>
				
				<div class="tabinner-detail">
				<label>Completed Date</label>
				<input name="completed_date" type="date" value="<?php echo $completed_date ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Data Hours</label>
				<input name="data_hrs" type="text" value="<?php echo $data_hrs ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Graphic Design Hours</label>
				<input name="gd_hrs" type="text" value="<?php echo $gd_hrs ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Initial Record Count</label>
				<input name="initialrec_count" type="text" value="<?php echo $initialrec_count ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Manual</label>
				<input name="manual" type="text" value="<?php echo $manual ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Uncorrected</label>
				<input name="uncorrected" type="text" value="<?php echo $uncorrected ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Unverifiable</label>
				<input name="unverifiable" type="text" value="<?php echo $unverifiable ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Foreigns</label>
				<input name="bs_foreigns" type="text" value="<?php echo $bs_foreigns ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Exact</label>
				<input name="bs_exact" type="text" value="<?php echo $bs_exact ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Loose</label>
				<input name="loose" type="text" value="<?php echo $loose ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Householded</label>
				<input name="householded" type="text" value="<?php echo $householded ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Basic</label>
				<input name="basic" type="text" value="<?php echo $basic ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>NCOA Errors</label>
				<input name="ncoa_errors" type="text" value="<?php echo $ncoa_errors ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Domestic</label>
				<input name="bs_domestic" type="text" value="<?php echo $bs_domestic ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>NCOA</label>
				<input name="bs_ncoa" type="text" value="<?php echo $bs_ncoa ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Final Count</label>
				<input name="final_count" type="text" value="<?php echo $final_count ; ?>"  class="contact-prefix">
				</div>
				
				<div class="tabinner-detail">				
				<label>Special Instructions</label>
				<textarea name="special_instructions" class="contact-prefix" cols="80" rows="25"><?php echo $special_instructions ; ?></textarea>
				</div>
				</div>
				<div class="newcontact-tabbtm">
					<input class="save-btn store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					<input class="save-btn delete-btn" type = "submit" value = "Delete" name = "delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
					<input type="button" class="save-btn" value="Print" onclick="PrintElem('.dashboard-cont')" style="width:200px; font-size:16px; background-color:black; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:right"/>
				</div>
			</form>
			</div>
		</div>
	</div>
	</div>
</div>
</div>
	
	