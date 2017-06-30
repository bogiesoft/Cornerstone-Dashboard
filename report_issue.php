<?php
require ("header.php");
?>

<div class="dashboard-cont" style="padding-top:110px;">
    <div class="contacts-title">
    <h1 class="pull-left">Report an Issue</h1>
    <div class="clear"></div>
    </div>
	<div class="dashboard-detail">
		<textarea id = "problem" style = "width: 800px; height: 500px" placeholder = "Enter Here..."></textarea>
	</div>
	 <div class="newcontact-tabbtm">
                    <input onclick = "saveReport()" class="save-btn store-btn" type="submit" value="Save" name="submit_form" style="float: left; width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
     </div>
</div>
<script>
function saveReport(){ 
	var user = <?php echo json_encode($_SESSION["user"]); ?>;
	var description = $("#problem").val();
	var data = [user, description];
	$.ajax({
		type: "POST",
		url: "save_report_issue.php",
		data: {report_info: data},
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function () {
			showSaveMessage();
			$("#problem").val("");
		}
	});
	function showSaveMessage(){
			swal({   title: "Saved!",   text: "Stephen will make your problems disappear",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true});  
	};
}
</script>