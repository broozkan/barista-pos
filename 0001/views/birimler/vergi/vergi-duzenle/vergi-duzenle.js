$(document).ready(function () {
  $("form#frmVergiDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var vergiAdi = $(this).find(".txtVergiAdi").val();
      var vergiYuzdesi = $(this).find(".txtVergiYuzdesi").val();
      var vergiId = $(this).find(".txtVergiAdi").attr("id");
      var json = {"txtVergiYuzdesi":vergiYuzdesi,"txtVergiAdi":vergiAdi,"txtVergiId":vergiId};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"vergi/vergiDuzenle/",
      data: {vergiDuzenle:json},
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
