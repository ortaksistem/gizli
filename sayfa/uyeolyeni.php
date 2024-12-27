<?php
function aylar($param){
	
	$aylar = array("", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
	
	if($param){
		return $aylar[$param];
	}
	else {
		for($i = 1; $i<=12; $i++) {
			echo "<option value=\"$i\">$aylar[$i]</option>";
		}
	}
	
}

function cinsiyetimiz($param){

	$cinsiyet = array("", "Bayan", "Çift", "Erkek");
	
	if($param){
		return $cinsiyet[$param];
	}
	else {
		$sayi = count($cinsiyet);
		
		for($i = 1; $i<$sayi; $i++){
			echo "<option value=\"$i\">$cinsiyet[$i]</option>";
		}
	}

}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Ücretsiz Partner Sitesi - Sevgilin.net</title>
	<meta name="description" content="Sıradanlıktan ve Birbirne Benzeyen Sitelerden Sıkıldınız Mı? Bildiklerinizi Unutma Zamanı. Türkiye'nin En Büyük Partner Bulma Sitesi ile Tanışın">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/uyeol.css">
    <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="/icon.png"/>

</head>
<body>
<div class="main">
    <div class="header">
        <div class="yp">
            <div class="title"><span style="color: #ffffff;"><a style="color: #ffffff;" href="https://www.sevgilin.net">YATAKPARTNER</a></span></div>
            <p>Hayallerinizi Ertelemeyin</p>
        </div>
    </div>
    <div class="headermenu">&nbsp;</div>

    <div class="content">

        <div class="form">
            <div class="title">Üye Ol</div>
            <div class="line"></div>
            <ul>
                <li> Adınız <input type="text" name="ad" /> </li>
                <li> Soyadınız <input type="text" name="soyad" /> </li>
                <li>Doğum Tarihiniz
                    <select style="width: 65px;right:150px;" name="d1">
                        <option value="sec">Seçin</option>
                        <?php
							for($i = 1; $i <= 31; $i++) echo "<option value=$i>$i</option>";
						?>
                    </select>
                    <select style="width: 70px;right:75px" name="d2">
                        <option value="sec">Seçin</option>
                        <? aylar(NULL); ?>
                    </select>
                    <select style="width: 70px" name="d3">
                        <option value="sec">Seçin</option>
                        <?php
							for($i = date("Y")-20; $i >= 1950; $i--) echo "<option value=$i>$i</option>";
						?>
				
                    </select>
                </li>
                <li>Email Adresiniz<input type="text" name="email" placeholder=" Onay maili gönderilecektir" /> <input type="hidden" name="emailonay" value="0" /> </li>
                <li>Cinsiyetiniz
                    <select name="cinsiyet">
                        <option value="sec">Seçiniz</option>
                        <? cinsiyetimiz(NULL); ?>
                    </select>
                </li>
                <li>Şehriniz
                    <select name="sehir">
                        <option value="sec">Seçiniz</option>


                        <option value="Adana">Adana</option><option value="Adapazari">Adapazari</option><option value="Adiyaman">Adiyaman</option><option value="Ağrı">Ağrı</option><option value="Afyon">Afyon</option><option value="Aksaray">Aksaray</option><option value="Amasya">Amasya</option><option value="Ankara">Ankara</option><option value="Antalya">Antalya</option><option value="Ardahan">Ardahan</option><option value="Artvin">Artvin</option><option value="Aydin">Aydin</option><option value="Balikesir">Balikesir</option><option value="Bartin">Bartin</option><option value="Batman">Batman</option><option value="Bayburt">Bayburt</option><option value="Bilecik">Bilecik</option><option value="Bingöl">Bingöl</option><option value="Bitlis">Bitlis</option><option value="Bolu">Bolu</option><option value="Burdur">Burdur</option><option value="Bursa">Bursa</option><option value="Çanakkale">Çanakkale</option><option value="Çankırı">Çankırı</option><option value="Çorum">Çorum</option><option value="Denizli">Denizli</option><option value="Diyarbakir">Diyarbakir</option><option value="Düzce">Düzce</option><option value="Edirne">Edirne</option><option value="Elazig">Elazig</option><option value="Erzincan">Erzincan</option><option value="Erzurum">Erzurum</option><option value="Eskisehir">Eskisehir</option><option value="Gaziantep">Gaziantep</option><option value="Gebze">Gebze</option><option value="Giresun">Giresun</option><option value="Gümüşhane">Gümüşhane</option><option value="Hakkari">Hakkari</option><option value="Hatay (Antakya)">Hatay (Antakya)</option><option value="Igdir">Igdir</option><option value="Iskenderun">Iskenderun</option><option value="Isparta">Isparta</option><option value="Istanbul Anadolu">Istanbul Anadolu</option><option value="Istanbul Avrupa">Istanbul Avrupa</option><option value="Izmir">Izmir</option><option value="Izmit">Izmit</option><option value="Kahramanmaras">Kahramanmaras</option><option value="Karabük">Karabük</option><option value="Karaman">Karaman</option><option value="Kars">Kars</option><option value="Kastamonu">Kastamonu</option><option value="Kayseri">Kayseri</option><option value="Kilis">Kilis</option><option value="Kirikkale">Kirikkale</option><option value="Kirklareli">Kirklareli</option><option value="Kirsehir">Kirsehir</option><option value="Konya">Konya</option><option value="Kütahya">Kütahya</option><option value="Malatya">Malatya</option><option value="Manisa">Manisa</option><option value="Mardin">Mardin</option><option value="Mersin">Mersin</option><option value="Mugla">Mugla</option><option value="Mus">Mus</option><option value="Nevsehir">Nevsehir</option><option value="Nigde">Nigde</option><option value="Ordu">Ordu</option><option value="Osmaniye">Osmaniye</option><option value="Rize">Rize</option><option value="Sakarya">Sakarya</option><option value="Samsun">Samsun</option><option value="Siirt">Siirt</option><option value="Sinop">Sinop</option><option value="Sirnak">Sirnak</option><option value="Sivas">Sivas</option><option value="Tekirdag">Tekirdag</option><option value="Tokat">Tokat</option><option value="Trabzon">Trabzon</option><option value="Tunceli">Tunceli</option><option value="Usak">Usak</option><option value="Van">Van</option><option value="Yalova">Yalova</option><option value="Yozgat">Yozgat</option><option value="Zonguldak">Zonguldak</option><option value="Şanlıurfa">Şanlıurfa</option>                     </select>
                </li>
                <li>Rumuz<input type="text" name="rumuz" /> <input type="hidden" name="rumuzonay" value="0" /> </li>
                <li>Şifreniz<input type="password" name="sifre" /> </li>
                <li>Şifreniz (Tekrar) <input type="password" name="sifre1" /> </li>
                <li><a href="#">Sözleşmeyi okudum ve onaylıyorum</a> <input type="checkbox" name="sozlesme" checked/></li>
                <li><button>Üyeliğimi Tamamla</button></li>
                <li class="loading"></li>
            </ul>
        </div>

        <div class="info">
            <p>Rumuzunuz, sizin Sevgilin.net' de ki  adınızdır. Aramalarda ilk
            okunacak hakkınızdaki ilk izlenimi verecek ve daha sonra sizi
            hatırlatacak kelimedir. Deyim yerindeyse, rumuz sizin markanızdır.</p>

            <p>Rumuzunuz 4 harften kısa, 32 harften uzun olamaz. 10 veya 12
            harften uzun olanı da pek bir işe yaramaz.</p>

            <p>Unutmayın profiliniz sizsiniz, rumuz da sizin kafanızdır. Kafasız insan
            olmayacağı için kendinize bir rumuz bulmak zorundasınız.</p>

            <p>İyi bir rumuz sizi tanımlamalı, kısa olmalı, kolay yazılmalı ve telaffuz
            edilmelidir. Örneğin fsqwda kötü bir rumuzdur. Böyle saçma sapan
            rumuzlar uydurmak yerine Angel, Mustafa, Hülya, Barbie gibi kolay
            okunan rumuzları kaparsanız hafızalarda kolay yer bulursunuz.</p>

            <p>Orjinal isim bulacağım diye de çok fazla düşünmeyin. Sıradan gibi
            görünmelerine rağmen gerçek isimlerde işlevlidir. İnsanlara daha
            fazla güven verirler.</p>

            <p>YP Yönetimi</p>
        </div>

        <div class="banner">
            <img src="assets/img/banner.gif" />
        </div>
    </div>
    <div class="footer">
        <div class="copy">Copyright Sevgilin.net</div>
        <div class="link">
            <a href="https://www.sevgilin.net">Anasayfa</a>
            <a href="javascript:void(0)">İletişim</a>
        </div>
    </div>
</div>
<div class="contactform">
    <div class="title">İletişim Formu</div>
    <a href="#" class="close">&nbsp;</a>
    <div class="line"></div>
    <p>Her türlü soru, görüş ve önerilerinizi iletişim formumuzu kullanarak bize iletebilirsiniz.</p>
    <ul>
        <li><input type="text" name="iad" placeholder="Adınız soyadınız" /></li>
        <li><input type="text" name="itel" placeholder="Telefon numaranız"/></li>
        <li><input type="text" name="iemail" placeholder="Emmail adresiniz"/></li>
        <li><textarea name="imesaj" placeholder="Mesajınız"></textarea></li>
        <li><button>Mesajımı Gönder</button></li>
    </ul>
    <p class="close-a"><a href="#">KAPAT</a></p>
</div>
<div class="contract">
    <div class="title">Üyelik Sözleşmesi</div>
    <div class="line"></div>
    <p>Yatakpartner.Com Üyelik Sözleşmesidir.</p>


<p>Yatakpartner.Com'a üye olanlar üyelik sözleşmesini okumuş kabul etmiş, üyelik sözleşmesindeki tüm esas ve kurallara uymayı kabul ve taahhüt etmiş sayılır.

<p>1. Yatakpartner.Com yalnızca aracıdır. 21 yaşın altında hiç kimsenin üyeliğini kabul etmez 21 yaşın altında üye olunmuşsa yatakpartner bu kişi yada kişilerden asla sorumlu tutulmaz tutulamaz. Gelen mesajların kontrol edilmesi olanaksızdır. </p>

<p>Gönderilen mesajlar bu forum sisteminin ya da bu foruma bağlı herhangi bir kurumun değil, sadece yazarının görüşlerini bildirir. Bu nedenle gönderilen hiçbir mesaj için sorumluluk kabul edilemez. Kullanıcılar kötü niyetli ya da rahatsız edici mesajları bize bildirebilirler. </p>

<p>Yatakpartner.Com bildirilen mesajları ya da uygun görmediği herhangi bir mesajı sebep göstermeksizin kaldırma hakkına sahiptir.</p>

<p>2. Yatakpartner.Com arkadaş bulma servisi yalnızca 18 yaşından büyük erişkin kullanıcılar içindir. Yatakpartner.Com üye formunu dolduran herkes 18 yaşından büyük olduğunu taahhüt eder.</p>

<p>3. Yatakpartner.Com üyeliği kişiseldir. Başkasına ödünç verilemez.</p>

<p>4. Üyeler suç teşkil edecek, yasal açıdan takip gerektirecek yerel, ülke çapında ya da uluslararası düzeyde yasalara ters düşecek bir durum yaratan ya da teşvik eden, hiçbir tür yasadışı, tehditkar, rahatsız edici, hakaret ve küfür içeren, küçük düşürücü, kaba, pornografik ya da ahlaka aykırı bilgi postalayamaz, iletemez. HER NE ŞEKİLDE OLURSA OLSUN SUÇ İŞLEYENE AİTTİR. Yatakpartner.Com SORUMLULUK KABUL ETMEZ.</p>

<p>5. Üyeler virüs ya da zararlı unsur içeren, ticari amaç taşıyan ya da reklam içeren hiçbir bilgi, yazılım ya da malzeme postalayamaz, iletemez.</p>

<p>6. Yatakpartner.Com arkadaş arayan insanların serbest iradesiyle birbirlerini tanıma ve seçme olanağı sunmaktadır. İnteraktif ortamda karşılaşan insanların karşılıklı birbirlerine uygun iradelerinin oluşumunda hiçbir katkısı ve sorumluluğu yoktur. Bu nedenle Yatakpartner.Com hiçbir şekilde tarafların cezai ve/veya hukuki taleplerine muhatap edilemez.</p>

<p>7. Üyeler ve misafirler her zaman sanal ortamda hareket ettiklerinin bilincinde olmalı, tam olarak güven kazanmadan özel hayatlarına ilişkin açıklayıcı bilgileri karşı tarafa vermekten kaçınmalıdırlar.</p>

<p>8. Yatakpartner.Com üyelerinin verdiği ve veri tabanında bulunan bilgileri istatistiksel bilgilere dönüştürmek, reklam ve pazarlama alanında kullanmak, site kullanıcılarının genel eğilimlerini belirlemek, içeriğini ve servislerini zenginleştirmek için kullanabilme hakkına sahiptir. Ancak kişilere ait bilgiler tek tek kullanılmayacaktır.</p>

<p>9. Yatakpartner.Com u ziyaret eden üyelerin bilgisayarlarının IP numaraları güvenlik nedeniyle sistem tarafından kaydedilmektedir. Taciz ya da tehdit halinde hukuki işlem gerektiği takdirde bu numaralar kullanıcının kimliğini tespit için kullanılabilecek ve gerekirse yargıya verilebilecektir. Bu zorunluluk nedeniyle sır tutma yükümlülüğümüzün de ortadan kalkacağı bilinmelidir.</p>

<p>10. Teknik aksaklıklardan dolayı Yatakpartner.Com'da hata ya da kesinti olabilir. Hizmetin bu şekilde kesilmesinden Yatakpartner.Com sorumlu değildir.</p>

<p>11. Yatakpartner.Com 'da yer alan herhangi bir eser kaynak belirtilmeden başka yerde yayımlanamaz.</p>

<p>12. Yatakpartner.Com link verdiği, banner tanıtımını yaptığı sitelerin içeriğinden ve gizlilik prensiplerinden sorumlu değildir.</p>

<p>13. Yatakpartner.Com hiçbir uyarı yapmaksızın herhangi bir mesajı silme, kısaltma ve herhangi bir üyenin üyeliğini iptal etme hakkına sahiptir.</p>

<p>14. Yatakpartner.Com tanıtımının yapıldığı, link verdiği ( Yatakpartner.Com adresinin yayınlandığı ) sitelerin içeriklerinden sorumlu değildir. Yatakpartner.Com gelir paylaşımı ortaklığı yöntemi ile tanıtımının ve reklamının yapıldığı kaynaklardan/web sitelerinden kullanıcılara doğabilecek olan zararları kabul etmez.</p>

<p>15. Yatakpartner.Com istediği üyeden istediği site üyelerine siteye çekmek için toplu mesaj atma hakkına sahiptir  veya bazı üye gruplarına toplu mesaj atma hakkı verebilir. Üyeler arasında atılan mesajların içeriğinden sadece mesajı atan üye sorumludur. Site sahipleri bu konuda herhangi bir sorumluluk almazlar.</p>

<p>Mesaj içerikleri herhangi bir sebeple suç unsuru taşırsa adli soruşturma için gerekli login bilgileri ve üyenin bağlandığı ip gibi üyeyi bulmak için gerekli bilgiler adli mercilere verilir. Üyelerin oluşturdukları profiller tamamen üyenin kendi sorumluluğundadır. Profilin gerçek olup olmadığı site sahibi tarafından araştırılmaz ve bu konuda sorumluluk alınmaz.</p>

<p>Gerçek olmadığı düşünülen profillerden rahatsız edici mesaj alan kişiler site yöneticilerine/editörlerine başvurmaları halinde o profilden bir daha mesaj almamaları için gerekli teknik işlem yapılabilir.</p>

<p>16. Sisteme üye olan her üye / kullanıcı YATAKPARTNER sitesinden, kullanıcılar ve sistem tarafından bilgilendirme mesajlarını ve mailleri kabul etmiş sayılır. Bu durumun iptali için mesaj ayarlarından E-POSTA istemiyorum seçeneğini seçerek sistemi devre dışı bırakabilirler. 

<p>Kişi/Kişiler Yada Kullanıcılar, Bu durumdan rahatsız olup hiçbir şekilde ayarlarında değişiklik yapmadığı taktirde, çeşitli yollar ile internet üzerinden sistemi karalama gibi girişimleri ve herhangi bir yasal müracat durumunda sistem Avukatları devreye girerek kişi yada kişiler hakkın maddi ve manevi tazminat davası açacaktır.</p>

<p>17. Profil kabul koşulları</p>

<p>- Profiller e-posta adresi, web adresi, telefon numarası gibi (doğrudan ya da
dolaylı olarak) kişisel bilgi içeremez.</p>

<p>- Profillerde kullanıcının kendini ya da aradığı eşi anlattığı alanlar açık, ve gerçeğe uygun olmalıdır.</p>

<p>- Profillerde kullanıcının kendini ya da aradığı eşi anlattığı alanlarda, herhangi bir biçimde hakaret içeren, seksist , çocuk pornosu ya da ırkçı ifadeler kullanılamaz. Profil sayfaları bütün üyelerimize açıktır.</p>

<p>- Profillerde Türkçe ya da İngilizce dışında bir dil kullanmak isteyenler bunu birkaç cümle ile sınırlı tutmak zorundadır.</p>

<p>- Profillerde herhangi bir siyasi görüşün, dinin v.b. propagandası yapılamaz.</p>

<p>- Profillerde herhangi bir şekilde reklam yapılamaz.</p>

<p>- Profillerde yer alan bilgiler kişilerin serbest iradesine bağlıdır ve denetlenmesi mümkün değildir. Bu nedenle Yatakpartner.Com bilgilerin doğruluğuna kefil değildir.</p>

<p>17. Ücretli üyeliklerde üyelik satışlarımız kesindir. Üyelik iptali yalnızca site yönetimi'nin takdirine kalmıştır.</p>

<p>18. Yatakpartner.Com'a üye olan herkes yukarıda belirtilen kuralların tümünü kabul ve taahhüt etmiş sayılır ve bu kurallara uymakla yükümlüdür.</p>

<p>Yatakpartner Yonetimi</p>
    <p><button>SÖZLEŞMEYI KABUL ETMEK İÇİN TIKLAYIN</button></p>
    <p class="close-a"><a href="#">KAPAT</a></p>
</div>

<div class="contentt">
    
<center><h1><span style="font-size: 12pt;"><strong>Ücretsiz Partner Sitesi</strong></span></h1></center>
<p>Hızlı yaşam koşullarından ötürü çevrenize vakit ayıramıyor ve yeni arkadaşlıklar kurmakta zorlanıyorsanız sizde birçok insan gibi sanal ortamda gerçek dostluklar kurabilirsiniz. </p>

<p>Ücretsiz partner sitesi sayesinde yeni kişiler ile tanışarak yeni arkadaşlıklar elde edebilirsiniz. Sitemiz diğer partner sitelerinden tamamen farklı bir şekilde dizayn edilmiş ve farklı bir konseptte sizler için hazırlanmıştır. </p>
<p>Gerçek kimliğinizi saklayarak para vermeden üye olmanızı sağlayan Yatak partner sitesi için kişilerin gizliliği ön plandadır. Bedava partner Sitesine nasıl üye olurum ve bu nezih ortamda yeni arkadaşlıkları nasıl edel ederim diyorsanız yapmanız gereken şey çok basit. </p>
<p>Üst kısımdaki forma bilgilerinizi girerek kendinizi tanıtın. Yaşınız, mesleğiniz, hangi şehirde yaşadığınız, boyunuz, kilonuz, göz renginiz gibi fiziksel özelliklerinizi belirterek profil oluşturmaya başlayabilirsiniz. </p>
<p>Oluşturduğunuz bu profil için resim eklemeniz arama sonuçlarında bir adım daha önce çıkmanızı sağlayacaktır. Unutmayın başkasına ait ya da pornografik resimler Editor onayından asla geçmeyecektir. Yapılan araştırmalar sonucu kişilerin profillerine eklediği alıntı ve başka kişilere ait fotoğraflar karşı tarafta hayal kırıklığı ve güven endişesi uyandırdığı tespit edilmiştir. </p>
<p>Dilerseniz kendiniz ve beklentileriniz hakkında bir yazıyı da profilinize ekleyebilirsiniz. Profilinizi oluşturduktan sonra birkaç dakika içinde aktif üye haline gelerek sistemi kullanmaya başlama fırsatını elde edecek ve diğer üyelerle eğlenceli sohbetlere başlayabileceksiniz. Ücretsiz partner sitesinin tadını çıkarın. </p>

</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/uyeol.js"></script>
</body>
</html>
<div style="display:none">
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(53593255, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/53593255" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</div>
