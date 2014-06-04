<?php
//echo "lgh";
//print_r($_GET);
$file=$_GET['f'];
//print ("file=[$file]  ");
if (!is_file($file)) { die("<b>404 File not found!</b>"); }
else if($file!=null){
	 //取得檔案資訊
   $len = filesize($file);
   $filename = basename($file);//FILENAME是下載下來的檔案名稱
   $file_extension = strtolower(substr(strrchr($filename,"."),1));//根據最後一個.取得副檔名
	
	
	//Header的開頭
   header("Pragma: public");
   header("Expires: 0");
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
   header("Cache-Control: public");
   header("Content-Description: File Transfer");
 
   //動態使用CTYPE
   $ctype="application/force-download";
   header("Content-Type: $ctype");
 
   //下載
   $header="Content-Disposition: attachment; filename=".$filename.";";
   header($header );
   header("Content-Transfer-Encoding: binary");
   header("Content-Length: ".$len);
   //ini_set('memory_limit','50M');使用 readfile 函數在做檔案下載處理時，遇到大檔案無法處理的問題。
   //ob_end_flush();
   
  	
	//$url="http://www.arno.tw/images/"; //頝臬?雿蔭
	$url="http://192.168.1.101:6001/"; //頝臬?雿蔭
	$num=date("Ymds");	
	readfile($url.str_replace("@","",$file));	
	exit(0);
}else{
}
?>