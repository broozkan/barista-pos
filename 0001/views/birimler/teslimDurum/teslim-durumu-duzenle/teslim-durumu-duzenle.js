$(document).ready(function () {
  $("form#frmTeslimDurumuDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var teslimDurumuAdi = $(this).find(".txtTeslimDurumuAdi").val();
      var teslimDurumuRengi = $(this).find(".txtTeslimDurumuRengi").val();
      var teslimDurumuIdsi = $(this).find(".txtTeslimDurumuAdi").attr("id");
      var json = {"txtTeslimDurumuRengi":teslimDurumuRengi,"txtTeslimDurumuAdi":teslimDurumuAdi,"txtTeslimDurumuIdsi":teslimDurumuIdsi};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"teslim-durum/teslim-durumu-duzenle/",
      data: {teslimDurumuDuzenle:json},
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
