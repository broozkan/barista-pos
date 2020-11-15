$(document).ready(function () {


})



function verileriPaylas(json) {
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"kategori/dataShare/",
    data: {dataShare:json},
    cache: false,
    beforeSend: function() {
      $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
    },
    error:function(err){
      alert(err.responseText);
    },
    success: function(response)
    {
      $(".btnLoading").html("PAYLAŞ");
      var donut = $.parseJSON(response);
      if (donut.yanit == true) {

        $.notify({
          // options
          icon: 'fa fa-warning fa-2x',
          message: "Dosya başarılı bir şekilde paylaşıldı"
        },{
          // settings
          type: 'success',
          z_index:7777
        });
        if (donut.epostaAdresiOlmayanlar.length > 0) {
          var exception = "";
          for (var i = 0; i < donut.epostaAdresiOlmayanlar.length; i++) {
            exception += "</br>"+donut.epostaAdresiOlmayanlar[i];
          }
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "E-posta adresi kayıtlı olmadığı için başarısız olanlar : "+exception
          },{
            // settings
            type: 'danger',
            z_index:7777
          });
        }
        if (donut.cboxIndir != false) {
          $('a#aIndir').attr({href:'/documents/'+donut.cboxIndir+''});
          jQuery('a#aIndir')[0].click();
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
}

function topluDuzenle(json) {
  window.location.replace("/kategori/kategori-duzenle/"+json);
}
function topluSil(json) {
  onayla("Emin misiniz?",function callBack(onay) {
    if (onay == true) {
      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"kategori/kategoriSil/",
        data: {kategoriSil:json},
        cache: false,
        error:function(err){
          alert(err.responseText);
        },
        success: function(response)
        {
          var donut = $.parseJSON(response);
          if (donut.yanit == true) {
            $.notify({
              // options
              icon: 'fa fa-warning fa-2x',
              message: "Başarılı bir şekilde silindi"
            },{
              // settings
              type: 'success'
            });
            $("table tr input[type=checkbox]:checked").closest("tr").fadeOut();
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
    }else {
      $("table tr input[type=checkbox]").prop("checked",false);
    }
  });
}
