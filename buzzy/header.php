    <div class="header-top">
        <div class="container clearfix">

            <ul class="top-menu right">

				<?php
				
					if(_UYEDURUM == 1){
					
					
					list($durum, $derece) = @mysql_fetch_row(@mysql_query("select durum, derece from moz order by id desc limit 1"));
					switch($durum){
						case "sunny": $durum = "Güneşli";break;
						case "ptcloudy": $durum = "Yarı Güneşli";break;
						case "stormy": $durum = "Yağmurlu";break;
						case "rainy": $durum = "Şimşekli";break;
						case "cloudy": $durum = "Bulutlu";break;
						default: $durum = "Güneşli";break;
					}	
			?>
                <li>
                    <a href="googledurum.php">Google Bugün <b><?=$durum?></b>, Algoritma <b><?=$derece?>&deg;</b></a>
                </li>
                <li class="user-login">
                    <?php $kadi = uyebilgi('kullaniciadi');echo '<img src="Assets/Img/user-icon.png" /> Merhaba <b>'.$kadi.'</b> <a href="profil.php">Hesabım</a> <a href="cikis.php">Çıkış</a> '; ?>
                </li>			
			<?php

					}
					else {
				?>
                <li>
                    <a href="nedir.php">Buzzy Nedir</a>
                </li>
                <li>
                    <a href="hakkimizda.php">Biz Kimiz</a>
                </li>
                <li>
                    <a href="iletisim.php">İletişim</a>
                </li>
                <li class="user-login">
                    <a href="javascript:void(0)"><img src="Assets/Img/plus-icon.png" /> Üye Ol</a> /
                    <a href="javascript:void(0)">Giriş <img src="Assets/Img/user-icon.png" /></a>
                </li>	
					<?php
					}
					?>

            </ul>
        </div>
    </div>
    <div class="header-menu-bg">
        <div class="container clearfix">
			<div class="user-login2">
				<div class="user-login3">
				<?php
					if(_UYEDURUM != 1){
				?>
					<div class="first">
					<div class="user-login-title"><p>Üye Girişi</p></div>
					<form action="javascript:void(0)" method="post">
					<ul>
						<li><input type="text" name="username" placeholder="E-posta veya kullanıcı adınız" /></li>
						<li><input type="password" name="password" placeholder="Şifreniz" /></li>
						<li>
							<span class="span1"><a href="javascript:void(0)" onclick="goster('third')"><b>Üye Ol</b></a></span>
							<span class="span2"><a href="javascript:void(0)" onclick="goster('second')">Şifremi Unuttum</a></span>
						</li>
						<li><input type="submit" value=" Giriş Yap " class="buttons" /></li>
						<li class="sonuc"></li>
					</ul>
					</form>
					</div>
					
					<div class="second" style="display:none">
					<div class="user-login-title"><p>Şifremi Gönder</p></div>
					<form action="javascript:void(0)" method="post">
					<ul>
						<li><input type="text" name="username" placeholder="E-posta veya kullanıcı adınız" /></li>
						<li>
							<span class="span1"><a href="javascript:void(0)" onclick="goster('third')"><b>Üye Ol</b></a></span>
							<span class="span2"><a href="javascript:void(0)" onclick="goster('first')">Üye Girişi Yap</a></span>
						</li>
						<li><input type="submit" value=" Şifremi Gönder " class="buttons" /></li>
						<li class="sonuc"></li>
					</ul>
					</form>
					</div>
					
					<div class="third" style="display:none">
					<div class="user-login-title"><p>Üye Ol</p></div>
					<form action="javascript:void(0)" method="post">
					<ul>
						<li><input type="text" name="eposta" placeholder="E-posta adresiniz" /></li>
						<li><input type="text" name="username" placeholder="Kullanıcı Adınız" /></li>
						<li><input type="password" name="password" placeholder="Şifreniz" /></li>
						<li><input type="submit" value=" Üyeliğimi Tamamla " class="buttons" /></li>
						<li class="sonuc">
							<span><a href="javascript:void(0)" onclick="goster('first')">Üye Girişi Yap</a></span>
							<span class="span2"><a href="javascript:void(0)" onclick="goster('second')">Şifremi Unuttum</a></span>
						</li>
					</ul>
					</form>
					</div>
					<?php
					}
					?>
				</div>
			</div>
            <div class="logo left">
                <a href="<?=_URL?>"><img src="Assets/Img/logo.png" alt="<?=_AD?>" /></a>
            </div>
            <ul class="menu right">
                <li>
                    <a href="index.php" class="active">ANASAYFA</a>
                </li>
                <li>
                    <a href="analiz.php">SİTE ANALİZ</a>
                </li>
                <li>
                    <a href="rakipanaliz.php">RAKİP TAKİP</a>
                </li>
                <li>
                    <a href="siratakip.php">SIRA BULUCU</a>
                </li>
                <li>
                    <a href="linktakip.php">LİNK TAKİP</a>
                </li>
            </ul>
        </div>
    </div>