$(document).ready(function () {
  $("form#frmMutfakDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var mutfakAdi = $(this).find(".txtMutfakAdi").val();
      var mutfakYaziciIdsi = $(this).find(".txtMutfakYaziciIdsi").find("option:selected").val();
      var mutfakId = $(this).find(".txtMutfakAdi").attr("id");
      var json = {"txtMutfakYaziciIdsi":mutfakYaziciIdsi,"txtMutfakAdi":mutfakAdi,"txtMutfakId":mutfakId};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"mutfak/mutfakDuzenle/",
      data: {mutfakDuzenle:json},
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
