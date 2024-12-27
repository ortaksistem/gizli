<?php
session_start();
ini_set('max_execution_time', 0);
$islem = $_GET["islem"];

if(!$islem) die("Go");


if($islem == "sitesil"){
	
	$id = $_POST["id"];
	
	if(is_numeric($id)){

	include("../fonksiyon.php");
		if(uye()){
			
			$uyeid = _UYEID;
			
			$result = @mysql_query("delete from siteler where id='$id' and uye='$uyeid'");
			
			if($result){
				
				@mysql_query("delete from kelimeler where site='$id'");
				
				@mysql_query("delete from kelimeler_log where site='$id'");
				
				
			}
			
			
			die("ok");
		
		}

	}
	die("Go");

}

if($islem == "kelimesil"){
	
	$id = $_POST["id"];
	
	if(is_numeric($id)){

	include("../fonksiyon.php");
	
		if(uye()){
			
			$uyeid = _UYEID;
			
			list($site) = mysql_fetch_row(mysql_query("select site from kelimeler where id='$id'"));
			
			$kimin = @mysql_query("select id from siteler where id='$site' and uye='$uyeid'");
			
			if(@mysql_num_rows($kimin) < 1){
				
				die("hata candir");
			
			}
			
			$result = @mysql_query("delete from kelimeler where id='$id'");
			
			if($result){
				
				
				@mysql_query("delete from kelimeler_log where kelimeid='$id'");
				
				
			}
			
			
			die("ok");
		
		}

	}
	die("Go");

}

if($islem == "siteguncelle"){

	include("../fonksiyon.php");
	
	if(uye()){
		
		$site = $_POST["id"];
		
		if(!is_numeric($site)) die("İstenilen alanların boş olması mantıklı mı?");
		
		$site = suz2($site);
		$site = trim($site);
		
		$uyeid = _UYEID;
		
		$result = mysql_query("select id, site from siteler where id='$site' and uye='$uyeid'");
		
		if(@mysql_num_rows($result) < 1){
		
			die("Nereye agam pasam");
			
		}
		
		list($siteid, $siteadi) = mysql_fetch_row($result);
		
		
		
		$result = mysql_query("select * from kelimeler where site='$siteid'");
		
		$kayit = @mktime();
		
		include("../fonksiyonsirabulucu.php");
		
		while($array = mysql_fetch_array($result)){
			
			$kelimeid = $array["id"];
			
			$kelime = $array["kelime"];
			
			
							if($array["google"] == 1){
								$sira = googlesira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set googleortasira='".$array["googlesonsira"]."', googleortatarih='".$array["googlesontarih"]."', googlesonsira='$sira', googlesontarih='$kayit' where id='$kelimeid'");
									
								
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

	}
	else {
		die("Ok mok kok");
	}

}
if($islem == "kelimeekle"){
	
	include("../fonksiyon.php");
	
	if(uye()){
		
		$site = $_POST["s"];
		$kelime = $_POST["k"];
		$google = $_POST["g"];
		$yandex = $_POST["ya"];
		$yahoo = $_POST["y"];
		$bing = $_POST["b"];
		
		if(!is_numeric($site) or !$kelime) die("İstenilen alanların boş olması mantıklı mı?");
		
		$site = suz2($site);
		$kelime = suz2($kelime);
		$google = suz2($google);
		$yandex = suz2($yandex);
		$yahoo = suz2($yahoo);
		$bing = suz2($bing);
		
		if($google != 1) $google = 0;
		if($yandex != 1) $yandex = 0;
		if($yahoo != 1) $yahoo = 0;
		if($bing != 1) $bing = 0;
		
		$site = trim($site);
		
		$uyeid = _UYEID;
		
		$result = mysql_query("select site from siteler where id='$site' and uye='$uyeid'");
		
		if(@mysql_num_rows($result) >= 1){

				$kelimeler = explode(",", $kelime);
				
				$a = 0;
				
				$siteid = $site;
				
				list($ite) = mysql_fetch_row($result);
				
				$kayit = @mktime();
				
				include("../fonksiyonsirabulucu.php");
				
				foreach($kelimeler as $kelime){
					
					$kelime = trim($kelime);
					
					if($kelime){
						
						
						list($warmi) = @mysql_fetch_row(@mysql_query("select count(id) from kelimeler where site='$siteid' and kelime='$kelime'"));
						
						if($warmi < 1){
						
						
							list($kelimeid) = mysql_fetch_row(mysql_query("select max(id) from kelimeler"));
								
							$kelimeid++;
							
							$kelime = suz2($kelime);
							
							@mysql_query("insert into kelimeler (id, site, kelime, google, yandex, yahoo, bing, kayit, durum) values('$kelimeid', '$siteid', '$kelime', '$google', '$yandex', '$yahoo', '$bing', '$kayit', '1')");

							

								if($google == 1){
									$sira = googlesira($site, $kelime);
									
									if($sira >= 1){
										
										@mysql_query("update kelimeler set googleilksira='$sira', googleilktarih='$kayit', googlesonsira='$sira', googlesontarih='$kayit', googleortasira='$sira', googleortatarih='$kayit', googleeniyi='$sira' where id='$kelimeid'");
									
									}						
								}
								if($yandex == 1){
									$sira = yandexsira($site, $kelime);
									
									if($sira >= 1){
										
										@mysql_query("update kelimeler set yandexilksira='$sira', yandexilktarih='$kayit', yandexsonsira='$sira', yandexsontarih='$kayit', yandexortasira='$sira', yandexortatarih='$kayit', yandexeniyi='$sira' where id='$kelimeid'");
									
									}						
								}							
								if($yahoo == 1){
									$sira = yahoosira($site, $kelime);
									
									if($sira >= 1){
										
										@mysql_query("update kelimeler set yahooilksira='$sira', yahooilktarih='$kayit', yahoosonsira='$sira', yahoosontarih='$kayit', yahooortasira='$sira', yahooortatarih='$kayit', yahooeniyi='$sira' where id='$kelimeid'");
									
									}						
								}
								if($bing == 1){
									$sira = bingsira($site, $kelime);
									
									if($sira >= 1){
										
										@mysql_query("update kelimeler set bingilksira='$sira', bingilktarih='$kayit', bingsonsira='$sira', bingsontarih='$kayit', bingortasira='$sira', bingortatarih='$kayit', bingeniyi='$sira' where id='$kelimeid'");
									
									}						
								}
							
								unset($sira);

							$a++;
						
						} // end $warmi
					
					} // end kelime varmı
				
				} // end foreach
				
				
				die("tamam");
				die("Site ve $a kelime eklendi. <a href='javascript:void(0)' onclick='siteeklekapat()'><b>Kapat</b></a>");
		
		
		} // end mysql num rows
		else {
			
			die("Site sizin gibi durmuyor");
			
		}
		
		
	}
	else {
		
		die("Gel bebegim");
		
	}
}
if($islem == "siteekle"){
	
	include("../fonksiyon.php");
	
	
	if(uye()){
		
		$site = $_POST["s"];
		$kelime = $_POST["k"];
		$google = $_POST["g"];
		$yandex = $_POST["ya"];
		$yahoo = $_POST["y"];
		$bing = $_POST["b"];
		
		if(!$site or !$kelime) die("İstenilen alanların boş olması mantıklı mı?");
		
		$site = suz2($site);
		$kelime = suz2($kelime);
		$google = suz2($google);
		$yandex = suz2($yandex);
		$yahoo = suz2($yahoo);
		$bing = suz2($bing);
		
		if($google != 1) $google = 0;
		if($yandex != 1) $yandex = 0;
		if($yahoo != 1) $yahoo = 0;
		if($bing != 1) $bing = 0;
		
		$site = trim($site);
		
		$uyeid = _UYEID;
		
		$site = str_replace("http://", "", $site);
		$site = str_replace("www.", "", $site);
		

		$sitetest = @file_get_contents("http://$site");
		
		if(!$sitetest){
		
			die("Geçerli bir site adresi giriniz");
		
		}

		
		$result = mysql_query("select id from siteler where uye='$uyeid' and site='$site'");
		
		$kayit = @mktime();
		

		if(@mysql_num_rows($result) >= 1){
			
			die("Bu site daha önce eklenmiştir.");
		
		}
		
			list($siteid) = mysql_fetch_row(mysql_query("select max(id) from siteler"));
			
			$siteid++;

			$result = mysql_query("insert into siteler (id, uye, site, kayit, durum) values('$siteid', '$uyeid', '$site', '$kayit', '1')");
			
			if($result){
				
				$kelimeler = explode(",", $kelime);
				
				$a = 0;
				
				include("../fonksiyonsirabulucu.php");
				
				foreach($kelimeler as $kelime){
					
					$kelime = trim($kelime);
					
					if($kelime){
						
						
						list($warmi) = @mysql_fetch_row(@mysql_query("select count(id) from kelimeler where site='$siteid' and kelime='$kelime'"));
						
						if($warmi < 1){
						
						
							list($kelimeid) = mysql_fetch_row(mysql_query("select max(id) from kelimeler"));
								
							$kelimeid++;
							
							$kelime = suz2($kelime);
							
							@mysql_query("insert into kelimeler (id, site, kelime, google, yandex, yahoo, bing, kayit, durum) values('$kelimeid', '$siteid', '$kelime', '$google', '$yandex', '$yahoo', '$bing', '$kayit', '1')");

							

								if($google == 1){
									$sira = googlesira($site, $kelime);
									
									if($sira >= 1){
										
										@mysql_query("update kelimeler set googleilksira='$sira', googleilktarih='$kayit', googlesonsira='$sira', googlesontarih='$kayit', googleortasira='$sira', googleortatarih='$kayit', googleeniyi='$sira' where id='$kelimeid'");
									
									}						
								}
								if($yandex == 1){
									$sira = yandexsira($site, $kelime);
									
									if($sira >= 1){
										
										@mysql_query("update kelimeler set yandexilksira='$sira', yandexilktarih='$kayit', yandexsonsira='$sira', yandexsontarih='$kayit', yandexortasira='$sira', yandexortatarih='$kayit', yandexeniyi='$sira' where id='$kelimeid'");
									
									}						
								}							
								if($yahoo == 1){
									$sira = yahoosira($site, $kelime);
									
									if($sira >= 1){
										
										@mysql_query("update kelimeler set yahooilksira='$sira', yahooilktarih='$kayit', yahoosonsira='$sira', yahoosontarih='$kayit', yahooortasira='$sira', yahooortatarih='$kayit', yahooeniyi='$sira' where id='$kelimeid'");
									
									}						
								}
								if($bing == 1){
									$sira = bingsira($site, $kelime);
									
									if($sira >= 1){
										
										@mysql_query("update kelimeler set bingilksira='$sira', bingilktarih='$kayit', bingsonsira='$sira', bingsontarih='$kayit', bingortasira='$sira', bingortatarih='$kayit', bingeniyi='$sira' where id='$kelimeid'");
									
									}						
								}
							
								unset($sira);

							$a++;
						
						} // end $warmi
					
					} // end kelime varmı
				
				} // end foreach
				
				
				die("tamam");
				die("Site ve $a kelime eklendi. <a href='javascript:void(0)' onclick='siteeklekapat()'><b>Kapat</b></a>");
				
			}
			else {
				
				die("Site eklenemedi, tekrar dener misiniz?");
			
			}
	}
	else {
		die("Gel aşkım gel");
	}

}

?>