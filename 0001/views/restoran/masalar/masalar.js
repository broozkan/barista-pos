$(document).ready(function () {


  /*MUTFAK MESAJINI KAPATMA KODU*/
  $(document).on("click",".spanMutfakMesajKapat",function () {
    $(this).closest("ul").fadeOut();
  })
  /*MUTFAK MESAJINI KAPATMA KODU*/

  /*MASA ARA KODLARI*/
  $(".btnMasaAra").on("click",function () {
    $(".masaAra").removeClass("d-none");
    $("#txtMasaAra").focus();
  })

  $("#txtMasaAra").on("keyup",function () {
    $(".divMasa").hide();
    var val = $(this).val();
    if (val == "") {
      $(".divMasa").show();
    }else {
      $(".spanMasaAdi:contains('"+val+"')").closest(".divMasa").show();
    }
  })
  /*MASA ARA KODLARI*/

  /*REZERVASYON YAP KODLARI*/
  $(".btnRezervasyonYap").on("click",function (e) {
    e.preventDefault();

    var masaIdsi = $(this).closest(".divMasa").attr("id");
    var masaAdi = $(this).closest(".divMasa").find(".spanMasaAdi").html();

    onayla(masaAdi+" adlı masayı rezerve etmek istediğinize emin misiniz",function callBack(onay) {
        if (onay == true) {
          jQuery.ajax({
            type: "POST",
            url: ""+yolHtml+"restoran/masa-rezerve-et",
            data: {masaRezerveEt:masaIdsi},
            cache: false,
            success: function(response)
            {
              var donut = $.parseJSON(response);
              if (donut.yanit == true) {
                $.notify({
                  // options
                  icon: 'fa fa-danger fa-2x',
                  message: "Masa tarafınızdan rezerve edildi"
                },{
                  // settings
                  type: 'success',
                  z_index:7777
                });
                bilgileriGuncelle();
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
    });
  })
  /*REZERVASYON YAP KODLARI*/

  /*MÜŞTERİ ADİSYONLARINI GETİRME KODLARI*/
  $(".btnMusteriAdisyonlariniGetir").on("click",function () {
    var musteriIdsi = $(this).closest("form").find("#txtMusteriAdiSoyadi").attr("data-id");

    if (musteriIdsi == null || musteriIdsi == "") {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Müşteri bulunamadı. Lütfen geçerli bir müşteri giriniz!"
      },{
        // settings
        type: 'danger',
        z_index:7777
      });
      return false;
    }

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/musteri-gecmis-adisyonlarini-al",
      data: {musteriGecmisAdisyonlariniAl:musteriIdsi},
      cache: false,
      beforeSend:function () {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      success: function(response)
      {
        $(".btnLoading").html("Geçmiş Adisyonlarını Getir");
        var donut = $.parseJSON(response);
        if (donut.musteriAdisyonlari) {
          $(".tblMusteriAdisyonlari tbody").html("");
          for (var i = 0; i < donut.musteriAdisyonlari.length; i++) {
            var eklenecekHtml = "<tr>";
            eklenecekHtml += "<td>"+donut.musteriAdisyonlari[i]["id"]+"</td>";
            eklenecekHtml += "<td>"+donut.musteriAdisyonlari[i]["adisyon_tutari"]+"</td>";
            eklenecekHtml += "<td><a href='"+yolHtml+"rapor/gecmis-adisyon-incele/"+donut.musteriAdisyonlari[i]["id"]+"' class='btn btn-warning'><span class='zmdi zmdi-search'></span>  </a> </td>";
            eklenecekHtml += "</tr>";
            $(".tblMusteriAdisyonlari tbody").append(eklenecekHtml);
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
  })
  /*MÜŞTERİ ADİSYONLARINI GETİRME KODLARI*/

  /*MASA YERLEŞİMİ KODLARI*/
  $("#btnMasaYerlesimi").on("click",function () {
    var lokasyonIdsi = $(this).attr("data-id");
    var lokasyonAdi = $(this).attr("data-name");
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/lokasyon-krokisi-al",
      data: {lokasyonKrokisiAl:lokasyonIdsi},
      cache: false,
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.lokasyonKrokisi) {
          $("#imgLokasyonKrokisi").attr("src","/local-assets/lokasyonlar/"+donut.lokasyonKrokisi);
          $("#modalMasaYerlesimiLokasyonAdi").html(lokasyonAdi);
          $("#modalMasaYerlesimi").modal("show");
        }
      }
    });
  })
  /*MASA YERLEŞİMİ KODLARI*/

  /*MASANIN ÜRÜNLERİNE BAKMA KODLARI*/
  $(".btnMasaUrunlerineBak").on("click",function (e) {
    e.preventDefault();
    var masaIdsi = $(this).closest(".divMasa").attr("id");

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masanin-urunlerini-al",
      data: {masaninUrunleriniAl:masaIdsi},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.masaninUrunleri) {
          $(".tblMasaUrunleri tbody").html("");
          for (var i = 0; i < donut.masaninUrunleri.length; i++) {

            var eklenecekHtml = "<tr>";

            if (donut.masaninUrunleri[i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_urunler") {
              eklenecekHtml += "<td>"+donut.masaninUrunleri[i]["urun_adi"]+"</td>";
            }else if (donut.masaninUrunleri[i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_alt_urunler") {
              eklenecekHtml += "<td>"+donut.masaninUrunleri[i]["alt_urun_adi"]+"</td>";
            }else {
              eklenecekHtml += "<td>"+donut.masaninUrunleri[i]["menu_adi"]+"</td>";
            }

            eklenecekHtml += "<td>"+donut.masaninUrunleri[i]["adisyon_urunleri_urun_adedi"]+"</td>";
            eklenecekHtml += "<td>"+donut.masaninUrunleri[i]["adisyon_urunleri_urun_toplam_fiyati"]+"</td>";
            eklenecekHtml += "</tr>";
            $("#modalMasaUrunleriMasaAdi").html(donut.adisyonBilgileri[0]["masa_adi"]);
            $(".tblMasaUrunleri tbody").append(eklenecekHtml);
          }
          $("#modalMasaUrunleri").modal("show");
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
  /*MASANIN ÜRÜNLERİNE BAKMA KODLARI*/

})


function bilgileriGuncelle() {
  var lokasyonIdsi = $("#txtLokasyonIdsi").val();

  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"restoran/masalar-bilgileri-guncelle",
    data: {masalarBilgileriGuncelle:lokasyonIdsi},
    cache: false,
    success: function(response)
    {
      var donut = $.parseJSON(response);
      if (donut.masaBilgileri) {
        i=0;
        $(".divMasa").each(function () {
          if ((donut.masaBilgileri[i]["adisyonBilgileri"]).length > 0) {
            $(this).find(".spanMasaAdisyonTutari").html(donut.masaBilgileri[i]["adisyonBilgileri"][0]["adisyon_tutari"]);
            $(this).find(".spanSonSiparisSaati").html(donut.masaBilgileri[i]["adisyonBilgileri"][0]["adisyon_urunleri_urun_siparis_saati"]);
          }else {
            $(this).find(".spanMasaAdisyonTutari").html("0.00");
            $(this).find(".spanSonSiparisSaati").html("-");
          }
          switch (donut.masaBilgileri[i]["masa_durumu"]) {
            case "0":
            var masaKilitliMi = 0;
            var masaDurumu = "<p class='text-muted'><span class='spanMasaDurumu badge badge-default float-right' >Kapalı</span> </p>";
            var cardDurumu = "cardKapali";
              break;
            case "1":
            var masaKilitliMi = 0;
            var masaDurumu = "<h2 class='text-muted'><span class='spanMasaDurumu badge badge-success float-right' >Açık</span> </h2>";
            var cardDurumu = "cardAcik";
              break;
            case "2":
            var masaKilitliMi = 1;
            var masaDurumu = "<h2 class='text-muted'><span class='spanMasaDurumu badge badge-danger float-right' >Kilitli</span> </h2>";
            var cardDurumu = "cardKapali";
              break;
            case "3":
            var masaKilitliMi = 0;
            var masaDurumu = "<h2 class='text-muted'><span class='spanMasaDurumu badge badge-danger float-right' >Rezerve</span> </h2>";
            var cardDurumu = "cardKapali";
              break;
            default:
          }

          if (masaKilitliMi == 1) {
            $(this).addClass("pointernone");
          }else {
            $(this).removeClass("pointernone");
          }

          $(this).find(".card:first").removeClass("cardKapali");
          $(this).find(".card:first").removeClass("cardAcik");
          $(this).find(".card:first").addClass(cardDurumu);
          $(this).find(".divMasaDurumu").html(masaDurumu);
          i++;

        })
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
