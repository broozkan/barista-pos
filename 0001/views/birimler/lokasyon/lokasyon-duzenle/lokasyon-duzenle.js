$(document).ready(function () {
  $("form#frmLokasyonDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var lokasyonAdi = $(this).find(".txtLokasyonAdi").val();
      var lokasyonKati = $(this).find(".txtLokasyonKati").val();
      var lokasyonId = $(this).find(".txtLokasyonAdi").attr("id");
      var json = {"txtLokasyonKati":lokasyonKati,"txtLokasyonAdi":lokasyonAdi,"txtLokasyonId":lokasyonId};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);

    var formData = new FormData();
    var dosya = document.getElementById("txtLokasyonGorseli");
    if(dosya.files[0] == "" || dosya.files[0] == null){

    }else {
      formData.append("dosya",dosya.files[0]);
    }
    formData.append("lokasyonDuzenle",json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"lokasyon/lokasyonDuzenle/",
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
