<?php
require ("connection.php");

$client_id = $_GET["client_info"];
$sql = "SELECT * FROM sales WHERE client_id = '$client_id'"; 
$result = mysqli_query($conn,$sql) or die("error"); 

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();	
	$business = $row["business"];
	$rep = $row["rep"];
	$quickbooks = $row["quickbooks"];
	$prefix = $row["prefix"];
	$full_name = $row["full_name"];
	$suffix = $row["suffix"];
	$contact_name = $row["contact_name"];
	$phone=$row["phone"];
	$email1=$row["email1"];
	$web_address=$row["web_address"];
	$alt_website1 = $row["alt_website1"];
	$alt_website2 = $row["alt_website2"];
	$linkedin = $row["linkedin"];
	$facebook = $row["facebook"];
	$twitter = $row["twitter"];
	$skypeid = $row["skypeid"];
	$address_line_3 = $row["address_line_3"];
	$source=$row["source"];
	$title_client=$row["title"];
	$notes=$row["notes"];
	$address_line_1 =$row["address_line_1"];
	$address_line_2 =$row["address_line_2"];
	$city = $row["city"];
	$state = $row["state"];
	$zipcode = $row["zipcode"];
	$country = $row["country"];
	$priority = $row["priority"];
	$fax = $row["fax"];
	$alt_fax = $row["alt_fax"];
	$display = "yes";
	$call_back_date = $row["call_back_date"];
	$date_added = $row["date_added"];
	$status = $row["status"];
	$mailing_list = $row["mailing_list"];
	$cell_phone = $row["cell_phone"];
	$alt_cell_phone = $row["alt_cell_phone"];
	$second_contact = $row["second_contact"];
	$pie_day = $row["pie_day"];
	$alt_phone = $row["alt_phone"];
	$home_phone = $row["alt_phone"];
	$work_phone = $row["work_phone"];
	$email2=$row["email2"];
	$cc_email = $row["cc_email"];
	$vertical1=$row["vertical1"];
	$vertical2=$row["vertical2"];
	$vertical3=$row["vertical3"];
	$_2014_pie_day=$row["_2014_pie_day"];
	$Non_Profit_Card_08_2013=$row["Non_Profit_Card_08_2013"];
	$Commercial_Card_08_2013=$row["Commercial_Card_08_2013"];
	$USPS_Post_Office_Mailing_03_2014=$row["USPS_Post_Office_Mailing_03_2014"];
	$Contractor_Small_Business_Select_Mailing_03_2014=$row["Contractor_Small_Business_Select_Mailing_03_2014"];
	$Contractor_SB_Select_Mailing_04_2014=$row["Contractor_SB_Select_Mailing_04_2014"];
	$USPS_EDDM_Regs_brochure_Mailing_04_2014=$row["USPS_EDDM_Regs_brochure_Mailing_04_2014"];
	$USPS_9Y9_EDDM_Marketing_Card=$row["USPS_9Y9_EDDM_Marketing_Card"];
	$SEPT_2014_3_5Y11_CRST_Marketing_Card=$row["SEPT_2014_3_5Y11_CRST_Marketing_Card"];
	$Contractor_Mailing_2016=$row["Contractor_Mailing_2016"];
	$crid = $row["crid"];
	$non_profit = $row["non_profit"];
	$type = $row["type"];

}
if(isset($_POST['delete_form'])){
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "deleted client info";
	$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6) or die('Error querying database 5.');
	$sql_delete = "DELETE FROM sales WHERE full_name = '$full_name' AND address_line_1 = '$address_line_1'";
	mysqli_query($conn, $sql_delete);
	$conn->close();
	header("location:clients.php");
	exit();
}
else if(isset($_POST['submit_form'])){
	$rep = $_POST["rep"];
	$quickbooks = $_POST["quickbooks"];
	$prefix = $_POST["prefix"];
	$full_name = $_POST['full_name'];
	$suffix = $_POST["suffix"];
	$contact_name = $_POST["contact_name"];
	$address_line_1 = $_POST['address_line_1'];
	$address_line_2 = $_POST['address_line_2'];
	$address_line_3 = $_POST["address_line_3"];
	$business = $_POST['business'];
	$phone = $_POST['phone'];
	$email1 = $_POST['email1'];
	$cc_email = $_POST["cc_email"];
	$source = $_POST['source'];
	$city = $_POST['city'];
	$web_address = $_POST['web_address'];
	$alt_website1 = $_POST["alt_website1"];
	$alt_website2 = $_POST["alt_website2"];
	$linkedin = $_POST["linkedin"];
	$facebook = $_POST["facebook"];
	$twitter = $_POST["twitter"];
	$skypeid = $_POST["skypeid"];
	$notes = $_POST['notes'];
	$title = $_POST['title'];
	$state = $_POST['state'];
	$zipcode = $_POST['zipcode'];
	$country = $_POST["country"];
	$fax = $_POST['fax'];
	$alt_fax = $_POST["alt_fax"];
	$status = $_POST['status'];
	$call_back_date = $_POST['call_back_date'];
	$priority = $_POST['priority'];
	$date_added = $_POST['date_added'];
	$second_contact = $_POST['second_contact'];
	$cell_phone = $_POST['cell_phone'];
	$alt_cell_phone = $_POST["alt_cell_phone"];
	$pie_day = isset($_POST['pie_day']) ? $_POST['pie_day'] : '';
	$mailing_list = isset($_POST['mailing_list']) ? $_POST['mailing_list'] : '';
	$alt_phone = $_POST['alt_phone'];
	$home_phone = $_POST['home_phone'];
	$work_phone = $_POST["work_phone"];
	$email2 = $_POST['email2'];
	$vertical1 = $_POST['vertical1'];
	$vertical2 = $_POST['vertical2'];
	$vertical3 = $_POST['vertical3'];
	$_2014_pie_day = isset($_POST['_2014_pie_day']) ? $_POST['_2014_pie_day'] : '';
	$Non_Profit_Card_08_2013 = isset($_POST['Non_Profit_Card_08_2013']) ? $_POST['Non_Profit_Card_08_2013'] : '';
	$Commercial_Card_08_2013 = isset($_POST['Commercial_Card_08_2013']) ? $_POST['Commercial_Card_08_2013'] : '';
	$USPS_Post_Office_Mailing_03_2014 = isset($_POST['USPS_Post_Office_Mailing_03_2014']) ? $_POST['USPS_Post_Office_Mailing_03_2014'] : '';
	$Contractor_Small_Business_Select_Mailing_03_2014 = isset($_POST['Contractor_Small_Business_Select_Mailing_03_2014']) ? $_POST['Contractor_Small_Business_Select_Mailing_03_2014'] : '';
	$Contractor_SB_Select_Mailing_04_2014 = isset($_POST['Contractor_SB_Select_Mailing_04_2014']) ? $_POST['Contractor_SB_Select_Mailing_04_2014'] : '';
	$USPS_EDDM_Regs_brochure_Mailing_04_2014 = isset($_POST['USPS_EDDM_Regs_brochure_Mailing_04_2014']) ? $_POST['USPS_EDDM_Regs_brochure_Mailing_04_2014'] : '';
	$USPS_9Y9_EDDM_Marketing_Card = isset($_POST['USPS_9Y9_EDDM_Marketing_Card']) ? $_POST['USPS_9Y9_EDDM_Marketing_Card'] : '';
	$SEPT_2014_3_5Y11_CRST_Marketing_Card = isset($_POST['SEPT_2014_3_5Y11_CRST_Marketing_Card']) ? $_POST['SEPT_2014_3_5Y11_CRST_Marketing_Card'] : '';
	$Contractor_Mailing_2016 = isset($_POST['Contractor_Mailing_2016']) ? $_POST['Contractor_Mailing_2016'] : '';
	$crid = $_POST["crid"];
	$non_profit = $_POST["non_profit"];
	$type = $_POST['type'];
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$_SESSION['date'] = $today;
	$job = "updated client info";
	$sql = 'UPDATE sales SET rep="' . $rep . '", quickbooks="' . $quickbooks . '", prefix="' . $prefix . '", suffix="' . $suffix . '", full_name="' . $full_name . '", linkedin = "' . $linkedin . '", facebook = "' . $facebook . '", twitter = "' . $twitter . '", skypeid = "' . $skypeid . '", address_line_1="' . $address_line_1 . '", address_line_2="' . $address_line_2 . '", address_line_3 = "' . $address_line_3 . '", phone="' . $phone . '",email1="' . $email1 . '", cc_email = "' . $cc_email . '", source="' . $source . '",web_address="' . $web_address . '", alt_website1 = "' . $alt_website1 . '", alt_website2 = "' . $alt_website2 . '", notes="' . $notes . '",business="' . $business . '",title="' . $title . '", cell_phone = "' . $cell_phone . '", alt_cell_phone = "' . $alt_cell_phone . '", city = "' . $city . '", state = "' . $state . '", 
	zipcode = "' . $zipcode . '", country = "' . $country . '", fax = "' . $fax . '", alt_fax = "' . $alt_fax . '", contact_name = "' . $contact_name . '", second_contact = "' . $second_contact . '", status = "' . $status . '", call_back_date = "' . $call_back_date . '", priority = "' . $priority . '" , date_added = "' . $date_added . '", mailing_list = "' . $mailing_list . '", pie_day = "' . $pie_day . '", alt_phone = "' . $alt_phone . '", home_phone = "' . $home_phone . '", work_phone = "' . $work_phone . '", email2 = "' . $email2 . '", vertical1 = "' . $vertical1 . '", vertical2 = "' . $vertical2 . '", vertical3 = "' . $vertical3 . '", _2014_pie_day = "' . $_2014_pie_day . '", Non_Profit_Card_08_2013 = "' . $Non_Profit_Card_08_2013 . '", Commercial_Card_08_2013 = "' . $Commercial_Card_08_2013 . '" , USPS_Post_Office_Mailing_03_2014 = "' . $USPS_Post_Office_Mailing_03_2014 . '", Contractor_Small_Business_Select_Mailing_03_2014 = "' . $Contractor_Small_Business_Select_Mailing_03_2014 . '", Contractor_SB_Select_Mailing_04_2014 = "' . $Contractor_SB_Select_Mailing_04_2014 . '", USPS_EDDM_Regs_brochure_Mailing_04_2014 = "' . $USPS_EDDM_Regs_brochure_Mailing_04_2014 . '", USPS_9Y9_EDDM_Marketing_Card = "' . $USPS_9Y9_EDDM_Marketing_Card . '", SEPT_2014_3_5Y11_CRST_Marketing_Card = "' . $SEPT_2014_3_5Y11_CRST_Marketing_Card . '", Contractor_Mailing_2016 = "' . $Contractor_Mailing_2016 . '", crid = "' .$crid . '", non_profit = "'. $non_profit . '", type = "' . $type . '" WHERE client_id = "' . $client_id . '"';
	
	$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6) or die('Error querying database 5.');
	$result = $conn->query($sql) or die($sql);
	$conn->close();
	header("location:clients.php");
	exit();
}

require ("header.php");
?>
<script src="ClientSweetAlert.js"></script>
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
<script>
	function showClientInfo(){
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		document.getElementById("client_info").style.display = "block";

	};
	function showNotes(){
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		document.getElementById("notes").style.display = "block";

	};
	function showMailingHistory(){
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("notes").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		document.getElementById("mailing_history").style.display = "block";

	};
	function showCrid(){
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		document.getElementById("crids").style.display = "block";

	};
	function showSocialMedia(){
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("social_media").style.display = "block";

	};
	function showAltInfo(){
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		document.getElementById("alternate_fields").style.display = "block";

	};


</script>
<!-- Tab Panes -->
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
		<h1 class="pull-left">Edit Client</h1>
		<a class='pull-right' href='clients.php' style = 'margin-left: 2%'>Back to Clients</a>
		<a class='pull-right' href='CRM.php' >Back to CRM</a>
		<div class="clear"></div>
	</div>
	<div class="dashboard-detail">
		<div class="newcontacts-tabs">
			<!-- Nav Tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showClientInfo()'>Client Info</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showAltInfo()'>Alternate Info</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showNotes()'>Notes</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showSocialMedia()'>Social Media</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showMailingHistory()'>Mailing History</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showCrid()'>CRIDS</a></li>
			</ul>

			<div class="newcontactstabs-outer">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">
						<form action="" method="post">
							<div class="newcontactstab-detail" id="client_info" style = 'display:block;'>
								
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Client Name</label>
										<input name="full_name" type="text" value="<?php echo $full_name; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Prefix</label>
										<input name="prefix" type="text" value="<?php echo $prefix; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Suffix</label>
										<input name="suffix" type="text" value="<?php echo $suffix; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>

									<div class="tabinner-detail">
										<label>Title</label>
										<input name="title" type="text" value="<?php echo $title_client;?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Business</label>
										<input name="business" type="text" value="<?php echo $business; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Address Line 1</label>
										<input name="address_line_1" type="text" value="<?php echo $address_line_1; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>City</label>
										<input name="city" type="text" value="<?php echo $city; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>State</label>
										<input name="state" type="text" value="<?php echo $state; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Zip</label>
										<input name="zipcode" type="text" value="<?php echo $zipcode; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Country</label>
										<input name="country" type="text" value="<?php echo $country; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Mailing List</label>
										<input name="mailing_list" type="checkbox" <?php if($mailing_list == 'Y'){echo "checked";}?> value='Y'>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Pie Day</label>
										<input name="pie_day" type="checkbox" <?php if($pie_day == 'Y'){echo "checked";}?> value='Y'>
										<div class="clear"></div>
									</div>
								</div>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Phone Number</label>
										<input name="phone" type="text" value="<?php echo $phone; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Cell Phone</label>
										<input name="cell_phone" type="text" value="<?php echo $cell_phone; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>								
									<div class="tabinner-detail">
										<label>Home Phone</label>
										<input name="home_phone" type="text" value="<?php echo $home_phone; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Work Phone</label>
										<input name="work_phone" type="text" value="<?php echo $work_phone; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>

									<div class="tabinner-detail">
										<label>Email 1</label>
										<input name="email1" type="text" value="<?php echo $email1; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>CC Email</label>
										<input name="cc_email" type="text" value="<?php echo $cc_email; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Website</label>
										<input name="web_address" type="text" value="<?php echo $web_address; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Fax</label>
										<input name="fax" type="text" value="<?php echo $fax; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Contact</label>
										<input name="contact_name" type="text" value="<?php echo $contact_name; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Type</label>
											<select name='type'>
												<?php 
												if($type=='Client')
													echo "<option selected = 'selected' value = '" . $type . "'>" . $type . "</option><option value =''>Select</option><option value ='Prospect'>Prospect</option>"; 
												else if($type=='Prospect')
													echo "<option selected = 'selected' value = '" . $type . "'>" . $type . "</option><option value =''>Select</option><option value ='Client'>Client</option>"; 
												else
													echo "<option selected = 'selected' value = ''>Select</option><option value ='Client'>Client</option><option value ='Prospect'>Prospect</option>"; 
												?>
											</select>
										<div class="clear"></div>
									</div>

									<div class="tabinner-detail">
										<label>Second Contact</label>
										<input name="second_contact" type="text" value="<?php echo $second_contact; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
								</div>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Rep</label>
										<input name="rep" type="text" value="<?php echo $rep; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Quickbooks</label>
										<input name="quickbooks" type="text" value="<?php echo $quickbooks; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Call Back Date</label>
										<input name="call_back_date" type="date" value="<?php echo $call_back_date; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Priority Level</label>
										<input name="priority" type="text" value="<?php echo $priority; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Date Added</label>
										<input name="date_added" type="date" value="<?php echo $date_added; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Status</label>
										<input name="status" type="text" value="<?php echo $status; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Source</label>
										<input name="source" type="text" value="<?php echo $source; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Vertical 1</label>
										<input name="vertical1" type="text" value="<?php echo $vertical1; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Vertical 2</label>
										<input name="vertical2" type="text" value="<?php echo $vertical2; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Vertical 3</label>
										<input name="vertical3" type="text" value="<?php echo $vertical3; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="newcontactstab-detail" id="alternate_fields" style = 'display:none;'>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Alternate Phone</label>
										<input name="alt_phone" type="text" value="<?php echo $alt_phone; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Alternate Mobile</label>
										<input name="alt_cell_phone" type="text" value="<?php echo $alt_cell_phone; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Alternate Fax</label>
										<input name="alt_fax" type="text" value="<?php echo $alt_fax; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Alternate URL 1</label>
										<input name="alt_website1" type="text" value="<?php echo $alt_website1; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Alternate URL 2</label>
										<input name="alt_website2" type="text" value="<?php echo $alt_website2; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Email 2</label>
										<input name="email2" type="text" value="<?php echo $email2; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Address Line 2</label>
										<input name="address_line_2" type="text" value="<?php echo $address_line_2; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Address Line 3</label>
										<input name="address_line_3" type="text" value="<?php echo $address_line_3; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>


								</div>
							</div>
							<div class="newcontactstab-detail" id="notes" style = 'display:none;'>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Note</label>
										<textarea name="notes" class="contact-notes" style = "width: 500%"><?php echo $notes; ?></textarea>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="newcontactstab-detail" id="social_media" style = 'display:none;'>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>LinkedIn</label>
										<input name="linkedin" type="text" value="<?php echo $linkedin; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Facebook</label>
										<input name="facebook" type="text" value="<?php echo $facebook; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Twitter</label>
										<input name="twitter" type="text" value="<?php echo $twitter; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Skype ID</label>
										<input name="skypeid" type="text" value="<?php echo $skypeid; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>

								</div>
							</div>

							<div class="newcontactstab-detail" id="mailing_history" style = 'display:none; white-space: nowrap;'>
							<div class="newcontacttab-inner" style="width:700px;">
								<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >
								<tbody>
								<tr valign='top'><th class='allcontacts-title'>Information<span class='allcontacts-subtitle'></span></th></tr>
								<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Description</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Check</th></tr></thead><tbody>
								<tr><td>2014 Pie Day</td><td><input type="checkbox" name="_2014_pie_day" class="contact-prefix" value='Y' <?php if($_2014_pie_day == 'Y'){echo "checked";}?>></td></tr>
								<tr><td>Non Profit Card 08 2013</td><td><input type="checkbox" name="Non_Profit_Card_08_2013" class="contact-prefix" value='Y' <?php if($Non_Profit_Card_08_2013 == 'Y'){echo "checked";}?>></td></tr>
								<tr><td>Commercial Card 08-2013</td><td><input type="checkbox" name="Commercial_Card_08_2013" class="contact-prefix" value='Y' <?php if($Commercial_Card_08_2013 == 'Y'){echo "checked";}?>></td></tr>
								<tr><td>USPS Post Office Mailing 03-2014</td><td><input type="checkbox" name="USPS_Post_Office_Mailing_03_2014" class="contact-prefix" value='Y' <?php if($USPS_Post_Office_Mailing_03_2014 == 'Y'){echo "checked";}?>></td></tr>
								<tr><td>Contractor/Small Business Select Mailing 03-2014</td><td><input type="checkbox" name="Contractor_Small_Business_Select_Mailing_03_2014" class="contact-prefix" value='Y' <?php if($Contractor_Small_Business_Select_Mailing_03_2014 == 'Y'){echo "checked";}?>></td></tr>
								<tr><td>Contractor/SB Select Mailing 04-2014</td><td><input type="checkbox" name="Contractor_SB_Select_Mailing_04_2014" class="contact-prefix" value='Y' <?php if($Contractor_SB_Select_Mailing_04_2014 == 'Y'){echo "checked";}?>></td></tr>
								<tr><td>USPS EDDM + Regs brochure Mailing 04-2014</td><td><input type="checkbox" name="USPS_EDDM_Regs_brochure_Mailing_04_2014" class="contact-prefix" value='Y' <?php if($USPS_EDDM_Regs_brochure_Mailing_04_2014 == 'Y'){echo "checked";}?>></td></tr>
								<tr><td>USPS 9Y9 EDDM Marketing Card</td><td><input type="checkbox" name="USPS_9Y9_EDDM_Marketing_Card" class="contact-prefix" value='Y' <?php if($USPS_9Y9_EDDM_Marketing_Card == 'Y'){echo "checked";}?>></td></tr>
								<tr><td>SEPT 2014 3.5Y11 CRST Marketing Card</td><td><input type="checkbox" name="SEPT_2014_3_5Y11_CRST_Marketing_Card" class="contact-prefix" value='Y' <?php if($SEPT_2014_3_5Y11_CRST_Marketing_Card == 'Y'){echo "checked";}?>></td></tr>
								<tr><td>Contractor Mailing 2016</td><td><input type="checkbox" name="Contractor_Mailing_2016" class="contact-prefix" value='Y' <?php if($Contractor_Mailing_2016 == 'Y'){echo "checked";}?>></td></tr>
								</tbody></table></td></tr></tbody></table></div>
							</div>
							
							</div>
							<div class="newcontactstab-detail" id="crids" style = 'display:none;'>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>CRID</label>
										<input name="crid" type="text" value="<?php echo $crid; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Non-Profit</label>
										<input name="non_profit" type="text" value="<?php echo $non_profit; ?>" class="contact-prefix">
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="newcontact-tabbtm">
								<input class="save-btn store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
								<input class="save-btn delete-btn" type = "submit" value = "Delete" name = "delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
