<?php
require ("header.php");
require ("connection.php");

$term = $_GET['title'];
$sql = "SELECT * FROM documentation WHERE title = '$term'";
$result = mysqli_query($conn,$sql);



	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();

		$title = $row['title'];
		$text = $row['text'];
		$description = $row['description'];
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
	<h1 class="pull-left">Edit Documentation</h1>
	<a class="pull-right" href="documentation.php?p=1" style="margin-right:20px; background-color:#d14700;">Back to Docs</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Documentation Tab</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<form action="update_doc.php" method="post">
				<div class="newdoctab-inner">
					<div class="tabinner-detail">
					<label>Title</label>
					<input name="title" type="text" value="<?php echo $title; ?>" class="contact-prefix" style="width:95%;">
					<div class="clear"></div>
					</div>
					<label>Description</label>
					<input name="description" type="text" value="<?php echo $description; ?>" class="contact-prefix" style="width:95%;">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Text</label>
					<textarea name="text" style="float:left; width:600px; height:300px;"><?php echo $text; ?></textarea>
					<div class="clear"></div>
					</div>
				</div>
			</div>
				<div class="newcontact-tabbtm">
					<input class="store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					<input class="delete-btn" type = "submit" value = "Delete" name = "delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
<script src="DocumentationSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>	
