window.onunload = function(){
							var panels = $('body').find('.panel');
							for(var i = 1; i <= panels.length; i++){
								savePosition(i);
							}
				};

$('document').ready(function(){		
		var panelSettings;
		
		$.ajax({
			type: 'POST',	
			url: "./Util/postdata.php",
			async:false,
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
				panelSettings = eval('(' + jqXHR.responseText + ')');
			}
		});

		var jsonArticles;

		for(i = 1; i <= panelSettings.length; i++){
			$.ajax({
				method:'POST',
				url:'./includes/pipes.php',
				async:false,
				data:{
					q: panelSettings[i-1].rss
				},
				statusCode: {
					200: function(xml, status){
						jsonArticles = xml2json.parser(xml);
						populatePanels(i, jsonArticles, panelSettings);
					}
				}
			});
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
	   						height: '30'
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
	   						height: '400'
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
	
	function checkPosition(id){
		if(parseInt($('#panel'+id).css('top')) < 40){
			$('#panel'+id).css('top',40);
		}
	}
	
	//THIS IS WHAT FIRST CREATES INDIVIDUAL PANELS
	function populatePanels(id, article, myPanelSettings){
		if(myPanelSettings[id-1].sizey == null || myPanelSettings[id-1].sizey == '' || 
		   parseInt(myPanelSettings[id-1].sizey) == 'NaN' || myPanelSettings[id-1].sizey == '0'
		   || parseInt(myPanelSettings[id-1].sizey) > 600){
			myPanelSettings[id-1].sizey = 400;
		}
		if(myPanelSettings[id-1].sizex == null || myPanelSettings[id-1].sizex == '' || 
		   parseInt(myPanelSettings[id-1].sizex) == 'NaN' || myPanelSettings[id-1].sizex == '0'
		   || parseInt(myPanelSettings[id-1].sizex) > 1000){
			myPanelSettings[id-1].sizex = 500;
		}
		if(myPanelSettings[id-1].posy == null || myPanelSettings[id-1].posy == '' || 
		   parseInt(myPanelSettings[id-1].posy) == 'NaN' || myPanelSettings[id-1].posy == '0' ||
		   parseInt(myPanelSettings[id-1].posy) < 40){
			myPanelSettings[id-1].posy = 40;
		}
		if(myPanelSettings[id-1].posx == null || myPanelSettings[id-1].posx == '' || 
		   parseInt(myPanelSettings[id-1].posx) == 'NaN' || myPanelSettings[id-1].posx == '0' ||
		   parseInt(myPanelSettings[id-1].posx) < 0){
			myPanelSettings[id-1].posx = 10;
		}
		
		$('body').append('<div id=\'panel'+id+'\' onmouseup=\'checkPosition('+id+');\' onmouseout=\'checkPosition('+id+');\' onmousedown=\'setTopZIndex('+id+')\' class=\'panel\'><div id=\'panel_title'+id+'\' class=\'panel_title\'>'+article.rss.channel.title+'<table style="float:right; margin-top:2px;"><tr><td id="minimize'+id+'" class="minimize ui-icon-minusthick" onclick="togglewindow('+id+');"></td><td id="settings'+id+'" class="settings ui-icon-info"></td><td id="close'+id+'" class="close ui-icon-closethick" onclick="closewindow('+id+');"></td></tr></table></div><div id=\'panel_feed'+id+'\' class=\'panel_feed\'></div></div>');
		$("#panel"+id).draggable({handle:$('#panel_title'+id)}); 
		$("#panel"+id).resizable();
		$("#panel"+id).css('z-index', id);
		for(var i = 0; i < article.rss.channel.item.length; i++){
			var description = article.rss.channel.item[i].description;
			if(!description.length){
				description = "No description available.";
			}
			var link = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="panel_feed_article_link" href='+article.rss.channel.item[i].link+'>link to full article</a>'
			var title = article.rss.channel.item[i].title;
			$('#panel_feed'+id).append('<div id=\'panel_feed_article'+id+'\' class=\'panel_feed_article\'> <div id=\'panel_feed_article_title'+id+'\' class=\'panel_feed_article_title\' onclick=\'toggleArticle('+id+','+i+')\'>'+title+'<div id=\'panel_feed_article_title_buttons'+id+'\' class=\'panel_feed_article_title_buttons\'><div id=\'caret'+id+''+i+'\' class=\'caretDiv ui-icon-carat-1-e\'></div></div></div><div style="display:none;" id=\'panel_feed_article_content'+id+''+i+'\' class=\'panel_feed_article_content\'>'+description+link+'</div></div>');
		}
		
		$("#panel"+id).draggable({handle:$('#panel_title'+id), containment:"window"}); 
		$("#panel"+id).resizable();
		$("#panel"+id).css({"position":"fixed"});
		var lastId = (id-1);
		$("#panel"+id).css({"height":myPanelSettings[id-1].sizey, "width":myPanelSettings[id-1].sizex,
		                    "z-index": id, "top":myPanelSettings[id-1].posy, "left":myPanelSettings[id-1].posx});
		                    
		$("#panel"+id).mousedown(function(id){
			$(".panel").css("z-index", id);
			$("#panel"+id).css("z-index", "99");
		});
	}
	
	function savePosition(id){
		console.log("saving panel: "+$('#panel'+id).css('top'));
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
				}
			},
			data: {
				action : 'edit',
				sizey : parseInt($('#panel'+id).css('height')),
				sizex : parseInt($('#panel'+id).css('width')), 
				posy : parseInt($('#panel'+id).css('top')),
				posx : parseInt($('#panel'+id).css('left')),
				rss : "[\"http://www.event.iastate.edu/rssgen.php?category=14\"]"
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