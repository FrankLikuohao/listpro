<?php
//'libraryDevelop/ListproShowLib.php'

function modify_show($updateiterms)
{
	//$program=$_SERVER[SCRIPT_NAME];//$program=stristr($program,'?',ture);
	//echo "<br><a href=$program >Back</a></br>";
  //$updateiterms = $_POST['checkiterms'];
 //table_html_head();
 $conn=opendb();
 
 echo '<form class=modify_form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">';
 $pos = strpos($ipfrom,'192.168');
  if ($pos === false) {echo '<table  width="610" height="50" border="1">';}
  else {echo '<table  width="850" height="50" border="1">';}
    echo   "<tr>";
    echo   "<th width='40' >Check</th>";
    echo   "<th width='30' >Flag</th>";
    echo   "<th width='109'>Iterms</th>";
    echo   "<th width='72' >Where</th>";
    echo   "<th width='276'>Notes</th>";
    echo   "<th width='40' >Price</th>";
    echo   "<th width='58' >Date</th>";
     echo   "<th width='40' >id</th>";
      echo   "<th width='39'>Delay</th>";
      echo   "<th width='39'>Projectid</th>";
    echo '</tr>';
 

 //enctype="multipart/form-data"
 if(sizeof($updateiterms)>=1){//none selected
		  mysql_select_db($dbname);
		  //$updateiterms = $_POST['checkiterms'];
		//print_r($updateiterms );
		//$colors = array(1, 2, 3, 4);
		$sum=0;
	foreach($updateiterms as &$selectid){
		 //print"$selectid";
		$query="SELECT  * FROM `todolist` WHERE `id` =  $selectid ";
		//echo "<br>query=[$query]";
		$result= mysql_query($query) or die('Error, quere select id');
		$row = mysql_fetch_assoc($result);
	   // print_r($row);
		//print " <tr>";
		//print "</label></th>";
		print "
			<tr>";
		if($row[Checkbox]== 1) 
		{  print "<th  ><input class=modify_iterm name='mutiCheckbox[]'' type='checkbox' id='1_0' value=$row[id] checked='checked'"; }
				  else       {  print "<th ><input class=modify_iterm name='mutiCheckbox[]' type='checkbox' id='1_0' value=$row[id]"; }  
		print " /></th>";
		  
		if($row[Flag]== 1) {  print "<th  ><input name='mutiFlag[]' type='checkbox' id='1_0' value=$row[id] checked='checked'"; }
				   else       {  print "<th ><input name='mutiFlag[]' type='checkbox' id='1_0' value=$row[id]"; }  
		print " /></th>";
		  
		   // if($row[Checkbox]== 1) {  print "<th width='23' height='15' scope='col'><input name='mutiCheckbox[]' type='checkbox' id='1_0'  value=$row[id] checked= 'checked'</th>"; }
			//       else     {  print "<th width='23' height='15' scope='col'><input name='mutiCheckbox[]' type='checkbox' id='1_0' value=$row[id]  </th>"; }  
		   // if($row[Flag] == 1) {  print "<th width='23' height='15' scope='col'><input name='mutiFlag[]' type='checkbox' id='1_1' checked= 'checked' value=$row[id]</th>"; }
		   //        else     {  print "<th width='23' height='15' scope='col'><input name='mutiFlag[]' type='checkbox' id='1_1' value=$row[id] </th>"; }   
			//echo "<th width='23' scope='col'><input name='mutiCheckbox[]' type='text' id='Iterms' value=\"$row[Checkbox]\"></th>";
			//echo "<th width='23' scope='col'><input name='mutiFlag[]' type='text' id='Iterms' value=\"$row[Flag]\"></th>";
			echo   "<th ><input class=modify_iterm name='mutiIterms[]' type='text' id='Iterms' value=\"$row[Iterms]\"></th>";
			echo   "<th ><input class=modify_iterm name='mutiWhere[]' type='text' id='Iterms' value=\"$row[Where]\"></th>";
			//<textarea name="Notes"  rows="3" id="Notes"></textarea>
			echo   "<th  ><textarea class=modify_iterm name='mutiNotes[]' rows='10' type='text' id='Iterms'>$row[Notes]</textarea></th>";
			echo   "<th  ><input class=modify_iterm name='mutiPrice[]' type='text' id='Iterms' value=\"$row[Price]\"></th>";
			//Modify as show record date be today
			//$today = date("Y-m-d");
			echo   "<th  ><input class='datepicker' name='mutiDate[]' type='text'  value=\"$row[Date] \"></th>";
			echo   "<th width='20'><input class=modify_iterm name='mutiid[]' type='text' id='id' value=$row[id] readonly='readonly'/></th>";   
			// put some iterms behided a month for non-imergcy or not show, use show all for uncheck  will show up`, modify will update the date
			print "<th ><input name='mutidelay[]' type='checkbox' id='1_0' value=$row[id] /></th>";
			echo   "<th  ><input name='mutiProjectid[]' type='text' id='Projectid' value=\"$row[Projectid]\"></th>";
			echo '</tr>';
		  
		   } 
  } 
//   echo " </form>";
//   echo '
 //       <br>Iterm Modify</br>
//		<form method="post" enctype="multipart/form-data">';

  echo " </table>";	
  echo ' <input name="Finish" type="submit" id="Finish" value="Finish">';
  echo ' <input name="Append" type="submit" id="Append" value="AppendRecord">';
  echo ' AddFile<input type="file" multiple name="AddFile[]"  >';
  //$checkiterms[]=$selectid;
  echo '<input name="FillProject_id" type="submit" id="FillProject_id" value="Fill_Projectid">';
  $hostname=$_SERVER[HTTP_HOST];
  $program=trim($_SERVER[SCRIPT_NAME]);$id=$_GET['SelectId'];
  //<a href="http://xuite.net"
  // onclick="window.open(this.href, '', 'width=500,height=500'); return false;" >Click</a>
  //$para="'http://www.pageresource.com/jscript/jex5.htm','mywindow','width=400,height=200'";
  $projectlink="http://$hostname/$program?ShowPicture=yes&SelectId=$id";
  //$para="'"."$projectlink"."'".",'mywindow','width=400,height=200'";
 //echo '<INPUT type="button" value="New Window!" onClick="window.open('.$para.')"> ';
  $onclickstr="window.open(this.href, '', 'width=921,height=691'); return false;" ;
  echo "<a href=\"$projectlink\" onclick=\"$onclickstr\">ShowPicture</a>";
 
  //$winstr="<INPUT type='button' value='ShowPicture' onClick='window.open('.$projectlink.',mywindow,width=400,height=200)>'";;
  //echo "<INPUT type='button' value='New Window!' onClick='window.open( jex5.htm ,mywindow,width=400,height=200,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,scrollbars=yes,copyhistory=yes,resizable=yes')>";
  //echo "<INPUT type='button' value='ShowPicture' onClick='window.open('$projectlink',mywindow,width=400,height=200)>'";
//echo "<INPUT type='button' value='ShowPicture' onClick='window.open('http://192.168.1.101:6001//Listprodevelop.php?ShowPicture=yes&SelectId=110510',mywindow,width=400,height=200)>";
 //  echo '<input name="ShowPicture" type="submit" id="Delete" value="ShowPicture">';
  echo '<input name="Delete" type="submit" id="Delete" value="Delete">';
  
  echo " </form>";
  mysql_close($conn);
  $newnotes=str_replace("width=16 height=12","width=480 height=520 ",$row[Notes]);
   if(isset($_GET[ShowPicture]))
   {
	   
	    $newnotes=Produce_fancybox_tag($newnotes);
	    print "$newnotes";
  }
 //<img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_4_1384916167.jpg width=16 height=12 alt=5_b.jpg>
   //<a class="fancybox" rel="gallery1" href=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_0_1384916167.jpg width=16 height=12 alt=1_b.jpg><img src=http://192.168.1.101:6001/frank_lgh/2013-11/AdditermData/110509_0_1384916167.jpg width=16 height=12 alt=1_b.jpg></a>
  
   else print "$newnotes";
   /*echo 
  '<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
  <input type="file" name="AddFile" id="fileField" />
  <label for="fileField"></label>
  </form>';*/
  return $updateiterms;
}
function finish_show($updateiterms)
{
	//$program=$_SERVER[SCRIPT_NAME];//$program=stristr($program,'?',ture);
	//echo "<br><a href=$program >Back</a></br>";
  //$updateiterms = $_POST['checkiterms'];
 //table_html_head();
 $conn=opendb();
 
 echo '<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">';
 $pos = strpos($ipfrom,'192.168');
  if ($pos === false) {echo '<table width="610" height="50" border="1">';}
  else {echo '<table width="850" height="50" border="1">';}
    echo   "<tr>";
    echo   "<th width='40' >Check</th>";
    echo   "<th width='30' >Flag</th>";
    echo   "<th width='109'>Iterms</th>";
    echo   "<th width='72' >Where</th>";
    echo   "<th width='276'>Notes</th>";
    echo   "<th width='40' >Price</th>";
    echo   "<th width='58' >Date</th>";
     echo   "<th width='40' >id</th>";
      echo   "<th width='39'>Delay</th>";
      echo   "<th width='39'>Projectid</th>";
    echo '</tr>';
 

 //enctype="multipart/form-data"
 if(sizeof($updateiterms)>=1){//none selected
		  mysql_select_db($dbname);
		  //$updateiterms = $_POST['checkiterms'];
		//print_r($updateiterms );
		//$colors = array(1, 2, 3, 4);
		$sum=0;
	foreach($updateiterms as &$selectid){
		 //print"$selectid";
		$query="SELECT  * FROM `todolist` WHERE `id` =  $selectid ";
		//echo "<br>query=[$query]";
		$result= mysql_query($query) or die('Error, quere select id');
		$row = mysql_fetch_assoc($result);
	   // print_r($row);
		print " <tr>";
		print "</label></th>";
		print "
			<tr>";
		if($row[Checkbox]== 1) 
		{  print "<th  ><input name='mutiCheckbox[]' type='checkbox' id='1_0' value=$row[id] checked='checked'"; }
				  else       {  print "<th ><input name='mutiCheckbox[]' type='checkbox' id='1_0' value=$row[id]"; }  
		print " /></th>";
		  
		if($row[Flag]== 1) {  print "<th  ><input name='mutiFlag[]' type='checkbox' id='1_0' value=$row[id] checked='checked'"; }
				   else       {  print "<th ><input name='mutiFlag[]' type='checkbox' id='1_0' value=$row[id]"; }  
		print " /></th>";
		  
		   // if($row[Checkbox]== 1) {  print "<th width='23' height='15' scope='col'><input name='mutiCheckbox[]' type='checkbox' id='1_0'  value=$row[id] checked= 'checked'</th>"; }
			//       else     {  print "<th width='23' height='15' scope='col'><input name='mutiCheckbox[]' type='checkbox' id='1_0' value=$row[id]  </th>"; }  
		   // if($row[Flag] == 1) {  print "<th width='23' height='15' scope='col'><input name='mutiFlag[]' type='checkbox' id='1_1' checked= 'checked' value=$row[id]</th>"; }
		   //        else     {  print "<th width='23' height='15' scope='col'><input name='mutiFlag[]' type='checkbox' id='1_1' value=$row[id] </th>"; }   
			//echo "<th width='23' scope='col'><input name='mutiCheckbox[]' type='text' id='Iterms' value=\"$row[Checkbox]\"></th>";
			//echo "<th width='23' scope='col'><input name='mutiFlag[]' type='text' id='Iterms' value=\"$row[Flag]\"></th>";
			echo   "<th ><input name='mutiIterms[]' type='text' id='Iterms' value=\"$row[Iterms]\"></th>";
			echo   "<th ><input name='mutiWhere[]' type='text' id='Iterms' value=\"$row[Where]\"></th>";
			//<textarea name="Notes"  rows="3" id="Notes"></textarea>
			echo   "<th  ><textarea name='mutiNotes[]' rows='10' type='text' id='Iterms'>$row[Notes]</textarea></th>";
			echo   "<th  ><input name='mutiPrice[]' type='text' id='Iterms' value=\"$row[Price]\"></th>";
			//Modify as show record date be today
			//$today = date("Y-m-d");
			echo   "<th  ><input name='mutiDate[]' type='text' id='dateinput' value=\"$row[Date] \"></th>";
			echo   "<th width='20'><input name='mutiid[]' type='text' id='id' value=$row[id] readonly='readonly'/></th>";   
			// put some iterms behided a month for non-imergcy or not show, use show all for uncheck  will show up`, modify will update the date
			print "<th ><input name='mutidelay[]' type='checkbox' id='1_0' value=$row[id] /></th>";
			echo   "<th  ><input name='mutiProjectid[]' type='text' id='Projectid' value=\"$row[Projectid]\"></th>";
			echo '</tr>';
		  
		   } 
  } 
//   echo " </form>";
//   echo '
 //       <br>Iterm Modify</br>
//		<form method="post" enctype="multipart/form-data">';

  echo " </table>";	
  echo ' <input name="Finish" type="submit" id="Finish" value="Finish">';
  echo ' <input name="Append" type="submit" id="Append" value="AppendRecord">';
  echo ' AddFile<input type="file" multiple name="AddFile[]"  >';
  //$checkiterms[]=$selectid;
  echo '<input name="Delete" type="submit" id="Delete" value="Delete">';
  echo '<input name="ShowPicture" type="submit" id="Delete" value="ShowPicture">';
  echo " </form>";
  mysql_close($conn);
  $newnotes=str_replace("width=16 height=12","width=480 height=520",$row[Notes]);
  //print_r($_GET);
    
  print "<hr>";
  print "$newnotes";
   /*echo 
  '<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
  <input type="file" name="AddFile" id="fileField" />
  <label for="fileField"></label>
  </form>';*/
}
function FinancialReport($keywords) 
{

	global $filterset;
	$filterset= geturlparas();
	$keywords=$filterset['Textfilter'];
	//print_r($keywords);	
	$conn=opendb();
	
	global $useragent_HTC 	;	
	global $useragent_Android;
	//print_r($_GET);
	
		
	$query = "Select * From financial  Where 
	 (`Type` = 'income')";
    //$query = "Select * From financial where ";    
	echo "<br>query=[$query]";//exit;
	$res=mysql_query($query) or die('Error, query failed [$query ]');
		 //exit;
		 // mysql_fetch_all_filter_show($result);	 
		 //$total_expense=0;
		 $total_income=0;
	while($row=mysql_fetch_array($res)) {
		//print_r($row);
		//foreach($row as &$iterm){if($row!="")echo $iterm;}
		//printf("%s %s %s %s",$row[Name],$row[Phone 1 - Value],$row[Notes],$row[Address 1 - Formatted]);
		$price=$row['Price'];
		//echo "<hr>row['Price']=$price";
		printf("<br>id[%s] Iterms=[%s] Price:[%s] <br>Category[%s] Type[%s]  Date[%s] income sum up %d",
		$row['id'],
		$row['Iterms'],
		$row['Price'],
		$row['Category'],
		$row['Type'],
		$row['Date'],
		$total_income+=$price);				
	}	
	
	$query = "Select * From financial  Where 
	 (`Type` = 'expense')";
    //$query = "Select * From financial where ";    
	echo "<br>query=[$query]";//exit;
	$res=mysql_query($query) or die('Error, query failed [$query ]');
		 //exit;
		 // mysql_fetch_all_filter_show($result);	 
		 $total_expense=0;
		 //$total_income=0;
	while($row=mysql_fetch_array($res)) {
		//print_r($row);
		//foreach($row as &$iterm){if($row!="")echo $iterm;}
		//printf("%s %s %s %s",$row[Name],$row[Phone 1 - Value],$row[Notes],$row[Address 1 - Formatted]);
		$price=$row['Price'];
		//echo "<hr>row['Price']=$price";
		printf("<br>id[%s] Iterms=[%s] Price:[%s] <br>Category[%s] Type[%s]  Date[%s] expense sum up %d",
		$row['id'],
		$row['Iterms'],
		$row['Price'],
		$row['Category'],
		$row['Type'],
		$row['Date'],
		$total_expense+=$price);				
	}
	
	
	$leisure_money=$total_income-$total_expense;
	echo "<hr>leisure_money=[$leisure_money]";
	$checkmonth=preg_replace('/report:(.*)/i', 
					'${1}', $keywords);
	echo "keyword=[";print_r($checkmonth);				
	if($checkmonth <0 ){	
	$query = "Select * From financial  Where 
	( month(date(Date))-Month(NOW())= $checkmonth)
	and (`Type` != 'expense') and (`Type` != 'income')";
	}
				
	else $query = "Select * From financial  Where 
	(DATEDIFF(date(Date),CURDATE()) <=0  and DATEDIFF(date(Date),CURDATE()) >= -31 and  month(date(Date)) = Month(NOW()))
	and (`Type` != 'expense') and (`Type` != 'income')";
    //$query = "Select * From financial where ";    
	//echo "<br>query=[$query]";exit;
	$res=mysql_query($query) or die('Error, insert query failed 4');
		 //exit;
		 // mysql_fetch_all_filter_show($result);	 
		 $total_thismonth=0;
	while($row=mysql_fetch_array($res)) {
		//print_r($row);
		//foreach($row as &$iterm){if($row!="")echo $iterm;}
		//printf("%s %s %s %s",$row[Name],$row[Phone 1 - Value],$row[Notes],$row[Address 1 - Formatted]);
		$price=$row['Price'];
		//echo "<hr>row['Price']=$price";
		printf("<br>id[%s] Iterms=[%s] Price:[%s] <br>Category[%s] Type[%s]  Date[%s] sum up %d remain [%d]",
		$row['id'],
		$row['Iterms'],
		$row['Price'],
		$row['Category'],
		$row['Type'],
		$row['Date'],
		$total_thismonth+=$price,
		$remain=$leisure_money-$total_thismonth
		);				
	}	 
	mysql_close($conn);
}
function SearchTelephonebook($keywords)
{
	global $filterset;
	$filterset= geturlparas();
	$keywords=$filterset['Textfilter'];
	//print_r($keywords);	
	$conn=opendb();
	
	global $useragent_HTC 	;	
	global $useragent_Android;
	//print_r($_GET);
	$keywords=preg_replace('/tel:(.*)/i', 
					'${1}', $keywords);
	//echo "keyword=[";print_r($keywords);					
	
    $query = "Select * From telephone where";    
	
	
	$keywordary = explode(' ', $keywords);
	$index=0;
	//print_r($keywordary);
	foreach($keywordary as &$keyword) {
		$keys = trim($keyword);
		if($keys =='')continue;
		$index++;	
		if($index==1){
			$other=" (`Name` LIKE  '%$keys%' 
			OR  `Notes` LIKE  '%$keys%' 
			OR `Address 1 - Formatted` LIKE  '%$keys%' 
			OR `Phone 1 - Value` LIKE  '%$keys%') ";
		}
		else{
			$other =$other . " or (`Name` LIKE  '%$keys%' 
			OR  `Notes` LIKE  '%$keys%' 
			OR `Address 1 - Formatted` LIKE  '%$keys%' 
			OR `Phone 1 - Value` LIKE  '%$keys%') ";}
	}
	
	$query=$query . "$other";
	
	$query=$query . ' ORDER BY  `Name` DESC , `id` DESC ';	
	
	//echo "<br>query=[$query]";
	$res=mysql_query($query) or die('Error, insert query failed 4');
		 //exit;
		 // mysql_fetch_all_filter_show($result);	 
	while($row=mysql_fetch_array($res)) {
		//print_r($row);
		//foreach($row as &$iterm){if($row!="")echo $iterm;}
		//printf("%s %s %s %s",$row[Name],$row[Phone 1 - Value],$row[Notes],$row[Address 1 - Formatted]);
		echo "<hr>";
		printf("id[%s] Name=[%s] 
		<br>Tel:%s[%s] %s[%s] %s[%s]  %s[%s]  %s[%s]
		<br>Address:%s[%s] %s[%s] %s[%s]  
		<br>Notes=[%s]",
		$row[id],
		$row[Name],
		$row['Phone 1 - Type'],
		$row['Phone 1 - Value'],
		$row['Phone 2 - Type'],
		$row['Phone 2 - Value'],
		$row['Phone 3 - Type'],
		$row['Phone 3 - Value'],
		$row['Phone 4- Type'],
		$row['Phone 4 - Value'],
		$row['Phone 5 - Type'],
		$row['Phone 5 - Value'],
		
		$row['Address 1 - Type'],
		$row['Address 1 - Formatted'],
		$row['Address 2 - Type'],
		$row['Address 2 - Formatted'],
		$row['Address 3 - Type'],
		$row['Address 3 - Formatted'],
		
		$row[Notes]);
		
		
	}	 
	mysql_close($conn);
		
}
function reflashall()
{
		
	$conn=opendb();
	global $filterset;
	global $useragent_HTC 	;	
	global $useragent_Android;
	//print_r($_GET);
	$filterset= geturlparas();
    
	//print_r($filterset);
 //default lastweek and next day
 //if($filterset[Datefilter] === 'NextDay') 
  //	   { $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) = 1 "; }
	if($filterset[Datefilter] === '1')//Today 
	   { $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) = 0 "; }   
	elseif( $filterset[Datefilter] === '2')//Yesterday
	   //{  $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) = -1 ";}
	   {  $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <= 0 and DATEDIFF(date(Date),CURDATE()) >= -1 ";}
    elseif( $filterset[Datefilter] === '3')//next Week ,default last week and next day 
	  {$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <= 7 and DATEDIFF(date(Date),CURDATE()) > 0 ";}
    elseif( $filterset[Datefilter] === '4')//LastMonth
      {$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <=0 and DATEDIFF(date(Date),CURDATE()) >= -31  ";}
    elseif( $filterset[Datefilter] === '5')//ThisMonthMonth(NOW())
      {$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <=0  and DATEDIFF(date(Date),CURDATE()) >= -31 and  month(date(Date)) = Month(NOW())";}
    elseif( $filterset[Datefilter] === '6')//ALL
      {$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <=100000  and DATEDIFF(date(Date),CURDATE()) >= -100000 ";}
	else{$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <2   and DATEDIFF(date(Date),CURDATE()) > -7 ";}
      //and `Checkbox` = $filterset[Checkfilter] and `Flag`= $filterset[Flagfilter] ORDER BY  `Date` DESC 
	
	if($filterset[Checkboxfilter] === '1' || $filterset[Checkboxfilter]=== '0' ){
		$query=$query . " and `Checkbox` = $filterset[Checkboxfilter]  ";
		}
	if($filterset[Flagfilter] === '0' || $filterset[Flagfilter] === '1' ){$query=$query . "and `Flag` = $filterset[Flagfilter] ";}
	if($filterset[Pricefilter] !== '0' ){
		/*
		     <option value='2'" .$select[2] .">>100</option>
             <option value='3'" .$select[3] .">>500</option>
             <option value='3'" .$select[4] .">>1000</option>
             <option value='3'" .$select[5] .">>10000</option>
        */
		if($filterset[Pricefilter] === '1' ) $query=$query . "and `Price` > 0 ";
		if($filterset[Pricefilter] === '2' ) $query=$query . "and `Price` > 100 ";
		if($filterset[Pricefilter] === '3' ) $query=$query . "and `Price` > 500 ";
		if($filterset[Pricefilter] === '4' ) $query=$query . "and `Price` > 1000 ";
		if($filterset[Pricefilter] === '5' ) $query=$query . "and `Price` > 10000 ";
	}
	if (isset($_GET['Projectid']))
	{
			 $projectid=$_GET['Projectid'];
			 $query=$query . ' AND  `Projectid` =  ' .$projectid ;
			 
	}
	$keywords=$filterset['Textfilter'];
	$keywordary = explode(' ', $keywords);
	$index=0;
	//print_r($keywordary);
	foreach($keywordary as &$keyword) {
		$index++;	
		$keys = trim($keyword);
		if($index==1){
			$other=" and (`Where` LIKE  '%$keys%' OR  `Notes` LIKE  '%$keys%' OR `Iterms` LIKE  '%$keys%') ";
		}
		else{
			$other =$other . " and (`Where` LIKE  '%$keys%' OR  `Notes` LIKE  '%$keys%' OR `Iterms` LIKE  '%$keys%') ";
		}
	}
	
	$query=$query . "$other";
	
	$query=$query . ' ORDER BY  `Date` DESC , `id` DESC ';	

		
	//echo "<br>query=[$query]";
	
	
		  $result=mysql_query($query) or die('Error, insert query failed 4');
		 //exit;
		 // mysql_fetch_all_filter_show($result);	 
		 
       if($useragent_Android ==1)  mysql_fetch_all_filter_mobile_show($result);
		  else  {mysql_fetch_all_filter_show($result);	 }
		// mysql_fetch_all_show($result,1);
	mysql_close($conn);
	
}
function filter_show()
{
	global $initsearchkeyword;	
	$conn=opendb();
	global $filterset;
	//print_r($filterset);
 //default lastweek and next day
 //if($filterset[Datefilter] === 'NextDay') 
  //	   { $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) = 1 "; }
	if($filterset[Datefilter] === '1')//Today 
	   { $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) = 0 "; }   
	elseif( $filterset[Datefilter] === '2')//Yesterday
	   //{  $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) = -1 ";}
	   {  $query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <= 0 and DATEDIFF(date(Date),CURDATE()) >= -1 ";}
    elseif( $filterset[Datefilter] === '3')//next Week ,default last week and next day 
	  {$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <= 7 and DATEDIFF(date(Date),CURDATE()) > 0 ";}
    elseif( $filterset[Datefilter] === '4')//LastMonth
      {$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <=0 and DATEDIFF(date(Date),CURDATE()) >= -31  ";}
    elseif( $filterset[Datefilter] === '5')//ThisMonthMonth(NOW())
      {$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <=0  and DATEDIFF(date(Date),CURDATE()) >= -31 and  month(date(Date)) = Month(NOW())";}
    elseif( $filterset[Datefilter] === '6')//ALL
      {$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <=100000  and DATEDIFF(date(Date),CURDATE()) >= -100000 ";}
	else{$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <2   and DATEDIFF(date(Date),CURDATE()) > -7 ";}
      //and `Checkbox` = $filterset[Checkfilter] and `Flag`= $filterset[Flagfilter] ORDER BY  `Date` DESC 
	
	if($filterset[Checkboxfilter] === '1' || $filterset[Checkboxfilter]=== '0' ){
		$query=$query . " and `Checkbox` = $filterset[Checkboxfilter]  ";
		}
	if($filterset[Flagfilter] === '0' || $filterset[Flagfilter] === '1' ){$query=$query . "and `Flag` = $filterset[Flagfilter] ";}
	if($filterset[Pricefilter] !== '0' ){
		/*
		     <option value='2'" .$select[2] .">>100</option>
             <option value='3'" .$select[3] .">>500</option>
             <option value='3'" .$select[4] .">>1000</option>
             <option value='3'" .$select[5] .">>10000</option>
        */
		if($filterset[Pricefilter] === '1' ) $query=$query . "and `Price` > 0 ";
		if($filterset[Pricefilter] === '2' ) $query=$query . "and `Price` > 100 ";
		if($filterset[Pricefilter] === '3' ) $query=$query . "and `Price` > 500 ";
		if($filterset[Pricefilter] === '4' ) $query=$query . "and `Price` > 1000 ";
		if($filterset[Pricefilter] === '5' ) $query=$query . "and `Price` > 10000 ";
	}
	if (isset($_GET['Projectid']))
	{
			 $projectid=$_GET['Projectid'];
			 $query=$query . ' AND  `Projectid` =  ' .$projectid ;
		     $initsearchkeyword=0;
			 
	}
	$query=$query . ' ORDER BY  `Date` DESC , `id` DESC ';
	//echo "<br>query=[$query]";
	
		  $result=mysql_query($query) or die('Error, insert query failed 4');
		 //exit;
		 // mysql_fetch_all_filter_show($result);	   
		 
		if($useragent_Android ==1)  mysql_fetch_all_filter_mobile_show($result);
		 else{ mysql_fetch_all_filter_show($result);} 
		// mysql_fetch_all_show($result,1);
	mysql_close($conn);
	
}
function record_match_mult_str($row,$sentence)
{
	$word =explode(" ",$sentence);
	//echo "<br>record_match_mult_str:keywords="; print_r($word);
	//echo "<br>record_match_mult_str:row="; print_r($row);
	for($i=0;$i<sizeof($word);$i++){
		$string=$word[$i];$find[$i]='f';
		if($string === "") continue;
		  for($k=0;$k<sizeof($row);$k++){
		  	  //echo "look <$row[$k],$string>";	
			   $pos = stripos($row[$k],$string);//case-insensitive
		     if ($pos !== false) {$find[$i]='t';break;}
		  }
  }
  //echo "find[$]"; print_r($find);
  for($i=0;$i<sizeof($word);$i++){
  	if($find[$i]=== 'f'){return ('f');}
  }	  
  return('t');
}
function mysql_fetch_all_filter_mobile_show($res)
{
	$sum=0;
	global $totalrow;
    global $shownumlimit;
	global $ipfrom;
	
	//echo "<br>table_html_head:filterset=";
	//print_r($filterset);
	$filterset=geturlparas();
     //print"<br>return "; print_r($filterset);
     $string =$filterset['Textfilter'];
	$showrowbegin=$filterset['showrowbegin'];
    $totalrow= mysql_num_rows($res);
    echo "<br>showrowbegin=[$showrowbegin] shownumlimit=[$shownumlimit]  totalrow=[$totalrow]";
 
echo '<form id="form1" name="formSearch" method="post" enctype="multipart/form-data" action="">';

	 $pos = strpos($ipfrom,'192.168');
  if ($pos === false) {echo '<table width="850" height="100" border="1">';}
  else {echo '<table width="850" height="100" border="1">';}

echo '<table><tr><td class="input">';   
echo"<input name='Textfilter' type='text' size='30' id='textfilter' value='$filterse[Textfilter]'>";
	//		<input type="text" name="query" id="input-19" placeholder="&#x641C;&#x5C0B;&#x4FE1;&#x4EF6;"/>
for($i=0;$i<=7;$i++){
		if($i ==$filterset[Datefilter]) {$select[$i]="selected='selected'";}else {$select[$i]="";}
	}         
    echo   "<select name='Datefilter' id='111'>
             <option value='Default' " .$select[0] .">Default</option>
             <option value='1' " .$select[1] .">Today</option>
             <option value='2' " .$select[2] .">Lastday</option>
             <option value='3' " .$select[3] .">NextWeek</option>
             <option value='4' " .$select[4] .">LastMonth</option>
             <option value='5' " .$select[5] .">ThisMonth</option>
              <option value='6' " .$select[6] .">ALL</option>
            
             </select></th>";
echo'</td><td class="submit">';
echo"<input name='Go' type='submit' id='go' value='Search'>";
//		<input type="submit" class="submit" value="&#x641C;&#x5C0B;"/>
echo '    </td></tr></table>';

echo'<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">';
//if($string === "") return;

	if($totalrow != 0)mysql_data_seek($res, $showrowbegin);
	for($shownumber=0;
	$showrowbegin<$totalrow && $shownumber<= $shownumlimit;
	$showrowbegin++,$shownumber++)
	{
	//while($row=mysql_fetch_array($res)) {
		$row=mysql_fetch_array($res);
		$sum+=$row[Price];
		$row[Notes]=NotePresentChangeIP($row[Notes]);
		$daydiff=days_diff_today($row[Date]);
		if($daydiff >= 1) $color1= "bgcolor='#66CCFF'"; 
			else {$color1="";}
    
   //printf ("<br>mysql_fetch_all_filter_show:string=[%s]",$string);	
  /* if($string !== "" && $string !== " " ){
	$find=record_match_mult_str($row,$string);//echo "findflag=[$find]";   
	if ( $find === 'f') {continue;}
	}*/
	
    
    echo '<hr>
		  <table class="itemTable " >
          <tr>
          <td class="itcb">';
     
         // <input type="checkbox" name="msgids" value="Inbox;2_0_0_1_83952_AC7NexsAAArKUlPXpgAAAMSiTVw" id="checkbox-26"/>
   
      if($row[0]== 1) {  print "<input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id] checked= 'checked' />"; }
           else       {  print "<input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id] />"; } 
           //echo "<br>row[id]=$row[id]"; print_r($row[id]) ;exit;    
    echo  '</td>
		  <td class="itcont">
		  <div class="uip first">
          <table class="template two-column">
          <tr>
          <td>
		  <table class="template">
		  <tr>
		  <td width="550" class="title-cell">';
	print"<div class='uic first' style='font-size:50;'>";
	
   $hostname=$_SERVER[HTTP_HOST];$program=trim($_SERVER[SCRIPT_NAME]);
    $parameters="SelectId=".$row[id];
    $link="href=http://$hostname/$program?$parameters";//echo "link=[$link]";exit;
    $parameters="Projectid=".$row[id];
   // $projectlink="href=http://$hostname/$program?$parameters";
     $projectlink="href=http://$hostname/$program?Checkboxfilter=2&Flagfilter=2&Textfilter=&Pricefilter=0&Datefilter=6"."&".$parameters;

	echo 	"<strong><a $link>$row[Iterms]</a></strong> ";
		
	echo '</div>
		  </td>';
    //echo "<td> $row[Price] </td>";	
	if($row[Flag]== 1) {   print "<td  ><input name='checkflag[]' type='checkbox' id='1_0' value=$row[id] checked='checked' />"; }
				   else       {  print "<td ><input name='checkflag[]' type='checkbox' id='1_0' value=$row[id] />"; }  
	  
	echo '</td>
		  <td class="value-cell"><div class="uic first">';
			
	echo "			<span class='subtext small' style='font-family:verdana; font-size:20;'>$row[Date]</span> ";
	echo '		
			
		   </td>
		   </tr>
		   <tr>';
	echo	"   <td class='subtext-cell' colspan='2'" . $color1 .'>
				<div class="uic small first" style="font-size:30;" >';
				//	<a href="/w/ygo-mail/message.bp%3B_ylt=A0S02ErJpVRSmXgAmwVE9tw4?e=0&amp;f=Inbox&amp;m=2_0_0_1_83952_AC7NexsAAArKUlPXpgAAAMSiTVw&amp;n=10&amp;.ts=1381279178&amp;.intl=tw&amp;.lang=zh-hant-tw">
	echo "					 <strong>$row[Notes]</strong> ";
	echo '				 <br/>';
	if (strpos($row[Where],'Project') !==false){
		  echo "<span class='subtext small'><span class='subtext small'><a $projectlink>$row[Where]</span> ";
	
	}	  
	else echo "					 <span class='subtext small'>$row[Where]</span> ";
	echo '				</a>
				</div>
			</td>';
	echo   "<td width='20' scope='col'". $color1 . ">$row[id]</td>";
	if($row[Price] >0) {echo   "<td width='20' scope='col'". $color1 . ">NT\$$row[Price]</td>"; }
	
	echo  '</tr>
			</table>
			</td>
			</tr>
			</table>
			</div>
			</td>
			</tr>
			</table>';
 /*  
  
  <th width='23' align='center' valign='middle' scope='col'><label>";
       if($row[1] != 0) {print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] checked='CHECKED' />";}
               else     {print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] />";}
 */            
    
    // print "<br>$daydiff";
    // break;
    
 
    //echo   "<th width='100' scope='col'". $color1 . ">$row[Iterms]</th>";
   // echo   "<th width='90' scope='col'". $color1 . ">$row[Where]</th>";
    //echo   "<th width='180' scope='col'". $color1 . ">$row[Notes]</th>";
   // echo   "<th width='90' scope='col'". $color1 . ">$row[Price]</th>";
    //echo   "<th width='90' scope='col'". $color1 . ">$row[Date]</th>";
   // echo   "<th width='20' scope='col'". $color1 . ">$row[id]</th>";
    
   // echo '</tr>';
   
      
   }
    table_exec_bottom();
   
   //DELETE FROM `listpro`.`todolist` WHERE `todolist`.`id` = 1 LIMIT 1;
   echo "<strong>sum=[$sum]";
   return $return;
}

function mysql_fetch_all_filter_show($res)
{
	$sum=0;
	//global $filterset;
	//global $showrowbegin;
	global $totalrow;
    global $shownumlimit;
	
	
	//echo "<br>Search [$string] now  ....";
	table_html_head();	
    //if($string === "") return;
   $filterset=geturlparas();


     //print"<br>return "; print_r($filterset);
     $string =$filterset['Textfilter'];
	$showrowbegin=$filterset['showrowbegin'];
    $totalrow= mysql_num_rows($res);
       if(isset($_GET['shownumlimit']))$shownumlimit=$totalrow;
     //echo "<br>showrowbegin=[$showrowbegin] shownumlimit=[$shownumlimit]  totalrow=[$totalrow]";
    if($totalrow != 0)mysql_data_seek($res, $showrowbegin);
	for($shownumber=0;
	$showrowbegin<$totalrow && $shownumber<= $shownumlimit;
	$showrowbegin++,$shownumber++)
	{//while($row=mysql_fetch_array($res)) {
		$row=mysql_fetch_array($res);
	   //printf ("<br>mysql_fetch_all_filter_show:string=[%s]",$string);	
		/*if($string !== "" && $string !== " " ){
		$find=record_match_mult_str($row,$string);//echo "findflag=[$find]";   
		if ( $find === 'f') {continue;}
		}*/
		
		//if($shownumber>=$shownumlimit) break;
		
	   print "
		<tr>";
		  if($row[Checkbox]== 1) {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id] checked= 'checked'"; }
			   else       {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id]"; }  
	   print " /></th>
	  
	  <th width='23' align='center' valign='middle' scope='col'><label>";
		   if($row[Flag] != 0) {print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] checked='CHECKED' />";}
				   else     {print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] />";}
				 
		$sum+=$row[Price];
		table_html_tail($row);
   
      
   }
    table_exec_bottom();
   
   //DELETE FROM `listpro`.`todolist` WHERE `todolist`.`id` = 1 LIMIT 1;
   echo "<strong>sum=[$sum]";
   return $return;
}

function mysql_fetch_all_show($res,$filterno) {
	
	
	table_html_head();
  $sum=0;
	while($row=mysql_fetch_array($res)) {
	       $return[] = $row;
       //print_r($row);
  //echo $MakeHTML = "<br>$row[0], $row[1], $row[2],$row[3],$row[4],$row[5]";
	if($row[0]== 1 && $filterno ==1)continue;
	//if($row[1]== 1 && $filterno ==2)continue;
	print "
    <tr>";
      if($row[0]== 1) {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id] checked= 'checked'"; }
           else       {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id]"; }  
  print " /></th>
      <th width='23' align='center' valign='middle' scope='col'><label>";
       if($row[1] == 1) {
       	  $sum+=$row[Price];
       		print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] checked='CHECKED' />";
       		}
       else     {print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] />";}
   
      table_html_tail($row);
   }
   table_exec_bottom();
   
   //DELETE FROM `listpro`.`todolist` WHERE `todolist`.`id` = 1 LIMIT 1;
   print"<strong>total sum=[$sum]</strong>";
   return $return;
}
function mysql_fetch_show_last($res,$filterno) {
	
	
	table_html_head();
  $sum=0;
	while($row=mysql_fetch_array($res)) {
	       $return[] = $row;
       //print_r($row);
  //echo $MakeHTML = "<br>$row[0], $row[1], $row[2],$row[3],$row[4],$row[5]";
	if($row[0]== 1 && $filterno ==1)continue;
	//if($row[1]== 1 && $filterno ==2)continue;
	print "
    <tr>";
      if($row[0]== 1) {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id] checked= 'checked'"; }
           else       {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id]"; }  
  print " /></th>
      <th width='23' align='center' valign='middle' scope='col'><label>";
       if($row[1] == 1) {
       	  $sum+=$row[Price];
       		print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] checked='CHECKED' />";
       		}
       else     {print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] />";}
   
      table_html_tail($row);
   }
    echo '
    
   </table>
    </p>
    <input name="ShowToday" type="submit" id="update" value="ShowToday">
     <input name="ShowLastDay" type="submit" id="update" value="ShowLastDay">
    <input name="ShowLastWeek" type="submit" id="update" value="ShowLastWeek">
    <input name="ShowLastMonth" type="submit" id="Sum" value="ShowLastMonth">
     <input name="ShowThisMonth" type="submit" id="UnFlag" value="ShowThisMonth">
     <input name="SumSelect" type="submit" id="Sum" value="SumSelect">
     <input name="UnFlag" type="submit" id="UnFlag" value="UnFlag">
      <input name="Modify" type="submit" id="Modify" value="Modify">
     <input name="Delete" type="submit" id="Delete" value="Delete">
     <input name="reflash" type="submit" id="reflash" value="Reflash">   
   </form>';
   //DELETE FROM `listpro`.`todolist` WHERE `todolist`.`id` = 1 LIMIT 1;
   print"<strong>total sum=[$sum]</strong>";
   return $return;
}
function mysql_fetch_all_filter_showold($res)
{
	$string = $_POST['Search'];
	if($string === "") return;
	echo "<br>Search [$string] now  ....";
	table_html_head();	

	while($row=mysql_fetch_array($res)) {
	      // $return[] = $row;
       //print_r($row);
  //echo $MakeHTML = "<br>$row[0], $row[1], $row[2],$row[3],$row[4],$row[5]";
   $find=record_match_mult_str($row,$string);//echo "findflag=[$find]";
  if ( $find === 'f') {continue;}
	print "
    <tr>";
      if($row[0]== 1) {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id] checked= 'checked'"; }
           else       {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id]"; }  
  print " /></th>
  
  <th width='23' align='center' valign='middle' scope='col'><label>";
       if($row[1] != 0) {print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] checked='CHECKED' />";}
               else     {print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] />";}
             
              
    
     
    table_html_tail($row);
   
      
   }
    table_exec_bottom();
   
   //DELETE FROM `listpro`.`todolist` WHERE `todolist`.`id` = 1 LIMIT 1;
   return $return;
}

function table_html_head()
{
	global $ipfrom;
	global $filterset;
	//echo "<br>table_html_head:filterset=";
	//print_r($filterset);
	
	echo '<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">';

	 $pos = strpos($ipfrom,'192.168');
  if ($pos === false) {echo '<table width="610" height="50" border="1">';}
  else {echo '<table width="900" height="50" border="1" >';}
    echo   "<tr>";
    for($i=0;$i<=2;$i++){
		if($i ==$filterset[Checkboxfilter]) {$select[$i]="selected='selected'";}else {$select[$i]="";}
	}
    echo   "<th width='23' scope='col'>
           <select name='Checkboxfilter' type='text' id='checkboxfilter'>
             <option value='0' " .$select[0] .">0</option>
             <option value='1' " .$select[1] .">1</option>
             <option value='2' " .$select[2] .">BOTH</option></th>";
    for($i=0;$i<=2;$i++){
		if($i ==$filterset[Flagfilter]) {$select[$i]="selected='selected'";}else {$select[$i]="";}
	}
    echo   "<th width='23'  scope='col'>  
			 <select name='Flagfilter' type='text' id='flagfilter'>
             <option value='0'" .$select[0] .">0</option>
             <option value='1'" .$select[1] .">1</option>
             <option value='2'" .$select[2] .">BOTH</option></th>";
    echo   "<th width='125' scope='col'>Icon</th>";
    echo   "<th width='90' scope='col'>Lgh Google</th>";
    //echo   "<th width='209' scope='col'><input name='Textfilter' type='text' id='textfilter' value='$filterse[Textfilter] '></th>'";
    echo   "<th width='209' scope='col'><input name='Textfilter' type='text' id='textfilter' value=" . "'" . $filterset[Textfilter] . "'></th>";
    //echo   "<th width='209' scope='col'><input name='Textfilter' type='text' id='textfilter' value='李'></th>'";
    for($i=0;$i<=5;$i++){
		if($i ==$filterset[Pricefilter]) {$select[$i]="selected='selected'";}else {$select[$i]="";}
	}
    echo   "<th width='70' scope='col'>
             <select name='Pricefilter' type='text' id='pricefilter'>
             <option value='0'" .$select[0] .">ALL</option>
             <option value='1'" .$select[1] .">Not0</option>
             <option value='2'" .$select[2] .">>100</option>
             <option value='3'" .$select[3] .">>500</option>
             <option value='3'" .$select[4] .">>1000</option>
             <option value='3'" .$select[5] .">>10000</option>
             </select></th>";
    for($i=0;$i<=7;$i++){
		if($i ==$filterset[Datefilter]) {$select[$i]="selected='selected'";}else {$select[$i]="";}
	}         
    echo   "<th width='70' scope='col'>
             <select name='Datefilter' id='111'>
             <option value='Default' " .$select[0] .">Default</option>
             <option value='1' " .$select[1] .">Today</option>
             <option value='2' " .$select[2] .">Lastday</option>
             <option value='3' " .$select[3] .">NextWeek</option>
             <option value='4' " .$select[4] .">LastMonth</option>
             <option value='5' " .$select[5] .">ThisMonth</option>
              <option value='6' " .$select[6] .">ALL</option>
            
             </select></th>";
    echo   "<th width='20' scope='col'><input name='Go' type='submit' id='go' value='Go'></th>";
    echo   '</tr>';
    echo   "<tr>";
    echo   "<th width='23' scope='col'>Check</th>";
    echo   "<th width='23'  scope='col'>Flag</th>";
    echo   "<th width='125' scope='col'>Iterms</th>";
    echo   "<th width='90' scope='col'>Where</th>";
    echo   "<th width='209' scope='col'>Notes</th>";
    echo   "<th width='70' scope='col'>Price</th>";
    echo   "<th width='70' scope='col'>Date</th>";
     echo   "<th width='20' scope='col'>id</th>";
    echo '</tr>';
}	

function table_html_headold_nofilter()
{
	global $ipfrom;
	echo '<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">';
	/*if (!empty($_SERVER['HTTP_CLIENT_IP']))
    $ip=$_SERVER['HTTP_CLIENT_IP'];
else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
else
    $ip=$_SERVER['REMOTE_ADDR'];
 */
 //print "ip from =[$ip]<br>";
 
	 $pos = strpos($ipfrom,'192.168');
  if ($pos === false) {echo '<table width="610" height="50" border="1">';}
  else {echo '<table width="900" height="50" border="1">';}
   
    echo   "<tr>";
    echo   "<th width='23' scope='col'>Check</th>";
    echo   "<th width='23'  scope='col'>Flag</th>";
    echo   "<th width='125' scope='col'>Iterms</th>";
    echo   "<th width='90' scope='col'>Where</th>";
    echo   "<th width='209' scope='col'>Notes</th>";
    echo   "<th width='70' scope='col'>Price</th>";
    echo   "<th width='70' scope='col'>Date</th>";
    echo   "<th width='20' scope='col'>id</th>";
    echo '</tr>';
}	
	
 function table_html_tail($row)
{
	print "</label></th>";
    $row[Notes]=NotePresentChangeIP($row[Notes]);
     $daydiff=days_diff_today($row[Date]);
    // print "<br>$daydiff";
    // break;
    
    if($daydiff >= 1) $color1= "bgcolor='#66CCFF'"; 
    else {$color1="";}
   // echo   "<th width='100' scope='col'". $color1 . ">$row[Iterms]</th>";
    
    $hostname=$_SERVER[HTTP_HOST];$program=trim($_SERVER[SCRIPT_NAME]);
    $parameters="SelectId=".$row[id];
    $link="href=http://$hostname/$program?$parameters";//echo "link=[$link]";exit;
    //$link.=' onclick="window.open(this.href, _blank)';
    $parameters="Projectid=".$row[id];
   // $projectlink="href=http://$hostname/$program?$parameters";
     $projectlink="href=http://$hostname/$program?Checkboxfilter=2&Flagfilter=2&Textfilter=&Pricefilter=0&Datefilter=6"."&".$parameters;

     //http://192.168.1.101:6001/Listprodevelop.php?SelectId=777
    //print_r($_SERVER);
    //print"link=[$link]";
    //exit;
    echo   "<th width='100' scope='col'". $color1 . "><a $link>$row[Iterms]</a></th>";
    if (strpos($row[Where],'Project') !==false){
		  echo   "<th width='90' scope='col'". $color1 . "><a $projectlink>$row[Where]</th>";
		  }
    else 
    {echo   "<th width='90' scope='col'". $color1 . ">$row[Where]</th>";}
    //echo   "<th><textarea name='mutiNotes[]' rows='3' type='text' id='Iterms'". $color1 .">" .$row[Notes] ."</textarea></th>";
    echo   "<th align=left width='180' scope='col' hight='100' ". $color1 . ">$row[Notes]</th>";
    //echo   "<th width='180' scope='col' hight='100' ". $color1 . "style='overflow: hidden;'>$row[Notes]</th>";
    echo   "<th width='90' scope='col'". $color1 . ">$row[Price]</th>";
    echo   "<th width='90' scope='col'". $color1 . ">$row[Date]</th>";
    if (strpos($row[Where],'Project') !==false){
		echo   "<th width='20' scope='col'". $color1 . ">($row[id])</th>";}
    else {echo "<th width='20' scope='col'". $color1 . ">$row[id]</th>";}
    echo '</tr>';
}
function table_exec_bottom()
{
	
global $totalrow;
global $shownumlimit;
//global $showrowbegin;
$hostname=$_SERVER[HTTP_HOST];
$program=trim($_SERVER[SCRIPT_NAME]);
$filterset=geturlparas();
$showrowbegin=$filterset[showrowbegin];
 //     echo "<br>shownumlimit=[$shownumlimit] showrowbegin=[$showrowbegin] totalrow=[$totalrow]"; 
	 echo '
   
   </table>
    </p>
    <input name="update" type="submit" id="update" value="Done">
    <input name="SumSelect" type="submit" id="Sum" value="Sum">
     <input name="UnFlag" type="submit" id="UnFlag" value="UnFlag">
     <input name="reflash" type="submit" id="reflash" value="Reflash">
     <input name="Modify" type="submit" id="Modify" value="Modify">
     <input name="Delete" type="submit" id="Delete" value="Delete">
     <input name="UnCheck" type="submit" id="UnCheck" value="UnCheck">
      <input name="Logout" type="submit" id="Logout" value="Logout">';
   
  /* global  $totalrow;
global $shownumlimit;
global $showrowbegin;*/
//echo "<br>shownumlimit=[$shownumlimit]";;


   for($i=0;$i<$totalrow/$shownumlimit;$i++)
   {
	$begin=0+$i*$shownumlimit;
	 if($begin==$showrowbegin){echo "  <input name='<<' type='submit' id='<<' value=$showrowbegin" . '> ';};   
	    $projectlink="<a href=http://$hostname/$program?Textfilter=$filterset[Textfilter]&Checkboxfilter=$filterset[Checkboxfilter]&Flagfilter=$filterset[Flagfilter]&Pricefilter=$filterset[Pricefilter]&Datefilter=$filterset[Datefilter]&showrowbegin=$begin>$i</a>";
	 //header("Location: $projectlink");
	   echo "$projectlink "; 
	 if($begin==$showrowbegin){
		$end=$showrowbegin+$shownumlimit;
		if($end>$totalrow){$end=$totalrow;}
		echo "  <input name='<<' type='submit' id='<<' value=$end" . '> '; 
	}  
	}  
  $projectlink="<a href=http://$hostname/$program?Textfilter=$filterset[Textfilter]&Checkboxfilter=$filterset[Checkboxfilter]&Flagfilter=$filterset[Flagfilter]&Pricefilter=$filterset[Pricefilter]&Datefilter=$filterset[Datefilter]&showrowbegin=0&shownumlimit=$totalrow>ALL</a>";
  echo "$projectlink "; 
   echo '  </form>';
   

}
function delete_select_iterms_show()
{
		
		 if(isset($_POST['mutiCheckbox']))$updateiterms = $_POST['mutiCheckbox'];
		 else  $updateiterms = $_POST['checkiterms'];
		 //print_r($_POST);
		 //print"updateiterms=["; print_r($updateiterms);exit;//mutiCheckbox[]

  table_html_head();
 if(sizeof($updateiterms)<1) {
	 echo "No Iterm selected<br>";
	  echo ' <input name="DeleteYes" type="submit" id="DeleteYes" value="Delete Yes">';
	  echo ' <input name="DeleteNo" type="submit" id="DeleteNo" value="No">';
	  echo " </form>";
  return;
  }//none selected
  //$updateiterms = $_POST['checkflag'];

//$colors = array(1, 2, 3, 4);
$sum=0;
		foreach($updateiterms as &$selectid){
			 //print"<br>selecti=[$selectid]";
		$query="SELECT  * FROM `todolist` WHERE `id` = $selectid";
		//echo "<br>query=[$query]";
		$result= mysql_query($query) or die('Error, quere select id[$selectid] ');
		//print "<br>result=$result";
		$row = mysql_fetch_assoc($result);
    //print_r($row);
 print " <tr>";
    print "</label></th>";
    
    print "
    <tr>";
   print "<th width='23' height='15' scope='col'><input name='mutiCheckbox[]' type='checkbox' id='1_0' value=$row[id] checked='checked'"; 
   print " /></th>";
  
   print "<th width='23' height='15' scope='col'><input name='mutiFlag[]' type='checkbox' id='1_0' value=$row[id] checked='checked'"; 
    print " /></th>";
  
   // if($row[Checkbox]== 1) {  print "<th width='23' height='15' scope='col'><input name='mutiCheckbox[]' type='checkbox' id='1_0'  value=$row[id] checked= 'checked'</th>"; }
    //       else     {  print "<th width='23' height='15' scope='col'><input name='mutiCheckbox[]' type='checkbox' id='1_0' value=$row[id]  </th>"; }  
   // if($row[Flag] == 1) {  print "<th width='23' height='15' scope='col'><input name='mutiFlag[]' type='checkbox' id='1_1' checked= 'checked' value=$row[id]</th>"; }
   //        else     {  print "<th width='23' height='15' scope='col'><input name='mutiFlag[]' type='checkbox' id='1_1' value=$row[id] </th>"; }   
    //echo "<th width='23' scope='col'><input name='mutiCheckbox[]' type='text' id='Iterms' value=\"$row[Checkbox]\"></th>";
    //echo "<th width='23' scope='col'><input name='mutiFlag[]' type='text' id='Iterms' value=\"$row[Flag]\"></th>";
    echo   "<th width='100' scope='col'>$row[Iterms]</th>";
    echo   "<th width='90' scope='col'>$row[Where]</th>";
    //<textarea name="Notes"  rows="3" id="Notes"></textarea>
    echo   "<th width='180' scope='col'><textarea name='mutiNotes[]' rows='1' type='text' id='Iterms'>$row[Notes]</textarea></th>"; 
    echo   "<th width='90' scope='col'>$row[Price]</th>";
    echo   "<th width='90' scope='col'>$row[Date]</th>";
    echo   "<th width='20' scope='col'><input name='mutiid[]' type='text' id='id' value=$row[id] readonly='readonly'/></th>";    
    echo '</tr>';
   
   
   }  
  echo ' <input name="DeleteYes" type="submit" id="DeleteYes" value="Delete Yes">';
  echo ' <input name="DeleteNo" type="submit" id="DeleteNo" value="No">';
  echo " </form>";
}

?>
