<script src="sorttable.js"></script>
<?php
require ("header.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Sales</h1>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific job">
		</div>
	</div>
	</div>
<div class="clear"></div>
<?php
require ("connection.php");

$result = mysqli_query($conn,"SELECT job_ticket.job_id, job_ticket.client_name, job_ticket.project_name, job_ticket.due_date, job_ticket.estimate_number, mail_data.records_total FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id AND mail_data.processed_by = ''");

echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Job Tickets in Process<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table id = 'sales_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='job_id' data-index='0'>Job ID</th><th class='maintable-thtwo data-header' data-name='client_name' data-index='1'>Client Name</th><th class='maintable-thtwo data-header' data-name='project_name' data-index='2'>Job Name</th><th class='maintable-thtwo data-header' data-name='due_date' data-index='3'>Due Date</th><th class='maintable-thtwo data-header' data-name='estimate_number' data-index='4'>Estimate #</th><th class='maintable-thtwo data-header' data-name='records_total' data-index='5'>Total Records</th><th class='maintable-thnine'>Actions</th></tr></thead><tbody>";

if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		$foo = $row['job_id'];
		echo "<tr><td>".$row["job_id"]."</td><td>".  $row["client_name"]."</td><td>". $row["project_name"]. "</td><td>". $row["due_date"]. "</td><td>". $row["estimate_number"]."</td><td>". $row["records_total"]. "</td><th>"."<a href='http://localhost/crst_dashboard/edit_job.php?job_id=$foo'>"."Edit"."</a></th></tr>";
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
<script src="sorttable.js"></script>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<script>
$("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#sales_table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    }); 
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
		if(numPages > 1){
			$("<li class = 'next' onclick = nextPage();>Next</li>").appendTo($ul);
		}
	});
	document.getElementById("id1").className = "current clickable";
}
function changeCount(){
	numPerPage = parseInt(document.getElementById('item_count').value);
	$('#pag').empty();
	pageCreator();
}
function nextPage(){
	//code here
}
</script>