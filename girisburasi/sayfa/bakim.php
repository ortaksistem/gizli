<?

$islem = $_GET["islem"];


$id = $_GET["id"];


if($islem == "mahirix"){

	ini_set("max_execution_time"," 259200");
	
	if($_POST["anket"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."anket_log");
	}
	
	if($_POST["galeritalep"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."galeri_talep");
		@mysql_query("update "._MX."uye set topgaleritalep='0', topgalerionay='0'");
	}
	
	if($_POST["gks"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."gks");
	}
		
	if($_POST["odeme1"] == 1){
		mysql_query("delete from "._MX."odeme where durum='1'");
	}
	
	if($_POST["odeme2"] == 1){
		mysql_query("delete from "._MX."odeme where durum='2'");
	}
	
	if($_POST["odeme1"] == 1 and $_POST["odeme2"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."odeme");
	}

	if($_POST["arkadas"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."uye_arkadas");
		@mysql_query("update "._MX."uye set toparkadas='0'");
	}	
	
	if($_POST["begeniler"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."uye_begeniler");
	}	

	if($_POST["cicek"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."uye_cicek");
		@mysql_query("update "._MX."uye set topcicek='0'");
	}	

	if($_POST["gelen"] == 1){
		mysql_query("delete from "._MX."uye_mesaj where yer!='2'");
		@mysql_query("update "._MX."uye set topmesaj='0'");
	}	

	if($_POST["giden"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."uye_mesaj_giden");
	}

	if($_POST["arsiv"] == 1){
		mysql_query("delete from "._MX."uye_mesaj where yer='2'");
	}

	if($_POST["gelenkutusu"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."uye_mesaj");
	}
		
	if($_POST["online"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."online");
	}
	
	if($_POST["onay"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."uye_onay");
	}
	
	if($_POST["yasakli"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."uye_yasakli");
		
	}
	
	if($_POST["opucuk"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."uye_opucuk");
		@mysql_query("update "._MX."uye set topopucuk='0'");
	}	

	if($_POST["hafta"] == 1){
	
		$hafta = date("W");
		
		$yil = date("Y");
		
		mysql_query("delete from "._MX."uye_hafta where hafta!='$hafta' and yil!='$yil'");
		
	}

	if($_POST["hit"] == 1){
	
		$ay = date("m");
		
		$yil = date("Y");
		
		mysql_query("delete from "._MX."uye_hit where ay!='$ay' or yil!='$yil'");
		
	}

	if($_POST["oy"] == 1){
	
		$ay = date("m");
		
		$yil = date("Y");
		
		mysql_query("delete from "._MX."uye_oy where ay!='$ay' or yil!='$yil'");
		
	}
			
	if($_POST["opucuk"] == 1){
		mysql_query("TRUNCATE TABLE "._MX."uye_opucuk");
	}
		
	mysql_query("TRUNCATE TABLE "._MX."uye_sil");	
}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Gereksiz Loglarý Sil | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
	function baslat(){
		
		var onaylama = confirm("Bu iþlemlerin geri dönüþü yoktur. \n\n Emin misiniz?");
		
		if(onaylama){
			
			$("#sonuc").html("<img src='img/loading.gif' /> Bekleyin ...");
			
			var anket = $("#anket:checked").val();
			var galeritalep = $("#galeritalep:checked").val();
			var gks = $("#gks:checked").val();
			var odeme1 = $("#odeme1:checked").val();
			var odeme2 = $("#odeme2:checked").val();
			var arkadas = $("#arkadas:checked").val();
			var begeniler = $("#begeniler:checked").val();
			var cicek = $("#cicek:checked").val();
			var hafta = $("#hafta:checked").val();
			var hit = $("#hit:checked").val();
			var gelen = $("#gelen:checked").val();
			var giden = $("#giden:checked").val();
			var online = $("#online:checked").val();
			var onay = $("#onay:checked").val();
			var opucuk = $("#opucuk:checked").val();
			var oy = $("#oy:checked").val();
			var yasakli = $("#yasakli:checked").val();
			var arsiv = $("#arsiv:checked").val();
			var gelenkutusu = $("#gelenkutusu:checked").val();
			
			jQuery.ajax({
				type: 'POST',
				url: 'index.php?sayfa=bakim&islem=mahirix',
				data: 'anket='+anket+'&galeritalep='+galeritalep+'&gks='+gks+'&odeme1='+odeme1+'&odeme2='+odeme2+'&arkadas='+arkadas+'&begeniler='+begeniler+'&cicek='+cicek+'&hafta='+hafta+'&hit='+hit+'&gelen='+gelen+'&giden='+giden+'&online='+online+'&onay='+onay+'&opucuk='+opucuk+'&oy='+oy+'&yasakli='+yasakli+"&arsiv="+arsiv+"&gelenkutusu="+gelenkutusu,
				success: function(sonuc){
					$("#sonuc").html("");
					alert("Gereksiz loglar baþarýyla silindi");
					document.bakimform.reset();
					
				}
			
			})
		}
	}
</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bakim.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post" name="bakimform">
		  <div class="table">

				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Gereksiz Loglarý Sil</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Anket Loglarý</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="anket" id="anket" value="1" checked /> * Gereksiz anket loglarý silinir. (ÖNERÝLÝR)</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Galeri Talepleri</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="galeritalep" id="galeritalep" value="1" /> * Tüm galeri talepleri silinir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>GKS Talepleri</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="gks" id="gks" value="1" /> * GKS talepleri onaylý onaysýz temizlenir</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Ödemeler</strong></td>
						<td class="last" style="text-align:left"> Onaylýlar <input type="checkbox" name="odeme1" id="odeme1" value="1" />  Onaysýzlar <input type="checkbox" name="odeme2" id="odeme2" value="1" />* Seçtiðiniz onaylý yada onaysýz ödemeler silinir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Online</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="online" id="online" value="1" /> * Online tablosu temizlenir</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Üye arkadaþlar</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="arkadas" id="arkadas" value="1" /> * Tüm üyelerin arkadaþ listesi temizlenir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Üye begeniler</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="begeniler" id="begeniler" value="1" /> * Tüm üyelerin begenenler listesi temizlenir</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Üye çiçekler</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="cicek" id="cicek" value="1" /> * Tüm üyelerin çiçek listesi temizlenir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Üye Hafta</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="hafta" id="hafta" value="1" checked /> * Bulunduðumuz hafta hariç diðer veriler temizlenir. (ÖNERÝLÝR)</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Üye Ýzlenme</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="hit" id="hit" value="1" checked /> * Bulunduðumuz ay hariç diðer hit verileri temizlenir. (ÖNERÝLÝR)</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Üye mesajlar (Gelen)</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="gelen" id="gelen" value="1" /> * Tüm üyelerin gelen kutusu temizlenir</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Üye mesajlar (Arþiv)</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="arsiv" id="arsiv" value="1" /> * Tüm üyelerin arþivi temizlenir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Üye mesajlar (Giden)</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="giden" id="giden" value="1" checked /> * Tüm üyelerin giden kutusu temizlenir. (ÖNERÝLÝR)</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Üye mesajlar (Tüm gelenler Arþiv + Gelen mesajlar)</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="gelenkutusu" id="gelenkutusu" value="1" /> * Tüm üyelerin mesajlar tablosu temizlenir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Üye email onay</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="onay" id="onay" value="1" /> * Eðer email onayý açýksa bu tablonun temizlenmesi gerekir.</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Üye öpücük</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="opucuk" id="opucuk" value="1" /> * Tüm üyelerin öpücük verileri temizlenir.</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Üye oy</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="oy" id="oy" value="1" checked /> * Bulunduðumuz ay hariç üyelerin oy listesi temizlenir. (ÖNERÝLÝR)</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Üye yasaklý</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="yasakli" id="yasakli" value="1" /> * Tüm üyelerin yasakli listesi temizlenir.</td>
					</tr>
					<tr>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Ýþlemi baþlat " onclick="baslat()" /> * Silinen verilere göre iþlem süresi deðiþir.<p><span id="sonuc"></span></p></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan veritabanýnda gereksiz loglarý silebilirsiniz. Ýstediðiniz doðrultusunda bir çok kayýtlý veride silinebilir. Önerilen verileri temizlemenizde fayda vardýr. Aylýk olarak bir kez bu iþlemi yapmanýz þiddetle tavsiye edilir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>