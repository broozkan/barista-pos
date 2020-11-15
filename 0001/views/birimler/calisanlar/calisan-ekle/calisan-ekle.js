$(document).ready(function () {
  $("#cboxTumYetkiler").on("click",function () {
    if ($(this).is(":checked")) {
      $("#frmStatuEkle").find("input[type=checkbox]").prop("checked",true);
    }else {
      $("#frmStatuEkle").find("input[type=checkbox]").prop("checked",false);
    }
  })

  $("form#frmCalisanEkle").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("form#frmCalisanEkle").serializeJSON();
    var hizliNotlar = new Array();
    $("span.tag").each(function () {
      var not = $(this).text();
      hizliNotlar.push(not);
    })
    formVerileri["txtCalisanHizliNotlari"] = hizliNotlar;
    var json = JSON.stringify(formVerileri);

    var formData = new FormData();
    var dosya = document.getElementById("txtCalisanProfilFotosu");
    if(dosya.files[0] == "" || dosya.files[0] == null){

    }else {
      formData.append("dosya",dosya.files[0]);
    }

    formData.append("calisanEkle",json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"calisan/calisanEkle/",
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
          $("form#frmCalisanEkle input").val("");
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
