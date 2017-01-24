<?php
require ("header.php");
require("connection.php");
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
			<form id = "search_form" action="vendor_search.php" method="post">
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific vendor">
			</form>
			<div class="search-boxright pull-right"><a href="#" onclick = "document.getElementById('search_form').submit()">Submit</a></div>
		</div>
	</div>
	</div>
<div class="clear"></div>
	<?php
	$result = mysqli_query($conn, "SELECT * FROM vendors");
	while($row = $result->fetch_assoc()){
	$name = $row["vendor_name"];
	$contact = $row["vendor_contact"];
	$phone = $row["vendor_phone"];
	$address = $row["vendor_add"];
	$email = $row["vendor_email"];
	$website = $row["vendor_website"];
	$vendor_info = array($name, $address);
	$serialed_info = serialize($vendor_info);
	$serialed_info = urlencode($serialed_info);
	$name_squeezed = str_replace(" ", "", $name);
	$address_squeezed = str_replace(" ", "", $address);
	$name_squeezed = strtolower($name_squeezed);
	$address_squeezed = strtolower($address_squeezed);
	echo '<div class="vendor_block">
	<div class="vendor_logo">';
	$temp = $name_squeezed . $address_squeezed;
	//echo $temp;
	if(file_exists("images/vendor-logos/" . $temp . ".jpg")){
		echo '<img src="images/vendor-logos/' . $temp . '.jpg">';
	}
	else if(file_exists("images/vendor-logos/" . $temp . ".png")){
		echo '<img src="images/vendor-logos/' . $temp . '.png">';
	}
	else{
		echo '<img src="images/vendor-logos/default-logo.png">';
	}
	echo '</div>';
		echo '<div class="vendor_info">';
		echo '<div class="vendor_title">';
		echo "<p><a href = 'search_vendor.php?vendor_info=" . $serialed_info . "'>" . $name . "</a></p>";
		echo '<p style="float:right; padding-right:20px;">' . $contact . '</p>
		</div>
		<div class="vendor_icons">
			<i><img class="profile-icon" src="images/web-icons/smartphone-6.png"/></i>
			<p class="profile-text">' . $phone .  '</p>
			<i><img class="profile-icon" src="images/web-icons/placeholder.png"/></i>
			<p class="profile-text">' . $address . '</p>
			<i><img class="profile-icon" src="images/web-icons/paper-plane-1.png"/></i>
			<p class="profile-text">' . $email . '</p>
			<i><img class="profile-icon" src="images/web-icons/internet.png"/></i>
			<p class="profile-text">' . $website . '</p>
		</div>
	</div></div>';	
	}
	?>
</div>