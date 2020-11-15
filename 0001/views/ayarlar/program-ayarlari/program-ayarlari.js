$(document).ready(function () {

  autoRadio();

  $("form#frmProgramBilgileri").on("submit",function (e) {
    e.preventDefault();
    var callerId = $(".txtCallerId:checked").val();
    var yazarkasaPos = $(".txtYazarKasaPos:checked").val();
    var yemekSepeti = $(".txtYemekSepeti:checked").val();
    var programBaslangicSaati = $("#txtProgramBaslangicSaati").val();
    var programBitisSaati = $("#txtProgramBitisSaati").val();
    var json = {
      "txtCallerId":callerId,
      "txtYazarKasaPos":yazarkasaPos,
      "txtYemekSepeti":yemekSepeti,
      "txtProgramBaslangicSaati":programBaslangicSaati,
      "txtProgramBitisSaati":programBitisSaati
    };
    json = JSON.stringify(json);



    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"ayarlar/program-ayarlarini-kaydet/",
      data: {programAyarlariniKaydet:json},
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
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Başarılı bir şekilde kaydedildi"
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
