<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

@mysql_query("update "._MX."uye set toparkadas=0 where id='$uyeid'");
?>
<h1 class="title">Arkadaşlarım</h1>
<div class="container-fluid iceriklisteleme">
    <?php

    $limit = 15;

    $sayfa = $_POST["p"];

    if(!$sayfa) $sayfa = 1;

    $toplam = mysql_query("select count(id) from "._MX."uye_arkadas where uye='$uyeid' or arkadas='$uyeid'");

    list($toplam) = mysql_fetch_row($toplam);

    $toplamsayfa = ceil(($toplam/$limit));

    if($toplam >= 1) {
        ?>
        <ul class="list-group">
            <?php
            $result = mysql_query("select id, uye, arkadas, uyead, arkadasad, durum from "._MX."uye_arkadas where uye='$uyeid' or arkadas='$uyeid' order by id desc, durum desc limit ".(($p-1)*$limit).",".$limit."");


            $i = 1;

            while (list($idimiz, $uye, $arkadas, $uyead, $arkadasad, $durum) = mysql_fetch_row($result)) {
                if($arkadas == $uyeid){

                    $id = $uye;

                    $kullanici = $uyead;

                }
                else {
                    $id = $arkadas;
                    $kullanici = $arkadasad;

                }

                if($durum == 2){

                    if($arkadas == $uyeid){

                        $buton = '<a href="javascript:void(0)" onclick="$.arkadasonayla('.$idimiz.','.$uyeid.')"><i class="fas fa-check-circle"></i></a>';
                        $durum = "<font color=red>Onayınız bekleniyor</font>";
                    }
                    else {

                        $buton = NULL;
                        $durum = "<font color=red>Üyemizin onayı bekleniyor</font>";

                    }

                }
                else {
                    $buton = NULL;
                    $durum = NULL;
                }

                list($dogum, $cinsiyet, $img, $sehir, $seviye) = mysql_fetch_row(mysql_query("select dogum, cinsiyet, img, sehir, seviye from "._MX."uye where id='$id'"));



                $yas = (date("Y") - date("Y", $dogum));

                $img = uyeavatar($img, $cinsiyet);

                $seviyerenk = seviye($seviye, "renk");

                ?>
                <li class="list-group-item" id="arkadasim<?=$idimiz?>">
                    <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><img src="<?= $img ?>" width="100"></a>
                    <div class="rumuz"><a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><font
                                    color="<?= $seviyerenk ?>"><?= turkcejquery($kullanici); ?></font></a></div>
                    <div class="konu"><?= turkcejquery($sehir); ?><br/>Yaş <?= $yas; ?></div>
                    <div class="tarih"><?=$durum?></div>
                    <div class="butonlar">
                        <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><i class="fas fa-info-circle"></i></a>
                        <a href="javascript:void(0)" onclick="$.mesaj('<?= $kullanici ?>', <?= $id ?>, <?= $uyeid ?>, <?= seviyeal("mesaj"); ?>)"><i class="fas fa-comment-dots"></i></a>
                        <a href="javascript:void(0)" onclick="$.arkadassil(<?=$idimiz?>)"><i class="fas fa-trash-alt"></i></a>
                        <?=$buton?>
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
        <p class="text-center" style="color:red">Henüz bir arkadaşlığınız bulunmamaktadır. !</p>
        <?php
    }
    if($toplamsayfa > 1){
        ?>
        <ul class="pagination float-center">
            <?php
            $p = $_POST["p"];
            if($p == 1) $onceki = $toplamsayfa;
            else $onceki = $p - 1;

            $sayfaadi = "arkadaslarim";
            ?>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="$.yukle('<?=$sayfaadi?>', '1')">İlk</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="$.yukle('<?=$sayfaadi?>', '<?=$onceki?>')">Önceki</a></li>

            <?php

            if($toplamsayfa > 5){

                for($i = $p-3; $i <= $p+3; $i++){
                    if($i >= 1 and $i <= $toplamsayfa) {
                        if($i == $p) $aktif = " active";
                        else $aktif = NULL;
                        echo '<li class="page-item'.$aktif.'"><a class="page-link" href="javascript:void(0)" onclick="$.yukle(\''.$sayfaadi.'\', \''.$i.'\')">' . $i . '</a></li>';
                    }
                }


            } else {

                for($i = 1; $i <= $toplamsayfa; $i++){
                    if($i == $p) $aktif = " active";
                    else $aktif = NULL;
                    echo '<li class="page-item'.$aktif.'"><a class="page-link" href="javascript:void(0)" onclick="$.yukle(\''.$sayfaadi.'\', \''.$i.'\')">'.$i.'</a></li>';
                }
            }


            if($p == $toplamsayfa) $sonraki = 1;
            else $sonraki = $p + 1;

            ?>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="$.yukle('<?=$sayfaadi?>', '<?=$sonraki?>')">Sonraki</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="$.yukle('<?=$sayfaadi?>', '<?=$toplamsayfa?>')">Son</a></li>
        </ul>
        <?php
    }
    ?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>
