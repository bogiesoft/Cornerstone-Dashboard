<?php
require ("header.php");
?>
<style>
.dropdown-check-list {
  display: inline-block;
}
.dropdown-check-list .anchor {
  position: relative;
  cursor: pointer;
  display: inline-block;
  padding: 5px 50px 5px 10px;
  border: 1px solid #ccc;
}
.dropdown-check-list .anchor:after {
  position: absolute;
  content: "";
  border-left: 2px solid black;
  border-top: 2px solid black;
  padding: 5px;
  right: 10px;
  top: 20%;
  -moz-transform: rotate(-135deg);
  -ms-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  -webkit-transform: rotate(-135deg);
  transform: rotate(-135deg);
}
.dropdown-check-list .anchor:active:after {
  right: 5px;
  top: 10%;
}
.dropdown-check-list ul.items {
  padding: 2px;
  display: none;
  margin: 0;
  border: 1px solid #ccc;
  border-top: none;
}
.dropdown-check-list ul.items li {
  list-style: none;
}
</style>
<script src="JobTicketSweetAlert.js"></script>
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
			addTotalWM();
        }
    });
 
};
function addWeights_Measures(){
    if(number_of_rows<20){
        number_of_rows=number_of_rows+1;
        id_of_row=id_of_row+1;
        $("#W_M_tbody").append( "<tr id='"+id_of_row+"'><td style = 'display: none'>           <input type='checkbox' id='checkbox"+id_of_row+"'checked name='wm[]' value=''>        </td>     <td>          <select class='vendors' id='vendors"+id_of_row+"' name='vendor' style='width:220px;'>             <option value=''>Select</option>            </select>     </td>     <td>          <select class='materials' id='materials"+id_of_row+"' name='material' style='width:220px;'>               <option value=''>Select</option>            </select>     </td>     <td>          <select class='types' id='types"+id_of_row+"' name='vendor' style='width:220px;'>             <option value=''>Select</option>            </select>     </td><td><input type = 'text' id = 'weight" + id_of_row + "' readonly></td><td><input type = 'text' id = 'height" + id_of_row + "' readonly></td><td><input type = 'text' id = 'based_on" + id_of_row + "' readonly></td><td><input type = 'date' name = 'expected_date" + number_of_rows + "'></input> </td><td><input type = 'checkbox' name = 'crst_pickup" + number_of_rows + "'></input></td><td><input type = 'text' name = 'initial" + number_of_rows + "'></input></td><td><select name = 'location" + number_of_rows + "'><option value = '' selected = 'selected'>--Choose Location--</option><option value = '29 Front'>29 Front</option><option value = '29 Middle'>29 Middle</option><option value = '29 Back'>29 Back</option><option value = '31 Front'>31 Front</option><option value = '31 Middle'>31 Middle</option><option value = '31 Back'>31 Back</option></select></td> <td><p style = 'cursor: pointer' onclick = removeWeights_Measures('#" + id_of_row + "')>X</p></td>  </tr>");
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
	$("#total_w_m").val(weight + "lbs. x " + height + " in.");
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
	$("#total_w_m").val(weight + " lbs. x " + height + " in.");
}
function showGeneral(){
	$("#general_info").show();
	$("#client_info").hide();
	$("#data_info").hide();
	$("#task_list_info").hide();
	$("#blue_sheet_info").hide();
	$("#mailing_info").hide();
	$("#w_m_info").hide();
	$("#special_instructions_info").hide();
	//-------------------------------
	$("#general_tab").css("background", '#476d65');
	$("#client_tab").css("background", '#000000');
	$("#data_tab").css("background", "#000000");
	$("#task_tab").css("background", "#000000");
	$("#bluesheet_tab").css("background", "#000000");
	$("#mailing_tab").css("background", "#000000");
	$("#w_m_tab").css("background", "#000000");
	$("#special_tab").css("background", "#000000");
	
}
function showClientInfo(){
	$("#general_info").hide();
	$("#client_info").show();
	$("#data_info").hide();
	$("#task_list_info").hide();
	$("#blue_sheet_info").hide();
	$("#mailing_info").hide();
	$("#w_m_info").hide();
	$("#special_instructions_info").hide();
	//----------------------------------------
	$("#general_tab").css("background", '#000000');
	$("#client_tab").css("background", '#476d65');
	$("#data_tab").css("background", "#000000");
	$("#task_tab").css("background", "#000000");
	$("#bluesheet_tab").css("background", "#000000");
	$("#mailing_tab").css("background", "#000000");
	$("#w_m_tab").css("background", "#000000");
	$("#special_tab").css("background", "#000000");
	
}
function showDataInfo(){
	$("#general_info").hide();
	$("#client_info").hide();
	$("#data_info").show();
	$("#task_list_info").hide();
	$("#blue_sheet_info").hide();
	$("#mailing_info").hide();
	$("#w_m_info").hide();
	$("#special_instructions_info").hide();
	//-----------------------------------------
	$("#general_tab").css("background", '#000000');
	$("#client_tab").css("background", '#000000');
	$("#data_tab").css("background", "#476d65");
	$("#task_tab").css("background", "#000000");
	$("#bluesheet_tab").css("background", "#000000");
	$("#mailing_tab").css("background", "#000000");
	$("#w_m_tab").css("background", "#000000");
	$("#special_tab").css("background", "#000000");
	
}
function showTaskInfo(){
	$("#general_info").hide();
	$("#client_info").hide();
	$("#data_info").hide();
	$("#task_list_info").show();
	$("#blue_sheet_info").hide();
	$("#mailing_info").hide();
	$("#w_m_info").hide();
	$("#special_instructions_info").hide();
	//-----------------------------------------
	$("#general_tab").css("background", '#000000');
	$("#client_tab").css("background", '#000000');
	$("#data_tab").css("background", "#000000");
	$("#task_tab").css("background", "#476d65");
	$("#bluesheet_tab").css("background", "#000000");
	$("#mailing_tab").css("background", "#000000");
	$("#w_m_tab").css("background", "#000000");
	$("#special_tab").css("background", "#000000");
	
}
function showBlueSheetInfo(){
	$("#general_info").hide();
	$("#client_info").hide();
	$("#data_info").hide();
	$("#task_list_info").hide();
	$("#blue_sheet_info").show();
	$("#mailing_info").hide();
	$("#w_m_info").hide();
	$("#special_instructions_info").hide();
	///---------------------------
	$("#general_tab").css("background", '#000000');
	$("#client_tab").css("background", '#000000');
	$("#data_tab").css("background", "#000000");
	$("#task_tab").css("background", "#000000");
	$("#bluesheet_tab").css("background", "#476d65");
	$("#mailing_tab").css("background", "#000000");
	$("#w_m_tab").css("background", "#000000");
	$("#special_tab").css("background", "#000000");
	
}
function showMailingInfo(){
	$("#general_info").hide();
	$("#client_info").hide();
	$("#data_info").hide();
	$("#task_list_info").hide();
	$("#blue_sheet_info").hide();
	$("#mailing_info").show();
	$("#w_m_info").hide();
	$("#special_instructions_info").hide();
	//-------------------------------------
	$("#general_tab").css("background", '#000000');
	$("#client_tab").css("background", '#000000');
	$("#data_tab").css("background", "#000000");
	$("#task_tab").css("background", "#000000");
	$("#bluesheet_tab").css("background", "#000000");
	$("#mailing_tab").css("background", "#476d65");
	$("#w_m_tab").css("background", "#000000");
	$("#special_tab").css("background", "#000000");
	
}
function showWMInfo(){
	$("#general_info").hide();
	$("#client_info").hide();
	$("#data_info").hide();
	$("#task_list_info").hide();
	$("#blue_sheet_info").hide();
	$("#mailing_info").hide();
	$("#w_m_info").show();
	$("#special_instructions_info").hide();
	//-------------------------------------------
	$("#general_tab").css("background", '#000000');
	$("#client_tab").css("background", '#000000');
	$("#data_tab").css("background", "#000000");
	$("#task_tab").css("background", "#000000");
	$("#bluesheet_tab").css("background", "#000000");
	$("#mailing_tab").css("background", "#000000");
	$("#w_m_tab").css("background", "#476d65");
	$("#special_tab").css("background", "#000000");
	
}
function showSpecialInfo(){
	$("#general_info").hide();
	$("#client_info").hide();
	$("#data_info").hide();
	$("#task_list_info").hide();
	$("#blue_sheet_info").hide();
	$("#mailing_info").hide();
	$("#w_m_info").hide();
	$("#special_instructions_info").show();
	//-----------------------------------------------
	$("#general_tab").css("background", '#000000');
	$("#client_tab").css("background", '#000000');
	$("#data_tab").css("background", "#000000");
	$("#task_tab").css("background", "#000000");
	$("#bluesheet_tab").css("background", "#000000");
	$("#mailing_tab").css("background", "#000000");
	$("#w_m_tab").css("background", "#000000");
	$("#special_tab").css("background", "#476d65");
}
</script>
<script type="text/javascript">

							  var checkList = document.getElementById('list1');
						var items = document.getElementById('items');
								checkList.getElementsByClassName('anchor')[0].onclick = function (evt) {
									if (items.classList.contains('visible')){
										items.classList.remove('visible');
										items.style.display = "none";
									}
									
									else{
										items.classList.add('visible');
										items.style.display = "block";
									}

								}

								items.onblur = function(evt) {
									items.classList.remove('visible');
								}
						</script>
<!----- New Job Ticket ----->
<div class="dashboard-cont" style="padding-top:110px;">
    <div class="contacts-title">
    <h1 class="pull-left">Job Ticket</h1>
    <div class="clear"></div>
    </div>
<div class="dashboard-detail">
    <div class="newcontacts-tabs">
        <!---- Nav Tabs ---->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active" onclick = "showGeneral()"><a id = "general_tab" role="tab" data-toggle="tab" aria-expanded="true" style = "background: #476d65">General Info</a></li>
			<li role="presentation" class="active" onclick = "showClientInfo()"><a id = "client_tab"  role="tab" data-toggle="tab" aria-expanded="true">Client Info</a></li>
			<li role="presentation" class="active" onclick = "showDataInfo()"><a id = "data_tab"  role="tab" data-toggle="tab" aria-expanded="true">Data</a></li>
			<li role="presentation" class="active" onclick = "showTaskInfo()"><a id = "task_tab"  role="tab" data-toggle="tab" aria-expanded="true">Task List</a></li>
			<li role="presentation" class="active" onclick = "showBlueSheetInfo()"><a id = "bluesheet_tab"  role="tab" data-toggle="tab" aria-expanded="true">Blue Sheet</a></li>
			<li role="presentation" class="active" onclick = "showMailingInfo()"><a id = "mailing_tab"  role="tab" data-toggle="tab" aria-expanded="true">Mailing Info</a></li>
			<li role="presentation" class="active" onclick = "showWMInfo()"><a id = "w_m_tab"  role="tab" data-toggle="tab" aria-expanded="true">Weights and Measures</a></li>
			<li role="presentation" class="active" onclick = "showSpecialInfo()"><a id = "special_tab"  role="tab" data-toggle="tab" aria-expanded="true">Special Instructions</a></li>
        </ul>
        <!--- Tab Panes --->
    <div class="newcontactstabs-outer">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
            <div class="newcontactstab-detail" style = "display: 'inline-block'">
            <form action="add_job_ticket.php" method="post">
				<div id = "general_info">
                <div class="newclienttab-inner">
				<table style = "border-style: hidden" border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
						<tbody>
							<tr valign='top'><td colspan='2'><table style = "border-style: hidden" id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Job Name</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Job Type</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Due Date</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Created By</th></tr></thead><tbody>
							<tr><td><input style = "width: 85%;" name="project_name" type="text" class="contact-prefix"></td><td><select name = "job_type"><option selected = "selected" value = "">--Choose Job Type--</option><option value = "Political">Political</option><option value = 'Non-Profit'>Non-Profit</option><option value = "EDDM">EDDM</option><option value = "Parcel">Parcel</option></select></td><td><input id = "due_date" style = "width: 45%" name="due_date" type="date" class="contact-prefix"></td><td><?php
                     
                         
                        $result1 = $conn->query("select first_name, last_name, user from users");
                        echo "<select name='created_by' style = 'width: 60%; margin-right: 40%'>";
						$selected_created_by = $_SESSION["user"];
						$result_selected_user = mysqli_query($conn, "SELECT first_name, last_name from users WHERE user = '$selected_created_by'");
						$row_selected_user = $result_selected_user->fetch_assoc();
						$name = $row_selected_user["first_name"] . " " . $row_selected_user["last_name"];
                        echo "<option selected = 'selected' value = '$selected_created_by'>$name</option>";
                        while ($row1 = $result1->fetch_assoc()) {
                                      unset($created_by);
                                      $created_by = $row1['first_name'] . ' ' . $row1['last_name']; 
                                      echo '<option value="'.$row1['user'].'">'.$created_by.'</option>';
                                      
                        }
                        echo "</select>";
                        ?></td></tr>
						</tbody></table></td></tr></tbody></table>
				</div>
				<div class = "newclienttab-inner" style = "float: left; width 100%; width: 100%; clear: both">
					<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' style = "border-style: hidden">
							<tbody>
							<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><label>Ticket Date</label><input id = "ticket_date" name="ticket_date" type="date" class="contact-prefix" style = "width: 50%; margin-right: 40%"></td><td><?php
                     
                         
                        $result2 = $conn->query("select first_name, last_name, user from users");
                        echo "<label>Assigned to</label><select name='processed_by' style = 'width: 50%; margin-right: 40%'>";
                        echo "<option disabled selected value> -- select an option -- </option>";
                        while ($row2 = $result2->fetch_assoc()) {
                                      //unset($pm);
                                      $processed_by = $row2['first_name']. ' '. $row2['last_name']; 
                                      echo '<option value="'.$row2['user'].'">'.$processed_by.'</option>';
                                      
                        }
                        echo "</select>";
                        ?></td><td><label>Job Status</label><select name='job_status' style = "width: 50%; margin-right: 40%"><option disabled selected value> -- select an option -- </option><option value="in P.M.">in P.M.</option><option value="in Production">in Production</option><option value="on hold">on hold</option><option value="waiting for materials">waiting for materials</option><option value="waiting for data">waiting for data</option><option value="waiting for postage">waiting for postage</option></select></td></tr>
						<tr><td><label>Estimate Number</label><input name="estimate_number" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%"></td><td><label>Estimate date</label><input id = "estimate_date" name="estimate_date" type="date" class="contact-prefix" style = "width: 50%; margin-right: 40%"></td><td><label>Estimate created by</label>
						<select name="estimate_created_by" style = "width: 50%; margin-right: 40%">
						<?php
							$result = mysqli_query($conn, "SELECT * FROM users");
							$count = 1;
							while($row = $result->fetch_assoc()){
								if($count == 1){
									echo "<option selected = 'selected' value = '" . $row['user'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>"; 
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
				</div>
				<div id = "client_info" class = "newclienttab-inner" style = "float: left; width 50%; width: 100%; margin-right: 2%; display: none">
					<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' style = "border-style: hidden">
							<tbody>
							<tr valign='top'><th class='allcontacts-title'><input style = "width: 50%; float: left" id = "client_name" placeholder="Client Name" name="client_name" type="text" class="contact-prefix" autocomplete = "off"><a class = "delete_client_af" href = "#" style = "display: none; font-size: 20px">delete</a></th></tr>
							<tr valign='top'><td colspan='2'><table style = "border-style: hidden" id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><ul class = "client_search_results" style = "list-style-type: none"></ul></td></tr>
							<tr><td><label>Primary Contact</label><input id = "contact_name" name="contact_name" type="text" class="contact-prefix" style = "width: 50%; margin-right: 50%" readonly></td><td><label>Phone</label><input id = "phone" name="phone" type="text" class="contact-prefix" style = "width: 50%; margin-right: 50%" readonly></td></tr>
							<tr><td><label>Email</label><input id = "email" name="email" type="text" class="contact-prefix" style = "width: 50%; margin-right: 50%" readonly></td><td><label>Address</label><input id = "address_line_1" name="address" type="text" class="contact-prefix" style = "width: 50%; margin-right: 50%" readonly></td></tr>
							<tr><td><label>Email 2</label><input id = "email2" name="email2" type="text" class="contact-prefix" style = "width: 50%; margin-right: 50%" readonly></td><td><label>Address 2</label><input id = "address_line_2" name="address2" type="text" class="contact-prefix" style = "width: 50%; margin-right: 50%" readonly></td></tr>
							<tr><td><label>City</label><input id = "city" style = "width: 30%" name="city" type="text" class="contact-prefix" readonly><label>State</label><input id = "state" style = "width: 7%" name="state" type="text" class="contact-prefix" readonly><label>ZIP</label><input id = "zipcode" style = "width: 15%" name="zip" type="text" class="contact-prefix" readonly></td><td><label>Second Contact</label><input id = "second_contact" name="second_contact" type="text" class="contact-prefix" style = "width: 50%; margin-right: 50%" readonly></td></tr>
							<tr><td><label>Fax</label><input id = "fax" name="fax" type="text" class="contact-prefix" style = "width: 20%; margin-right: 80%" readonly></td><td><label>Non Profit Number</label><input id = "non_profit_number" name="non_profit_number" type="text" class="contact-prefix" style = "width: 20%; margin-right: 80%" readonly></td></tr>
							<tr><td><label>CRID</label><input id = "crid" name="crid" type="text" class="contact-prefix" style = "width: 20%; margin-right: 80%" readonly></td><td><div class="newcontact-tabbtm" style = "background-color: #f4f5f7"><input onclick = "showSaveMessage()" class="save_client_info" value="Save Client Changes" name="submit_form" style="display: none; float: left; width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; cursor: pointer" readonly></div></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
				</div>
				<div id = "data_info" class = "newclienttab-inner" style = "float: left; width 50%; width: 100%; display: none">
					<div class='allcontacts-table'><table style = "border-style: hidden" border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><td colspan='2'><table style = "border-style: hidden" id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><label>Data Location</label><input id="file_location" type="file" style = "width: 78%; border-style: hidden"><textarea id = "data_location" style = "height: 10%; width: 78%" name="data_location" type="text" class="contact-prefix"></textarea></td><td><label>Data Source</label><select name = "data_source" style = "width: 50%; margin-right: 50%"><option selected = "selected" value = "Client">Client</option><option value = "BOE">BOE</option><option value = "Recycled">Recycled</option><option value = "Occupants Residency">Occupants Residency</option><option value = "Melissa">Melissa</option><option value = "Master">Master</option><option value = "DataConsulate">DataConsulate</option><option value = "Multiple">Multiple</option><option value = "Real Property">Real Property</option><option value = "Other">Other</option></select></td></tr>
							<tr><td><label>Data Received</label><input id = "data_received" name="data_received" type="date" class="contact-prefix" style = "width: 50%; margin-right: 50%"></td><td><label>Data Completed</label><input id = "data_completed" name="data_completed" type="date" class="contact-prefix" style = "width: 50%; margin-right: 50%"></td></tr>
							<tr><td><label>Processed By</label>
							 <select name="data_processed_by" style = "width: 50%; margin-right: 50%">
							<?php
								$result = mysqli_query($conn, "SELECT * FROM users");
								$count = 1;
								while($row = $result->fetch_assoc()){
									if($count == 1){
										echo "<option selected = 'selected' value = '" . $row['user'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>"; 
									}
									else{
										echo "<option value = '" . $row['user'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>"; 
									}
									 
									$count = $count + 1;
								}
							?></select></td><td><label>Records Total</label><input name="records_total" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%"></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
				</div>
				<div id = "task_list_info" class="newclienttab-inner" style = "float: left; width: 50%; clear: both; display: none">
                    <div class="tabinner-detail">
					<table style = "border-style: hidden" border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
						<tbody>
							<tr valign='top'><td colspan='2'><table style = "border-style: hidden" id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Check</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Task</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Special</th></tr></thead><tbody>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Mail Merge"/></td><td><label>Mail Merge</label></td><td><select name = "special_mail_merge"><option select = 'selected' value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Letter Printing"/></td><td><label>Letter Printing</label></td><td><select name = "special_letter_printing"><option select = 'selected' value = 'From PDF'>From PDF</option><option value = 'Inkjet'>Inkjet</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "In-House Envelope Printing"/></td><td><label>In-House Envelope Printing</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Tabbing"/></td><td><label>Tabbing</label></td><td><select name = "special_tabbing"><option select = 'selected' value = 'Manual Single'>Manual Single</option><option value = 'Manual Double'>Manual Double</option><option value = 'Manual Triple'>Manual Triple</option><option value = 'Auto Single'>Auto Single</option><option value = 'Auto Double'>Auto Double</option><option value = 'Auto Triple'>Auto Triple</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Folding"/></td><td><label>Folding</label></td><td><select name = 'special_folding'><option select = 'selected' value = 'Manual Double Fold'>Manual Double Fold</option><option value = 'Manual Tri Fold'>Manual Tri Fold</option><option value = 'Manual Parallel Fold'>Manual Parallel Fold</option><option value = 'Manual French Fold'>Manual French Fold</option><option value = 'Manual Gate Fold'>Manual Gate Fold</option><option value = 'Manual Half Fold'>Manual Half Fold</option><option value = 'Auto Double Fold'>Auto Double Fold</option><option value = 'Auto Tri Fold'>Auto Tri Fold</option><option value = 'Auto Parallel Fold'>Auto Parallel Fold</option><option value = 'Auto French Fold'>Auto French Fold</option><option value = 'Auto Gate Fold'>Auto Gate Fold</option><option value = 'Auto Half Fold'>Auto Half Fold</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Inserting"/></td><td><label>Inserting</label></td><td><select name = "special_inserting"><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Sealing"/></td><td><label>Sealing</label></td><td><select name = "special_sealing"><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Collating"/></td><td><label>Collating</label></td><td><select name = "special_collating"><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option><option value = 'Man. and Auto'>Man. and Auto</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Labeling"/></td><td><label>Labeling</label></td><td><select name = "special_labeling"><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Print Permit"/></td><td><label>Print Permit</label></td><td><select name = "special_print_permit"><option select = 'selected' value = 'Print'>Print</option><option value = 'Print and Fix'>Print and Fix</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Endorsement line"/></td><td><label>Endorsement line</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Xante Printing"/></td><td><label>Xante Printing</label></td><td></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Inkjet Printing"/></td><td><label>Inkjet Printing</label></td><td><select name = "special_inkjet_printing"><option select = 'selected' value = '11K'>11K</option><option value = '26K'>26K</option><option value = '30K'>30K</option></select></td></tr>
							<tr><td><input style = 'width: 25%' type="checkbox" name = "tasks[]" value = "Glue Dots"/></td><td><label>Glue Dots</label></td><td></td></tr>
						</tbody></table></td></tr></tbody></table>
						</div>
				</div>
				<div id = "blue_sheet_info" class = "newclienttab-inner" style = "float: left; width 100%; width: 50%; display: none">
					<div class='allcontacts-table'><table style = "border-style: hidden" border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><td colspan='2'><table style = "border-style: hidden" id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td> <label>Initial Record Count</label></td><td><input name="initialrec_count" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Manual</label></td><td><input name="manual" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Uncorrected</label></td><td><input name="uncorrected" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Unverifiable</label></td><td><input name="unverifiable" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Foreigns</label></td><td><input name="bs_foreigns" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Domestic</label></td><td><input name="bs_domestic" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Exact</label></td><td><input name="bs_exact" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Loose</label></td><td><input name="loose" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Householded</label></td><td><input name="householded" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Basic</label></td><td><input name="basic" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>NCOA</label></td><td><input name="bs_ncoa" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>NCOA Errors</label></td><td><input name="ncoa_errors" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Final Count</label></td><td><input name="final_count" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Graphic Design Hours</label></td><td><input name="gd_hrs" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Data Hours</label></td><td><input name="data_hrs" type="text" class="contact-prefix"></td></tr>
							<tr><td><label>Explanation(2 hrs. or more)</label></td><td><textarea style = 'height: 150px' name="hrs_explanation" type="text" class="contact-prefix"></textarea></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
				</div>
				<div id = "mailing_info" class = "newclienttab-inner" style = "float: left; width 100%; width: 100%; clear: both; display: none">
					<div class='allcontacts-table'><table style = "border-style: hidden" border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><td colspan='2'><table style = "border-style: hidden" id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><label>Mail Class</label><select name = "mail_class" style = "width: 50%; margin-right: 40%"><option selected = "selected" value = "FCM">FCM</option><option value = "Bulk Standard">Bulk Standard</option><option value = "Non-Profit BLK">Non-Profit BLK</option><option value = "BPM">BPM</option><option value = "Non-profit BPM">Non-profit BPM</option><option value = "Parcel">Parcel</option><option value = "Non-profit Parcel">Non-profit Parcel</option><option value = "Hand Stamp FCM">Hand Stamp FCM</option><option value = "Hand Stamp Bulk">Hand Stamp Bulk</option><option value = "EDDM Retail">EDDM Retail</option><option value = "EDDM Permit">EDDM Permit</option></select></td><td><label>Rate</label><select name = "rate" style = "margin-right: 90%"><option selected = "selected" value = "Auto">Auto</option><option value = "Auto-CRRT">Auto CRRT</option><option value = "Auto-WSS">Auto-WSS</option><option value = "Non-auto">Non-auto</option><option value = "Simplified">Simplified</option></select></td><td><label>Processing Category</label><select name = "processing_category" style = "width: 50%; margin-right: 50%"><option selected = "selected" value = "Flat">Flat</option><option value = "Letter">Letter</option><option value = "Postcard - FCM Only">Postcard - FCM Only</option><option value = 'Parcel'>Parcel</option><option value = 'Bound Printed Matter'>Bound Printed Matter</option></select></td></tr>
							<tr><td><label>Method of Delivery</label><select name="delivery" style = "width: 35%; margin-right: 65%"><option value = "" selected = "selected">--Select Method--</option><option value = "Hand Delivery">Hand Delivery</option><option value = "USPS - BMEU">USPS - BMEU</option><option value = 'USPS - DDU'>USPS - DDU</option><option value = "Priority Mail">Priority Mail</option><option value = 'Client Pickup'>Client Pickup</option></select></td><td><input type="checkbox" name="hold_postage" class="contact-prefix" style = "transform: scale(3.0)"><label style = "margin-left: 4%">Hold Postage</label></td><td><input name="postage_paid" type="checkbox" class="contact-prefix" style = "transform: scale(3.0)"><label style = "margin-left: 4%">Postage Paid</label></td></tr>
							<tr><td><label>Permit</label><select name="permit" id = "permit" style = "width: 50%; margin-right: 40%"><option value = "" selected = "selected">--Choose Permit--</option><option value = "473">473</option><option value = "26 Pre-cancelled">26 Pre-cancelled</option><option value = "Client">Client</option></select></td><td id = "client_no" style = "visibility: hidden"><label>Client #</label><input type = "text" id = "client_no" name="client_no" style = "width: 50%; margin-right: 40%"></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
				</div>
				<div id = "w_m_info" style = "display: none">
				<div class = "newclienttab-inner" style = "float: left; width 100%; width: 100%; clear: both">
					<div class='allcontacts-table'><table style = "border-style: hidden" border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table'>
							<tbody>
							<tr valign='top'><td colspan='2'><table style = "border-style: hidden" id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody>
							<tr><td><label>Based On</label><select id = "based_on" style = "width: 50%; margin-right: 40%" name="based_on" onchange = "addTotalWM()"><option selected = 'selected' value = '0'>--Choose W&M First--</option></select></td><td><label>Total Weights and Measures</label><input id = "total_w_m" name="total_w_m" type="text" class="contact-prefix" placeholder = "Auto Generated" style = "width: 50%; margin-right: 40%"></td><td><label>Mail Dimensions</label><input id = "mail_dimensions" name="mail_dim" type="text" class="contact-prefix" style = "width: 50%; margin-right: 40%"></td></tr>
					</tbody></table></td></tr></tbody></table></div>	
				</div>
				<div class="newclienttab-inner" style = "width: 100%">
                    <div class="tabinner-detail">
                    <a class="pull-right" onclick = 'addWeights_Measures()' style = "cursor: pointer"><h1>+</h1></a>
                    <table id="W_MTable" border="1" cellpadding="1" cellspacing="1" style='text-align: center; vertical-align: middle;'>
                        <thead>
                        <tr>
                            <th style = "display: none">Select</th><th>Vendor</th><th>Material</th><th>Type</th><th>Weight</th><th>Height</th><th>Based On</th><th>Expected Date Received</th><th>CRST Pickup</th><th>Initial</th><th>Location</th><th>Delete</th>
                        </tr>
                        </thead>
                        <tbody id="W_M_tbody">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM materials ORDER BY vendor");
                        while($row = $result->fetch_assoc()){
                                echo "<tr id='1'>
                                        <td style = 'display: none'><input type='checkbox' id='checkbox1' checked name='wm[]' value='" . $row['material_id'] . "'></td>
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
											<select name = 'location1'><option value = '' selected = 'selected'>--Choose Location--</option><option value = '29 Front'>29 Front</option><option value = '29 Middle'>29 Middle</option><option value = '29 Back'>29 Back</option><option value = '31 Front'>31 Front</option><option value = '31 Middle'>31 Middle</option><option value = '31 Back'>31 Back</option></select>
										</td>
                                        <td><p onclick = removeWeights_Measures('#1') style = 'cursor: pointer'>X</p></td>
                                    </tr>";
                                    }
                        ?>
                        </tbody>
                    </table>
					</div>
                </div>
				</div>
					<div id = "special_instructions_info" class="tabinner-detail" style = "display: none;">
                    <textarea name="special_instructions" class="contact-prefix" style = "width: 900px; height: 500px">Production:&#13;&#10; Project Management: &#13;&#10; Data: &#13;&#10; Printing:</textarea>
                    </div>
            </div>
                <div class="newcontact-tabbtm">
                    <input class="save-btn store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
$("#permit").on("change", function(){
	if($("#permit").val() == "Client"){
		$('#client_no').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
	}
	else{
		$("#client_no").css("visibility", "hidden");
	}
});
$(document).ready(function(){
	var date = new Date();
	var nextWeek = new Date(date.getTime() + 7 * 24 * 60 * 60 * 1000);
    document.getElementById("data_received").valueAsDate = date;
	document.getElementById("data_completed").valueAsDate = date;
	document.getElementById("due_date").valueAsDate = nextWeek;
	document.getElementById("ticket_date").valueAsDate = date;
	document.getElementById("estimate_date").valueAsDate = date;
})
//generate search for client names
document.getElementById("client_name").onkeyup = function(){
	var value = document.getElementById("client_name").value;
	$.ajax({
    type: "POST",
    url: "generate_client_search.php",
    data: {id_name: value},
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data_business) {
		$(".client_search_results").empty();
		for(var i = 0; i < data_business.length; i++){
			$(".client_search_results").append("<li class = 'client_search_item' onclick = 'fillInput(\"" + data_business[i] + "\")' style = 'cursor: pointer'>" + data_business[i] + "</li>");
			if(value == ""){
				$(".client_search_results").empty();
			}
		}
		if(data_business.length == 0){
			$(".client_search_results").append("<li><a href = 'add_client.php'>ADD CLIENT</a></li>");
		}
    }
});
};
//on click of client, autofill input
function fillInput(info){
	$("#client_name").val(info);
	$("#client_name").attr("readonly", true);
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
			$("#email2").val(data_info[12]);
			$("#email2").attr("readonly", false);
			$("#address_line_2").val(data_info[13]);
			$("#address_line_2").attr("readonly", false);
			$(".delete_client_af").show();
		}
});
$(".client_search_results").empty();
}
//save client info through ajax call
$(".save_client_info").click(function(){
	var client_id = $(".save_client_info").attr("id");
	var info = [$("#contact_name").val(), $("#phone").val(), $("#email").val(), $("#address_line_1").val(), $("#city").val(), $("#state").val(), $("#zipcode").val(), $("#second_contact").val(), $("#fax").val(), client_id, $("#non_profit_number").val(), $("#crid").val(), $("#email2").val(), $("#address_line_2").val()];
		$.ajax({
		type: "POST",
		url: "job_ticket_save_client_info.php",
		data: {id: info},
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (){
		}
	});
});
//delete autogenerated client fields and hide buttons
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
	$("#email2").val("");
	$("#email2").attr("readonly", true);
	$("#address_line_2").val("");
	$("#address_line_2").attr("readonly", true);
	$(".save_client_info").hide();
	$(".delete_client_af").hide();
	$("#client_name").val("");
	$("#client_name").attr("readonly", false);
});
function showSaveMessage(){
		swal({   title: "Saved!",   text: "This client has been saved.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true});  
};
//put file location as string
$("#file_location").change(function(){
	$("#data_location").val($("#file_location").val());
});
</script>        