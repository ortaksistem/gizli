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
	<title>Gereksiz Loglar� Sil | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
	function baslat(){
		
		var onaylama = confirm("Bu i�lemlerin geri d�n��� yoktur. \n\n Emin misiniz?");
		
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
					alert("Gereksiz loglar ba�ar�yla silindi");
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
						<th class="full" colspan="2">Gereksiz Loglar� Sil</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Anket Loglar�</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="anket" id="anket" value="1" checked /> * Gereksiz anket loglar� silinir. (�NER�L�R)</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Galeri Talepleri</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="galeritalep" id="galeritalep" value="1" /> * T�m galeri talepleri silinir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>GKS Talepleri</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="gks" id="gks" value="1" /> * GKS talepleri onayl� onays�z temizlenir</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>�demeler</strong></td>
						<td class="last" style="text-align:left"> Onayl�lar <input type="checkbox" name="odeme1" id="odeme1" value="1" />  Onays�zlar <input type="checkbox" name="odeme2" id="odeme2" value="1" />* Se�ti�iniz onayl� yada onays�z �demeler silinir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Online</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="online" id="online" value="1" /> * Online tablosu temizlenir</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>�ye arkada�lar</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="arkadas" id="arkadas" value="1" /> * T�m �yelerin arkada� listesi temizlenir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>�ye begeniler</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="begeniler" id="begeniler" value="1" /> * T�m �yelerin begenenler listesi temizlenir</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>�ye �i�ekler</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="cicek" id="cicek" value="1" /> * T�m �yelerin �i�ek listesi temizlenir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>�ye Hafta</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="hafta" id="hafta" value="1" checked /> * Bulundu�umuz hafta hari� di�er veriler temizlenir. (�NER�L�R)</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>�ye �zlenme</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="hit" id="hit" value="1" checked /> * Bulundu�umuz ay hari� di�er hit verileri temizlenir. (�NER�L�R)</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>�ye mesajlar (Gelen)</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="gelen" id="gelen" value="1" /> * T�m �yelerin gelen kutusu temizlenir</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>�ye mesajlar (Ar�iv)</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="arsiv" id="arsiv" value="1" /> * T�m �yelerin ar�ivi temizlenir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>�ye mesajlar (Giden)</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="giden" id="giden" value="1" checked /> * T�m �yelerin giden kutusu temizlenir. (�NER�L�R)</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>�ye mesajlar (T�m gelenler Ar�iv + Gelen mesajlar)</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="gelenkutusu" id="gelenkutusu" value="1" /> * T�m �yelerin mesajlar tablosu temizlenir</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>�ye email onay</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="onay" id="onay" value="1" /> * E�er email onay� a��ksa bu tablonun temizlenmesi gerekir.</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>�ye �p�c�k</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="opucuk" id="opucuk" value="1" /> * T�m �yelerin �p�c�k verileri temizlenir.</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>�ye oy</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="oy" id="oy" value="1" checked /> * Bulundu�umuz ay hari� �yelerin oy listesi temizlenir. (�NER�L�R)</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>�ye yasakl�</strong></td>
						<td class="last" style="text-align:left"><input type="checkbox" name="yasakli" id="yasakli" value="1" /> * T�m �yelerin yasakli listesi temizlenir.</td>
					</tr>
					<tr>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" ��lemi ba�lat " onclick="baslat()" /> * Silinen verilere g�re i�lem s�resi de�i�ir.<p><span id="sonuc"></span></p></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan veritaban�nda gereksiz loglar� silebilirsiniz. �stedi�iniz do�rultusunda bir �ok kay�tl� veride silinebilir. �nerilen verileri temizlemenizde fayda vard�r. Ayl�k olarak bir kez bu i�lemi yapman�z �iddetle tavsiye edilir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>