

<html> 
<head> 
   <meta http-equiv="Content-Type" content="text/html;charset=big5"> 
   <meta http-equiv="PRAGMA" content="NO-CACHE"> 
   <title>Lgh_html</title> 
</head> 
<body> 
<?php
print "<BR> updatedb";
$dbhost = 'localhost';
$dbuser = 'lgh';
$dbpass = 'frank';
$dbname = 'listpro';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');
mysql_select_db($dbname);

print_r($_POST);
$updateiterms = $_POST['checkiterms'];
//$colors = array(1, 2, 3, 4);
foreach($updateiterms as &$selectid){
	//  print"$selectid";
	  $query="UPDATE `todolist` SET `Checkbox`=1 WHERE  id = $selectid ";

echo "<br>query=[$query]";
mysql_query($query) or die('Error, update select id');

}
mysql_close($conn);
?>
</body> 
</html>
