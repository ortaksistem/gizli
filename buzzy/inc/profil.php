<?php
session_start();
ini_set('max_execution_time', 0);
$islem = $_GET["islem"];

if(!$islem) die("Go");

include("../fonksiyon.php");

if(!uye()){
	die("go to go");
}

if($islem == "desteksil"){

	$id = $_POST["id"];
	
	$id = suz2($id);
	
	if(!is_numeric($id)) die();
	
	$result = @mysql_query("delete from destek where id='$id' or cevap='$id' and uye='"._UYEID."'");
	
	if($result) die("ok");
	else die("hata");
	
}

if($islem == "destekicerik"){

	$id = $_POST["id"];
	
	$id = suz2($id);
	
	if(!is_numeric($id)) die();
	
	list($ilkmesaj, $ilkkayit) = @mysql_fetch_row(@mysql_query("select mesaj, kayit from destek where id='$id' and uye='"._UYEID."'"));
	
	$ilkmesaj = stripslashes($ilkmesaj);
	
	$kayit1 = date("d.m.Y", $ilkkayit);
	$kayit2 = date("H:i:s", $ilkkayit);
	?>
	<div class="cevap"><div class="icerik"><?=$ilkmesaj?></div><div class="kim">Siz<p><?=$kayit1?><br /><br /><?=$kayit2?></p></div></div>
	<?php
	$result = @mysql_query("select yonetici, mesaj, kayit from destek where cevap='$id' and uye='"._UYEID."' order by id asc");
	
	while(list($yonetici, $mesaj, $kayit) = @mysql_fetch_row($result)){
	
	$mesaj = stripslashes($mesaj);
	
	$kayit1 = date("d.m.Y", $kayit);
	$kayit2 = date("H:i:s", $kayit);
	
	if($yonetici == 1){
	?>
						<div class="cevap"><div class="kim">Yönetici<p><?=$kayit1?><br /><br /><?=$kayit2?></p></div><div class="icerik"><?=$mesaj?></div></div>
	<?php	
	}
	else {
	
	?>
						<div class="cevap"><div class="icerik"><?=$mesaj?></div><div class="kim">Siz<p><?=$kayit1?><br /><br /><?=$kayit2?></p></div></div>
	<?php	
	
	}
	
	
	}
?>
					
					<form action="javascript:void(0)" method="post" name="destektalepformu">
					<table>
						<tbody>
							<tr>
								<td>Cevabınız</td><td>:</td><td><textarea name="mesaj"></textarea></td>
							</tr>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td><td>
									<input type="submit" class="kapat" onclick="destekkapat(<?=$id?>)" value=" Kapat " />
									<input type="submit" class="sil" onclick="desteksil(<?=$id?>)" value=" Sil " />
									<input type="submit" class="cevapla" onclick="destekcevapla(<?=$id?>)" value=" Cevapla " />
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td><td class="sonuc"></td>
							</tr>
						</tbody>
					</table>
					</form>
<?php

	@mysql_query("update destek set durum='1' where id='$id' or cevap='$id' and uye='"._UYEID."'");
die();
}

if($islem == "destekcevapla"){
	
	$mesaj = $_POST["m"];
	$id = $_POST["id"];
	
	$id = suz2($id);
	
	if(!is_numeric($id)) die();

	$mesaj = suz2($mesaj);
	
	if($mesaj and $id){
		
		$result = mysql_query("insert into destek (uye, cevap, mesaj, kayit, durum) values('"._UYEID."', '$id', '$mesaj', '".@mktime()."', '1')");
		
		if($result){
			
			die("ok");
		
		}
		else {
			die("hata");
		}
	
	}
	else {	
		die("Gerekli alanlar boş");
	}
}

if($islem == "destektalebi"){
	
	$mesaj = $_POST["m"];
	$konu = $_POST["k"];

	$mesaj = suz2($mesaj);
	$konu = suz2($konu);
	
	if($mesaj and $konu){
		
		$result = mysql_query("insert into destek (uye, konu, mesaj, kayit, durum) values('"._UYEID."', '$konu', '$mesaj', '".@mktime()."', '1')");
		
		if($result){
			
			die("ok");
		
		}
		else {
			die("hata");
		}
	
	}
	else {	
		die("Gerekli alanlar boş");
	}
}

if($islem == "profilbilgi"){

	$isim = $_POST["s"];
	$tel = $_POST["s1"];
	$aciklama = $_POST["s2"];
	
	$aciklama = suz2($aciklama);
	$tel = suz2($tel);
	$isim = suz2($isim);
	
	if(!is_numeric($tel) or strlen($tel) != 10){
		die("Telefon numaranız hatalıdır. Örn : 5321234567 gibi olmalıdır");
	}
	
	$result = @mysql_query("update kullanici set isim='$isim', tel='$tel', aciklama='$aciklama' where id='"._UYEID."'");
	
	if($result) die("Bilgileriniz güncellenmiştir");
	else die("Güncelleme işlemi yapılamıyor, sonra tekrar deneyiniz");
	
}

if($islem == "sifredegistir"){
	
	$eski = $_POST["s"];
	$yeni = $_POST["s1"];
	$yeni1 = $_POST["s2"];

	if(strlen($yeni) < 6){
		die("Şifreniz güvensiz bir şifre değil mi?");
	}
	
	if($yeni != $yeni1){
		die("Yeni şifreniz ile tekrarı uyuşmuyor");
	}
	
	list($eskis) = @mysql_fetch_row(@mysql_query("select sifre from kullanici where id='"._UYEID."'"));
	
	
	if($eskis == sifrele($eski)){
		
		$yeni = sifrele($yeni);
		
		$result = @mysql_query("update kullanici set sifre='$yeni' where id='"._UYEID."'");
		
		if($result) {
			session_destroy();
			die("tamam");
		}
		else {
			die("Şifreniz şuanda değiştirilemiyor, tekrar dener misiniz");
		}
	}
	else {
	
		die("Eski şifreniz doğru değildir");
	
	}
}

?>