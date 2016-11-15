<?php
require("connection.php");
$sql = '';

function onPageLoad(){
  $sql = "UPDATE sales SET mark = 0";
  echo $sql;
  return $sql;
}

function singleMarkedUpdate(){
  $Client_name = $_POST['CName'];
  $address = $_POST['address'];
  $checked = $_POST['checked'];
  if ($checked == "true") {
    $sql = "UPDATE sales SET mark = 1 WHERE (full_name = '$Client_name' AND address_line_1 = '$address')";
  }else {
    $sql = "UPDATE sales SET mark = 0 WHERE (full_name = '$Client_name' AND address_line_1 = '$address')";
  }
  return $sql;
}

function multiMarkedUpdate(){
  $thissql = $_POST['sql'];
  $condition = substr($thissql, 26);      //remove SELECT * FROM sales WHERE
  if ($_POST['Select'] == 'all') {
    $sql = "UPDATE sales SET mark = 1 WHERE (".$condition.')';
  }else if ($_POST['Select'] == 'none') {
    $sql = "UPDATE sales SET mark = 0 WHERE (".$condition.')';
  }
  return $sql;
}

if($_POST['function'] == 0){
  $sql = onPageLoad();
}
if ($_POST['function'] == 1) {
  $sql = singleMarkedUpdate();
}
else if ($_POST['function'] == 2) {
  $sql = multiMarkedUpdate();
}
mysqli_query($conn, $sql) or die ("failed");

?>
