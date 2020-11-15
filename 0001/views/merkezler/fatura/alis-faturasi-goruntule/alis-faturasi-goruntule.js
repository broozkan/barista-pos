$(document).ready(function () {
  $("#frmAlisFaturasiOdemeYap").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("#frmAlisFaturasiOdemeYap").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"fatura/alis-faturasi-odeme-yap/",
      data: {alisFaturasiOdemeYap:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("ÖDEME YAP");

        var donut = $.parseJSON(response);

        if (donut.yanit) {
          location.reload();
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777
          });
        }
      }
    });

  })
})
