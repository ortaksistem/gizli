<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

@mysql_query("update "._MX."uye set topbakan='0' where id='$uyeid'");

?>
<h1 class="title">Profilime Bakanlar <button class="btn btn-danger btn-sm temizle" onclick="$.temizle('bakanlar', 0, 0)"><i class="fas fa-trash"></i> Temizle</button></h1>
<div class="container-fluid iceriklisteleme bakanlardiv">

<?php

        $ay = date("m");

        $yil = date("Y");

        $result = mysql_query("select hit, hitler from "._MX."uye_hit where uye='$uyeid' and ay='$ay' and yil='$yil'");



        list($hit, $hitler) = mysql_fetch_row($result);


        if($hit >= 1 or $hitler){


        ?>
    <ul class="list-group">
            <?php

            $explode = explode(":::", $hitler);

            sort($explode);

            foreach($explode as $parcala) {


                list($bakan, $bakanad, $tarih) = explode(";", $parcala);
                if(is_numeric($bakan)) {

                    $tarih2 = mobiltarihdon($tarih);
                    $tarih = $tarih2 . " " . date("H:i", $tarih);

                    list($cinsiyet, $dogum, $sehir, $img, $seviye) = @mysql_fetch_row(@mysql_query("select cinsiyet, dogum, sehir, img, seviye from " . _MX . "uye where id='$bakan'"));

                    $id = $bakan;
                    $kullanici = $bakanad;

                    $yas = (date("Y") - date("Y", $dogum));

                    $img = uyeavatar($img, $cinsiyet);

                    $seviyerenk = seviye($seviye, "renk");

                    ?>
                    <li class="list-group-item">
                        <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><img src="<?= $img ?>" width="100"></a>
                        <div class="rumuz"><a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><font
                                        color="<?= $seviyerenk ?>"><?= turkcejquery($kullanici); ?></font></a></div>
                        <div class="konu"><?= turkcejquery($sehir); ?><br/>Yaş <?= $yas; ?><br/></div>
                        <div class="tarih" style="font-size:14px"><?= $tarih ?></div>
                        <div class="butonlar">
                            <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><i
                                        class="fas fa-info-circle"></i></a>
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

            }
    ?>
     </ul>
    <?php
        }
        else {
            ?>
            <p>&nbsp;</p>
            <p class="text-center" style="color:red">Bu ay profilinize kimse bakmadı !</p>
        <?
        }
        ?>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>
