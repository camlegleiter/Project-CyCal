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
	<form method='GET' style="width:350px; text-align:left">
		<div>
			<div>Font Style:
				<select name="fontstyle">
					<option>Monaco</option>
					<option>Helvetica</option>
					<option>Comic Sans</option>
				</select>
			</div>
		</div>
		<br>
		<div>Font Size:
			<select name="fontsize">
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
			<input type="checkbox" class="checkbox" name="minimized">
			Start Minimized
		</div>
		<br>
		<div style="border:1px #000000 dotted; padding:5px">
			<input type="checkbox" class="checkbox" name="notfications">
			Notifications
			<div style="margin-left:20px">
				<div style="margin:5px">
					<input type="checkbox" class="checkbox" name="notifications_email">
					Email
					<div style="padding-left:20px">
						<input type="text">
					</div>
				</div>
				<div style="margin:5px">
					<input type="checkbox" class="checkbox" name="notifications_text">
					Text
					<div style="padding-left:20px">
						<input type="text">
					</div>
				</div>
			</div>
		</div>
		<br>
		<a href="#" style="font-size:xx-small;color:red;float:left">DELETE FEED</a>
		<input type="button" onClick="alertX()" style="float:right;width:100px;margin:10px" value="Set" name="SET">
		<input type="button" onClick="alertX()" style="float:right;width:100px;margin:10px" value="Reset" name="RESET">
		<div style="clear:both"></div>
	</form>
</div>

