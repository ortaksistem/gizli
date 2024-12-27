<?php

session_start();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();


$listele = $_POST["listele"];

$sayfa = $_POST["sayfa"];

if(!$listele){
	
	$listele = $_SESSION[_COOKIE."listele"];

}

switch($listele){
	case "bayan": $while = "where cinsiyet='1' or cinsiyet='5'";break;
	case "lezbiyen": $while = "where cinsiyet='4'";break;
	case "erkek": $while = "where cinsiyet='3'";break;
	case "ciftler": $while = "where cinsiyet='2' or cinsiyet='6'";break;
	case "gay": $while = "where cinsiyet='7'";break;
	case "trans": $while = "where cinsiyet='8'";break;
	default: $while = NULL;break;
}

															
															
$limit = 15;

$result = mysql_query("select count(uye) from "._MX."online ".$while." order by oncelik asc");

list($toplam) = mysql_fetch_row($result);

$toplamsayfa = ceil(($toplam/$limit));

?>
<select name="sayfalama" id="sayfalama" class="selectler" onChange="sayfa()">
<?
for($i = 1; $i <= $toplamsayfa; $i++) echo "<option value=$i>Sayfa : $i</option>";
?>
</select>