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
	<div class="contacts-title">
	<h1 class="pull-left">User Accounts</h1>
	<a class="pull-right" href="admin.php" >Back to Accounts</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">New Account</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<p style = "color: #ff0000; background: #f8f8f8; margin-left: 25px; margin-bottom: 15px"><?php echo $error; $error = "";?></p>
			<form action="update_users.php" id="form" method="POST">
			<div class="newcontacttab-inner">
				<div class="tabinner-detail">
				<label>First Name: </label>
				<input type = "text" name = "first" placeholder = "First Name" value = "<?php echo $firstName; ?>">
				</div>
				<div class="tabinner-detail">
				<label>Last Name: </label>
				<input type = "text" name = "last" placeholder = "Last Name" value = "<?php echo $lastName;?>">
				</div>
			</div>
			<div class="newcontacttab-inner">
				<div class="tabinner-detail">
				<label>User Name: </label>
				<input type = "text" name = "user" placeholder = "User Name" value = "<?php echo $user; ?>">
				</div>		
				<div class="tabinner-detail">
				<label>Password: </label>
				<input type = "password" name = "password" placeholder = "Password" value = "<?php echo $password; ?>">
				</div>		
				<div class="tabinner-detail">
				 <label>Email: </label>
				 <input type = "text" name = "email" placeholder = "Email" value = "<?php echo $email; ?>">
				</div>	
			</div>
			<div class="newcontacttab-inner">
				<div class="tabinner-detail">
				<label>Department: </label>
					<select name = "depart"  style = "width: 200px">
									<option disabled selected value><?php echo $department; ?></option>
									<option>Sales</option>
									<option>Customer Service</option>
									<option>Project Management</option>
									<option>Production</option>
									<option>Development</option>
					</select>
				</div>		
				<div class="tabinner-detail">
				<label>Title: </label>
				<select name = "title"  style = "width: 200px">
							<option disabled selected value><?php echo $title; ?></option>
							<option>MEMBER</option>
							<option>ADMIN</option>
				</select>
				</div>
			</div>	
			</div>
				<div class="newcontact-tabbtm">
					  <input class = 'save-btn' type = "submit" name = "account_save" value = "Save Account" style="float: right;width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;"/>
					  <input class = 'delete-btn' type = "submit" name = "account_delete" value = "Delete Account" style="float: left;width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;"/>
				</div>
				</form>


</div>
</div>
</div>
<script src="AdminSweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>