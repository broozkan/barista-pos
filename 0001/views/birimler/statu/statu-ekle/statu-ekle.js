$(document).ready(function () {
  $("#cboxTumYetkiler").on("click",function () {
    if ($(this).is(":checked")) {
      $("#frmStatuEkle").find("input[type=checkbox]").prop("checked",true);
    }else {
      $("#frmStatuEkle").find("input[type=checkbox]").prop("checked",false);
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

  $("form#frmStatuEkle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmStatuEkle").serializeJSON();
    var statuYetkiAdlari = new Array();
    var statuYetkiDegerleri = new Array();
    $("#frmStatuEkle input[type=checkbox]").each(function () {
      var yetkiAdi = $(this).attr("id");
      var yetkiDegeri = $(this).is(":checked");
      statuYetkiAdlari.push(yetkiAdi);
      statuYetkiDegerleri.push(yetkiDegeri);
    })
    formVerileri["txtStatuYetkiAdlari"] = statuYetkiAdlari;
    formVerileri["txtStatuYetkiDegerleri"] = statuYetkiDegerleri;
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"statu/statuEkle/",
      data: {statuEkle:json},
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
            type: 'success',
            z_index:7777
          });

          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtStatuAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmStatuEkle input").val("");
          $("form#frmStatuEkle").find(".btnIptal").trigger("click");

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
