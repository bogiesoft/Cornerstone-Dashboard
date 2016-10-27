<?php
require ("header.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Clients</h1>
	<a class="pull-right" href="add_client.php" class="add_button">Add Client</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific client">
			
				<div class="contacts-title">
				<a id = 'advanced_search_button' class="pull-right" href="#" class="add_button" onclick = 'addField()'>Advanced Search</a>
				<a id = 'show_saved_search' class="pull-right" class="add_button" onclick = 'showSavedSearch()' href = "#" style = "background: #ff5c33">Show Saved Search</a>
				</div>
		<form class = 'advanced_search_area' action = 'advanced_search_clients.php' method = 'post'>
							<input id = 'advanced_search_submit' name = 'advanced_search_submit' style = 'display: none; margin-right: 5%; margin-bottom: 5%; background-color: #000000; color: #ffffff' type = 'submit' value = "Search">
							<input id = 'advanced_search_and_save' name = 'advanced_search_and_save' style = 'display: none; margin-bottom: 5%; background-color: #000000; color: #ffffff' type = 'submit' value = "Search and Save">
							<input id = 'advanced_save' name = 'advanced_save' style = 'display: none; margin-bottom: 5%; margin-left: 5%; background-color: #000000; color: #ffffff' type = 'submit' value = "Save">
							<input id = 'advanced_search_name' name = 'advanced_search_name' style = 'display: none; width: 240px; margin-left: 3%; margin-bottom: 3%' type = 'text' placeholder = 'Enter Saved Search Name'>
		</form>
		</div>
		<div id="saved_search_div">
						<table id="saved_search_table" style = 'display: none'>
							<tbody>
								<?php
								$result = mysqli_query($conn, "SELECT * FROM saved_search WHERE table_type = 'Client' ORDER BY search_date DESC LIMIT 10");
								if (mysqli_num_rows($result) > 0) {
							    // output data of each row
									while($row = $result->fetch_assoc()) {
										$field1=$row["field1"];
										$value1=$row["value1"];
										$field2=$row["field2"];
										$value2=$row["value2"];
										$field3=$row["field3"];
										$value3=$row["value3"];
										$search_id=$row["search_id"];
										echo "<tr id = 'row" . $search_id . "'><td class='data-cell'><a href = 'advanced_search_clients.php?field1=$field1&value1=$value1&field2=$field2&value2=$value2&field3=$field3&value3=$value3&search_id=$search_id'>". $row["search_name"]."</a></td><td><button id = '" . $search_id . "'><img src = 'images/x_button.png' width = '25' height = '25'></button></tr>";
									}
								} 
								else {
									echo "0 Saved Searches";
								}
								?>
							</tbody>
						</table>
		</div>
	</div>
	</div>
<div class="clear"></div>



<?php

require ("connection.php");

$result = mysqli_query($conn,"SELECT * FROM sales WHERE type = 'Client'");


echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><td colspan='2'><table id = 'crm_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='job_id' data-index='0'>Client Name</th><th class='maintable-thtwo data-header' data-name='client_name' data-index='1'>Business</th><th class='maintable-thtwo data-header' data-name='due_date' data-index='2'>Phone</th><th class='maintable-thtwo data-header' data-name='estimate_number' data-index='3'>City</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='4'>Zip Code</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='5'>Call Back Date</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='6'>Priority</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='7'>Vertical 1</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='8'>Vertical 2</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='9'>Vertical 3</th></tr></thead><tbody>";


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
		echo "<tr><td class='data-cell'><a href = 'edit_client.php?client_info=$stren'>" .$row["full_name"]."</a></td><td class='data-cell'>".  $row["business"]."</td><td class='data-cell'>". $row["phone"]. "</td><td class='data-cell'>" . $row["city"] . "</td><td class='data-cell'>". $row["zipcode"]. "</td><td class='data-cell'>". $row["call_back_date"]."</td><td class='data-cell'>". $row["priority"]."</td><td class='data-cell'>". $row["vertical1"]."</td><td class='data-cell'>". $row["vertical2"]."</td><td class='data-cell'>". $row["vertical3"]."</td></tr>";
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
		<label>Clients Per Page</label>
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

<!-- script for making table sortable -->
<script src="sorttable.js"></script>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<script type = "text/javascript">
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
			+ "'><option selected = 'selected' value = 'full_name'>Client Name</option><option value = 'business'>Business</option><option value = 'address_line_1'>Address</option><option value = 'city'>City</option><option value = 'state'>State</option><option value = 'zipcode'>Zipcode</option><option value = 'title'>Title</option>" + 
			"<option value = 'phone'>Phone</option><option value = 'web_address'>Website</option><option value = 'email1'>Email</option></select></div>");
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
var numPerPage = 10;
var subtractValue = 3;
var prevSubValue = 4;

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
$("button").click(function(){
    var del_id = $(this).attr("id");
    var info = del_id;
	if(confirm("Are you sure you want to delete"))
	$.ajax({
		url: 'delete_search.php',
		type: 'POST',
		data: {
			id: info
		},
		success: function(){
			document.getElementById("row" + del_id).style.display = "none";
		}
	});
	return false;
});
</script>

	

	

						