<?php
// 'library/ListproFrontEnd.php'




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
		<td><input name="add" type="submit" id="add" value="Add New iterms"></td>
		</tr>
		<tr> 
		<td width="100">&nbsp;</td>
		<td>   Choose File To Upload : <input type="file" name="File[]" multiple /> 
		   <input type="submit" value="size" name="sizetest">
		   
		   </td>
		</tr>
		</table>
		</form>	';
	}
	else{}
	$showadditerm=1;
	
	

?>
