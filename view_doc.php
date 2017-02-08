<?php
require ("header.php");
require ("connection.php");

$term = $_GET['title'];
$sql = "SELECT * FROM documentation WHERE title = '$term'";
$result = mysqli_query($conn,$sql);



	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();

	$title = $row['title'];
    $user = $row['user'];
    $timestamp = $row['timestamp'];
    $text = $row['text'];
	$view_count = $row['view_count'];
	$view_count = $view_count + 1;
	mysqli_query($conn, "UPDATE documentation SET view_count = '$view_count' WHERE title = '$title'");
		$display = "yes";

	}
	else {
		echo "No results found";
		$display = "no";
	}

?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">View Documentation</h1>
	<a class="pull-right" href="documentation.php" >Back to Docs</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
		<div class="view_doc_post">
				<h2><?php echo $title; ?></h1>
				<label>Written by <?php echo $user; ?> on <?php echo $timestamp; ?></label>
				<div id = "text" name="text"><?php echo $text; ?></div>
		</div>
</div>
			
</div>
<script src="DocumentationSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="micromarkdown/micromarkdown.js"></script>
<script>
  var input = $('#text').text();
$(document).ready(function(){
  $('#text').html(micromarkdown.parse(input));
    if($display = "no"){
        $("form").hide();
    }
	if($display = "yes"){
        $("form").show();
    }
});
</script>
