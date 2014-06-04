<?php
//print_r($_POST);

  // phpinfo();exit;

session_start();
ob_start();
?>
<html>
<head>
<title>Lgh google</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="libraryDevelop/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/listpropc.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

<script type="text/javascript" src="js/tooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script-->
<script type="text/javascript" src="js/math.js"></script>
</head>
 
 <!--  cursor move to additerm when page is loaded  --> 
<body  
onload="document.getElementById('Iterms').focus()">
<script>
//alert("My First JavaScript");
</script>
<?php
/*password check*/

if(!isset($_SESSION['myusername'])){
header("location:main_login.php");
}
$program=$_SERVER[SCRIPT_NAME];//$program=stristr($program,'?',ture);
echo "<a href=$program >Back</a><br>";
global $shownumlimit;$shownumlimit=30;
global $showrowbegin;$showrowbegin=0;

require_once 'libraryDevelop/Listprolib.php';
include "js/krumo_0.2.1a_PHP5-Only/class.krumo.php";
//krumo(array('a1'=> 'A1', 3, 'red'));

$ipfrom=IpFrom();
$initsearchkeyword=0;   
$useragent_Android=CheckAndroidsystem();
$useragent_HTC=CheckHTCsystem();   
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
//krumo ($filterse);           
//hi();hi();hi();

/* Program begin   ***/

$showadditerm=1;

require_once 'libraryDevelop/ListproControl.php';

?>

<?php
include 'libraryDevelop/ListproFrontEnd.php';

?>
