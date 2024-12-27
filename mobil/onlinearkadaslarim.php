<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");


?>
<h1 class="title">Online Arkadaşlarım</h1>
<div class="container-fluid iceriklisteleme">
    <?php

    $toplam = mysql_query("select count(id) from "._MX."uye_arkadas where uye='$uyeid' or arkadas='$uyeid'");

    list($toplam) = mysql_fetch_row($toplam);


    if($toplam >= 1) {
        ?>
        <ul class="list-group">
            <?php
            $result = mysql_query("select id, uye, arkadas, uyead, arkadasad, durum from "._MX."uye_arkadas where uye='$uyeid' or arkadas='$uyeid' order by id desc, durum desc");


            $i = 1;

            while (list($idimiz, $uye, $arkadas, $uyead, $arkadasad, $durum) = mysql_fetch_row($result)) {
                if ($arkadas == $uyeid) {

                    $id = $uye;

                    $kullanici = $uyead;

                } else {
                    $id = $arkadas;
                    $kullanici = $arkadasad;

                }

                $online = mysql_query("select count(uye) from " . _MX . "online where uye='$id'");


                list($onlinemi) = mysql_fetch_row($online);

                if ($onlinemi >= 1) {


                    if ($durum == 2) {

                        if ($arkadas == $uyeid) {

                            $buton = '<a href="javascript:void(0)" onclick="$.arkadasonayla(' . $idimiz . ',' . $uyeid . ')"><i class="fas fa-check-circle"></i></a>';
                            $durum = "<font color=red>Onayınız bekleniyor</font>";
                        } else {

                            $buton = NULL;
                            $durum = "<font color=red>Üyemizin onayı bekleniyor</font> ";

                        }

                    } else {
                        $buton = NULL;
                        $durum = NULL;
                    }

                    list($dogum, $cinsiyet, $img, $sehir, $seviye) = mysql_fetch_row(mysql_query("select dogum, cinsiyet, img, sehir, seviye from " . _MX . "uye where id='$id'"));


                    $yas = (date("Y") - date("Y", $dogum));

                    $img = uyeavatar($img, $cinsiyet);

                    $seviyerenk = seviye($seviye, "renk");

                    ?>
                    <li class="list-group-item" id="arkadasim<?= $idimiz ?>">
                        <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><img src="<?= $img ?>" width="100"></a>
                        <div class="rumuz"><a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><font
                                        color="<?= $seviyerenk ?>"><?= turkcejquery($kullanici); ?></font></a></div>
                        <div class="konu"><?= turkcejquery($sehir); ?><br/>Yaş <?= $yas; ?></div>
                        <div class="tarih"><?= $durum ?> <font style="font-size:14px;color:green;font-weight: bold;">ŞUAN ONLİNE</font></div>
                        <div class="butonlar">
                            <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><i
                                        class="fas fa-info-circle"></i></a>
                            <a href="javascript:void(0)"
                               onclick="$.mesaj('<?= $kullanici ?>', <?= $id ?>, <?= $uyeid ?>, <?= seviyeal("mesaj"); ?>)"><i
                                        class="fas fa-comment-dots"></i></a>
                            <a href="javascript:void(0)" onclick="$.arkadassil(<?= $idimiz ?>)"><i
                                        class="fas fa-trash-alt"></i></a>
                            <?= $buton ?>
                        </div>
                    </li>
                    <?php

                }

            } // online mı
            ?>
        </ul>
        <?php
    }
    else {

        ?>
        <p>&nbsp;</p>
        <p class="text-center" style="color:red">Online arkadaşınız bulunmamaktadır. !</p>
        <?php
    }
    ?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>
