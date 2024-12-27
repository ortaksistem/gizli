<?php
ob_start();
session_start();
include("fonksiyon.php");

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Link Takip, <?=_BASLIK?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link href="Assets/Css/reset.css" rel="stylesheet" />
    <link href="Assets/Css/flexslider.css" rel="stylesheet" />
    <link href="Assets/Css/font-awesome.min.css" rel="stylesheet" />
    <link href="Assets/Css/main.css" rel="stylesheet" />
	<base href="<?=_URL?>" />
</head>
<body>
<?php include("header.php"); ?>
	<?php
	
	list($toplam) = @mysql_fetch_row(@mysql_query("select count(id) from linkler where uye='"._UYEID."'"));

	?>
     <div class="whitebg">
        <div class="container">
            <div class="kelime-listeleme-top clearfix">
                <div class="kelime-listeleme-sol left clearfix"><span class="text left">Link Ekleme Hakkı</span><span class="text right"><?=$toplam?>/32</span></div>
                <div class="kelime-listeleme-sag right"><span><strong>+</strong> <a href="javascript:void(0)" onclick="guncelle()">GÜNCELLE</a> </span><span>/</span> <span><a href="javascript:void(0)" onclick="linkeklekapat()">Link Ekle</a> <strong>+</strong></span></div>
				<div class="linkekle">
					<div class="title"><p>Link Ekle</p></div>
					<form action="javascript:void(0)" method="post" name="linkekleform">
					<ul>
						<li><input type="text" name="site" placeholder="Link Aldığınız Site URLsi" /></li>
						<li><input type="text" name="link" placeholder="Link Alınan Site URLsi" /></li>
						<li><textarea name="aciklama" placeholder="Açıklama alanı. Kimden aldınız, ne zaman bitecek vs. Zorunlu değildir."></textarea></li>
						<li><select name="bitis" onChange="zamangoster(this.value)">
							<option value="1">Süresiz</option>
							<option value="2">Süre Belirleyin</option>
						</select>
						</li>
						<li class="zaman" style="display:none">Gün : <select name="gun" class="select1">
							<?php
							list($gun, $ay, $yil) = explode("-", date("d-m-Y"));
							
							for($i = 1; $i <= 31; $i++) {
								if($gun == $i) echo "<option value=$i selected>$i</option>";
								else echo "<option value=$i>$i</option>";
							}
							
							?>
						</select> Ay : <select name="ay" class="select2">
							<?php
							
							for($i = 1; $i <= 12; $i++) {
								if($ay == $i) echo "<option value=$i selected>$i</option>";
								else echo "<option value=$i>$i</option>";
							}
							
							?>
						</select>
							Yıl : <select name="yil" class="select3">
							<?php
							
							for($i = $yil; $i <= $yil+5; $i++) {
								if($yil == $i) echo "<option value=$i selected>$i</option>";
								else echo "<option value=$i>$i</option>";
							}
							
							?>
						</select>
						</li>
						<li><input type="submit" value=" Linki Ekle " class="buttons" /></li>
						<li class="sonuc">* Link ilk kontrolü yapılacağından işlem uzun sürebilir.</li>
					</ul>
					</form>
				</div>
            </div>
            <div class="kelime-listeleme">
                <table>
                    <thead>
                        <tr>
                            <th class="align-left" style="width:230px">Alınan Site
                            </th>
                            <th style="width:230px">Link</th>
                            <th>Durum</th>
                            <th>Son Kont.</th>
                            <th>Bitiş</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
						
						$result = mysql_query("select * from linkler where uye='"._UYEID."' order by id desc");
						
						while($array = mysql_fetch_array($result)){
							
							$id = $array["id"];
							$site = stripslashes($array["site"]);
							$link = stripslashes($array["link"]);
							$aciklama = stripslashes($array["aciklama"]);
							$bitis = $array["bitis"];
							$durum = $array["sondurum"];
							
							switch($durum){
								case "1":$durum = "<font color=green>Bulundu</font>";break;
								case "2":$durum = "<font color=red>Bulunamadı</font>";break;
								case "3":$durum = "<font color=red>Siteye Erişilemiyor</font>";break;
								default : $durum = "<font color=black>Aranıcak</font>";break;
							}
							
							if(!$aciklama) $aciklama = "<b>Açıklama : </b> Boş<br /><br />Düzenlemek için üstüne tıklayınız";
							else $aciklama = "<b>Açıklama : </b> <br /><br />$aciklama<br /><br />Düzenlemek için üstüne tıklayınız";
							
							$sonkontrol = date("d.m.Y", $array["songoruntulenme"]);
							$ilkkontrol = date("d.m.Y", $array["ilkgoruntulenme"]);
							
							if($bitis == 1) $bitis = "Süresiz";
							else $bitis = date("d.m.Y", $bitis);
					?>
                        <tr id="link<?=$array["id"];?>">
                            <td class="align-left" id="linksite<?=$id?>"><a href="http://<?=$site?>" target="_blank"><?=$site;?></a></td>
                            <td class="align-center" id="linklink<?=$id?>"><a href="http://<?=$link?>" target="_blank"><?=$link;?></a></td>
                            <td class="align-center"><?=$durum?></td>
                            <td class="align-center"><?=$sonkontrol?></td>
                            <td class="align-center"><?=$bitis?></td>
                            <td class="align-center">
								<a href="linkduzenle.php?id=<?=$array["id"];?>"><img src="Assets/Img/git.png" alt="Link Düzenle" /></a>
                                <a href="javascript:void(0)" onclick="linksil(<?=$array["id"];?>)"><img src="Assets/Img/sil.png" /></a></td>
                        </tr>
					<?php	
						}
					
					?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>

<div id="popicerik">
	<div id="popkapat"><a href="javascript:void(0)" onclick="kapat()">KAPAT</a></div>
	<div id="popveri"></div>
</div>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
    <script>
		$(document).ready(function(){
			$("input[name=domainismi]").on({focus: function(){if($(this).val() == "") $(this).val("http://");},blur: function(){if($(this).val() == "http://") $(this).val("");}});
			$(".user-login").click(function(){$(".linkekle").css("display", "none");if($(".user-login2").css("display") == "none") $(".user-login2").css("display", "block");else $(".user-login2").css("display", "none");});
			
			$("*").click(function(e){
				if(!$(e.target).is('.user-login')){
					$(".user-login2").css("display", "none");
				}
			});
			
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
			


			$(".linkekle input[type=submit]").click(function(){
				var s = $(".linkekle input[name=site]").val();
				var l = $(".linkekle input[name=link]").val();
				var a = $(".linkekle textarea[name=aciklama]").val();
				var b = $(".linkekle select[name=bitis]").val();
				var g = $(".linkekle select[name=gun]").val();
				var ay = $(".linkekle select[name=ay]").val();
				var y = $(".linkekle select[name=yil]").val();
				if(s == ""){
					$(".linkekle .sonuc").html("Link Alınan Site adresini yazınız.");
				}
				else if(l == ""){
					$(".linkekle .sonuc").html("Link Aldığınız Site adresini yazınız.");
				}
				else {
					$(".linkekle .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".linkekle input[type=submit]").val('Lütfen Bekleyin...');
					$(".linkekle input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/linktakip.php?islem=linkekle',
							data: "s="+s+"&l="+l+"&a="+a+"&g="+g+"&b="+b+"&ay="+ay+"&y="+y,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "tamam"){
									$(".linkekle input[type=submit]").attr("disabled", false);;
									$(".linkekle input[type=submit]").val('Linki Ekle');
									document.linkekleform.reset();
									$(".linkekle .sonuc").html("Link eklendi. <a href='javascript:void(0)' onclick='linkeklekapat()'><b>Kapat</b></a>");
								}
								else {
									$(".linkekle input[type=submit]").attr("disabled", false);;
									$(".linkekle input[type=submit]").val('Linki Ekle');
									$(".linkekle .sonuc").html(sonuc);
								}
							}
						})
				}
			});		
		});
		
		function linksil(id){
			var onayla = confirm("Tüm veriler silinecek. İşlem sonu tekrar geri alınamaz. Emin misinz?");
			
			if(onayla){
				$("#link"+id).html("<td colspan='7'><p align=center><img src='Assets/Img/loader3.gif' /></p></td>");
						jQuery.ajax({
							type: 'POST',
							url: 'inc/linktakip.php?islem=linksil',
							data: "id="+id,
							success: function(sonuc){
								$("#link"+id).hide();
							}
						})
			}
		}
		function linkduzenle(veri, id, nere){
			$(".tooltip").hide();
			var neresi = nere + "" + id;
			$("#"+neresi).html("<input type='text' name='veri' value='"+veri+"' onblur=\"linkbitir("+id+", '"+veri+"', this.value, '"+nere+"')\" />");
		}
		function linkbitir(id, veri, veri2, nere){
			var neresi = nere + "" + id;
			if(veri2){
				if(veri != veri2){
					$("#"+neresi).html("<img src='Assets/Img/loader3.gif' />");
						jQuery.ajax({
							type: 'POST',
							url: 'inc/linktakip.php?islem=linkduzenle',
							data: "id="+id+"&data="+veri2+"&nere="+nere,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "tamam"){
									$("#"+neresi).html("<a href='javascript:void(0)' onclick=\"linkduzenle('"+veri2+"', "+id+", '"+nere+"')\">"+veri2+"</a>");
								}
								else {
									$("#"+neresi).html("<a href='javascript:void(0)' onclick=\"linkduzenle('"+veri+"', "+id+", '"+nere+"')\">"+veri+"</a>");
									alert(sonuc);
								}
							}
						})
				}
				else {
					$("#"+neresi).html("<a href='javascript:void(0)' onclick=\"linkduzenle('"+veri+"', "+id+", '"+nere+"')\">"+veri+"</a>");
				}
			}
			else {
				$("#"+neresi).html("<a href='javascript:void(0)' onclick=\"linkduzenle('"+veri+"', "+id+", '"+nere+"')\">"+veri+"</a>");
			}
		}
		var j = 0;
		function guncelle(){
			if(j < 1){
			$(".kelime-listeleme tbody").html("<tr><td colspan='7'><p align=center><img src='Assets/Img/loader3.gif' /></p></td></tr>");
			j = j +1 ;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/linktakip.php?islem=guncelle',
							data: "guncelle="+j,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								$(".kelime-listeleme tbody").html(sonuc);
							}
						})
			}
			else {
				alert("Güncelleme devam etmektedir veya güncelleme yapılmıştır");
			}
		}
		function denetle(){if($("input[name=domainismi]").val() == "") {alert ("Geçersiz Domain, Lütfen Kontrol Ediniz."); return false;}}
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
		function linkeklekapat(){if($(".linkekle").css("display") == "none") $(".linkekle").css("display", "block");else $(".linkekle").css("display", "none");}
		function zamangoster(nere){if(nere == 2) $(".linkekle .zaman").show();else $(".linkekle .zaman").hide();}
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>