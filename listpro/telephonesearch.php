<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<HEAD>    
<html>
	<TITLE> meta ¼хҪº¨ϥΡG¤¤¤廴­¶ </TITLE>
	<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=big5">
</HEAD>
<body>


<p>PHP Open D:\PHP\TWAMPd\data\google-d-utf8.csvand 6 Read text File</p>
<form method="post">
<table width="400" border="0" cellspacing="1" cellpadding="2">
<tr> 
<td width="100">Keyword</td>
<td><input name="Keyword" type="text" id="Keyword"></td>
</tr>
<tr> 
<td width="100">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr> 
<td width="100">&nbsp;</td>
<td><input name="add" type="submit" id="add" value="Search Submit"></td>
</tr>
</table>

</form>

<?php
session_start();
if(!isset($_SESSION['myusername'])){
header("location:main_login.php");
}
$mystring = $_POST['Keyword'];$i=0;
print "<BR>Search[$mystring]";

//$mystring=iconv("UTF-8","big5",$mystring);
//$mystring='Additional Name';$i=0;
//$mystring=iconv("UTF-8","big5",$mystring);

 //echo "file begin to open3";
 // Use fopen function to open a file
//$file = fopen('D:\temp\DownLoad\google-big5.csv', "r");
$filename='D:\PHP\TWAMPd\data\google-d-utf8.csv';
$file = fopen($filename, "r");
// echo "file open2";
// Read the file line by line until the end
$value = fgets($file);
$iterms = explode(",", $value );
//for($j=0;$j<sizeof($iterms);$j++){
// print"[($j)$iterms[$j]]";}
if($mystring === "") exit;
$index=0;
while (!feof($file) ) {
		$line_of_text[] = fgetcsv($file, 2048,",");		
		$index++;
	}
print "$index records read"; 
$recond_found_num=0;
for($j=0;$j<=$index;$j++)
{
	for($k=0;$k<sizeof($line_of_text[$j]);$k++){
	   $pos = strpos($line_of_text[$j][$k],$mystring);
     if ($pos !== false) {
     	$recond_found_num++;
     	print "<hr>Record $j,";
     	foreach($line_of_text[$j] as &$iterm) 
     		if($iterm !== "")print"[$iterm]";
     		break;
     	}
  }
//print "<br>Record $j,";print_r($line_of_text[$j]);
}
print "<hr>$recond_found_num  records found";
fclose($file);
//exit;
?>



</body>
</html>
