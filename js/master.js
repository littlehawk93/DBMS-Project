
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
				
				// Error Handling here
			}
		}
	);
}

function notNull() {
	console.log("here");
	var county = $("#countyBox").find(":selected").index();
	var age = $("#ageBox").find(":selected").index();
	var race = $("#raceBox").find(":selected").index();
	var gender = $("#genderBox").find(":selected").index()
	if (county > 0 && age > 0 && race > 0 && gender > 0)
		return true;
	else
		return false;
}
