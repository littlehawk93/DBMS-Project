
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
	if ($("#countyBox").find(":selected").index() > 0 && 
	$("#ageBox").find(":selected").index() > 0 &&
	$("#raceBox").find(":selected").index() > 0 &&
	$("#genderBox").find(":selected").index() > 0) {
		return true;
	}
	else
		return false;
}



