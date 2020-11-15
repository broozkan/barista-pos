$(document).ready(function () {

  /*lock session sorgulama kodları*/
  lockSessionSorgula();
  /*lock session sorgulama kodları*/

  /*kilit ekranı tuş vs. kodları*/
  $(".btnTusTakimiLock").on("click",function () {
    var mevcutDeger = $(".txtPin").val();
    if (mevcutDeger.length > 3) {
      return false;
    }
    var basilanDeger = $(this).html();
    $(".txtPin").val(mevcutDeger+basilanDeger);
  })

  $(".btnDelete").on("click",function () {
    $(".txtPin").val("");
  })

  $( document ).keydown(function() {
    $(".txtPin").focus();
  });

  $("form#frmLock").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmLock").serializeJSON();
    var json = JSON.stringify(formVerileri);
    $(".txtPin").val("");
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"lock/girisYap/",
      data: {girisYap:json},
      cache: false,
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $("#modalLock").modal("hide");
          $("nav.navbar").removeClass("blur");
          $("section.content").removeClass("blur");
          $("aside#leftsidebar").removeClass("blur");

        }else {
          $(".txtPin").val("");
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


  $(".btnLock").on("click",function (e) {
    e.preventDefault();
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"lock/destroy-lock-session",
      data: {destroyLockSession:1},
      cache: false,
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $("#modalLock").modal("show");
          $(".txtPin").focus();
          $("nav.navbar").addClass("blur");
          $("section.content").addClass("blur");
          $("aside#leftsidebar").addClass("blur");
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
  })
  /*kilit ekranı tuş vs. kodları*/




  /*common*/
  $('[data-toggle="tooltip"]').tooltip();

  $("#tumunuSec").on("click",function () {
    if ($(this).is(":checked")) {
      $("table").find("input[type=checkbox]").prop("checked",true);
    }else {
      $("table").find("input[type=checkbox]").prop("checked",false);
    }
  })

  $(document).on("click",".alert",function () {
    $(this).hide();
  })
  /*common*/

  /*klavye*/
  $(".klavye").on("click",function () {
    $(".klavye-wrapper").toggleClass("d-none");
  })

  $(".klavye-wrapper .btnTusTakimi").on("click",function () {
    var urunAdedi = $(".txtUrunAdedi").val();
    var tiklananSayi = $(this).html();
    var yazilacakSayi = urunAdedi+tiklananSayi;
    $(".txtUrunAdedi").val(yazilacakSayi);
    $(".h2UrunAdedi").html(yazilacakSayi);
  })
  $(".klavye-wrapper button.btnAdetiTemizle").on("click",function () {
    $(".txtUrunAdedi").val("");
    $(".h2UrunAdedi").html("");

  })
  $(".klavye-wrapper button.btnKlavyeKapat").on("click",function () {
    $(".klavye-wrapper").addClass("d-none");
  })
  /*klavye*/

  /*data search*/
  $(document).on("input",".dataSearch",function () {
    var input = $(this);
    var suggestionMenu = input.closest("div").find("ul.suggestion-menu");
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
          var eklenecekSatir = "<li class='disabled'><a><strong>Eşleşen : </strong></a></li>";
          if (donut.sonuclar != null) {
            for (var i = 0; i < donut.sonuclar.length; i++) {
              eklenecekSatir = eklenecekSatir+"<li><a data-id='"+donut.sonuclar[i]["id"]+"' >"+donut.sonuclar[i][donut.kolonAdi]+"</a></li>";
            }
            suggestionMenu.html(eklenecekSatir);
            suggestionMenu.css("display","block");
          }else {
            suggestionMenu.css("display","none");
          }
        }
      });
    }else {
      suggestionMenu.html("");
      suggestionMenu.css("display","none");
    }
  })
  /*data search*/

  /*döviz çevirici kodları*/
  $("#frmModalDovizCevirici input").on("keyup",function () {
    var girilenMiktar = $("#txtGirisMiktari").val();
    var girisKuru = $("#txtGirisKuru").val();
    var json = {"txtGirisMiktari":girilenMiktar,"txtGirisKuru":girisKuru};
    json = JSON.stringify(json);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/doviz-cevir",
      data: {dovizCevir:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingKur").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.dolarKarsilikAlis) {
          $(".btnLoadingKur").html("İPTAL");
          $("#txtDolarKarsilikAlis").val(donut.dolarKarsilikAlis);
          $("#txtDolarKarsilikSatis").val(donut.dolarKarsilikSatis);
          $("#txtEuroKarsilikAlis").val(donut.euroKarsilikAlis);
          $("#txtEuroKarsilikSatis").val(donut.euroKarsilikSatis);
        }
      }
    });
  })
  /*döviz çevirici kodları*/

  /*table row filter*/
  $("input.tableRowFilter").on("input",function () {
    $("table tbody tr").show();
    $("table tbody tr:not(:contains("+$(this).val()+"))").hide();
  })
  /*table row filter*/

  changeSelects();

  /*auto-check.js*/
  $("input[type=checkbox]").each(function () {
    var data = $(this).attr("data-bool");
    if (data) {
      $(this).prop("checked",true);
    }
  })
  /*auto-check.js*/

})

/*select2 elementlerini tekrar yükleme*/
function changeSelects() {
  $("select").each(function () {
    var data = $(this).attr("data-id");
    if (data) {
      $(this).val(data).trigger('change');
    }
  })
}
/*select2 elementlerini tekrar yükleme*/


/*FUNCTION FOR RADIO BUTTON VALUE*/
function autoRadio() {
  $(".radioForm").each(function () {
    var data = $(this).attr("data-radio");
    if (data == 1) {
      $(this).find("input[value=1]").prop("checked",true);
    }else {
      $(this).find("input[value=0]").prop("checked",true);
    }
  })
}
/*FUNCTION FOR RADIO BUTTON VALUE*/

/*lock session sorgulama kodları*/
function lockSessionSorgula() {
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"lock/lock-session-sorgula",
    data: {lockSessionSorgula:1},
    cache: false,
    error:function(err){
      alert(err.responseText);
    },
    success: function(response)
    {
      var donut = $.parseJSON(response);
      if (donut.yanit == true) {

      }else {
        $("#modalLock").modal("show");
        // $(".txtPin").focus();
        $("nav.navbar").addClass("blur");
        $("section.content").addClass("blur");
        $("aside#leftsidebar").addClass("blur");
      }
    }
  });
}
/*lock session sorgulama kodları*/

/*onayla.js*/
async function onayla(soruMetni,callBack) {
  swal(
    {
      title: "Emin misiniz?",
      text: soruMetni,
      icon: "warning",
      buttons: true,
      dangerMode: true,
      buttons: {
        cancel: "İptal",
        catch: "Onayla!"
      }
    }
  )
  .then((willDelete) => {
    if (willDelete) {
      //VERİLERİ SİL
      callBack(true);
    } else {
      callBack(false);
    }
  });
}
/*onayla.js*/


/*IP ADRESİNİ ALMA KODLARI*/
function getUserIP(onNewIP) { //  onNewIp - your listener function for new IPs
  //compatibility for firefox and chrome
  var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
  var pc = new myPeerConnection({
    iceServers: []
  }),
  noop = function() {},
  localIPs = {},
  ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
  key;

  function iterateIP(ip) {
    if (!localIPs[ip]) onNewIP(ip);
    localIPs[ip] = true;
  }

  //create a bogus data channel
  pc.createDataChannel("");

  // create offer and set local description
  pc.createOffer(function(sdp) {
    sdp.sdp.split('\n').forEach(function(line) {
      if (line.indexOf('candidate') < 0) return;
      line.match(ipRegex).forEach(iterateIP);
    });

    pc.setLocalDescription(sdp, noop, noop);
  }, noop);

  //listen for candidate events
  pc.onicecandidate = function(ice) {
    if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
    ice.candidate.candidate.match(ipRegex).forEach(iterateIP);
  };
}
/*IP ADRESİNİ ALMA KODLARI*/

/*modalOkcFonksiyonlari kodları*/
$("#txtOkcFonksiyonAdi").on("change",function () {
  if ($(this).find("option:selected").val() == "belgeyiKapat") {
    $("#frmOkcFonksiyonlari").find(".divBelgeyiKapat").removeClass("d-none");
  }else {
    $("#frmOkcFonksiyonlari").find(".divBelgeyiKapat").addClass("d-none");
  }
})
/*modalOkcFonksiyonlari kodları*/

/*ÜRÜN ökc bilgilerni alma kodları*/
async function urunOkcBilgileriniAl(json,callBack) {
  json = JSON.stringify(json);

  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"urun/urun-okc-bilgilerini-al/",
    data: {urunOkcBilgileriniAl:json},
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
          "txtUrunFiyati":donut.urunOkcBilgileri["adisyon_urunleri_urun_toplam_fiyati"],
          "txtUrunBarkodu":donut.urunOkcBilgileri["urun_barkodu"],
          "txtDepartmanNumarasi":1,
          "txtPluNo":donut.urunOkcBilgileri["urun_idsi"]
        };

        json = JSON.stringify(json);
        callBack(json);
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
/*ÜRÜN ökc bilgilerni alma kodları*/


/*müşteri adresleri ekleme kodları*/
$(".btnAdresEkle").on("click",function () {
  var eklenecekSatir = '<div class="input-group divMusteriAdresi">';
  eklenecekSatir += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
  eklenecekSatir += '<input type="text" id="txtMusteriAdresleri" required name="txtMusteriAdresleri[]" class="form-control" placeholder="Müşteri ikincil adreslerini giriniz">';
  eklenecekSatir += '<button type="button" class="btn btn-sm bg-red buttonInsideInput btnAdresSil" name="button">';
  eklenecekSatir += '<span class="zmdi zmdi-minus"></span>';
  eklenecekSatir += '</button>';
  eklenecekSatir += '</div>';
  $(".divMusteriAdresi:last").after(eklenecekSatir);
})

$(document).on("click",".btnAdresSil",function () {
  $(this).closest(".input-group").remove();
})
/*müşteri adresleri ekleme kodları*/

/*ökc bilgilerini alma kodları*/
async function okcBilgileriniAl(callBack) {
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"ayarlar/okc-bilgilerini-al/",
    data: {okcBilgileriniAl:1},
    cache: false,
    error:function(err){
      alert(err.responseText);
    },
    success: function(response)
    {
      var donut = $.parseJSON(response);
      if (donut.okcBilgileri) {

        var json = {
          "txtOkcPortAdi":donut.okcBilgileri["okc_bilgileri_port_adi"],
          "txtOkcBaudRate":donut.okcBilgileri["okc_bilgileri_baudrate"],
          "txtOkcFiscalIdsi":donut.okcBilgileri["okc_bilgileri_fiscal_idsi"]
        };

        json = JSON.stringify(json);
        callBack(json);
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

/*ökc bilgilerini alma kodları*/
