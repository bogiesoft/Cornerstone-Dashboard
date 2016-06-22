<?php
require('header.php');
?>
<script src="sorttable.js"></script>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Weights and Measures</h1>
	<a class="pull-right" href="add_wm.php" class="add_button">Add W/M</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form action="client_search.php" method="post" >
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific w/m">
			</form>
			<div class="search-boxright pull-right"><a href="#">Submit</a></div>
		</div>
	</div>
	</div>
<div class="clear"></div>

<?php
require ("connection.php");
$result = mysqli_query($conn,"SELECT * FROM materials");
echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Weights and Measures<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='job_id' data-index='0'>Job ID</th><th class='maintable-thtwo data-header' data-name='client_name' data-index='1'>Client Name</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='2'>Job Name</th><th class='maintable-thtwo data-header' data-name='received' data-index='3'>Date Received</th><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Vendor</th><th class='maintable-thtwo data-header' data-name='checked_in' data-index='5'>Checked In</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Material</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>Type</th><th class='maintable-thtwo data-header' data-name='quantity' data-index='8'>Quantity</th><th class='maintable-thtwo data-header' data-name='height' data-index='9'>Height 'in'</th><th class='maintable-thtwo data-header' data-name='weight' data-index='10'>Weight 'lbs'</th><th class='maintable-thtwo data-header' data-name='size' data-index='11'>Size 'in'</th><th class='maintable-thtwo data-header' data-name='based_on' data-index='12'>Based On</th></tr>";

$client_name = "";
$project_name = "";

if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		
		$job_id = $row['job_id'];
		
		$result1 = mysqli_query($conn,"SELECT client_name,project_name FROM job_ticket WHERE job_id='$job_id' ");
		    while($row1 = $result1->fetch_assoc()){
				$client_name = $row1["client_name"];
				$project_name = $row1["project_name"];
			}
		
		
		
		
		echo "<tr><td><a href = 'http://localhost/crst_dashboard/edit_wm.php?job_id=$job_id'>".$row["job_id"]."</a></td><td>".$client_name."</td><td>".$project_name."</td><td>". $row["received"]. "</td><td>". $row["vendor"]. "</td><td>". $row["checked_in"]. "</td><td>". $row["material"]. "</td><td>". $row["type"]. "</td><td>". $row["quantity"]. "</td><td>". $row["height"]. "</td><td>". $row["weight"]. "</td><td>". $row["size"]. "</td><td>". $row["based_on"]. "</td></tr>";
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