<?php
require ("connection.php");

$field1 = $_POST['field1'];
$value1 = $_POST['value1'];
$field2 = $_POST['field2'];
$value2 = $_POST['value2'];
$field3 = $_POST['field3'];
$value3 = $_POST['value3'];

$check=mysqli_query($conn,"select * from saved_search where field1='$field1' and value1='$value1' and field2='$field2'  and value2='$value2' and field3='$field3' and value3='$value3'");
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