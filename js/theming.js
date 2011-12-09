function updateTheme(id, rss) {
	var themedata;
	var feeds = new Array();
	feeds.push(rss);
	
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
	//Narrow the window
	themedata = themedata[0]['themeid'];
	var backcolor;
	var fontcolor;
	var fonttype;
	var fontsize;
	if (themedata['type'] == "System")
	{
		backcolor = '#CCCCCC';
		fontcolor = '#000000';
		fonttype = 'Verdana';
		fontsize = '12';
	}
	else
	{
		backcolor = themedata['backcolor'];
		fontcolor = themedata['fontcolor'];
		fonttype = themedata['fontname'];
		fontsize = themedata['fontsize'];
	}
	
	//Apply our css
	$('#panel'+id).animate({ backgroundColor: backcolor }, "slow");
	$('#panel_feed'+id).animate({ backgroundColor: backcolor }, "slow");

}