<?php
	$TO_ROOT = "";
	require "includes/membersOnly.php";

	$rss['rss'] = $_POST['rss'];
	$rss['panelid'] = $_POST['panelid'];
	$userid = $_SESSION['id'];
	
	$getTheme = mysql_query("SELECT * FROM theme WHERE userid='$userid' AND rss='".urlencode($rss['rss'])."'");
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
<script type="text/javascript">
	var feeds = new Array();
	feeds.push(<?php echo "'".$rss['rss']."'" ?>);
	
	var backcolor = <?php echo "'".$rss['backcolor']."'" ?>;
	var fontcolor = <?php echo "'".$rss['fontcolor']."'" ?>;
	
	function setTheme() {
		$.ajax({
			type: 'POST',
			url: './util/postdata.php',
			data: {
				action: 'settheme',
				rss: JSON.stringify(feeds),
				themeid: 1, 
				fontname: $('#Ffontstyle').val(),
				fontsize: $('#Ffontsize').val(),
				fontcolor: fontcolor,
				backcolor: backcolor, 
				//print: true
			},
			async:false,
			statusCode: {
				404: function() {
					alert('404: Page not found!');
				},
				409: function(jqXHR, status, error) {
					alert('Error: ' + error);
				},
				200: function(data) {
					updateTheme(<?php echo $rss['panelid'] ?>);
				}
			}
		});
	}
	
	function resetTheme() {
		if (confirm('Are you sure you want to reset this panels theme?'))
		{
			$('#Ffontstyle').val("Verdana");
			$('#Ffontsize').val("12");
			fontcolor = "#000000";
			backcolor = "#CCCCCC";
			$('#colorSelectorFont').ColorPickerSetColor(fontcolor);
			$('#colorSelectorFont div').css('backgroundColor', fontcolor);
			$('#colorSelectorBack').ColorPickerSetColor(backcolor);
			$('#colorSelectorBack div').css('backgroundColor', backcolor);
			$.ajax({
				type: 'POST',
				url: './util/postdata.php',
				data: {
					action: 'settheme',
					rss: JSON.stringify(feeds),
					themeid: -1 
					//print: true
				},
				async:false,
				statusCode: {
					404: function() {
						alert('404: Page not found!');
					},
					409: function(jqXHR, status, error) {
						alert('Error: ' + error);
					},
					200: function(data) {
						updateTheme(<?php echo $rss['panelid'] ?>);
					}
				}
			});
		}
	}
</script>
<div id="settings">
<style type="text/css">
	input {
		margin: 0px;
	}
</style>			
	<form method='GET' style="width:350px; text-align:left">
		<div>
			<div>Font Style:
				<select name="fontstyle" id="Ffontstyle">
				<?php
					$fontname = strtolower($rss['fontname']);
					echo "<option";
					if (strcmp($fontname,"verdana") == 0)
						echo " selected='selected'";
					echo ">Verdana</option>";
					echo "<option";
					if (strcmp($fontname,"monaco") == 0)
						echo " selected='selected'";
					echo ">Monaco</option>";
					echo "<option";
					if (strcmp($fontname,"helvetica") == 0)
						echo " selected='selected'";
					echo ">Helvetica</option>";
					echo "<option";
					if (strcmp($fontname,"comic sans") == 0)
						echo " selected='selected'";
					echo ">Comic Sans</option>";
				?>
				</select>
			</div>
		</div>
		<br>
		<div>Font Size:
			<select name="fontsize" id="Ffontsize">
				<?php 
					for ($i = 8; $i <= 20; $i += 2) 
					{ 
						echo '<option';
						if ($rss['fontsize'] == $i)
							echo " selected='selected'";
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
		<!--
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
		-->
		<input type="hidden" name="rss" value="<?php echo $rss ?>">
		<a href="#" id="deletefeed" style="font-size:xx-small;color:red;float:left">DELETE FEED</a>
		<input type="button" onClick="setTheme()" class="set" style="float:right;width:100px;margin:10px" value="Set" name="SET">
		<input type="button" onClick="resetTheme()" class="reset" style="float:right;width:100px;margin:10px" value="Reset" name="RESET">
		<div style="clear:both"></div>
	</form>
</div>

<script type="text/javascript">
	$('#colorSelectorFont').ColorPicker({
		color: fontcolor,
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
		color: backcolor,
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
</script>
