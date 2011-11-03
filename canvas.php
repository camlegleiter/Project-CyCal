<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>Canvas - CyCal</title>
<?php
	include 'includes/topbar_header.php';
?>
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
		$("#panel1").css('z-index', '1');
		$('#panel_feed1').append('<div id=\'panel_feed_article1\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title1\' class=\'panel_feed_article_title\' onclick=\'toggleArticle(1)\'>Performance: Skippyjon Jones<div id=\'panel_feed_article_title_buttons1\' class=\'panel_feed_article_title_buttons\'><div id=\'caret1\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content1\' class=\'panel_feed_article_content\'>Youth Matinee Series Performance:Skippyjon Jones(Grades PreK - 3)Skippyjon Jones is a little kitten with big ears and even bigger dreams!</div></div>');
		
		for(i = 2; i <= 5; i++){
			populatePanels(i);
		}
	});
	
	function togglewindow(id){
		if($('#panel'+id).css('min-height') != "0px"){
			$('#panel'+id).css('min-height', '0px');
			$('#panel'+id).css('min-width', '0px');
			$('#minimize'+id).removeClass('ui-icon-minusthick');
			$('#minimize'+id).addClass('ui-icon-arrowthick-2-ne-sw');
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
			$('#minimize'+id).removeClass('ui-icon-arrowthick-2-ne-sw');
			$('#minimize'+id).addClass('ui-icon-minusthick');
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
	
	function populatePanels(id){
		$('body').append('<div id=\'panel'+id+'\' onmousedown=\'setTopZIndex('+id+')\' class=\'panel\'><div id=\'panel_title'+id+'\' class=\'panel_title\'>  Title Text<table style="float:right; margin-top:2px;"><tr><td id="minimize'+id+'" class="minimize ui-icon-minusthick" onclick="togglewindow('+id+');"></td><td id="settings'+id+'" class="settings ui-icon-info"></td><td id="close'+id+'" class="close ui-icon-closethick" onclick="closewindow('+id+');"></td></tr></table></div><div id=\'panel_feed'+id+'\' class=\'panel_feed\'></div></div>');
		$("#panel"+id).draggable({handle:$('#panel_title'+id)}); 
		$("#panel"+id).resizable();
		$("#panel"+id).css('z-index', id);
		$('#panel_feed'+id).append('<div id=\'panel_feed_article'+id+'\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title'+id+'\' class=\'panel_feed_article_title\' onclick=\'toggleArticle('+id+')\'>Performance: Skippyjon Jones<div id=\'panel_feed_article_title_buttons'+id+'\' class=\'panel_feed_article_title_buttons\'><div id=\'caret'+id+'\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content'+id+'\' class=\'panel_feed_article_content\'>Youth Matinee Series Performance:Skippyjon Jones(Grades PreK - 3)Skippyjon Jones is a little kitten with big ears and even bigger dreams!</div></div>');
		
		$("#panel"+id).draggable({handle:$('#panel_title'+id)}); 
		$("#panel"+id).resizable();
		$("#panel"+id).css({"position":"fixed"});
		var lastId = (id-1);
		$("#panel"+id).css({"z-index": id, "top": $("#panel1").position().top, "left": $("#panel1").position().left+100});
		$("#panel"+id).mousedown(function(id){
			$(".panel").css("z-index", id);
			$("#panel"+id).css("z-index", "99");
		});
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
	
	function setTopZIndex(id){
			$(".panel").css("z-index", "1");
			$("#panel"+id).css("z-index", "99");
	}
</script>

</head>

<body> 
	<?php
		include 'includes/topbar.php';
	?>

	<div id="panel1" class="panel" onmousedown="setTopZIndex(1)">
		<div id="panel_title1" class="panel_title" >
			Title Text
			<table style="float:right; margin-top:2px;">
				<tr>
					<td id="minimize1" class="minimize ui-icon-minusthick" onclick="togglewindow(1);"></td>
					<td id="settings1" class="settings ui-icon-info"></td>
					<td id="close1" class="close ui-icon-closethick" onclick="closewindow(1);"></td>
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