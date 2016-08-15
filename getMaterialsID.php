<?php
require("connection.php");
$materialsIDArray=array();

$vendor=$_POST['vendor'];
$material=$_POST['material'];
$type=$_POST['type'];
$result=mysqli_query($conn,"SELECT material_id from materials where vendor='$vendor' and material='$material' and type='$type'");
while($row = $result->fetch_assoc())
	{
		array_push($materialsIDArray, $row['material_id']);
	};
echo json_encode($materialsIDArray);
?>