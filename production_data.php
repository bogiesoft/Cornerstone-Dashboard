<?php
require('header.php');
?>

<div class='content'>
	<div>Total Records &nbsp; <br><input type = "text" id = "records" style = "width: 80px" value = "1"></input></div><br><br>
	<div>Time/Unit &nbsp; <input type = "text" id = "time_number" style = "width: 40px; font-size = 18px;" value = "1"> &nbsp; </input><select id = "time_type"><option>min.</option><option>sec.</option></select><div><br><br>
	Records Complete in Time &nbsp; <input type = "text" id = "per_rec" style = "width: 50px" value = "1"></input><br><br>
	Number of People &nbsp; <select id = "people">
	<?php
		for($i = 1; $i <= 10; $i++)
		{
			echo "<option>" . $i . "</option>";
		}
	?>
</select><br><br><br><br>
<h1><progress id = "progress_bar" value = "1" max = "250" style = "background-color: red"></progress></h1><br>
<h2 id = "display_time">Hours: 0</h2><br>
<h2 id = "eff">Efficiency: </h2><br>
<input type = "submit" onclick = "changeBar();" value = "Submit Data"></input>

<style>
progress[value]::-webkit-progress-value {
  background-image:
	   -webkit-linear-gradient(-45deg, 
	                           transparent 33%, rgba(0, 0, 0, .1) 33%, 
	                           rgba(0,0, 0, .1) 66%, transparent 66%),
	   -webkit-linear-gradient(top, 
	                           rgba(255, 255, 255, .25), 
	                           rgba(0, 0, 0, .25)),
	   -webkit-linear-gradient(left, #09c, #f44);

    border-radius: 2px; 
    background-size: 35px 20px, 100% 100%, 100% 100%;
}
</style>

<script type = "text/javascript">
	function changeBar(){
		var bar = document.getElementById("progress_bar")
		var recordsNum = document.getElementById("records").value;
		var recsPer = document.getElementById("per_rec").value;
		var time = document.getElementById("time_number").value;
		var displayTime = document.getElementById("display_time");
		var displayEff = document.getElementById("eff");
		var unit = document.getElementById("time_type");
		var people = document.getElementById("people");
		
		if(/^[0-9]*$/.test(recordsNum) == false || /^[0-9]*$/.test(recsPer) == false || /^[0-9]*$/.test(time) == false){
			
			displayTime.innerHTML =  "Hours: -1";
			displayEff.innerHTML = "Efficiency: ";
			bar.value = "0";
			displayEff.style.color = "black";
		}
		else if(recordsNum == 0 || recsPer == 0 || time == 0)
		{
			displayTime.innerHTML =  "Hours: 0";
			displayEff.innerHTML = "Efficiency: ";
			bar.value = "0";
			displayEff.style.color = "black";
		}
		else if(recordsNum == "" || recsPer == "" || time == "")
		{
			displayTime.innerHTML = "Hours: 0";
			displayEff.innerHTML = "Efficiency: ";
			bar.value = "0";
			displayEff.style.color = "black";
		}
		else
		{
			if(unit.value == "min."){
				var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time) / 60 / parseInt(people.value);
				bar.value = "" + calculation;
				displayTime.innerHTML = "Hours: " + calculation;
			}
			else
			{
				var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time) / 3600 / parseInt(people.value);
				bar.value = "" + calculation;
				displayTime.innerHTML = "Hours: " + calculation;
			}
			
			if(calculation <= 40)
			{
				displayEff.innerHTML = "Efficiency: High";
				displayEff.style.color = "green";
			}
			else if(calculation <= 100)
			{
				displayEff.innerHTML = "Efficiency: Medium";
				displayEff.style.color = "orange";
			}
			else
			{
				displayEff.innerHTML = "Efficiency: Low";
				displayEff.style.color = "red";
			}
		}
}
</script>

</div>