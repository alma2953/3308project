<?php 
	function redirect_to($new_location)
	{
		header("Location: " . $new_location);
		exit;
	}


	function search_db($table, $attribute, $item)
	{
		global $connection;

		if($attribute == 'password')
		{
			$query = $query = "select id from {$table} where password=SHA1('{$item}');";
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

?>