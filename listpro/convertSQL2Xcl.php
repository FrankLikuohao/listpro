<?php
include 'library/config.php';
include 'library/opendb.php';

//$query  = "SELECT fname, lname FROM students";
$query  = "SELECT `user`, `password` FROM `user`";
$result = mysql_query($query) or die('Error, query failed');

$tsv  = array();
$html = array();
while($row = mysql_fetch_array($result, MYSQL_NUM))
{
   $tsv[]  = implode("\t", $row);
   $html[] = "<tr><td>" .implode("</td><td>", $row) .              "</td></tr>";
}

$tsv = implode("\r\n", $tsv);
$html = "<table>" . implode("\r\n", $html) . "</table>";

$fileName = 'mysql-to-excel.xls';
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$fileName");

//echo $tsv;
echo $html;
mysql_free_result($result);
include 'library/closedb.php';
?>