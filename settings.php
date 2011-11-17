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
	$printout = "";
	$oldencodedpass = getPassword($row['username'], $oldpass, $row['salt']);
	if (!($newpass == "") && !($confirmpass == "") && !($oldpass == "")) {
		if ($oldencodedpass == $row['password']) {
			
			if ($newpass == $confirmpass) { 
				mysql_query("Update users set password = '".getPassword($row['username'], $newpass, $row['salt'])."' where username = '".$_SESSION['usr']."'");
			} 
			else {
				$printout = "New passwords don't match!";
			}
			
			if (!($newEmail == $row['email'])) {
				mysql_query("Update users set email = '".$newEmail."' where username = '".$_SESSION['usr']."'");
			}
		} 
		
		else {
			$printout = "Old password doesn't match!"; 
		}
	}

	else {
		$printout = "Nothing to update";
	}
}

$result = mysql_query("SELECT * from users where username = '".$_SESSION['usr']."'");
$row = mysql_fetch_array($result);
?>
<html>
<head>
<?php
	include 'includes/topbar_header.php';
?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CyCal</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
	<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" >
	<script type="text/javascript" src="js/colorpicker.js"></script>
</head>
<body>
<?php
	//Must be included at the top of the <body> tag
	define("SETTINGSPAGE", true);
	include 'includes/topbar.php';
?>
<div id="Container_Normal">
	<div id="MainContainer">
		<div id="Header_Title">
		<h1>Settings</h1>
		<?php echo "<font color = 'red'>$printout</font>"; ?>
		</div>
		<form style="float:left"method='POST'>
			<h2>Account</h2>
				<p>Email:</p><input type='text' name='newEmail' value = <?php echo $row['email'] ?>>
				<p>New Password:</p><input type='password' name='newpass'>
				<p>Confirm Password:</p><input type='password' name='confirmpass'>
				<p>Current Password:</p><input type='password' name='oldpass'>
			
			<center><input type='submit' name='savepass' value='Save'><br></center>
			<a style="font-size:xx-small;color:red;" href='#'><strong>Delete Account</strong></a>
		</form>
		<form style="float:right" method='POST'>
			<h2 style="text-align:left">Panel Background</h2>
			<div style="text-align:left">
				<input class="radio" type="radio" name="group1" value="Default" id="cbDef" <?php echo 'checked="checked"' ?>>
					<span onclick="$('#cbDef').prop('checked', true)"> Default</span>
					<div style="clear:both"></div>
					<div id="colorSelectorDef" style="margin-left:2em">
						<div style="background-color: #a3a3a3"></div>
					</div>
					<br>
				<input class="radio" type="radio" name="group1" value="Color" id="cbColor">
					<span onclick="$('#cbColor').prop('checked', true)"> Color:</span><br>
					<div id="colorSelector" style="margin-left:2em">
						<div style="background-color: #a3a3a3"></div>
					</div>			
					<br>
				<!--
				<input style="margin-bottom:5px" type="radio" name="group1" value="Image"> Image<br>
				<input style="margin-left:20px" type='text' name='img'><input type="button" value='...'>
				-->
			</div>
			<input type='submit' name='savepass1' value='Set Background'>
		</form>
		<br style="clear:both">
	</div>
</div>

<script type="text/javascript">
	$('#colorSelector').ColorPicker({
		color: '#a3a3a3',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelector div').css('backgroundColor', '#' + hex);
		}
	});
</script>
</body>
</html>