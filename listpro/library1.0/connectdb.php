<?php
$dbhost = 'db.php-mysql-tutorial.com:3306';
$dbuser = 'root';
$dbpass = 'password';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');

$dbname = 'petstore';
mysql_select_db($dbname);
?><?php
$dbhost = 'db.php-mysql-tutorial.com:3306';
$dbuser = 'root';
$dbpass = 'password';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');

$dbname = 'petstore';
mysql_select_db($dbname);
?>