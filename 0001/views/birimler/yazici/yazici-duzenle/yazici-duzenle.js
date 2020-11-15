$(document).ready(function () {
  $("form#frmYaziciDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var yaziciAdi = $(this).find(".txtYaziciAdi").val();
      var yaziciIpAdresi = $(this).find(".txtYaziciIpAdresi").val();
      var yaziciId = $(this).find(".txtYaziciAdi").attr("id");
      var json = {"txtYaziciIpAdresi":yaziciIpAdresi,"txtYaziciAdi":yaziciAdi,"txtYaziciId":yaziciId};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"yazici/yaziciDuzenle/",
      data: {yaziciDuzenle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        $(".btnIptal").html("GERİ");
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Başarılı bir şekilde kaydedildi."
          },{
            // settings
            type: 'success'
          });
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger'
          });
        }
      }
    });
  })
})
