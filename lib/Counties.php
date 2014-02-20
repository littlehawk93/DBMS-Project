<?php

	include "DbConstants.php";
	
	$db = getDb();
	
	if(!isset($_GET['state'])) {
		header("State Not Found", true, 400);
		echo "State name is invalid";
		exit();
	}

	$state = mysqli_real_escape_string($db, $_GET['state']);
	
	$query = "SELECT c.* FROM county as c INNER JOIN state as s ON s.id = c.state_id WHERE s.name = '" . $state . "'";
	
	$result = mysqli_query($db, $query);
	
	while($row = mysqli_fetch_assoc($result))
	{
		$temp['id'] = $row['id'];
		$temp['name'] = $row['name'];
		$temp['state_id'] = $row['state_id'];
		$temp['population'] = $row['population'];
		$response[] = $temp;
	}
	
	header("Content_Type: application/json", true, 200);
	echo json_encode($response);
?>
