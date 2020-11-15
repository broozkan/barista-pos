$(document).ready(function () {
  $("form#frmKategoriDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var kategoriAdi = $(this).find(".txtKategoriAdi").val();
      var kategoriSiraNumarasi = $(this).find(".txtKategoriSiraNumarasi").val();
      var kategoriTabloAdi = $(this).find(".txtKategoriTabloAdi").find("option:selected").val();
      var kategoriId = $(this).find(".txtKategoriAdi").attr("id");
      var json = {"txtKategoriTabloAdi":kategoriTabloAdi,"txtKategoriAdi":kategoriAdi,"txtKategoriSiraNumarasi":kategoriSiraNumarasi,"txtKategoriId":kategoriId};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"kategori/kategoriDuzenle/",
      data: {kategoriDuzenle:json},
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
