$(document).ready(function () {
  $("form#frmVerecekDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var verecekKodu = $(this).find(".txtVerecekKodu").val();
      var verecekTutari = $(this).find(".txtVerecekTutari").val();
      var verecekAciklamasi = $(this).find(".txtVerecekAciklamasi").val();
      var verecekCariIdsi = $(this).find(".txtVerecekCariIdsi").attr("data-id");
      var verecekKasaIdsi = $(this).find(".txtVerecekKasaIdsi").find("option:selected").val();
      var verecekId = $(this).find(".txtVerecekKodu").attr("id");
      var json = {"txtVerecekAciklamasi":verecekAciklamasi,"txtVerecekTutari":verecekTutari,"txtVerecekCariIdsi":verecekCariIdsi,"txtVerecekKasaIdsi":verecekKasaIdsi,"txtVerecekKodu":verecekKodu,"txtVerecekId":verecekId};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"verecek/verecekDuzenle/",
      data: {verecekDuzenle:json},
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
