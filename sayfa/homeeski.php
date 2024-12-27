<?

$sorgulama = ayar("sorgulama");

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<title><?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="goole-site-verification" content="aVDSnWshymkbicBHOBO323QVlrU8hqA_s8aek9KthY4" />
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<style>
	body {
		background: url(img/bglogin.gif);
	}
</style>
<script type="text/javascript" src="inc/jquery.js"></script>
<?
	// 18 yaş sorgualaması
	if($sorgulama == 1){
?>
<script type="text/javascript" src="inc/jquery.cookie.js"></script>
<script type="text/javascript">
	function sorgulama(){
		var bak = <?=$sorgulama;?>;
		
		if(bak >= 1){
				
				$('#main').hide();
					
				var winH = $(window).height();
				var winW = $(window).width();	
				
				$("#sorgulama").css('top',  winH/2-$("#sorgulama").height()/2);
				$("#sorgulama").css('left', winW/2-$("#sorgulama").width()/2);
				
				$("#sorgulama").fadeIn(1000);
				
		}
	}
	function girisyap(){
		$("#sorgulama").hide();
		$("#main").show();
	}
</script>
<?
	}
?>
<script type="text/javascript">
	function login(){
		var kullanici = document.getElementById("kullaniciadi").value;
		var sifre = document.getElementById("kullanicisifresi").value;
		
		if(kullanici == '' || kullanici == 'Kullanıcı Adı'){
			alert("Kullanıcı adını yazmadınız");
		}
		else if(sifre == '' || sifre == 'Sifre'){
			alert("Şifrenizi yazmadınız");
		}
		else {
			$("#girissonuc").html("<img src='img/loading.gif' /> <font color=green><b>Bekleyin...</b></font>");

				jQuery.ajax({
					type : 'POST',
					url : 'inc/giris.php',
					data : "kullanici="+kullanici+"&sifre="+sifre,
					success: function(sonuc){		
						if(sonuc == "ok"){
							yonlendir("index.php?sayfa=giris");
						}	
						else if(sonuc == "hata1"){
							$("#girissonuc").html('<a href="javascript:void(0)" onclick="login()"><img border="0" src="img/lgn_btn_giris.gif" width="74" height="26"></a>');
							alert("Tüm alanları doldurun");
						}
						else if(sonuc == "hata2"){
							$("#girissonuc").html('<a href="javascript:void(0)" onclick="login()"><img border="0" src="img/lgn_btn_giris.gif" width="74" height="26"></a>');
							alert("Giriş Başarısız");
						}
						else if(sonuc == "hata3"){
							$("#girissonuc").html('<a href="javascript:void(0)" onclick="login()"><img border="0" src="img/lgn_btn_giris.gif" width="74" height="26"></a>');
							alert("Üyeliğiniz henüz onaylanmamış");
						}
						else {
							$("#girissonuc").html('<a href="javascript:void(0)" onclick="login()"><img border="0" src="img/lgn_btn_giris.gif" width="74" height="26"></a>');
							alert("Giriş Başarısız");

						}
					}
				})
				
		}
	}
	
	function yonlendir(url){
		window.location = url;
	}
	
</script>
</head>

<body <?php if($sorgulama == 1) echo "onLoad=\"sorgulama()\" "; ?>topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" background="img/20a_bg.png">
<?
	if($sorgulama == 1){
		echo "<div id=\"sorgulama\" style=\"display:none\">";
		include("sayfa/uyari.php");
		echo "</div>";
	}
?>
<div id="main" align="center">
	<table border="0" id="table1" cellspacing="0" cellpadding="0">
		<tr>
			<td width="750" height="19">&nbsp;</td>
		</tr>
		<tr>
			<td width="750" height="680" background="img/bg_login_zemin.gif" valign="top">
			<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
				<tr>
					<td height="5">
					<img border="0" src="img/1px.gif" width="1" height="1"></td>
				</tr>
				<tr>
					<td height="35">
					<table border="0" id="table3" cellspacing="0" cellpadding="0">
						<tr>
							<td width="428" height="35">&nbsp;</td>
							<td>
							<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=iletisim', '530', '450', 'iletisim', 2, 1, 1);">
							<img border="0" src="img/lgn_btn_satisortak.gif" width="117" height="35"></a></td>
							<td>
							<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=iletisim', '530', '450', 'iletisim', 2, 1, 1);">
							<img border="0" src="img/lgn_btn_iletisim.gif" width="76" height="35"></a></td>
							<td>
							<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=iletisim', '530', '450', 'iletisim', 2, 1, 1);">
							<img border="0" src="img/lgn_btn_canli_destek.gif" width="95" height="35"></a></td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td height="386">
					<table border="0" width="100%" id="table4" cellspacing="0" cellpadding="0">
						<tr>
							<td width="20" height="386">&nbsp;</td>
							<td width="222" valign="top">
							<table border="0" width="100%" id="table5" cellspacing="0" cellpadding="0">
								<tr>
									<td height="169" align="center">
									<img border="0" src="img/logos.gif" width="200" height="139"></td>
								</tr>
								<tr>
									<td>
									<table border="0" width="100%" id="table6" cellspacing="0" cellpadding="0">
										<tr>
											<td width="23">&nbsp;</td>
											<td align="right">
											<img border="0" src="img/lgn_tit_uyegirisi.gif" width="77" height="18"></td>
											<td width="13">&nbsp;</td>
										</tr>
										<tr>
											<td width="23" height="8"></td>
											<td height="8"></td>
											<td width="13" height="8"></td>
										</tr>
										<tr>
											<td width="23">&nbsp;</td>
											<td>
											<table border="0" width="100%" id="table7" cellspacing="0" cellpadding="0">
												<tr>
													<td width="9" background="img/lgn_formbox_sol.gif">&nbsp;
													</td>
													<td background="img/lgn_formbox_bg.gif">
													<input type="text" name="kullaniciadi" id="kullaniciadi" size="24" style="font-family: Trebuchet MS; color: #808080; font-size: 10pt; border: 1px solid #FFFFFF; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" value="Kullanıcı Adı" onFocus="if(this.value=='Kullanıcı Adı')this.value=''" onBlur="if(this.value=='')this.value='Kullanıcı Adı'"></td>
													<td width="13">
													<img border="0" src="img/lgn_formbox_sag.gif" width="13" height="31"></td>
												</tr>
											</table>
											</td>
											<td width="13">&nbsp;</td>
										</tr>
										<tr>
											<td width="23" height="8"></td>
											<td height="8"></td>
											<td width="13" height="8"></td>
										</tr>
										<tr>
											<td width="23">&nbsp;</td>
											<td>
											<table border="0" width="100%" id="table8" cellspacing="0" cellpadding="0">
												<tr>
													<td width="9" background="img/lgn_formbox_sol.gif">&nbsp;
													</td>
													<td background="img/lgn_formbox_bg.gif">
													<input type="password" name="kullanicisifresi" id="kullanicisifresi" size="24" style="font-family: Trebuchet MS; color: #808080; font-size: 10pt; border: 1px solid #FFFFFF; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" value="Sifre" onFocus="if(this.value=='Sifre')this.value=''" onBlur="if(this.value=='')this.value='Sifre'"></td>
													<td width="13">
													<img border="0" src="img/lgn_formbox_sag.gif" width="13" height="31"></td>
												</tr>
											</table>
											</td>
											<td width="13">&nbsp;</td>
										</tr>
										<tr>
											<td width="23" height="8"></td>
											<td height="8"></td>
											<td width="13" height="8"></td>
										</tr>
										<tr>
											<td width="23">&nbsp;</td>
											<td align="right">
											<span id="girissonuc"><a href="javascript:void(0)" onClick="login()"><img border="0" src="img/lgn_btn_giris.gif" width="74" height="26"></a></span></td>
											<td width="13">&nbsp;</td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td height="34">&nbsp;</td>
								</tr>
								<tr>
									<td>
									<table border="0" width="100%" id="table9" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20">
											<img border="0" src="img/1px.gif" width="1" height="1"></td>
											<td>
											<table border="0" width="100%" id="table16" cellspacing="0" cellpadding="0">
												<tr>
													<td width="10">
													<img border="0" src="img/ok.gif" width="10" height="5"></td>
													<td><a class="c1" href="javascript:void(0)" onClick="pencere('index.php?sayfa=sifremi_unuttum', '370', '380', 'sifremiunuttum', 2, 1, 1);" title="Şifre hatırlat">
													şifremi unuttum</a></td>
												</tr>
											</table>
											</td>
										</tr>
										<tr>
											<td width="20" height="4">
											<img border="0" src="img/1px.gif" width="1" height="1"></td>
											<td height="4">
											<img border="0" src="img/1px.gif" width="1" height="1"></td>
										</tr>
										<tr>
											<td width="20">
											<img border="0" src="img/1px.gif" width="1" height="1"></td>
											<td>
											<table border="0" width="100%" id="table17" cellspacing="0" cellpadding="0">
												<tr>
													<td width="10">
													<img border="0" src="img/ok.gif" width="10" height="5"></td>
													<td><a class="c1" onClick="pencere('index.php?sayfa=onay_maili', '770', '380', 'onaymaili', 2, 1, 1);" title="Onay Mailim Gelmedi">
													onay mailim gelmedi</a></td>
												</tr>
											</table>
											</td>
										</tr>
									</table>
									</td>
								</tr>
							</table>
							</td>
							<td width="482">
							<a href="index.php?sayfa=uyeol"><img border="0" src="img/login_foto.jpg" width="482" height="386"></a></td>
							<td>&nbsp;</td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td height="14"></td>
				</tr>
				<tr>
					<td>
					<table border="0" width="100%" id="table10" cellspacing="0" cellpadding="0">
						<tr>
							<td width="18">&nbsp;</td>
							<td width="235" height="72">
							<a href="index.php?sayfa=uyeol"><img border="0" src="img/btn_hemenuye_ol.jpg" width="235" height="72"></a></td>
							<td width="9">&nbsp;</td>
							<td width="470" background="img/bg_logn_istatistk.gif" valign="top">
							<table border="0" width="100%" id="table12" cellspacing="0" cellpadding="0">
								<tr>
									<td height="34" width="111" align="center">
									<p class="istatistik_tit">online üyeler</td>
									<td height="34" width="115" align="center">
									<p class="istatistik_tit">toplam üye</td>
									<td height="34" width="129" align="center">
									<p class="istatistik_tit">bugün kayıt olan</td>
									<td height="34" width="115" align="center">
									<p class="istatistik_tit">dün kayıt olan</td>
								</tr>
								<?php
								
									$result = mysql_query("select count(uye) from "._MX."online");
									
									list($online) = mysql_fetch_row($result);
									
									$result = mysql_query("select count(id) from "._MX."uye");
									
									list($toplam) = mysql_fetch_row($result);
									
									$simdi = mktime();
									
									$dun = mktime(0, 0, 0, date("m"), date("d"),   date("Y")); 
									
									$dun2 = mktime(0, 0, 0, date("m"), date("d")-1,   date("Y")); 
									
									$result = mysql_query("select count(id) from "._MX."uye where kayit < '$simdi' and kayit > '$dun'");
									
									list($bugun) = mysql_fetch_row($result);
									
									$result = mysql_query("select count(id) from "._MX."uye where kayit < '$dun' and kayit > '$dun2'");
									
									list($dun) = mysql_fetch_row($result);									
								
								?>
								<tr>
									<td height="34" width="111" align="center">
									<p class="istatistik_sayi"><b><?=$online?></b></td>
									<td height="34" width="115" align="center">
									<p class="istatistik_sayi"><b><?=$toplam?></b></td>
									<td height="34" width="129" align="center">
									<p class="istatistik_sayi"><b><?=$bugun?></b></td>
									<td height="34" width="115" align="center">
									<p class="istatistik_sayi"><b><?=$dun?></b></td>
								</tr>
							</table>
							</td>
							<td width="18">&nbsp;</td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td>
					<table border="0" width="100%" id="table11" cellspacing="0" cellpadding="0">
						<tr>
							<td width="18">&nbsp;</td>
							<td width="235" height="135" align="center">
							<img border="0" src="img/loginbanner1.jpg" width="235" height="135"></td>
							<td width="9">&nbsp;</td>
							<td width="470" valign="top">
							<table border="0" width="100%" id="table13" cellspacing="0" cellpadding="0">
								<tr>
									<td background="img/lgn_uyari_tit.gif" height="39" align="right">
									<table border="0" id="table15" cellspacing="0" cellpadding="0">
										<tr>
											<td>
											<p class="c1">
											<a class="c1" href="javascript:void(0)" onClick="pencere('index.php?sayfa=iletisim', '530', '450', 'iletisim', 2, 1, 1);"> 
											</a></td>
											<td width="16">&nbsp;</td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td background="img/lgn_uyari_bg.gif" height="90">
									<table border="0" width="100%" id="table14" cellspacing="0" cellpadding="0">
										<tr>
											<td width="15">&nbsp;</td>
											<td height="90">
											<marquee align="middle" scrollamount="1" height="90" width="440" direction="up" scrolldelay="1">
											<p style="text-align:justify;">
													<?php
													
														list($duyuru) = mysql_fetch_row(mysql_query("select duyuru from "._MX."duyuru where yer='1'"));
														
														echo stripslashes(nl2br($duyuru));
													?>
											</p></marquee>
											</td>
											<td width="15">&nbsp;</td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td height="6">
									<img border="0" src="img/lgn_uyari_alt.gif" width="470" height="6"></td>
								</tr>
							</table>
							</td>
							<td width="18">&nbsp;</td>
						</tr>
					</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="750" height="10"></td>
		</tr>
		<tr>
			<td width="750" align="center" height="25" valign="top">
			<font size="2" color="#808080" face="Tahoma"></font></td>
		</tr>
		<tr>
			<td width="750" align="center">
			<img border="0" src="img/c_yp.gif" width="121" height="17"></td>
		</tr>
		<tr>
			<td width="750">&nbsp;</td>
		</tr>
	</table>
	
</div>
</body>

</html>