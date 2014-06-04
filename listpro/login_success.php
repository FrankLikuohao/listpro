<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 


//var_dump(isset($_SESSION["myusername"]));

//if(!session_is_registered(myusername)){
//if($_SESSION['myusername'] == null)
session_start();
if(!isset($_SESSION['myusername'])){
header("location:main_login.php");
}
?>

<html>
<body>
Login Successful
<?php header("location:Listpro.php");?>
</body>
</html>
