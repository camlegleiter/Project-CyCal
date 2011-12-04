<div class="header">
	<h1>Add Other Feed</h1>
	<div id="buttons">
		<a id="close"><img src="img/buttons/popup_close.png" title="Close" alt="X"></a>
	</div>
</div>
<div class="content">
	<p>Have a blog who's articles you'd like to see on its own panel here? Just add the RSS feed link in the input box below!</p>
	<form method="POST" onsubmit="return validate()">
		<input type="text" id="textbox" name="otherfeed" onFocus="if (this.value == 'RSS Feed') { this.value='';}" 
			onblur="if (this.value == '') { this.value = 'RSS Feed';}" value="RSS Feed">
		<input type="submit" value="Ok">
	</form>
	<p>Or connect with Facebook, Twitter or Google+:</p>
	<div id="connect">
		<center><a href="#">Facebook (Coming Soon)</a></center><br>
		<center><a href="#">Twitter (Coming Soon)</a></center><br>
		<center><a href="#">Google+ (Coming Soon)</a></center>
	</div>
</div>
<script type="text/javascript">
	$('#otherfeed').jqmAddClose($('#otherfeed .header #buttons #close'));
	
	var $validated = false;
	
	function validate()
	{		
		var $text = $('.content form #textbox').val();
		if ($text.toLowerCase() == 'rss feed' ||
			$text.toLowerCase() == '')
		{
			alert('Please specify a URL');
			return false;
		}
		$validated = false;
		var feeds = new Array();
		feeds.push($text);
		
		$.ajax({
			type: 'POST',
			url: './util/postdata.php',
			data: {
				action: 'add',
				rss: JSON.stringify(feeds),
				//print: true
			},
			async:false,
			statusCode: {
				404: function() {
					alert('404: Page not found!');
					$validated = false;
				},
				409: function(jqXHR, status, error) {
					alert('Error: ' + error);
					$validated = false;
				},
				200: function(data) {
					$validated = true;
				}
			}
		});

		return $validated;
	}
</script>
