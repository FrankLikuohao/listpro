<?php
include 'library/config.php';
include 'library/opendb.php';

mysql_select_db($mysql);
$query = "INSERT INTO user (host, user, password, `select_priv`, `insert_priv`, `update_ priv`) VALUES ('localhost', 'lgh', PASSWORD('frank'), 'Y', 'Y', 'Y')";

mysql_query($query) or die('Error, insert query failed');

$query = "FLUSH PRIVILEGES";
mysql_query($query) or die('Error, insert query failed');

include 'library/closedb.php';
?>