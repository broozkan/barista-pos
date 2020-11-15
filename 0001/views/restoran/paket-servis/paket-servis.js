$(document).ready(function () {
  // var ekranYuksekligi = $(window).height();
  // var ekranGenisligi = $(window).width();

  /* Kolon genişlikleri ayarlaması */
  // $(".tblYemekSepetiKapsayici").css("height",ekranYuksekligi/1.3);
  // $(".tblBekleyenSiparislerKapsayici").css("height",ekranYuksekligi/2.5);
  // $(".tblYolaCikanSiparislerKapsayici").css("height",ekranYuksekligi/2.5);
  //
  // $(".tblKuryelerKapsayici").css("height",ekranYuksekligi/4.5);
  // $(".tblOdemeMetodlariKapsayici").css("height",ekranYuksekligi/4.5);
  // $(".tblIslemlerKapsayici").css("height",ekranYuksekligi/3);
  /* Kolon genişlikleri ayarlaması */


  /*SATIR, ÜRÜN SEÇME KODLARI*/
  $(document).on("click",".tblBekleyenSiparisler tr",function () {
    $(this).toggleClass("clicked");
  })

  $(document).on("click",".tblYolaCikanSiparisler tr",function () {
    $(this).toggleClass("clicked");
  })
  /*SATIR, ÜRÜN SEÇME KODLARI*/


  /*SİPARİŞİ YAZDIRMA KODLARI*/
  $(".btnSiparisiYazdir").on("click",function () {
    var seciliSiparisSayisi = $("table tr.clicked").length;
    if (seciliSiparisSayisi < 1) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen işlem yapmak istediğiniz sipariş veya siparişleri seçiniz!"
      },{
        // settings
        type: 'danger',
        z_index:7777
      });
      return false;
    }

    var yazdirilacakAdisyonIdleri = new Array();
    $("table tr.clicked").each(function () {
      var adisyonIdsi = $(this).attr("adisyon-idsi");
      var json = {"txtAdisyonIdsi":adisyonIdsi};
      yazdirilacakAdisyonIdleri.push(json);
    })
    yazdirilacakAdisyonIdleri = JSON.stringify(yazdirilacakAdisyonIdleri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/paket-siparis-siparis-yazdir",
      data: {paketSiparisSiparisYazdir:yazdirilacakAdisyonIdleri},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {

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
  /*SİPARİŞİ YAZDIRMA KODLARI*/


  /*ADiSYONU GÖSTERME KODLARI*/
  $(".btnAdisyonuGoster").on("click",function () {
    var musteriIdsi = $("table tbody tr.clicked").attr("musteri-idsi");
    if (!musteriIdsi) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Görüntülemek istediğiniz siparişe tıklayınız!"
      },{
        // settings
        type: 'danger',
        z_index:7777
      });
      return false;
    }

    window.location.href = ""+yolHtml+"restoran/paket-siparis-adisyon/"+musteriIdsi;
  })
  /*ADiSYONU GÖSTERME KODLARI*/

  /*HARİTADA GÖSTER KODLARI*/
  $(".btnHaritadaGoster").on("click",function () {
    var geocoder = new google.maps.Geocoder();
    var address = "sivas";

    geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        alert(latitude);
        alert(longitude);
      }
    });
  })
  /*HARİTADA GÖSTER KODLARI*/

  /*PAKET SİPARİŞ ÖDEMEYE ÇEVİRME, ÖDEMESİNİ ALMA KODLARI*/
  $(".tblOdemeMetodlari tbody button").on("click",function () {
    var kontrol = seciliSatirKontrol("tblYolaCikanSiparisler");
    var odemeMetodIdsi = $(this).attr("id");
    if (kontrol) {
      var odemeyeCevrilecekAdisyonIdleri = new Array();
      $(".tblYolaCikanSiparisler tbody tr.clicked").each(function () {
        var adisyonIdsi = $(this).attr("adisyon-idsi");
        var json = {"txtAdisyonIdsi":adisyonIdsi,"txtOdemeMetodIdsi":odemeMetodIdsi};
        odemeyeCevrilecekAdisyonIdleri.push(json);
      })

      json = JSON.stringify(odemeyeCevrilecekAdisyonIdleri);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"restoran/paket-siparis-odeme-al",
        data: {paketSiparisOdemeAl:json},
        cache: false,
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit == true) {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: "Ödeme başarılı bir şekilde alındı!"
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
  })
  /*PAKET SİPARİŞ ÖDEMEYE ÇEVİRME, ÖDEMESİNİ ALMA KODLARI*/

  /*YOLA ÇIKMIŞ SİPARİŞİ BEKLEYENE TEKRAR ALMA*/
  $(".btnBekleyeneCevir").on("click",function () {
    var kontrol = seciliSatirKontrol("tblYolaCikanSiparisler");
    if (kontrol) {
      var beklemeyeAlinacakAdisyonIdleri = new Array();
      $(".tblYolaCikanSiparisler tbody tr.clicked").each(function () {
        var adisyonIdsi = $(this).attr("adisyon-idsi");
        var json = {"txtAdisyonIdsi":adisyonIdsi};
        beklemeyeAlinacakAdisyonIdleri.push(json);
      })

      json = JSON.stringify(beklemeyeAlinacakAdisyonIdleri);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"restoran/adisyondan-kuryeyi-al",
        data: {adisyondanKuryeyiAl:json},
        cache: false,
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit == true) {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: "Sipariş başarılı bir şekilde beklemeye alındı!"
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
  })
  /*YOLA ÇIKMIŞ SİPARİŞİ BEKLEYENE TEKRAR ALMA*/

  /*BEKLEYEN SİPARİŞE KURYE ATAMA KODLARI*/
  $(".tblKuryeler tbody button").on("click",function () {
    var kontrol = seciliSatirKontrol("tblBekleyenSiparisler");
    if (kontrol) {
      var kuryeIdsi = $(this).attr("id");
      var yolaCikacakAdisyonIdleri = new Array();
      $(".tblBekleyenSiparisler tbody tr.clicked").each(function () {
        var adisyonIdsi = $(this).attr("adisyon-idsi");
        var json = {"txtKuryeIdsi":kuryeIdsi,"txtAdisyonIdsi":adisyonIdsi};
        yolaCikacakAdisyonIdleri.push(json);
      })

      json = JSON.stringify(yolaCikacakAdisyonIdleri);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"restoran/adisyona-kurye-ata",
        data: {adisyonaKuryeAta:json},
        cache: false,
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit == true) {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: "Sipaiş başarılı bir şekilde yola çıktı!"
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
  })
  /*BEKLEYEN SİPARİŞE KURYE ATAMA KODLARI*/

  /*MÜŞTERİYİ SEÇME FORMU KODLARI*/
  $("#frmMusteriyeUrunGir").on("submit",function (e) {
    e.preventDefault();
    var musteriIdsi = $("#txtMusteriAdi").attr("data-id");

    if (!musteriIdsi) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Müşteri bulunamadı. Lütfen arama sonuçlarından çıkan müşterilerden seçiniz!"
      },{
        // settings
        type: 'danger',
        z_index:7777
      });
      return false;
    }

    window.location.href = ""+yolHtml+"restoran/paket-siparis-adisyon/"+musteriIdsi;

  })
  /*MÜŞTERİYİ SEÇME FORMU KODLARI*/

})

/*BİLGİLERİ GÜNCELLEME KODLARI*/
function bilgileriGuncelle() {
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"restoran/paket-servis-guncelle",
    data: {paketServisGuncelle:1},
    cache: false,
    success: function(response)
    {
      var donut = $.parseJSON(response);
      if (donut.bilgiler) {
        $(".tblBekleyenSiparisler tbody").html("");
        $(".tblYolaCikanSiparisler tbody").html("");
        for (var i = 0; i < donut.bilgiler.length; i++) {
          if (donut.bilgiler[i]["adisyon_yola_cikti_mi"] == "0") {
            var bekleyenSiparislerHtml = "<tr adisyon-idsi='"+donut.bilgiler[i]["adisyon_idsi"]+"' musteri-idsi='"+donut.bilgiler[i]["musteri_idsi"]+"' >";
            bekleyenSiparislerHtml += "<td>";
            bekleyenSiparislerHtml += "<span class='spanBekleyenMusteriAdi'></span>";
            bekleyenSiparislerHtml += "<strong>"+donut.bilgiler[i]["musteri_adi_soyadi"]+"</strong>";
            bekleyenSiparislerHtml += "<br>";
            bekleyenSiparislerHtml += "<span class='spanBekleyenMusteriAdresi'>";
            bekleyenSiparislerHtml += donut.bilgiler[i]["musteri_adresi"];
            bekleyenSiparislerHtml += "</span>";
            bekleyenSiparislerHtml += "<br>";
            bekleyenSiparislerHtml += "<span class='spanBekleyenSiparisSaati'>";
            bekleyenSiparislerHtml += "<strong>"+donut.bilgiler[i]["adisyon_acilis_saati"]+"</strong> / "+donut.bilgiler[i]["musteri_telefon_numarasi"]+"";
            bekleyenSiparislerHtml += "</span>";
            bekleyenSiparislerHtml += "</td>";
            bekleyenSiparislerHtml += "<td class='align-middle'>";
            bekleyenSiparislerHtml += "<h5>";
            bekleyenSiparislerHtml += "<span class='spanBekleyenSiparisTutari'>"+donut.bilgiler[i]["adisyon_tutari"]+" </span>";
            bekleyenSiparislerHtml += "<span class='spanKurIsareti'></span>";
            bekleyenSiparislerHtml += "</h5>";
            bekleyenSiparislerHtml += "</td>";
            $(".tblBekleyenSiparisler tbody").append(bekleyenSiparislerHtml);
          }else {
            var yolaCikanSiparislerHtml = "<tr adisyon-idsi='"+donut.bilgiler[i]["adisyon_idsi"]+"' musteri-idsi='"+donut.bilgiler[i]["musteri_idsi"]+"' >";
            yolaCikanSiparislerHtml += "<td>";
            yolaCikanSiparislerHtml += "<span class='spanYolaCikanMusteriAdi'></span>";
            yolaCikanSiparislerHtml += "<strong>"+donut.bilgiler[i]["musteri_adi_soyadi"]+"</strong>";
            yolaCikanSiparislerHtml += "<br>";
            yolaCikanSiparislerHtml += "<span class='spanYolaCikanKuryeAdi'></span>";
            yolaCikanSiparislerHtml += "<strong>"+donut.bilgiler[i]["kurye_adi"]+"</strong>";
            yolaCikanSiparislerHtml += "<br>";
            yolaCikanSiparislerHtml += "<span class='spanYolaCikanMusteriAdresi'>";
            yolaCikanSiparislerHtml += donut.bilgiler[i]["musteri_adresleri_adres"];
            yolaCikanSiparislerHtml += "</span>";
            yolaCikanSiparislerHtml += "<br>";
            yolaCikanSiparislerHtml += "<span class='spanYolaCikanSiparisSaati'>";
            yolaCikanSiparislerHtml += "<strong>"+donut.bilgiler[i]["adisyon_acilis_saati"]+"</strong> / "+donut.bilgiler[i]["musteri_telefon_numarasi"]+"";
            yolaCikanSiparislerHtml += "</span>";
            yolaCikanSiparislerHtml += "</td>";
            yolaCikanSiparislerHtml += "<td class='align-middle'>";
            yolaCikanSiparislerHtml += "<h5>";
            yolaCikanSiparislerHtml += "<span class='spanYolaCikanSiparisTutari'>"+donut.bilgiler[i]["adisyon_tutari"]+" </span>";
            yolaCikanSiparislerHtml += "<span class='spanKurIsareti'></span>";
            yolaCikanSiparislerHtml += "</h5>";
            yolaCikanSiparislerHtml += "</td>";
            $(".tblYolaCikanSiparisler tbody").append(yolaCikanSiparislerHtml);
          }
        }

        $(".spanKurIsareti").html(donut.kurIsareti);

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
/*BİLGİLERİ GÜNCELLEME KODLARI*/

/*SEÇİLİ SATIR OLUP OLMADIĞINI KONTROL ETME*/
function seciliSatirKontrol(tabloAdi) {
  var seciliUrunSayisi = $("."+tabloAdi+" tr.clicked").length;
  if (seciliUrunSayisi == 0) {
    $.notify({
      // options
      icon: 'fa fa-danger fa-2x',
      message: "Lütfen işlem yapılacak siparişi veya siparişleri seçiniz!"
    },{
      // settings
      type: 'danger',
      z_index:7777
    });
    return false;
  }else {
    return true;
  }
}
/*SEÇİLİ SATIR OLUP OLMADIĞINI KONTROL ETME*/
