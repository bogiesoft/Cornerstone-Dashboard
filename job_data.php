<?php
	require("header.php");
?>
<style>
	#svg circle {
  stroke-dashoffset: 0;
  transition: stroke-dashoffset 1s linear;
  stroke: #666;
  stroke-width: 1em;
}
#svg #bar {
  stroke: #FF9F1E;
}
#cont {
  display: block;
  height: 200px;
  width: 200px;
  margin: 2em auto;
  box-shadow: 0 0 1em black;
  border-radius: 100%;
  position: relative;
  text-align: center;
}
#cont:after {
  position: absolute;
  display: block;
  height: 160px;
  width: 160px;
  left: 50%;
  top: 50%;
  box-shadow: inset 0 0 1em black;
  content: attr(data-pct)"%";
  margin-top: -80px;
  margin-left: -80px;
  border-radius: 100%;
  line-height: 160px;
  font-size: 2em;
  text-shadow: 0 0 0.5em black;
}

input {
  color: #000;
}


/* Make things perty */
html {  height: 100%;}
h1{ margin: 0; text-transform: uppercase;text-shadow: 0 0 0.5em black;}
h2 { font-weight: 300}
input { border: 1px solid #666; background: #333; color: #fff; padding: 0.5em; box-shadow: none; outline: none !important; margin: 1em  auto; text-align: center;}
</style>
<div class="dashboard-cont" style="padding-top:110px;">
<div class="contacts-title">
	<h1 class="pull-left">Data Summary</h1>
	<a class="pull-right" href="production.php" >Back to Production</a>
	</div><br><br><br><br>
<?php
	require("connection.php");
	
	$job_id = $_GET['job_id'];
	
	$sql = "SELECT tasks FROM production WHERE job_id = '$job_id'";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();
	$job_tasks = $row['tasks'];
	
	$sql = "SELECT records_total FROM mail_data WHERE job_id = '$job_id'";
	$result = mysqli_query($conn, $sql);
	$row1 = $result->fetch_assoc();
	$records_total = $row1['records_total'];
	
	$sql = "SELECT * FROM production_data";
	$result = mysqli_query($conn, $sql);
	
	$match = FALSE;
	$count = 1;
	while($row2 = $result->fetch_assoc()){
		$production_record = (int)$row2['total_records'];
		$match = FALSE;
		
		if($records_total == $production_record){
			$job_tasks_array = explode(",", $job_tasks);
			$production_tasks_array = explode(",", $row2['job']);
			$job_tasks_array = asort($job_tasks_array);
			$production_tasks_array2 = asort($production_tasks_array);
			
			if($production_tasks_array2 == $job_tasks_array){
				echo "<h1>Data " . $count . "</h1>";
				$records_per_array = explode(",", $row2['records_per']);
				$time_unit_array = explode(",", $row2['time_unit']);
				$time_number_array = explode(",", $row2['time_number']);
				$people_array = explode(",", $row2['people']);
				echo "<ul style = 'list-style-type: none;'>";
				for($i = 0; $i < count($records_per_array); $i++){
					echo "<li style = 'margin-left: 75px'>" . $production_tasks_array[$i] . ": " . $records_per_array[$i] . " record(s) in " . $time_number_array[$i] . " " . $time_unit_array[$i] . " " . "with " . $people_array[$i] . " people/person" . "</li>";
				}
				/*echo "<li style = 'margin-left: 75px'><div id='cont' data-pct='100'>
				<svg id='svg' width='200' height='200' viewPort='0 0 100 100' version='1.1' xmlns='http://www.w3.org/2000/svg'>
				<circle r='90' cx='100' cy='100' fill='transparent' stroke-dasharray='565.48' stroke-dashoffset='0'></circle>
				<circle id='bar' r='90' cx='100' cy='100' fill='transparent' stroke-dasharray='565.48' stroke-dashoffset='0'></circle>
				</svg>
				</div></li>";*/
				echo "<li style = 'margin-left: 75px'><h2>Total Hours: " . $row2['hours'] . "</h2></li>";
				$efficiency = "High";
				if($row2['hours'] < 50){
					$efficiency = "High";
				}
				else if($row2['hours'] < 150){
					$efficiency = "Medium";
				}
				else{
					$efficiency = "Low";
				}
				echo "<li style = 'margin-left: 75px'><h2>Efficiency: " . $efficiency . "</h2></li>";
				echo "</ul><br><br>";
				$count = $count + 1;
			}
		}
	}
	
	if($count == 1){
		echo "<i>0 results</i>";
	}
?>
</div>
<script>
$('#percent').on('change', function(){
  var val = parseInt($(this).val());
  var $circle = $('#svg #bar');
  
  if (isNaN(val)) {
   val = 100; 
  }
  else{
    var r = $circle.attr('r');
    var c = Math.PI*(r*2);
   
    if (val < 0) { val = 0;}
    if (val > 100) { val = 100;}
    
    var pct = ((100-val)/100)*c;
    
    $circle.css({ strokeDashoffset: pct});
    
    $('#cont').attr('data-pct',val);
  }
});

//https://codepen.io/JMChristensen/pen/Ablch

</script>