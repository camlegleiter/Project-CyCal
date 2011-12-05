<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/minicolors/jquery.miniColors.js"></script>
	</head>
	<body>
		<script type="text/javascript">
		function alertX()
		{			
			alert("query submitted");
		}
		</script>
	<?php
		//Must be included at the top of the <body> tag
		include 'includes/topbar.php';
	?>
		<div id="settings">
			<link href="css/reset.css" rel="stylesheet" type="text/css">
			<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
			<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">	
			<style type="text/css">
				input {
					margin: 0px;
				}
			</style>
			<link href="js/minicolors/jquery.miniColors.css" rel="stylesheet" type="text/css">				
				<form method='POST' style="width:350px; text-align:left">
					<div>
						<div>Font Style:
							<select>
								<option>Monaco</option>
								<option>Helvetica</option>
								<option>Comic Sans</option>
							</select>
						</div>
					</div>
					<br>
					<div>Font Size:
						<select>
							<?php for ($i = 8; $i <= 20; $i += 2) { echo '<option>' . $i . '</option>'; } ?>
						</select>
					</div>
					<br>
					<div>Font Color:
						<input class="colors miniColors" type="hidden" size="7" name="fontColor" maxlength="7" autocomplete="off">
						<script type="text/javascript">
							$(".colors").miniColors({
								change: function(hex, rgb) {
									// Do stuff with chosen rgb.r, rgb.g, rgb.b values
									// Test example
									// $('#test').html("RGB = " + rgb.r + ", " + rgb.g + ", " + rgb.b);
								}
							}); 
						</script>
					</div>
					<div>Background Color:
						<input class="colors miniColors" type="hidden" size="7" name="backgroundColor" maxlength="7" autocomplete="off">
						<script type="text/javascript">
							$(".colors").miniColors({
								change: function(hex, rgb) {
									// Do stuff with chosen rgb.r, rgb.g, rgb.b values
									// Test example
									// $('#test').html("RGB = " + rgb.r + ", " + rgb.g + ", " + rgb.b);
								}
							}); 
						</script>
					</div>
					<div>
						<input type="checkbox" class="checkbox">
						Start Minimized
					</div>
					<br>
					<div style="border:1px #000000 dotted; padding:5px">
						<input type="checkbox" class="checkbox">
						Notifications
						<div style="margin-left:20px">
							<div style="margin:5px">
								<input type="checkbox" class="checkbox">
								Email
								<div style="padding-left:20px">
									<input type="text">
								</div>
							</div>
							<div style="margin:5px">
								<input type="checkbox" class="checkbox">
								Text
								<div style="padding-left:20px">
									<input type="text">
								</div>
							</div>
						</div>
					</div>
					<br>
					<a href="#" style="font-size:xx-small;color:red;float:left">DELETE FEED</a>
					<input type="submit" onClick="alertX()" style="float:right">
					<div style="clear:both"></div>
				</form>
			</div>
	</body>
</html>
