<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

if($islem == "sil"){
	
	$id = $_POST["id"];
	
	$result = mysql_query("select resim, ana from "._MX."uye_resim where id='$id' and uye='$uyeid'");
	
	list($resim, $anaresim) = mysql_fetch_row($result);
	
	if($resim){
		
		unlink("../$resim");
		
		mysql_query("delete from "._MX."uye_resim where id='$id'");
		
		mysql_query("delete fr�m "._MX."uye set topresim=topresim-1 where id='$uyeid'");
		
		
		if($anaresim == 1){
			
			list($rid, $resimurl, $durum) = mysql_fetch_row(mysql_query("select id, resim, durum from "._MX."uye_resim where uye='$uyeid' and durum='1' order by rand() limit 1"));
			
			
			if($rid){
			
			
				include("fonksiyon2.php");
				
				$uzanti = explode(".", $resimurl);
				
				$uzanti = $uzanti[1];
				
				resmikes("../$resimurl", "../img_uye/avatar/$uyeid.$uzanti");
				
				mysql_query("update "._MX."uye set img='img_uye/avatar/$uyeid.$uzanti' where id='$uyeid'");
				
				mysql_query("update "._MX."uye_resim set ana='1' where id='$rid'");
				
				die("otoyap1");

			
			}
			else {
			
				list($avatar) = mysql_fetch_row(mysql_query("select img from "._MX."uye where id='$uyeid'"));
				
				unlink("../$avatar");
				
				mysql_query("update "._MX."uye set img='img_uye/avatar/null.jpg' where id='$uyeid'");
				
				die("otoyap2");
				
			}
		
		}
		
	}

}

if($islem == "yukle"){

	$limit = seviyeal("profilresmilimit");
	
	$result = mysql_query("select count(id) from "._MX."uye_resim where uye='$uyeid'");
	
	list($count) = mysql_fetch_row($result);
	
	if($count >= $limit){
	?>
	<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('limit');</script>
	<?
	
	die();
	
	}
	
	$dosyatmp = $_FILES['resim']['tmp_name'];
	$dosyatip = $_FILES['resim']['type'];
	
	if ($dosyatip == "image/gif") $uzanti = "gif";
	if ($dosyatip == "image/jpeg") $uzanti = "jpg";
	if ($dosyatip == "image/pjpeg") $uzanti = "jpg";
	if ($dosyatip == "image/png") $uzanti = "png";
	if($uzanti == "gif" or $uzanti == "jpg" or $uzanti == "png"){

		list($genislik, $yukseklik) = getimagesize($dosyatmp);
		
		if($genislik > 400){
			$boyutlandir = 1;
		}
		
		if($yukseklik > 400){
			$boyutlandir = 1;
		}
		
		
		if(is_uploaded_file($dosyatmp)){
		
			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye_resim"));
			
			$maxid++;
			
			if(move_uploaded_file($dosyatmp, "../img_uye/resim/$maxid-$uyeid.$uzanti")){

				include("../fonksiyon2.php");
				
				if($boyutlandir == 1){
					
					
				}
				
				resmeyaz("../img_uye/resim/$maxid-$uyeid.$uzanti","../img_uye/resim/$maxid-$uyeid.$uzanti");
				
				mysql_query("insert into "._MX."uye_resim values('$maxid', '$uyeid', 'img_uye/resim/$maxid-$uyeid.$uzanti', '0', '".time()."', '2')");
				
				?>
				<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('ok');</script>
				<?
				
				die();
			}
		}
		?>
		<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('hata');</script>
		<?
	}
	else {
	?>
	<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('hata');</script>
	<?
	}
}

if($islem == "resimguncelle"){

?>
														
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td width="20" height="28">&nbsp;</td>
																		<td height="28">
																		&nbsp;</td>
																		<td width="20" height="28">&nbsp;</td>
																		<td height="28">
																		&nbsp;</td>
																		<td width="20" height="28">&nbsp;</td>
																		<td height="28">
																		&nbsp;</td>
																	</tr>
																	<tr>
																	
																	<?
																	
																	
																	
																	$result = mysql_query("select id, resim, ana, durum from "._MX."uye_resim where uye='$uyeid'");
																	
																	$i = 1;
																	
																	while(list($id, $resim, $ana, $durum) = mysql_fetch_row($result)){
																	
																	
																	if($ana == 1){
																		$buton = '<img border="0" src="img/anaresim_tik.gif" width="80" height="15">';
																	}
																	else {
																		$buton = '<a href="javascript:void(0)" onclick="anaresim(\'index.php?sayfa=profil_resim&islem=anaresim&id='.$id.'\', '.$durum.')"><img border="0" src="img/btn_anarsimyap.gif" width="93" height="22"></a>';
																	}
																	
																	if($durum == 1){
																		$durum = NULL;
																	}
																	else {
																		$durum = "<font color=red size=2><b>Onay Bekliyor</b></font>";
																	}
																	?>
																	
																	
																		<td valign="top">
																		
																<table id="resimtablo<?=$id?>" border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/urn_penc_ust.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td background="img/urn_penc_bg.gif" align="center">
																		<a href="<?=$resim?>" class="resimlink"><img border="0" src="<?=$resim?>" width="80" height="100"></a></td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/urn_penc_alt.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td height="3" align="center">
																		<?=$durum?>
																		</td>
																	</tr>
																	<tr>
																		<td align="center" height="22">
																		<?=$buton?></td>
																	</tr>
																	<tr>
																		<td align="center" height="22">
																		<a href="javascript:sil(<?=$id?>)" title="Sil"><img border="0" src="img/btn_silresmi.gif" width="93" height="22"></a></td>
																	</tr>
																	</table>
	
																	
																		</td>
																		<td width="20">&nbsp;</td>
																		
																	
																	<?
																	
																	if($i % 4 == 0) echo '</tr>
																		<tr>
																			<td height="7">
																			</td>
																		</tr>
																	<tr>';
																	$i++;
																	
																	} // while
																	?>
																	
																	</tr>
																</table>

<?
}
?>