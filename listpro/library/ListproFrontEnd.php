<?php
//global$showadditerm
if($showadditerm==1)
{
	$today = date("Y-m-d"); 
echo '
		<br >Iterm added</br>
		<form method="post" enctype="multipart/form-data">
		
		<table class=additerm width="720" border="0" cellspacing="1" cellpadding="2">
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
		<td width="100">Price(a,b,c,)</td>
		<td><input name="Price" type="text" id="Price"></td>
		 </tr>
		<tr> 
		
		
		<td width="100" >Notes</td>
		<td><textarea name="Notes"  rows="10" id="Notes"></textarea></td>
		
		<td >  Drap or Choose Files To Upload :  <input class="input2" type="file" id="thefile" onchange="checkSize()" name="File[]"  multiple  /> 
		<td id="showszie"></td>
		</tr> 
		<tr> 
		<td>Date</td>';
	print"	<td ><input type='text' id='dateinput' size='10' name='Date' value=$today></td>";
    echo '</tr>
		
		<tr> 
		<td width="100">&nbsp;</td>
		<td><input name="add1" type="submit" id="add" value="Add New iterms"></td>
		</tr>
		
		';
	echo
	    '</table>
		</form>	';
	/*echo
	    '
		<button onclick="showsize($File)">size</button>
        <p id="showszie">$File</p>';*/
	}
	else{}
	$showadditerm=1;		
?>
<!-- Include jQuery -->	
<!--script src="libraryDevelop/jquery.js"></script-->
<!-- Include Core Datepicker JavaScript -->
<script src="libraryDevelop/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>	
	
<!-- Attach the datepicker to dateinput after document is ready -->

<script type="text/javascript">
/*var $j = jQuery.noConflict();  
$j(document).ready(function() {  
  $j("div").addClass("special");  
});  
	$(document).ready(function() {
		(".fancybox").fancybox();
	});*/
	
</script>
<script type="text/javascript" charset="utf-8">
jQuery(function($){
	$("#dateinput").datepicker({dateFormat: "yy-mm-dd", showOn: "both", 
	buttonImageOnly: true, buttonImage: "img/calendar.gif"});
	});	
var $j = jQuery.noConflict();  	
$j(document).ready(function() {
		$j(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	});
	
	
function showtrailfix(width,height,file)
{
	

	//if(navigator.userAgent.toLowerCase().indexOf('opera') == -1)
	{
		w=width
		h=height
		
		// followmouse()
	
		document.getElementById('ttimg').src=file
		document.onmousemove=followmouse
		gettrailobj().visibility="visible"
		
		gettrailobj().width=w+"px"
		gettrailobj().height=h+"px"
		var img = document.getElementById('ttimg');
		img.src=file;
		img.style.width=w+"px";
		img.style.height=h+"px"; 
	}



}
function imgtag_process(imgs)
{
var tmpfilename=imgs.src
var alink='<a href='+ tmpfilename +'>'
//alert ("This document contains:" + tmpfilename +"width"+imgs.width+"height"+imgs.height);
 
imgs.src='/img/showimage.gif'
imgs.width='16'
imgs.height='20'
imgs.onmouseover=function(){showtrailfix(200,200*1.3,tmpfilename);};
imgs.onmouseout=function(){ hidetrail();};
imgs.onclick=function(){ 
	window.open( tmpfilename, 'Frank Personal Google', config='height=400,width=600')
	};
}
//var imgs = document.getElementsByTagName("img")[1];

var images = document.getElementsByTagName("img");
for (var i=0; i<images.length; i++){
  //if (/AdditermData/i.test(images[i].src))
  if (/.jpg$/i.test(images[i].src) && location.search.indexOf("SelectId")  < 0)
    imgtag_process(images[i]);
   if (/.jpeg$/i.test(images[i].src) && location.search.indexOf("SelectId")  < 0)
    imgtag_process(images[i]);
     if (/.png$/i.test(images[i].src) && location.search.indexOf("SelectId")  < 0)
    imgtag_process(images[i]);
 //error if (/.gif$/i.test(images[i].src) && location.search.indexOf("SelectId")  < 0)
 //  imgtag_process(images[i]); 
    if (/\/pic\//i.test(images[i].src) && location.search.indexOf("SelectId")  < 0)
    imgtag_process(images[i]); 
    if (/\/image\//i.test(images[i].src) && location.search.indexOf("SelectId")  < 0)
    imgtag_process(images[i]);
}

//imgtag_process(document.getElementsByTagName("img")[1]);

</script>
<script>
function img_mouseover(){
	alert("mouse over");
	/*$filename='<a href=http://192.168.1.101:6001/'."$tmpfilename" .' >'
			."<src='/img/showimage.gif' width='16' height='20' onmouseover=\"showtrail(310,440,\'$tmpfilename\')\"; onmouseout=\"hidetrail()\";>" 
			.'</a>';*/
}	
function ajax_request() {
$('#placeholder').html('<p><img class="loader" src="/loader.gif"></p>');
$('#placeholder').load("/test.php?id=1234556");
}
	
 function checkSize() {
        //FOR IE FIX
       var fileSize = 0; //檔案大小
	   var SizeLimit = 1024;  //上傳上限，單位:byte

       var f = document.getElementById("thefile");
       
       for(var i=0;i<f.files.length;i++){
		//alert(f.files.length);   
		fileSize += f.files[i].size / 1024.0 ; 
	   }
		document.getElementById("showszie").innerHTML=fileSize.toFixed(2) + "kb";       
  }
function resize_images(maxht, maxwt, minht, minwt) {
  var imgs = document.getElementsByTagName('img');

  var resize_image = function(img, newht, newwt) {
    img.height = newht;
    img.width  = newwt;
  };
  
  for (var i = 0; i < imgs.length; i++) {
    var img = imgs[i];
    if (img.height > maxht || img.width > maxwt) {
      // Use Ratios to constraint proportions.
      var old_ratio = img.height / img.width;
      var min_ratio = minht / minwt;
      // If it can scale perfectly.
      if (old_ratio === min_ratio) {
        resize_image(img, minht, minwt);
      } 
      else {
        var newdim = [img.height, img.width];
        newdim[0] = minht;  // Sort out the height first
        // ratio = ht / wt => wt = ht / ratio.
        newdim[1] = newdim[0] / old_ratio;
        // Do we still have to sort out the width?
        if (newdim[1] > maxwt) {
          newdim[1] = minwt;
          newdim[0] = newdim[1] * old_ratio;
        }
        resize_image(img, newdim[0], newdim[1]);
      }
    }
  }
}
</script>
