<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Tüm Satışlar | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
	function sayfa(sayfa){
		
		window.location = 'index.php?sayfa=satislargenel&p='+sayfa;
		
	}
</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/satislar.php"); ?>
		<div id="center-column">
			<div class="table">
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="100">Kullanıcı Adı</th>
						<th>Bilgiler</th>
						<th>Üyelik Tipi</th>
						<th>Süre</th>
						<th>Tutar</th>
						<th>Tip</th>
						<th>Durum</th>
						<th class="last">Kayıt</th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?
					
						$limit = 20;
						
						$p = $_GET["p"];
						
						if(!$p) $p = 1;
						
						$p = intval($p);
						
						$result = mysql_query("select count(id) from "._MX."odeme");
						
						list($sayi) = mysql_fetch_row($result);
						
						$toplamsayfa = ceil(($sayi/$limit));
						
						$toplam = 0;

						$result = mysql_query("select id, uye, tur, ad, tel, mesaj, email, ip, tutar, seviye, sure, kayit, durum from "._MX."odeme order by id desc limit ".(($p-1)*$limit).",".$limit."");

						while(list($id, $uye, $tur, $ad, $tel, $mesaj, $email, $ip, $tutar, $seviye, $sure, $kayit, $durum) = mysql_fetch_row($result)){
						
						
						list($uyead) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$uye'"));
						
						list($seviyead, $seviyerenk) = mysql_fetch_row(mysql_query("select ad, renk from "._MX."seviye where id='$seviye'"));
						
						$kayit = date("d.m.Y", $kayit);
						
						switch($sure){
							case "aylik": $sure="1 Aylık";break;
							case "aylik3": $sure="3 Aylık";break;
							case "aylik6": $sure="6 Aylık";break;
							case "yillik": $sure="Yıllık";break;
							case "sinirsiz": $sure="Sınırsız";break;
							default: $sure="Belirlenemedi";break;
						}
						
						if($tur == 1) $tur = "K.Kartı";
						else $tur = "Havale";
						
						if($durum == 1) $durum = "<font color=green>Onaylı</font>";
						else $durum = "<font color=red>Bekliyor</font>";
						
							
						$toplam = $tutar + $toplam;
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><font color="<?=$seviyerenk?>"><?=$uyead?></font></a> </td>
						<td>Ad : <?=$ad?><br>Tel : <?=$tel?><br>Email : <?=$email?><br>Ip : <?=$ip?></td>
						<td><font color="<?=$seviyerenk?>"><?=$seviyead?></font></td>
						<td><?=$sure?></td>
						<td><?=$tutar?> TL</td>
						<td><?=$tur?></td>
						<td><?=$durum?></td>
						<td class="last">
						<?=$kayit?>
						</td>
					</tr>
					
					<?
						}
					?>
					</div>
				</table>
			</div>
				<div class="table">
				Sayfa Toplamı : <strong><?=$toplam?> TL</strong>
					<div class="select">
						<strong>Sayfalar : </strong>
						<select name="sayfalar" id="sayfalar" class="selectler" onChange="sayfa(this.value)">
							<? 
							for($i = 1; $i<=$toplamsayfa; $i++) {
							if($p == $i) echo "<option value=$i selected>$i. Sayfa</option>"; 
							else echo "<option value=$i>$i. Sayfa</option>"; 
							}
							?>
						</select>
					</div>
				</div>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Kredi karti satışları bu bölümde yer almaktadır. Onaylanan satışlar bulunur. Hatalı satışlar gereksiz yere tabloya işletilmez.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
