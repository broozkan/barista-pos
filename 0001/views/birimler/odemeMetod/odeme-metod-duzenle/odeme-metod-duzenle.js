$(document).ready(function () {
  $("form#frmOdemeMetodDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var odemeMetodAdi = $(this).find(".txtOdemeMetodAdi").val();
      var odemeMetodSiralamasi = $(this).find(".txtOdemeMetodSiralamasi").val();
      var odemeMetodAktifMi = $(this).find(".txtOdemeMetodAktifMi").find("option:selected").val();
      var odemeMetodIdsi = $(this).find(".txtOdemeMetodAdi").attr("id");
      var json = {"txtOdemeMetodAktifMi":odemeMetodAktifMi,"txtOdemeMetodSiralamasi":odemeMetodSiralamasi,"txtOdemeMetodAdi":odemeMetodAdi,"txtOdemeMetodIdsi":odemeMetodIdsi};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"odeme-metod/odeme-metod-duzenle/",
      data: {odemeMetodDuzenle:json},
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
