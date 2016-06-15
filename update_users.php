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
				$name = $_POST['first'] . " " . $_POST['last']; //new name
				
				if(strpos($email, '@') == FALSE){
					$_SESSION['error_update_user_account'] = "Email needs @ symbol";
					header("location: edit_user.php");
					exit();
				}
				else if(strpos($_POST['first'], ' ') || strpos($_POST['last'], ' ')){
					$_SESSION['error_update_user_account'] = "No spaces in first or last name";
					header("location: edit_user.php");
					exit();
				}
				else{
					$password = $_POST['password']; //new password
					$firstName = $_POST['first'];
					$lastName = $_POST['last'];
						
					$firstName = strtoupper($firstName);
					$lastName = strtoupper($lastName);
						
					$initial = $firstName[0] . $lastName[0]; //new initial
					
					if(isset($_POST['depart'])){
						$department = $_POST['depart']; //new department
						
						$sql = "UPDATE users SET user = '$new_user', password = '$password', initial = '$initial', department = '$department', name = '$name', email = '$email' WHERE user = '$user'";
						mysqli_query($conn, $sql) or die("ERROR");
						header("location: admin.php");
						exit();
					}
					else{
						$sql = "UPDATE users SET user = '$new_user', password = '$password', initial = '$initial', name = '$name', email = '$email' WHERE user = '$user'";
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