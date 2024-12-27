<?

$islem = $_GET["islem"];

if($islem == "kaydet"){

	$id = $_POST["id"];
	$kullanici = $_POST["kullanici"];
	$email = $_POST["email"];
	$sifre = $_POST["sifre"];
	$ad = $_POST["ad"];
	$soyad  = $_POST["soyad"];
	$tel = $_POST["tel"];
	$d1 = $_POST["d1"];
	$d2 = $_POST["d2"];
	$d3 = $_POST["d3"];
	$tanitim = $_POST["tanitim"];
	$cinsiyet = $_POST["cinsiyet"];
	$seviye = $_POST["seviye"];
	$avatar = $_POST["img"];
	$ulke = $_POST["ulke"];
	$sehir = $_POST["sehir"];
	$bitis1 = $_POST["bitis1"];
	$bitis2 = $_POST["bitis2"];
	$bitis3 = $_POST["bitis3"];
	$bitis4 = $_POST["bitis4"];
	$kgl = $_POST["kgl"];
	$durum = $_POST["durum"];
	$bansebep = $_POST["bansebep"];
	$b1 = $_POST["b1"];
	$b2 = $_POST["b2"];
	$b3 = $_POST["b3"];
	$botmesaji = $_POST["botmesaji"];
	
	$kullanici = turkce($kullanici);
	
	$ad = turkce($ad);
	
	$soyad = turkce($soyad);
	
	$tanitim = addslashes(turkce($tanitim));

	$ulke = turkce($ulke);
	
	$bansebep = turkce($bansebep);
	
	$sehir = turkce($sehir);
	
	$dogum = @mktime(0,0,0, $d2, $d1, $d3);
	
	if($durum == 7) $banbitis = @mktime(0,0,0, $b2, $b1, $b3);
	else $banbitis = 0;
	
	if($bitis4 == 1){
	
		$bit = 0;
		
	}
	else {
		
		$bit = @mktime(0,0,0, $bitis2, $bitis1, $bitis3);
	}
	
	
	
$result = mysql_query("update "._MX."uye set kullanici='$kullanici', email='$email', sifre='$sifre', ad='$ad', soyad='$soyad', tel='$tel', cinsiyet='$cinsiyet', dogum='$dogum', ulke='$ulke', sehir='$sehir', img='$avatar', tanitim='$tanitim', bitis='$bit', kgl='$kgl', seviye='$seviye', botmesaji='$botmesaji', bansebep='$bansebep', banbitis='$banbitis', durum='$durum' where id='$id'");

	
	if($result) die("ok");
	else die("hata2");
	
	
}
else if($islem == "avatar"){

	$id = $_POST["id"];
	
	list($img) = mysql_fetch_row(mysql_query("select img from "._MX."uye where id='$id'"));
	
	@unlink("../$img");
	
	$result = mysql_query("update "._MX."uye set img='img_uye/avatar/null.jpg' where id='$id'");
	
	if($result) die("ok");
	else die("hata");
		
}
else if($islem == "mesajsil"){

	$id = $_POST["id"];
	
	$result = mysql_query("delete from "._MX."uye_mesaj where id='$id'");
	
	if($result) die("ok");
	else die("hata");
	
}
else if($islem == "haftaninuyesi"){

	$id = $_POST["id"];
	
	list($uyead, $cinsiyet, $dogum, $sehir, $img, $oncelik) = mysql_Fetch_row(mysql_query("select kullanici, cinsiyet, dogum, sehir, img, oncelik from "._MX."uye where id='$id'"));
	
	$hafta = date("W");
	$yil = date("Y");
	
	$result = mysql_query("insert into "._MX."uye_hafta values(NULL, '$id', '$uyead', '$cinsiyet', '$dogum', '$sehir', '$img', '$oncelik', '$hafta', '$yil', '1')");
	
	if($result) die("ok");
	else die("hata");
	
}
else if($islem == "online"){

	$id = $_POST["id"];
	
	list($uyead, $cinsiyet, $dogum, $sehir, $img, $oncelik, $seviye) = mysql_Fetch_row(mysql_query("select kullanici, cinsiyet, dogum, sehir, img, oncelik, seviye from "._MX."uye where id='$id'"));
	
	list($seviyead, $seviyeicon, $seviyerenk) = mysql_fetch_row(mysql_query("select ad, icon, renk from "._MX."seviye where id='$seviye'"));
	
	list($sure) = mysql_Fetch_row(mysql_query("select sure from "._MX."ayarlar"));
	
	$sure = $sure * 60;
	
	$sure = @mktime() + $sure;
	
	$result = mysql_query("insert into "._MX."online values('$id', '$uyead', '$cinsiyet', '$dogum', '$sehir', '$seviyead', '$seviyeicon', '$seviyerenk', '$oncelik', '$sure')");
	
	if($result) die("ok");
	else die("hata");
	
}
else if($islem == "bot"){

	$id = $_POST["id"];
	
	list($bot) = mysql_Fetch_row(mysql_query("select bot from "._MX."uye where id='$id'"));
	
	if($bot == 1) $botcuk = NULL;
	else $botcuk = 1;
	
	$result = mysql_query("update "._MX."uye set bot='$botcuk' where id='$id'");
	
	if($result) die("ok");
	else die("hata");
	
}

else if($islem == "puanver"){

	$id = $_POST["id"];
	
	list($uyead, $cinsiyet, $dogum, $sehir, $img, $oncelik) = mysql_Fetch_row(mysql_query("select kullanici, cinsiyet, dogum, sehir, img, oncelik from "._MX."uye where id='$id'"));
	
	$ay = date("m");
	$yil = date("Y");
	
	$puan = $_POST["puan"];
	
	
	$result = mysql_query("select count(uye) from "._MX."uye_oy where uye='$id' and ay='$ay' and yil='$yil'");
	
	list($count) = mysql_fetch_row($result);
	
	if($count < 1){
		$result = mysql_query("insert into "._MX."uye_oy values('$id', '$uyead', '$cinsiyet', '$dogum', '$sehir', '1', '$puan', '', '$ay', '$yil')");
	}
	else {
		$result = mysql_query("update "._MX."uye_oy set toplamoy=toplamoy+1, toplampuan=toplampuan+$puan where uye='$id' and ay='$ay' and yil='$yil'");
	}
	
	if($result) die("ok");
	else die("hata");
	
}
else if($islem == "mesajgonder"){

	$id = $_POST["id"];
	$kimden = $_POST["kimden"];
	$konu = $_POST["konu"];
	$mesaj = $_POST["mesaj"];
	
	$konu = addslashes(turkce($konu));
	$mesaj = addslashes(turkce($mesaj));
	
	list($kim) = mysql_fetch_row(mysql_query("select id from "._MX."uye where kullanici='$kimden'"));
	
	if(!$kim) die("hata1");
	
	list($uyead, $oncelik) = mysql_Fetch_row(mysql_query("select kullanici, oncelik from "._MX."uye where id='$id'"));

	$kayit = @mktime();
	
	$tarih = date("Y-m-d");
	
	$result = mysql_query("insert into "._MX."uye_mesaj values(NULL, '$kim', '$id', '$kimden', '$konu', '$mesaj', '$kayit', '$tarih', '$oncelik', '1', '2')");

	if($result) die("ok");
	else die("hata");

}
else {

$id = $_GET["id"];

if(!is_numeric($id)) die("Hops");

list($kullanici) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$id'"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Üye Profil Düzenle : <?=$kullanici?> | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery-eski.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
	
	function kaydet(){
		
		var id = <?=$id?>;
		var kullanici = $("#kullanici").val();
		var email = $("#email").val();
		var sifre = $("#sifre").val();
		var ad = $("#ad").val();
		var soyad = $("#soyad").val();
		var tel = $("#tel").val();
		var d1 = $("#d1").val();
		var d2 = $("#d2").val();
		var d3 = $("#d3").val();
		var cinsiyet = $("#cinsiyet").val();
		var ulke = $("#ulke").val();
		var sehir = $("#sehir").val();
		var img = $("#img").val();
		var tanitim = $("#tanitim").val();
		var seviye = $("#seviye").val();
		var botmesaji = $("#botmesaji").val();
		var kgl = $("#kgl").val();
		var b1 = $("#b1").val();
		var b2 = $("#b2").val();
		var b3 = $("#b3").val();
		var durum = $("#durum").val();
		var bansebep = $("#bansebep").val();
		
		var bitis1 = $("#bitis1").val();
		var bitis2 = $("#bitis2").val();
		var bitis3 = $("#bitis3").val();
		var bitis4 = $("#bitis4:checked").val();
		
		
		$("#kaydet").html("<img src='img/loading.gif' /> <font color=green size=1><b>Lütfen Bekleyin...</b></font>");
		
					jQuery.ajax({
						type : 'POST',
						url : 'index.php?sayfa=uyeprofil&islem=kaydet',
						data : "id="+id+"&kullanici="+kullanici+"&email="+email+"&sifre="+sifre+"&ad="+ad+"&soyad="+soyad+"&tel="+tel+"&d1="+d1+"&d2="+d2+"&d3="+d3+"&b1="+b1+"&b2="+b2+"&b3="+b3+"&cinsiyet="+cinsiyet+"&ulke="+ulke+"&sehir="+sehir+"&img="+img+"&tanitim="+tanitim+"&seviye="+seviye+"&bitis1="+bitis1+"&bitis2="+bitis2+"&bitis3="+bitis3+"&bitis4="+bitis4+"&kgl="+kgl+"&durum="+durum+"&bansebep="+bansebep+"&botmesaji="+botmesaji,
						success: function(sonuc){		
							if(sonuc == "ok"){
								$("#kaydet").html("<font color=green size=1><b>Kaydedildi</b></font>");
							}
							else {
								$("#kaydet").html("");
								alert("Kaydedilemedi, lütfen sonra tekrar deneyin");
							}


						}
					})
				
		
	}
	
	function avatarsil(){
	
		var id = <?=$id?>;

		$("#avatarsil").html("<img src='img/loading.gif' />");
		
					jQuery.ajax({
						type : 'POST',
						url : 'index.php?sayfa=uyeprofil&islem=avatar',
						data : "id="+id,
						success: function(sonuc){		
							if(sonuc == "ok"){
								$("#avatarsil").html("");
								$("#img").val("img_uye/avatar/null.jpg");
							}
							else {
								$("#avatarsil").html("");
								alert("Kaydedilemedi, lütfen sonra tekrar deneyin");
							}
						}
					})
					
	}
	
	function resimsil(uye, i){
		var onayla = confirm("Silmek istediðinizden emin misiniz?");
		if(onayla){
			$("#uyeid"+i).hide();
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=uyebekleyenresim&islem=sil',
				data : "id="+uye,
				success: function(sonuc){	
					if(sonuc == "ok"){
						
					}
					else {
						alert("Resim silinemedi tekrar deneyiniz");
					}
				}
			})
		}
	}
	
	function resimonayla(uye, i){
		
			$("#uyeid"+i).hide();
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=uyebekleyenresim&islem=onayla',
				data : "id="+uye,
				success: function(sonuc){	
					if(sonuc == "ok"){
						
					}
					else {
						alert("Resim onaylanamadý tekrar deneyiniz");
					}
				}
			})
	}
	
	function mesajsil(id){
		var onayla = confirm("Silmek istediðinizden emin misiniz?");
		if(onayla){
			$("#mesajyer"+id).hide();
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=uyeprofil&islem=mesajsil',
				data : "id="+id,
				success: function(sonuc){	
					if(sonuc == "ok"){
						
					}
					else {
						alert("Mesaj silinemedi tekrar deneyiniz");
					}
				}
			})
		}
	}
	
	function haftaninuyesi(id){
		var onayla = confirm("Haftanýn üyesi yapmak istediðinizden emin misiniz?");
		if(onayla){
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=uyeprofil&islem=haftaninuyesi',
				data : "id="+id,
				success: function(sonuc){	
					if(sonuc == "ok"){
						alert("Üye baþarýyla haftanýn üyesi yapýldý");
					}
					else {
						alert("Tekrar deneyiniz");
					}
				}
			})
		}
	}

	function online(id){
		var onayla = confirm("Online yapmak istediðinizden emin misiniz?");
		if(onayla){
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=uyeprofil&islem=online',
				data : "id="+id,
				success: function(sonuc){	
					if(sonuc == "ok"){
						alert("Üye baþarýyla online yapýldý");
					}
					else {
						alert("Tekrar deneyiniz");
					}
				}
			})
		}
	}

	function bot(id){
		var onayla = confirm("Bot yapmak istediðinizden emin misiniz?");
		if(onayla){
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=uyeprofil&islem=bot',
				data : "id="+id,
				success: function(sonuc){	
					if(sonuc == "ok"){
						alert("Üye baþarýyla bot yapýldý");
					}
					else {
						alert("Tekrar deneyiniz");
					}
				}
			})
		}
	}
		
	function puanver(id){
		var onayla = confirm("Puan vermek istediðinizden emin misiniz?");
		if(onayla){
			var puan = $("#puan").val();
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=uyeprofil&islem=puanver',
				data : "id="+id+"&puan="+puan,
				success: function(sonuc){	
					if(sonuc == "ok"){
						alert("Puan baþarýyla verildi");
					}
					else {
						alert("Tekrar deneyiniz");
					}
				}
			})
		}
	}
	
	function mesajgonder(id){
		var onayla = confirm("Mesaj göndermek istediðinizden emin misiniz?");
		if(onayla){
			var kimden = $("#mesajgonderen").val();
			var konu = $("#mesajkonu").val();
			var mesaj = $("#mesajmesaj").val();
			
			if(kimden == ""){ alert("Gönderen adýný tam olarak yazýn"); }
			else if(konu == "") { alert("Konuyu yazýn"); }
			else if(mesaj == "") { alert("Mesajý Yazýn"); }
			else {
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=uyeprofil&islem=mesajgonder',
					data : "id="+id+"&kimden="+kimden+"&konu="+konu+"&mesaj="+mesaj,
					success: function(sonuc){	
						if(sonuc == "ok"){
							alert("Mesaj baþarýyla gönderildi.");
						}
						else if(sonuc == "hata1"){
							alert("Gönderen kayýtlý bir üye nicki deðildir.");
						}
						else {
							alert("Tekrar deneyiniz");
						}
					}
				})
			}
		}
	}
</script>
</head>
<body>
	<div id="center-column" style="width:470px">
			<p align="center">
			<a href="index.php?sayfa=uyeprofil&id=<?=$id?>"><b>Ana Profil</b></a> | 
			<a href="index.php?sayfa=uyeprofil&yer=resim&id=<?=$id?>"><b>Resimler</b></a> | 
			<a href="index.php?sayfa=uyeprofil&yer=galeri&id=<?=$id?>"><b>Galeriler</b></a> | 
			<a href="index.php?sayfa=uyeprofil&yer=mesaj&id=<?=$id?>"><b>Mesajlar</b></a> | 
			<a href="index.php?sayfa=uyeprofil&yer=diger&id=<?=$id?>"><b>Diðer Ýþlemler</b></a>
			</p>
			<div class="table" style="width:470px">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				
				<?php
				
					$result = mysql_query("select * from "._MX."uye where id='$id'");

					$rowla = mysql_fetch_array($result);
				
					$kullanici = $rowla["kullanici"];
				
					$yer = $_GET["yer"];
					
					if(!$yer) $yer = "profil";
					
					if($yer == "profil"){
				?>
				<table class="listing form" cellpadding="0" cellspacing="0" style="width:470px">
					<tr>
						<th class="full" colspan="2">Profili Düzenle <?=$kullanici?></th>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Üye Adý</strong></td>
						<td class="last"><input type="text" name="kullanici" id="kullanici" class="text" value="<?=$kullanici?>" style="width:320px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Email</strong></td>
						<td class="last"><input type="text" name="email" id="email" class="text" value="<?=$rowla["email"];?>" style="width:320px" /></td>
					</tr>	
					<tr>
						<td class="first" width="100"><strong>Þifre</strong></td>
						<td class="last"><input type="text" name="sifre" id="sifre" class="text" value="<?=$rowla["sifre"];?>" style="width:200px" /></td>
					</tr>	
					<tr>
						<td class="first" width="100"><strong>Ad</strong></td>
						<td class="last"><input type="text" name="ad" id="ad" class="text" value="<?=$rowla["ad"];?>" style="width:300px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Soyad</strong></td>
						<td class="last"><input type="text" name="soyad" id="soyad" class="text" value="<?=$rowla["soyad"];?>" style="width:300px" /></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Tel</strong></td>
						<td class="last"><input type="text" name="tel" id="tel" class="text" value="<?=$rowla["tel"];?>" style="width:100px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Doðum</strong></td>
						<td class="last">
						<?php
							$dogum = $rowla["dogum"];
							
							list($gun, $ay, $yil) = explode(".", date("d.m.Y", $dogum));
						
						?>
						Gün : <input type="text" name="d1" id="d1" value="<?=$gun?>" style="width:20px" /> 
						Ay : <input type="text" name="d2" id="d2" value="<?=$ay?>" style="width:20px" /> 
						Yil : <input type="text" name="d3" id="d3" value="<?=$yil?>" style="width:40px" /> 
						</td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Cinsiyet</strong></td>
						<td class="last">
							<select name="cinsiyet" id="cinsiyet">
							<?php
								cinsiyet(NULL, $rowla["cinsiyet"]);
							
							?>
							</select>
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Ülke</strong></td>
						<td class="last"><input type="text" name="ulke" id="ulke" class="text" value="<?=$rowla["ulke"];?>" style="width:150px" /></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Þehir</strong></td>
						<td class="last"><input type="text" name="sehir" id="sehir" class="text" value="<?=$rowla["sehir"];?>" style="width:150px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Avatar</strong></td>
						<td class="last"><input type="text" name="img" id="img" class="text" value="<?=$rowla["img"];?>" style="width:200px" /> <a href="javascript:void(0)" onclick="avatarsil()" title="Avatarý Sil"><img src="img/hr.gif" border="0" /></a> <span id="avatarsil"></span></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Profil Yazýsý</strong></td>
						<td class="last"><textarea name="tanitim" id="tanitim" style="width:250px"><?=stripslashes($rowla["tanitim"]);?></textarea></td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Son Giriþ</strong></td>
						<td class="last"><?=date("d.m.Y H:i", $rowla["sononline2"]);?></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Giriþ Sayýsý</strong></td>
						<td class="last"><?=$rowla["girissayisi"];?></td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Son Giriþ Ýp</strong></td>
						<td class="last"><?=$rowla["ip"];?></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Kayýt Tarihi</strong></td>
						<td class="last"><?=date("d.m.Y H:i", $rowla["kayit"]);?></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>KGL</strong></td>
						<td class="last">
						<select name="kgl" id="kgl">
						<?php
							
							if($rowla["kgl"] == 1){
							?>
							<option value="1" selected>KGL Üyesidir</option>
							<option value="2">KGL Üyesi DEÐÝLDÝR</option>
							<?
							}
							else {
							?>
							<option value="1">KGL Üyesidir</option>
							<option value="2" selected>KGL Üyesi DEÐÝLDÝR</option>
							<?
							}
							
						?>
						</select>
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Üyelik Bitiþ Tarihi</strong></td>
						<td class="last">
						<?php
						$bitis = $rowla["bitis"];
						
						if($bitis){
							list($gun, $ay, $yil) = explode("-", date("d-m-Y", $bitis));
						?>
							Gün : <select name="bitis1" id="bitis1">
								<?php
									for($i = 1; $i <= 31; $i++){
										if($i == $gun) echo "<option value=$i selected>$i</option>";
										else echo "<option value=$i>$i</option>";
									}
								?>
							</select> 
							Ay : <select name="bitis2" id="bitis2">
								<?php
									for($i = 1; $i <= 12; $i++){
										if($i == $ay) echo "<option value=$i selected>$i</option>";
										else echo "<option value=$i>$i</option>";
									}
								?>
							</select> 
							Yil : <input type="text" name="bitis3" id="bitis3" value="<?=$yil?>" style="width:40px" /> 
							
							<p>Sýnýrsýz <input type="checkbox" name="bitis4" id="bitis4" value="1" /> </p>
						<?
						}
						else {
						?>
							Gün : <select name="bitis1" id="bitis1">
								<?php
									for($i = 1; $i <= 31; $i++){
										if($i == date("d")) echo "<option value=$i selected>$i</option>";
										else echo "<option value=$i>$i</option>";
									}
								?>
							</select> 
							Ay : <select name="bitis2" id="bitis2">
								<?php
									for($i = 1; $i <= 12; $i++){
										if($i == date("m")) echo "<option value=$i selected>$i</option>";
										else echo "<option value=$i>$i</option>";
									}
								?>
							</select> 
							Yil : <input type="text" name="bitis3" id="bitis3" value="<?=date("Y");?>" style="width:40px" /> 
							
							<p>Sýnýrsýz <input type="checkbox" name="bitis4" id="bitis4" value="1" checked /></p>
						<?
						}
						?>
						* Eðer sýnýrsýz seçili ise sýnýrsýz üyelik aktif olur. Seçim yapýlmadýysa seçilen tarih ne ise süre o kadardýr.
						</td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Seviye</strong></td>
						<td class="last">
						<select name="seviye" id="seviye">
						<?php
							$result = mysql_query("select id, ad from "._MX."seviye");
							
							while(list($sid, $sad) = mysql_fetch_row($result)){
								if($sid == $rowla["seviye"]) echo "<option value=$sid selected>$sad</option>";
								else echo "<option value=$sid>$sad</option>";
							}
						
						?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Bot Mesajý</strong></td>
						<td class="last">
						<?php
							if($rowla["botmesaji"] == 1) $selected = " selected";
							else $selected = NULL;
						?>
						<select name="botmesaji" id="botmesaji">
							<option value="0">Alsýn</option>
							<option value="1"<?=$selected?>>Almasýn</option>
						</select>
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Durum</strong></td>
						<td class="last">
							<select name="durum" id="durum">
							<?php
								function durumlarimiz($durum){
									
									$durumlar = array("", "Onaylý", "Admin Onaylý Bekleniyor", "Email Onay bekleniyor", "Süresiz Banlý", "Kendini Silmiþ", "Admin Silmiþ", "Süreli Banla");
									
									for($i = 1; $i <= 7; $i++){
										
										if($durum == $i) echo "<option value=$i selected>$durumlar[$i]</option>";
										else echo "<option value=$i>$durumlar[$i]</option>";
									
									}
								
								}
								
								durumlarimiz($rowla["durum"]);
							
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Ban sebebi</strong></td>
						<td class="last"><textarea name="bansebep" id="bansebep" style="width:250px"><?=stripslashes($rowla["bansebep"]);?></textarea></td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>Ban Bitiþ Tarihi</strong></td>
						<td class="last">
						<?php
						$bitis = $rowla["banbitis"];
						
						if($bitis){
							list($gun, $ay, $yil) = explode("-", date("d-m-Y", $bitis));
						?>
							Gün : <select name="b2" id="b2">
								<?php
									for($i = 1; $i <= 31; $i++){
										if($i == $gun) echo "<option value=$i selected>$i</option>";
										else echo "<option value=$i>$i</option>";
									}
								?>
							</select> 
							Ay : <select name="b2" id="b2">
								<?php
									for($i = 1; $i <= 12; $i++){
										if($i == $ay) echo "<option value=$i selected>$i</option>";
										else echo "<option value=$i>$i</option>";
									}
								?>
							</select> 
							Yil : <input type="text" name="b3" id="b3" value="<?=$yil?>" style="width:40px" /> 
						<?
						}
						else {
						?>
							Gün : <select name="b1" id="b1">
								<?php
									for($i = 1; $i <= 31; $i++){
										if($i == date("d")) echo "<option value=$i selected>$i</option>";
										else echo "<option value=$i>$i</option>";
									}
								?>
							</select> 
							Ay : <select name="b2" id="b2">
								<?php
									for($i = 1; $i <= 12; $i++){
										if($i == date("m")) echo "<option value=$i selected>$i</option>";
										else echo "<option value=$i>$i</option>";
									}
								?>
							</select> 
							Yil : <input type="text" name="b3" id="b3" value="<?=date("Y");?>" style="width:40px" /> 
							
						<?
						}
						?>
						* Duruma Süreli banlýyý seçmiþ olmanýz gerekmektedir.
						</td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " class="inputlar" onclick="kaydet()"><span id="kaydet"></span></td>
					</tr>
				</table>
				<?php
					} // profil
					
					if($yer == "resim"){
				?>
				<table class="listing" cellpadding="0" cellspacing="0" style="width:470px">
					<tr>
						<th class="full" colspan="3">RESIMLER <?=$kullanici?></th>
					</tr>
					<tr>
				
				<?php
						$i = 1;
						
						$result = mysql_query("select id, resim, kayit, durum from "._MX."uye_resim where uye='$id'");
				
						while(list($id, $resim, $kayit, $durum) = mysql_fetch_row($result)){
						$zaman = date("d.m.Y", $kayit);
				?>
				
						<td id="uyeid<?=$i?>" class="first style1" style="text-aling:center">
							<p align=center><a href="javascript:void(0)" onclick="pencere('../<?=$resim?>', '500', '600', 'resimpopup<?=$uye?>', 2, 1, 1);"><img src="../<?=$resim?>" width="110" border="0" /></a></p>
							<p align=center>
							<font color=black size=1><?=$zaman?> Tarihinde eklendi</font>
							</p>
							<p align="center">
							<?php 
								if($durum != 1){
							?>
							<a href="javascript:resimonayla(<?=$id?>, <?=$i?>)" title="Onayla"><img src="img/add-icon.gif" border="0" /></a> 
							<?php
								}
							?>
							<a href="javascript:resimsil(<?=$id?>, <?=$i?>)" title="Sil"><img src="img/hr.gif" border="0" /></a> 
							</p>
						</td>
				<?
						
						if($i%3 == 0) echo "</tr><tr>";
						$i++;
						}
				?>
				
					</tr>
				</table>
				<?
					} // resim
					
					
					if($yer == "galeri"){
				?>
				<table class="listing" cellpadding="0" cellspacing="0" style="width:470px">
					<tr>
						<th class="full" colspan="3">GALERILER <?=$kullanici?></th>
					</tr>
					<tr>
				
				<?php
						$i = 1;
						
						$result = mysql_query("select id, resim, kayit from "._MX."galeri where uye='$id'");
				
						while(list($gid, $resim, $kayit) = mysql_fetch_row($result)){
						$zaman = date("d.m.Y", $kayit);
				?>
				
						<td id="uyeid<?=$i?>" class="first style1" style="text-aling:center">
							<p align=center><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$gid?>', '500', '600', 'resimpopup<?=$uye?>', 2, 1, 1);"><img src="../<?=$resim?>" width="110" border="0" /></a></p>
							<p align=center>
							<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$gid?>', '500', '600', 'resimpopup<?=$id?>', 2, 1, 1);"><font color=black size=1>Galeri ID : <?=$gid?></font></a>
							</p>
							<p align=center>
							<font color=black size=1><?=$zaman?> Tarihinde eklendi</font>
							</p>
						</td>
				<?
						
						if($i%3 == 0) echo "</tr><tr>";
						$i++;
						}
				?>
				
					</tr>
				</table>
				
				<?
					
					} // galeri
					
					
					if($yer == "mesaj"){
				?>
				<table class="listing" cellpadding="0" cellspacing="0" style="width:470px">
					<tr>
						<th class="full" colspan="3">MESAJLAR<?=$kullanici?></th>
					</tr>
					<?php
						
						$result = mysql_query("select id, gonderen, gonderilen, konu, mesaj, kayit, yer, durum from "._MX."uye_mesaj where gonderen='$id' or gonderilen='$id'");
						
						while(list($mid, $gonderen, $gonderilen, $konu, $mesaj, $kayit, $yer, $durum) = mysql_fetch_row($result)){
						
						if($yer == 1) $yer = "<font color=red>Gelen Kutusu</font>";
						else $yer = "<font color=black>Arþiv</font>";
						
						if($gonderen == $id){
							$uyecik = $gonderilen;
							$yer = $yer ." - Göndermiþ";
						}
						else {
							$uyecik = $gonderen;
							$yer = $yer ." - Almýþ";
						}
						
						
						list($uyecik2) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$uyecik'"));
						
						$konu = stripslashes($konu);
						$mesaj = stripslashes($mesaj);
						
						$kayit = date("d.m.Y H:i");
						
						if($durum == 1) $durum = "<font color=green>Okunmuþ</font>";
						else $durum = "<font color=red>Okunmamýþ</font>";
						
					?>
					<tr id="mesajyer<?=$mid?>">
						<td class="first" width="120">
						Kime : <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uyecik?>', '500', '600', 'profilpopup<?=$uyecik?>', 2, 1, 1);"><?=$uyecik2?></a> <br>
						Yer : <?=$yer?> <br>
						Tarih : <?=$kayit?><br>
						Durum : <?=$durum?>
						</td>
						<td style="text-align:left">
						<p><b>Konu</b> : <?=$konu;?></p>
						<p><b>Mesaj</b> : <?=$mesaj;?></p>
						</td>
						<td width="20" class="last">
						<a href="javascript:mesajsil(<?=$mid?>)" title="Mesajý Sil"><img src='img/hr.gif' /></a>
						</td>
					</tr>
					<?php
					
						}
					
					?>

					
				</table>
				<?
					} // mesajlar
					
					
					if($yer == "diger"){
				?>
				<table class="listing" cellpadding="0" cellspacing="0" style="width:470px">
					<tr>
						<th class="full" colspan="2">Diðer iþlemler<?=$kullanici?></th>
					</tr>
					<tr>
						<td class="first" width="200"><strong>Haftanýn Üyesi Yap</strong></td>
						<td class="last" style="text-align:left"><input type="submit" value="Haftanýn Üyesi Yap" onclick="haftaninuyesi(<?=$id?>)" /> </td>
					</tr>
					<tr>
						<td class="first" width="200"><strong>Puan Ver</strong></td>
						<td class="last" style="text-align:left">
						<select name="puan" id="puan">
							<?php for($i = 5; $i >= 1; $i--) echo "<option value=$i>$i Puan</option>"; ?>
						</select>
						<input type="submit" value="Puan Ver" onclick="puanver(<?=$id?>)" /> * Üye popüler üye olur fakat puan veren rumuz gözükmez.
						</td>
					</tr>
					<tr>
						<td class="first" width="200"><strong>Mesaj Gönder</strong></td>
						<td class="last" style="text-align:left">
						
						<table>
							<tr><td>Gönderen</td><td width="1">:</td><td> <input type="text" name="mesajgonderen" id="mesajgonderen"><br> * Tam nicki yazýnýz</td></tr>
						<tr><td>Konu</td><td width="1">:</td><td> <input type="text" name="mesajkonu" id="mesajkonu"></td></tr>
						<tr><td>Mesaj</td><td width="1">:</td><td> <textarea name="mesajmesaj" id="mesajmesaj"></textarea></td></tr>
						<tr><td>&nbsp;</td><td width="1">:</td><td> <input type="submit" value=" Mesajý Gönder" onclick="mesajgonder(<?=$id?>)"><br> <span id="mesajsonuc"></span></td></tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="first" width="200"><strong>Online Yap</strong></td>
						<td class="last" style="text-align:left"><input type="submit" value="Online Yap" onclick="online(<?=$id?>)" /> </td>
					</tr>
					<tr>
						<td class="first" width="200"><strong>Bot Yap</strong></td>
						<td class="last" style="text-align:left"><input type="submit" value="Bot Yap" onclick="bot(<?=$id?>)" /> * Üye bot ise normal üye olur, normal üye ise bot olur.</td>
					</tr>
				</table>
				<?
					} // diger
				?>

			</div>	
					
	</div>


</body>
</html>
<?php
}
?>