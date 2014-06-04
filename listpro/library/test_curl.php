<?php


$path = '/usr/lib/pear';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

function get_content($url)  
{  
   $ch = curl_init();  
  
   curl_setopt ($ch, CURLOPT_URL, $url);  
   curl_setopt ($ch, CURLOPT_HEADER, 0);  
  
   ob_start();  
  
   curl_exec ($ch);  
   curl_close ($ch);  
   $string = ob_get_contents();  
  
   ob_end_clean();  
     
   return $string;      
  
}  
function timeout()
{

 $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, 'http://www.sitepoint.com'); 
  curl_setopt($ch, CURLOPT_HEADER, 0); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
curl_setopt($ch, CURLOPT_TIMEOUT, 300);
  $data = curl_exec($ch); 
  file_put_contents("text.txt", $data);
  curl_close($ch); 
  }
  
//https://www.google.com/accounts/ServiceLoginAuth?
//continue=http://mail.google.com/gmail&service=mail&Email=LOGIN&Passwd=PASSWORD&null=Sign+in
$homepage = file_get_contents('https://www.google.com/accounts/ServiceLoginAuth?continue=http://mail.google.com/gmail&service=mail&Email=frank.likuohao@gmail.com&Passwd=frank0406!&null=Sign+in');
//$homepage = file_get_contents('https://mail.google.com/mail/ca/u/0/?shva=1#contacts/search/%E4%B9%9D');
//$homepage = file_get_contents('http://www.example.com/');
echo $homepage;
?>
<?php
//http://phplegend.wordpress.com/2010/02/13/importing-gmail-contacts-using-curl-and-php/
$location = "";
$cookiearr = array();
$csv_source_encoding='utf-8';

#function get_contacts, accepts as arguments $login (the username) and $password
#returns array of: array of the names and array of the emails if login successful
#otherwise returns 1 if login is invalid and 2 if username or password was not specified
function get_contacts($login, $password)
{
#the globals will be updated/used in the read_header function
global $csv_source_encoding;
global $location;
global $cookiearr;
global $ch;

#check if username and password was given:
if ((isset($login) && trim($login)=="") || (isset($password) && trim($password)==""))
{
#return error code if they weren't
return 2;
}

#initialize the curl session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/accounts/ServiceLoginAuth?service=mail&quot;);
curl_setopt($ch, CURLOPT_REFERER, "");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADERFUNCTION, 'read_header');

#get the html from gmail.com
$html = curl_exec($ch);

$matches = array();
$actionarr = array();

$action = "https://www.google.com/accounts/ServiceLoginAuth?service=mail&quot;;

#parse the login form:
#parse all the hidden elements of the form
preg_match_all('/]*name\="([^"]+)"[^>]*value\="([^"]*)"[^>]*>/si', $html, $matches);
$values = $matches[2];
$params = "";

$i=0;
foreach ($matches[1] as $name)
{
$params .= "$name=" . urlencode($values[$i]) . "&";
++$i;
}

$login = urlencode($login);
$password = urlencode($password);

#submit the login form:
curl_setopt($ch, CURLOPT_URL,$action);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params ."Email=$login&Passwd=$password&PersistentCookie=");

$html = curl_exec($ch);

#test if login was successful:
if (!isset($cookiearr['GX']) && (!isset($cookiearr['LSID']) || $cookiearr['LSID'] == "EXPIRED"))
{
return 1;
}

#this is the new csv url:
curl_setopt($ch, CURLOPT_URL, "http://mail.google.com/mail/contacts/data/export?exportType=ALL&groupToExport=&out=GMAIL_CSV");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPGET, 1);

$html = curl_exec($ch);
$html = iconv ($csv_source_encoding,'utf-8',$html);

$csvrows = explode("\n", $html);
array_shift($csvrows);

$names = array();
$emails = array();
foreach ($csvrows as $row)
{
if (preg_match('/^((?:"[^"]*")|(?:[^,]*)).*?([^,@]+@[^,]+)/', $row, $matches))
{
$names[] = trim( ( trim($matches[1] )=="" ) ? current(explode("@",$matches[2])) : $matches[1] , '" ');
$emails[] = trim( $matches[2] );
}
}

return array($names, $emails);
}

#read_header is essential as it processes all cookies and keeps track of the current location url
#leave unchanged, include it with get_contacts
function read_header($ch, $string)
{
global $location;
global $cookiearr;
global $ch;
global $csv_source_encoding;

$length = strlen($string);

if (preg_match("/Content-Type: text\\/csv; charset=([^\s;$]+)/",$string,$matches))
$csv_source_encoding=$matches[1];

if(!strncmp($string, "Location:", 9))
{
$location = trim(substr($string, 9, -1));
}
if(!strncmp($string, "Set-Cookie:", 11))
{
$cookiestr = trim(substr($string, 11, -1));
$cookie = explode(';', $cookiestr);
$cookie = explode('=', $cookie[0]);
$cookiename = trim(array_shift($cookie));
$cookiearr[$cookiename] = trim(implode('=', $cookie));
}
$cookie = "";
if(trim($string) == "")
{
foreach ($cookiearr as $key=>$value)
{
$cookie .= "$key=$value; ";
}
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
}

return $length;
}

#function to trim the whitespace around names and email addresses
#used by get_contacts when parsing the csv file
function trimvals($val)
{
return trim ($val, "\" \n");
}
function getContacts($username = null, $password = null){

$login = $username;
$password = $password;

$resultarray = get_contacts($login, $password);

foreach($resultarray as $res){
$emailArray['email'] = $res;
}
return $emailArray;

}

print_r(getContacts("GMAIL_USERNAME","GMAIL_PASSWORD"));
?>


