<html>
<head>
<style type="text/css">
table,th,td
{

}
body
{
background-color:#b0c4de;
)
}
.auto-style1 {
	color: #FFFFFF;
}
</style>
</head>

<body style="background-image: url('Images/cool-background_017.jpg')">
<?php
require("includes/connect.php");

?>


<h1 align="center" style="padding:0px; margin:0px;" class="auto-style1">Coming Soon</h1>
<div style="margin-bottom: 3px; padding: 3px;"></div>
<div style="clear:both; height:200px; margin:0px; padding:0px;"></div>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 


<table align="center">
<form method='POST'>
<tr><td><strong><span class="auto-style1">Username:</span></strong></td> 
<td><input type='text' name='user'></td></tr>
<tr><td class="auto-style1"><strong>Password:</strong></td> 
<td><input type='password' name='pass'></td>
</tr>
<tr><td class="auto-style1"><strong>Beta Key:</strong></td>
<td><input type='password' name='beta'></td>
</tr>
<tr>
<td></td><td><input type='submit' name='register' value='Register'></td>
</tr>
</form>
</table>

<?php
if($_POST['register']){
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
//require("footer.tpl");
?>
</body>
</html>