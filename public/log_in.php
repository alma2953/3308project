<!DOCTYPE html>
<html>
	<head>
		<title>Log in</title>
		<link rel="stylesheet" type="text/css" href="stylesheets/style1.css">
	</head>
	<body>
		<?php if($_GET["again"] == 1) { ?>
			<h3>Please try again</h3>
		<?php } ?>

		<form action="../includes/log_in_process.php" method="post">
			Username: <input type="text" name="username" value=""> <br>
			Password: <input type="password" name="password" value=""> <br>
			<input type="submit" name="submit" value="Submit"> <br><br>
			<a href="register.php" style="font-size: 15px;">Register</a>
		</form>

		<br>

	</body>
</html>