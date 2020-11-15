$(document).ready(function () {

  /*CKEDITOR YÜKLEME KODLARI*/
  let editor;

  ClassicEditor
  .create( document.querySelector( '#ckeditor' ) )
  .then( newEditor => {
    editor = newEditor;
  } )
  .catch( error => {
    console.error( error );
  } );
  /*CKEDITOR YÜKLEME KODLARI*/


  /*GERİ BİLDİRİM GÖNDERME KODLARI*/
  $("#frmGeriBildirim").on("submit",function (e) {
    e.preventDefault();

    var formVerileri = $("#frmGeriBildirim").serializeJSON();
    formVerileri["txtMesaj"] = editor.getData();
    var json = JSON.stringify(formVerileri);

    jQuery.ajax({
      type: "POST",
      url: ""+yolHtml+"baristapos/geri-bildirim-gonder/",
      data: {geriBildirimGonder:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoading").html("<img src='"+yolHtml+"assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoading").html("GÖNDER");
        var donut = $.parseJSON(response);
        if (donut.yanit == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Geri bildiriminiz için teşekkür ederiz"
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
  /*GERİ BİLDİRİM GÖNDERME KODLARI*/

})
