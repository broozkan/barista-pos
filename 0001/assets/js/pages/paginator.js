$(document).ready(function () {
  $("li.page-item").on("click",function () {
    var tiklananSayfaNumarasi = $(this).find("a").attr("id");
    var aktifSayfaNumarasi = getUrlParameter("p");
    if (!aktifSayfaNumarasi) {
      aktifSayfaNumarasi = 1;
      newUrl = window.location+"?p="+tiklananSayfaNumarasi;
    }else {
      var newUrl = location.href.replace("p="+aktifSayfaNumarasi, "p="+tiklananSayfaNumarasi);
    }
    window.location.href = newUrl;
  })
})
function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
