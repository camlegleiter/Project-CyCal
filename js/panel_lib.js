$('document').ready(function(){

		//add refresh functionality
		$(window).bind('beforeunload',function(){
			var panels = $('body').find('.panel');
			for(var i = 1; i <= panels.length; i++){
				savePosition(i);
			}
		
			console.log($('body').find('.panel'));
			//savePosition();
		}); 
		//this will eventually be the get of the rss feeds
		
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
		
		$.ajax({
			type: 'POST',	
			url: "./util/postdata.php",
			statusCode: {
				404: function() {
					alert('Page not found');
				},
				409: function(jqXHR, textStatus, errorThrown) {
					alert('Error: ' + errorThrown);
				},
				200: function(data, textStatus, jqXHR) {
					
				}
			},
			data: {
				action : 'get',
			},
			complete: function(jqXHR, textStatus) {
				//adds the panels to the page
				var panelSettings = eval('(' + jqXHR.responseText + ')');
				console.log(panelSettings.length);
				for(i = 1; i <= panelSettings.length; i++){
					populatePanels(i, articles, panelSettings);
				}
			}
		});

		/*extra stuffs to expect*/
		//position
		//size
		//theme
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
	
	function addISUFeed(){
	
	}
	
	function addOtherFeed(){
	
	}
	
	//THIS IS WHAT FIRST CREATES INDIVIDUAL PANELS
	function populatePanels(id, articles, myPanelSettings){			
		if(myPanelSettings[id-1].sizey == null || myPanelSettings[id-1].sizey == '' || 
		   parseInt(myPanelSettings[id-1].sizey) == 'NaN' || myPanelSettings[id-1].sizey == '0'){
			myPanelSettings[id-1].sizey = 400;
		}
		if(myPanelSettings[id-1].sizex == null || myPanelSettings[id-1].sizex == '' || 
		   parseInt(myPanelSettings[id-1].sizex) == 'NaN' || myPanelSettings[id-1].sizex == '0'){
			myPanelSettings[id-1].sizex = 500;
		}
		if(myPanelSettings[id-1].posy == null || myPanelSettings[id-1].posy == '' || 
		   parseInt(myPanelSettings[id-1].posy) == 'NaN' || myPanelSettings[id-1].posy == '0'){
			myPanelSettings[id-1].posy = 60;
		}
		if(myPanelSettings[id-1].posx == null || myPanelSettings[id-1].posx == '' || 
		   parseInt(myPanelSettings[id-1].posx) == 'NaN' || myPanelSettings[id-1].posx == '0'){
			myPanelSettings[id-1].posx = 20;
		}

		$('body').append('<div id=\'panel'+id+'\' onmousedown=\'setTopZIndex('+id+')\' class=\'panel\'><div id=\'panel_title'+id+'\' class=\'panel_title\'>'+myPanelSettings[id-1].rss+'<table style="float:right; margin-top:2px;"><tr><td id="minimize'+id+'" class="minimize ui-icon-minusthick" onclick="togglewindow('+id+');"></td><td id="settings'+id+'" class="settings ui-icon-info"></td><td id="close'+id+'" class="close ui-icon-closethick" onclick="closewindow('+id+');"></td></tr></table></div><div id=\'panel_feed'+id+'\' class=\'panel_feed\'></div></div>');
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
		$("#panel"+id).css({"height":myPanelSettings[id-1].sizey, "width":myPanelSettings[id-1].sizex,
		                    "z-index": id, "top":myPanelSettings[id-1].posy, "left":myPanelSettings[id-1].posx});
		                    
		$("#panel"+id).mousedown(function(id){
			$(".panel").css("z-index", id);
			$("#panel"+id).css("z-index", "99");
		});
		
		console.log(myPanelSettings[id-1].rss);
	}
	
	function savePosition(id){
		$.ajax({
			type: 'POST',	
			url: "./util/postdata.php",
			async:false,
			statusCode: {
				404: function() {
					alert('Page not found');
				},
				409: function(jqXHR, textStatus, errorThrown) {
					alert('Error: ' + errorThrown);
				},
				200: function(data, textStatus, jqXHR) {
					alert(data);
				}
			},
			data: {
				action : 'edit',
				sizey : parseInt($('#panel'+id).css('height')),
				sizex : parseInt($('#panel'+id).css('width')), 
				posy : parseInt($('#panel'+id).css('top')),
				posx : parseInt($('#panel'+id).css('left')),
				rss : "[\"this is where our rss will go\"]"
			},
			complete: function(jqXHR, textStatus) {
			}
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