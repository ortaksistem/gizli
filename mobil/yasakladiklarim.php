<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

?>
<h1 class="title">Yasakladıklarım</h1>
<div class="container-fluid iceriklisteleme">
    <?php

    $limit = 15;

    $sayfa = $_POST["p"];

    if(!$sayfa) $sayfa = 1;

    $toplam = mysql_query("select count(id) from "._MX."uye_yasakli where yasaklayan='$uyeid'");

    list($toplam) = mysql_fetch_row($toplam);

    $toplamsayfa = ceil(($toplam/$limit));

    if($toplam >= 1) {
        ?>
        <ul class="list-group">
            <?php
            $result = mysql_query("select id, yasakli, yasakliad, kayit from "._MX."uye_yasakli where yasaklayan='$uyeid' order by id desc limit ".(($p-1)*$limit).",".$limit."");


            $i = 1;

            while (list($idimiz, $uye, $uyead, $kayit) = mysql_fetch_row($result)) {

                $id = $uye;

                $kullanici = $uyead;

                list($dogum, $cinsiyet, $img, $sehir, $seviye) = mysql_fetch_row(mysql_query("select dogum, cinsiyet, img, sehir, seviye from "._MX."uye where id='$id'"));


                $durum = mobiltarihdon($kayit);

                $yas = (date("Y") - date("Y", $dogum));

                $img = uyeavatar($img, $cinsiyet);

                $seviyerenk = seviye($seviye, "renk");

                ?>
                <li class="list-group-item" id="yasakladigim<?=$idimiz?>">
                    <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><img src="<?= $img ?>" width="100"></a>
                    <div class="rumuz"><a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><font
                                    color="<?= $seviyerenk ?>"><?= turkcejquery($kullanici); ?></font></a></div>
                    <div class="konu"><?= turkcejquery($sehir); ?><br/>Yaş <?= $yas; ?></div>
                    <div class="tarih"><?=$durum?></div>
                    <div class="butonlar">
                        <a href="javascript:void(0)" onclick="$.yasakkaldir(<?=$idimiz?>)"><i class="fas fa-trash"></i></a>
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
        <p class="text-center" style="color:red">Henüz bir yasakladığınız kullanıcı bulunmamaktadır. !</p>
        <?php
    }
    if($toplamsayfa > 1){
        ?>
        <ul class="pagination float-center">
            <?php
            $p = $_POST["p"];
            if($p == 1) $onceki = $toplamsayfa;
            else $onceki = $p - 1;

            $sayfaadi = "yasakladiklarim";
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
