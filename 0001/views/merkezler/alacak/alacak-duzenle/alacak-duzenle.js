$(document).ready(function () {
  $("form#frmAlacakDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var alacakKodu = $(this).find(".txtAlacakKodu").val();
      var alacakTutari = $(this).find(".txtAlacakTutari").val();
      var alacakAciklamasi = $(this).find(".txtAlacakAciklamasi").val();
      var alacakCariIdsi = $(this).find(".txtAlacakCariIdsi").attr("data-id");
      var alacakKasaIdsi = $(this).find(".txtAlacakKasaIdsi").find("option:selected").val();
      var alacakId = $(this).find(".txtAlacakKodu").attr("id");
      var json = {"txtAlacakAciklamasi":alacakAciklamasi,"txtAlacakTutari":alacakTutari,"txtAlacakCariIdsi":alacakCariIdsi,"txtAlacakKasaIdsi":alacakKasaIdsi,"txtAlacakKodu":alacakKodu,"txtAlacakId":alacakId};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"alacak/alacakDuzenle/",
      data: {alacakDuzenle:json},
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
