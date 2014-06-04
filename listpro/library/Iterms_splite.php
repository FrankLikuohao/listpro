<?php
require "library/Listprolib.php";

function Iterms_splite($string)
{
	
	$multi_iterms1=explode("，" ,$string);
	$multi_iterms2=explode("," ,$string);
	if(sizeof($multi_iterms1) > sizeof($multi_iterms) )
		return $multi_iterms1;
	else  return $multi_iterms2;
	
	return $multi_iterms;
}

$string1="tt，1t"; $result=Iterms_splite($string1);
echo "<br>string1=$string1,splite=";print_r($result);

$string2="ttt,ttttt"; $result=Iterms_splite($string2);
echo "<br>string2=$string2,splite=";print_r($result);

$string3="ttt ttttt"; $result=Iterms_splite($string3);
echo "<br>string3=$string2,splite=";print_r($result);

?>
 

