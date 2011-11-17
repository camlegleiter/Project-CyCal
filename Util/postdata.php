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
if (!is_numeric($posx))
{
	errorMessage("posx is not an int");
}
if (!is_numeric($posy))
{
	errorMessage("posy is not an int");
}
if (!is_numeric($sizex))
{
	errorMessage("sizex is not an int");
}
if (!is_numeric($sizey))
{
	errorMessage("sizey is not an int");
}
if (!is_numeric($themeid))
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
	$count = 0;
	foreach ($rss as $value)
	{
		$errorvalue = urlencode($value);
		$value = mysql_real_escape_string($errorvalue);
		$rssCheck = mysql_query("SELECT COUNT(*) FROM panel WHERE userid='$userid' AND rss='$value'");
		$numrows = mysql_fetch_assoc($rssCheck);
		mysql_free_result($rssCheck);
		mysql_query("INSERT INTO panel(userid,rss,posx,posy,sizex,sizey,themeid) VALUES ('$userid','$value','$posx','$posy','$sizex','$sizey','$themeid')");
		$rows = mysql_affected_rows();
		if($rows != -1){
			$count++;
		}

	}
	if($count == 0){
		errorMessage("Those Feeds are already on your page or you have not selected a feed.");
	}
	else{
		successMessage('');
	}
}
else if ($action == "delete")
{
	$count = 0;
	foreach ($rss as $value)
	{
		$value = mysql_real_escape_string(urlencode($value));
		$rssCheck = mysql_query("DELETE FROM panel WHERE userid='$userid' AND rss='$value'");
		$rows = mysql_affected_rows();
		if($rows != 0){
			$count++;
		}
	}
	if($count == 0){
		errorMessage("Those Feeds are not in our database.");
	}
	else{
		successMessage('');
	}

}
else if ($action == "edit")
{
	//Add error checking
	mysql_query("UPDATE panel SET posx='$posx',posy='$posy', sizex='$sizex' , sizey='$sizey' WHERE userid='$userid' AND rss='$rss'");
	
}
else if ($action == "get")
{
	$getRSS = mysql_query("SELECT * FROM panel WHERE userid='$userid'");
	$rssarr = array();
	while ($row = mysql_fetch_assoc($getRSS))
	{
		$rss = array();
		$rss['rss'] = urldecode($row['rss']);
		$rss['posx'] = $row['posx'];
		$rss['posy'] = $row['posy'];
		$rss['sizex'] = $row['sizex'];
		$rss['sizey'] = $row['sizey'];
		$rss['themeid'] = array();
		if ($row['themeid'] == -1)
		{
			$rss['themeid']['type'] = "System";
		}
		else
		{
			$rss['themeid']['type'] = "User";
		}
		array_push($rssarr, $rss);
	}
	mysql_free_result($getRSS);
	successMessage(json_encode($rssarr));
	$rows = mysql_fetch_assoc($getRSS);
	mysql_free_result($rssCheck);
	successMessage(print_r($rows,true));
}
else
{
	errorMessage("action '".urlencode($action)."' is not valid");
}
?>