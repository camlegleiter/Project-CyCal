<?php
require("includes/connect.php");

if($_POST['submit']){
	$user = mysql_real_escape_string($_POST['user']);
	$pass = mysql_real_escape_string($_POST['pass']);
	$extract = mysql_query("SELECT * FROM users WHERE username='".$user."' AND password='".md5($pass)."'");
	$numrows = mysql_num_rows($extract);
	if($user != ''){
		if($numrows == 0){
			echo "Wrong Username or Password!";		
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
?>


<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Canvas - CyCal</title>
	
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div id="Container_Normal">
		<div id="NoContainer">
			<p align="center"><img src="img/Logo1.png" alt="" /></p>
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
								<input type='text' id="textbox" name='user' value="Username">
							</td>
						</tr>
						<tr>
							<td>
								<input type='password' id="textbox" name='pass' value="Password">
							</td>
						</tr>
						<tr>
							<td align="center">
								<input type='submit' id="submitOnlyButton" name='submit' value='Login'>
								<input type='button' onclick="location.href='register.php'" id="registerOnlyButton" name='register' value='Register'>
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

</body>
</html>