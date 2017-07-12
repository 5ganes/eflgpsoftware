<?php
	session_start();
	include("programloginprocess.php");
	include('clientobjectsProgram.php'); 
?>
<!DOCTYPE html>
<html>
<head>
		<title>
			EFLGP Software - Login
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="wrapper">
	<header class="header">
		<div class="header-top">
			<div class="logo">
				<img src="images/logo.png" width="120" height="">
			</div>
			 <div class="col-md-8 center-text" style="line-height: 20px;margin-top: -1%;">
                  
                      <h4>Government of Nepal</h4>
                      <h5>Agriculture Development Ministry</h5>
                      <h4>Ministry of Federal Affairs and Local Development</h4>
                      <h3>Environment Friendly Local Governance Program</h3>
     
             </div>
            <div class="col-md-2 flag" align="right">
				<img src="images/flagrr.gif" width="60">
			</div>
		</div>
	</header>

	<section>
		<div class="container">
		 	<div class="login-form">
		 		<h2 style="background:#FFF; margin-bottom:15px">Login Here</h2>
				<form action="<?php echo $PHP_SELF; ?>" method="post" name="frmUserLogin">
					<table class="login-form">
						<?php if(!empty($errMsg)){ ?> 
							<tr align="center">
								<td colspan="3" class="warning"><?php echo $errMsg; ?></td>
							</tr>
							<tr><td>&nbsp;</td></tr>
						<?php } ?>
						<tr>
							<td><label>Username:</label></td>
							<td><input type="text" name="uname" ></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td><label>Password:</label></td>
							<td><input type="password" name="pswd"></td>
						</tr>
						<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
						<tr>
							<td><input type="submit" name="btnUserLogin" value="Login"></td>
						</tr>
					</table>
				
				</form>
			</div>
	
		</div>
	</section>

	<footer>
		Copyright &copy; 20<?php echo date("y");?> EFLGP | All Rights Reserved
	</footer>
</div>
	

</body>
</html>
