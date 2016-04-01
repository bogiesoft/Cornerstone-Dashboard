<?php
require ("header.php");
?>
<style>
table {
    width: 40em;
    margin: 2em auto;
}

thead {
    background: #000;
    color: #fff;
}

td {
    width: 10em;
    padding: 0.3em;
}

tbody {
    background: #ccc;
}

div.pager {
    text-align: center;
    margin: 1em 0;
}

div.pager span {
    display: inline-block;
    width: 1.8em;
    height: 1.8em;
    line-height: 1.8;
    text-align: center;
    cursor: pointer;
    background: #000;
    color: #fff;
    margin-right: 0.5em;
}

div.pager span.active {
    background: #c00;
}
</style>
<div class="content">
<div class="content-box">
<div class="topbar">
<h1>Clients</h1>
<a href="add_client.php" class="add_button">Add Client</a>
</div>
<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form action="editClient.php" method="post" >
				<label>Quick Search</label>
				<input name="frmSearch" type="text" placeholder="Search for a specific client">
				<input id="SubmitBtn" type="submit" value="SUBMIT" >
			</form>
		</div>
	</div>
</div>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$result = mysqli_query($conn,"SELECT * FROM client_info");


echo "<table  border='1' cellspacing='2' cellpadding='2' class='paginated' >"; // start a table tag in the HTML
echo "<thead>";
echo "<tr><th> Client name </th><th> Contact name </th><th> Address </th><th> Contact Phone </th><th> Email </th><th> Website </th><th> Category </th><th> Title </th><th> Notes </th></tr>";
echo "</thead>";


if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		


		echo "<tr><td>"."<a href='http://localhost/crst_dashboard/client_info.php'>".$row["client_name"]."</a>"."</td><td>".  $row["contact_name"]."</td><td>". $row["client_add"]. "</td><td>". $row["contact_phone"]. "</td><td>". $row["contact_email"]."</td><td>". $row["website"]. "</td><td>". $row["category"]. "</td><td>". $row["title"]. "</td><td>". $row["notes"]. "</td></tr>";
    }
	echo "<br>";
} else {
    echo "0 results";
}

$conn->close();

?>
<!--<div class="allcontacts-table">
<table border="0" cellspacing="0" cellpadding="0" class="table-bordered allcontacts-table">
	<tbody>
		<tr valign="top">
			<th class="allcontacts-title">All Clients</th>
			<th class="column-editorbtn">Column Editor</th>
		</tr>
		<tr valign="top">
			<td colspan="2">
				<table border="0" cellspacing="0" cellpadding="0" class="table-striped main-table clients-list">
					<tbody>
						<tr valign="top" class="client-headers">
							<th>Client Name</th>
							<th>Full Name</th>
							<th>Address</th>
							<th>Phone Number</th>
							<th>Category</th>
							<th>Actions</th>
						</tr>
						<tr>
						<td class="maintable-thtwo data-cell"></td>
						<td class="maintable-thtwo data-cell"></td>
						<td class="maintable-thtwo data-cell"></td>
						<td class="maintable-thtwo data-cell"></td>
						<td class="maintable-thtwo data-cell"></td>
						<td class="maintable-thnine"><a href="#"></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</div>
<div class="allclients-breadcrumbs">
	<div class="allclients-breadcrumbsleft page-control">
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
</div>-->
</div>
</div>			
				
</div>	
<script>
/*$('td', 'table').each(function(i) {
    $(this).text(i+1);
});
*/


$('table.paginated').each(function() {
    var currentPage = 0;
    var numPerPage = 5;
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
</script>
	

						