<?

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	$saat = $_POST["saat"];
	$bayan = $_POST["bayan"];
	$cift = $_POST["cift"];
	$erkek = $_POST["erkek"];
	$sure = $_POST["sure"];
	
	
	$warmi = @mysql_query("select id from "._MX."online_liste_sure where saat='$saat'");
	
	if(@mysql_num_rows($warmi) >= 1) die("Bu saat �nceden eklenmi�. �nce onu silin !");
	
	
	$result = @mysql_query("insert into "._MX."online_liste_sure values(NULL, '$saat', '$bayan', '$cift', '$erkek', '$sure', '0')");
	
	if($result) die("Ekleme basarili. Sayfay� yenile");
	else die("Bir hata meydana geldi");

			
} else if($islem == "sil"){
	
	$id = $_POST["id"];
	
	if(!is_numeric($id)) die("hata");
	
	$result = @mysql_query("delete from "._MX."online_liste_sure where id='$id'");
	
	if($result) die("ok");
	else die("hata");
	
}
else {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Online listesi say� | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
		
		function kaydetaga(){
			
			$("#sonuc").html("L�tfen bekleyin.");
			
			$.post("index.php?sayfa=online_liste_sayi&islem=kaydet", $("form[name=onlinelisteform]").serialize(), function(sonuc){
				$("#sonuc").html(sonuc);
			})

		}	
		function silusagim(id){
			$.post("index.php?sayfa=online_liste_sayi&islem=sil", "id="+id, function(sonuc){
				if(sonuc == "ok"){
					$("#sayi"+id).hide();
				} else {
					alert("Silinemedi !");
				}
			})		
		}
	</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bot.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post" name="onlinelisteform">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Online Listesi Say� Olu�tur</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Hangi Saat</strong></td>
						<td class="last">
						<select name="saat" style="width:100px" class="text">
						<?php
							for($i=0;$i<=23;$i++) echo "<option value=$i>$i</option>";
						?>
						</select>
						<br />

						�yenin eklenece�i saat dilimi ! SUNUCU SAAT� : <?=date("G");?></td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Bayan say�s�</strong></td>
						<td class="last">
						<input type="text" name="bayan" class="text" style="width:50px" /> * Eklenecek bayan �ye say�s� !</td>
					</tr>
										<tr>
						<td class="first" width="172"><strong>�ift say�s�</strong></td>
						<td class="last">
						<input type="text" name="cift" class="text" style="width:50px" /> * Eklenecek �ift �ye say�s� !</td>
					</tr>
										<tr class="bg">
						<td class="first" width="172"><strong>Erkek say�s�</strong></td>
						<td class="last">
						<input type="text" name="erkek" class="text" style="width:50px" /> * Eklenecek erkek �ye say�s� !</td>
					</tr>
										<tr>
						<td class="first" width="172"><strong>Online s�resi</strong></td>
						<td class="last">
						<input type="text" name="sure" class="text" style="width:50px" value="120" /> * Online kalma s�resi !</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " onclick="kaydetaga()" /> <span id="sonuc"></span></td>
					</tr>
				</table>
		  </div>
		</form>
			<div class="table">
					<table class="listing" cellpadding="0" cellspacing="0">
						<tr>
							<th class="first" width="177">Saat</th>
							<th>Adet</th>
							<th class="last">��lem</th>
						</tr>
						<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
						<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						
						<?php
							
							$result = @mysql_query("select id, saat, bayan, cift, erkek, sure from "._MX."online_liste_sure order by saat asc");
							
							while(list($id, $saat, $bayan, $cift, $erkek, $sure)= @mysql_fetch_row($result)){
								
								
								
								
								
							
						
						?>
							<tr id="sayi<?=$id?>">
								<td class="first style1"><?=$saat?></td>
								<td class="style1">
								Bayan : <b><?=$bayan?></b> 
								�ift : <b><?=$cift?></b> 
								Erkek : <b><?=$erkek?></b> 
								S�re : <b><?=$sure?></b> 
								</td>
								<td class="last"><a href="javascript:void(0)" onclick="silusagim(<?=$id?>)" title="Sil">Sil</a></td>
							</tr>
								<?php
								
							}
							
						
						?>
						
					</table>
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">�nergelere dikkat edin.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>