$(document).ready(function () {

  $(document).on("click",".stokUrunEkle li a",function () {
    var urunIdsi = $(this).attr("data-id");

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"stok/stok-urun-bilgilerini-al/",
      data: {stokUrunBilgileriniAl:urunIdsi},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("STOK ALIMINI KAYDET");

        var donut = $.parseJSON(response);
        var placeholder = $("#txtStokEklenecekUrunMiktari").attr("placeholder");
        if (donut.urunBilgileri) {
          $("#txtStokEklenecekUrunMiktari").attr("placeholder",donut.urunBilgileri["birim_adi"]+" miktarını giriniz");
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

  $(document).on("click",".btnStokUrunBilgileriEkle",function () {
    var urunId = $("#txtStokGirisiYapilacakUrunAra").attr("data-id");
    var urunAdi = $("#txtStokGirisiYapilacakUrunAra").val();
    var dusulecekMiktar = $("#txtStokEklenecekUrunMiktari").val();
    if (urunAdi == "" || dusulecekMiktar == "") {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen stoktan düşülecek ürün ve adedini boş bırakmayınız!"
      },{
        // settings
        type: 'danger',
        z_index: '1900'

      });
      return false;
    }

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"stok/stok-urun-bilgilerini-al/",
      data: {stokUrunBilgileriniAl:urunId},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("STOK ALIMINI KAYDET");

        var donut = $.parseJSON(response);

        if (donut.urunBilgileri) {
          vergiler = "";
          for (var i = 0; i < donut.vergiler.length; i++) {
            vergiler += "<option value='"+donut.vergiler[i]["id"]+"'>"+donut.vergiler[i]["vergi_adi"]+"</option>";
          }

          var eklenecekHtml = "<tr id="+urunId+" data-id="+dusulecekMiktar+" >";
          eklenecekHtml += "<td>"+urunAdi+"</td>";
          eklenecekHtml += "<td class='tdUrunMiktari'>"+dusulecekMiktar+"</td>";
          eklenecekHtml += "<td class='tdUrunBirimAlisFiyati'><input value='"+donut.urunBilgileri["urun_alis_fiyati"]+"' required  class='form-control'/></td>";
          eklenecekHtml += "<td class='tdUrunAlisVergiIdsi'><select data-id='"+donut.urunBilgileri["urun_alis_vergi_idsi"]+"' required  class='form-control ms select2 selectVergiler'> "+vergiler+" <select/></td>";
          eklenecekHtml += "<td><button class='btn btn-sm bg-red btnStokUrunBilgileriSil'><span class='zmdi zmdi-minus'></span> </button></td>";
          eklenecekHtml += "</tr>";

          $("#tblStogaEklenecekUrunler").append(eklenecekHtml);
          $("#txtStokGirisiYapilacakUrunAra").val("");
          $("#txtStokEklenecekUrunMiktari").val("");
          $(".selectVergiler").select2();
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

  $(document).on("click",".btnStokUrunBilgileriSil",function () {
    $(this).closest("tr").remove();
  })


  $("#txtOdemeNasilKaydedilsin").on("change",function () {
    var secilenDeger = $(this).val();

    $(".kayitSekilleri").addClass("d-none");
    $(".kayitSekilleri").find("input").prop("required",false);

    switch (secilenDeger) {
      case "0":
        $(".divAlisFaturasiBilgileri").removeClass("d-none");
        $("#txtAlisFaturasiCariHesapIdsi").prop("required",true);
        $("#txtAlisFaturasiFaturaKodu").prop("required",true);
        $("#txtAlisFaturasiVadeTarihi").prop("required",true);
        $("#txtAlisFaturasiIskonto").prop("required",true);
        break;
      case "1":

        $(".divOdemelereKaydet").removeClass("d-none");
        $("#txtOdemelereKaydetCariHesapIdsi").prop("required",true);
        break;
      default:

    }
  })


  $("#frmStokMalGirisiYap").on("submit",function (e) {
    e.preventDefault();


    var stokEklenecekUrunAdedi = $("#tblStogaEklenecekUrunler tbody tr").length;
    if (stokEklenecekUrunAdedi < 1) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen mal girişi yapılacak ürün(leri) seçiniz!"
      },{
        // settings
        type: 'danger',
        z_index:7777
      });
      return false;
    }


    var formVerileri = $("#frmStokMalGirisiYap").serializeJSON();
    var stogaEklenecekUrunler = new Array();
    $("#tblStogaEklenecekUrunler tbody tr").each(function () {
      var urunId = $(this).closest("tr").attr("id");
      var urunAdedi = $(this).closest("tr").find(".tdUrunMiktari").html();
      var urunBirimAlisFiyati = $(this).closest("tr").find(".tdUrunBirimAlisFiyati").find("input").val();
      var urunAlisVergiIdsi = $(this).closest("tr").find(".tdUrunAlisVergiIdsi").find("option:selected").val();
      var json = {"txtUrunId":urunId,"txtUrunAdedi":urunAdedi,"txtUrunBirimAlisFiyati":urunBirimAlisFiyati,"txtUrunAlisVergiIdsi":urunAlisVergiIdsi};
      stogaEklenecekUrunler.push(json);
    })
    formVerileri["stogaEklenecekUrunler"] = stogaEklenecekUrunler;

    switch (formVerileri["txtOdemeNasilKaydedilsin"]) {
      case "0":
        formVerileri["txtAlisFaturasiCariHesapIdsi"] = $("#txtAlisFaturasiCariHesapIdsi").attr("data-id");
        break;
      case "1":
        formVerileri["txtOdemelereKaydetCariHesapIdsi"] = $("#txtOdemelereKaydetCariHesapIdsi").attr("data-id");
        break;
      case "2":
        //SADECE STOK DEĞİŞECEK
        break;
      default:

    }
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"stok/stok-mal-girisi-yap/",
      data: {stokMalGirisiYap:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("STOK ALIMINI KAYDET");

        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true || donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Stok alımı başarılı bir şekilde gerçekleştirildi."
          },{
            // settings
            type: 'success',
            z_index:7777
          });
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


  // $("form#frmMalGirisiYapilacaklaraEkle").on("submit",function (e) {
  //   e.preventDefault();
  //   var formVerileri = $("#frmMalGirisiYapilacaklaraEkle").serializeJSON();
  //   formVerileri["txtCariId"] = $("#txtCariAdi").attr("data-id");
  //   formVerileri["txtUrunId"] = $("#txtUrunId").val();
  //   var araToplam = parseFloat(formVerileri["txtUrunAlisFiyati"]) * parseFloat(formVerileri["txtUrunAlisMiktari"]);
  //   var eklenecekHtml = "<tr>";
  //   eklenecekHtml += '<td class="tdCariAdi" data-id="'+formVerileri["txtCariId"]+'">'+formVerileri["txtCariAdi"]+'</td>';
  //   eklenecekHtml += '<td>'+formVerileri["txtUrunKodu"]+'</td>';
  //   eklenecekHtml += '<td class="tdUrunAdi" data-id="'+formVerileri["txtUrunId"]+'" >'+formVerileri["txtUrunAdi"]+'</td>';
  //   eklenecekHtml += '<td class="tdUrunAlisMiktari">'+formVerileri["txtUrunAlisMiktari"]+'</td>';
  //   eklenecekHtml += '<td>'+formVerileri["txtUrunBirimi"]+'</td>';
  //   eklenecekHtml += '<td class="tdAraToplam">'+araToplam+'</td>';
  //   eklenecekHtml += '<td><button type="button" class="btn bg-red btn-sm btnMalGirisiYapilacaklarSil" name="button"><span class="zmdi zmdi-close"></span></button></td>';
  //   eklenecekHtml += '</tr>';
  //
  //   $("#tblMalGirisiYapilacaklar tbody").append(eklenecekHtml);
  //   $('#modalMalGirisiYapilacaklaraEkle').modal('hide');
  //   $.notify({
  //     // options
  //     icon: 'fa fa-danger fa-2x',
  //     message: "Mal girişi yapılacaklar listesine eklendi!"
  //   },{
  //     // settings
  //     type: 'success',
  //     z_index:7777
  //   });
  //
  // })


  // $("#btnStokAliminiKaydet").on("click",function () {
  //   var malGirisiYapilacakUrunSayisi = $("#tblMalGirisiYapilacaklar tbody tr").length;
  //   if (malGirisiYapilacakUrunSayisi < 1) {
  //     $.notify({
  //       // options
  //       icon: 'fa fa-danger fa-2x',
  //       message: "Lütfen mal girişi yapılacak ürün(leri) seçiniz!"
  //     },{
  //       // settings
  //       type: 'danger',
  //       z_index:7777
  //     });
  //   }else {
  //     malGirisiYapilacakUrunler = new Array();
  //     $("#tblMalGirisiYapilacaklar tbody tr").each(function () {
  //       var cariId = $(this).find(".tdCariAdi").attr("data-id");
  //       var urunId = $(this).find(".tdUrunAdi").attr("data-id");
  //       var urunAdedi = $(this).find(".tdUrunAlisMiktari").html();
  //       var araToplam = $(this).find(".tdAraToplam").html();
  //       var json = {"txtCariId":cariId,"txtUrunId":urunId,"txtUrunAdedi":urunAdedi,"txtAraToplam":araToplam};
  //       malGirisiYapilacakUrunler.push(json);
  //     })
  //     malGirisiYapilacakUrunler = JSON.stringify(malGirisiYapilacakUrunler);
  //
  //     jQuery.ajax({
  //       type: "POST",
  //       url: ""+yolHtml+"stok/stok-mal-girisi-yap/",
  //       data: {stokMalGirisiYap:json},
  //       cache: false,
  //       beforeSend: function() {
  //         $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
  //       },
  //       error:function(err){
  //         alert(err.responseText);
  //       },
  //       success: function(response)
  //       {
  //         $(".btnLoading").html("STOK ALIMINI KAYDET");
  //
  //         var donut = $.parseJSON(response);
  //         if (donut.yanit["yanit"]) {
  //           $.notify({
  //             // options
  //             icon: 'fa fa-danger fa-2x',
  //             message: "Stok alımı başarılı bir şekilde gerçekleştirildi. Alış faturası olarak kaydedildi"
  //           },{
  //             // settings
  //             type: 'success',
  //             z_index:7777
  //           });
  //         }else {
  //           $.notify({
  //             // options
  //             icon: 'fa fa-danger fa-2x',
  //             message: donut.yanit
  //           },{
  //             // settings
  //             type: 'danger',
  //             z_index:7777
  //           });
  //         }
  //       }
  //     });
  //   }
  // })

  // $(document).on("click",".btnMalGirisiYapilacaklarSil",function () {
  //   $(this).closest("tr").remove();
  // })

  // $(document).on("click",".btnMalGirisiYapilacaklaraEkle",function (e) {
  //   e.preventDefault();
  //
  //   var urunId = $(this).closest("tr").attr("id");
  //   jQuery.ajax({
  //     type: "POST",
  //     url: ""+yolHtml+"stok/stok-urun-bilgilerini-al/",
  //     data: {stokUrunBilgileriniAl:urunId},
  //     cache: false,
  //     beforeSend: function() {
  //       // $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
  //     },
  //     error:function(err){
  //       alert(err.responseText);
  //     },
  //     success: function(response)
  //     {
  //       var donut = $.parseJSON(response);
  //       if (donut.urunBilgileri) {
  //         $('#modalMalGirisiYapilacaklaraEkle').modal('show');
  //         $("#txtUrunId").val(donut.urunBilgileri["id"]);
  //         $("#txtUrunAdi").val(donut.urunBilgileri["urun_adi"]);
  //         $("#txtUrunAlisFiyati").val(donut.urunBilgileri["urun_alis_fiyati"]);
  //         $("#txtUrunBirimi").val(donut.urunBilgileri["urun_birimi"]);
  //         $("#txtUrunKodu").val(donut.urunBilgileri["urun_kodu"]);
  //       }else {
  //         $.notify({
  //           // options
  //           icon: 'fa fa-danger fa-2x',
  //           message: donut.yanit
  //         },{
  //           // settings
  //           type: 'danger',
  //           z_index:7777
  //         });
  //       }
  //     }
  //   });
  // })
})
