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
  $("#frmHasilatRaporu").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("#frmHasilatRaporu").serializeJSON();

    var varsayilanKurIsareti = $("#txtKurIsareti").val();

    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"rapor/hasilat-raporunu-al/",
      data: {hasilatRaporunuAl:json},
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
        if (donut.hasilatBilgileri) {
          $(".tblHasilatSatisRaporu tbody").html("");
          var kurIsareti = $("#txtVarsayilanKurIsareti").val();
          odemeMetoduAdlari = new Array();
          metodSatisFiyatlari = new Array();
          var toplamMiktar = 0;
          for (var i = 0; i < donut.hasilatBilgileri.length; i++) {
            odemeMetoduAdlari.push(donut.hasilatBilgileri[i]["odeme_metod_adi"]);

            var eklenecekHtml = "<tr>";
            eklenecekHtml += "<td>"+donut.hasilatBilgileri[i]["odeme_metod_adi"]+"</td>";
            eklenecekHtml += "<td>"+donut.hasilatBilgileri[i]["toplam_miktar"]+" "+kurIsareti+"</td>";
            eklenecekHtml += "</tr>";
            $(".tblHasilatSatisRaporu tbody").append(eklenecekHtml);

            metodSatisFiyatlari.push(donut.hasilatBilgileri[i]["toplam_miktar"]);
            toplamMiktar += parseFloat(donut.hasilatBilgileri[i]["toplam_miktar"]);

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
