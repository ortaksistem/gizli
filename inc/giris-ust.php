							<tr>
								<td>
								<script type="text/javascript" src="ypsohbetdosyalar/js/chat.js"></script>
								<script type="text/javascript">
	$(document).ready(function() {
			chatWith("Sohbet", "Deneme", "Deneme2", "Deneme3", "Deneme4");
			toggleChatBoxGrowth("Sohbet");
			$("#sohbetkisilistesi").html("<img src='img/loading.gif' /> <font color='green'>Kiþi listeniz yükleniyor...</font>");
			<?php
				if($_SESSION["sohbetdurum"] == 1){
			?>
			kisilistesiguncelle();
			<?php
				}
				else {
			?>
			sohbetikapat();
			<?
				}
			?>
			$("#sohbetarama").keyup(function() {
				var deger = $(this).val();
				if (deger.length > 0){
					$("#sohbetkisilistesi .aadi:not(:contains('"+deger+"'))").hide();
				}else {
					$("#sohbetkisilistesi .aadi").show();
				}
			});
	});
	function kisilistesiguncelle(){
			var seviye = <?=seviyeal("seviyeid");?>;
			jQuery.ajax({
				type : 'POST',
				url : 'ypsohbetdosyalar/kisilistesi.php',
				data : "kabul=evet&seviye="+seviye,
				success: function(sonuc){		
					$("#sohbetkisilistesi").html("<div class='sohbetkisilistesi'>"+sonuc+"</div>");
				}
			})	
		setTimeout('kisilistesiguncelle()', 120000);
	}
	function sohbetikapat(){
		toggleChatBoxGrowth('Sohbet');
		if ($("#sohbetayarlar").css('display') != 'none') {
			$("#sohbetayarlar").css('display', 'none');
		}
		$("#sohbetayarlarbuton").hide();
		$("#sohbetayarlarbaslik").html('<a href="javascript:void(0)" onclick="sohbetiac()" title="Sohbeti açmak için týklayýnýz">Çevrim Dýþý</a> <span id="onlinesayisi"></span>');
		$(".chatbox:not('#chatbox_Sohbet')").hide();
			jQuery.ajax({
				type : 'POST',
				url : 'ypsohbetdosyalar/sohbetislem.php',
				data : "islem=kapat",
				success: function(sonuc){		
				}
			})
	}
	function sohbetiac(){
		var onayla = confirm('Online olmak istediðinizden emin misiniz?');
		if(onayla){
			toggleChatBoxGrowth('Sohbet');
			$("#sohbetayarlarbaslik").html('<a href="javascript:void(0)" onclick="toggleChatBoxGrowth(\'Sohbet\')">Sohbet</a> <span id="onlinesayisi"></span>');
			$("#sohbetayarlarbuton").show();
			$(".chatbox:not('#chatbox_Sohbet')").show();
			jQuery.ajax({
				type : 'POST',
				url : 'ypsohbetdosyalar/sohbetislem.php',
				data : "islem=ac",
				success: function(sonuc){		
				}
			})
		}
	}
	function sohbetayarlar(){
		if ($("#sohbetayarlar").css('display') == 'none') {
			$("#sohbetayarlar").css('display', 'block');
		}
		else {
			$("#sohbetayarlar").css('display', 'none');
		}
	}
	function sohbetonlinekisi(deger){
		$("#onlinesayisi").html("("+deger+" Online)");
	}
								</script>
								<link type="text/css" rel="stylesheet" media="all" href="ypsohbetdosyalar/css/chat.css" />
								<style>

								ul, li {padding: 0px; margin: 0px; list-style-type: none}
								#yeni-header {
									width:770px;
									height:193px;
									background:url(images/header-yeni.jpg) no-repeat;
									margin:0px;
									padding:0px;
								}
								.yeni-header-menu {
									width:770px;
									height:49px;
									padding:144px 0px 0px 0px;
									margin:0px;
								}
								.yeni-header-menu li {
									float:left;
									list-style-type: none;
								}
								.yeni-header-menu img {
									border:none;
								}
									
								</style>
								<div id="yeni-header">
									<div id="yeni-header-menu">
										<div class="yeni-header-menu">
										<ul>
											<li><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=online-yeni2', '517', '670', 'onlineuyeler', 2, 1, 1);"><img src="images/header-menu-online.jpg" /></a></li>
											<li><a href="index.php?sayfa=gks_uyeler"><img src="images/header-menu-kgl.jpg" /></a></li>
											<li><a href="index.php?sayfa=ayinuyeleri"><img src="images/header-menu-okey.gif" /></a></li>
											<li><a href="index.php?sayfa=yardimmerkezi"><img src="images/header-menu-yardim.jpg" /></a></li>
											<li><a href="index.php?sayfa=uyelik_yukselt"><img src="images/header-menu-yukselt.jpg" /></a></li>
										</ul>
										</div>
									</div>
								</div>
								</td>
							</tr>
							<tr>
								<td height="4">
								<img border="0" src="img/1px.gif" width="1" height="1"></td>
							</tr>
							<tr>
								<td>
								<img border="0" src="img/ic_alan_gri_ust.gif" width="770" height="8"></td>
							</tr>