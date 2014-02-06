/*
*maps.js handles the canvas that holds the map of the USA
*/

//This variable handles how many milliseconds the various animations take to perform
var delay = 500;

//Perform this code once the page is fully loaded
$(document).ready(function() {
	$("#back_button").hide();
	$("area").click(function() {
		var clicked = $(this);
		goToState(clicked);
		return false;
	});
	$("#stateBox").change(function() {
		//Get the current text value from the selector
		var curVal = $("#stateBox option:selected").text();
		if(curVal != "NULL")
		{
			getCountiesForState(curVal);
		}
		var state = $("area[title='" + curVal + "'");
		goToState(state);
	});
});

//Change from usa image to image of selected state
function goToState(stateObj) {
	$("#usa").hide(delay);
	$("#back_button").show(delay);
	$("#map_div").append("<br class='state'><img class='state' src='img/state/" + stateObj.attr("alt") + ".gif'></img>");
	$("#stateBox, #statePara").hide(delay);
	getCountiesForState(stateObj.attr("title"));
}

//Go back to full usa map
function goBack() {
	$("#map_div").children(".state, #button").hide(delay, function() { $(this).remove(); });
	$("#back_button").hide(delay);
	$("#usa").show(delay);
	$("#stateBox, #statePara").show(delay);
	$('#stateBox option').eq(0).prop('selected', true);
	$('#countyBox').find('option').remove().end().append('<option value="NULL">- none -</option>').val('NULL');
}
