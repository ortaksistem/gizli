<?

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	$kullanici = $_POST["kullanici"];
	$sifre = $_POST["sifre"];
	$email = $_POST["email"];
	$super = $_POST["super"];
	
	$sifre = sifreleme($sifre);
	$kullanici = addslashes($kullanici);
	
	
	
	$result = mysql_query("insert into "._MX."admin values(NULL, '$kullanici', '$sifre', '$email', '$super')");
	
	
	if($result){
		$buton = "<font color=green><b>Y�netici kaydedildi</b></font>";
	}
	else {
		$buton = NULL;
	}
}

list($seviye) = mysql_fetch_row(mysql_query("select seviye from "._MX."admin where id='".adminid()."'"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Yeni Y�netici Ekle | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/yoneticiler.php"); ?>
		<div id="center-column">
		<form action="index.php?sayfa=yonetici&islem=kaydet" method="post">
		  <div class="table">
				<?php
					
					if($seviye != 1){
						echo "<p align=center><b>Bu alan� kullanma yetkiniz bulunmamaktad�r</b></p>";
						die();
					}
					
				?>
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Yeni y�netici ekle <?=$buton?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Kullan�c� ad�</strong></td>
						<td class="last"><input type="text" name="kullanici" id="kullanici" class="text" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>�ifre</strong></td>
						<td class="last"><input type="password" name="sifre" id="sifre" class="text" style="width:250px" /> </td>
					</tr>
					<tr>
						<td class="first"><strong>Email</strong></td>
						<td class="last"><input type="text" name="email" id="email" class="text" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>S�per Admin</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="super" id="super" class="text" value="1" /> * S�per admin y�netici y�netimini kontrol edebilir. Di�er adminler bu alan� kullanamaz</td>
					</tr>
					<tr>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " /></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan yeni y�netici ekleyebilir, ekli y�neticileri d�zenleyebilir ve silebilirsiniz. Bu alan geli�tirmeye a��kt�r �imdilik sadece y�netici eklenmek i�in kullan�lacakt�r.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
