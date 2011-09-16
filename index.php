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
else if ($_POST['register'])
{
	//Send header redirect
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
		<h1 align="center">CyCal</h1>
		<h1 align="center">Coming Soon</h1>
	</div>
	<div id="Container_Normal">
		<div id="MainContainer">
			<form method='POST'>
				<table align="center">
					<tr>
						<td>
							<strong>Username:</strong>
						</td> 
						<td>
							<input type='text' name='user'>
						</td>
						<td>
							<input type='submit' name='submit' value='Log In'>
						</td>
					</tr>
					<tr>
						<td>
							<strong>Password:</strong>
						</td> 
						<td>
							<input type='password' name='pass'>
						</td>
						<td>
							<input type='submit' name='register' value='Register'>
						</td>
					</tr>
				</table>
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