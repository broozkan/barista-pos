$(document).ready(function () {

  /*ADRES EKLEME/SİLME KODLARI*/
  $(".btnAdresEkle").on("click",function () {
    var eklenecekSatir = '<div class="input-group divMusteriAdresi">';
    eklenecekSatir += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekSatir += '<input type="text" id="txtMusteriAdresleri" required name="txtMusteriAdresleri[]" class="txtMusteriAdresleri form-control" placeholder="Müşteri ikincil adreslerini giriniz">';
    eklenecekSatir += '<button type="button" class="btn btn-sm bg-red buttonInsideInput btnAdresSil" name="button">';
    eklenecekSatir += '<span class="zmdi zmdi-minus"></span>';
    eklenecekSatir += '</button>';
    eklenecekSatir += '</div>';
    $(".divMusteriAdresi:last").after(eklenecekSatir);
  })

  $(document).on("click",".btnAdresSil",function () {
    $(this).closest(".input-group").remove();
  })
  /*ADRES EKLEME/SİLME KODLARI*/

  $("form#frmMusteriDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var musteriAdiSoyadi = $(this).find(".txtMusteriAdiSoyadi").val();
      var musteriAdresleri = new Array();
      $(this).find(".divMusteriAdresi").each(function () {
        musteriAdresleri.push($(this).find(".txtMusteriAdresleri").val());
      })
      var musteriAdresi = $(this).find(".txtMusteriAdresi").val();
      var musteriTelefonNumarasi = $(this).find(".txtMusteriTelefonNumarasi").val();
      var musteriEpostaAdresi = $(this).find(".txtMusteriEpostaAdresi").val();
      var musteriNotlari = $(this).find(".txtMusteriNotlari").val();
      var musteriIndirimTuru = $(this).find(".txtMusteriIndirimTuru").find("option:selected").val();
      var musteriIndirimMiktari = $(this).find(".txtMusteriIndirimMiktari").val();
      var musteriId = $(this).find(".txtMusteriAdiSoyadi").attr("id");
      var json = {
        "txtMusteriIndirimMiktari":musteriIndirimMiktari,
        "txtMusteriIndirimTuru":musteriIndirimTuru,
        "txtMusteriNotlari":musteriNotlari,
        "txtMusteriEpostaAdresi":musteriEpostaAdresi,
        "txtMusteriTelefonNumarasi":musteriTelefonNumarasi,
        "txtMusteriAdresleri":musteriAdresleri,
        "txtMusteriAdiSoyadi":musteriAdiSoyadi,
        "txtMusteriId":musteriId
      };
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"musteri/musteriDuzenle/",
      data: {musteriDuzenle:json},
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
