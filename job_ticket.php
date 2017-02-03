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
        $.ajax({
        url: 'getMaterialsID.php',
        type: 'post',
        data:{vendor:vendor,material:material,type:type},
        success: function(data){
            var result=jQuery.parseJSON(data);
            $.each(result,function( index, value ) {
                $("#checkbox"+row_id).attr("value", value);
            });
        }
    });
 
};
function addWeights_Measures(){
    if(number_of_rows<20){
        number_of_rows=number_of_rows+1;
        id_of_row=id_of_row+1;
        $("#W_M_tbody").append( "<tr id='"+id_of_row+"'><td >           <input type='checkbox' id='checkbox"+id_of_row+"'checked name='wm[]' value=''>        </td>     <td>          <select class='vendors' id='vendors"+id_of_row+"' name='vendor' style='width:220px;'>             <option value=''>Select</option>            </select>     </td>     <td>          <select class='materials' id='materials"+id_of_row+"' name='material' style='width:220px;'>               <option value=''>Select</option>            </select>     </td>     <td>          <select class='types' id='types"+id_of_row+"' name='vendor' style='width:220px;'>             <option value=''>Select</option>            </select>     </td> <td><img src = 'images/x_button.png' width = '25' height = '25' onclick = removeWeights_Measures('#" + id_of_row + "')></td>  </tr>");
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
    $(row_id).remove();
    number_of_rows--;
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
            <li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Create a Job Ticket</a></li>
        </ul>
        <!--- Tab Panes --->
    <div class="newcontactstabs-outer">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
            <div class="newcontactstab-detail">
            <form action="add_job_ticket.php" method="post">
                <div class="newclienttab-inner">
                    <div class="tabinner-detail">
                    <label>Client</label>
                    <input placeholder="Start typing name to bring down list" name="client_name" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Job Name</label>
                    <input name="project_name" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Ticket Date</label>
                    <input name="ticket_date" type="date" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Due Date</label>
                    <input name="due_date" type="date" class="contact-prefix">
                    </div>
                    <?php
                     
                         
                        $result1 = $conn->query("select first_name, last_name, user from users");
                        echo("<div class='tabinner-detail'>");
                        echo "<label>Created By</label><select name='created_by'>";
                        echo "<option disabled selected value> -- select an option -- </option>";
                        while ($row1 = $result1->fetch_assoc()) {
                                      unset($created_by);
                                      $created_by = $row1['first_name'] . ' ' . $row1['last_name']; 
                                      echo '<option value="'.$row1['user'].'">'.$created_by.'</option>';
                                      
                        }
                        echo "</select>";
                        echo "</div>";
                        ?>
                     
                    <div class="tabinner-detail">
                    <label>Estimate Number</label>
                    <input name="estimate_number" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Estimate date</label>
                    <input name="estimate_date" type="date" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Estimate created by</label>
                    <select name="estimate_created_by">
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
                    </select>
                    </div>
                    <div class="tabinner-detail">
                    <label>Materials Ordered</label>
                    <input name="materials_ordered" type="date" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Materials Expected</label>
                    <input name="materials_expected" type="date" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Expected Quantity</label>
                    <input name="expected_quantity" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Job Status</label>
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
                    <div class="tabinner-detail">
                    <label>Mail Class</label>
                    <input name="mail_class" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Rate</label>
                    <input name="rate" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Processing Category</label>
                    <input name="processing_category" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Mail Dimensions</label>
                    <input name="mail_dim" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Permit</label>
                    <input name="permit" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Bmeu</label>
                    <input name="bmeu" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Based On</label>
                    <input name="based_on" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Non Profit Number</label>
                    <input name="non_profit_number" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Records Total</label>
                    <input name="records_total" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Data Source</label>
                    <input name="data_source" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Data Received</label>
                    <input name="data_received" type="date" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Data Completed</label>
                    <input name="data_completed" type="date" class="contact-prefix">
                    </div>
                    <?php
                     
                         
                        $result2 = $conn->query("select first_name, last_name, user from users");
                        echo("<div class='tabinner-detail'>");
                        echo "<label>Assigned to</label><select name='processed_by'>";
                        echo "<option disabled selected value> -- select an option -- </option>";
                        while ($row2 = $result2->fetch_assoc()) {
                                      //unset($pm);
                                      $processed_by = $row2['first_name']. ' '. $row2['last_name']; 
                                      echo '<option value="'.$row2['user'].'">'.$processed_by.'</option>';
                                      
                        }
                        echo "</select>";
                        echo "</div>";
                        ?>
                     
                    <div class="tabinner-detail">
                    <label>DQR Sent</label>
                    <input name="dqr_sent" type="date" class="contact-prefix">
                    </div>
                     
                    <div class="tabinner-detail">
                    <input type="checkbox" name="hold_postage" class="contact-prefix" ><label>Hold Postage</label>
                    </div>
                    <div class="tabinner-detail">
                    <input name="postage_paid" type="checkbox" class="contact-prefix"><label>Postage Paid</label>
                    </div>
                    <div class="tabinner-detail">
                    <label>Print Template</label>
                    <input name="print_template" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Special Address Formatting</label>
                    <input name="special_address" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Method of Delivery</label>
                    <input name="delivery" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
							<label>Tasks</label>

							<div id="list1" class="dropdown-check-list" tabindex="100">
							<span class="anchor">Select Tasks</span>
							<ul name = "item" id="items" class="items">
								<li><input type="checkbox" name = "tasks[]" value = "Mail Merge"/>Mail Merge</li>
								<li><input type="checkbox" name = "tasks[]" value = "Letter Printing"/>Letter Printing</li>
								<li><input type="checkbox" name = "tasks[]" value = "In-House Envelope Printing"/>In-House Envelope Printing</li>
								<li><input type="checkbox" name = "tasks[]" value = "Tabbing"/>Tabbing </li>
								<li><input type="checkbox" name = "tasks[]" value = "Folding"/>Folding </li>
								<li><input type="checkbox" name = "tasks[]" value = "Inserting"/>Inserting </li>
								<li><input type="checkbox" name = "tasks[]" value = "Sealing"/>Sealing</li>
								<li><input type="checkbox" name = "tasks[]" value = "Collating"/>Collating</li>
								<li><input type="checkbox" name = "tasks[]" value = "Labeling"/>Labeling</li>
								<li><input type="checkbox" name = "tasks[]" value = "Print Permit"/>Print Permit</li>
								<li><input type="checkbox" name = "tasks[]" value = "Correct Permit"/>Correct Permit</li>
								<li><input type="checkbox" name = "tasks[]" value = "Carrier Route"/>Carrier Route</li>
								<li><input type="checkbox" name = "tasks[]" value = "Endorsement line"/>Endorsement line</li>
								<li><input type="checkbox" name = "tasks[]" value = "Address Printing"/>Address Printing</li>
								<li><input type="checkbox" name = "tasks[]" value = "Tag as Political"/>Tag as Political</li>
								<li><input type="checkbox" name = "tasks[]" value = "Inkjet Printing"/>Inkjet Printing</li>
								<li><input type="checkbox" name = "tasks[]" value = "Glue Dots"/>Glue Dots</li>
							</ul>
						</div>

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
				
					</div>
                     
                    <div class="tabinner-detail">
                    <label>Completed Date</label>
                    <input name="completed_date" type="date" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Data Hours</label>
                    <input name="data_hrs" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Graphic Design Hours</label>
                    <input name="gd_hrs" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Initial Record Count</label>
                    <input name="initialrec_count" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Manual</label>
                    <input name="manual" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Uncorrected</label>
                    <input name="uncorrected" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Unverifiable</label>
                    <input name="unverifiable" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Foreigns</label>
                    <input name="bs_foreigns" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Exact</label>
                    <input name="bs_exact" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Loose</label>
                    <input name="loose" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Householded</label>
                    <input name="householded" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Basic</label>
                    <input name="basic" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>NCOA Errors</label>
                    <input name="ncoa_errors" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Domestic</label>
                    <input name="bs_domestic" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>NCOA</label>
                    <input name="bs_ncoa" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Final Count</label>
                    <input name="final_count" type="text" class="contact-prefix">
                    </div>
                    <div class="tabinner-detail">
                    <label>Weights and Measures</label>
                    <a class="pull-right" onclick = 'addWeights_Measures()'>Add Weights and Measures</a>
                    <table id="W_MTable" border="1" cellpadding="1" cellspacing="1" style='text-align: center; vertical-align: middle;'>
                        <thead>
                        <tr>
                            <th>Select</th><th>Vendor</th><th>Material</th><th>type</th><th>Delete</th>
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
                                        <td><img src = 'images/x_button.png' width = '25' height = '25' onclick = removeWeights_Measures('#1')></td>
                                    </tr>";
                                    }
                        ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="tabinner-detail">
                    <label>Special Instructions</label>
                    <textarea name="special_instructions" class="contact-prefix"></textarea>
                    </div>
 
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
        