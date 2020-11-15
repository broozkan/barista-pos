$(document).ready(function () {




  /*WEBSOCKET İÇİN YEREL IP ALMA KODLARI*/
  var ipAdresi;
  getUserIP(function(ip){
    var callerIdAktifMi = $("#txtCallerIdAktifMi").val();
    if (callerIdAktifMi == 1) {
      webSocket(ip)
    }else {
      onayla("Caller ID bağlantınız sistem üzerinde inaktif edilmiş. Aktif etmek ister misiniz?",function (onay) {
        if (onay == true) {
          jQuery.ajax({
            type: "POST",
            url: ""+yolHtml+"restoran/callerIdAktifEt",
            data: {callerIdAktifEt:1},
            cache: false,
            error:function(err){
              alert(err.responseText);
            },
            success: function(response)
            {
              var donut = $.parseJSON(response);
              if ( donut.yanit == true ) {
                $.notify({
                  // options
                  icon: 'fa fa-danger fa-2x',
                  message: "Caller ID sistem üzerinde aktifleştirildi"
                },{
                  // settings
                  type: 'success',
                  z_index:7777
                });
                webSocket(ip);
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
    }
  });
  /*WEBSOCKET İÇİN YEREL IP ALMA KODLARI*/

})


/*WEBSOCKET KODLARI*/
function webSocket(ipAdresi) {
  var websocket = new WebSocket("ws://"+ipAdresi+":8088/");
  websocket.onopen = function(event) {

  }
  websocket.onmessage = function(event) {
    var telefonNumarasi = event.data;

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/callerIdNoSorgula",
      data: {callerIdNoSorgula:telefonNumarasi},
      cache: false,
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {

        var donut = $.parseJSON(response);

        if ( donut.musteriBilgileri ) {

          var eklenecekHtml = "<ul class='chat-scroll-list clearfix'>";
          eklenecekHtml += "<li class='left float-left'>";
          eklenecekHtml += "<div class='chat-info'>";
          eklenecekHtml += "<span class='float-right zmdi zmdi-close spanMutfakMesajKapat'></span>";
          eklenecekHtml += "<a class='name' href='"+yolHtml+"restoran/paket-siparis-adisyon/"+donut.musteriBilgileri["id"]+"'>"+donut.musteriBilgileri["musteri_adi_soyadi"]+"</a>";
          eklenecekHtml += "<span>"+donut.musteriBilgileri["saat"]+"</span>";
          eklenecekHtml += "<span class='message'>Adres : "+donut.musteriBilgileri["musteri_adresi"]+" </span>";
          eklenecekHtml += "</div>";
          eklenecekHtml += "</li>";
          eklenecekHtml += "</ul>";
          $(".callerId").append(eklenecekHtml);
          $(".chat-launcher").trigger("click");

        }else {
          $("#modalYeniMusteriEkle").modal("show");
          $("#txtMusteriTelefonNumarasi").val(telefonNumarasi);
        }
      }
    });


  };

  websocket.onerror = function(event){
    console.log("Bir sorun oluştu.");
  };
  websocket.onclose = function(event){

  };
}
/*WEBSOCKET KODLARI*/

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
