<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Yatakpartner - Mobil</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/mahir.min.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,600&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

</head>
<body>

<header>
    <div class="topmenu stripe">
        <a href="javascript:void(0)" onclick="$.anasayfa('mobil.php')" class="stripe logo"></a>
        <a href="javasript:void(0);" id="Menu" class="stripe menu"></a>
    </div>
    <div class="altmenu stripe">
        <a href="javascript:void(0);" onclick="$.yukle('onlineuyeler', 1)">Online Üyeler</a>
        <a href="javascript:void(0);" onclick="$.yukle('ayinguzeli', 1)">Ayın Üyeleri</a>
        <a href="javascript:void(0);" onclick="$.yukle('uyelikyukselt', 1)" style="color:#ffda09">Üyeliğimi Yükselt</a>
    </div>
</header>

<div class="body">
    <h1 class="title">Duvar</h1>
    <?php

    function kalanzaman($param){

        $simdi = time();

        $kalan = $simdi - $param;

        $saniye = $kalan;
        $dakika = round($kalan/60); // saniye
        $saat = round($kalan/3600); // dakika
        $gun = round($kalan/86400); // saat

        if($saniye < 60){
            return $saniye ." saniye önce";
        }
        else if($dakika < 60) {
            return $dakika ." dakika önce";
        }
        else if($saat < 24){
            return $saat ." saat önce";
        }
        else if($gun < 30){
            return $gun ." gün önce";
        }
        else {
            return mobiltarihdon($param);
        }
    }

    $kullaniciseviye = seviyeal("seviyeid");

    $kullaniciavatar = uyebilgi("avatar");

    if(!$kullaniciavatar or $kullaniciavatar == 'img_uye/avatar/null.jpg') {
        $kullaniciavatar = "img_uye/".uyebilgi("cinsiyet").".gif";
    }
    ?>
    <div class="duvar">
        <div class="paylas">
            <div class="inputlar">
                <form action="javascript:void(0)" id="durumpaylasform">
                    <div class="durumpaylas durumlar">
                        <input type="text" class="form-control" name="baslik" placeholder="Bir başlık yazın" maxlength="40">
                        <textarea class="form-control" name="icerik" placeholder="Ne düşünüyorsun buraya yaz"></textarea>
                        <div class="kalankarakter">40</div>
                    </div>
                </form>
                <form action="javascript:void(0)" id="resimpaylasform" enctype="multipart/form-data">
                    <div class="resimpaylas durumlar">
                        <input type="text" class="form-control" name="baslik" placeholder="Bir başlık yazın" maxlength="40">
                        <input type="file" name="resim" class="form-control" placeholder="Bir Dosya Seçiniz" accept="image/*">
                        <div class="kalankarakter">40</div>
                    </div>
                </form>
                <form action="javascript:void(0)" id="videopaylasform">
                    <div class="videopaylas durumlar">
                        <input type="text" class="form-control" name="baslik" placeholder="Bir başlık yazın" maxlength="40">
                        <textarea class="form-control" name="icerik" placeholder="Video Url/Embed kodunu buraya yazınız"></textarea>
                        <div class="kalankarakter">40</div>
                    </div>
                </form>
                    <input type="hidden" name="neyipaylas" value="">
                    <button class="btn btn-danger btnvazgec" onclick="$.durumvazgec()"><i class="fa fa-window-close"></i> Vazgeç</button>
                    <button class="btn btn-danger btnpaylas" onclick="$.durumpaylasgonder()"><i class="fa fa-share"></i> Paylaş</button>

            </div>
            <div class="paylasma">
                <div class="resim"><img src="<?=$kullaniciavatar?>"></div>
                <span class="nedusunuyorsun">Ne düşünüyorsun? Şimdi paylaş !</span>
                <span class="onceoku"><a href="javascript:void()" onclick="$.duvarkurallar()">Paylaşmadan önce mutlaka okuyunuz</a></span>
            </div>
        </div>
        <div class="butonlar">
            <button class="btn btn-danger" onclick="$.durumpaylas('durumpaylas', <?=$kullaniciseviye?>);"><i class="fa fa-comment-alt"></i> Durum</button>
            <button class="btn btn-danger" onclick="$.durumpaylas('resimpaylas', <?=$kullaniciseviye?>);"><i class="fa fa-camera"></i> Fotoğraf</button>
            <button class="btn btn-danger" onclick="$.durumpaylas('videopaylas', <?=$kullaniciseviye?>);"><i class="fa fa-video"></i> Video</button>
        </div>

                <?php

                $kacinci = 1;
                $limit = 10;

                $kullanicibilgi = $uyeid ."|". $uyeadi;

                $result = mysql_query("select id, uye, uyeadi, avatar, tur, baslik, icerik, resim, yorum, begen, begenliste, kayit from "._MX."duvar where durum='1' order by oncelik desc, id desc limit ".(($kacinci-1)*$limit).",".$limit."");

                while(list($id, $uye, $uyeadi, $avatar, $tur, $baslik, $icerik, $resim, $yorum, $begen, $begenliste, $kayit) = mysql_fetch_row($result)) {

                    $baslik = turkcejquery(stripslashes($baslik));

                    $icerik = turkcejquery($icerik);

                    if (strstr($begenliste, $kullanicibilgi)) {
                        $begendimi = 1;
                        $kalpicon = " aktif";
                        $begenbuton = '<i class="fas fa-heart-broken"></i> Vazgeç';
                    } else {
                        $begendimi = 0;
                        $kalpicon = NULL;
                        $begenbuton = '<i class="fas fa-heart"></i> Beğen';
                    }

                    $kayit = kalanzaman($kayit);

                    $icerik = nl2br($icerik);

                    if ($tur == 1) {

                        $icerigimiz = $icerik;

                        $basligimiz = $baslik;


                    } else if ($tur == 2) {

                        $icerik = stripslashes($icerik);

                        $icerigimiz = $icerik;

                        $basligimiz = $baslik;



                    } else if ($tur == 3) {

                        $basligimiz = $baslik;

                        $icerigimiz = '<img src="'.$resim.'">';


                    } else if ($tur == 4) {

                        $icerik = stripslashes($icerik);

                        $baslik = stripslashes($baslik);

                        $icerigimiz = $icerik;

                        $basligimiz = $baslik;


                    } else {

                        $icerigimiz = $icerik;

                        $basligimiz = $baslik;

                    }

                    $basligimiz = stripslashes($basligimiz);
                    $icerigimiz = stripslashes($icerigimiz);

                    if(strlen($basligimiz) > 40) $basligimiz = substr($basligimiz, 0, 40) ." ...";
                    ?>
                    <div class="icerik" id="icerik<?=$id?>">
                        <div class="kim">
                            <div class="resim"><a href="javascript:void (0)" onclick="$.profil(<?= $uye ?>)"><img src="<?=$avatar?>" /></a></div>
                            <span class="nickname"><a href="javascript:void (0)" onclick="$.profil(<?= $uye ?>)"><?=$uyeadi?></a></span>
                            <span class="basligimiz"><?=$basligimiz?></span>
                            <span class="zaman"><?=$kayit?></span>
                            <span class="begeni"><?=$begen?> begeni</span>
                            <span class="yorumsayisi"><?=$yorum?> yorum</span>
                            <span class="kalp<?=$kalpicon?>"><a href="javascript:void(0)" onclick="$.duvarbegen(<?=$id?>)"><i class="fa fa-heart"></i></a></span>
                        </div>
                        <div class="yazi">
                            <?=$icerigimiz?>
                        </div>
                        <textarea class="yorumyaptextarea" name="yorumyap<?=$id?>" placeholder="Yorum Yapın"></textarea>
                        <div class="yorumyap">
                            <input type="hidden" id="begenisayisi<?=$id?>" value="<?=$begen?>">
                            <input type="hidden" id="begendimi<?=$id?>" value="<?=$begendimi?>">
                            <button class="btn btn-danger yorumgonder" onclick="$.duvaryorumyap(<?=$id?>)"><i class="fas fa-comment"></i> Yorum Yap</button>
                            <button class="btn btn-danger begenbutonu" onclick="$.duvarbegen(<?=$id?>)"><?=$begenbuton?></button>
                            <button class="btn btn-danger" onclick="$.sikayetet(<?=$uye?>, <?=$uyeid?>)"><i class="fas fa-minus-circle"></i> Şikayet Et</button>
                        </div>
                        <div class="yorumlar" id="yorumlar<?=$id?>">
                            <h1 class="title">Yorumlar </h1>
                            <?php

                            $yorumadet = $yorum;
                            if($yorum >= 1) {

                            $resultyorum = mysql_query("select id, uye, uyeadi, avatar, yorum, begen, begenliste, kayit from "._MX."duvar_yorum where durum='1' and icerik='$id' order by id desc");

                                $y = 1;
                                $display = NULL;
                                while(list($yorumid, $yorumuye, $yorumuyeadi, $yorumavatar, $yorum, $begen, $begenliste, $kayit) = mysql_fetch_row($resultyorum)) {

                                    $yorumuyeadi = turkcejquery($yorumuyeadi);

                                    $kayit = kalanzaman($kayit);

                                    $yorum = turkcejquery(stripslashes($yorum));

                                    if (strstr($begenliste, $kullanicibilgi)) {
                                        $begendimi = 1;
                                        $begenclass = " aktif";
                                    } else {
                                        $begendimi = 0;
                                        $begenclass = NULL;
                                    }
                                    if($y > 3){
                                        $display = ' style="display:none"';
                                    }
                                    ?>
                                    <div id="yorum<?=$yorumid?>" class="yorum"<?=$display?>>
                                        <input type="hidden" id="yorumbegenisayisi<?=$yorumid?>" value="<?=$begen?>">
                                        <input type="hidden" id="yorumbegendimi<?=$yorumid?>" value="<?=$begendimi?>">
                                        <div class="resim"><a href="javascript:void (0)" onclick="$.profil(<?= $yorumuye ?>)"><img src="<?=$yorumavatar?>" /></a></div>
                                        <span class="yorumnickname"><a href="javascript:void (0)" onclick="$.profil(<?= $yorumuye ?>)"><?=$yorumuyeadi?></a></span>
                                        <span class="yorumzaman"><?=$kayit?></span>
                                        <span class="yorumbegeni"><?=$begen?> begeni</span>
                                        <span class="yorumbegenbuton<?=$begenclass?>"><a href="javascript:void(0)" onclick="$.duvaryorumbegen(<?=$yorumid?>)"><i class="fa fa-thumbs-up"></i></a></span>
                                        <div class="yorumicerik"><?=$yorum?></div>
                                    </div>
                                    <?php

                                    $y++;
                                } // end yorumwhile
                            }
                            else {
                                ?>
                                <div class="yorum">
                                    <div class="yorumbosicerik">Bu gönderiye henüz yorum yapılmamıştır.</div>
                                </div>
                                <?php
                            }

                            if($yorumadet > 3) {
                                ?>
                                <div class="tumyorumlar">
                                    <button class="btn btn-default" onclick="$.duvaryorumlar(<?=$id?>)"><i class="fa fa-comments"></i> Tüm Yorumlar</button>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="duvarcizgi">&nbsp;</div>

                <?php

                } // end while
                ?>



        </div>
        <div class="duvaryukleniyor" style="display: none;"><p class="text-center">
                <svg width="16px"  height="16px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-dual-ring" style="background: none;"><circle cx="50" cy="50" ng-attr-r="{{config.radius}}" ng-attr-stroke-width="{{config.width}}" ng-attr-stroke="{{config.stroke}}" ng-attr-stroke-dasharray="{{config.dasharray}}" fill="none" stroke-linecap="round" r="40" stroke-width="4" stroke="#dd2e2e" stroke-dasharray="62.83185307179586 62.83185307179586" transform="rotate(341.9 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg> <font color="#dd2e2e"><b>Yükleniyor</b></font> </p></div>
        <button class="btn btn-danger btn-block dahaeski" onclick="$.duvarfazlasi()"><i class="fas fa-calendar-alt"></i> Daha Eski Gönderiler</button>
        <input type="hidden" name="kacinci" value="1">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
</div>

<div class="popbox">
    <h1></h1><a href="javascript:void(0)" onclick="$.popboxkapat()" class="kapat"><i class="fas fa-times-circle"></i></a>
    <div class="container"></div>

</div>

<div class="profil"></div>

<nav class="Menu">
    <p class="header">DURUM MERKEZİ <font style="font-size:10px;color:red">BETA</font> <a href="javasript:void(0);" id="MenuKapat">x</a> </p>
    <ul>
        <li><i class="fa fa-home"></i> <a href="javascript:void(0);" onclick="$.anasayfa('mobil.php')">Anasayfa</a></li>
        <li><i class="fa fa-user-plus"></i> <a href="javascript:void(0)" onclick="$.yukle('uyelikyukselt', 1)">Üyeliğimi Yükselt</a></li>
        <li><i class="fa fa-user-tag"></i> <a href="javascript:void(0)" onclick="$.yukle('kglalin', 1)">KGL Alın</a></li>
        <li><i class="fa fa-users"></i> <a href="javascript:void(0)" onclick="$.yukle('kgl', 1)">KGL Üyeleri</a></li>
        <li><i class="fa fa-search"></i> <a href="javascript:void(0)" onclick="$.yukle('arama', 1)">Arama</a></li>
        <li><i class="fa fa-envelope"></i> <a href="javascript:void(0)" onclick="$.yukle('gelenkutusu', 1)">Mesajlarım</a></li>
        <li><i class="fa fa-pen"></i> <a href="javascript:void(0)" onclick="$.yukle('mesajyaz', 1)">Mesaj Yaz</a></li>
        <li><i class="fa fa-fire"></i> <a href="javascript:void(0)" onclick="$.yukle('populeruyeler', 1)">Popüler Üyeler</a></li>
        <li><i class="fa fa-user-circle"></i> <a href="javascript:void(0)" onclick="$.yukle('yeniuyeler', 1)">Yeni Üyeler</a></li>
        <li><i class="fa fa-calendar-check"></i> <a href="javascript:void(0)" onclick="$.yukle('haftaninuyeleri', 1)">Haftanın Üyeleri</a></li>
        <li><i class="fa fa-star-half-alt"></i> <a href="javascript:void(0)" onclick="$.yukle('kimleroyverdi', 1)">Kimler Oy Verdi</a></li>
        <li><i class="fa fa-user-friends"></i> <a href="javascript:void(0)" onclick="$.yukle('arkadaslarim', 1)">Arkadaşlarım</a></li>
        <li><i class="fa fa-globe-asia"></i> <a href="javascript:void(0)" onclick="$.yukle('onlinearkadaslarim', 1)">Online Arkadaşlarım</a></li>
        <li><i class="fa fa-user-slash"></i> <a href="javascript:void(0)" onclick="$.yukle('yasakladiklarim', 1)">Yasakladıklarım</a></li>
        <li><i class="fa fa-user-edit"></i> <a href="javascript:void(0)" onclick="$.yukle('profilguncelle', 1)">Profilimi Güncelle</a></li>
        <li><i class="fa fa-images"></i> <a href="javascript:void(0)" onclick="$.yukle('resim', 1)">Resimlerim</a></li>
        <li><i class="fa fa-key"></i> <a href="javascript:void(0)" onclick="$.sifredegistir(0)">Şifre Değiştir</a></li>
        <li><i class="fa fa-question"></i> <a href="javascript:void(0)" onclick="$.yukle('yardimmerkezi', 1)">Yardım Merkezi</a></li>
        <li><i class="fa fa-comments"></i> <a href="javascript:void(0)" onclick="$.hatabildir(<?=uyeid()?>)">İletişim - Hata Bildir</a></li>
        <li><i class="fa fa-desktop"></i> <a href="javascript:void(0)" onclick="$.anasayfa('index.php?sayfa=giris')">Masaüstü Sürüme Geç</a></li>
        <li><i class="fa fa-sign-out-alt"></i> <a href="javascript:void(0)" onclick="$.cikisyap()">Güvenli Çıkış</a></li>
    </ul>
    <p class="footer">Copyright 2004 - <?=date("Y");?> Yatakpartner</p>
</nav>

<div class="footer">
    <?php

    list($topmesaj, $topopucuk, $topbakan, $topcicek, $toparkadas) = mysql_fetch_row(mysql_query("select topmesaj, topopucuk, topbakan, topcicek, toparkadas from "._MX."uye where id='$uyeid'"));

    ?>
    <a href="javascript:void(0);" onclick="$.anasayfa('mobil.php')" class="stripe anasayfa">&nbsp;</a>
    <?php
    if($topbakan >= 1){
        $i = "<span>$topbakan</span>";
    } else {
        $i = NULL;
        if($topbakan < 0){
            @mysql_query("update "._MX."uye set topbakan=0 where id='$uyeid'");
        }
    }
    ?>
    <a href="javascript:void(0)" onclick="$.yukle('profilimebakanlar', 1)" class="stripe arkadas">&nbsp;<?=$i?></a>
    <?php
    if($topcicek >= 1){
        $i = "<span>$topcicek</span>";
    } else {
        $i = NULL;
        if($topcicek < 0){
            @mysql_query("update "._MX."uye set topcicek=0 where id='$uyeid'");
        }
    }
    ?>
    <a href="javascript:void(0)" onclick="$.yukle('cicekgonderenler', 1)" class="stripe cicek">&nbsp;<?=$i?></a>
    <?php
    if($toparkadas >= 1){
        $i = "<span>$toparkadas</span>";
    } else {
        $i = NULL;
        if($toparkadas < 0){
            @mysql_query("update "._MX."uye set toparkadas=0 where id='$uyeid'");
        }
    }
    ?>
    <a href="javascript:void(0)" onclick="$.yukle('arkadaslarim', 1)" class="stripe arkadasekle">&nbsp;<?=$i?></a>
    <?php
    if($topopucuk >= 1){
        $i = "<span>$topopucuk</span>";
    } else {
        $i = NULL;
        if($topopucuk < 0){
            @mysql_query("update "._MX."uye set topopucuk=0 where id='$uyeid'");
        }
    }
    ?>
    <a href="javascript:void(0)" onclick="$.yukle('opucukgonderenler', 1)" class="stripe dudak">&nbsp;<?=$i?></a>
    <?php
    if($topmesaj >= 1){
        $i = "<span>$topmesaj</span>";
    } else {
        $i = NULL;
        if($topmesaj < 0){
            @mysql_query("update "._MX."uye set topmesaj=0 where id='$uyeid'");
        }
    }

    ?>
    <a href="javascript:void(0)" onclick="$.yukle('gelenkutusu', 1)" class="stripe mesaj">&nbsp;<?=$i?></a>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/mahir.min.js"></script>
</body>
</html>