<?php

require("connection.php");
$data = array();
$handle = fopen($_FILES['fileUpload']["tmp_name"], 'r');
while($row = fgetcsv($handle , 100000 , ",")) {
   $data[] = $row;
}
for ($j=0; $j < count($data[0]); $j++) {
  for ($i=0; $i <count($data); $i++) {
    echo $data[$i][$j]." ";
  }
  echo "<br>";
}
echo $_POST["phone"];

?>
