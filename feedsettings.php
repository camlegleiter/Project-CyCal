<?php
	$TO_ROOT = "";
	require "includes/membersOnly.php";

	$rss = $_POST['rss'];
	
	$getTheme = mysql_query("SELECT * FROM theme WHERE userid='$userid' AND rss='".$row['rss']."'");
	$themeRow = mysql_fetch_assoc($getTheme);
	mysql_free_result($getTheme);
	$rss['fontname'] = $themeRow['fontname'];
	$rss['fontsize'] = $themeRow['fontsize'];
	$rss['fontcolor'] = $themeRow['fontcolor'];
	$rss['backcolor'] = $themeRow['backcolor'];
	$rss['name'] = $themeRow['name'];
	
	if (!isset($rss['fontname']) || empty($rss['fontname']))
		$rss['fontname'] = "Verdana";
	if (!isset($rss['fontsize']) || empty($rss['fontsize']))
		$rss['fontsize'] = 12;
	if (!isset($rss['backcolor']) || empty($rss['backcolor']))
		$rss['backcolor'] = "#CCCCCC";
	if (!isset($rss['fontcolor']) || empty($rss['fontcolor']))
		$rss['fontcolor'] = "#000000";
	
?>
<div id="settings">
<style type="text/css">
	input {
		margin: 0px;
	}
</style>			
	<form method='GET' style="width:350px; text-align:left">
		<div>
			<div>Font Style:
				<select name="fontstyle">
				<?php
					$fontname = strtolower($rss['fontname']);
					echo "<option";
					if (strcmp($fontname,"verdana") == 0)
						echo "selected='selected'";
					echo ">Verdana</option>";
					echo "<option";
					if (strcmp($fontname,"monaco") == 0)
						echo "selected='selected'";
					echo ">Monaco</option>";
					echo "<option";
					if (strcmp($fontname,"helvetica") == 0)
						echo "selected='selected'";
					echo ">Helvetica</option>";
					echo "<option";
					if (strcmp($fontname,"comic sans") == 0)
						echo "selected='selected'";
					echo ">Comic Sans</option>";
				?>
				</select>
			</div>
		</div>
		<br>
		<div>Font Size:
			<select name="fontsize">
				<?php 
					for ($i = 8; $i <= 20; $i += 2) 
					{ 
						echo '<option';
						if ($rss['fontsize'] == $i)
							echo "selected='selected'";
						echo '>' . $i . '</option>'; 
					} 
				?>
			</select>
		</div>
		<br>
		<div>Font Color:
			<div class="colorSelector" id="colorSelectorFont" style="margin-left:1em;">
				<div style="background-color: <?php echo $rss['fontcolor'] ?>"></div>
			</div>
		</div>
		<div>Background Color:
			<div class="colorSelector" id="colorSelectorBack" style="margin-left:1em;">
				<div style="background-color: <?php echo $rss['backcolor'] ?>"></div>
			</div>
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
		<input type="hidden" name="rss" value="<?php echo $rss ?>">
		<a href="#" id="deletefeed" style="font-size:xx-small;color:red;float:left">DELETE FEED</a>
		<input type="button" onClick="submit()" style="float:right;width:100px;margin:10px" value="Set" name="SET">
		<input type="button" onClick="reset()" style="float:right;width:100px;margin:10px" value="Reset" name="RESET">
		<div style="clear:both"></div>
	</form>
</div>

<script type="text/javascript">
	var backcolor = <?php echo "'".$rss['backcolor']."'" ?>;
	var fontcolor = <?php echo "'".$rss['fontcolor']."'" ?>;
	
	$('#colorSelectorFont').ColorPicker({
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelectorFont div').css('backgroundColor', '#' + hex);
			fontcolor = "#" + hex;
		}
	});
	
	$('#colorSelectorBack').ColorPicker({
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
			$('#colorSelectorBack div').css('backgroundColor', '#' + hex);
			backcolor = "#" + hex;
		}
	});

	function submit() {
		alert('reseting');
	}
	
	function reset() {
		alert('submitting');
	}
</script>
