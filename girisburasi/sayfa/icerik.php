<?

$islem = $_GET["islem"];

$yer = $_REQUEST["yer"];

if(!$yer) $yer = 1;

if($yer == 1) $neresi = "Site Giriþ";
else $neresi = "Site Ýçi";

if($islem == "kaydet"){
	
	$baslik = $_POST["baslik"];
	$duyuru = $_POST["duyuru"];
	
	$baslik = addslashes($baslik);
	$duyuru = addslashes($duyuru);
	
	$zaman = time();
	
	$result = mysql_query("insert into "._MX."duyuru values(NULL, '$baslik', '$duyuru', '$yer', '$zaman')");
	
	
	if($result){
		$buton = "<font color=green><b>Duyuru baþarýyla kaydedildi</b></font>";
	}
	else {
		$buton = NULL;
	}
}

if($islem == "sil"){
	
	$id = $_GET["id"];
	
	mysql_query("delete from "._MX."duyuru where id='$id'");

}

if($islem == "duzenle2"){
	
	$baslik = $_POST["baslik"];
	$duyuru = $_POST["duyuru"];
	$id = $_GET["id"];
	
	$duyuru = addslashes($duyuru);
	$baslik = addslashes($baslik);
	
	$zaman = time();
	
	$result = mysql_query("update "._MX."duyuru set baslik='$baslik', duyuru='$duyuru' where id='$id'");
	
	
	if($result){
		$buton = "<font color=green><b>Duyuru baþarýyla düzenlendi</b></font>";
	}
	else {
		$buton = NULL;
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Duyuru Ekle, Düzenle (<?=$neresi?>) | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/icerik.php"); ?>
	
		<?php
			if($islem == "duzenle"){
			
			$id = $_GET["id"];
			
			$result = mysql_query("select baslik, duyuru from "._MX."duyuru where id='$id'");
			
			list($baslik, $duyuru) = mysql_Fetch_row($result);
			
			$baslik = stripslashes($baslik);
			
			$duyuru = stripslashes($duyuru);
		?>
		<div id="center-column">
		<form action="index.php?sayfa=icerik&islem=icerik&islem=duzenle2&id=<?=$id?>" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2"><?=$baslik?> Düzenle</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Duyuru Baþlýðý</strong></td>
						<td class="last"><input type="text" name="baslik" id="baslik" class="text" value="<?=$baslik?>" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Duyuru</strong></td>
						<td class="last"><textarea name="duyuru" id="duyuru" class="textarea" cols="70" rows="10"><?=$duyuru?></textarea> <br> * Html kod kullanýlabilir. Site içi duyurularýn devamý seklinde görülmesini istiyorsanýz <-- MAHIRIX --> yazarak parcalayabilirsiniz. </td>
					</tr>
					<tr>>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " /></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		  <input type="hidden" name="yer" id="yer" value="<?=$yer?>">
		</form>
		<?php			
			
			}
			else {
			
		?>
		<div id="center-column">
		<form action="index.php?sayfa=icerik&islem=kaydet" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Duyuru Ekle (<?=$neresi?>) <?=$buton?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Duyuru Baþlýðý</strong></td>
						<td class="last"><input type="text" name="baslik" id="baslik" class="text" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Duyuru</strong></td>
						<td class="last"><textarea name="duyuru" id="duyuru" class="textarea" cols="70" rows="10"></textarea> <br> * Html kod kullanýlabilir. Site içi duyurularýn devamý seklinde görülmesini istiyorsanýz <-- MAHIRIX --> yazarak parcalayabilirsiniz.</td>
					</tr>
					<tr>>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " /></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		  <input type="hidden" name="yer" id="yer" value="<?=$yer?>">
		</form>
		<?php
		
		}
		?>
		
		<div id="center-column">
			<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="350">Duyuru Adý</th>
						<th>Eklenme Zamaný</th>
						<th>Düzenle</th>
						<th class="last">Sil</th>
					</tr>
				
					<?
						
						$result = mysql_query("select id, baslik, yer, kayit from "._MX."duyuru where yer='$yer' order by id desc");
						
						while(list($id, $baslik, $yeri, $kayit) = mysql_fetch_row($result)){
						
						$kayit = date("d.m.Y H:i", $kayit);
						
						$baslik = stripslashes($baslik);
						
						?>
					<tr>
						<td class="first style1" width="350"><?=$baslik?></td>
						<td><?=$kayit?></td>
<td><a href="index.php?sayfa=icerik&islem=duzenle&id=<?=$id?>&yer=<?=$yeri?>" title="Düzenle"><img src="img/edit-icon.gif" width="16" height="16" /></a></td>
						<td class="last"><a href="index.php?sayfa=icerik&islem=sil&id=<?=$id?>&yer=<?=$yeri?>" title="Sil" onclick="return confirm('Silmek istediðinizden Emin Misiniz?')"><img src="img/hr.gif" width="16" height="16" /></a></td>
					</tr>
						<?
						
						}
					
					?>
				</table>
			</div>
		</div>
					
		</div>		
					
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu bölümde duyuru, hayatý paylaþ gibi site içerikleri kontrol edilebilir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
