<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) die("hata");

@mysql_query("update "._MX."uye set topmesaj=0 where id='$uyeid'");

?>
<h1 class="title">Gelen Kutusu</h1>
<div class="container-fluid iceriklisteleme">
    <?php

    $limit = 10;

    $sayfa = $_POST["p"];

    if(!$sayfa) $sayfa = 1;

    $result = @mysql_query("select gonderen from "._MX."uye_mesaj where gonderilen='$uyeid' and yer='1' and masaustusil='0' and gonderilensil='0' group by gonderen");

    $toplam = @mysql_num_rows($result);

    $toplamsayfa = ceil(($toplam/$limit));

    if($toplam >= 1) {

        $result = @mysql_query("select gonderen, max(id) as sonid, max(konu) as konu, max(kayit) as kayit, min(oncelik) as oncelik, max(durum) as durum from "._MX."uye_mesaj where gonderilen='$uyeid' and yer='1' and masaustusil='0' and gonderilensil='0' group by gonderen order by durum desc, oncelik asc, sonid desc limit ".(($sayfa-1)*$limit).",".$limit."");

        ?>
        <ul class="list-group">
            <?php
            // $result = mysql_query("select id, gonderen, gonderenad, konu, kayit, durum from "._MX."uye_mesaj where gonderilen='$uyeid' and yer='1' order by durum desc, oncelik asc limit ".(($sayfa-1)*$limit).",".$limit."");

            $i = 1;

            while(list($gonderen, $id, $konu, $kayit, $oncelik, $durum) = mysql_fetch_row($result)){

                $konu = stripslashes(turkcejquery($konu));

                if(strlen($konu) > 24) $konu = substr($konu, 0, 25) ." ...";

                $kayit2 = mobiltarihdon($kayit);

                if($durum == 2) {
                    $durum = "<font color=red>Okunmamış Mesaj</font>";
                }
                else  {
                    $durum = NULL;

                }


                list($gonderenad, $dogum, $cinsiyet, $img, $sehir, $seviye) = mysql_fetch_row(mysql_query("select kullanici, dogum, cinsiyet, img, sehir, seviye from "._MX."uye where id='$gonderen'"));



                $yas = (date("Y") - date("Y", $dogum));

                $img = uyeavatar($img, $cinsiyet);

                $seviyerenk = seviye($seviye, "renk");

                ?>
                <li class="list-group-item" id="mesajim<?=$id?>">
                    <a href="javascript:void (0)" onclick="$.profil(<?= $gonderen ?>)"><img src="<?= $img ?>" width="100"></a>
                    <div class="rumuz"><a href="javascript:void (0)" onclick="$.mesajoku(<?= $id ?>)"><font color="<?= $seviyerenk ?>"><?= turkcejquery($gonderenad); ?></font></a>
                     </div>
                    <div class="konu" style="font-size:12px;margin-top:5px"><a href="javascript:void (0)" onclick="$.mesajoku(<?= $id ?>)">KONU : <?= $konu?></a><br /><?=$durum?></div>
                    <div class="tarih"><?=$kayit2?> <?=date("H:i", $kayit);?></div>
                    <div class="butonlar">
                        <a href="javascript:void (0)" onclick="$.profil(<?= $gonderen ?>)"><i class="fas fa-info-circle"></i></a>
                        <a href="javascript:void (0)" onclick="$.mesajoku(<?= $id ?>)"><i class="fas fa-comment"></i></a>
                        <a href="javascript:void(0)" onclick="$.mesajsil(<?=$id?>, 0, 0)"><i class="fas fa-trash-alt"></i></a>
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
        <p class="text-center" style="color:red">Henüz hiç mesajınız bulunmuyor !</p>
        <?php
    }
    if($toplamsayfa > 1){
        ?>
        <ul class="pagination float-center">
            <?php
            $p = $_POST["p"];
            if($p == 1) $onceki = $toplamsayfa;
            else $onceki = $p - 1;

            $sayfaadi = "gelenkutusu";
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
