<?php
session_start();

$islem = $_GET["islem"];

$id = $_GET["id"];

if(!is_numeric($id) or !$islem) die("hatacik");

include("../fonksiyon.php");

if(_UYEDURUM != 1) die("hatacik");

list($domain, $tip) = @mysql_fetch_row(@mysql_query("select domain, tip from sorgu where id='$id' and uye='"._UYEID."'"));
	
if(!$domain) die("Ýþlem gerçekleþtirilemiyor");

if(!$tip) $tip = "domain";

if($islem == "veri1"){

$suan = @mktime();
						
$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='veri_refdomains_new_lost_counters' and kayit > $suan");

if(@mysql_num_rows($cache) >= 1){
							
	list($cek) = @mysql_fetch_row($cache);
							
}
else {

	$cachetime = $suan + (60*60*24*7);
	
	@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='veri_refdomains_new_lost_counters' and kayit < $suan");
	
	$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refdomains_new_lost_counters&target=".$domain."&mode=".$tip."&limit=10&where=type%3A%22lost%22&order_by=date%3Adesc&output=json");

	@mysql_query("insert into cache values('$domain', '$tip', 'veri_refdomains_new_lost_counters', NULL, '$cek', '$cachetime')");
							
}

$don = json_decode($cek);

$aylar = array("", "Ocak", "Þubat", "Mart", "Nisan", "Mayýs", "Haziran", "Temmuz", "Aðustos", "Eylül", "Ekim", "Kasým", "Aralýk");

$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(
    array('label' => 'Tarih', 'type' => 'string'),
    array('label' => 'Yeni', 'type' => 'number'),
    array('label' => 'Eski', 'type' => 'number')
);

	foreach($don->counts as $don1){
		
		$temp = array();	
		$temp[] = array('v' => (string) $don1->date); 
		$temp[] = array('v' => (int) $don1->new_total); 
		$temp[] = array('v' => (int) $don1->lost_total); 
		$rows[] = array('c' => $temp);
		
	}
$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo $jsonTable;
die();
}

if($islem == "veri2"){

$suan = @mktime();
						
$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='veri_backlinks_new_lost_counters' and kayit > $suan");

if(@mysql_num_rows($cache) >= 1){
							
	list($cek) = @mysql_fetch_row($cache);
							
}
else {

	$cachetime = $suan + (60*60*24*7);
	
	@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='veri_backlinks_new_lost_counters' and kayit < $suan");
	
	$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=backlinks_new_lost_counters&target=".$domain."&mode=".$tip."&limit=10&order_by=date%3Adesc&output=json");

	@mysql_query("insert into cache values('$domain', '$tip', 'veri_backlinks_new_lost_counters', NULL, '$cek', '$cachetime')");
							
}

$don = json_decode($cek);

$aylar = array("", "Ocak", "Þubat", "Mart", "Nisan", "Mayýs", "Haziran", "Temmuz", "Aðustos", "Eylül", "Ekim", "Kasým", "Aralýk");

$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(
    array('label' => 'Tarih', 'type' => 'string'),
    array('label' => 'YENI', 'type' => 'number'),
    array('label' => 'KAYIP', 'type' => 'number')
);

	foreach($don->counts as $don1){
		
		$temp = array();	
		$temp[] = array('v' => (string) $don1->date); 
		$temp[] = array('v' => (int) $don1->new_total); 
		$temp[] = array('v' => (int) $don1->lost_total); 
		$rows[] = array('c' => $temp);
		
	}
$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo $jsonTable;
die();
}

if($islem == "veri3"){

$suan = @mktime();
						
$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='veri_refdomains_by_type' and kayit > $suan");

if(@mysql_num_rows($cache) >= 1){
							
	list($cek) = @mysql_fetch_row($cache);
							
}
else {

	$cachetime = $suan + (60*60*24*7);
	
	@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='veri_refdomains_by_type' and kayit < $suan");
	
	$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refdomains_by_type&target=".$domain."&mode=".$tip."&limit=1&output=json");

	@mysql_query("insert into cache values('$domain', '$tip', 'veri_refdomains_by_type', NULL, '$cek', '$cachetime')");
							
}

$don = json_decode($cek);

$kactane = $don->stats->refdomains;

$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(
    array('label' => 'Domain Tipi', 'type' => 'string'),
    array('label' => 'Toplam : '.$kactane.'', 'type' => 'number')
);


foreach($don->tlds as $aktar){
		
		
		$temp = array();	
		$temp[] = array('v' => (string) $aktar->tld); 
		$temp[] = array('v' => (int) $aktar->count); 
		$rows[] = array('c' => $temp);

		
	}
	
$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo $jsonTable;
die();
}
?>