<?php
require ("header.php");
?>
<?php
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
		$display = "yes";
		

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
if(isset($_POST['submit_form'])){
	$client_name = $_POST['client_name'];
	$client_add = $_POST['client_add'];
	$contact_name = $_POST['contact_name'];
	$contact_phone = $_POST['contact_phone'];
	$contact_email = $_POST['contact_email'];
	$category = $_POST['category'];
	$sec1 = $_POST['sec1'];
	$website = $_POST['website'];
	$notes = $_POST['notes'];
	$title = $_POST['title'];
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$_SESSION['date'] = $today;
	$job = "updated client info";

	$sql = "UPDATE client_info SET contact_name='$contact_name', client_add='$client_add',contact_phone='$contact_phone',contact_email='$contact_email',sec1='$sec1',website='$website',notes='$notes',category='$category',title='$title' WHERE client_name='$client_name'";

	$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6) or die('Error querying database 5.');

	$result = $conn->query($sql) or die('Error querying database.');
	 
	$conn->close();
	header("location: clients.php ");
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
					<input class="save-btn" type = "submit" value = "Delete" name = "delete_form" onClick = "return confirm('Are you sure you want to delete client?')" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
