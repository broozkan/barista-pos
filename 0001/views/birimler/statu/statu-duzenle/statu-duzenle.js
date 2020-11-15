$(document).ready(function () {
  $(".cboxTumYetkiler").on("click",function () {
    var formArea = $(this).closest(".formArea");
    if ($(this).is(":checked")) {
      formArea.find("input[type=checkbox]").prop("checked",true);
    }else {
      formArea.find("input[type=checkbox]").prop("checked",false);
    }
  })

  /*KISMİ OLARAK TAMAMINI İŞARETLE KODLARI*/
  $("#cboxBirimTumYetkiler").on("click",function () {
    if ($(this).is(":checked")) {
      $(this).closest("div.divBirimYetkileri").find("input[type=checkbox]").prop("checked",true);
    }else {
      $(this).closest("div.divBirimYetkileri").find("input[type=checkbox]").prop("checked",false);
    }

  })
  $("#cboxYonetimTumYetkiler").on("click",function () {
    if ($(this).is(":checked")) {
      $(this).closest("div.divYonetimYetkileri").find("input[type=checkbox]").prop("checked",true);
    }else {
      $(this).closest("div.divYonetimYetkileri").find("input[type=checkbox]").prop("checked",false);
    }

  })
  $("#cboxMerkezTumYetkiler").on("click",function () {
    if ($(this).is(":checked")) {
      $(this).closest("div.divMerkezYetkileri").find("input[type=checkbox]").prop("checked",true);
    }else {
      $(this).closest("div.divMerkezYetkileri").find("input[type=checkbox]").prop("checked",false);
    }

  })
  /*KISMİ OLARAK TAMAMINI İŞARETLE KODLARI*/

  $("form#frmStatuDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = Array();
    var json;

    $("div.formArea").each(function () {

      var statuAdi = $(this).find(".txtStatuAdi").val();
      var statuIdsi = $(this).find(".txtStatuAdi").attr("id");
      var statuYetkiAdlari = new Array();
      var statuYetkiDegerleri = new Array();
      $(this).find("input[type=checkbox]").each(function () {
        var yetkiAdi = $(this).attr("id");
        var yetkiDegeri = $(this).is(":checked");
        statuYetkiAdlari.push(yetkiAdi);
        statuYetkiDegerleri.push(yetkiDegeri);
        json = {"txtStatuIdsi":statuIdsi,"txtStatuAdi":statuAdi,"txtStatuYetkiAdlari":statuYetkiAdlari,"txtStatuYetkiDegerleri":statuYetkiDegerleri};
      })
      formVerileri.push(json);
    })
    json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"statu/statuDuzenle/",
      data: {statuDuzenle:json},
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
