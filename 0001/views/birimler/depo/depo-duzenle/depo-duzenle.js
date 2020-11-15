$(document).ready(function () {
  $("form#frmDepoDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var depoAdi = $(this).find(".txtDepoAdi").val();
      var depoAdresi = $(this).find(".txtDepoAdresi").val();
      var depoTelefonNumarasi = $(this).find(".txtDepoTelefonNumarasi").val();
      var depoIdsi = $(this).find(".txtDepoAdi").attr("id");
      var json = {"txtDepoTelefonNumarasi":depoTelefonNumarasi,"txtDepoAdresi":depoAdresi,"txtDepoAdi":depoAdi,"txtDepoIdsi":depoIdsi};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"depo/depoDuzenle/",
      data: {depoDuzenle:json},
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
