<?php
if (!isset ($_COOKIE[ini_get('CyCalLogin')])) {
	session_name('CyCalLogin');
	session_start();
}

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title>About</title>
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

<div id="Container_Normal">
	<div id="NoContainer">
		<p align="center"><img src="img/Logo2.png" alt="" /></p>
	</div>
</div>

<div id="Container_Wide">
<h1>General Idea</h1> 
<P>CyCal is a fully customizable event calender for Iowa State University students.  
We are a group of Software and Computer Engineering students at Iowa State, and 
CyCal was a project we decided to attempt for out ComS 319 interfaces class.  
The purpose of the project is to allow students to view and manipulate the many 
campus events in an interactive and customizable setting. </p>
<h1>Developers</h1>
<ul>
	<li>Justin Derby		 - Networking, RSS Research, Facebook</li>
	<li>Michael Kinsella		 - SQL Structure/Layout</li>
	<li>Kurt Kohl			 - Web Development</li>
	<li>Blair Billings		 - Javascript/JQuery</li>
	<li>Jamison Voss		 - Web Development</li>
	<li>Cameron Legleiter	 - Web Designer</li> 
</ul>
<h1>Description</h1>
<p>Project CyCal is a project about the beautification of RSS feeds in general.  
This project primarily focuses on the RSS feeds on the Iowa State University 
calendar of events.  The whole project will rely on the use of a web browser.  
This will implement jQuery and CSS to make it more pleasing to the user.  
We will give them the ability to move, scale, and manage their RSS feeds 
on a ‘desktop’ inside the web browser.  Added integration of Facebook, Twitter,
Google+, and other social media sites will be implemented when the main
functionality are done.  
</p>
<br>
<p>
The targeted user base is anyone who goes to Iowa State University, and we 
will expand to a more general audience when there is more exposure.  This 
includes students, teachers, faculty, and residents of Ames.  You can use 
it to keep up to date with the current events that are happening around you
at the university.  You can also use it to have a place where all your RSS 
feeds can be maintained and easily read/examined. 
</p>
</div>
<?php
include ("includes/footer.php");
?>