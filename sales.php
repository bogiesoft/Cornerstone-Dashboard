<?php
require ("header.php");
?>
<style>
ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Float the list items side by side */
ul.tab li {float: left;}

/* Style the links inside the list items */
ul.tab li a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.tab li a:hover {background-color: #ddd;}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {background-color: #ccc;}

/* Style the tab content */
.tab-content {
    display: none;
}
#internal{
	display: block;
}
</style>
<div class="dashboard-cont" style="padding-top:110px;">
<div class="contacts-title">
	<h1 class="pull-left">Sales</h1>
	</div>
<div class="dashboard-detail">
<div class="newcontacts-tabs">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="#" class="tablinks" onclick="changeTab(event, 'internal')">Internal</a></li>
  <li><a href="#" class="tablinks" onclick="changeTab(event, 'CRM')">CRM</a></li>
  <li><a href="#" class="tablinks" onclick="changeTab(event, 'statistics')">Statistics</a></li>
</ul>
<div id="internal" class="tab-content">
 <?php
require ("connection.php");

$result = mysqli_query($conn,"SELECT job_ticket.job_id, job_ticket.client_name, job_ticket.project_name, job_ticket.due_date, job_ticket.estimate_number, mail_data.records_total FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id AND mail_data.processed_by = ''");

echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Job Tickets in Process<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table id = 'sales_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='job_id' data-index='0'>Job ID</th><th class='maintable-thtwo data-header' data-name='client_name' data-index='1'>Client Name</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='2'>Job Name</th><th class='maintable-thtwo data-header' data-name='due_date' data-index='3'>Due Date</th><th class='maintable-thtwo data-header' data-name='estimate_number' data-index='4'>Estimate #</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='5'>Total Records</th></tr></thead><tbody>";

if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		$foo = $row['job_id'];
		echo "<tr><td><a href='edit_job.php?job_id=$foo'>".$row["job_id"]."</a></td><td>".  $row["client_name"]."</td><td>". $row["project_name"]. "</td><td>". $row["due_date"]. "</td><td>". $row["estimate_number"]."</td><td>". $row["records_total"]. "</td></tr>";
    }
	echo "</tbody></table></td></tr></tbody></table></div>";
} else {
    echo "0 results";
}
//class='paginated'
?>
<div class="allcontacts-breadcrumbs">
	<div class="allcontacts-breadcrumbsleft pull-left page-control">
		<nav>
			<ul class="pagination" id = "pag">
				<li id = 'prev_button' class = 'previous' style = 'display:none;' onclick = "prevPage();">Prev</li>
			</ul>
		</nav>
	</div>
	<div class="items-per-page-cont pull-right">
		<label>Jobs Per Page</label>
		<select class="per-page-val" id = "item_count" onchange = "changeCount()">
			<option value="10">10</option>
			<option value="25">25</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select>
	</div>
</div>
</div>

<div id="CRM" class="tab-content">
<h3>CRM</h3>
<p>Under Construction</p>
</div>

<div id="statistics" class="tab-content">
  <h3>Statistics</h3>
  <p>Under Construction</p>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="sorttable.js"></script>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<script>

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
var subtractValue = 3;
var prevSubValue = 4;

$(document).ready(function() 
    { 
        $("#sales_table").tablesorter(); 
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
		if(ul.children[lastIndex + 1].className == "next" || count < 5){
			document.getElementById("next_button").style.display = "none";
		}
	}
}
</script>