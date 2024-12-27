<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die("hata");

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

$sayfa = $_POST["sayfa"];

if(!is_numeric($sayfa)) die();

if($islem == "istekler"){

	$limit = 10;
	
	list($toplam) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri_talep where talepedilen='$uyeid' and durum='2'"));
	
	
	if($toplam < 1){
	
		echo "<p align=center><font color=red size=2><b>".turkcejquery(" Ýstek talebi bulunmamaktadýr ")."</b></font></p>";
		
		die();
	
	}
	
	$toplamsayfa = ceil(($toplam/$limit));
	
	$result = mysql_query("select id, galeri, talepeden, durum from "._MX."galeri_talep where talepedilen='$uyeid' and durum='2' limit ".(($sayfa-1)*$limit).",".$limit."");
	
	
	while(list($iid, $galeri, $talepeden, $durum) = mysql_fetch_row($result)){
	
	list($kullanici, $cinsiyet, $dogum, $sehir, $img, $seviye) = mysql_fetch_row(mysql_query("select kullanici, cinsiyet, dogum, sehir, img, seviye from "._MX."uye where id='$talepeden'"));
	
	$sehir = turkcejquery($sehir);
	
	$img = uyeavatar($img, $cinsiyet);
	
	$cinsiyet = turkcejquery(cinsiyet($cinsiyet));
	
	$yas = (date("Y")-date("Y", $dogum));
	
	$seviyeicon = seviye($seviye, "icon");
	
	$seviyerenk = seviye($seviye, "renk");
	
	
?>

													<table id="istek<?=$iid?>" border="0" width="100%" id="table214" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="10" height="5">
																		</td>
																		<td height="5">
																		</td>
																		<td width="10" height="5">
																		</td>
																	</tr>
																	<tr>
																		<td width="10">&nbsp;</td>
																		<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="110" valign="top"><a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$talepeden?>', '745', '700', 'profilpopup<?=$talepeden?>', 2, 1, 1);"><img border="0" src="<?=$img?>" width="110" height="110"></a></td>
																				<td width="10">&nbsp;</td>
																				<td valign="top">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td>
																		<img border="0" src="img/uyelik_ufak_<?=$seviyeicon?>.gif" width="33" height="15"></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="cc"></td>
																				<td width="8">&nbsp;</td>
																			</tr>
																		</table>
																								</td>
																					</tr>
																					<tr>
																						<td height="5"></td>
																					</tr>
																					<tr>
																						<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td>
																						<p class="nickname">nickname <a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$talepeden?>', '745', '700', 'profilpopup<?=$talepeden?>', 2, 1, 1);"><?=$kullanici?></a></td>
																				<td width="6">&nbsp;</td>
																				<td width="50">
																				<p class="yas">Yas <?=$yas?></td>
																				<td width="6">&nbsp;</td>
																				<td width="130">
																				<p class="yer"><?=$sehir?></td>
																				<td width="6">&nbsp;</td>
																				<td width="80">
																				<p class="merkez_shop"><?=$cinsiyet?></td>
																			</tr>
																		</table>
																						</td>
																					</tr>
																					<tr>
																						<td height="6"></td>
																					</tr>
																					<tr>
																						<td height="22" bgcolor="#EEEEEE">
																						<table border="0" style="border-collapse: collapse" cellpadding="0">
																							<tr>
																								<td width="7">&nbsp;</td>
																								<td><input type="checkbox" name="C2" value="ON"></td>
																								<td width="3"></td>
																								<td height="22">
																								<p class="form_txt"><a class="form_txt" href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$galeri?>', '600', '700', 'galeripopup<?=$galeri?>', 2, 1, 1);">Galeri ID: <?=$galeri?></a></td>
																							</tr>
																							
																							<tr>
																								<td width="7">&nbsp;</td>
																								<td>&nbsp;</td>
																								<td width="3"></td>
																								<td height="22">
																								<p class="form_txt">
																								
																								<a href="javascript:isteksil(<?=$iid?>)"><img src="img/secilenleri_sil.gif" border="0" /></a>
																								<a href="javascript:istekreddet(<?=$iid?>)"><img src="img/secilenleri_reddet.gif" border="0" /></a>
																								<a href="javascript:istekonayla(<?=$iid?>)"><img src="img/secilenleri_onayla.png" border="0" /></a>
																								
																								</td>
																							</tr>
																						</table>
																						</td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																		</table>
																		</td>
																		<td width="10">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="10" height="5">
																		</td>
																		<td height="5">
																		</td>
																		<td width="10" height="5">
																		</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
															</tr>
														</table>
														
<?php

	} // end while
?>
	<table align="right">
		<tr>
			<td align="right" style="text-algin:right;padding:5px" bgcolor="#EEEEEE">
			<font size="2"><b>Diger Sayfalar : </b></font>
			
			<select name="sayfacik" id="sayfacik" class="selectler" onChange="yukle('istekler', this.value)">
				<?php
				
					for($i = 1; $i <= $toplamsayfa; $i++){
						if($sayfa == $i) echo "<option value=$i selected>Sayfa $i</option>";
						else echo "<option value=$i>Sayfa $i</option>";
					}
				?>
			</select>
			</td>
		</tr>
	</table>

<?
} // if istekler




if($islem == "izinliler"){

	$limit = 10;
	
	list($toplam) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri_talep where talepedilen='$uyeid' and durum='1'"));
	
	
	if($toplam < 1){
	
		echo "<p align=center><font color=red size=2><b>".turkcejquery(" Ýzinli kiþi bulunmamaktadýr ")."</b></font></p>";
		
		die();
	
	}
	
	$toplamsayfa = ceil(($toplam/$limit));
	
	$result = mysql_query("select id, galeri, talepeden, durum from "._MX."galeri_talep where talepedilen='$uyeid' and durum='1' limit ".(($sayfa-1)*$limit).",".$limit."");
	
	
	while(list($iid, $galeri, $talepeden, $durum) = mysql_fetch_row($result)){
	
	list($kullanici, $cinsiyet, $dogum, $sehir, $img, $seviye) = mysql_fetch_row(mysql_query("select kullanici, cinsiyet, dogum, sehir, img, seviye from "._MX."uye where id='$talepeden'"));
	
	$sehir = turkcejquery($sehir);
	
	$img = uyeavatar($img, $cinsiyet);
	
	$cinsiyet = turkcejquery(cinsiyet($cinsiyet));
	
	$yas = (date("Y")-date("Y", $dogum));
	
	$seviyeicon = seviye($seviye, "icon");
	
	$seviyerenk = seviye($seviye, "renk");
	
	
?>

													<table id="istek<?=$iid?>" border="0" width="100%" id="table214" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="10" height="5">
																		</td>
																		<td height="5">
																		</td>
																		<td width="10" height="5">
																		</td>
																	</tr>
																	<tr>
																		<td width="10">&nbsp;</td>
																		<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="110" valign="top"><a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$talepeden?>', '745', '700', 'profilpopup<?=$talepeden?>', 2, 1, 1);"><img border="0" src="<?=$img?>" width="110" height="110"></a></td>
																				<td width="10">&nbsp;</td>
																				<td valign="top">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td>
																		<img border="0" src="img/uyelik_ufak_<?=$seviyeicon?>.gif" width="33" height="15"></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="cc"></td>
																				<td width="8">&nbsp;</td>
																			</tr>
																		</table>
																								</td>
																					</tr>
																					<tr>
																						<td height="5"></td>
																					</tr>
																					<tr>
																						<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td>
																						<p class="nickname">nickname <a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$talepeden?>', '745', '700', 'profilpopup<?=$talepeden?>', 2, 1, 1);"><?=$kullanici?></a></td>
																				<td width="6">&nbsp;</td>
																				<td width="50">
																				<p class="yas">Yas <?=$yas?></td>
																				<td width="6">&nbsp;</td>
																				<td width="130">
																				<p class="yer"><?=$sehir?></td>
																				<td width="6">&nbsp;</td>
																				<td width="80">
																				<p class="merkez_shop"><?=$cinsiyet?></td>
																			</tr>
																		</table>
																						</td>
																					</tr>
																					<tr>
																						<td height="6"></td>
																					</tr>
																					<tr>
																						<td height="22" bgcolor="#EEEEEE">
																						<table border="0" style="border-collapse: collapse" cellpadding="0">
																							<tr>
																								<td width="7">&nbsp;</td>
																								<td><input type="checkbox" name="C2" value="ON"></td>
																								<td width="3"></td>
																								<td height="22">
																								<p class="form_txt"><a class="form_txt" href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$galeri?>', '600', '700', 'galeripopup<?=$galeri?>', 2, 1, 1);">Galeri ID: <?=$galeri?></a></td>
																							</tr>
																							
																							<tr>
																								<td width="7">&nbsp;</td>
																								<td>&nbsp;</td>
																								<td width="3"></td>
																								<td height="22">
																								<p class="form_txt">
																								
																								<a href="javascript:isteksil(<?=$iid?>)"><img src="img/secilenleri_sil.gif" border="0" /></a>
																								<a href="javascript:istekreddet(<?=$iid?>)"><img src="img/secilenleri_reddet.gif" border="0" /></a>
																								
																								</td>
																							</tr>
																						</table>
																						</td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																		</table>
																		</td>
																		<td width="10">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="10" height="5">
																		</td>
																		<td height="5">
																		</td>
																		<td width="10" height="5">
																		</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
															</tr>
														</table>
														
<?php

	} // end while
?>
	<table align="right">
		<tr>
			<td align="right" style="text-algin:right;padding:5px" bgcolor="#EEEEEE">
			<font size="2"><b>Diger Sayfalar : </b></font>
			
			<select name="sayfacik" id="sayfacik" class="selectler" onChange="yukle('izinliler', this.value)">
				<?php
				
					for($i = 1; $i <= $toplamsayfa; $i++){
						if($sayfa == $i) echo "<option value=$i selected>Sayfa $i</option>";
						else echo "<option value=$i>Sayfa $i</option>";
					}
				?>
			</select>
			</td>
		</tr>
	</table>

<?
} // if izinliler


if($islem == "redler"){

	$limit = 10;
	
	list($toplam) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri_talep where talepedilen='$uyeid' and durum='3'"));
	
	
	if($toplam < 1){
	
		echo "<p align=center><font color=red size=2><b>".turkcejquery(" Red edilmiþ kiþi bulunmamaktadýr ")."</b></font></p>";
		
		die();
	
	}
	
	$toplamsayfa = ceil(($toplam/$limit));
	
	$result = mysql_query("select id, galeri, talepeden, durum from "._MX."galeri_talep where talepedilen='$uyeid' and durum='3' limit ".(($sayfa-1)*$limit).",".$limit."");
	
	
	while(list($iid, $galeri, $talepeden, $durum) = mysql_fetch_row($result)){
	
	list($kullanici, $cinsiyet, $dogum, $sehir, $img, $seviye) = mysql_fetch_row(mysql_query("select kullanici, cinsiyet, dogum, sehir, img, seviye from "._MX."uye where id='$talepeden'"));
	
	$sehir = turkcejquery($sehir);
	
	$img = uyeavatar($img, $cinsiyet);

	$cinsiyet = turkcejquery(cinsiyet($cinsiyet));
	
	$yas = (date("Y")-date("Y", $dogum));
	
	$seviyeicon = seviye($seviye, "icon");
	
	$seviyerenk = seviye($seviye, "renk");
	
	
?>

													<table id="istek<?=$iid?>" border="0" width="100%" id="table214" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="10" height="5">
																		</td>
																		<td height="5">
																		</td>
																		<td width="10" height="5">
																		</td>
																	</tr>
																	<tr>
																		<td width="10">&nbsp;</td>
																		<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="110" valign="top"><a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$talepeden?>', '745', '700', 'profilpopup<?=$talepeden?>', 2, 1, 1);"><img border="0" src="<?=$img?>" width="110" height="110"></a></td>
																				<td width="10">&nbsp;</td>
																				<td valign="top">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td>
																		<img border="0" src="img/uyelik_ufak_<?=$seviyeicon?>.gif" width="33" height="15"></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="cc"></td>
																				<td width="8">&nbsp;</td>
																			</tr>
																		</table>
																								</td>
																					</tr>
																					<tr>
																						<td height="5"></td>
																					</tr>
																					<tr>
																						<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td>
																						<p class="nickname">nickname <a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$talepeden?>', '745', '700', 'profilpopup<?=$talepeden?>', 2, 1, 1);"><?=$kullanici?></a></td>
																				<td width="6">&nbsp;</td>
																				<td width="50">
																				<p class="yas">Yas <?=$yas?></td>
																				<td width="6">&nbsp;</td>
																				<td width="130">
																				<p class="yer"><?=$sehir?></td>
																				<td width="6">&nbsp;</td>
																				<td width="80">
																				<p class="merkez_shop"><?=$cinsiyet?></td>
																			</tr>
																		</table>
																						</td>
																					</tr>
																					<tr>
																						<td height="6"></td>
																					</tr>
																					<tr>
																						<td height="22" bgcolor="#EEEEEE">
																						<table border="0" style="border-collapse: collapse" cellpadding="0">
																							<tr>
																								<td width="7">&nbsp;</td>
																								<td><input type="checkbox" name="C2" value="ON"></td>
																								<td width="3"></td>
																								<td height="22">
																								<p class="form_txt"><a class="form_txt" href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$galeri?>', '600', '700', 'galeripopup<?=$galeri?>', 2, 1, 1);">Galeri ID: <?=$galeri?></a></td>
																							</tr>
																							
																							<tr>
																								<td width="7">&nbsp;</td>
																								<td>&nbsp;</td>
																								<td width="3"></td>
																								<td height="22">
																								<p class="form_txt">
																								
																								<a href="javascript:isteksil(<?=$iid?>)"><img src="img/secilenleri_sil.gif" border="0" /></a>
																								<a href="javascript:istekonayla(<?=$iid?>)"><img src="img/secilenleri_onayla.png" border="0" /></a>
																								
																								</td>
																							</tr>
																						</table>
																						</td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																		</table>
																		</td>
																		<td width="10">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="10" height="5">
																		</td>
																		<td height="5">
																		</td>
																		<td width="10" height="5">
																		</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
															</tr>
														</table>
														
<?php

	} // end while
?>
	<table align="right">
		<tr>
			<td align="right" style="text-algin:right;padding:5px" bgcolor="#EEEEEE">
			<font size="2"><b>Diger Sayfalar : </b></font>
			
			<select name="sayfacik" id="sayfacik" class="selectler" onChange="yukle('izinliler', this.value)">
				<?php
				
					for($i = 1; $i <= $toplamsayfa; $i++){
						if($sayfa == $i) echo "<option value=$i selected>Sayfa $i</option>";
						else echo "<option value=$i>Sayfa $i</option>";
					}
				?>
			</select>
			</td>
		</tr>
	</table>

<?
} // if redler


if($islem == "listem"){

	
	$limit = 20;
	
	list($toplam) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri_talep where talepeden='$uyeid'"));
	
	
	if($toplam < 1){
	
		echo "<p align=center><font color=red size=2><b>".turkcejquery("Listeniz boþ.")."</b></font></p>";
		
		die();
	
	}
	
	$toplamsayfa = ceil(($toplam/$limit));
	
	$result = mysql_query("select id, galeri, talepeden, talepedilen, kayit, sil, durum from "._MX."galeri_talep where talepeden='$uyeid' limit ".(($sayfa-1)*$limit).",".$limit."");
	
	$i = 1;
	
	
	
	while(list($iid, $galeri, $talepeden, $talepedilen, $kayit, $sil, $durum) = mysql_fetch_row($result)){
	
	
	
	$kayit = date("d.m.Y H:i", $kayit);
	
	if($i%2 == 0) $renk = "f5f5f5";
	else $renk = "eeeeee";
	
	if($talepedilen == $uyeid){
	
		if($sil != 1){
		
		list($kullanici) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$talepeden'"));

		$kullaniciid = $talepeden;
		
		if($durum == 1) $durum = "<font color=green>Onay Verildi</font>";
		elseif($durum == 2) $durum = "<font color=red></b>Onayýnýz Bekleniyor</b></font>";
		else $durum = "<font color=red>Red edildi</font>";
		
		$durum = turkcejquery($durum);
?>


																<table id="istek<?=$iid?>" border="0" style="border-collapse: collapse" width="100%" cellpadding="0" bgcolor="#<?=$renk?>">
																	<tr>
																		<td width="10">&nbsp;</td>
																		<td width="110">
																		<p class="form_txt">
																		<a class="form_txt" href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$galeri?>', '600', '700', 'galeripopup<?=$galeri?>', 2, 1, 1);">Galeri 
																		ID:<?=$galeri?></a></td>
																		<td width="10">&nbsp;</td>
																		<td height="27">
																		<p class="nickname">
																		<a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$kullaniciid?>', '745', '700', 'profilpopup<?=$kullaniciid?>', 2, 1, 1);"><?=$kullanici?></a></td>
																		<td width="6">&nbsp;</td>
																		<td width="100">
																		<p class="form_txt">
																		<?=$kayit?></td>
																		<td width="6">&nbsp;</td>
																		<td width="65" align="center">
																		<p class="online">
																		<?=$durum?></td> 
																		<td width="6">&nbsp;</td>
																		<td width="20"></td>
																		<td width="10">&nbsp;</td>
																	</tr>
																</table>
<?		
		
		
		}
	}
	
	
	
	else {
	
		list($kullanici) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$talepedilen'"));

		$kullaniciid = $talepedilen;
			
		$durum2 = $durum;
		
		if($durum == 2) {
		$durum = "<font color=green>Onay Bekleniyor</font>";
		}
		elseif($durum == 3) {
		$durum = "<font color=red></b>Red Edildi</b></font>";
		}
		elseif($durum == 1) {
		$durum = "<font color=green>Onaylý</font>";	
		}
		else {
		$durum = "<font color=black><b>Silindi</b></font>";
		}
	
		$durum = turkcejquery($durum);
?>


																<table id="istek<?=$iid?>" border="0" style="border-collapse: collapse" width="100%" cellpadding="0" bgcolor="#<?=$renk?>">
																	<tr>
																		<td width="10">&nbsp;</td>
																		<td width="110">
																		<p class="form_txt">
																		<a class="form_txt" href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$galeri?>', '600', '700', 'galeripopup<?=$galeri?>', 2, 1, 1);">Galeri 
																		ID:<?=$galeri?></a></td>
																		<td width="10">&nbsp;</td>
																		<td height="27">
																		<p class="nickname">
																		<a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$kullaniciid?>', '745', '700', 'profilpopup<?=$kullaniciid?>', 2, 1, 1);"><?=$kullanici?></a></td>
																		<td width="6">&nbsp;</td>
																		<td width="100">
																		<p class="form_txt">
																		<?=$kayit?></td>
																		<td width="6">&nbsp;</td>
																		<td width="65" align="center">
																		<p class="online">
																		<?=$durum?></td> 
																		<td width="6">&nbsp;</td>
																		<td width="20">
																		<?php
																			if($durum2 == 4){
																		?>
																		
																		<a href="javascript:istektemizle(<?=$iid?>)" title="Sil"><img src="img/cross.png" border="0" /></a>
																		<?
																			}
																		?>
																		</td>
																		<td width="10">&nbsp;</td>
																	</tr>
																</table>
<?

	} // talepci bensem
	
	$i++;
	
	
	
	
	} // end while
?>
	<table align="right">
		<tr>
			<td align="right" style="text-algin:right;padding:5px" bgcolor="#EEEEEE">
			<font size="2"><b>Diger Sayfalar : </b></font>
			
			<select name="sayfacik" id="sayfacik" class="selectler" onChange="yukle('listem', this.value)">
				<?php
				
					for($i = 1; $i <= $toplamsayfa; $i++){
						if($sayfa == $i) echo "<option value=$i selected>Sayfa $i</option>";
						else echo "<option value=$i>Sayfa $i</option>";
					}
				?>
			</select>
			</td>
		</tr>
	</table>

<?
} // if listem onay red ff8585 onaylandý 85ff90 bekliyor f2f2f2 silindi e8e8e8



if($islem == "galeri"){

?>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="10">
																		<img border="0" src="img/ic_menu_ac.gif" width="10" height="39"></td>
																		<td background="img/ic_menu_bg.gif" width="5">&nbsp;</td>
																		<td background="img/ic_menu_bg.gif">
																		<p class="tit_1_beyaz">
																		Galerilerim</td>
																		<td width="127">
																		<a href="index.php?sayfa=profil_galeri_ac"><img border="0" src="img/btn_galeri_ac.gif" width="127" height="39"></a></td>
																	</tr>
																</table>
																
														<table border="0" id="table452" cellspacing="0" cellpadding="0" align="center">
															<tr>
																<?php
																
																	$result = mysql_query("select id, resim, hit, kayit, durum from "._MX."galeri where uye='$uyeid' order by id desc");
																	
																	$i = 1;
																	
																	while(list($id, $resim, $hit, $kayit, $durum) = mysql_fetch_row($result)){
																	
																	$kayit = date("d.m.Y H:i", $kayit);
																	
																	if($durum == 1) $durum = "<font color=green>ONAYLI</font>";
																	else $durum = "<font color=red>Onay Bekliyor</font>";
																	
																	list($topresim) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri_resim where galeri='$id'"));
																	
																?>
																<td align="center" valign="top">
																<table align="center" id="galeri<?=$id?>" border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td align="center">
																		<img border="0" src="img/urn_penc_ust.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td align="center" style="background:url(img/urn_penc_bg.gif);background-position:center;background-repeat:repeat-y;">
																		<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$id?>', '600', '700', 'galeripopup<?=$id?>', 2, 1, 1);" title="Galeriye Bak"><img border="0" src="<?=$resim?>" width="80" height="100"></a></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<img border="0" src="img/urn_penc_alt.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td height="6">
																		</td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="merkez_profil">
																		Galeri 
																		ID: 
																		<?=$id?></td>
																	</tr>
																	<tr>
																		<td align="center" height="18">
																		<p class="not">
																		- <?=$durum?>
																		-</td>
																	</tr>
																	<tr>
																		<td align="center" height="18">
																		<p class="form_txt">
																		toplam 
																		<?=$topresim?> ad. 
																		resim</td>
																	</tr>
																	<tr>
																		<td align="center" height="18">
																		<p class="form_txt">
																		<font color="#2069A0">
																		<?=$hit?> kez 
																		izlenmis</font></td>
																	</tr>
																	<tr>
																		<td align="center" height="18">
																		<p class="form_txt">
																		<?=$kayit?> tarihinde eklenmis</td>
																	</tr>
																	<tr>
																		<td align="center" height="5"></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td><a href="javascript:galerisil(<?=$id?>)"><img border="0" src="img/btn_sil.gif" width="35" height="28"></a></td>
																				<td width="2"></td>
																				<td><a href="index.php?sayfa=profil_galeri_duzenle&id=<?=$id?>"><img border="0" src="img/btn_duzenle.gif" width="64" height="28"></a></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																</table>
																</td>
																
																<?php
																	
																	if($i%4 == 0) echo "</tr><tr>";
																	$i++;
																	
																	} // end while
																
																?>
															</tr>
															</table>
<?
}
?> 