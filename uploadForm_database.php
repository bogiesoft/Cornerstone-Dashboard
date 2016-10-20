<?php
require("connection.php");


$array = file($_FILES['fileUpload']["tmp_name"]);
echo "<table border=1>";
for ($j=0; $j < count($array); $j++) {
  # code...
   echo "<tr>";
  $cell = explode(',',$array[$j]);
  if ($cell[$j]==country) {
    # code...
  }
  for ($i=0; $i <=2; $i++) {
    # code..
    echo "<td>".$cell[$i]."</td>";

  }
   echo "</tr>";

}

//each row
// for ($i=0; $i < count($array); $i++) {
//
//   $cell = split(",", $array[$i]);
//   //each cell in a row
//   for ($j=0; $j <count($cell) ; $j++) {
//      echo "<td>".$cell[$j]."</td>";
//   }
//   echo "</tr>";
// }
// echo "</table";



// $selected = $_POST['select1'];
// echo "Master title".$file;
// $result = mysqli_query($conn,"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'sales'");
//
// echo "<table border='1' >
// <tr>
// <td align=center> <b>Data Field</b></td>";
// if($result -> num_rows>0){
// while($data = $result->fetch_assoc())
// {
//     echo "<tr>";
//     echo "<td align=center>$data[COLUMN_NAME]</td>";
//     echo "</tr>";
// }
// }else
// 	echo "no result";
// echo "</table>";
?>
