<?php
//for errors, use 409 error
include "membersOnly.php";

function errorMessage($error){
header("HTTP/1.1 409 Conflict");
echo $error;
exit;
}
function successMessage($success){
echo $success;
exit;
}

$action = $_POST['action'];
$userid = $_POST['userid'];
$rss = $_POST['rss'];
$posx = $_POST['posx'];
$posy = $_POST['posy'];
$sizex = $_POST['sizex'];
$sizey = $_POST['sizey'];
$themeid = $_POST['themeid'];

if(!isset($action)){
	$action = "add";
}
if(!isset($posx)){
	$posx = 0;
}
if(!isset($posy)){
	$posy = 0;
}
if(!isset($sizex)){
	$sizex = 500;
}
if(!isset($sizey)){
	$sizey = 400;
}
if(!isset($themeid)){
	$themeid = -1;
}
$rssCheck = mysql_query("SELECT 1 FROM panel WHERE userid='$userid', rss='$rss'");
$numrows = mysql_num_rows($rssCheck);
if($numrows != 0){
	errorMessage("RSS feed already added");
}

mysql_query("INSERT INTO panel VALUES ('','$userid','$rss','$posx','$posy','$sizex','$sizey','$themeid')");

?>