<?php
/*
=====================================
	INCLUDES
=====================================
*/
if (!isset($TO_ROOT))
	$TO_ROOT = "../";	
require $TO_ROOT."includes/membersOnly.php";

/*
=====================================
	SENDING FUNCTIONS
=====================================
*/
function errorMessage($error){
	//for errors, use 409 error
	header("HTTP/1.1 409 Conflict");
	echo $error;
	exit;
}
function successMessage($success){
	echo $success;
	exit;
}

/*
=====================================
	GRAB POST DATA
=====================================
*/
$action = strtolower($_POST['action']);
$userid = $_POST['userid'];
$rss = $_POST['rss'];
$posx = $_POST['posx'];
$posy = $_POST['posy'];
$sizex = $_POST['sizex'];
$sizey = $_POST['sizey'];
$themeid = $_POST['themeid'];

/*
=====================================
	SET DEFAULTS
=====================================
*/
if(!isset($action)){
	//Needs to throw error after done testing!
	$action = "add";
	//errorMessage("action must be specified: ['add','delete','edit']");
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
/*
=====================================
	ERROR CHECKING
=====================================
*/
if (!is_int($posx))
{
	errorMessage("posx is not an int");
}
if (!is_int($posy))
{
	errorMessage("posy is not an int");
}
if (!is_int($sizex))
{
	errorMessage("sizex is not an int");
}
if (!is_int($sizey))
{
	errorMessage("sizey is not an int");
}
if (!is_int($themeid))
{
	errorMessage("themeid is not an int");
}

/*
=====================================
	DO WORK
=====================================
*/
if ($action == "add")
{
	$rssCheck = mysql_query("SELECT 1 FROM panel WHERE userid='$userid', rss='$rss'");
	$numrows = mysql_num_rows($rssCheck);
	
	if($numrows != 0){
		errorMessage("RSS feed already added");
	}

	mysql_query("INSERT INTO panel VALUES ('','$userid','$rss','$posx','$posy','$sizex','$sizey','$themeid')");
}
else if ($action == "delete")
{
	errorMessage("Not implemented yet.");
}
else if ($action == "edit")
{
	errorMessage("Not implemented yet.");
}
else
{
	errorMessage("action '".urlencode($action)."' is not valid");
}
?>