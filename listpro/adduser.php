<html>
<head>
<title>Add New MySQL User</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
echo "\n into user added";
if(isset($_POST['add']))
{
	echo "\nadded";
include 'library/config.php';
include 'library/opendb.php';

$username = $_POST['username'];
$password = $_POST['password'];
echo "insert username[$username]  passwd [$password]";
$query = "INSERT INTO user (host, user, password, select_priv, insert_priv,`update_ priv`) VALUES ('localhost', '$username', PASSWORD('$password'), 'Y', 'Y', 'Y')";
//mysql_query($query) or die('Error, insert query failed 1');
//$query = "INSERT INTO `user`(`host`, `user`, `password`, `select_priv`, `insert_priv`, `update_ priv`) VALUES ('localhost', '$username', PASSWORD('$password'), 'Y', 'Y', 'Y')";
echo "query=[$query]";
mysql_query($query) or die('Error, insert query failed1');

$query = "FLUSH PRIVILEGES";
mysql_query($query) or die('Error, insert query failed 2');

include 'library/closedb.php';
echo "New MySQL user added";
}
else
{
?>
<form method="post">
<table width="400" border="0" cellspacing="1" cellpadding="2">
<tr> 
<td width="100">Username</td>
<td><input name="username" type="text" id="username"></td>
</tr>
<tr> 
<td width="100">Password</td>
<td><input name="password" type="text" id="password"></td>
</tr>
<tr> 
<td width="100">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr> 
<td width="100">&nbsp;</td>
<td><input name="add" type="submit" id="add" value="Add New User"></td>
</tr>
</table>
</form>
<?php
}
?>
</body>
</html>
<style type="text/css"> .style1 { width: 615px; } .style2 { text-align: right; width: 85px; } </style>