<?php
session_start();
ob_start();
?>
<html>
<head>
<title>Lgh google</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="js/tooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/math.js"></script>
 
 
<link href="LibraryDevelop/ui.datepicker.css" rel="stylesheet" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link  href="css/listpro.css" rel=stylesheet type="text/css">


</head>

<body >
<script>
//alert("My First JavaScript");
</script>
<?php
/*password check*/

if(!isset($_SESSION['myusername'])){
header("location:main_login.php");
}
global $shownumlimit;$shownumlimit=30;
global $showrowbegin;$showrowbegin=0;

$program=$_SERVER[SCRIPT_NAME];//$program=stristr($program,'?',ture);
echo "<br><a href=$program >Back</a></br>";
require_once 'libraryDevelop/Listprolib.php';
$ipfrom=IpFrom();
$initsearchkeyword=0;   
//$useragent_Android=CheckAndroidsystem();
//$useragent_HTC=CheckHTCsystem(); 
  $useragent_Android=1;
  $useragent_HTC=1;
if($useragent_Android ==1)
$filterset=array( 'Checkboxfilter' =>'0' ,
                    'Flagfilter'  =>'2' ,
                     'Textfilter' => '',
                     'Pricefilter'=>'0',
                     'Datefilter' =>'0');//1 today fast
else{
$filterset=array( 'Checkboxfilter' =>'0' ,
                    'Flagfilter'  =>'2' ,
                     'Textfilter' => '',
                     'Pricefilter'=>'0',
                     'Datefilter' =>'0');//0 default
}              
//hi();hi();hi();

/* Program begin   ***/

$showadditerm=1;

require_once 'libraryDevelop/ListproControl.php';

?>

<?php
include 'libraryDevelop/ListproFrontEnd.php';

?>
