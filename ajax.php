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
				<input type="radio" name="group1" value="New user" checked onclick="query('feedspage.html')"> New user<br>
				<input type="radio" name="group1" value="Panel Settings" onclick="query('feedsettings.php')"> Panel Settings<br>
				<input type="radio" name="group1" value="Add Other Feed" onclick="query('otherfeed.html')"> Add other Feed<br>
				<input type="radio" name="group1" value="Add ISU Feed" onclick="query('isufeed.html')"> Add ISU Feed<br>
				<!-- <input type="button" value="Submit" name="Submit"> -->
			</fieldset>
		</form>
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
				<div id="panel_feed_article">
					<div id="panel_feed_article_title" onclick="toggleArticle()">
						Article Title
						<div id="panel_feed_article_title_buttons">
							&gt;
						</div>
					</div>
					<div id="panel_feed_article_content">
						here is some text in this content ish thing here
					</div>
				</div>
			</div>	
		</div>

		
		<script type="text/javascript">
			function query(page)
			{
				if (page=="")
				{
					document.getElementById("panel_feed").innerHTML="";
					return;
				} 
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}
				else
				{// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("panel_feed").innerHTML=xmlhttp.responseText;
						eval(document.getElementById("panel_feed").innerHTML);
					}
					else
					{
						//document.getElementById("re_bar_content").innerHTML="<p>Loading...</p>";
					}
				}
				xmlhttp.open("GET",page,true);
				xmlhttp.send();
			}		
		</script>
	</body>
</html>