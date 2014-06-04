<html>
<head>
<title>Lgh google</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
  
<body>

<?php
/*password check*/
session_start();
if(!isset($_SESSION['myusername'])){
header("location:main_login.php");
}

require_once 'library/Listprolib.php';
$ipfrom=IpFrom();
$initsearchkeyword=0;   
$useragent_Android=CheckAndroidsystem();
$useragent_HTC=CheckHTCsystem();   
if($useragent_HTC ==1)
$filterset=array( 'Checkboxfilter' =>'0' ,
                    'Flagfilter'  =>'2' ,
                     'Textfilter' => '',
                     'Pricefilter'=>'0',
                     'Datefilter' =>'2');//1 today fast
else{
$filterset=array( 'Checkboxfilter' =>'0' ,
                    'Flagfilter'  =>'2' ,
                     'Textfilter' => '',
                     'Pricefilter'=>'0',
                     'Datefilter' =>'0');//0 default
}              
//hi();

/* Program begin   ***/

$showadditerm=1;

require_once 'library/ListproControl.php';

?>

<?php
include 'library/ListproFrontEnd.php';

?>
