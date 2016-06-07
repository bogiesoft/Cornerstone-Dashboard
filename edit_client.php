<?php
require ("header.php");
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

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

<div class="content">
<form action="update_client.php" id="form" method="POST">
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Client Name</label>
					<input name="client_name" type="text" value="<?php echo $client_name; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Contact Name</label>
					<input name="contact_name" type="text" value="<?php echo $contact_name; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Contact Address</label>
					<input name="client_add" type="text" value="<?php echo $client_add; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Phone Number</label>
					<input name="contact_phone" type="text" value="<?php echo $contact_phone; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Email</label>
					<input name="contact_email" type="text" value="<?php echo $contact_email; ?>" class="contact-prefix">
					</div>
				</div>
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Category</label>
					<input name="category" type="text" value="<?php echo $category; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Title</label>
					<input name="title" type="text" value="<?php echo $title; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Phone Number 2</label>
					<input name="sec1" type="text" value="<?php echo $sec1; ?>" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Website</label>
					<input name="website" type="text" value="<?php echo $website; ?>" class="contact-prefix">
					</div>
				</div>
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Notes</label>
					<textarea name="notes" class="contact-notes" ><?php echo $notes; ?></textarea>
					</div>
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form">
				</div>
			</form>
			</div>
