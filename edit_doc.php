<?php
require ("header.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";
// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	
	$term = $_GET['title'];
	
	$sql = "SELECT * FROM documentation WHERE title = '$term'"; 
	$result = mysqli_query($conn,$sql); 
	
	
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();	
	
		$title = $row['title'];
		$text = $row['text'];
		$display = "yes";
    
	} 
	else {
		echo "No results found";
		$display = "no";
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
<form action="update_doc.php" method="post">
				<div class="newclienttab-inner">
					<div class="tabinner detail">
					<label>Title</label>
					<input name="title" type="text" class="contact-prefix" value="<?php echo $title; ?>">
					</div>
					<div class="tabinner detail">
					<label>Text</label>
					<textarea name="text" class="contact-notes" ><?php echo $text; ?></textarea>
					</div>
					
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form">
				</div>
			</form>
		</div>