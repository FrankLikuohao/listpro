<?php
/**
* 自?判?字符集并??
*/
function safeEncoding($string,$outEncoding ='UTF-8') 
{ 
$encoding = "UTF-8"; 
for($i=0;$i<strlen($string);$i++) 
{ 
if(ord($string{$i})<128) 
continue;

if((ord($string{$i})&224)==224) 
{ 
//第一?字?判?通? 
$char = $string{++$i}; 
if((ord($char)&128)==128) 
{ 
//第二?字?判?通? 
$char = $string{++$i}; 
if((ord($char)&128)==128) 
{ 
$encoding = "UTF-8"; 
break; 
} 
} 
}

if((ord($string{$i})&192)==192) 
{ 
//第一?字?判?通? 
$char = $string{++$i}; 
if((ord($char)&128)==128) 
{ 
// 第二?字?判?通? 
$encoding = "GB2312"; 
break; 
} 
} 
} //by www.jbxue.com

if(strtoupper($encoding) == strtoupper($outEncoding)) 
return $string; 
else 
return iconv($encoding,$outEncoding,$string); 
}
?>