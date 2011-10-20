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
		$("#panel1").draggable({handle:$('#panel_title1')}); 
		$("#panel1").resizable();
		
		$('body').append('<div id=\'panel2\' class=\'panel\'><div id=\'panel_title2\' class=\'panel_title\'>  Title Text<div id=\'panel_title_buttons2\' class=\'panel_title_buttons\'><img src=\'img/canvas/Title_Bar_Button_Min.png\' alt=\'_\'><img src=\'img/canvas/Title_Bar_Button_Setting.png\' alt=\'o\'><img src=\'img/canvas/Title_Bar_Button_Close.png\' alt=\'x\' onclick=\'closewindow(2)\'></div></div><div id=\'panel_feed2\' class=\'panel_feed\'></div></div>');
		populatePanel();
		$("#panel2").draggable({handle:$('#panel_title2')}); 
		$("#panel2").resizable();
		$("#panel2").css({"position":"fixed"});
		$("#panel2").css({"top": $("#panel1").position().top, "left": $("#panel1").position().left+525});
	});
	
	function togglewindow(id){
		if($('#panel'+id).css('min-height') != "0px"){
			$('#panel'+id).css('min-height', '0px');
			$('#panel'+id).css('min-width', '0px');
			$("#panel1").resizable({ disabled: true });
			$('#panel_feed'+id).animate({opacity:0},500,function(){});
			$('#panel'+id).animate({
	    					opacity: 0.75,
	    					//left: '+=50',
	   						height: '30',
	   						width: '250'
	 					   }, 1000, function() {
	    					// Animation complete.
	  					   });
		}else{
			$('#panel'+id).css('min-height', '100px');
			$('#panel'+id).css('min-width', '400px');
			$("#panel1").resizable({ disabled: false });
			$('#panel_feed'+id).animate({opacity:1},1000,function(){});
			$('#panel'+id).animate({
	    					opacity: 1,
	    					//left: '+=50',
	   						height: '400',
	   						width: '500'
	 					   }, 1000, function() {
	    					// Animation complete.
	  					   });

		}
	}
	
	function closewindow(id){
		$('#panel'+id).remove();
	}
	
	function populatePanel(){
		$('#panel_feed2').append('<div id=\'panel_feed_article2\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title2\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(2)\'>Performance: Skippyjon Jones<div id=\'panel_feed_article_title_buttons2\' class=\'panel_feed_article_title_buttons\'><div id=\'caret2\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content2\' class=\'panel_feed_article_content\'>Youth Matinee Series Performance:Skippyjon Jones(Grades PreK - 3)Skippyjon Jones is a little kitten with big ears and even bigger dreams!</div></div>');
		$('#panel_feed2').append('<div id=\'panel_feed_article3\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title3\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(3)\'>Chemical and Biological Engineering Graduate Seminar Series<div id=\'panel_feed_article_title_buttons3\' class=\'panel_feed_article_title_buttons\'><div id=\'caret3\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content3\' class=\'panel_feed_article_content\'>Maps, traffic and traffic lights: a cellular perspective" Ganesh Sriram, University of Maryland</div></div>');
		$('#panel_feed2').append('<div id=\'panel_feed_article4\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title4\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(4)\'>Brown Bag Lecture<div id=\'panel_feed_article_title_buttons4\' class=\'panel_feed_article_title_buttons\'><div id=\'caret4\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content4\' class=\'panel_feed_article_content\'>Itching to Share \'Our Iowa\' Pride," Jerry Wiebel, editor, "Our Iowa" magazine.</div></div>');
		$('#panel_feed2').append('<div id=\'panel_feed_article5\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title5\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(5)\'>Open forum: U.S. Food Systems and Global Hunger<div id=\'panel_feed_article_title_buttons5\' class=\'panel_feed_article_title_buttons\'><div id=\'caret5\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content5\' class=\'panel_feed_article_content\'>An open forum discussion on the relationship of U.S. food systems to global hunger led by Michael Hamm, Michigan State University.</div></div>');
		$('#panel_feed2').append('<div id=\'panel_feed_article6\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title6\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(6)\'>Computer science colloquia: Zhengyuan Zhu<div id=\'panel_feed_article_title_buttons6\' class=\'panel_feed_article_title_buttons\'><div id=\'caret6\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content6\' class=\'panel_feed_article_content\'>Zhengyuan Zhu, associate professor of statistics, will present "Spatial Sampling Design and Wireless Networks.</div></div>');
		$('#panel_feed2').append('<div id=\'panel_feed_article7\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title7\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(7)\'>Article Title<div id=\'panel_feed_article_title_buttons7\' class=\'panel_feed_article_title_buttons\'><div id=\'caret7\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content7\' class=\'panel_feed_article_content\'>here is some text inthis content ish thing here</div></div>');
		$('#panel_feed2').append('<div id=\'panel_feed_article8\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title8\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(8)\'>Article Title<div id=\'panel_feed_article_title_buttons8\' class=\'panel_feed_article_title_buttons\'><div id=\'caret8\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content8\' class=\'panel_feed_article_content\'>here is some text inthis content ish thing here</div></div>');
		$('#panel_feed2').append('<div id=\'panel_feed_article9\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title9\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(9)\'>Article Title<div id=\'panel_feed_article_title_buttons9\' class=\'panel_feed_article_title_buttons\'><div id=\'caret9\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content9\' class=\'panel_feed_article_content\'>here is some text inthis content ish thing here</div></div>');
		$('#panel_feed2').append('<div id=\'panel_feed_article10\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title10\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(10)\'>Article Title<div id=\'panel_feed_article_title_buttons10\' class=\'panel_feed_article_title_buttons\'><div id=\'caret10\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content10\' class=\'panel_feed_article_content\'>here is some text inthis content ish thing here</div></div>');
	}
	
	function toggleArticle(id){
		$('#panel_feed_article_content'+id).slideToggle("slow");
		if($('#caret'+id).attr('class').indexOf('ui-icon-carat-1-s') != -1){
			$('#caret'+id).removeClass('ui-icon-carat-1-s');
			$('#caret'+id).addClass('ui-icon-carat-1-e');
		}else{
			$('#caret'+id).removeClass('ui-icon-carat-1-e');
			$('#caret'+id).addClass('ui-icon-carat-1-s');
		}

	}
</script>

</head>

<body> 
	<div id="panel1" class="panel">
		<div id="panel_title1" class="panel_title">
			Title Text
			<table style="float:right; margin-top:2px;">
				<tr>
					<td id="" class="minimize ui-icon-minusthick" onclick="togglewindow(1);"></td>
					<td id="" class="settings ui-icon-info"></td>
					<td id="" class="close ui-icon-closethick" onclick="closewindow(1);"></td>
				</tr>
			</table>
		</div>
		<div id="panel_feed1" class="panel_feed">
			<div id="panel_feed_article1" class="panel_feed_article">
				<div id="panel_feed_article_title1" class="panel_feed_article_title" onclick="toggleArticle(1)">
					Article Title
					<div id="panel_feed_article_title_buttons1" class="panel_feed_article_title_buttons">
						<div id="caret1" class="caretDiv ui-icon-carat-1-s"></div>
					</div>
				</div>
				<div id="panel_feed_article_content1" class="panel_feed_article_content">
					here is some text in this content ish thing here
				</div>
			</div>
		</div>	
	</div> 
</body>
</html>