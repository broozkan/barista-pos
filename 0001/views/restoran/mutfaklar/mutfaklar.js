$(document).ready(function () {


  /*WEBSOCKET KODLARI*/
  var websocket = new WebSocket("ws://"+window.location.hostname+":8090/");
  /*WEBSOCKET KODLARI*/


  /* 5 SANİYEDE BİR GÜNCELLEME KODLARI*/
  window.setInterval(function(){
    mutfakSiparisleriniGuncelle();
  }, 3000);
  /* 5 SANİYEDE BİR GÜNCELLEME KODLARI*/

  /*SİPARİŞİ KALDIRMA KODLARI*/
  $(document).on("click",".btnSiparisiKaldir",function () {
    $(this).closest(".rowSiparisUrunleri").hide();
  })
  /*SİPARİŞİ KALDIRMA KODLARI*/

  /*MUTFAK SİPARİŞ DURUM DEĞİŞTİR KODLARI*/
  $(document).on("click",".btnSiparisHazir",function () {
    var urunAdi = $(this).closest(".rowSiparisUrunleri").find(".spanUrunAdi").html();
    var masaAdi = $(this).closest(".rowSiparisUrunleri").find(".spanMasaAdi").html();
    var mutfakAdi = $(".txtMutfakAdi").val();
    var adisyonUrunuIdsi = $(this).attr("id");
    var teslimDurumuIdsi = $(this).closest(".rowSiparisUrunleri").find(".txtTeslimDurumuIdsi option:selected").val();
    if (!teslimDurumuIdsi) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen bir durum seçiniz!"
      },{
        // settings
        type: 'danger',
        z_index:7777
      });
      return false;
    }
    var json = {"txtAdisyonUrunuIdsi":adisyonUrunuIdsi,"txtTeslimDurumuIdsi":teslimDurumuIdsi};

    json = JSON.stringify(json);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/siparis-durum-degistir",
      data: {siparisDurumDegistir:json},
      cache: false,
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Sipariş durumu değiştirildi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });

          var messageJSON = {
            urun_adi: urunAdi,
            urun_teslim_durumu_idsi: teslimDurumuIdsi,
    				mutfak_adi: mutfakAdi,
    				masa_adi: masaAdi
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
            z_index:7777
          });
        }
      }
    });
  })
  /*MUTFAK SİPARİŞ DURUM DEĞİŞTİR KODLARI*/

})


/*MUTFAK SİPARİŞLERİNİ GÜNCELLEME KODLARI*/
function mutfakSiparisleriniGuncelle() {
  var mutfakIdsi = $("#txtMutfakIdsi").val();
  var adisyonUrunleriIdleri = new Array();
  $(".rowSiparisUrunleri").each(function () {
    adisyonUrunleriIdleri.push($(this).find("button").attr("id"));
  });

  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"restoran/mutfak-siparislerini-guncelle",
    data: {mutfakSiparisleriniGuncelle:mutfakIdsi},
    cache: false,
    success: function(response)
    {
      var donut = $.parseJSON(response);
      if (donut.adisyonUrunleriIdleri) {
        teslimDurumlariHtml = $(".txtTeslimDurumuIdsi").html();
        for (var i = 0; i < donut.adisyonUrunleriIdleri.length; i++) {
          if ($.inArray(""+donut.adisyonUrunleriIdleri[i]+"",adisyonUrunleriIdleri) > -1) {
            $(".rowSiparisUrunleri#"+adisyonUrunleriIdleri[i]+"").find(".spanUrunNotu").html(donut.mutfakUrunleri[i]["adisyon_urunleri_urun_notu"]);

            // alert("adisyon urun ıdsi = "+donut.mutfakUrunleri[i]["id"]+" teslimdurum ıdsi : "+donut.mutfakUrunleri[i]["adisyon_urunleri_urun_teslim_durumu_idsi"])
            if (donut.mutfakUrunleri[i]["adisyon_urunleri_urun_teslim_durumu_idsi"] == "0") {
              var teslimDurumuHtmli = "<span class='badge badge-info'>YENİ</span>";
            }else {
              var teslimDurumuHtmli = "<span class='badge badge-success' style='background-color:"+donut.mutfakUrunleri[i]["teslim_durumu_rengi"]+"'>"+donut.mutfakUrunleri[i]["teslim_durumu_adi"]+"</span>";
            }
            $(".rowSiparisUrunleri#"+adisyonUrunleriIdleri[i]+"").find(".h3TeslimDurumu").html(teslimDurumuHtmli);
          }else {
            var eklenecekHtml = "<div class='row rowSiparisUrunleri' id="+donut.mutfakUrunleri[i]["id"]+">";
            eklenecekHtml += "<div class='col-lg-1 d-none-sm'></div>";
            eklenecekHtml += "<div class='col-lg-12 col-sm-12'>";
            eklenecekHtml += "<ul class='cbp_tmtimeline'>";
            eklenecekHtml += "<li>";
            eklenecekHtml += "<time class='cbp_tmtime' datetime='2017-11-04T03:45'><span>"+donut.mutfakUrunleri[i]["adisyon_urunleri_urun_siparis_saati"]+"</span> <span>Bugün</span></time>";
            eklenecekHtml += "<div class='cbp_tmicon bg-info'><i class='zmdi zmdi-cutlery text-white'></i></div>";
            eklenecekHtml += "<div class='cbp_tmicon bg-danger btnSiparisiKaldir' style='top:30%;cursor:pointer'><i class='zmdi zmdi-delete text-white'></i></div>";
            eklenecekHtml += "<div class='cbp_tmlabel'>";
            eklenecekHtml += "<div class='row'>";
            eklenecekHtml += "<div class='col-6'>";
            eklenecekHtml += "<h2><a href='javascript:void(0);'>ÜRÜN ADI :</a> <span class='spanUrunAdi'>"+donut.mutfakUrunleri[i]["urun_adi"]+"</span></h2>";
            eklenecekHtml += "<h2><a href='javascript:void(0);'>GARSON ADI :</a> <span class='spanGarsonAdi'>Burhan Özkan</span></h2>";
            eklenecekHtml += "<h2><a href='javascript:void(0);'>ÜRÜN ADEDİ :</a> <span class='spanUrunAdedi' >"+donut.mutfakUrunleri[i]["adisyon_urunleri_urun_adedi"]+"</span></h2>";
            eklenecekHtml += "<h2><a href='javascript:void(0);'>ÜRÜN NOTU :</a> <span class='spanUrunNotu' >"+donut.mutfakUrunleri[i]["adisyon_urunleri_urun_notu"]+"</span></h2>";
            eklenecekHtml += "</div>";
            eklenecekHtml += "<div class='col-3'><h3 class='h3TeslimDurumu'><span class='badge badge-info'>YENİ</span></h3>";
            eklenecekHtml += "</div>";
            eklenecekHtml += "<div class='col-3 align-middle text-right'>";
            eklenecekHtml += "<select class='form-control show-tick select2 ms txtTeslimDurumuIdsi'>";
            eklenecekHtml += teslimDurumlariHtml;
            eklenecekHtml += "</select>";
            eklenecekHtml += "<button type='button' class='btn g-bg-soundcloud btnSiparisHazir' id='"+donut.mutfakUrunleri[i]["id"]+"'>";
            eklenecekHtml += "<span class='zmdi zmdi-check-circle zmdi-hc-3x'></span>";
            eklenecekHtml += "</button>";
            if (donut.mutfakUrunleri[i]["masa_adi"] == null) {
              donut.mutfakUrunleri[i]["masa_adi"] = "Hızlı Satış";
            }
            eklenecekHtml += "<h3 class='mb-0'><span class='spanMasaAdi'>"+donut.mutfakUrunleri[i]["masa_adi"]+"</span></h3>";
            eklenecekHtml += "<h2><span>"+donut.mutfakUrunleri[i]["adisyon_urunleri_adisyon_idsi"]+"</span></h2>";
            eklenecekHtml += "</div>";
            eklenecekHtml += "</div>";
            eklenecekHtml += "</div>";
            eklenecekHtml += "</li>";
            eklenecekHtml += "</ul>";
            eklenecekHtml += "</div>";
            eklenecekHtml += "</div>";

            $(".rowSiparisUrunleri:first").before(eklenecekHtml);
            $("#myAudioElement")[0].play();

          }
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
/*MUTFAK SİPARİŞLERİNİ GÜNCELLEME KODLARI*/
