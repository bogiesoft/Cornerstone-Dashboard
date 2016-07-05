<?php
require('header.php');
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Production</h1>
	<a class="pull-right" href="#" class="add_button">TimeTracking</a>
	</div>
<div class="dashboard-detail">
<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for job">
		</div>
	</div>
	</div>
	<div class="clear"></div>
<?php
require ("connection.php");
	
$sql = "SELECT * FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id AND mail_data.processed_by = 'RP'"; 
$result = mysqli_query($conn,$sql); 


if ($result->num_rows > 0) {
	
echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Jobs in Production<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table id = 'production_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Client Name</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='1'>Job Name</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='2'>Total Records</th><th class='maintable-thtwo data-header' data-name='quantity' data-index='3'>Quantity</th><th class='maintable-thtwo data-header' data-name='based_on' data-index='4'>Based On</th><th class='maintable-thtwo data-header' data-name='tasks' data-index='5'>Tasks</th><th class='maintable-thtwo data-header' data-name='special_instructions' data-index='6'>Special Instructions</th><th class='maintable-thnine'>Job ID</th></tr></thead><tbody>";

    
	while($row = $result->fetch_assoc()) {
		
		$temp = $row['job_id'];
		$sql1 = "SELECT * FROM mail_data WHERE job_id = '$temp'"; 
		$result1 = mysqli_query($conn,$sql1);
		$row1 = $result1->fetch_assoc();
		$foo = $row['client_name'];
		$sql3 = "SELECT * FROM yellow_sheet WHERE job_id = '$temp'"; 
		$result3 = mysqli_query($conn,$sql3);
		$row3 = $result3->fetch_assoc();
		$sql2 = "SELECT * FROM materials WHERE job_id = '$temp'"; 
		$result2 = mysqli_query($conn,$sql2);
		$row2 = $result2->fetch_assoc();
		$sql4 = "SELECT * FROM mail_info WHERE job_id = '$temp'"; 
		$result4 = mysqli_query($conn,$sql4);
		$row4 = $result4->fetch_assoc();
		$sql5 = "SELECT * FROM production WHERE job_id = '$temp'"; 
		$result5 = mysqli_query($conn,$sql5);
		$row5 = $result5->fetch_assoc();
		

		echo "<tr><td>".  $row["client_name"]."</td><td>".  $row["project_name"]."</td><td>". $row1['records_total']. "</td><td>". $row2['quantity']. "</td><td>". $row2['based_on']. "</td><td>". $row5['tasks']. "</td><td><a href = 'http://localhost/crst_dashboard/special_instructions.php?job_id=$temp' >"."view". "</a></td><td><a href='http://localhost/crst_dashboard/edit_job.php?job_id=$temp'>".$temp."</a></td></tr>";
	}
	
	echo "</tbody></table></td></tr></tbody></table></div>";
	
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
		<label>Clients Per Page</label>
		<select class="per-page-val" id = "item_count" onchange = "changeCount()" >
			<option value="10">10</option>
			<option value="25">25</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select>
	</div>
</div>
<script src="sorttable.js"></script>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<script>

var subtractValue = 3;
var prevSubValue = 4;

$("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#production_table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    }); 
$(document).ready(function() 
    { 
        $("#production_table").tablesorter(); 
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