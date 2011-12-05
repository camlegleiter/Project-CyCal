<?php
$title = "Help";
if (!isset ($_COOKIE[ini_get('CyCalLogin')])) {
	session_name('CyCalLogin');
	session_start();
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title><?php echo $title; ?></title>
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
	<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<?php
		define("noCustomBG", true);
		include 'includes/topbar_header.php';
	?>

</head>

<body>
<?php
	//Must be included at the top of the <body> tag
	define("NOCANVAS", true);
	include 'includes/topbar.php';
?>
<script type="text/javascript">
	$(function() {
		$('div.helpcontent').hide();
	
	    $("a.topic").toggle(
			function () {
				$("div.helpcontent").hide("fast");
				$(this).next(".helpcontent").show("fast");
				return false;
			},
			function () {
				$(this).next(".helpcontent").hide("fast");
				return false;
			}                      
		);
	});
</script>



<div id="Container_Wide">
	
	<div id="MainContainer">
		
		<h1>Help Topics:</h1>
		(Click on a topic to expand the help content related to that topic)
		<ul>
			<li><h3>Registering and Logging In</h3>
				<ul>
					<li><a class="topic">Signing Up</a>
						<div class="helpcontent">
						To sign up, go to the homepage and click the register button.  
						Now you simply have to enter your email address and decide on a passowrd.
						</div>
					</li>
					<li><a class="topic">Signing In</a>
						<div class="helpcontent">
						Sign in by going to the homepage and enering your email and password.
						</div>
					</li>
				</ul>
			</li>
			<li><h3>User Account Information</h3>
				<ul>
					<li><a class="topic">Editing Your Personal Settings</a>
						<div class="helpcontent">
						If you wish to change information with you account, click on Account Settings in the menu under your name. 
						In this page you will be able to change your email address, password, and the background color for your canvas.  
						</div>
					</li>
				</ul>
			</li>
			<li><h3>Canvas</h3>
				<ul>
					<li><a class="topic">Adding a New Feed</a>
						<div class="helpcontent">
						You can add feeds from a list of popular Iowa State RSS feeds initially when you set up your account, but you can always 
						come back and add more.  This is done by checking the boxes of your desired feeds and hitting submit.  
						You can also click Add Other Feeds from the menu under your name to take your canvas to another level.  
						</div>
					</li>
					<li><a class="topic">Removing an Existing Feed</a>
						<div class="helpcontent">
						You can remove any feed by going to the panel settings for that feed and clicking Delete Feed.
						</div>
					</li>
					<li><a class="topic">Connecting With Friends</a>
						<div class="helpcontent">
							We want to allow our users to share articles and events with their friends with their preferred social networking site.  (coming soon)
							<ul>
								<li><a>Facebook</a>
								Update ALL the statuses!
								</li>
								<li><a>Twitter</a>
								Tweet ALL the updates!
								</li>
								<li><a>Google+</a>
								+1 ALL the Things!
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li><h3>Editing Your Panels</h3>
				<ul>
					<li><a class="topic">Basic Features</a>
						<div class="helpcontent">
						The basic feature of each panel is that you can move it arround the canvas to where ever you like.  
						Each panel also contains many articles from its feed, and it can be closed or colapsed.  
						</div>
					</li>
					<li><a class="topic">Customizing Your Panels</a>
						<ul>
							<li><a class="topic">Changing Colors</a>
								<div class="helpcontent">
								By clicking the settings button on the top of the panel, you have the ability to change the panel color
								and the color of the article's text.  
								</div>
							</li>
							<li><a class="topic">Articles</a>
								<div class="helpcontent">
								If you are scanning over your panels and you find an intriguing article, you can click on an arrow to expand 
								it within the panel.  Also, you can navigate to the original article by clicking on a link folloing the article.  You can 
								also change the font and text size of the text in the article by clicking on the settings button at the top of the 
								panel.  
								</div>
							</li>
							<li><a class="topic">Notifications</a>
								<div>
									<ul>
										<li><a class = topic>Email & SMS</a>
										<div class="helpcontent">
										We want to allow users to set up notications for any particular feed by again clicking on the panel settings button and specifing that 
										you would like to recieve notifications via email or sms text. (coming soon)
										</div>
										</li>
									</ul>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>	
		</ul>
	</div>
</div>
<?php
include ("includes/footer.php");
?>