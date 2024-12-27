<a href="index.php" class="logo">Admin paneline hoþ geldiniz. (Buraya çýkýþ ve bekleyen içerikler gelicek)</a>
		<ul id="top-navigation">
			<li><span><span><a href="index.php" title="Anasayfa">Anasayfa</a></span></span></li>
			<li class="active"><span><span><a href="index.php?sayfa=uye">Üye Yönetimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=icerik">Ýçerik Yönetimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=satislar">Satýþlar</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bot">Bot Yönetimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=yonetici">Yöneticiler</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bakim">Sistem Bakýmý</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=cikis" title="Çýkýþ Yap">Güvenli Çýkýþ</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>Üye Yönetimi</h3>
			<?
				$result = mysql_query("select id from "._MX."uye where durum='2'");
				$admin = mysql_num_rows($result);
				$result = mysql_query("select id from "._MX."uye where durum='3'");
				$email = mysql_num_rows($result);	
				
				if($admin >= 1) $admin = "<font color=red><b>$admin</b></font>";		
				if($email >= 1) $email = "<font color=red><b>$email</b></font>";		
			?>
			<ul class="nav">
				<li><a href="index.php?sayfa=uye">Üyeler</a></li>
				<li><a href="index.php?sayfa=uyebekleyen&tur=1">Admin Onayý (<?=$admin?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyen&tur=2">Email Onayý (<?=$email?>)</a></li>
				<li><a href="index.php?sayfa=uyesilinen&tur=1">Kendini Silen Üyeler</a></li>
				<li><a href="index.php?sayfa=uyesilinen&tur=2">Adminin Sildiði Üyeler</a></li>
				<li><a href="index.php?sayfa=haftaninuyeleri">Haftanýn Üyeleri</a></li>
				<li><a href="index.php?sayfa=uyekgl">KGL Üyeleri</a></li>
			</ul>
			<?php

				$hafta = date("W");		
				$yil = date("Y");
				
				$adminseviye = adminseviye();
				
				

				
				
				list($hafta) = mysql_fetch_row(mysql_query("select count(uye) from "._MX."uye_hafta where hafta='$hafta' and yil='$yil' and durum='2'"));
				list($bildirim) = mysql_fetch_row(mysql_query("select count(id) from "._MX."bildirim where durum='1'"));
				
				if($adminseviye == 2){
					list($icerik) = mysql_fetch_row(mysql_query("select count(id) from "._MX."duvar where durum='2'"));
					list($yorum) = mysql_fetch_row(mysql_query("select count(id) from "._MX."duvar_yorum where durum='2'"));
					list($video) = mysql_fetch_row(mysql_query("select count(id) from "._MX."video where durum='2'"));
					
					list($tanitim) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where durum='1' and tanitim!='' and tanitimonay='2'"));
					list($galeriresim) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri_resim where durum!='1'"));
					
					list($resim) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_resim where durum!='1'"));
					list($galeri) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri where durum!='1'"));
					
				}
				else {
					$icerik = 0;
					
					$sorgula = mysql_query("select uye from "._MX."duvar where durum='2'");
					while(list($uye) = mysql_fetch_row($sorgula)) {
						list($satissatis) = mysql_fetch_row(mysql_query("select satissatis from "._MX."uye where id='$uye'")); 
						if($satissatis != 2) $icerik++;
					}
					$yorum = 0;
					
					$sorgula = mysql_query("select uye from "._MX."duvar_yorum where durum='2'");
					while(list($uye) = mysql_fetch_row($sorgula)) {
						list($satissatis) = mysql_fetch_row(mysql_query("select satissatis from "._MX."uye where id='$uye'")); 
						if($satissatis != 2) $yorum++;
					}
					$video = 0;
					
					$sorgula = mysql_query("select uye from "._MX."video where durum='2'");
					while(list($uye) = mysql_fetch_row($sorgula)) {
						list($satissatis) = mysql_fetch_row(mysql_query("select satissatis from "._MX."uye where id='$uye'")); 
						if($satissatis != 2) $video++;
					}

					list($tanitim) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where durum='1' and tanitim!='' and tanitimonay='2' and satissatis!='2'"));
					

					
					$resim = 0;
					
					$sorgula = mysql_query("select uye from "._MX."uye_resim where durum='2'");
					while(list($uye) = mysql_fetch_row($sorgula)) {
						list($satissatis) = mysql_fetch_row(mysql_query("select satissatis from "._MX."uye where id='$uye'")); 
						if($satissatis != 2) $resim++;
					}
					$galeri = 0;
					
					$sorgula = mysql_query("select uye from "._MX."galeri where durum='2'");
					while(list($uye) = mysql_fetch_row($sorgula)) {
						list($satissatis) = mysql_fetch_row(mysql_query("select satissatis from "._MX."uye where id='$uye'")); 
						if($satissatis != 2) $galeri++;
					}
					$galeriresim = 0;
					
					$sorgula = mysql_query("select galeri from "._MX."galeri_resim where durum='2'");
					while(list($uye) = mysql_fetch_row($sorgula)) {
						list($uye) = mysql_fetch_row(mysql_query("select uye from "._MX."galeri where id='$uye'"));
						list($satissatis) = mysql_fetch_row(mysql_query("select satissatis from "._MX."uye where id='$uye'")); 
						if($satissatis != 2) $galeriresim++;
					}					
					
					
				}
				
				
			
			?>
			<h3>Bekleyen Ýçerikler</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=uyebekleyenhafta">Haftanin Üyesi (<?=$hafta?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyenresim">Resim (<?=$resim?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyengaleri">Galeri (<?=$galeri?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyengaleriresim">Galeri Resmi (<?=$galeriresim?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyentanitim">Tanýtým Yazýsý (<?=$tanitim?>)</a></li>
			</ul>

			<h3>Duvar</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=duvarbekleyen">Bekleyen Ýçerik (<?=$icerik?>)</a></li>
				<li><a href="index.php?sayfa=duvaryorumbekleyen">Bekleyen Yorum (<?=$yorum?>)</a></li>
				<li><a href="index.php?sayfa=duvar">Tüm Ýçerikler</a></li>
				<li><a href="index.php?sayfa=duvaryorum">Tüm Yorumlar</a></li>
				<li><a href="index.php?sayfa=duvarvideoekle">Duvar Video Ekle</a></li>
			</ul>

			<h3>Video</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=videobekleyen">Bekleyen Video (<?=$video?>)</a></li>
				<li><a href="index.php?sayfa=video">Tüm Videolar</a></li>
			</ul>
			
			<h3>Yöneticiye Bildirimler</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=bekleyenbildirim">(<?=$bildirim?>) Bekleyen Bildirim</a></li>
				<li><a href="index.php?sayfa=bildirim">Tüm Bildirimler</a></li>
			</ul>
		</div>