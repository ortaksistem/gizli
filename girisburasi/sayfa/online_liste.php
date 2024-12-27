<?

$islem = $_GET["islem"];

function gunadine($param){
	$array = array("", "Pazartesi", "Salý", "Çarþamba", "Perþembe", "Cuma", "Cumartesi", "Pazar");
	return $array[$param];
}

if($islem == "kaydet"){
	
	$nickler = turkce($_POST["nickler"]);
	$gun = $_POST["gun"];

	if(!is_numeric($gun)) die("Gün seçin");
	
	$nickler = explode(",", $nickler);
	
	$i = 0;
	
	foreach($nickler as $nick){
		
		$nick = trim($nick);
		
		if($nick){
			
			
			list($id, $cinsiyet) = @mysql_fetch_row(@mysql_query("select id, cinsiyet from "._MX."uye where kullanici='$nick'"));
			
			if(is_numeric($id)){
								
				$bak = @mysql_query("select id from "._MX."online_liste where gun='$gun' and uye='$id'");
				
				if(@mysql_num_rows($bak) < 1){
					
					
					$result = @mysql_query("insert into "._MX."online_liste values(NULL, '$id', '$nick', '$cinsiyet', '$gun')");
					
					if($result){
						
						$i++;
						
					}
					
					
				}
				
			}
			
			
		}
		
	}
	
	echo $i ." adet uye eklendi. Sayfayi yenileyin altta listelensin";

			
} else if($islem == "sil"){
	
	$id = $_POST["id"];
	
	if(!is_numeric($id)) die("hata");
	
	$result = @mysql_query("delete from "._MX."online_liste where id='$id'");
	
	if($result) die("ok");
	else die("hata");
	
}
else {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Online Yap | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
		
		function kaydetaga(){
			
			$("#sonuc").html("Lütfen bekleyin.");
			
			$.post("index.php?sayfa=online_liste&islem=kaydet", $("form[name=onlinelisteform]").serialize(), function(sonuc){
				$("#sonuc").html(sonuc);
			})

		}	
		function silusagim(id){
			$.post("index.php?sayfa=online_liste&islem=sil", "id="+id, function(sonuc){
				if(sonuc == "ok"){
					$("#span"+id).hide();
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
						<th class="full" colspan="2">Online Listesi Oluþtur</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Kullanýcý Adlarý</strong></td>
						<td class="last">
						<textarea name="nickler" rows="6" cols="45" class="text"></textarea><br />

						Tam nicki yazýnýz. Virgül ile ayýrýnýz !</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Haftanýn Günleri</strong></td>
						<td class="last">
						<input type="radio" name="gun" value="1"> Pazartesi<br />
						<input type="radio" name="gun" value="2"> Salý<br />
						<input type="radio" name="gun" value="3"> Çarþamba<br />
						<input type="radio" name="gun" value="4"> Perþembe<br />
						<input type="radio" name="gun" value="5"> Cuma<br />
						<input type="radio" name="gun" value="6"> Cumartesi<br />
						<input type="radio" name="gun" value="7"> Pazar<br />
						Hangi gün online olacaksa seçiniz.</td>
					</tr>
					<tr>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " onclick="kaydetaga()" /> <span id="sonuc"></span></td>
					</tr>
				</table>
		  </div>
		</form>
			<div class="table">
					<table class="listing" cellpadding="0" cellspacing="0">
						<tr>
							<th class="first" width="177">Günler</th>
							<th class="last">Üyeler</th>
						</tr>
						<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
						<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						
						<?php
							
							for($i = 1; $i<=7; $i++){
							
							?>
							<tr>
								<td class="first style1"><?=gunadine($i);?></td>
								<td class="last">
							<?php
							
								$result = @mysql_query("select id, uye, uyeadi, cinsiyet from "._MX."online_liste where gun='$i'");
								
								while(list($id, $uye, $uyeadi, $cinsiyet) = @mysql_fetch_row($result)){
									
									?>
						

							<span id="span<?=$id?>">(<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><font color="black"><?=$uyeadi?></font></a> <?=cinsiyet($cinsiyet);?> <a href="javascript:void(0)" onclick="silusagim(<?=$id?>)" title="Sil">Sil</a>)</span>		
									<?php
									
								}
								?>
									</td>
								</tr>
								<?php
								
							}
							
						
						?>
						
					</table>
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Önergelere dikkat edin.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>