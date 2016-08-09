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
	<div><a href="uploadForm.php">upload</a></div>
	</div>
<div class="dashboard-detail">
<div class="newcontacts-tabs">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="#" class="tablinks" onclick="changeTab(event, 'internal')">Internal</a></li>
  <li><a href="#" class="tablinks" onclick="changeTab(event, 'CRM')">CRM</a></li>
  <li><a href="#" class="tablinks" onclick="changeTab(event, 'statistics')">Statistics</a></li>
</ul>

</div>
<div id="CRM" class="tab-content">
<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form id = "search_form" action="vendor_search.php" method="post" >
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific client">
			</form>
			<div class="search-boxright pull-right"><a href="#" onclick = "document.getElementById('search_form').submit()">Submit</a></div>
			<div class="contacts-title">
				<a id = 'advanced_search_button' class="pull-right" href="#" class="add_button" onclick = 'addField()'>Advanced Search</a>
				</div>
		<form class = 'advanced_search_area' action = 'advanced_search_CRM.php' method = 'post'>
		<input id = 'advanced_search_submit' style = 'display: none' type = 'submit' name = 'submit_form_advanced'>
		</form>
		</div>
	</div><br>
<?php

$result = mysqli_query($conn, "SELECT * FROM sales");

echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><td colspan='2'><table id = 'crm_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='job_id' data-index='0'>Client Name</th><th class='maintable-thtwo data-header' data-name='client_name' data-index='1'>Business</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='2'>Address</th><th class='maintable-thtwo data-header' data-name='due_date' data-index='3'>Phone</th><th class='maintable-thtwo data-header' data-name='estimate_number' data-index='4'>City</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='5'>Title</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='5'>Email</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='5'>Website</th></tr></thead><tbody>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$website = $row['web_address'];
		$email = $row['email1'];
		
		if(strlen($website) >= 15){
			$website = substr($website, 0, 15) . "<br>" . "...";
		}
		if(strlen($email) >= 15){
			$email = substr($email, 0, 15) . "<br>" . "...";
		}

		$foo=array();
		array_push($foo, $row['full_name']);
		array_push($foo, $row['address_line_1']);
		$str = serialize($foo);
		$stren = urlencode($str);
		echo "<tr><td><a href = 'edit_client.php?client_info=$stren'>" .$row["full_name"]."</a></td><td>".  $row["business"]."</td><td>". $row["address_line_1"]. "</td><td>". $row["phone"]. "</td><td>" . $row["city"] . "</td><td>". $row['title']. "</td><td>". $email."</td><td>". $website."</td></tr>";
    }
	echo "</tbody></table></td></tr></tbody></table></div>";
} else {
    echo "0 results";
}
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
</div>

<div id="statistics" class="tab-content">
  <h3>Statistics</h3>
  <p>Under Construction</p>
</div>
<div id="internal" class="tab-content">
<h3>In Process</h3><br>
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
echo "<tr valign='top'><th class='allcontacts-title'>All Clients<span class='allcontacts-subtitle'></span></th></tr>";
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
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="sorttable.js"></script>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<script>
var fieldCount = 1;

function addField(){
	     if(fieldCount <= 3){
			$(".advanced_search_area").append("<div class = 'field" + fieldCount + "'><img src = 'images/x_button.png' width = '25' height = '25' onclick = removeField('.field" + fieldCount + "')><input name = 'fieldArea" + fieldCount + "' type = 'text' placeholder = 'Find'>Where<select style = 'width: 125px; font-size: 13px' name = 'select" + fieldCount 
			+ "'><option selected = 'selected' value = 'full_name'>Client Name</option><option value = 'business'>Business</option><option value = 'address_line_1'>Address</option><option value = 'city'>City</option><option value = 'state'>State</option><option value = 'zipcode'>Zipcode</option><option value = 'title'>Title</option>" + 
			"<option value = 'phone'>Phone</option><option value = 'web_address'>Website</option><option value = 'email1'>Email</option></select></div>");
			if(fieldCount == 1){
				document.getElementById("advanced_search_button").innerHTML = "Add Field";
				document.getElementById("advanced_search_submit").style.display = "block";
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

var subtractValue = 3;
var prevSubValue = 4;

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
		if(ul.children[lastIndex + 1].className == "next" || count < 5){
			document.getElementById("next_button").style.display = "none";
		}
	}
}
</script>