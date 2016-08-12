<?php
require("connection.php");
$typesArray=array();

$vendor=$_POST['vendor'];
$material=$_POST['material'];
$result=mysqli_query($conn,"SELECT Distinct type from materials where vendor='$vendor' and material='$material'");
while($row = $result->fetch_assoc())
	{
		array_push($typesArray, $row['type']);
	};
echo json_encode($typesArray);
?>