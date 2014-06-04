<?php
function mysql_fetch_all_filter_mobile_show($res)
{
	$sum=0;
	global $filterset;
	//echo "<br>mysql_fetch_all_filter_show:filterset";
	//print_r($filterset);
	$string =$filterset['Textfilter'];
	//$string = "";
	
	//echo "<br>Search [$string] now  ....";
	global $ipfrom;
	global $filterset;
	//echo "<br>table_html_head:filterset=";
	//print_r($filterset);
	
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
	while($row=mysql_fetch_array($res)) {
		$sum+=$row[Price];
		$row[Notes]=NotePresentChangeIP($row[Notes]);
		$daydiff=days_diff_today($row[Date]);
		if($daydiff >= 1) $color1= "bgcolor='#66CCFF'"; 
			else {$color1="";}
    
   //printf ("<br>mysql_fetch_all_filter_show:string=[%s]",$string);	
   if($string !== "" && $string !== " " ){
	$find=record_match_mult_str($row,$string);//echo "findflag=[$find]";   
	if ( $find === 'f') {continue;}
	}
	
    
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
	$hostname=$_SERVER[HTTP_HOST];$program=$_SERVER[SCRIPT_NAME];
    $parameters="SelectId=".$row[id];
    $link="href=http://$hostname/$program?$parameters";

   // echo   "<th width='100' scope='col'". $color1 . "><a $link>$row[Iterms]</a></th>";
  
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
	echo "					 <span class='subtext small'>$row[Where]</span> ";
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


function reflashall()
{
	global $useragent_HTC 	;	
	$conn=opendb();
	global $filterset;
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
	$query=$query . ' ORDER BY  `Date` DESC , `id` DESC ';
	
	
		  $result=mysql_query($query) or die('Error, insert query failed 4');
		 //exit;
		  	  if($useragent_HTC === 1) {mysql_fetch_all_filter_mobile_show($result);  }
		  else{mysql_fetch_all_filter_show($result);	 }
 
		    
		// mysql_fetch_all_show($result,1);
	mysql_close($conn);
	
}
function record_match_mult_str($row,$sentence)
{
	$word =explode(" ",$sentence);
	//echo "<br>record_match_mult_str:keywords="; print_r($word);
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
function modify_show($updateiterms)
{
	$program=$_SERVER[SCRIPT_NAME];//$program=stristr($program,'?',ture);
	echo "<br><a href=$program >Back</a></br>";
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
		//if($row[Checkbox]== 1) 
		{  print "<th  ><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id] checked='checked'"; }
				  // else       {  print "<th ><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id]"; }  
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
  echo " </form>";
  mysql_close($conn);
  $newnotes=str_replace("width=16 height=12","width=480 height=520",$row[Notes]);
  print "$newnotes";
   /*echo 
  '<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
  <input type="file" name="AddFile" id="fileField" />
  <label for="fileField"></label>
  </form>';*/
}
function modify_show_old()
{
 	$program=$_SERVER[SCRIPT_NAME];
	echo "<br><a href=$program >Back</a></br>";
	
	$updateiterms = $_POST['checkiterms'];
 //print_r($_POST);exit;
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
    echo '</tr>';
 

 //enctype="multipart/form-data"
 if(sizeof($updateiterms)>=1){//none selected
		  mysql_select_db($dbname);
		  //$updateiterms = $_POST['checkflag'];
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
		if($row[Checkbox]== 1) {  print "<th  ><input name='mutiCheckbox[]' type='checkbox' id='1_0' value=$row[id] checked='checked'"; }
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
			echo   "<th  ><textarea name='mutiNotes[]' rows='3' type='text' id='Iterms'>$row[Notes]</textarea></th>";
			echo   "<th  ><input name='mutiPrice[]' type='text' id='Iterms' value=\"$row[Price]\"></th>";
			//Modify as show record date be today
			//$today = date("Y-m-d");
			echo   "<th  ><input name='mutiDate[]' type='text' id='Iterms' value=\"$row[Date] \"></th>";
		  //echo   "<th width='90' scope='col'><input name='mutiDate[]' type='text' id='Iterms' value=\"$row[Date]\"></th>";
			echo   "<th ><input name='mutiid[]' type='text' id='id' value=$row[id] readonly='readonly'/></th>";   
			// put some iterms behided a month for non-imergcy or not show, use show all for uncheck  will show up`, modify will update the date
			print "<th ><input name='mutidelay[]' type='checkbox' id='1_0' value=$row[id] /></th>";
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
  echo " </form>";
  mysql_close($conn);
  
  /*echo 
  '<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
  <input type="file" name="AddFile" id="fileField" />
  <label for="fileField"></label>
  </form>';*/
}
function mysql_fetch_all_filter_show($res)
{
	$sum=0;
	global $filterset;
	//echo "<br>mysql_fetch_all_filter_show:filterset";
	//print_r($filterset);
	$string =$filterset['Textfilter'];
	//$string = "";
	
	//echo "<br>Search [$string] now  ....";

	
	
	table_html_head();	
    //if($string === "") return;
	while($row=mysql_fetch_array($res)) {
   //printf ("<br>mysql_fetch_all_filter_show:string=[%s]",$string);	
   if($string !== "" && $string !== " " ){
	$find=record_match_mult_str($row,$string);//echo "findflag=[$find]";   
	if ( $find === 'f') {continue;}
	}
	
   print "
    <tr>";
      if($row[0]== 1) {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id] checked= 'checked'"; }
           else       {  print "<th width='23' height='15' scope='col'><input name='checkiterms[]' type='checkbox' id='1_0' value=$row[id]"; }  
   print " /></th>
  
  <th width='23' align='center' valign='middle' scope='col'><label>";
       if($row[1] != 0) {print "<input name='checkflag[]' type='checkbox' id='radio' value=$row[id] checked='CHECKED' />";}
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
  else {echo '<table width="900" height="50" border="1">';}
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
    //echo   "<th width='209' scope='col'><input name='Textfilter' type='text' id='textfilter' value='$filterse[Textfilter]'></th>'";
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
    if($daydiff >= 1) $color1= "bgcolor='#66CCFF'"; 
    else {$color1="";}
    // print "<br>$daydiff";
    // break;
    $hostname=$_SERVER[HTTP_HOST];$program=$_SERVER[SCRIPT_NAME];
    $parameters="SelectId=".$row[id];
    $link="href=http://$hostname/$program?$parameters";

    echo   "<th width='100' scope='col'". $color1 . "><a $link>$row[Iterms]</a></th>";
    
   
   // echo   "<th width='100' scope='col'". $color1 . ">$row[Iterms]</th>";
    echo   "<th width='90' scope='col'". $color1 . ">$row[Where]</th>";
    echo   "<th width='180' scope='col'". $color1 . ">$row[Notes]</th>";
    echo   "<th width='90' scope='col'". $color1 . ">$row[Price]</th>";
    echo   "<th width='90' scope='col'". $color1 . ">$row[Date]</th>";
    echo   "<th width='20' scope='col'". $color1 . ">$row[id]</th>";
    
    echo '</tr>';
}
function table_exec_bottom()
{
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
     <input name="Logout" type="submit" id="Logout" value="Logout">
     
    
   </form>';
}
function delete_select_iterms_show()
{
		 $updateiterms = $_POST['checkiterms'];
 if(sizeof($updateiterms)<1) return;//none selected
  table_html_head();

  //$updateiterms = $_POST['checkflag'];
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
