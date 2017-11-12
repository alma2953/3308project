<?php
	ob_start();
	require_once("../includes/functions.php");

	$db_host = isset($_POST["host"]) ? $_POST["host"]: "";
	$db_user = isset($_POST["user"]) ? $_POST["user"]: "";
	$db_pass = isset($_POST["pass"]) ? $_POST["pass"]: "";
	$db_name = isset($_POST["name"]) ? $_POST["name"]: "";

	$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	if(mysqli_connect_errno())
	{
		redirect_to("../public/check_db.php?again=1");
	}
	else
	{
?>
		<form id="test" action="../public/log_in.php" method="post">
			<input type="hidden" name="host" value="<?php echo $db_host ?>">
			<input type="hidden" name="user" value="<?php echo $db_user ?>">
			<input type="hidden" name="pass" value="<?php echo $db_pass ?>">
			<input type="hidden" name="name" value="<?php echo $db_name ?>">
		</form>"
		<script type='text/javascript'>
			document.getElementById("test").submit();
		</script>"
	
<?php
	}
	ob_end_flush();
?>