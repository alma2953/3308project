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
	
	if($search_user == 1 and $search_email == 1)
	{ 
		redirect_to("../public/register.php?again=1&email=1&user=1");
	}
	elseif($search_user == 1)
	{
		redirect_to("../public/register.php?again=1&user=1");
	}
	elseif($search_email == 1)
	{
		redirect_to("../public/register.php?again=1&email=1");
	}
	else
	{
		if(!ereg(".+@.+\.", $email))
		{
			redirect_to("../public/register.php?again=1&check_email=1");
		}
		else
		{
			insert_Users($username, $email, $firstname, $lastname, $password);
			redirect_to("../public/log_in.php");
		}
	}

	ob_end_flush();
?>