<?php
	ob_start();
	require_once("../includes/functions.php");

	$db_host = isset($_POST["host"]) ? $_POST["host"]: "";
	$db_user = isset($_POST["user"]) ? $_POST["user"]: "";
	$db_pass = isset($_POST["pass"]) ? $_POST["pass"]: "";
	$db_name = isset($_POST["name"]) ? $_POST["name"]: "";

	$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	$username = isset($_POST["username"]) ? $_POST["username"]: "";
	$email = isset($_POST["email"]) ? $_POST["email"]: "";
	$firstname = isset($_POST["fname"]) ? $_POST["fname"]: "";
	$lastname = isset($_POST["lname"]) ? $_POST["lname"]: "";
	$password = isset($_POST["lname"]) ? $_POST["lname"]: "";


	$search = search_db('Users', 'username', $username);
	if($search == 1)
	{ ?>
		<form id="test" action="../public/register.php?again=1" method="post">
			<input type="hidden" name="host" value="<?php echo $db_host ?>">
			<input type="hidden" name="user" value="<?php echo $db_user ?>">
			<input type="hidden" name="pass" value="<?php echo $db_pass ?>">
			<input type="hidden" name="name" value="<?php echo $db_name ?>">
		</form>"
		<script type='text/javascript'>
			document.getElementById("test").submit();
		</script>"
	
	<?php }
	else
	{
		insert_Users($username, $email, $firstname, $lastname, $password);
		echo "<p>value inserted</p>";
	}


	ob_end_flush();
?>