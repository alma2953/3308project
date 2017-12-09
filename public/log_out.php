<?php

	ob_start();
	session_start();
	require_once("../includes/functions.php");

	$_SESSION['id'] = null;

	redirect_to("../site.php");

?>