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
session_start();
$temp=$_SESSION['client_name'];
$result = mysqli_query($conn,"SELECT * FROM client_info WHERE client_name=$temp");

echo $contact_name;
echo $client_add;
echo $contact_phone;

?>

<!--- Whole page for specific client where you can update information and add secondary/vendor contacts --->
<div class="title-bar">
	<h2 class="client_title"><?php //echo $client_name ?></h2>
	<div class="btn-right">
	<button class="update_btn">Update</button>
	<button class="delete_btn">Delete</button>
	</div>
</div>
<!--- View client info as editable input fields -->
<form action="" method="get">
<input class="client_info"><?php //echo $contact_name ?></input>
<input class="client_info"><?php //echo $client_add?></input>
<input class="client_info"><?php //echo $contact_phone ?></input>
<!---<input class="client_info"><?php //echo $email ?></input>
<input class="client_info"><?php //echo $website ?></input>
<input class="client_info"><?php //echo $category ?></input>
<input class="client_info"><?php //echo $sec1 ?></input>
<input class="client_info"><?php //echo $sec2 ?></input>
<input class="client_info"><?php //echo $sec3 ?></input>
<input class="client_info"><?php //echo $sec4 ?></input>
<input class="client_info"><?php// echo $vendor_contact ?></input>-->
</form>

<!--- + Button to add a secondary contact (hidden form field when its not clicked) -->
<!--- <button class="add_btn">Add Secondary Contact</button>
<!-- On button click display form --->
<!--- <form action="" method="">
	<input name="" type="text" placeholder="Contact Name">
	<input name="" type="text" placeholder="Title">
	<input name="" type="number" placeholder="Phone Number">
	<input name="" type="email" placeholder="Email">
</form>

<!--- + Button to add a vendor contact (hidden form field when its not clicked) -->
<!--- <button class="add_btn">Add Vendor Contact</button>
<!-- On button click display form --->
<!--- <form action="" method="">
	<input name="" type="text" placeholder="Vendor Name">
	<input name="" type="text" placeholder="Contact">
	<input name="" type="number" placeholder="Phone Number">
	<input name="" type="email" placeholder="Email">
	<input name="" type="website" placeholder="Website">
</form>

<button class="update_btn">Update</button>-->

<?php require ("footer.php"); ?>
