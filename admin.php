<?php
   //include("head.php");
   include("header.php");
   include("connection.php");
   
   if(!isset($_SESSION['user']) || $_SESSION['title'] != 'ADMIN'){
	   echo "<script>alert('Must be logged in as Admin');</script>";
	   echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
	   exit();
   }
   else{
	   $error = "";
	   $inUse = FALSE;
	   $errorAt = FALSE;
	   $department = "";
	   $success = "";
	   $pass = FALSE;
	   
	   
	   if(isset($_POST['account_add'])){
		   
		   $firstName = $_POST['first'];
		   $lastName = $_POST['last'];
		   
		   if($_POST['first'] == "" || $_POST['last'] == "" || $_POST['user'] == "" || $_POST['password'] == "" || $_POST['email'] == ""){
			   $error = "Required field left blank";
		   }
		   else
		   {
			   $userName = $_POST['user'];
			   $email = $_POST['email'];
			   $sql = "SELECT user FROM users";
			   $result = mysqli_query($conn, $sql);
			   
			   while($row = $result->fetch_assoc()){
				   if($row['user'] == $userName){
					   $inUse = TRUE;
				   }
			   }
			   
			  
			   if($inUse == TRUE){
				   $error = "Username in use";
			   }
			   else if(strpos($email, '@') == FALSE){
				   $errorAt = TRUE;
				   $error = "Email needs @ symbol";
			   }
			   else if($_POST['depart'] == "")
			   {
				   $error = "Department not selected";
			   }
			   else if($_POST['title'] == "")
			   {
				   $error = "Title not selected";
			   }
			   else
			   {
				   $pass = TRUE;
				   $success = "Account Saved";
				   $user = $_POST['user']; //user
				   
				   $firstName = $_POST['first']; //first name
				   $lastName = $_POST['last']; //last name
				   
				   $firstName1 = strtoupper($firstName);
				   $lastName1 = strtoupper($lastName);
				   $firstINIT = $firstName1[0];
				   $lastINIT = $lastName1[0];
				   $initials = $firstINIT . $lastINIT; //initial
				   
				   $email = $_POST['email']; //email
				   $password = $_POST['password']; //password
				   $department = $_POST['depart']; //department
				   $title = $_POST['title'];       //title
				   
				   $sql = "INSERT INTO users (user, first_name, last_name, initial, email, password, department, title) VALUES ('$user', '$firstName', '$lastName', '$initials', '$email', '$password', '$department', '$title')";
				   mysqli_query($conn, $sql) or die("error");
				   
			   }
		   }
	   }
	}
?>


<div class="dashboard-cont" style="padding-top:110px;">
	<h2>Account Information</h2><br>
<div class="dashboard-detail">
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<h1 style = "padding-top: 10px; padding-left: 10px">New Account</h1>
			<p style = "color: #ff0000; background: #f8f8f8; margin-left: 25px; margin-bottom: 15px"><?php echo $error; $error = "";?></p>
			<form action="" id="form" method="POST">
				<div class="tabinner-detail">
				<label style = "margin-left: 50px;">First Name:</label> 
				<input class = "contact-prefix" type = "text" name = "first" placeholder = "First Name" value = "<?php if(isset($_POST['first']) && $pass == FALSE){echo $_POST['first'];}?>">
				</div>
				<div class = "tabinner-detail">
				<label style = "margin-left: 50px;">Last Name:</label> 
				<input class = "contact-prefix" type = "text" name = "last" placeholder = "Last Name" value = "<?php if(isset($_POST['last']) && $pass == FALSE){echo $_POST['last'];}?>">
				</div>
				<div class = "tabinner-detail">
				<label style = "margin-left: 50px;">User Name:</label> 
				<input class = "contact-prefix" type = "text" name = "user" placeholder = "User Name" value = "<?php if(isset($_POST['user'])){if($inUse == FALSE && $pass == FALSE){echo $_POST['user'];} else{echo "";}}?>">
				</div>
				<div class = "tabinner-detail">
				<label style = "margin-left: 50px;">Password:</label> 
				<input class = "contact-prefix" type = "password" name = "password" placeholder = "Password" value = "<?php if(isset($_POST['password']) && $pass == FALSE){echo $_POST['password'];}?>">
				</div>
				<div class = "tabinner-detail">
				<label style = "margin-left: 50px;">Email:</label> 
				<input class = "contact-prefix" type = "text" name = "email" placeholder = "Email" value = "<?php if(isset($_POST['email'])){if($errorAt == FALSE && $pass == FALSE){echo $_POST['email'];} else{echo "";}}?>">
				</div>
				<div class = "tabinner-detail">
				<label style = "margin-left: 50px;">Department:</label> 
					<select name = "depart" style = "width: 150px">
					<option selected value>-- Select Dep --</option>
					<option>Sales</option>
					<option>Customer Service</option>
					<option>Project Management</option>
					<option>Production</option>
					<option>Development</option>
					</select>
				</div>
				<div class="tabinner-detail">
				<label style = "margin-left: 50px;">Title:</label> 
					<select name = "title" style = "width: 150px">
					<option selected value>-- Select Title --</option>
					<option>MEMBER</option>
					<option>ADMIN</option>
				</select>
				</div><br>
				</div>
			<div class="newcontact-tabbtm">	
				<input class = 'save-btn' style="float: right; width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;" type = "submit" name = "account_add" value = "Save Account"/>
			</div>
			</form><br><br>
			<p style = "color: #00cc33;"><?php echo $success;?></p>
		<?php
		echo " <div id='table-scroll' class = 'allcontacts-table'><table id='table' border='1' cellspacing='2' cellpadding='2' class='table-bordered allcontacts-table' >"; // start a table tag in the HTML
		echo "<tbody>";
		echo "<tr valign = 'top'><th class = 'allcontacts-title'>Users<span class = 'allcontacts-subtitle'></span></th></tr>";
		echo "<tr valign = 'top'><td colspan = '2'><table id = 'client_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='user' data-index='2'> Username </th><th class='maintable-thtwo data-header' data-name='first_name' data-index='0'>First Name</th><th class='maintable-thtwo data-header' data-name='last_name' data-index='1'> Last Name</th><th class='maintable-thtwo data-header' data-name='password' data-index='3'> Password </th><th class='maintable-thtwo data-header' data-name='initial' data-index='4'> Initial </th><th class='maintable-thtwo data-header' data-name='email' data-index='5'> Email </th><th class='maintable-thtwo data-header' data-name='department' data-index='6'> Department </th><th class='maintable-thtwo data-header' data-name='title' data-index='7'> Title </th></tr></thead><tbody>";

		$sql = "SELECT * FROM users ORDER BY department ASC";
		$result = mysqli_query($conn, $sql) or die("ERROR");

		while($row = $result->fetch_assoc()){
			$user = $row['user'];
			echo "<tr><th><a href = 'edit_user.php?user=$user'>" . $row['user'] .  "</a></th><th>" . $row['first_name'] . "</th><th>" . $row['last_name'] . "</th><th>" . $row['password'] .  "</th><th>" . $row['initial'] .  "</th><th>" . $row['email'] .  "</th><th>" . $row['department'] . "</th><th>" . $row['title'] . "</th></tr>";
		}

		?>
		</div>
		</div>
		</div>
		</div>
		</div>
		<script src="AdminSweetAlert.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>