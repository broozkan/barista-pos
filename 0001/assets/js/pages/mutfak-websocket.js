$(document).ready(function () {

  /*MUTFAK BAĞLANTI WEBSOCKET KODLARI*/
  var websocket = new WebSocket("ws://"+window.location.hostname+":8090/");
		websocket.onopen = function(event) {

		}
		websocket.onmessage = function(event) {
			var Data = JSON.parse(event.data);
      var lokasyonIdsi = $("#txtLokasyonIdsi").val();
      if (lokasyonIdsi) {
        bilgileriGuncelle(lokasyonIdsi);
      }

      stokDurumuSorgula();

      if (Data.masaAdi != null) {
        /*teslim durumu adını alma kodları*/
        jQuery.ajax({
          type: "POST",
          url: ""+yolHtml+"restoran/teslim-durumu-adini-al",
          data: {teslimDurumuAdiniAl:Data.urunTeslimDurumuIdsi},
          cache: false,
          success: function(response)
          {
            var donut = $.parseJSON(response);
            if (donut.teslimDurumuAdi) {
                var eklenecekHtml = "<ul class='chat-scroll-list clearfix'>";
                eklenecekHtml += "<li class='left float-left'>";
                eklenecekHtml += "<div class='chat-info'>";
                eklenecekHtml += "<span class='float-right zmdi zmdi-close spanMutfakMesajKapat'></span>";

                eklenecekHtml += "<a class='name' href='javascript:void(0);'>"+Data.mutfakAdi+"</a>";
                eklenecekHtml += "<span>"+donut.saat+"</span>";
                eklenecekHtml += "<span class='message'>"+Data.masaAdi+" masasının "+Data.urunAdi+" ürünün durumu '"+donut.teslimDurumuAdi+"' olarak değiştirildi</span>";
                eklenecekHtml += "</div>";
                eklenecekHtml += "</li>";
                eklenecekHtml += "</ul>";
                var bildirimSayisi = parseInt($(".spanMutfakBildirim").html());
                bildirimSayisi++;
                $(".chatMutfak").append(eklenecekHtml);
                $(".spanMutfakBildirim").html(bildirimSayisi);
                $(".spanMutfakBildirim").removeClass("d-none");
                bilgileriGuncelle();
            }
          }
        });
        /*teslim durumu adını alma kodları*/


      }

		};

		websocket.onerror = function(event){
      console.log("Bir sorun oluştu.");
		};
		websocket.onclose = function(event){

		};
  /*MUTFAK BAĞLANTI WEBSOCKET KODLARI*/
})

function stokDurumuSorgula() {
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"restoran/stok-biten-urunleri-al",
    data: {stokBitenUrunleriAl:1},
    cache: false,
    success: function(response)
    {
      var donut = $.parseJSON(response);
      $(".ulAzalanStoklar").html("");
      var bildirimSayisi = 0;
      if (donut.stokAzalanUrunler) {
        for (var i = 0; i < donut.stokAzalanUrunler.length; i++) {
          var eklenecekHtml = '<li>';
          eklenecekHtml += '<a href="javascript:void(0);">';
          eklenecekHtml += '<div class="progress-container progress-primary">';
          eklenecekHtml += '<span class="progress-badge">'+donut.stokAzalanUrunler[i]["urun_adi"]+'</span>';
          eklenecekHtml += '<div class="progress">';
          eklenecekHtml += '<div class="progress-bar" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">';
          eklenecekHtml += '<span class="progress-value">'+donut.stokAzalanUrunler[i]["urun_adedi"]+' adet kaldı</span>';
          eklenecekHtml += '</div>';
          eklenecekHtml += '</div>';
          eklenecekHtml += '</div>';
          eklenecekHtml += '</a>';
          eklenecekHtml += '</li>';

          bildirimSayisi++;
          $(".ulAzalanStoklar").append(eklenecekHtml);
        }

        $(".spanAzalanStoklarBildirim").html(bildirimSayisi);
      }
    }
  });
}
