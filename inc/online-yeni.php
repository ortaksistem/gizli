<?

if(seviyeal("online") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$zaman = time();

mysql_query("delete from "._MX."online where kayit < $zaman");
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Online �yeler</title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/reset.css" type="text/css" />
<link rel="stylesheet" href="inc/online.css" type="text/css" />
<link type='text/css' href='inc/basic.css' rel='stylesheet' media='screen' />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
<script type="text/javascript">
	function mesajgonder(uye){
		
		
		var mesajgonderme = <?=seviyeal("mesaj");?>;
		
		var gonderen = <?=$uyeid?>;
		

		
			if(mesajgonderme == 1){
			
			mahirixpencere("Mesaj g�nderin", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=mesajyaz',
				data : "uye="+uye+"&uyeadi=<?=$uyeadi?>",
				success: function(sonuc){		
					mahirixpencereguncelle(sonuc);
				}
			})
			
			}
			else {
				mahirixalert("Mesaj G�nderme", "<div><p><font color=red><b>Mesaj g�nderebilmek i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");
						
			}
		
	
	}
	
	function mesajgonderuygula(uye){
		
		var gonderen = <?=$uyeid?>;
				
		var konu = document.getElementById("konu").value;
		var mesaj = document.getElementById("mesaj").value;
		
		if(konu == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Konuyu yaz�n</b></font>");
		}
		else if(mesaj == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Mesaj� Yaz�n</b></font>");
		}
		else {
			$("#mesajgondersonuc").html("<img src='img/loading.gif' /> Bekleyin");

			jQuery.ajax({
				type : 'POST',
				url : 'inc/mesajgonder.php',
				data : "gonderen="+gonderen+"&gonderilen="+uye+"&mesaj="+mesaj+"&konu="+konu,
				success: function(sonuc){		
					if(sonuc == "ok"){
						mahirixpencereguncelle("<p align=center><font color=green><b>Mesaj�n�z �yemize ba�ar�yla iletilmi�tir</b></font>");
					}
					else if(sonuc == "hata1"){
						$("#mesajgondersonuc").html("<font color=red><b>G�nl�k mesaj g�nderme limitiniz dolmu�tur, daha fazla g�ndermek i�in �yeli�inizi y�kseltiniz</b></font>");
					}
					else {
						$("#mesajgondersonuc").html("<font color=red><b>Mesaj�n�z �uan g�nderilemiyor, l�tfen sonra tekrar deneyiniz</b></font>");
					}
				}
			})
				
		}
	
	}
	
	
	function listele(kimi){
	
		var sayfa = document.getElementById("sayfalama").value;
	
		$("#listele").html("<img src=img/loading.gif /> Y�kleniyor...");
	
			jQuery.ajax({
				type : 'POST',
				url : 'inc/onlineuyeler2.php',
				data : "listele="+kimi+"&sayfa="+sayfa,
				success: function(sonuc){		
					$("#listele").html(sonuc);
					sayfayazdir();
				}
			})
		
	}
	
	function sayfa(){
	
		var sayfa = document.getElementById("sayfalama").value;
	
		$("#listele").html("<img src=img/loading.gif /> Y�kleniyor...");
	
			jQuery.ajax({
				type : 'POST',
				url : 'inc/onlineuyeler2.php',
				data : "sayfa="+sayfa,
				success: function(sonuc){		
					$("#listele").html(sonuc);
				}
			})
		
	}
	
	function sayfayazdir(){

			var sayfa = 1;
			
			jQuery.ajax({
				type : 'POST',
				url : 'inc/onlineuyelersayfa2.php',
				data : "sayfa="+sayfa,
				success: function(sonuc){		
					$("#sayfalar").html(sonuc);
				}
			})

	}
</script>
</head>
<body>
<div id="mahirix-modal-content">
	<div id="mahirix-model-header">
		<div id="mahirix-model-title"></div>
		<div id="mahirix-model-title-kapat"><a href="javascript:void(0)" onclick="mahirixmodelkapat();" title="Kapat"><img src="img/mahirix_alert_kapat.png" border="0" /></a></div>
	</div>
	<div style="clear:both;"></div>
	<div id="mahirix-model-icc"></div>
	<div id="mahirix-model-alt"></div>
</div>

<div id="ust"></div>

<!--
<div id="header">
	<div class="header">
	<ul>
		<li><a href="javascript:listele('hepsi')"><img src="img/online-hepsi.jpg" /></a></li>
		<li><a href="javascript:listele('lezbiyen')"><img src="img/online-lezbiyen.jpg" /></a></li>
		<li><a href="javascript:listele('ciftler')"><img src="img/online-ciftler.jpg" /></a></li>
		<li><a href="javascript:listele('bayan')"><img src="img/online-bayanlar.jpg" /></a></li>
		<li><a href="javascript:listele('gay')"><img src="img/online-gayler.jpg" /></a></li>
		<li><a href="javascript:listele('trans')"><img src="img/online-trans.jpg" /></a></li>
		<li><a href="javascript:listele('erkek')"><img src="img/online-erkek.jpg" /></a></li>
	</ul>
	</div>
</div>

// -->

<div id="listeust"></div>

<div id="liste">
	<div class="liste" id="listele">

<?php															
	
	$a = 1;
																														
	$result = mysql_query("select uye, ad, cinsiyet, yas, sehir, seviyead, seviyeicon, seviyerenk from "._MX."online order by cinsiyet asc,oncelik asc");
																
	while(list($uye, $ad, $cinsiyet, $yas, $sehir, $seviyead, $seviyeicon, $seviyerenk) = mysql_fetch_row($result)){
	
	if($a > 16){
		
		$style = ' style="background:url(img/online-liste-bg.jpg);height:29px"';
	
	}														
																
															
	?>
	<ul<?=$style?>>
		<li class="tur"><img src="img/cins_ufak_<?=$cinsiyet?>.gif" /> <img src="img/uyelik_ufak_<?=$seviyeicon?>.gif" width="34" height="15" /></li>
		<li class="kullanici"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);" title="<?=$ad?>'�n Profiline Bak"><font color="<?=$seviyerenk?>"><?=$ad?></font></a></li>
		<li class="yas"><?=$yas?></li>
		<li class="sehir"><?=$sehir?></li>
		<li class="mesaj"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);" title="<?=$ad?>'�n Profiline Bak"><img src="img/online-mesajgonder.jpg" /></a></li>
	</ul>
	
<?php
	
	$a++;
	
	}
?>

	</div>
</div>


<div id="sayfa">
<a href="javascript:void(0)" onclick="window.location.reload();"><img src="img/online-sayfa-yenile.jpg" /></a>
</div>

<div id="alt"></div>
</body>
</html>