<?php

$islem = $_POST["islem"];

if($islem == "uyeol"){
	
	$rumuz = $_POST["rumuz"];
	
	$rumuz = turkce($rumuz);
	$rumuz = strtr($rumuz,"ÜÞÇÝÐÖüöþçiðý?","USCIGOuoscigi,");
	
	$result = mysql_query("select id from "._MX."uye where kullanici='$rumuz'");
	
	if(mysql_fetch_row($result) < 1){
		
		$email = $_POST["email"];
		
		$result = mysql_query("select id from "._MX."uye where email='$email'");
		
		$warmi = @mysql_num_rows($result);
		
		if($warmi >= 1) die("email");
		
		$boy = turkce($_POST["boy"]);
		$kilo = turkce($_POST["kilo"]);
		$sifre = turkce($_POST["sifre"]);
		$goz = turkce($_POST["goz"]);
		$sac = turkce($_POST["sac"]);
		$isim = addslashes(turkce($_POST["isim"]));
		$d1 = turkce($_POST["d1"]);
		$d2 = turkce($_POST["d2"]);
		$d3 = turkce($_POST["d3"]);
		$iliski = turkce($_POST["iliski"]);
		$aracinsiyet = turkce($_POST["aracinsiyet"]);
		$ulke = turkce($_POST["ulke"]);
		$sehir = turkce($_POST["sehir"]);
		$cinsiyet = turkce($_POST["cinsiyet"]);
		$medenidurum = turkce($_POST["medenidurum"]);
		$tanitim = addslashes(turkce($_POST["tanitim"]));
		$webcam = turkce($_POST["webcam"]);
	
		if($webcam == 1) $webcam = "Evet";
		else $webcam = "Hayir";
	
		$sifre = sifrele($sifre);
		$kayit = mktime();
		$kayit2 = 60 * 120;
		$kayit2 = $kayit - $kayit2;
		
		$dogum = mktime(0,0,0, $d2, $d1, $d3);
		
		
		$seviyeid = seviye(NULL, "id");
		$seviye = seviye($seviyeid, "oncelik");
		
		$oncelik = $cinsiyet * $seviye;
		
		$uyelik = ayar("uyelik");
		
		$ip = $_SERVER["REMOTE_ADDR"];
		
		$bakbakalim = @mysql_query("select count(id) from "._MX."uye where sononline > $kayit2 and ip='$ip'");
		
		list($bakbakalim2) = @mysql_fetch_row($bakbakalim);
		
		if($bakbakalim2 >= 1) die("uyeolmus");
		
		
		list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
		$maxid++;
		
		$ref = $_SESSION[_COOKIE."ref"];
		
		if(!$ref) $ref = NULL;
		
		list($ad, $soyad) = explode(" ", $isim);
		
		$tel = NULL;
		
		$result = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, medenidurum, webcamsohbet, iliski, aracinsiyet, boy, kilo, goz, sac, tanitim, sononline, girissayisi, ip, kayit, ref, oncelik, seviye, durum) values('$maxid', '$rumuz', '$sifre', '$email', '$ad', '$soyad', '$no', '$dogum', '$cinsiyet', '$ulke', '$sehir', '$medenidurum', '$webcam', '$iliski', '$aracinsiyet', '$boy', '$kilo', '$goz', '$sac', '$tanitim', '$kayit', '1', '$ip', '$kayit', '$ref', '$oncelik', '$seviyeid', '$uyelik')");
		
		if($result){
		
			die("ok");
		}
		else {
			die("hata");
		}
		
		
	}
	else {
		die("rumuz");
	}

}
else if($islem == "sil"){

$id = $_GET["id"];

@mysql_query("delete from mailler where id='$id'");

die("ok");

}
else {

$id = $_GET["id"];

list($email) = mysql_fetch_row(mysql_query("select email from mailler where id='$id'"));

function aylar($param){
	
	$aylar = array("", "Ocak", "Þubat", "Mart", "Nisan", "Mayýs", "Haziran", "Temmuz", "Aðustos", "Eylül", "Ekim", "Kasým", "Aralýk");
	
	if($param){
		return $aylar[$param];
	}
	else {
		for($i = 1; $i<=12; $i++) {
			echo "<option value=\"$i\">$aylar[$i]</option>";
		}
	}
	
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="tr-TR">
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Yatakpartnere hoþgeldiniz , Mesajýnýzý okuyabilmek için üyeliðinizi tamamlamanýz gerekmektedir</title>
<link rel="stylesheet" type="text/css" href="inc/reset.css" />
<link rel="stylesheet" type="text/css" href="inc/style-giris.css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type="text/javascript">
	function tamamla(){
		var rumuz = $.trim($("#rumuz").val());
		var email = $.trim($("#email").val());
		var boy = $.trim($("#boy").val());
		var kilo = $.trim($("#kilo").val());
		var sifre = $.trim($("#sifre").val());
		var sifre2 = $.trim($("#sifre2").val());
		var goz = $.trim($("#goz").val());
		var sac = $.trim($("#sac").val());
		var isim = $.trim($("#isim").val());
		var d1 = $.trim($("#d1").val());
		var d2 = $.trim($("#d2").val());
		var d3 = $.trim($("#d3").val());
		var iliski = $.trim($("#iliski").val());
		var aracinsiyet = $.trim($("#aracinsiyet").val());
		var ulke = $.trim($("#ulke").val());
		var sehir = $.trim($("#sehir").val());
		var cinsiyet = $.trim($("#cinsiyet").val());
		var medenidurum = $.trim($("#medenidurum").val());
		var tanitim = $.trim($("#tanitim").val());
		var webcam = $.trim($("#webcam:checked").val());
		var id = <?=$id?>;
			
		if(rumuz == ""){
			alert("Lütfen rumuz belirleyiniz");
		}
		else if(isim == ""){
			alert("Ýsim alanýný boþ býrakmayýnýz");
		}
		else if(sifre == ""){
			alert("Lütfen bir þifre belirleyiniz");
		}
		else if(sifre != sifre2){
			alert("Þifre ile tekrarý uyuþmamaktadýr");
		}
		else if(tanitim == ""){
			alert("Lütfen kýsaca kendinizi tanýtýnýz");
		}
		else {

			var zaman = new Date()
			var yil = zaman.getFullYear();
			var maxyil = yil - 20;
			var minyil = yil - 59;
		
			if(d3 >= maxyil){
			
				alert("Lütfen doðum yýlýnýzý kontrol ediniz.\nSitemize 21 yaþýndan küçük ve 60 yaþýndan büyük kullanýcýlar üye olamaz.");
								
				exit();
				
			}
			
			if(d3 <= minyil){
			
				alert("Lütfen doðum yýlýnýzý kontrol ediniz.\nSitemize 21 yaþýndan küçük ve 60 yaþýndan büyük kullanýcýlar üye olamaz.");
								
				exit();
			}
			
			var cinsiyetad = "";

			switch(cinsiyet){
				case "1": cinsiyetad = "Bayan";break;
				case "2": cinsiyetad = "Çift";break;
				case "3": cinsiyetad = "Erkek";break;
				case "4": cinsiyetad = "Lezbiyen";break;
				case "5": cinsiyetad = "Biseksüel Bayan";break;
				case "6": cinsiyetad = "Biseksüel Çift";break;
				case "7": cinsiyetad = "Biseksüel Erkek";break;
				case "8": cinsiyetad = "Transeksüel";break;
			}
			
			var onayal = confirm("Lütfen bilgilerinizi kontrol ediniz.\n\nBu bilgileri site içerisinde daha sonra güncelleme hakkýnýz bulunmamaktadýr. \nBilgileriniz aþaðýdadýr\n*************************************\n\nKullanýcý adýnýz : "+rumuz+"\n\nEmail Adresiniz : "+email+"\n\nDogum Tarihiniz : "+d1+"."+d2+"."+d3+"\n\nAdýnýz Soyadýnýz : "+isim+"\n\nCinsiyetiniz : "+cinsiyetad+"\n\n*************************************\n\nBilgileriniz doðru ise tamam tuþuna basýnýz, deðilse iptal tuþuna basarak yeniden düzenleyebilirsiniz.");
			
			if(onayal){
				$(".yukleniyor").show();
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=giris3',
					data : "islem=uyeol&rumuz="+rumuz+"&email="+email+"&boy="+boy+"&kilo="+kilo+"&sifre="+sifre+"&goz="+goz+"&sac="+sac+"&isim="+isim+"&d1="+d1+"&d2="+d2+"&d3="+d3+"&iliski="+iliski+"&aracinsiyet="+aracinsiyet+"&ulke="+ulke+"&sehir="+sehir+"&cinsiyet="+cinsiyet+"&medenidurum="+medenidurum+"&webcam="+webcam+"&tanitim="+tanitim+"&id="+id,
					success: function(sonuc){		
						if(sonuc == "hata"){
							alert("Bir sistem hatasý oluþtu. Bilgilerinizi kontrol ederek sonra tekrar deneyiniz");
						}
						else if(sonuc == "rumuz"){
							alert("Rumuzunuz sistemimize kayýtlýdýr, lütfen farklý rumuz deneyiniz");
						}
						else if(sonuc == "email"){
							alert("Email adresiniz sistemimize kayýtlýdýr, lütfen farklý email adresi deneyiniz");
						}
						else if(sonuc == "uyeolmus"){
							alert("Sitemizden sadece bir defa üyelik alabilirsiniz.");
							yonlendir("index.php");
						}
						else {
							alert("Üyeliðiniz baþarýyla tamamlanmýþtýr, Anasayfaya giderek giriþ yapabilirsiniz.\n\nTeþekkür ederiz...");
							window.location = 'index.php';
						}
						$(".yukleniyor").hide();
					}
				})	
			
			}
		}
		
	}
	function sil(){
		var id = <?=$id?>;
		
		var onayla = confirm("Silmek istediðinizden emin misiniz?");
		
		if(onayla){
				$(".yukleniyor").show();
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=giris3',
					data : "islem=sil&id="+id,
					success: function(sonuc){		
							alert("Sistemden baþarýyla silindiniz.\n\nTeþekkür ederiz...");
							window.location = 'index.php';
						$(".yukleniyor").hide();
					}
				})
		
		}
	}
	function sehirgetir(ulke){
	
		$("#sehirgetir").html("<br /><font color=red size=2><b>Bekleyin</b></font>");
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/sehiryukle.php',
					data : "ulke="+ulke,
					success: function(sonuc){		
						$("#sehirgetir").html(sonuc);	
					}
				})
	}
</script>
</head>
<body>

<div id="ana">
	<div class="ana">
		<div class="ust"><div class="yukleniyor">Ýþleminiz gerçekleþtiriliyor, lütfen bekleyiniz</div></div>
		<div class="orta">
			<div class="icerik">
				<ul>
					<li>Rumuz <input type="text" name="rumuz" id="rumuz" /></li>
					<li>E-posta <input type="text" name="email" id="email" value="<?=$email?>" disabled /></li>
					<li>Boyunuz 
						<select name="boy" id="boy">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<option value="<?=$ad?>"><?=$ad?></option>
															<?
														}
													?>
						</select>
					</li>
					<li>Kilonuz 
						<select name="kilo" id="kilo">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<option value="<?=$ad?>"><?=$ad?></option>
															<?
														}
													?>
						</select>
					</li>
					<li>Þifre <input type="password" name="sifre" id="sifre" /></li>
					<li>Þifre (Tekrar) <input type="password" name="sifre2" id="sifre2" /></li>
					<li>Göz Renginiz 
						<select name="goz" id="goz">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='7'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<option value="<?=$ad?>"><?=$ad?></option>
															<?
														}
													?>
						</select>
					</li>
					<li>Saç Renginiz 
						<select name="sac" id="sac">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='8'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<option value="<?=$ad?>"><?=$ad?></option>
															<?
														}
													?>
						</select>
					</li>
					<li>Ýsim Soyisim <input type="text" name="isim" id="isim" /></li>
					<li>Doðum Tarihiniz<br />
						<select name="d1" id="d1">
							<? for($i = 1; $i<=31; $i++){ echo "<option value=\"$i\">$i</option>"; } ?>
						</select>
						<select name="d2" id="d2">
							<? aylar(NULL); ?>
						</select>
						<input type="text" name="d3" id="d3" value="19" />
					</li>
					<li>Aradýðýnýz Ýliþki Türü
						<select name="iliski" id="iliski">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='2'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<option value="<?=$ad?>"><?=$ad?></option>
															<?
														}
													?>
						</select>
					</li>
					<li>Aradýðýnýz Cinsiyet
						<select name="aracinsiyet" id="aracinsiyet">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='18'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<option value="<?=$ad?>"><?=$ad?></option>
															<?
														}
													?>
						</select>
					</li>
					<li>Yaþadýðý Ülke
						<select name="ulke" id="ulke" onChange="sehirgetir(this.value)">
																	<?
																		$result = mysql_query("select id, adi from "._MX."ulkeler order by adi asc");
																		
																		while(list($uid, $uadi) = mysql_fetch_row($result)){
																			if($uid == 214) echo "<option value=\"$uadi\" selected>".turkce($uadi)."</option>";
																			else echo "<option value=\"$uadi\">".turkce($uadi)."</option>";
																		}
																	
																	?>
						</select>
					</li>
					<li>Yaþadýðý Þehir
						<span id="sehirgetir">
						<select name="sehir" id="sehir">
																								<?
																		$result = mysql_query("select id, adi from "._MX."sehirler where ulke='214' order by adi asc");
																		
																		while(list($sid, $sadi) = mysql_fetch_row($result)){
																			echo "<option value=\"$sadi\">".turkce($sadi)."</option>";
																		}	
																	?>
						</select>
						</span>
					</li>

					<li>Cinsiyet
						<select name="cinsiyet" id="cinsiyet">
							<? cinsiyet(NULL); ?>
						</select>
					</li>
					<li>Medeni Durum
						<select name="medenidurum" id="medenidurum">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='16'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<option value="<?=$ad?>"><?=$ad?></option>
															<?
														}
													?>
						</select>
					</li>
					<li class="tanitim">
						Kýsaca Kendinizden Bahsedin
						<textarea name="tanitim" id="tanitim"></textarea>
					</li>
					<li class="webcam">Webcam Sohbetten ?
						<input type="radio" name="webcam" id="webcam" value="1" /> <span>Hoþlanýrým</span> 
						<input type="radio" name="webcam" id="webcam" value="2" /> <span>Hoþlanmam </span>
					</li>
				</ul>
					<div class="bir"><a href="javascript:void(0)" onclick="tamamla();"><img src="img/mail-giris-tamamla.png" /></a></div>
					<div class="iki"><a href="javascript:void(0)" onclick="sil();"><img src="img/mail-giris-sil.png" /></a></div>
			</div>
		</div>
		<div class="alt"></div>
	</div>
</div>
</body>
</html><?php } ?>