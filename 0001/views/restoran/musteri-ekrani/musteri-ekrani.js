$(document).ready(function () {

  /* 5 SANİYEDE BİR GÜNCELLEME KODLARI*/
  window.setInterval(function(){
    mutfakSiparisleriniGuncelle();
  }, 5000);
  /* 5 SANİYEDE BİR GÜNCELLEME KODLARI*/


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
        for (var i = 0; i < donut.adisyonUrunleriIdleri.length; i++) {
          if ($.inArray(""+donut.adisyonUrunleriIdleri[i]+"",adisyonUrunleriIdleri) > -1) {
            $(".rowSiparisUrunleri#"+adisyonUrunleriIdleri[i]+"").find(".spanUrunNotu").html(donut.mutfakUrunleri[i]["adisyon_urunleri_urun_notu"]);
          }else {
            var eklenecekHtml = "<div class='row rowSiparisUrunleri' id="+donut.mutfakUrunleri[i]["id"]+">";
            eklenecekHtml += "<div class='col-lg-2 d-none-sm'></div>";
            eklenecekHtml += "<div class='col-lg-8 col-sm-12'>";
            eklenecekHtml += "<ul class='cbp_tmtimeline'>";
            eklenecekHtml += "<li>";
            eklenecekHtml += "<time class='cbp_tmtime' datetime='2017-11-04T03:45'><span>"+donut.mutfakUrunleri[i]["adisyon_urunleri_urun_siparis_saati"]+"</span> <span>Bugün</span></time>";
            eklenecekHtml += "<div class='cbp_tmicon bg-info'><i class='zmdi zmdi-cutlery text-white'></i></div>";
            eklenecekHtml += "<div class='cbp_tmlabel'>";
            eklenecekHtml += "<div class='row'>";
            eklenecekHtml += "<div class='col-7'>";
            eklenecekHtml += "<h2><a href='javascript:void(0);'>ÜRÜN ADI :</a> <span class='spanUrunAdi'>"+donut.mutfakUrunleri[i]["urun_adi"]+"</span></h2>";
            eklenecekHtml += "<h2><a href='javascript:void(0);'>GARSON ADI :</a> <span class='spanGarsonAdi'>Burhan Özkan</span></h2>";
            eklenecekHtml += "<h2><a href='javascript:void(0);'>ÜRÜN ADEDİ :</a> <span class='spanUrunAdedi' >"+donut.mutfakUrunleri[i]["adisyon_urunleri_urun_adedi"]+"</span></h2>";
            eklenecekHtml += "<h2><a href='javascript:void(0);'>ÜRÜN NOTU :</a> <span class='spanUrunNotu' >"+donut.mutfakUrunleri[i]["adisyon_urunleri_urun_notu"]+"</span></h2>";
            eklenecekHtml += "</div>";
            eklenecekHtml += "<div class='col-5 align-middle text-right'>";
            eklenecekHtml += "<button type='button' class='btn g-bg-cgreen btnSiparisHazir' id='"+donut.mutfakUrunleri[i]["id"]+"'>";
            eklenecekHtml += "<span class='zmdi zmdi-check-circle zmdi-hc-5x'></span> </button>";
            if (donut.mutfakUrunleri[i]["masa_adi"] == null) {
              donut.mutfakUrunleri[i]["masa_adi"] = "Hızlı Satış";
            }
            eklenecekHtml += "<h3 class='mb-0'>"+donut.mutfakUrunleri[i]["masa_adi"]+"</h3>";
            eklenecekHtml += "<h2><span>"+donut.mutfakUrunleri[i]["adisyon_urunleri_adisyon_idsi"]+"</span></h2>";
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
