<?php

error_reporting(0);

$connect = mysql_connect("localhost", "root", "localpost") or die(mysql_error());//connect to the sql
mysql_select_db("cycal") or die("Error: Could not connect to database! Try again later!"); //sql database name

?>