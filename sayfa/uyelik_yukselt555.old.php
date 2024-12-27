<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

if($_GET["islemyap"] == "ode"){


$paypalne = $_POST["paypalne"];
$numaramiz = $_POST["item_number"];

list($one1, $one2) = explode(";", $paypalne);

$odenecektutar = seviye($one1, "$one2");

		switch($one2){
			case "aylik"; $aciklama1 = "1 AYLIK";break;
			case "aylik3"; $aciklama1 = "3 AYLIK";break;
			case "aylik6"; $aciklama1 = "6 AYLIK";break;
			case "yillik"; $aciklama1 = "1 YILLIK";break;
			case "sinirsiz"; $aciklama1 = "SINIRSIZ";break;
		}
		switch($one1){
			case "1"; $aciklama2 = "Large";break;
			case "2"; $aciklama2 = "Medium";break;
		}

// PayPal settings
$paypal_email = 'muhasebe@ypartner.net';
$return_url = "http://www.ypartner.net/index.php?sayfa=odeme_alindi";
$cancel_url = "http://www.ypartner.net/index.php?sayfa=odeme_alinamadi";
$notify_url = 'http://www.ypartner.net';

$item_name = "$aciklama1 $aciklama2 Uyelik Odemesi";
$item_amount = $odenecektutar.".00";


// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){

	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";

	// Append amount& currency (�) to quersytring so it cannot be edited in html

	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";

	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	$zaman = @mktime();
	
	@mysql_query("insert into "._MX."paypal values (NULL, '$uyeid', '$numaramiz', '$paypalne', '$one1', '$one2', '$zaman')");
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);

	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;

	// Redirect to paypal IPN
	header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
	die();

}

//
}

$uyeadi = uyeadi();

$adi = uyebilgi("ad") ." ". uyebilgi("soyad");

$tel = "+9". uyebilgi("tel");

$tel = ereg_replace("-", "", $tel);

$eposta = uyebilgi("email");
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>�yelik Y�kselt <?=$uyeadi?> TEST</title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link rel="stylesheet" href="inc/basic.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
<style>
	body {
		background: url(img/bg.gif);
	}
</style>
<script type="text/javascript">
	function menuler(menu){ 
		
		$("#mesajmerkezitablo").hide();
		$("#arkadasmerkezitablo").hide();
		$("#aramamerkezitablo").hide();
		$("#profilmerkezitablo").hide();
		
		$("#"+menu+"tablo").show("slow");
	}
	
	function odeme(tur){
	
		$(".kredikarti").hide();
		$(".havale").hide();
		
		$("."+tur).show();
	
	}
	
	function tutar(nekadar, ne){
	
		$(".tutar").html(nekadar+" TL <input type='hidden' name='tutar' id='tutar' value='"+ne+"'>");
		$("#paypalne").val(ne);
	}
	
	function odemekredikarti(){
	
		klavye_gizle();
		
		var ad = $("#ad").val();
		var tel = $("#tel").val();
		var mail = $("#mail").val();
		var num1 = $("#num1").val();
		var num2 = $("#num2").val();
		var num3 = $("#num3").val();
		var num4 = $("#num4").val();
		var ay = $("#ay").val();
		var yil = $("#yil").val();
		var cvc = $("#cvc").val();
		var tutar = $("#tutar").val();
		
		if(ad == ""){
			$("#kredikartisonuc").html("<font color=red><b>L�tfen ad�n�z� yaz�n</b></font>");
		}
		else if(tel == ""){
			$("#kredikartisonuc").html("<font color=red><b>L�tfen telefon numaran�z� yaz�n</b></font>");
		}
		else if(mail == ""){
			$("#kredikartisonuc").html("<font color=red><b>L�tfen email adresinizi yaz�n</b></font>");
		}
		else if(num1 == "" || num2 == "" || num3 == "" || num4 == ""){
			$("#kredikartisonuc").html("<font color=red><b>Kredi kart� numaran�z� kontrol ediniz</b></font>");
		}
		else if(cvc == ""){
			$("#kredikartisonuc").html("<font color=red><b>CVC numaras�n� kontrol ediniz</b></font>");
		}
		else if(tutar == "" || tutar == "undefined"){
			$("#kredikartisonuc").html("<font color=red><b>�stedi�iniz �yelik tipi ve s�resini se�iniz</b></font>");
		}
		else {
			$("#kredikartisonuc").html();
			mahirixpencere("�deme Al�n�yor", "<p align=center><img src='img/loading.gif' /> <font color=red><b>L�tfen Bekleyin</b></font></p>");

			jQuery.ajax({
				type : 'POST',
				url : 'inc/odeme.php',
				data : "islem=kredikarti&ad="+ad+"&tel="+tel+"&mail="+mail+"&num1="+num1+"&num2="+num2+"&num3="+num3+"&num4="+num4+"&ay="+ay+"&yil="+yil+"&cvc="+cvc+"&tutar="+tutar,
				success: function(sonuc){		
					if(sonuc == "hata1"){
						mahirixpencereguncelle("<p align=center><font color=red><b>�yelik Tipini se�mediniz</b></font></p>");
					}
					else if(sonuc == "hata2"){
						window.location = 'index.php?sayfa=odeme_alinamadi';
					}
					else {
						window.location = 'index.php?sayfa=odeme_alindi&tur=1';
						$(".kredikarti").html("<td>&nbsp</td>");
					}
					
				}
			})
				
		}
	}
	
	function odemehavale(){
	
		var ad = $("#ad1").val();
		var tel = $("#tel1").val();
		var mail = $("#mail1").val();
		var tutar = $("#tutar").val();
		var mesaj = $("#mesaj").val();
		var banka = $("#banka").val();
		
		if(ad == ""){
			$("#havalesonuc").html("<font color=red><b>L�tfen ad�n�z� yaz�n</b></font>");
		}
		else if(tel == ""){
			$("#havalesonuc").html("<font color=red><b>L�tfen telefon numaran�z� yaz�n</b></font>");
		}
		else if(mail == ""){
			$("#havalesonuc").html("<font color=red><b>L�tfen email adresinizi yaz�n</b></font>");
		}
		else if(mesaj == ""){
			$("#havalesonuc").html("<font color=red><b>L�tfen mesaj k�sm�na gerekli bilgileri yaz�n</b></font>");
		}
		else if(banka == ""){
			$("#havalesonuc").html("<font color=red><b>L�tfen �deme yapt���n�z bankay� se�iniz</b></font>");
		}
		else {
			$("#havalesonuc").html();
			mahirixpencere("�deme Al�n�yor", "<p align=center><img src='img/loading.gif' /> <font color=red><b>L�tfen Bekleyin</b></font></p>");

			jQuery.ajax({
				type : 'POST',
				url : 'inc/odeme.php',
				data : "islem=havale&ad="+ad+"&tel="+tel+"&mail="+mail+"&mesaj="+mesaj+"&tutar="+tutar+"&banka="+banka,
				success: function(sonuc){		
					if(sonuc == "hata1"){
						mahirixpencereguncelle("<p align=center><font color=red><b>�yelik Tipini se�mediniz</b></font></p>");
					}
					else if(sonuc == "hata2"){
						window.location = 'index.php?sayfa=odeme_alinamadi';
					}
					else {
						window.location = 'index.php?sayfa=odeme_alindi&tur=2';
						$(".havale").html("<td>&nbsp</td>");
					}
					
				}
			})
				
		}
	}
	
    function klavye(yer, hangi){
		$("#"+yer).show();
		$("#"+yer).html('<tr><td><input type="button" id="21" name="21" value="1" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td><td><input type="button" id="22" name="22" value="2" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td><td><input type="button" id="23" name="23" value="3" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td></tr><tr><td><input type="button" id="24" name="24" value="4" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td><td><input type="button" id="25" name="25" value="5" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td><td><input type="button" id="26" name="26" value="6" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td></tr><tr><td><input type="button" id="27" name="27" value="7" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td><td><input type="button" id="28" name="28" value="8" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td><td><input type="button" id="29" name="29" value="9" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td></tr><tr><td><input type="button" id="20" name="20" value="0" class="inputlar" onclick="klavye_yazdir(\''+hangi+'\', this.value)" /></td><td> </td><td> </td></tr>');
	}
    
    function klavye_gizle(){
		$("#klavye").hide();
		$("#klavye2").hide();
    }
    
    function klavye_yazdir(hangi, key){
        var val = document.all[""+hangi+""].value;
        if(val.length < 4){
		val = ""+val+""+key+"";
		document.all[""+hangi+""].value = val;
		}
    }

	function cvc_code(){
		mahirixpencere("Cvc Kodu", "<p align=center><img src=img/cvc_code.gif /></p>");	
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
										
									<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
											<tr>
												<td height="45" background="img/pncere1_a_ust.gif">
												<table border="0" width="100%" id="table40" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20" height="45">&nbsp;</td>
														<td valign="bottom">
														<p class="tit_arama_mer">
														<font color="#000000">
														<span style="font-size: 14pt">�yeli�imi Y�kselt</span></font></td>
														<td width="100" align="right">
														&nbsp;</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table16" cellspacing="0" cellpadding="0">
													<tr>
														<td height="15">
														</td>
													</tr>
													<tr>
														<td align="center">
														<img border="0" src="img/mavikirmiziserit.gif" width="536" height="7"></td>
													</tr>
													<tr>
														<td>
												<table border="0" width="100%" id="table203" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
															<tr>
																<td width="245" valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td width="8"><img border="0" src="img/iko_ok_mavi.gif" width="11" height="11"></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="tit_zdshop_mer"><font color="#0000FF">MEDIUM �YEL�K</font></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="cc">AVANTAJLARI</td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>
																	<tr>
																		<td>
																		<p class="form_txt">
																		* G�nl�k 
																		25 mesaj 
																		atabilirler.<br>* 
																		G�nl�k 
																		s�n�rs�z 
																		mesaj 
																		alabilirler.<br>* 
																		Giden 
																		mesaj 
																		saklama 
																		limiti 50 dir.<br>* 
																		Ar�ivde 
																		mesaj 
																		saklama 
																		limiti 
																		50 dir.<br>* 
																		Arama 
																		se�enekleri 
																		geli�mi�tir.<br>* 
																		Kendilerine 
																		�p�c�k 
																		atanlar� 
																		g�rebilirler.<br>* 
																		Profillerine
																		bakanlar� 
																		g�rebilirler.<br>* 
																		�yelere 
																		g�nde 15 
																		adet 
																		�p�c�k 
																		yollayabilirler.<br>* 
																		Yard�m 
																		maillerinde 
																		�ncelikli 
																		cevaplan�rlar.<br>* 
																		Aramalarda 
																		Large 
																		�yeden 
																		sonra 
																		gelirler.<br>* 
																		Okey 
																		odalar�na 
																		girebilirler.<br>* 
																		Sohbet 
																		odalar�na 
																		girebilirler.<br>* 
																		Web cam 
																		odalar�na 
																		girebilirler.</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																</td>
																<td width="25">&nbsp;</td>
																<td width="245" valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td width="8"><img border="0" src="img/iko_ok_kirmizi.gif" width="11" height="11"></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="tit_profil_mer"><font color="#EC0000">LARGE �YEL�K</font></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="cc">AVANTAJLARI</td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>
																	<tr>
																		<td>
																		<p class="form_txt">
																		* G�nl�k 
																		s�n�rs�z mesaj 
																		atabilirler.<br>* 
																		G�nl�k 
																		s�n�rs�z 
																		mesaj 
																		alabilirler.<br>* 
																		Giden 
																		mesaj 
																		saklama 
																		limiti 
																		200 dir.<br>
																		* 
																		Ar�ivde 
																		mesaj 
																		saklama 
																		limiti 
																		200 dir.<br>* 
																		Arama 
																		se�enekleri 
																		geli�mi�tir.<br>* 
																		Kendilerine 
																		�p�c�k 
																		atanlar� 
																		g�rebilirler.<br>* 
																		Profillerine
																		bakanlar� 
																		g�rebilirler.<br>* 
																		�yelere 
																		g�nde 
																		s�n�rs�z 
																		�p�c�k 
																		yollayabilirler.<br>* 
																		Yard�m 
																		maillerinde 
																		�ncelikli 
																		cevaplan�rlar.<br>* 
																		Aramalarda 
																		en �st 
																		s�rada 
																		yer 
																		al�rlar.<br>* 
																		Okey 
																		odalar�na 
																		girebilirler.<br>* 
																		Sohbet 
																		odalar�na 
																		girebilirler.<br>* 
																		Web cam 
																		odalar�na 
																		girebilirler.</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																</td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
															<tr>
																<td width="245" valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td width="8"><img border="0" src="img/iko_ok_mavi.gif" width="11" height="11"></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="tit_zdshop_mer"><font color="#999999">�YEL�K</font></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="cc">PAKETLER�</td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>
																	</table>
																</td>
																<td width="25">&nbsp;</td>
																<td width="245" valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td width="8"><img border="0" src="img/iko_ok_kirmizi.gif" width="11" height="11"></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="tit_zdshop_mer"><font color="#999999">�YEL�K</font></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="cc">PAKETLER�</td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10"></td>
																	</tr>
																</table>
																</td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
															<tr>
																<td width="245" valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	
																	<?php
																		$result = mysql_query("select aylik, aylik3, aylik6, yillik, sinirsiz from "._MX."seviye where id='2'");
																		
																		list($aylik, $aylik3, $aylik6, $yillik, $sinirsiz) = mysql_fetch_row($result);
																		
																	?>
																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="10"><img border="0" src="img/paket_mavi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_mavi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$aylik?>, '2;aylik')" value="2;aylik"></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">1 Ayl�k �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#A0F3F8"><b><?=$aylik?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_mavi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>

																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="10"><img border="0" src="img/paket_mavi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_mavi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$aylik3?>, '2;aylik3')" value="2;aylik3"></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">3 Ayl�k �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#A0F3F8"><b><?=$aylik3?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_mavi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>	

																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="10"><img border="0" src="img/paket_mavi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_mavi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$aylik6?>, '2;aylik6')" value="2;aylik6"></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">6 Ayl�k �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#A0F3F8"><b><?=$aylik6?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_mavi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>
																	
																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="10"><img border="0" src="img/paket_mavi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_mavi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$yillik?>, '2;yillik')" value="2;yillik"></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">1 Senelik �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#A0F3F8"><b><?=$yillik?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_mavi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>
																	
																	<?php
																	
																	if($sinirsiz){
																	?>
																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="10"><img border="0" src="img/paket_mavi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_mavi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$sinirsiz?>, '2;sinirsiz')" value="2;sinirsiz"></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">S�n�rs�z �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#A0F3F8"><b><?=$sinirsiz?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_mavi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>
																	<?php
																		}
																	?>
																	</table>
																</td>
																<td width="25">&nbsp;</td>
																<td width="245" valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<?php
																		$result = mysql_query("select aylik, aylik3, aylik6, yillik, sinirsiz from "._MX."seviye where id='1'");
																		
																		list($aylik, $aylik3, $aylik6, $yillik, $sinirsiz) = mysql_fetch_row($result);
																		
																	?>
																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">

																			<tr>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_kirmizi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$aylik?>, '1;aylik')" value="1;aylik"></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">1 Ayl�k �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#FFDA09"><b><?=$aylik?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>
																	
																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">

																			<tr>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_kirmizi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$aylik3?>, '1;aylik3')" value="1;aylik3"></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">3 Ayl�k �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#FFDA09"><b><?=$aylik3?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>	
																	
																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">

																			<tr>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_kirmizi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$aylik6?>, '1;aylik6')" value="6;aylik6" checked></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">6 Ayl�k �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#FFDA09"><b><?=$aylik6?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>	
																	
																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">

																			<tr>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_kirmizi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$yillik?>, '1;yillik')" value="1;yillik"></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">1 Y�ll�k �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#FFDA09"><b><?=$yillik?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>
																	<?php
																	
																	if($sinirsiz){
																	?>
																	<tr>
																		<td width="245">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">

																			<tr>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sol.gif" width="10" height="36"></td>
																				<td background="img/paket_kirmizi2_bg.gif" height="36">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="20"><input type="radio" name="tur" id="tur" onclick="tutar(<?=$sinirsiz?>, '1;sinirsiz')" value="1;sinirsiz"></td>
																						<td width="10">&nbsp;</td>
																						<td width="110">
																				<p class="tx"><font color="#FFFFFF">S�n�rs�z �yelik</font></td>
																						<td>&nbsp;</td>
																						<td>
																						<p class="msg_tit"><font color="#FFDA09"><b><?=$sinirsiz?> TL</b></font></td>
																						<td>&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																				<td width="10"><img border="0" src="img/paket_kirmizi2_sag.gif" width="10" height="36"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																	</tr>	
																	<?php
																	}
																	?>													
																	</table>
																</td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" height="44" align="center">
														<p class="form_txt">
														L�tfen kendinize uygun 
														paketi se�in ve �deme 
														tipini belirleyin</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td>
																<a href="javascript:odeme('kredikarti')"><img border="0" src="img/btn_kk_satinal.gif" width="157" height="31"></a></td>
																<td width="25">&nbsp;</td>
																<td>
																<a href="javascript:odeme('havale')"><img border="0" src="img/btn_havale_satinal.gif" width="157" height="31"></a></td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr class="kredikarti" style="display:none">
														<td>&nbsp;</td>
														<td width="510" align="center">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<b>KRED� 
																		KARTI 
																		�LE 
																		�DEMEDE 
																		D�KKAT 
																		ED�LMES� 
																		GEREKENLER</b></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="10"></td>
																		<td height="10"></td>
																		<td width="15" height="10"></td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		<p class="form_txt" align="justify">
																		Kredi kart� numaran�z, en y�ksek g�venlikli sayfalarda, 256 bit �ifrelenmi� olarak al�n�r. 
Kredi kart� bilgileriniz kesinlikle sistem veritaban�nda ( kay�tlar�nda ) tutulmaz. Girmi� oldu�unuz kredi kart� bilgileri do�rudan bankaya g�nderilir. 
�yeli�iniz bittikten sonra sizden habersiz , sizin onay�n�z olmadan hi� bir �ekilde kredi kart�n�zdan para �ekilip �yeli�iniz uzat�lmaz. 
																		Formu 
																		doldurduktan
																		sonra 
																		sadece 1 
																		kere 
																		g�nder 
																		butonuna 
																		t�klay�n�z. 
																		Kredi 
																		kart� 
																		ekstrenizde 
																		�demeyi 
																		alan 
																		�irketin 
																		ismi 
																		ge�ecektir. 
																		Site ad� 
																		ge�memektedir.</td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr class="kredikarti" style="display:none">
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table307" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table308" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18"></td>
																		<td width="494" height="27" align="right">
																		<p class="tit_zdshop_mer">
																		Kredi 
																		Kart� 
																		�le 
																		�deme</td>
																		<td height="18"></td>
																	</tr>
																	<tr>
																		<td height="5"></td>
																		<td width="494" height="5"></td>
																		<td height="5"></td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td width="494" bgcolor="#EAEAEA">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt">�deyece�iniz Tutar:</td>
																				<td>
																				<p class="form_txt"><b><span class="tutar"><?=$aylik6?> TL <input type='hidden' name='tutar' id='tutar' value='1;aylik6'></span></b></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td colspan="2">
																					<form id="paypal_form" class="paypal" action="index.php?sayfa=uyelik_yukselt555&islemyap=ode" method="post">
																						<input name="cmd" type="hidden" value="_xclick" />
																						<input name="paypalne" id="paypalne" type="hidden" value="1;aylik6" />
																						<input name="no_note" type="hidden" value="1" />
																						<input name="lc" type="hidden" value="TR" />
																						<input name="currency_code" type="hidden" value="TRY" />
																						<input name="bn" type="hidden" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
																						<input name="first_name" type="hidden" value="<?php echo uyebilgi("ad");?>" />
																						<input name="last_name" type="hidden" value="<?php echo uyebilgi("soyad");?>" />
																						<input name="email" type="hidden" value="<?php echo uyebilgi("email");?>" />
																						<input name="item_number" type="hidden" value="<?php echo $uyeid ."-". rand(10000,99999);?>" />
																						<input type="submit" value="PAYPAL �LE �DEME TAP" />
																					</form>
																				</td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td width="494" bgcolor="#EAEAEA">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>


																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_alt.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td><span id="kredikartisonuc"></span></td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr class="havale" style="display:none">
														<td>&nbsp;</td>
														<td width="510" align="center">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<b>
																		HAVALE 
																		�LE 
																		�DEMEDE 
																		D�KKAT 
																		ED�LMES� 
																		GEREKENLER</b></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="10"></td>
																		<td height="10"></td>
																		<td width="15" height="10"></td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		<p class="form_txt" align="justify">
																		Yukar�daki �cret tablosunda kendinize uygun 
																		olan �yelik 
																		paketine ait �creti hesab�m�za yat�r�n. �creti yat�rd�ktan sonra �deme yapm�� oldu�unuz dekont �zerindeki baz� bilgileri alt taraftaki formu kullanarak taraf�m�za g�nderin, 
																		�yeli�inizi hemen 
																		ba�latal�m... </td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr class="havale" style="display:none">
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table658" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table659" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18"></td>
																		<td width="494" height="27" align="right">
																		<p class="tit_zdshop_mer">
																		<font color="#FF6320">Havale 
																		ile 
																		�deme</font></td>
																		<td height="18"></td>
																	</tr>
																	<tr>
																		<td height="5"></td>
																		<td width="494" height="5"></td>
																		<td height="5"></td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td width="494" bgcolor="#EAEAEA">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt">�deyece�iniz Tutar:</td>
																				<td>
																				<p class="form_txt"><b><span class="tutar"><?=$aylik6?> TL <input type='hidden' name='tutar' id='tutar' value='1;aylik6'></span></b></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td width="494" bgcolor="#EAEAEA">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt">Ad, Soyad:</td>
																				<td>
																				<p class="form_txt"><input type="text" name="ad1" id="ad1" value="<?=$adi?>" class="inputlar" size="45"></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td width="494" bgcolor="#EAEAEA">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt">Telefon Numaran�z:</td>
																				<td>
																				<p class="form_txt"><input type="text" name="tel1" id="tel1" value="<?=$tel?>" size="45" class="inputlar"></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td width="494" bgcolor="#EAEAEA">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt">E-posta Adresiniz:</td>
																				<td>
																				<p class="form_txt"><input type="text" name="mail1" id="mail1" class="inputlar" size="45" value="<?=$eposta?>"></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td width="494" bgcolor="#EAEAEA">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt">�deme Yapt���n�z Banka:</td>
																				<td>
																				<p class="form_txt">
																				<select name="banka" id="banka" class="selectler">
																					<option value="">L�tfen �deme yapt���n�z bankay� se�iniz</option>
																					<option value="Garanti Bankas�">Garanti Bankas�</option>
																					<option value="�� Bankas�">�� Bankas�</option>
																					<option value="AkBank">Akbank</option>
																				</select>
																				</td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td width="494" bgcolor="#EAEAEA">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td height="6"></td>
																		<td width="494" height="6">
																		</td>
																		<td height="6"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200" valign="top">
																				<p class="form_txt">Mesaj:<br>
																				<br>
																				<font color="#C32828">Havale dekontunudaki bilgileri (��lem tarihi, havale dekontu) yan kolona giriniz..<br>
																						&nbsp;</font></td>
																				<td>
																				<p class="form_txt"><textarea rows="10" name="mesaj" id="mesaj" cols="40" style="font-family: Tahoma; font-size: 8pt; padding-left: 1px; padding-right: 1px"></textarea></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		&nbsp;</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="7"></td>
																		<td width="494" height="7"></td>
																		<td height="7"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494" align="center">
																		<table border="0" width="100%" id="table660" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>&nbsp;</td>
																				<td width="476" height="51" background="img/msg_oku_btn_bg.gif" align="right" valign="top">
																				<table border="0" width="100%" id="table661" cellspacing="0" cellpadding="0">
																					<tr>
																						<td valign="top">
																						<table border="0" style="border-collapse: collapse" cellpadding="0">
																							<tr>
																								<td width="20">&nbsp;</td>
																								<td>
																								<p class="merkez_profil"><span id="havalesonuc">* L�tfen Bilgileri Eksiksiz Giriniz</span></td>
																							</tr>
																						</table>
																						</td>
																						<td width="150" align="right">
																				<table border="0" id="table662" cellspacing="0" cellpadding="0">
																					<tr>
																						<td width="13" height="20">&nbsp;</td>
																						<td width="30" height="20">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="13"><a href="javascript:odemehavale()"><img border="0" src="img/btn_gonderdavtet.gif" width="110" height="31"></a></td>
																						<td width="30">&nbsp;</td>
																					</tr>
																				</table>
																						</td>
																					</tr>
																				</table>
																				</td>
																				<td>&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																		<td width="494" height="10">
																		</td>
																		<td height="10">
																		</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_alt.gif" width="510" height="7"></td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr class="havale" style="display:none">
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td bgcolor="#EFEFEF" width="12">&nbsp;</td>
																<td bgcolor="#EFEFEF" height="26">
																<p class="form_txt">
																BANKA HESAP 
																B�LG�LER�</td>
																<td bgcolor="#EFEFEF" width="12">&nbsp;</td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
														<td width="510" align="center" bgcolor="#EFEFEF">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
														<td>
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
												</table>
														</td>
													</tr>
													<tr class="havale" style="display:none">
														<td height="15" align="center">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/logo_garanti.gif" width="150" height="50"></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="form_txt">
																		<b>TL 
																		Hesab�</b></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="form_txt">
																		Hesap 
																		No: 
																		6678369</td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="form_txt">
																		�ube 
																		Kodu: 
																		349</td>
																	</tr>
																</table>
																</td>
																<td width="20">&nbsp;</td>
																<td valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/akbank.gif" width="150" height="50"></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="form_txt">
																		<b>TL 
																		Hesab�</b></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="form_txt">
																		Hesap 
																		No: 
																		170742-1</td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="form_txt">
																		�ube 
																		Kodu: 
																		150</td>
																	</tr>
																</table>
																</td>
																<td width="20" valign="top">&nbsp;</td>
																<td valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/logo_isbank.gif" width="150" height="50"></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="form_txt">
																		<b>TL 
																		Hesab�</b></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="form_txt">
																		Hesap 
																		No: 
																		2248282</td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="form_txt">
																		�ube 
																		Kodu: 
																		1006</td>
																	</tr>
																</table>
																</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td height="8">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td>
														<img border="0" src="img/pncere1_alt.gif" width="540" height="9"></td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td height="12">
												</td>
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
										�yeler</a></b></td>
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
										<td><b><a class="c" href="index.php?sayfa=uyelik_yukselt">�yeli�ini 
										y�kselt</a></b></td>
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
										<td><b><a class="c" href="index.php?sayfa=yardimmerkezi">yard�m merkezi</a></b></td>
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
								<p class="c2"><a class="c1" href="index.php?sayfa=kullanim_sartlari">Kullan�m 
								�artlar�</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=gizlilik_ilkeleri">Gizlilik �lkeleri</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=yardimmaili">Bize Ula��n</a></td>
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