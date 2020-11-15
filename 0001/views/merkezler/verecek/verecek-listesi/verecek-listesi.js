$(document).ready(function () {

  $("#frmVerecekOdemeyeCevir").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmVerecekOdemeyeCevir").serializeJSON();
    formVerileri["txtOdemeCariIdsi"] = $("#txtOdemeCariIdsi").attr("data-id");
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"verecek/verecek-odemeye-cevir/",
      data: {verecekOdemeyeCevir:json},
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
            message: "Başarılı bir şekilde kaydedildi"
          },{
            // settings
            type: 'success',
            z_index: '7777'
          });
          $("form#frmVerecekOdemeyeCevir input").val("");
          $("#modalOdemeyeCevir").modal("hide");
          location.reload();
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index: '7777'

          });
        }
      }
    });
  })

  $(document).on("click",".btnOdemeyeCevir",function () {
    var verecekIdsi = $(this).closest("tr").attr("id");
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"verecek/verecek-bilgilerini-al/",
      data: {verecekBilgileriniAl:verecekIdsi},
      cache: false,
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.verecekBilgileri) {
          $("#txtOdemeCariIdsi").val(donut.verecekBilgileri["musteri_adi_soyadi"]);
          $("#txtOdemeCariIdsi").attr("data-id",donut.verecekBilgileri["verecek_cari_idsi"]);
          $("#txtOdemeKasaIdsi").attr("data-id",donut.verecekBilgileri["verecek_kasa_idsi"]);
          $("#txtOdemeTutari").val(donut.verecekBilgileri["verecek_tutari"]);
          $("#txtOdemeAciklamasi").val(donut.verecekBilgileri["verecek_aciklamasi"]);
          $("#txtVerecekIdsi").val(donut.verecekBilgileri["id"]);
          changeSelects();
          $("#modalOdemeyeCevir").modal("show");

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



function verileriPaylas(json) {
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"verecek/dataShare/",
    data: {dataShare:json},
    cache: false,
    beforeSend: function() {
      $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
    },
    error:function(err){
      alert(err.responseText);
    },
    success: function(response)
    {
      $(".btnLoading").html("PAYLAŞ");
      var donut = $.parseJSON(response);
      if (donut.yanit == true) {

        $.notify({
          // options
          icon: 'fa fa-warning fa-2x',
          message: "Dosya başarılı bir şekilde paylaşıldı"
        },{
          // settings
          type: 'success',
          z_index:7777
        });
        if (donut.epostaAdresiOlmayanlar.length > 0) {
          var exception = "";
          for (var i = 0; i < donut.epostaAdresiOlmayanlar.length; i++) {
            exception += "</br>"+donut.epostaAdresiOlmayanlar[i];
          }
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "E-posta adresi kayıtlı olmadığı için başarısız olanlar : "+exception
          },{
            // settings
            type: 'danger',
            z_index:7777
          });
        }
        if (donut.cboxIndir != false) {
          $('a#aIndir').attr({href:'/documents/'+donut.cboxIndir+''});
          jQuery('a#aIndir')[0].click();
        }
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
}

function topluDuzenle(json) {
  window.location.replace("/verecek/verecek-duzenle/"+json);
}
function topluSil(json) {
  onayla("Emin misiniz?",function callBack(onay) {
    if (onay == true) {
      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"verecek/verecekSil/",
        data: {verecekSil:json},
        cache: false,
        error:function(err){
          alert(err.responseText);
        },
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit == true) {
            $.notify({
              // options
              icon: 'fa fa-warning fa-2x',
              message: "Başarılı bir şekilde silindi"
            },{
              // settings
              type: 'success'
            });
            $("table tr input[type=checkbox]:checked").closest("tr").fadeOut();
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
    }else {
      $("table tr input[type=checkbox]").prop("checked",false);
    }
  });
}
