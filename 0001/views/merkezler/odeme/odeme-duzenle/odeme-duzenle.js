$(document).ready(function () {
  $("form#frmOdemeDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var odemeKodu = $(this).find(".txtOdemeKodu").val();
      var odemeTutari = $(this).find(".txtOdemeTutari").val();
      var odemeTarihi = $(this).find(".txtOdemeTarihi").val();
      var odemeAciklamasi = $(this).find(".txtOdemeAciklamasi").val();
      var odemeCariIdsi = $(this).find(".txtOdemeCariIdsi").attr("data-id");
      var odemeKasaIdsi = $(this).find(".txtOdemeKasaIdsi").find("option:selected").val();
      var odemeId = $(this).find(".txtOdemeKodu").attr("id");
      var json = {"txtOdemeAciklamasi":odemeAciklamasi,"txtOdemeTarihi":odemeTarihi,"txtOdemeTutari":odemeTutari,"txtOdemeCariIdsi":odemeCariIdsi,"txtOdemeKasaIdsi":odemeKasaIdsi,"txtOdemeKodu":odemeKodu,"txtOdemeId":odemeId};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"odeme/odemeDuzenle/",
      data: {odemeDuzenle:json},
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
