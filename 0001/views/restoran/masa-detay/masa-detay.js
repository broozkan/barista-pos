$(document).ready(function () {
  // var ekranYuksekligi = $(window).height();
  // var ekranGenisligi = $(window).width();
  //var urunSatiriGenisligi = $(".tblUrunler").width();
  // var urunTablosuYuksekligi = $(".tblUrunler").height();

  /* Kolon genişlikleri ayarlaması */
  // $(".tblKomutlarKapsayici").css("height",ekranYuksekligi/1.2);
  // $(".tblSiparisUrunleriKapsayici").css("height",ekranYuksekligi/1.9);
  // $(".tblUrunKategorileriKapsayici").css("height",ekranYuksekligi/1.3);
  // $(".tblUrunlerKapsayici").css("height",ekranYuksekligi/1.4);
  /* Kolon genişlikleri ayarlaması */

  /* Buton yükselik ve genişlik ayarlaması */
  // $(".tblUrunler button").css("width",ekranGenisligi/11);
  // $(".tblUrunler button").css("height",ekranYuksekligi/9);
  // $(".tblUrunKategorileri td button").css("height",ekranYuksekligi/9);
  /* Buton yükselik ve genişlik ayarlaması */

  /*Kategorilerden bir tanesini gösterme kodları*/
  // urunFiltrele($(".tblUrunKategorileri").find("tr").eq(1).find(".btnUrunKategorileri").attr("data-id"));
  /*Kategorilerden bir tanesini gösterme kodları*/


  /*AÇILIŞ YÜKLEME KODLARI*/
  var adisyonIdsi = $("#txtAdisyonIdsi").val();
  var masaDurumu = $("#txtMasaDurumu").val();
  if (!adisyonIdsi) {
    if (masaDurumu == "3") {
      $("#modalMasaRezerve").css("pointer-events","none");
      $("#modalMasaRezerve").modal("show");
    }
  }else {
    if (masaDurumu == "2") {
      $("#modalMasaKilitli").css("pointer-events","none");
      $("#modalMasaKilitli").modal("show");
    }else {
      bilgileriGuncelle(adisyonIdsi);
    }
  }

  $("button").each(function () {
    var bg = $(this).attr("bg");
    if (bg) {
      $(this).css("background","url("+bg+") no-repeat scroll 0 0 transparent");
      $(this).addClass("fullBgImage");
    }
  })
  /*AÇILIŞ YÜKLEME KODLARI*/


  /*WEBSOCKET KODLARI*/
  var websocket = new WebSocket("ws://"+window.location.hostname+":8090/");
  /*WEBSOCKET KODLARI*/

  $(".spanKeyboard").on("click",function () {
    var input = $(this).closest("tr").find("input");
    input.addClass("keyboard");
    $('.keyboard').keyboard({
      display : {
        // \u2714 = check mark - same action as accept
        'a'      : '\u2714:Accept (Shift-Enter)',
        'accept' : 'Onayla:Accept (Shift-Enter)',
        'alt'    : 'AltGr:Alternate Graphemes',
        // \u232b = outlined left arrow with x inside
        'b'      : '\u232b:Backspace',
        'bksp'   : 'Bksp:Backspace',
        // \u2716 = big X, close - same action as cancel
        'c'      : '\u2716:Cancel (Esc)',
        'cancel' : 'İptal:Cancel (Esc)',
        // clear num pad
        'clear'  : 'C:Clear',
        'combo'  : '\u00f6:Toggle Combo Keys',
        // decimal point for num pad (optional);
        // change '.' to ',' for European format
        'dec'    : '.:Decimal',
        // down, then left arrow - enter symbol
        'e'      : '\u21b5:Enter',
        'empty'  : '\u00a0', // &nbsp;
        'enter'  : 'Enter:Enter',
        // \u2190 = left arrow (move caret)
        'left'   : '\u2190',
        // caps lock
        'lock'   : '\u21ea Lock:Caps Lock',
        'next'   : 'Next',
        'prev'   : 'Prev',
        // \u2192 = right arrow (move caret)
        'right'  : '\u2192',
        // \u21e7 = thick hollow up arrow
        's'      : '\u21e7:Shift',
        'shift'  : 'Shift:Shift',
        // \u00b1 = +/- sign for num pad
        'sign'   : '\u00b1:Change Sign',
        'space'  : '&nbsp;:Space',

        // \u21e5 = right arrow to bar; used since this virtual
        // keyboard works with one directional tabs
        't'      : '\u21e5:Tab',
        // \u21b9 is the true tab symbol (left & right arrows)
        'tab'    : '\u21e5 Tab:Tab',
        // replaced by an image
        'toggle' : ' ',

        // added to titles of keys
        // accept key status when acceptValid:true
        'valid': 'valid',
        'invalid': 'invalid',
        // combo key states
        'active': 'active',
        'disabled': 'disabled'
      }
    });
    input.trigger("focus");
  })

  $(".urunArama").on("change",function () {
    var girilenDeger = $(this).val();
    $(this).closest("div.body").find(".tblUrunler button").hide();
    $(this).closest("div.body").find(".tblUrunler button:contains("+girilenDeger+")").show();
  })
  $(".kategoriArama").on("change",function () {
    var girilenDeger = $(this).val();
    $(this).closest("div.body").find(".tblUrunKategorileri button").hide();
    $(this).closest("div.body").find(".tblUrunKategorileri button:contains("+girilenDeger+")").show();
  })

  /*ÜRÜN KATEGORİLERİ KODLARI*/
  $(".btnUrunKategorileri").on("click",function () {
    var kategoriIdsi = $(this).attr("data-id");
    $("#btnAltUrunGeri").attr("data-id",kategoriIdsi);
    urunFiltrele(kategoriIdsi);
  })
  /*ÜRÜN KATEGORİLERİ KODLARI*/
  $(document).on("click",".tblSiparisUrunleri tr",function () {
    $(this).toggleClass("clicked");
  })


  /*ÜRÜNE NOT EKLEME KODLARI*/
  $(".btnNotEkle").on("click",function () {
    var kontrol = seciliSatirKontrol();
    if (kontrol) {
      $("#frmUruneNotEkle .txtNotuGirilecekAdisyonUrunuIdsi").remove();

      $(".tblSiparisUrunleri tr.clicked").each(function () {
        var notuGirilecekAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
        var eklenecekHtml = "<input type='hidden' name='txtNotuGirilecekAdisyonUrunuIdsi[]' class='txtNotuGirilecekAdisyonUrunuIdsi' value='"+notuGirilecekAdisyonUrunuIdsi+"' />";
        $("#frmUruneNotEkle").append(eklenecekHtml);
        $("#modalUruneNotEkle").modal("show");
      })
    }

  })

  $(".btnHizliNotlar").on("click",function () {
    $(this).closest("form").find("textarea").val($(this).html());
  })



  $("#frmUruneNotEkle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmUruneNotEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/urun-notu-ekle",
      data: {urunNotuEkle:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Not başarıyla eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          $("#modalUruneNotEkle").modal("hide");
          $(".tblUrunler tr").removeClass("clicked");
          bilgileriGuncelle(adisyonIdsi);
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })
  /*ÜRÜNE NOT EKLEME KODLARI*/

  /*REZERVASYON KALDIRMA KODLARI*/
  $("#frmRezervasyonKaldir").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmRezervasyonKaldir").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/rezervasyon-kaldir",
      data: {rezervasyonKaldir:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Rezervasyon kaldırıldı"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          $("#modalMasaRezerve").modal("hide");
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })
  /*REZERVASYON KALDIRMA KODLARI*/

  /*ADİSYON BÖLME KODLARI*/
  $(".btnAdisyonBol").on("click",function () {
    var mevcutMasaIdsi = $("#txtMasaIdsi").val();
    var seciliSatirSayisi = $(".tblSiparisUrunleri tbody tr.clicked").length;
    var satirSayisi = $(".tblSiparisUrunleri tbody tr").length;
    var kontrol = seciliSatirKontrol();
    if (kontrol) {
      if (seciliSatirSayisi == satirSayisi) {
        $("#txtMasaKapansinMi").val(1);
      }
      $("#frmAdisyonBol .txtBolunecekAdisyonUrunuIdsi").remove();
      $(".tblSiparisUrunleri tr.clicked").each(function () {
        var bolunecekAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
        var eklenecekHtml = "<input type='hidden' name='txtBolunecekAdisyonUrunuIdsi[]' class='txtBolunecekAdisyonUrunuIdsi' value='"+bolunecekAdisyonUrunuIdsi+"' />";
        $("#frmAdisyonBol").append(eklenecekHtml);

      })

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"restoran/acik-masalarin-bilgilerini-al",
        data: {acikMasalarinBilgileriniAl:mevcutMasaIdsi},
        cache: false,
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.acikMasalar) {
            $(".tblAcikMasalar tbody").html("");

            for (var i = 0; i < donut.acikMasalar.length; i++) {
              var eklenecekHtml = "<tr adisyon-idsi='"+donut.acikMasalar[i]["adisyon_idsi"]+"' id='"+donut.acikMasalar[i]["id"]+"'>";
              eklenecekHtml += "<td>"+donut.acikMasalar[i]["masa_adi"]+"</td>";
              eklenecekHtml += "<td>"+donut.acikMasalar[i]["lokasyon_adi"]+"</td>";
              eklenecekHtml += "<td><input class='btn btn-sm btn-default' type='submit' value='Seç' /></td>";
              eklenecekHtml += "</tr>";
              $(".tblAcikMasalar tbody").append(eklenecekHtml);
            }
            $("#modalAdisyonBol").modal("show");
          }else {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: donut.yanit
            },{
              // settings
              type: 'danger',
              z_index:7777,
              placement: {
                from: "bottom",
                align: "left"
              }
            });
          }
        }
      });
    }
  })


  $("#frmAdisyonBol").on("submit",function (e) {
    var txtBirlestirilmekIstenenMasaninAdisyonIdsi = $(document.activeElement);

    e.preventDefault();
    var formVerileri = $("form#frmAdisyonBol").serializeJSON();
    formVerileri["txtBirlestirilmekIstenenMasaninAdisyonIdsi"] = txtBirlestirilmekIstenenMasaninAdisyonIdsi.closest("tr").attr("adisyon-idsi");
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/adisyon-bol",
      data: {adisyonBol:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Adisyon başarıyla bölündü"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          $("#modalAdisyonBol").modal("hide");
          $(".tblUrunler tr").removeClass("clicked");
          bilgileriGuncelle(adisyonIdsi);
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })
  /*ADİSYON BÖLME KODLARI*/

  /*MASA BİRLEŞTİRME KODLARI*/
  $(".btnMasaBirlestir").on("click",function () {
    var mevcutMasaIdsi = $("#txtMasaIdsi").val();
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/acik-masalarin-bilgilerini-al",
      data: {acikMasalarinBilgileriniAl:mevcutMasaIdsi},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.acikMasalar) {
          $(".tblAcikMasalar tbody").html("");

          for (var i = 0; i < donut.acikMasalar.length; i++) {
            var eklenecekHtml = "<tr adisyon-idsi='"+donut.acikMasalar[i]["adisyon_idsi"]+"' id='"+donut.acikMasalar[i]["id"]+"'>";
            eklenecekHtml += "<td>"+donut.acikMasalar[i]["masa_adi"]+"</td>";
            eklenecekHtml += "<td>"+donut.acikMasalar[i]["lokasyon_adi"]+"</td>";
            eklenecekHtml += "<td><input class='btn btn-sm btn-default' type='submit' value='Seç' /></td>";
            eklenecekHtml += "</tr>";
            $(".tblAcikMasalar tbody").append(eklenecekHtml);
          }
          $("#modalMasaBirlestir").modal("show");
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })

  $("#frmMasaBirlestir").on("submit",function (e) {
    var txtBirlestirilmekIstenenMasaninAdisyonIdsi = $(document.activeElement);

    e.preventDefault();
    var formVerileri = $("form#frmMasaBirlestir").serializeJSON();
    formVerileri["txtBirlestirilmekIstenenMasaninAdisyonIdsi"] = txtBirlestirilmekIstenenMasaninAdisyonIdsi.closest("tr").attr("adisyon-idsi");
    formVerileri["txtBirlestirilmekIstenenMasaIdsi"] = txtBirlestirilmekIstenenMasaninAdisyonIdsi.closest("tr").attr("id");
    formVerileri["txtAdisyonIdsi"] = $("#txtAdisyonIdsi").val();
    var json = JSON.stringify(formVerileri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masa-birlestir",
      data: {masaBirlestir:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Masa başarılı bir şekilde birleştirildi!"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          $("#modalMasaBirlestir").modal("hide");
          bilgileriGuncelle(adisyonIdsi);
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })
  /*MASA BİRLEŞTİRME KODLARI*/

  /*MASA DEĞİŞTİRME KODLARI*/
  $(".btnMasaDegistir").on("click",function () {

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/kapali-masalarin-bilgilerini-al",
      data: {kapaliMasalarinBilgileriniAl:1},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.kapaliMasalar) {
          for (var i = 0; i < donut.kapaliMasalar.length; i++) {
            var eklenecekHtml = "<tr id='"+donut.kapaliMasalar[i]["id"]+"' >";
            eklenecekHtml += "<td>"+donut.kapaliMasalar[i]["masa_adi"]+"</td>";
            eklenecekHtml += "<td>"+donut.kapaliMasalar[i]["lokasyon_adi"]+"</td>";
            eklenecekHtml += "<td><input class='btn btn-sm btn-default' type='submit' value='Seç' /></td>";
            eklenecekHtml += "</tr>";
            $(".tblKapaliMasalar tbody").append(eklenecekHtml);
            $("#modalMasaDegistir").modal("show");
          }
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })

  $("#frmMasaDegistir").on("submit",function (e) {
    var txtDegistirilmekIstenenMasaIdsi = $(document.activeElement);

    e.preventDefault();
    var formVerileri = $("form#frmMasaDegistir").serializeJSON();
    formVerileri["txtDegistirilmekIstenenMasaIdsi"] = txtDegistirilmekIstenenMasaIdsi.closest("tr").attr("id");
    formVerileri["txtAdisyonIdsi"] = $("#txtAdisyonIdsi").val();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masa-degistir",
      data: {masaDegistir:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Masa başarılı bir şekilde değiştirildi!"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          window.location.href = ""+yolHtml+"restoran/masa-detay/"+formVerileri["txtDegistirilmekIstenenMasaIdsi"];
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })
  /*MASA DEĞİŞTİRME KODLARI*/

  /*MÜŞTERİYİ KALDIRMA KODLARI*/
  $(document).on("click",".btnMusteriyiKaldir",function () {
    var adisyonIdsi = $("#txtAdisyonIdsi").val();
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/adisyon-musterisini-kaldir",
      data: {adisyonMusterisiniKaldir:adisyonIdsi},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Müşteri/Çalışan başarılı bir şekilde kaldırıldı!"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          bilgileriGuncelle(adisyonIdsi);
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })
  /*MÜŞTERİYİ KALDIRMA KODLARI*/

  /*İNDİRİMİ TEKRAR EKLEME KODLARI*/
  $(document).on("click",".btnIndirimiTekrarEkle",function () {
    var adisyonIdsi = $("#txtAdisyonIdsi").val();
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/adisyon-indirimini-tekrar-ekle",
      data: {adisyonIndiriminiTekrarEkle:adisyonIdsi},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "İndirim tekrardan başarılı bir şekilde uygulandı!"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          bilgileriGuncelle(adisyonIdsi);
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })
  /*İNDİRİMİ TEKRAR EKLEME KODLARI*/

  /*İNDİRİMİ KALDIRMA KODLARI*/
  $(document).on("click",".btnIndirimiKaldir",function () {
    var adisyonIdsi = $("#txtAdisyonIdsi").val();
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/adisyon-indirimini-kaldir",
      data: {adisyonIndiriminiKaldir:adisyonIdsi},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "İndirim başarılı bir şekilde kaldırıldı!"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          bilgileriGuncelle(adisyonIdsi);
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })

  /*İNDİRİMİ KALDIRMA KODLARI*/

  /*ÜRÜN DURUM DEĞİŞTİR KODLARI*/
  $(".btnDurumDegistir").on("click",function () {
    var kontrol = seciliSatirKontrol();
    if (kontrol) {
      $("#frmTeslimDurumuDegistir .txtDurumuDegistirilecekAdisyonUrunuIdsi").remove();

      $(".tblSiparisUrunleri tr.clicked").each(function () {
        var durumuDegistirilecekAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
        var eklenecekHtml = "<input type='hidden' name='txtDurumuDegistirilecekAdisyonUrunuIdsi[]' class='txtDurumuDegistirilecekAdisyonUrunuIdsi' value='"+durumuDegistirilecekAdisyonUrunuIdsi+"' />";
        $("#frmTeslimDurumuDegistir").append(eklenecekHtml);
        $("#modalTeslimDurumuDegistir").modal("show");
      })
    }

  })

  $("#frmTeslimDurumuDegistir").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmTeslimDurumuDegistir").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/urun-teslim-durumunu-degistir",
      data: {urunTeslimDurumunuDegistir:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "İşlem başarılı"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          $(".tblUrunler tr").removeClass("clicked");
          $("#modalTeslimDurumuDegistir").modal("hide");
          bilgileriGuncelle(adisyonIdsi);
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })

  /*ÜRÜN DURUM DEĞİŞTİR KODLARI*/


  /*ÜRÜN YAZDIRMA KODLARI*/
  $(".btnYazdir").on("click",function () {
    var kontrol = seciliSatirKontrol();

    if (kontrol) {

      var yazdirilacakAdisyonUrunIdleri = new Array();
      $(".tblSiparisUrunleri tr.clicked").each(function () {
        var yazdirilacakAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
        var adisyonIdsi = $("#txtAdisyonIdsi").val();
        var yazdirilacakUrununIdsi = $(this).attr("id");
        var yazdirilacakUrununTabloAdi = $(this).attr("tbl");
        var json = {"txtAdisyonUrunuIdsi":yazdirilacakAdisyonUrunuIdsi,"txtUrunIdsi":yazdirilacakUrununIdsi,"txtAdisyonIdsi":adisyonIdsi,"txtUrunTabloAdi":yazdirilacakUrununTabloAdi};
        yazdirilacakAdisyonUrunIdleri.push(json);
      })

      json = JSON.stringify(yazdirilacakAdisyonUrunIdleri);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"restoran/urunleri-yazdir",
        data: {urunleriYazdir:json},
        cache: false,
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit == true) {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: "İşlem başarılı"
            },{
              // settings
              type: 'success',
              z_index:7777,
              placement: {
                from: "bottom",
                align: "left"
              }
            });
            $(".tblUrunler tr").removeClass("clicked");
          }else {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: donut.yanit
            },{
              // settings
              type: 'danger',
              z_index:7777,
              placement: {
                from: "bottom",
                align: "left"
              }
            });
          }
        }
      });
    }
  })

  $(".btnIptalFisiYazdir").on("click",function () {
    var kontrol = seciliSatirKontrol();

    if (kontrol) {

      var yazdirilacakAdisyonUrunIdleri = new Array();
      $(".tblSiparisUrunleri tr.clicked").each(function () {
        var yazdirilacakAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
        var adisyonIdsi = $("#txtAdisyonIdsi").val();
        var yazdirilacakUrununIdsi = $(this).attr("id");
        var yazdirilacakUrununTabloAdi = $(this).attr("tbl");
        var json = {"txtAdisyonUrunuIdsi":yazdirilacakAdisyonUrunuIdsi,"txtUrunIdsi":yazdirilacakUrununIdsi,"txtAdisyonIdsi":adisyonIdsi,"txtUrunTabloAdi":yazdirilacakUrununTabloAdi};
        yazdirilacakAdisyonUrunIdleri.push(json);
      })

      json = JSON.stringify(yazdirilacakAdisyonUrunIdleri);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"restoran/iptal-fisi-yazdir",
        data: {iptalFisiYazdir:json},
        cache: false,
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit == true) {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: "İşlem başarılı"
            },{
              // settings
              type: 'success',
              z_index:7777,
              placement: {
                from: "bottom",
                align: "left"
              }
            });
            $(".tblUrunler tr").removeClass("clicked");
          }else {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: donut.yanit
            },{
              // settings
              type: 'danger',
              z_index:7777,
              placement: {
                from: "bottom",
                align: "left"
              }
            });
          }
        }
      });
    }
  })
  /*ÜRÜN YAZDIRMA KODLARI*/

  /*ÜRÜN ÖZEL DURUM KODLARI*/
  $(".btnIkram").on("click",function () {
    var kontrol = seciliSatirKontrol();
    if (kontrol) {

      var ikramEdilecekAdisyonUrunIdleri = new Array();
      $(".tblSiparisUrunleri tr.clicked").each(function () {
        if ($(this).hasClass("odendi")) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Ödenmiş ürünü ikram veya iptal edemezsiniz!"
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          return false;
        }
        var ikramEdilecekAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
        var json = {"txtAdisyonUrunuIdsi":ikramEdilecekAdisyonUrunuIdsi};
        ikramEdilecekAdisyonUrunIdleri.push(json);
      })

      json = JSON.stringify(ikramEdilecekAdisyonUrunIdleri);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"restoran/urun-ikram-et",
        data: {urunIkramEt:json},
        cache: false,
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit == true) {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: "İşlem başarılı"
            },{
              // settings
              type: 'success',
              z_index:7777,
              placement: {
                from: "bottom",
                align: "left"
              }
            });
            $(".tblUrunler tr").removeClass("clicked");
            bilgileriGuncelle(adisyonIdsi);
          }else {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: donut.yanit
            },{
              // settings
              type: 'danger',
              z_index:7777,
              placement: {
                from: "bottom",
                align: "left"
              }
            });
          }
        }
      });
    }

  })

  $(".btnIptal").on("click",function () {

    var kontrol = seciliSatirKontrol();
    if (kontrol) {
      var iptalEdilecekAdisyonUrunIdleri = new Array();
      $(".tblSiparisUrunleri tr.clicked").each(function () {
        if ($(this).hasClass("odendi")) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Ödenmiş ürünü ikram veya iptal edemezsiniz!"
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          return false;
        }
        var iptalEdilecekAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
        var iptalEdilecekUrunIdsi = $(this).attr("id");
        var json = {"txtAdisyonUrunuIdsi":iptalEdilecekAdisyonUrunuIdsi,"txtUrunIdsi":iptalEdilecekUrunIdsi};
        iptalEdilecekAdisyonUrunIdleri.push(json);
      })
      json = JSON.stringify(iptalEdilecekAdisyonUrunIdleri);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"restoran/urun-iptal-et",
        data: {urunIptalEt:json},
        cache: false,
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit == true) {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: "İşlem başarılı"
            },{
              // settings
              type: 'success',
              z_index:7777,
              placement: {
                from: "bottom",
                align: "left"
              }
            });
            $(".tblUrunler tr").removeClass("clicked");
            bilgileriGuncelle(adisyonIdsi);
          }else {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: donut.yanit
            },{
              // settings
              type: 'danger',
              z_index:7777,
              placement: {
                from: "bottom",
                align: "left"
              }
            });
          }
        }
      });


    }

  })
  /*ÜRÜN ÖZEL DURUM KODLARI*/


  /*ÜRÜN SİL KODLARI*/
  $(".btnSil").on("click",function () {
    var adisyonIdsi = $("#txtAdisyonIdsi").val();
    var seciliSatirSayisi = $(".tblSiparisUrunleri tbody tr.clicked").length;
    var satirSayisi = $(".tblSiparisUrunleri tbody tr").length;
    var kontrol = seciliSatirKontrol();
    if (kontrol) {
      if (seciliSatirSayisi == satirSayisi) {
        onayla("Masadaki tüm ürünleri silmek masayı kapatacaktır. Onaylıyor musunuz?",function callBack(onay) {
          if (onay == true) {
            var masaKapansinMi = 1;
            var silinecekAdisyonUrunIdleri = new Array();
            $(".tblSiparisUrunleri tr.clicked").each(function () {
              var silinecekAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
              var silinecekUrunIdsi = $(this).attr("id");
              var masaIdsi = $("#txtMasaIdsi").val();
              var json = {"txtUrunIdsi":silinecekUrunIdsi,"txtAdisyonUrunuIdsi":silinecekAdisyonUrunuIdsi,"txtAdisyonIdsi":adisyonIdsi,"txtMasaKapansinMi":masaKapansinMi,"txtMasaIdsi":masaIdsi};
              silinecekAdisyonUrunIdleri.push(json);
            })
            json = JSON.stringify(silinecekAdisyonUrunIdleri);
            adisyonUrunleriniSil(json);
            window.location.href = yolHtml+"restoran/masalar";
          }else {
            return false;
          }
        });
      }else {
        var masaKapansinMi = 0;
        var silinecekAdisyonUrunIdleri = new Array();
        $(".tblSiparisUrunleri tr.clicked").each(function () {
          var silinecekAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
          var silinecekUrunIdsi = $(this).attr("id");
          var masaIdsi = $("#txtMasaIdsi").val();
          var json = {"txtUrunIdsi":silinecekUrunIdsi,"txtAdisyonUrunuIdsi":silinecekAdisyonUrunuIdsi,"txtAdisyonIdsi":adisyonIdsi,"txtMasaKapansinMi":masaKapansinMi,"txtMasaIdsi":masaIdsi};
          silinecekAdisyonUrunIdleri.push(json);
        })
        json = JSON.stringify(silinecekAdisyonUrunIdleri);
        adisyonUrunleriniSil(json);
      }

    }

  })
  /*ÜRÜN SİL KODLARI*/



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
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });

  })
  /*MENÜ İÇERİĞİNİ GÖSTERME KODLARI*/



  /*MASAYA MÜŞTERİ ATAMA KODLARI*/
  $("#frmMasayaMusteriAta").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmMasayaMusteriAta").serializeJSON();
    formVerileri["txtMusteriIdsi"] = $("#txtMasayaMusteriAtaMusteriAdiSoyadi").attr("data-id");
    if (!formVerileri["txtMusteriIdsi"]) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Müşteri bulunamadı. Lütfen arama sonuçlarından bir müşteri seçiniz!"
      },{
        // settings
        type: 'danger',
        z_index:7777,
        placement: {
          from: "bottom",
          align: "left"
        }
      });
      return false;
    }
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masaya-musteri-ata",
      data: {masayaMusteriAta:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "İşlem başarılı"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          $("#modalMasayaMusteriAta").modal("hide");
          bilgileriGuncelle(adisyonIdsi);
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })
  /*MASAYA MÜŞTERİ ATAMA KODLARI*/

  /*MASAYA SİPARİŞ ÜRÜN EKLE GİR KODLARI*/
  $(document).on("click",".btnUrunAdi",function () {
    var urunIdsi = $(this).attr("id");
    var urunAdedi = $("#txtUrunAdedi").val();
    var urunGrami = $("#txtUrunGrami").val();
    if (!urunGrami) {
      urunGrami = null;
    }
    var masaIdsi = $("#txtMasaIdsi").val();
    if (!urunAdedi) {
      urunAdedi = 1;
    }
    var adisyonIdsi = $("#txtAdisyonIdsi").val();
    var json = {
      "txtUrunIdsi":urunIdsi,
      "txtUrunAdedi":urunAdedi,
      "txtUrunGrami":urunGrami,
      "txtMasaIdsi":masaIdsi,
      "txtAdisyonIdsi":adisyonIdsi
    };
    json = JSON.stringify(json);
    $("#txtUrunAdedi").val("");
    $("#txtUrunGrami").val("");
    $(".klavye-wrapper").addClass("d-none");

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masaya-urun-ekle/"+adisyonIdsi,
      data: {masayaUrunEkle:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          // $.notify({
          //   // options
          //   icon: 'fa fa-danger fa-2x',
          //   message: "Ürün eklendi"
          // },{
          //   // settings
          //   type: 'success',
          //   z_index:7777,
          //   placement: {
          //     from: "bottom",
          //     align: "left"
          //   }
          // });
          $("#txtAdisyonIdsi").val(donut.adisyonIdsi);
          $(".btnOdemeVeKapat").removeClass("disabled");
          bilgileriGuncelle(adisyonIdsi);
          var messageJSON = {
            urun_adi: null,
            urun_teslim_durumu_idsi: null,
            mutfak_adi: null,
            masa_adi: null,
            masa_guncelle: 1
          };
          websocket.send(JSON.stringify(messageJSON));
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });

  })
  $(document).on("click",".btnAltUrunAdi",function () {

    var urunIdsi = $(this).attr("id");
    var urunAdedi = $("#txtUrunAdedi").val();
    var masaIdsi = $("#txtMasaIdsi").val();
    if (!urunAdedi) {
      urunAdedi = 1;
    }
    var adisyonIdsi = $("#txtAdisyonIdsi").val();
    var json = {
      "txtUrunIdsi":urunIdsi,
      "txtUrunAdedi":urunAdedi,
      "txtMasaIdsi":masaIdsi,
      "txtAdisyonIdsi":adisyonIdsi
    };
    json = JSON.stringify(json);
    $("#txtUrunAdedi").val("");
    $(".klavye-wrapper").addClass("d-none");
    $(".klavye-wrapper").addClass("d-none");

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masaya-urun-ekle",
      data: {masayaAltUrunEkle:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Ürün eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          $(".btnOdemeVeKapat").removeClass("disabled");
          $("#txtAdisyonIdsi").val(donut.adisyonIdsi);
          bilgileriGuncelle(adisyonIdsi);
          var messageJSON = {
            urun_adi: null,
            urun_teslim_durumu_idsi: null,
            mutfak_adi: null,
            masa_adi: null,
            masa_guncelle: 1
          };
          websocket.send(JSON.stringify(messageJSON));
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });

  })
  $(document).on("click",".btnMenuAdi",function () {

    var urunIdsi = $(this).attr("id");
    var urunAdedi = $("#txtUrunAdedi").val();
    var masaIdsi = $("#txtMasaIdsi").val();
    if (!urunAdedi) {
      urunAdedi = 1;
    }
    var adisyonIdsi = $("#txtAdisyonIdsi").val();
    var json = {
      "txtUrunIdsi":urunIdsi,
      "txtUrunAdedi":urunAdedi,
      "txtMasaIdsi":masaIdsi,
      "txtAdisyonIdsi":adisyonIdsi
    };
    json = JSON.stringify(json);
    $("#txtUrunAdedi").val("");
    $(".klavye-wrapper").addClass("d-none");

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masaya-urun-ekle",
      data: {masayaMenuEkle:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Ürün eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          $(".btnOdemeVeKapat").removeClass("disabled");
          $("#txtAdisyonIdsi").val(donut.adisyonIdsi);
          bilgileriGuncelle(adisyonIdsi);
          var messageJSON = {
            urun_adi: null,
            urun_teslim_durumu_idsi: null,
            mutfak_adi: null,
            masa_adi: null,
            masa_guncelle: 1
          };
          websocket.send(JSON.stringify(messageJSON));
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });

  })
  /*MASAYA SİPARİŞ ÜRÜN EKLE GİR KODLARI*/


  /*MASAYA ÇALIŞAN ATAMA KODLARI*/
  $("#frmMasayaCalisanAta").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmMasayaCalisanAta").serializeJSON();
    formVerileri["txtCalisanIdsi"] = $("#txtMasayaCalisanAtaCalisanAdiSoyadi").attr("data-id");
    if (!formVerileri["txtCalisanIdsi"]) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Çalışan bulunamadı. Lütfen arama sonuçlarından bir müşteri seçiniz!"
      },{
        // settings
        type: 'danger',
        z_index:7777,
        placement: {
          from: "bottom",
          align: "left"
        }
      });
      return false;
    }
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masaya-calisan-ata",
      data: {masayaCalisanAta:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "İşlem başarılı"
          },{
            // settings
            type: 'success',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
          $("#modalMasayaCalisanAta").modal("hide");
          bilgileriGuncelle(adisyonIdsi);
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index:7777,
            placement: {
              from: "bottom",
              align: "left"
            }
          });
        }
      }
    });
  })
  /*MASAYA ÇALIŞAN ATAMA KODLARI*/

  /*ÜRÜN GÖSTERME FİLTRELEME KODLARI*/
  $("#btnAltUrunGeri").on("click",function () {
    $(".tblUrunler button.btnAltUrunAdi").addClass("d-none");
    $(".trAltUrunGeri").addClass("d-none");
    $(".tblUrunler button.btnUrunAdi").removeClass("d-none");
    var btnGeciciUstUrun = $(".tblUrunler").find(".btnGeciciUstUrun");
    btnGeciciUstUrun.removeClass("btnUrunAdi");
    btnGeciciUstUrun.addClass("btnAltUrunleriGoster");
    btnGeciciUstUrun.removeClass("btnGeciciUstUrun");
    var kategoriIdsi = $(this).attr("data-id");
    urunFiltrele(kategoriIdsi);
  })

  $(document).on("click",".btnAltUrunleriGoster",function () {

    var urunIdsi = $(this).attr("id");
    var urunAdi = $(this).find("span.urunAdi").html();
    var btn = $(this);

    $(".spanUstKategoriAdi").html(urunAdi);
    $(".tblUrunler button").addClass("d-none");
    $(".tblUrunler button.btnAltUrunAdi[ust-urun-id='"+urunIdsi+"']").removeClass("d-none");
    $(".trAltUrunGeri").removeClass("d-none");

    btn.removeClass("btnAltUrunleriGoster");
    btn.addClass("btnUrunAdi");
    btn.addClass("btnGeciciUstUrun");
    btn.removeClass("d-none");

  })

  $(document).on("click",".btnUrunAdi",function () {
    var urunId = $(this).attr("id");
    var urunAdedi = $("#txtUrunAdedi").val();
    if (urunAdedi == "") {
      urunAdedi = 1;
    }

    /*  ÜRÜN EKLEMESİ YAPILACAKTIR  */

  })
  /*ÜRÜN GÖSTERME FİLTRELEME KODLARI*/


})

function adisyonUrunleriniSil(json) {
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"restoran/urun-sil",
    data: {urunSil:json},
    cache: false,
    success: function(response)
    {
      var donut = $.parseJSON(response);
      if (donut.yanit == true) {
        $.notify({
          // options
          icon: 'fa fa-danger fa-2x',
          message: "İşlem başarılı"
        },{
          // settings
          type: 'success',
          z_index:7777,
          placement: {
            from: "bottom",
            align: "left"
          }
        });
        var adisyonIdsi = $("#txtAdisyonIdsi").val();
        bilgileriGuncelle(adisyonIdsi);
      }else {
        $.notify({
          // options
          icon: 'fa fa-danger fa-2x',
          message: donut.yanit
        },{
          // settings
          type: 'danger',
          z_index:7777,
          placement: {
            from: "bottom",
            align: "left"
          }
        });
      }
    }
  });
}
/*BİLGİLERİ GÜNCELLEME KODLARI*/
function bilgileriGuncelle() {
  var masaIdsi = $("#txtMasaIdsi").val();
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"restoran/bilgileri-guncelle",
    data: {bilgileriGuncelle:masaIdsi},
    cache: false,
    success: function(response)
    {
      var donut = $.parseJSON(response);
      if (donut.adisyonBilgileri) {
        $("#spanMasaAdi").html(donut.adisyonBilgileri[0]["masa_adi"]);
        $("#spanAdisyonTutari").html(donut.adisyonBilgileri[0]["adisyon_tutari"]);
        $("#spanMusteriAdiSoyadi").html("Masaya müşteri veya çalışan atanmamış");

        if (donut.adisyonBilgileri[0]["adisyon_musteri_idsi"] != null) {
          $("#spanMusteriAdiSoyadi").html("<span id=''>"+donut.adisyonBilgileri[0]["musteri_adi_soyadi"]+"</span> <button class='btn bg-red btn-sm btnMusteriyiKaldir float-right' type='button'>Müşteriyi kaldır</button>");
        }

        if (donut.adisyonBilgileri[0]["adisyon_calisan_idsi"] != null) {
          $("#spanMusteriAdiSoyadi").html("<span id=''>"+donut.adisyonBilgileri[0]["calisan_adi_soyadi"]+"</span> <button class='btn bg-red btn-sm btnMusteriyiKaldir float-right' type='button'>Müşteriyi kaldır</button>");

        }


        $("#spanAdisyonOdenmisMiktar").html(donut.adisyonBilgileri[0]["adisyon_odenmis_tutar"]);


        if (donut.adisyonBilgileri[0]["adisyon_indirim_miktari"] > 0) {
          if (donut.adisyonBilgileri[0]["adisyon_indirim_turu"] == 0) {
            var tdIndirimHucresiHtml = "<h5 class='m-0'><span id='spanAdisyonIndirimTuru'>%</span><span id='spanAdisyonIndirimMiktari'>"+donut.adisyonBilgileri[0]["adisyon_indirim_miktari"]+"</span>";
            tdIndirimHucresiHtml += "<button class='btn bg-red btn-sm btnIndirimiKaldir float-right' type='button'>İndirimi kaldır</button></h5>";
            $("#tdIndirimHucresi").html(tdIndirimHucresiHtml);
          }else {
            var tdIndirimHucresiHtml = "<h5 class='m-0'><span id='spanAdisyonIndirimMiktari'>"+donut.adisyonBilgileri[0]["adisyon_indirim_miktari"]+"</span> <span id='spanAdisyonIndirimTuru'>"+donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]+"</span>";
            tdIndirimHucresiHtml += "<button class='btn bg-red btn-sm btnIndirimiKaldir float-right' type='button'>İndirimi kaldır</button></h5>";
            $("#tdIndirimHucresi").html(tdIndirimHucresiHtml);
          }
        }else {

          if (donut.adisyonBilgileri[0]["adisyon_musteri_idsi"] != null || donut.adisyonBilgileri[0]["adisyon_calisan_idsi"] != null) {
            if (donut.adisyonBilgileri[0]["calisan_indirim_miktari"] > 0 || donut.adisyonBilgileri[0]["musteri_indirim_miktari"] > 0) {
              var tdIndirimHucresiHtml = "<h5 class='m-0'>0 <span class='spanKurIsareti'>"+donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]+"</span>";
              tdIndirimHucresiHtml += "<button class='btn g-bg-cgreen btn-sm btnIndirimiTekrarEkle float-right' type='button'>İndirimi Uygula</button></h5>";
              $("#tdIndirimHucresi").html(tdIndirimHucresiHtml);
            }else {
              var tdIndirimHucresiHtml = "<h5 class='m-0'>0 <span class='spanKurIsareti'>"+donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]+"</span>";
              tdIndirimHucresiHtml += "<button disabled class='btn btn-info btn-sm float-right btnIndirimiTekrarEkle' type='button' title='Müşterinin tanımlanan indirim miktarı zaten bulunmamaktadır'>Mevcut Değil</button></h5>";
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
            donut.adisyonUrunleri[i]["urun_odendi_mi"] = "(Ödendi)";

          }else {
            donut.adisyonUrunleri[i]["urun_odendi_mi_class_adi"] = "";
            donut.adisyonUrunleri[i]["urun_odendi_mi"] = "";

          }

          var eklenecekHtml = "<tr adisyon-urun-idsi='"+donut.adisyonUrunleri[i]["id"]+"' id='"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_idsi"]+"' tbl='"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_tablo_adi"]+"' class='"+ozelDurumClass+" "+donut.adisyonUrunleri[i]["urun_odendi_mi_class_adi"]+"'>";
          eklenecekHtml += "<td>"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_adedi"]+"</td>";


          if (donut.adisyonUrunleri[i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_urunler") {
            eklenecekHtml += "<td><strong>"+donut.adisyonUrunleri[i]["urun_adi"]+" "+donut.adisyonUrunleri[i]["urun_odendi_mi"]+" </strong></td>";
          }else if (donut.adisyonUrunleri[i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_menuler") {
            eklenecekHtml += "<td><strong>"+donut.adisyonUrunleri[i]["urun_adi"]+"  "+donut.adisyonUrunleri[i]["urun_odendi_mi"]+" <button class='btn btn-xs float-right btn-default btnMenuIceriginiGoster'><span class='zmdi zmdi-eye' ></span></button> </strong></td>";
          }else {
            eklenecekHtml += "<td><strong>"+donut.adisyonUrunleri[i]["urun_adi"]+" "+donut.adisyonUrunleri[i]["urun_odendi_mi"]+" </strong></td>";
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
          z_index:7777,
          placement: {
            from: "bottom",
            align: "left"
          }
        });
      }
    }
  });
}
/*BİLGİLERİ GÜNCELLEME KODLARI*/


function seciliSatirKontrol() {
  var seciliUrunSayisi = $(".tblSiparisUrunleri tr.clicked").length;
  if (seciliUrunSayisi == 0) {
    $.notify({
      // options
      icon: 'fa fa-danger fa-2x',
      message: "Lütfen notu girilecek ürünü veya ürünleri seçiniz!"
    },{
      // settings
      type: 'danger',
      z_index:7777,
      placement: {
        from: "bottom",
        align: "left"
      }
    });
    return false;
  }else {
    return true;
  }
}
function topluSil(json) {
  return false;
}
function urunFiltrele(kategoriIdsi) {
  $(".tblUrunler button").addClass("d-none");
  $(".tblUrunler button[kategori-id='"+kategoriIdsi+"']").removeClass("d-none");
}
