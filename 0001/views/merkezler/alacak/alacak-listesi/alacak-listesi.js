$(document).ready(function () {

  $("#frmAlacakTahsilataCevir").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmAlacakTahsilataCevir").serializeJSON();
    formVerileri["txtTahsilatCariIdsi"] = $("#txtTahsilatCariIdsi").attr("data-id");
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"alacak/alacak-tahsilata-cevir/",
      data: {alacakTahsilataCevir:json},
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
          $("form#frmAlacakTahsilataCevir input").val("");
          $("#modalTahsilataCevir").modal("hide");
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

  $(document).on("click",".btnTahsilataCevir",function () {
    var alacakIdsi = $(this).closest("tr").attr("id");
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"alacak/alacak-bilgilerini-al/",
      data: {alacakBilgileriniAl:alacakIdsi},
      cache: false,
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.alacakBilgileri) {
          $("#txtTahsilatCariIdsi").val(donut.alacakBilgileri["musteri_adi_soyadi"]);
          $("#txtTahsilatCariIdsi").attr("data-id",donut.alacakBilgileri["alacak_cari_idsi"]);
          $("#txtTahsilatKasaIdsi").attr("data-id",donut.alacakBilgileri["alacak_kasa_idsi"]);
          $("#txtTahsilatTutari").val(donut.alacakBilgileri["alacak_tutari"]);
          $("#txtTahsilatAciklamasi").val(donut.alacakBilgileri["alacak_aciklamasi"]);
          $("#txtAlacakIdsi").val(donut.alacakBilgileri["id"]);
          changeSelects();
          $("#modalTahsilataCevir").modal("show");

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
    url: ""+yolHtml+"alacak/dataShare/",
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
  window.location.replace("/alacak/alacak-duzenle/"+json);
}
function topluSil(json) {
  onayla("Emin misiniz?",function callBack(onay) {
    if (onay == true) {
      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"alacak/alacakSil/",
        data: {alacakSil:json},
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
