<?php
require("includes/connect.php");

function adderror($error){
	global $errorarray;
	$errorarray[] = $error;
}

if($_POST['submit']){
	$user = mysql_real_escape_string($_POST['user']);
	$pass = mysql_real_escape_string($_POST['pass']);
	$extract = mysql_query("SELECT * FROM users WHERE username='".$user."' AND password='".md5($pass)."'");
	$numrows = mysql_num_rows($extract);
	if($user != ''){
		if($numrows == 0){
			adderror("Invalid username and/or password.");
		}
		else{
			adderror("You are in!");
		//	session_start();
		//	$row = mysql_fetch_assoc($extract);
		//	$id = $row['id'];
		//	$write = $row['writeable'];
		//	$_SESSION['id']= $id;
	//		if($write){
		//		header("Location: add_delete.php");
	//		}
	//		else
	//      {
		//		header("Location: server_info.php");
	//		}
		}
	}
	else
	{
		adderror("Invalid username and/or password.");
	}
}
else if ($_POST['register']){
	$user = mysql_real_escape_string($_POST['user']);
	$pass = mysql_real_escape_string($_POST['pass']);
	$beta = mysql_real_escape_string($_POST['beta']);
	$extract = mysql_query("SELECT * FROM users WHERE username='".$user."'");
	$numrows = mysql_num_rows($extract);
	if($user != ''){
		if(strlen($user)<4 || strlen($user)>32)
		{
			adderror("Your username must be between 3 and 32 characters!");
		}
		if(preg_match('/[^a-z0-9\-\_\.]+/i',$user))
		{
			adderror("Your username contains invalid characters!");
		}
		if(strlen($pass) < 8)
		{
			adderror("Your password needs to be 8 characters or more!");
		}

		if($numrows != 0){
			adderror("Username already exists.  Try another.");
		}
		
		if($beta != "feedme"){
			adderror("Invalid Beta Key!");
		}
		else{
			$write = mysql_query("INSERT INTO users(username,password,salt) VALUES('".$user."','".md5($pass)."','no')");
	
		if (!$write)
		{
			adderror("We dun goofed! Try again!");
		}
			adderror("You are in!");
		}
	}
	else
	{
		adderror("Please enter a username.");
	}
}
?>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Canvas - CyCal</title>
	
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
	
	<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>	

</head>

<body>
	<div id="Container_Normal">
		<div id="NoContainer">
			<p align="center"><img src="img/Logo2.png" alt="" /></p>
		</div>
	</div>
	<div id="Container_Normal">
		<div id="MainContainer">
			<?php
				foreach($errorarray as $value)
					echo "<p>$value</p>";
			?>
			<h2 align="center">Login</h2>
			<form method='POST'>
				<fieldset>
					<table cellspacing="10px" cellpadding="10px">
						<tr>
							<td>
								<input type='text' id="textbox" name='user' onFocus="if(this.value=='Username')this.value='';" 
									onblur="if(this.value == ''){ this.value = 'Username';}" value="Username">
							</td>
						</tr>
						<tr>
							<td>
								<input type='text' id="textbox" name='pass' onFocus="if(this.value=='Password'){this.value=''};this.type='password';" 
									onblur="if(this.value == ''){ this.value = 'Password';this.type='text'}" value="Password">
							</td>
						</tr>
						
							<tr>
								<td>
									<div id="RegisterDivPass">
										<input type='text' id="textbox" name='pass2' onFocus="if(this.value=='Confirm Password'){this.value=''};this.type='password';" 
											onblur="if(this.value == ''){ this.value = 'Confirm Password';this.type='text'}" value="Confirm Password">
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div id="RegisterDivBeta">
										<input type='text' id="textbox" name='beta' onFocus="if(this.value=='Beta Key')this.value='';" 
											onblur="if(this.value == ''){ this.value = 'Beta Key';}" value="Beta Key">
									</div>
								</td>
							</tr>
							<tr>
								<td align="center">
									<input type='submit' id="submitOnlyButton" name='submit' value='Login'>
									<input type='button' id="registerOnlyButton" name='register' value='RegisterToggle'>	
								</td>
							</tr>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
	<div id="Container_Normal">
		<div id="MainContainer">
			<h2>News / Updates</h2>
			<p>None now!</p>
			<?php
				//Fetch news!
			?>
		</div>
	</div>
	
	<div id="Footer">
		<div id="MainContainer">
			<p><a href="#">Home</a> | <a href="#">About</a> | <a href="#">Help</a></p>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var regShow = false;
			$('#RegisterDivPass').hide();
			$('#RegisterDivBeta').hide();

			$('#registerOnlyButton').click(function(){
				if (regShow)
				{
					$('#RegisterDivBeta').hide('fade',{},500,function(){$('#RegisterDivPass').hide('fade',{},500);});
					regShow = false;
					$('#submitOnlyButton').attr('name','submit');
					$('#cancelOnlyButton').attr('id', 'registerOnlyButton');
				}
				else
				{
					$('#RegisterDivPass').show('fade',{},500,function(){$('#RegisterDivBeta').show('fade',{},500);});
					regShow = true;
					$('#submitOnlyButton').attr('name','register');
					$('#registerOnlyButton').attr('id', 'cancelOnlyButton');

				}
				//location.href='register.php';
			});			
			
		});
	</script>
</body>
</html>