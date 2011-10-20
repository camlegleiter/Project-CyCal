<?php
session_name('CyCalLogin');
session_start();

if (isset($_POST['chooseFeeds'])) {
	$arr = array();
    if (isset($_POST['featuredEvents'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?featured=1";
	}
    if (isset($_POST['academicCalendar'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=14";
	}	
    if (isset($_POST['arts'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=3";
	}
    if (isset($_POST['athletics'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=8";
	}
    if (isset($_POST['conferences'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=2";
	}
    if (isset($_POST['diversity'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=7";
	}
	
    if (isset($_POST['lectures'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=4";
	}
    if (isset($_POST['liveGreen'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=18";
	}
    if (isset($_POST['meetings'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=15";
	}
    if (isset($_POST['specialEvents'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=16";
	}
    if (isset($_POST['studentActivites'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=9";
	}
    if (isset($_POST['training'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=17";
	}
	//for ($i = 0; $i < 12; $i++) {
	// Now delete every item, but leave the array itself intact:
		foreach ($arr as $i => $value) {
		//if($arr[$i] != 12 && $arr[$i] != NULL) {
			echo $arr[$i] . ", ";
		//}
	}
}



?>
<html>
<head>

<style type="text/css">
	#Check_Container {
		width:100%;
	}
	#Check_List {
		float:left;
		text-align:left;
		width:50%;
	}
	form {
		width:39%;
		text-align:center;
		
		height:100px;
		width:450px;
	}
	#feedSettings {
		height:100px;
		width:450px;
		margin-left:auto;
		margin-right:auto;
	}
</style>
</head>
<body>
<div id="feedSettings">
 	<h1><strong> Welcome, <?php echo $_SESSION['usr']; ?></strong></h1>

 	<br>

 	<p>
Here are some popular Iowa State University RSS feeds you can choose to start viewing right away
	</p>

 	<br>
	
 	<strong>Pick some:</strong>
	
 	<br>
	
 	<form method="post" action="">
 		<div id="Check_Container">
 			<div id="Check_List">
 				 	<input type="checkbox" name="featuredEvents" value="" /> Featured Events	
 				 	<br>
 					<input type="checkbox" name="academicCalendar" value="" /> Academic Calendar 
 					<br>
 					<input type="checkbox" name="arts" value="" /> Arts, performances 
 					<br>
 					<input type="checkbox" name="athletics" value="" /> Athletics 
 					<br>
 					<input type="checkbox" name="conferences" value="" /> Conferences 
 					<br>
 					<input type="checkbox" name="diversity" value="" /> Diversity
 			</div>
 			<div id="Check_List">
 				 	<input type="checkbox" name="lectures" value="" /> Lectures		
 				 	<br>
 					<input type="checkbox" name="liveGreen" value="" /> Live Green 
 				 	<br>
 					<input type="checkbox" name="meetings" value="" /> Meetings, receptions		
 				 	<br>
 					<input type="checkbox" name="specialEvents" value="" /> Special Events 
 				 	<br>
 					<input type="checkbox" name="studentActivites" value="" /> Student activites 
 				 	<br>
 					<input type="checkbox" name="training" value="" /> Training, development 
 			</div>
 			<br style="clear:left;">
 		</div>
 		<input type="submit" name="chooseFeeds" value = "Submit"/>
	</form>
</div>
</body>
</html>
 
 
 
 
 
 
 