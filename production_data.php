<?php
require('header.php');
?>

<div class="dashboard-cont" style="padding-top:110px;">
<form action="add_production_data.php" method="post">
<div>Total Records &nbsp; <br><input name = "records" type = "text" id = "records" style = "width: 80px" value = "1"></input></div><p id = "recs_error" style = "color:red;"></p><br><br>
  <div class = "prod_info">
	<h1>Task 1: </h1>
	Time/Unit &nbsp; <input name = "time_number" type = "text" id = "time_number" style = "width: 40px; font-size = 18px;" value = "1"><select name = "time_unit" id = "time_unit"><option>min.</option><option>sec.</option><option>hr.</option></select>
	Records Complete in Time &nbsp; <input name = "per_rec" type = "text" id = "per_rec" style = "width: 50px" value = "1"></input> &nbsp; &nbsp;
	Number of People &nbsp; <select name = "people" id = "people">
	<?php
		for($i = 1; $i <= 10; $i++)
		{
			echo "<option>" . $i . "</option>";
		}
	?>
</select>
Employees &nbsp; <select name = "employee[]" id = 'employee' multiple>
	<?php
		$sql = "SELECT * FROM users";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc())
		{
			echo "<option>" . $row['user'] . "</option>";
		}
	?>
</select> &nbsp;
Job &nbsp; <select name = "job" id = "job">
	<option>Insertion</option>
	<option>Printing</option>
	<option>Folding</option>
	<option>Tabbing</option>
	<option>Packaging</option>
</select><br><br>
<p id = "error" style = "color: red;"></p>
</div><br>
<h1><progress id = "progress_bar" value = "1" max = "250" style = "background-color: red"></progress></h1><br>
<h2 id = "display_time">Hours: 0</h2><br>
<h2 id = "eff">Efficiency: </h2><br>
<input type = "submit" value = "Save Data"></input>
</form>
<input type = "submit" onclick = "changeBar();" value = "Submit Data"></input><button type = "button" onclick = "addTask();">Add Task</button>
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
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js">
</script>
<script>
	var time_number = ["time_number"];
	var time_unit = ["time_unit"];
	var recs_comp = ["per_rec"];
	var people = ["people"];
	var employee = ["employee[]"];
	var job = ["job"];
	var errors = ["error"];
	var employeeOptions = document.getElementById('employee').options;
	var jobList = ["Insertion", "Printing", "Folding", "Tabbing", "Packaging"];
	var count = 1;
	var Task = 2;
	
	function addTask(){
		$(".prod_info").append("<h1>Task " + Task + ":</h1>Time/Unit &nbsp; <input name = 'time_number" + count + "' type = 'text' id = 'time_number" + count + "' style = 'width: 40px; font-size = 18px;' value = '1'> &nbsp; </input><select name = 'time_unit" + count + "' id = 'time_unit" + count + "'><option>min.</option><option>sec.</option><option>hr.</option></select> Records Complete in Time &nbsp; <input name = 'per_rec" + count + "' type = 'text' id = 'per_rec" + count + "' style = 'width: 50px' value = '1'></input> &nbsp; &nbsp;");
		$(".prod_info").append("&nbsp;Number of People &nbsp;<select name = 'people" + count + "' id = 'people" + count + "'>");
		for (var i = 1; i <= 10; i++){
			var opt = document.createElement('option');
			opt.value = i;
			opt.innerHTML = i;
			document.getElementById("people" + count).appendChild(opt);
		}
		$(".prod_info").append("</select>&nbsp;Employees &nbsp; <select name = 'employee" + count + "[]' id = 'employee" + count + "' multiple>");
		//$(".prod_info").append("<?php $sql = "SELECT * FROM users"; $result = mysqli_query($conn, $sql); while($row = $result->fetch_assoc()){echo "<option>" . $row['user'] . "</option>";} echo "</select>";?>");
		for (var i = 0; i < employeeOptions.length; i++){
			var opt = document.createElement('option');
			opt.value = employeeOptions[i].value;
			opt.innerHTML = employeeOptions[i].value;
			document.getElementById("employee" + count).appendChild(opt); 
		}
		$(".prod_info").append("</select> &nbsp; Job &nbsp; <select name = 'job" + count + "' id = 'job" + count + "'>");
		for(var i = 0; i < jobList.length; i++){
			var opt = document.createElement('option');
			opt.value = jobList[i];
			opt.innerHTML = jobList[i];
			document.getElementById("job" + count).appendChild(opt);
		}
		$(".prod_info").append("</select><br>");
		$(".prod_info").append("<p id = 'error" + count + "' style = 'color:red;'></p>");
		time_number.push("time_number" + count);
		time_unit.push("time_unit" + count);
		recs_comp.push("per_rec" + count);
		people.push("people" + count);
		employee.push("employee" + count);
		job.push("job" + count);
		errors.push("error" + count);
		Task = Task + 1;
		count = count + 1;
	}
</script>

<script type = "text/javascript">
	function test(){
		document.getElementById("display_time").innerHTML = document.getElementById(people[2]).value;
	}
	function changeBar(){
		var bar = document.getElementById("progress_bar");
		var recordsNum = document.getElementById("records").value;
		var displayTime = document.getElementById("display_time");
		var displayEff = document.getElementById("eff");
		var totalCalculation = 0;
		var error = false;
		var errorMessage = "";
		
		for(var i = 0; i < time_number.length; i++){
			
			var recsPer = document.getElementById(recs_comp[i]).value;
			var time = document.getElementById(time_number[i]).value;
			var unit = document.getElementById(time_unit[i]);
			var people = document.getElementById("people");
			var errorId = document.getElementById(errors[i]);
			errorId.innerHTML = "";
			document.getElementById("recs_error").innerHTML = "";
			
			if(i > 0){
				people = document.getElementById("people" + i);
			}
			
			
			if(/^[0-9]*$/.test(recordsNum) == false || recordsNum.length == 0){
				displayTime.innerHTML =  "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				document.getElementById("recs_error").innerHTML = "Invalid Input";
				error = true;
				break;
			}
			else if(/^[0-9]*$/.test(recsPer) == false || /^[0-9]*$/.test(time) == false){
				
				displayTime.innerHTML =  "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				var TaskNum = i + 1;
				errorMessage = "Character error in Task " + TaskNum;
				errorId.innerHTML = errorMessage;
				error = true;
				break;
			}
			else if(recsPer.length == 0 || time.length == 0)
			{
				displayTime.innerHTML = "Hours: -1";
				displayEff.innerHTML = "Efficiency: ";
				bar.value = "0";
				displayEff.style.color = "black";
				var TaskNum = i + 1;
				errorMessage = "Field left blank in Task " + TaskNum;
				errorId.innerHTML = errorMessage;
				error = true;
				break;
			}
			else if(recordsNum == 0 || recsPer == 0 || time == 0)
			{
				totalCalculation = totalCalculation + 0;
			}
			else
			{
				if(unit.value == "min."){
					var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time) / 60 / parseInt(people.value);
					totalCalculation = totalCalculation + calculation;
				}
				else if(unit.value == "sec.")
				{
					var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time) / 3600 / parseInt(people.value);
					totalCalculation = totalCalculation + calculation;
				}
				else if(unit.value == "hr.")
				{
					var calculation = parseInt(recordsNum) / parseInt(recsPer) * parseInt(time) / parseInt(people.value);
					totalCalculation = totalCalculation + calculation;
				}
			}
			
		}
		
		if(!error){
		
			bar.value = 250.0 - totalCalculation;
			displayTime.innerHTML = "Hours: " + totalCalculation;
			
			if(totalCalculation <= 50)
			{
				displayEff.innerHTML = "Efficiency: High";
				displayEff.style.color = "green";
			}
			else if(totalCalculation <= 150)
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