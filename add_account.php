<?php
   include("head.php");
   include("connection.php");
   
   $error = "";
   
   if(isset($_POST['account_add'])){
	   if($_POST['first'] == "" || $_POST['last'] == "" || $_POST['user'] == "" || $_POST['password'] == "" || $_POST['email'] == ""){
		   $error = "Required field left blank";
	   }
	   else
	   {
		   $userName = $_POST['user'];
		   $email = $_POST['email'];
		   $sql = "SELECT user FROM users";
		   $result = mysqli_query($conn, $sql);
		   
		   $inUse = FALSE;
		   
		   while($row = $result->fetch_assoc()){
			   if($row['user'] == $userName){
				   $inUse = TRUE;
			   }
		   }
		   
		   if($inUse == TRUE){
			   $error = "Username in use";
		   }
		   else if(strpos($email, '@') == FALSE){
			   $error = "Email needs @ symbol";
		   }
		   else
		   {
			   
		   }
	   }
   }
?>

<body>
    <div class="wrapper">
    	<div class="main-login">
        	<div class="login-outer">
            	<div class="login-logo">
                	<a href="#"><img id="loginlogo" class="img img-responsive" src="images/crstlogo.png" alt="" title="" ></a>
                </div>
                <form action="" method="post">
					<p id = "error_loc" style = "color: #ff0000;"><?php echo $error; $error = "";?></p>
					<input id = "first" name="first" type="text" placeholder="First Name" class="email-input"/>
					<input id = "last" name="last" type="text" placeholder="Last Name" class="email-input" />
                	<input id = "user" name="user" type="text" placeholder="User Name" class="email-input" />
                    <input id = "password" name="password" type="password" placeholder="Password" class="password-input" />
					<input id = "email" name="email" type="text" placeholder="Email" class="email-input" />
                    <input name="account_add" type="submit" value="Add Account" class="login-button"/>
                    <div class="loginform-row">
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
        </div>
      </div>
  </body>
</html>