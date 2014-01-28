<?php

	include "DbConstants.php";
	
	$db = getDb();

	$query = "SELECT * FROM `race`;";
	
	$results = $mysqli_query($query, $db);
	
	if(mysqli_num_rows($results) > 0) {
		$rows = mysqli_fetch_assoc($results);
	}
?>