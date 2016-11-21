<?php
require("connection.php");
$sql = '';

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
  $sql = "INSERT into saved_search (search_name, search_date,field1,value1, field2, value2, field3, value3, table_type, field4, value4, field5, value5) VALUES ('$search_name', '$today','$col_name[1]','$val[1]', '$col_name[2]','$val[2]', '$col_name[3]','$val[3]', 'CLIENT','$col_name[4]','$val[4]','$col_name[5]','$val[5]')";
  return $sql;
}

function delete_search(){
  $id = $_POST['id'];
  $sql = "DELETE FROM saved_search WHERE search_id=$id";
  return $sql;
}

if ($_POST['function'] == 0) {
    global $sql;
  $sql = save_search();
}
else if ($_POST['function'] == 1) {
  global $sql;
  $sql = delete_search();
}
mysqli_query($conn, $sql) or die (mysqli_error($conn));

?>
