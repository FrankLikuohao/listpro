<?php
function hi()
{
	echo "<strong>Hollo World</strong>";
}
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
		  stripos($_SERVER['HTTP_USER_AGENT'],'SAMSUNG SM-N9005') !== false
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
		if(stripos($_SERVER['HTTP_USER_AGENT'],'Android') !== false) 
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
	//  print"$selectid";
	  $query="UPDATE `todolist` SET `Checkbox`=$setCheckboxValue WHERE  id = $selectid ";

//echo "<br>query=[$query]";
mysql_query($query) or die('Error, update select id');
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
	//if( $useragent_Android == 1)
	{$myNotes=imgsrc2ahref($myNotes);}
	//echo "<hr>imgsrc2ahref=[$myNotes]";
	//else{$newNotes=}
	//cut < />
	//getfilename
	//produce string and replace the arrary
	//replace img src  => href=
	//(<img src=http://192.168.1.101:6001/AdditermData/1026_0_1381029062.jpg width=16 height=12 alt=text />)
	//123 3123(<img src=http://192.168.1.101:6001/AdditermData/1026_0_1381029062.jpg width=16 height=12 alt=text />) 452 5(<img src=http://192.168.1.101:6001/AdditermData/1026_1_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_2_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_3_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_4_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_5_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_6_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_7_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_8_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_9_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_10_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_11_1381029062.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/1026_12_1381029062.jpg width=16 height=12 alt=text />)
	//(<a href=http://192.168.1.101:6001/AdditermData/991_1.jpg>pic1</a>)
	
	if(strpos($ipfrom,'192.168') !== false) {
		//print "<br>Note no change";
	}
	else{
		$myNotes=str_replace('192.168.1.101','1.34.130.91',$myNotes);
		}
	
	//print "<br> ipfrom=[$ipfrom]  mynote=[$myNotes]";
	return($myNotes);
}
function NoteProcess($Notes)
{
	$check=0;  //level  3 2 1 less error   0 no erro
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
	for ($i=0;$i<sizeof($httpstrarray)-1;$i++){
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
		 if ($check >0) echo "<br>tmpstr[$i]=[$tmpstr]";
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
function NoteProcess($Notes)
{
	$nochange=1;//default no change;
	//print "Notes=$Notes]";
	// http://cline1413.pixnet.net/blog/post/221458400 ==>
	//<a href=http://cline1413.pixnet.net/blog/post/221458400>name<\a>
	if(strpos($Notes,'http://') !== false){
		$httpbefore=stristr($Notes, 'http://',true);
		$httpbegin=stristr($Notes, 'http://');
		$nochange=0;
		//print "<br>find 1";
	}
	if(strpos($Notes,'https://') !== false){
		$httpbefore=stristr($Notes, 'https://',true);
		$httpbegin=stristr($Notes, 'https://');
		$nochange=0;
		//print "<br>find 2";
	}
	if (strpos($Notes,'href=http://')!== false ){
		$nochange=1;//avoid insert " 
		//print "<br>find 3";
	}
	if (strpos($Notes,'src=http://')!== false ){
		$nochange=1;//avoid insert " 
		//print "<br>find 4";
	}
	
	$httpstr=stristr($httpbegin,' ',true);
	$httplast=stristr($httpbegin, ' ');
	
	$httplast=substr("$httplast", 1);// cut a ' ';
	$httplast=$httplast .' ';//avoid not ' ' after the name str
	$name=stristr($httplast, ' ',true);
	$httplast=stristr($httplast, ' ');
	
	if ($name == "") $name="Reference";
	$name='"'. $name . '"';	
	//print "<br>httpnote=[$Notes]";
	
    if($nochange==0){$Notes=$httpbefore . '<a href=' . $httpstr . '>' . $name . '</a> ' . $httplast ;$Notes=$httpbefore . '<a href=' . $httpstr . '>' . $name . '</a> ' . $httplast ;}//skip href=http://
	
	$Notes=str_replace('"','\"',$Notes);
	$Notes='"'. $Notes .'"';
	//print "[$nochange][$httpbefore][$httpbegin] [$httpstr] [$httplast] [ $name]<br>Notes=[$Notes]";
	//exit;	
	return $Notes;
}
*/

function opendb()
{// This is an example of config.php

session_start();
if(!isset($_SESSION['myusername'])){
header("location:main_login.php");
}
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
//echo "select db [ $dbname ]";
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
				//echo"<br>newname=$newname";				
				$temp = explode(".", $filename);
				$extension = end($temp);							
				$uploadname=$newname .".$extension";
				$tmpfilename=picMultiupload_name($picktag,$key,$uploadname);
			    $refnameLocal=tolinkaddressLocal($tmpfilename);
			    //$refnameWWW=tolinkaddressWWW($tmpfilename);
			    //$NoteAppendRefname=$_POST['Notes'] . $refnameWWW ."(" .$refnameLocal .")";
			     $NoteAppendRefname=$NoteAppendRefname . "(" .$refnameLocal .")" . ' ';
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
function tolinkaddressLocal($tmpfilename)
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
 if($filterset[Checkboxfilter] === "")$filterset[Checkboxfilter]='BOTH';//laststat ; else $filterset[Checkfilter]=0;
 if($filterset[Flagfilter] === "" )$filterset[Flagfilter]='BOTH'; //else $filterset[Flagfilter]=0;
 // if($filterset[Datefilter] === 'on')$filterset[Flagfilter]=1; else $filterset[Flagfilter]=0;
  $filterset[Textfilter]=$_POST[Textfilter]; 
 if($filterset[Textfilter] !== "") {$initsearchkeyword=1;}//good to view 
 if($filterset[Pricefilter] !== 0) {$Priceset=1;}//good to view $Priceset
 
  print "<br> getfilterset:filterset";
  print_r($filterset);
  return $filterset;	
}
?>

