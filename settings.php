<?php
define('INCLUDE_CHECK',true);

$TO_ROOT = "";
require 'includes/membersOnly.php';
require 'includes/functions.php';

if($_POST['savepass'])
{
	$newEmail = mysql_real_escape_string($_POST['newEmail']);
	$newpass = mysql_real_escape_string($_POST['newpass']);
	$confirmpass = mysql_real_escape_string($_POST['confirmpass']);
	$oldpass = mysql_real_escape_string($_POST['oldpass']);
	$result = mysql_query("Select * from users where username ='".$_SESSION['usr']."'");
	$row = mysql_fetch_array($result);
	//$_SESSION['msg']['err'] = "";
	$oldencodedpass = getPassword($row['username'], $oldpass, $row['salt']);
	if (!($newpass == "") && !($confirmpass == "") && !($oldpass == "")) {
		if ($oldencodedpass == $row['password']) {
			
			if ($newpass == $confirmpass) { 
				mysql_query("Update users set password = '".getPassword($row['username'], $newpass, $row['salt'])."' where username = '".$_SESSION['usr']."'");
			} 
			else {
				$_SESSION['msg']['err'] = "New passwords don't match!";
			}
			
			if (!($newEmail == $row['email'])) {
				mysql_query("Update users set email = '".$newEmail."' where username = '".$_SESSION['usr']."'");
			}
		} 
		
		else {
			$_SESSION['msg']['err'] = "Old password doesn't match!"; 
		}
	}

	else {
		$_SESSION['msg']['err'] = "Nothing to update";
	}
}

$result = mysql_query("SELECT * from users where username = '".$_SESSION['usr']."'");
$row = mysql_fetch_array($result);
mysql_free_result($result);

if ($_POST['savecolor'])
{
	$color = mysql_real_escape_string($_POST['colorSelect']);
	//if (strcmp(strtolower($_POST['BackgroundColor']), "color") == 0)
	//{
	mysql_query("UPDATE settings SET background='".$color."' WHERE userid='".$_SESSION['id']."'");
	//}
	//else
	//{
	//
	//}
}

$result2 = mysql_query("SELECT background from settings where userid='".$_SESSION['id']."'");
$backgroundColor = mysql_fetch_array($result2);
$backgroundColor = $backgroundColor['background'];
mysql_free_result($result2);

if (strcmp(strtolower($backgroundColor),"#a3a3a3") == 0)
	$defaultColor = true;
else
	$defaultColor = false;
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CyCal</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
	<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" >
	<script type="text/javascript" src="js/colorpicker.js"></script>
<?php
	include 'includes/topbar_header.php';
?>

</head>
<body>
<?php
	//Must be included at the top of the <body> tag
	define("SETTINGSPAGE", true);
	include 'includes/topbar.php';
?>
<div id="Container_Normal">
	<div id="MainContainer" style="color:#FFFFFF">
		<div id="Header_Title">
		<h1>Settings</h1>
		<?php 
			if(isset($_SESSION['msg']['err']))
			{
				echo '<div class="error"><p>'.$_SESSION['msg']['err'].'</p></div>';
				unset($_SESSION['msg']['err']);
			}

		?>
		</div>
		<form style="float:left"method='POST'>
			<h2>Account</h2>
				<p>Email:</p><input type='text' name='newEmail' value="<?php echo $row['email'] ?>">
				<p>New Password:</p><input type='password' name='newpass'>
				<p>Confirm Password:</p><input type='password' name='confirmpass'>
				<p>Current Password:</p><input type='password' name='oldpass'>
			<center><input class="save" type='submit' name='savepass' value='Save'><br></center>
			<a style="font-size:xx-small;color:red;" href='deleteAcct.php'><strong>Delete Account</strong></a>
		</form>
		<form style="float:right" method='POST' onsubmit="adjustColor()">
			<h2 style="text-align:left">Panel Background</h2>
			<div style="text-align:left">
				<input class="radio" type="radio" name="BackggroundColor" value="Default" id="cbDef" <?php if ($defaultColor) echo 'checked="checked"' ?>>
					<label onclick="$('#cbDef').prop('checked', true)"> Default</label>
					<div id="colorSelectorDef" class="colorSelector" style="margin-left:2em">
						<div style="background-color: #a3a3a3"></div>
					</div>
					<br>
				<input class="radio" type="radio" name="BackggroundColor" value="Color" id="cbColor" <?php if (!$defaultColor) echo 'checked="checked"' ?>>
					<label onclick="$('#cbColor').prop('checked', true)"> Color:</label>
					<div id="colorSelector" class="colorSelector" style="margin-left:2em">
						<?php
							echo '<div style="background-color: '.$backgroundColor.'"></div>';
						?>
					</div>		
					<input id="colorSelect" type="hidden" name="colorSelect" value="#a3a3a3">	
					<br>
				<!--
				<input style="margin-bottom:5px" type="radio" name="group1" value="Image"> Image<br>
				<input style="margin-left:20px" type='text' name='img'><input type="button" value='...'>
				-->
			</div>
			<input class="save" type='submit' name='savecolor' value='Set Background'>
		</form>
		<br style="clear:both">
	</div>
</div>

<script type="text/javascript">
	var color = <?php echo "'".$backgroundColor."'" ?>;
	$('#colorSelector').ColorPicker({
	<?php
		echo "color: '".$backgroundColor."',";
	?>
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			$('#cbColor').prop('checked', true);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelector div').css('backgroundColor', '#' + hex);
			color = "#" + hex;
		}
	});
	
	function adjustColor()
	{
		if ($('#cbColor').attr('checked') == 'checked')
			$('#colorSelect').val(color);
		else
			$('#colorSelect').val("#a3a3a3");
	}
</script>
</body>
</html>