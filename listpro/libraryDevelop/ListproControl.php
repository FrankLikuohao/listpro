<?php
//ListproControl.php
require_once 'libraryDevelop/ListproShowLib.php';
require_once 'libraryDevelop/ListproControlLib.php';
global $filterset;
global $initsearchkeyword;
global $Priceset; 
global $showrowbegin;
global $shownumlimit;
if (isset($_POST['Go']))
{   
	
	 // $filterset=getfilterset();
	
	$hostname=$_SERVER[HTTP_HOST];
	$program=trim($_SERVER[SCRIPT_NAME]);
    //$parameters="SelectId=".$row[id];
    //$link="href=http://$hostname/$program?$parameters";
    //$parameters="Projectid=".$row[id];
   // $projectlink="href=http://$hostname/$program?$parameters";
    if($_POST[Textfilter] !== " "){ $projectlink="http://$hostname/$program
     ?Textfilter=$_POST[Textfilter]
     &Checkboxfilter=2
     &Flagfilter=2
     &Pricefilter=0
     &Datefilter=6";}
     else{$projectlink="http://$hostname/$program
     ?Textfilter=$_POST[Textfilter]
     &Checkboxfilter=$_POST[Checkboxfilter]
     &Flagfilter=$_POST[Flagfilter]
     &Pricefilter=$_POST[Pricefilter]
     &Datefilter=$_POST[Datefilter]";}
	 header("Location: $projectlink");
	  //echo "initsearchkeyword=[$initsearchkeyword]";
	  //if ($initsearchkeyword === 1)
	  //{
			//$filterset[Checkboxfilter]='2';
			//$filterset[Datefilter] = '6';
	  //}
 
	  //if ($Priceset !== 0)$filterset[Checkboxfilter]='2';
		//echo "<br>initsearchkeyword=[$initsearchkeyword]";
	  //echo "<br>GO:filterset=";
	  //print_r($filterset);
	   //$conn=opendb();
	  //update_modify_with_file();
	  //update_modify_all(0);
	 // filter_show();
	  //$noreflash=1;
		//mysql_close($conn);
}

elseif (isset($_POST['>>']))
{   
	 $conn=opendb();
	  
	 $showrowbegin+=$shownumlimit;
	  mysql_close($conn);
		//mysql_close($conn);
}
elseif (isset($_POST['Modify']))
{   
	  //$conn=opendb();
	  print"<hr>enter Modify";
		modify_show($_POST['checkiterms']);
		//update_modify_all(0);
		$showadditerm=0;
		$noreflash=1;
		$savefilteset=$filterset;
		//mysql_close($conn);
}
elseif (isset($_POST['FillProject_id']))
{   
	  $conn=opendb();
	  
	 $idarray= fill_project_id();
	 //update_modify_with_file();
	  //update_modify_all(0);
	  //$filterset=$savefilteset;
		mysql_close($conn);
		
		finish_show($idarray);
		//update_modify_all(0);
		$showadditerm=0;
		$noreflash=1;
		$savefilteset=$filterset;
		
}elseif (isset($_POST['ShowPicture']))
{   
	  //echo "<br> get SelectId=$id";
	  //print_r($_POST);
	  $id=$_POST['ShowPicture'];
	  $_POST['checkiterms'][]=$id;
	  $_POST['ShowPicture']="yes";
	 modify_show($_POST['checkiterms']);
	  //update_modify_all(0);
		$showadditerm=0;
		$noreflash=1;
		$savefilteset=$filterset;
	 /*
	   
	$hostname=$_SERVER[HTTP_HOST];
	$program=trim($_SERVER[SCRIPT_NAME]);
    //$parameters="SelectId=".$row[id];
    //$link="href=http://$hostname/$program?$parameters";
    //$parameters="Projectid=".$row[id];
   // $projectlink="href=http://$hostname/$program?$parameters";
    
     $projectlink="http://$hostname/$program
     ?ShowPicture=$_POST[ShowPicture]";
     
	 header("Location: $projectlink");
	 
	  
	  
	  $conn=opendb();
	  //update_modify_with_file();
	 $idarray= update_modify_with_multi_file();
	  //update_modify_all(0);
	  //$filterset=$savefilteset;
		mysql_close($conn);
		
		finish_show($idarray);
		//update_modify_all(0);
		$showadditerm=0;
		$noreflash=1;
		$savefilteset=$filterset;
		*/
}
elseif (isset($_POST['Finish']))
{   
	  $conn=opendb();
	  //update_modify_with_file();
	 $idarray= update_modify_with_multi_file();
	  //update_modify_all(0);
	  //$filterset=$savefilteset;
		mysql_close($conn);
		
		finish_show($idarray);
		//update_modify_all(0);
		$showadditerm=0;
		$noreflash=1;
		$savefilteset=$filterset;
		
}
elseif (isset($_POST['Append']))
{   
	  $conn=opendb();
	   Append_modify_with_multi_file();
	  //update_modify_all(1);//1 insert 0 update -1 Delete
	  //reflash();
	  //echo "Append";
		mysql_close($conn);
		//$noreflash=1;
		$savefilteset=$filterset;
}
elseif (isset($_POST['Logout']))
{  
	 header("location:Logout.php");
}
/*elseif(isset($_POST['add']))
{
		  $conn=opendb();

	      //echo "_POST[";print_r($_POST);
		  //echo "_FILES['File']['tmp_name'][";print_r($_FILES['File']['tmp_name']);;
		  //exit;
		  
		  if($_POST['Iterms'] !== "") {
			  if($filename=$_FILES["File1"]["name"] !== ""){addIterms_pic(1);}
			  else{addIterms();}
		  }
	    //reflash();
		  mysql_close($conn);
		 
}*/
elseif(isset($_POST['add1']))
{
	if (count($_POST) > 0){ 
    if (checkFormSubmit()===true){ 
        //echo '表单提交成功'; 
        $conn=opendb();
	      //echo "_POST[";print_r($_POST);
		  //echo "_FILES['File']['tmp_name'][";print_r($_FILES['File']['tmp_name']);;
		  //exit;
		  
		  if($_POST['Iterms'] !== "") {
			  if($filename=$_FILES['File']['tmp_name'][0] !== ""){add_one_iterm_multi_pic();}
			  else{addIterms();}
		  }
	    //reflash();
		  mysql_close($conn);
    }else { 
        echo '表单重复提交'; 
    }
   } 
}

elseif(isset($_POST['UploadPicture']))
{
		
		   //<input type="submit" value="Upload..." name="UploadPicture"> 
		$tmpfilename=picupload();
		//echo"<br>Upload the filename=[$tmpfilename]";
		
		//$filename=tolinkaddressLocal($tmpfilename);
		//echo"<br>Upload Finish filename=[$filename]";
}
elseif(isset($_POST['checkBOM']))
{
		//<input type="submit" value="checkBOM" name="checkBOM">
		$UploadDir="AdditermData/";	
		$dirfile=$UploadDir .$_FILES["File1"]["name"];
		$result=checkBOM($dirfile);
		print "<br>$result";

}
/*elseif(isset($_POST['sizetest']))
{
		//print_r($_POST);
	$size=$_FILES["File1"]["size"] / 1024;
	printf (" Size: %d kB<br>",$size);
	//if($_POST['submitvalue'] === 'size' )
	$noreflash=1;
}
*/

elseif(isset($_POST['sizetest']))
{
	//print_r($_POST);
	$picktag='File';	
	foreach($_FILES[$picktag]['size'] as $key => $size){
	printf ("<br>%s(%d)kB",$_FILES[$picktag]['name'][$key] ,$size/1024);
	}
	$noreflash=0;
}
elseif (isset($_POST['update']))
{   
	  $conn=opendb();
		updatedb(1);
		//$noreflash=0;
		mysql_close($conn);
}
elseif (isset($_POST['SumSelect']))
{   
	  $conn=opendb();
		$sum=sum_select_iterms();
		//reflash();
		mysql_close($conn);
}
elseif (isset($_POST['UnCheck']))
{   
	  $conn=opendb();
		updatedb(0);
		//reflash();
		mysql_close($conn);
}
elseif (isset($_POST['UnFlag']))
{   
	  $conn=opendb();
		updateflagdb(0);
		//reflash();
		mysql_close($conn);
}
elseif (isset($_POST['Delete']))
{   
	  $conn=opendb();
		delete_select_iterms_show();
		//reflash();
		mysql_close($conn);
		$noreflash=1;
		$showadditerm=0;
}
elseif (isset($_POST['DeleteYes']))
{   
	  $conn=opendb();
	  
		 Delete_Yes();
		//reflash();
		mysql_close($conn);
}
elseif (isset($_POST['No']))
{   
}


elseif (isset($_POST['ShowThisMonth']))
{   
	$noreflash=1;
	echo "<strong>Wait to do";
	//  $conn=opendb();

		 /*

Select * From todolist  Where DATE_SUB(CURDATE(), INTERVAL 7 DAY ) <= date(Date);

Select * From todolist  Where DATE_SUB(CURDATE(), INTERVAL 1 MONTH ) <= date(Date);
 */
     //$query = "Select * From todolist  Where DATE_SUB(CURDATE(), INTERVAL 1 MONTH ) <= date(Date) ORDER BY  `id` DESC   ";
     /* $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <1 and DATEDIFF(date(Date),CURDATE()) > -31 ORDER BY  `Date` DESC   ";
		 	//	 $query = "SELECT * FROM `todolist` ORDER BY  `id` DESC LIMIT 0, 150   ";
		  //echo "<br>query=[$query]";
		  $result=mysql_query($query) or die('Error, insert query failed 3'); 
		  $array=mysql_fetch_show_last($result,3);
		  $noreflash=1;
		mysql_close($conn);

*/
}
elseif (isset($_POST['ShowToday']))
{   
	 // echo"in ShowLastday";exit;
	  $conn=opendb();
      //$query = "Select * From todolist  Where DATE_SUB(CURDATE(), INTERVAL 1 DAY ) <= date(Date) ORDER BY  `id` DESC   ";
      $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) = 0  ORDER BY  `Date` DESC   ";
	  $result=mysql_query($query) or die('Error, select query failed 3'); 
		  $array=mysql_fetch_show_last($result,3);
		  $noreflash=1;
		mysql_close($conn);
}
elseif (isset($_POST['ShowLastDay']))
{   
	  //echo"in ShowLastday";exit;
	  $conn=opendb();
      //$query = "Select * From todolist  Where DATE_SUB(CURDATE(), INTERVAL 1 DAY ) <= date(Date) ORDER BY  `id` DESC   ";
      $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) = -1 ORDER BY  `Date` DESC   ";
	  $result=mysql_query($query) or die('Error, insert query failed 3'); 
		  $array=mysql_fetch_show_last($result,3);
		  $noreflash=1;
		mysql_close($conn);
}
elseif (isset($_POST['ShowLastWeek']))
{   
	  $conn=opendb();
      $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <= 0 and DATEDIFF(date(Date),CURDATE()) >= -7 ORDER BY  `Date` DESC   ";
		 	//	 $query = "SELECT * FROM `todolist` ORDER BY  `id` DESC LIMIT 0, 150   ";
		  //echo "<br>query=[$query]";
		  $result=mysql_query($query) or die('Error, insert query failed 3'); 
		  $array=mysql_fetch_show_last($result,3);
		  $noreflash=1;
		mysql_close($conn);
}
elseif (isset($_POST['ShowLastMonth']))
{   
	  $conn=opendb();

	    $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <=0 and DATEDIFF(date(Date),CURDATE()) >= -31 ORDER BY  `Date` DESC   ";
		 	//	 $query = "SELECT * FROM `todolist` ORDER BY  `id` DESC LIMIT 0, 150   ";
		  //echo "<br>query=[$query]";
		  $result=mysql_query($query) or die('Error, insert query failed 3'); 
		  $array=mysql_fetch_show_last($result,3);
		  $noreflash=1;
		mysql_close($conn);
}
elseif (isset($_POST['Searchbottom']))
{   
	  $conn=opendb();
		 $query = "SELECT * FROM `todolist` LIMIT 0, 300 ";
		  //echo "<br>query=[$query]";
		  $result=mysql_query($query) or die('Error, insert query failed 3'); 
		  $array=mysql_fetch_all_filter_show($result,3);
		mysql_close($conn);
		 $noreflash=1;
}
elseif (isset($_GET['SelectId']))
{   
	   //http://192.168.1.101:6001/Listprodevelop.php?SelectId=777
	  //echo "<br> get SelectId=$id";
	  //print_r($_POST);
	  $id=$_GET['SelectId'];
	  $_POST['checkiterms'][]=$id;
	  $_POST['Modify']="yes";
	 modify_show($_POST['checkiterms']);
	  //update_modify_all(0);
		$showadditerm=0;
		$noreflash=1;
		$savefilteset=$filterset;
	 
	 
}
elseif (isset($_POST['reflash']))
{   
	 reflashall(); $noreflash=1;
}
else
{}
//$sql = "SELECT * FROM `todolist` WHERE `Checkbox` = 1 LIMIT 0, 30 ";
//$sql = "SELECT * FROM `todolist` LIMIT 0, 30 ";
//$sql = "INSERT INTO `listpro`.`todolist` (`Checkbox`, `Flag`, `Iterms`, `Where`, `Notes`, `Date`) VALUES (\'0\', \'1\', \'®³¦çªA\', \'°ªº¸¤Ò\', \'·Ç³ÆÀ³¸Õ\', CURRENT_DATE());";
if($noreflash==1){$noreflash=0;}
else {
	//print_r($_GET);
	if(strpos($_GET[Textfilter],"tel:")!==false)SearchTelephonebook($_GET[Textfilter]);
	if(strpos($_GET[Textfilter],"report:")!==false)FinancialReport($_GET[Textfilter]);
	else reflashall();
}
?>
