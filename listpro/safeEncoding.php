<?php
/**
* ��?�P?�r�Ŷ��}??
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
//�Ĥ@?�r?�P?�q? 
$char = $string{++$i}; 
if((ord($char)&128)==128) 
{ 
//�ĤG?�r?�P?�q? 
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
//�Ĥ@?�r?�P?�q? 
$char = $string{++$i}; 
if((ord($char)&128)==128) 
{ 
// �ĤG?�r?�P?�q? 
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