
<?php 
require('head.php');
?>
  <body>
    <div class="wrapper">
    	<div class="main-login">
        	<div class="login-outer">
            	<div class="login-logo">
                	<a href="#"><img id="loginlogo" class="img img-responsive" src="images/crstlogo.png" alt="" title="" ></a>
                </div>
                <form action="login.php" method="post">
					<p id = "error_login" style = "color: #ff0000;"><?php 
						session_start();
						$_SESSION['errorValue'];
						if(isset($_SESSION['error']) && $_SESSION['errorValue'] == TRUE){
							echo $_SESSION['error'];
							$_SESSION['errorValue'] = FALSE; 
						}?></p>
                	<input name="user" type="text" placeholder="User Name" class="email-input" />
                    <input name="password" type="password" placeholder="Password" class="password-input" />
                    <input name="" type="submit" value="LOGIN" class="login-button" />
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