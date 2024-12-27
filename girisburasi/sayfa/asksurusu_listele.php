<?

function gunler($param, $param2){

	$gunler = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	$gunler2 = array("Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi", "Pazar");
	
		
		$adet = count($gunler);
		
		for($i = 0; $i < $adet; $i++){
			$gun = $gunler[$i];
			$gun2 = $gunler2[$i];
			if($param == $gun){
				$gunumuz = $gun2;
			}
		}
		
	return $gunumuz;
}

$islem = $_GET["islem"];

if($islem == "sil"){
	
	
	$id = $_GET["id"];
	
	mysql_query("delete from "._MX."anket where id='$id'");
	
	mysql_query("delete from "._MX."anket_log where anket='$id'");
	
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Aşk Sürüşü Listele | <? echo _AD; ?></title>
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
	

		<div id="center-column">
			<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="350">Anket Başlığı</th>
						<th>Hangi Gün</th>
						<th>Kayıt</th>
						<th>Toplam Oylanma</th>
						<th class="last">İşlem</th>
					</tr>
				
					<?
					
						
						$result = mysql_query("select id, soru, toplam, gun, kayit from "._MX."anket order by id asc");
						
						while(list($id, $soru, $toplam, $gun, $kayit) = mysql_fetch_row($result)){
						
						$soru = stripslashes($soru);
						
						$kayit = date("d.m.Y H:i", $kayit);
						
						$gun = gunler($gun, NULL);
					?>
					<tr id="paylas<?=$id?>">
						<td class="first style1" width="200"><?=$soru?></td>
						<td><?=$gun?></td>
						<td><?=$kayit?></td>
						<td><?=$toplam?></td>
						<td class="last">
						<a href="index.php?sayfa=asksurusu&islem=duzenle&id=<?=$id?>" title="Düzenle"><img src="img/edit-icon.gif" width="16" height="16" /></a>
						<a href="index.php?sayfa=asksurusu_listele&islem=sil&id=<?=$id?>" title="Sil" onclick="return confirm('Silmek istediğinizden Emin Misiniz?')"><img src="img/hr.gif" width="16" height="16" /></a>
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
			<div class="box">Aşk sürüşü içeriğini ekleyebilirsiniz, düzenleyebilir, silebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
