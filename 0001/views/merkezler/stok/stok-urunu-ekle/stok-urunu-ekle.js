$(document).ready(function () {


  $("form#frmStokUrunEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmStokUrunEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);

    var formData = new FormData();
    var dosya = document.getElementById("txtStokUrunGorseli");
    for (var i = 0; i < dosya.files.length; i++) {
      if(dosya.files[i] == "" || dosya.files[i] == null){

      }else {
        formData.append("dosya[]",dosya.files[i]);
      }
    }
    formData.append("stokUrunEkle",json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"stok/stok-urunu-ekle/",
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
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Başarılı bir şekilde kaydedildi"
          },{
            // settings
            type: 'success',
            z_index: '1900'

          });
          $("form#frmStokUrunEkle input").val("");
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index: '1900'

          });
        }
      }
    });
  })


  $("form#frmExceldenAktar").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmExceldenAktar").serializeJSON();
    var json = JSON.stringify(formVerileri);
    var formData = new FormData();
    var dosya = document.getElementById("txtExcelDosyasi");

    if(dosya.files[0] == "" || dosya.files[0] == null){
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen excel dosyası seçiniz!"
      },{
        // settings
        type: 'danger',
        z_index: '1900'
      });
      return false;
    }else {
      formData.append("dosya",dosya.files[0]);
    }
    formData.append("urunExceldenAktar",json);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"urun/urunExceldenAktar/",
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
        $(".btnLoading").html("AKTAR");
        $(".btnIptal").html("GERİ");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Ürünler başarılı bir şekilde aktarıldı"
          },{
            // settings
            type: 'success',
            z_index: '1900'

          });
          $("form#frmExceldenAktar input").val("");
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
