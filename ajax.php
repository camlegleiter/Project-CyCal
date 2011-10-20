<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
		<title>Ajax Tester</title>
		<link href="css/reset.css" rel="stylesheet" type="text/css">
		<link href="css/canvas.css" rel="stylesheet" type="text/css">
		<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	</head>
	<body>
		<h2>Ajax Test</h2>
		<form method='POST' style="text-align:left">
			<fieldset>
				<input type="radio" name="group1" value="New user" checked onclick="query('newuserchoosefeed.php')"> New user<br>
				<input type="radio" name="group1" value="Panel Settings" onclick="query('feedsettings.php')"> Panel Settings<br>
				<input type="radio" name="group1" value="Add Other Feed" onclick="query('otherfeed.html')"> Add other Feed<br>
				<input type="radio" name="group1" value="Add ISU Feed" onclick="query('isufeed.html')"> Add ISU Feed<br>
				<!-- <input type="button" value="Submit" name="Submit"> -->
			</fieldset>
		</form>
		<div style="width:50%; margin:auto; border:medium black solid">
			<div id="panel">
				<div id="panel_title">
				Title Text
					<div id="panel_title_buttons">
						<img src="img/canvas/Title_Bar_Button_Min.png" alt="_">
						<img src="img/canvas/Title_Bar_Button_Setting.png" alt="o">
						<img src="img/canvas/Title_Bar_Button_Close.png" alt="x" onclick="closewindow()">
					</div>
				</div>
				<div id="panel_feed">
					<!-- Ajax here -->
				</div>	
			</div>
		</div>

		
		<script type="text/javascript">
			function query(page)
			{
				$.ajax({
				  url: page,
				  cache: false,
				  success: function(html){
				    $("#panel_feed").html(html);
				  },
				  statusCode: {
				    404: function() {
				      $("#panel_feed").html("<p>Error loading page: </p><p>" + page + "</p>");
				    }
				  }
				});
	
			
				$('#panel').resizable();
			}
		</script>
	</body>
</html>