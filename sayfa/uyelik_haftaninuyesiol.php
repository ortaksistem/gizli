<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$hafta = date("W");

$yil = date("Y");

$nereden = $_POST["nereden"];

$result = mysql_query("select id, durum from "._MX."uye_hafta where uye='$uyeid' and hafta='$hafta' and yil='$yil'");

list($warmi, $durum) = mysql_fetch_row($result);

if($warmi >= 1){
	
	if($nereden == "mobil"){
		if($durum == 3) die("red");
		else die("var");
	}
	else {
		if($durum == 3){
		echo "<script>alert('Baþvurunuz red edilmiþtir. Bu hafta yeni baþvuruda bulunamazsýnýz.'); window.close();</script>";
		die();
		}
		else {
		echo "<script>alert('Daha önce baþvurunuz vardýr'); window.close();</script>";
		die();
		}
	}

}

$islem = $_POST["kabulediyorum"];

if($islem){

	$cinsiyet = uyebilgi("cinsiyet");
	$sehir = uyebilgi("sehir");
	$dogum = uyebilgi("dogum");
	$img = uyebilgi("img");
	$oncelik = uyebilgi("oncelik");
	
	
	if(!$img or $img == "img_uye/avatar/null.jpg"){
		if($nereden == "mobil"){
			
			die("bulunamaz");
		
		}
		
		echo "<script>alert('Profil resmi bulunmayan üyeler haftanýn üyesi talebinde bulunamazlar.');</script>";
		
		echo "<script>window.close();</script>";
		
		die();		
	
	}
	
	$result = mysql_query("insert into "._MX."uye_hafta values(NULL, '$uyeid', '$uyeadi', '$cinsiyet', '$dogum', '$sehir', '$img', '$oncelik', '$hafta', '$yil', '2')");
	
	if($nereden == "mobil"){
			if($result) die("ok");
			else die("hata");
		
	}
	
	if($result) echo "<script>alert('Baþvurunuz alýnmýþtýr, editörlerimiz tarafýndan incelendikten sonra onaylanacaktýr');</script>";
	else echo "<script>alert('Þuanda baþvurunuz alýnamýyor, lütfen daha sonra tekrar deneyiniz');</script>";
	
	echo "<script>window.close();</script>";
	
	die();

}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Haftanýn Üyesi Ol <?=$uyeadi?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
</head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#E2107D">

<table border="0" style="border-collapse: collapse" cellpadding="0">
	<tr>
		<td width="20">&nbsp;</td>
		<td width="524">
		<img border="0" src="img/hafta_uye_ust.jpg" width="524" height="120"></td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="524" background="img/hafta_uye_bg.jpg" height="353" valign="top">
		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
			<tr>
				<td width="24" height="15"></td>
				<td height="15"></td>
				<td width="24" height="15"></td>
			</tr>
			<tr>
				<td width="24">&nbsp;</td>
				<td>
				<p class="merkez_shop">Sayýn Üyelerimiz; Haftanýn üyeleri arasýnda yer almak istiyorsanýz aþaðýdaki kurallara uygun profiliniz ile buradan haftanýn üyeleri arasýnda olmayý talep edebilirsiniz. </td>
				<td width="24">&nbsp;</td>
			</tr>
			<tr>
				<td width="24">&nbsp;</td>
				<td>&nbsp;</td>
				<td width="24">&nbsp;</td>
			</tr>
			<tr>
				<td width="24">&nbsp;</td>
				<td>
						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
							<tr>
								<td>
								<p class="cc">- Haftanýn Profili olmak için 
								baþvuru yapmak üzeresiniz.
								</td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- Haftanýn Profili ; tamamý 
								doldurulmuþ , resimli profil baþvurularýndan 
								seçilir.
								</td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- <span class="style2">Haftanýn 
								Profilinde, Öncelik Large ve Medium üyelerindir.</span></td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- <span class="style2">Haftanýn 
								Üyelerinden olmak için sýraya girilir ve uygun 
								profiller program tarafýndan haftanýn üyesi 
								olarak belirlenir.</span></td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- <span class="style2">Haftanýn 
								üyeleri bölümünde baþvurusu olmayan cinsel 
								tercih olursa bu kýsým site tarafýndan tayin 
								edilecektir.</span></td>
							</tr>
							<tr>
								<td height="12"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- <span class="style2">Eðer bu 
								iþlemi onaylýyorsanýz '<strong> Kabul Ediyorum</strong> 
								' , onaylamýyorsanýz ' <strong>Kabul Etmiyorum</strong> 
								' butonlarýna basýnýz..</span>.</td>
							</tr>
						</table>
						</td>
				<td width="24">&nbsp;</td>
			</tr>
			<tr>
				<td width="24">&nbsp;</td>
				<td>&nbsp;</td>
				<td width="24">&nbsp;</td>
			</tr>
			<tr>
				<td width="24">&nbsp;</td>
				<td>&nbsp;</td>
				<td width="24">&nbsp;</td>
			</tr>
			<tr>
				<td width="24">&nbsp;</td>
				<td>
				<form action="index.php?sayfa=uyelik_haftaninuyesiol" method="post">
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<p align="center">
						
						<input type="submit" name="kabulediyorum" id="kabulediyorum" value="Kabul Ediyorum">
						
						</p></td>
						<td>
						<p align="center"><input type="button" name="kabulediyorum" value="Kabul Etmiyorum" onclick="javascript:window.close()"></td>
					</tr>
				</table>
				</form>
				</td>
				<td width="24">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20"><img border="0" src="img/1px.gif" width="1" height="1"></td>
		<td width="524">
		<img border="0" src="img/hafta_uye_kapa.jpg" width="524" height="13"></td>
		<td width="20"><img border="0" src="img/1px.gif" width="1" height="1"></td>
	</tr>
	<tr>
		<td width="20" height="4"></td>
		<td width="524" height="4"></td>
		<td width="20" height="4"></td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="524" align="right">
		<table border="0" style="border-collapse: collapse" cellpadding="0">
			<tr>
				<td>
				<a href="javascript:window.close()"><img border="0" src="img/hafta_uye_btn_kapa.jpg" width="56" height="22"></a></td>
				<td width="15">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="524">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
</table>

</body>
</html>