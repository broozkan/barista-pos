$(document).ready(function () {


  /*BTN HAZIR GÜNLER KODLARI*/
  $(".btnDun").on("click",function () {
    tarihBilgileriniAl(0);

  })

  $(".btnBugun").on("click",function () {
    tarihBilgileriniAl(1);

  })

  $(".btnSonHafta").on("click",function () {
    tarihBilgileriniAl(2);
  })

  $(".btnSonAy").on("click",function () {
    tarihBilgileriniAl(3);
  })
  /*BTN HAZIR GÜNLER KODLARI*/


  /*ÜRÜN RAPOLARINI GETİRME KODLARI*/
  $("#frmSatisTipiRaporu").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("#frmSatisTipiRaporu").serializeJSON();

    var varsayilanKurIsareti = $("#txtKurIsareti").val();

    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"rapor/satis-tipi-raporunu-al/",
      data: {satisTipiRaporunuAl:json},
      cache: false,
      beforeSend: function () {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("ARA");

        var donut = $.parseJSON(response);
        if (donut.satisTipiBilgileri) {
          $(".tblSatisTipiRaporu tbody").html("");
          var kurIsareti = $("#txtVarsayilanKurIsareti").val();
          odemeMetoduAdlari = new Array();
          metodSatisFiyatlari = new Array();
          var toplamMiktar = 0;
          for (var i = 0; i < donut.satisTipiBilgileri.length; i++) {
            if( donut.satisTipiBilgileri[i]["adisyon_masa_idsi"] == "HS" ) {
              odemeMetoduAdlari.push("Hızlı Satış");
              donut.satisTipiBilgileri[i]["adisyon_masa_idsi"] = "Hızlı Satış";
            }else if (donut.satisTipiBilgileri[i]["adisyon_masa_idsi"] == "PS") {
              odemeMetoduAdlari.push("Paket Servis");
              donut.satisTipiBilgileri[i]["adisyon_masa_idsi"] = "Paket Servis";
            }else {
              odemeMetoduAdlari.push("Diğer");
              donut.satisTipiBilgileri[i]["adisyon_masa_idsi"] = "Diğer";
            }


            var eklenecekHtml = "<tr>";
            eklenecekHtml += "<td>"+donut.satisTipiBilgileri[i]["adisyon_masa_idsi"]+"</td>";
            eklenecekHtml += "<td>"+donut.satisTipiBilgileri[i]["toplam_miktar"]+" "+kurIsareti+"</td>";
            eklenecekHtml += "</tr>";
            $(".tblSatisTipiRaporu tbody").append(eklenecekHtml);

            metodSatisFiyatlari.push(donut.satisTipiBilgileri[i]["toplam_miktar"]);
            toplamMiktar += parseFloat(donut.satisTipiBilgileri[i]["toplam_miktar"]);

          }

          $("#h3Toplam").html(toplamMiktar.toFixed(2)+" "+kurIsareti);
          $(".rowHasilatSatisRaporu").removeClass("d-none");


          var ctx = document.getElementById("hasilatChart");
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: odemeMetoduAdlari,
              datasets: [{
                label: 'Toplam Fiyat ('+kurIsareti+')',
                data: metodSatisFiyatlari,
                backgroundColor: "#ffb1c1",
                borderWidth: 1
              }]
            }
          });
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
  /*ÜRÜN RAPOLARINI GETİRME KODLARI*/

})
function tarihBilgileriniAl(index) {

  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"rapor/tarih-bilgilerini-al/",
    data: {tarihBilgileriniAl:index},
    cache: false,
    error:function(err){
      alert(err.responseText);
    },
    success: function(response)
    {
      var donut = $.parseJSON(response);
      if (donut.baslangicTarihi) {
        $("#txtBaslangicTarihi").val(donut.baslangicTarihi);
        $("#txtBitisTarihi").val(donut.bitisTarihi);
        $("#txtBaslangicSaati").val(donut.baslangicSaati);
        $("#txtBitisSaati").val(donut.bitisSaati);
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
