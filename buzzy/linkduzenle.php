<?php
ob_start();
session_start();
$id = $_GET["id"];
if(!is_numeric($id)) die("Go");
include("fonksiyon.php");
$id = suz2($id);

$result = mysql_query("select id, uye, site, link, aciklama, bitis from linkler where id='$id' and uye='"._UYEID."'");

list($linkid, $uyeid, $site, $link, $aciklama, $bitis) = mysql_fetch_row($result);


if(!is_numeric($linkid) or _UYEID != $uyeid){
	
	yonlendir("index.php");
	
	die();
}

$site = stripslashes($site);
$link = stripslashes($link);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Link Düzenle, <?=_BASLIK?></title>
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
            <div class="kelime-analizi clearfix">
                <h1>Link Düzenle</h1>
                <div class="grafik left">
					<form action="javascript:void(0)" method="post">
					<table class="linkduzenle">
						<tbody>
							<tr>
								<td width="130">Alınan Site</td><td>:</td><td><input type="text" name="site" value="<?=$site?>" /></td>
							</tr>
							<tr>
								<td>Link</td><td>:</td><td><input type="text" name="link" value="<?=$link?>" /></td>
							</tr>
							<tr>
								<td>Açıklama</td><td>:</td><td><textarea name="aciklama"><?=$aciklama?></textarea></td>
							</tr>
							<tr>
								<td>Süre Durum</td><td>:</td><td>
								<select name="bitis" onChange="zamangoster(this.value)">
								<?php
									
									if($bitis == 1) $selected1 = " selected";
									else $selected2 = " selected";
																	
								?>
									<option value="1"<?=$selected1?>>Süresiz</option>
									<option value="2"<?=$selected2?>>Süre Belirleyin</option>
								</select>
								</td>
							</tr>
							<?php
								
								if($bitis == 1) $style = ' style="display:none"';
							?>
							<tr id="suresi"<?=$style?>>
								<td>Bitiş Tarihi</td><td>:</td><td>
								Gün : <select name="gun" style="width:70px">
								<?php
								if($bitis == 1) list($gun, $ay, $yil) = explode("-", date("d-m-Y"));
								else list($gun, $ay, $yil) = explode("-", date("d-m-Y", $bitis));
								
								for($i = 1; $i <= 31; $i++) {
									if($gun == $i) echo "<option value=$i selected>$i</option>";
									else echo "<option value=$i>$i</option>";
								}
								
								?>
							</select> Ay : <select name="ay" style="width:70px">
								<?php
								
								for($i = 1; $i <= 12; $i++) {
									if($ay == $i) echo "<option value=$i selected>$i</option>";
									else echo "<option value=$i>$i</option>";
								}
								
								?>
							</select>
								Yıl : <select name="yil" style="width:120px">
								<?php
								
								for($i = date("Y"); $i <= $yil+5; $i++) {
									if($yil == $i) echo "<option value=$i selected>$i</option>";
									else echo "<option value=$i>$i</option>";
								}
								
								?>
							</select>
								</td>
							</tr>

							<tr>
								<td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" value=" Linki Düzenle " onclick="linkduzenle(<?=$linkid?>)" /> <span id="sonuc"></span></td>
							</tr>
						</tbody>
					</table>
					</form>
                </div>
                <div class="kelimeler left">
                    <h2><span class="yellow"><i class="fa fa-comment-o"></i> Diğer</span> Linkler</h2>
                    <ul>
						<?php
						
						$result = mysql_query("select id, site, link from linkler where uye='"._UYEID."' order by id desc");
						
						while(list($lid, $site, $link) = @mysql_fetch_row($result)){
						
						$site = stripslashes($site);
						
						if(strlen($site) >= 46){
							
							$site = substr($site, 0, 45) ." ..";
						
						}
						?>
							<li class="clearfix"><div class="left"><?=$site?></div><span class="right"><a href="linkduzenle.php?id=<?=$lid?>" title="Düzenle">Düzenle</a></span></li>
						<?php
						}
						?>
						

                        
                    </ul>
                </div>
            </div>
        </div>
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
					
		});
		
		function linkduzenle(id){

				var s = $(".grafik input[name=site]").val();
				var l = $(".grafik input[name=link]").val();
				var a = $(".grafik textarea[name=aciklama]").val();
				var b = $(".grafik select[name=bitis]").val();
				var g = $(".grafik select[name=gun]").val();
				var ay = $(".grafik select[name=ay]").val();
				var y = $(".grafik select[name=yil]").val();
				if(s == ""){
					$("#sonuc").html("Link Alınan Site adresini yazınız.");
				}
				else if(l == ""){
					$("#sonuc").html("Link Aldığınız Site adresini yazınız.");
				}
				else {
					$("#sonuc").html('Güncelleniyor, lütfen bekleyin.');
					$(".grafik input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/linktakip.php?islem=linkduzenle',
							data: "s="+s+"&l="+l+"&a="+a+"&g="+g+"&b="+b+"&ay="+ay+"&y="+y+"&id="+id,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								$(".grafik input[type=submit]").attr("disabled", false);;
								$("#sonuc").html(sonuc);
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