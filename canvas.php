<html>
<head>

<body style="background-image: url('img/cool-background_017.jpg')">
<?php
require("includes/connect.php");
?>


<h1 align="center" style="padding:0px; margin:0px;" class="auto-style1">Coming Soon</h1>
<div style="margin-bottom: 3px; padding: 3px;"></div>
<div style="clear:both; height:200px; margin:0px; padding:0px;"></div>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
</head>

<?php
?>
<table align="center">
<form method='POST'>
<tr><td><strong><span class="auto-style1">Username:</span></strong></td> 
<td><input type='text' name='user'></td>
<td><input type='submit' name='submit' value='Log In'></td></tr>
<tr><td class="auto-style1"><strong>Password:</strong></td> 
<td><input type='password' name='pass'></td>
<td><input type='submit' name='register' value='Register'></td>
</tr>
</form>
</table>

<?php
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
//		else{
//		header("Location: server_info.php");
//		}
	}
}
}
//require("footer.tpl");
?>
</body>
</html>