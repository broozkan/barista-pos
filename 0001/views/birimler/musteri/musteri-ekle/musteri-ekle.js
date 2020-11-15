$(document).ready(function () {

  /*ADRES EKLEME/SİLME KODLARI*/
  $(".btnAdresEkle").on("click",function () {
    var eklenecekSatir = '<div class="input-group divMusteriAdresi">';
    eklenecekSatir += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekSatir += '<input type="text" id="txtMusteriAdresleri" required name="txtMusteriAdresleri[]" class="form-control" placeholder="Müşteri ikincil adreslerini giriniz">';
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


  $("form#frmMusteriEkle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmMusteriEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"musteri/musteriEkle/",
      data: {musteriEkle:json},
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
        if (donut.yanit["yanit"] == true || donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Başarılı bir şekilde kaydedildi"
          },{
            // settings
            type: 'success'
          });
          $("form#frmMusteriEkle input").val("");
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
