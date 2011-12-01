<?php

function isValidURL($url) {
	return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

$q = $_POST["q"];

$url = urldecode($q);

if (isValidURL($url)) {
	echo file_get_contents($q);
} else {
	echo "<error><message>Invalid URL. Please enter a valid URL including http://.</message></error>";
}
?>
