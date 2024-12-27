<?

$islem = $_GET["islem"];

if($islem == "bosalt"){
	
	$result = @mysql_query("TRUNCATE TABLE mailler");
	
	die("ok");
}
else if($islem == "bitir"){
	
	$kacinci = $_POST["kacinci"];
	
	$result = mysql_query("update "._MX."ayarlar2 set soncekilen='$kacinci'");
	
	die("ok");
	
}
else if($islem == "cek"){
	
	$kacinci = $_POST["kacinci"];
	
	list($email, $kullanici, $sifre) = mysql_fetch_row(mysql_query("select email, kullanici, sifre from "._MX."uye where id='$kacinci'"));
	
	if($email and $kullanici and $sifre){

				require('../msnTest/msnImportClass/msn.class.php');
				$msn = new MSN('', false);
				$ListeArray = array();
				
				if (!$msn->connect($email, $sifre)) {
					echo "MSN network baðlantýsý saðlanamadý.\n";
					echo "$msn->error\n";
				} else {
					$aContactList = $msn->getMembershipList();
					
					foreach ($aContactList as $u_domain => $aUserList)
					{
						foreach ($aUserList as $u_name => $aNetworks)
						{
							$toAddr = $u_name.'@'.$u_domain;
							array_push($ListeArray, $toAddr);
						}
					}
					
					if(count($ListeArray)<=0)
					{
						echo "Kiþi bulunamadý";
					} else {
					
						
						$done = 1;
						echo "toplam kiþi = ".count($ListeArray)."<br /><br />";
						Foreach($ListeArray as $ePosta)
						{

							
							@mysql_query("insert into mailler values(NULL, '$kacinci', '$kullanici', '$email', '$ePosta', '0')");
							
							
							
						}
					}
				}

	}
	$result = mysql_query("update "._MX."ayarlar2 set soncekilen='$kacinci'");
	die("ok");

}
else {

						
list($soncekilen) = mysql_fetch_row(mysql_query("select soncekilen from "._MX."ayarlar2"));
list($sonuncu) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
list($mail) = mysql_fetch_row(mysql_query("select count(id) from mailler where durum!='1'"));
$kalan = $sonuncu - $soncekilen;
					

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Emailleri Cek | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
	function bosalt(){
	
		$("#durum").html("<font color=green size=2><b>Bekleyin</b></font>");
				
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=emailcek&islem=bosalt',
					data : "gonder=ok",
					success: function(sonuc){		
						$("#durum").html("<font color=green size=2><b>Tablo Boþaltýldý</b></font>");
					}
				})
	}
	
	var i = <?=$soncekilen?>;
	
	var son = <?=$sonuncu?>;
	
	
		function calistir(){
				
			
			if(i < son){
			
			$("#durum").html("<font color=green size=2>Uye "+i+" cekiliyor</font>");
			
					
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=emailcek&islem=cek',
				data: "kacinci="+i,
				success: function(sonuc){
					i = i + 1;
					calistir();
				}
			
			})
			
			}
			else {
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=emailcek&islem=bitir',
					data: "kacinci="+i,
					success: function(sonuc){
						
					}
				
				})
				$("#sonuc").html("<font color=green size=2>Islem tamamlandi</font>");
			
			}
		
		}
</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bot.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post" name="bakimform">
		  <div class="table">

				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Mail Gönder</th>
					</tr>
					<tr>
						<td class="first"><strong>Ýþlem Butonlarý</strong></td>
						<td class="last">
						<input type="submit" value=" Tabloyu Boþalt " onclick="bosalt()" /> 
						<input type="submit" value=" Çekmeye Baþla " onclick="calistir()" /> <span id="durum"></span></td>
					</tr>
					<tr>
						<td class="first"><strong>Durum ve Ýstatistik</strong></td>
						<td class="last" id="islem">
						<b>Son Çekilen Üye id : </b><?=$soncekilen?> <br />
						<b>Son Uye id : </b><?=$sonuncu?> <br />
						<b>Çekilecek: </b><?=$kalan?> <br />
						<b>Atýlacak Mail Sayýsý: </b><?=$mail?> <br />
						</td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan kullanýcý email adreslerini çekebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>