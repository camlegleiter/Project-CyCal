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
		
		//this will eventually be the get of the rss feeds
		
		var realArticles;
		$.get("Util/postdata.php", function() {
    						
  						})
  						.success(function() { console.log("second success"); })
  						.error(function() { console.log("error"); })
  						.complete(function() { console.log("complete"); 
  		});
				
		//example json object for parsing
		var articles = { "feeds": [{        "url":"www.google.com",
											"title":"this is my overalltitle 1",
											"articles": [{"title": "article1title", "content": "this is my article content for 1", "articleURL": "artURL1"},
        								                 {"title": "article2title", "content": "this is my article content for 2", "articleURL": "artURL2"},
        								                 {"title": "article3title", "content": "this is my article content for 3", "articleURL": "artURL3"}]} ,
        								      
        								  { "url":"www.google.com",
											"title":"this is my overalltitle 2",
        								    "articles": [{"title": "article1title", "content": "this is my article content for 1", "articleURL": "artURL1"},
        								                 {"title": "article2title", "content": "this is my article content for 2", "articleURL": "artURL2"},
        								                 {"title": "article3title", "content": "this is my article content for 3", "articleURL": "artURL3"}]} ,
        								                    
									      { "url":"www.google.com",
											"title":"this is my overalltitle 3",
        								    "articles": [{"title": "article1title", "content": "this is my article content for 1", "articleURL": "artURL1"},
        								                 {"title": "article2title", "content": "this is my article content for 2", "articleURL": "artURL2"},
        								                 {"title": "article3title", "content": "this is my article content for 3", "articleURL": "artURL3"}]} ,
        								                    
        								  { "url":"www.google.com",
											"title":"this is my overalltitle 4",
        								    "articles": [{"title": "article1title", "content": "this is my article content for 1", "articleURL": "artURL1"},
        								                 {"title": "article2title", "content": "this is my article content for 2", "articleURL": "artURL2"},
        								                 {"title": "article3title", "content": "this is my article content for 3", "articleURL": "artURL3"}]} ,
        								     
        								  { "url":"www.google.com",
											"title":"this is my overalltitle 5",
        								    "articles": [{"title": "article1title", "content": "this is my article content for 1", "articleURL": "artURL1"},
        								    			 {"title": "article2title", "content": "this is my article content for 2", "articleURL": "artURL2"},
        								                 {"title": "article3title", "content": "this is my article content for 3", "articleURL": "artURL3"}]} ,
									     ]		       
				      };
		
		//adds the panels to the page
		for(i = 1; i <= 5; i++){
			populatePanels(i, articles);
		}
	});
	
	function togglewindow(id){
		if($('#panel'+id).css('min-height') != "0px"){
			$('#panel'+id).css('min-height', '0px');
			$('#panel'+id).css('min-width', '0px');
			$('#minimize'+id).removeClass('ui-icon-minusthick');
			$('#minimize'+id).addClass('ui-icon-arrowthick-2-ne-sw');
			$("#panel"+id).resizable({ disabled: true });
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
			$("#panel"+id).resizable({ disabled: false });
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
	
	function populatePanels(id, articles){
		$('body').append('<div id=\'panel'+id+'\' onmousedown=\'setTopZIndex('+id+')\' class=\'panel\'><div id=\'panel_title'+id+'\' class=\'panel_title\'>'+articles.feeds[id-1].title+'<table style="float:right; margin-top:2px;"><tr><td id="minimize'+id+'" class="minimize ui-icon-minusthick" onclick="togglewindow('+id+');"></td><td id="settings'+id+'" class="settings ui-icon-info"></td><td id="close'+id+'" class="close ui-icon-closethick" onclick="closewindow('+id+');"></td></tr></table></div><div id=\'panel_feed'+id+'\' class=\'panel_feed\'></div></div>');
		$("#panel"+id).draggable({handle:$('#panel_title'+id)}); 
		$("#panel"+id).resizable();
		$("#panel"+id).css('z-index', id);
		for(var i = 0; i < articles.feeds[id-1].articles.length; i++){
			$('#panel_feed'+id).append('<div id=\'panel_feed_article'+id+'\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title'+id+'\' class=\'panel_feed_article_title\' onclick=\'toggleArticle('+id+','+i+')\'>'+articles.feeds[id-1].articles[i].title+'<div id=\'panel_feed_article_title_buttons'+id+'\' class=\'panel_feed_article_title_buttons\'><div id=\'caret'+id+''+i+'\' class=\'caretDiv ui-icon-carat-1-s\'></div></div></div><div id=\'panel_feed_article_content'+id+''+i+'\' class=\'panel_feed_article_content\'>'+articles.feeds[id-1].articles[i].content+'</div></div>');
		}
		
		$("#panel"+id).draggable({handle:$('#panel_title'+id)}); 
		$("#panel"+id).resizable();
		$("#panel"+id).css({"position":"fixed"});
		var lastId = (id-1);
		$("#panel"+id).css({"z-index": id, "top": $("#panel"+(id == 1 ? 1 : (id-1))).position().top+20, "left": $("#panel"+(id == 1 ? 1 : (id-1))).position().left+100});
		$("#panel"+id).mousedown(function(id){
			$(".panel").css("z-index", id);
			$("#panel"+id).css("z-index", "99");
		});
	}
	
	function toggleArticle(id, i){
		$('#panel_feed_article_content'+id+i).slideToggle("slow");
		if($('#caret'+id+''+i).attr('class').indexOf('ui-icon-carat-1-s') != -1){
			$('#caret'+id+''+i).removeClass('ui-icon-carat-1-s');
			$('#caret'+id+''+i).addClass('ui-icon-carat-1-e');
		}else{
			$('#caret'+id+''+i).removeClass('ui-icon-carat-1-e');
			$('#caret'+id+''+i).addClass('ui-icon-carat-1-s');
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
</body>
</html>