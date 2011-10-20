<?php
define('INCLUDE_CHECK',true);

require "includes/connect.php";
require 'includes/functions.php';
session_name('CyCalLogin');
session_start();

if($_POST['savepass'])
{
	$newEmail = mysql_real_escape_string($_POST['newEmail']);
	$newpass = mysql_real_escape_string($_POST['newpass']);
	$confirmpass = mysql_real_escape_string($_POST['confirmpass']);
	$oldpass = mysql_real_escape_string($_POST['oldpass']);
	$result = mysql_query("Select * from users where username ='".$_SESSION['usr']."'");
	$row = mysql_fetch_array($result);
	$oldencodedpass = getPassword($row['username'], $oldpass, $row['salt']);
	if ($oldencodedpass == $row['password']) {
		if ($newpass == $confirmpass) { 
			mysql_query("Update users set password = '".getPassword($row['username'], $newpass, $row['salt'])."' where username = '".$_SESSION['usr']."'");
		} 
		if (!($newEmail == $row['email'])) {
			mysql_query("Update users set email = '".$newEmail."' where username = '".$_SESSION['usr']."'");
		}
	} 
}

$result = mysql_query("SELECT * from users where username = '".$_SESSION['usr']."'");
$row = mysql_fetch_array($result);
?>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>CyCal</title>

	<link href="css/reset.css" rel="stylesheet" type="text/css">

	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">

	<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>

	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<style type="text/css">
form{
	background-image: url('../img/WindowBack.png');
	padding: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	width: 250px;
	margin: 10px auto 10px auto;
	text-align: left;
}
#Header_Title{
	width: 100%;
	padding: 10px;
}
input {
	margin: 0px;
}
form p {
	padding:5px 0px 2px 0px;
}
</style>

</head>

<html>



<div id="Container_Normal">
	<div id="MainContainer">
		<div id="Header_Title">
		<h1>Settings</h1>
		</div>
		<form style="float:left"method='POST'>
			<h2>Account</h2>
				<p>Email:</p><input style="width:100%" type='text' name='newEmail' value = <?php echo $row['email'] ?>>
				<p>New Password:</p><input style="width:100%" type='password' name='newpass'>
				<p>Confirm Password:</p><input  style="width:100%"type='password' name='confirmpass'>
				<p>Current Password:</p><input  style="width:100%"type='password' name='oldpass'>
			
			<center><input type='submit' name='savepass' value='Save'><br></center>
			<a style="font-size:xx-small;color:red;" href='#'><strong>Delete Account</strong></a>
		</form>
		<form style="float:right"method='POST'>
			<h2 align="left">Background</h2>
			<input style="margin-bottom:5px" type="radio" name="group1" value="Default"> Default<br>
			<input style="margin-bottom:5px" type="radio" name="group1" value="Color"> Color<br>
			<input style="margin-left:20px" type='text' name='color'><input type="submit" value='...'><br>
			<input style="margin-bottom:5px" type="radio" name="group1" value="Image"> Image<br>
			<input style="margin-left:20px" type='text' name='img'><input type="submit" value='...'>
			<input type='submit' name='savepass1' value='Set Background'>
		</form>
		<br style="clear:both">
	</div>
</div>

</html>