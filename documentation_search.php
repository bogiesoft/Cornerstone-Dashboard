<?php
require ("header.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Documentation</h1>
	<a class="pull-right" href="add_doc.php" class="add_button">Add Doc</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form id = "form-id" action="documentation_search.php" method="post">
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search documentation by user, title etc.">
			</form>
			<div class="search-boxright pull-right"><a href="#" onclick = "document.getElementById('form-id').submit()">Submit</a></div>
		</div>
	</div>
	</div>
<div class="clear"></div>
<div class="documentation-detail">
<?php

require ("connection.php");
$compare = $_POST['frmSearch'];
$result = mysqli_query($conn,"SELECT * FROM documentation WHERE title LIKE '%{$compare}%' OR text LIKE '%{$compare}%' OR user LIKE '%{$compare}%' OR timestamp LIKE '%{$compare}%'");

if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		$temp = $row['title'];
		echo "<div class='doc-block'>";
		echo "<a href='http://localhost/crst_dashboard/edit_doc.php?title=$temp'><h2>".$row['title']."</h2></a>"."<p>Written by ".$row['user']." on ".$row['timestamp']."</p><br>";
		echo "<p>".$row['text']."</p>";
		echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();

?>
</div>
</div>
</div>