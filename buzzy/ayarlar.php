<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');

$db_host		=	"localhost";
$db_user		=	"buzyy_veri";
$db_password	=	"mert2014-";
$db_database	=	"buzyy_veri";

$cookie			=	"buzyycom";

$online			=	30; // dk cinsinden

$access_token	=	"138e2ee6d3f50e3bc0ebd7bfcb728e762ec28dbe";

$baglan = mysql_pconnect($db_host, $db_user, $db_password) or die("Veritabanina baglanamadim");
mysql_select_db($db_database, $baglan) or die("Veritabani secilemedi");
mysql_query("set names 'utf8'",$baglan);

define("_CODER", "mahirix");
define("_ONLINE", $online);
define("_COOKIE", $cookie);
define("_TOKEN", $access_token);
define("_AD", "buzyy.com");
define("_MAIL", "odeme@buzzy.com");
define("_URL", "http://buzyy.com/");
define("_BASLIK", "Buzyy.com Backlink analiz ve webmaster araçları");
define("_KEYWORDS", "Site keytwordsleri");
define("_DESCRIPTION", "Site Descriptionlari");
define("_COOKIE", $cookie);

?>
