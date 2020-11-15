
$(document).ready(function () {
  $("#frmSatisFaturasiEkle").on("submit",function (e) {
    e.preventDefault();
    var izin = true;

    var formVerileri = $("form#frmSatisFaturasiEkle").serializeJSON();
    formVerileri["txtSatisFaturasiCariIdsi"] = $("#txtSatisFaturasiCariIdsi").attr("data-id");

    console.log(formVerileri["txtSatisFaturasiCariIdsi"]);
    if (!formVerileri["txtSatisFaturasiCariIdsi"]) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Cari hesap bulunamadı. Lütfen arama sonucunda çıkan hesaplardan seçiniz!"
      },{
        // settings
        type: 'danger',
        z_index:7777
      });
      izin = false;
      return false;
    }


    var satisFaturasiUrunleri = new Array();
    $("table tbody tr.trUrunler").each(function () {
      var urunId = $(this).find(".txtSatisFaturasiUrunleriUrunAdi").attr("data-id");
      if (urunId == null || urunId == "") {
        $.notify({
          // options
          icon: 'fa fa-danger fa-2x',
          message: "Ürün bulunamadı. Lütfen arama sonucunda çıkan ürünlerden ürün seçiniz!"
        },{
          // settings
          type: 'danger',
          z_index:7777
        });
        izin = false;
        return false;
      }
      var urunAdi = $(this).find(".txtSatisFaturasiUrunleriUrunAdi").val();
      var urunAdedi = $(this).find(".txtSatisFaturasiUrunleriUrunAdedi").val();
      var urunBirimIdsi = $(this).find(".txtSatisFaturasiUrunleriUrunBirimIdsi").find("option:selected").val();
      var urunBirimAdi = $(this).find(".txtSatisFaturasiUrunleriUrunBirimIdsi").find("option:selected").html();
      var urunVergiIdsi = $(this).find(".txtSatisFaturasiUrunleriUrunVergiIdsi").find("option:selected").val();
      if (urunVergiIdsi == null || urunVergiIdsi == "") {
        $.notify({
          // options
          icon: 'fa fa-danger fa-2x',
          message: "Lütfen vergi tipi seçiniz!"
        },{
          // settings
          type: 'danger',
          z_index:7777
        });
        izin = false;
        return false;
      }
      var urunVergiMiktari = $(this).find(".txtSatisFaturasiUrunleriUrunTutari").attr("vergi-miktari");
      var urunBirimTutari = $(this).find(".txtSatisFaturasiUrunleriUrunBirimFiyati").val();
      var urunTutari = $(this).find(".txtSatisFaturasiUrunleriUrunTutari").val();
      var json = {
        "txtUrunIdsi":urunId,
        "txtUrunAdi":urunAdi,
        "txtUrunAdedi":urunAdedi,
        "txtUrunBirimIdsi":urunBirimIdsi,
        "txtUrunBirimAdi":urunBirimAdi,
        "txtUrunVergiIdsi":urunVergiIdsi,
        "txtUrunVergiMiktari":urunVergiMiktari,
        "txtUrunBirimTutari":urunBirimTutari,
        "txtUrunTutari":urunTutari
      }
      satisFaturasiUrunleri.push(json);
    })

    if (izin) {
      formVerileri["txtSatisFaturasiUrunleri"] = satisFaturasiUrunleri;

      formVerileri["txtSatisFaturasiAraToplami"] = $("#spanAraToplam").html();
      formVerileri["txtSatisFaturasiVergiMiktari"] = faturaBilgileriniGuncelle();
      formVerileri["txtSatisFaturasiTutari"] = $("#spanFaturaToplami").html();;


      var json = JSON.stringify(formVerileri);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"fatura/satis-faturasi-ekle",
        data: {satisFaturasiEkle:json},
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
          var donut = $.parseJSON(response);
          if (donut.yanit["yanit"] == true) {
            $.notify({
              // options
              icon: 'fa fa-warning fa-2x',
              message: "Başarılı bir şekilde kaydedildi"
            },{
              // settings
              type: 'success'
            });
            $("form#frmSatisFaturasiEkle input").val("");
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

  $(document).on("input",".faturaVerileriniGuncelle",function () {
    faturaBilgileriniGuncelle();
  })

  $(".btnSatisFaturasiUrunEkle").on("click",function () {
    var eklenecekHtml = $("table tbody tr:first").html();
    var satirSayisi = $("table tbody tr").length+1;
    eklenecekHtml = eklenecekHtml.replace(/urunler1/g, "urunler"+satirSayisi+"");

    $("table tbody tr:last").before("<tr class='trUrunler'>"+eklenecekHtml+"</tr>");
    faturaBilgileriniGuncelle();
  })
  $(document).on("click",".btnSatisFaturasiUrunSil",function () {
    var satirSayisi = $("table tbody tr").length;

    if (satirSayisi < 3) {

    }else {
      $(this).closest("tr").remove();
    }
    faturaBilgileriniGuncelle();
  })

  $(document).on("input",".txtSatisFaturasiUrunleriUrunAdi",function () {

    var input = $(this);
    var val = input.val();
    var urunId = $(this).closest("td").find("datalist option[value='"+val+"']").attr("data-id");
    $(this).attr("data-id",urunId);
    $(".ulSatisFaturasiUrunleriUrunIsimleri option").trigger("click");
    var suggestionMenu = input.closest("td").find("datalist");
    var girilenDeger = input.val();
    if (girilenDeger.length > 2) {

      var dataKolonIndex = input.attr("data-kolon-index");
      var dataTabloIndex = input.attr("data-tablo-index");
      var json = {"girilenDeger":girilenDeger,"dataKolonIndex":dataKolonIndex,"dataTabloIndex":dataTabloIndex};
      json = JSON.stringify(json);

      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"masa/datasearch",
        data: {dataSearch:json},
        cache: false,
        error:function(err){
          alert(err.responseText);
        },
        success: function(response)
        {
          // $(".btnLoading").html("KAYDET");
          var donut = $.parseJSON(response);
          suggestionMenu.html("");
          var eklenecekSatir = "";
          if (donut.sonuclar != null) {
            for (var i = 0; i < donut.sonuclar.length; i++) {
              eklenecekSatir = eklenecekSatir+"<option data-id='"+donut.sonuclar[i]["id"]+"' value='"+donut.sonuclar[i][donut.kolonAdi]+"' >"+donut.sonuclar[i][donut.kolonAdi]+"</option>";
            }
            suggestionMenu.html(eklenecekSatir);
            // suggestionMenu.css("display","block");
          }else {
            // suggestionMenu.css("display","none");
          }
        }
      });
    }else {
      suggestionMenu.html("");
      suggestionMenu.css("display","none");
    }
  })

  $(document).on("click",".ulSatisFaturasiUrunleriUrunIsimleri option",function () {
    var satir = $(this).closest("tr");
    var urunId = satir.find(".txtSatisFaturasiUrunleriUrunAdi").attr("data-id");

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"fatura/fatura-urun-bilgilerini-al/",
      data: {faturaUrunBilgileriniAl:urunId},
      cache: false,
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        if (response) {
          var donut = $.parseJSON(response);

          if (donut.urunBilgileri) {
            var urunAdedi = satir.find(".txtSatisFaturasiUrunleriUrunAdedi").val();
            var urunTutari = donut.urunBilgileri["urun_satis_fiyati"] * urunAdedi
            satir.find(".txtSatisFaturasiUrunleriUrunBirimIdsi").attr("data-id",donut.urunBilgileri["urun_birim_idsi"]);
            satir.find(".txtSatisFaturasiUrunleriUrunBirimFiyati").val(donut.urunBilgileri["urun_satis_fiyati"]);
            satir.find(".txtSatisFaturasiUrunleriUrunTutari").val(urunTutari.toFixed(2));
            changeSelects();
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

      }
    });
  })
})


function faturaBilgileriniGuncelle() {
  var genelVergiToplami = 0;

  var urunVergiAdlari = new Array();
  var urunVergiBilgileri = new Array();

  $("table tbody tr.trUrunler").each(function () {
    var urunAdedi = $(this).find(".txtSatisFaturasiUrunleriUrunAdedi").val();
    var urunBirimFiyati = $(this).find(".txtSatisFaturasiUrunleriUrunBirimFiyati").val();
    var urunSatirToplami = parseFloat(urunAdedi) * parseFloat(urunBirimFiyati);
    var urunVergiOrani = $(this).find(".txtSatisFaturasiUrunleriUrunVergiIdsi").find("option:selected").attr("tax-value");
    var urunVergiAdi = $(this).find(".txtSatisFaturasiUrunleriUrunVergiIdsi").find("option:selected").html();
    var urunVergiMiktari = (parseFloat(urunSatirToplami) * parseFloat(urunVergiOrani)) / 100;
    urunVergiAdlari.push(urunVergiAdi);
    var json = {};
    json[urunVergiAdi] = urunVergiMiktari;
    urunVergiBilgileri.push(json);
    $(this).find(".txtSatisFaturasiUrunleriUrunTutari").val(urunSatirToplami.toFixed(2));
    $(this).find(".txtSatisFaturasiUrunleriUrunTutari").attr("vergi-miktari",urunVergiMiktari);
  });

  var araToplam = 0;
  var genelToplam = 0;
  $(".txtSatisFaturasiUrunleriUrunTutari").each(function () {
    araToplam = parseFloat(araToplam) + parseFloat($(this).val());
    $("#spanAraToplam").html(araToplam.toFixed(2));
  })
  var iskontoOrani = $("#txtSatisFaturasiIskonto").val();
  var iskontoMiktari = (parseFloat(araToplam) * parseFloat(iskontoOrani)) / 100;
  genelToplam = parseFloat(araToplam) - parseFloat(iskontoMiktari);
  $("#spanFaturaToplami").html(genelToplam.toFixed(2));


  urunUniqueVergiAdlari = $.unique(urunVergiAdlari);
  var vergiHtml = "";

  for (var i = 0; i < urunUniqueVergiAdlari.length; i++) {
    var vergiToplami = 0;

    for (var a = 0; a < urunVergiBilgileri.length; a++) {
      for (var key in urunVergiBilgileri[a]) {
        //alert(key + ":" + obj[key]);
        if (key == urunUniqueVergiAdlari[i]) {
          vergiToplami += parseFloat(urunVergiBilgileri[a][key]);
          genelVergiToplami += parseFloat(urunVergiBilgileri[a][key]);

        }
      }
    }

    vergiHtml += "<p class='m-b-0 p-3'><b>"+urunUniqueVergiAdlari[i]+":</b> "+vergiToplami+" <span class='spanKurIsareti'></span></p>";
  }

  $("#vergiGruplari").html(vergiHtml);
  var kurIsareti = $("#txtSatisFaturasiKurIdsi").find("option:selected").attr("data-currency-symbol");
  $(".spanKurIsareti").html(kurIsareti);
  return genelVergiToplami;
}
