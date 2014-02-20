
function getCountiesForState(name)
{
	$.ajax(
		"../lib/Counties.php",
		{
			data: "state="+name,
			dataType: "json",
			type: "GET",
			success: function(data, textStatus, jqXHR) {
				
				$("#countyBox").empty();
				$("#countyBox").append('<option value="NULL">- none -</option>').val('NULL');
				$.each(data, function(i, item) {
					$("#countyBox").append("<option value=\"" + item.id + "\">" + item.name + "</option>");
				});
			},
			error: function() {
				//Error handling here
			}
		}
	);
}

function getDemoInfo(s, c, a, r, g) {
	$.ajax(
		"../lib/Demographics.php",
		{
			data: "s="+s+"&c="+c+"&a="+a+"&r="+r+"&g="+g,
			dataType: "json",
			type: "GET",
			success: function(data, textStatus, jqXHR) {
				$("#demographics").empty().append("<h1>Demographic Information</h1><p>State: " + data.state_name + "</p><p>\
				State Population: " + data.state_pop + "</p><p>County: " + data.county_name + "</p>\
				<p>County Population: " + data.county_pop + "</p><p>Age Group: " + data.age_group_name + "</p>\
				<p>Race: " + data.race_description + "</p><p>Gender: " + data.gender + "</p><p>\
				Selected Population: " + data.pop_size + "</p>");
				$("#demographics").show(500);
			},
			error: function() {
				//Error handling here
			}
		}
	);
}

function getChartInfo(s, c, a, r, g) {
	var string = "s=" + s;
	if(c != -1) string += "&c="+c;
	if(a != -1) string += "&a="+a;
	if(r != -1) string += "&r="+r;
	if(g != -1) string += "&g="+g;
	console.log(string);
	$.ajax(
		"../lib/charts.php",
		{
			data:string,
			dataType: "json",
			type: "GET",
			success: function(data, textStatus, jqXHR) {
				$.each(data, function(i, item) {
					$("#chartContainer").append(
						"<div class='row'>\
							<div class='col-md-12'>\
								<h3>" + data.title + "</h3>\
								<canvas id='chart" + i +"' width=100% height=200px></canvas>\
							</div>\
						</div>"
					);
				});
			},
			error: function() {
				//Error handling here
			}
		}
	);
}

function notNull() {
	var state = $("#stateBox").find(":selected").index()
	var county = $("#countyBox").find(":selected").index();
	var age = $("#ageBox").find(":selected").index();
	var race = $("#raceBox").find(":selected").index();
	var gender = $("#genderBox").find(":selected").index();
	if (county > 0 && age > 0 && race > 0 && gender > 0) {
		state = $("#stateBox").find(":selected").val();
		county = $("#countyBox").find(":selected").val();
		age = $("#ageBox").find(":selected").val();
		race = $("#raceBox").find(":selected").val();
		gender = $("#genderBox").find(":selected").val();
		getDemoInfo(state, county, age, race, gender);
		return true;
	}
	else {
		$("#demographics").hide(500);
		return false;
	}
}
