<?php
	ob_start();
	require_once("../includes/functions.php");

	$connection = connect_db();

	$username = isset($_POST["username"]) ? $_POST["username"]: "";
	$email = isset($_POST["email"]) ? $_POST["email"]: "";
	$firstname = isset($_POST["fname"]) ? $_POST["fname"]: "";
	$lastname = isset($_POST["lname"]) ? $_POST["lname"]: "";
	$password = isset($_POST["password"]) ? $_POST["password"]: "";

	$search_user = search_db('Users', 'username', $username);
	$search_email = search_db('Users', 'email', $email);

	$tmp = "";

	if($search_user == 1)
		$tmp .= "user=1";

	if($search_email == 1)
		if($tmp != "")
			$tmp .= "&email=1";
		else
			$tmp .= "email=1";

	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		if($tmp != "")
			$tmp .= "&check_email=1";
		else
			$tmp .= "check_email=1";

	if($tmp == "")
	{
		insert_Users($username, $email, $firstname, $lastname, $password);
		redirect_to("../public/log_in.php");
	}
	else
	{
		redirect_to("../public/register.php?again=1&{$tmp}");
	}
	
	ob_end_flush();
?>