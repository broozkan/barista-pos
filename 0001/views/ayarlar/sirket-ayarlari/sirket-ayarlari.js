$(document).ready(function () {
  $("form#frmSirketBilgileri").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmSirketBilgileri").serializeJSON();
    var json = JSON.stringify(formVerileri);

    var formData = new FormData();
    var dosya = document.getElementById("txtSirketLogosu");
    if(dosya.files[0] == "" || dosya.files[0] == null){

    }else {
      formData.append("dosya",dosya.files[0]);
    }

    formData.append("sirketBilgileriniKaydet",json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"ayarlar/sirket-bilgilerini-kaydet/",
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
})
