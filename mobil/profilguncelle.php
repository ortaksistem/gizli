<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = turkcejquery(uyeadi());

$result = mysql_query("select * from "._MX."uye where id='$uyeid'");

$rowla = mysql_fetch_array($result);

$songiris = $rowla["sononline2"];

$songiris2 = mobiltarihdon($songiris);
$songiris = date("H:i", $songiris);

$bitis = $rowla["bitis"];

if($bitis){
    $bitis = mobiltarihdon($bitis);
}
else {
    $bitis = "Sınırsız";
}

$dogum = $rowla["dogum"];

$dogum = mobiltarihdon($dogum);

$cinsiyet = $rowla["cinsiyet"];

$cinsiyet = turkcejquery(cinsiyet($cinsiyet));

$goruntulenme = $rowla["goruntulenme"];

$seviye = $rowla["seviye"];

$seviyeicon = seviyeal("seviyeicon");

$seviyerenk = seviyeal("renk");

$seviyead = seviyeal("seviyead");

$ay = date("m");

$yil = date("Y");

$resultpuan = mysql_query("select toplamoy, toplampuan from "._MX."uye_oy where uye='$uyeid' and ay='$ay' and yil='$yil'");

list($toplamoy, $toplampuan) = mysql_fetch_row($resultpuan);

if($toplamoy){
    $aylikpuan = "<b>$toplamoy</b> üyeden <b>$toplampuan</b> aldınız";
}
else {
    $aylikpuan = "<b>Bu ay hiç oy almadınız</b>";
}

?>
<h1 class="title">Profil Bilgileriniz <a href="javascript:void(0)" onclick="$.profilgoster('bilgiler', 1)" class="profilguncelleicon"><i class="fa fa-search-plus"></i></a></h1>

<div class="profilguncelle">

    <div class="bilgiler" id="bilgiler">
        <ul>
            <li><span><i class="fa fa-user"></i> Üye Adınız</span>: <?=$uyeadi?> </li>
            <li><span><i class="fa fa-venus-mars"></i> Cinsiyetiniz</span>: <?=$cinsiyet?> </li>
            <li><span><i class="fa fa-birthday-cake"></i> Doğum Tarihiniz</span>: <?=$dogum?> </li>
            <li><span><i class="fa fa-glasses"></i> Son Ziyaretiniz</span>: <?=$songiris2?> </li>
            <li><span><i class="fa fa-layer-group"></i> Üyelik Seviyeniz</span>: <b><font color="<?=$seviyerenk?>"><?=$seviyead?></font></b></li>
            <li><span><i class="fa fa-calendar-times"></i> Üyelik Bitişi</span>: <?=$bitis?> </li>
            <li><span><i class="fa fa-star"></i> Bu Ayki Puanınız</span>: <?=$aylikpuan?> </li>
            <li><span><i class="fa fa-search-location"></i> Profil Ziyaret Sayınız</span>: <b><?=$goruntulenme?></b> kez profiliniz ziyaret edilmiştir.</li>
        </ul>
    </div>
    <div class="clearfix"></div>

</div>

<h1 class="title"><a href="javascript:void(0)" onclick="$.profilgoster('kisiselbilgiler', 1)">Kişisel Bilgileriniz</a> <a href="javascript:void(0)" onclick="$.profilgoster('kisiselbilgiler', 1)" class="profilguncelleicon"><i class="fa fa-search-plus"></i></a></h1>

<div class="profilguncelle" id="kisiselbilgiler" style="display: none;">
    <form action="javascript:void(0)" id="kisiselbilgilerform">
    <div class="bilgiler">
        <div class="form-group">
            <label>Adınız</label>
            <input class="form-control" name="ad" placeholder="Adınız" value="<?=turkcejquery(stripslashes($rowla["ad"]))?>">
        </div>
        <div class="form-group">
            <label>Soyadınız</label>
            <input class="form-control" name="soyad" placeholder="Soyadınız" value="<?=turkcejquery(stripslashes($rowla["soyad"]))?>">
        </div>
        <?php
        list($tel1, $tel2) = explode("-", $rowla["tel"]);

        ?>
        <div class="form-group" style="height: 30px;">
            <label class="labels">Telefon Numaranız Örn : 555 5555555</label>
            <input class="form-control tel1" name="no1" placeholder="xxx" maxlength="3" value="<?=$tel1?>">
            <input class="form-control tel2" name="no2" placeholder="xxxxxxx" maxlength="7" value="<?=$tel2?>">
        </div>
        <?php

        list($dogum1, $dogum2, $dogum3) = explode(",", date("d,m,Y", $rowla["dogum"]));

        function aylarimiz($param){

            $aylar = array("", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");

            if(strstr($param, "0")) $param = str_replace("0", "", $param);

            for($i = 1; $i<=12; $i++) {
                if($i == $param) echo "<option value=\"$i\" selected>$aylar[$i]</option>";
                else echo "<option value=\"$i\">$aylar[$i]</option>";
            }

        }
        ?>
        <div class="clearfix"></div>
        <div class="form-group">
            <label class="dogum4 labels">Doğum Tarihiniz</label>
            <select name="d1" class="form-control dogum1">
                <?php
                for($i = 1; $i<=31; $i++){
                    if($i == $dogum1) $selected = " selected";
                    else $selected = NULL;
                    echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                }

                ?>
            </select>
            <select name="d2" class="form-control dogum2">
               <?=aylarimiz($dogum2);?>
            </select>
            <input class="form-control dogum3" name="d3" placeholder="19xx" value="<?=$dogum3?>">
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label class="labels">Ülke</label>
            <select name="ulke" class="form-control" onchange="$.sehirgetir(this.value)">
                <?php
                $result = @mysql_query("select id, adi from "._MX."ulkeler order by adi asc");

                while(list($id, $adi) = @mysql_fetch_row($result)){

                    $adi = turkcejquery($adi);
                    if($adi == turkcejquery($rowla["ulke"])) $selected = " selected";
                    else $selected = NULL;
                    echo '<option value="'.$adi.'"'.$selected.'>'.$adi.'</option>';
                }

                ?>
            </select>
        </div>
        <div class="clearfix"></div>
        <div class="form-group arama">
            <label class="labels">Şehir</label>
            <select name="sehir" class="form-control" style="width:100%">
                <?php
                $result = @mysql_query("select id, adi from "._MX."sehirler where ulke='214' order by adi asc");

                while(list($id, $adi) = @mysql_fetch_row($result)){

                    $adi = turkcejquery($adi);
                    if($adi == turkcejquery($rowla["sehir"])) $selected = " selected";
                    else $selected = NULL;
                    echo '<option value="'.$adi.'"'.$selected.'>'.$adi.'</option>';
                }

                ?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-danger" onclick="$.profilguncelle('kisiselbilgiler')"><i class="fa fa-save"></i> Bilgileri Kaydet</button>
        </div>
    </div>
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="clearfix"></div>
</div>
<p>&nbsp;</p>

<?php
$tanitimonay = $rowla["tanitimonay"];
$tanitim = stripslashes(turkcejquery($rowla["tanitim"]));

if($tanitimonay == 1) $tanitimonay = "<a href='javascript:void(0)' data-toggle='tooltip' title='Onaylandı'> <font color=green><i class='fa fa-check-circle'></i></font></a>";
elseif($tanitimonay == 3) $tanitimonay = "<font style='color:red; font-size:12px'>Editör Reddetmiş</font>";
else $tanitimonay = "<font style='color:red; font-size:12px'>Onay Bekliyor</font>";
?>

<h1 class="title"><a href="javascript:void(0)" onclick="$.profilgoster('tanitimyazisi', 1)">Profil Tanıtım Yazısı</a> <?=$tanitimonay?> <a href="javascript:void(0)" onclick="$.profilgoster('tanitimyazisi', 1)" class="profilguncelleicon"><i class="fa fa-search-plus"></i></a></h1>

<div class="profilguncelle" id="tanitimyazisi" style="display: none;">
    <form action="javascript:void(0)" id="tanitimyazisiform">
    <div class="bilgiler">
        <p>	
Kendinizi ve de aradığınız kişiyi tanıtan kısa bir yazı sizden istenmektedir. Bu yazıyı yazmanız ve aşağıdaki uyarılara dikkat ederek kabul edilmeyen profil yazısı yazmamanız profil yazınızın kabul edilmesini sağlayacaktır..</p>
		<p>Red edilme veya silinmeye neden olacak uyarılar aşağıdadır ;
Aşağıdaki uyarılara ve benzerlerine dikkat ederek hazırlayacağınız profil yazılarınız için teşekküre ederiz.</p>
		<p>Ben yazmam, ben sevmem, ben anlatılmam yaşanırım, tanımak isteyen tanır, ben uçarım, ben şuyum buyum, bunları yazmayı sevmem, noktalama işaretleri, telefon numarası, çaktırmadan skype adresi vermeye çalışmak.</p>
		<p>Zeki olan anlar şeklinde msn adresi vermeye çalışma vb. profil yazısı ile alakası olmayan yazılar, argo ve müstehcen olarak tanımlanabilecek kelimelerin olduğu, manasız yazılar yazmayınız bu tip profiller Editörler tarafından silinmektedir.</p>
        <div class="form-group">
            <label>Tanıtım Yazısı</label>
            <textarea class="form-control" name="tanitim" rows="6" placeholder="Profil tanıtım yazısınızı buraya yazınız"><?=$tanitim?></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-danger" onclick="$.profilguncelle('tanitimyazisi')"><i class="fa fa-save"></i> Tanıtım Yazısını Güncelle</button>
        </div>
    </div>
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="clearfix"></div>

</div>
<p>&nbsp;</p>

<?php

/*
<h1 class="title"><a href="javascript:void(0)" onclick="$.profilgoster('ilgialanlari', 1)">İlgi Alanlarınız</a> <a href="javascript:void(0)" onclick="$.profilgoster('ilgialanlari', 1)" class="profilguncelleicon"><i class="fa fa-search-plus"></i></a></h1>

<div class="profilguncelle" id="ilgialanlari" style="display: none;">
    <form action="javascript:void(0)" id="ilgialanlariform">
        <div class="bilgiler">
            <div class="baslik">Hobileriniz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='12'");
            $veri = turkcejquery($rowla["hobiler"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="checkbox" class="custom-control-input" name="hobiler[]" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <div class="baslik">Beğenileriniz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='13'");
            $veri = turkcejquery($rowla["begeniler"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="checkbox" class="custom-control-input" name="begeniler[]" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <div class="baslik">Sevdiğiniz Filmler</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='14'");
            $veri = turkcejquery($rowla["filmler"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="checkbox" class="custom-control-input" name="filmler[]" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <div class="baslik">Hoşlandığınız Tipler</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='15'");
            $veri = turkcejquery($rowla["tipler"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="checkbox" class="custom-control-input" name="tipler[]" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <div class="form-group">
                <button class="btn btn-danger" onclick="$.profilguncelle('ilgialanlari')"><i class="fa fa-save"></i> İlgi Alanlarınız Kaydet</button>
            </div>
        </div>
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="clearfix"></div>

</div>

<p>&nbsp;</p>
*/
?>

<h1 class="title"><a href="javascript:void(0)" onclick="$.profilgoster('profilbilgileri', 1)">Profil Bilgieriniz</a> <a href="javascript:void(0)" onclick="$.profilgoster('profilbilgileri', 1)" class="profilguncelleicon"><i class="fa fa-search-plus"></i></a></h1>

<div class="profilguncelle" id="profilbilgileri" style="display: none;">
    <form action="javascript:void(0)" id="profilbilgileriform">
        <div class="bilgiler">
            <div class="baslik">Medeni Durum</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='16'");
            $veri = turkcejquery($rowla["medenidurum"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="radio" class="custom-control-input" name="medenidurum" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <div class="baslik">Kiminle Yaşıyorsunuz ?</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='1'");
            $veri = turkcejquery($rowla["kiminle"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="radio" class="custom-control-input" name="kiminle" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            /*
            ?>
            <div class="clearfix"></div>
            <div class="baslik">Webcamınız Var Mı ?</div>
            <?php
            $veri = $rowla["webcam"];

            if($veri == "Evet"){
                $checked = " checked";
                $checked1 = NULL;
            }
            else {
                $checked1 = " checked";
                $checked = NULL;
            }
            unset($veri);


                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="radio" class="custom-control-input" name="webcam" value="Evet"<?=$checked?>>
                    <label class="custom-control-label">Evet</label>
                </div>
                <div class="custom-control custom-checkbox inputs">
                    <input type="radio" class="custom-control-input" name="webcam" value="Hayır"<?=$checked1?>>
                    <label class="custom-control-label">Hayır</label>
                </div>
            <div class="clearfix"></div>
            <div class="baslik">Webcam Sohbetten Hoşlanır Mısınız ?</div>
            <?php
            $veri = $rowla["webcamsohbet"];

            if($veri == "Evet"){
                $checked = " checked";
                $checked1 = NULL;
            }
            else {
                $checked1 = " checked";
                $checked = NULL;
            }
            unset($veri);


            ?>
            <div class="custom-control custom-checkbox inputs">
                <input type="radio" class="custom-control-input" name="webcamsohbet" value="Evet"<?=$checked?>>
                <label class="custom-control-label">Evet</label>
            </div>
            <div class="custom-control custom-checkbox inputs">
                <input type="radio" class="custom-control-input" name="webcamsohbet" value="Hayır"<?=$checked1?>>
                <label class="custom-control-label">Hayır</label>
            </div>
            <div class="clearfix"></div>
            <?php
            */
            ?>
            <div class="clearfix"></div>
            <div class="baslik">Aradığınız İlişki Türü</div>
            <?php

            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='2'");
            $veri = turkcejquery($rowla["iliski"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="checkbox" class="custom-control-input" name="iliski[]" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <div class="baslik">Aradığınız Cinsiyet</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='18'");
            $veri = turkcejquery($rowla["aracinsiyet"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="checkbox" class="custom-control-input" name="aracinsiyet[]" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>

            <?php

            $cinsiyet = $rowla["cinsiyet"];

            if($cinsiyet == 2){
                ?>
                <div class="baslik">Boyunuz</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
                $veri = turkcejquery($rowla["boy"]);
                $veri = explode("::", $veri);
                $veri = $veri[0];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="boy" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <div class="baslik">Boyunuz (Eşinizin)</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
                $veri = turkcejquery($rowla["boy"]);
                $veri = explode("::", $veri);
                $veri = $veri[1];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="boyes" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
            <?php
            } else {
                ?>
                <div class="baslik">Boyunuz</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
                $veri = turkcejquery($rowla["boy"]);

                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="boy" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
            <?php
            } // boy

            if($cinsiyet == 2){
                ?>
                <div class="baslik">Kilonuz</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
                $veri = turkcejquery($rowla["kilo"]);
                $veri = explode("::", $veri);
                $veri = $veri[0];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="kilo" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <div class="baslik">Kilonuz (Eşinizin)</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
                $veri = turkcejquery($rowla["kilo"]);
                $veri = explode("::", $veri);
                $veri = $veri[1];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="kiloes" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <?php
            } else {
                ?>
                <div class="baslik">Kilonuz</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
                $veri = turkcejquery($rowla["kilo"]);

                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="kilo" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <?php
            } // kilo

            if($cinsiyet == 2){
            ?>
            <div class="baslik">Göz Renginiz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='7'");
            $veri = turkcejquery($rowla["goz"]);
            $veri = explode("::", $veri);
            $veri = $veri[0];
            while(list($ad) = mysql_fetch_row($result)){
            $ad = stripslashes(turkcejquery($ad));

            if(strstr($veri, $ad)) $checked = " checked";
            else $checked = NULL;

            ?>
            <div class="custom-control custom-checkbox inputs">
                <input type="radio" class="custom-control-input" name="goz" value="<?=$ad?>"<?=$checked?>>
                <label class="custom-control-label"><?=$ad?></label>
            </div>
            <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <div class="baslik">Göz Renginiz (Eşinizin)</div>
            <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='7'");
            $veri = turkcejquery($rowla["goz"]);
            $veri = explode("::", $veri);
            $veri = $veri[1];
            while(list($ad) = mysql_fetch_row($result)){
            $ad = stripslashes(turkcejquery($ad));

            if(strstr($veri, $ad)) $checked = " checked";
            else $checked = NULL;

            ?>
            <div class="custom-control custom-checkbox inputs">
                <input type="radio" class="custom-control-input" name="gozes" value="<?=$ad?>"<?=$checked?>>
                <label class="custom-control-label"><?=$ad?></label>
            </div>
            <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <?php
            } else {
                ?>
            <div class="baslik">Göz Renginiz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='7'");
            $veri = turkcejquery($rowla["goz"]);

            while(list($ad) = mysql_fetch_row($result)){
            $ad = stripslashes(turkcejquery($ad));

            if(strstr($veri, $ad)) $checked = " checked";
            else $checked = NULL;

            ?>
            <div class="custom-control custom-checkbox inputs">
                <input type="radio" class="custom-control-input" name="goz" value="<?=$ad?>"<?=$checked?>>
                <label class="custom-control-label"><?=$ad?></label>
            </div>
            <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <?php
            } // goz


            if($cinsiyet == 2){
                ?>
                <div class="baslik">Vücut Yapınız</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='6'");
                $veri = turkcejquery($rowla["vucut"]);
                $veri = explode("::", $veri);
                $veri = $veri[0];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="vucut" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <div class="baslik">Vücut Yapınız (Eşinizin)</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='6'");
                $veri = turkcejquery($rowla["vucut"]);
                $veri = explode("::", $veri);
                $veri = $veri[1];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="vucutes" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <?php
            } else {
                ?>
                <div class="baslik">Vucüt Yapınız</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='6'");
                $veri = turkcejquery($rowla["vucut"]);

                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="vucut" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <?php
            } // vucut


            if($cinsiyet == 2){
                ?>
                <div class="baslik">Saç Renginiz</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='8'");
                $veri = turkcejquery($rowla["sac"]);
                $veri = explode("::", $veri);
                $veri = $veri[0];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="sac" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <div class="baslik">Saç Renginiz (Eşinizin)</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='8'");
                $veri = turkcejquery($rowla["sac"]);
                $veri = explode("::", $veri);
                $veri = $veri[1];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="saces" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <?php
            } else {
                ?>
                <div class="baslik">Saç Renginiz</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='8'");
                $veri = turkcejquery($rowla["sac"]);

                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="sac" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <?php
            } // sac


            if($cinsiyet == 2){
            ?>
            <div class="baslik">İlişki Deneyiminiz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='17'");
            $veri = turkcejquery($rowla["deneyim"]);
            $veri = explode("::", $veri);
            $veri = $veri[0];
            while(list($ad) = mysql_fetch_row($result)){
            $ad = stripslashes(turkcejquery($ad));

            if(strstr($veri, $ad)) $checked = " checked";
            else $checked = NULL;

            ?>
            <div class="custom-control custom-checkbox inputs">
                <input type="radio" class="custom-control-input" name="deneyim" value="<?=$ad?>"<?=$checked?>>
                <label class="custom-control-label"><?=$ad?></label>
            </div>
            <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <div class="baslik">İlişki Deneyiminiz (Eşinizin)</div>
            <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='17'");
            $veri = turkcejquery($rowla["deneyim"]);
            $veri = explode("::", $veri);
            $veri = $veri[1];
            while(list($ad) = mysql_fetch_row($result)){
            $ad = stripslashes(turkcejquery($ad));

            if(strstr($veri, $ad)) $checked = " checked";
            else $checked = NULL;

            ?>
            <div class="custom-control custom-checkbox inputs">
                <input type="radio" class="custom-control-input" name="deneyimes" value="<?=$ad?>"<?=$checked?>>
                <label class="custom-control-label"><?=$ad?></label>
            </div>
            <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <?php
            } else {
                ?>
            <div class="baslik">İlişki Deneyiminiz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='17'");
            $veri = turkcejquery($rowla["deneyim"]);

            while(list($ad) = mysql_fetch_row($result)){
            $ad = stripslashes(turkcejquery($ad));

            if(strstr($veri, $ad)) $checked = " checked";
            else $checked = NULL;

            ?>
            <div class="custom-control custom-checkbox inputs">
                <input type="radio" class="custom-control-input" name="deneyim" value="<?=$ad?>"<?=$checked?>>
                <label class="custom-control-label"><?=$ad?></label>
            </div>
            <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <?php
            } // deneyim

            if($cinsiyet == 2){
                ?>
                <div class="baslik">Bakımlı Mısınız?</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='19'");
                $veri = turkcejquery($rowla["bakim"]);
                $veri = explode("::", $veri);
                $veri = $veri[0];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="bakim" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <div class="baslik">Bakımlı Mısınız? (Eşinizin)</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='19'");
                $veri = turkcejquery($rowla["bakim"]);
                $veri = explode("::", $veri);
                $veri = $veri[1];
                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="bakimes" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <?php
            } else {
                ?>
                <div class="baslik">Bakımlı Mısınız?</div>
                <?php
                $result = mysql_query("select ad from "._MX."uye_secenekler where tur='19'");
                $veri = turkcejquery($rowla["bakim"]);

                while(list($ad) = mysql_fetch_row($result)){
                    $ad = stripslashes(turkcejquery($ad));

                    if(strstr($veri, $ad)) $checked = " checked";
                    else $checked = NULL;

                    ?>
                    <div class="custom-control custom-checkbox inputs">
                        <input type="radio" class="custom-control-input" name="bakim" value="<?=$ad?>"<?=$checked?>>
                        <label class="custom-control-label"><?=$ad?></label>
                    </div>
                    <?
                }
                unset($veri);
                ?>
                <div class="clearfix"></div>
                <?php
            } // bakim
            /*
            ?>

            <div class="baslik">Karakter Özellikleriniz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='3'");
            $veri = turkcejquery($rowla["karakter"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="checkbox" class="custom-control-input" name="karakter[]" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <?php
            */
            ?>
            <div class="baslik">Eğitim Durumunuz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='9'");
            $veri = turkcejquery($rowla["egitim"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="radio" class="custom-control-input" name="egitim" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>

            <div class="baslik">Çalışma Durumunuz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='11'");
            $veri = turkcejquery($rowla["calisma"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="radio" class="custom-control-input" name="calisma" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>

            <div class="baslik">Mesleğiniz</div>
            <?php
            $result = mysql_query("select ad from "._MX."uye_secenekler where tur='10'");
            $veri = turkcejquery($rowla["meslek"]);

            while(list($ad) = mysql_fetch_row($result)){
                $ad = stripslashes(turkcejquery($ad));

                if(strstr($veri, $ad)) $checked = " checked";
                else $checked = NULL;

                ?>
                <div class="custom-control custom-checkbox inputs">
                    <input type="radio" class="custom-control-input" name="meslek" value="<?=$ad?>"<?=$checked?>>
                    <label class="custom-control-label"><?=$ad?></label>
                </div>
                <?
            }
            unset($veri);
            ?>
            <div class="clearfix"></div>
            <div class="form-group">
                <button class="btn btn-danger" onclick="$.profilguncelle('profilbilgileri')"><i class="fa fa-save"></i> Profil Bilgilerini Güncelle</button>
            </div>
        </div>
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="clearfix"></div>

</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
