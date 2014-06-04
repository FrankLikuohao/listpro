<?php
function hi()
{
	echo "<strong>Hollo World</strong>";
}
//session_start(); 
/** 
     * 检查表单是否被重复提交 
     * 相同内容的表单在设定时间内只能提交1次 
     * @param int $iTimeOffset 
     * @return bool 
     */ 
function checkFormSubmit($iTimeOffset=60){ 
    // 取得表单的标识 
    $idForm = md5(serialize($_POST)); 
    // 是否需要表单提交检察 
    $iFormCheck = true; 
    if (isset($_SESSION['formSubmitCheck'])){ 
        // 删除过期的表单标识 
        foreach (array_keys($_SESSION['formSubmitCheck']) as $val){ 
            if (time() > $val){ 
                unset($_SESSION['formSubmitCheck'][$val]); 
            } 
        } 
    }else { 
        $_SESSION['formSubmitCheck'] = array(); 
        $iFormCheck = false; 
    } 
    if ($iFormCheck == true){ 
        // 检查是否有重复标识的提交记录 
        foreach ($_SESSION['formSubmitCheck'] as $val){ 
            if ($val == $idForm){ 
                return false; 
            } 
        } 
    } 
    // 保存表单标识 
    $_SESSION['formSubmitCheck'][(time()+$iTimeOffset)] = $idForm; 
    return true; 
} 
function checkBOM ($filename) {
	//print "<br>in checkBOM filename=[$filename]";
    //global $auto;
    $contents = file_get_contents($filename);
    $charset[1] = substr($contents, 0, 1); 
    $charset[2] = substr($contents, 1, 1); 
    $charset[3] = substr($contents, 2, 1); 
    if (ord($charset[1]) == 239 && ord($charset[2]) == 187 && ord($charset[3]) == 191) {
    //if ($auto == 1) {
        $rest = substr($contents, 3);
        rewrite ($filename, $rest);
        return ("BOM found, automatically removed.");
    //} else {
    //    return ("BOM found.");
    //}
    } 
    else return ("BOM Not Found.");
}
function rewrite ($filename, $data) {
    $filenum = fopen($filename, "w");
    flock($filenum, LOCK_EX);
    fwrite($filenum, $data);
    fclose($filenum);
}
function CheckHTCsystem()
{
	global $useragent_HTC;
	$useragent_HTC=0;
	
		//print_r($_SERVER);
		if(stripos($_SERVER['HTTP_USER_AGENT'],'HTC') !== false ||
		  stripos($_SERVER['HTTP_USER_AGENT'],'SM-N9005') !== false
		) 
		{ $useragent_HTC=1; return 1;}
		//echo "<br>_SERVER['HTTP_USER_AGENT']=[$_SERVER['HTTP_USER_AGENT']";
		//echo "<br>_SERVER['HTTP_USER_AGENT']=" . '"' .$_SERVER['HTTP_USER_AGENT'] ."'; ";
		//echo "<br>useragent_HTC=[$useragent_HTC]";
	return 0;	
}

function CheckAndroidsystem()
{
	global $useragent_Android;
	$useragent_Android=0;
	
		//print_r($_SERVER);
		if(stripos($_SERVER['HTTP_USER_AGENT'],'Android') !== false ||
		  stripos($_SERVER['HTTP_USER_AGENT'],'SM-N9005') !== false
		  )
		{ $useragent_Android=1; return 1;}
	return 0;	
}
function IpFrom()
{
if (!empty($_SERVER['HTTP_CLIENT_IP']))
    $ip=$_SERVER['HTTP_CLIENT_IP'];
else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
else
    $ip=$_SERVER['REMOTE_ADDR'];
 
 //print "ip from =[$ip]<br>";
 return($ip);
}

function updatedb($setCheckboxValue)
{
	if(sizeof($_POST)<2) return;
	

mysql_select_db($dbname);

//print_r($_POST);
$updateiterms = $_POST['checkiterms'];
if(sizeof($updateiterms)<1) return;
//$colors = array(1, 2, 3, 4);
	foreach($updateiterms as &$selectid){
		 // print"$selectid";
		 
		  $query="UPDATE `todolist` SET `Checkbox`=$setCheckboxValue WHERE  id =$selectid";
		  //$query="UPDATE `todolist` SET `Checkbox`=1 WHERE id = 1368";
		//echo "<br>query=[$query]";
		$result=mysql_query($query) or die('<hr>Error, update select id');
		 // print"<hr>update result?=[$result]";

	}
}


function mysql_fetch_all($res) {
   while($row=mysql_fetch_array($res)) {
       $return[] = $row;
       //print_r($row);
      echo $MakeHTML = "<br>$row[0], $row[1], $row[2],$row[3],$row[4],$row[5]";
     }
   return $return;
}


function days_diff_today($recordday)
{
	$myday=explode("-",$recordday);
	$today = getdate();
	//print_r($myday);print_r($today);
	$diffday=($myday[0]-$today[year])*365+  ($myday[1]-$today[mon]) * 30 + $myday[2]-$today[mday];
	return($diffday);
}
function imgsrc2ahref($Notes)
{
	$no=0;
	$strarray=splitehtmltag($Notes);
	//echo "<br>imgsrc2ahref:splitehtmltag(Notes) =[";print_r($strarray);
	foreach ($strarray as &$word)
	{
		if(strpos($word,'src=http://192.168.1.101:6001/')!== false ){
			$no++;
			$cutwords=$_SESSION['myusername'];;
			//echo "word=[$word] cutwords[$cutwords]";
			$imgname=stristr($word, $cutwords);
			$newhref='<a href=http://192.168.1.101:6001/'.$imgname.'pic' .$no .'</a>';
			//echo "newhref[$newhref]";
			$newNotes =$newNotes . $newhref;
		}
		/*else $newNotes=$newNotes . 	$word;*/
		else if(strpos($word,'img ')!== false && strpos($word,' src=')!== false){
			$newhref='[pic->]';
			//echo "newhref[$newhref]";
			$newNotes =$newNotes . $newhref;
		}
		else if(strpos($word,'iframe ')!== false && strpos($word,'www.youtube.com')!== false){
			$newhref='[youtube]';
			//echo "newhref[$newhref]";
			$newNotes =$newNotes . $newhref;
		}
		else $newNotes=$newNotes . 	$word;
	}
	//echo"<hr>$newNotes";
	return $newNotes;
}

function imgsrc2ahref_old($Notes)
{
	$no=0;
	$strarray=splitehtmltag($Notes);
	//echo "<br>imgsrc2ahref:splitehtmltag(Notes) =[";print_r($strarray);
	foreach ($strarray as &$word)
	{
		if(strpos($word,'src=http://192.168.1.101:6001/')!== false ){
			$no++;
			$cutwords=$_SESSION['myusername'];;
			//echo "word=[$word] cutwords[$cutwords]";
			$imgname=stristr($word, $cutwords);
			
			
			//$imgbegin=stristr($word, 'AdditermData/');
			//$names = $imgbegin;
			//<a href=http://192.168.1.101:6001/AdditermData/991_1.jpg>pic1</a>
			$newhref='<a href=http://192.168.1.101:6001/'.$imgname.'pic' .$no .'</a>';
			//echo "newhref[$newhref]";
			$newNotes =$newNotes . $newhref;
		}
		else $newNotes=$newNotes . 	$word;

	}
	//echo"<hr>$newNotes";
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
function getimgsname($Notes)
{
		$string=explode(' ',$Notes);
		//print_r($string);
		foreach ($string as &$word)
		{
			if(strpos($word,'src=http://192.168.1.101:6001/')!== false ){
			//$userfolder=$_SESSION['myusername'];
			//$cutwords=$userfolder.'/AdditermData/';
			$cutwords=$_SESSION['myusername'];;
			//echo "word=[$word] cutwords[$cutwords]";
			$imgbegin=stristr($word, $cutwords);
			$names[] = $imgbegin  ;
			//$imgfilename[]=stristr($imgbegin,'',ture);
			//echo "imagebegin=[$imgbegin] delete file[",print_r($names);
			//exit;
			}
			else{continue;}
		}
		return $names;
};
function NotePresentChangeIP($myNotes)
{
	global $ipfrom;//=IpFrom();
	global $useragent_Android;
	global $useragent_HTC;
	
	if( $useragent_HTC === 1)
	{$myNotes=imgsrc2ahref($myNotes);
	}
	
	
	if(strpos($ipfrom,'192.168') !== false) {
		//print "<br>Note no change";
	}
	else{
		$myNotes=str_replace('192.168.1.101','1.34.130.91',$myNotes);
		}
	
	//print "<br> ipfrom=[$ipfrom]  mynote=[$myNotes]";
	return($myNotes);
}
function dragNote($srcstr,$ext)
{
	
	$jpgarray= explode($ext,$srcstr);
		//print"jpgarray=[";print_r($jpgarray);
	for ($i=0;$i<sizeof($jpgarray);$i++){
	$tmpstr=$jpgarray[$i];
	if(sizeof($mergestr=explode('http://',$tmpstr))>2)
	{
		$tmpstr='<a href=http://' . $mergestr[1] . '>' . '<img src=http://' .$mergestr[2] ."$ext".'>'. '</a> ';
	}

	else if(strpos($tmpstr,'http://') !== false)$tmpstr='<img src=' . $tmpstr . $ext.'>' ;
	else if( strpos($tmpstr,'src=') !== false)$tmpstr=$jpgarray[$i] . $ext;
	$dragnote=$dragnote .$tmpstr; 
	}
	//print "dragnote=[$dragnote]";
    //exit;
	return $dragnote;
}
function dragNotePchome($srcstr)
{
	
	$jpgarray= explode('http://',$srcstr);
	//print"httparray=[";print_r($jpgarray);
	for ($i=0;$i<sizeof($jpgarray);$i++){
	$tmpstr=$jpgarray[$i];
    if(strpos($tmpstr,'=exhibit') !== false)$tmpstr='<a href=http://' . $tmpstr .'>'. 'iterm['.$i.']</a><hr>'; 
    else if(strpos($tmpstr,'pic') !== false)$tmpstr='<img src=http://' . $tmpstr .'>' ;
	else if( strpos($tmpstr,'src=') !== false)$tmpstr='http://'. $jpgarray[$i];
	$dragnote=$dragnote .$tmpstr; 
	}
	//print "<br>dragnote=[$dragnote]";
    //exit;
	return $dragnote;
}
function NoteProcess($Notes)
{
	$check=0;  //level  3 2 1 less error   0 no erro
	
	if(strpos($Notes,"\n\r") !== false )
	{
			if(strpos($Notes,"<ol>") === false )
		{
			
			$Notes = "<ol>" . $Notes;
		}
	//print "<br>find '\\n'"; 
		$Notes=str_replace("\n\r","<li>",$Notes);
	}
	if(strpos($Notes,'http:') === false &&  strpos($Notes,'https:') === false)
	{
		$Notes=str_replace('"','\"',$Notes);
		$Notes='"'. $Notes .'"';
		if ($check >0)print "<br>find 0";
		return $Notes;
	}
	
	if ($check >0)print "<hr><strong>NoteProcess($Notes)</strong>";
	$orgNotes=$Notes;

	$tagstrarray=splitehtmltag($Notes);
	$finalNotes="";
	if ($check>0) print_r($tagstrarray);
	
	for($tagindex=0;$tagindex<sizeof($tagstrarray);$tagindex++)
	{	$acut=$tagstrarray[$tagindex];
		 
		if(trim($acut)=='')continue;
		//if ($check >0)print "acut=[$acut]";
		if(strpos($acut,'<') !== false &&  strpos($acut,'>') !== false)
		{$finalNotes.=$acut;continue;}
		$finalNotes.=ProcessNotTagNote($acut);
		if ($check >0) echo  "<hr>finalNotes=[$finalNotes]";
	}
	
	$Notes=$finalNotes;
	if ($check >0) echo  "<hr>Notes=[$Notes]";
	$Notes=mergerefimg($Notes);
	if ($check >0) echo  "<hr>Notes=mergerefimg(Notes)=$Notes";
	$Notes=str_replace('"','\"',$Notes);
	$Notes='"'. $Notes .'"';
	//if ($check >0)exit;
	return $Notes;
}
function mergerefimg($Notes)
{
		//replace ref <a> = [<img ..><a>]
		$check=0;
	$tagstrarray=splitehtmltag($Notes);
	if ($check>0) print_r($tagstrarray);
	for($tagindex=0;$tagindex<sizeof($tagstrarray);$tagindex++)
	{	$acut=$tagstrarray[$tagindex];
		if($acut=='ref' && stripos($tagstrarray[$tagindex+3],'<img ') !== false
			 && stripos($tagstrarray[$tagindex+1],'</a>')   !== false)
		{
			$tagstrarray[$tagindex]=$tagstrarray[$tagindex+3];
			$tagstrarray[$tagindex+3]="";
		}
	}
	if ($check>0) print_r($tagstrarray);
	for($tagindex=0;$tagindex<sizeof($tagstrarray);$tagindex++)
	 $mrgstr.=$tagstrarray[$tagindex];
	if ($check>0) print"mrgstr=$mrgstr";
	return $mrgstr;
}
function ProcessNotTagNote($acut)
{
		$check=0;
		$acut=$acut. ' ';
	$httpstrarray=explode(' ',$acut);
		
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
				$ext="";
				if(strpos($tmpstr,'src=http')===  false){
					if(strpos($tmpstr,'.jpg')!==  false){$ext='.jpg';}
					if(strpos($tmpstr,'.jpeg')!==  false){$ext='.jpeg';}	
					if(strpos($tmpstr,'.png')!==  false){$ext='.png';}
					if(strpos($tmpstr,'.gif')!==  false){$ext='.gif';}	
					if($ext != ""){	
						$orgtmpstr =dragNote($tmpstr,$ext);		
						$nochange=1;
						if ($check >0)print "<br>find img orgtmpstr =[$orgtmpstr ]";
					}
					if(strpos($tmpstr,'img.pchome')!==  false){ 
						$orgtmpstr =dragNotePchome($tmpstr);
						$nochange=1;
						if ($check >0)print "<br>find img.pchome orgtmpstr =[$orgtmpstr ]";	
						$httpstrarray[sizeof($httpstrarray)-1]="";
					}				
				}
			}
		  
			if(strpos($tmpstr,'https://') !== false){
				$nochange=0;
				if ($check >0) print "<br>find 2";
			}
			if(strpos($tmpstr,'https://www.youtube.com') !== false){
				$nochange=0;
				if ($check >0) print "<br>find 6";
			}
			if (strpos($tmpstr,'href=http')!== false ){
				$nochange=1;//avoid insert " 
				if ($check >0) print "<br>find 3";
			}
			if (strpos($tmpstr,'src=http')!== false ){
				$nochange=1;//avoid insert " 
				if ($check >0) print "<br>find 4";
			}
			 if($nochange==0){
				if($httpstrarray[$i+1] !== "")$tmpstr='<a href=' . $tmpstr . '>' . $httpstrarray[$i+1] . '</a> ';
				
				else $tmpstr='<a href=' . $tmpstr . '>' .'ref' . '</a> ';
				$i++;
				}
			 else {$tmpstr=$orgtmpstr;}
			
			 $tmpNotes=$tmpNotes . $tmpstr . ' ';//explode reomce
			  if ($check >0)echo "<br>tmpNotes=[$tmpNotes]";
			}
		return $tmpNotes;
			
}
function NoteProcess_old($Notes)
{
	$check=0;  //level  3 2 1 less error   0 no erro
	if(strpos($Notes,'http:') === false &&  strpos($Notes,'https:') === false)
	{
		$Notes=str_replace('"','\"',$Notes);
		$Notes='"'. $Notes .'"';
		if ($check >0)print "<br>find 0";
		return $Notes;
	}
	
	if ($check >0)print "<hr><strong>NoteProcess($Notes)</strong>";
	$orgNotes=$Notes;
	$Notes=$Notes . ' ';// for using function stristr() if no end of $Notes for cut string   
	
	//default no change;
	//print "Notes=$Notes]";
	// http://cline1413.pixnet.net/blog/post/221458400 ==>
	//<a href=http://cline1413.pixnet.net/blog/post/221458400>name<\a>
	$httpstrarray=splitehtmltag($Notes);
	//$httpstrarray= explode(' ',$Notes);
	
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
			$ext="";
			if(strpos($tmpstr,'src=http')===  false){
				if(strpos($tmpstr,'.jpg')!==  false){$ext='.jpg';}
				if(strpos($tmpstr,'.jpeg')!==  false){$ext='.jpeg';}	
				if(strpos($tmpstr,'.png')!==  false){$ext='.png';}
				if(strpos($tmpstr,'.gif')!==  false){$ext='.gif';}	
				if($ext != ""){	
					$orgtmpstr =dragNote($tmpstr,$ext);		
					$nochange=1;
					if ($check >0)print "<br>find img orgtmpstr =[$orgtmpstr ]";
				}
				if(strpos($tmpstr,'img.pchome')!==  false){ 
					$orgtmpstr =dragNotePchome($tmpstr);
					$nochange=1;
					if ($check >0)print "<br>find img.pchome orgtmpstr =[$orgtmpstr ]";	
					$httpstrarray[sizeof($httpstrarray)-1]="";
				}				
			}
		}
	  
		if(strpos($tmpstr,'https://') !== false){
			$httpbefore=stristr($tmpstr, 'https://',true);
			$httpbegin=stristr($tmpstr, 'https://');
			$nochange=1;
			if ($check >0) print "<br>find 2";
		}
		if(strpos($tmpstr,'https://www.youtube.com') !== false){
			$nochange=0;
			if ($check >0) print "<br>find 6";
		}
		if (strpos($tmpstr,'href=http')!== false ){
			$nochange=1;//avoid insert " 
			if ($check >0) print "<br>find 3";
		}
		if (strpos($tmpstr,'src=http')!== false ){
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
			if($httpstrarray[$i+1] !== "")$tmpstr='<a href=' . $tmpstr . '>' . $httpstrarray[$i+1] . '</a> ';
			else $tmpstr='<a href=' . $tmpstr . '>' .'ref' . '</a> ';
			$i++;
			}
		 else {$tmpstr=$orgtmpstr;}
		
		 $tmpNotes=$tmpNotes . $tmpstr . ' ';//explode reomce
		  //echo "<br>tmpNotes=[$tmpNotes]";
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

function opendb()
{// This is an example of config.php

/*session_start();
if(!isset($_SESSION['myusername'])){
header("location:main_login.php");
}*/
$dbhost = 'localhost';
$dbuser = 'lgh';
$dbpass = 'frank';
//$dbname = 'listpro';
$dbname = $_SESSION["myusername"];//'listpro';

// This is an example opendb.php
//So now you can open a connection to mysql like this :
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');
 
$db_selected=mysql_select_db($dbname);	
  if (!$db_selected) {
    die ("Can\'t use db=[$dbname] foo : " . mysql_error());
  }
echo "select db [ $dbname ]";
return $conn;
}
function CheckCreateMonthFolder($SessionName)
{
 $thismonth = date("Y-m"); //echo "thismonth=[$thismonth]";exit;
 
 $picture_dir=$SessionName.'/'.$thismonth.'/'."AdditermData/";
 if (!file_exists($picture_dir)) {
	 if (!mkdir($picture_dir, 0, true)) {
		die('Failed to create folders...');
	 }
  }
 return $picture_dir;
}
function picMultiupload_name($picktag,$key,$destname)
{
	//$picktag="File1";
$UploadDir=	CheckCreateMonthFolder($_SESSION["myusername"]);
$dirfile=$UploadDir .$destname;
//print_r($_POST);
//print_r($_FILES);
$allowedExts = array("gif", "jpeg", "jpg", "png");
$filename=$_FILES[$picktag]["name"];
//echo "filename=[$filename]";
$temp = explode(".", $_FILES[$picktag]["name"][$keys]);
$extension = end($temp);
$size=$_FILES[$picktag]["size"][$key] / 1024;


if($_POST['submitvalue'] === 'size' )exit;
  if ($_FILES[$picktag]["error"][$key] > 0)
    {
    echo "Return Code: " . $_FILES[$picktag]["error"][$key] . "<br>";
    }
  else
    {
//    echo "Upload: " . $_FILES["File1"]["name"] . "<br>";
 //   echo "Type: " . $_FILES["File1"]["type"] . "<br>";
    //echo "Size: " .  $size .  "kB<br>";
//    echo "Temp file: " . $_FILES["File1"]["tmp_name"] . "<br>";

    if (file_exists($dirfile))
      {
      echo $dirfile . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES[$picktag]["tmp_name"][$key],
      $dirfile );
      $result=checkBOM ( $dirfile) ;
     // print "<br>checkBOMresult=$result";
      echo "<br>Stored in: " .$dirfile;
      printf ("[%d]kB",$size);
      
      return ( $dirfile);
      }
    }
}
/*function ()
{
		foreach($_FILES['File']['tmp_name'] as $key => $tmpName) {

		  $file_name = $_FILES['File']['name'][$key];
		  $file_type = $_FILES['File']['type'][$key];
		  $file_size = $_FILES['File']['size'][$key];
		  $file_tmp  = $_FILES['File']['tmp_name'][$key];
		  //$filename=$lastid.'_'.$key.time();
		  $filename=$lastid.'_'.$key;
		  $refnameLocal=UploadMultiFileGetLinkName('File',$key,$filename);
		 //$refnameLocal=UploadFileGetLinkName("$files[$i]",$filename);
                $NoteAppendRefname=$NoteAppendRefname . "(" .$refnameLocal .")" . ' ';
        }
     
}*/
function UploadMultiFileGetLinkName($picktag,$lastid)
{
	//print_r($_FILES);
	//echo "<br>picktag=[$picktag]";
	mutiFileUpload($picktag);
	foreach($_FILES[$picktag]['name'] as $key => $filename) {
				//echo"<br>filename=$filename";
				$newname=$lastid .'_'.$key. '_'. time();
				//$newname=date('Ymd_u'). '_'.$lastid .'_'.$key ;
				//echo"<br>newname=$newname";//exit;//20131109_125440				
				$temp = explode(".", $filename);
				$extension = end($temp);							
				$uploadname=$newname .".$extension";
				$tmpfilename=picMultiupload_name($picktag,$key,$uploadname);
			    //$refnameLocal=tolinkaddressLocal($tmpfilename);
			    $refnameLocal=tolinkaddressLocal($tmpfilename,$filename);
			    //$refnameWWW=tolinkaddressWWW($tmpfilename);
			    //$NoteAppendRefname=$_POST['Notes'] . $refnameWWW ."(" .$refnameLocal .")";
			    // $NoteAppendRefname=$NoteAppendRefname . "(" .$refnameLocal .")" . ' ';
			     $NoteAppendRefname=$NoteAppendRefname . " " .$refnameLocal ." " . ' ';
	}
      return   array($NoteAppendRefname,$key+1);
}
function UploadMultiFileGetLinkName_old($picktag,$key,$lastid)
{
						$filename=$_FILES[$picktag]["name"][$key];
		
						//echo "filename=[$filename]";
						//$temp = explode(".", $_FILES["File1"]["name"]);
						$temp = explode(".", $filename);
						$extension = end($temp);							
				$uploadname=$lastid . ".$extension";
				$tmpfilename=picMultiupload_name($picktag,$key,$uploadname);
			    $refnameLocal=tolinkaddressLocal($tmpfilename);
			    //$refnameWWW=tolinkaddressWWW($tmpfilename);
			    //$NoteAppendRefname=$_POST['Notes'] . $refnameWWW ."(" .$refnameLocal .")";
      return $refnameLocal;
}
/*function tolinkaddressLocal($tmpfilename)
{
	// note add
	//<a href=http://192.168.1.101:6001/downloadurl.php?f=upload/my.txt>upload/my.txt</a> 
	//$picDir= 'upload/';
	//$tmpfilename = $dir . $tmpfilename;
	//<img src="upload/66-1.jpg" width="16" height="12" alt="text" />
	$filename='<img src=http://192.168.1.101:6001/'. "$tmpfilename" . ' width=16 height=12 alt=text />';
	//$filename='<a href=http://192.168.1.101:6001/downloadurl.php?f='. "$tmpfilename" . '>' ."Local"  .'</a>';
	//print"[tmpfilename=$tmpfilename] imgfilename=[$filename]";
	return($filename);
}*/
function tolinkaddressWWW($tmpfilename)
{
	// note add
	//<a href=http://192.168.1.101:6001/downloadurl.php?f=upload/my.txt>upload/my.txt</a> 
	//$picDir= 'upload/';
	//$tmpfilename = $dir . $tmpfilename;
	//$filename='<a href=http://1.34.130.91:6001/downloadurl.php?f='. "$tmpfilename" . '>' ."$tmpfilename"  .'</a>';
	$filename='<img src=http://1.34.130.91:6001/'. "$tmpfilename" . ' width=16 height=12 alt=text />';
	print"[tmpfilename=$tmpfilename] imgwwwfilename=[$filename]";
	return($filename);
}
function tolinkaddressLocal_nofilename($tmpfilename)
{
	// note add
	//<a href=http://192.168.1.101:6001/downloadurl.php?f=upload/my.txt>upload/my.txt</a> 
	//$picDir= 'upload/';
	//$tmpfilename = $dir . $tmpfilename;
	//<img src="upload/66-1.jpg" width="16" height="12" alt="text" />
	$filename='<img src=http://192.168.1.101:6001/'. "$tmpfilename" . ' width=16 height=12 alt=text />';
	//$filename='<a href=http://192.168.1.101:6001/downloadurl.php?f='. "$tmpfilename" . '>' ."Local"  .'</a>';
	//print"[tmpfilename=$tmpfilename] imgfilename=[$filename]";
	
	return($filename);
}function tolinkaddressLocal($tmpfilename,$originalfilename)
{
	// note add
	//<a href=http://192.168.1.101:6001/downloadurl.php?f=upload/my.txt>upload/my.txt</a> 
	//$picDir= 'upload/';
	//$tmpfilename = $dir . $tmpfilename;
	//<img src="upload/66-1.jpg" width="16" height="12" alt="text" />
	$filename='<img src=http://192.168.1.101:6001/'. "$tmpfilename" . ' width=16 height=12 alt='.$originalfilename.'>';
	//$filename='<a href=http://192.168.1.101:6001/downloadurl.php?f='. "$tmpfilename" . '>' ."Local"  .'</a>';
	//print"[tmpfilename=$tmpfilename] imgfilename=[$filename]";
	
	return($filename);
}
function tolinkaddressLocal_old($tmpfilename)
{
	// note add
	//<a href=http://192.168.1.101:6001/downloadurl.php?f=upload/my.txt>upload/my.txt</a> 
	//$picDir= 'upload/';
	//$tmpfilename = $dir . $tmpfilename;
	//<img src="upload/66-1.jpg" width="16" height="12" alt="text" />
	$filename='<img src=http://192.168.1.101:6001/'. "$tmpfilename" . ' width=16 height=12 alt=text />';
	//$filename='<a href=http://192.168.1.101:6001/downloadurl.php?f='. "$tmpfilename" . '>' ."Local"  .'</a>';
	//print"[tmpfilename=$tmpfilename] imgfilename=[$filename]";
	return($filename);
}		
function mutiFileUpload($filepostname)
{ 
	foreach($_FILES[$filepostname]['tmp_name'] as $key => $tmpName) {

		  $file_name = $_FILES[$filepostname]['name'][$key];
		  $file_type = $_FILES[$filepostname]['type'][$key];
		  $file_size = $_FILES[$filepostname]['size'][$key];
		  $file_tmp  = $_FILES[$filepostname]['tmp_name'][$key];
		  print "<br>File[$keys]>$filename=[$file_name],filetype=[$file_type],file_size=[$file_size],filetmpname=[$file_tmp]"; 
		  
	  //move_uploaded_file($file_tmp,"files/".time().$file_name);
		}
}
function picupload_name($picktag,$destname)
{
	//$picktag="File1";
//$UploadDir="AdditermData/";	
$UploadDir="AdditermData/";	
$dirfile=$UploadDir .$destname;
//print_r($_POST);
//print_r($_FILES);
$allowedExts = array("gif", "jpeg", "jpg", "png");
$filename=$_FILES[$picktag]["name"];
//echo "filename=[$filename]";
$temp = explode(".", $_FILES[$picktag]["name"]);
$extension = end($temp);
$size=$_FILES[$picktag]["size"] / 1024;
printf (" Size: %d kB<br>",$size);

if($_POST['submitvalue'] === 'size' )exit;
  if ($_FILES[$picktag]["error"] > 0)
    {
    echo "Return Code: " . $_FILES[$picktag]["error"] . "<br>";
    }
  else
    {
//    echo "Upload: " . $_FILES["File1"]["name"] . "<br>";
 //   echo "Type: " . $_FILES["File1"]["type"] . "<br>";
    //echo "Size: " .  $size .  "kB<br>";
//    echo "Temp file: " . $_FILES["File1"]["tmp_name"] . "<br>";

    if (file_exists($dirfile))
      {
      echo $dirfile . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES[$picktag]["tmp_name"],
      $dirfile );
      $result=checkBOM ( $dirfile) ;
     // print "<br>checkBOMresult=$result";
      echo "Stored in: " .$dirfile;
      
      return ( $dirfile);
      }
    }
}
function picupload()
{
$UploadDir="upload/";	
//print_r($_POST);
//print_r($_FILES);
$allowedExts = array("gif", "jpeg", "jpg", "png");
$filename=$_FILES["File1"]["name"];
echo "filename=[$filename]";
$temp = explode(".", $_FILES["File1"]["name"]);
$extension = end($temp);
$size=$_FILES["File1"]["size"] / 1024;
printf (" Size: %d kB<br>",$size);

if($_POST['submitvalue'] === 'size' )exit;
  if ($_FILES["File1"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["File1"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["File1"]["name"] . "<br>";
    echo "Type: " . $_FILES["File1"]["type"] . "<br>";
    //echo "Size: " .  $size .  "kB<br>";
    echo "Temp file: " . $_FILES["File1"]["tmp_name"] . "<br>";

    if (file_exists($UploadDir . $_FILES["File1"]["name"]))
      {
      echo $_FILES["File1"]["name"] . " already exists. ";
      }
    else
      {
	  move_uploaded_file($_FILES["File1"]["tmp_name"],
      $UploadDir . $_FILES["File1"]["name"]);
      //echo "Stored in: " . $UploadDir . $_FILES["File1"]["name"];
      $dirfile=$UploadDir . $_FILES["File1"]["name"];
      $result=checkBOM ( $dirfile) ;
      //print "<br>checkBOMresult=$result";
      return ( $dirfile);
      }
    }
}
function geturlparas()
{
//print_r($_GET);

if(isset($_GET['Textfilter']))
	{
	$filterset=array( 'Checkboxfilter' =>trim($_GET['Checkboxfilter']) ,
                    'Flagfilter' =>trim($_GET['Flagfilter']),
                     'Textfilter' =>trim($_GET['Textfilter']),
                    'Pricefilter'=>trim($_GET['Pricefilter']),
                    'Datefilter' =>trim($_GET['Datefilter']),
                     
            );//6 all ,0 today fast	
			 
	}
	else
	{
	$filterset=array( 'Checkboxfilter' =>'0' ,
                    'Flagfilter' =>'2',
                     'Textfilter' =>"",
                    'Pricefilter'=>'0',
                    'Datefilter' =>'0',
          
            );//6 all ,0 7 fast	
			 
	}
//put after $filterset=array(  otherwise it will be overwrite	
if(isset($_GET['showrowbegin'])){
$filterset['showrowbegin']=trim($_GET[showrowbegin]);
}

else{$filterset['showrowbegin']=0;}	
if(isset($_GET['shownumlimit'])){
$filterset['shownumlimit']=trim($_GET[shownumlimit]);
}
	//print "<br> filterser =";print_r($filterset);
	return $filterset;
}	
function getfilterset()
{
	global $initsearchkeyword;
  // Array ( [Checkfilter] => on [Flagfilter] => on [Textfilter] => 123 [Pricefilter] => 1 [Datefilter] => 2 ) 
  //print "<br> getfilterset:_POST";
  //print_r($_POST);
  global $filterset;
  $filterset=array( 'Checkboxfilter' =>$_POST[Checkboxfilter] ,
                    'Flagfilter'  => $_POST[Flagfilter],
                     'Textfilter' => $_POST[Textfilter],
                     'Pricefilter'=> $_POST[Pricefilter],
                     'Datefilter' => $_POST[Datefilter]); 
 if($filterset[Checkboxfilter] === NULL)$filterset[Checkboxfilter]='2';//laststat ; else $filterset[Checkfilter]=0;
 if($filterset[Flagfilter] === NULL )$filterset[Flagfilter]='2'; //else $filterset[Flagfilter]=0;
 // if($filterset[Datefilter] === 'on')$filterset[Flagfilter]=1; else $filterset[Flagfilter]=0;
  $filterset[Textfilter]=$_POST[Textfilter]; 
 if($filterset[Textfilter] !== NULL ) {$initsearchkeyword=1;}//good to view 
 //if($filterset[Pricefilter] !== 0) {$Priceset=1;}//good to view $Priceset
 if($filterset[Pricefilter] === NULL) {$filterset[Pricefilter]='0';}//good to view $Priceset
 if($filterset[Datefilter] === NULL )$filterset[Datefilter]='6';
 //print "<br> getfilterset:filterset";
  //print_r($filterset);
  return $filterset;	
}
function Produce_fancybox_tag($Notes)
{
//<img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_4_1384916167.jpg width=16 height=12 alt=5_b.jpg>
//<a class="fancybox" rel="gallery1" href=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_0_1384916167.jpg width=16 height=12 alt=1_b.jpg><img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_0_1384916167.jpg width=16 height=12 alt=1_b.jpg></a>
/*  $HTMLDOM = new DOMDocument();
    $HTMLDOM->loadHTML($Notes);
    $arrContentImages = array();
    
  
    
$node =  $HTMLDOM->getElementsByTagName("img")->item(0);
print_r($node);
 $imgsrc = $node ->getAttribute("src");
 print_r($imgsrc);
     $element = $HTMLDOM->createElement('test', 'This is the root element!');
//$node->insertAfter ($element);
$newText = new DOMText('new content</a>');
$node->appendChild($newText);
echo "Content 3: ".$node->textContent."\n";

    foreach ($HTMLDOM->getElementsByTagName("img") as $objImage) {
		//print_r($objImage);
       $imgsrc = $objImage->getAttribute("src");
       $objImage->nodeValue="</a>";
       //$element = $HTMLDOM->createElement('test', 'This is the root element!');
       //$objImage->insertAfter ($element);
		//print_r($divs->item(0)->nodeValue);
		//$newText = new DOMText('new content</a>');
		//$objImage->appendChild($newText);
		//$arrContentImages[] =$imgsrc;
    }
 //print_r( $arrContentImages) ;
echo $HTMLDOM->saveXML();
exit;
    return (!empty($arrContentImages)) ? $arrContentImages : false;
  
 /*$resultstrarray=splitehtmltag($Notes);*/
 $array = array(); 
 $tagarray=splitehtmltag($Notes);
 //print_r($tagarray);
	 foreach($tagarray as &$atag){
		//echo "atag=[$atag]";
			 if(strpos($atag,'<img ')!==false){
				 if(strpos($atag,'.jpg')!==false){
					$newtag=preg_replace('/<img src=(.*).jpg (.*)>/i', 
					'<a class="fancybox" rel="gallery1" href=${1}.jpg>', $atag);
					$newtag.=$atag .'</a>';
				  }
				  if(strpos($atag,'.jpeg')!==false){
					$newtag=preg_replace('/<img src=(.*).jpeg (.*)>/i', 
					'<a class="fancybox" rel="gallery1" href=${1}.jpeg>', $atag);
					$newtag.=$atag .'</a>';
				  }
				  if(strpos($atag,'.png')!==false){
					$newtag=preg_replace('/<img src=(.*).jpeg (.*)>/i', 
					'<a class="fancybox" rel="gallery1" href=${1}.png>', $atag);
					$newtag.=$atag .'</a>';
				  }
				
			 }
			 else{$newtag=$atag;}
			//echo "newtag=[$newtag]"; 
		  $array[]=$newtag;
		  $newnotes.=$newtag;
		  }
	//print_r($array);
	//echo "newnotes=[$newnotes]";
	
	return $newnotes;
}

?>

