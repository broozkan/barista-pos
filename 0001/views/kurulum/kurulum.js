$(document).ready(function () {


  $("form#frmKurulum").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmKurulum").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"kurulum/kurulumYap/",
      data: {kurulumBilgileri:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {

        $(".btnLoading").html("KURULUM YAP");
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Kurulum başarılı bir şekilde tamamlandı. Yönetim paneline yönlendiriliyorsunuz..."
          },{
            // settings
            type: 'success'
          });
          $.ajax({
            url : "../../../../../../Kurulum.json",
            dataType: "json",
            success : function (data) {
              yolHtml = "/"+data["txtVersiyonNo"]+"/";
            }
          });
          setTimeout(
          function()
          {
            window.location.href = ""+yolHtml+"login";
          }, 2000);
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
