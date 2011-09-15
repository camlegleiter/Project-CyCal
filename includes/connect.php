<?php

error_reporting(0);

$connect = mysql_connect("localhost", "root", "localpost") or die(mysql_error());//connect to the sql
mysql_select_db("cycal") or die(mysql_error()); //sql database name
echo "<p>Connected!</p>";

?>