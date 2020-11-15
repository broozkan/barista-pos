$(document).ready(function () {



  $(document).on("click",".btnStokUrunBilgileriDuzenle",function () {
    var urunId = $("#txtStoktanDusulecekUrunAra").attr("data-id");
    var urunAdi = $("#txtStoktanDusulecekUrunAra").val();
    var dusulecekMiktar = $("#txtStoktanDusulecekUrunMiktari").val();
    if (urunAdi == "" || dusulecekMiktar == "") {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen boşluk bırakmayınız!"
      },{
        // settings
        type: 'danger',
        z_index: '1900'

      });
      return false;
    }
    var eklenecekHtml = "<tr id="+urunId+" data-id="+dusulecekMiktar+" ><td>"+urunAdi+"</td><td>"+dusulecekMiktar+"</td><td><button class='btn btn-sm bg-red btnStokUrunBilgileriSil'><span class='zmdi zmdi-minus'></span> </button></td></tr>";
    $("#tblStokTakibiBilgileri").append(eklenecekHtml);
    $("#txtStoktanDusulecekUrunAra").val("");
    $("#txtStoktanDusulecekUrunMiktari").val("");

  })

  $(document).on("click",".btnAltUrunStokUrunBilgileriDuzenle",function () {
    var urunId = $(this).closest(".divAltUrunStokTakibiBilgileri").find("#txtAltUrunStoktanDusulecekUrunAra").attr("data-id");
    var urunAdi = $(this).closest(".divAltUrunStokTakibiBilgileri").find("#txtAltUrunStoktanDusulecekUrunAra").val();
    var dusulecekMiktar = $(this).closest(".divAltUrunStokTakibiBilgileri").find("#txtAltUrunStoktanDusulecekUrunMiktari").val();
    if (urunAdi == "" || dusulecekMiktar == "") {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen boşluk bırakmayınız!"
      },{
        // settings
        type: 'danger',
        z_index: '1900'

      });
      return false;
    }
    var eklenecekHtml = "<tr id="+urunId+" data-id="+dusulecekMiktar+" ><td>"+urunAdi+"</td><td>"+dusulecekMiktar+"</td><td><button class='btn btn-sm bg-red btnAltUrunStokUrunBilgileriSil'><span class='zmdi zmdi-minus'></span> </button></td></tr>";
    $(this).closest(".divAltUrunStokTakibiBilgileri").find(".tblAltUrunStokTakibiBilgileri").append(eklenecekHtml);
    $("#txtAltUrunStoktanDusulecekUrunAra").val("");
    $("#txtAltUrunStoktanDusulecekUrunMiktari").val("");

  })

  $(document).on("click",".btnStokUrunBilgileriSil",function () {
    $(this).closest("tr").remove();
  })

  $(document).on("click",".btnAltUrunStokUrunBilgileriSil",function () {
    $(this).closest("tr").remove();
  })




  $(document).on("click",".txtAltUrunStokTakibiYapilsinMi",function () {
    var val = $(this).val();
    if (val == 1) {
      $(this).closest(".divAltUrunDuzenle").find(".divAltUrunStokTakibiBilgileri").removeClass("d-none");
    }else {
      $(this).closest(".divAltUrunDuzenle").find(".divAltUrunStokTakibiBilgileri").addClass("d-none");
    }
  })

  $(document).on("click",".txtStokTakibiYapilsinMi",function () {
    var val = $(this).val();
    if (val == 1) {
      $(".divStokTakibiBilgileri").removeClass("d-none");
    }else {
      $(".divStokTakibiBilgileri").addClass("d-none");
    }
  })



  var click = 10;
  $(document).on("click",".btnYeniAltUrunDuzenle",function () {
    click++;
    var vergilerHtml = $("#txtUrunAlisVergiIdsi").html();

    var eklenecekHtml = '<div class="panel-body divAltUrunDuzenle">';
    eklenecekHtml += '<div class="row ">';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Kodu</label>';
    eklenecekHtml += '<div class="input-group divSuggestion">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="text" id="txtAltUrunKodu" data-tablo-index="4" data-kolon-index="6" autocomplete="off" class="form-control dataSearch txtAltUrunKodu uppercase"  placeholder="Alt Ürün kodu giriniz">';
    eklenecekHtml += '<ul class="dropdown-menu suggestion-menu inner">';
    eklenecekHtml += '</ul>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Barkodu</label>';
    eklenecekHtml += '<div class="input-group divSuggestion">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="text" id="txtAltUrunBarkodu" autocomplete="off" class="form-control txtAltUrunBarkodu"  placeholder="Alt Ürün barkodu giriniz">';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="row">';
    eklenecekHtml += '<div class="col-md-12">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Adı</label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="text" id="txtAltUrunAdi" data-tablo-index="4" data-kolon-index="5" autocomplete="off" class="form-control dataSearch txtAltUrunAdi"  placeholder="Alt Ürün adını giriniz">';
    eklenecekHtml += '<ul class="dropdown-menu suggestion-menu inner">';
    eklenecekHtml += '</ul>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="row">';
    eklenecekHtml += '<div class="col-md-4">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Adedi</label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="number" step=".01" id="txtAltUrunAdedi" autocomplete="off" class="form-control txtAltUrunAdedi"  placeholder="Alt Ürün mevcut stok adedini giriniz">';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="col-md-4">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Rengi</label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="text" id="txtAltUrunRengi" autocomplete="off" class="form-control txtAltUrunRengi"  placeholder="Alt Ürün rengini giriniz">';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="row">';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Alt Uyarı Değeri <span class="zmdi zmdi-help" data-toggle="tooltip" title="Alt Ürün, stoklarınızda bu seviyeye indiğinde uyarı alacaksınız"></span> </label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="number" step=".01" id="txtAltUrunAltUyariDegeri" autocomplete="off" class="form-control txtAltUrunAltUyariDegeri"  placeholder="Alt Ürün alt uyarı değeri giriniz">';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="row">';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Kg Fiyatı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Gramajlı satış için gereklidir."></span> </label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="number" step=".01" id="txtAltUrunKgFiyati" autocomplete="off" class="form-control txtAltUrunKgFiyati"  placeholder="Alt Ürün kg fiyati giriniz">';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="row">';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Alış Fiyatı</label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="number" step=".01" id="txtAltUrunAlisFiyati" autocomplete="off" class="form-control txtAltUrunAlisFiyati"  placeholder="Alt Ürün alış fiyatı giriniz">';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Satış Fiyatı</label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="number" step=".01" id="txtAltUrunSatisFiyati" autocomplete="off" class="form-control txtAltUrunSatisFiyati"  placeholder="Alt Ürün satış fiyatı giriniz">';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="row">';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Alış Vergisi</label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<select class="form-control show-tick ms txtAltUrunAlisVergiIdsi" name="txtAltUrunAlisVergiIdsi" id="txtAltUrunAlisVergiIdsi">';
    eklenecekHtml += vergilerHtml;
    eklenecekHtml += '</select>';
    eklenecekHtml += '<button type="button" class="btn btn-sm btn-default buttonInsideInput btnVergiDuzenle" data-toggle="modal" data-target="#modalYeniVergiDuzenle" name="button">Vergi Duzenle</button>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<label for="email_address">Alt Ürün Satış Vergisi</label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<select class="form-control show-tick ms txtAltUrunSatisVergiIdsi" name="txtAltUrunSatisVergiIdsi" id="txtAltUrunSatisVergiIdsi">';
    eklenecekHtml += vergilerHtml;
    eklenecekHtml += '</select>';
    eklenecekHtml += '<button type="button" class="btn btn-sm btn-default buttonInsideInput btnVergiDuzenle" data-toggle="modal" data-target="#modalYeniVergiDuzenle" name="button">Vergi Duzenle</button>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="row">';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<label for="email_address">Stok Takibi Yapılsın Mı? <span class="zmdi zmdi-help" data-toggle="tooltip" title="Alınan siparişlerinizle entegreli bir şekilde stok adetleriniz güncellenecektir."></span> </label>';
    eklenecekHtml += '<div class="input-group divAltUrunStokTakibiYapilsinMi">';
    eklenecekHtml += '<div class="checkbox inlineblock ">';
    eklenecekHtml += '<input type="radio" name="txtAltUrunStokTakibiYapilsinMi'+click+'" class="txtAltUrunStokTakibiYapilsinMi" value="1"> Evet';
    eklenecekHtml += '<input type="radio" name="txtAltUrunStokTakibiYapilsinMi'+click+'" class="txtAltUrunStokTakibiYapilsinMi" checked value="0"> Hayır';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="row divAltUrunStokTakibiBilgileri d-none">';
    eklenecekHtml += '<div class="col-md-3">';
    eklenecekHtml += '<label for="email_address">Stoktan Düşülecek Ürün <span class="zmdi zmdi-help" data-toggle="tooltip" title="Şu an bilgilerini girmekte olduğunuz ürün sipariş olarak girildiğinde buraya yazdığınız ürünün miktarından yan tarafa yazdığınız kadar düşülecektir."></span> </label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="text" id="txtAltUrunStoktanDusulecekUrunAra" autocomplete="off" name="txtAltUrunStoktanDusulecekUrunAra" data-tablo-index="4" data-kolon-index="5" class="form-control dataSearch"  placeholder="Ürün adı yazınız">';
    eklenecekHtml += '<ul class="dropdown-menu suggestion-menu inner stokUrunEkle">';
    eklenecekHtml += '</ul>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="col-md-2">';
    eklenecekHtml += '<label for="email_address">Düşülecek Miktar</label>';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>';
    eklenecekHtml += '<input type="text" id="txtAltUrunStoktanDusulecekUrunMiktari" autocomplete="off" name="txtAltUrunStoktanDusulecekUrunMiktari" class="form-control"  placeholder="Miktar yazınız">';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="col-md-1">';
    eklenecekHtml += '<div class="input-group">';
    eklenecekHtml += '<label for="email_address">Duzenle</label>';
    eklenecekHtml += '<button type="button" class="btn-sm btn g-bg-cgreen btnAltUrunStokUrunBilgileriDuzenle"><span class="zmdi zmdi-plus"></span> </button>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '<div class="col-md-6">';
    eklenecekHtml += '<div class="table">';
    eklenecekHtml += '<table class="tblAltUrunStokTakibiBilgileri">';
    eklenecekHtml += '<thead>';
    eklenecekHtml += '<th>Ürün Adı</th>';
    eklenecekHtml += '<th>Stok Düşüm Miktarı</th>';
    eklenecekHtml += '<th>İşlem</th>';
    eklenecekHtml += '</thead>';
    eklenecekHtml += '<tbody>';
    eklenecekHtml += '</table>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';
    eklenecekHtml += '</div>';


    $(".divAltUrunDuzenleKapsayici").append(eklenecekHtml);
  })

  $(document).on("click",".btnAltUrunSil",function () {
    var altUrunSayisi = $(".divAltUrunDuzenle").length;
    if (altUrunSayisi < 2) {

    }else {
      $(".divAltUrunDuzenle:last").remove();
    }

  })

  $("form#frmUrunDuzenle").on("submit",function (e) {
    e.preventDefault();
    var formData = new FormData();

    var stokTakibiYapilacakMi = $(".txtStokTakibiYapilsinMi:checked").val();

    if (stokTakibiYapilacakMi == 1) {
      var satirSayisi = $("#tblStokTakibiBilgileri").find("tbody tr");
      if (satirSayisi.length < 1) {
        $.notify({
          // options
          icon: 'fa fa-danger fa-2x',
          message: "Lütfen stok takibi bilgilerini giriniz!"
        },{
          // settings
          type: 'danger',
          z_index: '1900'

        });
        return false;
      }

      stokTakibiBilgileri = new Array();
      $("#tblStokTakibiBilgileri tbody tr").each(function () {
        var dusulecekStokUrunIdsi = $(this).attr("id");
        var dusulecekStokMiktari = $(this).attr("data-id");
        var dusulecekStokJson = {"txtDusulecekStokUrunIdsi":dusulecekStokUrunIdsi,"txtDusulecekStokMiktari":dusulecekStokMiktari};
        stokTakibiBilgileri.push(dusulecekStokJson);
      })

      stokTakibiBilgileri = JSON.stringify(stokTakibiBilgileri);
      formData.append("stokTakibiBilgileri",stokTakibiBilgileri);

    }else {
      formData.append("stokTakibiBilgileri",false);
    }

    var formVerileri = $("form#frmUrunDuzenle").serializeJSON();
    formVerileri["txtUrunId"] = $("#txtUrunId").val();
    var json = JSON.stringify(formVerileri);

    var dosya = document.getElementById("txtUrunGorseli");
    for (var i = 0; i < dosya.files.length; i++) {
      if(dosya.files[i] == "" || dosya.files[i] == null){

      }else {
        formData.append("dosya[]",dosya.files[i]);
      }
    }
    formData.append("urunDuzenle",json);

    var altUrunDuzenlenecekMi = $("#collapseAltUrunDuzenle").hasClass("show");
    var altUrunBilgileri;

    if ( altUrunDuzenlenecekMi ) {
      altUrunBilgileri = new Array();
      altUrunStokTakibiBilgileri = new Array();
      var altUrunIndexi = 0;
      $(".divAltUrunDuzenle").each(function () {
        var altUrunStokTakibiYapilacakMi = $(this).find(".txtAltUrunStokTakibiYapilsinMi:checked").val();

        if (altUrunStokTakibiYapilacakMi == 1) {
          var satirSayisi = $(this).find(".tblAltUrunStokTakibiBilgileri").find("tbody tr");
          if (satirSayisi.length < 1) {
            $.notify({
              // options
              icon: 'fa fa-danger fa-2x',
              message: "Lütfen stok takibi bilgilerini giriniz!"
            },{
              // settings
              type: 'danger',
              z_index: '1900'

            });
            return false;
          }

          $(this).find(".tblAltUrunStokTakibiBilgileri tbody tr").each(function () {
            var dusulecekStokUrunIdsi = $(this).attr("id");
            var dusulecekStokMiktari = $(this).attr("data-id");
            var dusulecekStokJson = {"txtDusulecekStokUrunIdsi":dusulecekStokUrunIdsi,"txtDusulecekStokMiktari":dusulecekStokMiktari,"txtAltUrunIndexi":altUrunIndexi,"txtAltUrunIdsi":dusulecekStokUrunIdsi};
            altUrunStokTakibiBilgileri.push(dusulecekStokJson);
          })


        }else {

        }

        var altUrunIdsi = $(this).find(".txtAltUrunIdsi").val();
        var altUrunKodu = $(this).find(".txtAltUrunKodu").val();
        var altUrunBarkodu = $(this).find(".txtAltUrunBarkodu").val();
        var altUrunAdi = $(this).find(".txtAltUrunAdi").val();
        var altUrunAdedi = $(this).find(".txtAltUrunAdedi").val();
        var altUrunRengi = $(this).find(".txtAltUrunRengi").val();
        var altUrunAltUyariDegeri = $(this).find(".txtAltUrunAltUyariDegeri").val();
        var altUrunKgFiyati = $(this).find(".txtAltUrunKgFiyati").val();
        var altUrunAlisFiyati = $(this).find(".txtAltUrunAlisFiyati").val();
        var altUrunSatisFiyati = $(this).find(".txtAltUrunSatisFiyati").val();
        var altUrunAlisVergiIdsi = $(this).find(".txtAltUrunAlisVergiIdsi").val();
        var altUrunSatisVergiIdsi = $(this).find(".txtAltUrunSatisVergiIdsi").val();
        var altUrunJson = {"txtAltUrunIdsi":altUrunIdsi,"txtAltUrunKodu":altUrunKodu,"txtAltUrunBarkodu":altUrunBarkodu,"txtAltUrunAdi":altUrunAdi,"txtAltUrunAdedi":altUrunAdedi,"txtAltUrunRengi":altUrunRengi,"txtAltUrunAltUyariDegeri":altUrunAltUyariDegeri,"txtAltUrunKgFiyati":altUrunKgFiyati,"txtAltUrunAlisFiyati":altUrunAlisFiyati,"txtAltUrunSatisFiyati":altUrunSatisFiyati,"txtAltUrunAlisVergiIdsi":altUrunAlisVergiIdsi,"txtAltUrunSatisVergiIdsi":altUrunSatisVergiIdsi};
        altUrunBilgileri.push(altUrunJson);
        altUrunIndexi++;
      })
      altUrunBilgileri = JSON.stringify(altUrunBilgileri);
      altUrunStokTakibiBilgileri = JSON.stringify(altUrunStokTakibiBilgileri);

      formData.append("altUrunStokTakibiBilgileri",altUrunStokTakibiBilgileri);
      formData.append("altUrunDuzenle",altUrunBilgileri);

    }else {
      formData.append("altUrunDuzenle",false);
    }

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"urun/urunDuzenle/",
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
        if (donut.yanit["yanit"] == true || donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Başarılı bir şekilde kaydedildi"
          },{
            // settings
            type: 'success',
            z_index: '1900'

          });
          $("form#frmUrunDuzenle input").val("");
          $("#collapseAltUrunDuzenle").removeClass("show");
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: donut.yanit
          },{
            // settings
            type: 'danger',
            z_index: '1900'

          });
        }
      }
    });
  })


  $("form#frmExceldenAktar").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmExceldenAktar").serializeJSON();
    var json = JSON.stringify(formVerileri);
    var formData = new FormData();
    var dosya = document.getElementById("txtExcelDosyasi");

    if(dosya.files[0] == "" || dosya.files[0] == null){
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen excel dosyası seçiniz!"
      },{
        // settings
        type: 'danger',
        z_index: '1900'
      });
      return false;
    }else {
      formData.append("dosya",dosya.files[0]);
    }
    formData.append("urunExceldenAktar",json);
    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"urun/urunExceldenAktar/",
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
        $(".btnLoading").html("AKTAR");
        $(".btnIptal").html("GERİ");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Ürünler başarılı bir şekilde aktarıldı"
          },{
            // settings
            type: 'success',
            z_index: '1900'

          });
          $("form#frmExceldenAktar input").val("");
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
