<?php

session_start();


$domain = $_GET["domain"];

if(!$domain) die("Nere");

include("../fonksiyon.php");


$tip = $_GET["tip"];
$tip = suz2($tip);
if(!$tip) $tip = "domain";
	
$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=backlinks_new_lost_counters&target=".$domain."&mode=".$tip."&limit=10&order_by=date%3Adesc&output=json");

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
	/*
	while($suan >= 1412892000){ // 10.10.2014e kadar eksiltcek
		$yeni = rand(10,99);
		$eski = rand(10,99);		
		
		$temp = array();
		
		$date = date("m.d.Y", $suan);
		$temp[] = array('v' => (string) $date); 


		$temp[] = array('v' => (int) $yeni); 
		$temp[] = array('v' => (int) $eski); 
		$rows[] = array('c' => $temp);
		$suan = $suan - $eksilt;
	}
	
$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;
*/
?>