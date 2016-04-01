<?php
require ("header.php");
?>
<div class="content">
<div class="content-box">
<div class="topbar">
<h1>Clients</h1>
<a href="add_client.php" class="add_button">Add Client</a>
</div>
<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form action="" method="get" onsubmit="return false">
				<label>Quick Search</label>
				<input name="" type="text" placeholder="Search for a specific client">
			</form>
			<a href="#">Search</a>
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
echo "Results from clientinfo:"."<br>"."<br>";
if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		$a = $row["contact_name"];
        echo "<br>"."Client: ";
		echo "<a href='http://localhost/crst_dashboard/client_info.php'>".$a."</a>";
		echo "<br>". "Address: " . $row["client_add"]. "<br>". "Contact Name: " . $row["contact_name"]. "<br>". "Contact Phobe: " . $row["contact_phone"]. "<br>". "Email: " . $row["contact_email"]. "<br>". "Website: " . $row["website"]. "<br>". "Category: " . $row["category"]. "<br>". "Title: " . $row["title"]. "<br>". "Notes: " . $row["notes"]. "<br>";
    }
	echo "<br>";
} else {
    echo "0 results";
}

$conn->close();

?>
<div class="allcontacts-table">
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
</div>
</div>
</div>			
				
</div>			

						