<?

if(seviyeal("goruntuleme") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyead = uyeadi();

$uye = $_GET["id"];

if(!is_numeric($uye)) header("Location: index.php");

list($varmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_yasakli where yasakli='$uyeid' and yasaklayan='$uye'"));

if($varmi >= 1){
	echo "<script>alert('Bu �ye taraf�ndan yasakland�n�z, �yenin bilgilerini g�remezsiniz.'); window.close();</script>";
	die();
}

$result = mysql_query("select * from "._MX."uye where id='$uye'");

$uyeaktar = mysql_fetch_array($result);

$uyeadi = $uyeaktar["kullanici"];

$cinsiyet = $uyeaktar["cinsiyet"];

$cinsiyetadi = cinsiyet($cinsiyet);

$dogum = $uyeaktar["dogum"];

$dogumyil = date("Y", $dogum);

$yas = (date("Y")-$dogumyil);

$sehir = $uyeaktar["sehir"];

if($uyeid != $uye){

	$ay = date("m");
	
	$yil = date("Y");
	
	$hitbak = mysql_query("select count(uye) from "._MX."uye_hit where uye='$uye' and ay='$ay' and yil='$yil'");
	
	list($hitsay) = mysql_fetch_row($hitbak);
	
	$hitekle = $uyeid .";". uyeadi();
		
	if($hitsay < 1){
	
		$hitekle = $hitekle.";".time();
		
		mysql_query("insert into "._MX."uye_hit values('$uye', '$uyeadi', '$cinsiyet', '$yas', '$sehir', '1', '$hitekle', '$ay', '$yil')");	
		
		mysql_query("update "._MX."uye set topbakan=topbakan+1, goruntulenme=goruntulenme+1 where id='$uye'");
	
	}
	else {
	
		list($hitler) = mysql_fetch_row(mysql_query("select hitler from "._MX."uye_hit where uye='$uye' and ay='$ay' and yil='$yil'"));
	
		if(!strstr($hitler, $hitekle)){
		
			$yeniekle = $hitler .":::". $hitekle.";".time();
			
			mysql_query("update "._MX."uye_hit set hit=hit+1, hitler='$yeniekle' where uye='$uye' and ay='$ay' and yil='$yil'");
			
			mysql_query("update "._MX."uye set topbakan=topbakan+1, goruntulenme=goruntulenme+1 where id='$uye'");
			
		}
	}
	
}

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title><?=$uyeadi?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<style type="text/css">
	body {
		background:url(img/bg.gif);
	}
</style>
<link type='text/css' href='inc/basic.css' rel='stylesheet' media='screen' />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
<script type="text/javascript">

	function puanver(puan, uye){
		
		var yapan = <?=$uyeid?>;
		
		if(yapan == uye){
			mahirixalert("Oy Verin", "<font color=red><b>Kendi kendinize oy veremezsiniz</b></font>");
		}
		else {
				$("#oyvertable").html("<tr><td align=center><img src='img/loading.gif' /> <font color=green><b>�yeye "+puan+" puan veriliyor, bekleyin..</font></td></tr>");

				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=oy&yapan="+yapan+"&yapilan="+uye+"&puan="+puan,
					success: function(sonuc){		
						if(sonuc == "var"){
							$("#oyvertable").html("<tr><td align=center><font color=red><b>Daha �nce puan verdiniz.</b></font></td></tr>");
						}
						else {
							$("#oyvertable").html("<tr><td align=center><font color=green><b>Oyunuz i�in te�ekk�r ederim</b></font></td></tr>");
						}
					}
				})
		}
		
	}

	function begenenler(uye){
		
			
			mahirixpencere("<?=$uyeadi?>'in profilini be�enenler", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=profilinibegenenler',
				data : "uye="+uye,
				success: function(sonuc){		
					mahirixpencereguncelle(sonuc);
				}
			})

	
	}

	function begenengoster(i){
		$("#listele"+i).slideToggle(1);
	}

	function mesajgonder(uye){
		
		
		var mesajgonderme = <?=seviyeal("mesaj");?>;
		
		var gonderen = <?=$uyeid?>;
		

		
			if(mesajgonderme == 1){
			
			mahirixpencere("<?=$uyeadi?>'e mesaj g�nderin", "<p align=center><img src='img/loading.gif' /></p>");
		
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

	function yoneticiyebildir(uye){
		
		
		var gonderen = <?=$uyeid?>;
		

		

			
			mahirixpencere("<?=$uyeadi?>'i y�neticiye bildirin", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=yoneticiyebildir',
				data : "uye="+uye+"&uyeadi=<?=$uyeadi?>",
				success: function(sonuc){		
					mahirixpencereguncelle(sonuc);
				}
			})
			

		
	
	}

	function yoneticiyebildiruygula(uye){
		
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
				url : 'inc/yoneticiyebildir.php',
				data : "yer=profil&gonderen="+gonderen+"&gonderilen="+uye+"&mesaj="+mesaj+"&konu="+konu,
				success: function(sonuc){		
					if(sonuc == "ok"){
						mahirixpencereguncelle("<p align=center><font color=green><b>Bildiriminiz g�nderilmi�tir. En k�sa zamanda ilgilenilecektir. Te�ekk�r ederiz.</b></font>");
					}
					else {
						$("#mesajgondersonuc").html("<font color=red><b>Mesaj�n�z �uan g�nderilemiyor, l�tfen sonra tekrar deneyiniz</b></font>");
					}
				}
			})
				
		}
	
	}
		
	function yasakla(uye){
		
		var yasaklama = <?=seviyeal("yasakla");?>;
		
		if(yasaklama == 1){
			
			var yasaklayan = <?=$uyeid?>
			
			if(yasaklayan == uye){
				mahirixalert("�ye Yasaklama", "<div><p><font color=red><b>Kendi kendinizi yasaklayamazs�n�z</b></font></p></div>");			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=yasakla&yapan="+yasaklayan+"&yapilan="+uye,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("�ye Yasaklama", "<div><p><font color=red><b>�ye daha �nce yasaklanm��t�r.</b></font></p></div>");
						}
						else {
							mahirixalert("�ye Yasaklama", "<div><p><font color=green><b>�yeyi ba�ar�yla yasaklad�n�z.</b></font></p></div>");
						}
					}
				})
			
			}
		}
		else {
			mahirixalert("�ye Yasaklama", "<div><p><font color=red><b>�ye yasaklamak i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");	
		}
	}
	
	function listemeekle(uye){
		
		var ekleme = <?=seviyeal("arkadas");?>;
		
		if(ekleme == 1){
			
			var ekleyen = <?=$uyeid?>
			
			if(ekleyen == uye){
				mahirixalert("Arkada� Listeme Ekle", "<div><p><font color=red><b>Kendi kendinizi listenize ekleyemezsiniz.</b></font></p></div>");			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=arkadas&yapan="+ekleyen+"&yapilan="+uye,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("Arkada� Listeme Ekle", "<div><p><font color=red><b>�ye daha �nce listenize eklenmi�tir.</b></font></p></div>");
						}
						else {
							mahirixalert("Arkada� Listeme Ekle", "<div><p><font color=green><b>�yeyi ba�ar�yla listenize eklediniz, �ye onaylad�ktan sonra arkada� olacaks�n�z.</b></font></p></div>");
						}
					}
				})
			
			}
		}
		else {
			mahirixalert("Arkada� Listeme Ekle", "<div><p><font color=red><b>Arkada� ekleyebilmek i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");	
		}
	}
	
	function opucuk(uye){
		
		var opucuk = <?=seviyeal("opucuk");?>;
		
		if(opucuk == 1){
			
			var gonderen = <?=$uyeid?>
			
			if(gonderen == uye){
				mahirixalert("�p�c�k G�nderin", "<div><p><font color=red><b>Kendi kendinizi �p�c�k g�nderemezsiniz.</b></font></p></div>");			
			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=opucuk&yapan="+gonderen+"&yapilan="+uye,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("�p�c�k G�nderin", "<div><p><font color=red><b>�yeyi daha �nce �pt�n�z.</b></font></p></div>");
						}
						else {
							mahirixalert("�p�c�k G�nderin", "<div><p><font color=green><b>�yeyi ba�ar�yla �pt�n�z.</b></font></p></div>");
						}
					}
				})
			
			}
		}
		else {
			mahirixalert("�p�c�k G�nderin", "<div><p><font color=red><b>�p�c�k g�nderebilmek i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");	
		}
	}
	
	function cicek(uye){
		
		var cicek = <?=seviyeal("cicek");?>;
		
		if(cicek == 1){
			
			var gonderen = <?=$uyeid?>
			
			if(gonderen == uye){
				mahirixalert("�i�ek G�nderin", "<div><p><font color=red><b>Kendi kendinizi �i�ek g�nderemezsiniz.</b></font></p></div>");			
			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=cicek&yapan="+gonderen+"&yapilan="+uye,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("�i�ek G�nderin", "<div><p><font color=red><b>�yeye daha �nce �i�ek g�nderdiniz.</b></font></p></div>");
						}
						else {
							mahirixalert("�i�ek G�nderin", "<div><p><font color=green><b>�yeye ba�ar�yla �i�ek g�nderdiniz.</b></font></p></div>");
						}
					}
				})
			
			}
		}
		else {
			mahirixalert("�p�c�k G�nderin", "<div><p><font color=red><b>�i�ek g�nderebilmek i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");	
		}
	}
	
	
	function begendim(uye){
	
		var hangisi = document.getElementById("begendim").value;
		
		$("#begeniler").html("<font size=2>Bekleyin...</font>");


			var gonderen = <?=$uyeid?>
			
			if(gonderen == uye){
				mahirixalert("Be�enin", "<div><p><font color=red><b>Kendi kendinizi be�enemezsiniz.</b></font></p></div>");			
			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=begeni&yapan="+gonderen+"&yapilan="+uye+"&begeni="+hangisi,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("Be�eni G�nderin", "<div><p><font color=red><b>Daha �nce be�eniniz g�nderilmi�tir.</b></font></p></div>");
							$("#begeniler").html("");

						}
						else {
							mahirixalert("Be�eni G�nderin", "<div><p><font color=green><b>Be�eniniz ba�ar�yla iletilmi�tir.</b></font></p></div>");
							$("#begeniler").html("<font size=1><b>Be�eniniz g�nderildi</b></font>");

						}
					}
				})
			
			}
			
				
	}
	
	function galeritalep(uye, galeri){


			var gonderen = <?=$uyeid?>
			
			if(gonderen == uye){
				mahirixalert("Galeri talebi", "<div><p><font color=red><b>Kendi kendinize galeri talebinde bulunamazs�n�z</b></font></p></div>");			
			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=galeritalep&yapan="+gonderen+"&yapilan="+uye+"&galeri="+galeri,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("Galeri talebi", "<div><p><font color=red><b>�uan talebiniz bulunmaktad�r. Galerilerim  men�s�nden takip edebilirsiniz</b></font></p></div>");

						}
						else {
							mahirixalert("Galeri talebi", "<div><p><font color=green><b>Galeri talebiniz ba�ar�yla iletilmi�tir.</b></font></p></div>");
						}
					}
				})
			
			}
			
				
	}
	
	function bilgiilgi(){
		
		$("#bilgibaslik").html("�lgi Alanlar�m");
		
		if(document.getElementById("bilgiprofil").style.display != "none") document.getElementById("bilgiprofil").style.display = "none";
		if(document.getElementById("bilgikisisel").style.display != "none") document.getElementById("bilgikisisel").style.display = "none";
		if(document.getElementById("bilgiresimler").style.display != "none") document.getElementById("bilgiresimler").style.display = "none";
		if(document.getElementById("bilgigaleriler").style.display != "none") document.getElementById("bilgigaleriler").style.display = "none";
		
		document.getElementById("bilgiilgi").style.display = "";
	}
	
	function bilgikisisel(){
		
		$("#bilgibaslik").html("Ki�isel Bilgilerim");
		
		if(document.getElementById("bilgiprofil").style.display != "none") document.getElementById("bilgiprofil").style.display = "none";
		if(document.getElementById("bilgiilgi").style.display != "none") document.getElementById("bilgiilgi").style.display = "none";
		if(document.getElementById("bilgiresimler").style.display != "none") document.getElementById("bilgiresimler").style.display = "none";
		if(document.getElementById("bilgigaleriler").style.display != "none") document.getElementById("bilgigaleriler").style.display = "none";
				
		document.getElementById("bilgikisisel").style.display = "";
	}

	function bilgiprofil(){
		
		$("#bilgibaslik").html("Profil Bilgilerim");
		
		if(document.getElementById("bilgiilgi").style.display != "none") document.getElementById("bilgiilgi").style.display = "none";
		if(document.getElementById("bilgikisisel").style.display != "none") document.getElementById("bilgikisisel").style.display = "none";
		if(document.getElementById("bilgiresimler").style.display != "none") document.getElementById("bilgiresimler").style.display = "none";
		if(document.getElementById("bilgigaleriler").style.display != "none") document.getElementById("bilgigaleriler").style.display = "none";
				
		document.getElementById("bilgiprofil").style.display = "";
	}	
	
	function resimler(){
	
		$("#bilgibaslik").html("Resimlerim");
		
		if(document.getElementById("bilgiilgi").style.display != "none") document.getElementById("bilgiilgi").style.display = "none";
		if(document.getElementById("bilgikisisel").style.display != "none") document.getElementById("bilgikisisel").style.display = "none";
		if(document.getElementById("bilgiprofil").style.display != "none") document.getElementById("bilgiprofil").style.display = "none";
		if(document.getElementById("bilgigaleriler").style.display != "none") document.getElementById("bilgigaleriler").style.display = "none";
				
		document.getElementById("bilgiresimler").style.display = "";
	}
	
	function galeriler(){
	
		$("#bilgibaslik").html("Galerilerim");
		
		if(document.getElementById("bilgiilgi").style.display != "none") document.getElementById("bilgiilgi").style.display = "none";
		if(document.getElementById("bilgikisisel").style.display != "none") document.getElementById("bilgikisisel").style.display = "none";
		if(document.getElementById("bilgiprofil").style.display != "none") document.getElementById("bilgiprofil").style.display = "none";
		if(document.getElementById("bilgiresimler").style.display != "none") document.getElementById("bilgiresimler").style.display = "none";
				
		document.getElementById("bilgigaleriler").style.display = "";
	}
	
	function sayfayikapat(){
		window.close();
	}
	
	function resimyukle(resim, gen){
	
		$("#resimlerid").html("<img src='"+resim+"' width="+gen+" />");
	
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
<div id="main">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
  <tr>
    <td width="15">&nbsp;</td>
    <td width="713">&nbsp;</td>
    <td width="15">&nbsp;</td>
  </tr>
  <tr>
    <td width="15">&nbsp;</td>
    <td width="713">
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
      <tr>
        <td width="100%">
        <img border="0" src="img/profil_bg_ac.jpg" width="713" height="20"></td>
      </tr>
      <tr>
        <td width="100%" background="img/profil_bg_bu.jpg">
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
          <tr>
            <td width="10">&nbsp;</td>
            <td>
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
              <tr>
                <td width="15">&nbsp;</td>
                <td>
                <img border="0" src="img/profil_logodeneme.gif" width="190" height="60"></td>
                <td width="468" height="60" align="center">
				<? echo stripslashes(ayar("profilust")); ?>
				</td>
                <td width="6">&nbsp;</td>
              </tr>
            </table>
            </td>
            <td width="10">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" height="10">
            <img border="0" src="img/1px.gif" width="1" height="1"></td>
            <td height="10">
            <img border="0" src="img/1px.gif" width="1" height="1"></td>
            <td width="10" height="10">
            <img border="0" src="img/1px.gif" width="1" height="1"></td>
          </tr>
          <tr>
            <td width="10">&nbsp;</td>
            <td background="img/profil_btn_bgleri.gif" height="228" align="center">
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
              <tr>
                <td width="168" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                  <tr>
                    <td width="100%">
                    <img border="0" src="img/profil_resim_ac.gif" width="168" height="18"></td>
                  </tr>
                  <tr>
                    <td width="100%" background="img/profil_resim_bg.gif" height="146" align="center">
                    <?
						$avatar = $uyeaktar["img"];
						
						if(!$avatar or $avatar == "img_uye/avatar/null.jpg") $oyverme = 1;
						$avatar = uyeavatar($avatar, $cinsiyet);
                    ?>
                    <a href="javascript:resimler()" title="Resimler"><img src="<?=$avatar?>" witdh="125" border="0" /></a>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" background="img/profil_resim_kapa.gif" height="39" align="center">
                    <a href="javascript:resimler()" title="Resimler" style="text-decoration:none"><p class="form_txt2">Toplam <?=$uyeaktar["topresim"];?> Resmi var</p></a></td>
                  </tr>
                </table>
                </td>
                <td width="6">&nbsp;</td>
                <td width="340" background="img/profil_bg_ortaksm.gif">
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                  <tr>
                    <td width="100%" height="53" align="center">
                    <table id="oyvertable" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr>
                        <td width="86">
                        <img border="0" src="img/profil_tit_buprofileoyver.gif" width="86" height="53"></td>
                        <td width="15">&nbsp;</td>
                        <?php                 
                        
                        if($oyverme != 1){


                        $ay = date("m");
                        
                        $yil = date("Y");
                        
                        $oylayan = $uyeid .";". $uyead;
                        
                        $result = mysql_query("select count(uye), oylar from "._MX."uye_oy where uye='$uye' and oylar like '%$oylayan%' and ay='$ay' and yil='$yil'");
                        
                        list($oylandimi, $oylar) = mysql_fetch_row($result);
                        
                        if($oylandimi < 1){
                        
                        ?>
                        <td width="28" background="img/profil_oyver_bg_rakam.gif" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                          <tr>
                            <td width="100%" height="8">
                            <img border="0" src="img/1px.gif" width="1" height="1"></td>
                          </tr>
                          <tr>
                            <td width="100%" height="24" align="center">
                            <p class="tit_1_beyaz"><b>1</b></td>
                          </tr>
                          <tr>
                            <td width="100%" align="center">
                            <input type="radio" value="1" name="puan" id="puan" onclick="puanver(this.value, <?=$uye?>);"></td>
                          </tr>
                        </table>
                        </td>
                        <td width="15">&nbsp;</td>
                        <td width="28" background="img/profil_oyver_bg_rakam.gif" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                          <tr>
                            <td width="100%" height="8">
                            <img border="0" src="img/1px.gif" width="1" height="1"></td>
                          </tr>
                          <tr>
                            <td width="100%" height="24" align="center">
                            <p class="tit_1_beyaz"><b>2</b></td>
                          </tr>
                          <tr>
                            <td width="100%" align="center">
                            <input type="radio" value="2" name="puan" id="puan" onclick="puanver(this.value, <?=$uye?>);"></td>
                          </tr>
                        </table>
                        </td>
                        <td width="15">&nbsp;</td>
                        <td width="28" background="img/profil_oyver_bg_rakam.gif" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                          <tr>
                            <td width="100%" height="8">
                            <img border="0" src="img/1px.gif" width="1" height="1"></td>
                          </tr>
                          <tr>
                            <td width="100%" height="24" align="center">
                            <p class="tit_1_beyaz"><b>3</b></td>
                          </tr>
                          <tr>
                            <td width="100%" align="center">
                            <input type="radio" value="3" name="puan" id="puan" onclick="puanver(this.value, <?=$uye?>);"></td>
                          </tr>
                        </table>
                        </td>
                        <td width="15">&nbsp;</td>
                        <td width="28" background="img/profil_oyver_bg_rakam.gif" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                          <tr>
                            <td width="100%" height="8">
                            <img border="0" src="img/1px.gif" width="1" height="1"></td>
                          </tr>
                          <tr>
                            <td width="100%" height="24" align="center">
                            <p class="tit_1_beyaz"><b>4</b></td>
                          </tr>
                          <tr>
                            <td width="100%" align="center">
                            <input type="radio" value="4" name="puan" id="puan" onclick="puanver(this.value, <?=$uye?>);"></td>
                          </tr>
                        </table>
                        </td>
                        <td width="15">&nbsp;</td>
                        <td width="28" background="img/profil_oyver_bg_rakam.gif" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                          <tr>
                            <td width="100%" height="8">
                            <img border="0" src="img/1px.gif" width="1" height="1"></td>
                          </tr>
                          <tr>
                            <td width="100%" height="24" align="center">
                            <p class="tit_1_beyaz"><b>5</b></td>
                          </tr>
                          <tr>
                            <td width="100%" align="center">
                            <input type="radio" value="5" name="puan" id="puan" onclick="puanver(this.value, <?=$uye?>);"></td>
                          </tr>
                        </table>
                        </td>
                        <?php
                        
                        }
                        else {
                        
							preg_match('#'.$oylayan.';(.*?);#si', $oylar, $puanaktar);
							
							echo '<td width="200" align="center"><font size=2 color=green><b>Profile '.$puanaktar[1].' puan verdiniz.</b></font></td>';
                        
                        }
                        
                        }
                        else {
                        
							echo '<td width="200" align="center"><font size=2 color=red><b>Profil resmi olmayan <br>�yelerimize oy verilemez</b></font></td>';
                        
                        }
                        ?>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" height="63" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td align="center" width="5">
                        &nbsp;</td>
                        <td align="center">
                        <a href="javascript:yasakla(<?=$uye?>);" title="Yasakla">
                        <img border="0" src="img/profil_btn_yasakla.gif" width="35" height="45"></a></td>
                        <td width="1" align="center">
                        <img border="0" src="img/profil_oz_menu_bol.gif" width="1" height="63"></td>
                        <td align="center">
                        <a href="javascript:mesajgonder(<?=$uye?>);" title="Mesaj G�nder">
                        <img border="0" src="img/profil_btn_mesaj.gif" width="62" height="45"></a></td>
                        <td width="1" align="center">
                        <img border="0" src="img/profil_oz_menu_bol.gif" width="1" height="63"></td>
                        <td align="center">
                        <a href="javascript:listemeekle(<?=$uye?>);" title="Listeme Ekle">
                        <img border="0" src="img/profil_btn_ekle.gif" width="49" height="45"></a></td>
                        <td width="1" align="center">
                        <img border="0" src="img/profil_oz_menu_bol.gif" width="1" height="63"></td>
                        <td align="center">
                        <a href="javascript:opucuk(<?=$uye?>);" title="�p�c�k G�nder">
                        <img border="0" src="img/profil_btn_opucuk.gif" width="55" height="45"></a></td>
                        <td width="1" align="center">
                        <img border="0" src="img/profil_oz_menu_bol.gif" width="1" height="63"></td>
                        <td align="center">
                        <a href="javascript:cicek(<?=$uye?>);" title="�i�ek G�nder">
                        <img border="0" src="img/profil_btn_cicek.gif" width="47" height="45"></a></td>
                        <td align="center" width="5">
                        &nbsp;</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" height="81" align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr>
                        <td width="324" height="5"></td>
                      </tr>
                      <tr>
                        <td width="324" height="35">
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                          <tr>
                            <td width="16%">
                            <img border="0" src="img/profil_tit_begedim.gif" width="111" height="35"></td>
                            <td valign="top">
								<?
									$online = mysql_query("select count(uye) from "._MX."online where uye='$uye'");
									
									list($onlinemi) = mysql_fetch_row($online);
									
									if($onlinemi >= 1) $online = "online";
									else $online = "offline";								
								?>
							<img border="0" src="img/profil_iko_<?=$online?>.gif" width="64" height="30"></td>
                            <td width="6%" valign="top">&nbsp;</td>
                            <td valign="top">
                            <?
									$seviye = $uyeaktar["seviye"];
									
									list($seviyeicon) = mysql_fetch_row(mysql_query("select icon from "._MX."seviye where id='$seviye'"));
									
                            ?>
                            <img border="0" src="img/profil_iko_uye_<?=$seviyeicon?>.gif" width="59" height="30"></td>
                            <td width="6%" valign="top">&nbsp;</td>
                            <td valign="top">
                            <?
									$webcam = $uyeaktar["webcam"];
									
									if($webcam == "Evet") $webcam = "var";
									else $webcam = "yok";
									
                            ?>
                            <img border="0" src="img/profil_iko_cam_<?=$webcam?>.gif" width="78" height="30"></td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                      <tr>
                        <td width="324" height="36" background="img/profil_begenenler_bg.gif">
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td>
                            <?php
								
								$begenen = $uyeid .";". $uyead;
								
								$resultbegeni = mysql_query("select count(id), begeni from "._MX."uye_begeniler where uye='$uye' and begenenler like '%$begenen%'");
								
								list($begeniwarmi, $begenineymis) = mysql_fetch_row($resultbegeni);
                            
                            if($begeniwarmi < 1){
                            ?>
                            <span id="begeniler">
                            <select class="selectler" name="begendim" id="begendim" onChange="begendim(<?=$uye?>)">
                            <option value="">Se�im Yap�n�z</option>
                            <?php begeniler(NULL, NULL); ?>
                            </select>
                            </span>
                            <?php
                            }
                            else {
                            $begenineymis = begeniler($begenineymis, NULL);
                            echo "<font size=1>Be�endiniz ��nk� <b>$begenineymis</b></font>";
                            }
                            ?>
                            </td>
                            <td width="80" height="36" align="right">
                            <a class="form_txt2" <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profilinibegenenler&id=<?=$uye?>', '400', '480', 'begenenlerpopup<?=$uye?>', 2, 1, 1);" style="color:#ffffff;text-decoration:none;font-size:8pt"><b>Bu Profili<br>Be�enenler</a></b></td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                </table>
                </td>
                <td width="6">&nbsp;</td>
                <td width="147" background="img/profil_kull_menu.gif" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                  <tr>
                    <td width="100%" height="3">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%" height="27">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr>
                        <td width="9%">&nbsp;</td>
                        <td width="10">
                        <img border="0" src="img/profil_menu_iko.gif" width="10" height="5"></td>
                        <td height="27">
                        <p class="form_txt"><a class="form_txt" href="javascript:bilgiprofil()">
                        Profil Bilgilerim</a></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" height="27">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr>
                        <td width="9%">&nbsp;</td>
                        <td width="10">
                        <img border="0" src="img/profil_menu_iko.gif" width="10" height="5"></td>
                        <td height="27">
                        <p class="form_txt"><a class="form_txt" href="javascript:bilgikisisel()">
                        Ki�isel Bilgilerim</a></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" height="27">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr>
                        <td width="9%">&nbsp;</td>
                        <td width="10">
                        <img border="0" src="img/profil_menu_iko.gif" width="10" height="5"></td>
                        <td height="27">
                        <p class="form_txt"><a class="form_txt" href="javascript:bilgiilgi()">
						�lgi Alanlar�m</a></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" height="27">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr>
                        <td width="9%">&nbsp;</td>
                        <td width="10">
                        <img border="0" src="img/profil_menu_iko.gif" width="10" height="5"></td>
                        <td height="27">
                        <p class="form_txt"><a class="form_txt" href="javascript:resimler()">
                        Resimlerim</a></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" height="27">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr>
                        <td width="9%">&nbsp;</td>
                        <td width="10">
                        <img border="0" src="img/profil_menu_iko.gif" width="10" height="5"></td>
                        <td height="27">
                        <p class="form_txt">
                        <?php
							
							$topgalerimiz = $uyeaktar["topgaleri"];
							
							if($topgalerimiz < 1){
							?>
							<a class="form_txt" href="javascript:alert('�yenin hen�z galerisi bulunmuyor')">Galerilerim</a>
							<?php
							}
							else {
							?>
							<a class="form_txt" href="javascript:galeriler()">Galerilerim (<?=$topgalerimiz?> adet)</a>
							<?php
							}
                        
                        ?>
                        </td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" height="27">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr>
                        <td width="9%">&nbsp;</td>
                        <td width="10">
                        <img border="0" src="img/profil_menu_iko2.gif" width="10" height="5"></td>
                        <td height="25">
                        <p class="form_txt"><b><a class="form_txt2" href="javascript:void(0)" onclick="yoneticiyebildir(<?=$uye?>)">Y�neticiye Bildir</a></b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" height="27">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
                      <tr>
                        <td width="9%">&nbsp;</td>
                        <td width="10">
                        <img border="0" src="img/profil_menu_iko2.gif" width="10" height="5"></td>
                        <td height="27">
                        <p class="form_txt"><b><a class="form_txt2" href="index.php?sayfa=uyelik_yukselt" target="_blank" onclick="sayfayikapat();">�yeli�imi Y�kselt</a></b></td>
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
            <td width="10">&nbsp;</td>
            <td height="36">
            <!-- icerik -->
            
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
              <tr>
                <td width="25">&nbsp;</td>
                <td>
                <p class="tit_profil_mer"><span id="bilgibaslik">Profil Bilgilerim</span></td>
              </tr>
            </table>
            </td>
            <td width="10">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" height="3"></td>
            <td height="3"></td>
            <td width="10" height="3"></td>
          </tr>
          <tr>
            <td width="10">&nbsp;</td>
            <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
              <tr>
                <td valign="top" width="492" height="16" background="img/profil_golgebol_bg.gif"></td>
                <td width="17" height="16"></td>
                <td width="170" valign="top" height="16" background="img/profil_golgebol_bg2.gif"></td>
              </tr>
              <tr>
                <td valign="top" width="492">

				
				<?php
				
					if($cinsiyet != 2){ // �ift de�ilse
				?>
				<!-- bilgi profil -->
				
                <table id="bilgiprofil" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Rumuz</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b><?=$uyeadi;?></b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Cinsiyet</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b><?=cinsiyet($cinsiyet)?></b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Ya�</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
                        <?=$yas?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Medeni Durum</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
						<?php
						if(!$uyeaktar["medenidurum"]) echo "Belirtilmemi�"; 
						else echo $uyeaktar["medenidurum"];
						?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Ya�ad��� Yer</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
                        <?
						echo $uyeaktar["sehir"];
                        if($uyeaktar["kiminle"]) echo ", ".$uyeaktar['kiminle']."	ya��yorum.";
                        ?></b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Arad��� �li�ki T�r�</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["iliski"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
								
								$iliski = explode(";", $iliski);
								
								foreach($iliski as $ilis) if($ilis) echo $ilis .", ";
								
								}
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Arad��� Cinsiyet</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["aracinsiyet"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
								
								$iliski = explode(";", $iliski);
								
								foreach($iliski as $ilis) if($ilis) echo $ilis .", ";
								
								}
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Webcam Sohbetten</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
                        <?
							$iliski = $uyeaktar["webcamsohbet"];
							
							if($iliski == "Evet") echo "Ho�lan�yorum";
							else echo "Ho�lanm�yorum";
                        ?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">K�saca Tan�t�m</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								if($uyeaktar["tanitimonay"] == 1){
									echo stripslashes(nl2br($uyeaktar["tanitim"]));
								}
								else {
									echo "<font color=red>Profil yaz�s� onay bekliyor</font>";
								}
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">&nbsp;</td>
                  </tr>
                </table>
                <!-- bilgi profil -->

				<!-- bilgi kisisel -->
				
                <table id="bilgikisisel" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; display: none;" bordercolor="#111111" width="100%">
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Boy</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["boy"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Kilo</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["kilo"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">G�z Rengi</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["goz"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Sa� Rengi</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["sac"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">�li�ki Deneyimi</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
                        <?php
                        if(!$uyeaktar["deneyim"]) echo "Belirtmemi�";
                        else echo $uyeaktar["deneyim"];
                        ?></b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                 <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Bak�ml� m�</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["bakim"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">V�cut Yap�s�</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["vucut"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Karakter �zellikleri</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["karakter"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo $ilis .", ";
								}
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">E�itim Durumu</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["egitim"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">�al��ma Durumu</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["calisma"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Meslek</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["meslek"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">&nbsp;</td>
                  </tr>
                </table>
                <!-- bilgi kisisel -->
       
       
				<?php
				
					}
					else { // �ift ise
				?>
				<!-- bilgi cift profil -->
				
                <table id="bilgiprofil" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Rumuz</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b><?=$uyeadi;?></b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Cinsiyet</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b><?=cinsiyet($cinsiyet)?></b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Ya�</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
                        <?=$yas?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Medeni Durum</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
						<?php
						if(!$uyeaktar["medenidurum"]) echo "Belirtilmemi�"; 
						else echo $uyeaktar["medenidurum"];
						?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Ya�ad��� Yer</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
                        <?
						echo $uyeaktar["sehir"];
                        if($uyeaktar["kiminle"]) echo ", ".$uyeaktar['kiminle']."	ya��yorum.";
                        ?></b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Arad��� �li�ki T�r�</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["iliski"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
								
								$iliski = explode(";", $iliski);
								
								foreach($iliski as $ilis) if($ilis) echo $ilis .", ";
								
								}
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Arad��� Cinsiyet</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["aracinsiyet"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
								
								$iliski = explode(";", $iliski);
								
								foreach($iliski as $ilis) if($ilis) echo $ilis .", ";
								
								}
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Webcam Sohbetten</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
                        <?
							$iliski = $uyeaktar["webcamsohbet"];
							
							if($iliski == "Evet") echo "Ho�lan�yorum";
							else echo "Ho�lanm�yorum";
                        ?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">K�saca Tan�t�m</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								if($uyeaktar["tanitimonay"] == 1){
									echo stripslashes(nl2br($uyeaktar["tanitim"]));
								}
								else {
									echo "<font color=red>Profil yaz�s� onay bekliyor</font>";
								}
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">&nbsp;</td>
                  </tr>
                </table>
                <!-- bilgi cift profil -->

				<!-- bilgi cift kisisel -->
				
                <table id="bilgikisisel" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; display: none;" bordercolor="#111111" width="100%">
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">&nbsp;</td>
						<td width="15">&nbsp;</td>
						<td>
							<table>
								<tr>
									<td width="150" style="text-align:left;color:blue;font-size:8pt;font-weight:bold">
									KEND�N�N
								   </td>
									<td width="150" style="text-align:left;color:red;font-size:8pt;font-weight:bold">
									E��N�N
									</td>
								</tr>
							</table>
                       </td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Boy</td>
                        <td width="15">&nbsp;</td>
                        <td>

                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["boy"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
							<table>
								<tr>
									<td width="150" style="text-align:left;color:blue;font-size:8pt;font-weight:bold;bacground-color:#1e00ff;opacity:0.5;">
									<?=$iliski1?>
								   </td>
									<td width="150" style="text-align:left;color:red;font-size:8pt;font-weight:bold;bacground-color:#ff0000;opacity:0.5;">
									<?=$iliski2?>
									</td>
								</tr>
							</table>
						</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Kilo</td>
                        <td width="15">&nbsp;</td>
                        <td>

                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["kilo"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
							<table>
								<tr>
									<td width="150" style="text-align:left;color:blue;font-size:8pt;font-weight:bold;bacground-color:#1e00ff;opacity:0.5;">
									<?=$iliski1?>
								   </td>
									<td width="150" style="text-align:left;color:red;font-size:8pt;font-weight:bold;bacground-color:#ff0000;opacity:0.5;">
									<?=$iliski2?>
									</td>
								</tr>
							</table>
						</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">G�z Rengi</td>
                        <td width="15">&nbsp;</td>
                        <td>

                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["goz"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
							<table>
								<tr>
									<td width="150" style="text-align:left;color:blue;font-size:8pt;font-weight:bold;bacground-color:#1e00ff;opacity:0.5;">
									<?=$iliski1?>
								   </td>
									<td width="150" style="text-align:left;color:red;font-size:8pt;font-weight:bold;bacground-color:#ff0000;opacity:0.5;">
									<?=$iliski2?>
									</td>
								</tr>
							</table>
						</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Sa� Rengi</td>
                        <td width="15">&nbsp;</td>
                        <td>

                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["sac"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
							<table>
								<tr>
									<td width="150" style="text-align:left;color:blue;font-size:8pt;font-weight:bold;bacground-color:#1e00ff;opacity:0.5;">
									<?=$iliski1?>
								   </td>
									<td width="150" style="text-align:left;color:red;font-size:8pt;font-weight:bold;bacground-color:#ff0000;opacity:0.5;">
									<?=$iliski2?>
									</td>
								</tr>
							</table>
						</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                 <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">�li�ki Deneyimi</td>
                        <td width="15">&nbsp;</td>
                        <td>

                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["deneyim"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
							<table>
								<tr>
									<td width="150" style="text-align:left;color:blue;font-size:8pt;font-weight:bold;bacground-color:#1e00ff;opacity:0.5;">
									<?=$iliski1?>
								   </td>
									<td width="150" style="text-align:left;color:red;font-size:8pt;font-weight:bold;bacground-color:#ff0000;opacity:0.5;">
									<?=$iliski2?>
									</td>
								</tr>
							</table>
						</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Bak�ml� m�</td>
                        <td width="15">&nbsp;</td>
                        <td>

                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["bakim"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
							<table>
								<tr>
									<td width="150" style="text-align:left;color:blue;font-size:8pt;font-weight:bold;bacground-color:#1e00ff;opacity:0.5;">
									<?=$iliski1?>
								   </td>
									<td width="150" style="text-align:left;color:red;font-size:8pt;font-weight:bold;bacground-color:#ff0000;opacity:0.5;">
									<?=$iliski2?>
									</td>
								</tr>
							</table>
						</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">V�cut Yap�s�</td>
                        <td width="15">&nbsp;</td>
                        <td>

                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["vucut"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
							<table>
								<tr>
									<td width="150" style="text-align:left;color:blue;font-size:8pt;font-weight:bold;bacground-color:#1e00ff;opacity:0.5;">
									<?=$iliski1?>
								   </td>
									<td width="150" style="text-align:left;color:red;font-size:8pt;font-weight:bold;bacground-color:#ff0000;opacity:0.5;">
									<?=$iliski2?>
									</td>
								</tr>
							</table>
						</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Karakter �zellikleri</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["karakter"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo $ilis .", ";
								}
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">E�itim Durumu</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["egitim"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">�al��ma Durumu</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["calisma"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                 <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Meslek</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["meslek"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">&nbsp;</td>
                  </tr>
                </table>
                <!-- bilgi cift kisisel -->

				<?php
					} // �ift ise biti�
				?>

				<!-- bilgi ilgi -->
				
                <table id="bilgiilgi" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; display: none;" bordercolor="#111111" width="100%">
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Hobilerim</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["hobiler"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo "- $ilis<br />";
								}
							?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Be�enilerim</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["begeniler"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo "- $ilis<br />";
								}
							?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Ho�land���m Filmler</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["filmler"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo "- $ilis<br />";
								}
							?>
                        </b></p></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                      <tr>
                        <td width="11" height="26">&nbsp;</td>
                        <td width="145" height="26">
                        <p class="form_txt">Ho�land���m Tipler</td>
                        <td width="15">&nbsp;</td>
                        <td>
                        <p class="form_txt"><b>
							<?
								$iliski = $uyeaktar["tipler"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo "- $ilis<br />";
								}
							?>
                        </b></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="100%" bgcolor="#F4F4F4">
                    <img border="0" src="img/1px.gif" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td width="100%">&nbsp;</td>
                  </tr>
                </table>
                <!-- bilgi ilgi -->
                				
				<!-- bilgi resimler -->
				<table id="bilgiresimler" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; display: none;" bordercolor="#111111" width="100%">
					<tr><td>
				<?php
					
					if($uyeaktar["topresim"] >= 1){
				?>
					<table border="0" style="border-collapse: collapse" cellpadding="5" cellspacing="5">
						
						<tr>


							<td>
							
							
	<script type="text/javascript" src="inc/swfobject.js" ></script>

	<script type="text/javascript">
	function updategallery() {
		//<![CDATA[
		var so = new SWFObject("inc/photo.swf", "polaroid", "480", "500", "8", "#FFFFFF");
		so.addVariable("xmlimiz","inc/photos.php?id=<?=$uye?>");
		so.write("galeriyazdir");
		//]]>
	}
	</script>
	<div id="galeriyazdir"><p align="center"><strong>Galerinin �al��mas� i�in flash player y�klemeniz gerekmektedir.</strong><br />Y�klemek i�in <a href="http://www.adobe.com/products/flashplayer/">buraya</a> t�klay�n�z.</p></div>
	<script type="text/javascript">
	updategallery();
	</script>
							
							</td>


						</tr>
					</table>	
				<?php
					}
					else {
						
						echo "<p align=center><b>�yemizin hen�z resmi bulunmuyor</b></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
					}
				?>
					
					</td></tr>
				</table>
				<!-- bilgi resimler -->


				<!-- bilgi galeriler -->
				<table id="bilgigaleriler" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; display: none;" bordercolor="#111111" width="100%">
				<tr><td>
				
				<?php
					if($uyeaktar["topgaleri"] >= 1){
					
					
					if(seviyeal("album2") != 1){
						echo "<p align=center><b>Alb�mleri g�rebilmek i�in l�tfen �yelik y�kseltiniz.</b></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
					}
					else {
				?>
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                  <tr>
                    <td width="100%" align="center">
														<table border="0" id="table452" cellspacing="0" cellpadding="0">
															<tr>
															
														<?php
														
															$resultgaleri = mysql_query("select id, resim, hit from "._MX."galeri where uye='$uye' and durum='1'");
															
															$i = 1;
															
															while(list($id, $resim, $hit) = mysql_fetch_row($resultgaleri)){
															
															
															list($topresim) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri_resim where galeri='$id'"));
															
														
														?>
																<td valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/urn_penc_ust.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td background="img/urn_penc_bg.gif" align="center">
																		<img border="0" src="<?=$resim?>" style="opacity:0.2;filter:alpha(opacity=20)" width="80" height="100"></td>
																	</tr>
																	<tr>
																		<td>
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
																		izlenmi�</font></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td>
																				<p class="not"><a class="not" href="javascript:galeritalep(<?=$uye?>, <?=$id?>)"><font color="#CC00CC">TALEP ET</font></a></td>
																				<td width="10">&nbsp;</td>
																				<td>
																				<p class="not"><a class="not" href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$id?>', '600', '700', 'galeripopup<?=$id?>', 2, 1, 1);"><font color="#CC00CC">G�R�NT�LE</font></a></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																</table>
																</td>
																<td width="25">&nbsp;</td>
																
														<?php
														
															if($i%4 == 0) echo "</tr><tr>";
															$i++;
															
															} // end while
														?>
															</tr>
															</table>
																		</td>
                  </tr>
                  <tr>
                    <td width="100%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="100%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="100%">&nbsp;</td>
                  </tr>
                  </table>

				<?php
						}
					}
					else {
						
						echo "<p align=center><b>�yemizin hen�z galerisi bulunmuyor</b></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
					}
				?>
				</td></tr>
				</table>
				<!-- bilgi galeriler -->
							
				<!-- Bilgiler sonu -->
                </td>
                <td width="17" valign="top">&nbsp;</td>
                <td width="170" valign="top" align="center">
                <?php
                
                $kgl = $uyeaktar["kgl"];
                
                if($kgl == 1) echo '<img src="img/kglkucuk.gif" border="0" />';
                else echo stripslashes(ayar("profilsag"));
                
                ?>
                </td>
              </tr>
              </table>
            </td>
            <td width="10">&nbsp;</td>
          </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="100%">
        <img border="0" src="img/profil_bg_kapa.jpg" width="713" height="20"></td>
      </tr>
    </table>
    </td>
    <td width="15">&nbsp;</td>
  </tr>
  <tr>
    <td width="15">&nbsp;</td>
    <td width="713" align="center">
    <p class="nickname"><a class="nickname" href="javascript:window.close();">bu pencereyi kapat</a></td>
    <td width="15">&nbsp;</td>
  </tr>
</table>
</div>
</body>
</html>