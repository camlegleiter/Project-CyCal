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
	//Change each article slice
	var articles = $('#panel'+id).attr('articlesLength');
	
}











