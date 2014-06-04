<meta http-equiv="Content-Type" content="text/html; charset=Big5">
<HEAD>    
<html>
	<TITLE> meta 標籤的使用：中文網頁 </TITLE>
	<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=big5">
</HEAD>
<body>
<p>PHP Open and 5 Read text File</p>
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

$mystring = $_POST['Keyword'];$i=0;
print "<BR>Search[$mystring]";

$mystring=iconv("UTF-8","big5",$mystring);
//$mystring='Additional Name';$i=0;
//$mystring=iconv("UTF-8","big5",$mystring);

 //echo "file begin to open3";
 // Use fopen function to open a file
//$file = fopen('D:\temp\DownLoad\google-big5.csv', "r");
$file = fopen('D:\temp\DownLoad\google-d-utf8.csv', "r");
// echo "file open2";
// Read the file line by line until the end
$value = fgets($file);
$iterms = explode(",", $value );
//for($j=0;$j<sizeof($iterms);$j++){
// print"[($j)$iterms[$j]]";}
if($mystring === "") exit;
while (!feof($file)) {
$i++;
$value = fgets($file);$value = rtrim($value);
//$value="Short Name,Maiden Name,Birthday,Gender,Location,Billing Information,Directory";
//chop($value);chop($value);
//echo "$value";
//print "[$i]"; 
//$pos = mb_strpos($value,$mystring);
$iterms = explode(",", $value );
for($j=0;$j<sizeof($iterms);$j++){
 //print"\n[$iterms[$j]]";
$pos = strpos($iterms[$j],$mystring);
if ($pos !== false) {
	//print"find <br> $iterms[$j]";
	echo "<br>";
	for($k=0;$k<sizeof($iterms)-1;$k++)
	{
			$iterms[$k]=iconv("big5","UTF-8",$iterms[$k]);
			echo "$iterms[$k],";
	}
	//$iterms[0]=iconv("big5","UTF-8",$iterms[0]);
	//echo "<BR> $k,
	//Name:$iterms[0] 
	//TEL:$iterms[34]:$iterms[35]$iterms[36]:$iterms[37] $iterms[38]:$iterms[39]:$iterms[40]:$iterms[41]$iterms[42]:$iterms[43] $iterms[44]
	//Addr:$iterms[44]$iterms[45]
	//note:$iterms[25]
	//";
	break;
}
//else{ print"[$j]";}
}
//exit;
 

//Name,Given Name,Additional Name,Family Name,Yomi Name,Given Name Yomi,Additional Name Yomi,Family Name Yomi,Name Prefix,Name Suffix,Initials,Nickname,Short Name,Maiden Name,Birthday,Gender,Location,Billing Information,Directory Server,Mileage,Occupation,Hobby,Sensitivity,Priority,Subject,Notes,Group Membership,E-mail 1 - Type,E-mail 1 - Value,E-mail 2 - Type,E-mail 2 - Value,IM 1 - Type,IM 1 - Service,IM 1 - Value,Phone 1 - Type,Phone 1 - Value,Phone 2 - Type,Phone 2 - Value,Phone 3 - Type,Phone 3 - Value,Phone 4 - Type,Phone 4 - Value,Phone 5 - Type,Phone 5 - Value,Address 1 - Type,Address 1 - Formatted,Address 1 - Street,Address 1 - City,Address 1 - PO Box,Address 1 - Region,Address 1 - Postal Code,Address 1 - Country,Address 1 - Extended Address,Address 2 - Type,Address 2 - Formatted,Address 2 - Street,Address 2 - City,Address 2 - PO Box,Address 2 - Region,Address 2 - Postal Code,Address 2 - Country,Address 2 - Extended Address,Address 3 - Type,Address 3 - Formatted,Address 3 - Street,Address 3 - City,Address 3 - PO Box,Address 3 - Region,Address 3 - Postal Code,Address 3 - Country,Address 3 - Extended Address,Organization 1 - Type,Organization 1 - Name,Organization 1 - Yomi Name,Organization 1 - Title,Organization 1 - Department,Organization 1 - Symbol,Organization 1 - Location,Organization 1 - Job Description,Relation 1 - Type,Relation 1 - Value,Relation 2 - Type,Relation 2 - Value,Website 1 - Type,Website 1 - Value,Website 2 - Type,Website 2 - Value,Website 3 - Type,Website 3 - Value,Event 1 - Type,Event 1 - Value,Custom Field 1 - Type,Custom Field 1 - Value,Jot 1 - Type,Jot 1 - Value
// 0        1           2          3             4               5            6                   7                   8         9        10      11         12           13       14       15      16     17                    18              19        20       21    22          23        24    25    26    27            28            29             30                         31      32                33                        34           35            36                37           38                 39          40             41              42                43             44               45                     46             47                  48                  49                     50                  51                 52                        53                             54               55           56             57                 58                         59               60                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
//for ($i=0; $i<sizeof($iterms); $i++) {
//   print"<br> $i $iterms[0]";
   //}


//print "The name of this line is " .  $iterms[0] . "<br>";

}

// Close the file that no longer in use
fclose($file);
//exit;
?>



</body>
</html>