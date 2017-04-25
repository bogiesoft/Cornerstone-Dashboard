<?php
require ("header.php");
?>
<style>
li {
	list-style-type: none;
}
</style>
<script src="JobTicketSweetAlert.js"></script>
<script type="text/javascript">

    function PrintElem()
    {
	    var mywindow = window.open('height=400,width=600');
        mywindow.document.write('<html><head><title>CRST JOB TICKET</title>');
        mywindow.document.write('</head><body>');
		mywindow.document.write($(".main_headers").html());
		//All needed Values
		mywindow.document.write('<div style = "float: left; width: 21%; padding-right: 5px">');
		var panel= $("#client_info_div");
		var inputs = panel.find("input");
		var labels_client = ["Contact Name", "Phone", "Email", "Address", "City", "State", "Zipcode", "Second Contact", "Fax"];
		for(var i = 0; i < inputs.length; i++){
			mywindow.document.write('<div style = "padding-bottom: 2px"><label><b>' + labels_client[i] + '</b></label><input value = "' + inputs[i].value + '"></div>');
		}
		mywindow.document.write('</div>');
		mywindow.document.write('<div style = "float: left; width: 21%; padding-right: 5px">');
		var labels_wm = ["Non Profit Number", "Mail Class", "Rate", "Processing Category", "Mail Dimensions", "Total W & M"];
		var panel= $("#wm_info_div");
		var inputs = panel.find("input");
		for(var i = 0; i < inputs.length - 1; i++){
			mywindow.document.write('<div style = "padding-bottom: 5px"><label><b>' + labels_wm[i] + '</b></label><input value = "' + inputs[i].value + '"></div>');
		}
		if($("#based_on").val() == 1){
			mywindow.document.write("<div style = 'padding-bottom: 5px'><label><b>Based On</b></label><input value = '" + 0 + "'></div>");
		}
		else{
			mywindow.document.write("<div style = 'padding-bottom: 5px'><label><b>Based On</b></label><input value = '" + $("#based_on").val() + "'></div>");
		}
		mywindow.document.write("<div style = 'padding-bottom: 5px'><label><b>Permit</b></label><input value = '" + $("#permit").val() + "'></div>");
		mywindow.document.write('</div>');
		mywindow.document.write($(".data_info").html());
		mywindow.document.write($(".task_table").html());
		mywindow.document.write($(".blue_sheet_info").html());
		if($("#W_MTable_display tbody").children().length == 0){
			mywindow.document.write('<div class="newclienttab-inner" style = "width: 100%"><div class="tabinner-detail"><table id="W_MTable_display" border="1" cellpadding="1" cellspacing="1" style="text-align: center; vertical-align: middle; table-layout: auto"><thead><tr><th>Vendor</th><th>Material</th><th>type</th><th>Expected Date Received</th></tr></thead><tbody id="W_M_tbody">');
			mywindow.document.write("<tr><td><select style = 'width: 220px'><option>None</option></select></td><td><select style = 'width: 220px'><option>None</option></select></td><td><select style = 'width: 220px'><option>None</option></select></td><td><select style = 'width: 220px'><option>None</option></select></td></tr>");
			mywindow.document.write("</tbody></table></div></div>");
		}
		else{
			mywindow.document.write($(".w_m_table").html());
		}
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
<script>
	var id_of_row;
	var number_of_rows;
	var based_on_ids = [];

	$(function() {
		id_of_row=parseInt($( "tr:last" ).attr('id'));
		number_of_rows=id_of_row;
		if(isNaN(number_of_rows)){
			number_of_rows = 0;
		}
    $(document).on('change', '.vendors',function(){
    	var id=$(this).parent().parent().attr('id');
    	getMaterials(id);
    });
    $(document).on('change', '.materials',function(){
    	var id=$(this).parent().parent().attr('id');
    	getTypes(id);
    });
    $(document).on('change', '.types',function(){
    	var id=$(this).parent().parent().attr('id');
    	getMaterialsID(id);
    });

});
function getMaterialsID(row_id){
        var vendor=$("#vendors"+row_id).val();
        var material = $("#materials"+row_id).val();
		based_on_ids.push(row_id);		
        var type=$("#types"+row_id).val(); 
        $.ajax({
        url: 'getMaterialsID.php',
        type: 'post',
        data:{vendor:vendor,material:material,type:type},
        success: function(data){
			var count_result = 1;
            var result=jQuery.parseJSON(data);
            $.each(result,function( index, value ) {
				if(count_result == 1){
					$("#checkbox"+row_id).attr("value", value);
				}
				else if(count_result == 2){
					$('#based_on').append($('<option>', {value: value, text: value}));
					$('#based_on' + row_id).val(value);
				}
				else if(count_result == 4){
					$('#weight' + row_id).val(value);
				}
				else if(count_result == 5){
					$('#height' + row_id).val(value);
				}
				count_result++
            });
        }
    });
 
};
function addWeights_Measures(){
    if(number_of_rows<20){
        number_of_rows=number_of_rows+1;
        id_of_row=id_of_row+1;
        $("#W_M_tbody").append( "<tr id='"+id_of_row+"'><td >           <input type='checkbox' id='checkbox"+id_of_row+"'checked name='wm[]' value=''>        </td>     <td>          <select class='vendors' id='vendors"+id_of_row+"' name='vendor' style='width:220px;'>             <option value=''>Select</option>            </select>     </td>     <td>          <select class='materials' id='materials"+id_of_row+"' name='material' style='width:220px;'>               <option value=''>Select</option>            </select>     </td>     <td>          <select class='types' id='types"+id_of_row+"' name='vendor' style='width:220px;'>             <option value=''>Select</option>            </select>     </td><td><input type = 'text' id = 'weight" + id_of_row + "' readonly></td><td><input type = 'text' id = 'height" + id_of_row + "' readonly></td><td><input type = 'text' id = 'based_on" + id_of_row + "' readonly></td><td><input type = 'date' name = 'expected_date" + number_of_rows + "'></input> </td><td><input type = 'checkbox' name = 'crst_pickup" + number_of_rows + "'></input></td><td><input type = 'text' name = 'initial" + number_of_rows + "'></input></td><td><input name = 'location" + number_of_rows + "' type = 'text'></td> <td><img src = 'images/x_button.png' width = '25' height = '25' onclick = removeWeights_Measures('#" + id_of_row + "')></td>  </tr>");
        getVendors(id_of_row);
 
    }
};
function removeWeights_Measures(row_id){
	 $(row_id).remove()
	var based_on = parseFloat($("#based_on").val());
	var index = based_on_ids.indexOf(row_id);
	based_on_ids.splice(index, 1);
	var weight = 0;
	var height = 0;
	for(var i = 0; i < based_on_ids.length; i++){
		weight += parseFloat($("#weight" + based_on_ids[i]).val()) / parseFloat($("#based_on" + based_on_ids[i]).val()) * based_on;
		height += parseFloat($("#height" + based_on_ids[i]).val()) / parseFloat($("#based_on" + based_on_ids[i]).val()) * based_on;
	}
    number_of_rows--;
	weight = weight.toFixed(2);
	height = height.toFixed(2);
	$("#total_w_m").val(weight + " x " + height);
};
function getVendors(row_id)
{
    $.ajax({
        url: 'getVendors.php',
        type: 'post',
        success: function(data){
        	$("#materials"+row_id).children().remove();
        	$("#materials"+row_id).append("<option value='default'>Select</option>");
        	$("#types"+row_id).children().remove();
        	$("#types"+row_id).append("<option value='default'>Select</option>");
        	var result=jQuery.parseJSON(data);
        	$.each(result,function( index, value ) {
				$("#vendors"+row_id).append('<option value="'+value+'">'+value+'</option>');
			});
    	}
    });

};
function getMaterials(row_id)
{
   var vendor = $("#vendors"+row_id).val(); 
    $.ajax({
        url: 'getMaterials.php',
        type: 'post',
        data: {
            vendor: vendor
        },
        success: function(data){
        	$("#materials"+row_id).children().remove();
        	$("#materials"+row_id).append("<option value='default'>Select</option>");
        	$("#types"+row_id).children().remove();
        	$("#types"+row_id).append("<option value='default'>Select</option>");
        	var result=jQuery.parseJSON(data);
        	$.each(result,function( index, value ) {
				$("#materials"+row_id).append('<option value="'+value+'">'+value+'</option>');
			});
    	}
    });
};

function getTypes(row_id)
{
	var vendor=$("#vendors"+row_id).val();
    var material = $("#materials"+row_id).val(); 
    $.ajax({
        url: 'getTypes.php',
        type: 'post',
        data: {
            vendor: vendor,
            material:material
        },
        success: function(data){
        	$("#types"+row_id).children().remove();
        	$("#types"+row_id).append("<option value='default'>Select</option>");
        	var result=jQuery.parseJSON(data);
        	$.each(result,function( index, value ) {
				$("#types"+row_id).append('<option value="'+value+'">'+value+'</option>');
			});
    	}
    });
};
function addTotalWM()
{
	var based_on = parseFloat($("#based_on").val());
	var weight = 0;
	var height = 0;
	for(var i = 0; i < based_on_ids.length; i++){
		weight += parseFloat($("#weight" + based_on_ids[i]).val()) / parseFloat($("#based_on" + based_on_ids[i]).val()) * based_on;
		height += parseFloat($("#height" + based_on_ids[i]).val()) / parseFloat($("#based_on" + based_on_ids[i]).val()) * based_on;
	}
	weight = weight.toFixed(2);
	height = height.toFixed(2);
	$("#total_w_m").val(weight + " x " + height);
}
function showJobInfo(){
		document.getElementById("job_info").style.display = "block";
		document.getElementById("special_instructions").style.display = "none";
};
	function showSP(){
		document.getElementById("job_info").style.display = "none";
		document.getElementById("special_instructions").style.display = "block";
};
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
		$estimate_date = $row['estimate_date'];
		$estimate_created_by = $row['estimate_created_by'];
		$special_instructions = $row['special_instructions'];
		$materials_ordered = $row['materials_ordered'];
		$materials_expected = $row['materials_expected'];
		$expected_quantity = $row['expected_quantity'];
		$job_status = $row['job_status'];
		$non_profit_number = $row["non_profit_number"];
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
		$_SESSION["current_records_total"] = $records_total;
		$_SESSION["old_wm"] = $weights_measures;		
		
		$sql2 = "SELECT * FROM project_management WHERE job_id = '$job_id'"; 
		$result2 = mysqli_query($conn,$sql2);
		if ($result2->num_rows > 0) {
			$row2 = $result2->fetch_assoc();	
				$data_source = $row2['data_source'];
				$data_received = $row2['data_received'];
				$data_completed = $row2['data_completed'];
				$dqr_sent = $row2['dqr_sent'];
				$data_location = $row2["data_location"];
				$data_processed_by = $row2["data_processed_by"];

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
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showJobInfo()'>Edit Current Job</a></li>
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showSP()'>Special Instructions</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail" id="job_info" style = 'display:block;'>
			<form action="update_job.php" method="post">
			 <div class="newclienttab-inner">
				<table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
						<tbody>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Client</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Job Name</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Due Date</th></tr></thead><tbody>
							<tr><td><input style = "width: 75%" id = "client_name" name="client_name" type="text" value="<?php echo $client_name ; ?>" class="contact-prefix"></td><td><input style = "width: 75%" name="project_name" type="text" value="<?php echo $project_name ; ?>" class="contact-prefix"></td><td><input style = "width: 75%" name="due_date" type="date" value="<?php echo $due_date ; ?>" class="contact-prefix"></td></tr>
						</tbody></table></td></tr></tbody></table>
                    <div class="tabinner-detail">
					<ul class = "client_search_results">
					</ul>
                    </div>
			</div>
			<div class="newclienttab-inner" id = "client_info_div" style = "float: left; width: 31%">
                    <div class="tabinner-detail">
                    <label>Contact Name</label>
                    <input id = "contact_name" name="contact_name" type="text" class="contact-prefix" readonly>
                    </div>
					<div class="tabinner-detail">
                    <label>Phone</label>
                    <input id = "phone" name="phone" type="text" class="contact-prefix" readonly>
                    </div>
					<div class="tabinner-detail">
                    <label>Email</label>
                    <input id = "email" name="email" type="text" class="contact-prefix" readonly>
                    </div>
					<div class="tabinner-detail">
                    <label>Address</label>
                    <input id = "address_line_1" name="address" type="text" class="contact-prefix" readonly>
                    </div>
					<div class="tabinner-detail">
                    <label>City</label><input id = "city" style = "width: 20%" name="city" type="text" class="contact-prefix" readonly><label>State</label><input id = "state" style = "width: 20%" name="state" type="text" class="contact-prefix" readonly><label>Zip</label><input id = "zipcode" style = "width: 20%" name="zip" type="text" class="contact-prefix" readonly>
                    </div>
					<div class="tabinner-detail">
                    <label>Second Contact</label>
                    <input id = "second_contact" name="second_contact" type="text" class="contact-prefix" readonly>
                    </div>
					<div class="tabinner-detail">
                    <label>Fax</label>
                    <input id = "fax" name="fax" type="text" class="contact-prefix" readonly>
                    </div>
			</div>
			<div id = "wm_info_div" class="newclienttab-inner" style = "float: left; width: 31%">
				<div class="tabinner-detail">
                <label>Non Profit Number</label>
                <input name="non_profit_number" type="text" class="contact-prefix" value="<?php echo $non_profit_number ; ?>">
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
				<input id = "mail_dimensions" name="mail_dim" type="text" value="<?php echo $mail_dim ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
                <label>Total Weights and Measures</label>
                <input id="total_w_m" name="total_w_m" type="text" class="contact-prefix" readonly>
                </div>
				<div class="tabinner-detail">
				<label>Based On</label>
				<select id = "based_on" name = "based_on" onchange = "addTotalWM()">
				<?php
				if($based_on == 0){
					echo '<option selected = "selected" value = "1"><?php echo $based_on ; ?></option>';
				}
				else{
					echo "<option selected = 'selected' value = '$based_on'>$based_on</option>";
				}
				?>
				</select>
				</div>
				<div class="tabinner-detail">
				<label>Permit</label>
				<input id = "permit" name="permit" type="text" value="<?php echo $permit ; ?>" class="contact-prefix">
				</div>
			</div>
			<div class="newclienttab-inner" style = "float: left; width: 31%">
				<div class="tabinner-detail">
				<label>Records Total</label>
				<input name="records_total" type="text" value="<?php echo $records_total ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
                <label>Data Location</label>
                <textarea style = "height: 10%" name="data_location" type="text" class="contact-prefix"><?php echo $data_location ; ?></textarea>
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
                    <label>Processed By</label>
                     <select name="data_processed_by">
                    <?php
						$result_current_name = mysqli_query($conn, "SELECT * FROM users WHERE user = '$data_processed_by'");
						$row_name = $result_current_name->fetch_assoc();
						echo "<option selected = 'selected' value = '" . $data_processed_by . "'>" . $row_name['first_name'] . " " . $row_name['last_name'] . "</option>"; 
                        $result = mysqli_query($conn, "SELECT * FROM users");
                        $count = 1;
                        while($row = $result->fetch_assoc()){
                                echo "<option value = '" . $row['user'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>"; 
						}
                        
                    ?>
                    </select>
                    </div>
			</div>
			<div id = "task_table" class="newclienttab-inner" style = "float: left; width: 40%">
			<div class="tabinner-detail">
					<table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
						<tbody>
							<tr valign='top'><td colspan='2'><table id = 'tasks' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Check</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Task</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Special</th></tr></thead><tbody>
							<?php
							$entire_task = array("Mail Merge","Letter Printing", "In-House Envelope Printing", "Tabbing","Folding","Inserting","Sealing","Collating","Labeling","Print Permit","Correct Permit","Carrier Route","Endorsement line","Address Printing","Tag as Political","Inkjet Printing","Glue Dots");
							$task_array = explode(",", $tasks);
							for($i = 0;$i<count($entire_task);$i++){
								$found_task = FALSE;
								//checks for special tasks checked off and then tasks with no special instructions
								for($ii = 0; $ii<count($task_array); $ii++){
									if(strpos($task_array[$ii], "^") !== FALSE){
										$task_array_2 = explode("^", $task_array[$ii]);
										if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Mail Merge"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_mail_merge'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Letter Printing"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_letter_printing'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'From PDF'>From PDF</option><option value = 'Inkjet'>Inkjet</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Tabbing"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_tabbing'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual Single'>Manual Single</option><option value = 'Manual Double'>Manual Double</option><option value = 'Auto Single'>Auto Single</option><option value = 'Auto Double'>Auto Double</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Folding"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_folding'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Inserting"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_inserting'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Sealing"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_sealing'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Collating"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_collating'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option><option value = 'Man. and Auto'>Man. and Auto</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Inkjet Printing"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_inkjet_printing'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = '26K'>26K</option><option value = '11K'>11K</option></select></td></tr>";
										}
									}
									else if(in_array($entire_task[$i], $task_array) && $found_task == FALSE)
									{
										$found_task = TRUE;
										echo '<tr><td><input type = "checkbox" name = "tasks[]" value="'.$entire_task[$i].'" checked/></td><td><label>'.$entire_task[$i].'</label></td><td></td></tr>';
									}
								}
								
								if($found_task == FALSE){
									$job = $entire_task[$i];
									if($i == 0){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Mail Merge"/></td><td><label>Mail Merge</label></td><td><select name = "special_mail_merge"><option select = "selected" value = "Sent to Vendor">Sent to Vendor</option><option value = "In-House">In-House</option></select></td></tr>';
									}
									else if($i == 1){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Letter Printing"/></td><td><label>Letter Printing</label></td><td><select name = "special_letter_printing"><option select = "selected" value = "From PDF">From PDF</option><option value = "Inkjet">Inkjet</option></select></td></tr>';
									}
									else if($i == 3){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Tabbing"/></td><td><label>Tabbing</label></td><td><select name = "special_tabbing"><option select = "selected" value = "Manual Single">Manual Single</option><option value = "Manual Double">Manual Double</option><option value = "Auto Single">Auto Single</option><option value = "Auto Double">Auto Double</option></select></td></tr>';
									}
									else if($i == 4 || $i == 5 || $i == 6){
										$job_lowercase = strtolower($job);
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "' . $job . '"/></td><td><label>' . $job . '</label></td><td><select name = "special_' . $job_lowercase . '"><option select = "selected" value = "Manual">Manual</option><option value = "Auto">Auto</option></select></td></tr>';
									}
									else if($i == 7){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Collating"/></td><td><label>Collating</label></td><td><select name = "special_collating"><option select = "selected" value = "Manual">Manual</option><option value = "Auto">Auto</option><option value = "Man. and Auto">Man. and Auto</option></select></td></tr>';
									}
									else if($i == 15){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Inkjet Printing"/></td><td><label>Inkjet Printing</label></td><td><select name = "special_inkjet_printing"><option select = "selected" value = "26K">26K</option><option value = "11K">11K</option></select></td></tr>';
									}
									else{
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "' . $job . '"/></td><td><label>' . $job . '</label></td><td></td></tr>';
									}
								}
							}
							?>
						</tbody></table></td></tr></tbody></table>
					</div>
			</div>
			<div class="newclienttab-inner" style = "float: right; width: 55%">
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
				<label>DQR Sent</label>
				<input name="dqr_sent" type="date" value="<?php echo $dqr_sent ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Bmeu</label>
				<input name="bmeu" type="text" value="<?php echo $bmeu ; ?>" class="contact-prefix">
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
			</div>
			<div class="newclienttab-inner" style = "float: right; width: 33%; clear: left">
				<div class="tabinner-detail">
				<label>Estimate Number</label>
				<input name="estimate_number" type="text" value="<?php echo $estimate_number ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Estimate date</label>
				<input name="estimate_date" type="date" value="<?php echo $estimate_date ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label>Estimate created by</label>
				<select name="estimate_created_by">
					<?php
						$result = mysqli_query($conn, "SELECT * FROM users");
						$result_selected = mysqli_query($conn, "SELECT * FROM users WHERE user = '$estimate_created_by'");
						if(mysqli_num_rows($result_selected) > 0){
							$row_selected = $result_selected->fetch_assoc();
							$name = $row_selected["first_name"] . " " . $row["last_name"];
							echo "<option selected = 'selected' value = '" . $estimate_created_by . "'>" . $name . "</option>";
						}
						else{
							echo "<option selected = 'selected' value = ''></option>";
						}
						while($row = $result->fetch_assoc()){
							echo "<option value = '" . $row['user'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>"; 
						}
					?>
					</select>
				</div>
			</div>
			<div class="newclienttab-inner" style = "float: left; width: 33%">
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
				<label>Ticket Date</label>
				<input name="ticket_date" type="date" value="<?php echo $ticket_date ; ?>" class="contact-prefix">
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
			</div>
			<div class="newclienttab-inner" style = "float: left; width: 33%">
				<div class="tabinner-detail">
				<label>Completed Date</label>
				<input name="completed_date" type="date" value="<?php echo $completed_date ; ?>" class="contact-prefix">
				</div>
			</div>
			<div class="newclienttab-inner" style = "float: left; width: 33%">
				<div class="tabinner-detail">
				<label>Hold Postage</label>
				<?php
				if($hold_postage == "yes"){
					echo '<input type="checkbox" name="hold_postage" class="contact-prefix" checked>';
				}
				else{
					echo '<input type="checkbox" name="hold_postage" class="contact-prefix" checked>';
				}
				?>
				</div>
				<div class="tabinner-detail">
				<label>Postage Paid</label>
				<?php
				if($postage_paid == "yes"){
					echo '<input type="checkbox" name="postage_paid" class="contact-prefix" checked>';
				}
				else{
					echo '<input type="checkbox" name="postage_paid" class="contact-prefix">';
				}
				?>
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
			</div>
			<div class="newclienttab-inner" style = "width: 100%">
				<div class="tabinner-detail">
				<label>Weights and Measures</label>
				<a class="pull-right" onclick = 'addWeights_Measures()'>Add Weights and Measures</a>
					<table id="W_MTable" border="1" cellpadding="1" cellspacing="1" style='text-align: center; vertical-align: middle;'>
					<thead>
						<tr>
					        <th>Select</th><th>Vendor</th><th>Material</th><th>type</th><th>Weight</th><th>Height</th><th>Based On</th><th>Expected Date Received</th><th>CRST Pickup</th><th>Initial</th><th>Location</th><th>Delete</th>
					    </tr>
					</thead>
					<tbody id="W_M_tbody">
					<?php
						$result_wm = mysqli_query($conn, "SELECT weights_measures FROM job_ticket WHERE job_id = '$job_id'");
						$row_wm = "";
						$num_rows = mysqli_num_rows($result_wm);
						if($num_rows > 0){
							$row_wm = $result_wm->fetch_assoc();
						}
						
						$materials_array = array();
						
						if($row_wm != ""){
							$materials_array = explode(",", $row_wm['weights_measures']);
						}
						for($i = 0; $i < count($materials_array); $i++){
							$material_id = $materials_array[$i];
							$result_production_receipt = mysqli_query($conn, "SELECT * FROM production_receipts WHERE job_id = '$temp' AND wm_id = '$material_id'");
							$row_pr = $result_production_receipt->fetch_assoc();
							$result_wm = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$material_id'");
							
							$expected_date = $row_pr["date_expected"];
							$crst_pickup = $row_pr["crst_pickup"];
							$initial = $row_pr["initial"];
							$location = $row_pr["location"];
							
							if(mysqli_num_rows($result_wm) > 0){
								$row = $result_wm->fetch_assoc();
								echo "<tr id='".($i+1)."'>
								        <td ><input type='checkbox' id='checkbox".$i."' checked name='wm[]' value='" . $row['material_id'] . "'></td>
								        <td><select class='vendors' id='vendors1' name='vendor' style='width:220px;'><option value='default'>" . $row['vendor'] . "</option></select>
										</td>
								        <td><select class='materials' id='materials1' name='vendor' style='width:220px;'><option value='default'>" . $row['material'] . "</option></select>
										</td>
								       	<td>
											<select class='types' id='types1' name='vendor' style='width:220px;'><option value='default'>" . $row['type'] . "</option></select>
										</td>
										<td>
											<input type = 'text' id = 'weight" . ($i + 1) . "' value = '" . $row['weight'] . "' readonly></input>
										</td>
										<td>
											<input type = 'text' id = 'height" . ($i + 1) . "' value = '" . $row['height'] . "' readonly></input>
										</td>
										<td>
											<input type = 'text' id = 'based_on" . ($i + 1) . "' value = '" . $row['based_on'] . "' readonly></input>
										</td>
										<td>
											<input type = 'date' name = 'expected_date" . ($i + 1) . "' value = '$expected_date'></input>
										</td>";
										if($crst_pickup == 1){
											echo "<td>
												<input type = 'checkbox' name = 'crst_pickup" . ($i + 1) . "' checked = '$crst_pickup'></input>
											</td>";
										}
										else{
											echo "<td>
												<input type = 'checkbox' name = 'crst_pickup" . ($i + 1) . "'></input>
											</td>";
										}
										echo "<td>
											<input type = 'text' name = 'initial" . ($i + 1) . "' value = '$initial'></input>
										</td>
										<td>
											<input type = 'text' name = 'location" . ($i + 1) . "' value = '$location'></input>
										</td>
										<td><img src = 'images/x_button.png' width = '25' height = '25' onclick = removeWeights_Measures('#" . ($i+1) . "')></td>
								    </tr>";
							}
					}
					?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
			<div class="newcontactstab-detail" id="special_instructions" style = 'display:none;'>
				<div class="tabinner-detail">				
				<label>Special Instructions</label>
				<textarea name="special_instructions" class="contact-prefix" cols="80" rows="25"><?php echo $special_instructions; ?></textarea>
				</div>
			</div>
				<div class="newcontact-tabbtm">
					<input class="save-btn store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					<input class="save-btn delete-btn" type = "submit" value = "Delete" name = "delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
					<input type="button" class="save-btn" value="Print" onclick="PrintElem()" style="width:200px; font-size:16px; background-color:black; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:right"/>
				</div>
			</form>
			</div>
		</div>
	</div>
	</div>
</div>
</div>
<script>
$( document ).ready(function() {
	var count = 1;
	var id = "";
	while(document.getElementById("checkbox" + (count - 1))){ 
		based_on_ids.push(count);
		count++;
	}
    var value = document.getElementById("client_name").value;
	$.ajax({
    type: "POST",
    url: "generate_client_search.php",
    data: {id_name_info: value},
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data_info) {
			$(".client_search_results").empty();
			$("#contact_name").val(data_info[0]);
			$("#contact_name2").val(data_info[0]);
			$("#phone").val(data_info[1]);
			$("#email").val(data_info[2]);
			$("#address_line_1").val(data_info[3]);
			$("#city").val(data_info[4]);
			$("#state").val(data_info[5]);
			$("#zipcode").val(data_info[6]);
			$("#second_contact").val(data_info[7]);
			$("#fax").val(data_info[8]);
    }
});
	var based_on = parseFloat($("#based_on").val());
	var weight = 0;
	var height = 0;
	for(var i = 0; i < based_on_ids.length; i++){
		weight += parseFloat($("#weight" + based_on_ids[i]).val()) / parseFloat($("#based_on" + based_on_ids[i]).val()) * based_on;
		height += parseFloat($("#height" + based_on_ids[i]).val()) / parseFloat($("#based_on" + based_on_ids[i]).val()) * based_on;
		$('#based_on').append($('<option>', {value: $("#based_on" + based_on_ids[i]).val(), text: $("#based_on" + based_on_ids[i]).val()}));
		
	}
	weight = weight.toFixed(2);
	height = height.toFixed(2);
	$("#total_w_m").val(weight + " x " + height);
});
document.getElementById("client_name").onkeyup = function(){
	var value = document.getElementById("client_name").value;
	$.ajax({
    type: "POST",
    url: "generate_client_search.php",
    data: {id_name: value},
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
		$(".client_search_results").empty();
		for(var i = 0; i < data.length; i++){
			$(".client_search_results").append("<li class = 'client_search_item' onclick = 'fillInput(\"" + data[i] + "\")'>" + data[i] + "</li>");
			if(value == ""){
				$(".client_search_results").empty();
			}
		}
    }
});
};
function fillInput(info){
	$("#client_name").val(info);
	$.ajax({
    type: "POST",
    url: "generate_client_search.php",
    data: {id_name_info: info},
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data_info) {
			$(".client_search_results").empty();
			$("#contact_name").val(data_info[0]);
			$("#phone").val(data_info[1]);
			$("#email").val(data_info[2]);
			$("#address_line_1").val(data_info[3]);
			$("#city").val(data_info[4]);
			$("#state").val(data_info[5]);
			$("#zipcode").val(data_info[6]);
			$("#second_contact").val(data_info[7]);
			$("#fax").val(data_info[8]);
		}
});
$(".client_search_results").empty();
}
</script>
<!--These are extra divs for the printing portion of the job ticket-->
<canvas class = "main_headers" style = "display: none">
 <div class="newclienttab-inner">
				<table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
						<tbody>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'><h2>Client</h2></th><th class='maintable-thtwo data-header' data-name='material' data-index='6'><h2>Job Name</h2></th><th class='maintable-thtwo data-header' data-name='type' data-index='7'><h2>Due Date</h2></th></tr></thead><tbody>
							<tr><td><input style = "width: 100%" id = "client_name" name="client_name" type="text" value="<?php echo $client_name ; ?>" class="contact-prefix"></td><td><input style = "width: 100%" name="project_name" type="text" value="<?php echo $project_name ; ?>" class="contact-prefix"></td><td><input style = "width: 100%" name="due_date" type="date" value="<?php echo $due_date ; ?>" class="contact-prefix"></td></tr>
						</tbody></table></td></tr></tbody></table>
                    <div class="tabinner-detail">
					<ul class = "client_search_results">
					</ul>
                    </div>
			</div>
</canvas>
<canvas class = "data_info" style = "display: none">
<div class="newclienttab-inner" style = "float: left; width: 25%; padding-right: 5px">
				<div style = 'padding-bottom: 5px'>
				<label><b>Records Total</b></label>
				<input name="records_total" type="text" value="<?php echo $records_total ; ?>" class="contact-prefix">
				</div>
				<div style = 'padding-bottom: 5px'>
                <label><b>Data Location</b></label>
                <textarea style = "height: 10%" name="data_location" type="text" class="contact-prefix"><?php echo $data_location ; ?></textarea>
                </div>
				<div style = 'padding-bottom: 5px'>
				<label><b>Data Source</b></label>
				<input name="data_source" type="text" value="<?php echo $data_source ; ?>" class="contact-prefix">
				</div>
				<div style = 'padding-bottom: 5px'>
				<label><b>Data Received</b></label>
				<input name="data_received" type="date" value="<?php echo $data_received ; ?>" class="contact-prefix">
				</div>
				<div style = 'padding-bottom: 5px'>
				<label><b>Data Completed</b></label>
				<input name="data_completed" type="date" value="<?php echo $data_completed ; ?>" class="contact-prefix">
				</div>
				<div style = 'padding-bottom: 5px'>
                    <label><b>Processed By</b></label>
                     <select name="data_processed_by">
                    <?php
						$result_current_name = mysqli_query($conn, "SELECT * FROM users WHERE user = '$data_processed_by'");
						$row_name = $result_current_name->fetch_assoc();
						echo "<option selected = 'selected' value = '" . $data_processed_by . "'>" . $row_name['first_name'] . " " . $row_name['last_name'] . "</option>"; 
                        $result = mysqli_query($conn, "SELECT * FROM users");
                        $count = 1;
                        while($row = $result->fetch_assoc()){
                                echo "<option value = '" . $row['user'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>"; 
						}
                        
                    ?>
                    </select>
                    </div>
			</div>
</canvas>
<canvas class = "task_table" style = "display: none">
<div id = "task_table" class="newclienttab-inner" style = "float: left; width: 40%; clear: left; padding-right: 15px">
			<div class="tabinner-detail">
					<table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' style = "border: 1px solid black;">
						<tbody>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Check</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Task</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Special</th></tr></thead><tbody>
							<?php
							$entire_task = array("Mail Merge","Letter Printing", "In-House Envelope Printing", "Tabbing","Folding","Inserting","Sealing","Collating","Labeling","Print Permit","Correct Permit","Carrier Route","Endorsement line","Address Printing","Tag as Political","Inkjet Printing","Glue Dots");
							$task_array = explode(",", $tasks);
							for($i = 0;$i<count($entire_task);$i++){
								$found_task = FALSE;
								//checks for special tasks checked off and then tasks with no special instructions
								for($ii = 0; $ii<count($task_array); $ii++){
									if(strpos($task_array[$ii], "^") !== FALSE){
										$task_array_2 = explode("^", $task_array[$ii]);
										if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Mail Merge"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_mail_merge'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Letter Printing"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_letter_printing'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'From PDF'>From PDF</option><option value = 'Inkjet'>Inkjet</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Tabbing"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_tabbing'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual Single'>Manual Single</option><option value = 'Manual Double'>Manual Double</option><option value = 'Auto Single'>Auto Single</option><option value = 'Auto Double'>Auto Double</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Folding"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_folding'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Inserting"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_inserting'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Sealing"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_sealing'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Collating"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_collating'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option><option value = 'Man. and Auto'>Man. and Auto</option></select></td></tr>";
										}
										else if(in_array($entire_task[$i], $task_array_2) && $task_array_2[0] == "Inkjet Printing"){
											$found_task = TRUE;
											echo "<tr><td><input type = 'checkbox' name = 'tasks[]' value='".$entire_task[$i]."' checked/></td><td><label>".$entire_task[$i]."</label></td><td><select name = 'special_inkjet_printing'><option select = 'selected' value = '" . $task_array_2[1] . "'>" . $task_array_2[1] . "</option><option value = '26K'>26K</option><option value = '11K'>11K</option></select></td></tr>";
										}
									}
									else if(in_array($entire_task[$i], $task_array) && $found_task == FALSE)
									{
										$found_task = TRUE;
										echo '<tr><td><input type = "checkbox" name = "tasks[]" value="'.$entire_task[$i].'" checked/></td><td><label>'.$entire_task[$i].'</label></td><td></td></tr>';
									}
								}
								
								if($found_task == FALSE){
									$job = $entire_task[$i];
									if($i == 0){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Mail Merge"/></td><td><label>Mail Merge</label></td><td><select name = "special_mail_merge"><option select = "selected" value = "Sent to Vendor">Sent to Vendor</option><option value = "In-House">In-House</option></select></td></tr>';
									}
									else if($i == 1){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Letter Printing"/></td><td><label>Letter Printing</label></td><td><select name = "special_letter_printing"><option select = "selected" value = "From PDF">From PDF</option><option value = "Inkjet">Inkjet</option></select></td></tr>';
									}
									else if($i == 3){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Tabbing"/></td><td><label>Tabbing</label></td><td><select name = "special_tabbing"><option select = "selected" value = "Manual Single">Manual Single</option><option value = "Manual Double">Manual Double</option><option value = "Auto Single">Auto Single</option><option value = "Auto Double">Auto Double</option></select></td></tr>';
									}
									else if($i == 4 || $i == 5 || $i == 6){
										$job_lowercase = strtolower($job);
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "' . $job . '"/></td><td><label>' . $job . '</label></td><td><select name = "special_' . $job_lowercase . '"><option select = "selected" value = "Manual">Manual</option><option value = "Auto">Auto</option></select></td></tr>';
									}
									else if($i == 7){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Collating"/></td><td><label>Collating</label></td><td><select name = "special_collating"><option select = "selected" value = "Manual">Manual</option><option value = "Auto">Auto</option><option value = "Man. and Auto">Man. and Auto</option></select></td></tr>';
									}
									else if($i == 15){
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "Inkjet Printing"/></td><td><label>Inkjet Printing</label></td><td><select name = "special_inkjet_printing"><option select = "selected" value = "26K">26K</option><option value = "11K">11K</option></select></td></tr>';
									}
									else{
										echo '<tr><td><input type="checkbox" name = "tasks[]" value = "' . $job . '"/></td><td><label>' . $job . '</label></td><td></td></tr>';
									}
								}
							}
							?>
						</tbody></table></td></tr></tbody></table>
					</div>
			</div>
</canvas>
<canvas class = "blue_sheet_info" style = "display: none">
<div class="newclienttab-inner" style = "width: 23%; float: left">
				<div class="tabinner-detail">
				<label><b>Data Hours</b></label>
				<input name="data_hrs" type="text" value="<?php echo $data_hrs ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Graphic Design Hours</b></label>
				<input name="gd_hrs" type="text" value="<?php echo $gd_hrs ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Initial Record Count</b></label>
				<input name="initialrec_count" type="text" value="<?php echo $initialrec_count ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Manual</b></label>
				<input name="manual" type="text" value="<?php echo $manual ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Uncorrected</b></label>
				<input name="uncorrected" type="text" value="<?php echo $uncorrected ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Unverifiable</b></label>
				<input name="unverifiable" type="text" value="<?php echo $unverifiable ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Foreigns</b></label>
				<input name="bs_foreigns" type="text" value="<?php echo $bs_foreigns ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Exact</b></label>
				<input name="bs_exact" type="text" value="<?php echo $bs_exact ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Loose</b></label>
				<input name="loose" type="text" value="<?php echo $loose ; ?>"  class="contact-prefix">
				</div>
</div>
<div class="newclienttab-inner" style = "width: 23%; float: left">
				<div class="tabinner-detail">
				<label><b>Householded</b></label>
				<input name="householded" type="text" value="<?php echo $householded ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Basic</b></label>
				<input name="basic" type="text" value="<?php echo $basic ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>DQR Sent</b></label>
				<input name="dqr_sent" type="date" value="<?php echo $dqr_sent ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Bmeu</b></label>
				<input name="bmeu" type="text" value="<?php echo $bmeu ; ?>" class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>NCOA Errors</b></label>
				<input name="ncoa_errors" type="text" value="<?php echo $ncoa_errors ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Domestic</b></label>
				<input name="bs_domestic" type="text" value="<?php echo $bs_domestic ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>NCOA</b></label>
				<input name="bs_ncoa" type="text" value="<?php echo $bs_ncoa ; ?>"  class="contact-prefix">
				</div>
				<div class="tabinner-detail">
				<label><b>Final Count</b></label>
				<input name="final_count" type="text" value="<?php echo $final_count ; ?>"  class="contact-prefix">
				</div>
			</div>
</canvas>
<canvas class = "w_m_table" style = "display: none">
<div class="newclienttab-inner" style = "width: 100px">
				<div class="tabinner-detail">
				<label><b>Weights and Measures</b></label>
					<table id="W_MTable_display" border="1" cellpadding="1" cellspacing="1" style='text-align: center; vertical-align: middle; table-layout: auto'>
					<thead>
						<tr>
					        <th>Vendor</th><th>Material</th><th>type</th><th>Expected Date Received</th>
					    </tr>
					</thead>
					<tbody id="W_M_tbody">
					<?php
						$result_wm = mysqli_query($conn, "SELECT weights_measures FROM job_ticket WHERE job_id = '$job_id'");
						$row_wm = "";
						$num_rows = mysqli_num_rows($result_wm);
						if($num_rows > 0){
							$row_wm = $result_wm->fetch_assoc();
						}
						
						$materials_array = array();
						
						if($row_wm != ""){
							$materials_array = explode(",", $row_wm['weights_measures']);
						}
						for($i = 0; $i < count($materials_array); $i++){
							$material_id = $materials_array[$i];
							$result_production_receipt = mysqli_query($conn, "SELECT * FROM production_receipts WHERE job_id = '$temp' AND wm_id = '$material_id'");
							$row_pr = $result_production_receipt->fetch_assoc();
							$result_wm = mysqli_query($conn, "SELECT * FROM materials WHERE material_id = '$material_id'");
							
							$expected_date = $row_pr["date_expected"];
							$crst_pickup = $row_pr["crst_pickup"];
							$initial = $row_pr["initial"];
							$location = $row_pr["location"];
							
							if(mysqli_num_rows($result_wm) > 0){
								$row = $result_wm->fetch_assoc();
								echo "<tr id='".($i+1)."'>
								        <td><select class='vendors' id='vendors1' name='vendor' style='width:220px;'><option value='default'>" . $row['vendor'] . "</option></select>
										</td>
								        <td><select class='materials' id='materials1' name='vendor' style='width:220px;'><option value='default'>" . $row['material'] . "</option></select>
										</td>
								       	<td>
											<select class='types' id='types1' name='vendor' style='width:220px;'><option value='default'>" . $row['type'] . "</option></select>
										</td>
										<td>
											<input type = 'date' name = 'expected_date" . ($i + 1) . "' value = '$expected_date'></input>
										</td></tr>";
							}
					}
					?>
					</tbody>
					</table>
				</div>
		</div>
</canvas>