<?

if(seviyeal("online") != 1){
    yonlendir("index.php?sayfa=hata");
    die();
}

@mysql_query("SET NAMES latin1");

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");


include("cache.php");

cache_baslat();


$uyeadi = uyeadi();

$zaman = time();

mysql_query("delete from "._MX."online where kayit < $zaman");

$saat = date("G");
$gun = date("N");
$yil = date("Y");

$varmi = @mysql_query("select id, bayan, cift, erkek, sure, durum from "._MX."online_liste_sure where saat='$saat'");

if(@mysql_num_rows($varmi) >= 1){

    list($id, $bayan, $cift, $erkek, $sure, $durum) = @mysql_fetch_row($varmi);


    if($durum != 1){

        $ekle = ($sure * 60) + $zaman;

        if($bayan >= 1){
            $cinsiyet = 1;
            $result = @mysql_query("select uye, uyeadi from "._MX."online_liste where cinsiyet='1' and gun='$gun' order by rand() limit $bayan");
            while (list($uye, $uyeadi) = @mysql_fetch_row($result)){

                list($yas, $sehir, $seviye) = @mysql_fetch_row(@mysql_query("select dogum, sehir, seviye from "._MX."uye where id='$uye'"));

                list($seviyead, $seviyeicon, $renk, $oncelik) = @mysql_fetch_row(@mysql_query("select ad, icon, renk, oncelik from "._MX."seviye where id='$seviye'"));

                $yas = $yil - date("Y", $yas);
                $uyeonceligi = $cinsiyet * $oncelik;
                @mysql_query("insert into "._MX."online values('$uye', '$uyeadi', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$uyeonceligi', '$ekle')");


            }
        } // end bayan

        if($cift >= 1){
            $cinsiyet = 2;
            $result = @mysql_query("select uye, uyeadi from "._MX."online_liste where cinsiyet='2' and gun='$gun' order by rand() limit $cift");
            while (list($uye, $uyeadi) = @mysql_fetch_row($result)){

                list($yas, $sehir, $seviye) = @mysql_fetch_row(@mysql_query("select dogum, sehir, seviye from "._MX."uye where id='$uye'"));

                list($seviyead, $seviyeicon, $renk, $oncelik) = @mysql_fetch_row(@mysql_query("select ad, icon, renk, oncelik from "._MX."seviye where id='$seviye'"));

                $yas = $yil - date("Y", $yas);
                $uyeonceligi = $cinsiyet * $oncelik;
                @mysql_query("insert into "._MX."online values('$uye', '$uyeadi', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$uyeonceligi', '$ekle')");


            }
        } // end cift

        if($erkek >= 1){
            $cinsiyet = 3;
            $result = @mysql_query("select uye, uyeadi from "._MX."online_liste where cinsiyet='3' and gun='$gun' order by rand() limit $erkek");
            while (list($uye, $uyeadi) = @mysql_fetch_row($result)){

                list($yas, $sehir, $seviye) = @mysql_fetch_row(@mysql_query("select dogum, sehir, seviye from "._MX."uye where id='$uye'"));

                list($seviyead, $seviyeicon, $renk, $oncelik) = @mysql_fetch_row(@mysql_query("select ad, icon, renk, oncelik from "._MX."seviye where id='$seviye'"));

                $yas = $yil - date("Y", $yas);
                $uyeonceligi = $cinsiyet * $oncelik;
                @mysql_query("insert into "._MX."online values('$uye', '$uyeadi', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$uyeonceligi', '$ekle')");

            }
        } // end cift

        @mysql_query("update "._MX."online_liste_sure set durum='0'");
        @mysql_query("update "._MX."online_liste_sure set durum='1' where id='$id'");


    }
}

?>
<div class="container-fluid online-uyeler">
        <h1 class="title">Online Üyeler</h1>
        <form id="onlineuyelerselect">
            <div class="form-row">
                <div class="form-group col-md-4 formliste">
                    <label for="inputState">Cinsiyet</label>
                    <select class="form-control" name="cinsiyetselect" onchange="$.onlineuyelersec(this.value)">
                        <option value="0" selected>Hepsi</option>
                        <option value="bayan">Bayan </option>
                        <option value="cift">Çift </option>
                        <option value="erkek">Erkek </option>
                    </select>
                </div>
                <div class="form-group col-md-4 formliste">
                    <label for="inputZip">Üyelik Tipi</label>
                    <select class="form-control" name="uyeliktipiselect" onchange="$.onlineuyelersec(this.value)">
                        <option value="0" selected>Hepsi</option>
                        <option value="large">Large </option>
                        <option value="medium">Medium </option>
                        <option value="small">Small </option>
                    </select>
                </div>
            </div>
        </form>
        <div class="cizgimiz"></div>

        <ul class="list-group list-group-flush listeleme">
        <?php

            $result = mysql_query("select uye, ad, cinsiyet, yas, sehir, seviyead, seviyeicon, seviyerenk from "._MX."online order by cinsiyet asc, oncelik asc");

            while(list($uye, $ad, $cinsiyet, $yas, $sehir, $seviyead, $seviyeicon, $seviyerenk) = mysql_fetch_row($result)){


                list($img) = mysql_fetch_row(mysql_query("select img from "._MX."uye where id='$uye'"));

                $img = uyeavatar($img, $cinsiyet);

                if(strlen($yas) > 2){
                    $yas = date("Y") - date("Y", $yas);
                }

                if(strstr($sehir, "Istanbul")) $sehir = "Istanbul";

                if($cinsiyet == 1) { $cinsiyeta = "B"; $cssci = "bayan";}
                else if($cinsiyet == 2) { $cinsiyeta = "Ç"; $cssci = "cift";}
                else if($cinsiyet == 3) { $cinsiyeta = "E"; $cssci = "erkek";}
                else if($cinsiyet == 4) { $cinsiyeta = "L"; $cssci = "bayan";}
                else if($cinsiyet == 5) { $cinsiyeta = "B"; $cssci = "bayan";}
                else if($cinsiyet == 6) { $cinsiyeta = "Ç"; $cssci = "cift";}
                else if($cinsiyet == 7) { $cinsiyeta = "E"; $cssci = "erkek";}
                else if($cinsiyet == 8) { $cinsiyeta = "T"; $cssci = "erkek";}
                else { $cinsiyeta = "B"; $cssci = "bayan";}

               ?>
                <li class="list-group-item li<?=$seviyead?> li<?=$cssci?>">
                    <span class="avatar"><a href="javascript:;" onclick="$.profil(<?=$uye?>)" style="color:<?=$seviyerenk?>;"><img src="<?=$img?>" /></a></span>
                    <span class="nickname"<a href="javascript:;" onclick="$.profil(<?=$uye?>)" style="color:<?=$seviyerenk?>;"><?=turkcejquery($ad)?></a></span>
                    <span class="sehir"><?=turkcejquery($sehir)?></span>
                    <span class="yas">Yaş <?=$yas?></span>
                    <span class="islem">
                    <a href="javascript:;" class="cinsiyet <?=$cssci?>"> <?=$cinsiyeta?> </a>
                    <a href="javascript:;" onclick="$.mesaj('<?=turkcejquery($ad)?>', <?=$uye?>, <?= $uyeid ?>, <?=seviyeal("mesaj");?>)" class="fa fa-comment-dots"></a>
                    <a href="javascript:;" onclick="$.profil(<?=$uye?>)" class="fa fa-info-circle"></a>
                </span>
                </li>
                <?php


            }

            ?>



        </ul>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    </div>
<?php

cache_bitir();
