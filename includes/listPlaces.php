<?php 
	require_once("../includes/functions.php");
	global $connection;
	$user_id = $_REQUEST['user_id'];

		$connection = connect_db();
		$query = "select * from Places where user_id='{$user_id}';";

		$result = mysqli_query($connection, $query);
		$placesArray = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$array = array('name' => $row['location'],'lat' => $row['latitude'],'lng' => $row['latitude']);
			array_push($placesArray, $array);
		}
		echo json_encode($placesArray);

?>

