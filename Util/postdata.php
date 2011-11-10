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
	header("HTTP/1.1 409 ".$error);
	echo $error;
	exit;
}
function successMessage($success){
	echo $success;
	exit;
}
/*
=====================================
	Error Testing
=====================================
*/

if($_POST['error'] || isset($_GET['error'])){
	errorMessage('Error message flag set');
}
if($_POST['success']){
	successMessage('Success message flag set');
}

/*
=====================================
	GRAB POST DATA
=====================================
*/
$action = mysql_real_escape_string(strtolower($_POST['action']));
$userid = mysql_real_escape_string($_SESSION['id']);
$_POST['rss'] = json_decode(stripslashes($_POST['rss']),true);
$rss = $_POST['rss'];
$posx = mysql_real_escape_string($_POST['posx']);
$posy = mysql_real_escape_string($_POST['posy']);
$sizex = mysql_real_escape_string($_POST['sizex']);
$sizey = mysql_real_escape_string($_POST['sizey']);
$themeid = mysql_real_escape_string($_POST['themeid']);

/*
=====================================
	Print all
=====================================
*/
if($_POST['print']){
	successMessage(print_r($_POST, true));
}

/*
=====================================
	SET DEFAULTS
=====================================
*/
if(!isset($action) || empty($action)){
	//Needs to throw error after done testing!
	$action = "add";
	//errorMessage("action must be specified: ['add','delete','edit', 'get']");
}
if(!isset($posx) || empty($posx)){
	$posx = 0;
}
if(!isset($posy) || empty($posy)){
	$posy = 0;
}
if(!isset($sizex) || empty($sizex)){
	$sizex = 500;
}
if(!isset($sizey) || empty($sizey)){
	$sizey = 400;
}
if(!isset($themeid) || empty($themeid)){
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
	foreach ($rss as $value)
	{
		$errorvalue = urlencode($value);
		$value = mysql_real_escape_string($errorvalue);
		$rssCheck = mysql_query("SELECT COUNT(*) FROM panel WHERE userid='$userid' AND rss='$value'");
		$numrows = mysql_fetch_assoc($rssCheck);
		if($numrows['COUNT(*)'] != 0){
			errorMessage("RSS feed already added: ".$errorvalue);
		}
		mysql_free_result($rssCheck);
		mysql_query("INSERT INTO panel(userid,rss,posx,posy,sizex,sizey,themeid) VALUES ('$userid','$value','$posx','$posy','$sizex','$sizey','$themeid')");
	}
	successMessage('');
}
else if ($action == "delete")
{
	errorMessage("Not implemented yet.");
}
else if ($action == "edit")
{
	errorMessage("Not implemented yet.");
}
else if ($action == "get")
{
	$getRSS = mysql_query("SELECT * FROM panel WHERE userid='$userid'");
	$rows = mysql_fetch_assoc($getRSS);
	mysql_free_result($rssCheck);
	successMessage(print_r($rows,true));
}
else
{
	errorMessage("action '".urlencode($action)."' is not valid");
}
?>