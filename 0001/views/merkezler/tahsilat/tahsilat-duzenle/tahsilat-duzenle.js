$(document).ready(function () {
  $("form#frmTahsilatDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var tahsilatKodu = $(this).find(".txtTahsilatKodu").val();
      var tahsilatTutari = $(this).find(".txtTahsilatTutari").val();
      var tahsilatAciklamasi = $(this).find(".txtTahsilatAciklamasi").val();
      var tahsilatCariIdsi = $(this).find(".txtTahsilatCariIdsi").attr("data-id");
      var tahsilatKasaIdsi = $(this).find(".txtTahsilatKasaIdsi").find("option:selected").val();
      var tahsilatId = $(this).find(".txtTahsilatKodu").attr("id");
      var json = {"txtTahsilatAciklamasi":tahsilatAciklamasi,"txtTahsilatTutari":tahsilatTutari,"txtTahsilatCariIdsi":tahsilatCariIdsi,"txtTahsilatKasaIdsi":tahsilatKasaIdsi,"txtTahsilatKodu":tahsilatKodu,"txtTahsilatId":tahsilatId};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"tahsilat/tahsilatDuzenle/",
      data: {tahsilatDuzenle:json},
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
