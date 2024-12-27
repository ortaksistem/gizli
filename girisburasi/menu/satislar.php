<a href="index.php" class="logo">Admin paneline hoþ geldiniz. (Buraya çýkýþ ve bekleyen içerikler gelicek)</a>
		<ul id="top-navigation">
			<li><span><span><a href="index.php" title="Anasayfa">Anasayfa</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=uye">Üye Yönetimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=icerik">Ýçerik Yönetimi</a></span></span></li>
			<li class="active"><span><span><a href="index.php?sayfa=satislar">Satýþlar</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bot">Bot Yönetimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=yonetici">Yöneticiler</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bakim">Sistem Bakýmý</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=cikis" title="Çýkýþ Yap">Güvenli Çýkýþ</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<?php
				
				$result = mysql_query("select count(id) from "._MX."odeme where tur='2' and durum='2'");
				
				list($bekleyen) = mysql_fetch_row($result);
			
			?>
			<h3>Satýþ Yönetimi</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=satislar">K.Karti Satýþlar</a></li>
				<li><a href="index.php?sayfa=havale"><?=$bekleyen?> Havale</a></li>
				<li><a href="index.php?sayfa=satislargenel">Tüm Satýþlar</a></li>
				<li><a href="index.php?sayfa=satislaristatistik">Ýstatistik</a></li>
				<li><a href="index.php?sayfa=referans">Referans Ýstatistikleri</a></li>
			</ul>
		</div>

