<?php

// mysql ayarlar�
$host			=	"localhost";
$user			=	"daligizli_site";
$sifre			=	"Dali.1978";
$database		=	"daligizli_site";

// sitecookie
$cookie			=	"mahirixarkadaslik";

// baslik ve url ayarlar�
$siteadi		=	"Gizli";
$sitebaslik 	=	"Gizli.com.tr";
$siteurl		=	"https://dali.gizli.com.tr/";
$sitekeywords	=	"Gizli";
$sitedescription=	"Gizli Arkadas Bulma Sitesi";

// bu sat�rlara dokunmaman�z onerilir

include("fix-mysql.php");

$baglan=@mysql_connect ($host,$user,$sifre) or die ("Sistem veritabanina baglanamadi. Lutfen site yetkilisine basvurun.");

mysql_select_db ($database,$baglan) or die ("Veritabani baglantilarini kontrol ediniz..");

// elle�meyin buraya kesinlikle

define("_URL", $siteurl);
define("_BASLIK", $sitebaslik);
define("_AD", $siteadi);
define("_KEYWORDS", $sitekeywords);
define("_DESCRIPTION", $sitedescription);
define("_COOKIE", $cookie);
define("_MX", "mahir_");

?>