<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die(2);

include("../ayarlar.php");
include("../fonksiyon.php");

$uye = uyeid();
$uyeadi = uyeadi();

if(!$uye) die(1);

function kalanzaman($param){
	
	$simdi = time();
	
	$kalan = $simdi - $param;
	
	$saniye = $kalan;
	$dakika = round($kalan/60); // saniye
	$saat = round($kalan/3600); // dakika
	$gun = round($kalan/86400); // saat
	
	if($saniye < 60){
		return $saniye ." saniye önce";
	}
	else if($dakika < 60) {
		return $dakika ." dakika önce";
	}
	else if($saat < 24){
		return $saat ." saat önce";
	}
	else if($gun < 30){
		return $gun ." gün önce";
	}
	else {
		return date("d.m.Y H:i");
	}
}

function resmikesss($source, $dest) {
	$nw = 130;
	$nh = 100;
	$stype = explode(".", $source);
	$stype = $stype[count($stype)-1];
    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];
    switch($stype) {
        case 'gif':
        $simg = imagecreatefromgif($source);
        break;
        case 'jpg':
        $simg = imagecreatefromjpeg($source);
        break;
        case 'png':
        $simg = imagecreatefrompng($source);
        break;
    }
    $dimg = imagecreatetruecolor($nw, $nh);
    $wm = $w/$nw;
    $hm = $h/$nh;
    $h_height = $nh/2;
    $w_height = $nw/2;
    if($w> $h) {
        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;
        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
    } elseif(($w <$h) || ($w == $h)) {
        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;
        imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
    } else {
        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
    }
    imagejpeg($dimg,$dest,100);
}
// bitti

if($islem == "durum"){

	$mesaj = $_POST["mesaj"];
	
	$icerik = $_POST["icerik"];
	
	$mesaj = strip_tags(turkce($mesaj), "<(.*?)>");
	
	$icerik = strip_tags(turkce($icerik), "<(.*?)>");
	
	$mesaj = suz($mesaj);
	
	$icerik = suz($icerik);
	
	
	if(!$icerik) $icerik = NULL;
	
	$kayit = time();
	
	$neredengeliyor = $_POST["neredengeliyor"];
	
	$avatar = uyebilgi("avatar");
	
	if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') {
		$avatar = "img_uye/".uyebilgi("cinsiyet").".gif";
	}
	
	$result = mysql_query("insert into "._MX."duvar (id, uye, uyeadi, avatar, tur, baslik, icerik, kayit, durum) values(NULL, '$uye', '$uyeadi', '$avatar', '1', '$mesaj', '$icerik', '$kayit', '2')");

	if($result) {
		
		if($neredengeliyor == "mobil") die("ok");
		
		$mesaj = turkcejquery($mesaj);
		$uyeadi = turkcejquery($uyeadi);
	
	?>
		<div class="gonderi">
			<div class="avatar"><img src="<?=$avatar?>" /></div>
			<div class="nick"><a href="javascript:void(0)"><?=$uyeadi?></a> <span>[Az Once]</span></div>
			<div class="aciklama"><?=$mesaj?></div>
			<div class="yorumyap">
				<font color="red">Onay beklemektedir</font>
			</div>
		</div>
		<div class="temizle"></div>
		<div class="cizgi"></div>
	<?
	}
	else die("hata");

}

if($islem == "video"){
	
	$neredengeliyor = $_POST["neredengeliyor"];
	
	if($neredengeliyor == "mobil"){
		
		
	
		$mesaj = $_POST["mesaj"];
		
		$icerik = $_POST["icerik"];
		
		$mesaj = strip_tags(turkce($mesaj), "<(.*?)>");
		
		$mesaj = suz($mesaj);
		
		if(strpos($icerik, "youtube.com")){
			
			list($ex1, $ex2) = explode("v=", $icerik); 
			
			
			$icerik = '<iframe width="380" height="214" src="https://www.youtube.com/embed/'.$ex2.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
			
		}
		
		$icerik = turkce($icerik);
		
		$icerik = suz($icerik);
		
		
		if(!$icerik) $icerik = NULL;
		
		$kayit = time();
		
		
		
		$avatar = uyebilgi("avatar");
		
		if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') {
			$avatar = "img_uye/".uyebilgi("cinsiyet").".gif";
		}
		
		$result = mysql_query("insert into "._MX."duvar (id, uye, uyeadi, avatar, tur, baslik, icerik, kayit, durum) values(NULL, '$uye', '$uyeadi', '$avatar', '2', '$mesaj', '$icerik', '$kayit', '2')");

		if($result) die("ok");
		else die("hata");
		
	
	} else {
	
		$mesaj = $_POST["mesaj"];
		
		$mesaj = strip_tags(turkce($mesaj), "<(.*?)>");
		
		$mesaj = suz($mesaj);
		
		$mesaj = trim($mesaj);
		
		$cek = @file_get_contents($mesaj);
		
		/*
		  <meta property="og:url" content="http://www.youtube.com/watch?v=WZURsOlV8d8">

		  <meta property="og:title" content="Golf VI 1.2 TSI 3th gear acceleration">
		  <meta property="og:description" content="This video was uploaded from an Android phone.">
		  <meta property="og:type" content="video">
		  <meta property="og:image" content="http://i4.ytimg.com/vi/WZURsOlV8d8/hqdefault.jpg">
			<meta property="og:video" content="http://www.youtube.com/v/WZURsOlV8d8?version=3&amp;autohide=1">
		  <meta property="og:video:type" content="application/x-shockwave-flash">
		  <meta property="og:video:width" content="396">
		  <meta property="og:video:height" content="297">
		  <meta property="og:site_name" content="YouTube">

		*/
		
		if(!$cek) die("hata1");
		
		preg_match('#<title>(.*?)</title>#si', $cek, $baslik);
		preg_match('#<meta property="og:image" content="(.*?)">#si', $cek, $resim);
		preg_match('#<meta property="og:url" content="(.*?)">#si', $cek, $video);
		preg_match('#<meta property="og:video:width" content="(.*?)">#si', $cek, $genislik);
		preg_match('#<meta property="og:video:height" content="(.*?)">#si', $cek, $yukseklik);
		
		
		$baslik = turkce(trim(str_replace("- YouTube", "", $baslik[1])));
		$resim = $resim[1];
		$video = $video[1];
		$genislik = $genislik[1];
		$yukseklik = $yukseklik[1];
		
		
		$video = explode("v=", $video);

		$video = $video[1];

		
		if(!$baslik) die("hata");
		if(!$resim) die("hata");
		if(!$video) die("hata");
		if(!$yukseklik) die("hata");
		if(!$genislik) die("hata");
		

		$icerik = "398||224||http://www.youtube.com/v/".$video."?version=3&amp;autohide=1";
		
		$icerik = stripslashes($icerik);
		$baslik = stripslashes($baslik);
		
		$kayit = time();
		
		$avatar = uyebilgi("avatar");
		
		if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') {
			$avatar = "img_uye/".uyebilgi("cinsiyet").".gif";
		}
		
		$result = mysql_query("insert into "._MX."duvar (id, uye, uyeadi, avatar, tur, baslik, icerik, resim, kayit, durum) values(NULL, '$uye', '$uyeadi', '$avatar', '2', '$baslik', '$icerik', '$resim', '$kayit', '2')");

		if($result) {
		$baslik = turkcejquery($baslik);
		$uyeadi = turkcejquery($uyeadi);
		
		?>
			<div class="gonderi">
				<div class="avatar"><img src="<?=$avatar?>" /></div>
				<div class="nick"><a href="javascript:void(0)"><?=$uyeadi?></a> <span>[Az Once]</span></div>
				<div class="aciklama">
					<img src="<?=$resim?>" width="130" /><?=$baslik?>
				</div>
				<div class="yorumyap">
					<font color="red">Onay beklemektedir</font>
				</div>
			</div>
			<div class="temizle"></div>
			<div class="cizgi"></div>
		<?
		}
		else die("hata");
	
	}
}

if($islem == "resim"){
	
	$baslik = $_POST["fotografinput"];
	
	$neredengeliyor = $_POST["neredengeliyor"];
	
	$baslik = strip_tags(turkce($baslik), "<(.*?)>");
	
	$baslik = turkce(suz($baslik));
	
	if($baslik == "Fotoðraf baþlýðý yazabilirsiniz") $baslik = NULL;
	$resim2 = $_POST["resim2"];
	
	$resim2 = strip_tags(turkce($resim2), "<(.*?)>");
	
	$resim2 = suz($resim2);	
	
	$dosyatmp = $_FILES['resim']['tmp_name'];
	$dosyatip = $_FILES['resim']['type'];
	
	
	if($dosyatmp or $resim2){
		
		if($dosyatmp){
		
			if ($dosyatip == "image/gif") $uzanti = "gif";
			if ($dosyatip == "image/jpeg") $uzanti = "jpg";
			if ($dosyatip == "image/pjpeg") $uzanti = "jpg";
			if ($dosyatip == "image/png") $uzanti = "png";
			if($uzanti == "gif" or $uzanti == "jpg" or $uzanti == "png"){
	
	
				if(is_uploaded_file($dosyatmp)){
				
					list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."duvar"));
					
					$maxid++;
					
					if(move_uploaded_file($dosyatmp, "../img_uye/duvar/$maxid-$uye.$uzanti")){
					
					@resmikesss("../img_uye/duvar/$maxid-$uye.$uzanti", "../img_uye/duvar_thumb/$maxid-$uye.$uzanti");
					
					include("../fonksiyon2.php");
					if($uzanti == "png"){
						
						@png2jpg("../img_uye/resim/$maxid-$uyeid.$uzanti", "../img_uye/resim/$maxid-$uyeid.jpg");
						
						$uzanti = "jpg";
					}
					@resmeyaz("../img_uye/duvar/$maxid-$uye.$uzanti", "../img_uye/duvar/$maxid-$uye.$uzanti");
					
					$kayit = time();
					
					$resimbaslik = $_POST["baslik"];
					
					$resimbaslik = addslashes(strip_tags(turkce($resimbaslik)));
					
					if($resimbaslik) $baslik = $resimbaslik;
					
					if(!$baslik) $baslik = date("d.m.Y H:i");
					
					$avatar = uyebilgi("avatar");
					
					if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') {
						$avatar = "img_uye/".uyebilgi("cinsiyet").".gif";
					}
					
					$resim = "img_uye/duvar/$maxid-$uye.$uzanti";
					
					$result = mysql_query("insert into "._MX."duvar (id, uye, uyeadi, avatar, tur, baslik, icerik, resim, kayit, durum) values(NULL, '$uye', '$uyeadi', '$avatar', '3', '$baslik', NULL, '$resim', '$kayit', '2')");
					
					if($neredengeliyor == "mobil") die("ok");
					
					?>
					<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('yuklendi');</script>
					<?
					
					die();
					
					}
					
				}
				
				if($neredengeliyor == "mobil") die("hata");
				
					?>
					<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('yuklenemedi');</script>
					<?
					
				die();
	
	
		
			
			}
			else {
				
				if($neredengeliyor == "mobil") die("uzanti");
					?>
					<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('uzanti');</script>
					<?
					
				die();
			}
		
		}
		else if($resim2){
			
			$uzanti = explode(".", $resim2);
			
			$uzanti = $uzanti[count($uzanti)-1];
			
			if($uzanti == "gif" or $uzanti == "jpg" or $uzanti == "png"){

				list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."duvar"));
					
				$maxid++;
					
				if(@copy($resim2, "../img_uye/duvar/$maxid-$uye.$uzanti")){
				
					@resmikesss("../img_uye/duvar/$maxid-$uye.$uzanti", "../img_uye/duvar_thumb/$maxid-$uye.$uzanti");
						
					$kayit = time();
					
					$resimbaslik = $_POST["baslik"];
					
					$resimbaslik = addslashes(strip_tags(turkce($resimbaslik)));
					
					if($resimbaslik) $baslik = $resimbaslik;
					
					if(!$baslik) $baslik = date("d.m.Y H:i");
					
					$avatar = uyebilgi("avatar");
					
					if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') {
						$avatar = "img_uye/".uyebilgi("cinsiyet").".gif";
					}
					
					$resim = "img_uye/duvar/$maxid-$uye.$uzanti";
					
					$result = mysql_query("insert into "._MX."duvar (id, uye, uyeadi, avatar, tur, baslik, icerik, resim, kayit, durum) values(NULL, '$uye', '$uyeadi', '$avatar', '3', '$baslik', NULL, '$resim', '$kayit', '2')");
					
					if($neredengeliyor == "mobil") die("ok");
					
					?>
					<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('yuklendi');</script>
					<?
					
					die();
				
				}
					if($neredengeliyor == "mobil") die("hata");
					?>
					<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('yuklenemedi');</script>
					<?
					
				die();
				
				
			}
			else {
					if($neredengeliyor == "mobil") die("uzanti");
			
					?>
					<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('uzanti');</script>
					<?
					
				die();
			}
		
		}
		else {
			if($neredengeliyor == "mobil") die("resimyok");
		?>
		<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('resimyok');</script>
		<?
		}
	
	}
	else {
		
		if($neredengeliyor == "mobil") die("resimyok");
	?>
	<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('resimyok');</script>
	<?
	}

}

if($islem == "yorum"){
	
	$id = $_POST["id"];
	
	if(!is_numeric($id)) die("hata");
	
	$mesaj = $_POST["mesaj"];
	
	$mesaj = strip_tags(turkce($mesaj), "<(.*?)>");
	
	$mesaj = suz($mesaj);
	
	$kayit = time();
	
	$avatar = uyebilgi("avatar");

	if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') {
		$avatar = "img_uye/".uyebilgi("cinsiyet").".gif";
	}
	
	$durum = 2;
	
	$result = mysql_query("insert into "._MX."duvar_yorum (id, icerik, uye, uyeadi, avatar, yorum, begen, kayit, durum) values(NULL, '$id', '$uye', '$uyeadi', '$avatar', '$mesaj', '0', '$kayit', '$durum')");
	
	if($result) {
	$mesaj = turkcejquery($mesaj);
	
	if($durum == 1){
		mysql_query("update "._MX."duvar set yorum=yorum+1 where id='$id'");
	}
	?>
					<a href="javascript:void(0)"><img src="<?=$avatar?>" /></a>
					<div class="yorumu">
					<a href="javascript:void(0)" class="nickname"><?=$uyeadi?></a> <?=$mesaj?>
					<p class="tarih">Az once yazildi</span> <a href="javascript:void(0)">Onay Bekliyor</a></p>
					</div>
	<?
	}
	else die("hata");
}

if($islem == "tumyorumlar"){

	$id = $_POST["id"];
	
	
	if(!is_numeric($id)) die("hata");
	
				$resultyorum = mysql_query("select id, uye, uyeadi, avatar, yorum, begen, begenliste, kayit from "._MX."duvar_yorum where icerik='$id' and durum='1' order by id asc");
				
					while(list($yorumid, $yorumuye, $yorumuyeadi, $yorumavatar, $yorum, $begen, $begenliste, $kayit) = mysql_fetch_row($resultyorum)){
					
					$kayit = kalanzaman($kayit);
					
					$yorum = turkcejquery(stripslashes($yorum));
					
					$yorumuyeadi = turkcejquery($yorumuyeadi);
					
					if(strstr($begenliste, $uye ."|". $uyeadi)) {
						$begenmebuton1 = "display:none";
						$begenmebuton2 = NULL;
					}
					else {
						$begenmebuton2 = "display:none";
						$begenmebuton1 = NULL;			
					}
					?>
				<div class="yorum">
					<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=profil&id=<?=$yorumuye?>', '745', '700', 'profilpopup<?=$yorumuye?>', 2, 1, 1);" title="Profiline Bak"><img src="<?=$yorumavatar?>" /></a>
					<div class="yorumu">
					<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=profil&id=<?=$yorumuye?>', '745', '700', 'profilpopup<?=$yorumuye?>', 2, 1, 1);" title="Profiline Bak"><?=$yorumuyeadi?></a> <?=$yorum?>
					<p class="tarih"><?=turkcejquery($kayit);?></span> <a href="javascript:void(0)" onclick="yorumbegen(<?=$yorumid?>)" id="yorumbegenme<?=$yorumid?>1" style="<?=$begenmebuton1?>"><?=turkcejquery("Beðen");?></a> <a href="javascript:void(0)" onclick="yorumvazgec(<?=$yorumid?>)" id="yorumbegenme<?=$yorumid?>2" style="<?=$begenmebuton2?>"><?=turkcejquery("Beðenmekten Vazgeç");?></a> (<span id="yorumbegenensayisi<?=$yorumid?>"><?=$begen?></span> <?=turkcejquery("kiþi beðendi");?>)</p>
					</div>
				</div>
					<?
					
					}
					
					die();
					
}

if($islem == "begen"){
	$id = $_POST["id"];
	
	
	if(!is_numeric($id)) die("hata");
	
	list($begenliste) = mysql_fetch_row(mysql_query("select begenliste from "._MX."duvar where id='$id'"));
	
	if(!strstr($begenliste, $uye."|".$uyeadi."||")){
		
		$begenliste = $uye ."|". $uyeadi."||". $begenliste;
		
		$result = mysql_query("update "._MX."duvar set begen=begen+1, begenliste='$begenliste' where id='$id'");
		
	}
	
	die();
}

if($islem == "begenvazgec"){
	$id = $_POST["id"];
	
	
	if(!is_numeric($id)) die("hata");
	
	list($begenliste) = mysql_fetch_row(mysql_query("select begenliste from "._MX."duvar where id='$id'"));
	
	$begenliste = str_replace("$uye|$uyeadi||", "", $begenliste);
	
	$result = mysql_query("update "._MX."duvar set begen=begen-1, begenliste='$begenliste' where id='$id'");
	
	die();
}

if($islem == "yorumbegen"){
	$id = $_POST["id"];
	
	
	if(!is_numeric($id)) die("hata");
	
	list($begenliste) = mysql_fetch_row(mysql_query("select begenliste from "._MX."duvar_yorum where id='$id'"));
	
	if(!strstr($begenliste, $uye."|".$uyeadi."||")){
		
		$begenliste = $uye ."|". $uyeadi."||". $begenliste;
		
		$result = mysql_query("update "._MX."duvar_yorum set begen=begen+1, begenliste='$begenliste' where id='$id'");
		
	}
	
	
	die();
}

if($islem == "yorumbegenvazgec"){
	$id = $_POST["id"];
	
	
	if(!is_numeric($id)) die("hata");
	
	list($begenliste) = mysql_fetch_row(mysql_query("select begenliste from "._MX."duvar_yorum where id='$id'"));
	
	$begenliste = str_replace("$uye|$uyeadi||", "", $begenliste);
	
	$result = mysql_query("update "._MX."duvar_yorum set begen=begen-1, begenliste='$begenliste' where id='$id'");
	
	die();
}

if($islem == "fazlasi"){

	$kacinci = $_POST["kacinci"];

	if(!is_numeric($kacinci)) die();

	$limit = 10;
	
			$kullaniciavatar = uyebilgi("avatar");

				if(!$kullaniciavatar or $kullaniciavatar == 'img_uye/avatar/null.jpg') {
					$kullaniciavatar = "img_uye/".uyebilgi("cinsiyet").".gif";
				}
	
			$kullanicibilgi = $uye ."|". $uyeadi;
			
			$result = mysql_query("select id, uye, uyeadi, avatar, tur, baslik, icerik, resim, yorum, begen, begenliste, kayit from "._MX."duvar where durum='1' order by id desc limit ".(($kacinci-1)*$limit).",".$limit."");
			
			$ai = 0;
			
			while(list($id, $uye, $uyeadi, $avatar, $tur, $baslik, $icerik, $resim, $yorum, $begen, $begenliste, $kayit) = mysql_fetch_row($result)){
			
			$baslik = turkcejquery(stripslashes($baslik));
			
			$ikincisi = turkcejquery(stripslashes($icerik));
			
			$uyeadi = turkcejquery($uyeadi);
			
			if(strstr($begenliste, $kullanicibilgi)) {
				$begenmebuton1 = "display:none";
				$begenmebuton2 = NULL;
			}
			else {
				$begenmebuton2 = "display:none";
				$begenmebuton1 = NULL;			
			}
			$kayit = turkcejquery(kalanzaman($kayit));

			if($tur == 1){
				
				$icerigimiz = $baslik;
				
				
			}
			else if($tur == 2){
				
				$icerik = stripslashes($icerik);
				
				list($genislik, $yukseklik, $video) = explode("||", $icerik);
				$icerigimiz = '<div id="videogoster'.$id.'"><a href="javascript:void(0)" onclick="videogoster('.$id.', '.$genislik.', '.$yukseklik.', \''.$video.'\')"><img src="'.$resim.'" width="130" /></a></div> '.$baslik.'';
				
				
			}
			else if($tur == 3){

				$resimthumb = str_replace("duvar/", "duvar_thumb/", $resim);
				
				$icerigimiz = '<div id="resimdegistir'.$id.'"><a href="javascript:void(0)" onclick="resimdegistir('.$id.', \''.$resim.'\')"><img src="'.$resimthumb.'" width="130" /></a></div> '.$baslik.'';
				
			}
			else if($tur == 4){
			
				$icerik = stripslashes($icerik);
				
				$baslik = stripslashes($baslik);
				
				$icerigimiz = $icerik ."<br />". $baslik;
				
			
			}
			else {
			
				$icerigimiz = $baslik;
						
			}
		?>
		<div class="gonderi" id="gonderi<?=$id?>">
			<div class="avatar"><img src="<?=$avatar?>" /></div>
			<div class="nick"><a href="javascript:void(0)" onClick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);" title="Profiline Bak"><?=$uyeadi?></a> <span>[<?=$kayit?>]</span></div>
			<div class="aciklama"><?=$icerigimiz?><br /><?=$ikincisi?></div>
			<div class="yorumyap">
				<div class="yorumbuton"><input type="submit" value=" Yorum Yap " class="buton" onclick="yorumyapsec(<?=$id?>)" /></div>
				<div class="yorumicon"><img src="img/duvar_yorum_icon.jpg" /></div>
				<div class="yorumadet"><?=$yorum?> <?=turkcejquery("yorum yapýldý");?>.</div>
				<div class="begenbuton" id="begenbuton<?=$id?>1" style="<?=$begenmebuton1?>"><input type="submit" value=" <?=turkcejquery("Beðen");?> " class="buton" onclick="gonderibegen(<?=$id?>)" /></div>
				<div class="begenbuton" id="begenbuton<?=$id?>2" style="<?=$begenmebuton2?>"><input type="submit" value=" <?=turkcejquery("Vazgeç");?> " class="buton" onclick="gonderivazgec(<?=$id?>)" /></div>
				<div class="begenicon"><img src="img/duvar_begen_icon.jpg" /></div>
				<div class="begenadet"><span id="begenensayisi<?=$id?>"><?=$begen?></span> <?=turkcejquery("kiþi beðendi");?>.</div>
			</div>
			<div class="yorumlar">
				<?php
				
				if($yorum >= 1){
				
				if($yorum > 3){
				?>
				<div id="tumyorumlar<?=$id?>"></div>
				<div class="yorum" id="yorumhepsinigoster<?=$id?>"><a href="javascript:void(0)" onclick="tumyorumlar(<?=$id?>)"><?=turkcejquery("Tüm yorumlarý göster");?> (<?=$yorum;?>)</a></div>
				<?
				}
				
				$resultyorum = mysql_query("select id, uye, uyeadi, avatar, yorum, begen, begenliste, kayit from "._MX."duvar_yorum where durum='1' and icerik='$id' order by id desc limit 3");
				
					while(list($yorumid, $yorumuye, $yorumuyeadi, $yorumavatar, $yorum, $begen, $begenliste, $kayit) = mysql_fetch_row($resultyorum)){
					
					$kayit = turkcejquery(kalanzaman($kayit));
					
					$yorum = turkcejquery(stripslashes($yorum));
					
					if(strstr($begenliste, $kullanicibilgi)) {
						$begenmebuton1 = "display:none";
						$begenmebuton2 = NULL;
					}
					else {
						$begenmebuton2 = "display:none";
						$begenmebuton1 = NULL;			
					}
					?>
				<div class="yorum">
					<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=profil&id=<?=$yorumuye?>', '745', '700', 'profilpopup<?=$yorumuye?>', 2, 1, 1);" title="Profiline Bak"><img src="<?=$yorumavatar?>" /></a>
					<div class="yorumu">
					<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=profil&id=<?=$yorumuye?>', '745', '700', 'profilpopup<?=$yorumuye?>', 2, 1, 1);" title="Profiline Bak"><?=$yorumuyeadi?></a> <?=$yorum?>
					<p class="tarih"><?=$kayit?></span> <a href="javascript:void(0)" onclick="yorumbegen(<?=$yorumid?>)" id="yorumbegenme<?=$yorumid?>1" style="<?=$begenmebuton1?>"><?=turkcejquery("Beðen");?></a> <a href="javascript:void(0)" onclick="yorumvazgec(<?=$yorumid?>)" id="yorumbegenme<?=$yorumid?>2" style="<?=$begenmebuton2?>"><?=turkcejquery("Beðenmekten Vazgeç");?></a> (<span id="yorumbegenensayisi<?=$yorumid?>"><?=$begen?></span> <?=turkcejquery("kiþi beðendi");?>)</p>
					</div>
				</div>
					<?
					
					}
				
				}
				
				?>
				<div class="yorum" id="yorumyap<?=$id?>">
					<img src="<?=$kullaniciavatar?>" />
					<div class="yorumu">
					<input type="text" name="yorum" id="yorum<?=$id?>" class="yoruminput" value="Yorum yap" onFocus="if(this.value=='Yorum yap')this.value=''" onBlur="if(this.value=='')this.value='Yorum yap'"/>
					<span id="yorumyapsonuc<?=$id?>"></span><input type="submit" value=" <?=turkcejquery("Gönder");?> " id="yorumyapbuton" class="buton" onclick="yorumyap(<?=$id?>)" />
					</div>
				</div>			
			</div>
		</div>
		<div class="temizle"></div>
		<div class="cizgi"></div>
		<?
			
			
			$ai++;
			
			}
		
		if($ai < 1) die("fazlasiyok");
		
		die();
		
}
?>