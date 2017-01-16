<?php
require ("header.php");
?>


<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
		<h1 class="pull-left">Sales</h1>
	</div>
	<div class="dashboard-detail">

<div id="internal" class="tab-content">
 <?php

$job_count = 1;
$result = mysqli_query($conn, "SELECT * FROM job_ticket WHERE processed_by = ''");
while($row = $result->fetch_assoc()){
	if(isset($_POST['assign_to' . $job_count])){
		$user_name = $_SESSION['user'];
		date_default_timezone_set('America/New_York');
		$today = date("Y-m-d G:i:s");
		$a_p = date("A");
		$job_id = $row["job_id"];
		$job = "updated job ticket " . $job_id;
		$processed_by = $_POST['assign_to' . $job_count];
		mysqli_query($conn, "UPDATE job_ticket SET processed_by = '$processed_by' WHERE job_id = '$job_id'");
		$result_processed_by = mysqli_query($conn, "SELECT processed_by FROM job_ticket WHERE job_id = '$job_id'");
		$row_processed_by = $result_processed_by->fetch_assoc();
		$processed_by = $row_processed_by['processed_by'];
		$sql100 = "INSERT INTO timestamp (user,time,job, a_p,processed_by,viewed) VALUES ('$user_name', '$today','$job', '$a_p','$processed_by','no')";
		$result100 = $conn->query($sql100) or die('Error querying database 101.');
	}

	$job_count = $job_count + 1;
}

$result = mysqli_query($conn,"SELECT * FROM job_ticket WHERE processed_by = ''");


echo " <div id = 'table-scroll' class='allcontacts-table'><table id = 'table' border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Current Job Tickets<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table id = 'client_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th id = 'client_name' class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Job ID</th><th id = 'client_name' class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Assign to</th><th id = 'contact_name' class='maintable-thtwo data-header' data-name='contact_name' data-index='1'>Client Name</th><th id = 'address' class='maintable-thtwo data-header' data-name='client_add' data-index='2'>Project Name</th><th id = 'phone' class='maintable-thtwo data-header' data-name='contact_phone' data-index='3'>Due Date</th><th id = 'email' class='maintable-thtwo data-header' data-name='contact_email' data-index='4'>Estimate Number</th><th id = 'website' class='maintable-thtwo data-header' data-name='website' data-index='5'>Job Status</th></tr></thead><tbody>";

if ($result->num_rows > 0) {
    // output data of each row
	$job_count = 1;
    while($row = $result->fetch_assoc()) {
		$job_id = $row["job_id"];
		echo "<tr class = 'hoverTab'><td><a href = 'edit_job.php?job_id=$job_id'>".$row["job_id"]."</a></td><td>";
		echo "<form method = 'post' action = ''>";
		echo "<select name = 'assign_to" . $job_count . "' style = 'font-size: 10px; width: 80px' onchange = 'this.form.submit()'>";
		$processed_by = $row['processed_by'];
		echo "<option selected = 'selected' value = ''>" . $processed_by . "</option>";
		$sql = "SELECT first_name, last_name, user FROM users";
		$result1 = mysqli_query($conn, $sql);
		while($row1 = $result1->fetch_assoc()){
			echo "<option value = '" . $row1['user'] . "'>" . $row1['first_name'] . ' ' .  $row1['last_name'] . "</option>";

		}
		echo "</select></form>";
		echo "</td><td>" .  $row["client_name"]."</td><td>". $row["project_name"]. "</td><td>". $row["due_date"] . "</td><td>". $row["estimate_number"]. "</td><td>". $row["job_status"]. "</td></tr>";
		$job_count = $job_count + 1;
    }
	echo "</tbody></table></td></tr></tbody></table></div>";
} else {
    echo "0 results";
}
?>


</div>
</div>
</div>
</div>

<script src="sorttable.js"></script>
<script type="text/javascript" src="jquery.tablesorter.js"></script>
<script type='text/javascript'>

var fieldCount = 1;
function showSavedSearch(){
	if(document.getElementById('show_saved_search').innerHTML == "Show Saved Search"){
		document.getElementById('saved_search_table').style.display = "block";
		document.getElementById('show_saved_search').innerHTML = "Hide Saved Search";
	}
	else{
		document.getElementById('saved_search_table').style.display = "none";
		document.getElementById('show_saved_search').innerHTML = "Show Saved Search";
	}
}
function addField(){
	     if(fieldCount <= 3){
			$(".advanced_search_area").append("<div class = 'field" + fieldCount + "'><img src = 'images/x_button.png' width = '25' height = '25' onclick = removeField('.field" + fieldCount + "')><input style = 'margin-bottom: 4%' name = 'fieldArea" + fieldCount + "' type = 'text' placeholder = 'Find'>Where<select style = 'width: 125px; font-size: 13px' name = 'select" + fieldCount
			+ "'><option selected = 'selected' value = 'full_name'>Client Name</option><option value = 'business'>Business</option><option value = 'address_line_1'>Address</option><option value = 'city'>City</option><option value = 'state'>State</option><option value = 'zipcode'>Zipcode</option><option value = 'call_back_date'>Call Back Date</option><option value = 'priority'>Priority</option><option value = 'title'>Title</option>" +"<option value = 'phone'>Phone</option><option value = 'web_address'>Website</option><option value = 'email1'>Email</option><option value = 'vertical1'>Vertical1</option><option value = 'vertical2'>Vertical2</option><option value = 'vertical3'>Vertical3</option></select></div>");
			if(fieldCount == 1){
				document.getElementById("advanced_search_button").innerHTML = "Add Field";
				document.getElementById("advanced_search_submit").style.display = "inline";
				document.getElementById("advanced_search_and_save").style.display = "inline";
				document.getElementById("advanced_search_name").style.display = "inline";
				document.getElementById("advanced_save").style.display = "inline";
			}

			fieldCount++;
		 }
}
function removeField(x){
	$(x).remove();
	fieldCount--;
	if(fieldCount == 1){
		document.getElementById("advanced_search_button").innerHTML = "Advanced Search";
		document.getElementById("advanced_search_submit").style.display = "none";
		document.getElementById("advanced_search_and_save").style.display = "none";
		document.getElementById("advanced_search_name").style.display = "none";
		document.getElementById("advanced_save").style.display = "none";
	}
}
function changeTab(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

var numPerPage = 10;
var subtractValue = 3;
var prevSubValue = 5;

$("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#crm_table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();
        });
    });

$(document).ready(function()
    {
        $("#crm_table").tablesorter();
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


function exportTableToCSV($table, filename) {
		var $headers = $table.find('tr:has(th)')
				,$rows = $table.find('tr:has(td:has(input:checked))')
				// Temporary delimiter characters unlikely to be typed by keyboard
				// This is to avoid accidentally splitting the actual contents
				,tmpColDelim = String.fromCharCode(11) // vertical tab character
				,tmpRowDelim = String.fromCharCode(0) // null character
				// actual delimiter characters for CSV format
				,colDelim = '","'
				,rowDelim = '"\r\n"';
				// Grab text from table into CSV formatted string
				var csv = '"';
				csv += formatRows($headers.map(grabRow));
				csv += rowDelim;
				csv += formatRows($rows.map(grabRow)) + '"';
				// Data URI
				var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
		$(this)
				.attr({
				'download': filename
						,'href': csvData
						//,'target' : '_blank' //if you want it to open in a new window
		});
		//------------------------------------------------------------
		// Helper Functions
		//------------------------------------------------------------
		// Format the output so it has the appropriate delimiters
		function formatRows(rows){
				return rows.get().join(tmpRowDelim)
						.split(tmpRowDelim).join(rowDelim)
						.split(tmpColDelim).join(colDelim);
		}
		// Grab and format a row from the table
		function grabRow(i,row){

				var $row = $(row);
				//for some reason $cols = $row.find('td') || $row.find('th') won't work...
				var $cols = $row.find('td:not(:first-child)');
				if(!$cols.length) $cols = $row.find('th:not(:first-child)');
				return $cols.map(grabCol)
										.get().join(tmpColDelim);
		}
		// Grab and format a column from the table
		function grabCol(j,col){
				var $col = $(col),
						$text = $col.text();
				return $text.replace('"', '""'); // escape double quotes
		}
}

// This must be a hyperlink
$("#export").click(function (event) {
		// var outputFile = 'export'
		var outputFile = window.prompt("What do you want to name your output file (Note: This won't have any effect on Safari)") || 'export';
		outputFile = outputFile.replace('.csv','') + '.csv'

		// CSV
		exportTableToCSV.apply(this, [$('#inside_table>table'), outputFile]);

		// IF CSV, don't do event.preventDefault() or return false
		// We actually need this to be a typical hyperlink
});

$("#view_marked").click(function(){
    $("#inside_table>table tr").has(".check-box:not(:checked)").css("display", "none");;
});


// $("button").click(function(){
//     var del_id = $(this).attr("id");
//     var info = del_id;
// 	if(confirm("Are you sure you want to delete"))
// 	$.ajax({
// 		url: 'delete_search.php',
// 		type: 'POST',
// 		data: {
// 			id: info
// 		},
// 		success: function(){
// 			document.getElementById("row" + del_id).style.display = "none";
// 		}
// 	});
// 	return false;
// });
</script>
