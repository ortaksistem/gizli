<?php

@mysql_query("SET NAMES latin1");
if(seviyeal("goruntuleme") != 1){
    echo '<h1 class="title">Profil</h1> <p class="text-center"><br /><font color="red">Görüntüleme yetkiniz bulunmuyor</font></p><p>&nbsp;</p><p><button class="btn btn-danger btn-block" onclick="$.profilkapat()"><i class="fa fa-close"></i> Sayfayı Kapat</button> </p>';
    die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) {
    echo '<p class="text-center"><br /><br /><font color="red">Hımm hamm humm nörüon hacı ?</font></p>';
    die();
}

$uyead = uyeadi();

$uye = $_POST["id"];

if(!is_numeric($uye)) {
    echo '<p class="text-center"><br /><br /><font color="red">ID bulunamıyor</font></p>';
}

list($varmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_yasakli where yasakli='$uyeid' and yasaklayan='$uye' or yasakli='$uye' and yasaklayan='$uyeid'"));

if($varmi >= 1){
    echo '<h1 class="title">Profil</h1><p class="text-center"><br /><br /><font color="red">Profil yasaklandığından profil görüntülenemiyor!</font></p><p>&nbsp;</p><p><button class="btn btn-danger btn-block" onclick="$.profilkapat()"><i class="fa fa-close"></i> Sayfayı Kapat</button> </p>';
    die();
}

$result = mysql_query("select * from "._MX."uye where id='$uye'");

$uyeaktar = mysql_fetch_array($result);

$uyeadi = $uyeaktar["kullanici"];

$uyedurumune = $uyeaktar["durum"];

if(!$uyeadi){
    echo '<h1 class="title">Profil</h1><p class="text-center"><br /><br /><font color="red">Böyle bir kullanıcı sistemde bulunmuyor !</font></p><p>&nbsp;</p><p><button class="btn btn-danger btn-block" onclick="$.profilkapat()"><i class="fa fa-close"></i> Sayfayı Kapat</button> </p>';
    die();
}

if($uyedurumune == 5){
    echo '<h1 class="title">Profil</h1><p class="text-center"><br /><br /><font color="red">Üye kendini sildiğinden bilgilerine ulaşılamaz !</font></p><p>&nbsp;</p><p><button class="btn btn-danger btn-block" onclick="$.profilkapat()"><i class="fa fa-close"></i> Sayfayı Kapat</button> </p>';
    die();
}

if($uyedurumune == 6){
    echo '<h1 class="title">Profil</h1><p class="text-center"><br /><br /><font color="red">Üye yöneticiler tarafından sistemden uzaklaştırılmıştır !</font></p><p>&nbsp;</p><p><button class="btn btn-danger btn-block" onclick="$.profilkapat()"><i class="fa fa-close"></i> Sayfayı Kapat</button> </p>';
    die();
}

$cinsiyet = $uyeaktar["cinsiyet"];

$cinsiyetadi = cinsiyet($cinsiyet);

$dogum = $uyeaktar["dogum"];

$dogumyil = date("Y", $dogum);

$yas = (date("Y")-$dogumyil);

$sehir = $uyeaktar["sehir"];



if($uyeid != $uye){

    $ay = date("m");

    $yil = date("Y");

    $hitbak = mysql_query("select count(uye) from "._MX."uye_hit where uye='$uye' and ay='$ay' and yil='$yil'");

    list($hitsay) = mysql_fetch_row($hitbak);

    $hitekle = $uyeid .";". uyeadi();

    if($hitsay < 1){

        $hitekle = $hitekle.";".time();

        mysql_query("insert into "._MX."uye_hit values('$uye', '$uyeadi', '$cinsiyet', '$yas', '$sehir', '1', '$hitekle', '$ay', '$yil')");

        mysql_query("update "._MX."uye set topbakan=topbakan+1, goruntulenme=goruntulenme+1 where id='$uye'");

    }
    else {

        list($hitler) = mysql_fetch_row(mysql_query("select hitler from "._MX."uye_hit where uye='$uye' and ay='$ay' and yil='$yil'"));

        if(!strstr($hitler, $hitekle)){

            $yeniekle = $hitler .":::". $hitekle.";".time();

            mysql_query("update "._MX."uye_hit set hit=hit+1, hitler='$yeniekle' where uye='$uye' and ay='$ay' and yil='$yil'");

            mysql_query("update "._MX."uye set topbakan=topbakan+1, goruntulenme=goruntulenme+1 where id='$uye'");

        }
    }

}

$online = mysql_query("select count(uye) from "._MX."online where uye='$uye'");

list($onlinemi) = mysql_fetch_row($online);

if($onlinemi >= 1) $online = "online";
else $online = "offline";

$seviye = $uyeaktar["seviye"];

switch($seviye){
    case "1": $seviyeicon = "large";break;
    case "2": $seviyeicon = "medium";break;
    case "3": $seviyeicon = "small";break;
    default: $seviyeicon = "small";break;
}

$avatar = $uyeaktar["img"];

if(!$avatar or $avatar == "img_uye/avatar/null.jpg") $oyverme = 1;
$avatar = uyeavatar($avatar, $cinsiyet);

?>
<div class="container-fluid">
        <h1 class="title">Profil Bilgileri<a href="javascript:void (0)" onclick="$.profilkapat()" class="fa fa-times-circle"></a></h1>
        <h2 class="titlealt"><?=$uyeadi?>
            <a href="javascript:void (0)" class="fa fa-circle <?=$online?>"> <?=$online?> </a>
            <a href="javascript:void (0)" class="fa fa-circle <?=$seviyeicon?>"> <?=$seviyeicon?> Üye </a>
        </h2>
        <div class="yukari">

            <div class="resim"><a href="javascript:void(0)" onclick="$.resim(<?=$uyeaktar["topresim"];?>)"><img src="<?=$avatar?>" /></a><p><a href="javascript:void(0)" onclick="$.resim(<?=$uyeaktar["topresim"];?>)">(<?=$uyeaktar["topresim"];?> Resim)</a></p></div>
            <div class="sag">
                <a href="javascript:void(0)" class="stripe mesaj" onclick="$.mesaj('<?=$uyeadi?>', <?= $uye ?>, <?= $uyeid ?>, <?=seviyeal("mesaj");?>)">Mesaj</a>
                <a href="javascript:void(0)" class="stripe yasakla" onclick="$.yasakla(<?= $uye ?>, <?= $uyeid ?>, <?=seviyeal("yasakla");?>, 0)">Yasakla</a>
                <a href="javascript:void(0)" class="stripe arkadas" onclick="$.arkadas(<?= $uye ?>, <?= $uyeid ?>, <?=seviyeal("arkadas");?>, 0)">Arkadaş</a>
                <a href="javascript:void(0)" class="stripe opucuk" onclick="$.opucuk(<?= $uye ?>, <?= $uyeid ?>, <?=seviyeal("opucuk");?>, 0)">Öpücük</a>
                <a href="javascript:void(0)" class="stripe cicek" onclick="$.cicek(<?= $uye ?>, <?= $uyeid ?>, <?=seviyeal("cicek");?>, 0)">Çiçek</a>
            </div>
            <div class="puanver">
                Puan ver :
                <?php
                if($oyverme != 1) {
                    ?>
                    <span class="profil-oy-ver">
				<a href="javascript:void(0)" onclick="$.profiloyver(1, <?= $uye ?>, <?= $uyeid ?>, 0);"><img
                            src="img/profil-yildiz-kapali.png" border="0"/></a>
				<a href="javascript:void(0)" onclick="$.profiloyver(2, <?= $uye ?>, <?= $uyeid ?>, 0);"><img
                            src="img/profil-yildiz-kapali.png" border="0"/></a>
				<a href="javascript:void(0)" onclick="$.profiloyver(3, <?= $uye ?>, <?= $uyeid ?>, 0);"><img
                            src="img/profil-yildiz-kapali.png" border="0"/></a>
				<a href="javascript:void(0)" onclick="$.profiloyver(4, <?= $uye ?>, <?= $uyeid ?>, 0);"><img
                            src="img/profil-yildiz-kapali.png" border="0"/></a>
				<a href="javascript:void(0)" onclick="$.profiloyver(5, <?= $uye ?>, <?= $uyeid ?>, 0);"><img
                            src="img/profil-yildiz-kapali.png" border="0"/></a>
				</span>
                    <?php
                }
                else {
                    echo '<font style="font-size:8px">Resmi bulunmayan üyeye oy verilemez</font>';
                }

                ?>
            </div>
            <a href="javascript:;" onclick="$.sikayetet(<?= $uye ?>, <?= $uyeid ?>)" class="sikayetet">Şikayet et</a>
        </div>
        <div class="asagi galeri" style="display:none;">
            <?php

            if($uyeaktar["topresim"] >= 1){
            $uyemizinidsi = $uyeaktar["id"];
            $resultresim = mysql_query("select resim from "._MX."uye_resim where uye='$uyemizinidsi'");


            ?>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">

                    <?php
                    $i = 1;
                    $active = NULL;
                    while(list($resimresim) = mysql_fetch_row($resultresim)) {
                        if($i == 1) $active = " active";
                        else $active = NULL;
                        ?>
                        <div class="item<?=$active?>">
                            <img src="<?=$resimresim?>" />
                        </div>
                        <?php
                        $i++;
                    }
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
            <?php
            }
            else {
                echo '<p align="text-center" style="color:red">Üyemizin henüz resmi bulunmamaktadır ! </p>';
            }
            ?>
            <p>&nbsp;</p>
            <p align="text-center"><button class="btn btn-danger" onclick="$.resimkapat()"><i class="fas fa-window-close"></i> Galeriyi Kapat</button></p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
        <div class="asagi profilbilgi">
            <ul class="list-group">
                <li class="list-group-item">
                    <b>Profil Bilgileri</b>
                    <span>&nbsp;</span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-user-tag"></i>
                    Üyelik
                    <span><?php
                        if($uyeaktar["kgl"] == 1) echo '<font color="red">KGL Üyesidir</font>';
                        else echo 'KGL üyesi değildir.'
                        ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-transgender"></i>
                    Cinsiyet
                    <span><?=turkcejquery(cinsiyet($cinsiyet))?></span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-clock"></i>
                    Yaş
                    <span><?=$yas?></span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-user-friends"></i>
                    Medeni Durum
                    <span>
                    <?php
                        if(!$uyeaktar["medenidurum"]) echo "Belirtilmemiş";
                        else echo turkcejquery($uyeaktar["medenidurum"]);
                     ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-city"></i>
                    Yaşadığı Yer
                    <span><?php
                        echo turkcejquery($uyeaktar["sehir"]);
                        if($uyeaktar["kiminle"]) echo " ".turkcejquery($uyeaktar['kiminle'])."	yaşıyorum.";
                        ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-search-plus"></i>
                    Aradığı İlişki Durumu
                    <span>
							<?php
                            $iliski = $uyeaktar["iliski"];

                            if(!$iliski){
                                echo "Belirtmemiş";
                            }
                            else {

                                $iliski = explode(";", $iliski);

                                foreach($iliski as $ilis) if($ilis) echo turkcejquery($ilis) .", ";

                            }
                            ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-restroom"></i>
                    Aradığı Cinsiyet
                    <span>
							<?php
                            $iliski = $uyeaktar["aracinsiyet"];

                            if(!$iliski){
                                echo "Belirtmemiş";
                            }
                            else {

                                $iliski = explode(";", $iliski);

                                foreach($iliski as $ilis) if($ilis) echo turkcejquery($ilis) .", ";

                            }
                            ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-weight"></i>
                    Boy ve Kilo
                    <span>
							<?php

                            if($cinsiyet == 2){
                                list($iliski1, $iliski2) = explode("::", turkcejquery($uyeaktar["boy"]));
                                if(!$iliski1) $iliski1 = "Belirtmemiş";
                                if(!$iliski2) $iliski2 = "Belirtmemiş";

                                echo "<b>Kendinin :</b> $iliski1 <b>Eşinin : </b> $iliski2<br /><br />";

                                list($iliski1, $iliski2) = explode("::", turkcejquery($uyeaktar["kilo"]));
                                if(!$iliski1) $iliski1 = "Belirtmemiş";
                                if(!$iliski2) $iliski2 = "Belirtmemiş";

                                echo "<b>Kendinin :</b> $iliski1 <b>Eşinin : </b> $iliski2";

                            }
                            else {
                                $iliski = $uyeaktar["boy"];

                                if (!$iliski) echo "Belirtmemiş";
                                else echo turkcejquery($iliski);
                                echo " , ";
                                $iliski = $uyeaktar["kilo"];

                                if (!$iliski) echo "Belirtmemiş";
                                else echo turkcejquery($iliski);
                            }
                            ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-tasks"></i>
                    Özellikleri
                    <span>
							<?
                            $iliski = $uyeaktar["karakter"];

                            if(!$iliski){
                                echo "Belirtmemiş";
                            }
                            else {
                                $iliski = explode(";", $iliski);

                                foreach($iliski as $ilis) if($ilis) echo turkcejquery($ilis) .", ";
                            }
                            ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-users"></i>
                    İlişki Deneyimi
                    <span>
							<?php

                            if($cinsiyet == 2) {
                                list($iliski1, $iliski2) = explode("::", turkcejquery($uyeaktar["deneyim"]));
                                if (!$iliski1) echo "<b>Kendinin :</b> Belirtmemiş ";
                                else echo "<b>Kendinin :</b> ". $iliski1 ." ";
                                if (!$iliski2) echo "<b>Eşinin :</b> Belirtmemiş ";
                                else echo "<b>Eşinin :</b> ".$iliski2 ." ";
                            } else {

                                $iliski = $uyeaktar["deneyim"];
                                if (!$iliski) echo "Belirtmemiş";
                                else echo $iliski;
                            }
                            ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-bath"></i>
                    Bakımlı mı?
                    <span>
							<?php
                            if($cinsiyet == 2){
                                list($iliski1, $iliski2) = explode("::", turkcejquery($uyeaktar["bakim"]));
                                if (!$iliski1) echo "<b>Kendinin :</b> Belirtmemiş ";
                                else echo "<b>Kendinin :</b> ". $iliski1 ." ";
                                if (!$iliski2) echo "<b>Eşinin :</b> Belirtmemiş ";
                                else echo "<b>Eşinin :</b> ".$iliski2." ";
                            } else {
                                $iliski = $uyeaktar["bakim"];
                                if (!$iliski) echo "Belirtmemiş";
                                else echo $iliski;
                            }
                            ?>
                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-user-graduate"></i>
                    Eğitim ve Meslek
                    <span>
							<?php
                            $iliski = $uyeaktar["egitim"];

                            if(!$iliski) echo "Belirtmemiş";
                            else echo turkcejquery($iliski);
                            echo " , ";
                            $iliski = $uyeaktar["meslek"];

                            if(!$iliski) echo "Belirtmemiş";
                            else echo turkcejquery($iliski);
                            ?>

                    </span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-comment-dots"></i>
                    Kısaca Tanıtım
                    <p>
                        <?
                        if($uyeaktar["tanitimonay"] == 1){
                            echo turkcejquery(stripslashes(nl2br($uyeaktar["tanitim"])));
                        }
                        else {
                            echo "<font color=red>Profil yazısı onay bekliyor</font>";
                        }
                        ?>
                    </p>
                </li>
            </ul>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
    </div>