$(document).ready(function() {
  $("span#loading").hide();
  $.getScript('../mail/jquery.serializejson.js', function()
  {

  });
  $("form#formIletisim").on("submit", function(e) {
    e.preventDefault();
    var json =JSON.stringify($("form#formIletisim").serializeJSON()) ;
    jQuery.ajax({
        type: "POST",
        url: "../mail/mail.php",
        data: {verilerIletisim:json},
        cache: false,
        error:function(){
          alert("Birim ekleme başarısız.");
        },
        beforeSend: function() {
        $("button#btnFormIletisim").find("span#mesajGonderYazi").hide();
        $("button#btnFormIletisim").find("span#loading").show();
        },
        success: function(response)
        {
          if(response == true){
            $("button#btnFormIletisim").find("span#loading").hide();
            $("button#btnFormIletisim").find("span#mesajGonderYazi").show();
            document.getElementById("formIletisim").reset();
            var div = document.createElement("div");
            div.setAttribute("class", "alert alert-success");
            div.innerHTML="<strong>Mesajınız başarıyla gönderildi. Teşekkür ederiz.";
            document.getElementById("uyari").append(div);
            $(".alert").first().hide().fadeIn();

          }else {
            $("button#btnFormIletisim").find("span#loading").hide();
            $("button#btnFormIletisim").find("span#mesajGonderYazi").show();
            document.getElementById("formIletisim").reset();
            var div = document.createElement("div");
            div.setAttribute("class", "alert alert-danger");
            div.innerHTML="<strong>Mesajınız gönderilirken bir sorun oluştu. Lütfen tekrar deneyiniz.";
            document.getElementById("uyari").append(div);
            $(".alert").first().hide().fadeIn();
          }

        }
      });
  })
})
