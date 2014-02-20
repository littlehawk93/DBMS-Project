/*
*maps.js handles the canvas that holds the map of the USA
*/

//This variable handles how many milliseconds the various animations take to perform
var delay = 500;

//Perform this code once the page is fully loaded
$(document).ready(function() {
	
	$.ajax(
		"../lib/Init.php",
		{
			data: "",
			dataType: "json",
			type: "GET",
			success: function(data, textStatus, jqXHR) {
			
				var races = data.race;
				for(i=0;i<races.length;i++) {
					$("#raceBox").append("<option value=\"" + races[i].name + "\">" + races[i].description + "</option>");
				}
				
				var ages = data.age;
				for(i=0;i<ages.length;i++) {
					$("#ageBox").append("<option value=\"" + ages[i].id  +"\">" + ages[i].name + "</option>");
				}
			},
			error: function() {
				
				// Error Handling here
			}
		}
	);

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
		var state = $("area[title='" + curVal + "']");
		goToState(state);
	});
	
	$("#countyBox").change(function() { notNull(); });
	$("#ageBox").change(function() { notNull(); });
	$("#raceBox").change(function() { notNull(); });
	$("#genderBox").change(function() { notNull(); });
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
