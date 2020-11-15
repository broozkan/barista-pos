$(document).ready(function () {
  $("span[data-role=remove]").on("click",function () {
    $(this).parent().remove();
  })


  /*VARSAYILANLARI DEĞİŞTİRME KODLARI*/
  $("#frmVarsayilanlariDegistir").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmVarsayilanlariDegistir").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"ayarlar/varsayilanlari-degistir/",
      data: {varsayilanlariDegistir:json},
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
  /*VARSAYILANLARI DEĞİŞTİRME KODLARI*/


  /*PROFİLİ GÜNCELLEME KODLARI*/
  $("form#frmProfilGuncelle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmProfilGuncelle").serializeJSON();

    var hizliNotlar = new Array();
    $("span.tag").each(function () {
      var not = $(this).text();
      hizliNotlar.push(not);
    })
    formVerileri["txtCalisanHizliNotlari"] = hizliNotlar;

    var json = JSON.stringify(formVerileri);

    var formData = new FormData();
    var dosya = document.getElementById("txtCalisanProfilFotosu");
    if(dosya.files[0] == "" || dosya.files[0] == null){

    }else {
      formData.append("dosya",dosya.files[0]);
    }

    formData.append("profiliGuncelle",json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"ayarlar/profili-guncelle/",
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
  /*PROFİLİ GÜNCELLEME KODLARI*/


  /*PAROLA DEĞİŞTİRME KODLARI*/
  $("#frmParolaDegistir").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmParolaDegistir").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"ayarlar/parola-degistir/",
      data: {parolaDegistir:json},
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
          $("#frmParolaDegistir input").val("");
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
  /*PAROLA DEĞİŞTİRME KODLARI*/

  /*PİN DEĞİŞTİRME KODLARI*/
  $("#frmPinDegistir").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmPinDegistir").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"ayarlar/pin-degistir/",
      data: {pinDegistir:json},
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
          $("#frmPinDegistir input").val("");
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
  /*PİN DEĞİŞTİRME KODLARI*/
})
