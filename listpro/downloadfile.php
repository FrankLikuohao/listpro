<html> 
<head> 
   <meta http-equiv="Content-Type" content="text/html;charset=big5"> 
   <meta http-equiv="PRAGMA" content="NO-CACHE"> 
   <title>Lgh_html</title> 
</head> 
<body> 
<?php
session_start();
if(!isset($_SESSION['myusername'])){
header("location:main_login.php");
}

if (!empty($_SERVER['HTTP_CLIENT_IP']))
    $ip=$_SERVER['HTTP_CLIENT_IP'];
else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
else
    $ip=$_SERVER['REMOTE_ADDR'];
 
 print "ip from =[$ip]<br>";

$Dir='upload/';
if ($handle = opendir('upload/')) {
   // echo "Directory handle: $handle\n";
    //echo "Entries:\n";

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        //echo "$entry\n";
         $size=(int) (filesize($Dir . $entry)/1024);
        $pos = strpos($ip,'192.168');
        if ($pos === false) {$ip= '1.34.130.91';}
        else {$ip= '192.168.1.101';}
        
        $string= '<a href=http://'. $ip . ':6001/downloadurl.php?f=upload/' . $entry . '>upload/' . $entry .'</a>';
      
        print  "<br>$string ($size kb)";
        //<img src="upload/66-1.jpg" width="16" height="12" alt="text" />
        $picstring='<img src=http://'. $ip . ':6001/' . 'upload/' . $entry .' width="16" height="12" alt="text" />';
        print  "$picstring ";
        
    }

   
    closedir($handle);
}
?>
</body> 
</html>
