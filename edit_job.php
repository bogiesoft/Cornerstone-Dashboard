<?php
require ("header.php");?>

<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script> 
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
	
	
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();	
		session_start();
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
		
		$sql1 = "SELECT * FROM mail_info WHERE job_id = '$job_id'"; 
		$result1 = mysqli_query($conn,$sql1);
		if ($result1->num_rows > 0) {
			$row1 = $result1->fetch_assoc();	
		
				$mail_class = $row1['mail_class'];
				$rate = $row1['rate'];
				$processing_category = $row1['processing_category'];
				$mail_dim = $row1['mail_dim'];
				$weights_measures = $row1['weights_measures'];
				$permit = $row1['permit'];
				$bmeu = $row1['bmeu'];
				$based_on = $row1['based_on'];
				$non_profit_number = $row1['non_profit_number'];
				
		}
		
		$sql2 = "SELECT * FROM mail_data WHERE job_id = '$job_id'"; 
		$result2 = mysqli_query($conn,$sql2);
		if ($result2->num_rows > 0) {
			$row2 = $result2->fetch_assoc();	
		
				$data_loc = $row2['data_loc'];
				$records_total = $row2['records_total'];
				$domestic = $row2['domestic'];
				$foreigns = $row2['foreigns'];
				$data_source = $row2['data_source'];
				$data_received = $row2['data_received'];
				$data_completed = $row2['data_completed'];
				$processed_by = $row2['processed_by'];
				$dqr_sent = $row2['dqr_sent'];
				$exact = $row2['exact'];
				$mail_foreigns = $row2['mail_foreigns'];
				$household = $row2['household'];
				$ncoa = $row2['ncoa'];

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
				$task1 = $row3['task1'];
				$task2 = $row3['task2'];
				$task3 = $row3['task3'];
		}
		
		$sql4 = "SELECT * FROM blue_sheet WHERE job_id = '$job_id'"; 
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

?>

<div class="content">

			<div id="mydiv">
			
			  
				<form action="update_job.php" method="post">
				<div class="tabinner detail">
				<label>Client Name</label>
				<input name="client_name" type="text" value="<?php echo $client_name ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Job Name</label>
				<input name="project_name" type="text" value="<?php echo $project_name ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Ticket Date</label>
				<input name="ticket_date" type="date" value="<?php echo $ticket_date ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Due Date</label>
				<input name="due_date" type="date" value="<?php echo $due_date ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Created By</label>
				<input name='created_by' type="text" value="<?php echo $created_by ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Estimate Number</label>
				<input name="estimate_number" type="text" value="<?php echo $estimate_number ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Materials Ordered</label>
				<input name="materials_ordered" type="date" value="<?php echo $materials_ordered ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Materials Expected</label>
				<input name="materials_expected" type="date" value="<?php echo $materials_expected ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Expected Quantity</label>
				<input name="expected_quantity" type="text"value="<?php echo $expected_quantity ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Job Status</label>
				<input name="job_status" type="text"value="<?php echo $job_status ; ?>" class="contact-prefix">
				<select name='job_status'>
					<option disabled selected value> -- select an option -- </option>
					<option value="in P.M.">in P.M.</option>
					<option value="in Production">in Production</option>
					<option value="on hold">on hold</option>
					<option value="waiting for materials">waiting for materials</option>
					<option value="waiting for data">waiting for data</option>
					<option value="waiting for postage">waiting for postage</option>
				</select>
				</div>
				
				
				<div class="tabinner detail">
				<label>Mail Class</label>
				<input name="mail_class" type="text" value="<?php echo $mail_class ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Rate</label>
				<input name="rate" type="text" value="<?php echo $rate ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Processing Category</label>
				<input name="processing_category" type="text" value="<?php echo $processing_category ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Mail Dimensions</label>
				<input name="mail_dim" type="text" value="<?php echo $mail_dim ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Weights and Measures</label>
				<input name="weights_measures" type="text" value="<?php echo $weights_measures ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Permit</label>
				<input name="permit" type="text" value="<?php echo $permit ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Bmeu</label>
				<input name="bmeu" type="text" value="<?php echo $bmeu ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Based On</label>
				<input name="based_on" type="text" value="<?php echo $based_on ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Non Profit Number</label>
				<input name="non_profit_number" type="text" value="<?php echo $non_profit_number ; ?>" class="contact-prefix">
				</div>
				
				<div class="tabinner detail">
				<label>Data Location</label>
				<input type="text" name="data_loc" value="<?php echo $data_loc ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Records Total</label>
				<input name="records_total" type="text" value="<?php echo $records_total ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Domestic</label>
				<input name="domestic" type="text" value="<?php echo $domestic; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Foreigns</label>
				<input name="foreigns" type="text" value="<?php echo $foreigns ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Data Source</label>
				<input name="data_source" type="text" value="<?php echo $data_source ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Data Received</label>
				<input name="data_received" type="date" value="<?php echo $data_received ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Data Completed</label>
				<input name="data_completed" type="date" value="<?php echo $data_completed ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Assigned to</label>
				<input name="processed_by" type="text" value="<?php echo $processed_by ; ?>" class="contact-prefix">
				<select name='processed_by'>
					<option disabled selected value> -- select an option -- </option>
					<option value="JS">JS</option>
					<option value="KM">KM</option>
					<option value="MB">MB</option>
					<option value="RP">RP</option>
				</select>
				</div>
				<div class="tabinner detail">
				<label>DQR Sent</label>
				<input name="dqr_sent" type="date" value="<?php echo $dqr_sent ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Exact</label>
				<input name="exact" type="text" value="<?php echo $exact ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Mail Foreigns</label>
				<input name="mail_foreigns" type="text" value="<?php echo $mail_foreigns ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Household</label>
				<input name="household" type="text" value="<?php echo $household ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>NCOA</label>
				<input name="ncoa" type="text" value="<?php echo $ncoa ; ?>" class="contact-prefix">
				</div>
				
				<div class="tabinner detail">
				<label>Hold Postage</label>
				<input type="text" name="hold_postage" value="<?php echo $hold_postage ; ?>" class="contact-prefix" >
				</div>
				<div class="tabinner detail">
				<label>Postage Paid</label>
				<input name="postage_paid" type="text" value="<?php echo $postage_paid ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Print Template</label>
				<input name="print_template" type="text" value="<?php echo $print_template ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Special Address Formatting</label>
				<input name="special_address" type="text" value="<?php echo $special_address ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Method of Delivery</label>
				<input name="delivery" type="text" value="<?php echo $delivery ; ?>" class="contact-prefix">
				</div>
				
				<div class="tabinner detail">
				<label>Tasks</label>
				<input name="tasks" type="text" value="<?php echo $tasks ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Task 1</label>
				<input name="task1" type="text" value="<?php echo $task1 ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Task 2</label>
				<input name="task2" type="text" value="<?php echo $task2 ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Task 3</label>
				<input name="task3" type="text" value="<?php echo $task3 ; ?>" class="contact-prefix">
				</div>
				
				<div class="tabinner detail">
				<label>Completed Date</label>
				<input name="completed_date" type="date" value="<?php echo $completed_date ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Data Hours</label>
				<input name="data_hrs" type="text" value="<?php echo $data_hrs ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Graphic Design Hours</label>
				<input name="gd_hrs" type="text" value="<?php echo $gd_hrs ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Initial Record Count</label>
				<input name="initialrec_count" type="text" value="<?php echo $initialrec_count ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Manual</label>
				<input name="manual" type="text" value="<?php echo $manual ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Uncorrected</label>
				<input name="uncorrected" type="text" value="<?php echo $uncorrected ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Unverifiable</label>
				<input name="unverifiable" type="text" value="<?php echo $unverifiable ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Foreigns</label>
				<input name="bs_foreigns" type="text" value="<?php echo $bs_foreigns ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Exact</label>
				<input name="bs_exact" type="text" value="<?php echo $bs_exact ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Loose</label>
				<input name="loose" type="text" value="<?php echo $loose ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Householded</label>
				<input name="householded" type="text" value="<?php echo $householded ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Basic</label>
				<input name="basic" type="text" value="<?php echo $basic ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>NCOA Errors</label>
				<input name="ncoa_errors" type="text" value="<?php echo $ncoa_errors ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Domestic</label>
				<input name="bs_domestic" type="text" value="<?php echo $bs_domestic ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>NCOA</label>
				<input name="bs_ncoa" type="text" value="<?php echo $bs_ncoa ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner detail">
				<label>Final Count</label>
				<input name="final_count" type="text" value="<?php echo $final_count ; ?>"  class="contact-prefix">
				</div>
				
				<div class="tabinner detail">				
				<label>Special Instructions</label>
				<textarea name="special_instructions" class="contact-prefix" cols="80" rows="25"><?php echo $special_instructions ; ?></textarea>
				</div>
				<div class="form-bottom">
				<input id="btn" type="submit" value="Save" name="submit_form">
				</div>
	</form>

			</div>

<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />
</div>
	
	