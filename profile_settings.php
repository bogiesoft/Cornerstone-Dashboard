<?php
require("header.php");
require("connection.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Profile</h1>
	</div>
<div class="dashboard-detail">
<div class="profile-block">
	<div class="image-block">
	<?php
		$temp = $_SESSION["user"];
		if(isset($_POST["submit_form"])){
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
			echo "<img  src='images/profiles/" . $temp . ".jpg' width = '200' height = '200'>";
		}
		else if (file_exists("images/profiles/" . $temp . ".png")){
			echo "<img  src='images/profiles/" . $temp . ".png' width = '200' height = '200'>";
		}
		else{
			echo "<img src='images/web-icons/user.png' width = '200' height = '200'>";
		}
	?>
	</div>
	<div class="info-block">
		<h1 style="font-size:36px; color:#356CAC; border-bottom: 2px solid #356CAC; padding-bottom:15px; margin-bottom:15px;"><?php echo $row["first_name"] . " " . $row["last_name"] ?></h1>
		<i><img class="profile-icon" src="images/web-icons/smartphone-6.png"/></i>
		<p class="profile-text"><?php echo $row["extension"]; ?></p>
		<i><img class="profile-icon" src="images/web-icons/paper-plane-1.png"/></i>
		<p class="profile-text"><?php echo $row["email"]; ?></p>
		<i><img class="profile-icon" src="images/web-icons/id-card-5.png"/></i>
		<p class="profile-text"><?php echo $row["department"]; ?></p>
		<i><img class="profile-icon" src="images/web-icons/network.png"/></i>
		<p class="profile-text"><?php echo $row["title"]; ?></p>
		<div class="profile-static">
			<p>You can change your profile picture below by choosing a .jpg or .png image.  Please make sure your image is close to a perfect square or rectangle and no bigger than 2 megabytes in size.</p>
		</div>
		<div class="button_bar">
		<form action='' method='post' enctype='multipart/form-data'>
		<input class="save-btn" type="submit" value="Upload" name="submit_form" style="float:right; width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
		<input type='file' name='fileToUpload' id='fileToUpload'>
		</form>
		</div>
	</div>
</div>
</div>
</div>