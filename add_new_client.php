<?php

require ("connection.php");

$full_name = $_POST['full_name'];
$address_line_1 = $_POST['address_line_1'];
$business = $_POST['business'];
$phone = $_POST['phone'];
$cell_phone = $_POST['cell_phone'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$source = $_POST['source'];
$second_contact = $_POST['second_contact'];
$rep = $_POST['rep'];
$title = $_POST['title'];
$fax = $_POST['fax'];
$web_address = $_POST['web_address'];
$notes = $_POST['notes'];

session_start();

$user_name = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d G:i:s");
$a_p = date("A");
$_SESSION['date'] = $today;
$job = "added new client";
$today2 = date("Y-m-d");

//<<<<<<< HEAD
$check=mysqli_query($conn,"select * from sales where (full_name='$full_name' and address_line_1 ='$address_line_1') or full_name = '$full_name'");
//=======
//>>>>>>> refs/remotes/origin/master
    $checkrows=mysqli_num_rows($check);

    if ($checkrows>0){
	   echo '<script>alert("This record has already been added.");
	   window.location.href = "clients.php";</script>';
   }
   else{
	   $sql = "INSERT INTO sales (full_name,address_line_1,business,phone,cell_phone,city,state,zipcode,source,second_contact,rep,title,fax,web_address,notes,type,date_added) VALUES ('$full_name', '$address_line_1', '$business', '$phone','$cell_phone','$city','$state','$zipcode','$source','$second_contact','$rep', '$title', '$fax', '$web_address', '$notes', 'Client', '$today2')";
		$result = $conn->query($sql) or die('error');

		$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
		$result7 = $conn->query($sql6) or die('Error querying database 5.');
   }
   
$conn->close();
header("location: clients.php");
exit();

?>


