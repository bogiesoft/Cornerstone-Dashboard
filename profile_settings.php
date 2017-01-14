<?php
require("header.php");
require("connection.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Profile</h1>
	</div>
<div class="dashboard-detail">
<!----
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
</div>";
	
?>
---->
<div class="profile-block">
	<div class="image-block">
		<img src="images/profiles/mbroc.jpg">
	</div>
</div>
</div>
	<div class="newcontact-tabbtm">
		<input class="save-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
		<input class="delete-btn" type = "submit" value = "Delete" name = "delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px; float:left">
	</div>
</form>
</div>