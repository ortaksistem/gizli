<?php

	list($topmesaj, $topopucuk, $topbakan, $topcicek, $toparkadas, $topgaleritalep, $topgalerionay) = mysql_fetch_row(mysql_query("select topmesaj, topopucuk, topbakan, topcicek, toparkadas, topgaleritalep, topgalerionay from "._MX."uye where id='$uyeid'"));
	
	

?>

										<table border="0" width="100%" id="table201" cellspacing="0" cellpadding="0">
											<tr>
												<td>
												<table border="0" width="100%" id="table202" cellspacing="0" cellpadding="0">
													<tr>
														<td background="img/g_menu_durummerkezi_ust.gif" height="39" align="right">
														<table border="0" id="table203" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<p class="c">
																<font color="#DD2E2E"><b>DURUM MERKEZ�M</b></font></td>
																<td width="11" height="39">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td background="img/g_menu_bg.gif" align="center">
														<table border="0" id="durummerkezitablo" cellspacing="0" cellpadding="0">
														<?php
															if(mobilcihazmi()){
														?>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table205" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="mobil.php">Mobil Siteye Ge�</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<?php
															}
															?>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table205" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=giris">Ana Sayfa</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table205" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=duvar">YP Duvar</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table206" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=uyelik_yukselt">�yeli�imi Y�kselt</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table206" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=gks">KGL Al�n</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table208" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="24">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=mesaj_gelenkutusu">
																		<?php
																			if($topmesaj >= 1) {
																			echo "<b>$topmesaj Mesaj�n�z vard�r</b>";
																			$uyeayaranimasyon = uyebilgi("mesajayaranimasyon");
																			
																			if($uyeayaranimasyon == 1){
																			echo " <img src='img/yeni.gif' border='0' />";
																			}
																			
																			}
																			else {
																			echo "Yeni mesaj�n�z yok";
																			}
																		?>
																		</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table209" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=arkadas_arkadaslarim">
																		<?php
																			
																			if($toparkadas >= 1) echo "<b>$toparkadas arkada�l�k iste�iniz var</b>";
																			else echo "Bekleyen arkada� yok";
																		
																		?>
																		</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table209" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=arkadas_opucukler">
																		<?php
																			
																			if($topopucuk >= 1) echo "<b>$topopucuk �p�c�k ald�n�z</b>";
																			else echo "�p�c�k listeniz bo�";
																		
																		?>
																		</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table210" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=arkadas_profilimebakanlar">
																		<?php
																			
																			if($topbakan >= 1) echo "<b>$topbakan ki�i profilinize bakm��</b>";
																			else echo "Bakan listeniz bo�";
																		
																		?>
																		</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table211" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=arkadas_cicekler">
																		<?php
																		
																			if($topcicek >= 1) echo "<b>$topcicek �i�ek ald�n�z</b>";
																			else echo "�i�ek listeniz bo�";
																		?>
																		
																		</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
																													
															<tr>
															
																<td width="186">
																<table border="0" width="100%" id="table212" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=sohbet">Sohbet odalar�</a></td>
																	</tr>
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_durum" href="index.php?sayfa=okey">Okey oyna</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table214" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="javascript:void(0)" onclick="pencere('index.php?sayfa=online-yeni2', '517', '670', 'onlineuyeler', 2, 1, 1);">Online �yeler</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table215" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=yardimmaili">Yard�m maili</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table216" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<p>
																		<a class="merkez_durum" href="index.php?sayfa=cikis">G�venli ��k��</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td>
														<img border="0" src="img/g_menu_alt.gif" width="200" height="6"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td>
												<table border="0" width="100%" id="table219" cellspacing="0" cellpadding="0">
													<tr>
														<td background="img/g_menu_mesajmerkezi_ust.gif" height="39" align="right">
														<table border="0" id="table220" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<p class="c">
																<a href="javascript:menuler('mesajmerkezi');"><font color="#B031CC">
																<b>MESAJ 
																MERKEZ�M</b></font></a></td>
																<td width="11" height="39">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td background="img/g_menu_bg.gif" align="center">
														<table border="0" id="mesajmerkezitablo" cellspacing="0" cellpadding="0" style="display:none">
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table290" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_mesaj" href="index.php?sayfa=mesaj_gelenkutusu">Gelen Kutusu</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table291" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_mesaj" href="index.php?sayfa=mesaj_gidenkutusu">Giden Kutusu</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table292" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="12" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_mesaj" href="index.php?sayfa=mesaj_arsiv">Ar�ivim</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table293" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="24">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_mesaj" href="index.php?sayfa=mesaj_mesajyaz">Mesaj Yaz</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table294" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_mesaj" href="index.php?sayfa=mesaj_ayarlar">Ayarlar�m</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															</table>
																</td>
													</tr>
													<tr>
														<td>
														<img border="0" src="img/g_menu_alt.gif" width="200" height="6"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td>
												<table border="0" width="100%" id="table221" cellspacing="0" cellpadding="0">
													<tr>
														<td background="img/g_menu_arkadaslar_ust.gif" height="39" align="right">
														<table border="0" id="table222" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<p class="c">
																<a href="javascript:menuler('arkadasmerkezi');"><font color="#FF00B4">
																<b>ARKADA� 
																MERKEZ�M</b></font></a></td>
																<td width="11" height="39">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td background="img/g_menu_bg.gif" align="center">
														<table border="0" id="arkadasmerkezitablo" cellspacing="0" cellpadding="0" style="display:none">
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table314" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="index.php?sayfa=arkadas_arkadaslarim">Arkada�lar�m</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table315" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="index.php?sayfa=arkadas_onlinearkadaslarim">Online Arkada�lar�m</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table316" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="12" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="javascript:void(0)" onclick="pencere('index.php?sayfa=online-yeni2', '517', '670', 'onlineuyeler', 2, 1, 1);">Online �yeler</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table317" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="24">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="index.php?sayfa=arkadas_opucukler">�p�c�kler</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table318" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="index.php?sayfa=arkadas_cicekler">�i�ekler</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table319" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="index.php?sayfa=arkadas_yasakladiklarim">Yasaklad�klar�m</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table320" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="index.php?sayfa=arkadas_yasaklayanlar">Beni Yasaklayanlar</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table321" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="index.php?sayfa=arkadas_profilimebakanlar">Profilime Bakanlar</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table322" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="index.php?sayfa=arkadas_begenenler">Profilimi Be�enenler</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arkadas" href="index.php?sayfa=arkadas_davetiyegonder">Davetiye G�nder</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															</table>
																</td>
													</tr>
													<tr>
														<td>
														<img border="0" src="img/g_menu_alt.gif" width="200" height="6"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>
												<table border="0" width="100%" id="table223" cellspacing="0" cellpadding="0">
													<tr>
														<td background="img/g_menu_aramamer_ust.gif" height="39" align="right">
														<table border="0" id="table224" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<p class="c">
																<a href="javascript:menuler('aramamerkezi');"><font color="#26ABBF">
																<b>ARAMA 
																MERKEZ�M</b></font></a></td>
																<td width="11" height="39">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td background="img/g_menu_bg.gif" align="center">
														<table border="0" id="aramamerkezitablo" cellspacing="0" cellpadding="0" style="display:none">
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table338" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arama" href="index.php?sayfa=arama_yeniuyeler">Yeni �yeler</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table339" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arama" href="index.php?sayfa=arama_populeruyeler">Pop�ler �yeler</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table340" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="12" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arama" href="index.php?sayfa=arama_smallarama">Small Arama</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table341" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="24">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arama" href="index.php?sayfa=arama_mediumarama">Medium Arama</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table342" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_arama" href="index.php?sayfa=arama_largearama">Large Arama</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table343" cellspacing="0" cellpadding="0">
																	<tr>
																		
																	</tr>
																</table>
																</td>
															</tr>
															</table>
																</td>
													</tr>
													<tr>
														<td>
														<img border="0" src="img/g_menu_alt.gif" width="200" height="6"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td>
												<table border="0" width="100%" id="table225" cellspacing="0" cellpadding="0">
													<tr>
														<td background="img/g_menu_profil_ust.gif" height="39" align="right">
														<table border="0" id="table226" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<p class="c">
																<a href="javascript:menuler('profilmerkezi');"><font color="#FF6600">
																<b>PROF�L 
																MERKEZ�M</b></font></a></td>
																<td width="11" height="39">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td background="img/g_menu_bg.gif" align="center">
														<table border="0" id="profilmerkezitablo" cellspacing="0" cellpadding="0" style="display:none">
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table362" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_profil" href="index.php?sayfa=profil_kisiselbilgileri" title="Ki�isel Bilgilerim">Ki�isel Bilgilerim</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table363" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_profil" href="index.php?sayfa=profil_profilbilgileri" title="Profil Bilgilerim">Profil Bilgilerim</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<!--
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table365" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="24">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_profil" href="index.php?sayfa=profil_ilgialanlari" title="Ki�isel Bilgilerim">�lgi Alanlar�m</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															-->
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table366" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_profil" href="index.php?sayfa=profil_profiltanimi" title="Ki�isel Bilgilerim">Profil Tan�m�m</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table367" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="26">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_profil" href="index.php?sayfa=profil_resim">Resimlerim</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															<!--
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table368" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_profil" href="index.php?sayfa=profil_galeri">Galerilerim</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															-->
															<tr>
																<td width="186" bgcolor="#F2F2F2">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="186">
																<table border="0" width="100%" id="table370" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="4" height="26">&nbsp;
																		</td>
																		<td width="11" height="24">
																		<img border="0" src="img/ok_gri.gif" width="11" height="11"></td>
																		<td width="7">&nbsp;</td>
																		<td>
																		<a class="merkez_profil" href="index.php?sayfa=profil_kimleroyverdi">Kimler Oy Verdi</a></td>
																	</tr>
																</table>
																</td>
															</tr>
															</table>
																</td>
													</tr>
													<tr>
														<td>
														<img border="0" src="img/g_menu_alt.gif" width="200" height="6"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
											  <td>
												
												<table border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td height="26" width="12">&nbsp;</td>
													<td>
													  <p class="c"></td>
												</tr>
												</table>
												
												</td>
											</tr>
											<tr>
												<td bgcolor="#e6e6e6"><img src="img/1px.gif" width="1" height="1" /></td>
											</tr>
											<tr>
												<td>
												
												<table border="0" cellspacing="0" cellpadding="0">
												
												<tr>
												
												<td width="12">&nbsp;</td>
												
												<td>
												<p class="c" style="text-align:justify;">
												
												<?php
												
													$result = mysql_query("select id, baslik, duyuru from "._MX."duyuru where yer='2' order by rand() limit 1");
													
													list($id, $baslik, $duyuru) = @mysql_fetch_row($result);
													
													$baslik = stripslashes($baslik);
													
													if(strstr($duyuru, "<-- MAHIRIX -->")){
													
													$duyuru = explode("<-- MAHIRIX -->", $duyuru);
													
													$duyuru = $duyuru[0];
													
													$duyuru = nl2br($duyuru);
													
													$duyuru = stripslashes($duyuru);
													?>
															<?=$duyuru?><br>
															<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=duyuru&id=<?=$id?>', '520', '400', 'duyurupopup<?=$uyeid?>', 2, 1, 1);" title="Duyuruya Bak" style="text-decoration:none" class="c"><b>Devam�n� Oku...</b></a>
													<?
													}
													else {
													
														$duyuru = nl2br($duyuru);
														$duyuru = stripslashes($duyuru);
														echo $duyuru;
														
													}
												
												?>
												</p>
												</td>
												
												</tr>
												</table>
	
                                
												
												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
										</table>