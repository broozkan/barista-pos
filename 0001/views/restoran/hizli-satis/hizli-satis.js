$(document).ready(function () {
  // var ekranYuksekligi = $(window).height();
  // var ekranGenisligi = $(window).width();
  // var urunSatiriGenisligi = $(".tblUrunler").width();
  // var urunTablosuYuksekligi = $(".tblUrunler").height();

  /* Kolon genişlikleri ayarlaması */
  // $(".tblKomutlarKapsayici").css("height",ekranYuksekligi/1.2);
  // $(".tblSiparisUrunleriKapsayici").css("height",ekranYuksekligi/1.9);
  // $(".tblUrunKategorileriKapsayici").css("height",ekranYuksekligi/1.3);
  // $(".tblOdemeMetodlariKapsayici").css("height",ekranYuksekligi/1.3);
  // $(".tblUrunlerKapsayici").css("height",ekranYuksekligi/1.6);
  /* Kolon genişlikleri ayarlaması */

  /* Buton yükselik ve genişlik ayarlaması */
  // $(".tblUrunler button").css("width",ekranGenisligi/11);
  // $(".tblUrunler button").css("height",ekranYuksekligi/9);
  // $(".tblUrunKategorileri td button").css("height",ekranYuksekligi/9);
  // $(".tblOdemeMetodlari td button").css("height",ekranYuksekligi/9);
  /* Buton yükselik ve genişlik ayarlaması */

  /*AÇILIŞ YÜKLEME KODLARI*/
  var adisyonIdsi = $("#txtAdisyonIdsi").val();
  if (!adisyonIdsi) {

  }else {
    bilgileriGuncelleHizliSatis(adisyonIdsi);
  }

  $("button").each(function () {
    var bg = $(this).attr("bg");
    if (bg) {
      $(this).css("background","url("+bg+") no-repeat scroll 0 0 transparent");
      $(this).addClass("fullBgImage");
    }
  })
  /*AÇILIŞ YÜKLEME KODLARI*/

  /*WEBSOCKET ÖKC BAĞLANTI KODLARI*/
  var cihazDurumu = 0;
  var okcBilgileri = "";
  var websocket;
  if ($("#txtOkcAktifMi").val() == 1) {
    getUserIP(function(ip){

      websocket = new WebSocket("ws://"+ip+":8088/");
      websocket.onopen = function(event) {
        var okcPortAdi = $("#txtOkcPortAdi").val();
        var okcBaudRate = $("#txtOkcBaudRate").val();
        var okcFiscalIdsi = $("#txtOkcFiscalIdsi").val();
        var json = {"txtOkcPortAdi":okcPortAdi,"txtOkcBaudRate":okcBaudRate,"txtOkcFiscalIdsi":okcFiscalIdsi};
        okcBilgileri = JSON.stringify(json);

        var messageJSON = {
          urun_adi: "baglan",
          urun_teslim_durumu_idsi: "teslimDurumuIdsi",
          mutfak_adi: "mutfakAdi",
          masa_adi: "masaAdi",
          fonksiyon_adi: "baglan",
          fonksiyon_parametreleri: okcBilgileri
        };
        websocket.send(JSON.stringify(messageJSON));


      }

      websocket.onmessage = function(event) {
        var websocketMesaji = $.parseJSON(event.data);
        if (websocketMesaji["cihazDurumu"]) {
          cihazDurumu = websocketMesaji["cihazDurumu"];
        }else if (websocketMesaji["odemeTipiIdsi"]) {
          $("#tbodyOdemeMetodlari tr").removeClass("d-none");
          var eklenecekHtml = "<tr>";
          eklenecekHtml += "<td>";
          eklenecekHtml += "<button index='"+websocketMesaji["odemeTipiIdsi"]+"' data-id='1' type='button' class='btn g-bg-soundcloud btn-lg btnOdemeMetodlari' name='button'>'"+websocketMesaji["odemeTipiAdi"]+"'</button>";
          eklenecekHtml += "</td>";
          eklenecekHtml += "</tr>";
          $("#tbodyOdemeMetodlari").append(eklenecekHtml);

        }
      };

      websocket.onerror = function(event){
        console.log("Bir sorun oluştu.");
      };
      websocket.onclose = function(event){

      };

    });
  }
  /*WEBSOCKET ÖKC BAĞLANTI KODLARI*/


  /*WEBSOCKET ODEME METDOLARINI ALMA KODLARI*/
  setTimeout(function(){
    var messageJSON = {
      urun_adi: "odemeTipleriniAl",
      urun_teslim_durumu_idsi: "teslimDurumuIdsi",
      mutfak_adi: "mutfakAdi",
      masa_adi: "masaAdi",
      fonksiyon_adi: "odemeTipleriniAl",
      fonksiyon_parametreleri: "{}"
    };
    websocket.send(JSON.stringify(messageJSON));
  }, 1000);

  /*WEBSOCKET ODEME METDOLARINI ALMA KODLARI*/


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

  // $(".btnTusTakimi").on("click",function () {
  //   var urunAdedi = $(".txtUrunAdedi").val();
  //   var tiklananSayi = $(this).html();
  //   var yazilacakSayi = urunAdedi+tiklananSayi;
  //   $(".txtUrunAdedi").val(yazilacakSayi);
  // })

  $(".keyboard").on("change",function () {
    var girilenDeger = $(this).val();
    $(this).closest("div.body").find(".tblUrunler button").hide();
    $(this).closest("div.body").find(".tblUrunler button:contains("+girilenDeger+")").show();
  })

  /*ÜRÜN KATEGORİLERİ KODLARI*/
  $(".btnUrunKategorileri").on("click",function () {
    var kategoriIdsi = $(this).attr("data-id");
    $("#btnAltUrunGeri").attr("data-id",kategoriIdsi);
    urunFiltrele(kategoriIdsi);
  })
  /*ÜRÜN KATEGORİLERİ KODLARI*/


  /*modalOkcFonksiyonlari KODLARI*/
  $("#frmOkcFonksiyonlari").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("#frmOkcFonksiyonlari").serializeJSON();
    var json = JSON.stringify(formVerileri);


    var messageJSON = {
      urun_adi: ""+formVerileri["txtOkcFonksiyonAdi"]+"",
      urun_teslim_durumu_idsi: "teslimDurumuIdsi",
      mutfak_adi: "mutfakAdi",
      masa_adi: "masaAdi",
      fonksiyon_adi: ""+formVerileri["txtOkcFonksiyonAdi"]+"",
      fonksiyon_parametreleri: json
    };

    websocket.send(JSON.stringify(messageJSON));

  })
  /*modalOkcFonksiyonlari KODLARI*/


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
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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

  /*YENİ SATIŞ AÇMA KODLARI*/
  $(".btnYeniSatis").on("click",function () {
    $("#txtAdisyonIdsi").val("");
    $(".tblSiparisUrunleri tbody").html("");
    $(".trParaUstu").removeClass("d-none");
    $(".trOdendi").addClass("d-none");
    $(".rowUrunler").toggleClass("d-none");
    $(".rowOdeme").toggleClass("d-none");
    $("#spanAdisyonTutari").html("0.00");
    $("#tdIndirimHucresi h5").html("0.00");
    $("#spanAdisyonOdenmisMiktar").html("0.00");
    $("#spanAdisyonKalanMiktar").html("0.00");
    $("#spanMusteriAdiSoyadi").html("");
  })
  /*YENİ SATIŞ AÇMA KODLARI*/

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
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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

  /*ÜRÜN TESLİM EDİLDİ KODLARI*/
  $(".btnTeslimEdildi").on("click",function () {
    var kontrol = seciliSatirKontrol();
    if (kontrol) {

      var teslimEdildiIsaretlenecekUrunIdleri = new Array();
      $(".tblSiparisUrunleri tr.clicked").each(function () {
        var teslimEdildiIsaretlenecekUrunIdsi = $(this).attr("adisyon-urun-idsi");
        var json = {"txtAdisyonUrunuIdsi":teslimEdildiIsaretlenecekUrunIdsi};
        teslimEdildiIsaretlenecekUrunIdleri.push(json);
      })
    }
    json = JSON.stringify(teslimEdildiIsaretlenecekUrunIdleri);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/urun-teslim-edildi",
      data: {urunTeslimEdildi:json},
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
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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
  /*ÜRÜN TESLİM EDİLDİ KODLARI*/

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
            bilgileriGuncelleHizliSatis(adisyonIdsi);
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
            bilgileriGuncelleHizliSatis(adisyonIdsi);
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
            var adisyonIdsi = $("#txtAdisyonIdsi").val();
            var silinecekAdisyonUrunIdleri = new Array();
            $(".tblSiparisUrunleri tbody tr").each(function () {
              var silinecekAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
              var silinecekUrunIdsi = $(this).attr("id");
              var masaIdsi = "HS";
              var json = {"txtUrunIdsi":silinecekUrunIdsi,"txtAdisyonUrunuIdsi":silinecekAdisyonUrunuIdsi,"txtAdisyonIdsi":adisyonIdsi,"txtMasaKapansinMi":masaKapansinMi,"txtMasaIdsi":masaIdsi};
              silinecekAdisyonUrunIdleri.push(json);
            })
            json = JSON.stringify(silinecekAdisyonUrunIdleri);
            adisyonUrunleriniSil(json);
            location.reload();
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
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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

  /*ADİSYON İNDİRİM YAP, DEĞİŞTİR KODLARI*/
  $("#frmIndirimYap").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmIndirimYap").serializeJSON();
    formVerileri["txtAdisyonIdsi"] = $("#txtAdisyonIdsi").val();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/adisyon-indirim-degistir",
      data: {adisyonIndirimDegistir:json},
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
          $("#modalIndirimYap").modal("hide");
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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
  /*ADİSYON İNDİRİM YAP, DEĞİŞTİR KODLARI*/


  /*SATIR, ÜRÜN SEÇME KODLARI*/
  $(document).on("click",".tblSiparisUrunleri tr",function () {
    if ($(this).hasClass("odendi") || $(this).hasClass("ikram") || $(this).hasClass("iptal")) {
      return false;
    }
    var seciliUrunAdedi = $(this).find(".spanSeciliUrunAdedi").html().replace('(', '');
    seciliUrunAdedi = seciliUrunAdedi.replace(')', '');
    var tiklamaSayisi = parseFloat(seciliUrunAdedi);
    tiklamaSayisi++;

    var urunAdedi = $(this).closest("tr").find(".spanUrunAdedi").html();
    $(this).addClass("clicked");
    $(this).closest("tr").find(".spanSeciliUrunAdedi").html("("+tiklamaSayisi+")");

    if (tiklamaSayisi > urunAdedi) {
      $(this).removeClass("clicked");
      $(this).closest("tr").find(".spanSeciliUrunAdedi").html("(0)");
      tiklamaSayisi = 0;
    }

    var seciliSatirSayisi = $(".tblSiparisUrunleri tr.clicked").length;
    var adisyonKalanTutar = parseFloat($("#spanAdisyonKalanMiktar").html());

    if (seciliSatirSayisi > 0) {
      var seciliUrunlerinToplamTutari = 0;
      $(".tblSiparisUrunleri tr.clicked").each(function () {
        var seciliUrunAdedi = $(this).find(".spanSeciliUrunAdedi").html().replace('(', '');
        seciliUrunAdedi = seciliUrunAdedi.replace(')', '');
        var urunToplamTutari = parseFloat($(this).find(".spanUrunToplamFiyati").html());
        var urunToplamAdedi = parseFloat($(this).find(".spanUrunAdedi").html());
        var urunBirimFiyati = urunToplamTutari / urunToplamAdedi;

        seciliUrunlerinToplamTutari += urunBirimFiyati * parseFloat(seciliUrunAdedi);

      });
      if (parseFloat(seciliUrunlerinToplamTutari) > parseFloat(adisyonKalanTutar)) {
        $("#spanToplam").html(adisyonKalanTutar.toFixed(2));
      }else {
        $("#spanToplam").html(seciliUrunlerinToplamTutari.toFixed(2));
      }
    }else {
      $("#spanToplam").html(adisyonKalanTutar.toFixed(2));
    }
    paraUstunuHesapla();
  })
  /*SATIR, ÜRÜN SEÇME KODLARI*/

  /*TOPLAM TUTARI N KİŞİYE BÖLME KODLARI*/
  $("#frmBirBoluN").on("submit",function (e) {
    e.preventDefault();
    var n = $("#txtBirBoluN").val();
    var spanToplam = parseFloat($("#spanToplam").html());
    var spanTahsilEdilen = $("#spanTahsilEdilen");
    spanTahsilEdilen.html((spanToplam / n).toFixed(2));
    paraUstunuHesapla();
    $("#modalBirBoluN").modal("hide");

  })
  /*TOPLAM TUTARI N KİŞİYE BÖLME KODLARI*/

  /*TUŞ TAKIMI, TAHSİLAT MİKTARI GİRME KODLARI*/
  $(".btnNumerik").on("click",function () {
    var spanToplam = parseFloat($("#spanToplam").html());
    if (isNaN(spanToplam)) {
      return false;
    }

    var spanTahsilEdilen = $("#spanTahsilEdilen");
    if (spanTahsilEdilen.html().length > 4) {
      return false;
    }
    var mevcutYaziliOlan = parseFloat($("#spanTahsilEdilen").html());
    var tiklananRakam = parseFloat($(this).html());
    if (mevcutYaziliOlan == 0) {
      spanTahsilEdilen.html(tiklananRakam);
    }else {
      var yazilacakSayi = $("#spanTahsilEdilen").html() + $(this).html();
      spanTahsilEdilen.html(yazilacakSayi);
    }
    paraUstunuHesapla();
  })

  $(".btnKalipSayi").on("click",function () {
    var spanTahsilEdilen = $("#spanTahsilEdilen");
    var spanToplam = parseFloat($("#spanToplam").html());
    if (isNaN(spanToplam)) {
      return false;
    }
    var tiklananRakam = parseFloat($(this).html());
    spanTahsilEdilen.html(tiklananRakam.toFixed(2));
    paraUstunuHesapla();
  })

  $(".btnTumu").on("click",function () {
    var spanToplam = parseFloat($("#spanToplam").html());
    if (isNaN(spanToplam)) {
      return false;
    }
    spanToplam = parseFloat(spanToplam);
    var spanTahsilEdilen = $("#spanTahsilEdilen");
    spanTahsilEdilen.html(spanToplam.toFixed(2));
    paraUstunuHesapla();
  })

  $(".btnYarisi").on("click",function () {
    var spanToplam = parseFloat($("#spanToplam").html());
    if (isNaN(spanToplam)) {
      return false;
    }
    var spanTahsilEdilen = $("#spanTahsilEdilen");
    spanTahsilEdilen.html((spanToplam / 2).toFixed(2));
    paraUstunuHesapla();
  })

  $(".btnUcteBiri").on("click",function () {

    var spanToplam = parseFloat($("#spanToplam").html());
    if (isNaN(spanToplam)) {
      return false;
    }
    var spanTahsilEdilen = $("#spanTahsilEdilen");
    spanTahsilEdilen.html((spanToplam / 3).toFixed(2));
    paraUstunuHesapla();
  })

  $(".btnTahsilEdileniTemizle").on("click",function () {
    var spanToplam = parseFloat($("#spanToplam").html());
    if (isNaN(spanToplam)) {
      return false;
    }
    $("#spanTahsilEdilen").html("0.00");
    paraUstunuHesapla();
  })
  /*TUŞ TAKIMI, TAHSİLAT MİKTARI GİRME KODLARI*/

  /*MASAYA SİPARİŞ ÜRÜN EKLE GİR KODLARI*/
  $(document).on("click",".btnUrunAdi",function () {
    var urunIdsi = $(this).attr("id");
    var urunAdedi = $("#txtUrunAdedi").val();
    var urunGrami = $("#txtUrunGrami").val();
    var txtHizliSatis = 1;
    var masaIdsi = "HS";
    if (!urunGrami) {
      urunGrami = null;
    }
    if (!urunAdedi) {
      urunAdedi = 1;
    }
    var adisyonIdsi = $("#txtAdisyonIdsi").val();
    var json = {
      "txtUrunIdsi":urunIdsi,
      "txtUrunAdedi":urunAdedi,
      "txtUrunGrami":urunGrami,
      "txtHizliSatis":txtHizliSatis,
      "txtMasaIdsi":masaIdsi,
      "txtAdisyonIdsi":adisyonIdsi
    };
    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masaya-urun-ekle",
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
          // 		from: "bottom",
          // 		align: "left"
          // 	}
          // });
          $("#txtAdisyonIdsi").val(donut.adisyonIdsi);
          $("#txtUrunAdedi").val("");
          $("#txtUrunGrami").val("");
          $(".klavye-wrapper").addClass("d-none");
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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
    var urunGrami = $("#txtUrunGrami").val();
    var masaIdsi = "HS";
    if (!urunGrami) {
      urunGrami = null;
    }
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

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masaya-urun-ekle",
      data: {masayaAltUrunEkle:json},
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
          // 		from: "bottom",
          // 		align: "left"
          // 	}
          // });
          $("#txtAdisyonIdsi").val(donut.adisyonIdsi);
          $("#txtUrunAdedi").val("");
          $("#txtUrunGrami").val("");
          $(".klavye").trigger("click");
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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
    var urunGrami = $("#txtUrunGrami").val();
    var masaIdsi = "HS";

    if (urunGrami) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Menü ürünlerinde gramaj satış yapılamaz. Lütfen gram kısmını boş bırakınız!"
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

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/masaya-urun-ekle",
      data: {masayaMenuEkle:json},
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
          // 		from: "bottom",
          // 		align: "left"
          // 	}
          // });
          $("#txtAdisyonIdsi").val(donut.adisyonIdsi);
          $("#txtUrunAdedi").val("");
          $("#txtUrunGrami").val("");
          $(".klavye").trigger("click");
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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


  /*BTN KAPAT KODLARI*/
  $(".btnKapat").on("click",function (e) {
    e.preventDefault();
    var satirSayisi = $(".tblSiparisUrunleri  tbody tr").length;
    if (satirSayisi > 0) {
      if ($("#txtAdisyonOdemeDurumu").val() == 0) {
        onayla("Adisyonun ödemesi alınmadan kapatırsanız satış gerçekleşmez. Yine de devam etmek istiyor musunuz?",function callBack(onay) {
          if (onay == true) {
            var masaKapansinMi = 1;
            var adisyonIdsi = $("#txtAdisyonIdsi").val();
            var silinecekAdisyonUrunIdleri = new Array();
            $(".tblSiparisUrunleri tbody tr").each(function () {
              var silinecekAdisyonUrunuIdsi = $(this).attr("adisyon-urun-idsi");
              var silinecekUrunIdsi = $(this).attr("id");
              var masaIdsi = "HS";
              var json = {"txtUrunIdsi":silinecekUrunIdsi,"txtAdisyonUrunuIdsi":silinecekAdisyonUrunuIdsi,"txtAdisyonIdsi":adisyonIdsi,"txtMasaKapansinMi":masaKapansinMi,"txtMasaIdsi":masaIdsi};
              silinecekAdisyonUrunIdleri.push(json);
            })
            json = JSON.stringify(silinecekAdisyonUrunIdleri);
            adisyonUrunleriniSil(json);
            location.reload();
          }
        });
      }else {
        window.location.href = ""+yolHtml+"restoran/masalar";
      }
    }else {
      window.location.href = ""+yolHtml+"restoran/masalar";
    }


  })
  /*BTN KAPAT KODLARI*/

  /*BTN ÖDEME KODLARI*/
  $(".btnOdeme").on("click",function () {
    $(".rowUrunler").toggleClass("d-none");
    $(".rowOdeme").toggleClass("d-none");
  })
  /*BTN ÖDEME KODLARI*/

  /*ÖDEME GERİ ALMA KODLARI*/
  $("#frmOdemeGeriAl").on("submit",function (e) {
    var tiklananButon = $(document.activeElement);
    e.preventDefault();
    var odemeIdsi = tiklananButon.attr("odeme-id");
    var adisyonIdsi = $("#txtAdisyonIdsi").val();
    var json = {
      "txtOdemeIdsi":odemeIdsi,
      "txtAdisyonIdsi":adisyonIdsi
    };
    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/odemeyi-sil",
      data: {odemeyiSil:json},
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
          $("#modalGecmisOdemeler").modal("hide");
          bilgileriGuncelleHizliSatis();
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

  $(".btnOdemeGeriAl").on("click",function () {
    var adisyonIdsi = $("#txtAdisyonIdsi").val();

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/gecmis-odemeleri-al",
      data: {gecmisOdemeleriAl:adisyonIdsi},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.gecmisOdemeler) {

          $(".tblGecmisOdemeler tbody").html("");
          for (var i = 0; i < donut.gecmisOdemeler.length; i++) {
            var eklenecekHtml = "<tr id='"+donut.gecmisOdemeler[i]["id"]+"' >";
            eklenecekHtml += "<td>"+donut.gecmisOdemeler[i]["adisyon_odemesi_odeme_miktari"]+"</td>";
            eklenecekHtml += "<td>"+donut.gecmisOdemeler[i]["odeme_metod_adi"]+"</td>";
            eklenecekHtml += "<td>"+donut.gecmisOdemeler[i]["adisyon_odemesi_odeme_tarihi"]+"</td>";
            eklenecekHtml += "<td><button odeme-id='"+donut.gecmisOdemeler[i]["id"]+"' class='btn btn-sm bg-red' type='submit'><span class='zmdi zmdi-rotate-left'></span></button></td>";
            eklenecekHtml += "</tr>";
            $(".tblGecmisOdemeler tbody").append(eklenecekHtml);
          }
          $("#modalGecmisOdemeler").modal("show");
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
  /*ÖDEME GERİ ALMA KODLARI*/

  /*ÖDEME ALMA KODLARI*/

  /*ÖDEME ALMA KODLARI*/
  var sure = 0;
  var urunOkcBilgileri = "";
  $(document).on("click",".btnOdemeMetodlari",function () {
    var odemeMetodIdsi = $(this).attr("data-id");
    var odemeMetodIndexi = $(this).attr("index");

    var spanTahsilEdilen = parseFloat($("#spanTahsilEdilen").html());
    var spanToplam = parseFloat($("#spanToplam").html());
    var odenecekTutar = 0;
    if (spanTahsilEdilen > spanToplam) {
      odenecekTutar = spanToplam;
    }else {
      odenecekTutar = spanTahsilEdilen;
    }

    var txtTiklananAdisyonUrunleriIdleri = new Array();
    var toplamTutar = 0;

    var index = 0;

    if (odenecekTutar == 0) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen ödenecek tutarı belirtiniz!"
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

    if ($("#txtOkcAktifMi").val() == 1) {
      var messageJSON = {
        urun_adi: "durumSorgula",
        urun_teslim_durumu_idsi: "teslimDurumuIdsi",
        mutfak_adi: "mutfakAdi",
        masa_adi: "masaAdi",
        fonksiyon_adi: "durumSorgula",
        fonksiyon_parametreleri: "{}"
      };
      websocket.send(JSON.stringify(messageJSON));
      sure = 1000;
    }else {
      sure = 0;
    }


    setTimeout(function() {



      $(".tblSiparisUrunleri tbody tr.clicked").each(function () {
        index = index+1;

        var donguSayisi = $(".tblSiparisUrunleri tbody tr.clicked").length;

        var adisyonUrunIdsi = $(this).attr("adisyon-urun-idsi");
        var urunIdsi = $(this).attr("id");

        var odenecekUrunAdedi = $(this).find(".spanSeciliUrunAdedi").html().replace('(', '');
        odenecekUrunAdedi = odenecekUrunAdedi.replace(')', '');

        var urunTabloAdi = $(this).attr("tbl");

        var json = {"txtUrunIdsi":urunIdsi,"txtUrunTabloAdi":urunTabloAdi,"txtAdisyonUrunuIdsi":adisyonUrunIdsi,"txtOdenecekUrunAdedi":odenecekUrunAdedi};

        txtTiklananAdisyonUrunleriIdleri.push(json);

        if ($("#txtOkcAktifMi").val() == 1) {
          if (cihazDurumu != 0) {

            json = JSON.stringify(json);
            jQuery.ajax({
              type: "POST",
              url: ""+yolHtml+"urun/urun-okc-bilgilerini-al/",
              data: {urunOkcBilgileriniAl:json},
              async: false,
              cache: false,
              error:function(err){
                alert(err.responseText);
              },
              success: function(response)
              {
                var donut = $.parseJSON(response);
                if (donut.urunOkcBilgileri) {
                  var json = {
                    "txtUrunKaydedilecekMi":donut.urunOkcBilgileri["txtUrunKaydedilecekMi"],
                    "txtUrunAdi":donut.urunOkcBilgileri["urun_adi"],
                    "txtUrunAdedi":donut.urunOkcBilgileri["adisyon_urunleri_urun_adedi"],
                    "txtUrunFiyati":donut.urunOkcBilgileri["urun_satis_fiyati"],
                    "txtIndirimTuru":donut.urunOkcBilgileri["adisyon_indirim_turu"],
                    "txtIndirimMiktari":donut.urunOkcBilgileri["adisyon_indirim_miktari"],
                    "txtUrunBarkodu":donut.urunOkcBilgileri["urun_barkodu"],
                    "txtDepartmanNumarasi":1,
                    "txtPluNo":donut.urunOkcBilgileri["urun_idsi"]
                  };

                  json["txtToplamTutar"] = spanTahsilEdilen;
                  json["txtOdemeTuru"] = odemeMetodIdsi;
                  json["txtOdemeIndex"] = odemeMetodIndexi;
                  json["txtSlipKopya"] = false;
                  urunOkcBilgileri = JSON.stringify(json);

                  if (cihazDurumu != 4) {
                    var messageJSON = {
                      urun_adi: "satisiGerceklestir",
                      urun_teslim_durumu_idsi: "teslimDurumuIdsi",
                      mutfak_adi: "mutfakAdi",
                      masa_adi: "masaAdi",
                      fonksiyon_adi: "satisiGerceklestir",
                      fonksiyon_parametreleri: urunOkcBilgileri
                    };
                    websocket.send(JSON.stringify(messageJSON));
                  }


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
          }

        }
      })

      if ( $("#txtOkcAktifMi").val() == 1) {
        if (cihazDurumu != 0) {
          if (odemeMetodIdsi == "kart") {
            var messageJSON = {
              urun_adi: "odemeyiKartIleAl",
              urun_teslim_durumu_idsi: "teslimDurumuIdsi",
              mutfak_adi: "mutfakAdi",
              masa_adi: "masaAdi",
              fonksiyon_adi: "odemeyiKartIleAl",
              fonksiyon_parametreleri: urunOkcBilgileri
            };
            websocket.send(JSON.stringify(messageJSON));
          }else {
            var messageJSON = {
              urun_adi: "odemeyiAl",
              urun_teslim_durumu_idsi: "teslimDurumuIdsi",
              mutfak_adi: "mutfakAdi",
              masa_adi: "masaAdi",
              fonksiyon_adi: "odemeyiAl",
              fonksiyon_parametreleri: urunOkcBilgileri
            };
            websocket.send(JSON.stringify(messageJSON));
          }

        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "ÖKC ödeme almak için hazır değil. Lütfen cihaz bağlantılarını kontrol ediniz!"
          },{
            // settings
            type: 'danger'
          });
          return false;
        }
      }




      var adisyonIdsi = $("#txtAdisyonIdsi").val();
      var json = {"txtOdenecekTutar":odenecekTutar,"txtOdemeMetodIdsi":odemeMetodIdsi,"txtAdisyonIdsi":adisyonIdsi,"txtTiklananAdisyonUrunleriIdleri":txtTiklananAdisyonUrunleriIdleri};
      json = JSON.stringify(json);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"restoran/adisyon-odeme-al",
        data: {adisyonOdemeAl:json},
        cache: false,
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit["yanit"] == true) {
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
            $("#spanTahsilEdilen").html("0.00");
            $("#spanParaUstu").html("0.00");
            bilgileriGuncelleHizliSatis(adisyonIdsi);
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


    }, sure);




  })
  /*ÖDEME ALMA KODLARI*/

  // $(".btnOdemeMetodlari").on("click",function () {
  //   var spanTahsilEdilen = parseFloat($("#spanTahsilEdilen").html());
  //   var spanToplam = parseFloat($("#spanToplam").html());
  //   var odenecekTutar = 0;
  //   if (spanTahsilEdilen > spanToplam) {
  //     odenecekTutar = spanToplam;
  //   }else {
  //     odenecekTutar = spanTahsilEdilen;
  //   }
  //   if (odenecekTutar == 0) {
  //     $.notify({
  //       // options
  //       icon: 'fa fa-danger fa-2x',
  //       message: "Lütfen ödenecek tutarı belirtiniz!"
  //     },{
  //       // settings
  //       type: 'danger',
  //       z_index:7777
  //     });
  //     return false;
  //   }
  //   var odemeMetodIdsi = $(this).attr("data-id");
  //   var adisyonIdsi = $("#txtAdisyonIdsi").val();
  //   var json = {"txtOdenecekTutar":odenecekTutar,"txtOdemeMetodIdsi":odemeMetodIdsi,"txtAdisyonIdsi":adisyonIdsi};
  //   json = JSON.stringify(json);
  //
  //   jQuery.ajax({
  //     type: "POST",
  //     url: ""+yolHtml+"restoran/adisyon-odeme-al",
  //     data: {adisyonOdemeAl:json},
  //     cache: false,
  //     success: function(response)
  //     {
  //       var donut = $.parseJSON(response);
  //       if (donut.yanit["yanit"] == true) {
  //         $.notify({
  //           // options
  //           icon: 'fa fa-danger fa-2x',
  //           message: "İşlem başarılı"
  //         },{
  //           // settings
  //           type: 'success',
  //           z_index:7777
  //         });
  //         bilgileriGuncelleHizliSatis(adisyonIdsi);
  //         location.reload();
  //       }else {
  //         $.notify({
  //           // options
  //           icon: 'fa fa-danger fa-2x',
  //           message: donut.yanit
  //         },{
  //           // settings
  //           type: 'danger',
  //           z_index:7777
  //         });
  //       }
  //     }
  //   });
  // })
  /*ÖDEME ALMA KODLARI*/

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
          bilgileriGuncelleHizliSatis(adisyonIdsi);
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
  var masaIdsi = "HS";
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"restoran/urun-sil/"+masaIdsi+"",
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
        bilgileriGuncelleHizliSatis(adisyonIdsi);
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
function bilgileriGuncelleHizliSatis() {
  var masaIdsi = "HS";
  var seciliYaziciIdsi = $(".txtYaziciIdsi").find("option:selected").val();
  var json = {"txtMasaIdsi":masaIdsi,"txtYaziciIdsi":seciliYaziciIdsi};
  json = JSON.stringify(json);
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"restoran/bilgileri-guncelle-hizli-satis/",
    data: {bilgileriGuncelleHizliSatis:json},
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
        $("#txtAdisyonOdemeDurumu").val(donut.adisyonBilgileri[0]["adisyon_odeme_durumu"]);

        $("#txtIndirimTuru").attr("data-id",donut.adisyonBilgileri[0]["adisyon_indirim_turu"]);
        $("#txtIndirimMiktari").val(donut.adisyonBilgileri[0]["adisyon_indirim_miktari"]);
        $("#spanAdisyonIndirimMiktari").html(donut.adisyonBilgileri[0]["adisyon_indirim_miktari"]);


        if (donut.adisyonBilgileri[0]["adisyon_kalan_tutar"] < 0) {
          donut.adisyonBilgileri[0]["adisyon_kalan_tutar"] = 0;
        }
        $("#spanAdisyonKalanMiktar").html(donut.adisyonBilgileri[0]["adisyon_kalan_tutar"].toFixed(2));
        $("#spanToplam").html(donut.adisyonBilgileri[0]["adisyon_kalan_tutar"].toFixed(2));
        $(".spanKurIsareti").html(donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]);

        if (donut.adisyonBilgileri[0]["adisyon_odeme_durumu"] == 1) {
          $(".trParaUstu").addClass("d-none");
          $(".trOdendi").removeClass("d-none");
        }else {
          $(".trParaUstu").removeClass("d-none");
          $(".trOdendi").addClass("d-none");
        }

        $(".tblSiparisUrunleri tbody").html("");

        for (var i = 0; i < donut.adisyonUrunleri.length; i++) {

          switch (donut.adisyonUrunleri[i]["adisyon_urunleri_urun_teslim_durumu_idsi"]) {
            case '0':
              var teslimDurumu = '<span class="badge badge-warning">Hazırlanıyor</span>';
              break;
            case '1':
              var teslimDurumu = '<span class="badge badge-danger">Hazır</span>';
              break;
            case '2':
              var teslimDurumu = '<span class="badge badge-success">Teslim Edildi</span>';
              break;
            default:

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
          eklenecekHtml += "<td><span class='spanUrunAdedi'>"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_adedi"]+"</span> <span class='spanSeciliUrunAdedi'>("+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_odenmis_urun_adedi"]+")</span></td>";


          if (donut.adisyonUrunleri[i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_urunler") {
            eklenecekHtml += "<td><strong>"+donut.adisyonUrunleri[i]["urun_adi"]+"</strong></td>";
          }else if (donut.adisyonUrunleri[i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_menuler") {
            eklenecekHtml += "<td><strong>"+donut.adisyonUrunleri[i]["menu_adi"]+" <button class='btn btn-xs float-right btn-default btnMenuIceriginiGoster'><span class='zmdi zmdi-eye' ></span></button> </strong></td>";
          }else {
            eklenecekHtml += "<td><strong>"+donut.adisyonUrunleri[i]["alt_urun_adi"]+"</strong></td>";
          }


          eklenecekHtml += "<td>"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_notu"]+"</td>";
          eklenecekHtml += "<td><span class='spanUrunToplamFiyati'>"+donut.adisyonUrunleri[i]["adisyon_urunleri_urun_toplam_fiyati"]+"</span> "+donut.adisyonBilgileri[0]["varsayilan_kur_isareti"]+"</td><td>"+teslimDurumu+"</td>";
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

/*PARA ÜSTÜNÜ HESAPLAMA KODLARI*/
function paraUstunuHesapla() {
  var spanTahsilEdilen = parseFloat($("#spanTahsilEdilen").html());
  var spanToplam = parseFloat($("#spanToplam").html());
  var paraUstu = spanTahsilEdilen - spanToplam;
  if (paraUstu < 0) {
    paraUstu = 0;
  }
  $("#spanParaUstu").html(paraUstu.toFixed(2));
}
/*PARA ÜSTÜNÜ HESAPLAMA KODLARI*/


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
