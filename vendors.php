<?php
require ("header.php");
?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Vendors</h1>
	<a class="pull-right" href="add_vendor.php" class="add_button">Add Vendor</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form id = "search_form" action="vendor_search.php" method="post" >
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific vendor">
			</form>
			<div class="search-boxright pull-right"><a href="#" onclick = "document.getElementById('search_form').submit()">Submit</a></div>
		</div>
	</div>
	</div>
<div class="clear"></div>

<?php

require ("connection.php");


$result = mysqli_query($conn,"SELECT * FROM vendors");


if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
		
		echo "<div data-role='main' class='ui-content'>";
			echo "<div class='vendor-left'>";
				$foo = array();
				array_push($foo, $row["vendor_name"]);
				array_push($foo, $row["vendor_add"]);
				$str = serialize($foo);
				$stren = urlencode($str);
				echo "<h3><a href='search_vendor.php?vendor_info=$stren'>".$row["vendor_name"]."</a></h1>";
				echo "<p>Contact Name: ".$row["vendor_contact"]."</p>";
				echo "<p>Address: ".$row["vendor_add"]."</p>";
			echo "</div>";
			echo "<div class='vendor-right'>";
				echo "<p>Phone: ".$row["vendor_phone"]."</p>";
				echo "<p>Email: ".$row["vendor_email"]."</p>";
				echo "<p>Website: ".$row["vendor_website"]."</p>";
			echo "</div>";
			echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();

?>

</div>
</div>



	

						