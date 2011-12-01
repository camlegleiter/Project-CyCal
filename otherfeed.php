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
	
	function validate()
	{
		var $validated = false;
		$.ajax({
			  url: page,
			  cache: false,
			  success: function(html){
			    $("#panel_feed").html(html);
			  },
			  statusCode: {
			    404: function() {
			      alert('Page not found! :/');
			      $validated = false;
			    }
			    409: function(jqXHR, status, error) {
			    	alert('409: ' + error);
			    	$validated = false;
			    }
			    200: function(data) {
			    	alert(data);
			    	$validated = true;
			    }
			  }
			});
		return $validated;
	}
</script>