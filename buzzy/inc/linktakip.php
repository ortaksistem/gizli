<?php
session_start();
ini_set('max_execution_time', 0);
$islem = $_GET["islem"];

if(!$islem) die("Go");


if($islem == "guncelle"){

	include("../fonksiyon.php");
	
	
	if(uye()){
		
		$bitis = @mktime();
		
		$result = mysql_query("select id, site, link from linkler where bitis='1' or bitis > $bitis and uye='"._UYEID."'");
		
		if(@mysql_num_rows($result) >= 1){
		
			while(list($id, $site, $link) = @mysql_fetch_row($result)){
			
				$site = linkduzelt($site);
				$link = linkduzelt($link);
				
				$cek = @file_get_contents("http://".$site);
				
				if(!$cek){
					$durum = 3;
				}
				else {
				
					if(preg_match("#".$link."#si", $cek)) { 
								
							$durum = 1;
							
					}
					else {
						
							$durum = 2;
						
					}
				
				}
				
				
				@mysql_query("update linkler set sondurum='$durum', songoruntulenme='$bitis' where id='$id'");
				
				
				unset($durum);
			
			}
			
			
						$result = mysql_query("select * from linkler where uye='"._UYEID."' order by id desc");
						
						while($array = mysql_fetch_array($result)){
							
							$id = $array["id"];
							$site = stripslashes($array["site"]);
							$link = stripslashes($array["link"]);
							$aciklama = stripslashes($array["aciklama"]);
							$bitis = $array["bitis"];
							$durum = $array["sondurum"];
							
							switch($durum){
								case "1":$durum = "<font color=green>Bulundu</font>";break;
								case "2":$durum = "<font color=red>Bulunamadı</font>";break;
								case "3":$durum = "<font color=red>Siteye Erişilemiyor</font>";break;
								default : $durum = "<font color=black>Aranıcak</font>";break;
							}
							
							if(!$aciklama) $aciklama = "<b>Açıklama : </b> Boş<br /><br />Düzenlemek için üstüne tıklayınız";
							else $aciklama = "<b>Açıklama : </b> <br /><br />$aciklama<br /><br />Düzenlemek için üstüne tıklayınız";
							
							$sonkontrol = date("d.m.Y", $array["songoruntulenme"]);
							$ilkkontrol = date("d.m.Y", $array["ilkgoruntulenme"]);
							
							if($bitis == 1) $bitis = "Süresiz";
							else $bitis = date("d.m.Y", $bitis);
					?>
                        <tr id="link<?=$array["id"];?>">
                            <td class="align-left" id="linksite<?=$id?>"><a href="http://<?=$site?>" target="_blank"><?=$site;?></a></td>
                            <td class="align-center" id="linklink<?=$id?>"><a href="http://<?=$link?>" target="_blank"><?=$link;?></a></td>
                            <td class="align-center"><?=$durum?></td>
                            <td class="align-center"><?=$sonkontrol?></td>
                            <td class="align-center"><?=$bitis?></td>
                            <td class="align-center">
                                <a href="javascript:void(0)" onclick="linksil(<?=$array["id"];?>)">
                                    <img src="Assets/Img/sil.png" /></a></td>
                        </tr>
					<?php	
						}
						
			die();
			
			
		}
		else {
			
			die("<tr><td colspan='7'><p align=center><font color=red>Güncellenecek linkleriniz bulunmamaktadır</font></p></td></tr>");
		}
	
	}
	else {
		die("go to go");
	}

}

if($islem == "linksil"){
	
	$id = $_POST["id"];
	
	if(is_numeric($id)){

	include("../fonksiyon.php");
		if(uye()){
			
			$uyeid = _UYEID;
			
			$result = @mysql_query("delete from linkler where id='$id' and uye='$uyeid'");
			
			if($result){

				
				
			}
			
			
			die("ok");
		
		}

	}
	die("Go");

}

if($islem == "linkduzenle"){
	
	$site = $_POST["s"];
	$link = $_POST["l"];
	$aciklama = $_POST["a"];
	$bitis = $_POST["b"];
	$gun = $_POST["g"];
	$ay = $_POST["ay"];
	$yil = $_POST["y"];
	$id = $_POST["id"];
	
	if(!is_numeric($id) or !$site or !$bitis or !$link) die("İstenilen alanların boş olması mantıklı mı?");

	
	include("../fonksiyon.php");
	
	if(uye()){
		
		$site = suz2($site);
		$link = suz2($link);
		$aciklama = suz2($aciklama);
		$bitis = suz2($bitis);
		$gun = suz2($gun);
		$ay = suz2($ay);
		$yil = suz2($yil);
		$id = suz2($id);

		
		$site = trim($site);
		$link = trim($link);
		$aciklama = trim($aciklama);
		

				
		include("../fonksiyonsirabulucu.php");
		
		$site = linkduzelt($site);
		$link = linkduzelt($link);
		
		$cek = @file_get_contents("http://".$site);
		
		if(!$cek) die("Belirtilen siteye şuanda ulaşılamıyor");
		
		if(preg_match("#".$link."#si", $cek)) { 
					
				$kayit = @mktime();
				
				if($bitis == 1) $bitis = 1;
				else $bitis = @mktime(0,0,0,$ay,$gun,$yil);
				
				$result = mysql_query("update linkler set site='$site', link='$link', aciklama='$aciklama', bitis='$bitis' where id='$id' and uye='"._UYEID."'");
				
				if($result){
					
					die("<font color=green><b>Başarıyla güncellendi</b></font>");
					
				}
				else {
					
					die("<font color=red><b>Güncelleme yapılamıyor</b></font>");
					
				}
				
		}
		else {
			
			die(" Aradığınız link $site adresinde bulamadık. Bu sebeple ekleme yapamıyoruz. Linkin eklendiğinden emin olur musunuz? ");
			
		}
		
		die("$site $link $aciklama $bitis $gun $ay $yil");
				
	}
	else {
		die("go to go");
	}


}

if($islem == "linkekle"){
	
	include("../fonksiyon.php");
	
	if(uye()){
		
		$site = $_POST["s"];
		$link = $_POST["l"];
		$aciklama = $_POST["a"];
		$bitis = $_POST["b"];
		$gun = $_POST["g"];
		$ay = $_POST["ay"];
		$yil = $_POST["y"];
		
		if(!$site or !$bitis or !$link) die("İstenilen alanların boş olması mantıklı mı?");
		
		$site = suz2($site);
		$link = suz2($link);
		$aciklama = suz2($aciklama);
		$bitis = suz2($bitis);
		$gun = suz2($gun);
		$ay = suz2($ay);
		$yil = suz2($yil);

		
		$site = trim($site);
		$link = trim($link);
		$aciklama = trim($aciklama);
		

				
		include("../fonksiyonsirabulucu.php");
		
		$site = linkduzelt($site);
		$link = linkduzelt($link);
		
		$cek = @file_get_contents("http://".$site);
		
		if(!$cek) die("Belirtilen siteye şuanda ulaşılamıyor");
		
		if(preg_match("#".$link."#si", $cek)) { 
					
				$kayit = @mktime();
				
				if($bitis == 1) $bitis = 1;
				else $bitis = @mktime(0,0,0,$ay,$gun,$yil);
				
				$result = mysql_query("insert into linkler (uye,site,link,aciklama,bitis,ilkgoruntulenme,songoruntulenme,sondurum,kayit) values('"._UYEID."', '$site', '$link', '$aciklama', '$bitis', '$kayit', '$kayit', '1', '$kayit')");
				
				if($result){
					
					die("tamam");
					
				}
				else {
					
					die("Şuanda bir hata meydana geldi. Yeniden dener misiniz?");
					
				}
				
		}
		else {
			
			die(" Aradığınız link $site adresinde bulamadık. Bu sebeple ekleme yapamıyoruz. Linkin eklendiğinden emin olur musunuz? ");
			
		}
		
		die("$site $link $aciklama $bitis $gun $ay $yil");
				
	}
	else {
		die("go to go");
	}

}

?>