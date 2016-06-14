<?php
require ("header.php");
require ("connection.php");

$sql1 = "SELECT vendor_name FROM vendors";
$sql2 = "SELECT client_name FROM client_info";

$vendors = mysqli_query($conn, $sql1);
$clients = mysqli_query($conn, $sql2);

$id = $_GET['id'];
$_SESSION['id_rem'] = $id; 

$sql = "SELECT * FROM reminder WHERE id = '$id'"; 
$result = mysqli_query($conn,$sql); 

if ($result->num_rows > 0) {

		$row = $result->fetch_assoc();	
	

		$date = $row['date'];
		$text = $row['text'];
		$vendor_name = $row['vendor_name'];
		$client_name = $row['client_name'];
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
	<div class="contacts-title">
		<h2>Reminders</h2>
		
	</div>
	<div class="dashboard-detail">
		<div class="newcontacts-outer">
			<div class="tab-content">
				<form action="update_reminder.php" method="post">
					<div class="newclienttab-inner">
						<div class="tabinner detail">
						<label>Date</label>
						<input name="date" type="date" class="contact-prefix" value = "<?php echo $date; ?>">
						</div>
						<div class="tabinner detail">
						<label>Text</label>
						<textarea name="text" type="date" class="contact-prefix"><?php echo $text;?></textarea><br>
						<label>Client Name</label>
						<select name = "client_info">
							<option disabled selected value><?php echo $client_name;?></option><?php
								while($row = $clients->fetch_assoc()){
									echo "<option>" . $row['client_name'] . "</option>";
								}
							?>
						</select><br>
						<label>Vendor Name</label>
						<select name = "vendor_info">
							<option disabled selected value><?php echo $vendor_name;?></option>
							<?php
								while($row = $vendors->fetch_assoc()){
									echo("<option>" .$row['vendor_name'] . "</option>");
								}
							?>
						</select>
						</div>
					</div>
					<div class="form-bottom">
						<input id="btn" type="submit" value="Save" name="submit_form" onclick = "return confirm('Save changes?')">
						<input type = "submit" value = "Delete" name = "delete_form" onclick = "return confirm('Delete Reminder?')">
					</div>
				</form>
			</div>
		</div>
	
	</div>
</div>