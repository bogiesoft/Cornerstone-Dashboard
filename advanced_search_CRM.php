<?php
require ("connection.php");
if(isset($_POST["advanced_save"])){
	$index = 1;
	$fields = array();
	$values = array();
	while($index <= 3){
	  if(isset($_POST['fieldArea' . $index])){
		$find = $_POST['fieldArea' . $index];
		$value = $_POST['select' . $index];
		if($find!=''&& $value!='')
		{
			array_push($fields, $value);
			array_push($values, $find);
		}
	  }
	  
	  $index = $index + 1;
	  
	}
	$search_name = $_POST['advanced_search_name'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d");
	if(count($values) != 0){
		if($search_name == ''){
			$search_name = "Search_" . $values[0] . "_" . $fields[0];
		}
		if($values[0] != ''){
			if(count($fields) == 1){
				$field1 = $fields[0];
				$value1 = $values[0];
				mysqli_query($conn, "INSERT INTO saved_search (search_name, search_date, field1, value1, table_type) VALUES ('$search_name', '$today', '$field1', '$value1', 'CRM')");
			}
			else if(count($fields) == 2){
				$field1 = $fields[0];
				$value1 = $values[0];
				$field2 = $fields[1];
				$value2 = $values[1];
				mysqli_query($conn, "INSERT INTO saved_search (search_name, search_date, field1, value1, field2, value2, table_type) VALUES ('$search_name', '$today', '$field1', '$value1', '$field2', '$value2', 'CRM')");
			}
			else{
				$field1 = $fields[0];
				$value1 = $values[0];
				$field2 = $fields[1];
				$value2 = $values[1];
				$field3 = $fields[2];
				$value3 = $values[2];
				mysqli_query($conn, "INSERT INTO saved_search (search_name, search_date, field1, value1, field2, value2, field3, value3, table_type) VALUES ('$search_name', '$today', '$field1', '$value1', '$field2', '$value2', '$field3', '$value3', 'CRM')");
			}
		}
	}
	header("location: sales.php");
}
require ("header.php");
?>
<script src="saveSearchSweetAlert.js"></script>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Advanced Search Results</h1>
	<a class="pull-right" href="sales.php" class="add_button">Back to Sales</a>
	</div>
<div class="dashboard-detail">
<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific client">
		</div>
	</div>
	</div>
<div class="clear"></div>



<?php
$sql = "";
$fields = array();
$values = array();
if(isset($_POST['advanced_search_submit']) || isset($_POST['advanced_search_and_save'])){
	$sql = $sql . "SELECT * FROM sales WHERE (type = 'Client' or type = 'Prospect')";
	$index = 1;
	while($index <= 3){
	  if(isset($_POST['fieldArea' . $index])){
		$find = $_POST['fieldArea' . $index];
		$value = $_POST['select' . $index];
		if($find!=''&& $value!='')
		{
			$sql = $sql . " AND (" . $value . " = '$find' OR " . $value . " LIKE '%{$find}%')"; 
			array_push($fields, $value);
			array_push($values, $find);
		}
	  }
	  
	  $index = $index + 1;
	  
	}
}
if($sql != ""){
	$result = mysqli_query($conn,$sql) or die("error");
}

if(isset($_POST['advanced_search_and_save'])){
	$search_name = $_POST['advanced_search_name'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d");
	if(count($values) != 0){
		if($search_name == ''){
			$search_name = "Search_" . $values[0] . "_" . $fields[0];
		}
		if($values[0] != ''){
			if(count($fields) == 1){
				$field1 = $fields[0];
				$value1 = $values[0];
				mysqli_query($conn, "INSERT INTO saved_search (search_name, search_date, field1, value1, table_type) VALUES ('$search_name', '$today', '$field1', '$value1', 'CRM')");
			}
			else if(count($fields) == 2){
				$field1 = $fields[0];
				$value1 = $values[0];
				$field2 = $fields[1];
				$value2 = $values[1];
				mysqli_query($conn, "INSERT INTO saved_search (search_name, search_date, field1, value1, field2, value2, table_type) VALUES ('$search_name', '$today', '$field1', '$value1', '$field2', '$value2', 'CRM')");
			}
			else{
				$field1 = $fields[0];
				$value1 = $values[0];
				$field2 = $fields[1];
				$value2 = $values[1];
				$field3 = $fields[2];
				$value3 = $values[2];
				mysqli_query($conn, "INSERT INTO saved_search (search_name, search_date, field1, value1, field2, value2, field3, value3, table_type) VALUES ('$search_name', '$today', '$field1', '$value1', '$field2', '$value2', '$field3', '$value3', 'CRM')");
			}
		}
	}
}
if(!isset($_POST['advanced_search_submit']) && !isset($_POST['advanced_search_and_save'])){
	$search_id = $_GET['search_id'];
	$field1 = $_GET['field1'];
	$value1 = $_GET['value1'];
	$field2 = $_GET['field2'];
	$value2 = $_GET['value2'];
	$field3 = $_GET['field3'];
	$value3 = $_GET['value3'];
	
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d");
	
	mysqli_query($conn, "UPDATE saved_search SET search_date = '$today' WHERE search_id = '$search_id'") or die("ERROR");
	
	if($field2 != "$$$" && $field3 == "$$$"){
		$sql = "SELECT * FROM sales WHERE type != '' AND (" . $field1 . " = '$value1' OR " . $field1 . " LIKE '%{$value1}%') AND (" . $field2 . " = '$value2' OR " . $field2 . " LIKE '%{$value2}%')";
	}
	else if($field3 != "$$$"){
		$sql = "SELECT * FROM sales WHERE type != '' AND (" . $field1 . " = '$value1' OR " . $field1 . " LIKE '%{$value1}%') AND (" . $field2 . " = '$value2' OR " . $field2 . " LIKE '%{$value2}%') AND (" . $field3 . " = '$value3' OR " . $field3 . " LIKE '%{$value3}%')";
	}
	else{
		$sql = "SELECT * FROM sales WHERE type != '' AND (" . $field1 . " = '$value1' OR " . $field1 . " LIKE '%{$value1}%')";
	}
	$result = mysqli_query($conn, $sql) or die("error");
}
echo " <div id = 'table-scroll' class='allcontacts-table'><table id = 'table' border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>All Results<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table id = 'client_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'>
<th id = 'client_name' class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Client Name</th>
<th id = 'contact_name' class='maintable-thtwo data-header' data-name='contact_name' data-index='1'>Business</th>
<th id = 'address' class='maintable-thtwo data-header' data-name='client_add' data-index='2'>Address</th>
<th id = 'city' class='maintable-thtwo data-header' data-name='city' data-index='3'>City</th>
<th id = 'state' class='maintable-thtwo data-header' data-name='state' data-index='4'>State</th>
<th id = 'zipcode' class='maintable-thtwo data-header' data-name='zipcode' data-index='5'>Zipcode</th>
<th id = 'call_back_date' class='maintable-thtwo data-header' data-name='call_back_date' data-index='6'>Call back date</th>

<th id = 'priority' class='maintable-thtwo data-header' data-name='priority' data-index='7'>Priority</th>

<th id = 'title' class='maintable-thtwo data-header' data-name='title' data-index='8'>Title</th>
<th id = 'phone' class='maintable-thtwo data-header' data-name='category' data-index='9'>Phone</th>
<th id = 'email' class='maintable-thtwo data-header' data-name='email' data-index='10'>Email</th>
<th id = 'website' class='maintable-thtwo data-header' data-name='website' data-index='11'>Website</th>
<th id = 'vertical1' class='maintable-thtwo data-header' data-name='vertical1' data-index='12'>Vertical1</th>
<th id = 'vertical2' class='maintable-thtwo data-header' data-name='vertical2' data-index='13'>Vertical2</th>
<th id = 'vertical3' class='maintable-thtwo data-header' data-name='vertical3' data-index='14'>Vertical3</th></tr></thead><tbody>";

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
		echo "<tr class = 'hoverTab'><td><a href = 'edit_client.php?client_info=$stren'>".$row["full_name"].
		"</a></td><td>".  $row["business"]."</td><td>". $row["address_line_1"]. "</td><td>". $row["city"] . "</td><td>". $row["state"] .
		"</td><td>". $row["zipcode"] .
		"</td><td>". $row["call_back_date"]. "</td><td>". $row["priority"]. "</td><td>".$row["title"]."</td><td>". $row["phone"] .
		"</td><td>" .$email."</td><td>". $website . "</td><td>". $row["vertical1"]. "</td><td>". $row["vertical2"]. "</td><td>". $row["vertical3"]. "</td><td><tr>";
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
<script>
var numPerPage = 10;
var subtractValue = 3;
var prevSubValue = 4;

$("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#client_table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    }); 
	
$(document).ready(function() 
    { 
        $("#client_table").tablesorter(); 
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
</script>