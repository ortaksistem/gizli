<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) die("hata");

$neresi = $_GET["neresi"];

if(!$neresi) die("Galiba Sanırsam hata var");

?>
<h1 class="title">Arama Sonuçları</h1>
<div class="container-fluid iceriklisteleme">
    <form action="javascript:void(0)" id="aramaform">
    <ul class="list-group">
        <?php

        $limit = 10;

        $sayfa = $_POST["p"];

        if(!$sayfa) $sayfa = 1;

        if($neresi == "rumuz") {

            $rumuz = $_GET["rumuz"];
            ?>
            <input type="hidden" name="rumuz" value="<?=$rumuz?>">
            <?php


            $rumuz = mysql_real_escape_string(addslashes(strip_tags($rumuz)));

            $toplam = mysql_query("select count(id) from " . _MX . "uye where kullanici like '%$rumuz%' and durum='1'");

            list($toplam) = mysql_fetch_row($toplam);

            $toplamsayfa = ceil(($toplam / $limit));


            $result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, img, tanitim, seviye, kayit from " . _MX . "uye where kullanici like '%$rumuz%' and durum='1' order by cinsiyet asc, id desc limit " . (($sayfa - 1) * $limit) . "," . $limit . "");

        }

        if($neresi == "diger"){

                $where = NULL;

                $cinsiyet = $_GET["cinsiyet"];
                if ($cinsiyet) {
                    foreach ($cinsiyet as $cins) {
                        ?>
                        <input type="hidden" name="cinsiyet[]" value="<?=$cins?>">
                        <?php
                        if ($where) $where .= " or cinsiyet='$cins'";
                        else $where .= "(cinsiyet='$cins'";
                    }
                }

                if($where) $where .= ")";

                $ulke = $_GET["ulke"];
                ?>
                <input type="hidden" name="ulke" value="<?=$ulke?>">
                <?php
                 $ulke = turkce($ulke);
                if ($ulke != "farketmez") {
                    if ($where) $where .= " and ulke='$ulke'";
                    else $where .= "ulke='$ulke'";
                }



                $sehir = $_GET["sehir"];
                ?>
                <input type="hidden" name="sehir" value="<?=$sehir?>">
                <?php
                $sehir = turkce($sehir);
                if ($sehir != "farketmez") {
                    if ($where) $where .= " and sehir='$sehir'";
                    else $where .= "sehir='$sehir'";
                }

                $yas1 = $_GET["yas1"];
                $yas2 = $_GET["yas2"];
                ?>
                <input type="hidden" name="yas1" value="<?=$yas1?>">
                <input type="hidden" name="yas2" value="<?=$yas2?>">
                <?php
                $yil = date("Y");

                $baslangicyas = @mktime(0, 0, 0, date("m"), date("d"), ($yil - $yas1));

                $bitisyas = @mktime(0, 0, 0, date("m"), date("d"), ($yil - $yas2));


                if ($where) $where .= " and (dogum<$baslangicyas and dogum>$bitisyas)";
                else $where = "(dogum<$baslangicyas and dogum>$bitisyas)";


                $medenidurum = $_GET["medenidurum"];
                ?>
                <input type="hidden" name="medenidurum" value="<?=$medenidurum?>">
                <?php
                $medenidurum = turkce($medenidurum);
                if ($medenidurum != "farketmez") $where .= " and medenidurum like '%$medenidurum%'";



            $toplam = mysql_query("select count(id) from " . _MX . "uye where $where and durum='1'");

            list($toplam) = mysql_fetch_row($toplam);

            $toplamsayfa = ceil(($toplam / $limit));


            $result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, img, tanitim, seviye, kayit from " . _MX . "uye where $where and durum='1' order by cinsiyet asc, id desc limit " . (($sayfa - 1) * $limit) . "," . $limit . "");


        }

        $i = 1;
        if($toplam >= 1){


        while (list($id, $kullanici, $cinsiyet, $dogum, $sehir, $img, $tanitim, $seviye, $kayit) = mysql_fetch_row($result)) {

            $yas = (date("Y") - date("Y", $dogum));

            $img = uyeavatar($img, $cinsiyet);

            $seviyerenk = seviye($seviye, "renk");

            ?>
            <li class="list-group-item">
                <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><img src="<?= $img ?>" width="100"></a>
                <div class="rumuz"><a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><font
                                color="<?= $seviyerenk ?>"><?= turkcejquery($kullanici); ?></font></a></div>
                <div class="konu"><?= turkcejquery($sehir); ?><br/>Yaş <?= $yas; ?></div>
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

        if ($neresi == "rumuz") {
            ?>
            <p class="text-center"><?= $rumuz ?> kelimesi geçen rumuzlar listelenmiştir.</p>
            <?php
        }

        if ($neresi == "diger") {
            ?>
            <p class="text-center"><?= $toplam ?> sonuç listelenmiştir.</p>
            <?php
        }

    } else {
        ?>
        <p class="text-center">Aramaya uygun herhangi bir üye bulunamamıştır.</p>
        <?php
    }


    if($toplamsayfa > 1){
        ?>
        <ul class="pagination float-center">
            <?php
            $p = $_POST["p"];
            if($p == 1) $onceki = $toplamsayfa;
            else $onceki = $p - 1;


            ?>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="$.aramayap('<?=$neresi?>', '1', '1')">İlk</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="$.aramayap('<?=$neresi?>', '1', '<?=$onceki?>')">Önceki</a></li>

            <?php

            if($toplamsayfa > 5){

                for($i = $p-3; $i <= $p+3; $i++){
                    if($i >= 1 and $i <= $toplamsayfa) {
                        if($i == $p) $aktif = " active";
                        else $aktif = NULL;
                        echo '<li class="page-item'.$aktif.'"><a class="page-link" href="javascript:void(0)" onclick="$.aramayap(\''.$neresi.'\', \'1\', \''.$i.'\')">' . $i . '</a></li>';
                    }
                }


            } else {

                for($i = 1; $i <= $toplamsayfa; $i++){
                    if($i == $p) $aktif = " active";
                    else $aktif = NULL;
                    echo '<li class="page-item'.$aktif.'"><a class="page-link" href="javascript:void(0)" onclick="$.aramayap(\''.$neresi.'\', \'1\', \''.$i.'\')">'.$i.'</a></li>';
                }
            }


            if($p == $toplamsayfa) $sonraki = 1;
            else $sonraki = $p + 1;

            ?>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="$.aramayap('<?=$neresi?>', '1', '<?=$sonraki?>')">Sonraki</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="$.aramayap('<?=$neresi?>', '1', '<?=$toplamsayfa?>')">Son</a></li>
        </ul>
        <?php
    }
    ?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    </form>
</div>
<p>&nbsp; </p>
<p>&nbsp; </p>
<p>&nbsp; </p>