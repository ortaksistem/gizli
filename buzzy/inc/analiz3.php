<?php

session_start();

$id = $_GET["id"];

if(!is_numeric($id)) die();

include("../fonksiyon.php");

if(_UYEDURUM != 1) die("hata");

list($domain, $tip) = @mysql_fetch_row(@mysql_query("select domain, tip from sorgu where id='$id' and uye='"._UYEID."'"));
	
if(!$domain) die("İşlem gerçekleştirilemiyor");
	

if(!$tip) $tip = "domain";

$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refips&target=".$domain."&mode=".$tip."&limit=100&output=json&order_by=backlinks%3Adesc");

$don = json_decode($cek);

$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(
    array('label' => 'Ulke', 'type' => 'string'),
    array('label' => 'Adet', 'type' => 'number')
);


$yeniarray = array();
foreach($don->refips as $aktar){

		$ip = $aktar->refip;
		$iparray = explode('.', $ip);
		$ipdecimal = ($iparray[0] * 16777216) + ($iparray[1] * 65536) + ($iparray[2] * 256) + ($iparray[3]);
		
		list($kod) = @mysql_fetch_row(@mysql_query("SELECT name FROM ip2country WHERE ".$ipdecimal." BETWEEN min AND max"));
		
		if($kod) array_push($yeniarray, $kod);

		
	}
	
	$adet = array_count_values($yeniarray);
		
	foreach($adet as $x => $y){
		
		$temp = array();	
		$temp[] = array('v' => (string) $x); 
		$temp[] = array('v' => (int) $y); 
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