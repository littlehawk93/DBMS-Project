
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