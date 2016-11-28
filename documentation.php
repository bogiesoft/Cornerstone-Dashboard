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
				<input id="searchbox" name="frmSearch" type="text" placeholder="Search documentation by user, title etc.">
			</form>
			<div class="search-boxright pull-right"><a href="#" onclick = "document.getElementById('form-id').submit()">Submit</a></div>
		</div>
	</div>
	</div>
<div class="clear"></div>
<div class="documentation-detail">
<?php

require ("connection.php");
$result = mysqli_query($conn,"SELECT * FROM documentation");

if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
		$temp = $row['title'];
		echo "<div class='doc-block'>";
		echo "<div class='search-boxright pull-right'><a href='edit_doc.php?title=$temp'>Edit</a></div>";
		echo "<a href='view_doc.php?title=$temp'><h2>".$row['title']."</h2></a>"."<p>Written by <b>".$row['user']."</b> on ".$row['timestamp']."</p><br>";
		echo "<p>".$row['description']."</p>";
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
<script>
	$(document).ready(function(){
		$("#searchbox").on("keyup input paste cut", function() {
			//searchbox value
			var search_val = $(this).val();
			//compare the searchbox value with each job id
			$("div.doc-block").each(function(){
				//if title.text OR username.text OR paragraphText.text contains the string in searchbox
				if($(this).children("a").text().toLowerCase().search(search_val)!=-1 || $(':nth-child(2)', this).children().text().toLowerCase().search(search_val)!=-1 || $(':nth-child(4)', this).text().toLowerCase().search(search_val)!=-1){
					//show div
					$(this).show();
				}
				else{
					//hide div
					$(this).hide();
				}
			});
		});
	});
</script>
