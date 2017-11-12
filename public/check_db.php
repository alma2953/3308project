<!DOCTYPE html>
<html>
	<head>
		<title>Check Database</title>
	</head>
	<body>
		<?php if($_GET["again"] == 1) { ?>
			<h3>Please try again</h3>
		<?php } ?>

		<form action="../includes/db_connection.php" method="post">
			Host: <input type="text" name="host" value=""> <br>
			User: <input type="text" name="user" value=""> <br>
			Password: <input type="text" name="pass" value=""> <br>
			DB name: <input type="text" name="name" value=""> <br>
			<br>
			<input type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>