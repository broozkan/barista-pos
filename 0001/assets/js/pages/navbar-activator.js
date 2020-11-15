$(document).ready(function () {
  var pageName = $("#pageName").html();
  var element = $("aside ul").find("a:contains('"+pageName+"')");
  element.css("font-weight","bold");
  element.closest("ul.ml-menu").css("display","block");
})
