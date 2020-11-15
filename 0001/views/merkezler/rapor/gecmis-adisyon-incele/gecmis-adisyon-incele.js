$(document).ready(function () {
  var ekranYuksekligi = $(window).height();
  var ekranGenisligi = $(window).width();
  var urunSatiriGenisligi = $(".tblUrunler").width();
  var urunTablosuYuksekligi = $(".tblUrunler").height();

  /* Kolon genişlikleri ayarlaması */
  $(".tblSiparisUrunleriKapsayici").css("height",ekranYuksekligi/1.9);
  /* Kolon genişlikleri ayarlaması */


  /*AÇILIŞ YÜKLEME KODLARI*/
  bilgileriGuncelle();
  /*AÇILIŞ YÜKLEME KODLARI*/



  /*MENÜ İÇERİĞİNİ GÖSTERME KODLARI*/
  $(document).on("click",".btnMenuIceriginiGoster",function () {
    var menuIdsi = $(this).closest("tr").attr("id");
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/menu-icerigini-al",
      data: {menuIceriginiAl:menuIdsi},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.menuIcerigi) {
          $(".tblMenuIcerigi tbody").html("");
          for (var i = 0; i < donut.menuIcerigi.length; i++) {
            var eklenecekHtml = "<tr>";
            eklenecekHtml += "<td>"+donut.menuIcerigi[i]["urun_adi"]+"</td>";
            eklenecekHtml += "<td>"+donut.menuIcerigi[i]["menu_urunleri_urun_adedi"]+"</td>";
            eklenecekHtml += "</tr>";
            $(".tblMenuIcerigi tbody").append(eklenecekHtml);
          }
          $("#modalMenuIceriginiGoster").modal("show");
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
  /*MENÜ İÇERİĞİNİ GÖSTERME KODLARI*/


})

/*BİLGİLERİ GÜNCELLEME KODLARI*/
function bilgileriGuncelle() {
  var adisyonIdsi = $("#txtAdisyonIdsi").val();
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"restoran/bilgileri-guncelle/"+adisyonIdsi+"",
    data: {bilgileriGuncelle:adisyonIdsi},
    cache: false,
    success: function(response)
    {
      var donut = $.parseJSON(response);
      if (donut.adisyonBilgileri) {
        $("#spanMasaAdi").html(donut.adisyonBilgileri[0]["masa_adi"]);
        $("#spanAdisyonTutari").html(donut.adisyonBilgileri[0]["adisyon_tutari"]);
        $("#spanMusteriAdiSoyadi").html("Masaya müşteri veya çalışan atanmamış");
        $("#spanMasaGarsonu").html(donut.adisyonBilgileri[0]["adisyon_garson_adi"]);

        if (donut.adisyonBilgileri[0]["adisyon_musteri_idsi"] != null) {
          $("#spanMusteriAdiSoyadi").html("<span id=''>"+donut.adisyonBilgileri[0]["musteri_adi_soyadi"]+"</span>");
        }

        if (donut.adisyonBilgileri[0]["adisyon_calisan_idsi"] != null) {
          $("#spanMusteriAdiSoyadi").html("<span id=''>"+donut.adisyonBilgileri[0]["calisan_adi_soyadi"]+"</span>");

        }


        $("#spanAdisyonOdenmisMiktar").html(donut.adisyonBilgileri[0]["adisyon_odenmis_tutar"]);


        if (donut.adisyonBilgileri[0]["adisyon_indirim_miktari"] > 0) {
          if (donut.adisyonBilgileri[0]["adisyon_indirim_turu"] == 0) {
            var tdIndirimHucresiHtml = "<h5 class='m-0'><span id='spanAdisyonIndirimTuru'>%</span><span id='spanAdisyonIndirimMiktari'>"+donut.adisyonBilgileri[0]["adisyon_indirim_miktari"]+"</span>";
            $("#tdIndirimHucresi").html(tdIndirimHucresiHtml);
          }else {
            var tdIndirimHucresiHtml = "<h5 class='m-0'><span id='spanAdisyonIndirimMiktari'>"+donut.adisyonBilgileri[0]["adisyon_indirim_miktari"]+"</span> <span id='spanAdisyonIndirimTuru'>"+donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]+"</span>";
            $("#tdIndirimHucresi").html(tdIndirimHucresiHtml);
          }
        }else {

          if (donut.adisyonBilgileri[0]["adisyon_musteri_idsi"] != null || donut.adisyonBilgileri[0]["adisyon_calisan_idsi"] != null) {
            if (donut.adisyonBilgileri[0]["calisan_indirim_miktari"] > 0 || donut.adisyonBilgileri[0]["musteri_indirim_miktari"] > 0) {
              var tdIndirimHucresiHtml = "<h5 class='m-0'>0 <span class='spanKurIsareti'>"+donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]+"</span>";
              $("#tdIndirimHucresi").html(tdIndirimHucresiHtml);
            }else {
              var tdIndirimHucresiHtml = "<h5 class='m-0'>0 <span class='spanKurIsareti'>"+donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]+"</span>";
              $("#tdIndirimHucresi").html(tdIndirimHucresiHtml);
            }
          }else {
            var tdIndirimHucresiHtml = "<h5 class='m-0'>0 <span class='spanKurIsareti'>"+donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]+"</span>";
            $("#tdIndirimHucresi").html(tdIndirimHucresiHtml);
          }

        }
        if (donut.adisyonBilgileri[0]["adisyon_indirim_turu"] == 0) {
          $("#spanAdisyonIndirimTuru").html("%");
        }else {
          $("#spanAdisyonIndirimTuru").html(donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]);
        }



        $("#spanAdisyonIndirimMiktari").html(donut.adisyonBilgileri[0]["adisyon_indirim_miktari"]);
        if (donut.adisyonBilgileri[0]["adisyon_kalan_tutar"] < 0) {
          donut.adisyonBilgileri[0]["adisyon_kalan_tutar"] = 0;
        }
        $("#spanAdisyonKalanMiktar").html(donut.adisyonBilgileri[0]["adisyon_kalan_tutar"].toFixed(2));
        $(".spanKurIsareti").html(donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]);

        $(".tblSiparisUrunleri tbody").html("");

        for (var i = 0; i < donut.adisyonUrunleri.length; i++) {

          if (donut.adisyonBilgileri[i]["teslim_durumu_idsi"] == null) {
            var teslimDurumu = '<span class="badge badge-info">YENİ</span>';
          }else {
            var teslimDurumu = '<span class="badge badge-warning" style="background-color:'+donut.adisyonBilgileri[i]["teslim_durumu_rengi"]+'">'+donut.adisyonBilgileri[i]["teslim_durumu_adi"]+'</span>';
          }


          switch (donut.adisyonUrunleri[i]["adisyon_urunleri_urun_ozel_durumu_idsi"]) {
            case "0":
            var ozelDurumClass = "";
              break;
            case "1":
            var ozelDurumClass = "ikram";
            teslimDurumu = '<span class="badge badge-danger">İKRAM</span>';
              break;
            case "2":
            var ozelDurumClass = "iptal";
            teslimDurumu = '<span class="badge badge-danger">İPTAL</span>';
              break;
            default:

          }

          if (donut.adisyonUrunleri[i]["adisyon_urunleri_urun_odenmis_urun_adedi"] == donut.adisyonUrunleri[i]["adisyon_urunleri_urun_adedi"]) {
            donut.adisyonUrunleri[i]["urun_odendi_mi_class_adi"] = "odendi";
          }else {
            donut.adisyonUrunleri[i]["urun_odendi_mi_class_adi"] = "";
          }

          var eklenecekHtml = "<tr adisyon-urun-idsi='"+donut.adisyonUrunleri[i]["id"]+"' id='"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_idsi"]+"' tbl='"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_tablo_adi"]+"' class='"+ozelDurumClass+" "+donut.adisyonUrunleri[i]["urun_odendi_mi_class_adi"]+"'>";
          eklenecekHtml += "<td>"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_adedi"]+"</td>";


          if (donut.adisyonUrunleri[i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_urunler") {
            eklenecekHtml += "<td><strong>"+donut.adisyonUrunleri[i]["urun_adi"]+"</strong></td>";
          }else if (donut.adisyonUrunleri[i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_menuler") {
            eklenecekHtml += "<td><strong>"+donut.adisyonUrunleri[i]["menu_adi"]+" <button class='btn btn-xs float-right btn-default btnMenuIceriginiGoster'><span class='zmdi zmdi-eye' ></span></button> </strong></td>";
          }else {
            eklenecekHtml += "<td><strong>"+donut.adisyonUrunleri[i]["alt_urun_adi"]+"</strong></td>";
          }


          eklenecekHtml += "<td>"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_notu"]+"</td>";
          eklenecekHtml += "<td>"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_toplam_fiyati"]+" "+donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]+"</td><td>"+teslimDurumu+"</td>";
          eklenecekHtml += "</tr>";
          $(".tblSiparisUrunleri tbody").append(eklenecekHtml);

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
/*BİLGİLERİ GÜNCELLEME KODLARI*/



function topluSil(json) {
  return false;
}
