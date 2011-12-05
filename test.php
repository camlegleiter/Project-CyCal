
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title>Canvas - CyCal</title>
	
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
	<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<?php
		//Must be included inside the Header (at bottom)
		include 'includes/topbar_header.php';
		require "includes/simple_html_dom.php";

	?>

</head>

<body>
	<?php
		//Must be included at the top of the <body> tag
		include 'includes/topbar.php';
		
//		$html = @file_get_contents("http://www.event.iastate.edu/rssgen.php?featured=1");
		
		//		if($html === false)
//			errorMessage('Invalid RSS Feed: '.$value);
		
//		foreach($html->find('content') as $element) 
 //      		echo $element->href . '<br>';
//		if($title != true || $des != true || $link != true){
//			echo"Not valid RSS";
//		}
		$html = file_get_html('http://xkcd.com/rss.xml');
		$good = null;
		$rss = $html->find('rss',0);
		if($rss != null){
			$chan = $html->find('rss',0)->find('channel',0);
			if($chan != null){
			$good = true;
			}
		}
		if($good == null){
			echo"Not valid RSS";
		}
		//->find('channel',0)->find('title', 0)->plaintext;
		
		
	?>
	<p>Content here!</p>

</body>
</html>