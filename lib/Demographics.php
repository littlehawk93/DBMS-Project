<?php

	include "DbConstants.php";
	
	if(!isset($_GET['s']) || !isset($_GET['c']) || !isset($_GET['r']) || !isset($_GET['g']) || !isset($_GET['a'])) {
		exit();
	}
	
	$state = $_GET['s'];
	$county = $_GET['c'];
	$race = $_GET['r'];
	$gender = $_GET['g'];
	$age = $_GET['a'];
	
	if(!is_numeric($age) || !ctype_alnum($state) || !is_numeric($county) || !ctype_alnum($race) || (strcmp($gender, "Male") != 0 && strcmp($gender, "Female") != 0)) {
		header("Not Valid", true, 400);
		exit();
	}
	
	$cxn = getDb();
	
	$query = "SELECT s.name as state_name, c.name as county_name, a.name as age_group_name, r.description as race_description, p.gender as gender, p.size as pop_size, s.population as state_pop, c.population as county_pop, (p.size / s.population) AS pop_in_state, (p.size / c.population) AS pop_in_county FROM population p JOIN state s ON s.id = p.state_id JOIN county c ON c.id = p.county_id JOIN race r ON r.id = p.race_id JOIN age_group a ON a.id = p.age_group_id WHERE a.id = " . $age . " AND p.gender = '" . $gender . "' AND s.name = '" . $state . "' AND r.name = '" . $race . "' AND c.id = " . $county . " LIMIT 1;";
	
	$result = mysqli_query($cxn, $query);
	
	if(mysqli_num_rows($result) > 0) {
		
		$result = mysqli_fetch_assoc($result);
		
		header("Content-Type: application/json", true, 200);
		echo json_encode($result);
		
	}
?>
