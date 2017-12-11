<?php 
	require_once("../includes/functions.php");
	global $connection;
	$user_id = $_REQUEST['user_id'];

		$connection = connect_db();
		$query = "select * from Places where user_id='{$user_id}';";

		$result = mysqli_query($connection, $query);
		while($row = mysqli_fetch_assoc($result))
		{
			$array = array('name' => $row['location'],'lat' => $row['latitude'],'lng' => $row['latitude']);
			echo json_encode($array);
		}
	

?>

