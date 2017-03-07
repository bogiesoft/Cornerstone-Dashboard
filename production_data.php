<?php
require('header.php');
?>

<div class="dashboard-cont" style="padding-top:110px;">
<div class="contacts-title">
	<h1 class="pull-left">Time Tracker</h1>
	<a class="pull-right" href="production.php" >Back to Production</a>
	</div>
<div class="dashboard-detail">
<form action="add_production_data.php" method="post">
<div><label>Total Records</label><input name = "records" type = "text" id = "records" style = "width: 80px" value = "1"></input><p id = "recs_error" style = "color:red;"></p></div>
  <div class = "prod_info">
  <div class = "new_task">
	<h1>Task 1: </h1>
	<label style = "float: left;">Records/Minute</label><input name = "recs_per_min" type = "text" id = "recs_per_min" style = "float: left; margin-right: 10px; width: 40px; font-size = 18px;" value = "1"></input>
<label style = "float: left;">Job</label><span class = 'job_info'><select style = "float: left; width: 200px" name = "job" id = "job" onchange = "checkSpecial('special')">
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
</select><select id = 'special' name = 'special'><option select = 'selected' value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select></span>
<p id = "error" style = "color: red;"></p>
</div>
</div>
<div style = "margin-top: 50px">
<h1><progress id = "progress_bar" value = "0" max = "40" style = "background-color: red"></progress></h1>
<h2 id = "display_time">Hours: 0</h2>
<h2 id = "eff">Efficiency: </h2>
<input class = "save-btn" type = "submit" value = "Save Data"></input>
</form>
<button type = "button" onclick = "changeBar();">Calculate</button><button type = "button" onclick = "addTask();">Add Task</button><button type = "button" onclick = "removeTask();">Remove Task</button>
</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for data">
		</div>
	</div>
	</div>
<?php
require ("connection.php");

$result = mysqli_query($conn,"SELECT * FROM production_data");


echo " <div id = 'table-scroll' class='allcontacts-table'><table style = 'width: 100%' id = 'table' border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>All Data<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table style = 'width: 100%' id = 'production_data_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th id = 'client_name' class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Task</th><th id = 'client_name' class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Special</th><th id = 'contact_name' class='maintable-thtwo data-header' data-name='contact_name' data-index='1'>Total Records</th><th id = 'address' class='maintable-thtwo data-header' data-name='client_add' data-index='2'>Records/Minute</th><th id = 'address' class='maintable-thtwo data-header' data-name='client_add' data-index='2'>Hours</th></tr></thead><tbody>";


if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		

		$foo=array($row['job'], $row['special']);
		$stren = serialize($foo);
		$stren_url = urlencode($stren);
		echo "<tr class = 'hoverTab'><td><a href = 'edit_production_data.php?id=$stren_url'>".$row["job"]."</a></td><td>".$row["special"]."</td><td>".  $row["total_records"]."</td><td>". $row["recs_per_min"] . "</td><td>" . $row["hours"] . "</td></tr>";
    }
	echo "</tbody></table></td></tr></tbody></table></div>";
} else {
    echo "0 results";
}

$conn->close();
?>
<div class="allcontacts-breadcrumbs">
	<div class="allcontacts-breadcrumbsleft pull-left page-control">
	<nav>
		<ul class = "pagination" id = "pag">
			<li id = 'prev_button' class = 'previous' style = 'display:none;' onclick = "prevPage();">Prev</li>
		</ul>
	</nav>
	</div>
	<div class="items-per-page-cont pull-right">
		<label>Tasks Per Page</label>
		<select class="per-page-val" id = "item_count" onchange = "changeCount()">
			<option value="10">10</option>
			<option value="25">25</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select>
	</div>
</div>
<style>
progress[value]::-webkit-progress-value {
  background-image:
	   -webkit-linear-gradient(-45deg, 
	                           transparent 33%, rgba(0, 0, 0, .1) 33%, 
	                           rgba(0,0, 0, .1) 66%, transparent 66%),
	   -webkit-linear-gradient(top, 
	                           rgba(255, 255, 255, .25), 
	                           rgba(0, 0, 0, .25)),
	   -webkit-linear-gradient(left, #09c, #f44);

    border-radius: 2px; 
    background-size: 35px 20px, 100% 100%, 100% 100%;
}
</style>
<script src="TimeTrackingSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<script src="sorttable.js"></script>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<script>
var numPerPage = 10;
var subtractValue = 3;
var prevSubValue = 4;

$("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#production_data_table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
}); 
$(document).ready(function() 
    { 
        $("#production_data_table").tablesorter(); 
		pageCreator();
    } 
); 
function pageCreator(){
	$('table.table-striped.main-table.contacts-list').each(function() {
		var currentPage = 0;
		numPerPage = parseInt(document.getElementById('item_count').value);
		var $table = $(this);
		var $ul = $('ul.pagination');
		$table.bind('repaginate', function() {
			$table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
		});
		$table.trigger('repaginate');
		var numRows = $table.find('tbody tr').length;
		var numPages = Math.ceil(numRows / numPerPage);
		var count = 1;
		for (var page = 0; page < numPages; page++) {
			var i = $('<li id = id' + count + ' class = "current"></li>').text(page + 1).bind('click', {
				newPage: page
			}, function(event) {
				currentPage = event.data['newPage'];
				$table.trigger('repaginate');
				$(this).addClass('clickable').siblings().removeClass('clickable');
			}).appendTo($ul).addClass('current');
			count = count + 1;
		}
		if(numPages > 5){
			$("<li id = 'next_button' class = 'next' onclick = nextPage();>Next</li>").appendTo($ul);
		}
	});
	document.getElementById("id1").className = "current clickable";
	var ul = document.getElementById("pag");
	
	if(ul.childNodes.length > 5){
		for(var i = 6; i < ul.childNodes.length - 1; i++){
			ul.children[i].style.display = "none";
			document.getElementById("next_button").style.display = "inline";
		}
	}
}
function changeCount(){
	numPerPage = parseInt(document.getElementById('item_count').value);
	$('#pag').empty();
	$("<li id = 'prev_button' class = 'previous' style = 'display:none;' onclick = prevPage();>Prev</li>").appendTo("#pag");
	subtractValue = 1;
	prevSubValue = 2;
	pageCreator();
}
function prevPage(){
	document.getElementById("next_button").style.display = "inline";
	var ul = document.getElementById("pag");
	var length1 = ul.childNodes.length - prevSubValue;
	var oldDisplayIndex = 0;
	for(var i = length1; i >= 1; i--){
		if(ul.children[i].style.display == "inline"){
			oldDisplayIndex = i;
			break;
		}
	}
	
	var newDisplayIndex = 0;
	for(var i = oldDisplayIndex; i >= 1; i--){
		newDisplayIndex = i;
		if(ul.children[i].style.display == "none"){
			break;
		}
		else{
			ul.children[i].style.display = "none";
		}
	}
	
	var count = 0;
	var lastIndex = 0;
	for(var i = newDisplayIndex; i >= 1; i--){
		lastIndex = i;
		if(count == 5){
			break;
		}
		else{
			//alert("Hi");
			ul.children[i].style.display = "inline";
			count = count + 1;
		}
	}
	if(lastIndex == 1){
		document.getElementById("prev_button").style.display = "none";
	}
}
function nextPage(){
	document.getElementById("prev_button").style.display = "inline";
	var ul = document.getElementById("pag");
	
	var displayCount = 0;
	var lastIndexCheck = 0;
	for(var i = 1; i < ul.childNodes.length - 1; i++){
		if(ul.children[i].style.display != "none"){
			displayCount++;
		}
		lastIndexCheck = i;
		if(displayCount == 5){
			break;
		}
	}
	if(lastIndexCheck != ul.childNodes.length - 2){
		var oldDisplayIndex = 0;
		for(var i = 1; i < ul.childNodes.length - 1; i++){
			if(ul.children[i].style.display != "none"){
				oldDisplayIndex = i;
				break;
			}
		}
		
		var newDisplayIndex = 0;
		for(var i = oldDisplayIndex; i < ul.childNodes.length - 1; i++){
			if(ul.children[i].style.display == "none"){
				newDisplayIndex = i;
				break;
			}
			else{
				ul.children[i].style.display = "none";
			}
		}
		
		var count = 0;
		var lastIndex = 0;
		for(var i = newDisplayIndex; i < (ul.childNodes.length - subtractValue); i++){
			if(count == 5){
				break;
			}
			else{
				ul.children[i].style.display = "inline";
				count = count + 1;
				lastIndex = i;
			}
			if(i == ul.childNodes.length){
				break;
			}
		}
		if(count < 5 || ul.children[lastIndex + 1].className == "next"){
			document.getElementById("next_button").style.display = "none";
		}
	}
}
	var recs_min = ["recs_per_min"];
	var job = ["job"];
	var errors = ["error"];
	var jobList = ["Mail Merge", "Letter Printing", "In-House Envelope Printing", "Sealing", "Collating", "Labeling", "Print Permit", "Correct Permit", "Carrier Route", "Endorsement Line", "Address Printing", "Tag as Political", "Inkjet Printing", "Glue Dots", "Inserting", "Printing", "Folding", "Tabbing", "Packaging"];
	var count = 1;
	var Task = 2;
	
	function addTask(){
		$(".prod_info").append("<div class = 'new_task" + count + "'><h1>Task " + Task + ":</h1><label style = 'float: left;'>Records/Minute</label><input name = 'recs_per_min" + count + "' type = 'text' id = 'recs_per_min" + count + "' style = 'float: left; width: 40px; font-size = 18px;' value = '1'></input><label style = 'float: left;'>Job</label><span class = 'job_info" + count + "'><select style = 'float: left;width: 200px;' name = 'job" + count + "' id = 'job" + count + "' onchange = checkSpecial('special" + count + "')></select>");
		for(var i = 0; i < jobList.length; i++){
			var opt = document.createElement('option');
			opt.value = jobList[i];
			opt.innerHTML = jobList[i];
			document.getElementById("job" + count).appendChild(opt);
		}
		$(".prod_info").append("<select id = 'special" + count +  "' name = 'special" + count + "'><option select = 'selected' value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select></span><p id = 'error" + count + "' style = 'color:red;'></p></div>");
		recs_min.push("recs_per_min" + count);
		job.push("job" + count);
		errors.push("error" + count);
		Task = Task + 1;
		count = count + 1;
	}
</script>

<script type = "text/javascript">
	function changeBar(){
		var bar = document.getElementById("progress_bar");
		var recordsNum = document.getElementById("records").value;
		var displayTime = document.getElementById("display_time");
		var displayEff = document.getElementById("eff");
		var totalCalculation = 0;
		var error = false;
		var errorMessage = "";
		
		for(var i = 0; i < recs_min.length; i++){
			
			var recs_per_min = document.getElementById(recs_min[i]).value;
			var errorId = document.getElementById(errors[i]);
			errorId.innerHTML = "";
			document.getElementById("recs_error").innerHTML = "";
			
			
			
			if(/^[0-9]*$/.test(recordsNum) == false || recordsNum.length == 0){
				displayTime.innerHTML =  "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				document.getElementById("recs_error").innerHTML = "Invalid Input";
				error = true;
				break;
			}
			else if(isNaN(recs_per_min) == true){
				
				displayTime.innerHTML =  "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				var TaskNum = i + 1;
				errorMessage = "Character error in Task " + TaskNum;
				errorId.innerHTML = errorMessage;
				error = true;
				break;
			}
			else if(recs_per_min.length == 0)
			{
				displayTime.innerHTML = "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				var TaskNum = i + 1;
				errorMessage = "Field left blank in Task " + TaskNum;
				errorId.innerHTML = errorMessage;
				error = true;
				break;
			}
			else if(recs_per_min == 0)
			{
				totalCalculation = totalCalculation + 0;
			}
			else
			{
				var calculation = parseInt(recordsNum) / parseInt(recs_per_min) / 60;
				totalCalculation = totalCalculation + calculation;
			}
			bar.value = 40 - totalCalculation;
			displayTime.innerHTML = "Hours: " + totalCalculation.toFixed(2);
			if(totalCalculation <= 12)
			{
				displayEff.innerHTML = "Efficiency: High";
				displayEff.style.color = "green";
			}
			else if(totalCalculation <= 36)
			{
				displayEff.innerHTML = "Efficiency: Medium";
				displayEff.style.color = "orange";
			}
			else
			{
				displayEff.innerHTML = "Efficiency: Low";
				displayEff.style.color = "red";
			}
		}
}
function removeTask(){
	count = count - 1;
	Task = Task - 1;
	if(count != 0){
		$(".new_task" + count).remove();
		$("#special" + count).remove();
	}
	else{
		count = count + 1;
		Task = Task + 1;
	}
}
function checkSpecial(id_name){
	var number = id_name[id_name.length-1];
	$("#" + id_name).remove();
	if(!isNaN(number)){
		$("#special0" + number).remove();
		if($("#job" + number).val() == "Mail Merge"){
			$(".job_info" + number).append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select>");
		}
		else if($("#job" + number).val() == "Letter Printing"){
			$(".job_info" + number).append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'From PDF'>From PDF</option><option value = 'Inkjet'>Inkjet</option></select>");
		}
		else if($("#job" + number).val() == "Tabbing"){
			$(".job_info" + number).append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'Manual Single'>Manual Single</option><option value = 'Manual Double'>Manual Double</option><option value = 'Auto Single'>Auto Single</option><option value = 'Auto Double'>Auto Double</option></select>");
		}
		else if($("#job" + number).val() == "Folding" || $("#job" + number).val() == "Inserting" || $("#job" + number).val() == "Sealing"){
			$(".job_info" + number).append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select>");
		}
		else if($("#job" + number).val() == "Collating"){
			$(".job_info" + number).append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option><option value = 'Man. and Auto'>Man. and Auto</option></select>");
		}
		else if($("#job" + number).val() == "Inkjet Printing"){
			$(".job_info" + number).append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = '26K'>26K</option><option value = '11K'>11K</option></select>");
		}
		else{
			$(".job_info" + number).append("<select style = 'visibility: hidden' id = 'special0" + number + "' name = 'special0'><option select = 'selected' value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select>");
		}
	}
	else{
		$("#special0").remove();
		if($("#job").val() == "Mail Merge"){
			$(".job_info").append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select>");
		}
		else if($("#job").val() == "Letter Printing"){
			$(".job_info").append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'From PDF'>From PDF</option><option value = 'Inkjet'>Inkjet</option></select>");
		}
		else if($("#job").val() == "Tabbing"){
			$(".job_info").append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'Manual Single'>Manual Single</option><option value = 'Manual Double'>Manual Double</option><option value = 'Auto Single'>Auto Single</option><option value = 'Auto Double'>Auto Double</option></select>");
		}
		else if($("#job").val() == "Folding" || $("#job").val() == "Inserting" || $("#job").val() == "Sealing"){
			$(".job_info").append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option></select>");
		}
		else if($("#job").val() == "Collating"){
			$(".job_info").append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = 'Manual'>Manual</option><option value = 'Auto'>Auto</option><option value = 'Man. and Auto'>Man. and Auto</option></select>");
		}
		else if($("#job").val() == "Inkjet Printing"){
			$(".job_info").append("<select id = '" + id_name + "' name = '" + id_name + "'><option select = 'selected' value = '26K'>26K</option><option value = '11K'>11K</option></select>");
		}
		else{
			$(".job_info").append("<select style = 'visibility: hidden' id = 'special0' name = 'special0'><option select = 'selected' value = 'Sent to Vendor'>Sent to Vendor</option><option value = 'In-House'>In-House</option></select>");
		}
	}
}
</script>
</div>
</div>