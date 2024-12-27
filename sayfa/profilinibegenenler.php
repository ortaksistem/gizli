<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uye = $_GET["id"];

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Bu Profili Beğenenler</title>
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<style type="text/css">
	body {
		background:url(img/bg.gif);
	}
</style>
</head>
<body>

<table border="0" id="table5" cellspacing="0" cellpadding="0">
	<tr>
		<td width="20">&nbsp;</td>
		<td width="300">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="300" valign="top">
		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
			<tr>
				<td background="img/pop_profilibegenenler_ust.gif" height="44">
		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
			<tr>
				<td width="20">&nbsp;</td>
				<td>
								<p class="tit_mesaj_mer"><font color="#FFFFFF">
								Bu Profili Beğenenler</font></td>
			</tr>
			<tr>
				<td width="20" height="5"></td>
				<td height="5">
								</td>
			</tr>
		</table>
				</td>
			</tr>
			<tr>
				<td background="img/pop_profilibegenenler_bg.gif">
				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
															<?php
																
																$sayisi = begeniler(NULL, "say");
																
																$toplam = 0;
																
																for($i = 1; $i < $sayisi; $i++){
																
																$begeni = begeniler($i, NULL);
														
															
																$result = mysql_query("select begenenler, hit from "._MX."uye_begeniler where uye='$uye' and begeni='$i'");
																
																list($begenenler, $hit) = mysql_fetch_row($result);
																
																if(!$hit) $hit = 0;
																
															?>
															
					<tr>
						<td width="5">&nbsp;</td>
						<td>
						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
							<tr>
								<td width="12" height="23">&nbsp;</td>
								<td width="170">
								<p class="form_txt"><b><?=turkcejquery($begeni);?></b></td>
								<td width="12">&nbsp;</td>
								<td>
								<p class="form_txt"><font color="#F9950E"><b><?=$hit?></b></font></td>
							</tr>
						</table>
						</td>
						<td width="5">&nbsp;</td>
					</tr>
					<tr>
						<td width="5">
						<img border="0" src="img/1px.gif" width="1" height="1"></td>
						<td bgcolor="#F3F3F3">
						<img border="0" src="img/1px.gif" width="1" height="1"></td>
						<td width="5">
						<img border="0" src="img/1px.gif" width="1" height="1"></td>
					</tr>
					
					<?php
					
							$toplam = $toplam + $hit;
						}
					?>
				</table>
				</td>
			</tr>
			<tr>
				<td background="img/pop_profilibegenenler_alt.gif" height="46">
				<table border="0" style="border-collapse: collapse" cellpadding="0">
					<tr>
						<td width="5" height="23">&nbsp;</td>
						<td width="12" height="23">&nbsp;</td>
						<td width="170">
						<p class="form_txt"><font color="#FFFFFF"><b><?php echo turkcejquery("TOPLAM 
						BEĞENEN ÜYE:"); ?></b></font></td>
						<td width="12">&nbsp;</td>
						<td>
						<p class="tit_1_beyaz"><font color="#FFFFFF"><b><?=$toplam?></b></font></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
</body>
</html>