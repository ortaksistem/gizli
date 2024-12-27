<?php

session_start();


$domain = $_GET["domain"];

if(!$domain) die("Nere");

include("../fonksiyon.php");


$tip = $_GET["tip"];
$tip = suz2($tip);
if(!$tip) $tip = "domain";

$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refdomains_by_type&target=".$domain."&mode=".$tip."&limit=1&output=json");

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