$(document).ready(function () {
  $("form#frmCalisanDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var calisanIdsi = $(this).find(".txtCalisanAdiSoyadi").attr("id");
      var calisanAdiSoyadi = $(this).find(".txtCalisanAdiSoyadi").val();
      var calisanAdresi = $(this).find(".txtCalisanAdresi").val();
      var calisanDogumTarihi = $(this).find(".txtCalisanDogumTarihi").val();
      var calisanTelefonNumarasi = $(this).find(".txtCalisanTelefonNumarasi").val();
      var calisanEpostaAdresi = $(this).find(".txtCalisanEpostaAdresi").val();
      var calisanStatuIdsi = $(this).find(".txtCalisanStatuIdsi").find("option:selected").val();
      var calisanIndirimTuru = $(this).find(".txtCalisanIndirimTuru").find("option:selected").val();
      var calisanIndirimMiktari = $(this).find(".txtCalisanIndirimMiktari").val();
      var calisanGunlukHarcamaSiniri = $(this).find(".txtCalisanGunlukHarcamaSiniri").val();
      var json = {
        "txtCalisanIdsi":calisanIdsi,
        "txtCalisanAdiSoyadi":calisanAdiSoyadi,
        "txtCalisanAdresi":calisanAdresi,
        "txtCalisanDogumTarihi":calisanDogumTarihi,
        "txtCalisanTelefonNumarasi":calisanTelefonNumarasi,
        "txtCalisanEpostaAdresi":calisanEpostaAdresi,
        "txtCalisanStatuIdsi":calisanStatuIdsi,
        "txtCalisanIndirimTuru":calisanIndirimTuru,
        "txtCalisanIndirimMiktari":calisanIndirimMiktari,
        "txtCalisanGunlukHarcamaSiniri":calisanGunlukHarcamaSiniri
      };
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);

    var formData = new FormData();
    var dosya = document.getElementById("txtCalisanProfilFotosu");
    if(dosya.files[0] == "" || dosya.files[0] == null){

    }else {
      formData.append("dosya",dosya.files[0]);
    }

    formData.append("calisanDuzenle",json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"calisan/calisanDuzenle/",
      xhr: function() {
        var myXhr = $.ajaxSettings.xhr();
        return myXhr;
      },
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
