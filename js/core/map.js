/*
*maps.js handles the canvas that holds the map of the USA
*/

$(document).ready(function() {
	$("#back_button").hide();
	$("area").click(function() {
		var clicked = $(this);
		$("#usa").hide(500);
		//alert("You clicked on: " + $(this).attr("title"));
		$("#back_button").show(500);
		$("#map_div").append("<br class='state'><img class='state' src='img/state/" + clicked.attr("alt") + ".gif'></img>");
		return false;
	});
});

function goBack() {
	$("#map_div").children(".state, #button").hide(500, function() { $(this).remove(); });
	$("#back_button").hide(500);
	$("#usa").show(500);
	return false;
}
