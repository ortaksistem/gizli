<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$kacinci = $_POST["kacinci"];

if(!is_numeric($kacinci)) die("kobaa");

$limit = 10;

$uyeadi = uyeadi();

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

$kullanicibilgi = $uyeid ."|". $uyeadi;

$result = mysql_query("select id, uye, uyeadi, avatar, tur, baslik, icerik, resim, yorum, begen, begenliste, kayit from "._MX."duvar where durum='1' order by id desc limit ".(($kacinci-1)*$limit).",".$limit."");

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