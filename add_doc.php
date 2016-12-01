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
						<input name="title" type="text" class="contact-prefix" style="width:95%;">
						<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
						<label>Description</label>
						<input name="description" type="text" class="contact-prefix" style="width:95%;">
						<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a  id = "text_label" role="tab" data-toggle="tab" aria-expanded="true">Text</a></li>
							<li role="presentation" class="active"><a  id = "preview_label" role="tab" data-toggle="tab" aria-expanded="true">Preview</a></li>
						</ul>
							<input name = "file" id="fileInput" type="file" style="display:none;" onchange='getFilename(this)' form = "importForm"/>
							<input type="button" value="Choose Files!" onclick="document.getElementById('fileInput').click();" />
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
			<form id = "importForm" action = "image_blog.php" method = "POST" enctype="multipart/form-data">
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

function getFilename(name){
	document.getElementById("importForm").submit();
	// var filename = $(name).val().replace(/C:\\fakepath\\/i, '');
	// console.log(filename);
	// $.ajax({
	// 	 type:'POST',
	// 	 url: 'image_blog.php',
	// 	 data: {
	// 		 'file': filename
	// 	 }
	//  });
}
	$(document).ready(function(){
		//  $('#imageFile').live('change', function(){
		// 	 console.log($(this).val());
		// 	//  $.ajax({
		// 	// 	 type:'POST',
		// 	// 	 url: 'image_blog.php',
		// 	// 	 data: {
		// 	// 		 'function': 2,
		// 	// 		 'Select': 'none',
		// 	// 		 'sql': sqlsend
		// 	// 	 }
		// 	//  });
		// 	});

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
			preview.hide();
			textarea.show();
		});
	});
</script>
