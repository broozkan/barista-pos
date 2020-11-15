$(document).ready(function () {
  $("form#frmKurDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    $("div.formArea").each(function () {
      var kurAdi = $(this).find(".txtKurAdi").val();
      var kurIsareti = $(this).find(".txtKurIsareti").val();
      var kurKisaltmasi = $(this).find(".txtKurKisaltmasi").val();
      var kurAktifMi = $(this).find(".txtKurAktifMi").find("option:selected").val();
      var kurIdsi = $(this).find(".txtKurAdi").attr("id");
      var json = {"txtKurKisaltmasi":kurKisaltmasi,"txtKurAktifMi":kurAktifMi,"txtKurIsareti":kurIsareti,"txtKurAdi":kurAdi,"txtKurIdsi":kurIdsi};
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"kur/kurDuzenle/",
      data: {kurDuzenle:json},
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
