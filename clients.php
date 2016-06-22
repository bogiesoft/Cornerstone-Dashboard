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

<?php

require ("connection.php");

$result = mysqli_query($conn,"SELECT * FROM client_info");


echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>All Clients<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='client_name' data-index='0'>Client Name</th><th class='maintable-thtwo data-header' data-name='contact_name' data-index='1'>Contact Name</th><th class='maintable-thtwo data-header' data-name='client_add' data-index='2'>Address</th><th class='maintable-thtwo data-header' data-name='contact_phone' data-index='3'>Phone</th><th class='maintable-thtwo data-header' data-name='contact_email' data-index='4'>Email</th><th class='maintable-thtwo data-header' data-name='website' data-index='5'>Website</th><th class='maintable-thtwo data-header' data-name='category' data-index='6'>Category</th><th class='maintable-thtwo data-header' data-name='title' data-index='7'>Title</th><th class='maintable-thnine'>Actions</th></tr>";


if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		

		$foo=$row['client_name'];
		echo "<tr><td>".$row["client_name"]."</td><td>".  $row["contact_name"]."</td><td>". $row["client_add"]. "</td><td>". $row["contact_phone"]. "</td><td>". $row["contact_email"]."</td><td>". $row["website"]. "</td><td>". $row["category"]. "</td><td>". $row["title"]. "</td><th>"."<a href='http://localhost/crst_dashboard/edit_client.php?client_name=$foo'>"."Edit"."</a></th></tr>";
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
<script>
$('table.sortable').each(function() {
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
        $.each($("#table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    }); 

</script>

	

	

						