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
  $("#frmCalisanRaporu").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("#frmCalisanRaporu").serializeJSON();
    var varsayilanKurIsareti = $("#txtKurIsareti").val();
    if ($("#txtCalisanAdi").val() != "") {
      var calisanIdsi = $("#txtCalisanAdi").attr("data-id");
      if (!calisanIdsi) {
        $.notify({
          // options
          icon: 'fa fa-danger fa-2x',
          message: "Lütfen çalışanü arama sonuçlarından çıkan çalışanlerden seçiniz. Eğer bir çalışane özel arama yapmak istemiyorsanız boş bırakınız!"
        },{
          // settings
          type: 'danger'
        });
        return false;
      }else {
        formVerileri["txtCalisanIdsi"] = calisanIdsi;
      }
    }

    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"rapor/calisan-raporunu-al/",
      data: {calisanRaporunuAl:json},
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
        if (donut.calisanAdetVeFiyatBilgileri) {
          $(".tblCalisanSatisRaporu tbody").html("");

          calisanAdlari = new Array();
          calisanSatisAdetleri = new Array();
          calisanSatisFiyatlari = new Array();
          for (var i = 0; i < donut.calisanAdetVeFiyatBilgileri.length; i++) {
            calisanAdlari.push(donut.calisanAdetVeFiyatBilgileri[i]["calisan_adi_soyadi"]);

            var eklenecekHtml = "<tr>";
            eklenecekHtml += "<td>"+donut.calisanAdetVeFiyatBilgileri[i]["calisan_adi_soyadi"]+"</td>";
            eklenecekHtml += "<td>"+donut.calisanAdetVeFiyatBilgileri[i]["urun_toplam_adedi"]+"</td>";
            eklenecekHtml += "<td>"+donut.calisanAdetVeFiyatBilgileri[i]["urun_toplam_fiyati"]+" "+varsayilanKurIsareti+" </td>";
            eklenecekHtml += "</tr>";
            $(".tblCalisanSatisRaporu tbody").append(eklenecekHtml);



            calisanSatisAdetleri.push(donut.calisanAdetVeFiyatBilgileri[i]["urun_toplam_adedi"]);
            calisanSatisFiyatlari.push(donut.calisanAdetVeFiyatBilgileri[i]["urun_toplam_fiyati"]);

          }

          $(".rowCalisanSatisRaporu").removeClass("d-none");


          var ctx = document.getElementById("calisanAdetChart");
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: calisanAdlari,
              datasets: [{
                label: 'Adet',
                data: calisanSatisAdetleri,
                backgroundColor: "#9ad0f5",
                borderWidth: 1
              },{
                label: 'Toplam Fiyat ('+varsayilanKurIsareti+')',
                data: calisanSatisFiyatlari,
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
