$(document).ready(function () {

  $(document).on('click', '.btnSil', function(){
    var satir = $(this).closest("tr");
    satir.find("input[type=checkbox]").prop("checked",true);
    var cboxSayisi = $("table tr input[type=checkbox]:checked").length;
    var formVerileri = Array();
    for (var i = 0; i < cboxSayisi; i++) {
      var id = satir.attr("id");
      var json = {"id":id};
      formVerileri.push(json)
    }
    json = JSON.stringify(formVerileri);
    topluSil(json);

  })
  $(document).on('click', '.btnTopluSil', function(){
    var cboxSayisi = $("table tr input[type=checkbox]:checked").length;
    if (cboxSayisi > 0) {
      var formVerileri = Array();
      $("table tr input[type=checkbox]:checked").each(function () {
        var id = $(this).closest("tr").attr("id");
        var json = {"id":id};
        formVerileri.push(json)
      })
      json = JSON.stringify(formVerileri);
      topluSil(json);
    }else {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen silinecek satırları işaretleyiniz"
      },{
        // settings
        type: 'danger'
      });
    }
  })

  $(".btnVerilerinTumunuSec").on("click",function () {
    swal("Çok fazla veriniz varsa verilerin tamamını seçmek tarayıcınızın çökmesine sebep olabilir!");
    $("#txtPaylasilacakVeriMiktari").val("000-999");
  })

  $("form#frmPaylas").on("submit",function (e) {
    e.preventDefault();
    var thead = Array();
    $("table thead tr th").each(function () {
      if (!$(this).hasClass("thLast")) {
        thead.push($(this).html());
      }
    })
    var formVerileri = $("form#frmPaylas").serializeJSON();
    var json = JSON.stringify(formVerileri);
    formVerileri = $.parseJSON(json);
    formVerileri["thead"] = thead;
    if ($(this).find("input[type=checkbox]:checked").length == 0) {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen bir işlem işaretleyiniz!"
      },{
        // settings
        type: 'danger',
        z_index: 7777
      });
      return false;
    }else {
      if ($("#cboxEpostaGonder").is(":checked") == true) {
        if ($("ul#epostaGonderilecekKisiler").html() == 0) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Lütfen eposta gönderilecek kişileri ekleyiniz"
          },{
            // settings
            type: 'danger',
            z_index: 7777
          });
          return false;
        }else {
          var epostaGonderilecekKisiIdleri = Array();
          for (var i = 0; i < $(".liEpostaGonderilecekKisiler").length; i++) {
            epostaGonderilecekKisiIdleri.push($(".liEpostaGonderilecekKisiler:eq("+i+")").find("button").attr("data-id"));
          }
          formVerileri["epostaGonderilecekKisiIdleri"] = epostaGonderilecekKisiIdleri;

        }
      }
    }

    json = JSON.stringify(formVerileri);
    verileriPaylas(json);
  })

  $(document).on('click','.btnTopluDuzenle',function () {
    var cboxSayisi = $("table tr input[type=checkbox]:checked").length;
    if (cboxSayisi > 0) {
      var url = "";
      $("table tr input[type=checkbox]:checked").each(function () {
        var departmanId = $(this).closest("tr").attr("id");
        url = url+departmanId+",";
      })
      topluDuzenle(url);
    }else {
      $.notify({
        // options
        icon: 'fa fa-danger fa-2x',
        message: "Lütfen düzenlenecek satırları işaretleyiniz"
      },{
        // settings
        type: 'danger'
      });
    }
  })

  $("#cboxEpostaGonder").on("change",function () {
    if ($(this).is(":checked") == true) {
      $(".divEpostaGonderilecekKisi").css("display","block");
    }else {
      $(".divEpostaGonderilecekKisi").css("display","none");
    }
  })

  $(document).on("click",".liEpostaGonderilecekKisiler span",function () {
    $(this).closest("li").remove();
  })
  $(document).on("click",".ePostaKisiEkle li",function () {
    var val = $(this).find("a").html();
    var id = $(this).find("a").attr("data-id");
    var eklenecekHtml = "<li class='liEpostaGonderilecekKisiler'><button data-id='"+id+"' type='button' class='btn btn-default btn-sm' name='button'>"+val+" <span class='zmdi zmdi-close'></span> </button> </li>";
    $("ul#epostaGonderilecekKisiler").append(eklenecekHtml);
    $(this).closest("ul.suggestion-menu").hide();
    $("#txtPaylasilacakEpostaAdresi").val("");
  })
  $(document).on("click",".stokUrunEkle li",function () {
    var val = $(this).find("a").html();
    var id = $(this).find("a").attr("data-id");

    $(this).closest("div").find("input[type=text]").val(val);
    $(this).closest("div").find("input[type=text]").attr("data-id",id);
    $(this).closest("ul.suggestion-menu").hide();

  })
  $(document).on("click",".cariHesapEkle li",function () {
    var val = $(this).find("a").html();
    var id = $(this).find("a").attr("data-id");

    $(this).closest("div").find("input[type=text]").val(val);
    $(this).closest("div").find("input[type=text]").attr("data-id",id);
    $(this).closest("ul.suggestion-menu").hide();

  })

  $(".btnFiltreToggle").on("click",function () {
    $(".rowFiltreSecenekleri").toggleClass("d-none");
  })





})
