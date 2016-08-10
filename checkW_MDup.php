<?php
require ("connection.php");

$material = $_POST['material'];
$type = $_POST['type'];
$vendor = $_POST['vendor'];


$check=mysqli_query($conn,"select * from materials where material='$material' and type='$type' and vendor='$vendor'");
    $checkrows=mysqli_num_rows($check);

   if ($checkrows>0){
	   echo 'duplicate';  
   }
   else
   {
   		echo'no duplicate';
   }

exit();

?>