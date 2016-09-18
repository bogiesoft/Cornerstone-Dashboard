<?php
$id = $_GET['id'];
require ("connection.php");

if(isset($_POST['submit_form'])){
	session_start();
	$temp = $id;
	$user = $_SESSION['user'];
	$date = $_POST['date'];
	$text = $_POST['text'];
	$occurence = $_POST['occurence'];
	if($occurence == 'Day'){
		mysqli_query($conn, "UPDATE reminder set user = '$user', text = '$text', date = '$date', occurence = '$occurence', end_date = 'none', time = 'none' WHERE id = '$temp'");
	}
	else if($occurence == 'DT'){
		$time = $_POST['time'];
		mysqli_query($conn, "UPDATE reminder set user = '$user', text = '$text', date = '$date', occurence = '$occurence', end_date = 'none', time = '$time' WHERE id = '$temp'");
	}
	else{
		$end_date = $_POST['end_date'];
		mysqli_query($conn, "UPDATE reminder set user = '$user', text = '$text', date = '$date', occurence = '$occurence', end_date = '$end_date', time = 'none' WHERE id = '$temp'");
	}
header("location: reminders.php");
exit();
}
require ("header.php");

$temp = $id;

$sql = "SELECT * FROM reminder WHERE id = '$temp'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$date = $row['date'];
$occurence = $row['occurence'];
$end_date = $row['end_date'];
$time = $row['time'];
$text = $row['text'];

?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Edit Reminder</h1>
	<a class="pull-right" href="reminders.php" style="margin-right:20px; background-color:#d14700;">Back to Reminders</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
	<form action = "" method = "post">
	<div class="tabinner-detail">
	<label id = "date_label">Date</label>
	<input id = "date" name="date" type="date" class="contact-prefix" style="width:95%;" value = '<?php echo $date ?>'>
	<div class="clear"></div>
	</div><br>
	<div class="tabinner-detail">
	<label id = "occurence_label">Occurence</label><br>
	<select style = "float: left; width: 150px" id = "occurence_id" name = "occurence" onchange = "showExtraInput()">
	<?php
		if($occurence == 'Day'){
			echo "<option value = 'Day' selected = 'selected'>Day</option>";
			echo "<option value = 'DT'>Day and Time</option>";
			echo "<option value = 'DUR'>Duration</option>";
			
		}
		else if($occurence == "DT"){
			echo "<option value = 'DT' selected = 'selected'>Day and Time</option>";
			echo "<option value = 'Day'>Day</option>";
			echo "<option value = 'DUR'>Duration</option>";
		}
		else{
			echo "<option value = 'DUR' selected = 'selected'>Duration</option>";
			echo "<option value = 'Day'>Day</option>";
			echo "<option value = 'DT'>Day and Time</option>";
		}
		
		
	?>
	</select>
	<div class="clear"></div>
	</div><br>
	<div class="tabinner-detail">
	<label id = "end_date_label" style = "display: none">End Date</label>
	<input id = "end_date" name="end_date" type="date" class="contact-prefix" style="width:95%; display: none" value = '<?php if($end_date != "none"){echo $end_date;} ?>'>
	<div class="clear"></div>
	</div><br>
	<div class="tabinner-detail">
	<label id = "time_label" style = "display: none">Time</label>
	<input id = "time" name="time" type="time" class="contact-prefix" style="width:95%; display: none" value = '<?php if($time != "none"){echo $time;} ?>'>
	<div class="clear"></div>
	</div><br>
	<div class="tabinner-detail">
	<label>Text</label><br>
	<textarea name="text" style="float:right; width:600px; height:300px;"><?php echo $text; ?></textarea>
	<div class="clear"></div>
	</div><br>
	<input class = "save-btn" type = "submit" name = "submit_form" value = "Save" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
	</form>
			</div>
		</div>
	</div>
	</div>
</div>
				
</div>
<script>

window.onload = showInfo;

function showInfo(){
	var currentSel = document.getElementById("occurence_id").value;
	
	if(currentSel == "Day"){
		document.getElementById("end_date_label").style.display = "none";
		document.getElementById("end_date").style.display = "none";
		document.getElementById("time").style.display = "none";
		document.getElementById("time_label").style.display = "none";
	}
	else if(currentSel == "DT"){
		document.getElementById("time").style.display = "block";
		document.getElementById("time_label").style.display = "block";
		document.getElementById("end_date").style.display = "none";
		document.getElementById("end_date_label").style.display = "none";
	}
	else{
		document.getElementById("time").style.display = "none";
		document.getElementById("time_label").style.display = "none";
		document.getElementById("end_date").style.display = "block";
		document.getElementById("end_date_label").style.display = "block";
	}
}

function showExtraInput(){
	var e = document.getElementById("occurence_id");
	if(e.options[e.selectedIndex].value == "DUR"){
		document.getElementById("end_date").style.display = "block";
		document.getElementById("end_date_label").style.display = "block";
		document.getElementById("time_label").style.display = "none";
		document.getElementById("time").style.display = "none";
	}
	else if(e.options[e.selectedIndex].value == "DT"){
		document.getElementById("end_date").style.display = "none";
		document.getElementById("end_date_label").style.display = "none";
		document.getElementById("time_label").style.display = "block";
		document.getElementById("time").style.display = "block";
	}
	else{
		document.getElementById("time_label").style.display = "none";
		document.getElementById("time").style.display = "none";
		document.getElementById("end_date").style.display = "none";
		document.getElementById("end_date_label").style.display = "none";
	}
}
</script>