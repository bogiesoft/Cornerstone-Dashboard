<?php
require ("header.php");
?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Vendors</h1>
	<a class="pull-right" href="add_vendor.php" class="add_button">Add Vendor</a>
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
<div class="vendor_block">
	<div class="vendor_logo">
		<img src="images/vendor-logos/pro-printers.png">
	</div>
	<div class="vendor_info">
		<div class="vendor_title">
		<p>Pro-Printers</p>
		<p style="float:right; padding-right:20px;">Ryan Scott</p>
		</div>
		<div class="vendor_icons">
			<i><img class="profile-icon" src="images/web-icons/smartphone-6.png"/></i>
			<p class="profile-text">845-123-1234</p>
			<i><img class="profile-icon" src="images/web-icons/placeholder.png"/></i>
			<p class="profile-text">45 Hudson St - Hudson, NY 12534</p>
			<i><img class="profile-icon" src="images/web-icons/paper-plane-1.png"/></i>
			<p class="profile-text">ryan@pro-printers.com</p>
			<i><img class="profile-icon" src="images/web-icons/internet.png"/></i>
			<p class="profile-text">www.pro-printers.com</p>
		</div>
	</div>	
</div>
</div>
</div>



	

						