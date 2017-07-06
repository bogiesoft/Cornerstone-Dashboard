<?php
require ("header.php");
require("connection.php");
$bug_id = $_GET["bug_id"];
$result = mysqli_query($conn, "SELECT description from issues WHERE id = '$bug_id'");
$row = $result->fetch_assoc();
$description = $row["description"];
?>

<div class="dashboard-cont" style="padding-top:110px;">
    <div class="contacts-title">
    <h1 class="pull-left">Issue</h1>
    <div class="clear"></div>
	<textarea style = 'width: 500px; height: 500px'><?php echo $description; ?></textarea>
    </div>
</div>