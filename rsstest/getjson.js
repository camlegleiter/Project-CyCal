var jsonObject;

function showRSS(str) {
	str = encodeURIComponent(str);

	$.get("pipes.php?q=" + str, function(xml, status) {
		jsonObject = xml2json.parser(xml);
	});
}
