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
	   $firstName = $row['first_name']; //firstName
	   $lastName = $row['last_name']; //lastName
	   
	   $password = $row['password']; //password
	   $email = $row['email']; //email
	   $department = $row['department']; //department
	   $title = $row['title'];
   }
?>

<div class="dashboard-cont" style="padding-top:110px;">
	<h2>Account Information</h2><br>
	<div class="dashboard-detail">
		<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
				<div class="newcontactstab-detail">
					<p style = "color: #ff0000; background: #ffffff;"><?php echo $error; $error = "";?></p><br>
						<form action="update_users.php" id="form" method="POST">
						<div class="tabinner-detail" style = "margin-bottom: 15px">
							First Name: <input type = "text" name = "first" placeholder = "First Name" value = "<?php echo $firstName; ?>">
						</div>
						<div class="tabinner-detail" style = "margin-bottom: 15px">
							 Last Name: <input type = "text" name = "last" placeholder = "Last Name" value = "<?php echo $lastName;?>">
						</div>
						<div class="tabinner-detail" style = "margin-bottom: 15px">
							 User Name: <input type = "text" name = "user" placeholder = "User Name" value = "<?php echo $user; ?>">
						</div>
						<div class="tabinner-detail" style = "margin-bottom: 15px">
							  Password: <input type = "password" name = "password" placeholder = "Password" value = "<?php echo $password; ?>">
						</div>
						<div class="tabinner-detail" style = "margin-bottom: 15px">
								 Email: <input type = "text" name = "email" placeholder = "Email" value = "<?php echo $email; ?>">
						</div>
						<div class="tabinner-detail" style = "margin-bottom: 15px">
						Department:
							<select name = "depart"  style = "width: 150px">
											<option disabled selected value><?php echo $department; ?></option>
											<option>Sales</option>
											<option>Customer Service</option>
											<option>Project Management</option>
											<option>Production</option>
											<option>Development</option>
							</select>
						</div>
						<div class="tabinner-detail" style = "margin-bottom: 15px">
								 Title: <select name = "title"  style = "width: 150px">
											<option disabled selected value><?php echo $title; ?></option>
											<option>MEMBER</option>
											<option>ADMIN</option>
										</select>
						</div>
						</div><br>
						<div class="newcontact-tabbtm">
							  <input type = "submit" name = "account_save" value = "Save Account" onclick = "return confirm('Save Changes?')" style="float: right;width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;"/>
							  <input type = "submit" name = "account_delete" value = "Delete Account" onclick = "return confirm('Delete account?')" style="float: left;width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;"/>
						</div>
						</form>
</div>
</div>
</div>
</div>
</div>