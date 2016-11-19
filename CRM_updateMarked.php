<?php
require("connection.php");
$sql = '';

function onPageLoad(){
  $sql = "UPDATE sales SET mark = 0";
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

function save_search(){
  $search_name = $_POST['search_name'];
  $val = explode(",", $_POST['val']);
  $col_name = explode(",",$_POST['col_name']);
  $today = date("Y-m-d");
  if (count($val)<6) {        //first val is null
    for($i = count($val); $i < 6; $i++) {
      $val[$i] = "$$$";
      $col_name[$i] = "$$$";
    }
  }
  $sql = "INSERT into saved_search (search_name, search_date,field1,value1, field2, value2, field3, value3, table_type, field4, value4, field5, value5) VALUES ('$search_name', '$today','$col_name[1]','$val[1]', '$col_name[2]','$val[2]', '$col_name[3]','$val[3]', 'CRM','$col_name[4]','$val[4]','$col_name[5]','$val[5]')";
  return $sql;
}

function delete_search(){
  $id = $_POST['id'];
  $sql = "DELETE FROM saved_search WHERE search_id=$id";
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
else if ($_POST['function'] == 3) {
  $sql = save_search();
}
else if ($_POST['function'] == 4) {
  $sql = delete_search();
}
echo $sql;
mysqli_query($conn, $sql) or die (mysqli_error($conn));

?>
