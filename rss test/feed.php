<?php 
header('Content-Type: application/json');

$q = $_GET["q"];
 
$feed = new DOMDocument();
$feed->load($q); 
$json = array(); 
 
$json['title'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue; 
$json['description'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('description')->item(0)->firstChild->nodeValue; 
$json['link'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('link')->item(0)->firstChild->nodeValue; 
 
$items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item'); 
 
$json['item'] = array(); 
$i = 0; 
 
 
foreach($items as $item) { 
 
   $title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue; 
   $description = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue; 
   $pubDate = $item->getElementsByTagName('pubDate')->item(0)->firstChild->nodeValue; 
   $guid = $item->getElementsByTagName('guid')->item(0)->firstChild->nodeValue; 
    
   $json['item'][$i++]['title'] = $title; 
   $json['item'][$i++]['description'] = $description; 
   $json['item'][$i++]['pubdate'] = $pubDate; 
   $json['item'][$i++]['guid'] = $guid;    
      
} 
 
 
echo json_encode($json); 
 
 
?>
