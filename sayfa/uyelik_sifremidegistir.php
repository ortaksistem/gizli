<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>�ifremi De�i�tir <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type="text/javascript">

	function gonder(){
	
	var sifreeski = $("#sifreeski").val();
	var sifreyeni = $("#sifreyeni").val();
	var sifreyeni2 = $("#sifreyeni2").val();
	
	
	if(sifreeski == ""){
		
		$("#sonuc").html("Eski �ifrenizi yaz�n�z");
	
	}
	else if(sifreyeni == "") {
	
		$("#sonuc").html("Yeni �ifrenizi yaz�n�z");
		
	}
	else if(sifreyeni2 == "") {
	
		$("#sonuc").html("Yeni �ifre tekrar�n� yaz�n�z");
		
	}
	else if(sifreyeni != sifreyeni2){
	
		$("#sonuc").html("Yeni �ifre ile tekrar� uyu�muyor");
	}
	else {
	
		$("#sonuc").html("<img src=img/loading.gif /> Bekleyin...");
		
			jQuery.ajax({
				type : 'POST',
				url : 'inc/uyelikislem.php',
				data : "islem=sifredegistir&sifre="+sifreeski+"&yeni="+sifreyeni,
				success: function(sonuc){		
					if(sonuc == "hata1"){
						$("#sonuc").html("�ifreniz hatal�d�r");
					}
					else if(sonuc == "hata3"){
						$("#sonuc").html(" ");
						alert("�uan g�ncelleme yap�lam�yor l�tfen daha sonra tekrar deneyin");
						window.close();
					}
					else {
						$("#sonuc").html(" ");
						alert("�ifreniz de�i�tirilmi�tir, yeniden giri� yapmal�s�n�z otomatik olarak ��k�� yapt�r�ld�n�z.");
						window.close();
					}

					
				}
			})
			
	}
	
	}
</script>
</head>

<body>

<table border="0" id="table1" cellspacing="0" cellpadding="0">
	<tr>
		<td width="20">&nbsp;</td>
		<td width="330">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<form method="POST" action="javascript:void(0)">
		<td width="330" background="img/bg_sifremiunuttum.jpg" height="323" valign="top">
		<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
			<tr>
				<td width="33">&nbsp;</td>
				<td height="49">
				<p class="tit_zdshop_mer">�ifremi De�i�tir</td>
				<td width="33">&nbsp;</td>
			</tr>
			<tr>
				<td width="33">&nbsp;</td>
				<td valign="top">
				<table border="0" width="100%" id="table3" cellspacing="0" cellpadding="0">
					<tr>
						<td height="15"></td>
					</tr>
					<tr>
						<td>
						<p class="not2_byz"><b>Dikkat !</b> �ifrenizi de�i�tirmek i�in �nce eski 
						�ifrenizi yaz�n�z...</td>
					</tr>
				</table>
				</td>
				<td width="33">&nbsp;</td>
			</tr>
			<tr>
				<td width="33" height="20"></td>
				<td height="20">
				</td>
				<td width="33" height="20"></td>
			</tr>
			<tr>
				<td width="33">&nbsp;</td>
				<td align="right">
				<table border="0" style="border-collapse: collapse" cellpadding="0">
					<tr>
						<td align="right">
						<p class="form_txt"><font color="#FFFFFF">Eski �ifreniz</font></td>
						<td width="5">&nbsp;</td>
						<td>
						<div align="right">
						<table border="0" id="table13" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10">
								<img border="0" src="img/sfrem_box_sol.gif" width="10" height="31"></td>
								<td background="img/sfrem_box_bg.gif">
													<input type="password" name="sifreeski" id="sifreeski" size="24" style="font-family: Trebuchet MS; color: #808080; font-size: 10pt; border: 1px solid #FFFFFF; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
								<td width="10">
								<img border="0" src="img/sfrem_box_sag.gif" width="10" height="31"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
				</table>
				</td>
				<td width="33">&nbsp;</td>
			</tr>
			<tr>
				<td width="33" height="12"></td>
				<td height="12">
				</td>
				<td width="33" height="12"></td>
			</tr>
			<tr>
				<td width="33">&nbsp;</td>
				<td align="right">
				<table border="0" style="border-collapse: collapse" cellpadding="0">
					<tr>
						<td align="right">
						<p class="form_txt"><font color="#FFFFFF">Yeni �ifreniz</font></td>
						<td width="5">&nbsp;</td>
						<td>
						<div align="right">
						<table border="0" id="table16" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10">
								<img border="0" src="img/sfrem_box_sol.gif" width="10" height="31"></td>
								<td background="img/sfrem_box_bg.gif">
													<input type="password" name="sifreyeni" id="sifreyeni" size="24" style="font-family: Trebuchet MS; color: #808080; font-size: 10pt; border: 1px solid #FFFFFF; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
								<td width="10">
								<img border="0" src="img/sfrem_box_sag.gif" width="10" height="31"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
				</table>
				</td>
				<td width="33">&nbsp;</td>
			</tr>
			<tr>
				<td width="33" height="12"></td>
				<td height="12">
				</td>
				<td width="33" height="12"></td>
			</tr>
			<tr>
				<td width="33">&nbsp;</td>
				<td align="right">
				<table border="0" style="border-collapse: collapse" cellpadding="0">
					<tr>
						<td align="right">
						<p class="form_txt"><font color="#FFFFFF">Yeni �ifreniz (Tekrar)</font></td>
						<td width="5">&nbsp;</td>
						<td>
						<div align="right">
						<table border="0" id="table17" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10">
								<img border="0" src="img/sfrem_box_sol.gif" width="10" height="31"></td>
								<td background="img/sfrem_box_bg.gif">
													<input type="password" name="sifreyeni2" id="sifreyeni2" size="24" style="font-family: Trebuchet MS; color: #808080; font-size: 10pt; border: 1px solid #FFFFFF; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
								<td width="10">
								<img border="0" src="img/sfrem_box_sag.gif" width="10" height="31"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
				</table>
				</td>
				<td width="33">&nbsp;</td>
			</tr>
			<tr>
				<td width="33" height="12"></td>
				<td height="12">
				</td>
				<td width="33" height="12"></td>
			</tr>
			<tr>
				<td width="33">&nbsp;</td>
				<td align="right">
						<input type="image" src="img/btn_gonderx.gif" width="70" height="26" onclick="gonder()"></td>
				<td width="33">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><span id="sonuc" style="padding-left:30px;color:#ffffff;font-weight:bold"></span></td>
			</tr>
			</table>
		</td>
		</form>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20" height="5"></td>
		<td width="330" height="5"></td>
		<td width="20" height="5"></td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="330" align="right">
		<table border="0" id="table4" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<p class="not"><a class="not" href="javascript:window.close();">pencereyi kapat</a></td>
				<td width="15">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="330">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
</table>

</body>

</html>