
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
		require "includes/htmlToArray.php";

	?>

</head>

<body>
	<?php
		//Must be included at the top of the <body> tag
		include 'includes/topbar.php';
		
		$html = @file_get_contents("http://xkcd.com/rss.xml");
//		if($html === false)
//			errorMessage('Invalid RSS Feed: '.$value);
		$parsed = new htmlParser($html);
		$arr = $parsed->toArray();
		$title = true;
		$des = false;
		$link = false;
		$ref = $arr[0]['childNodes'];
		for ($i=0; $i < count($ref); $i++)
		{
			if($ref[$i]['tag'] == 'title')
			$title = true;
			echo $title;
			if($ref[$i]['tag'] == 'description')
			$des = true;
			if($ref[$i]['tag'] == 'link')
			$link = true;
		}
		var_dump($ref);
		if($title != true || $des != true || $link != true){
//			errorMessage('Invalid RSS Feed: '.$title);
		}

	?>
	<p>Content here!</p>

</body>
</html>