<?php
require("includes/connect.php");

if($_POST['submit']){
	$user = mysql_real_escape_string($_POST['user']);
	$pass = mysql_real_escape_string($_POST['pass']);
	$extract = mysql_query("SELECT * FROM users WHERE username='".$user."' AND password='".md5($pass)."'");
	$numrows = mysql_num_rows($extract);
	if($user != ''){
		if($numrows == 0){
			echo "Access Denied! ".mysql_error();
			echo "  |  SELECT * FROM users WHERE username='".$user."' AND password='".md5($pass)."'";
		}
		else{
			echo"You are In!";
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
}
else if($_POST['register']){
	$user = mysql_real_escape_string($_POST['user']);
	$pass = mysql_real_escape_string($_POST['pass']);
	$beta = mysql_real_escape_string($_POST['beta']);
	$extract = mysql_query("SELECT * FROM users WHERE username='".$user."'");
	$numrows = mysql_num_rows($extract);
	if($user != ''){
		if($numrows != 0){
			echo "User Name Already Registered!!";
		}
		if($beta !="feedme"){
			echo"Wrong beta key!";
		}
		else{
			$write = mysql_query("INSERT INTO users(username,password,salt) VALUES('".$user."','".md5($pass)."','no')");
	
		if (!$write)
		{
			die(mysql_error());
		}
			echo"You are In!";
		}
	}
}
?>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Canvas - CyCal</title>
	
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

</head>

<body>
	<div id="Container_Normal">
		<div id="NoContainer">
			<p align="center"><img src="img/Logo2.png" alt="" /></p>
			<p align="center"><strong>Coming Soon!</strong></p>
		</div>
	</div>
	<div id="spacer">
	</div>
	<div id="Container_Normal">
		<div id="MainContainer">
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
					$('#RegisterDivPass').hide();
					$('#RegisterDivBeta').hide();
					regShow = false;
					$('#submitOnlyButton').attr('value','Login');
				}
				else
				{
					$('#RegisterDivPass').show();
					$('#RegisterDivBeta').show();
					regShow = true;
					$('#submitOnlyButton').attr('value','Register');
				}
				//location.href='register.php';
			});			
			
		});
	</script>
</body>
</html>