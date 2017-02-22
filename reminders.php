<?php
require('header.php');
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Reminders</h1>
	<a id = "add_rem_button" class="pull-right" href="add_reminder.php" class="add_button">Add Reminder</a>
	</div>
<div class="dashboard-detail">
<?php
require ("connection.php");
//session_start();

$user = $_SESSION['user'];

$result = mysqli_query($conn, "SELECT * FROM reminder WHERE user = '$user'");
$dates = array();
$texts = array();
$id = array();
$occurences = array();
$times = array();
$end_dates = array();

while($row = $result->fetch_assoc()){
	array_push($dates, $row['date']);
	array_push($texts, $row['text']);
	array_push($id, $row['id']);
	array_push($end_dates, $row['end_date']);
	array_push($times, $row['time']);
	array_push($occurences, $row['occurence']);
}

$result = mysqli_query($conn, "SELECT * FROM job_ticket");
$job_ids = array();
$job_dates = array();

while($row = $result->fetch_assoc()){
	array_push($job_ids, $row['job_id']);
	array_push($job_dates, $row['due_date']);
}

$conn->close();
?>
<script>

	$(document).ready(function() {
	
	var dates = <?php echo json_encode($dates); ?>;
	var texts = <?php echo json_encode($texts); ?>;
	var ids = <?php echo json_encode($id); ?>;
	var end_dates = <?php echo json_encode($end_dates); ?>;
	var times = <?php echo json_encode($times); ?>;
	var occurences = <?php echo json_encode($occurences); ?>;
	var job_ids = <?php echo json_encode($job_ids); ?>;
	var job_dates = <?php echo json_encode($job_dates); ?>;	
	
	var events = [];
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1;
	var yyyy = today.getFullYear();
	var index = 0;
	
	for(var i = 0; i < dates.length; i++){
		var id1 = ids[i];
		if(occurences[i] == "Day"){
			events[i] = {
				url: "edit_reminder.php?id=" + id1,
				title: texts[i],
				start: dates[i]
			};
		}
		else if(occurences[i] == "DT"){
			events[i] = {
				url: "edit_reminder.php?id=" + id1,
				title: texts[i],
				start: dates[i] + "T" + times[i] + ":00"
			};
		}
		else{
			events[i] = {
				url: "edit_reminder.php?id=" + id1,
				title: texts[i],
				start: dates[i],
				end: end_dates[i]
			};
		}
		index = i;
	}
	
	var exitIndex = index;
	
	for(var i = 0; i < job_ids.length; i++){
		if(exitIndex == 0){
				events[i] = {
				url: "edit_job.php?job_id=" + job_ids[i],
				title: "Job " + job_ids[i] + " Due",
				start: job_dates[i]
			};
		}
		else{
				events[index+1] = {
				url: "edit_job.php?job_id=" + job_ids[i],
				title: "Job " + job_ids[i] + " Due",
				start: job_dates[i]
			};
			
			index = index + 1;
		}
	}
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,listDay'
			},
			defaultDate: yyyy + '-' + mm + '-' + dd,
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: events
		});
	});
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
<style>
	#calendar {
		width: 100%;
		margin: 0 auto;
	}

</style>

<div id='calendar'></div>

</div>
</div>		