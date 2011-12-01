var jsonObject;

function showRSS(url) {

	$.ajax({
		type: "POST",
		url: "pipes.php", 
		data: {
			q: url
		},
		statusCode: {
			200: function(xml, status) {
				jsonObject = xml2json.parser(xml);
			}
		}
	});
}
