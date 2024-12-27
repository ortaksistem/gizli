<?
function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}
$islem = $_GET["islem"];

if($islem == "sil"){

	$id = $_GET["id"];
	
	mysql_query("delete from "._MX."bildirim where id='$id'");
	
	?>
	<script>alert("Bildirim baþarýyla silindi");window.close();</script>
	<?
	
	
}
else if($islem == "bak"){

	$id = $_GET["id"];
	
	mysql_query("update "._MX."bildirim set durum='2' where id='$id'");
	
	?>
	<script>alert("Bildirim baþarýyla bakýldý sayýldý.");window.close();</script>
	<?
	
		
}
else if($islem == "mesaj"){

	$id = $_POST["id"];
	
	list($uye) = mysql_fetch_row(mysql_query("select gonderen from "._MX."bildirim where id='$id'"));
	
	$mesaj = $_POST["mesaj"];
	
	$mesaj = addslashes(turkce($mesaj));
	
	$result = mysql_query("update "._MX."uye set topbildirim='1', bildirim='$mesaj' where id='$uye'");
	
	if($result){
		
		mysql_query("update "._MX."bildirim set durum='2' where id='$id'");
		
		die("ok");
	}
	else {
		die("hata");
	}
	
	
}
else {

$id = $_GET["id"];

list($gonderen, $gonderilen, $konu, $mesaj, $kayit) = mysql_fetch_row(mysql_query("select gonderen, gonderilen, konu, mesaj, kayit from "._MX."bildirim where id='$id'"));

list($gonderenad) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$gonderen'"));

list($gonderilenad) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$gonderilen'"));

$konu = stripslashes($konu);

$mesaj = nl2br($mesaj);

$kayit = date("d.m.Y H:i", $kayit);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bildirim Ýncele <?=$id?> | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
function gonder(id){
		
		var mesaj = $("#mesaj").val();
		
		if(mesaj == ""){
			$("#sonuc").html("<font color=red><b>Mesajý yazýn</b></font>");
		}	
		else {
		
			$("#sonuc").html("<img src='img/loading.gif' />");
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=bildirimincele&islem=mesaj',
				data : "id="+id+"&mesaj="+mesaj,
				success: function(sonuc){	
					if(sonuc == "ok"){
						$("#sonuc").html("<font color=green><b>Mesaj baþarýyla iletildi.</b></font>");
						document.bildirimformu.reset();
					}
					else {
						alert("Mesaj gönderilemedi tekrar deneyiniz");
					}
				}
			})
		
		}
}	

</script>
</head>
<body>
	<div id="center-column" style="width:470px">
			<form action="javascript:void(0)" method="post" name="bildirimformu">
			<div class="table" style="width:470px">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0" style="width:470px">
					<tr>
						<th class="full" colspan="3">Bildirim Ýncele</th>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Gönderen</strong></td>
						<td class="last"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$gonderen?>', '500', '600', 'profilpopup<?=$gonderen?>', 2, 1, 1);"><b><?=$gonderenad?></b></a></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Gönderilen</strong></td>
						<td class="last"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$gonderilen?>', '500', '600', 'profilpopup<?=$gonderilen?>', 2, 1, 1);"><b><?=$gonderilenad?></b></a></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Bildirim Konusu</strong></td>
						<td class="last"><?=$konu?></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Mesaj</strong></td>
						<td class="last"><?=$kayit?></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Gönderilme Tarihi</strong></td>
						<td class="last"><?=$mesaj?></td>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Cevapla</strong></td>
						<td class="last"><p><textarea name="mesaj" id="mesaj" rows="6" cols="50"></textarea></p><p><input type="submit" value=" Gönder " onclick="gonder(<?=$id?>)"> <span id="sonuc"></span></p><p>Bu göndereceðiniz cevapla yazýsý üyenin giriþ sayfasýnda Dikkat diye çýkacaktýr. Kurduðunuz cümleye dikkat ediniz.</p></td>
					</tr>
					<tr>
						<td align="center" colspan="3">
							
								<p><a href="index.php?sayfa=bildirimincele&islem=sil&id=<?=$id?>" title="Bildirimi Sil"><b>Sil</b></a> </p>
								<p><a href="index.php?sayfa=bildirimincele&islem=bak&id=<?=$id?>" title="Sadece Galeriyi Onayla"><b>Bakýldý Olarak iþaretle</b></a> </p>

						</td>
					</tr>
				</table>

			</div>	
			</form>
					
	</div>


</body>
</html>
<?php
}
?>