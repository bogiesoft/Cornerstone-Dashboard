<?php
	require("connection.php");
	
	session_start();
	$user = $_SESSION['update_user_before'];
	$new_user = $_POST['user']; //new user
	$_SESSION['error_update_user_account'] = "";
	
	if($_POST['first'] == "" || $_POST['last'] == "" || $_POST['user'] == "" || $_POST['password'] == "" || $_POST['email'] == ""){
		   $_SESSION['error_update_user_account'] = "Required field left blank";
		   header("location: edit_user.php");
		   exit();
	   }
	
	if(isset($_POST['account_save'])){
		$sql = "SELECT user FROM users where user != '$user'";
		$result = mysqli_query($conn, $sql);
		
		while($row = $result->fetch_assoc()){
			if($new_user == $row['user']){
				$_SESSION['error_update_user_account'] = "Username in use";
				header("location: edit_user.php");
				exit();
			}
		}
				$email = $_POST['email']; //new email
				$firstName = $_POST['first']; //new first name
				$lastName = $_POST['last']; //new last name
				
				if(strpos($email, '@') == FALSE){
					$_SESSION['error_update_user_account'] = "Email needs @ symbol";
					header("location: edit_user.php");
					exit();
				}
				else{
					$password = $_POST['password']; //new password
					$firstName = $_POST['first'];
					$lastName = $_POST['last'];
						
					$firstName1 = strtoupper($firstName);
					$lastName1 = strtoupper($lastName);
						
					$initial = $firstName1[0] . $lastName1[0]; //new initial
					
					if(isset($_POST['depart']) && !(isset($_POST['title']))){
						$department = $_POST['depart']; //new department
						
						$sql = "UPDATE users SET user = '$new_user', password = '$password', initial = '$initial', department = '$department', first_name = '$firstName', last_name = '$lastName', email = '$email' WHERE user = '$user'";
						mysqli_query($conn, $sql) or die("ERROR");
						header("location: admin.php");
						exit();
					}
					else if(!(isset($_POST['depart'])) && isset($_POST['title'])){
						$title = $_POST['title']; //new title
						
						$sql = "UPDATE users SET user = '$new_user', password = '$password', initial = '$initial', title = '$title', first_name = '$firstName', last_name = '$lastName', email = '$email' WHERE user = '$user'";
						mysqli_query($conn, $sql) or die("ERROR");
						header("location: admin.php");
						exit();
					}
					else if(isset($_POST['depart']) && isset($_POST['title'])){
						$department = $_POST['depart']; //new title and department
						$title = $_POST['title'];
						
						$sql = "UPDATE users SET user = '$new_user', password = '$password', initial = '$initial', title = '$title', department = '$department', first_name = '$firstName', last_name = '$lastName', email = '$email' WHERE user = '$user'";
						mysqli_query($conn, $sql) or die("ERROR");
						header("location: admin.php");
						exit();
					}
					else{
						$sql = "UPDATE users SET user = '$new_user', password = '$password', initial = '$initial', first_name = '$firstName', last_name = '$lastName', email = '$email' WHERE user = '$user'";
						mysqli_query($conn, $sql) or die("ERROR");
						header("location: admin.php");
						exit();
					}
				}
	}
	if(isset($_POST['account_delete']))
	{
		$sql = "DELETE FROM users WHERE user = '$user'";
		mysqli_query($conn, $sql) or die("ERROR");
		header("location: admin.php");
	}
	
	exit();
?>