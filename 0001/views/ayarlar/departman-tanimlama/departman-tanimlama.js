$(document).ready(function () {

  autoRadio();
  /*WEBSOCKET İÇİN YEREL IP ALMA VE BAĞLANTI KODLARI*/
  var ipAdresi;
  var websocket;
  getUserIP(function(ip){

    websocket = new WebSocket("ws://"+ip+":8088/");
    websocket.onopen = function(event) {

    }
    
    websocket.onmessage = function(event) {
      var birimBilgileri = $.parseJSON(event.data);
      var eklenecekHtml = "<tr>";
      eklenecekHtml += "<td class='tdDepartmanIdsi' >"+birimBilgileri["departmanIdsi"]+"</td>";
      eklenecekHtml += "<td class='tdDepartmanAdi'><p>"+birimBilgileri["departmanAdi"]+"</p> <input value='"+birimBilgileri["departmanAdi"]+"' type='text' class='form-control show-tick txtDepartmanAdi d-none'/></td>";
      eklenecekHtml += "<td class='tdDepartmanKdvNosu'><p>"+birimBilgileri["departmanKdvNosu"]+"</p><input value='"+birimBilgileri["departmanKdvNosu"]+"' type='text' class='form-control show-tick txtDepartmanKdvNosu d-none'/></td>";
      eklenecekHtml += "<td class='tdDepartmanFiyati'><p>"+birimBilgileri["departmanFiyati"]+"</p><input value='"+birimBilgileri["departmanFiyati"]+"' type='text' class='form-control show-tick txtDepartmanFiyati d-none'/></td>";
      eklenecekHtml += "<td class='tdDepartmanLimiti'></td>";
      eklenecekHtml += "<td class='tdDepartmanTartilabilir'><p>"+birimBilgileri["departmanTartilabilir"]+"</p><input value='"+birimBilgileri["departmanTartilabilir"]+"' type='text' class='form-control show-tick txtDepartmanTartilabilir d-none'/></td>";
      eklenecekHtml += "<td><button class='btn btn-success btnOkcDepartmanKaydet'>Kaydet</button> / <button class='btn btn-warning btnOkcDuzenle'>Düzenle</button></td>";
      eklenecekHtml += "</tr>";
      $(".tblDepartmanlar tbody").append(eklenecekHtml);
    };

    websocket.onerror = function(event){
      console.log("Bir sorun oluştu.");
    };
    websocket.onclose = function(event){

    };

  });
  /*WEBSOCKET İÇİN YEREL IP ALMA VE BAĞLANTI KODLARI*/


  /*ÖKC FONKSİYON TUŞLARI KODLARI*/
  $(".btnBaglan").on("click",function () {

    okcBilgileriniAl(function callBack(json) {
      okcBilgileri = json;

      var messageJSON = {
        urun_adi: "baglan",
        urun_teslim_durumu_idsi: "teslimDurumuIdsi",
        mutfak_adi: "mutfakAdi",
        masa_adi: "masaAdi",
        fonksiyon_adi: "baglan",
        fonksiyon_parametreleri: okcBilgileri
      };
      websocket.send(JSON.stringify(messageJSON));
    });




  })

  $(".btnDepartmanlariAl").on("click",function () {
    $(".tblDepartmanlar tbody").html("");

    var messageJSON = {
      urun_adi: "departmanlari_getir",
      urun_teslim_durumu_idsi: "teslimDurumuIdsi",
      mutfak_adi: "mutfakAdi",
      masa_adi: "masaAdi",
      fonksiyon_adi: "departmanlariAl",
      fonksiyon_parametreleri: "{}"
    };
    websocket.send(JSON.stringify(messageJSON));
  })
  /*ÖKC FONKSİYON TUŞLARI KODLARI*/


  /*TABLO TUŞLARI KODLARI*/
  $(document).on("click",".btnOkcDuzenle",function () {
    var satir = $(this).closest("tr");

    $(satir).find("td").each(function () {
      if ($(this).find("p").hasClass("d-none")) {
        $(this).find("p").removeClass("d-none");
        $(this).find("input").addClass("d-none");
      }else {
        $(this).find("p").addClass("d-none");
        $(this).find("input").removeClass("d-none");
      }

    })
  })

  $(document).on("click",".btnOkcDepartmanKaydet",function () {
    var departmanIdsi = $(this).closest("tr").find("td.tdDepartmanIdsi").html();
    var departmanAdi = $(this).closest("tr").find("td.tdDepartmanAdi input").val();
    var departmanKdvNosu = $(this).closest("tr").find("td.tdDepartmanKdvNosu input").val();
    var departmanFiyati = $(this).closest("tr").find("td.tdDepartmanFiyati input").val();
    var departmanLimiti = $(this).closest("tr").find("td.tdDepartmanLimiti").html();
    var departmanTartilabilir = $(this).closest("tr").find("td.tdDepartmanTartilabilir input").val();
    var json = {
      "txtDepartmanIdsi":departmanIdsi,
      "txtDepartmanAdi":departmanAdi,
      "txtDepartmanKdvNosu":departmanKdvNosu,
      "txtDepartmanFiyati":departmanFiyati,
      "txtDepartmanLimiti":departmanLimiti,
      "txtDepartmanTartilabilir":departmanTartilabilir
    };
    json = JSON.stringify(json);

    var messageJSON = {
      urun_adi: "",
      urun_teslim_durumu_idsi: "",
      mutfak_adi: "",
      masa_adi: "",
      fonksiyon_adi: "departmanlariKaydet",
      fonksiyon_parametreleri: json
    };
    websocket.send(JSON.stringify(messageJSON));

    $.notify({
      // options
      icon: 'fa fa-danger fa-2x',
      message: "Departman bilgileri kayıt edilecektir"
    },{
      // settings
      type: 'success',
      z_index:7777
    });

  })
  /*TABLO TUŞLARI KODLARI*/
})
