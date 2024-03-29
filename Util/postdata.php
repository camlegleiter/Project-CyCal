<?php
/*
=====================================
	INCLUDES
=====================================
*/
if (!isset($TO_ROOT))
	$TO_ROOT = "../";	
require $TO_ROOT."includes/membersOnly.php";
require $TO_ROOT."includes/simple_html_dom.php";
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
$action = strtolower($_POST['action']);
$userid = mysql_real_escape_string($_SESSION['id']);
$_POST['rss'] = json_decode(stripslashes($_POST['rss']),true);
$rss = $_POST['rss'];
$posx = mysql_real_escape_string($_POST['posx']);
$posy = mysql_real_escape_string($_POST['posy']);
$sizex = mysql_real_escape_string($_POST['sizex']);
$sizey = mysql_real_escape_string($_POST['sizey']);
$themeid = mysql_real_escape_string($_POST['themeid']);
$minimized = mysql_real_escape_string($_POST['minimized']);

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
if(!isset($minimized) || empty($minimized)){
	$minimized = 0;
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
if (!is_numeric($minimized))
{
	errorMessage("minimized is not an int");
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
		$html = @file_get_html($value);
		if (!$html)
			errorMessage('Invalid RSS Feed:'.$value);
		$good = null;
		$rss = $html->find('rss',0);
		if($rss != null)
		{
			$chan = $rss->find('channel',0);
			if($chan != null)
			{
				$good = true;
			}
		}
		if($good == null){
			errorMessage('Invalid RSS Feed:'.$value);
		}
		$errorvalue = urlencode($value);
		$value = mysql_real_escape_string($errorvalue);
		mysql_query("INSERT INTO panel(userid,rss,posx,posy,sizex,sizey,themeid,minimized) VALUES ('$userid','$value','$posx','$posy','$sizex','$sizey','$themeid','$minimized')");
		$rows = mysql_affected_rows();
		if($rows != -1){
			$count++;
		}

	}
	if($count == 0){
		errorMessage("Those feeds are already on your page or you have not selected a feed.");
	}
	else{
		successMessage('');
	}
}
else if ($action == "delete")
{
	$count = 0;
	foreach ($rss as $feed)
	{
		$feed = mysql_real_escape_string(urlencode($feed));
		$rssCheck = mysql_query("DELETE FROM panel WHERE userid='$userid' AND rss='$feed'");
		$rssCheckTheme = mysql_query("DELETE FROM theme WHERE userid='$userid' AND rss='$feed'");
		$rows = mysql_affected_rows();
		if($rows != 0){
			$count++;
		}
	}
	if($count == 0){
		errorMessage("Those feeds are not in our database.");
	}
	else{
		successMessage('');
	}

}
else if ($action == "edit")
{
	if(count($rss) != 1){
		errorMessage("1 RSS feed must be given.");
	}
	//Get it so it matches the database
	$feed = mysql_real_escape_string(urlencode($rss[0]));
	if(mysql_query("UPDATE panel SET posx='$posx',posy='$posy', sizex='$sizex' , sizey='$sizey' WHERE userid='$userid' AND rss='$feed'")){
		successMessage('');
	}	
	else{
		errorMessage("Failed to Update Panel");

	}
	
}
else if ($action == "get")
{
	$panelTheme = "";
	if (!empty($rss[0]))
	{
		$panelTheme = "AND rss='".urlencode($rss[0])."'";
	}
	$getRSS = mysql_query("SELECT * FROM panel WHERE userid='$userid' $panelTheme");
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
			$getTheme = mysql_query("SELECT * FROM theme WHERE userid='$userid' AND rss='".$row['rss']."'");
			$themeRow = mysql_fetch_assoc($getTheme);
			mysql_free_result($getTheme);
			$rss['themeid']['fontname'] = $themeRow['fontname'];
			$rss['themeid']['fontsize'] = $themeRow['fontsize'];
			$rss['themeid']['fontcolor'] = $themeRow['fontcolor'];
			$rss['themeid']['backcolor'] = $themeRow['backcolor'];
			$rss['themeid']['name'] = $themeRow['name'];
		}
		array_push($rssarr, $rss);
	}
	mysql_free_result($getRSS);
	successMessage(json_encode($rssarr));
	$rows = mysql_fetch_assoc($getRSS);
	mysql_free_result($rssCheck);
	successMessage(print_r($rows,true));
}
else if ($action == "settheme")
{
	if(count($rss) != 1){
		errorMessage("1 RSS feed must be given.");
	}

	$feed = mysql_real_escape_string(urlencode($rss[0]));

	if ($themeid == -1)
	{
		mysql_query("UPDATE panel SET themeid='-1' WHERE userid='$userid' AND rss='$feed'");
		@mysql_query("DELETE FROM theme WHERE userid='$userid' AND rss='$feed'");
		successMessage("reset theme");
	}
	else
	{
		$fontname = mysql_real_escape_string($_POST['fontname']);
		$fontsize = mysql_real_escape_string($_POST['fontsize']);
		$fontcolor = mysql_real_escape_string($_POST['fontcolor']);
		$backcolor = mysql_real_escape_string($_POST['backcolor']);
		$name = mysql_real_escape_string($_POST['name']);
		
		if(!isset($fontname) || empty($fontname)){
			$fontname = "Verdana";
		}
		if(!isset($fontsize) || empty($fontsize)){
			$fontsize = 12;
		}
		if(!isset($fontcolor) || empty($fontcolor)){
			$fontcolor = "#000000";
		}
		if(!isset($backcolor) || empty($backcolor)){
			$backcolor = "#CCCCCC";
		}
		if(!isset($name) || empty($name)){
			$name = "";
		}
		
		mysql_query("UPDATE panel SET themeid='1' WHERE userid='$userid' AND rss='$feed'");
		//if (mysql_affected_rows() == 0)
		//	errorMessage("Failed to update theme for: ".$rss[0]." (Error: 0)");
			
		mysql_query("UPDATE theme SET fontname='$fontname',fontsize='$fontsize',fontcolor='$fontcolor',backcolor='$backcolor',name='$name' WHERE userid='$userid' AND rss='$feed'");
		if (mysql_affected_rows() == 0)
		{
			mysql_query("INSERT INTO theme (userid,rss,fontname,fontsize,fontcolor,backcolor,name) VALUES ('$userid','$feed','$fontname','$fontsize','$fontcolor','$backcolor','$name')");
			if (mysql_affected_rows() == 0)
			{
				errorMessage("Failed to update theme for: ".$rss[0]." (Error: 1)");
			}
			successMessage("inserted new theme");
		}
		successMessage("updated new theme");
	}
}
else
{
	errorMessage("action '".urlencode($action)."' is not valid");
}
?>
