<?php

function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}

	$islem = $_GET["islem"];

	$limit = 20; 
	
	if($islem == "bul"){
	
	?>
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177"><? echo turkcejquery("Kullanýcý Adý"); ?></th>
						<th>Cinsiyet</th>
						<th>Email</th>
						<th>Seviye</th>
						<th><? echo turkcejquery("Kayýt"); ?></th>
						<th><? echo turkcejquery("Durum"); ?></th>
						<th class="last"><? echo turkcejquery("Ýþlem"); ?></th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?
					
						$adminseviye = adminseviye();
						
						$p = $_POST["sayfa"];
						$siralama = $_POST["siralama"];
						$cinsiyet = $_POST["cinsiyet"];
						
						if($cinsiyet != "hepsi"){
							$cinsiyet = "where cinsiyet='$cinsiyet' ";
						}
						else {
							$cinsiyet = NULL;
						}
						
						switch($siralama){
							case "1": $order = "order by id desc";break;
							case "2": $order = "order by id asc";break;
							case "3": $order = "order by sononline desc";break;
							case "4": $order = "order by sononline asc";break;
							case "5": $order = "order by girissayisi desc";break;
							case "6": $order = "order by girissayisi asc";break;
							case "7": $order = "order by oncelik desc";break;
							case "8": $order = "order by oncelik asc";break;
							default: $order = "order by id desc";break;
							
						}
						
						$resultseviye = mysql_query("select id, ad, renk from "._MX."seviye");
						
						while($rowla = mysql_fetch_array($resultseviye)){
							
							$seviyemiz[$rowla["id"]]["ad"] = turkcejquery($rowla["ad"]);
							$seviyemiz[$rowla["id"]]["renk"] = $rowla["renk"];
						}
						
						$result = mysql_query("select id, kullanici, email, cinsiyet, sononline, satissatis, ip, kayit, seviye, durum from "._MX."uye ".$cinsiyet."".$order." limit ".(($p-1)*$limit).",".$limit."");

						while(list($id, $kullanici, $email, $cinsiyet, $sononline, $satissatis, $ip, $kayit, $seviye, $durum) = mysql_fetch_row($result)){
						
						$cinsiyet = turkcejquery(cinsiyet($cinsiyet));
						
						$kayit = date("d.m.Y", $kayit);
						
						$sononline = date("d.m.Y", $sononline);
						
						$seviyead = $seviyemiz[$seviye]["ad"];
						$seviyerenk = $seviyemiz[$seviye]["renk"];
						
						switch($durum){
							case "1":
								$durumad = "<font color=green>Onaylý</font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="pencere(\'index.php?sayfa=uyeprofil&id='.$id.'\', \'500\', \'600\', \'profilpopup'.$id.'\', 2, 1, 1);"><img src="img/edit-icon.gif" border="0" /></a> <a href="#" onclick="uyesil('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "2":
								$durumad = "<font color=red><b>Admin Onayý</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a> <a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "3":
								$durumad = "<font color=red><b>Email Onay</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a><a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "5":
								$durumad = "<font color=red><b>Kendini Silmiþ</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a><a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "6":
								$durumad = "<font color=red><b>Admin Silmiþ</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a><a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
						
						}
						
						$durumad = turkcejquery($durumad);
						
						if($satissatis == 2 and $adminseviye != 2){
						
						}
						else if($satissatis == 2 and $adminseviye == 2){
						
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$id?>', '500', '600', 'profilpopup<?=$id?>', 2, 1, 1);"><font color="<?=$seviyerenk?>"><?=$kullanici?></font></a> </td>
						<td><?=$cinsiyet?></td>
						<td><?=$email?></td>
						<td><font color="<?=$seviyerenk?>"><?=$seviyead?></font></td>
						<td><?=$kayit?></td>
						<td><?=$durumad?></td>
						<td class="last">
						<?=$durumbuton?>
						</td>
					</tr>
					
					<?
						}
						else {
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$id?>', '500', '600', 'profilpopup<?=$id?>', 2, 1, 1);"><font color="<?=$seviyerenk?>"><?=$kullanici?></font></a> </td>
						<td><?=$cinsiyet?></td>
						<td><?=$email?></td>
						<td><font color="<?=$seviyerenk?>"><?=$seviyead?></font></td>
						<td><?=$kayit?></td>
						<td><?=$durumad?></td>
						<td class="last">
						<?=$durumbuton?>
						</td>
					</tr>
					
					<?						
						
						}
						
					
						}
					?>
					</div>
				</table>
	<?
	}
	else if($islem == "uyebul"){
	?>
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177"><? echo turkcejquery("Kullanýcý Adý"); ?></th>
						<th>Cinsiyet</th>
						<th>Email</th>
						<th>Seviye</th>
						<th><? echo turkcejquery("Kayýt"); ?></th>
						<th><? echo turkcejquery("Durum"); ?></th>
						<th class="last"><? echo turkcejquery("Ýþlem"); ?></th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?
					
						
						$adminseviye = adminseviye();
						
						$p = $_POST["sayfa"];
						$siralama = $_POST["siralama"];
						$cinsiyet = $_POST["cinsiyet"];
						$uyeadi = $_POST["uyeadi"];
						
						if($cinsiyet != "hepsi"){
							$cinsiyet = "and cinsiyet='$cinsiyet' ";
						}
						else {
							$cinsiyet = NULL;
						}
						
						switch($siralama){
							case "1": $order = "order by id desc";break;
							case "2": $order = "order by id asc";break;
							case "3": $order = "order by sononline desc";break;
							case "4": $order = "order by sononline asc";break;
							case "5": $order = "order by girissayisi desc";break;
							case "6": $order = "order by girissayisi asc";break;
							case "7": $order = "order by oncelik desc";break;
							case "8": $order = "order by oncelik asc";break;
							default: $order = "order by id desc";break;
							
						}
						
						$resultseviye = mysql_query("select id, ad, renk from "._MX."seviye");
						
						while($rowla = mysql_fetch_array($resultseviye)){
							
							$seviyemiz[$rowla["id"]]["ad"] = turkcejquery($rowla["ad"]);
							$seviyemiz[$rowla["id"]]["renk"] = $rowla["renk"];
						}
						
						$result = mysql_query("select id, kullanici, email, cinsiyet, satissatis, sononline, ip, kayit, seviye, durum from "._MX."uye where kullanici like '%$uyeadi%' or email like '%$uyeadi%' ".$cinsiyet."".$order." limit ".(($p-1)*$limit).",".$limit."");

						while(list($id, $kullanici, $email, $cinsiyet, $satissatis, $sononline, $ip, $kayit, $seviye, $durum) = mysql_fetch_row($result)){
						
						$cinsiyet = turkcejquery(cinsiyet($cinsiyet));
						
						$kayit = date("d.m.Y", $kayit);
						
						$sononline = date("d.m.Y", $sononline);
						
						$seviyead = $seviyemiz[$seviye]["ad"];
						$seviyerenk = $seviyemiz[$seviye]["renk"];
						
						switch($durum){
							case "1":
								$durumad = "<font color=green>Onaylý</font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="pencere(\'index.php?sayfa=uyeprofil&id='.$id.'\', \'500\', \'600\', \'profilpopup'.$id.'\', 2, 1, 1);"><img src="img/edit-icon.gif" border="0" /></a> <a href="#" onclick="uyesil('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "2":
								$durumad = "<font color=red><b>Admin Onayý</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a> <a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "3":
								$durumad = "<font color=red><b>Email Onay</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a><a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "5":
								$durumad = "<font color=red><b>Kendini Silmiþ</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a><a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "6":
								$durumad = "<font color=red><b>Admin Silmiþ</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a><a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
						
						}
						
						$durumad = turkcejquery($durumad);
						if($satissatis == 2 and $adminseviye != 2){
						
						}
						else if($satissatis == 2 and $adminseviye == 2){
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$id?>', '500', '600', 'profilpopup<?=$id?>', 2, 1, 1);"><font color="<?=$seviyerenk?>"><?=$kullanici?></font></a> </td>
						<td><?=$cinsiyet?></td>
						<td><?=$email?></td>
						<td><font color="<?=$seviyerenk?>"><?=$seviyead?></font></td>
						<td><?=$kayit?></td>
						<td><?=$durumad?></td>
						<td class="last">
						<?=$durumbuton?>
						</td>
					</tr>
					
					<?
					
						}
						else {
						
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$id?>', '500', '600', 'profilpopup<?=$id?>', 2, 1, 1);"><font color="<?=$seviyerenk?>"><?=$kullanici?></font></a> </td>
						<td><?=$cinsiyet?></td>
						<td><?=$email?></td>
						<td><font color="<?=$seviyerenk?>"><?=$seviyead?></font></td>
						<td><?=$kayit?></td>
						<td><?=$durumad?></td>
						<td class="last">
						<?=$durumbuton?>
						</td>
					</tr>
					
					<?
											
						
						}
						
						
						}
					?>
					</div>
				</table>
	<?	
	}
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Üye Yönetimi | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery-eski.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function uyebul(){
	var cinsiyet = document.getElementById('cinsiyet').value;
	var sirala = document.getElementById('sirala').value;
	var sayfa = document.getElementById('sayfalar').value;
	
	$("#uyeyukle").html("<img src='img/loading.gif' /> <font color=green size=1>Lütfen Bekleyin...</font>");
	
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=uye&islem=bul',
					data : "cinsiyet="+cinsiyet+"&siralama="+sirala+"&sayfa="+sayfa,
					success: function(sonuc){		
						$("#uyeyukle").html(sonuc);
					}
				})
}
function uyeara(){
	var cinsiyet = document.getElementById('cinsiyet').value;
	var sirala = document.getElementById('sirala').value;
	var sayfa = document.getElementById('sayfalar').value;
	var uyeadi = document.getElementById('uyeadi').value;
	
	$("#uyeyukle").html("<img src='img/loading.gif' /> <font color=green size=1>Lütfen Bekleyin...</font>");
	
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=uye&islem=uyebul',
					data : "cinsiyet="+cinsiyet+"&siralama="+sirala+"&sayfa="+sayfa+"&uyeadi="+uyeadi,
					success: function(sonuc){		
						$("#uyeyukle").html(sonuc);
					}
				})
}
function uyesil(uye){
	var onayla = confirm("Silmek istediðinizden emin misiniz?");
	if(onayla){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=uyeduzenle&islem=sil',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					$("#uyesonuc"+uye+"").hide("slow");
				}
				else {
					alert("Üye silinemedi tekrar deneyiniz");
				}
			}
		})
	}
}
function uyesil2(uye){
	var onayla = confirm("Silmek istediðinizden emin misiniz? (Veritabanýndan tüm bilgileri silinecektir)");
	if(onayla){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=uyeduzenle&islem=sil2',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					$("#uyesonuc"+uye+"").hide("slow");
				}
				else {
					alert("Üye silinemedi tekrar deneyiniz");
				}
			}
		})
	}
}
function onayla(uye){
	var onayla = confirm("Emin misiniz?");
	if(onayla){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=uyeduzenle&islem=onayla',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					$("#uyesonuc"+uye+"").hide("slow");
				}
				else {
					alert("Üye onaylanamadý");
				}
			}
		})
	}
}
function uyeduzenle(uye){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=uyeduzenle&islem=duzenle',
			data : "id="+uye,
			success: function(sonuc){	
				$("#uyeyukle").html(sonuc);
			}
		})
}
</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/uye.php"); ?>
		<div id="center-column">
		  <div class="select-bar">
			<label>
			<b>Üye Bul :</b> 
			</label>
		    <label>
		    <input type="text" name="uyeadi" id="uyeadi" size="14" class="inputlar" />
		    </label>
		    <label>
			<input type="submit" name="Submit" value=" Bul " onclick="uyeara()" />
			</label>
			<label>
			<b>Göster :</b> 
			</label>
			<label>
				<select name="cinsiyet" id="cinsiyet" class="selectler" onChange="uyebul()">
					<option value="hepsi" selected>Cinsiyete Göre</option>
					<? cinsiyet(); ?>
				</select>
			</label>
			<label>
			<b>Sýrala :</b> 
			</label>
			<label>
				<select name="sirala" id="sirala" class="selectler" onChange="uyebul()">
					<option value="1" selected>Son Eklenen</option>
					<option value="2">Ýlk Eklenen</option>
					<option value="3">Son Aktif Olan</option>
					<option value="4">Ilk Aktif Olan</option>
					<option value="5">En Çok Login Olan</option>
					<option value="6">En Az Login Olan</option>
					<option value="7">Seviyesi Yüksek Olanlar</option>
					<option value="8">Seviyesi Az Olanlar</option>
				</select>
			</label>
		  </div>
		  
			<div class="table" id="uyeyukle">
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Kullanýcý Adý</th>
						<th>Cinsiyet</th>
						<th>Email</th>
						<th>Seviye</th>
						<th>Kayýt</th>
						<th>Durum</th>
						<th class="last">Ýþlem</th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?
					
						$adminseviye = adminseviye();
					
						$p = 1;
						$result = mysql_query("select id from "._MX."uye");
						$sayi = mysql_num_rows($result);
						$toplamsayfa = ceil(($sayi/$limit));
						
						$resultseviye = mysql_query("select id, ad, renk from "._MX."seviye");
						
						while($rowla = mysql_fetch_array($resultseviye)){
							
							$seviyemiz[$rowla["id"]]["ad"] = $rowla["ad"];
							$seviyemiz[$rowla["id"]]["renk"] = $rowla["renk"];
						}
						
						$result = mysql_query("select id, kullanici, email, cinsiyet, satissatis, sononline, ip, kayit, seviye, durum from "._MX."uye order by id desc limit ".(($p-1)*$limit).",".$limit."");

						while(list($id, $kullanici, $email, $cinsiyet, $satissatis, $sononline, $ip, $kayit, $seviye, $durum) = mysql_fetch_row($result)){
						
						$cinsiyet = cinsiyet($cinsiyet);
						
						$kayit = date("d.m.Y", $kayit);
						
						$sononline = date("d.m.Y", $sononline);
						
						$seviyead = $seviyemiz[$seviye]["ad"];
						$seviyerenk = $seviyemiz[$seviye]["renk"];
						
						switch($durum){
							case "1":
								$durumad = "<font color=green>Onaylý</font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="pencere(\'index.php?sayfa=uyeprofil&id='.$id.'\', \'500\', \'600\', \'profilpopup'.$id.'\', 2, 1, 1);"><img src="img/edit-icon.gif" border="0" /></a> <a href="#" onclick="uyesil('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "2":
								$durumad = "<font color=red><b>Admin Onayý</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a> <a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "3":
								$durumad = "<font color=red><b>Email Onay</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a><a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "5":
								$durumad = "<font color=red><b>Kendini Silmiþ</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a><a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
							case "6":
								$durumad = "<font color=red><b>Admin Silmiþ</b></font>";
								$durumbuton = '<a href="javascript:void(0)" onclick="onayla('.$id.')" title="Üyeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a><a href="#" onclick="uyesil2('.$id.')" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>';
							break;
						
						}
						
						if($satissatis == 2 and $adminseviye != 2){
						
						}
						else if($satissatis == 2 and $adminseviye == 2){
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$id?>', '500', '600', 'profilpopup<?=$id?>', 2, 1, 1);"><font color="<?=$seviyerenk?>"><?=$kullanici?></font></a> </td>
						<td><?=$cinsiyet?></td>
						<td><?=$email?></td>
						<td><font color="<?=$seviyerenk?>"><?=$seviyead?></font></td>
						<td><?=$kayit?></td>
						<td><?=$durumad?></td>
						<td class="last">
						<?=$durumbuton?>
						</td>
					</tr>
					
					<?
						}
						else {
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$id?>', '500', '600', 'profilpopup<?=$id?>', 2, 1, 1);"><font color="<?=$seviyerenk?>"><?=$kullanici?></font></a> </td>
						<td><?=$cinsiyet?></td>
						<td><?=$email?></td>
						<td><font color="<?=$seviyerenk?>"><?=$seviyead?></font></td>
						<td><?=$kayit?></td>
						<td><?=$durumad?></td>
						<td class="last">
						<?=$durumbuton?>
						</td>
					</tr>
					
					<?	
						}
						
						
						}
					?>
					</div>
				</table>
			</div>
				<div class="table">
					<div class="select">
						<strong>Sayfalar : </strong>
						<select name="sayfalar" id="sayfalar" class="selectler" onChange="uyebul()">
							<? for($i = 1; $i<=$toplamsayfa; $i++) echo "<option value=$i>$i. Sayfa</option>"; ?>
						</select>
					</div>
				</div>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Üye yönetimi bu alandan yapýlmaktadýr. Bu alanda ufak bilgiler bulabilirsiniz. Sýralama ve göster seçim yapýldýðý zaman yükleme yapýlýr. Ajax kullanýlmýþtýr sayfa yüklenmesine gerek yoktur. Üyeyi düzenlemek için nickine týklayýn küçük bir pop sayfasý açýlacaktýr.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}
?>
