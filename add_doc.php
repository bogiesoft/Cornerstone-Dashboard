<?php
require ("header.php");
?>


<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Add Documentation</h1>
	<a class="pull-right" href="documentation.php?p=1" style="margin-right:20px; background-color:#d14700;">Back to Docs</a>
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
					<label>Text</label>
					<textarea name="text" style="float:left; width:600px; height:300px;"></textarea>
					<div class="clear"></div>
					</div>
				</div>
			</div>
				<div class="newcontact-tabbtm">
					<input class="store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
				</div>
			</form>
			</div>
		</div>
	</div>
	</div>
</div>
				
</div>
<script src="DocumentationSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>