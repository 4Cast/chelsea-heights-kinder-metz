<?php
	@session_start();
	
	include_once '../include/common.php';
	$_SESSION['logged_in']=false;
	
	if(isset($_POST['submit']))
	{
		if
		(
			$_POST['username']=="ChelseaHeightsKinder"&&
			$_POST['password']=="CHK@dmin2017"
		)
		{
			$_SESSION['is_super_admin']=true;
			$_SESSION['logged_in']=true;
			header("Location:index.php");
			exit;
		}
	}
	else
	{
		$_SESSION['logged_in']=false;
	}
?>
<html>
	<head>
		<title>Log in</title>
		<link rel="stylesheet" href="../include/foundation5/css/foundation.css">
		<link rel="stylesheet" href="css/admin.css">
	  	<script src="../js/jquery-1.7.2.min.js"></script>	
		
	  	<script src="../include/foundation/js/foundation/foundation.js"></script>
	  	<script>$(document).foundation();</script>	  	
	</head>
	
	<body>
		<div class="row">
			<div class="large-6 large-offset-3 small-12 medium-6 columns">
				
				<form action="" method="post">
					<table style='margin-top:120px;border:1px solid #ADB0B5;padding:10px;border-radius:5px;'>
						<tr>
							<td colspan="2" align="center">
								<img width="" src="../images/footer/Footer_Logo.png" />
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<strong><?php echo SLOGAN;?> CMS Admin</strong>
							</td>
						</tr>
						<tr>
							<td>Username : </td>
							<td><input type="text" name="username" />
						</tr>
						<tr>
							<td>Password : </td>
							<td><input type="password" name="password" />
						</tr>
						<tr>
							<td></td>
							<td><input class="button" type="submit" value="Log In" name="submit" />
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>