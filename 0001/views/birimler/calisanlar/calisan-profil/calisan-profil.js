$(document).ready(function () {

  /*ÇALIŞAN HARCAMA ADİSYONLARINI GETİRME*/
  $(".btnHarcamaAdisyonlari").on("click",function () {
    var calisanIdsi = $("#txtCalisanIdsi").val();

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"restoran/calisan-gecmis-adisyonlarini-al",
      data: {calisanGecmisAdisyonlariniAl:calisanIdsi},
      cache: false,
      beforeSend:function () {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      success: function(response)
      {
        $(".btnLoading").html("Geçmiş Adisyonlarını Getir");
        var donut = $.parseJSON(response);
        if (donut.calisanAdisyonlari) {
          $(".tblHarcamaAdisyonlari tbody").html("");
          for (var i = 0; i < donut.calisanAdisyonlari.length; i++) {
            var eklenecekHtml = "<tr>";
            eklenecekHtml += "<td>"+donut.calisanAdisyonlari[i]["id"]+"</td>";
            eklenecekHtml += "<td>"+donut.calisanAdisyonlari[i]["adisyon_tutari"]+"</td>";
            eklenecekHtml += "<td>"+donut.calisanAdisyonlari[i]["adisyon_tarihi"]+"</td>";
            eklenecekHtml += "<td><a href='"+yolHtml+"rapor/gecmis-adisyon-incele/"+donut.calisanAdisyonlari[i]["id"]+"' class='btn btn-warning'><span class='zmdi zmdi-search'></span>  </a> </td>";
            eklenecekHtml += "</tr>";
            $(".tblHarcamaAdisyonlari tbody").append(eklenecekHtml);
          }
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
  })
  /*ÇALIŞAN HARCAMA ADİSYONLARINI GETİRME*/


  /*ÇALIŞAN SATIŞ BİLGİLERİNİ GETİRME VE GRAFİĞE YÜKLEME*/
  $(".btnCalisanSatislari").on("click",function (e) {
    e.preventDefault();
    var calisanIdsi = $("#txtCalisanIdsi").val();
    var json = {"txtCalisanIdsi":calisanIdsi,"txtBaslangicTarihi":"2000-01-01","txtBitisTarihi":"3000-01-01"};

    var json = JSON.stringify(json);

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

          calisanAdlari = new Array();
          calisanSatisAdetleri = new Array();
          calisanSatisFiyatlari = new Array();
          for (var i = 0; i < donut.calisanAdetVeFiyatBilgileri.length; i++) {
            calisanAdlari.push(donut.calisanAdetVeFiyatBilgileri[i]["calisan_adi_soyadi"]);
            calisanSatisAdetleri.push(donut.calisanAdetVeFiyatBilgileri[i]["urun_toplam_adedi"]);
            calisanSatisFiyatlari.push(donut.calisanAdetVeFiyatBilgileri[i]["urun_toplam_fiyati"]);
          }

          var ctx = document.getElementById("calisanAdetChart");
          var myChart = new Chart(ctx, {
            type: 'bar',
            responsive: true,
            data: {
              labels: calisanAdlari,
              datasets: [{
                label: 'Adet',
                data: calisanSatisAdetleri,
                backgroundColor: "#9ad0f5",
                borderWidth: 1
              },{
                label: 'Toplam Fiyat',
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
  /*ÇALIŞAN SATIŞ BİLGİLERİNİ GETİRME VE GRAFİĞE YÜKLEME*/

})
