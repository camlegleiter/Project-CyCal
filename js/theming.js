function updateTheme(id) {
	var themedata;
	var feeds = new Array();
	feeds.push($('#panel'+id).attr('rss'));
	
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
				themedata = data;
			}
		},
		dataType: 'json',
		data: {
			action : 'get',
			rss: JSON.stringify(feeds)
		}
	});
	
	themify(id, themedata[0]);
}

function shadeColor(color, shade) {
    var colorInt = parseInt(color.substring(1),16);

    var R = (colorInt & 0xFF0000) >> 16;
    var G = (colorInt & 0x00FF00) >> 8;
    var B = (colorInt & 0x0000FF) >> 0;

    R = R + Math.floor((shade/255)*R);
    G = G + Math.floor((shade/255)*G);
    B = B + Math.floor((shade/255)*B);

    var newColorInt = (R<<16) + (G<<8) + (B);
    var newColorStr = "#"+newColorInt.toString(16);

    return newColorStr;
}


function themify(id, themedata)
{
	//Narrow the window
	themedata = themedata['themeid'];
	var backcolor;
	var fontcolor;
	var fonttype;
	var fontsize;
	if (themedata['type'] == "System")
	{
		backcolor = '#CCCCCC';
		fontcolor = '#000000';
		fonttype = 'Verdana';
		fontsize = '16';
	}
	else
	{
		backcolor = themedata['backcolor'];
		fontcolor = themedata['fontcolor'];
		fonttype = themedata['fontname'];
		fontsize = themedata['fontsize'];
	}
	
	//Apply our css
	//Animate font first
	//$('#panel'+id).css('font-family', fonttype);
	//$('#panel_feed'+id).css('font-family', fonttype);
	//Then the rest
	$('#panel'+id).animate(
		{ 
			//Background color
			'backgroundColor': backcolor,
		}, 
		"slow");
	$('#panel_feed'+id).animate(
		{
			//Background color
			'backgroundColor': backcolor,
			//Text color
			'color': fontcolor,
			//Font stuff
			'font-size': fontsize
		}, 
		"slow");
		
	//Calculate darker backcolor
	var backcolorDark = shadeColor(backcolor, -25);
	
	//Change each article slice
	var articles = $('#panel'+id).attr('articlesLength');
	for (var i = 0; i < articles; i++)
	{
		$('#panel_feed_article'+id+'_'+i).animate(
		{
			//Background color
			'backgroundColor': backcolor
		}, 
		"slow");
		$('#panel_feed_article_title'+id+'_'+i).animate(
		{
			//Background color
			'backgroundColor': backcolor
		}, 
		"slow");
		$('#panel_feed_article_title'+id+'_'+i).hover(
			//Select
			function() {
				$(this).css('backgroundColor',backcolorDark);
			},
			//Unselect
			function() {
				$(this).css('backgroundColor',backcolor);
			}
		);
	}
}










