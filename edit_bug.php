<?php
require("connection.php");
$bug_id = $_GET["bug_id"];
if(isset($_POST["submit_form"])){
	mysqli_query($conn, "DELETE FROM issues WHERE id = '$bug_id'") or die();
	header("location: bugs_list.php");
}
require ("header.php");
$result = mysqli_query($conn, "SELECT description from issues WHERE id = '$bug_id'");
$row = $result->fetch_assoc();
$description = $row["description"];
?>

<div class="dashboard-cont" style="padding-top:110px;">
<form action = "" method = "post">
    <div class="contacts-title">
    <h1 class="pull-left">Issue</h1>
    <div class="clear"></div>
	<textarea style = 'width: 500px; height: 500px'><?php echo $description; ?></textarea>
    </div>
	<div class="newcontact-tabbtm">
                    <input class="save-btn store-btn" type="submit" value="Delete" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
    </div>
</form>
</div>