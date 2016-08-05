<?php
require ("header.php");
?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Vendors</h1>
	<a class="pull-right" href="add_vendor.php" class="add_button">Add Vendor</a>
	<a class="pull-right" href="add_pop_wm.php" style="margin-right:20px; background-color:#d14700;">Add Popular W/M</a>
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
				$x = $row["vendor_name"];
				echo "<h3><a href='http://localhost/Cornerstone-Dashboard/search_vendor.php?vendor_name=$x'>".$row["vendor_name"]."</a></h1>";
				echo "<p>Contact Name: ".$row["vendor_contact"]."</p>";
				echo "<p>Address: ".$row["vendor_add"]."</p>";
			echo "</div>";
			echo "<div class='vendor-right'>";
				echo "<p>Phone: ".$row["vendor_phone"]."</p>";
				echo "<p>Email: ".$row["vendor_email"]."</p>";
				echo "<p>Website: ".$row["vendor_website"]."</p>";
			echo "</div>";
				
	
					echo "<div>";
							
					$result1 = mysqli_query($conn,"SELECT * FROM w_and_m WHERE vendor='$x'");
					
					if ($result1->num_rows > 0) {
						echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
						echo "<tbody>";
						echo "<tr valign='top'><td colspan='2'><table border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><tbody><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='material' data-index='0'>Material</th><th class='maintable-thtwo data-header' data-name='size' data-index='1'>Size 'in'</th><th class='maintable-thtwo data-header' data-name='height' data-index='2'>Height 'in'</th><th class='maintable-thtwo data-header' data-name='weight' data-index='3'>Weight 'lb'</th><th class='maintable-thtwo data-header' data-name='based_on' data-index='4'>Based On</th></tr>";
						while($row1 = $result1->fetch_assoc()) {
							
							echo "<tr><td>".$row1["material"]."</td><td>".  $row1["size"]."</td><td>". $row1["height"]. "</td><td>". $row1["weight"]. "</td><td>". $row1["based_on"]."</td></tr>";
							
							
						}
						echo "</tbody></table></td></tr></tbody></table></div>";
						echo "<div class='clear'></div>";
						echo "<br>";
					} 
				
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



	

						