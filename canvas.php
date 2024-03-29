<?php

	$TO_ROOT = "";
	require 'includes/membersOnly.php';

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>Canvas - CyCal</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
<link href="css/canvas.css" rel="stylesheet" type="text/css">
<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="css/dialog/jqModal.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" >

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/xml2json.js"></script>
<script type="text/javascript" src="js/xmlObjectifier.js"></script>
<script type="text/javascript" src="js/getjson.js"></script>
<script type="text/javascript" src="js/theming.js"></script>
<script type="text/javascript" src="js/panel_lib.js"></script>
<script type="text/javascript" src="js/dialog/jqModal.js"></script>
<script type="text/javascript" src="js/colorpicker.js"></script>
<?php
	include 'includes/topbar_header.php';
?>

</head>

<body> 
	<?php
		include 'includes/topbar.php';
	?>
	<noscript>
		<br>
		<br>
		<br>
		<p style="text-align:center"><strong>Please enable Javascript! This <em>WHOLE</em> page relies on it!</strong></p>
		<br>
		<br>
		<br>
	</noscript>

	<div class="popup" id="otherfeed" style="display:none">
	</div>	
	
	<div class="popup" id="isufeed" style="display:none">
	</div>	
	
	<script type="text/javascript">
		$('#otherfeed').jqm({ajax:'otherfeed.php'});
		$('#isufeed').jqm({ajax:'newuserchoosefeed.php'});
				
		function addOtherFeed() 
		{
			 $('#otherfeed').jqmShow();
		}
	</script>
</body>
</html>
