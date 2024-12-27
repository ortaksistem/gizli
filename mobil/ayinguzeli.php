<?php

@mysql_query("SET NAMES latin1");
if(seviyeal("goruntuleme") != 1){
    echo '<p class="text-center"><br /><br /><font color="red">Görüntüleme yetkiniz bulunmuyor</font></p>';
    die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) {
    echo '<p class="text-center"><br /><br /><font color="red">Hımm hamm humm nörüon hacı ?</font></p>';
    die();
}

$aylar = array("", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");

$ay = $_GET["ay"];

$yil = $_GET["yil"];

if(!$ay){
    $ay = date("m") - 1;
    $yil = date("Y");
}
if(!$yil) $yil = date("Y");

if($ay == 1){
    $oncekiay = 12;
    $yilimiz = $yil - 1;
} else {
    $oncekiay = $ay - 1;
    $yilimiz = $yil;
}

$onceki = "ayinguzeli&ay=$oncekiay&yil=$yilimiz";


// list($warmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_ay where ay='$oncekiay' and yil='$yil'"));



if(!$_GET["ay"] or $_GET["ay"] == (date("m")-1)) $sonraki = 'javascript:void(0)';
else {
    if($ay == 12){
        $sonrakiay = 1;
        $yilimiz = $yil + 1;

    } else {
        $sonrakiay = $ay + 1;
        $yilimiz = $yil;
    }
    $sonraki = "$.yukle('ayinguzeli&ay=".$sonrakiay."&yil=".$yilimiz."', 1)";
}



$ayad = $aylar[$ay];


$seccinsiyet = array(1, 2, 3);


?>
<h1 class="title ayinbutonlari">
    <div class="sol"><button class="btn btn-danger" onclick="$.yukle('<?=$onceki?>', 1)"><i class="fas fa-arrow-left"></i> Önceki</button></div>
    Ayın Güzelleri <?=$ay?>/<?=$yil?>
    <div class="sag"><button class="btn btn-danger" onclick="<?=$sonraki?>">Sonraki <i class="fas fa-arrow-right"></i></button></div>
</h1>

<div id="myCarousel" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner">
        <?php

        $i = 1;
        $active = NULL;
        foreach($seccinsiyet as $sec){
            if($i == 1) $active = " active";
            else $active = NULL;
            $i++;


            list($uye, $uyead, $resim) = mysql_fetch_row(mysql_query("select uye, uyead, img from "._MX."uye_ay where cinsiyet='$sec' and ay='$ay' and yil='$yil'"));


            list($dogum, $sehir, $kiminle, $iliski, $aracinsiyet, $tanitim, $tanitimonay) = mysql_fetch_row(mysql_query("select dogum, sehir, kiminle, iliski, aracinsiyet, tanitim, tanitimonay from "._MX."uye where id='$uye'"));

            $yas = date("Y") - date("Y", $dogum);

            $sehir = stripslashes($sehir);

            $kiminle = stripslashes($kiminle);

            $iliski = str_replace(";", ", ", $iliski);

            $aracinsiyet = str_replace(";", ", ", $aracinsiyet);

            if($tanitimonay == 1) $tanitim = stripslashes($tanitim);
            else $tanitim = "<font color=red>Onay bekliyor</font>";

            $tanitim = substr($tanitim, 0, 276);

            ?>
            <div class="item<?=$active?>">
                <img src="<?=$resim?>" />
                <div class="ayinguzeli">
                    <div class="rumuz">
                        <a href="javascript:void (0)" onclick="$.profil(<?= $uye ?>)"><?=turkcejquery($uyead)?></a>
                        <a href="javascript:void (0)" onclick="$.profil(<?= $uye ?>)" class="rumuzbutonlar"><i class="fas fa-info-circle"></i></a>
                        <a href="javascript:void(0)" onclick="$.mesaj('<?= $uyead ?>', <?= $uye ?>, <?= $uyeid ?>, <?= seviyeal("mesaj"); ?>)" class="rumuzbutonlar"><i class="fas fa-comment-dots"></i></a>
                    </div>
                    <div class="yas"><b><?=turkcejquery($yas)?></b> yaşında <b><?=turkcejquery($sehir)?></b> şehrinde, <b><?=turkcejquery($kiminle)?></b> yaşıyor
                        <br /><b>Aradığı İlişki</b> : <?=turkcejquery($iliski)?>
                        <br /><b>Aradığı Cinsiyet</b> : <?=turkcejquery($aracinsiyet)?>

                    </div>

                </div>
                <p>&nbsp;</p>
            </div>


            <?php

        } // end foreach

        ?>

    </div>
    <!-- Carousel controls -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
<p>&nbsp;</p>
<h1 class="title title2">Ayın güzeli nedir?</h1>

<p>- Ayın güzeli bulunduğumuz ayın içerisinde üyelerimiz tarafından en fazla puanı alan üyelerimizdir.</p>
<p>- Ayın güzelini sistem otomatik olarak belirler.</p>
<p>- Her üyemiz sadece bir defa ayın güzeli olabilir.</p>

<p>&nbsp;</p>
<p>&nbsp;</p>
