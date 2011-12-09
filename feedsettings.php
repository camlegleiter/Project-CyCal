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
		$rss['fontsize'] = 16;
	if (!isset($rss['backcolor']) || empty($rss['backcolor']))
		$rss['backcolor'] = "#CCCCCC";
	if (!isset($rss['fontcolor']) || empty($rss['fontcolor']))
		$rss['fontcolor'] = "#000000";
	
?>
<script type="text/javascript">
	var feeds<?php echo $rss['panelid'] ?> = new Array();
	var rss<?php echo $rss['panelid'] ?> = <?php echo "'".$rss['rss']."'" ?>;
	feeds<?php echo $rss['panelid'] ?>.push(rss<?php echo $rss['panelid'] ?>);
	
	var backcolor<?php echo $rss['panelid'] ?> = <?php echo "'".$rss['backcolor']."'" ?>;
	var fontcolor<?php echo $rss['panelid'] ?> = <?php echo "'".$rss['fontcolor']."'" ?>;
	
	function setTheme<?php echo $rss['panelid'] ?>() {
		$.ajax({
			type: 'POST',
			url: './util/postdata.php',
			data: {
				action: 'settheme',
				rss: JSON.stringify(feeds<?php echo $rss['panelid'] ?>),
				themeid: 1, 
				fontname: $('#Ffontstyle_<?php echo $rss['panelid'] ?>').val(),
				fontsize: $('#Ffontsize_<?php echo $rss['panelid'] ?>').val(),
				fontcolor: fontcolor<?php echo $rss['panelid'] ?>,
				backcolor: backcolor<?php echo $rss['panelid'] ?>, 
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
	
	function resetTheme<?php echo $rss['panelid'] ?>() {
		if (confirm('Are you sure you want to reset this panels theme?'))
		{
			$('#Ffontstyle_<?php echo $rss['panelid'] ?>').val("Verdana");
			$('#Ffontsize_<?php echo $rss['panelid'] ?>').val("12");
			fontcolor = "#000000";
			backcolor = "#CCCCCC";
			$('#colorSelectorFont_<?php echo $rss['panelid'] ?>').ColorPickerSetColor(fontcolor);
			$('#colorSelectorFont_<?php echo $rss['panelid'] ?> div').css('background-color', fontcolor);
			$('#colorSelectorBack_<?php echo $rss['panelid'] ?>').ColorPickerSetColor(backcolor);
			$('#colorSelectorBack_<?php echo $rss['panelid'] ?> div').css('background-color', backcolor);
			$.ajax({
				type: 'POST',
				url: './util/postdata.php',
				data: {
					action: 'settheme',
					rss: JSON.stringify(feeds<?php echo $rss['panelid'] ?>),
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
				<select name="fontstyle" id="Ffontstyle_<?php echo $rss['panelid'] ?>">
				<?php
					$fonts = array(
						"Verdana" => "verdana",
						"Monaco" => "monaco",
						"Helvetica" => "helvetica",
						"Segoe UI" => "segoe ui",
						"Courier New" => "courier new",
						"Arial" => "arial",
						"Cambria" => "cambria",
						"Georgia" => "georgia",
						"Times New Roman" => "times new roman",
						"Lucida Sans" => "lucida sans",
						"Impact" => "impact",
						"Tahoma" => "tahoma",
						"Trebuchet MS" => "trebuchet ms",
						"Geneva" => "geneva",
						"Franklin Gothic Medium" => "franklin gothic medium",
					);
					$fontname = strtolower($rss['fontname']);
					foreach ($fonts as $key => $value)
					{
						echo "<option value='".$value."' style='font-family:".$key."'";
						if (strcmp($fontname,strtolower($value)) == 0)
							echo " selected='selected'";
						echo ">".$key."</option>";
					}
				?>
				</select>
			</div>
		</div>
		<br>
		<div>Font Size:
			<select name="fontsize" id="Ffontsize_<?php echo $rss['panelid'] ?>">
				<?php 
					for ($i = 12; $i <= 24; $i += 2) 
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
			<div class="colorSelector" id="colorSelectorFont_<?php echo $rss['panelid'] ?>" style="margin-left:1em;">
				<div style="background-color: <?php echo $rss['fontcolor'] ?>"></div>
			</div>
		</div>
		<div>Background Color:
			<div class="colorSelector" id="colorSelectorBack_<?php echo $rss['panelid'] ?>" style="margin-left:1em;">
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
		<input type="button" onClick="setTheme<?php echo $rss['panelid'] ?>()" class="set" style="float:right;width:100px;margin:10px" value="Set" name="SET">
		<input type="button" onClick="resetTheme<?php echo $rss['panelid'] ?>()" class="reset" style="float:right;width:100px;margin:10px" value="Reset" name="RESET">
		<div style="clear:both"></div>
	</form>
</div>

<script type="text/javascript">
	$('#colorSelectorFont_<?php echo $rss['panelid'] ?>').ColorPicker({
		color: fontcolor<?php echo $rss['panelid'] ?>,
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelectorFont_<?php echo $rss['panelid'] ?> div').css('background-color', '#' + hex);
			fontcolor<?php echo $rss['panelid'] ?> = "#" + hex;
		}
	});
	
	$('#colorSelectorBack_<?php echo $rss['panelid'] ?>').ColorPicker({
		color: backcolor<?php echo $rss['panelid'] ?>,
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelectorBack_<?php echo $rss['panelid'] ?> div').css('background-color', '#' + hex);
			backcolor<?php echo $rss['panelid'] ?> = "#" + hex;
		}
	});
	
</script>
