<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["imported_file"]["name"]);
$uploadOk = 1;
$cvsFileType = pathinfo($target_file,PATHINFO_EXTENSION);
move_uploaded_file($_FILES["imported_file"]["tmp_name"], $target_file);
$test = fopen($target_file, "r");
while($string = fgetcsv($test, ", "))
{
	echo $string[0];
}
?>