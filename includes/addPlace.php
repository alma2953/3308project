<?php 
	echo "here";
	require_once("../includes/functions.php");
	$latitude = $_REQUEST['lat'];
	$longitude = $_REQUEST['long'];
	$location = $_REQUEST['loc'];
	$user_id = $_REQUEST['user_id'];

		global $connection;

		$connection = connect_db();

		$query = "insert into Places (longitude, latitude, location, user_id) ";
		$query .= "values ('{$longitude}', '{$latitude}', '{$location}', '{$user_id}');";

		$result = mysqli_query($connection, $query);

?>