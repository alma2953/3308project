<?php 
if(!isset($_POST['host'])) {
	require_once("../includes/functions.php");
	redirect_to("check_db.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Log in</title>
	</head>
	<body>
		<?php
			$db_host = $_POST['host'];
			$db_user = $_POST['user'];
			$db_pass = $_POST['pass'];
			$db_name = $_POST['name'];
		?>
		<?php if($_GET["again"] == 1) { ?>
			<h3>Please try again</h3>
		<?php } ?>

		<form action="../includes/log_in_process.php" method="post">
			Username: <input type="text" name="username" value=""> <br>
			Password: <input type="password" name="password" value=""> <br>
			<br>
			<input type="hidden" name="host" value="<?php echo $db_host ?>">
			<input type="hidden" name="user" value="<?php echo $db_user ?>">
			<input type="hidden" name="pass" value="<?php echo $db_pass ?>">
			<input type="hidden" name="name" value="<?php echo $db_name ?>">
			<input type="submit" name="submit" value="Submit">
		</form>

		<br>

		<a href="register.php?host=<?php echo $db_host ?>&user=<?php echo $db_user ?>&pass=<?php echo $db_pass ?>&name=<?php echo $db_name ?>">Click here to register</a>
	</body>
</html>