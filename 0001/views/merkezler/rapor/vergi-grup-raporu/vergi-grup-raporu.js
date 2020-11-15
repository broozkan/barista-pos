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
  $("#frmVergiRaporu").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("#frmVergiRaporu").serializeJSON();
    var varsayilanKurIsareti = $("#txtKurIsareti").val();
    if ($("#txtVergiAdi").val() != "") {
      var vergiIdsi = $("#txtVergiAdi").attr("data-id");
      if (!vergiIdsi) {
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
        formVerileri["txtVergiIdsi"] = vergiIdsi;
      }
    }

    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"rapor/vergi-grup-raporunu-al/",
      data: {vergiGrupRaporunuAl:json},
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
        if (donut.kdvGrupBilgileri) {
          $(".tblVergiSatisRaporu tbody").html("");

          vergiAdlari = new Array();
          vergiSatisAdetleri = new Array();
          vergiSatisFiyatlari = new Array();
          for (var i = 0; i < donut.kdvGrupBilgileri.length; i++) {
            if (donut.kdvGrupBilgileri[i]["vergi_adi"] != null) {

              var vergiAdi = donut.kdvGrupBilgileri[i]["vergi_adi"];
              vergiAdlari.push(donut.kdvGrupBilgileri[i]["vergi_adi"]);

            }

            var eklenecekHtml = "<tr>";
            eklenecekHtml += "<td>"+vergiAdi+"</td>";
            eklenecekHtml += "<td>"+donut.kdvGrupBilgileri[i]["vergi_toplam_fiyati"]+" "+varsayilanKurIsareti+"</td>";
            eklenecekHtml += "</tr>";
            $(".tblVergiSatisRaporu tbody").append(eklenecekHtml);



            vergiSatisFiyatlari.push(donut.kdvGrupBilgileri[i]["vergi_toplam_fiyati"]);

          }


          $(".rowVergiSatisRaporu").removeClass("d-none");


          var ctx = document.getElementById("vergiAdetChart");
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: vergiAdlari,
              datasets: [{
                label: 'Adet',
                data: vergiSatisAdetleri,
                backgroundColor: "#9ad0f5",
                borderWidth: 1
              },{
                label: 'Toplam Fiyat ('+varsayilanKurIsareti+')',
                data: vergiSatisFiyatlari,
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
