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
		$display = "yes";

	}
	else {
		echo "No results found";
		$display = "no";
	}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    if($display = "no"){
        $("form").hide();
    }
	if($display = "yes"){
        $("form").show();
    }
});
</script>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">View Documentation</h1>
	<a class="pull-right" href="documentation.php" style="margin-right:20px; background-color:#d14700;">Back to Docs</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<form action="update_doc.php" method="post">
				<div class="newdoctab-inner">
					<div class="tabinner-detail">
					<h3><?php echo $title; ?></h3>
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Written by <?php echo $user; ?> on <?php echo $timestamp; ?></label>
					<div name="text" style="float:left; width:600px; height:300px;"><?php echo $text; ?></div>
					<div class="clear"></div>
					</div>
				</div>
			</div>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
<script src="DocumentationSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
