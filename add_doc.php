<?php
require ("header.php");
?>


<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Add Documentation</h1>
	<a class="pull-right" href="documentation.php" style="margin-right:20px; background-color:#d14700;">Back to Docs</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">New Documentation</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<form action="add_new_doc.php" method="post">
				<div class="newdoctab-inner">
					<div class="tabinner-detail">
						<label>Title</label>
						<input id = "title" name="title" type="text" class="contact-prefix" style="width:95%;">
						<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
						<label>Description</label>
						<input id = "description" name="description" type="text" class="contact-prefix" style="width:95%;">
						<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a  id = "text_label" role="tab" data-toggle="tab" aria-expanded="true">Text</a></li>
							<li role="presentation" class="active"><a  id = "preview_label" role="tab" data-toggle="tab" aria-expanded="true">Preview</a></li>
						</ul>
							<input name = "file" id="fileInput" type="file" style="display:none;" form = "uploadImage"/>
						<textarea id = "text" name="text" style="float:left; width:600px; height:300px;"></textarea>
						<div id='fake_textarea' name = 'fake_textarea' contenteditable = "true" style="display: none;"></div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
				<div class="newcontact-tabbtm">
					<input class="store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
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
			</div>
		</div>
	</div>
	</div>
</div>

</div>

<script src="DocumentationSweetAlert.js"></script>
<link rel="stylesheet" href="css/likeaboss.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="likeaboss.js" type="text/javascript"></script>
<script type="text/javascript" src="micromarkdown/micromarkdown.js"></script>
<script>
	$(document).ready(function(){
		$("#title").val(localStorage.getItem("title_val"));
		$("#description").val(localStorage.getItem("description_val"));
		$("#text").val(localStorage.getItem("textarea_val"));
		$("textarea").likeaboss();
		var textarea = $('#text');
		var preview = $('#fake_textarea');

		$('#preview_label').on('click', function(){
			var input = textarea.val();
			preview.html(micromarkdown.parse(input));
			preview.show();
			textarea.hide();
		});

		$('#text_label').on('click', function(){
			console.log(localStorage.getItem("title_val"));
			preview.hide();
			textarea.show();
		});

		$( "#fileInput" ).change(function() {
			nameoffile = $(this).val().replace(/^.*\\/, "");
			console.log(nameoffile);
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
	$(".likeaboss_h1").html("");
    $(".likeaboss_h2").html("");
    $(".likeaboss_h3").html("");
	$(".likeaboss_bold").html("");
	$(".likeaboss_italic").html("");
	$(".likeaboss_bullet_list").html("");
	$(".likeaboss_number_list").html("");
	$(".likeaboss_link").html("");
	$(".likeaboss_image").html("");
	$(".likeaboss_code").html("");
	$(".likeaboss_horizontal").html("");
	});
</script>
