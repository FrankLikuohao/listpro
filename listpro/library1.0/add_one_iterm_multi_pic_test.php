<?php

$showadditerm=1;
if($showadditerm==1)
{
	echo '
		<br>Iterm added</br>
		<form method="post" enctype="multipart/form-data">
		<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr> 
		<td width="100">Checkbox</td>
		<td><input name="Checkbox" type="checkbox" id="Checkbox"></td>
		</tr>
		<tr> 
		<td width="100">Flag</td>
		<td><input name="Flag" type="checkbox" id="Flag"></td>
		</tr>
		<tr> 
		<td width="100">Iterms(a,b,c)</td>
		<td><input name="Iterms" type="text" id="Iterms"></td>
		</tr>
		<tr> 
		<td width="100">Where</td>
		<td><input name="Where" type="text" id="Where"></td>
		</tr>
		<tr> 
		<td width="100" >Notes</td>
		<td><textarea name="Notes"  rows="3" id="Notes"></textarea></td>
		</tr>
		<tr> 
		<td width="100">Price(a,b,c,)</td>
		<td><input name="Price" type="text" id="Price"></td>
		<td width="100">&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
		<tr> 
		<td width="100">&nbsp;</td>
		<td><input name="add1" type="submit" id="add" value="Add New iterms"></td>
		</tr>
		<tr> 
		<td width="100">&nbsp;</td>
		<td>   Choose File To Upload : <input type="file" name="File[]"  multiple  /> 
		   <input type="submit" value="size" name="sizetest">
		   
		   </td>
		</tr>
		</table>
		</form>	';
	}
	else{}
/*
function picMultiupload_name($picktag,$key,$destname)
{
	//$picktag="File1";
$UploadDir="AdditermData/";	
$dirfile=$UploadDir .$destname;
//print_r($_POST);
//print_r($_FILES);
$allowedExts = array("gif", "jpeg", "jpg", "png");
$filename=$_FILES[$picktag]["name"];
//echo "filename=[$filename]";
$temp = explode(".", $_FILES[$picktag]["name"][$keys]);
$extension = end($temp);
$size=$_FILES[$picktag]["size"][$key] / 1024;
printf (" Size: %d kB<br>",$size);

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
      echo "Stored in: " .$dirfile;
      
      return ( $dirfile);
      }
    }
}
function UploadMultiFileGetLinkName($picktag,$key,$lastid)
{
						$filename=$_FILES[$picktag]["name"][$key];
		
						echo "filename=[$filename]";
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
*/	     
require "library/Listprolib.php";
//require "library/ListproControl.php";
// echo "_POST[";print_r($_POST);
if(isset($_POST['add1']))
{
/*	
	$_POST=array
(
    Flag => 'on',
    Iterms => 'muli pic input', 
    Where => 'home',
    Notes => 'go and get http://stackoverflow.com/questions/1175347/how-can-i-select-and-upload-multiple-files-with-html-and-php-using-http-post 多檔上傳',
    Price => '9999',
    add => 'Add New iterms'
);
*/

		  $conn=opendb();
	      //echo "_POST[";print_r($_POST);
		  //echo "_FILES['File']['tmp_name'][";print_r($_FILES['File']['tmp_name']);;
		  //exit;
		  
		  if($_POST['Iterms'] !== "") {
			  if($filename=$_FILES['File']['tmp_name'][0] !== ""){add_one_iterm_multi_pic();}
			  //else{//addIterms();}
		  }
	    //reflash();
		  mysql_close($conn);
		 
}


function add_one_iterm_multi_pic()
{
//print_r($_POST);
//print_r($_FILES['File']['tmp_name']);

//$files=$_FILES['File']['tmp_name']; 
//$multi_iterms=explode("," ,$_POST['Iterms']);
//$multi_prices=explode("," ,$_POST['Price']);
$Checkbox=0;$Flag =0;
				if($_POST['Checkbox'] === 'on') {$Checkbox = '"'. '1' .'"';}
				if($_POST['Flag'] === 'on') {$Flag = '"'. '1' .'"';}
				$Iterms='"'. $_POST['Iterms'].'"';
				$Where ='"'. $_POST['Where'].'"';
				$Date ='CURRENT_DATE()';//CURRENT_DATE()
				$Price ='"'. $_POST['Price'].'"';
    
				if($Price > 0) {$Flag = '"'. '1' .'"';}
				//echo "<br>insert `Checkbox`[$Checkbox], `Flag`[$Flag ], `Iterms`[$Iterms], `Where`[$Where], `Notes`[$Notes], `Date`[$Date]";
				$query="INSERT INTO `todolist`(`Checkbox`, `Flag`, `Iterms`, `Where`, `Price`,`Date`) VALUES ($Checkbox, $Flag, $Iterms,$Where,$Price,$Date);";
				//echo "<br>query=[$query]";
				mysql_query($query) or die('Error, insert query failed1');
			    
			    $lastid=mysql_insert_id();
			    //echo "<br>lastid==$lastid";
			    //$lastid='9999999';
			    $NoteAppendRefname=$_POST['Notes'];

		//show input file arrays 
         //mutiFileUpload('File');
   
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
                //echo "Notes=[$NoteAppendRefname]";
                $Notes =NoteProcess($NoteAppendRefname);
                
                //exit;
   
				$query="UPDATE `todolist` SET `Notes`=$Notes WHERE  id = $lastid ";
				//echo "query=[$query]";
				   
				mysql_query($query) or die('Error, Update pic notes query failed1');
				$query = "FLUSH PRIVILEGES";
				mysql_query($query) or die('Error, insert query failed 2');
				
				//$result=mysql_query($query) or die('Error, insert query failed 3');
				//print_r($result);				
		
		echo "<br>1 New Iterms with [$key+1] picture added ";
}

	
?>
 
