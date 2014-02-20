<?php

	include "DbConstants.php";
	
	$db = getDb();
	
	$query = "SELECT * FROM race;";
	
	$results = mysqli_query($db, $query);
	
	
	while($row = mysqli_fetch_assoc($results)) {
	
		$response["race"][] = $row;
	}
	
	$query = "SELECT * FROM `age_group`;";
	
	$results = mysqli_query($db, $query);
	
	while($row = mysqli_fetch_assoc($results)) {
		
		$response["age"][] = $row;
	}
	
	header("Content_Type: application/json", true, 200);
	echo json_encode($response);
?>
