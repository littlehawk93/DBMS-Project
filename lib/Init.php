<?php

	include "DbConstants.php";
	
	$db = getDb();

	$query = "SELECT * FROM `race`;";
	
	$results = $mysqli_query($query, $db);
	
	if(mysqli_num_rows($results) > 0) {
		$rows = mysqli_fetch_assoc($results);
		for($i=0;i<sizeof($rows);$i++) {
			$temp["name"] = $rows[$i]["name"];
			$temp["description"] = $rows[$i]["description"];
			$temp["id"] = $rows[$i]["id"];
			$response[] = $temp;
		}
	}
	echo json_encode($response);
?>