<a href="index.php" class="logo">Admin paneline ho� geldiniz. (Buraya ��k�� ve bekleyen i�erikler gelicek)</a>
		<ul id="top-navigation">
			<li><span><span><a href="index.php" title="Anasayfa">Anasayfa</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=uye">�ye Y�netimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=icerik">��erik Y�netimi</a></span></span></li>
			<li class="active"><span><span><a href="index.php?sayfa=satislar">Sat��lar</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bot">Bot Y�netimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=yonetici">Y�neticiler</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bakim">Sistem Bak�m�</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=cikis" title="��k�� Yap">G�venli ��k��</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<?php
				
				$result = mysql_query("select count(id) from "._MX."odeme where tur='2' and durum='2'");
				
				list($bekleyen) = mysql_fetch_row($result);
			
			?>
			<h3>Sat�� Y�netimi</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=satislar">K.Karti Sat��lar</a></li>
				<li><a href="index.php?sayfa=havale"><?=$bekleyen?> Havale</a></li>
				<li><a href="index.php?sayfa=satislargenel">T�m Sat��lar</a></li>
				<li><a href="index.php?sayfa=satislaristatistik">�statistik</a></li>
				<li><a href="index.php?sayfa=referans">Referans �statistikleri</a></li>
			</ul>
		</div>

