<?php
error_reporting(0);
ini_set('max_execution_time', 0);
header('Content-Type: text/html; charset=utf-8');
// baglant�
$baglan = @mysql_connect("localhost", "buzyy_veri", "mert2014-") or die("baglanamadim");
mysql_select_db("buzyy_veri", $baglan) or die("Secemedim");
mysql_query("set names 'utf8'",$baglan);

// fonksiyonlar
	function cek($url)
	{
		$user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
		$icerik = curl_exec($ch);
		curl_close($ch);
		return $icerik;
	}

	function googlesira($site, $kelime){
		
		$sira = NULL;
		
		$kelime = urlencode($kelime);
		
		$a = 1;
		
		$site = str_replace("www.", "", $site);
		
		for($j = 0; $j<=9; $j++){
			
			$sayfa = $j ."0";
			
			$cek = "https://www.google.com.tr/search?q=".$kelime."&start=".$sayfa."&lr=tr&hl=tr&oe=utf8&ie=utf8&cr=countryTR";
					
			$cek = cek($cek);
		
			preg_match_all('#<cite(.*?)>(.*?)</cite#si', $cek, $aktar, PREG_SET_ORDER);
	
			foreach($aktar as $ak){
				
				
				$aranacak = strip_tags($ak[2]);
				
				if(preg_match("#".$site."\b#", $aranacak)) { 
					
					return $a;
					
					break;
				
				}
	
				$a++;

			} // end foreach
			
		} // end for j
		
		return false;
	
	} // googlesira()
	
	function yandexsira($site, $kelime){
	
		$sira = NULL;
		
		$kelime = urlencode($kelime);
		
		$a = 1;
		
		$site = str_replace("www.", "", $site);
		
		for($j = 0; $j<=9; $j++){
			
			
			$cek = "http://www.yandex.com.tr/yandsearch?text=".$kelime."&p=".$j."";
					
			$cek = cek($cek);
		
			preg_match_all('#<a class="link serp-url__link" target="_blank" href="(.*?)"(.*?)>(.*?)</a>#si', $cek, $aktar, PREG_SET_ORDER);
	
			foreach($aktar as $ak){
				
				
				$aranacak = strip_tags($ak[1]);
				
				if(preg_match("#".$site."\b#", $aranacak)) { 
					
					return $a;
					
					break;
				
				}
	
				$a++;

			} // end foreach
			
		} // end for j
		
		return false;
		

	
	} // function yandexsira();
	
	function yahoosira($site, $kelime){
	
		$sira = NULL;
		
		$kelime = urlencode($kelime);
		
		$a = 1;
		
		$site = str_replace("www.", "", $site);
		
		for($j = 0; $j<=9; $j++){
			
			if($j == 0) $sayfa = "1";
			else $sayfa = $j ."1";
			
			$cek = "https://search.yahoo.com/search?p=".$kelime."&ei=UTF-8&b=".$sayfa."";
					
			$cek = cek($cek);
		
			preg_match_all('#<span(.*?)class="url"(.*?)>(.*?)</span>#si', $cek, $aktar, PREG_SET_ORDER);
	
			foreach($aktar as $ak){
				
				
				$aranacak = strip_tags($ak[3]);
				
				if(preg_match("#".$site."\b#", $aranacak)) { 
					
					return $a;
					
					break;
				
				}
	
				$a++;

			} // end foreach
			
		} // end for j
		
		return false;
	} // yahoo sira

	
	function bingsira($site, $kelime){
	
		$sira = NULL;
		
		$kelime = urlencode($kelime);
		
		$a = 1;
		
		$site = str_replace("www.", "", $site);
		
		for($j = 0; $j<=9; $j++){
			
			if($j == 0) $sayfa = "1";
			else $sayfa = $j ."1";
			
			$cek = "http://www.bing.com/search?q=".$kelime."&first=".$sayfa."";
					
			$cek = cek($cek);
		
			preg_match_all('#<cite(.*?)>(.*?)</cite>#si', $cek, $aktar, PREG_SET_ORDER);
	
			foreach($aktar as $ak){
				
				
				$aranacak = strip_tags($ak[0]);
				
				if(preg_match("#".$site."\b#", $aranacak)) { 
					
					return $a;
					
					break;
				
				}
	
				$a++;

			} // end foreach
			
		} // end for j
		
		return false;
	} // bing sira
	


	
		$result = mysql_query("select * from kelimeler order by id desc");
		
		$kayit = @mktime();
		
		list($gun,$ay,$yil,$saat,$dakika) = explode("-", date("d-m-y-H-i"));
		
		while($array = mysql_fetch_array($result)){
			
			$kelimeid = $array["id"];
			
			
			$siteid = $array["site"];
			
			
			list($siteadi) = mysql_fetch_row(mysql_query("select site from siteler where id='$siteid'"));
			
			$kelime = $array["kelime"];
			
			
			list($maxlogid) = mysql_fetch_row(mysql_query("select max(id) from kelimeler_log"));
			
			$maxlogid++;
			
			@mysql_query("insert into kelimeler_log (id, kelimeid, siteid, kelime, site, gun, ay, yil, saat, dakika, kayit) values('$maxlogid', '$kelimeid', '$siteid', '$kelime', '$siteadi', '$gun', '$ay', '$yil', '$saat', '$dakika', '$kayit')");
			
							if($array["google"] == 1){
								
								
								
								$sira = googlesira($siteadi, $kelime);
									
								
								if($sira >= 1){
										
									@mysql_query("update kelimeler set googleortasira='".$array["googlesonsira"]."', googleortatarih='".$array["googlesontarih"]."', googlesonsira='$sira', googlesontarih='$kayit' where id='$kelimeid'");
									
									@mysql_query("update kelimeler_log set google='$sira' where id='$maxlogid'");

									if($array["googleeniyi"] < 1){								
											@mysql_query("update kelimeler set googleeniyi='$sira' where id='$kelimeid'");
									}
									else {
										if($sira < $array["googleeniyi"]){
											@mysql_query("update kelimeler set googleeniyi='$sira' where id='$kelimeid'");
										}			
									}
								
								}		


								
							}
							if($array["yandex"] == 1){
								$sira = yandexsira($siteadi, $kelime);
								
								if($sira >= 1){
									
									
									@mysql_query("update kelimeler set yandexortasira='".$array["yandexsonsira"]."', yandexortatarih='".$array["yandexsontarih"]."', yandexsonsira='$sira', yandexsontarih='$kayit' where id='$kelimeid'");
									
									@mysql_query("update kelimeler_log set yandex='$sira' where id='$maxlogid'");
									if($array["yandexeniyi"] < 1){								
											@mysql_query("update kelimeler set yandexeniyi='$sira' where id='$kelimeid'");
									}
									else {
										if($sira < $array["yandexeniyi"]){
											@mysql_query("update kelimeler set yandexeniyi='$sira' where id='$kelimeid'");
										}			
									}
								}						
							}							
							if($array["yahoo"] == 1){
								$sira = yahoosira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set yahooortasira='".$array["yahoosonsira"]."', yahooortatarih='".$array["yahoosontarih"]."', yahoosonsira='$sira', yahoosontarih='$kayit' where id='$kelimeid'");
									
									@mysql_query("update kelimeler_log set yahoo='$sira' where id='$maxlogid'");
									if($array["yahooeniyi"] < 1){								
											@mysql_query("update kelimeler set yahooeniyi='$sira' where id='$kelimeid'");
									}
									else {
										if($sira < $array["yahooeniyi"]){
											@mysql_query("update kelimeler set yahooeniyi='$sira' where id='$kelimeid'");
										}			
									}
								}						
							}
							if($array["bing"] == 1){
								$sira = bingsira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set bingortasira='".$array["bingsonsira"]."', bingortatarih='".$array["bingsontarih"]."',bingsonsira='$sira', bingsontarih='$kayit' where id='$kelimeid'");
									
									@mysql_query("update kelimeler_log set bing='$sira' where id='$maxlogid'");
									if($array["bingeniyi"] < 1){								
											@mysql_query("update kelimeler set bingeniyi='$sira' where id='$kelimeid'");
									}
									else {
										if($sira < $array["bingeniyi"]){
											@mysql_query("update kelimeler set bingeniyi='$sira' where id='$kelimeid'");
										}			
									}
								}						
							}
							
							unset($sira);
			
		
		}	
		
		die("ok");
?>