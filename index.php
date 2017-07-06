<?php
include("head.php");
require ("connection.php");
   session_start();
   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn, $_POST['user']);
      $mypassword = mysqli_real_escape_string($conn, $_POST['password']); 
	  
	  $_SESSION['user'] = $myusername; 
	  
      $sql = "SELECT * FROM users WHERE user = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	  $_SESSION['initial'] = $row['initial'];
      
      $count = mysqli_num_rows($result); 
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        header("location: dashboard.php");
      }else {
         $error = "Your Login Name or Password is invalid";
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
					<p style = "color: #ff0000;"><?php echo $error; $error = "";?> </p>
                	<input name="user" type="text" placeholder="User Name" class="email-input" />
                    <input name="password" type="password" placeholder="Password" class="password-input" />
                    <input name="" type="submit" value="LOGIN" class="login-button"/>
                    <div class="loginform-row">
                    	<div class="formrow-left">
                        	<input name="" type="checkbox" value="" class="remember-input">
                            <label>Remember me</label>
                            <div class="clear"></div>
                        </div>
                        <div class="formrow-right">
                        	<a href="#">Forgot Password?</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
        </div>
      </div>
  </body>
</html>