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
	
	$result = mysql_query("select resim from "._MX."galeri_resim where id='$id'");
	
	list($resim) = mysql_fetch_row($result);
	
	if($resim){
		
		unlink("../$resim");
		
		mysql_query("delete from "._MX."galeri_resim where id='$id'");
		
	
	}

}

if($islem == "yukle"){

	
	$galeri = $_SESSION["galeriid"];
	
	list($galeri, $durum) = explode(";", $galeri);

	if(!is_numeric($galeri)){
			?>
			<script language="javascript" type="text/javascript">window.top.window.resimyuklesonuc('hata1');</script>
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


	
		if($durum == "mahirix"){
		
				list($uye) = mysql_fetch_row(mysql_query("select uye from "._MX."galeri where id='$galeri'"));
				
				if($uye){
					
					list($maxgaleriid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."galeri"));
					
					$galeri = $maxgaleriid + 1;
					
					mysql_query("insert into "._MX."galeri values('$galeri', '$uyeid', NULL, '1', '".time()."', '2')");
					
					$_SESSION["galeriid"] = $galeri .";eklendi";
					
					$_SESSION["galerieklendi"] = "evet";
					
					mkdir("../img_uye/galeri/$galeri", 0777);
					
				}
				else {
				
					mysql_query("insert into "._MX."galeri values('$galeri', '$uyeid', NULL, '1', '".time()."', '2')");
					
					$_SESSION["galeriid"] = $galeri .";eklendi";
					
					$_SESSION["galerieklendi"] = "evet";
					
					mkdir("../img_uye/galeri/$galeri", 0777);
					
				}
	
		}		
		
		
		if(is_uploaded_file($dosyatmp)){
		
			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."galeri_resim"));
			
			$maxid++;
			
			if(move_uploaded_file($dosyatmp, "../img_uye/galeri/$galeri/$maxid.$uzanti")){

				include("../fonksiyon2.php");
				
				if($uzanti == "png"){
					
					@png2jpg("../img_uye/resim/$maxid-$uyeid.$uzanti", "../img_uye/resim/$maxid-$uyeid.jpg");
					
					$uzanti = "jpg";
				}
				
				resmeyaz("../img_uye/galeri/$galeri/$maxid.$uzanti","../img_uye/galeri/$galeri/$maxid.$uzanti");
				
				mysql_query("insert into "._MX."galeri_resim values('$maxid', '$galeri', 'img_uye/galeri/$galeri/$maxid.$uzanti', '2')");
				
				
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

if($islem == "galerisil"){

	$galeri = $_POST["id"];
	
	$result = mysql_query("select id, resim from "._MX."galeri_resim where galeri='$galeri'");
	
	while(list($id, $resim) = mysql_fetch_row($result)){
	
		@unlink("../$resim");
		
		mysql_query("delete from "._MX."galeri_resim where id='$id'");
	}
	
	@rmdir("../img_uye/galeri/$galeri");
	
	list($thumb, $durum) = mysql_fetch_row(mysql_query("select resim, durum from "._MX."galeri where id='$galeri'"));
	
	@unlink("../$thumb");
	
	mysql_query("delete from "._MX."galeri where id='$galeri'");
	
	mysql_query("delete from "._MX."galeri_talep where galeri='$galeri'");
	
	if($durum == 1){
		mysql_query("update "._MX."uye set topgaleri=topgaleri-1 where id='$uyeid'");
	}
	
	die("ok");

}

if($islem == "resimguncelle"){

	$galeri = $_POST["galeri"];
	
?>
																		<td align="center">
														<table border="0" id="table452" cellspacing="0" cellpadding="0">
															<tr>
															<?
																
																$result = mysql_query("select id, resim, durum from "._MX."galeri_resim where galeri='$galeri'");
																$i = 1;
																
																while(list($resid, $resim, $durum) = mysql_fetch_row($result)){
																
															?>
																<td valign="top">
																<table id="resimtablo<?=$resid?>" border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/urn_penc_ust.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td background="img/urn_penc_bg.gif" align="center">
																		<img border="0" src="<?=$resim?>" width="80" height="100"></td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/urn_penc_alt.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td height="6">
																		</td>
																	</tr>
																	<tr>
																		<td align="center">
																		<a href="javascript:void(0)" onclick="sil(<?=$resid?>)"><img border="0" src="img/btn_sil.gif" width="35" height="28"></a></td>
																	</tr>
																</table>
																</td>
																<td width="25">&nbsp;</td>
															<?
																	if($i%4 == 0){
																	?>
															</tr>
															<tr>
																<td valign="top">
																&nbsp;</td>
																<td width="25">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
																<td width="25">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
																<td width="25">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
															</tr>
															<tr>
																	<?
																	}
																$i++;
																
																}
															?>
															</tr>
															</table>
																		</td>
<?
}
?>