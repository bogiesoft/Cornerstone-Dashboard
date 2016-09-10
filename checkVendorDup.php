<?php
require ("connection.php");

$vendor_name = $_POST['vendor_name'];

$check=mysqli_query($conn,"select * from vendors where vendor_name='$vendor_name'");
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

