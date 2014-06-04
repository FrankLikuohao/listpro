<?php

$host="localhost"; // Host name 
$username="lgh"; // Mysql username 
$password="frank"; // Mysql password 
$db_name="listpro"; // Database name 
$tbl_name="members"; // Table name 


// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
$row=mysql_fetch_assoc($result);
//print_r($row);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
session_start();
//$_SESSION["a1"] = "LOGGED";
// Register $myusername, $mypassword and redirect to file "login_success.php"
//unset($_SESSION["myusername"]);
$_SESSION["myuser_db_id"]=$row[id];
$_SESSION["myusername"]=$row[username];
//unset ($_SESSION["a1"]);
//unset($_SESSION["mypassword"]);
//print_r($_SESSION);
//exit;
//var_dump(isset($_SESSION["myusername"]));

//session_register("myusername");
//$_SESSION["mypassword"]=1;
//session_register("mypassword"); 

header("location:login_success.php");
}
else {
echo "Wrong Username or Password";
header("location:main_login.php");
}
?>
