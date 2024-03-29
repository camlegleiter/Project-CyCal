window.onunload = function ()
{
    var panels = $('body').find('.panel');
    for (var i = 0; i < panels.length; i++)
    {
        savePosition(i);
    }
};
$('document').ready(function ()
{
    var panelSettings;
    $.ajax(
    {
        type: 'POST',
        url: "./Util/postdata.php",
        async: false,
        statusCode: {
            404: function ()
            {
                alert('Page not found');
            },
            409: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error: ' + errorThrown);
            },
            200: function (data, textStatus, jqXHR)
            {}
        },
        data: {
            action: 'get',
        },
        complete: function (jqXHR, textStatus)
        {
            //adds the panels to the page
            panelSettings = eval('(' + jqXHR.responseText + ')');
        }
    });
    var jsonArticles;
    for (i = 0; i < panelSettings.length; i++)
    {
        $.ajax(
        {
            method: 'POST',
            url: './includes/pipes.php',
            async: false,
            data: {
                q: panelSettings[i].rss
            },
            dataType: "XML",
            statusCode: {
                200: function (xml, status)
                {
                    if (status == "parsererror")
                    {
                    	//look into xml.responseText to get title.
                    	//will have to minipulate string
                    	var title = xml.responseText.substring(xml.responseText.indexOf("<title>")+7,xml.responseText.indexOf("</title>"));
                    	console.log(title);
                    	jsonArticles = {  
							"channel" : [{  
								"title" : [{
									"Text" : title
								}],				
								"item" : [{  
									"title" : [{  
										"Text" : "RSS parse error" 
									}],  
									"description" : [{  
										"Text" : "This RSS feed is invalid" 
									}],  
									"link" : [{  
										"Text" : "#" 
									}]  
								}]				
							}] 
						};		
						populatePanels(i, jsonArticles, panelSettings);
                    }
                    else
                    {
                        jsonArticles = $.xmlToJSON(xml);
                        populatePanels(i, jsonArticles, panelSettings);
                    }
                }
            }
        });
    }
});
//minimizes window

function togglewindow(id)
{
    if ($('#panel' + id).css('min-height') != "0px")
    {
        $('#panel' + id).css('min-height', '0px');
        $('#minimize' + id).removeClass('ui-icon-minusthick');
        $('#minimize' + id).addClass('ui-icon-arrowthick-2-ne-sw');
        $("#panel" + id).resizable(
        {
            disabled: true
        });
        $('#panel_feed' + id).animate(
        {
            opacity: 0
        }, 500, function ()
        {});
        $('#panel' + id).animate(
        {
            opacity: 0.75,
            //left: '+=50',
            height: '30'
        }, 1000, function ()
        {
            // Animation complete.
        });
    }
    else
    {
        $('#panel' + id).css('min-height', '100px');
        $('#panel' + id).css('min-width', '400px');
        $('#minimize' + id).removeClass('ui-icon-arrowthick-2-ne-sw');
        $('#minimize' + id).addClass('ui-icon-minusthick');
        $("#panel" + id).resizable(
        {
            disabled: false
        });
        $('#panel_feed' + id).animate(
        {
            opacity: 1
        }, 1000, function ()
        {});
        $('#panel' + id).animate(
        {
            opacity: 1,
            //left: '+=50',
            height: '400'
        }, 1000, function ()
        {
            // Animation complete.
        });
    }
}
//remove panel

function closewindow(id)
{
    if (confirm("Are you sure you want to remove this feed?"))
    {
        var feed = $('#panel' + id).attr('rss');
        $('#panel' + id).remove();
        $.ajax(
        {
            type: 'POST',
            url: './Util/postdata.php',
            async: false,
            data: {
                action: 'delete',
                rss: "[\"" + feed + "\"]"
            },
            statusCode: {
                200: function (xml, status)
                {},
            }
        });
    }
}
//bounds check after moving a panel

function checkPosition(id)
{
    if (parseInt($('#panel' + id).css('top')) < 40)
    {
        $('#panel' + id).css('top', 40);
    }
}
//THIS IS WHAT FIRST CREATES INDIVIDUAL PANELS

function populatePanels(id, article, myPanelSettings)
{
	console.log(article);
    if (myPanelSettings[id].sizey == null || myPanelSettings[id].sizey == '' || parseInt(myPanelSettings[id].sizey) == 'NaN' || myPanelSettings[id].sizey == '0' || parseInt(myPanelSettings[id].sizey) > 600)
    {
        myPanelSettings[id].sizey = 400;
    }
    if (myPanelSettings[id].sizex == null || myPanelSettings[id].sizex == '' || parseInt(myPanelSettings[id].sizex) == 'NaN' || myPanelSettings[id].sizex == '0' || parseInt(myPanelSettings[id].sizex) > 1000 || parseInt(myPanelSettings[id].sizex) < 400)
    {
        myPanelSettings[id].sizex = 400;
    }
    if (myPanelSettings[id].posy == null || myPanelSettings[id].posy == '' || parseInt(myPanelSettings[id].posy) == 'NaN' || myPanelSettings[id].posy == '0' || parseInt(myPanelSettings[id].posy) < 40)
    {
        myPanelSettings[id].posy = 40;
    }
    if (myPanelSettings[id].posx == null || myPanelSettings[id].posx == '' || parseInt(myPanelSettings[id].posx) == 'NaN' || myPanelSettings[id].posx == '0' || parseInt(myPanelSettings[id].posx) < 0)
    {
        myPanelSettings[id].posx = 10;
    }
    if (id > 0 && myPanelSettings[0].posy == myPanelSettings[id].posy && myPanelSettings[0].posx == myPanelSettings[id].posx)
    {
        myPanelSettings[id].posy = parseInt(myPanelSettings[id - 1].posy) + 10;
        myPanelSettings[id].posx = parseInt(myPanelSettings[id - 1].posx) + 10;
    }
    var overallTitle = article.channel[0].title[0].Text;
    $("#panel" + id).attr('fullTitle', overallTitle);
    if (overallTitle.indexOf("Iowa State University Events -") != -1)
    {
        overallTitle = overallTitle.substring(("Iowa State University Events - ").length, overallTitle.length);
    }
    if (overallTitle.length > 40)
    {
        overallTitle = overallTitle.substring(0, 40) + "...";
    }
    //creates overall containing div for articles
    $('body').append('<div id="panel' + id + '" onmouseup="checkPosition(' + id + ');" onmousedown="changeZIndex(' + id + ');" onmouseout="checkPosition(' + id + ');" class="panel"><div id="panel_title' + id + '" class="panel_title">' + overallTitle + '<table style="float:right; margin-top:2px;"><tr><td id="minimize' + id + '" class="minimize ui-icon-minusthick" onclick="togglewindow(' + id + ');"></td><td id="settings' + id + '" class="settings ui-icon-info" onclick="showSettings(' + article.channel[0].item.length + ',' + id + ');"></td><td id="close' + id + '" class="close ui-icon-closethick" onclick="closewindow(' + id + ');"></td></tr></table></div><div id="panel_feed' + id + '" class="panel_feed"></div></div>');
    $("#panel" + id).draggable(
    {
        handle: $('#panel_title' + id),
        containment: "window"
    });
    
    //need to perform check to adjust title size
    $("#panel" + id).resizable();
    $("#panel" + id).css('z-index', id);
    //interior articles
    if (article.channel[0].item.length > 0)
    {
        for (var i = 0; i < article.channel[0].item.length; i++)
        {
            var title = article.channel[0].item[i].title[0].Text;
            var description = getArticleDescription(article, i);
            if (!description.length)
            {
                description = "No description available.";
            }
            else
            {
                description = description.replace(/\&lt;/g, '<');
                description = description.replace(/\&gt;/g, '>');
            }
            var link = '<br><br><a class="panel_feed_article_link" target="_blank" href="' + article.channel[0].item[i].link[0].Text + '">&raquo;&nbsp;Link to full article</a>'
            $('#panel_feed' + id).append('<div id="panel_feed_article' + id + '_' + i + '" class="panel_feed_article"> <div id="panel_feed_article_title' + id + '_' + i + '" class="panel_feed_article_title" onclick="toggleArticle(' + id + ',' + i + ')">' + title + '<div id="panel_feed_article_title_buttons' + id + '" class="panel_feed_article_title_buttons"><div id="caret' + id + '' + i + '" class="caretDiv ui-icon-carat-1-e"></div></div></div><div style="display:none;" id="panel_feed_article_content' + id + '_' + i + '" class="panel_feed_article_content">' + description + link + '</div></div>');
        }
    }
    else
    {
        $('#panel_feed' + id).append('<div id=\'noArticle\' class=\'panel_feed_no_article\'> No articles </div>');
    }
    $("#panel" + id).css(
    {
        "position": "fixed"
    });
    //setting the width, height, position, etc of the panel
    $("#panel" + id).css(
    {
        "height": myPanelSettings[id].sizey,
        "width": myPanelSettings[id].sizex,
        "z-index": id,
        "top": myPanelSettings[id].posy,
        "left": myPanelSettings[id].posx
    });
    $("#panel" + id).attr('rss', myPanelSettings[id].rss);
    $("#panel" + id).attr('articlesLength', article.channel[0].item.length);
    themify(id, myPanelSettings[id]);
}

function savePosition(id)
{
    $.ajax(
    {
        type: 'POST',
        url: "./util/postdata.php",
        async: false,
        statusCode: {
            404: function ()
            {
                alert('Page not found');
            },
            409: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error: ' + errorThrown);
            },
            200: function (data, textStatus, jqXHR)
            {}
        },
        data: {
            action: 'edit',
            sizey: parseInt($('#panel' + id).css('height')),
            sizex: parseInt($('#panel' + id).css('width')),
            posy: parseInt($('#panel' + id).css('top')),
            posx: parseInt($('#panel' + id).css('left')),
            rss: "[\"" + $("#panel" + id).attr('rss') + "\"]"
        },
        complete: function (jqXHR, textStatus)
        {}
    });
}

function getArticleDescription(article, i)
{
    var articleInfo = article.channel[0].item[i];
    // Check for encoded content first
    if (articleInfo.encoded)
    {
        return articleInfo.encoded[0].Text;
    }
    // Description is default in the RSS object
    if (articleInfo.description)
    {
        return articleInfo.description[0].Text;
    }
}

function toggleArticle(id, i)
{
    $('#panel_feed_article_content' + id + '_' + i).slideToggle("slow");
    if ($('#caret' + id + '' + i).attr('class').indexOf('ui-icon-carat-1-s') != -1)
    {
        $('#caret' + id + '' + i).removeClass('ui-icon-carat-1-s');
        $('#caret' + id + '' + i).addClass('ui-icon-carat-1-e');
    }
    else
    {
        $('#caret' + id + '' + i).removeClass('ui-icon-carat-1-e');
        $('#caret' + id + '' + i).addClass('ui-icon-carat-1-s');
    }
}

function changeZIndex(id)
{
    $(".panel").css("z-index", id);
    $("#panel" + id).css("z-index", "99");
}

function showSettings(articlesLength, id)
{
    // Check if the settings isn't already been added to the panel
    if (!$('#panel_feed' + id + ' > #settings_panel' + id).length)
    {
        $('#panel_feed' + id).append('<div id="settings_panel' + id + '" style="display: none; "></div>');
        $.ajax(
        {
            url: 'feedsettings.php',
            type: 'POST',
            data: {
                rss: $('#panel' + id).attr('rss'),
                panelid: id
            },
            success: function (data)
            {
                $('#settings_panel' + id).html(data);
                $('a#deletefeed').attr('onclick', 'javascript:closewindow(' + id + ');');
            }
        });
    }
    // Show/hide the articles
    for (var i = 0; i < articlesLength; i++)
    {
        $('#panel_feed' + id).children('#panel_feed_article' + id + '_' + i).toggle();
    }
    // Show/hide the settings
    $('#settings_panel' + id).toggle();
}

function applyTheme(i, id, themeObject)
{    
    var titleHex = getCSSValues("rgb(255,0,0)");
    $("#panel" + id).css('background-color', '#FF0000');
    $("#panel_feed" + id).css('background-color', '#FF0000');
    $("#panel_feed_article_title" + id).css('background-color', '#FF0000');
    $("#panel_feed_article_title" + id + '_' + i).hover(function ()
    {
        $("#panel_feed_article_title" + id + '_' + i).css('background-color', '#' + titleHex);
    }, function ()
    {
        $("#panel_feed_article_title" + id + '_' + i).css('background-color', '#FF0000');
    });
    $('.panel_feed_article_title:hover').css('background-color', '#' + titleHex);
    $("#panel_feed_article_content" + id + "_" + i).css('background-color', '#FF0000');
}

function getCSSValues(rgbString)
{
    var rgb = rgbString.substring(4, rgbString.length - 1).split(",");
    rgb[0] = parseInt(rgb[0]) - 25 > 0 ? "" + (parseInt(rgb[0]) - 25).toString(16) + "" : "00";;
    rgb[1] = parseInt(rgb[1]) - 25 > 0 ? "" + (parseInt(rgb[1]) - 25).toString(16) + "" : "00";
    rgb[2] = parseInt(rgb[2]) - 25 > 0 ? "" + (parseInt(rgb[2]) - 25).toString(16) + "" : "00";;
    return rgb[0] + rgb[1] + rgb[2];
}