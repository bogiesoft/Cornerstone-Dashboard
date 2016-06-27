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
			<form action="client_search.php" method="post" >
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific client">
			</form>
			<div class="search-boxright pull-right"><a href="#">Submit</a></div>
		</div>
	</div>
	</div>
<div class="clear"></div>

<style>
.hoverTab { 
   background: #f1f1f1; 
}
.hoverTab td a { 
   display: block; 
   padding: 16px; 
   text-decoration: none;
   color: black;
}
#client_name:hover{
	background: #0047b3;
	color: #ffffff;
}
#contact_name:hover{
	background: #0047b3;
	color: #ffffff;
}
#address:hover{
	background: #0047b3;
	color: #ffffff;
}
#phone:hover{
	background: #0047b3;
	color: #ffffff;
}
#email:hover{
	background: #0047b3;
	color: #ffffff;
}
#website:hover{
	background: #0047b3;
	color: #ffffff;
}
#category:hover{
	background: #0047b3;
	color: #ffffff;
}
#title:hover{
	background: #0047b3;
	color: #ffffff;
}
</style>

<?php

require ("connection.php");

$result = mysqli_query($conn,"SELECT * FROM client_info");


echo " <div id = 'table-scroll' class='allcontacts-table'><table id = 'table' border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>All Clients<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table id = 'client_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th id = 'client_name' class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Client Name</th><th id = 'contact_name' class='maintable-thtwo data-header' data-name='contact_name' data-index='1'>Contact Name</th><th id = 'address' class='maintable-thtwo data-header' data-name='client_add' data-index='2'>Address</th><th id = 'phone' class='maintable-thtwo data-header' data-name='contact_phone' data-index='3'>Phone</th><th id = 'email' class='maintable-thtwo data-header' data-name='contact_email' data-index='4'>Email</th><th id = 'website' class='maintable-thtwo data-header' data-name='website' data-index='5'>Website</th><th id = 'category' class='maintable-thtwo data-header' data-name='category' data-index='6'>Category</th><th id = 'title' class='maintable-thtwo data-header' data-name='title' data-index='7'>Title</th></tr></thead><tbody>";


if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		

		$foo=$row['client_name'];
		echo "<tr class = 'hoverTab'><td><a href='edit_client.php?client_name=$foo'>".$row["client_name"]."</a></td><td><a href='edit_client.php?client_name=$foo'>".  $row["contact_name"]."</a></td><td><a href='edit_client.php?client_name=$foo'>". $row["client_add"]. "</a></td><td><a href='edit_client.php?client_name=$foo'>". $row["contact_phone"]. "</a></td><td><a href='edit_client.php?client_name=$foo'>". $row["contact_email"]."</a></td><td><a href='edit_client.php?client_name=$foo'>". $row["website"]. "</a></td><td><a href='edit_client.php?client_name=$foo'>". $row["category"]. "</a></td><td><a href='edit_client.php?client_name=$foo'>". $row["title"]. "</a></td></tr>";
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
			<ul class="pagination">
				<li class="current"><a class="page" href="#">1<span class="sr-only">(current)</span></a></li>
				<li><a class="page" href="#">2<span class="sr-only">(current)</span></a></li>
				<li><a class="page" href="#">3<span class="sr-only">(current)</span></a></li>
				<li><a class="page" href="#">4<span class="sr-only">(current)</span></a></li>
				<li><a class="page" href="#">5<span class="sr-only">(current)</span></a></li>
				<li><a class="next" href="#">Next<span class="sr-only">(current)</span></a></li>
			</ul>
		</nav>
	</div>
	<div class="items-per-page-cont pull-right">
		<label>Clients Per Page</label>
		<select class="per-page-val">
			<option value="10">10</option>
			<option value="25">25</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select>
	</div>
</div>
</div>
</div>

<!--- script for making table sortable --->
<script src="sorttable.js"></script>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<script>
$('table-bordered allcontacts-table').each(function() {
    var currentPage = 0;
    var numPerPage = 10;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pager"></div>');
    for (var page = 0; page < numPages; page++) {
        $('<span class="page-number"></span>').text(page + 1).bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager).addClass('clickable');
    }
    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
});

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
    } 
); 
</script>

	

	

						