<a href="index.php" class="logo">Admin paneline hoþ geldiniz. (Buraya çýkýþ ve bekleyen içerikler gelicek)</a>
		<ul id="top-navigation">
			<li><span><span><a href="index.php" title="Anasayfa">Anasayfa</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=uye">Üye Yönetimi</a></span></span></li>
			<li class="active"><span><span><a href="index.php?sayfa=icerik">Ýçerik Yönetimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=satislar">Satýþlar</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bot">Bot Yönetimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=yonetici">Yöneticiler</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bakim">Sistem Bakýmý</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=cikis" title="Çýkýþ Yap">Güvenli Çýkýþ</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>Duyuru Yönetimi</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=icerik">Duyuru Giriþ</a></li>
				<li><a href="index.php?sayfa=icerik&yer=2">Duyuru Site Ýçi</a></li>
			</ul>

			<h3>Hayatý Paylaþ</h3>
			<ul class="nav">
			<?php
				
				$result = mysql_query("select count(id) from "._MX."hayati_paylas where durum='2'");
				
				list($bekleyen) = mysql_fetch_row($result);
			
			?>
				<li><a href="index.php?sayfa=hayati_paylas"><?=$bekleyen?> Bekleyen Yazý</a></li>
				<li><a href="index.php?sayfa=hayati_paylas_listele">Yazýlarý Listele</a></li>
			</ul>


			<h3>Anket - Aþk Sürüþü</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=asksurusu">Yeni Ekle</a></li>
				<li><a href="index.php?sayfa=asksurusu_listele">Listele</a></li>
			</ul>
		</div>