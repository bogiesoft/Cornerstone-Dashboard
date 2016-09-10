<?php
require("connection.php");
$materialsArray=array();

$vendor=$_POST['vendor'];
$result=mysqli_query($conn,"SELECT Distinct material from materials where vendor='$vendor'");
while($row = $result->fetch_assoc())
	{
		array_push($materialsArray, $row['material']);
	};
echo json_encode($materialsArray);
?>