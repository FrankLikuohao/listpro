<?php
// 'libraryDevelop/ListproControlLib.php'
require_once 'Math.php';
function Delete_Yes()
{
	
		mysql_select_db($dbname);
	//print_r($_POST);
	      $mutiCheckbox =  $_POST['mutiCheckbox'] ;
		  $mutiFlag =$_POST['mutiFlag'] ;
				//$mutiIterms =$_POST['mutiIterms'] ;
				//$mutiWhere = $_POST['mutiWhere'];
				$mutiNotes = $_POST['mutiNotes'];
				//$mutiPrice = $_POST['mutiPrice'];
				//$Date ='CURRENT_DATE()';//CURRENT_DATE()
				//$mutiDate =$_POST['mutiDate'];
	      $mutiid= $_POST['mutiid'];
	      if(sizeof($mutiid)<1) return;

		 $index=0;
			foreach($mutiid as &$selectid){
				if(  sizeof($mutiCheckbox) >0 && in_array($selectid, $mutiCheckbox )) {$Checkbox = '"'. '1'.'"';}else {$Checkbox = '"'. '0'.'"';}
				//$Checkbox = '"'. $mutiCheckbox[$index].'"';
				if(  sizeof($mutiFlag) >0 && in_array($selectid,$mutiFlag)) {$Flag ='"'. '1' .'"';}else { $Flag ='"'. '0' .'"';}
				//$Flag ='"'. $mutiFlag[$index] .'"';
				//$Iterms ='"'. $mutiIterms[$index].'"';
				//$Where ='"'. $mutiWhere[$index].'"';
				//print "<br>note=[$Notes]";
				$Notes =NoteProcess($mutiNotes [$index]);
				
				$query="DELETE FROM `todolist` WHERE `id`  = $selectid ";
				 //echo "[$Notes]";
				 if(strpos($Notes,'src=http://192.168.1.101:6001/')!== false ){
					erasenotesoldfiles($Notes,"");
				 }	
				//echo "<br>record $index>query=[$query]"; 
				
				mysql_query($query) or die('Error, update select id');
				//	echo "=>ok";
					$index++;
			}
} 
function Append_modify_with_multi_file()
{
		mysql_select_db($dbname);
	   $mutiCheckbox =  $_POST['mutiCheckbox'] ;
				$mutiFlag =$_POST['mutiFlag'] ;
				$mutiIterms =$_POST['mutiIterms'] ;
				$mutiWhere = $_POST['mutiWhere'];
				$mutiNotes = $_POST['mutiNotes'];
				$mutiPrice = $_POST['mutiPrice'];
				//$Date ='CURRENT_DATE()';//CURRENT_DATE()
				$mutiDate =$_POST['mutiDate'];
	      $mutiid= $_POST['mutiid'];
	      $mutiProjectid= $_POST['mutiProjectid'];
	      //print_r($_POST);
	      if(sizeof($mutiid)<1) return;
			//$colors = array(1, 2, 3, 4);
			$index=0;
			//$colors = array(1, 2, 3, 4);
			$index=0;
			foreach($mutiid as &$selectid){
     		if(  sizeof($mutiCheckbox) >0 && in_array($selectid, $mutiCheckbox )) {$Checkbox = '"'. '1'.'"';}else {$Checkbox = '"'. '0'.'"';}
				//$Checkbox = '"'. $mutiCheckbox[$index].'"';
				if(  sizeof($mutiFlag) >0 && in_array($selectid,$mutiFlag)) {$Flag ='"'. '1' .'"';}else { $Flag ='"'. '0' .'"';}
				//$Flag ='"'. $mutiFlag[$index] .'"';
				$Iterms ='"'. $mutiIterms[$index].'"';
				$Where ='"'. $mutiWhere[$index].'"';
				// create a record to get id for filename first ,otherelse update record only
				//print "<br>note=[$Notes]";
				$Notes=$mutiNotes[$index];
				$projectid=$mutiProjectid[$index];
				$query="INSERT`todolist` SET `Date` =0";
				mysql_query($query) or die('Error, INSERT select id');
				$lastid=mysql_insert_id();		 
				
				//copy original files produce new ontes with copy files ==waste space
				//empty the original note avoid to kill img by accident 
				//detect with image then mark otherwise do nothing
				if(stripos('<img',$Notes) !== false){$emptystr='"'."move pics to id=[$lastid]".'"';}
				else{$emptystr='"'."".'"';}
				
				$query="UPDATE `todolist` SET `Notes`=$emptystr WHERE  id = $selectid ";
				//echo "<br>id[$selectid]>query=[$query]"; 
				mysql_query($query) or die('Error, update empty of select id');
				//$copyfiles=getimgsname($Notes);
								
				if($_FILES['AddFile'][name][0] !== ""){				
				list ($NoteAppendRefname,$numfiles)=UploadMultiFileGetLinkName('AddFile',$lastid);
				}
				$Notes=$Notes.$NoteAppendRefname; 
				
				//print "<br>note=[$Notes]";
				$Notes =NoteProcess($Notes);
	
	
				//print "<br>httpnote=[$Notes]";
				//exit;
				
				$Price ='"'. $mutiPrice[$index].'"';
				$Date ='"'. $mutiDate[$index] .'"';//CURRENT_DATE()		
				$query="UPDATE `todolist` SET `Projectid`=$projectid, `Checkbox`=$Checkbox,`Flag`=$Flag,`Iterms`=$Iterms,`Where`=$Where,`Notes`=$Notes,`Price`=$Price,`Date`=$Date WHERE  id = $lastid ";		
				//echo "<br>record $index>query=[$query]"; 
				mysql_query($query) or die('Error, append  last id');
				//	echo "=>ok";
					$index++;
			}	
	
}

function Append_modify_with_file_old()
{
		mysql_select_db($dbname);
	   $mutiCheckbox =  $_POST['mutiCheckbox'] ;
				$mutiFlag =$_POST['mutiFlag'] ;
				$mutiIterms =$_POST['mutiIterms'] ;
				$mutiWhere = $_POST['mutiWhere'];
				$mutiNotes = $_POST['mutiNotes'];
				$mutiPrice = $_POST['mutiPrice'];
				//$Date ='CURRENT_DATE()';//CURRENT_DATE()
				$mutiDate =$_POST['mutiDate'];
	      $mutiid= $_POST['mutiid'];
	      if(sizeof($mutiid)<1) return;
			//$colors = array(1, 2, 3, 4);
			$index=0;
			//$colors = array(1, 2, 3, 4);
			$index=0;
			foreach($mutiid as &$selectid){

          
				if(  sizeof($mutiCheckbox) >0 && in_array($selectid, $mutiCheckbox )) {$Checkbox = '"'. '1'.'"';}else {$Checkbox = '"'. '0'.'"';}
				//$Checkbox = '"'. $mutiCheckbox[$index].'"';
				if(  sizeof($mutiFlag) >0 && in_array($selectid,$mutiFlag)) {$Flag ='"'. '1' .'"';}else { $Flag ='"'. '0' .'"';}
				//$Flag ='"'. $mutiFlag[$index] .'"';
				$Iterms ='"'. $mutiIterms[$index].'"';
				$Where ='"'. $mutiWhere[$index].'"';
				// create a record to get id for filename first ,otherelse update record only
				//print "<br>note=[$Notes]";
				$Notes=$mutiNotes[$index];
				
				$query="INSERT`todolist` SET `Date` =0";
				mysql_query($query) or die('Error, INSERT select id');
				$lastid=mysql_insert_id();		 
				
				if($_FILES[AddFile][name] !== ""){
				 $refnameLocal=UploadFileGetLinkName("AddFile",$lastid);
				 //print_r($_POST);
				 $NoteAppendRefname=$_POST['Notes'] . "(" .$refnameLocal .")";
				 $Notes = $Notes  . "(" .$refnameLocal .")";
				 }
				//print "<br>note=[$Notes]";
				$Notes =NoteProcess($Notes);
	
	
				//print "<br>httpnote=[$Notes]";
				//exit;
				
				$Price ='"'. $mutiPrice[$index].'"';
				$Date ='"'. $mutiDate[$index] .'"';//CURRENT_DATE()		
				$query="UPDATE `todolist` SET `Checkbox`=$Checkbox,`Flag`=$Flag,`Iterms`=$Iterms,`Where`=$Where,`Notes`=$Notes,`Price`=$Price,`Date`=$Date WHERE  id = $lastid ";		
				//echo "<br>record $index>query=[$query]"; 
				mysql_query($query) or die('Error, update select id');
				//	echo "=>ok";
					$index++;
			}	
	
}

//$_FILES["File1"]["name"]   $picktag="File1" can process eveything for picked file


function erasenotesoldfiles($oldNotes,$currentNotes)
{ 
				$oldfiles=getimgsname($oldNotes);
			    $currentfiles=getimgsname($currentNotes);
	/*[currentfiles,oldfiles] Array ( [0] => AdditermData/1005.1005_0 [1] => AdditermData/1005.1005_1 [2] => [3] => [4] => AdditermData/1005_0_1381018179.jpg ) Array ( [0] => AdditermData/1005.1005_0 [1] => AdditermData/1005.1005_1 [2] => [3] => [4] => AdditermData/1005_0_1381018179.jpg [5] => AdditermData/1005_0_1381019679.jpg [6] => AdditermData/1005_1_1381019679.jpg ) */	
	//detect oldfiles : erase the old files which not needed
	if( sizeof($oldfiles) >0){
		foreach($oldfiles as &$oldfile)
		{
			
			//in_array("Irix", $os)
			if(sizeof($currentfiles) === 0){
				echo "<br>delete file:$oldfile"; 
				//if (file_exists($oldfile)) 
				{unlink($oldfile);}
				$erasefiles[]=$oldfile; }
			else{
				if (in_array($oldfile,$currentfiles) === false){
					echo "<br>delete file:$oldfile"; 
					//if (file_exists($oldfile))
					 {unlink($oldfile);}
					$erasefiles[]=$oldfile; }
			}
		}
	}
	return $erasefiles;;
}
				
function update_modify_with_multi_file()
{

$math = new Math();

		//mysql_select_db($dbname);
				$mutiCheckbox =  $_POST['mutiCheckbox'] ;
				$mutiFlag =$_POST['mutiFlag'] ;
				$mutiIterms =$_POST['mutiIterms'] ;
				$mutiWhere = $_POST['mutiWhere'];
				$mutiNotes = $_POST['mutiNotes'];
				$mutiPrice = $_POST['mutiPrice'];
				$mutidelay= $_POST['mutidelay'];
				//$Date ='CURRENT_DATE()';//CURRENT_DATE()
				$mutiDate =$_POST['mutiDate'];
	            $mutiid= $_POST['mutiid'];
	            $mutiProjectid= $_POST['mutiProjectid'];
				//print_r($_POST);
	            //echo "<br>mutiProjectid[";print_r($mutiProjectid);
				//print_r($mutiProjectid);
	      if(sizeof($mutiid)<1) return;
//$colors = array(1, 2, 3, 4);
$index=0;
			foreach($mutiid as &$selectid){
            
				if(  sizeof($mutiCheckbox) >0 && in_array($selectid, $mutiCheckbox )) {$Checkbox = '"'. '1'.'"';}else {$Checkbox = '"'. '0'.'"';}
				//print "<br>Checkbox=[$Checkbox]";
				//$Checkbox = '"'. $mutiCheckbox[$index].'"';
				if(  sizeof($mutiFlag) >0 && in_array($selectid,$mutiFlag)) {$Flag ='"'. '1' .'"';}else { $Flag ='"'. '0' .'"';}
				if(  sizeof($mutidelay) >0 && in_array($selectid,$mutidelay)) {$Delay ='"'. '1' .'"';}else { $Delay ='"'. '0' .'"';}
				//$Flag ='"'. $mutiFlag[$index] .'"';
				$Iterms ='"'. $mutiIterms[$index].'"';
				$Where ='"'. $mutiWhere[$index].'"';
				
				//print "<br>note=[$Notes]";
				
				//print "<br>note=[$Notes]";
				 $Notes=$mutiNotes[$index];
				
				//skip no file selected
				$query="SELECT  * FROM `todolist` WHERE `id` =  $selectid ";
				//echo "<br>query=[$query]";
				$result= mysql_query($query) or die('Error, quere select id');
				$row = mysql_fetch_assoc($result);
				$oldNotes=$row[Notes];
			    
			    //modify means erase the old files which not needed and add the new files

			    $erasefiles=erasenotesoldfiles($oldNotes,$Notes);
			   // echo "[currentfiles,oldfiles]";print_r($currentfiles);print_r($oldfiles);
			    //append file :if fileselect,add anyway with timestamp unique don't care the exist filename confliction
				if($_FILES['AddFile'][name][0] !== ""){				
				list ($NoteAppendRefname,$numfiles)=UploadMultiFileGetLinkName('AddFile',$selectid);
				}
				$Notes=$Notes.$NoteAppendRefname; 
				//print "<br>before NoteProcess Notes=[$Notes]";
				$Notes =NoteProcess($Notes);
				//print "<br>after NoteProcess Notes=[$Notes]";
				//exit;
				try{$Price ='"'.$math->evaluate($mutiPrice[$index]).'"';}
				catch (Exception $e){
					echo '<br>Price express error:=> '.  "$mutiPrice[$index]". "<br>"; 
					$Price ='"'. "0".'"';
					}
				
				$Projectid ='"'. $mutiProjectid[$index] .'"';
				//echo "Projectid=[$Projectid]";
				//print_r($mutiProjectid);
				if($Delay === '"'. '1' .'"' ){ $Date ='SUBDATE(CURRENT_DATE(), 10)';}
				else{$Date ='"'. $mutiDate[$index] .'"';}
				//echo "Date=[$Date]";
				//CURRENT_DATE()
				//$Date ='"'. '"';
				if($insert==1){$query="INSERT`todolist` SET `Projectid`=$Projectid,`Checkbox`=$Checkbox,`Flag`=$Flag,`Iterms`=$Iterms,`Where`=$Where,`Notes`=$Notes,`Price`=$Price,`Date`=$Date";}		
				//Delete record
				else if ($insert==-1){
					 $query="DELETE FROM `todolist` WHERE `id`  = $selectid ";
					 }
				else {$query="UPDATE `todolist` SET `Projectid`=$Projectid, `Checkbox`=$Checkbox,`Flag`=$Flag,`Iterms`=$Iterms,`Where`=$Where,`Notes`=$Notes,`Price`=$Price,`Date`=$Date WHERE  id = $selectid ";		}
				//echo "<br>record $index>query=[$query]"; 
					mysql_query($query) or die('Error, update select id');
				//	echo "=>ok";
					$index++;
			}
			//exit;
	return($mutiid);
}

function update_modify_with_file()
{
	
		mysql_select_db($dbname);
	   $mutiCheckbox =  $_POST['mutiCheckbox'] ;
				$mutiFlag =$_POST['mutiFlag'] ;
				$mutiIterms =$_POST['mutiIterms'] ;
				$mutiWhere = $_POST['mutiWhere'];
				$mutiNotes = $_POST['mutiNotes'];
				$mutiPrice = $_POST['mutiPrice'];
				//$Date ='CURRENT_DATE()';//CURRENT_DATE()
				$mutiDate =$_POST['mutiDate'];
	      $mutiid= $_POST['mutiid'];
	      $mutiProjectid= $_POST['Projectid'];
	      if(sizeof($mutiid)<1) return;
//$colors = array(1, 2, 3, 4);
$index=0;
			foreach($mutiid as &$selectid){
            
				if(  sizeof($mutiCheckbox) >0 && in_array($selectid, $mutiCheckbox )) {$Checkbox = '"'. '1'.'"';}else {$Checkbox = '"'. '0'.'"';}
				//$Checkbox = '"'. $mutiCheckbox[$index].'"';
				if(  sizeof($mutiFlag) >0 && in_array($selectid,$mutiFlag)) {$Flag ='"'. '1' .'"';}else { $Flag ='"'. '0' .'"';}
				//$Flag ='"'. $mutiFlag[$index] .'"';
				$Iterms ='"'. $mutiIterms[$index].'"';
				$Where ='"'. $mutiWhere[$index].'"';
				//print "<br>note=[$Notes]";
				
				//print "<br>note=[$Notes]";
				 $Notes=$mutiNotes[$index];
				//skip no file selected
				if($_FILES[AddFile][name] !== ""){
				 $refnameLocal=UploadFileGetLinkName("AddFile",$selectid);
				 //print_r($_POST);
				 $NoteAppendRefname=$_POST['Notes'] . "(" .$refnameLocal .")";
				 $Notes = $Notes  . "(" .$refnameLocal .")";
				 }
				$Notes =NoteProcess($Notes);
	
				//print "<br>httpnote=[$Notes]";
				//exit;
				
				$Price ='"'. $mutiPrice[$index].'"';
				$Date ='"'. $mutiDate[$index] .'"';
				
				$Projectid ='"'. $mutiProjectid[$index] .'"';
				//CURRENT_DATE()
				//$Date ='"'. '"';
				if($insert==1){$query="INSERT`todolist` SET `Projectid`=$Projectid `Checkbox`=$Checkbox,`Flag`=$Flag,`Iterms`=$Iterms,`Where`=$Where,`Notes`=$Notes,`Price`=$Price,`Date`=$Date";}		
				//Delete record
				else if ($insert==-1){
					 $query="DELETE FROM `todolist` WHERE `id`  = $selectid ";
					 }
				else {$query="UPDATE `todolist` SET `Projectid`=$Projectid `Checkbox`=$Checkbox,`Flag`=$Flag,`Iterms`=$Iterms,`Where`=$Where,`Notes`=$Notes,`Price`=$Price,`Date`=$Date WHERE  id = $selectid ";		}
				echo "<br>record $index>query=[$query]"; 
					mysql_query($query) or die('Error, update select id');
				//	echo "=>ok";
					$index++;
			}
}

function update_modify_all($insert)
{
	
		mysql_select_db($dbname);
	//print_r($_POST);
	      $mutiCheckbox =  $_POST['mutiCheckbox'] ;
				$mutiFlag =$_POST['mutiFlag'] ;
				$mutiIterms =$_POST['mutiIterms'] ;
				$mutiWhere = $_POST['mutiWhere'];
				$mutiNotes = $_POST['mutiNotes'];
				$mutiPrice = $_POST['mutiPrice'];
				//$Date ='CURRENT_DATE()';//CURRENT_DATE()
				$mutiDate =$_POST['mutiDate'];
	      $mutiid= $_POST['mutiid'];
	      if(sizeof($mutiid)<1) return;
//$colors = array(1, 2, 3, 4);
$index=0;
			foreach($mutiid as &$selectid){
				//  print"$selectid";
							//echo "<br>insert `Checkbox`[$Checkbox], `Flag`[$Flag ], `Iterms`[$Iterms], `Where`[$Where], `Notes`[$Notes], `Date`[$Date]";
							
							//$query="INSERT INTO `todolist`(`Checkbox`, `Flag`, `Iterms`, `Where`, `Notes`, `Price`,`Date`) VALUES ($Checkbox, $Flag, $Iterms,$Where,$Notes, $Price,$Date);";
							//echo "<br>query=[$query]";
							//mysql_query($query) or die('Error, insert query failed1');
							
				if(  sizeof($mutiCheckbox) >0 && in_array($selectid, $mutiCheckbox )) {$Checkbox = '"'. '1'.'"';}else {$Checkbox = '"'. '0'.'"';}
				//$Checkbox = '"'. $mutiCheckbox[$index].'"';
				if(  sizeof($mutiFlag) >0 && in_array($selectid,$mutiFlag)) {$Flag ='"'. '1' .'"';}else { $Flag ='"'. '0' .'"';}
				//$Flag ='"'. $mutiFlag[$index] .'"';
				$Iterms ='"'. $mutiIterms[$index].'"';
				$Where ='"'. $mutiWhere[$index].'"';
				print "<br>note=[$Notes]";
				$Notes =NoteProcess($mutiNotes [$index]);
				print "<br>httpnote=[$Notes]";
				//exit;
				$Price ='"'. $mutiPrice[$index].'"';
				$Date ='"'. $mutiDate[$index] .'"';//CURRENT_DATE()		
				if($insert==1){$query="INSERT`todolist` SET `Checkbox`=$Checkbox,`Flag`=$Flag,`Iterms`=$Iterms,`Where`=$Where,`Notes`=$Notes,`Price`=$Price,`Date`=$Date";}		
				//Delete record
				else if ($insert==-1){
					 $query="DELETE FROM `todolist` WHERE `id`  = $selectid ";
					 }
				else {$query="UPDATE `todolist` SET `Checkbox`=$Checkbox,`Flag`=$Flag,`Iterms`=$Iterms,`Where`=$Where,`Notes`=$Notes,`Price`=$Price,`Date`=$Date WHERE  id = $selectid ";		}
				//echo "<br>record $index>query=[$query]"; 
					mysql_query($query) or die('Error, update select id');
				//	echo "=>ok";
					$index++;
			}
}

function fill_project_id()
{
	
		mysql_select_db($dbname);
	//print_r($_POST);
	      $mutiCheckbox =  $_POST['mutiCheckbox'] ;
				$mutiFlag =$_POST['mutiFlag'] ;
				$mutiIterms =$_POST['mutiIterms'] ;
				$mutiWhere = $_POST['mutiWhere'];
				$mutiNotes = $_POST['mutiNotes'];
				$mutiPrice = $_POST['mutiPrice'];
				//$Date ='CURRENT_DATE()';//CURRENT_DATE()
				$mutiDate =$_POST['mutiDate'];
				$mutiid= $_POST['mutiid'];
				$mutiProjectid=$_POST['mutiProjectid'];
				//print_r($_POST);
				if(sizeof($mutiid)<1) return;
				$index=0;
				foreach($mutiWhere as &$Where){
					if($Where=='Project') $Projectid=$mutiid[$index];
					else $notProjectid[]=$mutiid[$index];
					$index++;
				}		
//$colors = array(1, 2, 3, 4);
			$index=0;
			foreach($notProjectid as &$selectid){
		$query="UPDATE `todolist` SET  `Projectid`=$Projectid WHERE  id = $selectid ";		
				echo "<br>record $index>query=[$query]"; 
					mysql_query($query) or die('Error, update select id');
				//	echo "=>ok";
					$index++;
			}
			//exit;
			return($mutiid);
}
function delete_select_iterms_bak()
{
		if(sizeof($_POST)<2) return;
			mysql_select_db($dbname);
			//print_r($_POST);
			$updateiterms = $_POST['checkiterms'];
			//$colors = array(1, 2, 3, 4);
			foreach($updateiterms as &$selectid){
				//  print"$selectid";
				  $query="DELETE FROM `todolist` WHERE `id`  = $selectid ";
			echo "<br>query=[$query]";
			mysql_query($query) or die('Error, update select id');
			}
}




function sum_select_iterms()
{
	if(sizeof($_POST)<2) return;//none selected
mysql_select_db($dbname);

$updateiterms = $_POST['checkflag'];
//print_r($updateiterms );
//$colors = array(1, 2, 3, 4);
$sum=0;
		foreach($updateiterms as &$selectid){
			 //print"$selectid";
			  $query="SELECT  * FROM `todolist` WHERE `id` =  $selectid ";
		//echo "<br>query=[$query]";
		$result= mysql_query($query) or die('Error, quere select id');
		$row = mysql_fetch_assoc($result);
		//print_r($row); 
		$sum += $row[Price];
		
		//update
		$query="UPDATE `todolist` SET `Flag`=1 WHERE  id = $selectid ";
		mysql_query($query) or die('Error, update select id');

		//print"<br>Sum=[$sum]";
		}
print"<strong>Sum=[$sum]";
return ($sum);
}
function updateflagdb($setFlagValue)
{
	if(sizeof($_POST)<2) return;
	

mysql_select_db($dbname);

//print_r($_POST);
$updateiterms = $_POST['checkflag'];
//$colors = array(1, 2, 3, 4);
foreach($updateiterms as &$selectid){
	//  print"$selectid";
	  $query="UPDATE `todolist` SET `Flag`=$setFlagValue WHERE  id = $selectid ";

//echo "<br>query=[$query]";
mysql_query($query) or die('Error, update select id');
}
}
function Iterms_splite($string)
{
	
	$multi_iterms1=explode("，" ,$string);
	$multi_iterms2=explode("," ,$string);
	if(sizeof($multi_iterms1) > sizeof($multi_iterms2) )
		return $multi_iterms1;
	else  return $multi_iterms2;
	
	return $multi_iterms;
}

function additerms()
{


$math = new Math();


//print_r($_POST);
	$multi_iterms=Iterms_splite($_POST['Iterms']);
	$multi_prices=Iterms_splite($_POST['Price']);
	//print_r($multi_prices);

$Checkbox=0;$Flag =0;
				if($_POST['Checkbox'] === 'on') {$Checkbox = '"'. '1' .'"';}
				if($_POST['Flag'] === 'on') {$Flag = '"'. '1' .'"';}
				
				$Where ='"'. $_POST['Where'].'"';
							
				$Date ='"'. $_POST['Date'].'"';			
				if (isset($_GET['Projectid']))
				{
				 $projectid=$_GET['Projectid'];	
				 //print 	"projectid=[$projectid]"; 
				}
				else($projectid=-1);
				//$Date ='CURRENT_DATE()';//CURRENT_DATE()
    for($i=0;$i < sizeof($multi_iterms);$i++)
		//foreach($multi_iterms as &$piece_iterm)
		{
				$multi_iterms[$i]=str_replace('"','\"',$multi_iterms[$i]);
				$Iterms ='"'. $multi_iterms[$i] .'"';
				$Notes =NoteProcess($_POST['Notes']);
				//echo "<br>Note return =[$notes]";	
				//$answer = $math->evaluate($multi_prices[$i]);
				//echo "multi_prices[$i]=[$multi_prices[$i]] ";
				//$tmpstr="'".$multi_prices[$i] . "'";echo "tmpstr=[$tmpstr]";
				//$answer = $math->evaluate($multi_prices[$i]);echo "answer=[$answer]";
				//print "<br>i=[$i] multi_prices[$i]=[$multi_prices[$i]]";
				if($multi_prices[$i] !== '' && isset($multi_prices[$i])){
					//$Price ='"'.$math->evaluate($multi_prices[$i]).'"';
					try{$Price ='"'.$math->evaluate($multi_prices[$i]).'"';}
					catch (Exception $e){
					echo "<br>iterm[$multi_iterms[$i]]>Price express error:=> ".  "$multi_prices[$i]". "<br>"; 
					$Price ='"'. "0".'"';
					}
				}
				else{$Price ='"'.$multi_prices[$i].'"';}
				if($multi_prices[$i] > 0) {$Flag = '"'. '1' .'"';}
				//echo "<br>insert `Checkbox`[$Checkbox], `Flag`[$Flag ], `Iterms`[$Iterms], `Where`[$Where], `Notes`[$Notes], `Date`[$Date]";
				//$query="INSERT INTO `todolist`(`Checkbox`, `Flag`, `Iterms`, `Where`, `Notes`, `Price`,`Date`) VALUES ($Checkbox, $Flag, $Iterms,$Where,$Notes, $Price,$Date);";
				$query="INSERT INTO `todolist`(`Projectid`,`Checkbox`, `Flag`, `Iterms`, `Where`, `Notes`, `Price`,`Date`) VALUES ($projectid,$Checkbox, $Flag, $Iterms,$Where,$Notes, $Price,$Date);";
	           	//echo "<br>query=[$query]";
	           	mysql_query($query) or die('Error, insert query failed1');
	           $lastid=mysql_insert_id();
				
				if($Price != "" && $Price  != 0) {
					if($Price>=0)$Type='"spend"';
					else {$Type='"earn"';$Price*=-1;}
					
					$Where=str_replace('"', '', $Where);
					//print "Where=[$Where]";
					$tmpcategory= explode(' ',$Where);
					//print_r($tmpcategory);
					$category	='"'.trim($tmpcategory[0]).'"';
					
					
					$query="INSERT INTO `financial` 
					        (`Iterms`, `Price`,`Date`,	`Category`,`Type`,`associate_key`) 
					VALUES ($Iterms, $Price,$Date,$category,$Type,$lastid);";
				//echo "<br>query=[$query]";exit;
				mysql_query($query) or die('Error, insert INTO `financial query failed');
				}
				
			
			
				$query = "FLUSH PRIVILEGES";
				mysql_query($query) or die('Error, insert query failed 2');
				
				//$result=mysql_query($query) or die('Error, insert query failed 3');
				//print_r($result);				
		}
		echo "$i New Iterms added hi";
}

function add_one_iterm_multi_pic()
{
//print_r($_POST);
//print_r($_FILES['File']['tmp_name']);
$math = new Math();
//$files=$_FILES['File']['tmp_name']; 
//$multi_iterms=explode("," ,$_POST['Iterms']);
//$multi_prices=explode("," ,$_POST['Price']);
$Checkbox=0;$Flag =0;
				if($_POST['Checkbox'] === 'on') {$Checkbox = '"'. '1' .'"';}
				if($_POST['Flag'] === 'on') {$Flag = '"'. '1' .'"';}
				$Iterms='"'. $_POST['Iterms'].'"';
				$Where ='"'. $_POST['Where'].'"';
				$Date ='CURRENT_DATE()';//CURRENT_DATE()
				//$Price ='"'. $_POST['Price'].'"';
				try{$Price ='"'.$math->evaluate($_POST['Price']).'"';}
					catch (Exception $e){
					echo '<br>Price express error:=> '.  $_POST['Price']. "<br>"; 
					$Price ='"'. "0".'"';
					}
				if (isset($_GET['Projectid']))
				{
				 $projectid=$_GET['Projectid'];	
				 //print 	"projectid=[$projectid]"; 
				}
				else($projectid=-1);
				if($Price > 0) {$Flag = '"'. '1' .'"';}
				//echo "<br>insert `Checkbox`[$Checkbox], `Flag`[$Flag ], `Iterms`[$Iterms], `Where`[$Where], `Notes`[$Notes], `Date`[$Date]";
			   $query="INSERT INTO `todolist`(`Checkbox`, `Flag`, `Iterms`, `Where`, `Price`,`Date`) VALUES ($Checkbox, $Flag, $Iterms,$Where,$Price,$Date);";
				echo "<br>query=[$query]";
				mysql_query($query) or die('Error, insert query failed1');
			    
			    $lastid=mysql_insert_id();
			    //echo "<br>lastid==$lastid";
			    //$lastid='9999999';
			    $NoteOriginal=$_POST['Notes'];

		//show input file arrays 
         //mutiFileUpload('File');
   
		/*foreach($_FILES['File']['tmp_name'] as $key => $tmpName) {

		  $file_name = $_FILES['File']['name'][$key];
		  $file_type = $_FILES['File']['type'][$key];
		  $file_size = $_FILES['File']['size'][$key];
		  $file_tmp  = $_FILES['File']['tmp_name'][$key];
		  //$filename=$lastid.'_'.$key.time();
		  $filename=$lastid.'_'.$key;
		  $refnameLocal=UploadMultiFileGetLinkName('File',$key,$filename);
		 //$refnameLocal=UploadFileGetLinkName("$files[$i]",$filename);
                $NoteAppendRefname=$NoteAppendRefname . "(" .$refnameLocal .")" . ' ';
        }*/
        list ($NoteAppendRefname,$numfiles)=UploadMultiFileGetLinkName('File',$lastid);
                 $Notes=$NoteOriginal . $NoteAppendRefname;
               // echo "Notes=[$Notes]";
                $Notes =NoteProcess($Notes);
                echo "<hr></bh>Notes=[$Notes]";
                //exit;
				//$query="INSERT INTO `todolist`(`Projectid`,`Checkbox`, `Flag`, `Iterms`, `Where`,  `Price`,`Date`) VALUES ($projectid,$Checkbox, $Flag, $Iterms,$Where,$Price,$Date);";
				$query="UPDATE `todolist` SET `Notes`=$Notes WHERE  id = $lastid ";
					mysql_query($query) or die('Error, Update pic notes query failed1');
				$query="UPDATE `todolist` SET `Projectid`=$projectid WHERE  id = $lastid ";
				// echo "query=[$query]";   
				mysql_query($query) or die('Error, Update pic notes query failed1');
				$query = "FLUSH PRIVILEGES";
				mysql_query($query) or die('Error, insert query failed 2');
				
				//$result=mysql_query($query) or die('Error, insert query failed 3');
				//print_r($result);				
		
		echo "<br>1 New Iterms with [$numfiles] picture added ";
}

?>
