<!--
**********************************
* Title: ADMIN DASHBOARD V1
* Author: Mike
* Designed and Developed by: Mike
* URL: http://cr8tivemanila.com
**********************************
-->
<?php 
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Admin Dashboard - <?=SITENAME;?></title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oswald:400,700"/>
		<script type="text/javascript" src="scripts/jquery-1.8.0.min.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
	</head>
<body>
	<header>
		<div class="head-copy">Copyright &copy; <?php echo date("o"); ?> - <?=SITENAME;?></div>
		<div class="clear"></div>
	</header>
	<div class="loginBoxBG">
		<div class="loginBox">
				<?php
					if (isset($_GET['error'])) {
						echo "<div class='error'>Invalid Username or Password!</div>";
					}

				?>
			<form id="loginForm" name="loginForm" method="post" action="login-exec.php">
				<span class="loginTxt">Username:</span>
				<input name="login" type="text" class="textfield" id="login" required="required"/><br/>
				<span class="loginTxt">Password:</span>
				<input name="password" type="password" class="textfield" id="password" required="required"/><br/>
				<input name="submit" type="submit" class="loginbutt" id="submit" value="LOGIN"/>
			</form>
		</div>
	</div>
	<footer>
		Admin Dashboard - <b><?=SITENAME;?></b> / <a href="<?=SITEURL;?>"><?=SITEURL;?></a><br/>
		Designed and Coded by: Mike
	</footer>
</body>
</html>
