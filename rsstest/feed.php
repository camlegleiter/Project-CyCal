<?php 
header('Content-Type: application/json');

// Grab the passed in URL to be modified
$q = $_GET["q"];

// Create a new DOM document and get the XML data from it
$feed = new DOMDocument();
$feed->load($q); 

// Parse the base information from the RSS
$json = array();  
$json['title'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue; 
$json['description'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('description')->item(0)->firstChild->nodeValue; 
$json['link'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('link')->item(0)->firstChild->nodeValue; 

// Get all current items in the RSS
$items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item'); 
 
$json['item'] = array(); 
$i = 0; 

// Loop through each item and put the corresponding item in the JSON object
foreach ($items as $item) { 
   $title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue; 
   $description = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue; 
   $pubDate = $item->getElementsByTagName('pubDate')->item(0)->firstChild->nodeValue; 
   $guid = $item->getElementsByTagName('guid')->item(0)->firstChild->nodeValue; 
    
   $json['item'][$i++]['title'] = $title; 
   $json['item'][$i++]['description'] = $description; 
   $json['item'][$i++]['pubdate'] = $pubDate; 
   $json['item'][$i++]['guid'] = $guid;    
} 

// Return the JSON object back
echo json_encode($json); 
?>
