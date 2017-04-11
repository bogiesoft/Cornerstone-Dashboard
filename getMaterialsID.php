<?php
require("connection.php");
$materialsIDArray=array();
$basedonArray=array();
$sizeArray=array();
$weightArray=array();
$heightArray=array();
$vendor=$_POST['vendor'];
$material=$_POST['material'];
$info=array();
$type=$_POST['type'];
$result=mysqli_query($conn,"SELECT material_id, based_on, size, weight, height from materials where vendor='$vendor' and material='$material' and type='$type'");
while($row = $result->fetch_assoc())
	{
		array_push($materialsIDArray, $row['material_id']);
		array_push($basedonArray, $row["based_on"]);
		array_push($sizeArray, $row["size"]);
		array_push($weightArray, $row["weight"]);
		array_push($heightArray, $row["height"]);
		array_push($info, $materialsIDArray);
		array_push($info, $basedonArray);
		array_push($info, $sizeArray);
		array_push($info, $weightArray);
		array_push($info, $heightArray);
	};
echo json_encode($info);
return;
?>