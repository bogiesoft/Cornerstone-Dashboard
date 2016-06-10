<?php

require ("connection.php");

$_1 = (isset($_POST['1'])) ? 8 : 0 ;
$_2 = (isset($_POST['2'])) ? 8 : 0 ;
$_3 = (isset($_POST['3'])) ? 7 : 0 ;
$_4 = (isset($_POST['4'])) ? 7 : 0 ;
$_5 = (isset($_POST['5'])) ? 7 : 0 ;
$_6 = (isset($_POST['6'])) ? 7 : 0 ;
$_7 = (isset($_POST['7'])) ? 7 : 0 ;
$_8 = (isset($_POST['8'])) ? 7 : 0 ;
$_9 = (isset($_POST['9'])) ? 7 : 0 ;
$_10 = (isset($_POST['10'])) ? 7 : 0 ;
$_11 = (isset($_POST['11'])) ? 7 : 0 ;
$_12 = (isset($_POST['12'])) ? 7 : 0 ;
$_13 = (isset($_POST['13'])) ? 7 : 0 ;
$_14 = (isset($_POST['14'])) ? 7 : 0 ;
$job_id = $_POST['job_id'];




$percent = $_1 + $_2 + $_3 + $_4 + $_5 + $_6 + $_7 + $_8 + $_9 + $_10 + $_11 + $_12 + $_13 + $_14 ;

$sql = "UPDATE yellow_sheet SET percent = '$percent' WHERE job_id = $job_id ";
$result = $conn->query($sql) or die('Error querying database 0.');

//$sql1 = "UPDATE yellow_sheet SET 1 = $_1,  WHERE job_id = $job_id ";
//$result1 = $conn->query($sql1) or die('Error querying database 1.');

//, 2 = $_POST[2], 3 = '$_POST['3']', 4 = '$_POST['4']', 5 = '$_POST['5']', 6 = '$_POST['6']', 7 = '$_POST['7']', 8 = '$_POST['8']', 9 = '$_POST['9']', 10 = '$_POST['10']', 11 = '$_POST['11']', 12 = '$_POST['12']', 13 = '$_POST['13']', 14 = '$_POST['14']'

$conn->close();
header("location: http://localhost/crst_dashboard/project_management.php ");
exit();
?>