<?php
function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}
$islem = $_GET["islem"];

if($islem == "sil"){

	$id = $_POST["id"];
	
	$result = mysql_query("delete from "._MX."bildirim where id='$id'");
	
	if($result) die("ok");
	else die("hata");
	
}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Tüm Bildirimler | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">

function sil(id){
	var onayla = confirm("Silmek istediğinizden emin misiniz?");
	if(onayla){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=bekleyenbildirim&islem=sil',
			data : "id="+id,
			success: function(sonuc){	
				if(sonuc == "ok"){
					$("#bildirim"+id+"").hide();
				}
				else {
					alert("Bildirim silinemedi tekrar deneyiniz");
				}
			}
		})
	}
}

</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/uye.php"); ?>
		<div id="center-column">

		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="100">Gönderen</th>
						<th width="100">Şikayet Edilen</th>
						<th>Neresi</th>
						<th>Konu</th>
						<th>Kayıt</th>
						<th class="last">İşlem</th>
					</tr>
					
					<?php
						
						$result = mysql_query("select id, gonderen, gonderilen, yer, konu, kayit from "._MX."bildirim where durum!='1'");
						
						while(list($id, $gonderen, $gonderilen, $yer, $konu, $kayit) = mysql_fetch_row($result)){
						
						list($gonderenad) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$gonderen'"));
						list($gonderilenad) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$gonderilen'"));
						$konu = stripslashes($konu);
						$kayit = date("d.m.Y", $kayit);
						
					?>
					<tr id="bildirim<?=$id?>">
						<td class="first style1"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$gonderen?>', '500', '600', 'profilpopup<?=$gonderen?>', 2, 1, 1);"><b><?=$gonderenad?></b></a></td>
						<td><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$gonderilen?>', '500', '600', 'profilpopup<?=$gonderilen?>', 2, 1, 1);"><b><?=$gonderilenad?></b></a></td>
						<td><?=$yer?></td>
						<td><?=$konu?></td>
						<td><?=$kayit?></td>
						<td class="last">
						<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=bildirimincele&id=<?=$id?>', '500', '600', 'bildirimpopup<?=$id?>', 2, 1, 1);" title="İncele"><img src="img/add-icon.gif" width="16" height="16" /></a>
						
						<a href="#" onclick="sil(<?=$id?>)" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>
						</td>
					</tr>
					
					<?
						
						}
					
					?>
				</table>

		</div>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Üye şikayetleri bu alanda bulunmaktadır. Şikayeti silebilir, okuyabilir, şikayette konu olan üyeye not gönderebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>