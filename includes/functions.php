<?php 


	function redirect_to($new_location)
	{
		header("Location: " . $new_location);
		exit;
	}

	function connect_db()
	{
		define('DB_SERVER', 'trendzy.cgtircrxumcl.us-east-1.rds.amazonaws.com');
		define('DB_USERNAME', 'trendzyuser');
		define('DB_PASSWORD', 'trendzyuser');
		define('DB_DATABASE', 'Trendzy');

		// $connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
		// $database = mysql_select_db(DB_DATABASE) or die(mysql_error());

		$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(mysqli_error());

		return $connection;
	}

	function search_db($table, $attribute, $item)
	{
		global $connection;

		if($attribute == 'password')
		{
			$tmp = "set @tmp = SHA1('$item');";
			$query = "select id from {$table} where password=@tmp;";
			$result = mysqli_query($connection, $tmp);
		}
		else
		{
			$query = "select id from {$table} where {$attribute}='{$item}';";
		}
		
		$result = mysqli_query($connection, $query);

		$count = 0;
		while($i = mysqli_fetch_assoc($result))
		{
			$count += 1;
		}

		if($count == 0)
		{
			return 0;
		}
		else
		{
			mysqli_free_result($result);
			return 1;
		}
	}

	function insert_Users($username, $email, $firstname, $lastname, $password)
	{
		global $connection;

		$query = "insert into Users (username, email, first_name, last_name, password) ";
		$query .= "values ('{$username}', '{$email}', '{$firstname}', '{$lastname}', SHA1('{$password}'));";

		$result = mysqli_query($connection, $query);
	}

	function insert_Places($longitude, $latitude, $location, $user_id)
 	{
 		$connection = connect_db();
 
		$query = "insert into Places (longitude, latitude, location, user_id) ";
 		$query .= "select * from (select {$longitude}, {$latitude}, '{$location}', {$user_id}) as tmp ";
 		$query .= "where not exists (";
 		$query .= "select location from Places where location='{$location}') limit 1;";

 		$result = mysqli_query($connection, $query);
 	}
 
 	function list_Places($user_id)
 	{
 		$connection = connect_db();
 		$query = "select * from Places where user_id={$user_id};";
 
 		$result = mysqli_query($connection, $query);
 		
 		$arr = array();
 		while($row = mysqli_fetch_assoc($result))
 		{
 			// echo "<h3> {$row['user_id']} </h3>";
 			// echo "<p> Location: {$row['location']}, Longitude: {$row['longitude']}, Latitude: {$row['latitude']} <p>";

 			array_push($arr, $row['location']);
 		}

 		return $arr;
 	}

 	function getCoordinates($address){
 
	$address = str_replace(" ", "+", $address); 
	 
	$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
	 
	$response = file_get_contents($url);
	 
	$json = json_decode($response,TRUE); 
	
	$arr = array('lat'=>$json['results'][0]['geometry']['location']['lat'], 'lng'=>$json['results'][0]['geometry']['location']['lng']);

	return $arr;
	}

?>