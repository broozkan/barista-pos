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
  $("#frmGecmisAdisyonlar").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("#frmGecmisAdisyonlar").serializeJSON();

    if ($("#txtCalisanAdi").val() != "") {
      var calisanIdsi = $("#txtCalisanAdi").attr("data-id");
      if (!calisanIdsi) {
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
        formVerileri["txtCalisanIdsi"] = calisanIdsi;
      }
    }

    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"rapor/gecmis-adisyonlari-al/",
      data: {gecmisAdisyonlariAl:json},
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
        if (donut.gecmisAdisyonlar) {
          $(".tblGecmisAdisyonlar tbody").html("");
          $(".rowGecmisAdisyonlar").removeClass("d-none");

          for (var i = 0; i < donut.gecmisAdisyonlar.length; i++) {
            var eklenecekHtml = "<tr id='"+donut.gecmisAdisyonlar[i]["adisyon_idsi"]+"'>";
            eklenecekHtml += "<td>"+donut.gecmisAdisyonlar[i]["calisan_adi_soyadi"]+"</td>";
            eklenecekHtml += "<td><strong>"+donut.gecmisAdisyonlar[i]["adisyon_tutari"]+" <span class='spanKurIsareti'></span> </strong></td>";
            eklenecekHtml += "<td><strong>"+donut.gecmisAdisyonlar[i]["adisyon_tarihi"]+"</strong></td>";
            eklenecekHtml += "<td><a href='"+yolHtml+"rapor/gecmis-adisyon-incele/"+donut.gecmisAdisyonlar[i]["adisyon_idsi"]+"' class='btn btn-warning'><span class='zmdi zmdi-search'></span> </button> </td>";
            eklenecekHtml += "</tr>";
            $(".tblGecmisAdisyonlar tbody").append(eklenecekHtml);

          }
          $(".spanKurIsareti").html($("#txtKurIsareti").val());

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
