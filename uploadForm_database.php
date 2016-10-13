<?php
require("connection.php");

$result = mysqli_query($conn,"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'sales'");

echo "<table border='1' >
<tr>
<td align=center> <b>Data Field</b></td>";
if($result -> num_rows>0){
while($data = $result->fetch_assoc())
{   
    echo "<tr>";
    echo "<td align=center>$data[COLUMN_NAME]</td>";
    echo "</tr>";
}
}else 
	echo "no result";
echo "</table>";
?>