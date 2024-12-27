<?php
	$id = $_GET["id"];
	
	if(!is_numeric($id)) die("Hata");

	list($cinsiyet) = mysql_fetch_row(mysql_query("select cinsiyet from "._MX."uye where id='$id'"));
	
	if(!is_numeric($cinsiyet)) die("Hata");
	
	if($tipler)	foreach($tipler as $t) $tipler2 .= $t .";";
	
	if($filmler) foreach($filmler as $f) $filmler2 .= $f .";";
	
	if($hobiler) foreach($hobiler as $h) $hobiler2 .= $h .";";
	
	if($begeniler) foreach($begeniler as $b) $begeniler2 .= $b .";";
	
	

	$tipler2 = suz($tipler2);
	$begeniler2 = suz($begeniler2);
	$filmler2 = suz($filmler2);
	$hobiler2 = suz($hobiler2);
	$tanitim = suz($tanitim);
	
	
	$result = mysql_query("update "._MX."uye set hobiler='$hobiler2', begeniler='$begeniler2', filmler='$filmler2', tipler='$tipler2', tanitim='$tanitim', tanitimonay='2' where id='$id'");

	$uyelik = ayar("uyelik");
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Adım 4 : Üye Ol, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<style type="text/css">
	body {
		background:url(img/bg.gif);
	}
</style>
<script type="text/javascript" src="inc/jquery.js"></script>
</head>

<body>

<div align="center">
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
							<tr>
								<td>
								<style>

								ul, li {padding: 0px; margin: 0px; list-style-type: none}
								#yeni-header {
									width:770px;
									height:193px;
									background:url(images/header-yeni.jpg) no-repeat;
									margin:0px;
									padding:0px;
								}
								.yeni-header-menu {
									width:770px;
									height:49px;
									padding:144px 0px 0px 0px;
									margin:0px;
								}
								.yeni-header-menu li {
									float:left;
									list-style-type: none;
								}
								.yeni-header-menu img {
									border:none;
								}
									
								</style>
								<div id="yeni-header">
									<div id="yeni-header-menu">
										<div class="yeni-header-menu">
										</div>
									</div>
								</div>
								</td>
							</tr>
							<tr>
								<td height="7">
								<img border="0" src="img/1px.gif" width="1" height="1"></td>
							</tr>
							<tr>
								<td>
								<img border="0" src="img/ic_alan_gri_ust.gif" width="770" height="8"></td>
							</tr>
							<tr>
								<td background="img/ic_alan_gri_bg.gif">
								<table border="0" width="100%" id="table14" cellspacing="0" cellpadding="0">
									<tr>
										<td width="10">&nbsp;</td>
										<td width="200" valign="top">
										<table border="0" width="100%" id="table41" cellspacing="0" cellpadding="0">
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/uyeadim_arasi2.gif" width="200" height="2"></td>
											</tr>
											<tr>
												<td background="img/uyeadim_secilmeyen.gif" height="33" align="center">
												<img border="0" src="img/uyeol_step_kullanici1.gif" width="98" height="18"></td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/uyeadim_arasi2.gif" width="200" height="2"></td>
											</tr>
											<tr>
												<td background="img/uyeadim_secilmeyen.gif" align="center" height="33">
												<img border="0" src="img/uyeol_step_genelbilgi1.gif" width="100" height="18"></td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/uyeadim_arasi2.gif" width="200" height="2"></td>
											</tr>
											<tr>
												<td background="img/uyeadim_secilmeyen.gif" align="center" height="33">
												<img border="0" src="img/uyeol_step_ilgialanlari1.gif" width="83" height="18"></td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/uyeadim_arasi2.gif" width="200" height="2"></td>
											</tr>
											<tr>
												
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
										</table>
										</td>
										<td width="6">&nbsp;</td>
										<td width="540" valign="top">
										<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
											<tr>
												<td height="45" background="img/pncere1_a_ust.gif">
												<table border="0" width="100%" id="table40" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20" height="45">&nbsp;</td>
														<td>
														<p class="menu">&nbsp;</td>
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
														<td align="center">
														<a href="index.php" title="Giriş Yap"><img border="0" src="img/tebrikler.gif" width="500" height="500"></a></td>
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
											</table>
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
								<p class="c2">&nbsp;</td>
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
		<table border="0" id="table847" cellspacing="0" cellpadding="0">
			<tr>
				<td width="15" height="156">&nbsp;</td>
				<td width="161" height="156">&nbsp;</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">
				<?php include("inc/giris-sag2.php"); ?>
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
</div>

</body>
</html>