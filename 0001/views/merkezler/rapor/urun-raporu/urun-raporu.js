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
  $("#frmUrunRaporu").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("#frmUrunRaporu").serializeJSON();
    var varsayilanKurIsareti = $("#txtKurIsareti").val();
    if ($("#txtUrunAdi").val() != "") {
      var urunIdsi = $("#txtUrunAdi").attr("data-id");
      if (!urunIdsi) {
        $.notify({
          // options
          icon: 'fa fa-danger fa-2x',
          message: "Lütfen ürünü arama sonuçlarından çıkan ürünlerden seçiniz. Eğer bir ürüne özel arama yapmak istemiyorsanız boş bırakınız!"
        },{
          // settings
          type: 'danger'
        });
        return false;
      }else {
        formVerileri["txtUrunIdsi"] = urunIdsi;
      }
    }

    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"rapor/urun-raporunu-al/",
      data: {urunRaporunuAl:json},
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
        if (donut.urunAdetVeFiyatBilgileri) {
          $(".tblUrunSatisRaporu tbody").html("");

          urunAdlari = new Array();
          urunSatisAdetleri = new Array();
          urunSatisFiyatlari = new Array();
          for (var i = 0; i < donut.urunAdetVeFiyatBilgileri.length; i++) {
            if (donut.urunAdetVeFiyatBilgileri[i]["urun_adi"] != null) {

              var urunAdi = donut.urunAdetVeFiyatBilgileri[i]["urun_adi"];
              urunAdlari.push(donut.urunAdetVeFiyatBilgileri[i]["urun_adi"]);

            }else if (donut.urunAdetVeFiyatBilgileri[i]["alt_urun_adi"] != null) {

              var urunAdi = donut.urunAdetVeFiyatBilgileri[i]["alt_urun_adi"];
              urunAdlari.push(donut.urunAdetVeFiyatBilgileri[i]["alt_urun_adi"]);

            }else {

              var urunAdi = donut.urunAdetVeFiyatBilgileri[i]["menu_adi"];
              urunAdlari.push(donut.urunAdetVeFiyatBilgileri[i]["menu_adi"]);

            }

            var eklenecekHtml = "<tr>";
            eklenecekHtml += "<td>"+urunAdi+"</td>";
            eklenecekHtml += "<td>"+donut.urunAdetVeFiyatBilgileri[i]["urun_toplam_adedi"]+"</td>";
            eklenecekHtml += "<td>"+donut.urunAdetVeFiyatBilgileri[i]["urun_toplam_fiyati"]+" "+varsayilanKurIsareti+"</td>";
            eklenecekHtml += "</tr>";
            $(".tblUrunSatisRaporu tbody").append(eklenecekHtml);



            urunSatisAdetleri.push(donut.urunAdetVeFiyatBilgileri[i]["urun_toplam_adedi"]);
            urunSatisFiyatlari.push(donut.urunAdetVeFiyatBilgileri[i]["urun_toplam_fiyati"]);

          }
          if (donut.iptalVeIkramAdetleri.length == 1) {
            $("#spanIptalAdedi").html(donut.iptalVeIkramAdetleri[0]["urun_toplam_adedi"]);
            $("#spanIptalTutari").html(donut.iptalVeIkramAdetleri[0]["urun_toplam_fiyati"]+" "+varsayilanKurIsareti);
          }
          if (donut.iptalVeIkramAdetleri.length == 2) {
            $("#spanIptalAdedi").html(donut.iptalVeIkramAdetleri[0]["urun_toplam_adedi"]);
            $("#spanIptalTutari").html(donut.iptalVeIkramAdetleri[0]["urun_toplam_fiyati"]+" "+varsayilanKurIsareti);
            $("#spanIkramAdedi").html(donut.iptalVeIkramAdetleri[1]["urun_toplam_adedi"]);
            $("#spanIkramTutari").html(donut.iptalVeIkramAdetleri[1]["urun_toplam_fiyati"]+" "+varsayilanKurIsareti);
          }

          $(".rowUrunSatisRaporu").removeClass("d-none");


          var ctx = document.getElementById("urunAdetChart");
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: urunAdlari,
              datasets: [{
                label: 'Adet',
                data: urunSatisAdetleri,
                backgroundColor: "#9ad0f5",
                borderWidth: 1
              },{
                label: 'Toplam Fiyat ('+varsayilanKurIsareti+')',
                data: urunSatisFiyatlari,
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
