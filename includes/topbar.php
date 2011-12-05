<?php 
if ($_SESSION['id'])
	$loggedin = true;
else
	$loggedin = false;
?>

<div class="tb" id="topContainer">
	<div class="chromestyle" id="chromemenu">
		<div class="tb" id="topLogo"></div>
		<ul>
			<li><a href="help.php">Help</a></li>
			<?php
				if ($loggedin)
				{
					echo '
						<li><a href="#" rel="dropmenu1">Hello, '.$_SESSION['usr'].'</a></li>
						';
				}
				else
				{
					echo '
						<li><a href="index.php">Login</a></li>
						';
				}
			?>
			
		</ul>
	</div>
</div>

<!--1st drop down menu -->                                                   
<span id="dropmenu1" class="dropmenudiv">
<?php
if (defined("SETTINGSPAGE") || defined("NOCANVAS"))
{
	echo '
	<a href="canvas.php">Back to Canvas</a>
	';
}
else if (!defined("ONLYLOGOUT"))
{
	echo '
	<a href="#addISU" onclick="addISUFeed()">Add ISU Feed</a>
	<a href="#addOther" onclick="addOtherFeed()">Add Other Feed</a>
	
	';
}

if (!defined("SETTINGSPAGE"))
{
	echo '
		<a href="settings.php">Account Settings</a>
		';
}
?>
	
	<a href="logout.php">Log Out</a>
</span>

<script type="text/javascript">

	cssdropdown.startchrome("chromemenu")

	function addISUFeed()
	{
		window.location.href = 'newuserchoosefeed.php?new=1';
	}
</script>

