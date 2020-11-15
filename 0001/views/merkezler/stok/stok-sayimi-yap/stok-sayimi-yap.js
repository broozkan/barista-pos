$(document).ready(function () {

  $(document).on("click",".btnStokAdediKaydet",function (e) {
    e.preventDefault();
    var stokUrunId = $(this).closest("tr").attr("id");
    var stokUrunAdedi = $(this).closest("tr").find("input.txtStokUrunAdedi").val();
    if (stokUrunAdedi == null || stokUrunAdedi == "") {
      $.notify({
        // options
        icon: 'fa fa-warning fa-2x',
        message: "Lütfen stok adedini boş bırakmayınız. Eğer stokta yoksa 0 giriniz!"
      },{
        // settings
        type: 'danger',
        z_index:7777
      });
      return false;
    }

    var json = {"txtStokUrunId":stokUrunId,"txtStokUrunAdedi":stokUrunAdedi};
    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"stok/stok-sayimi-yap/",
      data: {stokSayimiYap:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("<i class='zmdi zmdi-save'></i>");
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Stok adedi başarılı bir şekilde güncellendi"
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


})


function verileriPaylas(json) {
  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"urun/dataShare/",
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
  window.location.replace("/urun/urun-duzenle/"+json);
}
function topluSil(json) {
  onayla("Emin misiniz?",function callBack(onay) {
    if (onay == true) {
      jQuery.ajax({
        type: "POST",
        url: ""+yolHtml+"urun/urunSil/",
        data: {urunSil:json},
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
