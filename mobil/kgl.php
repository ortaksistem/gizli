<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");


?>
<h1 class="title">KGL Üyelerimiz</h1>
<div class="container-fluid iceriklisteleme">
    <ul class="list-group">
<?php

$limit = 10;

$sayfa = $_POST["p"];

if(!$sayfa) $sayfa = 1;

$toplam = mysql_query("select count(id) from "._MX."uye where kgl='1' and durum='1'");

list($toplam) = mysql_fetch_row($toplam);

$toplamsayfa = ceil(($toplam/$limit));


$result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, img, tanitim, seviye, kayit from "._MX."uye where kgl='1' and durum='1' order by cinsiyet asc, id desc limit ".(($sayfa-1)*$limit).",".$limit."");


$i = 1;

while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $img, $tanitim, $seviye, $kayit) = mysql_fetch_row($result)) {

    $yas = (date("Y") - date("Y", $dogum));

    $img = uyeavatar($img, $cinsiyet);

    $seviyerenk = seviye($seviye, "renk");

    ?>
    <li class="list-group-item">
        <a href="javascript:void (0)" onclick="$.profil(<?=$id?>)"><img src="<?=$img?>" width="100"></a>
        <div class="rumuz"><a href="javascript:void (0)" onclick="$.profil(<?=$id?>)"><font color="<?=$seviyerenk?>"><?=turkcejquery($kullanici);?></font></a></div>
        <div class="konu"><?=turkcejquery($sehir);?><br/>Yaş <?=$yas;?></div>
        <div class="butonlar">
            <a href="javascript:void (0)" onclick="$.profil(<?=$id?>)"><i class="fas fa-info-circle"></i></a>
            <a href="javascript:void(0)" onclick="$.mesaj('<?=$kullanici?>', <?= $id ?>, <?= $uyeid ?>, <?=seviyeal("mesaj");?>)"><i class="fas fa-comment-dots"></i></a>
            <a href="javascript:void(0)" onclick="$.yasakla(<?= $id?>, <?= $uyeid ?>, <?=seviyeal("yasakla");?>, 0)"><i class="fas fa-user-times"></i></a>
        </div>
    </li>
    <?php

}

        ?>
    </ul>
    <?php

    if($toplamsayfa > 1){
        ?>
        <ul class="pagination float-center">
            <?php
            $p = $_POST["p"];
            if($p == 1) $onceki = $toplamsayfa;
            else $onceki = $p - 1;

            $sayfaadi = "kgl";
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
