$(document).ready(function () {
  $("form#frmVerecekEkle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmVerecekEkle").serializeJSON();
    formVerileri["txtVerecekCariIdsi"] = $("#txtVerecekCariIdsi").attr("data-id");
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"verecek/verecekEkle/",
      data: {verecekEkle:json},
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
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Başarılı bir şekilde kaydedildi"
          },{
            // settings
            type: 'success'
          });
          $("form#frmVerecekEkle input").val("");
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
