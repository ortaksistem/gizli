<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$sayfaadi = "yeniuyeler";

?>
<h1 class="title">Yeni Üyeler</h1>

<div class="container-fluid populeruyeler">
    <p class="text-center">
        <button class="btn" onclick="$.yukle('<?=$sayfaadi?>',11)"><i class="fas fa-circle butonbayanlar"></i> Bayanlar</button>
        <button class="btn" onclick="$.yukle('<?=$sayfaadi?>',22)"><i class="fas fa-circle butonciftler"></i> Çiftler</button>
        <button class="btn" onclick="$.yukle('<?=$sayfaadi?>',33)"><i class="fas fa-circle butonerkekler"></i> Erkekler</button>
    </p>
    <div class="listeleme text-center">
        <?php
        $limit = 15;

        $p = $_POST["p"];

        if($p == 1 or !$p){
            $where = NULL;
        } else {
            if($p == 11) $where = "cinsiyet=1 and ";
            if($p == 22) $where = "cinsiyet=2 and ";
            if($p == 33) $where = "cinsiyet=3 and ";
        }


        $result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, img, tanitim, seviye from "._MX."uye where ".$where."durum='1' and topresim >= 1 order by cinsiyet asc, id desc limit $limit");


        $i = 1;

        while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $img, $tanitim, $seviye) = mysql_fetch_row($result)){

            $yas = (date("Y")-date("Y", $dogum));

            $seviyead = seviye($seviye, "ad");

            $seviyerenk = seviye($seviye, "renk");

            ?>
            <div class="kutu">
                <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><img src="<?=$img?>"></a>
                <?=$seviyead?><br />
                <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><font color="<?=$seviyerenk?>"><?=$kullanici?></font></a><br /><br />
                <?=$yas?> Yaşında<br />
                <?=turkcejquery($sehir)?><br />
            </div>
            <?php
        }
        ?>
    </div>

</div>
<!--<p class="text-center"><button class="btn btn-default btn-block">Haftanın Üyesi Ol</button> </p>-->
<p>&nbsp;</p>
<p>&nbsp;</p>