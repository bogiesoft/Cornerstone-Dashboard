<?php
require("header.php");
require("connection.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
<h1>Profile</h1>

<?php
$temp = $_SESSION["user"];
if(isset($_POST["submit"])){
	$info = pathinfo($_FILES['fileToUpload']['name']);
	$ext = "." . $info["extension"];
	$newname = $temp . $ext;
	$target_Path = "images/profiles/" . $newname;
	//$target_Path = $target_Path.basename( $_FILES['fileToUpload']['name'] );
	move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $target_Path);
}
$result = mysqli_query($conn, "SELECT * FROM users WHERE user = '$temp'");
$row = $result->fetch_assoc();
$name = $row["first_name"] . " " . $row["last_name"];
$email = $row["email"];
if(file_exists("images/profiles/" . $temp . ".jpg")){
	echo "<div style = 'background: #ffffff'><img src='images/profiles/" . $temp . ".jpg' width = '200' height = '200'>";
}
else if(file_exists("images/profiles/" . $temp . ".JPG")){
	echo "<div style = 'background: #ffffff'><img src='images/profiles/" . $temp . ".JPG' width = '200' height = '200'>";
}
else if (file_exists("images/profiles/" . $temp . ".png")){
	echo "<div style = 'background: #ffffff'><img src='images/profiles/" . $temp . ".png' width = '200' height = '200'>";
}
else{
	echo "<div style = 'background: #ffffff'><img src='images/web-icons/user.png' width = '200' height = '200'>";
}
echo "<form action='' method='post' enctype='multipart/form-data'>
    <input type='file' name='fileToUpload' id='fileToUpload'>
    <input type='submit' value='Upload Image' name='submit'>
</form>";
echo "<h3>$name</h3>";
	
echo "</div>";
?>
</div>