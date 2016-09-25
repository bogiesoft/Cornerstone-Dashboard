<?php
require('connection.php');
$id=$_POST['id'];
$delete = "DELETE FROM saved_search WHERE search_id=$id";
mysqli_query($conn, $delete) or die(mysql_error());
?>