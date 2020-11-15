$(document).ready(function () {




  /*WEBSOCKET İÇİN YEREL IP ALMA KODLARI*/
  var ipAdresi;
  getUserIP(function(ip){
    webSocket(ip);
  });
  /*WEBSOCKET İÇİN YEREL IP ALMA KODLARI*/




})


/*WEBSOCKET KODLARI*/
function webSocket(ipAdresi) {
  var websocket = new WebSocket("ws://"+ipAdresi+":8088/");
  websocket.onopen = function(event) {

  }
  websocket.onmessage = function(event) {
    alert(event.data);
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
