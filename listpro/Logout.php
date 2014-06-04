
<?php 
session_start();
//session_destroy();
unset($_SESSION["myusername"]);
unset($_SESSION["myuser_db_id"]);
print "Thank you, See you.";
print "Logout";
header("location:main_login.php");
?>
