<?php
define('INCLUDE_CHECK',true);

$TO_ROOT = "";
require 'includes/membersOnly.php';
require 'includes/functions.php';

$deleted = false;

if ($_POST['deleteAcc'])
{
	$userid = $_SESSION['id'];
	mysql_query("DELETE FROM admins WHERE userid='".$userid."'");
	mysql_query("DELETE FROM settings WHERE userid='".$userid."'");
	mysql_query("DELETE FROM panel WHERE userid='".$userid."'");
	mysql_query("DELETE FROM users WHERE userid='".$userid."'");
	
	$deleted = true;
	header( "Refresh: 3; url=index.php" ); 
}

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
<?php
	include 'includes/topbar_header.php';
?>

</head>
<body>
<?php
	//Must be included at the top of the <body> tag
	define("NOCANVAS", true);
	include 'includes/topbar.php';
?>
<div id="Container_Normal">
	<div id="MainContainer">
		<div id="Header_Title">
			<h1>Delete Account</h1>
		</div>
		<p>Are you sure you want to delete your account? <a href="canvas.php">No! Go back</a></p>
		<br>
		<p><strong>All data, including settings, RSS feeds, and account info, will be removed!</strong> 
		You must re-register if you would like to use this site again.</p>
		<?php
			if ($deleted)
			{
				echo "
					<br>
					<br>
					<h1 style='text-align:center'>Your account has been deleted</h1>
					<p style='text-align:center'>Redirecting to main page...please wait.</p>
					<br>
					<br>
					";
			}
			else
			{
				echo "
					<form method='POST'>
						<input type='submit' name='deleteAcc' value='Delete My Account'>
					</form>
					";
			}
		?>
		
	</div>
</div>
</body>
</html>