$(document).ready(function () {

  /*GÜNCELLEŞTİRMEYİ KONTROL ETME KODLARI*/
  $(".btnGuncellestirmeKontrolEt").on("click",function () {

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"baristapos/guncelleme-kontrol-et/",
      data: {guncellemeKontrolEt:1},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("Kontrol Et");
        var donut = $.parseJSON(response);
        if (donut.guncellenecekVersiyonSurumu != null) {

          $(".btnGuncellestirmeKontrolEt").prop("disabled",true);
          $(".btnGuncellestirmeKontrolEt").removeClass("btn-info");
          $(".btnGuncellestirmeKontrolEt").addClass("g-bg-cgreen");
          $(".btnGuncellestirmeKontrolEt").html(donut.guncellenecekVersiyonSurumu+" versiyonu mevcut! Güncellemek için sihirbazda ilerleyin");
          $("#txtGuncellemeVarMi").val(1);
          $("#txtGuncellenecekVersiyonSurumu").val(donut.guncellenecekVersiyonSurumu);
        }else {
          $(".btnGuncellestirmeKontrolEt").prop("disabled",true);
          $(".btnGuncellestirmeKontrolEt").html("En güncel versiyonu kullanmaktasınız");
          $("#txtGuncellemeVarMi").val(0);
        }
      }
    });

  })
  /*GÜNCELLEŞTİRMEYİ KONTROL ETME KODLARI*/

  /*VERİTABANI YEDEK ALMA KODLARI*/
  $(".btnYedekAl").on("click",function () {
    var epostaAdresi = $("#txtEpostaAdresi").val();
    if (!epostaAdresi) {
      epostaAdresi = null;
    }
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"baristapos/veritabani-yedegi-al/",
      data: {veritabaniYedegiAl:epostaAdresi},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingYedek").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $(".btnLoadingYedek").html("<span class='zmdi zmdi-check'></span> Yedeklendi");
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Yedek başarıyla alındı"
          },{
            // settings
            type: 'success'
          });
          $("#txtYedekAlindiMi").val(1);
        }else {
          $(".btnLoadingYedek").html("<span class='zmdi zmdi-dns'></span> Şimdi Yedekle");
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
  /*VERİTABANI YEDEK ALMA KODLARI*/


  /*GÜNCELLEMEYİ GERÇEKLEŞTİR KODLARI*/
  $(".btnGuncelle").on("click",function () {
    onayla("Lütfen internet ve elektrik bağlantınızı kontrol edin. Güncellemek istediğinize emin misiniz?",function callBack(onay) {
      if (onay == true) {
        var guncellenecekVersiyonSurumu = $("#txtGuncellenecekVersiyonSurumu").val();
        if (!guncellenecekVersiyonSurumu) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Güncelleme versiyon sürümü bulunamadı!"
          },{
            // settings
            type: 'danger'
          });
          return false;
        }

        jQuery.ajax({
          type: "POST",
          url: ""+yolHtml+"baristapos/guncellemeyi-gerceklestir/",
          data: {guncellemeyiGerceklestir:guncellenecekVersiyonSurumu},
          cache: false,
          beforeSend: function() {
            $(".btnLoadingGuncelle").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
          },
          error:function(err){
            alert(err.responseText);
          },
          success: function(response)
          {
            var donut = $.parseJSON(response);
            if (donut.yanit == true) {
              $(".btnLoadingGuncelle").html("<span class='zmdi zmdi-check'></span> Güncellendi");
              $("#txtGuncellenecekVersiyonSurumu").val("");
              $.notify({
                // options
                icon: 'fa fa-danger fa-2x',
                message: "Güncelleme başarıyla gerçekleşti"
              },{
                // settings
                type: 'success'
              });
              window.location.href = '/';
            }else {
              $(".btnLoadingGuncelle").html("<span class='zmdi zmdi-download'></span> GÜNCELLE");
              $(".btnLoadingGuncelle").prop("disabled",true);

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

      }



    })
  })
  /*GÜNCELLEMEYİ GERÇEKLEŞTİR KODLARI*/

})
