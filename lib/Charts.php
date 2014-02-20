<?php

include "DbConstants.php";

if(!isset($_GET['s'])) {
	header("Bad Request", true, 400);
	exit();
}

$db = getDb();

$state = $_GET['s'];

$flags = Array();

$race = NULL;

$gender = NULL;

$county = NULL;

$age_grp = NULL;

if(isset($_GET['r']) && is_numeric($_GET['r'])) {
	$race = $_GET['r'];
	$flags['r'] = true;
}

if(isset($_GET['g']) && ctype_alpha($_GET['g'])) {
	$gender = $_GET['g'];
	$flags['g'] = true;
}

if(isset($_GET['c']) && is_numeric($_GET['c'])) {
	$county = $_GET['c'];
	$flags['c'] = true;
}

if(isset($_GET['a']) && is_numeric($_GET['a'])) {
	$age_grp = $_GET['a'];
	$flags['a'] = true;
}

$from = " FROM population p JOIN state s ON s.id = p.state_id JOIN county c ON c.id = p.county_id";

$where = " WHERE s.name = '" . $state . "'";

$title_append = $state;

if(isset($flags['c'])) {
	
	$query = "SELECT name FROM county WHERE id = " . $county . " LIMIT 1";
	$result = mysqli_query($db, $query);
	
	if(mysqli_num_rows($result) > 0) {
		$where .= " AND c.id = " . $county;
		$row = mysqli_fetch_assoc($result);
		$name = $row["name"];
		$title_append = $name . ", " . $title_append;
	}
}

if(isset($flags['a'])) {
	$where .= " AND p.age_group_id = " . $age_grp;
}

if(isset($flags['g'])) {
	$where .= " AND p.age_group_id = '" . $gender . "'";
}

if(isset($flags['r'])) {
	$where .= " AND p.race_id = " . $race;
}

$master_results = Array();

if(!isset($flags['a'])) {

	$temp["title"] = "Age Groups For " . $title_append;
	$temp["results"] = Array();
	
	$query = "SELECT a.name as name, SUM(p.size) as sum" . $from . " JOIN age_group a ON a.id = p.age_group_id" . $where . " AND a.id != 4 GROUP BY a.id";
	
	$results = mysqli_query($db, $query);
	$num = mysqli_num_rows($results);
	if($num > 0) {
		while($result = mysqli_fetch_assoc($results)) {
			$tmp["title"] = $result["name"];
			$tmp["value"] = $result["sum"];
			$temp["results"][] = $tmp;
		}
		$master_results[] = $temp;
	}
}

if(!isset($flags['g'])) {

	$temp["title"] = "Genders For " . $title_append;
	$temp["Results"] = Array();
	
	$query = "SELECT p.gender as name, SUM(p.size) as sum" . $from . $where . " GROUP BY p.gender";
	
	$results = mysqli_query($db, $query);
	$num = mysqli_num_rows($results);
	if($num > 0) {
		while($result = mysqli_fetch_assoc($results)) {
			$tmp["title"] = $result["name"];
			$tmp["value"] = $result["sum"];
			$temp["results"][] = $tmp;
		}
		$master_results[] = $temp;
	}
}

if(!isset($flags['r'])) {
	
	$temp["title"] = "Races For " . $title_append;
	$temp["results"] = Array();
	
	$query = "SELECT r.description as name, SUM(p.size) as sum" . $from . " JOIN race r ON r.id = p.race_id" . $where . " GROUP BY r.id";
	
	$results = mysqli_query($db, $query);
	$num = mysqli_num_rows($results);
	if($num > 0) {
		while($result = mysqli_fetch_assoc($results)) {
			$tmp["title"] = $result["name"];
			$tmp["value"] = $result["sum"];
			$temp["results"][] = $tmp;
		}
		$master_results[] = $temp;
	}
}

header("Content-Type: application/json", true, 200);
echo json_encode($master_results);

exit();

?>
