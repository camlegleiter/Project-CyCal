<?php
session_name('CyCalLogin');
session_start();
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
	
 	<form>
 		<div id="Check_Container">
 			<div id="Check_List">
 				 	<input type="checkbox" name="RSS" value="" /> Featured Events	
 				 	<br>
 					<input type="checkbox" name="RSS" value="" /> Academic Calendar 
 					<br>
 					<input type="checkbox" name="RSS" value="" /> Arts, performances 
 					<br>
 					<input type="checkbox" name="RSS" value="" /> Athletics 
 					<br>
 					<input type="checkbox" name="RSS" value="" /> Conferences 
 					<br>
 					<input type="checkbox" name="RSS" value="" /> Diversity
 			</div>
 			<div id="Check_List">
 				 	<input type="checkbox" name="RSS" value="" /> Lectures		
 				 	<br>
 					<input type="checkbox" name="RSS" value="" /> Live Green 
 				 	<br>
 					<input type="checkbox" name="RSS" value="" /> Meetings, receptions		
 				 	<br>
 					<input type="checkbox" name="RSS" value="" /> Special Events 
 				 	<br>
 					<input type="checkbox" name="RSS" value="" /> Student activites 
 				 	<br>
 					<input type="checkbox" name="RSS" value="" /> Training, development 
 			</div>
 			<br style="clear:left;">
 		</div>
 		<button type="button">Do it</button>
	</form>
</div>
</body>
</html>
 
 
 
 
 
 
 