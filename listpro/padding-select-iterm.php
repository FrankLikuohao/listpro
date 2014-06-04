<? php


function opendb()
{// This is an example of config.php
$dbhost = 'localhost';
$dbuser = 'lgh';
$dbpass = 'frank';
$dbname = 'listpro';

// This is an example opendb.php
//So now you can open a connection to mysql like this :
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');
mysql_select_db($dbname);
//echo "<br>select db [ $dbname ]";
return $conn;
}




	$conn=opendb();
		
	 $query = "SELECT * FROM `howaii travelb bak` LIMIT 0, 300 ";
		  //echo "<br>query=[$query]";
		  $result=mysql_query($query) or die('Error, insert query failed 3');
		  $i=0'
		  foreach($result as $row)
		  {
		  	$i++;
		  	print "<br> ";print_r($row);
		  }
		  
		  mysql_close($conn);

?>