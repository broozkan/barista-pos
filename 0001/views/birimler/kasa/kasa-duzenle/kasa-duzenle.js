$(document).ready(function () {
  $("form#frmKasaDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var kasaAdi = $(this).find(".txtKasaAdi").val();
      var kasaAcilisBakiyesi = $(this).find(".txtKasaAcilisBakiyesi").val();
      var kasaBirincilKasaMi = $(this).find(".txtKasaBirincilKasaMi").find("option:selected").val();
      var kasaIdsi = $(this).find(".txtKasaAdi").attr("id");
      var json = {"txtKasaAdi":kasaAdi,"txtKasaAcilisBakiyesi":kasaAcilisBakiyesi,"txtKasaBirincilKasaMi":kasaBirincilKasaMi,"txtKasaIdsi":kasaIdsi};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"kasa/kasaDuzenle/",
      data: {kasaDuzenle:json},
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
