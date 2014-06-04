<?php
//echo "lgh";
//print_r($_GET);
$file=$_GET['f'];
//print ("file=[$file]  ");
if($file!=null){
	 //取得檔案資訊
   $len = filesize($file);
   $filename = basename($file);//FILENAME是下載下來的檔案名稱
   $file_extension = strtolower(substr(strrchr($filename,"."),1));//根據最後一個.取得副檔名
	
	
	//Header的開頭
   //動態使用CTYPE
   $ctype="application/application";
   header("Content-Type: $ctype");
 
   //下載
   $header="Content-Disposition: attachment; filename=".$filename.";";

  	
	//$url="http://www.arno.tw/images/"; //頝臬?雿蔭
	$url="http://192.168.1.101:6001/"; //頝臬?雿蔭
	$num=date("Ymds");	
	readfile($url.str_replace("@","",$file));	
	exit(0);
}else{
}
?>