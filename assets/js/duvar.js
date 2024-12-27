$(function () {
    $(".yorumyap").click(function () {
        $(this).css("height", "80px");
        $(this).css("border", "2px solid #dd2e2e");
    })
    $(".yorumyap").bind('blur', function () {
        var yorum = $(this).val();
        if(yorum == ""){
            $(this).css("height", "30px");
            $(this).css("border", "1px solid #d0d0d0");
        }
    })
    $(".yorumgonder").click(function () {
        var yorum = $(".yorumyap").val();
        if(yorum){
            alert(yorum);
        }
    })
})