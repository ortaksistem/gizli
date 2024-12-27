<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die(2);

$sayfa = $_POST["sayfa"];

if(!$sayfa) die(3);

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

$result = mysql_query("select begenenler, hit from "._MX."uye_begeniler where uye='$uyeid' and begeni='$sayfa'");

list($begenenler, $hit) = mysql_fetch_row($result);
																
if(!$hit) $hit = 0;


																			if($hit == 1){
																			
																				list($bid, $bad, $bcins) = explode(";", $begenenler);
																				
																				if($bid and $bad and $bcins){
																				
																				$bcins = cinsiyet($bcins);
																				
																				$bcins = turkcejquery($bcins);
																				
																				$bad = turkcejquery($bad);
																				
																					?>
																					<a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$bid?>', '745', '700', 'profilpopup<?=$bid?>', 2, 1, 1);"><font color=red><?=$bad?> (<?=$bcins?>)</font></a>,&nbsp;
																					<?
																				}
																			}
																			
																			else {
																				
																				$begenenler = explode(":::", $begenenler);
																				
																				$adet = count($begenenler);
																				
																				for($e = 1; $e < $adet; $e++){

																					list($bid, $bad, $bcins) = explode(";", $begenenler[$e]);
																					
																					if($bid and $bad and $bcins){
																					
																					$bcins = cinsiyet($bcins);
																					
																				
																					$bcins = turkcejquery($bcins);
																				
																					$bad = turkcejquery($bad);
																				
																					?>
																					<a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$bid?>', '745', '700', 'profilpopup<?=$bid?>', 2, 1, 1);"><font color=red><?=$bad?> (<?=$bcins?>)</font></a>,&nbsp;
																					<?
																					
																					}
																				
																				}
																			}
?>