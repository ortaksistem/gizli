<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");
?>
<h1 class="title">Arama</h1>
<div class="arama">
    <form action="javascript:void(0)" id="aramaform">
    <div class="baslik">Rumuz ile ara</div>
    <input type="text" class="form-control rumuz" name="rumuz" placeholder="Rumuzu yazınız"><span>Aramak istediğiniz rumuzu buraya yazınız.</span>
    <button class="btn btn-danger btn-block" onclick="$.aramayap('rumuz', <?=seviyeal('arama');?>, 1)"><i class="fa fa-search"></i> Rumuz ile ara</button>
    <div class="clearfix"></div>
    <div class="baslik">Aradığınız Cinsiyet</div>
    <div class="custom-control custom-checkbox cinsiyet">
        <input type="checkbox" class="custom-control-input" name="cinsiyet[]" value="1">
        <label class="custom-control-label">Bayan</label>
    </div>
    <div class="custom-control custom-checkbox cinsiyet">
        <input type="checkbox" class="custom-control-input" name="cinsiyet[]" value="2">
        <label class="custom-control-label">Çift</label>
    </div>
    <div class="custom-control custom-checkbox cinsiyet">
        <input type="checkbox" class="custom-control-input" name="cinsiyet[]" value="3">
        <label class="custom-control-label">Erkek</label>
    </div>
    <div class="clearfix"></div>
    <div class="baslik">Aradığınız Şehir</div>
    <select name="ulke" class="form-control" onchange="$.sehirgetir(this.value)">
        <option value="farketmez">Farketmez</option>
        <?php
            $result = @mysql_query("select id, adi from "._MX."ulkeler order by adi asc");

            while(list($id, $adi) = @mysql_fetch_row($result)){

                $adi = turkcejquery($adi);
                if($id == 214) $selected = " selected";
                else $selected = NULL;
                echo '<option value="'.$adi.'"'.$selected.'>'.$adi.'</option>';
            }

        ?>
    </select>
    <select name="sehir" class="form-control">
        <option value="farketmez">Farketmez</option>
        <?php
        $result = @mysql_query("select id, adi from "._MX."sehirler where ulke='214' order by adi asc");

        while(list($id, $adi) = @mysql_fetch_row($result)){

            $adi = turkcejquery($adi);
            echo '<option value="'.$adi.'">'.$adi.'</option>';
        }

        ?>
    </select>
    <div class="clearfix"></div>
    <div class="baslik">Aradığınız Yaş Aralığı ve Medeni Durum</div>
    <div class="yasvemedeni">
        <select name="yas1" class="form-control">
            <?php
                for($i = 21; $i<=45;$i++) echo '<option value="'.$i.'">'.$i.'</option>';

            ?>
        </select>
        <select name="yas2" class="form-control">
            <?php
            for($i = 65; $i>=45;$i--) echo '<option value="'.$i.'">'.$i.'</option>';

            ?>
        </select>
        <select name="medenidurum" class="form-control">
            <option value="farketmez">Farketmez</option>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='16'");
            $i = 1;
            while(list($ad) = mysql_fetch_row($result)) {
                $ad = turkcejquery(stripslashes($ad));
                echo '<option value="'.$ad.'">'.$ad.'</option>';
            }
            ?>
        </select>
    </div>
    <button class="btn btn-danger btn-block" style="margin-top:55px" onclick="$.aramayap('diger', <?=seviyeal('arama');?>, 1)"><i class="fa fa-search"></i> Arama Yap</button>
    </form>
</div>


<p>&nbsp; </p>
<p>&nbsp; </p>
<p>&nbsp; </p>