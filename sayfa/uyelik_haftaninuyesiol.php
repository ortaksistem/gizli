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
		echo "<script>alert('Ba�vurunuz red edilmi�tir. Bu hafta yeni ba�vuruda bulunamazs�n�z.'); window.close();</script>";
		die();
		}
		else {
		echo "<script>alert('Daha �nce ba�vurunuz vard�r'); window.close();</script>";
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
		
		echo "<script>alert('Profil resmi bulunmayan �yeler haftan�n �yesi talebinde bulunamazlar.');</script>";
		
		echo "<script>window.close();</script>";
		
		die();		
	
	}
	
	$result = mysql_query("insert into "._MX."uye_hafta values(NULL, '$uyeid', '$uyeadi', '$cinsiyet', '$dogum', '$sehir', '$img', '$oncelik', '$hafta', '$yil', '2')");
	
	if($nereden == "mobil"){
			if($result) die("ok");
			else die("hata");
		
	}
	
	if($result) echo "<script>alert('Ba�vurunuz al�nm��t�r, edit�rlerimiz taraf�ndan incelendikten sonra onaylanacakt�r');</script>";
	else echo "<script>alert('�uanda ba�vurunuz al�nam�yor, l�tfen daha sonra tekrar deneyiniz');</script>";
	
	echo "<script>window.close();</script>";
	
	die();

}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Haftan�n �yesi Ol <?=$uyeadi?></title>
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
				<p class="merkez_shop">Say�n �yelerimiz; Haftan�n �yeleri aras�nda yer almak istiyorsan�z a�a��daki kurallara uygun profiliniz ile buradan haftan�n �yeleri aras�nda olmay� talep edebilirsiniz. </td>
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
								<p class="cc">- Haftan�n Profili olmak i�in 
								ba�vuru yapmak �zeresiniz.
								</td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- Haftan�n Profili ; tamam� 
								doldurulmu� , resimli profil ba�vurular�ndan 
								se�ilir.
								</td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- <span class="style2">Haftan�n 
								Profilinde, �ncelik Large ve Medium �yelerindir.</span></td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- <span class="style2">Haftan�n 
								�yelerinden olmak i�in s�raya girilir ve uygun 
								profiller program taraf�ndan haftan�n �yesi 
								olarak belirlenir.</span></td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- <span class="style2">Haftan�n 
								�yeleri b�l�m�nde ba�vurusu olmayan cinsel 
								tercih olursa bu k�s�m site taraf�ndan tayin 
								edilecektir.</span></td>
							</tr>
							<tr>
								<td height="12"></td>
							</tr>
							<tr>
								<td>
								<p class="cc">- <span class="style2">E�er bu 
								i�lemi onayl�yorsan�z '<strong> Kabul Ediyorum</strong> 
								' , onaylam�yorsan�z ' <strong>Kabul Etmiyorum</strong> 
								' butonlar�na bas�n�z..</span>.</td>
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