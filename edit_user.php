<?php
   //include("head.php");
   include("header.php");
   include("connection.php");
   
   $user = "";
   
   $error = $_SESSION['error_update_user_account'];
   $_SESSION['error_update_user_account'] = "";
   
   if(isset($_GET['user'])){
		$user = $_GET['user']; //username
   }
   else
   {
	   $user = $_SESSION['update_user_before'];
   }

   $_SESSION['update_user_before'] = $user;
   
   $sql = "SELECT * FROM users WHERE user = '$user'";
   $result = mysqli_query($conn, $sql) or die("ERROR");
   
   $firstName = "";
   $lastName = "";
   
   while($row = $result->fetch_assoc()){
	   $name = $row['name'];
	   $split = explode(" ", $name);
	   $firstName = $split[0]; //firstName
	   $lastName = $split[1]; //lastName
	   
	   $password = $row['password']; //password
	   $email = $row['email']; //email
	   $department = $row['department']; //department
   }
?>

<div class="content">
	<h2>Account Information</h2><br>
	<p style = "color: #ff0000;"><?php echo $error; ?></p>
	<form action="update_users.php" id="form" method="POST">
		First Name: <input type = "text" name = "first" placeholder = "First Name" value = "<?php echo $firstName; ?>"/>
		 Last Name: <input type = "text" name = "last" placeholder = "Last Name" value = "<?php echo $lastName;?>"/><br><br>
		 User Name: <input type = "text" name = "user" placeholder = "User Name" value = "<?php echo $user; ?>"/>
		  Password: <input type = "password" name = "password" placeholder = "Password" value = "<?php echo $password; ?>"/><br><br>
			 Email: <input type = "text" name = "email" placeholder = "Email" value = "<?php echo $email; ?>"/>
		Department: <select name = "depart">
						<option disabled selected value><?php echo $department; ?></option>
					 <?php
					 if($department != "ADMIN"){
						echo "<option>Sales</option>";
						echo "<option>Customer Service</option>";
						echo "<option>Project Management</option>";
						echo "<option>Production</option>";
						echo "<option>Development</option>";
			          } 
					  else{
						  echo "<option>ADMIN</option>";
					  }
					  ?>
					</select><br><br>
		  <input type = "submit" name = "account_save" value = "Save Account" onclick = "return confirm('Save Changes?')"/>
		  <input type = "submit" name = "account_delete" value = "Delete Account" onclick = "return confirm('Delete account?')"/>
	</form>