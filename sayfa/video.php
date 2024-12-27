<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$id = $_GET["id"];

if(!is_numeric($id)) die("sie");


$result = mysql_query("select * from "._MX."video where id='$id'");


$rowla = mysql_fetch_array($result);

$durum = $rowla["durum"];

/*if($durum != 1) die("onaysız video");*/


@mysql_query("update "._MX."video set hit=hit+1 where id='$id'");

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Video ID:<?=$id?>, <?=$uyeadi?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link rel="stylesheet" href="inc/basic.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
<script type="text/javascript" src="swfobject.js"></script>
<style>
	body {
		background: url(img/bg.gif);
	}
</style>
<script type="text/javascript">
	function menuler(menu){ 
		
		$("#mesajmerkezitablo").hide();
		$("#arkadasmerkezitablo").hide();
		$("#aramamerkezitablo").hide();
		$("#profilmerkezitablo").hide();
		
		$("#"+menu+"tablo").show("slow");
	}
	
	function yildiz(kac, id){ 
		
		var data = "";
		var a = 1;
		var i = 1;

		for(i; i <= kac; i++){
			data = ""+data+" <a href='javascript:void(0)' onclick='puanver("+i+", "+id+")' onmouseout='javascript:yildizlar("+id+")' title='"+i+" Puan ver'><img src='img/star.png' border='0' /></a>";
			a++;
		}
		for(i = a; i <= 5; i++){
			data = ""+data+" <a href='javascript:void(0)' onmouseover='yildiz("+i+", "+id+")' onmouseout='javascript:yildizlar("+id+")' title='"+i+" Puan ver'><img src='img/star_empty.png' border='0' /></a>";
		}
		
		
		$("#vote-send").html(data);
	}
	
	function yildizlar(id){
		var data = "";
		var i = 1;
		
		for(i = 1; i <= 5; i++){
			data = ""+data+" <a href='javascript:void(0)' onmouseover='yildiz("+i+", "+id+")' title='"+i+" Puan ver'><img src='img/star_empty.png' border='0' /></a>";
		}
			
		$("#vote-send").html(data);
	}
	
	function puanver(kac, id){
		
		$("#vote-send").html("<font color=green><b>Bekleyin . . .</b></font>");
		
		jQuery.ajax({
			type: 'POST',
			url: 'inc/videoislem.php',
			data: 'id='+id+'&puan='+kac+"&tur=puan",
			success:function(sonuc){
				$("#vote-send").html("<font color=green><b>Oyunuz için eşekkür ederiz.</b></font>");
			}
			
		})
	}
</script>
</head>
<body onLoad="menuler('durummerkezi');">
<div id="mahirix-modal-content">
	<div id="mahirix-model-header">
		<div id="mahirix-model-title"></div>
		<div id="mahirix-model-title-kapat"><a href="javascript:void(0)" onclick="mahirixmodelkapat();" title="Kapat"><img src="img/mahirix_alert_kapat.png" border="0" /></a></div>
	</div>
	<div style="clear:both;"></div>
	<div id="mahirix-model-icc"></div>
	<div id="mahirix-model-alt"></div>
</div>
<table border="0" width="100%" id="table1" cellspacing="0" cellpadding="0" height="100%">
	<tr>
		<td width="16">&nbsp;</td>
		<td width="790" valign="top">
		<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<table border="0" width="100%" id="table3" cellspacing="0" cellpadding="0">
					<tr>
						<td width="10" background="img/ste_golge_sol.gif">&nbsp;</td>
						<td bgcolor="#FFFFFF">
						<table border="0" width="100%" id="table13" cellspacing="0" cellpadding="0">
							
							<?php include("inc/giris-ust.php"); ?>
							
							<tr>
								<td background="img/ic_alan_gri_bg.gif">
								<table border="0" width="100%" id="table14" cellspacing="0" cellpadding="0">
									<tr>
										<td width="10">&nbsp;</td>
										<td width="200" valign="top">
										
										<?php include("inc/giris-sol.php"); ?>
										
										</td>
										
										
										<td width="6">&nbsp;</td>
										<td width="540" valign="top" align="center">
										<!-- icerik -->
										

										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Videoyu İzle</td>
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
														<td width="510" align="center">
														
														<table>
															<tr>
																<td colspan="2">
																<table>
																	<tr>
																	<td>
																	<?php
																	
																	$videokodumuz = $rowla["dosya"];
																	
																	?>
			
			
																<div id="hata">Lütfen flash player yükleniyiniz.</div>
																 
																  <script type='text/javascript'>
																  var s1 = new SWFObject('player.swf','ply','500','400','1','#000000');
																  s1.addParam('allowfullscreen','true');
																  s1.addParam('allowscriptaccess','always');
																  s1.addParam('flashvars','file=<?=$videokodumuz?>&skin=video/dangdang.swf&autostart=false');
																  s1.write('hata');
																</script>
																	</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="350" valign="top">
																	<table cellpadding="5" cellspacing="5">
																		<?php
																		
																		
																		$kid = $rowla["uye"];
																		
																		list($kadi) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$kid'"));
																		?>
																		<tr>
																			<td width="70"><b>Ekleyen</b></td><td>: <a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$kid?>', '745', '700', 'profilpopup<?=$kid?>', 2, 1, 1);"><font color="red" size="2"><b><?=$kadi?></b></font></a></td>
																		</tr>
																		<tr>
																			<td width="70"><b>İzlenme</b></td><td>: <?=$rowla["hit"];?></td>
																		</tr>		
																		<tr>
																			<td width="70"><b>Eklenme</b></td><td>:  <?=date("d.m.Y", $rowla["kayit"]);?></td>
																		</tr>																
																	</table>
																</td>
																<td width="150" valign="top">
																	<table cellpadding="5" cellspacing="5">
																		<tr><td><b>Puan Ver :</b></td></tr>
																		<tr>
																			<td>
																			<span id="vote-send">
																			<?php
																				
																				$oy = $rowla["oy"];
																				if(!$oy) $oy = 0;
																				
																				$puan = $rowla["puan"];
																				
																				if($puan >= 1) $ortalama = round($puan/$oy);
																				else $ortalama = 0;
																				
																				$id = $_GET["id"];
																			
																				$a = 1;
																				
																				for($i = 1; $i <= $ortalama; $i++){
																					echo '<a href="javascript:void(0)" onmouseover="yildiz('.$i.', '.$id.');"><img src="img/star.png" border="0" /></a> ';
																					$a++;
																				}
																				
																				for($i = $a; $i <= 5; $i++){
																					echo '<a href="javascript:void(0)" onmouseover="yildiz('.$i.', '.$id.');"><img src="img/star_empty.png" border="0" /></a> ';
																				}
																				
																			?>
																			</span>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
					
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="14"></td>
														<td width="510" align="center" height="14">
														</td>
														<td height="14"></td>
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
												&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td align="center">
												<? echo stripslashes(ayar("icerikalti")); ?>
												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											</table>
											
										<!-- icerik sonu -->
										</td>
										<td width="8">&nbsp;</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td>
								<img border="0" src="img/ic_alan_gri_alt.gif" width="770" height="8"></td>
							</tr>
						</table>
						</td>
						<td width="10" background="img/ste_golge_sag.gif">&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td background="img/ste_alt2.gif" height="93" valign="top">
				<table border="0" width="100%" id="table4" cellspacing="0" cellpadding="0">
					<tr>
						<td width="25" height="7"></td>
						<td height="7"></td>
						<td width="25" height="7"></td>
					</tr>
					<tr>
						<td width="25" height="29">&nbsp;</td>
						<td height="29">
						<table border="0" id="table6" cellspacing="0" cellpadding="0">
							<tr>
								<td>
								<table border="0" id="table7" cellspacing="0" cellpadding="0">
									<tr>
										<td><b><a class="c" href="index.php">ana sayfa</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table8" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=okey">okey oyna</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table9" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=sohbet">sohbet et</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table10" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=arkadas_onlineuyeler">online 
										üyeler</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table11" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=uyelik_yukselt">üyeliğini 
										yükselt</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table12" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=yardimmerkezi">yardım merkezi</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						</td>
						<td width="25" height="29">&nbsp;</td>
					</tr>
					<tr>
						<td width="25" height="10"></td>
						<td height="10"></td>
						<td width="25" height="10"></td>
					</tr>
					<tr>
						<td width="25">&nbsp;</td>
						<td>
						<table border="0" width="100%" id="table5" cellspacing="0" cellpadding="0">
							<tr>
								<td width="150">
								<p class="copyright">Copyright 2010<br>
								<?=_AD?></td>
								<td align="right" valign="bottom">
								<p class="c2"><a class="c1" href="index.php?sayfa=kullanim_sartlari">Kullanım 
								Şartları</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=gizlilik_ilkeleri">Gizlilik İlkeleri</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=yardimmaili">Bize Ulaşın</a></td>
							</tr>
						</table>
						</td>
						<td width="25">&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td valign="top">
		<table border="0" id="table169" cellspacing="0" cellpadding="0">
			<tr>
				<td width="15" height="156">&nbsp;</td>
				<td width="161" height="156">&nbsp;</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">
				<?php include("inc/giris-sag.php"); ?>
				</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">&nbsp;</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
</table>


</body>
</html>