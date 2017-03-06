
<?php
require('connection.php');
if(isset($_POST['submit_form'])){
	session_start();
	$job_id = $_SESSION['yellow_sheet_job_id'];
	$count = 1;
	$check_count = 0;
	$max = 14;
	while($count <= 14){
		$went_up = FALSE;
		if(isset($_POST[$count])){
			mysqli_query($conn, "UPDATE project_management SET `" . $count . "` = 1 WHERE job_id = '$job_id'");
			$check_count = $check_count + 1;
			$went_up = TRUE;
		}
		else{
			mysqli_query($conn, "UPDATE project_management SET `" . $count . "` = 0 WHERE job_id = '$job_id'");
		}
		
		if(isset($_POST['na_' . $count])){
			mysqli_query($conn, "UPDATE project_management SET na_" . $count . " = 1 WHERE job_id = '$job_id'");
			mysqli_query($conn, "UPDATE project_management SET `" . $count . "` = 0 WHERE job_id = '$job_id'");
			$max = $max - 1;
			if($went_up == TRUE){
				$check_count = $check_count - 1;
			}
		}
		else{
			mysqli_query($conn, "UPDATE project_management SET na_" . $count . " = 0 WHERE job_id = '$job_id'");
		}
		$count = $count + 1;
	}
	if($max == 0){
		$percent = 100;
	}
	else{
		$percent = (int)($check_count / $max * 100);
	}
	
	mysqli_query($conn, "UPDATE project_management SET percent = '$percent' WHERE job_id = '$job_id'") or die("error");
	header("location: project_management.php");
}
require('header.php');
$job_id = $_GET['job_id'];
$_SESSION['yellow_sheet_job_id'] = $job_id;

?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Yellow Sheet</h1>
	<a class="pull-right" href="project_management.php">Back to PM</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Yellow Sheet Options</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
<form action="" method="post">
<?php
require ("connection.php");
$result = mysqli_query($conn,"SELECT * FROM project_management WHERE job_id = '$job_id'");
echo " <div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
echo "<tbody>";
echo "<tr valign='top'><th class='allcontacts-title'>Yellow Sheet<span class='allcontacts-subtitle'></span></th></tr>";
echo "<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Description</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Complete</th><th class='maintable-thtwo data-header' data-name='type' data-index='7'>N/A</th></tr></thead><tbody>";

$descriptions = array("Permit is Complete", "Non-Profit Verified", "Move Update/NCOA", "Manual Duplicate Review", "Foreign Address Formatting", "Blue Sheet Completed", "Actual Postage Verified Against Estimate", 
						"NCOA Checked Off", "Save mail.dat", "Double Checked Job", "Update Job Ticket", "Are Examples Printed Out", "Sign Job Ticket", "Manually Checked Data For Errors");
if ($result->num_rows > 0) {
    // output data of each row
	$row = $result->fetch_assoc();
	
    for($i = 0; $i <= 13; $i++) {
		$index = $i + 1;
		$complete = $row[$index];
		$na = $row['na_' . $index];
		echo "<tr><td>" . $descriptions[$i] . "</td><td><input type='checkbox' name='" . $index . "' class='contact-prefix' ";
		if($complete == 1){
			echo "checked";
		}
		echo "></td><td><input type='checkbox' name='na_" . $index . "' class='contact-prefix' ";
		if($na == 1){
			echo "checked";
		}
		echo "></td></tr>";
    }
	echo "</tbody></table></td></tr></tbody></table></div>";
} else {
    echo "0 results";
}
$conn->close();
?>
</div>
<div class="newcontact-tabbtm">
	<input class="save-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
</div>
</form>
</div>
</div>
</div>
</div>
</div>
