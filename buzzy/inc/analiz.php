<?php
session_start();

$islem = $_GET["islem"];

$id = $_POST["id"];

if(!is_numeric($id) or !$islem) die("hatacik");

include("../fonksiyon.php");

if(_UYEDURUM != 1) die("hatacik");

list($domain, $tip) = @mysql_fetch_row(@mysql_query("select domain, tip from sorgu where id='$id' and uye='"._UYEID."'"));
	
if(!$domain) die("İşlem gerçekleştirilemiyor");

if(!$tip) $tip = "domain";

if($islem == "anchortop"){

	$backlink = $_POST["backlink"];
	$refering = $_POST["refering"];
	$backlink = suz2($backlink);
	$refering = suz2($refering);

	$suan = @mktime();
							
	$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='veri_refdomains_new_lost_counters' and kayit > $suan");

	if(@mysql_num_rows($cache) >= 1){
								
		list($cek) = @mysql_fetch_row($cache);
			
		echo $cek;
		
		echo json_decode($cek);
		
		die("123");
	}
	else {

		$cachetime = $suan + (60*60*24*7);
		
		@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='veri_refdomains_new_lost_counters' and kayit < $suan");
		
		$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refdomains_new_lost_counters&target=".$domain."&mode=".$tip."&limit=10&where=type%3A%22lost%22&order_by=date%3Adesc&output=json");

		@mysql_query("insert into cache values('$domain', '$tip', 'veri_refdomains_new_lost_counters', NULL, '$cek', '$cachetime')");
								
	}
	
	$cek = json_decode($cek);
	
	$array1 = NULL;
	
	foreach($cek->refdomains as $aktar){
		
		if($aktar->domain_rating > 80) $rating = 80;
		else $rating = $aktar->domain_rating;
		$array1 .= '<li class="clearfix"> <span class="left" style="width:'.$rating.'%">'.$aktar->refdomain.'</span><span class="right"> Rating : '.$aktar->domain_rating.'</span></li>';
	
	}
	
	$suan = @mktime();
							
	$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='veri_refdomains_new_lost_counters2' and kayit > $suan");

	if(@mysql_num_rows($cache) >= 1){
								
		list($cek) = @mysql_fetch_row($cache);
								
	}
	else {

		$cachetime = $suan + (60*60*24*7);
		
		@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='veri_refdomains_new_lost_counters2' and kayit < $suan");
		
		$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refdomains_new_lost_counters&target=".$domain."&mode=".$tip."&limit=10&where=type%3A%22new%22&order_by=date%3Adesc&output=json");

		@mysql_query("insert into cache values('$domain', '$tip', 'veri_refdomains_new_lost_counters2', NULL, '$cek', '$cachetime')");
								
	}
	
	$cek = json_decode($cek);
	
	$array2 = NULL;
	
	foreach($cek->refdomains as $aktar){
		if($aktar->domain_rating > 80) $rating = 80;
		else $rating = $aktar->domain_rating;
		$array2 .= '<li class="clearfix"> <span class="left" style="width:'.$rating.'%">'.$aktar->refdomain.'</span><span class="right">Rating : '.$aktar->domain_rating.'</span></li>';
	
	}
	
?>
              <div class="analiz-domainler">
                    <h3><i class="capa-icon"></i>Referans Domain</h3>
                    <div class="referer-domains left">
                        <div class="top left clearfix">
                            <h4 class="right">KAYIP SON 10</h4>
                        </div>
                        <ul class="left clearfix"><?=$array1?></ul>
                    </div>
                    <div class="referer-domains2 left">
                        <div class="top left">
                            <h4 class="right">YENI SON 10</h4>
                        </div>
                        <ul class="left clearfix"><?=$array2?></ul>
                    </div>
                </div>
<?php

die();
}

if($islem == "anchorcloud"){

	$backlink = $_POST["backlink"];
	$backlink = suz2($backlink);

	
	$suan = @mktime();
							
	$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='veri_anchors' and kayit > $suan");

	if(@mysql_num_rows($cache) >= 1){
								
		list($cek) = @mysql_fetch_row($cache);
								
	}
	else {

		$cachetime = $suan + (60*60*24*7);
		
		@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='veri_anchors' and kayit < $suan");
		
		$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=anchors&target=".$domain."&mode=".$tip."&limit=15&output=json&order_by=backlinks%3Adesc");

		@mysql_query("insert into cache values('$domain', '$tip', 'veri_anchors', NULL, '$cek', '$cachetime')");
								
	}	

	$cek = json_decode($cek);

	$toplambacklink = $backlink;
	$toplamref = $cek->stats->refpages;
	
	$birim = $toplambacklink / 100;
	
	$soldaki = NULL;
	$sagdaki = NULL;
	
	$i = 1;
	foreach($cek->anchors as $deger){
	
		$kelime = $deger->anchor;
		$backlink = $deger->backlinks;
		
		$yuzde = $backlink/$birim;
		
		$yuzde = floor($yuzde);
		
		
		if($yuzde < 1) $yuzde = 1;
		
		if(!$kelime) $kelime = "notext";
		
		if($yuzde >= 5){
			
			if($i%2 == 0) $class = 'yellow';
			if($i%3 == 0) $class = 'yellow2';
			if(!$class) $class = 'blue';
			
			$soldaki .= '<a href="javascript:void(0)" class="'.$class.'"><strong>'.$kelime.'</strong> (%'.$yuzde.')</a> ';
		}
		else {
			
			$sagdaki .= '<a href="javascript:void(0)">'.$kelime.' (%'.$yuzde.')</a> ';
		}
		
		// echo "$kelime $backlink %$yuzde<br />";
		
		
		
		$i++;
	
	}
?>
                        <div class="popular-tags left">
                            <?=$soldaki?>
                        </div>
                        <div class="other-tags left">
                            <?=$sagdaki?>
                        </div>
<?php
die();
}

if($islem == "sosyal"){
	
	$cek = @file_get_contents("http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=".$domain);
	$fb = json_decode($cek);
	$fb1 = sayicevirici($fb[0]->total_count);
	$fb2 = sayicevirici($fb[0]->like_count);
	if($fb1 < 1) $fb1 = 0;
	if($fb2 < 1) $fb2 = 0;

	$cek = @file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=".$domain);
	$t = json_decode($cek);
	$t = sayicevirici($t->count);
	if($t < 1) $t = 0;	
	
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($domain).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
	$curl_results = curl_exec ($curl);
	curl_close ($curl);
	$json = json_decode($curl_results, true);
	$google = isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
	
	$google = sayicevirici($google);
?>
                            <div class="analiz-like left"><span><?=$fb2?></span></div>
                            <div class="analiz-face left"><span class="spanleft"><?=$fb1?></span></div>
                            <div class="analiz-twit left"><span><?=$t?></span></div>
                            <div class="analiz-google left"><span class="spanleft"><?=$google?></span></div>
<?php
die();
}

?>