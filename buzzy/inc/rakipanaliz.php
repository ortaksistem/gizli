<?php
session_start();
ini_set('max_execution_time', 0);
$islem = $_GET["islem"];

if(!$islem) die("Go");


if($islem == "sil"){
	
	$id = $_POST["id"];
	
	if(is_numeric($id)){

	include("../fonksiyon.php");
		if(uye()){
			
			$uyeid = _UYEID;
			
			$result = @mysql_query("delete from rakip where id='$id' and uye='$uyeid'");
			
			
			if($result){

				@mysql_query("delete from rakip_log where rakip='$id' and uye='$uyeid'");
				
			}
			
			
			die("ok");
		
		}

	}
	die("Go");

}

if($islem == "yenirakip"){
	
	$id = $_POST["id"];
	
	if(!is_numeric($id)) die("hatacikk");
	
	$siteler = $_POST["a"];
	
	if(!$siteler) die("hatacik");

	
	include("../fonksiyon.php");
	
	if(uye()){
		
		list($id, $aranacak) = @mysql_fetch_row(@mysql_query("select id, siteler from rakip where id='$id' and uye='"._UYEID."'"));
		
		if(!$id) die("Bir hata oluştu");		
		
		list($adet) = @mysql_fetch_row(@mysql_query("select count(id) from rakip_log where rakip='$id' and uye='"._UYEID."'"));
		
		if($adet >= 11) die("En fazla 10 site eklenebilir");
		
		$siteler = suz2($siteler);
		
		$siteler = explode(",", $siteler);
		
		$suan = @mktime();
		
		foreach($siteler as $sit){
		
			$sit = str_replace("http://", "", $sit);
			
			$sit = trim($sit);
			
			if($sit){

				if(!preg_match("#".$sit."\b#", $aranacak)) { 
				

				$analiz = ahrefsanaliz("http://apiv2.ahrefs.com/?from=metrics_extended&target=".$sit."&mode=domain&output=json");

					$don = json_decode($analiz);
					
					$backlinks = $don->metrics->backlinks;
					$refpages = $don->metrics->refpages;
					$pages = $don->metrics->pages;
					$text = $don->metrics->text;
					$image = $don->metrics->image;
					$sitewide = $don->metrics->sitewide;
					$not_sitewide = $don->metrics->not_sitewide;
					$nofollow = $don->metrics->nofollow;
					$dofollow = $don->metrics->dofollow;
					$redirect = $don->metrics->redirect;
					$canonical = $don->metrics->canonical;
					$gov = $don->metrics->gov;
					$edu = $don->metrics->edu;
					$rss = $don->metrics->rss;
					$alternate = $don->metrics->alternate;
					$html_pages = $don->metrics->html_pages;
					$links_internal = $don->metrics->links_internal;
					$links_external = $don->metrics->links_external;
					$refdomains = $don->metrics->refdomains;
					$refclass_c = $don->metrics->refclass_c;
					$refips = $don->metrics->refips;
					$linked_root_domains = $don->metrics->linked_root_domains;

					
					$domainrating = ahrefsanaliz("http://apiv2.ahrefs.com/?from=domain_rating&target=".$sit."&output=json");
					$domainrating = json_decode($domainrating);
					$domainrating = $domainrating->domain->domain_rating;
						
					//$analiz = ahrefsanaliz("http://apiv2.ahrefs.com/?from=anchors&target=".$sit."&mode=domain&limit=1&output=json&where=anchor%3A%22".urlencode($kelime)."%22");
					
					$analiz = ahrefsanaliz("http://apiv2.ahrefs.com/?from=anchors&target=".$sit."&limit=10&output=json&order_by=backlinks%3Adesc");
					
					$don = json_decode($analiz);				
					
					$kelimeler = NULL;
					
					foreach($don->anchors as $anc){
					
						$kanchor = $anc->anchor;
						$kbacklinks = $anc->backlinks;
						$krefpages = $anc->refpages;
						$krefdomains = $anc->refdomains;
						if(!$kanchor) $kanchor = "no-text";
						$kelimeler .= $kanchor ."||". $kbacklinks ."||". $krefpages ."||". $krefdomains ."|||";
						
					}
					
					$cek = @file_get_contents("http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=".$sit);
					$fb = json_decode($cek);
					$fb1 = ($fb[0]->total_count);
					$fb2 = ($fb[0]->like_count);
					if($fb1 < 1) $fb1 = 0;
					if($fb2 < 1) $fb2 = 0;

					$cek = @file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=".$sit);
					$t = json_decode($cek);
					$t = ($t->count);
					if($t < 1) $t = 0;	
					
					
					$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode("http://".$sit).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
					$curl_results = curl_exec ($curl);
					curl_close ($curl);
					$json = json_decode($curl_results, true);
					$google = isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
					
					@mysql_query("insert into rakip_log values(NULL, '"._UYEID."', '$id', '$sit', '$domainrating', '$backlinks', '$refpages', '$pages', '$text', '$image', '$sitewide', '$not_sitewide', '$nofollow', '$dofollow', '$redirect', '$canonical', '$gov', '$edu', '$rss', '$alternate', '$html_pages', '$links_internal', '$links_external', '$refdomains', '$refclass_c', '$refips', '$linked_root_domains', '$kbacklinks', '$krefpages', '$krefdomains', '$fb1', '$fb2', '$t', '$google', '$kelimeler', '$suan')");
					
					$aranacak = $aranacak ."". $sit ."|";
				
				} // end pregmatch

			} // end if sit
		}
		
		@mysql_query("update rakip set siteler='$aranacak' where id='$id' and uye='"._UYEID."'");
		
		
		die("ok");
		
	}
	else {
	
		die("go to go");
		
	}
	
}

if($islem == "rakipekle"){
	
	include("../fonksiyon.php");
	
	if(uye()){
	
	$kelime = $_POST["s"];
	$site = $_POST["l"];
	$siteler = $_POST["a"];
	
	$kelime = suz2($kelime);
	$site = suz2($site);
	$siteler = suz2($siteler);
	
	$site = str_replace("http://", "", $site);
	
	if($kelime and $site){
	
		include("../fonksiyonsirabulucu.php");
		
		$cek = @file_get_contents("http://".$site);
		
		if(!$cek) die("hata2");
		
		if($siteler){

		list($maxid) = @mysql_fetch_row(@mysql_query("select max(id) from rakip"));
		
		$maxid++;
		
		$suan = @mktime();
		
		$result = mysql_query("insert into rakip (id, uye, kelime, site, kayit) values('$maxid', '"._UYEID."', '$kelime', '$site', '$suan')");
		
			$siteler = explode(",", $siteler);
			
			$s = NULL;
			
			$i = 1;
			
			foreach($siteler as $sit){
				
				if($i >= 11) break;
				
				$sit = str_replace("http://", "", $sit);
				
				$sit = trim($sit);
				
				if($sit){
				
					$analiz = ahrefsanaliz("http://apiv2.ahrefs.com/?from=metrics_extended&target=".$sit."&mode=domain&output=json");

					$don = json_decode($analiz);
					
					$backlinks = $don->metrics->backlinks;
					$refpages = $don->metrics->refpages;
					$pages = $don->metrics->pages;
					$text = $don->metrics->text;
					$image = $don->metrics->image;
					$sitewide = $don->metrics->sitewide;
					$not_sitewide = $don->metrics->not_sitewide;
					$nofollow = $don->metrics->nofollow;
					$dofollow = $don->metrics->dofollow;
					$redirect = $don->metrics->redirect;
					$canonical = $don->metrics->canonical;
					$gov = $don->metrics->gov;
					$edu = $don->metrics->edu;
					$rss = $don->metrics->rss;
					$alternate = $don->metrics->alternate;
					$html_pages = $don->metrics->html_pages;
					$links_internal = $don->metrics->links_internal;
					$links_external = $don->metrics->links_external;
					$refdomains = $don->metrics->refdomains;
					$refclass_c = $don->metrics->refclass_c;
					$refips = $don->metrics->refips;
					$linked_root_domains = $don->metrics->linked_root_domains;

					
					$domainrating = ahrefsanaliz("http://apiv2.ahrefs.com/?from=domain_rating&target=".$sit."&output=json");
					$domainrating = json_decode($domainrating);
					$domainrating = $domainrating->domain->domain_rating;
						
					//$analiz = ahrefsanaliz("http://apiv2.ahrefs.com/?from=anchors&target=".$sit."&mode=domain&limit=1&output=json&where=anchor%3A%22".urlencode($kelime)."%22");
					
					$analiz = ahrefsanaliz("http://apiv2.ahrefs.com/?from=anchors&target=".$sit."&limit=10&output=json&order_by=backlinks%3Adesc");
					
					$don = json_decode($analiz);				
					
					$kelimeler = NULL;
					
					foreach($don->anchors as $anc){
					
						$kanchor = $anc->anchor;
						$kbacklinks = $anc->backlinks;
						$krefpages = $anc->refpages;
						$krefdomains = $anc->refdomains;
						if(!$kanchor) $kanchor = "no-text";
						$kelimeler .= $kanchor ."||". $kbacklinks ."||". $krefpages ."||". $krefdomains ."|||";
						
					}
					
					$cek = @file_get_contents("http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=".$sit);
					$fb = json_decode($cek);
					$fb1 = ($fb[0]->total_count);
					$fb2 = ($fb[0]->like_count);
					if($fb1 < 1) $fb1 = 0;
					if($fb2 < 1) $fb2 = 0;

					$cek = @file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=".$sit);
					$t = json_decode($cek);
					$t = ($t->count);
					if($t < 1) $t = 0;	
					
					
					$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode("http://".$sit).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
					$curl_results = curl_exec ($curl);
					curl_close ($curl);
					$json = json_decode($curl_results, true);
					$google = isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
					
					@mysql_query("insert into rakip_log values(NULL, '"._UYEID."', '$maxid', '$sit', '$domainrating', '$backlinks', '$refpages', '$pages', '$text', '$image', '$sitewide', '$not_sitewide', '$nofollow', '$dofollow', '$redirect', '$canonical', '$gov', '$edu', '$rss', '$alternate', '$html_pages', '$links_internal', '$links_external', '$refdomains', '$refclass_c', '$refips', '$linked_root_domains', '$kbacklinks', '$krefpages', '$krefdomains', '$fb1', '$fb2', '$t', '$google', '$kelimeler', '$suan')");
					
					// unset($kelimeler);
	
					$s .= $sit ."|";
					
					$i++;
				
				}
				
			}
			
			@mysql_query("update rakip set siteler='$s' where id='$maxid' and uye='"._UYEID."'");
				
				
				// ana site analiz bilgileri
				
				$analiz = ahrefsanaliz("http://apiv2.ahrefs.com/?from=metrics_extended&target=".$site."&mode=domain&output=json");

				$don = json_decode($analiz);
				
				$backlinks = $don->metrics->backlinks;
				$refpages = $don->metrics->refpages;
				$pages = $don->metrics->pages;
				$text = $don->metrics->text;
				$image = $don->metrics->image;
				$sitewide = $don->metrics->sitewide;
				$not_sitewide = $don->metrics->not_sitewide;
				$nofollow = $don->metrics->nofollow;
				$dofollow = $don->metrics->dofollow;
				$redirect = $don->metrics->redirect;
				$canonical = $don->metrics->canonical;
				$gov = $don->metrics->gov;
				$edu = $don->metrics->edu;
				$rss = $don->metrics->rss;
				$alternate = $don->metrics->alternate;
				$html_pages = $don->metrics->html_pages;
				$links_internal = $don->metrics->links_internal;
				$links_external = $don->metrics->links_external;
				$refdomains = $don->metrics->refdomains;
				$refclass_c = $don->metrics->refclass_c;
				$refips = $don->metrics->refips;
				$linked_root_domains = $don->metrics->linked_root_domains;

				$domainrating = ahrefsanaliz("http://apiv2.ahrefs.com/?from=domain_rating&target=".$site."&output=json");
				$domainrating = json_decode($domainrating);
				$domainrating = $domainrating->domain->domain_rating;
					
				$analiz = ahrefsanaliz("http://apiv2.ahrefs.com/?from=anchors&target=".$site."&limit=10&output=json&order_by=backlinks%3Adesc");
					
				$don = json_decode($analiz);				
					
				$kelimeler = NULL;
					
				foreach($don->anchors as $anc){
					
						$kanchor = $anc->anchor;
						$kbacklinks = $anc->backlinks;
						$krefpages = $anc->refpages;
						$krefdomains = $anc->refdomains;
						
						if(!$kanchor) $kanchor = "no-text";
						$kelimeler .= $kanchor ."||". $kbacklinks ."||". $krefpages ."||". $krefdomains ."|||";
						
				}
				
					$cek = @file_get_contents("http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=".$site);
					$fb = json_decode($cek);
					$fb1 = ($fb[0]->total_count);
					$fb2 = ($fb[0]->like_count);
					if($fb1 < 1) $fb1 = 0;
					if($fb2 < 1) $fb2 = 0;

					$cek = @file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=".$site);
					$t = json_decode($cek);
					$t = ($t->count);
					if($t < 1) $t = 0;	
					
					
					$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode("http://".$site).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
					$curl_results = curl_exec ($curl);
					curl_close ($curl);
					$json = json_decode($curl_results, true);
					$google = isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
					
				@mysql_query("insert into rakip_log values(NULL, '"._UYEID."', '$maxid', '$site', '$domainrating', '$backlinks', '$refpages', '$pages', '$text', '$image', '$sitewide', '$not_sitewide', '$nofollow', '$dofollow', '$redirect', '$canonical', '$gov', '$edu', '$rss', '$alternate', '$html_pages', '$links_internal', '$links_external', '$refdomains', '$refclass_c', '$refips', '$linked_root_domains', '$kbacklinks', '$krefpages', '$krefdomains', '$fb1', '$fb2', '$t', '$google', '$kelimeler', '$suan')");	
				
				@mysql_query("update rakip set guncelleme='$suan' where id='$maxid' and uye='"._UYEID."'");
				
				die("$maxid");
			
		
		} else {
			die("hata1");
		}
		
	}
	else {
		die("gotogo");
	}
	
		
	}
	else {
		die("gotogo");
	}

}

?>