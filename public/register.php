<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="stylesheets/style1.css">
	</head>
	<body>
		<?php 
			if($_GET["again"] == 1) 
			{ 
				echo "<h3>Please try again</h3>";
				echo "<ul>";
				if($_GET["user"] == 1) 
					echo "<li><p>Username exists</p></li>";
				if($_GET["email"] == 1) 
					echo "<li><p>Email exists</p></li>";
				if($_GET["check_email"] == 1)
					echo "<li><p>Enter a valid email</p></li>";
				echo "</ul>";
			} 
		?>

		<form action="../includes/register_process.php" method="post">
			Username<br> <input type="text" name="username" value=""> <br>
			Email<br> <input type="text" name="email" value=""> <br>
			First Name<br> <input type="text" name="fname" value=""> <br>
			Last Name<br> <input type="text" name="lname" value=""> <br>
			Password<br> <input type="password" name="password" value=""> <br>
			<input type="submit" name="submit" value="Submit"> <br><br>
			<a href="register.php" style="font-size: 15px;">Login</a>
		</form>

		<br>
		
	</body>
</html>