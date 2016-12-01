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
$result = mysqli_query($conn, "SELECT * FROM project_management WHERE job_id = '$job_id'");
$row = $result->fetch_assoc();
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
<div class="newcontacttab-inner" style="width:700px;">
	<div class="tabinner-detail">
	<div class="clear"></div>
	</div>	
	<div class="tabinner-detail">
	<label style="width:30%; float:left">Complete</label><label style = 'width: 27%; float: right'>N/A</label>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input type="checkbox" name="1" class="contact-prefix" style="width:10%; float:left;"<?php if($row['1'] == 1){echo "checked";}?>><label style="width:30%; float:left">Permit is correct</label><input type="checkbox" name="na_1" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_1'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="2" type="checkbox" class="contact-prefix"<?php if($row['2'] == 1){echo "checked";}?>><label style="width:30%; float:left">Non-profit verified</label><input type="checkbox" name="na_2" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_2'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="3" type="checkbox" class="contact-prefix"<?php if($row['3'] == 1){echo "checked";}?>><label style="width:30%; float:left">Move Update/NCOA</label><input type="checkbox" name="na_3" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_3'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="4" type="checkbox" class="contact-prefix"<?php if($row['4'] == 1){echo "checked";}?>><label style="width:30%; float:left">Manual Duplicate review</label><input type="checkbox" name="na_4" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_4'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="5" type="checkbox" class="contact-prefix"<?php if($row['5'] == 1){echo "checked";}?>><label style="width:30%; float:left">Foreign Address Formatting</label><input type="checkbox" name="na_5" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_5'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="6" type="checkbox" class="contact-prefix"<?php if($row['6'] == 1){echo "checked";}?>><label style="width:30%; float:left">Blue Sheet Completed</label><input type="checkbox" name="na_6" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_6'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="7" type="checkbox" class="contact-prefix"<?php if($row['7'] == 1){echo "checked";}?>><label style="width:30%; float:left">Actual Postage verified against Estimate</label><input type="checkbox" name="na_7" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_7'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="8" type="checkbox" class="contact-prefix"<?php if($row['8'] == 1){echo "checked";}?>><label style="width:30%; float:left">NCOA checked off</label><input type="checkbox" name="na_8" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_8'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="9" type="checkbox" class="contact-prefix"<?php if($row['9'] == 1){echo "checked";}?>><label style="width:30%; float:left">Save mail.dat</label><input type="checkbox" name="na_9" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_9'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="10" type="checkbox" class="contact-prefix"<?php if($row['10'] == 1){echo "checked";}?>><label style="width:30%; float:left">Double checked job</label><input type="checkbox" name="na_10" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_10'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="11" type="checkbox" class="contact-prefix"<?php if($row['11'] == 1){echo "checked";}?>><label style="width:30%; float:left">Update job ticket</label><input type="checkbox" name="na_11" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_11'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="12" type="checkbox" class="contact-prefix"<?php if($row['12'] == 1){echo "checked";}?>><label style="width:30%; float:left">Are examples printed out?</label><input type="checkbox" name="na_12" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_12'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="13" type="checkbox" class="contact-prefix"<?php if($row['13'] == 1){echo "checked";}?>><label style="width:30%; float:left">Sign job ticket</label><input type="checkbox" name="na_13" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_13'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>
	<div class="tabinner-detail">
	<input style="width:10%; float:left" name="14" type="checkbox" class="contact-prefix"<?php if($row['14'] == 1){echo "checked";}?>><label style="width:30%; float:left">Manually checked data for errors?</label><input type="checkbox" name="na_14" class="contact-prefix" style="width:50%; float:right;"<?php if($row['na_14'] == 1){echo "checked";}?>>
	<div class="clear"></div>
	</div>	
</div>
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
