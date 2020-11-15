$(document).ready(function () {

  /*BİRİM EKLEME*/
  $("form#frmModalYeniBirimEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniBirimEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"birim/birimEkle/",
      data: {birimEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Birim başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtBirimAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniBirimEkle").find("input").val("");
          $("form#frmModalYeniBirimEkle").find(".btnIptal").trigger("click");
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
  /*BİRİM EKLEME*/

  /*ÇALIŞAN EKLEME*/
  $("form#frmModalYeniCalisanEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniCalisanEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"calisan/calisanEkle/",
      data: {calisanEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Müşteri başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtCalisanAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniCalisanEkle").find("input").val("");
          $("form#frmModalYeniCalisanEkle").find(".btnIptal").trigger("click");
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
  /*ÇALIŞAN EKLEME*/

  /*CARİ EKLEME*/
  $("form#frmModalYeniCariEkle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmModalYeniCariEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"cari/cariEkle/",
      data: {cariEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Cari hesap başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          $("form#frmModalYeniCariEkle").find("input").val("");
          $("form#frmModalYeniCariEkle").find(".btnIptal").trigger("click");
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
  /*CARİ EKLEME*/

  /*DEPO EKLEME*/
  $("form#frmModalYeniDepoEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniDepoEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"depo/depoEkle/",
      data: {depoEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Depo başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtDepoAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniDepoEkle").find("input").val("");
          $("form#frmModalYeniDepoEkle").find(".btnIptal").trigger("click");
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
  /*DEPO EKLEME*/

  /*DEPARTMAN EKLEME*/
  $("form#frmModalYeniDepartmanEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniDepartmanEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"departman/departmanEkle/",
      data: {departmanEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Kategori başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtDepartmanAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniDepartmanEkle").find("input").val("");
          $("form#frmModalYeniDepartmanEkle").find(".btnIptal").trigger("click");
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
  /*DEPARTMAN EKLEME*/

  /*KASA EKLEME*/
  $("form#frmModalYeniKasaEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniKasaEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"kasa/kasaEkle/",
      data: {kasaEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Müşteri başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtKasaAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniKasaEkle").find("input").val("");
          $("form#frmModalYeniKasaEkle").find(".btnIptal").trigger("click");
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
  /*KASA EKLEME*/

  /*KATEGORİ EKLEME*/
  $("form#frmModalYeniKategoriEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniKategoriEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"kategori/kategoriEkle/",
      data: {kategoriEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Kategori başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtKategoriAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniKategoriEkle").find("input").val("");
          $("form#frmModalYeniKategoriEkle").find(".btnIptal").trigger("click");
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
  /*KATEGORİ EKLEME*/

  /*KUR EKLEME*/
  $("form#frmModalYeniKurEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniKurEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"kur/kurEkle/",
      data: {kurEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Kur başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtKurAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniKurEkle").find("input").val("");
          $("form#frmModalYeniKurEkle").find(".btnIptal").trigger("click");
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
  /*KUR EKLEME*/

  /*LOKASYON EKLEME*/
  $("form#frmModalYeniLokasyonEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniLokasyonEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"lokasyon/lokasyonEkle/",
      data: {lokasyonEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Lokasyon başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtLokasyonAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniLokasyonEkle").find("input").val("");
          $("form#frmModalYeniLokasyonEkle").find(".btnIptal").trigger("click");
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
  /*LOKASYON EKLEME*/

  /*MÜŞTERİ EKLEME*/
  $("form#frmModalYeniMusteriEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniMusteriEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"musteri/musteriEkle/",
      data: {musteriEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true || donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Müşteri başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtMusteriAdiSoyadi"]
          };
          var newOption = new Option(data.text, data.id, true, true);
          $("#txtMusteriAdi").attr("data-id",data.id);
          $("#txtMusteriAdi").val(data.text);
          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniMusteriEkle").find("input").val("");
          $("form#frmModalYeniMusteriEkle").find(".btnIptal").trigger("click");
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
  /*MÜŞTERİ EKLEME*/

  /*MUTFAK EKLEME*/
  $("form#frmModalYeniMutfakEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniMutfakEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"mutfak/mutfakEkle/",
      data: {mutfakEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Mutfak başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtMutfakAdi"]
          };
          var o = new Option(data.text, data.id);
          /// jquerify the DOM object 'o' so we can use the html method
          $(o).html(data.text);
          $("#txtUrunMutfakIdleri").append(o);

          $("form#frmModalYeniMutfakEkle").find("input").val("");
          $("form#frmModalYeniMutfakEkle").find(".btnIptal").trigger("click");
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
  /*MUTFAK EKLEME*/

  /*TESLİM DURUMU EKLEME*/
  $("form#frmModalYeniTeslimDurumuEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniTeslimDurumuEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"teslim-durum/teslim-durumu-ekle/",
      data: {teslimDurumuEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Kur başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtKurAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniTeslimDurumuEkle").find("input").val("");
          $("form#frmModalYeniTeslimDurumuEkle").find(".btnIptal").trigger("click");
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
  /*TESLİM DURUMU EKLEME*/

  /*VERGİ EKLEME*/
  $("form#frmModalYeniVergiEkle").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("form#frmModalYeniVergiEkle").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"vergi/vergiEkle/",
      data: {vergiEkle:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("KAYDET");
        var donut = $.parseJSON(response);
        if (donut.yanit["yanit"] == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Vergi başarılı bir şekilde eklendi"
          },{
            // settings
            type: 'success',
            z_index:7777
          });
          var data = {
            id: donut.yanit["lastId"],
            text: formVerileri["txtVergiAdi"]
          };
          var newOption = new Option(data.text, data.id, true, true);

          $('select.select2').append(newOption).trigger('change');

          $("form#frmModalYeniVergiEkle").find("input").val("");
          $("form#frmModalYeniVergiEkle").find(".btnIptal").trigger("click");
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
  /*VERGİ EKLEME*/

})
