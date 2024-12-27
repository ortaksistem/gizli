<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$galeri = $_GET["id"];

if(!is_numeric($id)) die();

list($sahibi) = mysql_fetch_row(mysql_query("select uye from "._MX."galeri where id='$galeri'"));

if($sahibi != $uyeid){

$result = mysql_query("select talepedilen, durum from "._MX."galeri_talep where talepeden='$uyeid' and galeri='$galeri'");

list($sahip, $durum) = mysql_fetch_row($result);

	if($durum != 1){
	
		echo "<p align=center><font size=3 color=red><b>Bu galeriyi görüntüleme yetkiniz bulunmamaktadýr. (Talep göndermiþ iseniz beklemede, silinmiþ yada reddedilmiþ olabilir).</b></font></p>";
	
		die();
	}

}

list($sahipad) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$sahibi'"));

$result = mysql_query("select hit, kayit from "._MX."galeri where id='$galeri'");

list($hit, $kayit) = mysql_fetch_row($result);

mysql_query("update "._MX."galeri set hit=hit+1 where id='$galeri'");

$kayit = tarihdon($kayit);
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Galeri <?=$id?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link type='text/css' href='inc/basic.css' rel='stylesheet' media='screen' />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
  <link rel="stylesheet" type="text/css" href="inc/jquery.ad-gallery.css">
  <script type="text/javascript" src="inc/jquery.ad-gallery.js?rand=995"></script>
  <script type="text/javascript">
  $(function() {
    var galleries = $('.ad-gallery').adGallery();
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
  });
  
	function yoneticiyebildir(uye){

			
			mahirixpencere("Yöneticiye bildirin", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=yoneticiyebildir',
				data : "uye="+uye+"&uyeadi=<?=$uyeadi?>",
				success: function(sonuc){		
					mahirixpencereguncelle(sonuc);
				}
			})
			

		
	
	}

	function yoneticiyebildiruygula(uye){
		
		var gonderen = <?=$uyeid?>;
				
		var konu = document.getElementById("konu").value;
		var mesaj = document.getElementById("mesaj").value;
		
		if(konu == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Konuyu yazýn</b></font>");
		}
		else if(mesaj == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Mesajý Yazýn</b></font>");
		}
		else {
			$("#mesajgondersonuc").html("<img src='img/loading.gif' /> Bekleyin");

			jQuery.ajax({
				type : 'POST',
				url : 'inc/yoneticiyebildir.php',
				data : "yer=galeri&gonderen="+gonderen+"&gonderilen="+uye+"&mesaj="+mesaj+"&konu="+konu,
				success: function(sonuc){		
					if(sonuc == "ok"){
						mahirixpencereguncelle("<p align=center><font color=green><b>Bildiriminiz gönderilmiþtir. En kýsa zamanda ilgilenilecektir. Teþekkür ederiz.</b></font>");
					}
					else {
						$("#mesajgondersonuc").html("<font color=red><b>Mesajýnýz þuan gönderilemiyor, lütfen sonra tekrar deneyiniz</b></font>");
					}
				}
			})
				
		}
	
	}
  </script>

  <style type="text/css">
  #gallery {
    padding: 0px;
  }
  </style>
</head>
<body>
<div id="mahirix-modal-content">
	<div id="mahirix-model-header">
		<div id="mahirix-model-title"></div>
		<div id="mahirix-model-title-kapat"><a href="javascript:void(0)" onclick="mahirixmodelkapat();" title="Kapat"><img src="img/mahirix_alert_kapat.png" border="0" /></a></div>
	</div>
	<div style="clear:both;"></div>
	<div id="mahirix-model-icc"></div>
	<div id="mahirix-model-alt"></div>
</div>
<table border="0" id="table5" cellspacing="0" cellpadding="0">
	<tr>
		<td width="20">&nbsp;</td>
		<td width="540">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="540" valign="top">
										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
															<tr>
																<td>
														<p class="tit_1_beyaz">
														Galer ID : <?=$galeri?></td>
																<td width="160" align="right">
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td>
																		<p class="not2_byz">
																		<b>
																		<a class="not2_byz" href="javascript:void(0)" onclick="yoneticiyebildir(<?=$sahip?>)">
																		<u>
																		<span style="font-size: 9pt">Yöneticiye 
																		Bildir</span></u></a></b></td>
																		<td width="8">&nbsp;</td>
																		<td>
																		<img border="0" src="img/iko_yonetici_bildir.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
														</table>
														</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table525" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
														<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
															<tr>
																<td width="8" valign="top">
																<img border="0" src="img/galeripop_golge_sol.gif" width="8" height="51"></td>
																<td background="img/galeripop_golge.gif" align="center" valign="top">
																<div align="center">
																	<table border="0" style="border-collapse: collapse" cellpadding="0">
																		<tr>
																			<td>
																			<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																				<tr>
																					<td width="34">
																			<img border="0" src="img/iko_adam.gif" width="28" height="28"></td>
																					<td>
																			<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																				<tr>
																					<td>
																					<p class="form_txt">gönderen:</td>
																				</tr>
																				<tr>
																					<td>
																					<p class="nickname"><?=$sahipad?></td>
																				</tr>
																			</table>
																					</td>
																				</tr>
																			</table>
																			</td>
																			<td width="12" height="50">&nbsp;</td>
																			<td width="1" height="50" bgcolor="#F0F0F0">
				<img border="0" src="img/1px.gif" width="1" height="1"></td>
																			<td width="12" height="50">&nbsp;</td>
																			<td>
																			<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																				<tr>
																					<td width="36">
																			<img border="0" src="img/iko_saat.gif" width="28" height="28"></td>
																					<td>
																			<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																				<tr>
																					<td>
																					<p class="form_txt">oluþturma tarihi:</td>
																				</tr>
																				<tr>
																					<td>
																					<p class="merkez_shop"><?=$kayit?></td>
																				</tr>
																			</table>
																					</td>
																				</tr>
																			</table>
																			</td>
																			<td width="12" valign="top">&nbsp;</td>
																			<td width="1" valign="top" bgcolor="#F0F0F0">
				<img border="0" src="img/1px.gif" width="1" height="1"></td>
																			<td width="12" valign="top">&nbsp;</td>
																			<td>
																			<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																				<tr>
																					<td width="34">
																			<img border="0" src="img/iko_yildiz.gif" width="28" height="28"></td>
																					<td>
																			<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																				<tr>
																					<td>
																					<p class="form_txt">açýldýðýndan beri:</td>
																				</tr>
																				<tr>
																					<td>
																					<p class="merkez_shop"><?=$hit?> kez ziyaret edildi</td>
																				</tr>
																			</table>
																					</td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																	</table>
																</div>
																</td>
																<td width="8">
																<img border="0" src="img/galeripop_golge_sag.gif" width="8" height="51"></td>
															</tr>
														</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="6"></td>
																	</tr>
																	<tr>
																	<!-- kodlar buraya -->
   <div id="gallery" class="ad-gallery">
      <div class="ad-image-wrapper">
      </div>
      <div class="ad-controls">
      </div>
      <div class="ad-nav">
        <div class="ad-thumbs">
          <ul class="ad-thumb-list">
          
			<?php
				
				$result = mysql_query("select resim from "._MX."galeri_resim where galeri='$galeri' order by id desc");
				
				$i = 1;
				while(list($resim) = mysql_fetch_row($result)){
				
				if($i == 1){
				
				?>
            <li>
              <a href="<?=$resim?>">
                <img src="<?=$resim?>" height="70" border="0" class="image0">
              </a>
            </li>				
				
				<?
				}
				else {
				?>
            <li>
              <a href="<?=$resim?>">
                <img src="<?=$resim?>" height="70" border="0" title="<?=_AD?>" longdesc="<?=_AD?>" class="<? echo ($i-1); ?>">
              </a>
            </li>		


            
            <?php
				} // end else 
				
				$i++;
				} // end while
            ?>
          </ul>
        </div>
      </div>

    </div>


																	<!-- kodlar buraya kadar -->
																	</tr>
																</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													</table>
														</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif" height="10">
												<img border="0" src="img/1px.gif" width="1" height="1"></td>
											</tr>
											<tr>
												<td background="img/alt_kapa_turuncu.gif" height="41">
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<tr>
														<td width="10">&nbsp;</td>
														<td align="center">
														&nbsp;</td>
														<td width="10">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="540" align="right">
		<table border="0" style="border-collapse: collapse" cellpadding="0">
			<tr>
				<td>
				<a href="javascript:window.close()"><img border="0" src="img/btn_kapat2.gif" width="56" height="22"></a></td>
				<td width="15">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="540">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
</table>

<p>&nbsp;</p>

</body>

</html>