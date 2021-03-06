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



<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Edit Documentation</h1>
	<a class="pull-right" href="documentation.php">Back to Docs</a>
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
					<div class="tabinner-detail">
						<label>Description</label>
						<input name="description" type="text" value="<?php echo $description; ?>" class="contact-prefix" style="width:95%;">
						<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a  id = "text_label" role="tab" data-toggle="tab" aria-expanded="true">Text</a></li>
							<li role="presentation" ><a  id = "preview_label" role="tab" data-toggle="tab" aria-expanded="true">Preview</a></li>
							<input name = "file" id="fileInput" type="file" style="display:none;" form = "uploadImage"/>
						<li><input style="width:222px; color:white; background-color:#d14700; border:none; text-align:center; font-size:16px; font-weight:400; line-height:1.5; float:right; height:42px;" type="button" value="Choose File" onclick="document.getElementById('fileInput').click();" /></li>
						</ul>
						<textarea class="article-input" id="text" name = "text" type="text" rows="9" style = "width: 600px; height: 300px"><?php echo $text; ?></textarea>
						<div id='fake_textarea' name = 'fake_textarea' contenteditable = "true" style="display: none;"></div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
						</div>
		</div>
	</div>
</div>
</div>
				<div class="newcontact-tabbtm">
					<input class="store-btn pull-right" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					<input class="delete-btn" type = "submit" value = "Delete" name = "delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
				</div>
			</form>
			<form id = "uploadImage" action = "<?php
			  $name = '';
				$tmp_name ='';
			  if (isset($_FILES["file"]["name"])) {
			      $name = $_FILES["file"]["name"];
			      $tmp_name = $_FILES['file']['tmp_name'];
			      $error = $_FILES['file']['error'];
			      if (!empty($name)) {
			          $location = '/Applications/XAMPP/xamppfiles/htdocs/Cornerstone1/images/';
			          move_uploaded_file($tmp_name, $location.$name);
			      } else {
			          echo 'please choose a file';
			      }
			  }

			?>" method = "POST" enctype="multipart/form-data">
			</form>

<script src="DocumentationSweetAlert.js"></script>
<link rel="stylesheet" href="css/likeaboss.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="likeaboss.js" type="text/javascript"></script>
<script type="text/javascript" src="micromarkdown/micromarkdown.js"></script>
<script>
	$(document).ready(function(){
		//restore back the saved value when page reload
		$("#title").val(localStorage.getItem("title_val"));
		$("#description").val(localStorage.getItem("description_val"));
		$("#text").likeaboss();
		var textarea = $('#text');
		var preview = $('#fake_textarea');

		$('#preview_label').on('click', function(){
			var input = textarea.val();
			preview.html(micromarkdown.parse(input));
			preview.show();
			textarea.hide();
			$('.likeaboss_toolbar').hide();
		});

		$('#text_label').on('click', function(){
			console.log(localStorage.getItem("title_val"));
			preview.hide();
			textarea.show();
			$('.likeaboss_toolbar').show();
		});

		$( "#fileInput" ).change(function() {
			nameoffile = $(this).val().replace(/^.*\\/, "");
			var imageURL = "![An Image](images/"+nameoffile+")";
			textarea.val(textarea.val() +"\n"+ imageURL);

			localStorage.setItem("textarea_val", $(textarea).val());
			localStorage.setItem("title_val", $('#title').val());
			localStorage.setItem("description_val",$('#description').val());

			document.getElementById("uploadImage").submit(function () {
					return false;
			});
		});

		$('.store-btn').on('click', function(){
			localStorage.removeItem("textarea_val");
			localStorage.removeItem("title_val");
			localStorage.removeItem("description_val");

		});

    if($display = "no"){
        $("form").hide();
    }
	if($display = "yes"){
        $("form").show();
    }
});
</script>
