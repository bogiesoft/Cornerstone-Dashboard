<?php
require ("header.php");
?>
<?php
require ("connection.php");

	$temp=$_GET['client_name'];
	
	$sql = "SELECT * FROM client_info WHERE client_name = '$temp'"; 
	$result = mysqli_query($conn,$sql); 
	
	
	
	if ($result->num_rows > 0) {

		$row = $result->fetch_assoc();	
	

		$client_name = $row["client_name"];
		$contact_name=$row["contact_name"];
		$contact_phone=$row["contact_phone"];
		$contact_email=$row["contact_email"];
		$website=$row["website"];
		$category=$row["category"];
		$title=$row["title"];
		$notes=$row["notes"];
		$client_add =$row["client_add"];
		$sec1 = $row["sec1"];
		$display = "yes";
		

}
if(isset($_POST['delete_form'])){
	session_start();
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$job = "deleted client info";
	$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6) or die('Error querying database 5.');
	
	$sql_delete = "DELETE FROM client_info WHERE '$client_name' = client_name";
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
					<input name="client_name" type="text" value="<?php echo $client_name; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Contact Name</label>
					<input name="contact_name" type="text" value="<?php echo $contact_name; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Contact Address</label>
					<input name="client_add" type="text" value="<?php echo $client_add; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Phone Number</label>
					<input name="contact_phone" type="text" value="<?php echo $contact_phone; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Email</label>
					<input name="contact_email" type="text" value="<?php echo $contact_email; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Category</label>
					<input name="category" type="text" value="<?php echo $category; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Title</label>
					<input name="title" type="text" value="<?php echo $title; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Phone Number 2</label>
					<input name="sec1" type="text" value="<?php echo $sec1; ?>" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Website</label>
					<input name="website" type="text" value="<?php echo $website; ?>" class="contact-prefix">
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
