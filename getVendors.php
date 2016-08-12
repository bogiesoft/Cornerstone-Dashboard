<?php
require("connection.php");
$vendorsArray=array();
$result=mysqli_query($conn,"SELECT Distinct vendor from materials");
while($row = $result->fetch_assoc())
	{
		array_push($vendorsArray, $row['vendor']);
	};
echo json_encode($vendorsArray);
?>