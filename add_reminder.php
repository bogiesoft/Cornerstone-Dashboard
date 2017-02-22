<?php
require ("connection.php");

if(isset($_POST['submit_form'])){
	session_start();
	$user = $_SESSION['user'];
	
	$date = $_POST['date'];
	$text = $_POST['text'];
	$occurence = $_POST['occurence'];
	if($occurence == 'Day'){
		mysqli_query($conn, 'INSERT INTO reminder (user, text, date, occurence) VALUES ("' . $user . '", "' . $text . '", "' . $date . '", "' . $occurence . '")');
	}
	else if($occurence == 'DT'){
		$time = $_POST['time'];
		mysqli_query($conn, 'INSERT INTO reminder (user, text, date, occurence, time) VALUES ("' . $user . '", "' . $text . '", "' . $date . '", "' . $occurence . '", "' . $time . '")');
	}
	else{
		$end_date = $_POST['end_date'];
		mysqli_query($conn, 'INSERT INTO reminder (user, text, date, occurence, end_date) VALUES ("' . $user . '", "' . $text . '", "' . $date . '", "' . $occurence . '", "' . $end_date . '")');
	}
	
	$conn->close();
	header("location: reminders.php");
	exit();
}

require("header.php");
$user = $_SESSION['user'];
?>
<div class="dashboard-cont" style="padding-top:110px;">
<div class="dashboard-detail">
<div id = "add_reminder">
	<form action = "" method = "post">
	<div class="tabinner-detail">
	<label id = "date_label">Date</label>
	<input id = "date" name="date" type="date" class="contact-prefix" style="width:95%;">
	<div class="clear"></div>
	</div><br>
	<div class="tabinner-detail">
	<label id = "occurence_label">Occurence</label><br>
	<select style = "float: left; width: 150px" id = "occurence_id" name = "occurence" onchange = "showExtraInput()">
	<option selected = 'selected' value = "Day">Day</option>
	<option value = "DT">Day and Time</option>
	<option value = "DUR">Duration</option>
	</select>
	<div class="clear"></div>
	</div><br>
	<div class="tabinner-detail">
	<label id = "end_date_label" style = "display: none">End Date</label>
	<input id = "end_date" name="end_date" type="date" class="contact-prefix" style="width:95%; display: none">
	<div class="clear"></div>
	</div><br>
	<div class="tabinner-detail">
	<label id = "time_label" style = "display: none">Time</label>
	<input id = "time" name="time" type="time" class="contact-prefix" style="width:95%; display: none">
	<div class="clear"></div>
	</div><br>
	<div class="tabinner-detail">
	<label>Text</label><br>
	<textarea name="text" style="float:right; width:600px; height:300px;"></textarea>
	<div class="clear"></div>
	</div><br>
	<input class = "save-btn" type = "submit" name = "submit_form" value = "Save" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
	</form>
</div>
</div>
</div>
<script>
function showAdd(){
   if(document.getElementById("add_rem_button").innerHTML == "Add Reminder"){
		document.getElementById("add_reminder").style.display = "inline";
		document.getElementById("add_rem_button").innerHTML = "Cancel";
   }
   else{
	   document.getElementById("add_reminder").style.display = "none";
	   document.getElementById("add_rem_button").innerHTML = "Add Reminder";
   }
}

function showExtraInput(){
	var e = document.getElementById("occurence_id");
	if(e.options[e.selectedIndex].value == "DUR"){
		document.getElementById("end_date").style.display = "inline";
		document.getElementById("end_date_label").style.display = "inline";
		document.getElementById("time_label").style.display = "none";
		document.getElementById("time").style.display = "none";
	}
	else if(e.options[e.selectedIndex].value == "DT"){
		document.getElementById("end_date").style.display = "none";
		document.getElementById("end_date_label").style.display = "none";
		document.getElementById("time_label").style.display = "inline";
		document.getElementById("time").style.display = "inline";
	}
	else{
		document.getElementById("time_label").style.display = "none";
		document.getElementById("time").style.display = "none";
		document.getElementById("end_date").style.display = "none";
		document.getElementById("end_date_label").style.display = "none";
	}
}
</script>