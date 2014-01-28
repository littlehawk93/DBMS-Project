<?php

	function getDb()
	{
		$host = "localhost";
		$user = "root";
		$password = "flyinglemurs";
		$database = "dbms_project";

		$db = mysqli_connect($host, $username, $password, $database) or die(return null;);
		return $db;
	}

?>