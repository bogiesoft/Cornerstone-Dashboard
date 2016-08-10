<?php
require ("connection.php");

$full_name = $_POST['full_name'];
$address_line_1 = $_POST['address_line_1'];

$check=mysqli_query($conn,"select * from sales where full_name='$full_name' and address_line_1='$address_line_1' ");
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