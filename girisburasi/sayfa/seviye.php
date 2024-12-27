<?

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	if($ad or $icon or $renk){
	$ad = addslashes($ad);
	$result = mysql_query("insert into "._MX."seviye values(NULL, '$ad', '$icon', '$renk', '$oncelik', '$profil', '$goruntuleme', '$profilbakan', '$profilbakan2', '$profilresmi', '$profilresmilimit', '$album', '$albumlimit', '$album2', '$mesaj', '$mesajlimit', '$mesajoku', '$mesajcevapla', '$arama', '$arama2', '$opucuk', '$opucukgor', '$opucukgor2', '$cicek', '$cicekgor', '$cicekgor2', '$yasakla', '$yasaklagor', '$yasaklagor2', '$yasaklagor3', '$yasaklagor4', '$arkadas', '$arkadasgor', '$online', '$sohbet', '$oyun', '$bilgiler', '$arkadaslistele', '$davet', '$mesajfiltre', '$listemele', '$aylik', '$aylik3', '$aylik6', '$yillik', '$sinirsiz', 0, 0, 0, 0)");
	
	if($result) $buton = "<font color=green>Yeni Seviye Kaydedildi</font>";
	else $buton = "<font color=red>Bir hata oluþtu</font>";
	
	}
	else {
	$buton = "<font color=red>Ad, icon ve renk boþ býrakýlamaz</font>";
	}
}
if($islem == "sil"){
	
	$result = mysql_query("delete from "._MX."seviye where id='$id'");
	if($result) $buton = "<font color=green>Seviye baþarýyla silindi</font>";
	else $buton = "<font color=red>Bir hata oluþtu</font>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Üyelik Seviyeleri Yönetimi | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
		<? include("menu/anasayfa.php"); ?>
		
		<div id="center-column">
		
		<?
			if($islem == "duzenle" or $islem == "duzenle2"){
			
			$yap = $_GET["yap"];
			$id = $_GET["id"];
					
			if($yap == "kaydet"){
			
			if(!$mesaj) $mesaj = 0;
			if(!$mesajcevapla) $mesajcevapla = 0;
			if(!$arama2) $arama2 = 0;
			if(!$opucuk) $opucuk = 0;
			if(!$opucukgor) $opucukgor = 0;
			if(!$opucukgor2) $opucukgor2 = 0;
			if(!$cicek) $cicek = 0;
			if(!$cicekgor) $cicekgor = 0;
			if(!$cicekgor2) $cicekgor2 = 0;
			if(!$yasakla) $yasakla = 0;
			if(!$yasaklagor) $yasaklagor = 0;
			if(!$yasaklagor2) $yasaklagor2 = 0;
			if(!$yasaklagor3) $yasaklagor3 = 0;
			if(!$yasaklagor4) $yasaklagor4 = 0;
			if(!$arkadas) $arkadas = 0;
			if(!$arkadasgor) $arkadasgor = 0;
			if(!$online) $online = 0;
			if(!$sohbet) $sohbet = 0;
			if(!$oyun) $oyun = 0;
			if(!$bilgiler) $bilgiler = 0;
			if(!$arkadaslistele) $arkadaslistele = 0;
			if(!$davet) $davet = 0;
			if(!$mesajfiltre) $mesajfiltre = 0;
			if(!$listeleme) $listeleme = 0;
			
			$ad = addslashes($ad);
			$result = mysql_query("update "._MX."seviye set ad='$ad', icon='$icon', renk='$renk', oncelik='$oncelik', profil='$profil', goruntuleme='$goruntuleme', profilbakan='$profilbakan', profilresmi='$profilresmi', profilresmilimit='$profilresmilimit', album='$album', albumlimit='$albumlimit', album2='$album2', mesaj='$mesaj', mesajlimit='$mesajlimit', mesajoku='$mesajoku', mesajcevapla='$mesajcevapla', arama='$arama', arama2='$arama2', opucuk='$opucuk', opucukgor='$opucukgor', opucukgor2='$opucukgor2', cicek='$cicek', cicekgor='$cicekgor', cicekgor2='$cicekgor2', yasakla='$yasakla', yasaklagor='$yasaklagor', yasaklagor2='$yasaklagor2', yasaklagor3='$yasaklagor3', yasaklagor4='$yasaklagor4', arkadas='$arkadas', arkadasgor='$arkadasgor', online='$online', sohbet='$sohbet', oyun='$oyun', bilgiler='$bilgiler', arkadaslistele='$arkadaslistele', davet='$davet', mesajfiltre='$mesajfiltre', listeleme='$listeleme', aylik='$aylik', aylik3='$aylik3', aylik6='$aylik6', yillik='$yillik', sinirsiz='$sinirsiz' where id='$id'");			
			
			if($result) $buton = "<font color=green>Seviye güncellendi</font>";
			else $buton = "<font color=red>Bir hata oluþtu ".mysql_error()."</font>";		
			
			}

			$result = mysql_query("select ad, icon, renk, oncelik, profil, goruntuleme, profilbakan, profilbakan2, profilresmi, profilresmilimit, album, albumlimit, album2, mesaj, mesajlimit, mesajoku, mesajcevapla, arama, arama2, opucuk, opucukgor, opucukgor2, cicek, cicekgor, cicekgor2, yasakla, yasaklagor, yasaklagor2, yasaklagor3, yasaklagor4, arkadas, arkadasgor, online, sohbet, oyun, bilgiler, arkadaslistele, davet, mesajfiltre, listeleme, aylik, aylik3, aylik6, yillik, sinirsiz from "._MX."seviye where id='$id'");
			
			list($ad, $icon, $renk, $oncelik, $profil, $goruntuleme, $profilbakan, $profilbakan2, $profilresmi, $profilresmilimit, $album, $albumlimit, $album2, $mesaj, $mesajlimit, $mesajoku, $mesajcevapla, $arama, $arama2, $opucuk, $opucukgor, $opucukgor2, $cicek, $cicekgor, $cicekgor2, $yasakla, $yasaklagor, $yasaklagor2, $yasaklagor3, $yasaklagor4, $arkadas, $arkadasgor, $online, $sohbet, $oyun, $bilgiler, $arkadaslistele, $davet, $mesajfiltre, $listeleme, $aylik, $aylik3, $aylik6, $yillik, $sinirsiz) = mysql_fetch_row($result);
			
			$ad = stripslashes($ad);
			
			function yap($param){
				if($param) $don = " checked";
				else $don = NULL;
				return $don;
			}
			$profil = yap($profil);
			$goruntuleme = yap($goruntuleme);
			$profilbakan = yap($profilbakan);
			$profilbakan2 = yap($profilbakan2);
			$profilresmi = yap($profilresmi);
			$album = yap($album);
			$album2 = yap($album2);
			$mesaj = yap($mesaj);
			$mesajoku = yap($mesajoku);
			$mesajcevapla = yap($mesajcevapla);
			$arama = yap($arama);
			$arama2 = yap($arama2);
			$opucuk = yap($opucuk);
			$opucukgor = yap($opucukgor);
			$opucukgor2 = yap($opucukgor2);
			$cicek = yap($cicek);
			$cicekgor = yap($cicekgor);
			$cicekgor2 = yap($cicekgor2);
			$yasakla = yap($yasakla);
			$yasaklagor = yap($yasaklagor);
			$yasaklagor3 = yap($yasaklagor3);
			$yasaklagor4 = yap($yasaklagor4);
			$yasaklagor2 = yap($yasaklagor2);
			$arkadas = yap($arkadas);
			$arkadasgor = yap($arkadasgor);
			$online = yap($online);
			$sohbet = yap($sohbet);
			$bilgiler = yap($bilgiler);
			$arkadaslistele = yap($arkadaslistele);
			$oyun = yap($oyun);
			$davet = yap($davet);
			$mesajfiltre = yap($mesajfiltre);
			$listeleme = yap($listeleme);
			
			
		?>
		<form action="index.php?sayfa=seviye&islem=duzenle2&yap=kaydet&id=<?=$id?>" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2"><?=$ad?> Düzenle <?=$buton?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Seviye Adý</strong></td>
						<td class="last"><input type="text" name="ad" id="ad" class="text" value="<?=$ad?>" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Seviye Ýconu</strong></td>
						<td class="last"><input type="text" name="icon" id="icon" class="text" value="<?=$icon?>" style="width:350px" /> * ismi veriniz medium, large, small gibi sistem otomatik yerine göre resim çekicektir. Resim Uzantýlarý Örn;<br>
						
						uye_img_medium.gif, uye_img_medium.gif, profil_iko_uye_medium.gif (Siz sadece medium yazýn ve img klasörüne isimlerdeki resimleri atin</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Seviye Rengi</strong></td>
						<td class="last"><input type="text" name="renk" id="renk" class="text" value="<?=$renk?>" style="width:50px" /> * #ff0000 yada red, blue gibi ingilizce isimler. Kullanýcýnýn nicki her yerde bu rengi alacaktýr.</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Profil Oluþturabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="profil" id="profil"<?=$profil?> /> * Profil ayarlarý yapmayý saðlar</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Profil Görüntüleyebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="goruntuleme" id="goruntuleme"<?=$goruntuleme?> /> * Diðer kullanýcýlarýn profillerini görüntüleyebilir </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Profiline Bakanlarý Görebilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="profilbakan" id="profilbakan"<?=$profilbakan?> /> * Profiline bakanlarý görebilsin</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Baþkalarýnýn Profiline Bakanlarý</strong></td>
						<td class="last"><input type="checkbox" value="1" name="profilbakan2" id="profilbakan2"<?=$profilbakan2?> /> * Baþkalarýnýn profiline bakanlarý görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Profil Resmi Ekleyebilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="profilresmi" id="profilresmi"<?=$profilresmi?> /> * Profil resmi ekleyebilsin</td>
					</tr>
					<tr>
						<td class="first"><strong>Profil Resmi Kaç Adet</strong></td>
						<td class="last"><input type="text" name="profilresmilimit" id="profilresmilimit" value="<?=$profilresmilimit?>" style="width:50px" class="text" /> * Kaç tane profil resmi ekleyebilsin</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Albüm Oluþturabilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="album" id="album"<?=$album?> /> * Albüm oluþturabilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Albüm Kaç Adet</strong></td>
						<td class="last"><input type="text" name="albumlimit" id="albumlimit" value="<?=$albumlimit?>" style="width:50px" class="text" /> * Kaç tane profil resmi ekleyebilsin</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Albüm Görebilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="album2" id="album2"<?=$album2?> /> * Ýzin almadan baþkalarýnýn albümlerini görüntüleyebilir</td>
					</tr>
					
					<tr>
						<td class="first" width="172"><strong>Mesaj Gönderebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="mesaj" id="mesaj"<?=$mesaj?> /> * Özel Mesaj Gönderebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Mesaj Limiti</strong></td>
						<td class="last"><input type="text" name="mesajlimit" id="mesajlimit" class="text" style="width:50px" value="<?=$mesajlimit?>" /> * Üstteki evetse günlük mesaj limiti </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Mesajlarý Okuyabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="mesajoku" id="mesajoku"<?=$mesajoku?> /> * Gelen mesajlarý okuyabilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Mesajlarý cevaplayabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="mesajcevapla" id="mesajcevapla"<?=$mesajcevapla?> /> * Mesajlarý cevaplabilsin </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Basit Arama</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arama" id="arama"<?=$arama?> /> * Basit arama yapabilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Detaylý Arama</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arama2" id="arama2"<?=$arama2?> /> * Detaylý arama yapabilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Öpücük Yollayabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="opucuk" id="opucuk"<?=$opucuk?> /> * Öpücük gönderebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Öpücük Yollayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="opucukgor" id="opucugor"<?=$opucukgor?> /> * Öpücük yollayanlarý görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Baþkalarýna Öpücük Yollayanlarýný Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="opucukgor2" id="opucukgor2"<?=$opucukgor2?> /> * Baþkalarýna öpücük yollayanlarý görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Çiçek Yollayabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="cicek" id="cicek"<?=$cicek?> /> * Çiçek gönderebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Çiçek Yollayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="cicekgor" id="cicekgor"<?=$cicekgor?> /> * Çiçek yollayanlarý görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Baþkalarýna Çiçek Yollayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="cicekgor2" id="cicekgor2"<?=$cicekgor2?> /> * Baþkalarýna çiçek yollayanlarý görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Üye Yasaklayabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasakla" id="yasakla"<?=$yasakla?> /> * Üye Yasaklayabilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Yasaklýlarý Listeleyebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasaklagor" id="yasaklagor"<?=$yasaklagor?> /> * Yasakladýðý üyeleri görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Baþkalarýnýn Yasaklýlarýný Listeleyebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasaklagor2" id="yasaklagor2"<?=$yasaklagor2?> /> * Baþkalarýnýn yasakladýðý üyeleri görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Kendini Yasaklayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasaklagor3" id="yasaklagor3"<?=$yasaklagor3?> /> * Kendini Yasaklayanlarý Görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Baþkasýný Yasaklayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasaklagor4" id="yasaklagor4"<?=$yasaklagor4?> /> * Baþka bir üyeyi yasaklayanlarý görebilsin. </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Arkadaþ Listesi Oluþturabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arkadas" id="arkadas"<?=$arkadas?> /> * Arkadaþ listesi oluþturabilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Online Arkadaþlarýný Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arkadasgor" id="arkadasgor"<?=$arkadasgor?> /> * Arkadaþlarýnýn online/offline olup olmadýðýný görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Online Üyeleri Listeleme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="online" id="online"<?=$online?> /> * Online üyeleri görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Sohbete Girebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="sohbet" id="sohbet"<?=$sohbet?> /> * Canlý sohbete girebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Oyuna Girebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="oyun" id="oyun"<?=$oyun?> /> * Oyuna girebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Özel Bilgileri Görebilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="bilgiler" id="bilgiler"<?=$bilgiler?> /> * Üyelerin mail, telefon, ad soyad gibi özel bilgilerini görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Baþkalarýnýn Arkadaþlarýný Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arkadaslistele" id="arkadaslistele"<?=$arkadaslistele?> /> * Baþkalarýnýn arkadaþlarýný listeleyebilsin. </td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Arama Önceliði</strong></td>
						<td class="last"><input type="text" name="oncelik" id="oncelik" class="text" style="width:50px" value="<?=$oncelik?>" /> * Aramada kaçýncý sýrada çýksýn. 1 en üst 10 en azdýr. Ayný seviyeyi vermemeye dikkat ediniz. </td>
					</tr>
					<tr>
						<td class="first"><strong>Daveti Kullanabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="davet" id="davet"<?=$davet?> /> * Daveti kullanabilmesini saðlar. </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Mesaj Filtresi</strong></td>
						<td class="last"><input type="checkbox" value="1" name="mesajfiltre" id="mesajfiltre"<?=$mesajfiltre?> /> * Mesajlarý filtrelensin </td>
					</tr>
					<tr>
						<td class="first"><strong>Listelenmesin (Önemli)</strong></td>
						<td class="last"><input type="checkbox" value="1" name="listeleme" id="listeleme"<?=$listeleme?> /> * Üyelik yülseltme sayfasýnda listelenmemesini saðlar. Örnegin yönetici seviyesi listelenmez. </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>1 Aylýk Ücret</strong></td>
						<td class="last"><input type="text" name="aylik" id="aylik" class="text" value="<?=$aylik?>" style="width:50px" /> * 1 aylýk ücreti (Tüm ücretleri TL olarak giriniz.)</td>
					</tr>
					<tr>
						<td class="first"><strong>3 Aylýk Ücret</strong></td>
						<td class="last"><input type="text" name="aylik3" id="aylik3" class="text" value="<?=$aylik3?>" style="width:50px" /> * 3 aylýk ücreti </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>6 Aylýk Ücret</strong></td>
						<td class="last"><input type="text" name="aylik6" id="aylik6" class="text" value="<?=$aylik6?>" style="width:50px" /> * 6 aylýk ücreti </td>
					</tr>
					<tr>
						<td class="first"><strong>1 Yýllýk</strong></td>
						<td class="last"><input type="text" name="yillik" id="yillik" class="text" value="<?=$yillik?>" style="width:50px" /> * Yýllýk ücreti </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Sýnýrsýz</strong></td>
						<td class="last"><input type="text" name="sinirsiz" id="sinirsiz" class="text" value="<?=$sinirsiz?>" style="width:50px" /> * Sýnýrsýz ücret </td>
					</tr>
					<tr>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " /></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>		
		<?
			}
			else {
		?>
		<form action="index.php?sayfa=seviye&islem=kaydet" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Yeni Üyelik Seviyesi Ekle <?=$buton?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Seviye Adý</strong></td>
						<td class="last"><input type="text" name="ad" id="ad" class="text" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Seviye Ýconu</strong></td>
						<td class="last"><input type="text" name="icon" id="icon" class="text" style="width:350px" /> * ismi veriniz medium, large, small gibi sistem otomatik yerine göre resim çekicektir. Resim Uzantýlarý Örn;<br>
						
						uye_img_medium.gif, uye_img_medium.gif, profil_iko_uye_medium.gif (Siz sadece medium yazýn ve img klasörüne isimlerdeki resimleri atin</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Seviye Rengi</strong></td>
						<td class="last"><input type="text" name="renk" id="renk" class="text" style="width:50px" /> * #ff0000 yada red, blue gibi ingilizce isimler. Kullanýcýnýn nicki her yerde bu rengi alacaktýr.</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Profil Oluþturabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="profil" id="profil" /> * Profil ayarlarý yapmayý saðlar</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Profil Görüntüleyebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="goruntuleme" id="goruntuleme" /> * Diðer kullanýcýlarýn profillerini görüntüleyebilir </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Profiline Bakanlarý Görebilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="profilbakan" id="profilbakan" /> * Profiline bakanlarý görebilsin</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Baþkalarýnýn Profiline Bakanlarý</strong></td>
						<td class="last"><input type="checkbox" value="1" name="profilbakan2" id="profilbakan2" /> * Baþkalarýnýn profiline bakanlarý görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Profil Resmi Ekleyebilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="profilresmi" id="profilresmi" /> * Profil resmi ekleyebilsin</td>
					</tr>
					<tr>
						<td class="first"><strong>Profil Resmi Kaç Adet</strong></td>
						<td class="last"><input type="text" name="profilresmilimit" id="profilresmilimit" style="width:50px" class="text" /> * Kaç tane profil resmi ekleyebilsin</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Albüm Oluþturabilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="album" id="album" /> * Albüm oluþturabilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Albüm Kaç Adet</strong></td>
						<td class="last"><input type="text" name="albumlimit" id="albumlimit" style="width:50px" class="text" /> * Kaç tane profil resmi ekleyebilsin</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Albüm Görebilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="album2" id="album2" /> * Ýzin almadan baþkalarýnýn albümlerini görüntüleyebilir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Mesaj Gönderebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="mesaj" id="mesaj" /> * Özel Mesaj Gönderebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Mesaj Limiti</strong></td>
						<td class="last"><input type="text" name="mesajlimit" id="mesajlimit" class="text" style="width:50px" /> * Üstteki evetse günlük mesaj limiti </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Mesajlarý Okuyabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="mesajoku" id="mesajoku" /> * Gelen mesajlarý okuyabilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Mesajlarý cevaplayabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="mesajcevapla" id="mesajcevapla" /> * Mesajlarý cevaplabilsin </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Basit Arama</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arama" id="arama" /> * Basit arama yapabilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Detaylý Arama</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arama2" id="arama2" /> * Detaylý arama yapabilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Öpücük Yollayabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="opucuk" id="opucuk" /> * Öpücük gönderebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Öpücük Yollayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="opucukgor" id="opucugor" /> * Öpücük yollayanlarý görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Baþkalarýna Öpücük Yollayanlarýný Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="opucukgor2" id="opucukgor2" /> * Baþkalarýna öpücük yollayanlarý görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Çiçek Yollayabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="cicek" id="cicek" /> * Çiçek gönderebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Çiçek Yollayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="cicekgor" id="cicekgor" /> * Çiçek yollayanlarý görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Baþkalarýna Çiçek Yollayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="cicekgor2" id="cicekgor2" /> * Baþkalarýna çiçek yollayanlarý görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Üye Yasaklayabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasakla" id="yasakla" /> * Üye Yasaklayabilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Yasaklýlarý Listeleyebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasaklagor" id="yasaklagor" /> * Yasakladýðý üyeleri görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Baþkalarýnýn Yasaklýlarýný Listeleyebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasaklagor2" id="yasaklagor2" /> * Baþkalarýnýn yasakladýðý üyeleri görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Kendini Yasaklayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasaklagor3" id="yasaklagor3" /> * Kendini Yasaklayanlarý Görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Baþkasýný Yasaklayanlarý Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="yasaklagor4" id="yasaklagor4" /> * Baþka bir üyeyi yasaklayanlarý görebilsin. </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Arkadaþ Listesi Oluþturabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arkadas" id="arkadas" /> * Arkadaþ listesi oluþturabilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Online Arkadaþlarýný Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arkadasgor" id="arkadasgor" /> * Arkadaþlarýnýn online/offline olup olmadýðýný görebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Online Üyeleri Listeleme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="online" id="online" /> * Online üyeleri görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Sohbete Girebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="sohbet" id="sohbet" /> * Canlý sohbete girebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Oyuna Girebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="oyun" id="oyun" /> * Oyuna girebilsin </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Özel Bilgileri Görebilme</strong></td>
						<td class="last"><input type="checkbox" value="1" name="bilgiler" id="bilgiler" /> * Üyelerin mail, telefon, ad soyad gibi özel bilgilerini görebilsin </td>
					</tr>
					<tr>
						<td class="first"><strong>Baþkalarýnýn Arkadaþlarýný Görebilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="arkadaslistele" id="arkadaslistele" /> * Baþkalarýnýn arkadaþlarýný listeleyebilsin. </td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Arama Önceliði</strong></td>
						<td class="last"><input type="text" name="oncelik" id="oncelik" class="text" style="width:50px" /> * Aramada kaçýncý sýrada çýksýn. 1 en üst 10 en azdýr. Ayný seviyeyi vermemeye dikkat ediniz. </td>
					</tr>
					<tr>
						<td class="first"><strong>Daveti Kullanabilsin</strong></td>
						<td class="last"><input type="checkbox" value="1" name="davet" id="davet" /> * Daveti kullanabilmesini saðlar. </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Mesaj Filtresi</strong></td>
						<td class="last"><input type="checkbox" value="1" name="mesajfiltre" id="mesajfiltre" /> * Mesajlarý filtrelensin </td>
					</tr>
					<tr>
						<td class="first"><strong>Listelenmesin (Önemli)</strong></td>
						<td class="last"><input type="checkbox" value="1" name="listeleme" id="listeleme" /> * Üyelik yülseltme sayfasýnda listelenmemesini saðlar. Örnegin yönetici seviyesi listelenmez. </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>1 Aylýk Ücret</strong></td>
						<td class="last"><input type="text" name="aylik" id="aylik" class="text" style="width:50px" /> * 1 aylýk ücreti (Tüm ücretleri TL olarak giriniz.)</td>
					</tr>
					<tr>
						<td class="first"><strong>3 Aylýk Ücret</strong></td>
						<td class="last"><input type="text" name="aylik3" id="aylik3" class="text" style="width:50px" /> * 3 aylýk ücreti </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>6 Aylýk Ücret</strong></td>
						<td class="last"><input type="text" name="aylik6" id="aylik6" class="text" style="width:50px" /> * 6 aylýk ücreti </td>
					</tr>
					<tr>
						<td class="first"><strong>1 Yýllýk</strong></td>
						<td class="last"><input type="text" name="yillik" id="yillik" class="text" style="width:50px" /> * Yýllýk ücreti </td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Sýnýrsýz</strong></td>
						<td class="last"><input type="text" name="sinirsiz" id="sinirsiz" class="text" style="width:50px" /> * Sýnýrsýz ücret </td>
					</tr>
					<tr>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " /></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		<?
			}
		?>
			<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="277">Seviye Adý</th>
						<th>Ýcon</th>
						<th>Ana Profil</th>
						<th>Arama Önceliði</th>
						<th>Düzenle</th>
						<th class="last">Sil</th>
					</tr>
					<?
						$result = mysql_query("select id, ad, icon, renk, oncelik from "._MX."seviye order by oncelik asc");
						$i = 1;
						list($anaprofil) = mysql_fetch_row(mysql_query("select seviye from "._MX."ayarlar"));
						while(list($id, $ad, $icon, $renk, $oncelik) = mysql_fetch_row($result)){
						
						$ad = stripslashes($ad);
						
						if($i%2 == 0) $bg = " class=\"bg\"";
					?>
					<tr<?=$bg?>>
						<td class="first style1"> <font color="<?=$renk?>"><?=$ad?></font></td>
						<td><img src="../img/uyelik_ufak_<?=$icon?>.gif" /></td>
						<td>
						<?
							if($anaprofil == $id){ echo "<font color=green><b>Evet</b></font>"; }
							else { echo "<font color=red><b>-</b></font>"; }
						?>	
						</td>
						<td><?=$oncelik?></td>
						<td><a href="index.php?sayfa=seviye&islem=duzenle&id=<?=$id?>" title="Düzenle"><img src="img/edit-icon.gif" width="16" height="16" /></a></td>
						<td class="last"><a href="index.php?sayfa=seviye&islem=sil&id=<?=$id?>" title="Sil" onclick="return confirm('Silmek istediðinizden Emin Misiniz?')"><img src="img/hr.gif" width="16" height="16" /></a></td>
					</tr>
					
					<?
						unset($bg);
						$i++;
						}
					?>
				</table>
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Açýklayýcý bilgiler yanlarýnda yazmaktadýr. Seviyeleri ayarladýktan sonra mutlaka site ayarlarýna gidip ana kullanýcý hesabýný seçiniz. Ekli seviyeler sayfanýn altýndadýr.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
