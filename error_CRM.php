<?php
require("connection.php");
$result = mysqli_query($conn, "select * from sales limit 220, 10") or die("error");
while($row = $result->fetch_assoc()){
	echo $row["business"] . "<br>";
}
?>