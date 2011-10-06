<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>Canvas - CyCal</title>

<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/canvas.css" rel="stylesheet" type="text/css">
<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script type="text/javascript">
	$('document').ready(function(){
		$("#panel").draggable({handle:$('#panel_title')}); 
		$("#panel").resizable();
		//var i;
		/*for(i=0; i<10; i++){
			$('#bodyId').append('<div id="panel'+i+'" class="ui-widget-content"><p id="titlebar'+i+'">Title</p><div id="panelContent'+i+'">Content goes in here</div></div>');
			$('#panel'+i).css('background-color','#00FF00');
			$('#panel'+i).css('width','200px');
			$('#panel'+i).css('height','100px');
			$('#titlebar'+i).css('background-color','#FF0000');
			$('#titlebar'+i).css('width','auto');
			$('#titlebar'+i).css('height','25px');
			$('#panelContent'+i).css('background-color','#FFFFFF');
			$('#panelContent'+i).css('width','auto');
			$('#panelContent'+i).css('height','100%');
			$("#panel"+i).draggable({handle:"p"});
			$("#panel"+i).resizable();
		}*/				
	});
	function closewindow(){
		$('#panel').remove();
	}
	
	function toggleArticle(){
		$('#panel_feed_article_content').slideToggle("slow");
	}
</script>

</head>

<body> 
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
</body>
</html>