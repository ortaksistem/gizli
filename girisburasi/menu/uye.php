<a href="index.php" class="logo">Admin paneline ho� geldiniz. (Buraya ��k�� ve bekleyen i�erikler gelicek)</a>
		<ul id="top-navigation">
			<li><span><span><a href="index.php" title="Anasayfa">Anasayfa</a></span></span></li>
			<li class="active"><span><span><a href="index.php?sayfa=uye">�ye Y�netimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=icerik">��erik Y�netimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=satislar">Sat��lar</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bot">Bot Y�netimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=yonetici">Y�neticiler</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bakim">Sistem Bak�m�</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=cikis" title="��k�� Yap">G�venli ��k��</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>�ye Y�netimi</h3>
			<?
				$result = mysql_query("select id from "._MX."uye where durum='2'");
				$admin = mysql_num_rows($result);
				$result = mysql_query("select id from "._MX."uye where durum='3'");
				$email = mysql_num_rows($result);	
				
				if($admin >= 1) $admin = "<font color=red><b>$admin</b></font>";		
				if($email >= 1) $email = "<font color=red><b>$email</b></font>";		
			?>
			<ul class="nav">
				<li><a href="index.php?sayfa=uye">�yeler</a></li>
				<li><a href="index.php?sayfa=uyebekleyen&tur=1">Admin Onay� (<?=$admin?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyen&tur=2">Email Onay� (<?=$email?>)</a></li>
				<li><a href="index.php?sayfa=uyesilinen&tur=1">Kendini Silen �yeler</a></li>
				<li><a href="index.php?sayfa=uyesilinen&tur=2">Adminin Sildi�i �yeler</a></li>
				<li><a href="index.php?sayfa=haftaninuyeleri">Haftan�n �yeleri</a></li>
				<li><a href="index.php?sayfa=uyekgl">KGL �yeleri</a></li>
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
			<h3>Bekleyen ��erikler</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=uyebekleyenhafta">Haftanin �yesi (<?=$hafta?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyenresim">Resim (<?=$resim?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyengaleri">Galeri (<?=$galeri?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyengaleriresim">Galeri Resmi (<?=$galeriresim?>)</a></li>
				<li><a href="index.php?sayfa=uyebekleyentanitim">Tan�t�m Yaz�s� (<?=$tanitim?>)</a></li>
			</ul>

			<h3>Duvar</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=duvarbekleyen">Bekleyen ��erik (<?=$icerik?>)</a></li>
				<li><a href="index.php?sayfa=duvaryorumbekleyen">Bekleyen Yorum (<?=$yorum?>)</a></li>
				<li><a href="index.php?sayfa=duvar">T�m ��erikler</a></li>
				<li><a href="index.php?sayfa=duvaryorum">T�m Yorumlar</a></li>
				<li><a href="index.php?sayfa=duvarvideoekle">Duvar Video Ekle</a></li>
			</ul>

			<h3>Video</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=videobekleyen">Bekleyen Video (<?=$video?>)</a></li>
				<li><a href="index.php?sayfa=video">T�m Videolar</a></li>
			</ul>
			
			<h3>Y�neticiye Bildirimler</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=bekleyenbildirim">(<?=$bildirim?>) Bekleyen Bildirim</a></li>
				<li><a href="index.php?sayfa=bildirim">T�m Bildirimler</a></li>
			</ul>
		</div>