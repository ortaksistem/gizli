<a href="index.php" class="logo">Admin paneline ho� geldiniz. (Buraya ��k�� ve bekleyen i�erikler gelicek)</a>
		<ul id="top-navigation">
			<li><span><span><a href="index.php" title="Anasayfa">Anasayfa</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=uye">�ye Y�netimi</a></span></span></li>
			<li class="active"><span><span><a href="index.php?sayfa=icerik">��erik Y�netimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=satislar">Sat��lar</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bot">Bot Y�netimi</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=yonetici">Y�neticiler</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=bakim">Sistem Bak�m�</a></span></span></li>
			<li><span><span><a href="index.php?sayfa=cikis" title="��k�� Yap">G�venli ��k��</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>Duyuru Y�netimi</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=icerik">Duyuru Giri�</a></li>
				<li><a href="index.php?sayfa=icerik&yer=2">Duyuru Site ��i</a></li>
			</ul>

			<h3>Hayat� Payla�</h3>
			<ul class="nav">
			<?php
				
				$result = mysql_query("select count(id) from "._MX."hayati_paylas where durum='2'");
				
				list($bekleyen) = mysql_fetch_row($result);
			
			?>
				<li><a href="index.php?sayfa=hayati_paylas"><?=$bekleyen?> Bekleyen Yaz�</a></li>
				<li><a href="index.php?sayfa=hayati_paylas_listele">Yaz�lar� Listele</a></li>
			</ul>


			<h3>Anket - A�k S�r���</h3>
			<ul class="nav">
				<li><a href="index.php?sayfa=asksurusu">Yeni Ekle</a></li>
				<li><a href="index.php?sayfa=asksurusu_listele">Listele</a></li>
			</ul>
		</div>