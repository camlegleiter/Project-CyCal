<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/reset.css" rel="stylesheet" type="text/css">
		<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
		<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/minicolors/jquery.miniColors.js"></script>
		<link href="js/minicolors/jquery.miniColors.css" rel="stylesheet" type="text/css">
		<style type="text/css">
			form{
				-moz-border-radius: 15px;
				border-radius: 15px;
				height: 300px;
			}
			#Header_Title{
				width: 100%;
			}
			input {
				margin: 0px;
			}
			div > div {
				padding: 5px auto;
			}
		</style>
	</head>
	<body>
		<div>
			<div id="MainContainer">
				<div id="Header_Title">
					<h2>Settings</h2>
				</div>
				<form method='POST'>
					<div width="100%">
						<div style="float: left; width: 150px">Font Style:</div>
						<div style="float: left;">
							<select>
								<option>Monaco</option>
								<option>Helvetica</option>
								<option>Comic Sans</option>
							</select>
						</div>
					</div>
					<br>
					<div width="100%">
						<div style="float: left; width: 150px;">Font Size:</div>
						<div style="float: left; width: 100px;">
							<select>
								<?php for ($i = 8; $i <= 20; $i += 2) { echo '<option>' . $i . '</option>'; } ?>
							</select>
						</div>
					</div>
					<br>
					<div width="100%">
						<div style="float: left; width: 150px;">Font Color:</div>
						<div style="float: left; width: 100px;">
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
					</div>
					<div width="100%">
						<div style="float: left; width: 150px;">Background Color:</div>
						<div style="float: left; width: 100px;">
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
					</div>
					<hr width="100%" style="margin: 10px 0px 10px 0px">
					<div width="100%">
						<input type="checkbox" style="float: left; top: 50%;">
						<div style="float: left; top: 50%; width: 200px">Start Minimized</div>
					</div>
					<br>
					<div width="100%">
						<input type="checkbox" style="float: left; top: 50%;">
						<div style="float: left; top: 50%; width: 200px">Notifications</div>
					</div>
					<div style="padding: 10px"></div>
					<div width="100%">
						<div width="50%" style="float: left;">
							<div style="horizontal-align: middle;">
								<input type="checkbox" style="float: left; top: 50%;">
								<div style="float: left; top: 50%; width: 100px">Email</div>
							</div>
							<input type="text">
						</div>
						<div width="50%" style="float: left;">
							<div style="horizontal-align: middle;">
								<input type="checkbox" style="float: left; top: 50%;">
								<div style="float: left; top: 50%; width: 100px">Text</div>
							</div>
							<input type="text">
						</div>
					</div>
					<a href="#">DELETE FEED</a>
					<input type="submit">
				</form>
			</div>
		</div>
	</body>
</html>
