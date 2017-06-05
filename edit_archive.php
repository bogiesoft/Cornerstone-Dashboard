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
    function PrintElem()
    {
	    var mywindow = window.open('height=400,width=600');
        mywindow.document.write('<html><head><title>CRST JOB TICKET</title>');
        mywindow.document.write('</head><body>');
		
		//top of print div
		var project_name = $("#project_name").val();
		var due_date = $("#due_date").val();
		mywindow.document.write('<div class="newclienttab-inner" id = "main_headers"><table border="0" cellspacing="0" cellpadding="0" class="table-bordered allcontacts-table"><tbody><tr valign="top"><td colspan="2"><table id = "w_m_table" border="0" cellspacing="0" cellpadding="0" class="table-striped main-table contacts-list"><thead><tr valign="top" class="contact-headers"><th class="maintable-thtwo data-header" data-name="material" data-index="6">Job Name</th><th class="maintable-thtwo data-header" data-name="type" data-index="7">Due Date</th></tr></thead><tbody><tr><td><input style = "width: 300px; margin-right: 20px" id = "project_name" name="project_name" type="text" value="' + project_name + '" class="contact-prefix"></td><td><input style = "width: 300px; margin-right: 10px" id = "due_date" name="due_date" type="date" value="' + due_date + '" class="contact-prefix"></td></tr></tbody></table></td></tr></tbody></table></div>');
		
		//general information
		var records_total = $("#records_total").val();
		var processed_by = $("#processed_by option:selected").text();
		var job_status = $("#job_status").val();
		var ticket_date = $("#ticket_date").val();
		var created_by = $("#created_by option:selected").text();
		var completed_date = $("#completed_date").val();
		var estimate_number = $("#estimate_number").val();
		var estimate_created_by = $("#estimate_created_by option:selected").text();
		var estimate_date = $("#estimate_date").val();
		mywindow.document.write('<div style = "border: 1px solid; padding: 2px 2px 2px 2px; margin-top: 1px" class="allcontacts-table"><table border="0" cellspacing="0" cellpadding="0" class="table-bordered allcontacts-table"><tbody><tr valign="top"><th class="allcontacts-title">General<span class="allcontacts-subtitle"></span></th></tr><tr valign="top"><td colspan="2"><table id = "w_m_table" border="0" cellspacing="0" cellpadding="0" class="table-striped main-table contacts-list"><tbody><tr><td><label>Records Total</label><input name="records_total" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + records_total + '"></td><td><label>Assigned to</label><input value = "' + processed_by + '"></input></td><td><label>Job Status</label><input name= "job_status" style = "width: 50%; margin-right: 40%" value = "' + job_status + '"></td></tr><tr><td><label>Ticket Date</label><input id = "ticket_date" name="ticket_date" type="date" class="contact-prefix" style = "width: 150px; margin-right: 40%" value = "' + ticket_date + '"></td><td><label>Created By</label><input value = "' + created_by + '"></td><td><label>Completed Date</label><input id = "completed_date" name="completed_date" type="date" class="contact-prefix" style = "width: 150px; margin-right: 40%" value = "' + completed_date + '"></td></tr><tr><td><label>Estimate Number</label><input name="estimate_number" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + estimate_number + '"></td><td><label>Estimate date</label><input id = "estimate_date" name="estimate_date" type="date" class="contact-prefix" style = "width: 150px; margin-right: 40%" value = "' + estimate_date + '"></td><td><label>Estimate created by</label><input name="estimate_created_by" style = "width: 150px; margin-right: 40% value = "' + estimate_created_by + '"></td></tr></tbody></table></td></tr></tbody></table></div>');
		
		//client information
		var client_name = $("#client_name").val();
		var primary_contact = $("#contact_name").val();
		var phone = $("#phone").val();
		var email = $("#email").val();
		var address = $("#address_line_1").val();
		var city = $("#city").val();
		var state = $("#state").val();
		var zipcode = $("#zipcode").val();
		var second_contact = $("#second_contact").val();
		var fax = $("#fax").val();
		var non_profit_number = $("#non_profit_number").val();
		var crid = $("#crid").val();
		mywindow.document.write('<div class="allcontacts-table"><table border="0" cellspacing="0" cellpadding="0" class="table-bordered allcontacts-table" style = "border: 1px solid; padding: 2px 2px 2px 2px; margin-top: 1px; width: 50%; float: left"><tbody><tr valign="top"><th class="allcontacts-title" style = "width: 50%">Client Information<span class="allcontacts-subtitle"></span></th><th class="allcontacts-title"><input style = "width: 100%" id = "client_name" placeholder="Client Name" name="client_name" type="text" class="contact-prefix" value="' + client_name + '" autocomplete = "off"></th></tr><tr valign="top"><td colspan="2"><table id = "w_m_table" border="0" cellspacing="0" cellpadding="0" class="table-striped main-table contacts-list"><tbody><tr><td><label>Primary Contact</label><input id = "contact_name" name="contact_name" type="text" class="contact-prefix" style = "width: 78%" value = "' + primary_contact + '"></td><td><label>Phone</label><input id = "phone" name="phone" type="text" class="contact-prefix" style = "width: 78%; margin-right: 50px" value = "' + phone + '"></td></tr><tr><td><label>Email</label><input id = "email" name="email" type="text" class="contact-prefix" style = "width: 78%; margin-right: 50px" value = "' + email + '"></td><td><label>Address</label><input id = "address_line_1" name="address" type="text" class="contact-prefix" style = "width: 78%; margin-right: 50px" value = "' + address + '"></td></tr><tr><td><label>City</label><br><input id = "city" style = "width: 150px" name="city" type="text" class="contact-prefix" value = "' + city + '"></td><td><label>Second Contact</label><input id = "second_contact" name="second_contact" type="text" class="contact-prefix" style = "width: 78%" value = "' + second_contact + '"></td></tr><tr><td><label>State</label><input id = "state" style = "width: 50px" name="state" type="text" class="contact-prefix" value = "' + state + '"><label>Zip</label><input id = "zipcode" style = "width: 50px" name="zip" type="text" class="contact-prefix" value = "' + zipcode + '"></td><td><label>Non Profit Number</label><input id = "non_profit_number" name="non_profit_number" type="text" class="contact-prefix" style = "width: 78%" value = "' + non_profit_number + '"></td></tr><tr><td><label>Fax</label><input id = "fax" name="fax" type="text" class="contact-prefix" style = "width: 78%; margin-right: 100px" value = "' + fax + '"></td><td><label>CRID</label><input id = "crid" name="crid" type="text" class="contact-prefix" style = "width: 78%; margin-right: 50px" value = "' + crid + '"></td></tr></tbody></table></td></tr></tbody></table></div>');
		
		//data information
		var data_location = $("#data_location").val();
		var data_source = $("#data_source").val();
		var data_received = $("#data_received").val();
		var data_completed = $("#data_completed").val();
		var data_processed_by = $("#data_processed_by option:selected").text();
		var data_hrs = $("#data_hrs").val();
		mywindow.document.write('<div class="allcontacts-table"><table border="0" cellspacing="0" cellpadding="0" class="table-bordered allcontacts-table" style = "border: 1px solid; padding: 2px 2px 2px 2px; margin-top: 1px; width: 50%"><tbody><tr valign="top"><th class="allcontacts-title">Data<span class="allcontacts-subtitle"></span></th></tr><tr valign="top"><td colspan="2"><table id = "w_m_table" border="0" cellspacing="0" cellpadding="0" class="table-striped main-table contacts-list"><tbody><tr><td><label>Data Location</label><textarea id = "data_location" style = "height: 100px; width: 150px" name="data_location" type="text" class="contact-prefix" value = "' + data_location + '">' + data_location + '</textarea></td><td><label>Data Source</label><input name = "data_source" style = "width: 75%" value = "' + data_source + '"></td></tr><tr><td><label>Data Received</label><input id = "data_received" name="data_received" type="date" class="contact-prefix" style = "width: 150px" value = "' + data_received + '"></td><td><label>Data Completed</label><input id = "data_completed" name="data_completed" type="date" class="contact-prefix" style = "width: 150px" value = "' + data_completed + '"></td></tr><tr><td><label>Processed By</label><input name="data_processed_by" style = "width: 70%" value = "' + data_processed_by + '"></td><td><label>Data Hours</label><input name="data_hrs" type="text" class="contact-prefix" style = "width: 75%" value = "' + data_hrs + '"></td></tr></tbody></table></td></tr></tbody></table></div>');
		
		//production task data
		mywindow.document.write("<div class='tabinner-detail' id = 'production_task_table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' style = 'border: 1px solid; padding: 2px 2px 2px 2px; margin-top: 1px; width: 50%; clear: both; float: left'><tbody><tr valign='top'><td colspan='2'><table id = 'tasks' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Check</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Task</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Special</th></tr></thead><tbody>");
		var count = 0;
		$('#production_task_table').find('input[type="checkbox"]:checked').each(function () {
			var task = $(this).attr("value");
			var special = task;
			var font_size = "16px";
			if(task == "In-House Envelope Printing"){
				font_size = "12px";
			}
			special = special.split(" ").join("_");
			special = special.toLowerCase();
			special = "special_" + special;
			if($("#" + special).val() == undefined){
				special = "";
			}
			else{
				special = $("#" + special).val();
			}
			mywindow.document.write("<tr><td><input id = 'mail_merge' type = 'checkbox' name = 'tasks[]' value='' checked/></td><td><label style = 'font-size: " + font_size + "; margin-right: 10px'>" + task + "</label></td><td><input value = '" + special + "'></td></tr>");
			count++;
		});
		if(count == 0){
			mywindow.document.write("<tr><td><input id = 'mail_merge' type = 'checkbox' name = 'tasks[]' value=''></td><td><label style = 'margin-right: 50px'>No</label></td><td><label>Tasks</label></td></tr>");
		}
		mywindow.document.write("</tbody></table></td></tr></tbody></table></div>");
		
		//Blue Sheet information
		var gd_hrs = $("#gd_hrs").val();
		var initialrec_count = $("#initialrec_count").val();
		var manual = $("#manual").val();
		var uncorrected = $("#uncorrected").val();
		var bmeu = $("#bmeu").val();
		var unverifiable = $("#unverifiable").val();
		var bs_foreigns = $("#bs_foreigns").val();
		var bs_exact = $("#bs_exact").val();
		var loose = $("#loose").val();
		var householded = $("#householded").val();
		var dqr_sent = $("#dqr_sent").val();
		var basic = $("#basic").val();
		var bs_ncoa = $("#bs_ncoa").val();
		var ncoa_errors = $("#ncoa_errors").val();
		var domestic = $("#domestic").val();
		var final_count = $("#final_count").val();
		mywindow.document.write('<div id = "blue_sheet_table" class="allcontacts-table" style = "border: 1px solid; width: 43%; float: left; margin-left: 2%"><table border="0" cellspacing="0" cellpadding="0" class="table-bordered allcontacts-table"><tbody><tr valign="top"><th class="allcontacts-title">Blue Sheet<span class="allcontacts-subtitle"></span></th></tr><tr valign="top"><td colspan="2"><table id = "w_m_table" border="0" cellspacing="0" cellpadding="0" class="table-striped main-table contacts-list"><tbody><tr><td><label style = "font-size: 14px;">Graphic Design Hours</label></td><td><input id = "gd_hrs" name="gd_hrs" type="text" class="contact-prefix" value = "' + gd_hrs + '"></td></tr><tr><td> <label>Initial Record Count</label></td><td><input id = "initialrec_count" name="initialrec_count" type="text" class="contact-prefix" value = "' + initialrec_count + '"></td></tr><tr><td><label>Manual</label></td><td><input id = "manual" name="manual" type="text" class="contact-prefix" value = "' + manual + '"></td></tr><tr><td><label>Uncorrected</label></td><td><input id = "uncorrected" name="uncorrected" type="text" class="contact-prefix" value = "' + uncorrected + '"></td></tr><tr><td><label>BMEU</label></td><td><input id = "bmeu" name="bmeu" type="text" class="contact-prefix" value = "' + bmeu + '"></td></tr><tr><td><label>Unverifiable</label></td><td><input id = "unverifiable" name="unverifiable" type="text" class="contact-prefix" value = "' + unverifiable + '"></td></tr><tr><td><label>Foreigns</label></td><td><input id = "bs_foreigns" name="bs_foreigns" type="text" class="contact-prefix" value = "' + bs_foreigns + '"></td></tr><tr><td><label>Exact</label></td><td><input id = "bs_exact" name="bs_exact" type="text" class="contact-prefix" value = "' + bs_exact + '"></td></tr><tr><td><label>Loose</label></td><td><input id = "loose" name="loose" type="text" class="contact-prefix" value = "' + loose + '"></td></tr><tr><td><label>Householded</label></td><td><input id = "householded" name="householded" type="text" class="contact-prefix" value = "' + householded + '"></td></tr><tr><td><label>DQR Sent</label></td><td><input id = "dqr_sent" name="dqr_sent" type="date" class="contact-prefix" style = "width: 78.5%" value = "' + dqr_sent + '"></td></tr><tr><td><label>Basic</label></td><td><input id = "basic" name="basic" type="text" class="contact-prefix" value = "' + basic + '"></td></tr><tr><td><label>NCOA</label></td><td><input id = "bs_ncoa" name="bs_ncoa" type="text" class="contact-prefix" value = "' + bs_ncoa + '"></td></tr><tr><td><label>NCOA Errors</label></td><td><input id = "ncoa_errors" name="ncoa_errors" type="text" class="contact-prefix" value = "' + ncoa_errors + '"></td></tr><tr><td><label>Domestic</label></td><td><input id = "domestic" name="bs_domestic" type="text" class="contact-prefix" value = "' + domestic + '"></td></tr><tr><td><label>Final Count</label></td><td><input id = "final_count" name="final_count" type="text" class="contact-prefix" value = "' + final_count + '"></td></tr></tbody></table></td></tr></tbody></table></div>');
		
		//mailing information
		var mail_class = $("#mail_class").val();
		var rate = $("#rate").val();
		var processing_category = $("#processing_category").val();
		var print_template = $("#print_template").val();
		var special_address = $("#special_address").val();
		var delivery = $("#delivery").val();
		var permit = $("#permit").val();
		var hold_postage = "";
		var paid_postage = "";
		if($("#hold_postage").is(":checked")){
			hold_postage = "checked";
		}
		if($("#paid_postage").is(":checked")){
			paid_postage = "checked";
		}
		mywindow.document.write('<div class="allcontacts-table" style = "border: 1px solid; width: 100%; clear: both; padding-bottom: 1px; margin-bottom: 100px"><table border="0" cellspacing="0" cellpadding="0" class="table-bordered allcontacts-table"><tbody><tr valign="top"><th class="allcontacts-title">Mailing Information<span class="allcontacts-subtitle"></span></th></tr><tr valign="top"><td colspan="2"><table id = "w_m_table" border="0" cellspacing="0" cellpadding="0" class="table-striped main-table contacts-list"><tbody><tr><td><label>Mail Class</label><input name = "mail_class" style = "width: 50%; margin-right: 40%" value = "' + mail_class + '"></td><td><label>Rate</label><input name = "rate" style = "margin-right: 90%" value = "' + rate + '"></td><td><label>Processing Category</label><input name = "processing_category" style = "width: 50%; margin-right: 50%" value = "' + processing_category + '"></td></tr><tr><td><label>Print Template</label><input name="print_template" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + print_template + '"></td><td><label>Special Address Formatting</label><input name="special_address" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + special_address + '"></td><td><label>Method of Delivery</label><input name="delivery" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + delivery + '"></td></tr><tr><td><label>Permit</label><input name="permit" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + permit + '"></td><td><input style = "transform: scale(3.0)" type="checkbox" name="hold_postage" class="contact-prefix" ' + hold_postage + '><label style = "margin-left: 4%">Hold Postage</label></td><td><input style = "transform: scale(3.0)" type="checkbox" name="postage_paid" class="contact-prefix" ' + paid_postage + '><label style = "margin-left: 4%">Postage Paid</label></td></tr></tbody></table></td></tr></tbody></table></div>');
		
		//weights and measures information
		var mail_dimensions = $("#mail_dimensions").val();
		var materials_ordered = $("#materials_ordered").val();
		var materials_expected = $("#materials_expected").val();
		var based_on = $("#based_on").val();
		var total_w_m = $("#total_w_m").val();
		var expected_quantity = $("#expected_quantity").val();
		mywindow.document.write('<div class = "newclienttab-inner" style = "float: left; width 100%; width: 100%; clear: both; border: 1px solid; padding-bottom: 5px; padding-left: 2px"><div class="allcontacts-table"><table border="0" cellspacing="0" cellpadding="0" class="table-bordered allcontacts-table"><tbody><tr valign="top"><th class="allcontacts-title">Weights and Measures<span class="allcontacts-subtitle"></span></th></tr><tr valign="top"><td colspan="2"><table id = "w_m_table" border="0" cellspacing="0" cellpadding="0" class="table-striped main-table contacts-list"><tbody><tr><td><label>Mail Dimensions</label><input id = "mail_dimensions" name="mail_dim" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + mail_dimensions + '"></td><td><label>Materials Ordered</label><input id = "materials_ordered" name="materials_ordered" type="date" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + materials_ordered + '"></td><td><label>Materials Expected</label><input id = "materials_expected" name="materials_expected" type="date" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + materials_expected + '"></td></tr><tr><td><label>Based On</label><input id = "based_on" style = "width: 50%; margin-right: 40%" name="based_on" value = "' + based_on + '"></td><td><label>Total Weights and Measures</label><input id = "total_w_m" name="total_w_m" type="text" class="contact-prefix" value = "' + total_w_m + '"></td><td><label>Expected Quantity</label><input name="expected_quantity" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "' + expected_quantity + '"></td></tr></tbody></table></td></tr></tbody></table></div></div>');
		
		//weights and measures table of info
		mywindow.document.write('<div class="newclienttab-inner" style = "width: 100%"><div class="tabinner-detail"><table id="W_MTable" border="1" cellpadding="1" cellspacing="1" style="text-align: center; vertical-align: middle;"><thead><tr><th>Select</th><th>Vendor</th><th>Material</th><th>type</th><th>Weight</th><th>Height</th></tr></thead><tbody id="W_M_tbody">');
		var count = 0;
		$("#W_MTable tr").each(function(){
			if(count > 0){
				var id = ($(this).attr("id"));
				var vendor = $("#vendors" + id).val();
				var materials = $("#materials" + id).val();
				var types = $("#types" + id).val();
				var weight = $("#weight" + id).val();
				var height = $("#height" + id).val();
				var based_on = $("#based_on" + id).val();
				var expected_date = $("#expected_date" + id).val();
				var crst_pickup = "";
				if($("#crst_pickup" + id).is(":checked")){
					crst_pickup = "checked";
				}
				var initial = $("#initial" + id).val();
				var location = $("#location" + id).val();
				mywindow.document.write('<tr><td></td><td><input value = "' + vendor + '"></td><td><input value = "' + materials + '"></td><td><input value = "' + types + '"></td><td><input value = "' + weight + '"></td><td><input value = "' + height + '"></td></tr>');
			}
			count++;
		});
		mywindow.document.write('</tbody></table></div></div>');
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
			<div class="newclienttab-inner" id = "main_headers">
				<table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
						<tbody>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Job Name</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Due Date</th></tr></thead><tbody>
							<tr><td><input style = "width: 75%" id = "project_name" name="project_name" type="text" value="<?php echo $project_name ; ?>" class="contact-prefix"></td><td><input style = "width: 75%" id = "due_date" name="due_date" type="date" value="<?php echo $due_date ; ?>" class="contact-prefix"></td></tr>
						</tbody></table></td></tr></tbody></table>
			</div>
			<div class = "newclienttab-inner" style = "float: left; width 100%; width: 100%; clear: both">
					<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><th class='allcontacts-title'>General<span class='allcontacts-subtitle'></span></th></tr>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><label>Records Total</label><input id = "records_total" name="records_total" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $records_total ?>"></td><td><?php
                     
                         
                        $result2 = $conn->query("select first_name, last_name, user from users");
                        echo "<label>Assigned to</label><select id = 'processed_by' name='processed_by' style = 'width: 50%; margin-right: 40%'>";
						$result_name = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user = '$processed_by'");
						$row = $result_name->fetch_assoc();
						$name = $row["first_name"] . " " . $row["last_name"];
                        echo "<option selected = 'selected' value = '" . $processed_by . "'>" . $name . "</option>";
                        while ($row2 = $result2->fetch_assoc()) {
                                      //unset($pm);
                                      $processed_by = $row2['first_name']. ' '. $row2['last_name']; 
                                      echo '<option value="'.$row2['user'].'">'.$processed_by.'</option>';
                                      
                        }
                        echo "</select>";
                        ?></td><td><label>Job Status</label><select id = "job_status" name='job_status' style = "width: 50%; margin-right: 40%"><option selected = "selected" value = "<?php echo $job_status; ?>"><?php echo $job_status; ?></option><option value="in P.M.">in P.M.</option><option value="in Production">in Production</option><option value="on hold">on hold</option><option value="waiting for materials">waiting for materials</option><option value="waiting for data">waiting for data</option><option value="waiting for postage">waiting for postage</option></select></td></tr>
						<tr><td><label>Ticket Date</label><input id = "ticket_date" name="ticket_date" type="date" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $ticket_date; ?>"></td><td><?php
                     
                         
                        $result1 = $conn->query("select first_name, last_name, user from users");
                        echo "<label>Created By</label><select id = 'created_by' name='created_by' style = 'width: 50%; margin-right: 40%'>";
						$result_name = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user = '$created_by'");
						$row = $result_name->fetch_assoc();
						$name = $row["first_name"] . " " . $row["last_name"];
                        echo "<option selected = 'selected' value = '" . $created_by . "'>" . $name . "</option>";
                        while ($row1 = $result1->fetch_assoc()) {
                                      unset($created_by);
                                      $created_by = $row1['first_name'] . ' ' . $row1['last_name']; 
                                      echo '<option value="'.$row1['user'].'">'.$created_by.'</option>';
                                      
                        }
                        echo "</select>";
                        ?></td><td><label>Completed Date</label><input id = "completed_date" name="completed_date" type="date" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $completed_date; ?>"></td></tr>
						<tr><td><label>Estimate Number</label><input id = "estimate_number" name="estimate_number" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $estimate_number; ?>"></td><td><label>Estimate date</label><input id = "estimate_date" name="estimate_date" type="date" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $estimate_date; ?>"></td><td><label>Estimate created by</label>
						<select id = "estimate_created_by" name="estimate_created_by" style = "width: 50%; margin-right: 40%">
						<?php
							$result_name = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user = '$estimate_created_by'");
							$row_name= $result_name->fetch_assoc();
							$result = mysqli_query($conn, "SELECT * FROM users");
							$count = 1;
							while($row = $result->fetch_assoc()){
								if($count == 1){
									echo "<option selected = 'selected' value = '" . $row_name['user'] . "'>" . $row_name['first_name'] . " " . $row_name['last_name'] . "</option>"; 
								}
								else{
									echo "<option value = '" . $row['user'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>"; 
								}
								 
								$count = $count + 1;
							}
						?>
                    </select></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
				</div>
			<div class = "newclienttab-inner" style = "float: left; width 50%; width: 45%; margin-right: 2%">
					<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><th class='allcontacts-title' style = "width: 50%">Client Information<span class='allcontacts-subtitle'></span></th><th class='allcontacts-title'><input style = "width: 100%" id = "client_name" placeholder="Client Name" name="client_name" type="text" class="contact-prefix" value="<?php echo $client_name; ?>" autocomplete = "off"><a class = "delete_client_af" href = "#" style = "display: none; font-size: 20px">delete</a></th></tr>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><ul class = "client_search_results" style = "list-style-type: none; cursor: pointer"></ul></td></tr>
							<tr><td><label>Primary Contact</label><input id = "contact_name" name="contact_name" type="text" class="contact-prefix" style = "width: 78%" readonly></td><td><label>Phone</label><input id = "phone" name="phone" type="text" class="contact-prefix" style = "width: 78%; margin-right: 50px" readonly></td></tr>
							<tr><td><label>Email</label><input id = "email" name="email" type="text" class="contact-prefix" style = "width: 78%; margin-right: 50px" readonly></td><td><label>Address</label><input id = "address_line_1" name="address" type="text" class="contact-prefix" style = "width: 78%; margin-right: 50px" readonly></td></tr>
							<tr><td> <label>City</label><input id = "city" style = "width: 20%" name="city" type="text" class="contact-prefix" readonly><label>State</label><input id = "state" style = "width: 20%" name="state" type="text" class="contact-prefix" readonly><label>Zip</label><input id = "zipcode" style = "width: 20%" name="zip" type="text" class="contact-prefix" readonly></td><td><label>Second Contact</label><input id = "second_contact" name="second_contact" type="text" class="contact-prefix" style = "width: 78%" readonly></td></tr>
							<tr><td> <label>Fax</label><input id = "fax" name="fax" type="text" class="contact-prefix" style = "width: 78%; margin-right: 100px" readonly></td><td><label>Non Profit Number</label><input id = "non_profit_number" name="non_profit_number" type="text" class="contact-prefix" style = "width: 78%" readonly></td></tr>
							<tr><td> <label>CRID</label><input id = "crid" name="crid" type="text" class="contact-prefix" style = "width: 78%; margin-right: 50px" readonly></td><td><div class="newcontact-tabbtm" style = "background-color: #f4f5f7"><input onclick = "showSaveMessage()" class="save_client_info" value="Save Client Changes" name="submit_form" style="display: none; float: left; width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; cursor: pointer" readonly></div></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
			</div>
			<div class = "newclienttab-inner" style = "float: left; width 50%; width: 45%">
					<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><th class='allcontacts-title'>Data<span class='allcontacts-subtitle'></span></th></tr>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><label>Data Location</label><input id="file_location" type="file" style = "width: 78%"><textarea id = "data_location" style = "height: 10%; width: 78%" name="data_location" type="text" class="contact-prefix" value = "<?php echo $data_location; ?>"><?php echo $data_location; ?></textarea></td><td> <label>Data Source</label><select id = "data_source" name = "data_source" style = "width: 75%"><option selected = "selected" value = "<?php echo $data_source; ?>"><?php echo $data_source; ?></option><option value = "Client">Client</option><option value = "BOE">BOE</option><option value = "Recycled">Recycled</option><option value = "Occupants Residency">Occupants Residency</option><option value = "Melissa">Melissa</option><option value = "Master">Master</option><option value = "DataConsulate">DataConsulate</option><option value = "Multiple">Multiple</option><option value = "Real Property">Real Property</option><option value = "Other">Other</option></select></td></tr>
							<tr><td><label>Data Received</label><input id = "data_received" name="data_received" type="date" class="contact-prefix" style = "width: 70%" value = "<?php echo $data_received;?>"></td><td><label>Data Completed</label><input id = "data_completed" name="data_completed" type="date" class="contact-prefix" style = "width: 70%" value = "<?php echo $data_completed;?>"></td></tr>
							<tr><td><label>Processed By</label>
							 <select id = "data_processed_by" name="data_processed_by" style = "width: 70%">
							<?php
								$result = mysqli_query($conn, "SELECT * FROM users");
								$count = 1;
								$result_name = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user = '$data_processed_by'");
								$row_name = $result_name->fetch_assoc();
								$name = $row_name["first_name"] . " " . $row_name["last_name"];
								while($row = $result->fetch_assoc()){
									if($count == 1){
										echo "<option selected = 'selected' value = '" . $data_processed_by .  "'>" . $name . "</option>"; 
									}
									else{
										echo "<option value = '" . $row['user'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>"; 
									}
									 
									$count = $count + 1;
								}
							?></select></td><td><label>Data Hours</label><input id = "data_hrs" name="data_hrs" type="text" class="contact-prefix" style = "width: 75%" value = "<?php echo $data_hrs;?>"></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
				</div>
			<div class="newclienttab-inner" style = "float: left; width: 45%; clear: both">
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
			<div class = "newclienttab-inner" style = "float: left; width 50%; width: 35%; margin-left: 17%">
					<div id = "blue_sheet_table" class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><th class='allcontacts-title'>Blue Sheet<span class='allcontacts-subtitle'></span></th></tr>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><label>Graphic Design Hours</label></td><td><input id = "gd_hrs" name="gd_hrs" type="text" class="contact-prefix" value = "<?php echo $gd_hrs; ?>"></td></tr>
							<tr><td> <label>Initial Record Count</label></td><td><input id = "initialrec_count" name="initialrec_count" type="text" class="contact-prefix" value = "<?php echo $initialrec_count; ?>"></td></tr>
							<tr><td><label>Manual</label></td><td><input id = "manual" name="manual" type="text" class="contact-prefix" value = "<?php echo $manual; ?>"></td></tr>
							<tr><td><label>Uncorrected</label></td><td><input id = "uncorrected" name="uncorrected" type="text" class="contact-prefix" value = "<?php echo $uncorrected; ?>"></td></tr>
							<tr><td><label>BMEU</label></td><td><input id = "bmeu" name="bmeu" type="text" class="contact-prefix" value = "<?php echo $bmeu;?>"></td></tr>
							<tr><td><label>Unverifiable</label></td><td><input id = "unverifiable" name="unverifiable" type="text" class="contact-prefix" value = "<?php echo $unverifiable; ?>"></td></tr>
							<tr><td><label>Foreigns</label></td><td><input id = "bs_foreigns" name="bs_foreigns" type="text" class="contact-prefix" value = "<?php echo $bs_foreigns; ?>"></td></tr>
							<tr><td><label>Exact</label></td><td><input id = "bs_exact" name="bs_exact" type="text" class="contact-prefix" value = "<?php echo $bs_exact; ?>"></td></tr>
							<tr><td><label>Loose</label></td><td><input id = "loose" name="loose" type="text" class="contact-prefix" value = "<?php echo $loose; ?>"></td></tr>
							<tr><td><label>Householded</label></td><td><input id = "householded" name="householded" type="text" class="contact-prefix" value = "<?php echo $householded; ?>"></td></tr>
							<tr><td><label>DQR Sent</label></td><td><input id = "dqr_sent" name="dqr_sent" type="date" class="contact-prefix" style = "width: 78.5%" value = "<?php echo $dqr_sent; ?>"></td></tr>
							<tr><td><label>Basic</label></td><td><input id = "basic" name="basic" type="text" class="contact-prefix" value = "<?php echo $basic; ?>"></td></tr>
							<tr><td><label>NCOA</label></td><td><input id = "bs_ncoa" name="bs_ncoa" type="text" class="contact-prefix" value = "<?php echo $bs_ncoa; ?>"></td></tr>
							<tr><td><label>NCOA Errors</label></td><td><input id = "ncoa_errors" name="ncoa_errors" type="text" class="contact-prefix" value = "<?php echo $ncoa_errors; ?>"></td></tr>
							<tr><td><label>Domestic</label></td><td><input id = "domestic" name="bs_domestic" type="text" class="contact-prefix" value = "<?php echo $bs_domestic; ?>"></td></tr>
							<tr><td><label>Final Count</label></td><td><input id = "final_count" name="final_count" type="text" class="contact-prefix" value = "<?php echo $final_count; ?>"></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
			</div>
			<div class = "newclienttab-inner" style = "float: left; width 100%; width: 100%; clear: both">
					<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><th class='allcontacts-title'>Mailing Information<span class='allcontacts-subtitle'></span></th></tr>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><label>Mail Class</label><select id = "mail_class" name = "mail_class" style = "width: 50%; margin-right: 40%"><option selected = "selected" value = "<?php echo $mail_class; ?>"><?php echo $mail_class; ?></option><option value = "FCM">FCM</option><option value = "Bulk Standard">Bulk Standard</option><option value = "Non-Profit BLK">Non-Profit BLK</option><option value = "BPM">BPM</option><option value = "Non-profit BPM">Non-profit BPM</option><option value = "Parcel">Parcel</option><option value = "Non-profit Parcel">Non-profit Parcel</option><option value = "Hand Stamp FCM">Hand Stamp FCM</option><option value = "Hand Stamp Bulk">Hand Stamp Bulk</option></select></td><td><label>Rate</label><select id = "rate" name = "rate" style = "margin-right: 90%"><option selected = "selected" value = "<?php echo $rate; ?>"><?php echo $rate; ?></option><option value = "Auto">Auto</option><option value = "Auto-CRRT">Auto CRRT</option><option value = "Auto-WSS">Auto-WSS</option><option value = "Non-auto">Non-auto</option><option value = "Simplified">Simplified</option></select></td><td><label>Processing Category</label><select id = "processing_category" name = "processing_category" style = "width: 50%; margin-right: 50%"><option selected = "selected" value = "<?php echo $processing_category; ?>"><?php echo $processing_category; ?></option><option value = "Flat">Flat</option><option value = "Letter">Letter</option><option value = "Postcard - FCM Only">Postcard - FCM Only</option></select></td></tr>
							<tr><td><label>Print Template</label><input id = "print_template" name="print_template" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $print_template; ?>"></td><td><label>Special Address Formatting</label><input id = "special_address" name="special_address" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $special_address; ?>"></td><td><label>Method of Delivery</label><input id = "delivery" name="delivery" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $delivery; ?>"></td></tr>
							<tr><td><label>Permit</label><input id = "permit" name="permit" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $permit; ?>"></td><td><?php if($hold_postage == "yes"){echo '<input id = "hold_postage" style = "transform: scale(3.0)" type="checkbox" name="hold_postage" class="contact-prefix" checked>';}else{echo '<input id = "hold_postage" style = "transform: scale(3.0)" type="checkbox" name="hold_postage" class="contact-prefix">';}?><label style = "margin-left: 4%">Hold Postage</label></td><td><?php if($postage_paid == "yes"){echo '<input id = "postage_paid" style = "transform: scale(3.0)" type="checkbox" name="postage_paid" class="contact-prefix" checked>';}else{echo '<input id = "postage_paid" style = "transform: scale(3.0)" type="checkbox" name="postage_paid" class="contact-prefix">';}?><label style = "margin-left: 4%">Postage Paid</label></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
			</div>
			<div class = "newclienttab-inner" style = "float: left; width 100%; width: 100%; clear: both">
					<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><th class='allcontacts-title'>Weights and Measures<span class='allcontacts-subtitle'></span></th></tr>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><label>Mail Dimensions</label><input id = "mail_dimensions" name="mail_dim" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $mail_dim; ?>"></td><td><label>Materials Ordered</label><input id = "materials_ordered" name="materials_ordered" type="date" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $materials_ordered; ?>"></td><td><label>Materials Expected</label><input id = "materials_expected" name="materials_expected" type="date" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $materials_expected; ?>"></td></tr>
							<tr><td><label>Based On</label><select id = "based_on" style = "width: 50%; margin-right: 40%" name="based_on" onchange = "addTotalWM()"><option selected = 'selected' value = '<?php echo $based_on; ?>'><?php echo $based_on; ?></option></select></td><td><label>Total Weights and Measures</label><input id = "total_w_m" name="total_w_m" type="text" class="contact-prefix" placeholder = "Auto Generated" style = "width: 50%; margin-right: 40%"></td><td><label>Expected Quantity</label><input id = "expected_quantity" name="expected_quantity" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%" value = "<?php echo $expected_quantity; ?>"></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
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
					<input class="save2-btn" type="button" value="Print Div" onclick="PrintElem()" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left" />
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
			$("#contact_name").attr("readonly", false);
			$("#phone").val(data_info[1]);
			$("#phone").attr("readonly", false);
			$("#email").val(data_info[2]);
			$("#email").attr("readonly", false);
			$("#address_line_1").val(data_info[3]);
			$("#address_line_1").attr("readonly", false);
			$("#city").val(data_info[4]);
			$("#city").attr("readonly", false);
			$("#state").val(data_info[5]);
			$("#state").attr("readonly", false);
			$("#zipcode").val(data_info[6]);
			$("#zipcode").attr("readonly", false);
			$("#second_contact").val(data_info[7]);
			$("#second_contact").attr("readonly", false);
			$("#fax").val(data_info[8]);
			$("#fax").attr("readonly", false);
			$(".save_client_info").show();
			$(".save_client_info").attr("id", data_info[9]);
			$("#non_profit_number").val(data_info[10]);
			$("#non_profit_number").attr("readonly", false);
			$("#crid").val(data_info[11]);
			$("#crid").attr("readonly", false);
			if(data_info[9] != ""){
				$(".save_client_info").show();
				$(".delete_client_af").show();
			}
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
			$("#contact_name").attr("readonly", false);
			$("#phone").val(data_info[1]);
			$("#phone").attr("readonly", false);
			$("#email").val(data_info[2]);
			$("#email").attr("readonly", false);
			$("#address_line_1").val(data_info[3]);
			$("#address_line_1").attr("readonly", false);
			$("#city").val(data_info[4]);
			$("#city").attr("readonly", false);
			$("#state").val(data_info[5]);
			$("#state").attr("readonly", false);
			$("#zipcode").val(data_info[6]);
			$("#zipcode").attr("readonly", false);
			$("#second_contact").val(data_info[7]);
			$("#second_contact").attr("readonly", false);
			$("#fax").val(data_info[8]);
			$("#fax").attr("readonly", false);
			$(".save_client_info").show();
			$(".save_client_info").attr("id", data_info[9]);
			$("#non_profit_number").val(data_info[10]);
			$("#non_profit_number").attr("readonly", false);
			$("#crid").val(data_info[11]);
			$("#crid").attr("readonly", false);
			$(".delete_client_af").show();
		}
});
$(".client_search_results").empty();
}
$(".delete_client_af").click(function(){
	$(".client_search_results").empty();
	$("#contact_name").val("");
	$("#contact_name").attr("readonly", true);
	$("#phone").val("");
	$("#phone").attr("readonly", true);
	$("#email").val("");
	$("#email").attr("readonly", true);
	$("#address_line_1").val("");
	$("#address_line_1").attr("readonly", true);
	$("#city").val("");
	$("#city").attr("readonly", true);
	$("#state").val("");
	$("#state").attr("readonly", true);
	$("#zipcode").val("");
	$("#zipcode").attr("readonly", true);
	$("#second_contact").val("");
	$("#second_contact").attr("readonly", true);
	$("#fax").val("");
	$("#fax").attr("readonly", true);
	$("#non_profit_number").val("");
	$("#non_profit_number").attr("readonly", true);
	$("#crid").val("");
	$("#crid").attr("readonly", true);
	$(".save_client_info").hide();
	$(".delete_client_af").hide();
	$("#client_name").val("");
	$("#client_name").attr("readonly", false);
});
$(".save_client_info").click(function(){
	var client_id = $(".save_client_info").attr("id");
	var info = [$("#contact_name").val(), $("#phone").val(), $("#email").val(), $("#address_line_1").val(), $("#city").val(), $("#state").val(), $("#zipcode").val(), $("#second_contact").val(), $("#fax").val(), client_id, $("#non_profit_number").val(), $("#crid").val()]
		$.ajax({
		type: "POST",
		url: "job_ticket_save_client_info.php",
		data: {id: info},
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (){
		}
	});
});
function showSaveMessage(){
		swal({   title: "Saved!",   text: "This client has been saved.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true});  
};
$("#file_location").change(function(){
	$("#data_location").val($("#file_location").val());
});
$(document).ready(function(){
	var date = new Date();
	var nextWeek = new Date(date.getTime() + 7 * 24 * 60 * 60 * 1000);
    document.getElementById("data_received").valueAsDate = date;
	document.getElementById("data_completed").valueAsDate = date;
	document.getElementById("due_date").valueAsDate = nextWeek;
	document.getElementById("materials_ordered").valueAsDate = date;
	document.getElementById("materials_expected").valueAsDate = date;
	document.getElementById("ticket_date").valueAsDate = date;
	document.getElementById("completed_date").valueAsDate = nextWeek;
	document.getElementById("estimate_date").valueAsDate = date;
})
</script>
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
        