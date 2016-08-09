<?php
require ("header.php");
require ("connection.php");

	$temp=unserialize($_GET['client_info']);
	$full_name = $temp[0];
	$address_line_1 = $temp[1];	
	$sql = "SELECT * FROM sales WHERE full_name = '$full_name' AND address_line_1 = '$address_line_1'"; 
	$result = mysqli_query($conn,$sql) or die("error"); 

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();	
		$full_name = $row["full_name"];
		$business=$row["business"];
		$phone=$row["phone"];
		$email1=$row["email1"];
		$web_address=$row["web_address"];
		$source=$row["source"];
		$title=$row["title"];
		$notes=$row["notes"];
		$address_line_1 =$row["address_line_1"];
		$city = $row["city"];
		$state = $row["state"];
		$zipcode = $row["zipcode"];
		$fax = $row["fax"];
		$display = "yes";
		$call_back_date = $row["call_back_date"];
		$status = $row["status"];
		$cell_phone = $row["cell_phone"];
		$second_contact = $row["second_contact"];
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
	header("location: clients.php");
	exit();
}
else if(isset($_POST['submit_form'])){
	$full_name = $_POST['full_name'];
	$address_line_1 = $_POST['address_line_1'];
	$business = $_POST['business'];
	$phone = $_POST['phone'];
	$email1 = $_POST['email1'];
	$source = $_POST['source'];
	$city = $_POST['city'];
	$web_address = $_POST['web_address'];
	$notes = $_POST['notes'];
	$title = $_POST['title'];
	$state = $_POST['state'];
	$zipcode = $_POST['zipcode'];
	$fax = $_POST['fax'];
	$status = $_POST['status'];
	$call_back_date = $_POST['call_back_date'];
	$second_contact = $_POST['second_contact'];
	$cell_phone = $_POST['cell_phone'];
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$_SESSION['date'] = $today;
	$job = "updated client info";
	$sql = "UPDATE sales SET full_name='$full_name', address_line_1='$address_line_1',phone='$phone',email1='$email1',source='$source',web_address='$web_address',notes='$notes',business='$business',title='$title', cell_phone = '$cell_phone', city = '$city', state = '$state', zipcode = '$zipcode', fax = '$fax', second_contact = '$second_contact', status = '$status', call_back_date = '$call_back_date' WHERE full_name='$full_name' AND address_line_1 = '$address_line_1'";
	$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6) or die('Error querying database 5.');
	$result = $conn->query($sql) or die('Error querying database.');
	$conn->close();
	header("location: clients.php");
	exit();
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
	<h1 class="pull-left">Edit Client</h1>
	<a class="pull-right" href="clients.php" >Back to Clients</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Edit Current Client</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<form action="" method="post">
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Client Name</label>
					<input name="full_name" type="text" value="<?php echo $full_name; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Business</label>
					<input name="business" type="text" value="<?php echo $business; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Contact Address</label>
					<input name="address_line_1" type="text" value="<?php echo $address_line_1; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Phone Number</label>
					<input name="phone" type="text" value="<?php echo $phone; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Email</label>
					<input name="email1" type="text" value="<?php echo $email1; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Website</label>
					<input name="web_address" type="text" value="<?php echo $web_address; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Source</label>
					<input name="source" type="text" value="<?php echo $source; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Title</label>
					<input name="title" type="text" value="<?php echo $title; ?>" class="contact-prefix">
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
					<label>Fax</label>
					<input name="fax" type="text" value="<?php echo $fax; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Call Back Date</label>
					<input name="call_back_date" type="date" value="<?php echo $call_back_date; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Status</label>
					<input name="status" type="text" value="<?php echo $status; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Cell Phone</label>
					<input name="cell_phone" type="text" value="<?php echo $cell_phone; ?>" class="contact-prefix">
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
					<label>Note</label>
					<textarea name="notes" class="contact-notes"><?php echo $notes; ?></textarea>
					<div class="clear"></div>
					</div>
				</div>
			</div>
				<div class="newcontact-tabbtm">
					<input class="save-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					<input class="save-btn delete-btn" type = "submit" value = "Delete" name = "delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
