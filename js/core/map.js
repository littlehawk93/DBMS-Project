/*
*maps.js handles the canvas that holds the map of the USA
*/

$(document).ready(function() {
	$("area").click(function() {
		var clicked = $(this);
		$("#usa").hide(500);
		//alert("You clicked on: " + $(this).attr("title"));
		$("#map_div").append("<button class='state' onclick='goBack()' class='state'>Back</button><br class='state'>" + 
			"<img class='state' src='img/state/" + clicked.attr("title") + ".gif'></img>");
		return false;
	});
});

function goBack() {
	$("#map_div").children(".state").hide(500, function() { $(this).remove(); });
	$("#usa").show(500);
	return false;
}
