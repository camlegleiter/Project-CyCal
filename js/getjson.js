var jsonObject;

function showRSS(str) {
	str = encodeURIComponent(str);

	$.get("../includes/pipes.php?q=" + str, function(xml, status) {
		jsonObject = xml2json.parser(xml);
	});
}
