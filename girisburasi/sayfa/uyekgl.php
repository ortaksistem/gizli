<?php
function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}

	$islem = $_GET["islem"];

if($islem == "onayla"){
		$id = $_POST["id"];
		$result = mysql_query("update "._MX."uye set durum='1' where id='$id'");
		if($result) die("ok");
		else die("hata");
}
else {

	
	$limit = 20; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>KGL �yeleri | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function sayfa(sayfa){
	
	window.location = 'index.php?sayfa=uyekgl&p='+sayfa;
}

function onayla(uye){
	if(onayla){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=uyesilinen&islem=onayla',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					$("#uyesonuc"+uye+"").hide("slow");
				}
				else {
					alert("�ye onaylanamad� tekrar deneyiniz");
				}
			}
		})
	}
}
</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/uye.php"); ?>
		<div id="center-column">
		  
			<div class="table" id="uyeyukle">
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Kullan�c� Ad�</th>
						<th>Cinsiyet</th>
						<th>Email</th>
						<th>Seviye</th>
						<th>Kay�t</th>
						<th>Son Giri�</th>
						<th class="last">��lem</th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?
					
						$adminseviye = adminseviye();
						
						$p = $_GET["p"];
						if(!$p) $p = 1;
						$p = intval($p);
						
						$result = mysql_query("select id from "._MX."uye where kgl='1'");
						$sayi = mysql_num_rows($result);
						$toplamsayfa = ceil(($sayi/$limit));
						
						$resultseviye = mysql_query("select id, ad, renk from "._MX."seviye");
						
						while($rowla = mysql_fetch_array($resultseviye)){
							
							$seviyemiz[$rowla["id"]]["ad"] = $rowla["ad"];
							$seviyemiz[$rowla["id"]]["renk"] = $rowla["renk"];
						}
						
						$result = mysql_query("select id, kullanici, email, cinsiyet, satissatis, sononline, ip, kayit, seviye from "._MX."uye where kgl='1' order by id desc limit ".(($p-1)*$limit).",".$limit."");

						while(list($id, $kullanici, $email, $cinsiyet, $satissatis, $sononline, $ip, $kayit, $seviye) = mysql_fetch_row($result)){
						
						$cinsiyet = cinsiyet($cinsiyet);
						
						$kayit = date("d.m.Y", $kayit);
						
						$sononline = date("d.m.Y", $sononline);
						
						$seviyead = $seviyemiz[$seviye]["ad"];
						$seviyerenk = $seviyemiz[$seviye]["renk"];
						
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
						<td><?=$sononline?></td>
						<td class="last">
						<a href="javascript:void(0)" onclick="onayla(<?=$id?>)" title="�yeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a>
						
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
						<td><?=$sononline?></td>
						<td class="last">
						<a href="javascript:void(0)" onclick="onayla(<?=$id?>)" title="�yeyi Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a>
						
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
						<select name="sayfalar" id="sayfalar" class="selectler" onChange="sayfa(this.value)">
							<? 
							for($i = 1; $i<=$toplamsayfa; $i++) {
							if($i == $p) echo "<option value=$i selected>$i. Sayfa</option>"; 
							else echo "<option value=$i>$i. Sayfa</option>";
							}
							?>
						</select>
					</div>
				</div>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Burada KGL �yelerini listeleyebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>