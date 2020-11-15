$(document).ready(function () {
  $("form#frmLogin").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmLogin").serializeJSON();
    var json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"login/girisYap/",
      data: {girisYap:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("GİRİŞ YAP");
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Giriş başarılı. Yönetim paneline yönlendiriliyorsunuz..."
          },{
            // settings
            type: 'success'
          });
          window.location.href = ""+yolHtml+"yonetim";
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
