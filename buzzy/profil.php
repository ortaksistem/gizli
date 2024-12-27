<?php
ob_start();
session_start();
include("fonksiyon.php");
if(!uye()){
	yonlendir("index.php");
	die();
}
$result = @mysql_query("select * from kullanici where id='"._UYEID."'");

$array = @mysql_fetch_array($result);

$kullaniciadi = stripslashes($array["kullaniciadi"]);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$kullaniciadi;?> Profil Merkezi, <?=_BASLIK?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link href="Assets/Css/reset.css" rel="stylesheet" />
    <link href="Assets/Css/flexslider.css" rel="stylesheet" />
    <link href="Assets/Css/font-awesome.min.css" rel="stylesheet" />
    <link href="Assets/Css/main.css" rel="stylesheet" />
	<base href="<?=_URL?>" />
</head>
<body>
<?php include("header.php"); ?>
   <div class="whitebg">
        <div class="container">

			<div class="k-top"><h2>Hoşgeldin <?=$kullaniciadi?></h2></div>
			
			<div class="k-sol" id="hesapozeti">
				<div class="k-sol-top"><h3>Hesap Özeti</h3></div>
				<div class="bilgi">
					Bu alan hesap özeti alanıdır.
				</div>
			</div>
			
			<div class="k-sol" id="destekler" style="display:none">
				<div class="k-sol-top"><h3>Destek Talepleri</h3></div>
				<div class="bilgi">
					<ul>
					<?php
						
						$talepsay = 0;
						
						$result = @mysql_query("select id, konu, kayit, durum from destek where uye='"._UYEID."' and cevap is NULL order by id desc");
						
						
						if(@mysql_num_rows($result) < 1){
						
						echo '<li><span class="tarih"><strong>Henüz destek bildirimiz bulunmamaktadır.</strong></span></li>';
						
						}
						else {
						while(list($did, $dkonu, $dkayit, $ddurum) = @mysql_fetch_row($result)){
						
						$dkonu = stripslashes($dkonu);
						
						if($ddurum == 2) {$ddurum = 1; $talepsay++;}
						else $ddurum = 2;
						
						$dkayit = date("d.m.Y H:i", $dkayit);
						
					?>
					<li class="clearfix" id="<?=$did?>">
						<span class="tarih"><strong>Konu : </strong><?=$dkonu?></span>
						<span class="durum"><img src="Assets/Img/destek<?=$ddurum?>.png" /></span>
						<span class="tarih2"><?=$dkayit?></span>

					</li>
					
					<?php
						}
						
						} // end if
					
					?>
					</ul>
				</div>
			</div>
			

			<div class="k-sol" id="destektalebi" style="display:none">
				<div class="k-sol-top"><h3>Yeni Destek Talebi</h3></div>
				<div class="bilgi">
					<form action="javascript:void(0)" method="post" name="destektalepformu">
					<table>
						<tbody>
							<tr>
								<td>Destek Konusu</td><td>:</td><td>
								<select name="konu">
									<option>Bilgi Edinme</option>
									<option>Destek</option>
									<option>Ödeme</option>
									<option>Bir Fikrim/Önerim Var</option>
									<option>Diğer Konular</option>
								</select>
								</td>
							</tr>
							<tr>
								<td>Mesajınız</td><td>:</td><td><textarea name="mesaj"></textarea></td>
							</tr>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td><td><input type="image" src="Assets/Img/kaydet.png" onclick="destektalebigonder()" /> </td>
							</tr>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td><td class="sonuc"></td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
			
			<div class="k-sol" id="odemegecmisi" style="display:none">
				<div class="k-sol-top"><h3>Ödeme Geçmişi</h3></div>
				<div class="bilgi">
					<ul>
					<?php
						
						$result = @mysql_query("select tutar, tur, sure, zaman from odeme where uye='"._UYEID."'");
						
						if(@mysql_num_rows($result) < 1){
						
							echo '<li><span class="tarih">Henüz Ödemeniz Bulunmuyor</span></li>';
						
						}
						else {
							
							while(list($tutar, $tur, $sure, $zaman) = @mysql_fetch_row($result)){
							
							$zaman = turkcetarih($zaman);
							
							switch($tur){
								case "large": $tur = "<font color=red>Large</font>";break;
								case "medium": $tur = "<font color=blue>Medium</font>";break;
							}
							
							echo '<li><span class="tarih">'.$zaman.' <strong>('.$sure.' - '.$tur.')</strong></span><span class="tutar">'.$tutar.' TL</span></li>';
						
							}
						}
					
					?>
					</ul>
				</div>
			</div>
			
			<div class="k-sol" id="profilbilgi" style="display:none">
				<div class="k-sol-top"><h3>Üyelik Bilgi Güncelle</h3></div>
				<div class="bilgi">
					<form action="javascript:void(0)" method="post">
					<table>
						<tbody>
							<tr>
								<td width="130">Kullanıcı Adınız</td><td>:</td><td><input type="text" name="kadi" value="<?=$kullaniciadi?>" disabled /></td>
							</tr>
							<tr>
								<td>E-Posta Adresiniz</td><td>:</td><td><input type="text" name="eposta" value="<?=stripslashes($array["eposta"]);?>" disabled /></td>
							</tr>
							<tr>
								<td>İsim - Soyisim</td><td>:</td><td><input type="text" name="isim" value="<?=stripslashes($array["isim"]);?>" /></td>
							</tr>
							<tr>
								<td>Telefon Numaranız</td><td>:</td><td><input type="text" name="telefon" value="<?=stripslashes($array["tel"]);?>" style="width:250px" /> Örn: 5321234567</td>
							</tr>
							<tr>
								<td>Kısa Açıklama</td><td>:</td><td><textarea name="aciklama"><?=stripslashes($array["aciklama"]);?></textarea></td>
							</tr>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td><td><input type="image" src="Assets/Img/kaydet.png" onclick="profilbilgiguncelle()" /> </td>
							</tr>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td><td class="sonuc"></td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
			
			<div class="k-sol" id="sifredegistir" style="display:none">
				<div class="k-sol-top"><h3>Şifre Değiştir</h3></div>
				<div class="bilgi">
				<form action="javascript:void(0)" method="post">
					<table>
						<tbody>
							<tr>
								<td width="130">Eski Şifreniz</td><td>:</td><td><input type="password" name="pass" value="" /></td>
							</tr>
							<tr>
								<td>Yeni Şifreniz</td><td>:</td><td><input type="password" name="pass1" value="" /></td>
							</tr>
							<tr>
								<td>Yeni Şifre Tekrarı</td><td>:</td><td><input type="password" name="pass2" value="" /></td>
							</tr>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td><td><input type="image" src="Assets/Img/kaydet.png" onclick="sifredegistir()" /></td>
							</tr>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td><td class="sonuc"></td>
							</tr>
						</tbody>
					</table>
				</form>
				</div>
			</div>
			
			
			<div class="k-sag">
				<div class="k-sag-top"><h3>KULLANICI<span>PANELİ</span></h3></div>
				<ul>
					<li class="aktif"><a href="javascript:void(0)" onclick="profilgoster('hesapozeti')">Hesap Özeti</a></li>
					<li><a href="javascript:void(0)" class="profilbilgi" onclick="profilgoster('profilbilgi')">Profil Bilgi Güncelle</a></li>
					<li><a href="javascript:void(0)" onclick="profilgoster('sifredegistir')">Şifre Değiştir</a></li>
					<li><a href="javascript:void(0)" onclick="profilgoster('destekler')">Destek Merkezi <span><?php if($talepsay >= 1) echo "($talepsay Cevaplanmış)"; else echo "(Yeni Mesaj Yok)";?></span></a></li>
					<li><a href="javascript:void(0)" onclick="profilgoster('destektalebi')">Yeni Destek Talebi</a></li>
					<li><a href="javascript:void(0)" onclick="profilgoster('odemegecmisi')">Ödeme Geçmişi</a></li>
					<li><a href="cikis.php">Güvenli Çıkış</a></li>
				</ul>
			</div>

        </div>
		<div class="clearfix"></div>
    </div>
<?php include("footer.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
    <script>
		$(document).ready(function(){
			$("input[name=domainismi]").on({focus: function(){if($(this).val() == "") $(this).val("http://");},blur: function(){if($(this).val() == "http://") $(this).val("");}});
			$(".user-login").click(function(){$(".linkekle").css("display", "none");if($(".user-login2").css("display") == "none") $(".user-login2").css("display", "block");else $(".user-login2").css("display", "none");});
			
			$(".first input[type=submit]").click(function(){
				var k = $(".first input[name=username]").val();
				var s = $(".first input[name=password]").val();
				if(k == ""){
					$(".first .sonuc").html("E-posta veya kullanıcı adını yazınız");
				}
				else if(s == ""){
					$(".first .sonuc").html("Şifrenizi yazınız");
				}
				else {
					$(".first .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".first input[type=submit]").val('Lütfen Bekleyin...');
					$(".first input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/uye.php?islem=giris',
							data: "k="+k+"&s="+s,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "ok"){
									$(".user-login2").css("display", "none");
									$(".user-login").html('<img src="Assets/Img/user-icon.png" /> Merhaba <b>'+k+'</b> <a href="cikis.php">Çıkış</a>');
									$(".user-login2").html('<p><font color=white>Üye Menüsü Gelicek</p>');
								}
								else {
									$(".first input[type=submit]").attr("disabled", false);;
									$(".first input[type=submit]").val('Giriş Yap');
									$(".first .sonuc").html(sonuc);
								}
							}
						})
				}
			});

			$(".second input[type=submit]").click(function(){
				var k = $(".second input[name=username]").val();
				if(k == ""){
					$(".second .sonuc").html("E-posta veya kullanıcı adını yazınız");
				}
				else {
					$(".second .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".second input[type=submit]").val('Lütfen Bekleyin...');
					$(".second input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/uye.php?islem=sifremiunuttum',
							data: "k="+k,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "ok"){
									$(".second input[name=username]").val("");
									$(".second input[type=submit]").val('Şifremi Gönder');
									$(".second .sonuc").html("Şifreniz başarıyla değiştirilip e-posta adresinize gönderilmiştir.<br /><br />E-posta adresinizde junk kısmına bakmanızı tavsiye ederiz.");
								}
								else {
									$(".second input[type=submit]").attr("disabled", false);;
									$(".second input[type=submit]").val('Şifremi Gönder');
									$(".second .sonuc").html(sonuc);
								}
							}
						})
				}
			});
			
			$(".third input[type=submit]").click(function(){
				var k = $(".third input[name=username]").val();
				var s = $(".third input[name=password]").val();
				var e = $(".third input[name=eposta]").val();
				if(k == ""){
					$(".third .sonuc").html("Kullanıcı adını yazınız");
				}
				else if(e == ""){
					$(".third .sonuc").html("E-posta adresinizi yazınız");
				}
				else if(s == ""){
					$(".third .sonuc").html("Şifrenizi yazınız");
				}
				else {
					$(".third .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".third input[type=submit]").val('Lütfen Bekleyin...');
					$(".third input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/uye.php?islem=uyeol',
							data: "k="+k+"&s="+s+"&e="+e,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "tamam"){
									$(".third ul").html('<li>Başarıyla üye oldunuz.<br /><br /><a href="javascript:void(0)" onclick="goster(\'first\')"><b>BURAYA</b> tıklayarak giriş yapabilirsiniz.</a></li>');
								}
								else {
									$(".third input[type=submit]").attr("disabled", false);;
									$(".third input[type=submit]").val('Üyeliğimi Tamamla');
									$(".third .sonuc").html(sonuc);
								}
							}
						})
				}
			});
			
			$("#destekler li").click(function(){
				var id = $(this).attr("id");
				if(id){
					$("."+id).remove();
					$("#"+id+" .durum").html("<img src='Assets/Img/loader3.gif' />");
					$(this).css("height", "100%");
							jQuery.ajax({
								type: 'POST',
								url: 'inc/profil.php?islem=destekicerik',
								data: "id="+id,
								success: function(sonuc){
									$("#"+id).after("<div class='"+id+"'>"+sonuc+"</div>");
									$("#"+id+" .durum").html($("#"+id+" .tarih2").html());
								}
							})
				}
			});
			
			$(".k-sag li").click(function(){
				$(".k-sag li").removeClass("aktif");
				$(this).addClass("aktif");
			});			
		});
		
		function profilgoster(nere){$(".k-sol").hide();$("#"+nere).show();}
		function destekkapat(id) {$("."+id).remove();}
		function desteksil(id) {
			var onayla = confirm("Silmek istediğinizden emin misiniz?");
			if(onayla){
				$("."+id).remove();
				$("#"+id+" .durum").html("<img src='Assets/Img/loader3.gif' />");
							jQuery.ajax({
								type: 'POST',
								url: 'inc/profil.php?islem=desteksil',
								data: "id="+id,
								success: function(sonuc){
									$("#"+id).hide();
								}
							})
			}
		}
		function destekcevapla(id){
				var m = $("."+id+" textarea[name=mesaj]").val();	
				if(m == ""){
					$("."+id+" .sonuc").html("Bir mesaj yazınız");
				}
				else {
					$("."+id+" .sonuc").html("Gönderiliyor, bekleyin...");
					$("."+id+" .cevapla").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/profil.php?islem=destekcevapla',
							data: "m="+m+"&id="+id,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "ok"){
									$("."+id+" .sonuc").html("Mesajınız başarıyla kaydedilmiştir. <br />Yöneticilerimiz en kısa sürede sizlere dönüş yapacaktır");
								}
								else {
									$("."+id+" .sonuc").html(sonuc);
									$("."+id+" input[type=submit]").attr("disabled", false);;
								}
								
							}
						})
				}
		}
		
		function sifredegistir(){
				var s = $("#sifredegistir input[name=pass]").val();
				var s1 = $("#sifredegistir input[name=pass1]").val();
				var s2 = $("#sifredegistir input[name=pass2]").val();
				if(s == "" || s1 == "" || s2 == ""){
					$("#sifredegistir .sonuc").html("Tüm alanları doldurunuz.");
				}
				else if(s1 != s2){
					$("#sifredegistir .sonuc").html("Yeni şifreniz ile tekrarı aynı olması gerekmiyor mu?");
				}
				else if(s == s1){
					$("#sifredegistir .sonuc").html("Yeni şifreniz ile eskisi aynı olduktan sonra şifre değiştirmenizin bir anlamı var mı?");
				}
				else {
					$("#sifredegistir .sonuc").html("Güncelleniyor, bekleyin...");
					$("#sifredegistir input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/profil.php?islem=sifredegistir',
							data: "s="+s+"&s1="+s1+"&s2="+s2,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "tamam"){
									alert("Şifreniz değiştirilmiştir. Yeniden giriş yapmanız gerekmektedir.");
									window.location='index.php';
								}
								else {	
									$("#sifredegistir .sonuc").html(sonuc);
									$("#sifredegistir input[type=submit]").attr("disabled", false);;
								}
							}
						})
				}	
		}
		function profilbilgiguncelle(){
				var s = $("#profilbilgi input[name=isim]").val();
				var s1 = $("#profilbilgi input[name=telefon]").val();
				var s2 = $("#profilbilgi textarea[name=aciklama]").val();
					$("#profilbilgi .sonuc").html("Güncelleniyor, bekleyin...");
					$("#profilbilgi input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/profil.php?islem=profilbilgi',
							data: "s="+s+"&s1="+s1+"&s2="+s2,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								$("#profilbilgi .sonuc").html(sonuc);
								$("#profilbilgi input[type=submit]").attr("disabled", false);;
							}
						})
				
		}
		function destektalebigonder(){
				var k = $("#destektalebi select[name=konu]").val();
				var m = $("#destektalebi textarea[name=mesaj]").val();
				
				if(m == ""){
					$("#destektalebi .sonuc").html("Bir mesaj yazınız");
				}
				else {
					$("#destektalebi .sonuc").html("Gönderiliyor, bekleyin...");
					$("#destektalebi input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/profil.php?islem=destektalebi',
							data: "m="+m+"&k="+k,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "ok"){
									$("#destektalebi .sonuc").html("Mesajınız başarıyla kaydedilmiştir. <br />Yöneticilerimiz en kısa sürede sizlere dönüş yapacaktır");
									document.destektalepformu.reset();
								}
								else {
									$("#destektalebi .sonuc").html(sonuc);
								}
								$("#destektalebi input[type=submit]").attr("disabled", false);;
							}
						})
				}
		}
		
		function denetle(){if($("input[name=domainismi]").val() == "") {alert ("Geçersiz Domain, Lütfen Kontrol Ediniz."); return false;}}
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
		function zamangoster(nere){if(nere == 2) $("#suresi").show();else $("#suresi").hide();}
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>