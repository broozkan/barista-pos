function dataYukle(offset,limit,callBack) {

  var json = {"offset":offset,"limit":limit};
  json = JSON.stringify(json);

  jQuery.ajax({
    type: "POST",
    url: ""+yolHtml+"departman/dataload",
    data: {dataLoad:json},
    cache: false,
    beforeSend: function() {
      $("#tableOverlay").css("display","block");
    },
    error:function(err){
      alert(err.responseText);
    },
    success: function(response)
    {

      $("#tableOverlay").css("display","none");

      var donut = $.parseJSON(response);
      if ( donut.sonuclar ) {
        callBack(donut);
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
}
