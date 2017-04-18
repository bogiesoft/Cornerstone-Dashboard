<?php
$job_id = $_GET['job_id'];
require ("header.php");
$_SESSION['deleted_archived_job_id'] = $job_id;
?>
<style>
li{
	list-style-type: none;
}
</style>
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
<script>
    var id_of_row;
    var id_of_task;
    var number_of_rows;
    var number_of_tasks;
	var based_on_ids = [];
    $(function() {
        id_of_row=parseInt($( "tr:last" ).attr('id'));
        number_of_rows=id_of_row;
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
    $(document).on('change', '.tasks',function(){
        var id=$(this).parent().parent().attr('id');
        getTasks(id);
    });
 
});
function getMaterialsID(row_id){
        var vendor=$("#vendors"+row_id).val();
        var material = $("#materials"+row_id).val(); 
        var type=$("#types"+row_id).val();
		based_on_ids.push(row_id);
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
function addTasks(){
    if(number_of_tasks<20){
        number_of_tasks=number_of_tasks+1;
        id_of_task=id_of_task+1;
        $("#Taskbody").append(  "<tr id='"+id_of_task+"'><td >          <input type='checkbox' id='checkbox"+id_of_task+"'checked name='wm[]' value=''>       </td>     <td>          <select class='tasks' id='tasks"+id_of_task+"' name='tasks' style='width:220px;'></select></td></tr>");
         
 
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
function removeTasks(row_id){
    $(row_id).remove();
    number_of_task--;
};
function getVendors(row_id)
{
    $.ajax({
        url: 'getVendors.php',
        type: 'post',
        success: function(data){
            $("#materials"+row_id).children().remove();
            $("#materials"+row_id).append("<option value=''>Select</option>");
            $("#types"+row_id).children().remove();
            $("#types"+row_id).append("<option value=''>Select</option>");
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
            $("#materials"+row_id).append("<option value=''>Select</option>");
            $("#types"+row_id).children().remove();
            $("#types"+row_id).append("<option value=''>Select</option>");
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
            $("#types"+row_id).append("<option value=''>Select</option>");
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
</script>

<?php
require ("connection.php");

	$sql = "SELECT * FROM archive_jobs WHERE job_id = '$job_id'"; 
	$result = mysqli_query($conn,$sql); 
	$_SESSION["job_id"] = $temp;
	
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();	
		$job_id = $row['job_id'];
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
		
		$mail_class = $row['mail_class'];
		$rate = $row['rate'];
		$processing_category = $row['processing_category'];
		$mail_dim = $row['mail_dim'];
		$weights_measures = $row['weights_measures'];
		$permit = $row['permit'];
		$bmeu = $row['bmeu'];
		$based_on = $row['based_on'];
		$non_profit_number = $row['non_profit_number'];
		
		$data_loc = $row['data_loc'];
		$records_total = $row['records_total'];
		$domestic = $row['domestic'];
		$foreigns = $row['foreigns'];
		$data_location = $row['data_location'];
		$data_processed_by = $row['data_processed_by'];
		$data_source = $row['data_source'];
		$data_received = $row['data_received'];
		$data_completed = $row['data_completed'];
		$processed_by = $row['processed_by'];
		$dqr_sent = $row['dqr_sent'];
		$exact = $row['exact'];
		$mail_foreigns = $row['mail_foreigns'];
		$household = $row['household'];
		$ncoa = $row['ncoa'];
		
		$hold_postage = $row['hold_postage'];
		$postage_paid = $row['postage_paid'];
		$print_template = $row['print_template'];
		$special_address = $row['special_address'];
		$delivery = $row['delivery'];
		//$completed = $row['completed'];
		$tasks = $row['tasks']; 
		
		$completed_date = $row['completed_date'];
		$data_hrs = $row['data_hrs'];
		$gd_hrs = $row['gd_hrs'];
		$initialrec_count = $row['initialrec_count'];
		$manual = $row['manual'];
		$uncorrected = $row['uncorrected'];
		$unverifiable = $row['unverifiable'];
		$bs_foreigns = $row['bs_foreigns'];
		$bs_exact = $row['bs_exact'];
		$loose = $row['loose'];
		$householded = $row['householded'];
		$basic = $row['basic'];
		$ncoa_errors = $row['ncoa_errors'];
		$bs_ncoa = $row['bs_ncoa'];
		$final_count = $row['final_count'];
		$bs_domestic = $row['bs_domestic'];
				
		$display = "yes";

	} 
	else {
		echo "No results found";
		$display = "no";
	}

?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Archived Job: <?php echo $project_name;?></h1>
	<a class="pull-right" href="archive.php" >Back to Archive</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Edit Archived Job</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<form action="add_job_ticket.php" method="post">
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
			<div class="newclienttab-inner" style = "float: left; width: 31%">
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
			<div class="newclienttab-inner" style = "float: left; width: 31%">
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
				<option selected = "selected" value = "<?php echo $based_on ; ?>"><?php echo $based_on ; ?></option>
				</select>
				</div>
				<div class="tabinner-detail">
				<label>Permit</label>
				<input name="permit" type="text" value="<?php echo $permit ; ?>" class="contact-prefix">
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
			<div class="newclienttab-inner" style = "float: left; width: 45%;">
                    <div class="tabinner-detail">
					<table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
						<tbody>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Check</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Task</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Special</th></tr></thead><tbody>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Mail Merge"/></td><td><label>Mail Merge</label></td><td><select name = "special_mail_merge"><option select = 'selected' value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Letter Printing"/></td><td><label>Letter Printing</label></td><td><select name = "special_letter_printing"><option select = 'selected' value = 'From PDF'>From PDF</option><option value = 'Inkjet'>Inkjet</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "In-House Envelope Printing"/></td><td><label>In-House Envelope Printing</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Tabbing"/></td><td><label>Tabbing</label></td><td><select name = "special_tabbing"><option select = 'selected' value = 'Manual Single'>Manual Single</option><option value = 'Manual Double'>Manual Double</option><option value = 'Auto Single'>Auto Single</option><option value = 'Auto Double'>Auto Double</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Folding"/></td><td><label>Folding</label></td><td><select name = "special_folding"><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Inserting"/></td><td><label>Inserting</label></td><td><select name = "special_inserting"><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Sealing"/></td><td><label>Sealing</label></td><td><select name = "special_sealing"><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Collating"/></td><td><label>Collating</label></td><td><select name = "special_collating"><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option><option value = 'Man. and Auto'>Man. and Auto</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Labeling"/></td><td><label>Labeling</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Print Permit"/></td><td><label>Print Permit</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Correct Permit"/></td><td><label>Correct Permit</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Carrier Route"/></td><td><label>Carrier Route</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Endorsement line"/></td><td><label>Endorsement line</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Address Printing"/></td><td><label>Address Printing</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Tag as Political"/></td><td><label>Tag as Political</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Inkjet Printing"/></td><td><label>Inkjet Printing</label></td><td><select name = "special_inkjet_printing"><option select = 'selected' value = '26K'>26K</option><option value = '11K'>11K</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Glue Dots"/></td><td><label>Glue Dots</label></td><td></td></tr>
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
                            <th>Select</th><th>Vendor</th><th>Material</th><th>Type</th><th>Weight</th><th>Height</th><th>Based On</th><th>Expected Date Received</th><th>CRST Pickup</th><th>Initial</th><th>Location</th><th>Delete</th>
                        </tr>
                        </thead>
                        <tbody id="W_M_tbody">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM materials ORDER BY vendor");
                        while($row = $result->fetch_assoc()){
                                echo "<tr id='1'>
                                        <td ><input type='checkbox' id='checkbox1' checked name='wm[]' value='" . $row['material_id'] . "'></td>
                                        <td>"; $result = $conn->query("select vendor_name from vendors");
                                            echo "<select class='vendors' id='vendors1' name='vendor' style='width:220px;'><option value=''>Select</option>";
                                            while ($row = $result->fetch_assoc()) {
                                                          unset($vendor_name);
                                                          $vendor_name = $row['vendor_name']; 
                                                          echo '<option value="'.$vendor_name.'">'.$vendor_name.'</option>';
                                                          
                                            }
                                            echo "</select>
                                        </td>
 
                                        <td>";
                                            echo "<select class='materials' id='materials1' name='vendor' style='width:220px;'><option value=''>Select</option></select>
                                        </td>
                                        <td>
                                            <select class='types' id='types1' name='vendor' style='width:220px;'><option value=''>Select</option></select>
                                        </td>
										<td><input type = 'text' id = 'weight1' readonly></td>
										<td><input type = 'text' id = 'height1' readonly></td>
										<td><input type = 'text' id = 'based_on1' readonly></td>
										<td>
											<input type = 'date' name = 'expected_date1'></input>
										</td>
										<td>
											<input type = 'checkbox' name = 'crst_pickup1'></input>
										</td>
										<td>
											<input type = 'text' name = 'initial1'></input>
										</td>
										<td>
											<input type = 'text' name = 'location1'></input>
										</td>
                                        <td><img src = 'images/x_button.png' width = '25' height = '25' onclick = removeWeights_Measures('#1')></td>
                                    </tr>";
                                    }
                        ?>
                        </tbody>
                    </table>
					</div>
                </div>
					<div class="tabinner-detail">
                    <label>Special Instructions</label>
                    <textarea name="special_instructions" class="contact-prefix"></textarea>
                    </div>
            </div>
				<div class="newcontact-tabbtm">
					<input class="save-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;"/>
					<input class="save2-btn" type="button" value="Print Div" onclick="PrintElem('.dashboard-cont')" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left" />
					</form>
					<form action = "delete_archive.php" method = "post">
					<input class="delete-btn" type="submit" value="Delete" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;"/>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>	
<div class="contacts-title">
	</div>
</div>
<script src="ArchiveSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>	
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