$(document).ready(function () {
  $(".spanKurIsareti").html($("#txtKurIsareti").val());


  /*btnTahsilatlar kodları*/
  $("#btnTahsilatlar").on("click",function () {
    var baslangicTarihi = $("#txtBaslangicTarihi").val();
    var bitisTarihi = $("#txtBitisTarihi").val();
    var baslangicSaati = $("#txtBaslangicSaati").val();
    var bitisSaati = $("#txtBitisSaati").val();

    var json = {
      "txtBaslangicTarihi":baslangicTarihi,
      "txtBitisTarihi":bitisTarihi,
      "txtBaslangicSaati":baslangicSaati,
      "txtBitisSaati":bitisSaati
    };

    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"muhasebe/muhasebe-tahsilatlari-al/",
      data: {muhasebeTahsilatlariAl:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("ARA");
        var donut = $.parseJSON(response);
        $("#tblTahsilatlar tbody").html("");

        for (var i = 0; i < donut.tahsilatlar.length; i++) {
          var eklenecekHtml = "<tr>";
          eklenecekHtml += "<td>"+donut.tahsilatlar[i]["musteri_adi_soyadi"]+"</td>";
          eklenecekHtml += "<td>"+donut.tahsilatlar[i]["tahsilat_tutari"]+"</td>";
          eklenecekHtml += "<td>"+donut.tahsilatlar[i]["tahsilat_aciklamasi"]+"</td>";
          eklenecekHtml += "<td>"+donut.tahsilatlar[i]["tahsilat_tarihi"]+"</td>";
          eklenecekHtml += "</tr>";
          $("#tblTahsilatlar tbody").append(eklenecekHtml);
        }



      }
    });

  })
  /*btnTahsilatlar kodları*/


  /*btnOdemeler kodları*/
  $("#btnOdemeler").on("click",function () {
    var baslangicTarihi = $("#txtBaslangicTarihi").val();
    var bitisTarihi = $("#txtBitisTarihi").val();
    var baslangicSaati = $("#txtBaslangicSaati").val();
    var bitisSaati = $("#txtBitisSaati").val();

    var json = {
      "txtBaslangicTarihi":baslangicTarihi,
      "txtBitisTarihi":bitisTarihi,
      "txtBaslangicSaati":baslangicSaati,
      "txtBitisSaati":bitisSaati
    };

    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"muhasebe/muhasebe-odemeleri-al/",
      data: {muhasebeOdemeleriAl:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("ARA");
        var donut = $.parseJSON(response);
        $("#tblOdemeler tbody").html("");

        for (var i = 0; i < donut.odemeler.length; i++) {
          var eklenecekHtml = "<tr>";
          eklenecekHtml += "<td>"+donut.odemeler[i]["musteri_adi_soyadi"]+"</td>";
          eklenecekHtml += "<td>"+donut.odemeler[i]["odeme_tutari"]+"</td>";
          eklenecekHtml += "<td>"+donut.odemeler[i]["odeme_aciklamasi"]+"</td>";
          eklenecekHtml += "<td>"+donut.odemeler[i]["odeme_tarihi"]+"</td>";
          eklenecekHtml += "</tr>";
          $("#tblOdemeler tbody").append(eklenecekHtml);
        }



      }
    });

  })
  /*btnOdemeler kodları*/

  /*btnSatisFaturalari kodları*/
  $("#btnSatisFaturalari").on("click",function () {
    var baslangicTarihi = $("#txtBaslangicTarihi").val();
    var bitisTarihi = $("#txtBitisTarihi").val();
    var baslangicSaati = $("#txtBaslangicSaati").val();
    var bitisSaati = $("#txtBitisSaati").val();

    var json = {
      "txtBaslangicTarihi":baslangicTarihi,
      "txtBitisTarihi":bitisTarihi,
      "txtBaslangicSaati":baslangicSaati,
      "txtBitisSaati":bitisSaati
    };

    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"muhasebe/muhasebe-satis-faturalarini-al/",
      data: {muhasebeSatisFaturalariniAl:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("ARA");
        var donut = $.parseJSON(response);
        $("#tblSatisFaturalari tbody").html("");

        for (var i = 0; i < donut.satisFaturalari.length; i++) {
          var eklenecekHtml = "<tr>";
          eklenecekHtml += "<td>"+donut.satisFaturalari[i]["musteri_adi_soyadi"]+"</td>";
          eklenecekHtml += "<td>"+donut.satisFaturalari[i]["satis_faturasi_tutari"]+"</td>";
          eklenecekHtml += "<td>"+donut.satisFaturalari[i]["satis_faturasi_aciklamasi"]+"</td>";
          eklenecekHtml += "<td>"+donut.satisFaturalari[i]["satis_faturasi_vade_tarihi"]+"</td>";
          eklenecekHtml += "<td>"+donut.satisFaturalari[i]["satis_faturasi_tarihi"]+"</td>";
          eklenecekHtml += "</tr>";
          $("#tblSatisFaturalari tbody").append(eklenecekHtml);
        }



      }
    });

  })
  /*btnSatisFaturalari kodları*/

  /*btnAlisFaturalari kodları*/
  $("#btnAlisFaturalari").on("click",function () {
    var baslangicTarihi = $("#txtBaslangicTarihi").val();
    var bitisTarihi = $("#txtBitisTarihi").val();
    var baslangicSaati = $("#txtBaslangicSaati").val();
    var bitisSaati = $("#txtBitisSaati").val();

    var json = {
      "txtBaslangicTarihi":baslangicTarihi,
      "txtBitisTarihi":bitisTarihi,
      "txtBaslangicSaati":baslangicSaati,
      "txtBitisSaati":bitisSaati
    };

    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"muhasebe/muhasebe-alis-faturalarini-al/",
      data: {muhasebeAlisFaturalariniAl:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("ARA");
        var donut = $.parseJSON(response);
        $("#tblAlisFaturalari tbody").html("");

        for (var i = 0; i < donut.alisFaturalari.length; i++) {
          var eklenecekHtml = "<tr>";
          eklenecekHtml += "<td>"+donut.alisFaturalari[i]["musteri_adi_soyadi"]+"</td>";
          eklenecekHtml += "<td>"+donut.alisFaturalari[i]["alis_faturasi_tutari"]+"</td>";
          eklenecekHtml += "<td>"+donut.alisFaturalari[i]["alis_faturasi_aciklamasi"]+"</td>";
          eklenecekHtml += "<td>"+donut.alisFaturalari[i]["alis_faturasi_vade_tarihi"]+"</td>";
          eklenecekHtml += "<td>"+donut.alisFaturalari[i]["alis_faturasi_tarihi"]+"</td>";
          eklenecekHtml += "</tr>";
          $("#tblAlisFaturalari tbody").append(eklenecekHtml);
        }



      }
    });

  })
  /*btnAlisFaturalari kodları*/

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

  /*VERİLERİ GETİR KODLARI*/
  $("#frmMuhasebeRaporu").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("#frmMuhasebeRaporu").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"muhasebe/muhasebe-raporunu-al/",
      data: {muhasebeRaporunuAl:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("ARA");

        var donut = $.parseJSON(response);

        $("#spanAdisyonlarToplami").html(donut.adisyonToplami);
        $("#spanIndirimToplami").html(donut.adisyonIndirimTutari);
        $("#spanSatisFaturalariToplami").html(donut.satisFaturalariToplami);
        $("#spanTahsilatlarToplami").html(donut.toplamTahsilatTutari);
        $("#spanToplamGelir").html(donut.toplamGelir.toFixed(2));


        $("#spanAlisFaturalariToplami").html(donut.alisFaturalariToplami);
        $("#spanOdemelerToplami").html(donut.toplamOdemeTutari);
        $("#spanToplamGider").html(donut.toplamGider.toFixed(2));

        $("#spanToplamKar").html(donut.toplamKar.toFixed(2));

        $("#spanAlacakToplami").html(donut.alacakToplami);
        $("#spanVerecekToplami").html(donut.verecekToplami);
        $("#spanBorcBakiyesi").html(donut.borcBakiyesi);
      }
    });
  })
  /*VERİLERİ GETİR KODLARI*/


  $( "#frmMuhasebeRaporu" ).submit();

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
