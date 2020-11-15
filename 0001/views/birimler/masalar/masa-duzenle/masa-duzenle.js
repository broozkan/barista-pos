$(document).ready(function () {
  $("form#frmMasaDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var masaId = $(this).find(".txtMasaId").attr("id");
      var masaAdi = $(this).find(".txtMasaAdi").val();
      var masaLokasyonIdsi = $(this).find(".txtMasaLokasyonIdsi").find("option:selected").val();
      var json = {"txtMasaId":masaId,"txtMasaAdi":masaAdi,"txtMasaLokasyonIdsi":masaLokasyonIdsi};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);

    var formData = new FormData();
    var dosya = document.getElementById("txtMasaGorselleri");
    for (var i = 0; i < dosya.files.length; i++) {
      if(dosya.files[i] == "" || dosya.files[i] == null){

      }else {
        formData.append("dosya[]",dosya.files[i]);
      }
    }
    formData.append("masaDuzenle",json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"masa/masaDuzenle/",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
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
