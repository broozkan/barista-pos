<!doctype html>
<html class="no-js " lang="tr">
<?php require $this->yolPhp."/arayuz/head.php"; ?>

<body class="theme-purple authentication sidebar-collapse">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank">Barista Pos</a>
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="page-header">
    <div class="page-header-image" style="background-image:url(<?php echo $this->yolHtml; ?>assets/images/login.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="" action="#">
                    <div class="header">
                        <div class="logo-container">
                            <img src="https://thememakker.com/templates/oreo/html/assets/images/logo.svg" alt="">
                        </div>
                        <h5>Hata 404!</h5>
                        <span>Sayfa Bulunamadı</span>
                    </div>
                    <div class="footer text-center">
                        <a href="<?php echo $this->yolHtml; ?>" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">ANASAYFAYA DÖN</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
      <div class="container">
        <nav>
          <ul>
            <li><a href="javascript:void(0);" target="_blank">İLETİŞİM</a></li>
            <li><a href="javascript:void(0);" target="_blank">HAKKINDA</a></li>
            <li><a href="javascript:void(0);" target="_blank">GİZLİLİK POLİTİKASI</a></li>
            <li><a href="javascript:void(0);" target="_blank">LİSANS KOŞULLARI</a></li>
            <li><a href="javascript:void(0);">SSS</a></li>
          </ul>
        </nav>
        <div class="copyright">
          &copy;
          2019
          <span>BROSOFT YAZILIM</span>
        </div>
      </div>
    </footer>

</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
</script>
</body>

</html>
