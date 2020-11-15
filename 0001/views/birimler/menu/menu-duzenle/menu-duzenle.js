$(document).ready(function () {

  $(document).on("click",".menuUrunleri li a",function () {
    var urunFiyati = 0;
    var urunIdsi = $(this).attr("data-id");

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"menu/urunFiyatiniAl/",
      data: {urunFiyatiniAl:urunIdsi},
      async: false,
      cache: false,
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        var donut = $.parseJSON(response);
        if (donut.urunFiyati) {
          urunFiyati = donut.urunFiyati;
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Ürün bilgileri alınamadı!"
          },{
            // settings
            type: 'danger'
          });
        }
      }
    });

    if (!urunIdsi) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Ürün bulunamadı. Lütfen arama sonuçlarından bir ürün seçiniz!"
      },{
        // settings
        type: 'danger'
      });
      return false;
    }
    var urunAdi = $(this).html();
    var eklenecekHtml = "<tr id='"+urunIdsi+"'>";
    eklenecekHtml += "<td><input class='form-control txtMenuUrunleriUrunAdi show-tick ms' name='txtMenuUrunleriUrunAdi[]' required type='text' readonly value='"+urunAdi+"'  /></td>";
    eklenecekHtml += "<td class='d-none'><input class='form-control txtMenuUrunleriUrunAdi show-tick ms' name='txtMenuUrunleriUrunIdsi[]' required type='hidden' readonly value='"+urunIdsi+"'  /></td>";
    eklenecekHtml += "<td><input type='number' class='form-control txtMenuUrunleriUrunAdedi show-tick ms' name='txtMenuUrunleriUrunAdedi[]' required placeholder='Ürün adedi giriniz' value='1' min='1' /></td>";
    eklenecekHtml += "<td><input type='number' class='form-control txtMenuUrunleriUrunFiyati show-tick ms' required readonly value='"+urunFiyati+"' /></td>";
    eklenecekHtml += "</tr>";

    $(".tblMenuUrunleri tbody").append(eklenecekHtml);
    $(".menuUrunleri").css("display","none");
    $("#txtMenuUrunuAra").val("");
    toplamTutariGoster();
  })
  $(document).on("input",".txtMenuUrunleriUrunAdedi",function () {
    toplamTutariGoster();
  })
  $("form#frmMenuDuzenle").on("submit",function (e) {
    e.preventDefault();
    if ($(".tblMenuUrunleri tbody tr").length < 1) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen menüye ürün ekleyiniz!"
      },{
        // settings
        type: 'danger'
      });
      return false;
    }

    var formVerileri = $("form#frmMenuDuzenle").serializeJSON();

    var json = JSON.stringify(formVerileri);

    var formData = new FormData();
    var dosya = document.getElementById("txtMenuGorselleri");
    for (var i = 0; i < dosya.files.length; i++) {
      if(dosya.files[i] == "" || dosya.files[i] == null){

      }else {
        formData.append("dosya[]",dosya.files[i]);
      }
    }
    formData.append("menuDuzenle",json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"menu/menuDuzenle/",
      xhr: function() {
           var myXhr = $.ajaxSettings.xhr();
           return myXhr;
       },
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        $(".btnIptal").html("GERİ");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Başarılı bir şekilde kaydedildi"
          },{
            // settings
            type: 'success'
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
})
function toplamTutariGoster() {
  var toplamTutar = 0;
  $(".tblMenuUrunleri tbody tr").each(function () {
    var satirTutari = parseFloat($(this).find(".txtMenuUrunleriUrunFiyati").val()) * parseFloat($(this).find(".txtMenuUrunleriUrunAdedi").val());
    toplamTutar = parseFloat(toplamTutar) + parseFloat(satirTutari);
  })
  $("#spanUrunToplamTutar").html(toplamTutar);
}
