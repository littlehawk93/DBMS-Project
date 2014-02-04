<?php

	include "DbConstants.php";
	
	$db = getDb();
	
	if(!isset($_GET['state'])) {
		header("State Not Found", true, 404);
		echo "State name is invalid";
		exit();
	}

	$state = mysqli_real_escape_string($db, $_GET['state']);
	
	$query = "SELECT id FROM state WHERE name = \'$state\'";
	
	$result = mysqli_query($db, $query);
	
	$rows = mysqli_fetch_assoc($result);
	
	if(sizeof($rows) < 1) {
		header("State Not Found", true, 404);
		echo "State name is invalid";
		exit();
	}
	
	$id = $rows[0]['id'];
	
	$query = "SELECT * FROM county WHERE state_id = $id";
	
	$result = mysqli_query($db, $query);
	
	$rows = mysqli_fetch_assoc($result);
	
	header("OK", true, 200);
	echo json_encode($rows);
?>