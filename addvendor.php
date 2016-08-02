<?php

require ("connection.php");


$vendor_name = $_POST['vendor_name'];
$vendor_add = $_POST['vendor_add'];
$vendor_contact = $_POST['vendor_contact'];
$vendor_phone = $_POST['vendor_phone'];
$vendor_email = $_POST['vendor_email'];
$vendor_website = $_POST['vendor_website'];

session_start();
$user_name = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d G:i:s");
$a_p = date("A");
$job = "added new vendor";



$check=mysqli_query($conn,"select * from vendors where vendor_name='$vendor_name' and vendor_add='$vendor_add' ");
    $checkrows=mysqli_num_rows($check);

    if ($checkrows>0){
	   echo '<script>alert("This record has already been added.");
	   window.location.href = "vendors.php";
	   </script>';  
   }


$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
$result7 = $conn->query($sql6) or die('Error querying database 5.');


$sql = "INSERT INTO vendors(vendor_name,vendor_add,vendor_contact,vendor_phone,vendor_email,vendor_website) VALUES ('$vendor_name', '$vendor_add', '$vendor_contact', '$vendor_phone','$vendor_email','$vendor_website')";
$result = $conn->query($sql) or die('Error querying database.');
 
$conn->close();

header("location: http://localhost/crst_dashboard/vendors.php ");

exit();

?>

