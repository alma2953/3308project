<?php
	session_start();
	$array = array('id' => (int)$_SESSION['id']);
	echo json_encode($array);
?>