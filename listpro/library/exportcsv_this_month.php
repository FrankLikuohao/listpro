<?php
include "Listprolib.php";
$conn=opendb();
//$conn = mysql_connect( 'localhost', 'root', '12345' ) or die( mysql_error( ) );
//mysql_select_db( 'database_name', $conn ) or die( mysql_error( $conn ) );
$query = "Select * From todolist  Where DATEDIFF(date(Date),CURDATE()) <=0  and DATEDIFF(date(Date),CURDATE()) >= -31 and  month(date(Date)) = Month(NOW())-1 and `Price` > 0 ORDER BY `Date` ASC";
$result = mysql_query($query ) or die( mysql_error( $conn ) );
mysql_close($conn);
exportcsv($result);
function exportcsv($result)
{
header( 'Content-Type: text/csv' ); // tell the browser to treat file as CSV
header( 'Content-Disposition: attachment;filename=export.csv' ); // tell browser to download a file in user's system with name export.csv
$row = mysql_fetch_assoc( $result ); // Get the column names
if ( $row )
	{
		outputcsv( array_keys( $row ) ); // It wil pass column names to outputcsv function
	}
while ( $row )
{
	outputcsv( $row );    // loop is used to fetch all the rows from table and pass them to outputcsv func
	$row = mysql_fetch_assoc( $result );
}

}
function outputcsv( $fields )
{
$separator = '';
	/*foreach ( $fields as $field )
	{
		echo $separator . $field;
		$separator = ',';        // Separate values with a comma
	}*/
	echo "$fields[Date],$fields[Iterms],$fields[Price]";
echo "\r\n";     //Give a carriage return and new line space after each record
}
?>
