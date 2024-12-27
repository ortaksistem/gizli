<?php

$id = suz($_GET["id"]);

list($baslik, $duyuru) = mysql_fetch_row(mysql_query("select baslik, duyuru from "._MX."duyuru where id='$id'"));

$baslik = stripslashes($baslik);

$duyuru = str_replace("<-- MAHIRIX -->", "", $duyuru);

$duyuru = nl2br($duyuru);

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title><?=$baslik?></title>
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
		<style>
		body {
			background:#fff;
		}
		</style>
</head>
<body>
<table border="0" id="table1" cellspacing="0" cellpadding="0">
	<tr>
		<td width="20">&nbsp;</td>
		<td width="510">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="510" valign="top">
														<table border="0" width="100%" id="table730" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="15" height="10">
																		</td>
																		<td height="10">
																		<p class="c">
																		</td>
																		<td width="15" height="10">
																		</td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		<p class="cc">
																		<?=$duyuru?>
																		</p></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="10">
																		</td>
																		<td height="10">
																		</td>
																		<td width="15" height="10">
																		</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
															</tr>
														</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20" height="10"></td>
		<td width="510" height="10"></td>
		<td width="20" height="10"></td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="510" align="right">
		<table border="0" id="table4" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<a href="javascript:window.close()" title="Kapat"><img border="0" src="img/btn_kapat.gif" width="100" height="22"></a></td>
				<td width="15">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="510">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
</table>
</body>
</html>
