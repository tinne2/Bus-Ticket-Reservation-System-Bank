<?php session_start(); 

	require_once('connection.php')	;

	$errors;

	if (isset($_POST['Submit'])) {

		if ( (empty($_POST['username'])) || (empty($_POST['password'])) ) {
			$errors = "Username or Password Can't Empty.";
		}
		else
		{
		
			$username = $_POST['username'];

			$password = $_POST['password'];
			
			$query = "select * from admin where admin_id ='{$username}' and admin_password = '{$password}'";

			
			$result = mysql_query($query, $connection);
			
			// $row = mysql_num_rows($result);

			if ($result) {

				$_SESSION['login_user'] = $username; 
				header("Location: register.php");

			} else {
			
				$errors = "Username or Password is invalid";

			}

				mysql_close($connection);
		}
	}


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Login - Bank</title>

	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
	<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
	<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
	<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	$(document).pngFix( );
	});
	</script>
</head>

<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
	
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	
	<form action=""  method="post">
	
		
	<div id="loginbox">
	
		<!--  start login-inner -->
		<div id="login-inner">
			<span><?php echo (isset($errors))? $errors : ' ' ?> </span>
			 <table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<th>Username</th>
					<td><input name="username" type="text" class="login-inp"  id="user_id" /></td>
				</tr>
				<tr>
					<th>Password</th>
					<td><input type="password" name="password" value=""  onfocus="this.value=''"  class="login-inp" /></td>
				</tr>
				
				<tr>
					<th></th>
					<td><input type="submit" value="Submit"  name="Submit" class="submit-login"  /></td>
					
				</tr>
			</table>
		</div>
	 	<!--  end login-inner -->
	<div class="clear"></div>
	<a href="" class="forgot-pwd">Forgot Password?</a>
 </div>
 	</form>

 
		<div class="clear"></div>
		<a href="" class="back-login">Back to login</a>
	</div>
	<!--  end forgotbox -->

</div>

<!-- End: login-holder -->
</body>
</html>
