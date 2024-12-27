$(function () {
    $(".form button").click(function () {
        $(".loading").show("fast");
        var ad = $("input[name=ad]").val();
        var soyad = $("input[name=soyad]").val();
        var d1 = $("select[name=d1]").val();
        var d2 = $("select[name=d2]").val();
        var d3 = $("select[name=d3]").val();
        var cinsiyet = $("select[name=cinsiyet]").val();
        var sehir = $("select[name=sehir]").val();
        var email = $("input[name=email]").val();
        var rumuz = $("input[name=rumuz]").val();
        var sifre = $("input[name=sifre]").val();
        var sifre1 = $("input[name=sifre1]").val();
        var rumuzonay = $("input[name=rumuzonay]").val();
        var emailonay = $("input[name=emailonay]").val();

        if(ad == "") {$("input[name=ad]").css("border", "3px solid red");}
        else {$("input[name=ad]").css("border", "3px solid #dddddd");}
        if(soyad == "") {$("input[name=soyad]").css("border", "3px solid red");}
        else {$("input[name=soyad]").css("border", "3px solid #dddddd");}
        if(d1 == "sec") {$("select[name=d1]").css("border", "3px solid red");}
        else {$("select[name=d1]").css("border", "3px solid #dddddd");}
        if(d2 == "sec") {$("select[name=d2]").css("border", "3px solid red");}
        else {$("select[name=d2]").css("border", "3px solid #dddddd");}
        if(d3 == "sec") {$("select[name=d3]").css("border", "3px solid red");}
        else {$("select[name=d3]").css("border", "3px solid #dddddd");}
        if(cinsiyet == "sec") {$("select[name=cinsiyet]").css("border", "3px solid red");}
        else {$("select[name=cinsiyet]").css("border", "3px solid #dddddd");}
        if(sehir == "sec") {$("select[name=sehir]").css("border", "3px solid red");}
        else {$("select[name=sehir]").css("border", "3px solid #dddddd");}
        if(email == "") {$("input[name=email]").css("border", "3px solid red");}
        else {$("input[name=email]").css("border", "3px solid #dddddd");}
        if(rumuz == "") {$("input[name=rumuz]").css("border", "3px solid red");}
        else {$("input[name=rumuz]").css("border", "3px solid #dddddd");}
        if(sifre == "") {$("input[name=sifre]").css("border", "3px solid red");}
        else {$("input[name=sifre]").css("border", "3px solid #dddddd");}
        if(sifre1 == "") {$("input[name=sifre1]").css("border", "3px solid red");}
        else {$("input[name=sifre1]").css("border", "3px solid #dddddd");}

        if(ad && soyad && rumuz && sifre && email && sehir != "sec" && d1 != "sec" && d2 != "sec" && d3 != "sec" && cinsiyet != "sec"){
            if(sifre == sifre1){
                if(rumuzonay != 1){
                    $(".loading").html('<font color="red">Rumuzunuz onaylanmadı !</font>');
                    $("input[name=rumuz]").css("border", "3px solid red");
                } else if (emailonay != 1){
                    $(".loading").html('<font color="red">Email adresiniz onaylanmadı !</font>');
                    $("input[name=email]").css("border", "3px solid red");
                }
                else {
                    $(".loading").html('<font color="green">Yükleniyor, lütfen bekleyin...</font>');
                    $.post('inc/uyeol.php', "ad="+ad+"&soyad="+soyad+"&d1="+d1+"&d2="+d2+"&d3="+d3+"&email="+email+"&cinsiyet="+cinsiyet+"&ulke=Türkiye&sehir="+sehir+"&rumuz="+rumuz+"&sifre="+sifre, function (sonuc) {
                        if(sonuc == "hata"){
                            $(".loading").html('<font color="red">Şifre ve tekrarı uyuşmuyor</font>');
                        }
                        else if(sonuc == "uyeolmus"){
                            alert("Sitemizden sadece bir defa üyelik alabilirsiniz.");
                            yonlendir("index.php");
                        }
                        else {
                            $(".loading").html('<font color="green">Başarıyla üye olundu, giriş yapılıyor !</font>');
                            $.post('inc/giris.php', 'kullanici='+rumuz+'&sifre='+sifre, function (sonuc) {
                                if(sonuc == "mobil"){
                                    window.location = 'mobil.php';
                                } else if(sonuc == "ok"){
                                    window.location = 'index.php'
                                } else {
                                    window.location = 'index.php'
                                }
                            })
                            alert("Başarıyla üye oldunuz.\n\n Teşekkür ederiz. Yönlendiriliyorsunuz...");

                        }
                    })
                }
            } else {
                $(".loading").html('<font color="red">Şifre ve tekrarı uyuşmuyor</font>');
            }
        }
        else {
            $(".loading").html('<font color="red">Belirtilen alanları doldurun</font>');
        }

    })

    $(".form input[name=email]").keyup(function () {
        var email = $("input[name=email]").val();
        if(email){
            $.post('inc/degerlendir.php', 'tur=mail&deger='+email, function (sonuc) {
                if(sonuc == "ok") {
                    $(".loading").html('<font color="green">Email onaylandı</font>');
                    $("input[name=email]").css("border", "3px solid green");
                    $("input[name=emailonay]").val(1);
                }
                else if(sonuc == "email"){
                    $(".loading").html('<font color="red">Email adresi kullanılıyor !</font>');
                    $("input[name=email]").css("border", "3px solid red");
                    $("input[name=emailonay]").val("0");
                }
                else {
                    $(".loading").html('<font color="red">Email kabul edilmedi.</font>');
                    $("input[name=email]").css("border", "3px solid red");
                    $("input[name=emailonay]").val("0");
                }
            })
        }
        else {
            $("input[name=email]").css("border", "3px solid red");
            $("input[name=emailonay]").val("0");
        }
    })

    $(".form input[name=rumuz]").keyup(function () {
        var rumuz = $("input[name=rumuz]").val();
        if(rumuz.length < 3){
            $(".loading").html('<font color="red">Rumuz en az 3 karakter olmalıdır.</font>');
            $("input[name=rumuz]").css("border", "3px solid red");
            $("input[name=rumuzonay]").val("0");
        }
        else {
            if (rumuz) {
                $.post('inc/degerlendir.php', 'tur=rumuz&deger=' + rumuz, function (sonuc) {
                    if (sonuc == "ok") {
                        $(".loading").html('<font color="green">Rumuz onaylandı</font>');
                        $("input[name=rumuz]").css("border", "3px solid green");
                        $("input[name=rumuzonay]").val(1);
                    } else if (sonuc == "rumuz") {
                        $(".loading").html('<font color="red">Rumuz kullanılıyor !</font>');
                        $("input[name=rumuz]").css("border", "3px solid red");
                        $("input[name=rumuzonay]").val("0");
                    } else if (sonuc == "karakter"){
                        $(".loading").html('<font color="red">Rumuz çok kısa !</font>');
                        $("input[name=rumuz]").css("border", "3px solid red");
                        $("input[name=rumuzonay]").val("0");
                    } else if (sonuc == "sayi"){
                        $(".loading").html('<font color="red">Rumuz sadece sayıdan oluşamaz !</font>');
                        $("input[name=rumuz]").css("border", "3px solid red");
                        $("input[name=rumuzonay]").val("0");
                    } else {
                        $(".loading").html('<font color="red">Rumuz kabul edilmedi.</font>');
                        $("input[name=rumuz]").css("border", "3px solid red");
                        $("input[name=rumuzonay]").val("0");
                    }
                })
            } else {
                $("input[name=rumuz]").css("border", "3px solid red");
                $("input[name=rumuzonay]").val("0");
            }
        }
    })

    $(".contactform a").click(function () {
        $(".contactform").hide("fast");
    })
    $(".link a:not(:first)").click(function () {
        $(".contactform").show("fast");
    })
    $(".form a").click(function () {
        $(".contract").show("fast");
    })
    $(".contract a").click(function () {
        $(".contract").hide("fast");
    })
    $(".contract button").click(function () {
        $(".contract").hide("fast");
        $('.form input[type=checkbox]').attr('checked','checked');
    })
    $(".contactform button").click(function () {
        var ad = $("input[name=iad]").val();
        var tel = $("input[name=itel]").val();
        var email = $("input[name=iemail]").val();
        var mesaj = $("textarea[name=imesaj]").val();

        if(ad == "") {$("input[name=iad]").css("border", "3px solid red");}
        else {$("input[name=iad]").css("border", "3px solid #dddddd");}
        if(tel == "") {$("input[name=itel]").css("border", "3px solid red");}
        else {$("input[name=itel]").css("border", "3px solid #dddddd");}
        if(email == "") {$("input[name=iemail]").css("border", "3px solid red");}
        else {$("input[name=iemail]").css("border", "3px solid #dddddd");}
        if(mesaj == "") {$("textarea[name=imesaj]").css("border", "3px solid red");}
        else {$("textarea[name=imesaj]").css("border", "3px solid #dddddd");}

        if(ad && tel && email && mesaj){
            $(".contactform p:first").html("<font color=green><b>Mesajınız gönderiliyor, lütfen bekleyiniz...</b></font>");
            $.post('index.php?sayfa=iletisim&islem=gonder', 'ad='+ad+'&tel='+tel+'&mail='+email+'&mesaj='+mesaj, function (sonuc) {
                if(sonuc == "ok"){
                    $(".contactform").hide("fast");
                    $(".contactform p:first").html("Her türlü soru, görüş ve önerilerinizi iletişim formumuzu kullanarak bize iletebilirsiniz.");
                    alert("Mesajınız başarıyla iletilmiştir. \n\n Editörlerimiz tarafından incelenip size geri dönülecektir. \n\n Teşekkür ederiz...");
                }
                else {
                    $(".contactform").hide("fast");
                    $(".contactform p:first").html("Her türlü soru, görüş ve önerilerinizi iletişim formumuzu kullanarak bize iletebilirsiniz.");
                    alert("Mesajınız gönderilemedi, lütfen sonra tekrar deneyin.");
                }
            })
        }
    })


})