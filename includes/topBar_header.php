<?php
	if ($_SESSION['id'])
	{
		$result2 = mysql_query("SELECT background from settings where userid='".$_SESSION['id']."'");
		$cssColor = mysql_fetch_array($result2);
		$cssColor = $cssColor['background'];
		mysql_free_result($result2);
	}
	else
	{
		$cssColor = "#a3a3a3";
	}

?>

<link href="css/topbar.css" rel="stylesheet" type="text/css">
<script src="js/topBar.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('body').animate({ backgroundColor: <?php echo "'".$cssColor."'"; ?> }, "slow");
	});
</script>