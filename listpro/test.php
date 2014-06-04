<?php

// 'library/ListproControlLib.php'
/*$Notes='(<img src=http://192.168.1.101:6001/AdditermData/965_0.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/965_1.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/965_2.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/965_3.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/965_4.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/965_5.jpg width=16 height=12 alt=text />)  ';
print"<br>input notes =[$Notes]";
$imgfinenames=getimgsname($Notes);
echo "<br>imagesname=[";print_r($imgfinenames);
*/
//$Notes="123 3123(<img src=http://192.168.1.101:6001/AdditermData/1055_0_1381072830.jpg width=16 height=12 alt=text />) 452 5(<img src=http://192.168.1.101:6001/AdditermData/1026_1_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_2_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_3_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_4_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_5_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_6_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_7_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_8_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_9_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_10_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_11_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_12_1381029062.jpg width=16 height=12 alt=text />)end";
//$Notes="(<img src=http://192.168.1.101:6001/AdditermData/1055_0_1381072830.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1055_1_1381072830.jpg width=16 height=12 alt=text />)  ";
$Notes='(<img src=http://192.168.1.101:6001/AdditermData/1055_0_1381072830.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1055_1_1381072830.jpg width=16 height=12 alt=text />) http://php.net/manual/zh/function.return.php 123';
imgsrc2ahref($Notes);
function getimgsname($Notes)
{
		$string=explode(' ',$Notes);
		//print_r($string);
		foreach ($string as &$word)
		{
			if(strpos($word,'src=http://192.168.1.101:6001/')!== false ){
			$imgbegin=stristr($word, 'AdditermData/');
			$names[] = $imgbegin;
			//$imgfilename[]=stristr($imgbegin,'',ture);
			//echo "imagebegin=[$imgbegin] delete file[$imgfilename]";
			}
			else{continue;}
		}
		return $names;
};
function imgsrc2ahref($Notes)
{
	$no=0;
	$strarray=splitehtmltag($Notes);
	print_r($strarray);
	foreach ($strarray as &$word)
	{
		if(strpos($word,'src=http://192.168.1.101:6001/')!== false ){
			$no++;
			$imgbegin=stristr($word, 'AdditermData/');
			$names = $imgbegin;
			//<a href=http://192.168.1.101:6001/AdditermData/991_1.jpg>pic1</a>
			$newhref='<a href=http://192.168.1.101:6001/'.$names .'pic' .$no .'</a>';
			$newNotes =$newNotes . $newhref;
		}
		else $newNotes=$newNotes . 	$word;

	}
	echo"<hr>$newNotes";
	return $newNotes;
}

function splitehtmltag($Notes)
{
	$cutflag=0;
	$chararray=str_split($Notes);
	for($i=0;$i<sizeof($chararray);$i++)
	{	$char=$chararray[$i];	
		//echo "[$char]";
		if($chararray[$i] === '<'){
			//$posleft[] = $i;
			$cutstring=$char;
			$resultstrarray[]=$origstring;
			//print "<br>left";print_r($resultstrarray);
			$origstring="";
			$cutflag=1;
			continue;//skip this < to $originstring
		}
		else if($chararray[$i] === '>') {
			//$posright[] = $i;
			$cutflag=0;
			$cutstring=$cutstring . $char;
			//print"<br>tag string=$cutstring";
			$resultstrarray[]=$cutstring;
			//print "<br>right";print_r($resultstrarray);
			$cutstring="";
			continue;//skip this > to $originstring
			//hrefstr=process($cutstring);
			}
			
		if($cutflag === 0){$origstring=$origstring. $char;}
		else{$cutstring=$cutstring . $char;}
	}
	$resultstrarray[]=$origstring;
	//print_r($resultstrarray);
	return $resultstrarray;
//produce string and replace the arrary
	//replace img src  => href=
	//(<img src=http://192.168.1.101:6001/AdditermData/1026_0_1381029062.jpg width=16 height=12 alt=text />)
	//123 3123(<img src=http://192.168.1.101:6001/AdditermData/1026_0_1381029062.jpg width=16 height=12 alt=text />) 452 5(<img src=http://192.168.1.101:6001/AdditermData/1026_1_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_2_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_3_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_4_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_5_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_6_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_7_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_8_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_9_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_10_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_11_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_12_1381029062.jpg width=16 height=12 alt=text />)
	//(<a href=http://192.168.1.101:6001/AdditermData/991_1.jpg>pic1</a>)	
}
?>
 
