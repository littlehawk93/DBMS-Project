<?php

	include "DbConstants.php";
	
	$state = $_GET['s'];
	$county = $_GET['c'];
	$race = $_GET['r'];
	$gender = $_GET['g'];
	$age = $_GET['a'];
	
	if(!is_numeric($age) || !ctype_alpha($state) || !is_numeric($county) || !ctype_alpha($race) strcmp($gender, "Male") != 0 || strcmp($gender, "Female") != 0) {
		header("Not Valid", true, 400);
		echo "State name is invalid";
		exit();
	}
	
	$cxn = getDb();
	
	$query = "SELECT s.name as state_name, c.name as county_name, a.name as age_group_name, r.description, p.gender, p.size, s.population as state_pop, c.population as county_pop FROM population p JOIN state s ON s.id = p.state_id JOIN county c ON c.id = p.county_id JOIN race r ON r.id = p.race_id JOIN age_group a ON a.id = p.age_group_id WHERE a.id = " . $age . " AND p.gender = \'" . $gender . "\' AND s.name = " . $state . " AND r.name = " . $race " AND c.id = " . $county . " LIMIT 1;";
	
	$result = mysqli_query($cxn, $query);
	
	if($result) {
		
		$result = mysqli_fetch_assoc($result);
		
		header("Okay", 200, true);
		echo json_encode($result);
		
	}else {
		header("Not Valid", true, 406);
		echo "State name is invalid";
		exit();
	}
	
	$mysqli_close($cxn);
	exit();
?>