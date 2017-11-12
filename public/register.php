<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
	</head>
	<body>
		<?php
			if(isset($_GET['host']))
			{
				$db_host = $_GET['host'];
				$db_user = $_GET['user'];
				$db_pass = $_GET['pass'];
				$db_name = $_GET['name'];
			}
			else
			{
				$db_host = $_POST['host'];
				$db_user = $_POST['user'];
				$db_pass = $_POST['pass'];
				$db_name = $_POST['name'];
			}
		?>

		<?php if($_GET["again"] == 1) { ?>
			<h3>Please try again</h3>
		<?php } ?>

		<form action="../includes/register_process.php" method="post">
			Username: <input type="text" name="username" value=""> <br>
			Email : <input type="text" name="email" value=""> <br>
			First Name: <input type="text" name="fname" value=""> <br>
			Last Name: <input type="text" name="lname" value=""> <br>
			Password: <input type="password" name="password" value=""> <br>
			<br>
			<input type="hidden" name="host" value="<?php echo $db_host ?>">
			<input type="hidden" name="user" value="<?php echo $db_user ?>">
			<input type="hidden" name="pass" value="<?php echo $db_pass ?>">
			<input type="hidden" name="name" value="<?php echo $db_name ?>">
			<input type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>