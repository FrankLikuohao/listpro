
<?php
include 'config.php';
//include 'opendb.php';

// ... do something like insert or select, etc

?>


<?php
// This is an example opendb.php
//So now you can open a connection to mysql like this :
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');
mysql_select_db($dbname);
echo "\nselect db [ $dbname ]";
?>


