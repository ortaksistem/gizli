<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

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

$kullaniciseviye = seviyeal("seviyeid");
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>YP Duvar, Haber Kaynağı <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link rel="stylesheet" href="inc/basic.css" type="text/css" />
<link rel="stylesheet" href="inc/reset.css" type="text/css" />
<link rel="stylesheet" href="inc/style-duvar.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
<script type="text/javascript">
	$(function() {
			$("#paylasinput").keyup(function() {
				var deger = $(this).val();
				if (deger.length > 0){
					$("#paylasbuton").slideDown();
				}else {
					$("#paylasbuton").slideUp();
				}
			});

			$("#videoinput").keyup(function() {
				var deger = $(this).val();
				if (deger.length > 0){
					$("#videopaylasbuton").slideDown();
				}else {
					$("#videopaylasbuton").slideUp();
				}
			});
			
			$("#paylasbuton").click(function(){
				var kseviye = <?=$kullaniciseviye;?>;
				if(kseviye != 2 && kseviye != 1){
					var onayla = confirm("Sadece large ve medium üyelerimiz duvara içerik gönderebilir. Üyeliğinizi yükseltmek ister misiniz?");
					
					if(onayla){
						window.location = 'index.php?sayfa=uyelik_yukselt';
					}
				}
				else {
				var deger = $("#paylasinput").val();
				if(deger != "Ne düşünüyorsun, şimdi paylaş?"){
					$("#yukleniyor1").show();
					jQuery.ajax({
						type : 'POST',
						url : 'inc/duvar.php',
						data : "islem=durum&mesaj="+deger,
						success: function(sonuc){		
							if(sonuc == "hata"){
								alert("Durum mesajı güncellenemedi, lütfen daha sonra tekrar deneyiniz");
							}
							else {
								document.paylasform1.reset();
								$("#durumguncellesonuc").html(sonuc);
							}
							$("#yukleniyor1").hide();
						}
					})	
				}
				}
			});

			$("#videopaylasbuton").click(function(){
				var deger = $("#videoinput").val();
				if(deger != "Video linkini yazınız"){
					$("#yukleniyor2").show();
					jQuery.ajax({
						type : 'POST',
						url : 'inc/duvar.php',
						data : "islem=video&mesaj="+deger,
						success: function(sonuc){		
							if(sonuc == "hata"){
								alert("Video alınamadı, lütfen linki kontrol ediniz.");
							}
							else {
							
								document.paylasform2.reset();
								$("#durumguncellesonuc").html(sonuc);
							}
							$("#yukleniyor2").hide();

						}
					})	
				}
			});
			
			$("#fotografyukle #resim").change(function() {
				var deger = $(this).val();
				if (deger.length > 0){
					$("#fotografpaylasbuton").slideDown();
				}else {
					$("#fotografpaylasbuton").slideUp();
				}
			});

			$("#fotografyukle #resim2").keyup(function() {
				var deger = $(this).val();
				if (deger.length > 0){
					$("#fotografpaylasbuton").slideDown();
				}else {
					$("#fotografpaylasbuton").slideUp();
				}
			});			
			var fazlasi = 2;
			$("#fazlasi a").click(function(){
			$("#fazlasiyukleniyor").show();
			jQuery.ajax({
						type : 'POST',
						url : 'inc/duvar.php',
						data : "islem=fazlasi&kacinci="+fazlasi,
						success: function(sonuc){	
							if(sonuc == "fazlasiyok"){
								$("#fazlasiyukleniyor").html("<b>Daha fazla içerik bulunmamaktadır</b>");
								$("#fazlasi a").hide();
							}
							else {
							$("#fazlasiyukle").append(sonuc);
							$("#fazlasiyukleniyor").hide();
							}
						}
					})
				
			fazlasi++;
			});
			
	});
	function yorumyapsec(id){
		$("#yorum"+id).focus();
	}
	function yorumyap(id){
		var yorum = $("#yorum"+id).val();
		if(yorum && yorum != "Yorum yap"){
					$("#yorumyapsonuc"+id).html("<font color=green>Yorum gönderiliyor, lütfen bekleyin...</font>");
					jQuery.ajax({
						type : 'POST',
						url : 'inc/duvar.php',
						data : "islem=yorum&mesaj="+yorum+"&id="+id,
						success: function(sonuc){		
							if(sonuc == "hata"){
								$("#yorumyapsonuc"+id).html("<font color=red>Yorum gönderilemedi, lütfen daha sonra tekrar deneyiniz</font>");
							}
							else {
								$("#yorumyap"+id).html(sonuc);
							}
						}
					})
		}
	}
	function tumyorumlar(id){
		$("#yorumhepsinigoster"+id).html("<font color=green>Yükleniyor, lütfen bekleyin...</font>");
					jQuery.ajax({
						type : 'POST',
						url : 'inc/duvar.php',
						data : "islem=tumyorumlar&id="+id,
						success: function(sonuc){
							$("#gonderi"+id+" .yorumlar .yorum:not(:last)").hide();
							$("#yorumhepsinigoster"+id).hide();
							$("#tumyorumlar"+id).html(sonuc);
						}
					})
	}
	function gonderibegen(id){
		var begenen = $("#begenensayisi"+id).html();
		begenen = parseInt(begenen);
		begenen++;
		$("#begenensayisi"+id).html(begenen);
		$("#begenbuton"+id+"1").hide();
		$("#begenbuton"+id+"2").show();
					jQuery.ajax({
						type : 'POST',
						url : 'inc/duvar.php',
						data : "islem=begen&id="+id
					})
	}
	function gonderivazgec(id){
		var begenen = $("#begenensayisi"+id).html();
		begenen = parseInt(begenen);
		begenen--;
		$("#begenensayisi"+id).html(begenen);
		$("#begenbuton"+id+"1").show();
		$("#begenbuton"+id+"2").hide();
					jQuery.ajax({
						type : 'POST',
						url : 'inc/duvar.php',
						data : "islem=begenvazgec&id="+id
					})
	}	
	function yorumbegen(id){
		var begenen = $("#yorumbegenensayisi"+id).html();
		begenen = parseInt(begenen);
		begenen++;
		$("#yorumbegenensayisi"+id).html(begenen);
		$("#yorumbegenme"+id+"1").hide();
		$("#yorumbegenme"+id+"2").show();
					jQuery.ajax({
						type : 'POST',
						url : 'inc/duvar.php',
						data : "islem=yorumbegen&id="+id
					})
	}
	function yorumvazgec(id){
		var begenen = $("#yorumbegenensayisi"+id).html();
		begenen = parseInt(begenen);
		begenen--;
		$("#yorumbegenensayisi"+id).html(begenen);
		$("#yorumbegenme"+id+"1").show();
		$("#yorumbegenme"+id+"2").hide();
					jQuery.ajax({
						type : 'POST',
						url : 'inc/duvar.php',
						data : "islem=yorumbegenvazgec&id="+id
					})
	}
	function menugoster(hangisi){
	
				var kseviye = <?=$kullaniciseviye;?>;
				if(kseviye != 2 && kseviye != 1){
					var onayla = confirm("Sadece large ve medium üyelerimiz duvara içerik gönderebilir. Üyeliğinizi yükseltmek ister misiniz?");
					
					if(onayla){
						window.location = 'index.php?sayfa=uyelik_yukselt';
					}
				}
				else {
					$("#menucubugu li").removeClass("aktif");
					$("#menucubugu #"+hangisi).addClass("aktif");
					$(".paylas").hide();
					$("#"+hangisi+"paylas").show();
				}
	}
	function resimyuklesonuc(deger){
		
		if(deger == "resimyok"){
			alert("Lütfen bir resim seçiniz");
		}
		else if(deger == "yuklendi"){
			alert("Resim başarıyla yüklendi, Editör onayından sonra yayına alınacaktıır. Teşekkür ederiz");
			document.resimformu.reset();
		}
		else if(deger == "uzanti"){
			alert("Geçersiz resim uzantısı. Lütfen jpg, gif, bmp ve png bir resim seçiniz.");
			document.resimformu.reset();
		}
		else if(deger == "resimyok"){
			alert("Yüklenecek bir resim yok, lütfen resim seçiniz.");
			document.resimformu.reset();
		}
		else {
			alert("Resim yüklenemedi, lütfen tekrar deneyiniz.");
		}
		$("#yukleniyor3").hide();
	}
	function resimdegistir(id, resim){
		$("#resimdegistir"+id).css('width', '430px');
		$("#resimdegistir"+id).html('<img src="'+resim+'" style="width:430px;" width="430" />');
	}
	function videogoster(id, genislik, yukseklik, video){
		$("#videogoster"+id).css('width', '430px');
		$("#videogoster"+id).html('<embed width="'+genislik+'" height="'+yukseklik+'" src="'+video+'"></embed>');
	}
	function menuler(menu){ 
		
		$("#mesajmerkezitablo").hide();
		$("#arkadasmerkezitablo").hide();
		$("#aramamerkezitablo").hide();
		$("#profilmerkezitablo").hide();
		
		$("#"+menu+"tablo").show("slow");
	}
	
	function uyegoster(yer){
		
		$(".liste li").removeClass("aktif");
		$("#cinsiyet"+yer).addClass("aktif");
		
		$(".ay-resimm").hide();
		$("#cinsiyetresim"+yer).fadeIn("slow");
		
		$(".ay-bilgiler").hide();
		$("#cinsiyetbilgiler"+yer).fadeIn("slow");
	}
</script>
</head>
<body onLoad="menuler('durummerkezi');">
<div id="mahirix-modal-content">
	<div id="mahirix-model-header">
		<div id="mahirix-model-title"></div>
		<div id="mahirix-model-title-kapat"><a href="javascript:void(0)" onclick="mahirixmodelkapat();" title="Kapat"><img src="img/mahirix_alert_kapat.png" border="0" /></a></div>
	</div>
	<div style="clear:both;"></div>
	<div id="mahirix-model-icc"></div>
	<div id="mahirix-model-alt"></div>
</div>
<table border="0" width="100%" id="table1" cellspacing="0" cellpadding="0" height="100%">
	<tr>
		<td width="16">&nbsp;</td>
		<td width="790" valign="top">
		<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<table border="0" width="100%" id="table3" cellspacing="0" cellpadding="0">
					<tr>
						<td width="10" background="img/ste_golge_sol.gif">&nbsp;</td>
						<td bgcolor="#FFFFFF">
						<table border="0" width="100%" id="table13" cellspacing="0" cellpadding="0">
							
							<?php include("inc/giris-ust.php"); ?>
							
							<tr>
								<td background="img/ic_alan_gri_bg.gif">
								<table border="0" width="100%" id="table14" cellspacing="0" cellpadding="0">
									<tr>
										<td width="10">&nbsp;</td>
										<td width="200" valign="top">
										
										<?php include("inc/giris-sol.php"); ?>
										
										</td>
										
										
										<td width="6">&nbsp;</td>
										<td width="540" valign="top" align="center">
										<!-- icerik -->
										

										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td>

<div id="duvar" class="duvar">
	<div class="ust"></div>
	<div class="icerik">
		<div class="haberkaynagi">Haber Kaynağı</div>
		<div class="menu" id="menucubugu">
			<ul>
				<li id="durum" class="aktif"><a href="javascript:void(0)" onclick="menugoster('durum')">Durum</a></li>
				<li id="fotograf"><a href="javascript:void(0)" onclick="menugoster('fotograf')">Fotoğraf</a></li>
				<li id="video"><a href="javascript:void(0)" onclick="menugoster('video')">Video</a></li>
			</ul>
		</div>
		
		<div class="paylas" id="durumpaylas">
		<form name="paylasform1" action="javascript:void(0)">
			<input type="text" name="paylas" name="paylasinput" class="paylasinput" id="paylasinput" value="Ne düşünüyorsun, şimdi paylaş?" onFocus="if(this.value=='Ne düşünüyorsun, şimdi paylaş?')this.value=''" onBlur="if(this.value=='')this.value='Ne düşünüyorsun, şimdi paylaş?'" />
			<span class="yukleniyor" id="yukleniyor1"><img src="img/loading.gif" /></span><input type="submit" value=" Paylaş " id="paylasbuton" class="buton" />
		</form>
		</div>
		<div class="paylas" id="videopaylas" style="display:none">
		<form name="paylasform2" action="javascript:void(0)">
			<input type="text" name="paylas" name="paylasinput" class="paylasinput" id="videoinput" value="Video linkini yazınız" onFocus="if(this.value=='Video linkini yazınız')this.value=''" onBlur="if(this.value=='')this.value='Video linkini yazınız'" /> Örnegin : http://www.youtube.com/watch?v=WZURsOlV8d8
			<span class="yukleniyor" id="yukleniyor2"><img src="img/loading.gif" /></span><input type="submit" value=" Paylaş " id="videopaylasbuton" class="buton" />
		</form>
		</div>
		<div class="paylas" id="fotografpaylas" style="display:none">
		<form action="inc/duvar.php" method="post" name="resimformu" target="resimyukle" enctype="multipart/form-data">
			<input type="text" name="fotografinput" class="paylasinput" id="fotografinput" value="Fotoğraf başlığı yazabilirsiniz" onFocus="if(this.value=='Fotoğraf başlığı yazabilirsiniz')this.value=''" onBlur="if(this.value=='')this.value='Fotoğraf başlığı yazabilirsiniz'" />
			<div class="fotograf" id="fotografyukle">
				<div class="sol"><p>Bilgisayarınızdan bir fotoğraf seçin</p><input type="file" name="resim" id="resim" /></div>
				<div class="sag"><p>Bir fotoğraf linki yazın</p><input type="text" name="resim2" id="resim2" /></div>
			</div>
			<span class="yukleniyor" id="yukleniyor3"><img src="img/loading.gif" /></span><input type="submit" value=" Paylaş " id="fotografpaylasbuton" class="buton" /> <input type="hidden" name="islem" value="resim" />
		</form>
		<iframe name="resimyukle" id="resimyukle" height="0" width="0" style="display:none"></iframe>
		</div>
		<div class="temizle"></div>
		<div class="cizgi"></div>
		
		<div id="durumguncellesonuc"></div>
		
		<?php
			
			$kullaniciavatar = uyebilgi("avatar");

				if(!$kullaniciavatar or $kullaniciavatar == 'img_uye/avatar/null.jpg') {
					$kullaniciavatar = "img_uye/".uyebilgi("cinsiyet").".gif";
				}
	
			$kullanicibilgi = $uyeid ."|". $uyeadi;
			
			$result = mysql_query("select id, uye, uyeadi, avatar, tur, baslik, icerik, resim, yorum, begen, begenliste, kayit from "._MX."duvar where durum='1' order by oncelik desc, id desc limit 10");
			
			while(list($id, $uye, $uyeadi, $avatar, $tur, $baslik, $icerik, $resim, $yorum, $begen, $begenliste, $kayit) = mysql_fetch_row($result)){
			
			$baslik = stripslashes($baslik);
			$ikincisi = stripslashes($icerik);
			
			if(strstr($begenliste, $kullanicibilgi)) {
				$begenmebuton1 = "display:none";
				$begenmebuton2 = NULL;
			}
			else {
				$begenmebuton2 = "display:none";
				$begenmebuton1 = NULL;			
			}
			
			$kayit = kalanzaman($kayit);
			
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
				<div class="yorumadet"><?=$yorum?> yorum yapıldı.</div>
				<div class="begenbuton" id="begenbuton<?=$id?>1" style="<?=$begenmebuton1?>"><input type="submit" value=" Beğen " class="buton" onclick="gonderibegen(<?=$id?>)" /></div>
				<div class="begenbuton" id="begenbuton<?=$id?>2" style="<?=$begenmebuton2?>"><input type="submit" value=" Vazgeç " class="buton" onclick="gonderivazgec(<?=$id?>)" /></div>
				<div class="begenicon"><img src="img/duvar_begen_icon.jpg" /></div>
				<div class="begenadet"><span id="begenensayisi<?=$id?>"><?=$begen?></span> kişi beğendi.</div>
			</div>
			<div class="yorumlar">
				<?php
				
				if($yorum >= 1){
				
				if($yorum > 3){
				?>
				<div id="tumyorumlar<?=$id?>"></div>
				<div class="yorum" id="yorumhepsinigoster<?=$id?>"><a href="javascript:void(0)" onclick="tumyorumlar(<?=$id?>)">Tüm yorumları göster (<?=$yorum;?>)</a></div>
				<?
				}
				
				$resultyorum = mysql_query("select id, uye, uyeadi, avatar, yorum, begen, begenliste, kayit from "._MX."duvar_yorum where durum='1' and icerik='$id' order by id desc limit 3");
				
					while(list($yorumid, $yorumuye, $yorumuyeadi, $yorumavatar, $yorum, $begen, $begenliste, $kayit) = mysql_fetch_row($resultyorum)){
					
					$kayit = kalanzaman($kayit);
					
					$yorum = stripslashes($yorum);
					
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
					<p class="tarih"><?=$kayit?></span> <a href="javascript:void(0)" onclick="yorumbegen(<?=$yorumid?>)" id="yorumbegenme<?=$yorumid?>1" style="<?=$begenmebuton1?>">Beğen</a> <a href="javascript:void(0)" onclick="yorumvazgec(<?=$yorumid?>)" id="yorumbegenme<?=$yorumid?>2" style="<?=$begenmebuton2?>">Beğenmekten Vazgeç</a> (<span id="yorumbegenensayisi<?=$yorumid?>"><?=$begen?></span> kişi beğendi)</p>
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
					<span id="yorumyapsonuc<?=$id?>"></span><input type="submit" value=" Gönder " id="yorumyapbuton" class="buton" onclick="yorumyap(<?=$id?>)" />
					</div>
				</div>			
			</div>
		</div>
		<div class="temizle"></div>
		<div class="cizgi"></div>
		<?
			
			
			}
		
		?>

		<!--
		<div class="gonderi">
			<div class="avatar"><img src="img/duvar_avatar.jpg" /></div>
			<div class="nick"><a href="#">Nickname</a> <span>[12 saat önce]</span></div>
			<div class="aciklama">
				<a href="#"><img src="img/duvar_resim.jpg" /></a>
				adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda adsadasda 
			</div>
			<div class="yorumyap">
				<div class="yorumbuton"><input type="submit" value=" Yorum Yap " class="buton" /></div>
				<div class="yorumicon"><img src="img/duvar_yorum_icon.jpg" /></div>
				<div class="yorumadet">10 yorum yapıldı.</div>
				<div class="begenbuton"><input type="submit" value=" Beğen " class="buton" /></div>
				<div class="begenicon"><img src="img/duvar_begen_icon.jpg" /></div>
				<div class="begenadet">10 kişi beğendi.</div>
			</div>
			<div class="yorumlar">
				<div class="yorum">
					<a href="#"><img src="img/duvar_avatar.jpg" /></a>
					<div class="yorumu">
					<a href="#" class="nickname">Deneme</a> Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a 
					<p class="tarih">3 dakika önce</span> <a href="#">Beğen</a> (3 kişi beğendi)</p>
					</div>
				</div>
				<div class="yorum">
					<a href="#"><img src="img/duvar_avatar.jpg" /></a>
					<div class="yorumu">
					<a href="#" class="nickname">Deneme</a> Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a 
					<p class="tarih">3 dakika önce</span> <a href="#">Beğen</a> (3 kişi beğendi)</p>
					</div>
				</div>
				<div class="yorum">
					<a href="#"><img src="img/duvar_avatar.jpg" /></a>
					<div class="yorumu">
					<a href="#" class="nickname">Deneme</a> Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a Deneme Yorumumuz bu olsun olala floasd a 
					<p class="tarih">3 dakika önce</span> <a href="#">Beğen</a> (3 kişi beğendi)</p>
					</div>
				</div>
				<div class="yorum">
					<img src="img/duvar_avatar.jpg" />
					<div class="yorumu">
					<textarea name="yorum" id="yorum" class="yoruminputtext"></textarea>
					<input type="submit" value=" Gönder " id="yorumyapbuton" class="buton" />
					</div>
				</div>	
			</div>
		</div>
		<div class="temizle"></div>
		<div class="cizgi"></div>
		-->
		
		<div id="fazlasiyukle"></div>
		<div class="gonderi">
			<div class="fazlasi" id="fazlasi"><a href="javascript:void(0)"></a><p id="fazlasiyukleniyor">Yükleniyor, lütfen bekleyiniz...</p></div>
		<div class="temizle"></div>
		</div>
	</div>
	<div class="alt"></div>
</div>												
												
												

												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td align="center">
												<? echo stripslashes(ayar("icerikalti")); ?>
												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											</table>

											
										<!-- icerik sonu -->
										</td>
										<td width="8">&nbsp;</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td>
								<img border="0" src="img/ic_alan_gri_alt.gif" width="770" height="8"></td>
							</tr>
						</table>
						</td>
						<td width="10" background="img/ste_golge_sag.gif">&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td background="img/ste_alt2.gif" height="93" valign="top">
				<table border="0" width="100%" id="table4" cellspacing="0" cellpadding="0">
					<tr>
						<td width="25" height="7"></td>
						<td height="7"></td>
						<td width="25" height="7"></td>
					</tr>
					<tr>
						<td width="25" height="29">&nbsp;</td>
						<td height="29">
						<table border="0" id="table6" cellspacing="0" cellpadding="0">
							<tr>
								<td>
								<table border="0" id="table7" cellspacing="0" cellpadding="0">
									<tr>
										<td><b><a class="c" href="index.php">ana sayfa</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table8" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=okey">okey oyna</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table9" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=sohbet">sohbet et</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table10" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=arkadas_onlineuyeler">online 
										üyeler</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table11" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=uyelik_yukselt">üyeliğini 
										yükselt</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table12" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=yardimmerkezi">yardım merkezi</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						</td>
						<td width="25" height="29">&nbsp;</td>
					</tr>
					<tr>
						<td width="25" height="10"></td>
						<td height="10"></td>
						<td width="25" height="10"></td>
					</tr>
					<tr>
						<td width="25">&nbsp;</td>
						<td>
						<table border="0" width="100%" id="table5" cellspacing="0" cellpadding="0">
							<tr>
								<td width="150">
								<p class="copyright">Copyright 2010<br>
								<?=_AD?></td>
								<td align="right" valign="bottom">
								<p class="c2"><a class="c1" href="index.php?sayfa=kullanim_sartlari">Kullanım 
								Şartları</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=gizlilik_ilkeleri">Gizlilik İlkeleri</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=yardimmaili">Bize Ulaşın</a></td>
							</tr>
						</table>
						</td>
						<td width="25">&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td valign="top">
		<table border="0" id="table169" cellspacing="0" cellpadding="0">
			<tr>
				<td width="15" height="156">&nbsp;</td>
				<td width="161" height="156">&nbsp;</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">
				<?php include("inc/giris-sag.php"); ?>
				</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">&nbsp;</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
</table>


</body>
</html>