<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

?>
<h1 class="title">Kimler Oy Verdi</h1>
<div class="container-fluid iceriklisteleme">

<?php

        $ay = date("m");

        $yil = date("Y");

        $result = mysql_query("select oylar from "._MX."uye_oy where uye='$uyeid' and ay='$ay' and yil='$yil'");


        list($oylar) = mysql_fetch_row($result);

        $count = 0;

        if($oylar){

            $oylar = explode(":", $oylar);

            $count = count($oylar);

        }

        if($count >= 1){


        ?>
    <ul class="list-group">
            <?php


            foreach($oylar as $oy) {

                $oy = explode(";", $oy);
                $oyid = $oy[0];
                $oyad = $oy[1];
                $puan = $oy[2];
                $tarih = date("d.m.Y H:i", $oy[3]);

                list($cinsiyet, $dogum, $sehir, $img , $seviye) = @mysql_fetch_row(@mysql_query("select cinsiyet, dogum, sehir, img, seviye from "._MX."uye where id='$oyid'"));

                $id = $oyid;
                $kullanici = $oyad;

                $yas = (date("Y") - date("Y", $dogum));

                $img = uyeavatar($img, $cinsiyet);

                $seviyerenk = seviye($seviye, "renk");

                ?>
                <li class="list-group-item">
                    <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><img src="<?= $img ?>" width="100"></a>
                    <div class="rumuz"><a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><font
                                    color="<?= $seviyerenk ?>"><?= turkcejquery($kullanici); ?></font></a></div>
                    <div class="konu"><?= turkcejquery($sehir); ?><br/>Yaş <?= $yas; ?><br /><b><?=$puan?> puan verdi</b></div>
                    <div class="tarih" style="font-size:14px"><?=$tarih?></div>
                    <div class="butonlar">
                        <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><i class="fas fa-info-circle"></i></a>
                        <a href="javascript:void(0)"
                           onclick="$.mesaj('<?= $kullanici ?>', <?= $id ?>, <?= $uyeid ?>, <?= seviyeal("mesaj"); ?>)"><i
                                    class="fas fa-comment-dots"></i></a>
                        <a href="javascript:void(0)"
                           onclick="$.yasakla(<?= $id ?>, <?= $uyeid ?>, <?= seviyeal("yasakla"); ?>, 0)"><i
                                    class="fas fa-user-times"></i></a>
                    </div>
                </li>
                <?php

            }
    ?>
     </ul>
    <?php
        }
        else {
            ?>
            <p>&nbsp;</p>
            <p class="text-center" style="color:red">Bu ay henüz oy almadınız !</p>
        <?
        }
        ?>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>
