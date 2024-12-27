<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$id = $_POST["id"];

if(!is_numeric($id)) die("Dur bilmeden bastığın bu toprak boktur !");

$result = mysql_query("select gonderen, gonderilen, konu, mesaj, kayit, durum from "._MX."uye_mesaj where id='$id'");

list($gonderen, $gonderilen, $konu, $mesaj, $kayit, $durum) = mysql_fetch_row($result);

if($gonderen != $uyeid and $gonderilen != $uyeid) die("Dur bilmeden bastığın bu toprak boktur. !");

if($gonderen == $uyeid){
    $profil = $gonderilen;
}
else {
    $profil = $gonderen;
}

list($gonderenad, $dogum, $cinsiyet, $img, $sehir, $seviye) = mysql_fetch_row(mysql_query("select kullanici, dogum, cinsiyet, img, sehir, seviye from "._MX."uye where id='$profil'"));

$yas = (date("Y") - date("Y", $dogum));

$img = uyeavatar($img, $cinsiyet);

$seviyerenk = seviye($seviye, "renk");

$konu = turkcejquery(addslashes($konu));

$gonderenad = turkcejquery(addslashes($gonderenad));

$kayit = date("d.m.Y H:i", $kayit);

?>
<div class="container-fluid mesajoku">
    <div class="bilgi">
        <div class="resim"><a href="javascript:void (0)" onclick="$.profil(<?= $profil; ?>)"><img src="<?=$img?>" /></a></div>
        <div class="konu"><?=$konu?></div>
        <div class="kapat"></div>
        <div class="butonlar">
            <a href="javascript:void (0)" onclick="$.profil(<?= $profil; ?>)"><i class="fas fa-info-circle"></i></a>
            <a href="javascript:void (0)" onclick="$.yasakla(<?= $profil ?>, <?= $uyeid ?>, <?=seviyeal("yasakla");?>, 0)"><i class="fas fa-user-alt-slash"></i></a>
            <a href="javascript:void(0)" onclick="$.mesajsil(<?=$id?>, 0, 1)"><i class="fas fa-trash-alt"></i></a>
        </div>
    </div>
    <div class="mesajlar">

        <?php

        $result = mysql_query("select id, gonderen, gonderilen, mesaj, kayit, durum from "._MX."uye_mesaj where gonderen='$profil' and gonderilen='$uyeid' and gonderilensil='0' or gonderen='$uyeid' and gonderilen='$profil' and gonderensil='0' order by id asc");

        while(list($mesajid, $gonderen, $gonderilen, $mesaj, $kayit, $durum) = @mysql_fetch_row($result)){

            $mesaj = turkcejquery(addslashes(nl2br($mesaj)));
            $kayit2 = mobiltarihdon($kayit);
            $kayit = $kayit2 ." " . date("H:i", $kayit);

            if($durum == 2){
                $okundu = NULL;
                // mysql_query("update "._MX."uye set topmesaj=topmesaj-1 where id='$uyeid'");
            } else {

                $okundu = ' class="aktif"';

            }

            if($gonderen == $uyeid){
                $kim = "gonderilen";
                $nickname = "Siz";
                if($durum == 2){
                    // @mysql_query("update "._MX."uye set topmesaj=topmesaj-1 where id='$uyeid'");

                }

            }
            else {
                $kim = "gonderen";
                $nickname = $gonderenad;
                if($durum == 2){
                    @mysql_query("update "._MX."uye set topmesaj=topmesaj-1 where id='$uyeid'");
                    @mysql_query("update "._MX."uye_mesaj set durum='1' where id='$mesajid'");

                }
            }
            ?>
            <div class="<?=$kim?>">
                <span class="tarih"><?=$kayit?></span>
                <b><?=$nickname;?></b><br />
                <?=$mesaj?>
                <br />
                <span<?=$okundu?>><i class="fas fa-check-double"></i></span>
            </div>
        <?php

        }

        ?>
    </div>
    <div class="clearfix"></div>
    <?php

    $seviye = seviyeal("mesaj");
    if($seviye == 1) {
        ?>
        <form id="formmesajcevapyaz" action="javascript:void (0)">
            <div class="form-group cevapyazbosluk">
                <label>Cevap Yaz</label>
                <input type="hidden" name="konu" value="<?=$konu?>">
                <textarea class="form-control" name="mesaj" placeholder="Mesajınızı bu alana yazınız."></textarea>
            </div>
            <p class="text-center">
                <button type="submit" class="btn btn-danger" onclick="$.mesajgonder2(<?= $profil ?>, <?= $uyeid ?>)"><i
                            class="fas fa-share"></i> Cevabı Gönder
                </button>
            </p>
            <span>&nbsp;</span>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </form>
        <?php
    }
    else {
        ?>
        <p>&nbsp;</p>
        <p class="text-center">Mesaj gönderebilmek için üyelik yükseltmeniz gerekmektedir.
            Üyelik yükseltmek için <a href="javascript:void(0)" onclick="$.yukle('uyelikyukselt', 1)" style="color:red">TIKLAYINIZ.</a>
        </p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <?php
    }

        ?>
    </div>
</div>