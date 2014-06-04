<?php
/*--------------------------------------------------------------------
 * TWAMP Web Configurator
 *
 * @package    TWAMP Web Configurator
 * @copyright  Copyright (c) 2009-2012 TWAMP Group (http://orz99.com/twamp)
 * @license    GPL licenses
 * @version    $Id$
 *
--------------------------------------------------------------------*/
if( isset($_GET['q']) ) {
	if ( $_GET['q'] == 'phpinfo' )
	{
		phpinfo();
		exit();
	}
}

$str_path_twamp = substr($_SERVER["DOCUMENT_ROOT"], 0, strrpos($_SERVER["DOCUMENT_ROOT"], '/'));
$str_path_httpd_conf = $str_path_twamp. '/ap/conf/httpd.conf';
$arr_php_ver = array('52'=>'#', '53'=>'#', '54'=>'#');

if ( isset($_POST['ver']) ) {
	foreach ($arr_php_ver as $k => $v) {
  	if ( $k == $_POST['ver'] ) {
    	$arr_php_ver[$k] = '';
  	}
	}
}

if ( isset($_GET['ver']) ) {
	$str_ver_setup_hint = "<div id=\"change_version_hint\">PHP Version is changed, Please <strong>Restart TWAMP</strong>!!</div>";
}
$arr_httpd_conf = file($str_path_httpd_conf);
$str_httpd_conf_new = '';
$php = array(52=>'', 53=>'', 54=>'',);
foreach ( $arr_httpd_conf as $v ) {
  if (preg_match("/^(#|)Include php-5.2\/php.conf/i", $v)) {
    if (preg_match("/^Include php-5.2\/php.conf/i", $v)) {
      $php[52] = 'checked';
    }
    $str_httpd_conf_new .= "{$arr_php_ver['52']}Include php-5.2/php.conf\n";
  } elseif (preg_match("/^(#|)Include php-5.3\/php.conf/i", $v)) {
    if (preg_match("/^Include php-5.3\/php.conf/i", $v)) {
      $php[53] = 'checked';
    }
    $str_httpd_conf_new .= "{$arr_php_ver['53']}Include php-5.3/php.conf\n";

  } elseif (preg_match("/^(#|)Include php-5.4\/php.conf/i", $v)) {
    if (preg_match("/^Include php-5.4\/php.conf/i", $v)) {
      $php[54] = 'checked';
    }
    $str_httpd_conf_new .= "{$arr_php_ver['54']}Include php-5.4/php.conf\n";

  } else {
    $str_httpd_conf_new .= $v;
  }

}

$str_ver_setup = "<div id=\"change_version\"><form action=\"{$_SERVER['REQUEST_URI']}\" method=\"post\"><input type=\"radio\" name=\"ver\" value=\"52\" {$php['52']}> PHP 5.2.17 <input type=\"radio\" name=\"ver\" value=\"53\" {$php['53']}> PHP 5.3.25 <input type=\"radio\" name=\"ver\" value=\"54\" {$php['54']}> PHP 5.4.15<input type=\"submit\" value=\" 　Switch　\" id=\"submit_button\"></form></div>";
if( isset($_POST['ver']) ) {
	if ( in_array($_POST['ver'], array('52','53','54')) ) {
	  $fp = fopen($str_path_httpd_conf,'w');
	  fputs($fp, $str_httpd_conf_new);
	  fclose($fp);
	
	  header('Location: http://'. $_SERVER["HTTP_HOST"]. '?ver='. $_POST['ver']);
	}
}
$twamp_title = 'TWAMP v7.22.01-bumbler 懦弱不是美德軟趴就是無能版';
$twamp_ver = '7.22.01';
$twamp_ver_nick = 'bumbler 懦弱不是美德軟趴就是無能版';
$twamp_ver_nick_desc = '這年頭提到「無能」兩個字你會想到誰？
「無能」已經從形容詞變成代名詞了，「南方朔觀點－懦弱不是美德 怕事不叫理性」文章暗喻某(自棄)主權國家「領倒」人是秦檜，私甚不以為然，
因為奸臣不等於無能，如此比擬簡直太污辱秦檜了！

';


$drupal6_path = 'drupal-6.28';
$drupal7_path = 'drupal-7.22';

if ( !$_GET['d7']) {
  define('DRUPAL_ROOT', getcwd(). "/{$drupal7_path}");
  require_once DRUPAL_ROOT . '/includes/bootstrap.inc';

  drupal_bootstrap( DRUPAL_BOOTSTRAP_CONFIGURATION );
  $drupa7_databas = $GLOBALS['databases']['default']['default'];
  $conn = mysql_connect ( $drupa7_databas[host], $drupa7_databas[username], $drupa7_databas[password] );

  if (!$conn) {
    die('Could not connect : ' . mysql_error($conn));
  }
  mysql_select_db($drupa7_databas['database']);
  $query  = "SELECT value FROM ". $drupa7_databas['prefix']. "variable WHERE name = 'install_task'";
  $result = mysql_query($query);
  mysql_close( $conn );

  if ($result) {
    $d7 = 'Using';

  } else {
    $d7 = 'Install';
  }
  header("Location: ". $_SERVER['REQUEST_URI']. "&d7={$d7}");  exit();

} elseif ( !$_GET['d6'] ) {
  chdir('./'. $drupal6_path);
  include_once './includes/bootstrap.inc';

  drupal_bootstrap( DRUPAL_BOOTSTRAP_DATABASE );

  $drupal6_creatable = @db_result(db_query("SELECT value FROM {variable} WHERE name = '%s'", 'install_task'));
  if (empty($drupal6_creatable))
  {
  	$d6 = 'Install';

  }
  else
  {
  	$d6 = 'Using';

  }
  header("Location: ". $_SERVER['REQUEST_URI']. "&d6={$d6}");exit();
}

//*******************************************************
// print array content
//*******************************************************
function printr( $object ) {
  if ( is_array( $object ) ) {
    print( '<pre>' );
    print_r( $object );
    print( '</pre>' );
  } elseif ( is_string($object) || is_int($object) ) {

    print( '<h3>' );
    print_r( $object );
    print( '</h3>' );
  } else {
    var_dump( $object );
  }
  flush();

}

function ieversion() {
  $match=preg_match('/MSIE ([0-9]\.[0-9])/',$_SERVER['HTTP_USER_AGENT'],$reg);
  if($match==0)

    return -1;
  else
    return floatval($reg[1]);
}


if ($_GET['d7'] == 'Install') {
  $url_drupal7 = 'install.php';
  } else {

  $url_drupal7 = '';
}

if ($_GET['d6'] == 'Install') {
  $url_drupal6 = 'install.php';

} else {
  $url_drupal6 = '';
}

//$ieversion = ieversion();
$str_drupal6 = "{$_GET['d6']} {$drupal6_path}";
$str_drupal7 = "{$_GET['d7']} {$drupal7_path}";
$str_phpmyadmin = "phpMyAdmin (root)";
$str_phpinfo = "phpinfo with SSL";
$str_perl = "perl CGI with SSL";
?><html>
<head><link href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAACW3iEA4HoLAPq/fwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIRERERERERIRERABEREREREREAEREREREREAABEREREREAAAAREREREQAAABERERERAAAAAREREREAAAABERERERAAAAEREREREAAAARERERERAAAAEREREREQAAAREREREREAAAERERERERAAAREREREREQARERIRERERERERIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $twamp_title; ?></title>
<script type="text/javascript">
</script>


<style type="text/css">

body {
	margin: 0;
	padding: 0;
	text-align: center;
}

body, td, th, h1, h2 {
  font-family: "Microsoft JhengHei", 微軟正黑體, "Microsoft Yahei", 微软雅黑, "Apple LiGothic Medium", STHeiti, "Comic Sans MS", sans-serif !important; }

.oneCol #container {
	width: 930px;
	background: #618CD5;
	margin: 0 auto;
	border: 1px solid #000000;
	text-align: left; }

img {
	border: 0px;
}

#header a, {
  background: none !important;
  color: #959690;
}

#headerContent a {
  background: none !important;
  color: #C0CCC0 !important;
}
#headerContent {
  text-align: center;
  margin-left: auto; margin-right: auto;
  border: 0px;
}

#header h1, #main h1 {
  background: #1250AB;
  color: #959690;
  padding: 0 10px;
}

#header h1 a:link {
  background: #1250AB;
  color: #95E600;
}

#header h1 a:visited {
  background: #1250AB;
  color: #95E600;
}

#header h1 a:hover {
  background: #1250AB;
  color: #EEEE00;
}

#header h1 a:active {
  background: #1250AB;
  color: #9596CC;
}

.oneCol #footer { 
	padding: 0 10px;
	background:#AABBCC;
	font-size: 12px;
}

.oneCol #footer p {
	margin: 0;
	padding: 10px 0;
}

#ploy {
  text-align:center;
  margin-bottom: 25px;
}

#lyrics {
	text-align: center;
	margin-bottom: 25px;
}

#lyrics img {
		float: none !important;
}

.classname {
  float: left;
  border:solid 1px #2d2d2d;
  text-align:center;
  background:#575757;
  margin-left: 5px;
  padding:5px 20px 5px 20px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
}

.classname a:link {
  color: #EEEE00 !important;
}

#change_version {
	text-align:center;
}

#submit_button {
	position: relative;
	top: -2px; left: 10px;
	font-family: arial; font-weight: 700;

}

#change_version_hint {
	text-align: center;
	margin-left: auto; margin-right: auto; margin-bottom: 25px;
	background: #E0E000;
}


/* =Your Generated css 
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
.classname{-moz-box-shadow:5px 5px 5px #000000;-webkit-box-shadow:5px 5px 5px #000000;box-shadow:5px 5px 5px #000000;}
/* End of Your Generated css 
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/

.clr {
  clear: both;
}

</style>

</head>
<body class="oneCol">
	<div id="container">
	  <div id="header">
			<h1><a href="/index.php" class="header_title pointer" title="<?php print $twamp_ver_nick_desc; ?>">TWAMP v<?php print $twamp_ver; ?> </a> <?php print $twamp_ver_nick; ?> </h1>
	  </div><!-- end #header -->
	  <div id="headerContent">

					<div class="classname"><a href="http://<?php print $_SERVER["HTTP_HOST"]; ?>" title="Home" class="pointer">
							Home
					</a></div>
					<div class="classname"><a href="./<?php print $drupal7_path; ?>/<?php print $url_drupal7; ?>" title="<?php print $_GET['d7']. " {$drupal7_path}"; ?>" class="pointer">
							<?php print $str_drupal7; ?>
						</a></div>
					<div class="classname"><a href="./<?php print $drupal6_path; ?>/<?php print $url_drupal6; ?>" title="<?php print $_GET['d6']. " {$drupal6_path}"; ?>" class="pointer">
							<?php print $str_drupal6; ?>
					</a></div>

					<div class="classname"><a href="./phpMyAdmin/" title="login as root, no password" class="pointer">
							<?php print $str_phpmyadmin; ?>
					</a></div>
					<div class="classname"><a href="https://<?php print $_SERVER["HTTP_HOST"]. $_SERVER['REQUEST_URI']; ?>&amp;q=phpinfo" title="phpinfo" class="pointer">
							<?php print $str_phpinfo; ?>
					</a></div>

	  </div>
	  <div class="clr">&nbsp;</div>
	  <div id="main">
	  	<h1 class="main_title">phpinfo</h1>
	  </div>
		<div id="mainContent">
<?php
	if ( isset($str_ver_setup) ) { print $str_ver_setup; }
	if ( isset($str_ver_setup_hint) ) { print $str_ver_setup_hint; }
?>

<?php
	phpinfo();
	//$pinfo = ob_get_contents();
	//ob_end_clean();
	//$pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
	//echo $pinfo;
?>

		</div><!-- end #mainContent -->
		<div id="ploy"></div>
		<div id="lyrics"></div>
		<div id="lyrics"></div>
	  <div id="footer">
			<p>Powered by TWAMP v7 &copy;2011-2012 by orz99.com. All Rights Reserved.</p>
	  </div><!-- end #footer -->
	</div><!-- end #container -->
</body></html>