<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$adi = uyebilgi("ad") ." ". uyebilgi("soyad");

$adi = turkcejquery($adi);

$tel = "+9". uyebilgi("tel");

$tel = str_replace("-", "", $tel);

$eposta = uyebilgi("email");

?>
<h1 class="title">Üyelik Yükselt</h1>
<div class="container-fluid uyelikyukselt">
    <p><span style="font-size: 11pt;"><b><span style="color: #dd2e2e;">LARGE</span> ÜYELİK</b></span></p>
    <p><span style="font-size: 11pt;">Large üye olduğunuz taktirde sistemde ki tüm
        faliyetlerden kısıtlama olmadan faydanalacaksınız.</p>
<span style="font-size: 11pt;"><strong>* Günlük sınırsız mesaj atabilirler</strong></span><br>
<span style="font-size: 11pt;"><strong>* Üyelere günde sınırsız öpücük, çiçek yollayabilirler.</strong><br>
<span style="font-size: 11pt;"><strong>* Aramalarda en üst sırada yer alırlar.</strong><br>

    <p class="text-center">
    <form action="javascript:void(0)" id="uyelikyukseltformu">
        <input type="hidden" name="ne" value="">
        <?php
        $result = mysql_query("select aylik, aylik3, aylik6, yillik, sinirsiz from "._MX."seviye where id='1'");

        list($aylik, $aylik3, $aylik6, $yillik, $sinirsiz) = mysql_fetch_row($result);

        ?>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$aylik?>, '1;aylik')"><span class="adi"><i class="fas fa-circle"></i> 1 AYLIK LARGE ÜYELİK</span><span class="fiyati"><?=$aylik?> TL</span></button>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$aylik3?>, '1;aylik3')"><span class="adi"><i class="fas fa-circle"></i> 3 AYLIK LARGE ÜYELİK</span><span class="fiyati"><?=$aylik3?> TL</span></button>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$aylik6?>, '1;aylik6')"><span class="adi"><i class="fas fa-circle"></i> 6 AYLIK LARGE ÜYELİK</span><span class="fiyati"><?=$aylik6?> TL</span></button>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$yillik?>, '1;yillik')"><span class="adi"><i class="fas fa-circle"></i> YILLIK LARGE ÜYELİK</span><span class="fiyati"><?=$yillik?> TL</span></button>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$sinirsiz?>, '1;sinirsiz')"><span class="adi"><i class="fas fa-circle"></i> SINIRSIZ LARGE ÜYELİK</span><span class="fiyati"><?=$sinirsiz?> TL</span></button>
    </p>
</div>

<h1 class="title title2">&nbsp; </h1>

<div class="container-fluid uyelikyukselt mediumuyelik">
	<p><span style="font-size: 11pt;"><b><span style="color: #0072cc;">MEDİUM</span> ÜYELİK</b></span></p>
    <p><span style="font-size: 11pt;">Üyeliğinizi yükselterek site içerisinde ki tüm
        faliyetlerden sınırsız faylanabilir, Sohbet odalarına
        girip yeni arkadaşlar edinibilirsiniz.</p>
<span style="font-size: 11pt;"><strong>* Günlük 25 mesaj atabilirler.</strong><br>
<span style="font-size: 11pt;"><strong>* Üyelere günde 15 adet öpücük, çiçek yollayabilirler.</strong><br>
<span style="font-size: 11pt;"><strong>* Aramalarda Large üyelerden sonra gösterirler.</strong><br><br>
    <p class="text-center">

        <?php
        $result = mysql_query("select aylik, aylik3, aylik6, yillik, sinirsiz from "._MX."seviye where id='2'");

        list($aylik, $aylik3, $aylik6, $yillik, $sinirsiz) = mysql_fetch_row($result);

        ?>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$aylik?>, '2;aylik')"><span class="adi"><i class="fas fa-circle"></i> 1 AYLIK MEDİUM ÜYELİK</span><span class="fiyati"><?=$aylik?> TL</span></button>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$aylik3?>, '2;aylik3')"><span class="adi"><i class="fas fa-circle"></i> 3 AYLIK MEDİUM ÜYELİK</span><span class="fiyati"><?=$aylik3?> TL</span></button>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$aylik6?>, '2;aylik6')"><span class="adi"><i class="fas fa-circle"></i> 6 AYLIK MEDİUM ÜYELİK</span><span class="fiyati"><?=$aylik6?> TL</span></button>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$yillik?>, '2;yillik')"><span class="adi"><i class="fas fa-circle"></i> YILLIK MEDİUM ÜYELİK</span><span class="fiyati"><?=$yillik?> TL</span></button>
        <button class="btn btn-danger btn-block text-left" onclick="$.uyeliktipi(<?=$sinirsiz?>, '2;sinirsiz')"><span class="adi"><i class="fas fa-circle"></i> SINIRSIZ MEDİUM ÜYELİK</span><span class="fiyati"><?=$sinirsiz?> TL</span></button>

    </p>
</div>
<h1 class="title">Bir Ödeme Yöntemi Seçin</h1><br>
<span style="font-size: 11pt;"><strong>Ödeme yaptıktan sonra sistemden güvenli çıkış yaparak yeniden giriniz..</strong><br>
<div class="container-fluid uyelikyukselt">
    <p class="text-center">
        <button class="btn btn-danger" onclick="$.uyelikodemetipi('bankahavalesi')"><i class="fa fa-university"></i> BANKA HAVALESİ </button>
        <button class="btn btn-danger" onclick="$.uyelikodemetipi('kredikarti')"><i class="fa fa-money-check-alt"></i> KREDİ KARTI </button>
    </p>

    <div class="bankahavalesi" style="display: none;">
        <div class="bankalar">
            <div class="banka">
                <div class="bankaresmi"><img src="assets/img/garanti.jpg"></div>
                <div class="bankaadi">Sezgin Akdemirci<br />
                    Iban : TR50 0006 2000 3490 0006 6783 69
                </div>
            </div>
            <div class="banka">
                <div class="bankaresmi"><img src="assets/img/enpara.jpg"></div>
                <div class="bankaadi">Sezgin Akdemirci<br />
                    Iban : TR66 0011 1000 0000 0080 0005 55
                </div>
            </div>
            <div class="banka">
                <div class="bankaresmi"><img src="assets/img/is.jpg"></div>
                <div class="bankaadi">Sezgin Akdemirci<br />
                    Iban : TR12 0006 4000 0011 0062 2482 82
                </div>
            </div>
        </div>


        <div class="container-fluid odemeformu">
            <span class="odemeadi">BANKA HAVALESİ</span>
            <span class="tutar">Seçim yapılmadı</span>
            <input type="text" id="havalead" class="form-control btn-block" placeholder="Ödeme yapan adı soyadı" value="<?=$adi?>">
            <input type="text" id="havaletel" class="form-control btn-block" placeholder="Telefon numaranız" value="<?=$tel?>">
            <input type="text" id="havaleeposta" class="form-control btn-block" placeholder="E-posta adresiniz" value="<?=$eposta?>">
            <select class="form-control btn-block" id="havalebanka">
                <option value="Garanti Bankası">Garanti Bankası</option>
                <option value="Enpara">Enpara</option>
                <option value="İş Bankası">İş Bankası</option>
            </select>
            <textarea class="form-control btn-block" id="havalemesaj" placeholder="Eklemek istedikleriniz"></textarea>
        </div>
        <button class="btn btn-danger btn-block" onclick="$.uyelikyukselthavale()"><i class="fa fa-share"></i> BİLGİLERİ GÖNDER </button>
    </div>

    <div class="kredikarti" style="display: none;">
        <div class="container-fluid odemeformu">
            <span class="odemeadi">KREDİ KARTI</span>
            <span class="tutar">Seçim yapılmadı</span>
            <input type="text" id="kkad" class="form-control btn-block" placeholder="Ödeme yapan adı soyadı" value="<?=$adi?>">
            <input type="text" id="kktel" class="form-control btn-block" placeholder="Telefon numaranız" value="<?=$tel?>">
            <input type="text" id="kkeposta" class="form-control btn-block" placeholder="E-posta adresiniz" value="<?=$eposta?>">

            <p>&nbsp;</p>
            <div class='form-row'>
                <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Kart Üzerindeki İsim</label>
                    <input id="kkisim" class='form-control' type='text' placeholder="Kart Üzerindeki İsim">
                </div>
            </div>
            <div class='form-row'>
                <div class='col-xs-12 form-group card required'>
                    <label class='control-label labelimiz'>Kart No</label>
                    <input id="kknum1" autocomplete='off' class='form-control card-number' type='text' placeholder="xxxx" maxlength="4">
                    <input id="kknum2" autocomplete='off' class='form-control card-number' type='text' placeholder="xxxx" maxlength="4">
                    <input id="kknum3" autocomplete='off' class='form-control card-number' type='text' placeholder="xxxx" maxlength="4">
                    <input id="kknum4" autocomplete='off' class='form-control card-number' type='text' placeholder="xxxx" maxlength="4">
                </div>
            </div>
            <div class='form-row'>
                <div class='col-xs-4 form-group cvc required'>
                    <label class='control-label'>CVC</label>
                    <input autocomplete='off' id="kkcvc" class='form-control card-cvc' placeholder='Örn : 311' size='4' type='text' maxlength="3">
                </div>
                <div class='col-xs-4 form-group expiration required'>
                    <label class='control-label'>Ay</label>
                    <select id="kkay" class="form-control">
                        <?php
                        for($i = 1; $i<=12; $i++){

                            if($i < 10) echo '<option value="0'.$i.'">0'.$i.'</option>';
                            else echo '<option value="'.$i.'">'.$i.'</option>';

                        }
                        ?>
                    </select>
                </div>
                <div class='col-xs-4 form-group expiration required'>
                    <label class='control-label'>Yıl</label>
                    <select id="kkyil" class="form-control">
                        <?php
                        $yil = date("y");
                        for($i = $yil; $i<=$yil+10; $i++){

                            echo '<option value="'.$i.'">'.$i.'</option>';

                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-danger btn-block" onclick="$.uyelikyukseltkredikarti()"><i class="fa fa-share"></i> ÖDEMEYİ YAP </button>

        </form>
    </div>

</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>