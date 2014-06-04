<?php
class NoteProcess
{
}
//require "library/Listprolib.php";
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
function Produce_fancybox_tag($Notes)
{
//<img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_4_1384916167.jpg width=16 height=12 alt=5_b.jpg>
//<a class="fancybox" rel="gallery1" href=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_0_1384916167.jpg width=16 height=12 alt=1_b.jpg><img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_0_1384916167.jpg width=16 height=12 alt=1_b.jpg></a>
 $HTMLDOM = new DOMDocument();
    $HTMLDOM->loadHTML($Notes);
    $arrContentImages = array();
    
  /* 
    
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
 foreach( $tagarray as &$atag)
 {
	 if(strpos($atag,'<img ')!==false){
		 $newtag=preg_replace('/<img src=(.*).jpg (.*)>/i', 
		'<a class="fancybox" rel="gallery1" href=${1}.jpg>', $atag);$newtag.=$atag .'</a>';
	 }
	 else{$newtag=$atag;}
  $array[]=$newtag;
}
  

print_r($array);
 //$array = array();


    //preg_match( '/src=([^"]*)/i', $Notes, $array ) ;
    //print_r( $array ) ;
	//print_r($resultstrarray);*/
}
function dragNote($srcstr,$ext)
{
	
	$jpgarray= explode($ext,$srcstr);
		print"jpgarray=[";print_r($jpgarray);
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
    if(strpos($tmpstr,'=exhibit') !== false)$tmpstr='<a href=http://' . $tmpstr .'>'. 'iterm['.$i.']</a>'; 
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
	if(strpos($Notes,'http:') === false &&  strpos($Notes,'https:') === false)
	{
		$Notes=str_replace('"','\"',$Notes);
		$Notes='"'. $Notes .'"';
		if ($check >0)print "<br>find 0";
		return $Notes;
	}
	
	if ($check >0)print "<hr><strong>NoteProcess($Notes)</strong>";
	$orgNotes=$Notes;
	
	//default no change;
	//print "Notes=$Notes]";
	// http://cline1413.pixnet.net/blog/post/221458400 ==>
	//<a href=http://cline1413.pixnet.net/blog/post/221458400>name<\a>
	$tagstrarray=splitehtmltag($Notes);
	if ($check>0) print_r($tagstrarray);
	foreach($tagstrarray as &$acut)
	{
		if(strpos($acut,'<') !== false &&  strpos($acut,'>') !== false)
		{$tmpNotes=$acut;continue;}
		$acut=$acut. ' ';// for using function stristr() if no end of $Notes for cut string   
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
		$finalNotes=$finalNotes .  $tmpNotes;
	}
	//if ($name == "") $name="Reference";
	//$name='"'. $name . '"';	
	//if ($check >2) print "<br>httpnote=[$Notes]";
	
    /*if($nochange==0){
		$Notes=$httpbefore . '<a href=' . $httpstr . '>' . $name . '</a> ' . $httplast ;
	}
	else {$Notes=$orgNotes;}//skip href=http:  ,  img src=http:
	*/
	$Notes=$finalNotes;
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
*/
$string[0]="normal string";
$string[1]="http://cline1413.pixnet.net/blog/post/221458400"; 
$string[2]="<a href=http://cline1413.pixnet.net/blog/post/221458400>name"; 
$string[3]="https://mail.google.com/mail/u/0/#inbox/1386c678caf50f6e";
$string[4]= $string[1] . ' '. webpage .' ' . $string[2] .' '. $string[3];
$string[5]='(<img src=http://192.168.1.101:6001/AdditermData/868.jpg width="16" height="12" alt="text" />)';
$string[6]="(<img src=http://192.168.1.101:6001/AdditermData/9999999_01380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_11380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_21380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_31380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_41380981226.jpg width=16 height=12 alt=text />) (<img src=http://192.168.1.101:6001/AdditermData/9999999_51380981226.jpg width=16 height=12 alt=text />)";
$string[7]="1，高cpu大RAM(效率)<br>   
2，雙鏡頭->視訊聊天<br>
3，攝影快且有相机品質->你的人生
4，大點螢幕導航或查資料眼睛老花(5吋)面板要比HD2大->iphone5不考慮<br>
5,電量->有電才能用(常要充電麻煩)<br> 
6，google導行<br>
(<img src=http://192.168.1.101:6001/frank_lgh/AdditermData/607_0_1383021597.jpg width=16 height=12 alt=text />)<a href=http://zh.wikipedia.org/zh/HTC_Butterfly_S><img  src=http://192.168.1.101:6001/frank_lgh/AdditermData/607_0_1383037247.jpg width=16 height=12 alt=text></a>)  (<img src=http://192.168.1.101:6001/frank_lgh/AdditermData/607_0_1383037285.jpg width=16 height=12 alt=text />)              ";
$string[8]="http://shopping.pchome.com.tw/?mod=item&func=exhibit&IT_NO=DGBM68-A79989226&SR_NO=DGALNT&ROWNO=4http://ec1img.pchome.com.tw/pic/v1/data/item/201310/D/G/B/M/6/8/DGBM68-A79989226000_524d14e970982http://ec1img.pchome.com.tw/pic/v1/data/item/201310/D/G/B/M/6/8/DGBM68-A79989226000_524d14ea7481a";

$string[10]="https://www.youtube.com/watch?feature=player_detailpage&v=BaItE24Vkbo#t=1201 slowmotion <a href=https://www.youtube.com/watch?feature=player_detailpage&v=BaItE24Vkbo#t=1092>note 3 OTG</a> ";
$string[9]="重灌 買新的 物流追蹤碼：	0603369923 <a href=http://www.t-cat.com.tw/Inquire/Trace.aspx?no=0603369923>黑貓</a>  <a href=https://www.evernote.com/shard/s192/view/notebook/2b7cbfae-8678-4b14-9892-3239a22a84a2?locale=zh_TW#st=p&n=2b7cbfae-8678-4b14-9892-3239a22a84a2>【西瓜通訊】高雄有店面全新未拆</a>  SAMSUNG GALAXY Note 3N9000 LTE 16GB 4G版/1300萬/2.3GHz四核/3GB RAM 黑色</a>";          

$string[11]="http://jsgears.com/thread-63-1-1.html test (<img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/100167_0_1383838512.jpg width=16 height=12 alt=text />) ";
$string[12]="http://mybid.ruten.com.tw/master/my.php <img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110334_0_1384301152.png width=16 height=12 alt=text />    ";

$string[13]="<a href=https://www.evernote.com/shard/s192/view/notebook/2b7cbfae-8678-4b14-9892-3239a22a84a2?locale=zh_TW#st=p&n=2b7cbfae-8678-4b14-9892-3239a22a84a2>西瓜通訊高雄有店面>全新未拆</a>";
$string[14]="<a href=http://mybid.ruten.com.tw/master/my.php <img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110334_0_1384301152.png width=16 height=12 alt=text /> </a>";
$string[15]="<img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_3_1384916167.jpg width=16 height=12 alt=4_b.jpg><img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_4_1384916167.jpg width=16 height=12 alt=5_b.jpg>";
$i=15;
$result=Produce_fancybox_tag($string[$i]);//NoteProcess($string[$i]);
echo "<hr>string[$i]=<br>$string[$i]<br>result=<br>$result";
?>
 

