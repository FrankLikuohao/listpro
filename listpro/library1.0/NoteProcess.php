<?php
//require "library/Listprolib.php";

function NoteProcess($Notes)
{
	$check=3;  //level  3 2 1 less error   0 no erro
	if(strpos($Notes,'http:') === false)
	{
		$Notes=str_replace('"','\"',$Notes);
		$Notes='"'. $Notes .'"';
		return $Notes;
	}
	
	if ($check >0)print "<hr><strong>NoteProcess($Notes)</strong>";
	$orgNotes=$Notes;
	$Notes=$Notes . ' ';// for using function stristr() if no end of $Notes for cut string   
	
	//default no change;
	//print "Notes=$Notes]";
	// http://cline1413.pixnet.net/blog/post/221458400 ==>
	//<a href=http://cline1413.pixnet.net/blog/post/221458400>name<\a>
	
	$httpstrarray= explode(' ',$Notes);
	$httpstrarray[sizeof($httpstrarray)-1]="reference";//add ' ' at end replace as reference
	if ($check>0) print_r($httpstrarray);
	for ($i=0;$i<sizeof($httpstrarray);$i++){
		$tmpstr=$httpstrarray[$i];
		if(strpos($tmpstr,'http') === false){
			$tmpNotes=$tmpNotes . $tmpstr . ' ';
			continue;
		}
		$nochange=1;
		$orgtmpstr=$tmpstr;
		
		if(strpos($tmpstr,'http://') !== false){
			$httpbefore=stristr($tmpstr, 'http://',true);
			$httpbegin=stristr($tmpstr, 'http://');
			$nochange=0;
			if ($check >0)print "<br>find 1";
		}
		if(strpos($tmpstr,'https://') !== false){
			$httpbefore=stristr($tmpstr, 'https://',true);
			$httpbegin=stristr($tmpstr, 'https://');
			$nochange=0;
			if ($check >0) print "<br>find 2";
		}
		if (strpos($tmpstr,'href=http://')!== false ){
			$nochange=1;//avoid insert " 
			if ($check >0) print "<br>find 3";
		}
		if (strpos($tmpstr,'src=http://')!== false ){
			$nochange=1;//avoid insert " 
			if ($check >0) print "<br>find 4";
		}
		/*
		$httpstr=stristr($httpbegin,' ',true);
		$httplast=stristr($httpbegin, ' ');
		
		$httplast=substr("$httplast", 1);// cut a ' ';
		$httplast=$httplast .' ';//avoid not ' ' after the name str
		$name=stristr($httplast, ' ',true);
		$httplast=stristr($httplast, ' ');
		*/
		 if($nochange==0){
			$tmpstr='<a href=' . $tmpstr . '>' . $httpstrarray[$i+1] . '</a> ';
			$i++;
			}
		 else {$tmpstr=$orgtmpstr;}
		 echo "<br>tmpstr[$i]=[$tmpstr]";
		 $tmpNotes=$tmpNotes . $tmpstr . ' ';//explode reomce
		}	
	
	//if ($name == "") $name="Reference";
	//$name='"'. $name . '"';	
	//if ($check >2) print "<br>httpnote=[$Notes]";
	
    /*if($nochange==0){
		$Notes=$httpbefore . '<a href=' . $httpstr . '>' . $name . '</a> ' . $httplast ;
	}
	else {$Notes=$orgNotes;}//skip href=http:  ,  img src=http:
	*/
	$Notes=$tmpNotes;
	$Notes=str_replace('"','\"',$Notes);
	$Notes='"'. $Notes .'"';
	/*if ($check >1) 
	print "<br>nochange=[$nochange]
		   <br>httpbefore=[$httpbefore]
		   <br>httpbegin=[$httpbegin]
		   <br>httpstr[$httpstr]
		   <br>httplast=[$httplast] 
		   <br>name=[$name]
		   <br>Notes=[$Notes]";
	*/	
	return $Notes;
}
/*
//echo test
$string="normal string";
$result=NoteProcess($string);
echo "<hr>string=$string<br>result=[";print_r($result);
*  
$string1="http://cline1413.pixnet.net/blog/post/221458400"; 
$result=NoteProcess($string1);
echo "<hr>string1=[$string1]<br>result=";print_r($result);

$string2="<a href=http://cline1413.pixnet.net/blog/post/221458400>name"; 
$result=NoteProcess($string2);
echo "<hr>string2=$string2 <br>result=";print_r($result);

$string3="https://mail.google.com/mail/u/0/#inbox/1386c678caf50f6e";
$result=NoteProcess($string3);
echo "<hr>string3=$string3 <br>result=";print_r($result);

$string4= $string1 . ' '. webpage .' ' . $string2 .' '. $string3;
$result=NoteProcess($string4);
echo "<hr>string4=$string4 <br>result=";print_r($result);

$string5='(<img src=http://192.168.1.101:6001/AdditermData/868.jpg width="16" height="12" alt="text" />)';
$result=NoteProcess($string5);
echo "<hr>string5=$string5<br>result=[";print_r($result);
*/
$string6="http://www.youtube.com/watch?v=CQry2CjYoYw m2";
//$string6="(<img src=http://192.168.1.101:6001/AdditermData/9999999_01380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_11380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_21380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_31380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_41380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_51380981226.jpg width=16 height=12 alt=text />)";

$result=NoteProcess($string6);
echo "<hr>string6=$string<br>result=[";print_r($result);
?>
 

