$(document).ready(function () {
  $("form#frmLokasyonEkle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmLokasyonEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);

    var formData = new FormData();
    var dosya = document.getElementById("txtLokasyonGorseli");
      if(dosya.files[0] == "" || dosya.files[0] == null){

      }else {
        formData.append("dosya",dosya.files[0]);
      }

    formData.append("lokasyonEkle",json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"lokasyon/lokasyonEkle/",
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
            type: 'success'
          });
          $("form#frmLokasyonEkle input").val("");
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
