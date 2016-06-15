<?php
   //include("head.php");
   include("header.php");
   include("connection.php");
   
   $error = "";
   $inUse = FALSE;
   $spaces = FALSE;
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
		   
		   if(strpos($firstName, ' ') == TRUE || strpos($lastName, ' ') == TRUE){
			   
			   $error = "No spaces in first or last name";
			   $spaces = TRUE;
			   
		   }
		   else if($inUse == TRUE){
			   $error = "Username in use";
		   }
		   else if(strpos($email, '@') == FALSE){
			   $errorAt = TRUE;
			   $error = "Email needs @ symbol";
		   }
		   else if(!(isset($_POST['depart'])))
		   {
			   $error = "Department not selected";
		   }
		   else
		   {
			   $pass = TRUE;
			   $success = "Account Saved";
			   $user = $_POST['user']; //user
			   
			   $firstName = $_POST['first'];
			   $lastName = $_POST['last'];
			   $name = $firstName . " " . $lastName; //name
			   
			   $firstName = strtoupper($firstName);
			   $lastName = strtoupper($lastName);
			   $firstINIT = $firstName[0];
			   $lastINIT = $lastName[0];
			   $initials = $firstINIT . $lastINIT; //initial
			   
			   $email = $_POST['email']; //email
			   $password = $_POST['password']; //password
			   $department = $_POST['depart']; //department
			   
			   $sql = "INSERT INTO users (user, name, initial, email, password, department) VALUES ('$user', '$name', '$initials', '$email', '$password', '$department')";
			   mysqli_query($conn, $sql) or die("error");
			   
		   }
	   }
   }
?>


<div class="content">
	<h2>Account Information</h2><br>
	<p style = "color: #ff0000;"><?php echo $error; $error = "";?></p>
	<form action="" id="form" method="POST">
		First Name: <input type = "text" name = "first" placeholder = "First Name" value = "<?php if($spaces == TRUE){echo "";}else if(isset($_POST['first']) && $pass == FALSE){echo $_POST['first'];}?>"/>
		 Last Name: <input type = "text" name = "last" placeholder = "Last Name" value = "<?php if($spaces == TRUE){echo "";}else if(isset($_POST['last']) && $pass == FALSE){echo $_POST['last'];}?>"/><br><br>
		 User Name: <input type = "text" name = "user" placeholder = "User Name" value = "<?php if(isset($_POST['user'])){if($inUse == FALSE && $pass == FALSE){echo $_POST['user'];} else{echo "";}}?>"/>
		  Password: <input type = "password" name = "password" placeholder = "Password" value = "<?php if(isset($_POST['password']) && $pass == FALSE){echo $_POST['password'];}?>"/><br><br>
			 Email: <input type = "text" name = "email" placeholder = "Email" value = "<?php if(isset($_POST['email'])){if($errorAt == FALSE && $pass == FALSE){echo $_POST['email'];} else{echo "";}}?>"/>
		Department: <select name = "depart">
						<option disabled selected value>-- Select Dep --</option>
						<option>Sales</option>
						<option>Customer Service</option>
						<option>Project Management</option>
						<option>Production</option>
						<option>Development</option>
					</select><br><br>
		  <input type = "submit" name = "account_add" value = "Save Account" onclick = "return confirm('Save Account?')"/>
	</form><br><br>
	<p style = "color: #00cc33;"><?php echo $success;?></p>
<?php
echo " <div id='table-scroll'><table id='table' border='1' cellspacing='2' cellpadding='2' class='sortable' >"; // start a table tag in the HTML
echo "<thead>";
echo "<tr><th>  </th><th> Name </th><th> Username </th><th> Password </th><th> Initial </th><th> Email </th><th> Department </th></tr>";
echo "</thead>";
echo "<tbody>";

$sql = "SELECT * FROM users ORDER BY department ASC";
$result = mysqli_query($conn, $sql) or die("ERROR");

while($row = $result->fetch_assoc()){
	$user = $row['user'];
	echo "<tr><th><a href='edit_user.php?user=$user'>Edit</a> </th><th>" . $row['name'] . "</th><th>" .  $row['user'] .  "</th><th>" . $row['password'] .  "</th><th>" . $row['initial'] .  "</th><th>" . $row['email'] .  "</th><th>" . $row['department'] . "</th></tr>";
}

?>
</div>