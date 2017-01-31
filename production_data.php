<?php
require('header.php');
?>

<div class="dashboard-cont" style="padding-top:110px;">
<div class="contacts-title">
	<h1 class="pull-left">Production Data Manager</h1>
	<a class="pull-right" href="production.php" >Back to Production</a>
	</div><br><br><br><br>
<form action="add_production_data.php" method="post">
<div>Total Records &nbsp; <br><input name = "records" type = "text" id = "records" style = "width: 80px" value = "1"></input></div><p id = "recs_error" style = "color:red;"></p><br><br>
  <div class = "prod_info">
	<h1>Task 1: </h1>
	<label style = "float: left;">Time/Unit</label> &nbsp; <input name = "time_number" type = "text" id = "time_number" style = "float: left; margin-right: 10px; width: 40px; font-size = 18px;" value = "1"></input><select style = "float:left;" name = "time_unit" id = "time_unit"><option>min.</option><option>sec.</option><option>hr.</option></select>
	<label style = "float: left;">Records Complete in Time</label> &nbsp; <input style = "float: left; width: 40px" name = "per_rec" type = "text" id = "per_rec" value = "1"></input> &nbsp; &nbsp;
<label style = "float: left;">Job</label> &nbsp; <select style = "float: left; width: 200px" name = "job" id = "job">
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
</select><br><br>
<p id = "error" style = "color: red;"></p>
</div><br>
<h1><progress id = "progress_bar" value = "0" max = "40" style = "background-color: red"></progress></h1><br>
<h2 id = "display_time">Hours: 0</h2><br>
<h2 id = "eff">Efficiency: </h2><br>
<input class = "save-btn" type = "submit" value = "Save Data"></input>
</form>
<button type = "button" onclick = "changeBar();">Calculate</button><button type = "button" onclick = "addTask();">Add Task</button><button type = "button" onclick = "removeTask();">Remove Task</button><br><br><br>
<div class="contacts-title">
	<h1 class="pull-left">Production Time Data</h1>
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
echo "<tr valign='top'><td colspan='2'><table style = 'width: 100%' id = 'production_data_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th id = 'client_name' class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Tasks</th><th id = 'contact_name' class='maintable-thtwo data-header' data-name='contact_name' data-index='1'>Total Hours</th><th id = 'address' class='maintable-thtwo data-header' data-name='client_add' data-index='2'>Records Based On</th></tr></thead><tbody>";


if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		

		$foo=$row['id'];
		echo "<tr class = 'hoverTab'><td><a href = 'edit_production_data.php?id=$foo'>".$row["job"]."</a></td><td>".  $row["hours"]."</td><td>". $row["total_records"] . "</td></tr>";
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
	var time_number = ["time_number"];
	var time_unit = ["time_unit"];
	var recs_comp = ["per_rec"];
	var people = ["people"];
	var employee = ["employee[]"];
	var job = ["job"];
	var errors = ["error"];
	var jobList = ["Mail Merge", "Letter Printing", "In-House Envelope Printing", "Sealing", "Collating", "Labeling", "Print Permit", "Correct Permit", "Carrier Route", "Endorsement Line", "Address Printing", "Tag as Political", "Inkjet Printing", "Glue Dots", "Inserting", "Printing", "Folding", "Tabbing", "Packaging"];
	var count = 1;
	var Task = 2;
	
	function addTask(){
		$(".prod_info").append("<div class = 'new_task" + count + "'><h1>Task " + Task + ":</h1><label style = 'float: left;'>Time/Unit</label> &nbsp; <input name = 'time_number" + count + "' type = 'text' id = 'time_number" + count + "' style = 'float: left; width: 40px; font-size = 18px;' value = '1'> &nbsp; </input><select style = 'float: left;' name = 'time_unit" + count + "' id = 'time_unit" + count + "'><option>min.</option><option>sec.</option><option>hr.</option></select> <label style = 'float: left;'>Records Complete in Time<label> &nbsp; <input name = 'per_rec" + count + "' type = 'text' id = 'per_rec" + count + "' style = 'float: left; width: 40px' value = '1'></input> &nbsp; &nbsp; <label style = 'float: left;'>Job</label> &nbsp; <select style = 'float: left;width: 200px;' name = 'job" + count + "' id = 'job" + count + "'></select><br><p id = 'error" + count + "' style = 'color:red;'></p></div>");
		//$(".prod_info").append("&nbsp;<label style = 'float:left'>Number of People</label> &nbsp;<select style = 'float:left;' name = 'people" + count + "' id = 'people" + count + "'>");
		//$(".prod_info").append("</select>");
		//$(".prod_info").append("&nbsp; <label style = 'float: left;'>Job</label> &nbsp; <select style = 'float: left;width: 200px;' name = 'job" + count + "' id = 'job" + count + "'>");
		for(var i = 0; i < jobList.length; i++){
			var opt = document.createElement('option');
			opt.value = jobList[i];
			opt.innerHTML = jobList[i];
			document.getElementById("job" + count).appendChild(opt);
		}
		//$(".prod_info").append("</select><br>");
		//$(".prod_info").append("<p id = 'error" + count + "' style = 'color:red;'></p><br>");
		time_number.push("time_number" + count);
		time_unit.push("time_unit" + count);
		recs_comp.push("per_rec" + count);
		people.push("people" + count);
		employee.push("employee" + count);
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
		
		for(var i = 0; i < time_number.length; i++){
			
			var recsPer = document.getElementById(recs_comp[i]).value;
			var time = document.getElementById(time_number[i]).value;
			var unit = document.getElementById(time_unit[i]);
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
			else if(/^[0-9]*$/.test(recsPer) == false || /^[0-9]*$/.test(time) == false){
				
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
			else if(recsPer.length == 0 || time.length == 0)
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
			else if(recordsNum == 0 || recsPer == 0 || time == 0)
			{
				totalCalculation = totalCalculation + 0;
			}
			else
			{
				if(unit.value == "min."){
					var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time) / 60;
					totalCalculation = totalCalculation + calculation;
				}
				else if(unit.value == "sec.")
				{
					var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time) / 3600;
					totalCalculation = totalCalculation + calculation;
				}
				else if(unit.value == "hr.")
				{
					var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time);
					totalCalculation = totalCalculation + calculation;
				}
			}
			bar.value = 40 - totalCalculation;
			displayTime.innerHTML = "Hours: " + totalCalculation;
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
	}
	else{
		count = count + 1;
		Task = Task + 1;
	}
}
</script>

</div>