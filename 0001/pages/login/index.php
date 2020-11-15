<?php require $_SERVER["DOCUMENT_ROOT"]."/settings/config.php"; ?>
<?php
if (@$_SESSION["login"]) {
  session_destroy();
}
?>
<!doctype html>
<html class="no-js " lang="tr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

  <title>Smart Process</title>
  <!-- Favicon-->
  <link rel="icon" href="<?php echo $this->yolHtml ?>favicon.ico" type="image/x-icon">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?php echo $this->yolHtml ?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $this->yolHtml ?>assets/css/main.css">
  <link rel="stylesheet" href="<?php echo $this->yolHtml ?>assets/css/authentication.css">
  <link rel="stylesheet" href="<?php echo $this->yolHtml ?>assets/css/color_skins.css">
</head>

<body class="theme-purple authentication sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">
      <div class="navbar-translate n_logo">
        <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank">Smart Process</a>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="page-header">
    <div class="page-header-image" style="background-image:url(<?php echo $this->yolHtml ?>assets/images/factory.jpg)"></div>
    <div class="container">
      <div class="col-md-12 content-center">
        <div class="card-plain">
          <form class="form" id="frmLogin" method="post" action="">
            <div class="header">
              <div class="logo-container">
                <img src="https://thememakker.com/templates/oreo/html/assets/images/logo.svg" alt="">
              </div>
              <h5>Giriş Yap</h5>
            </div>
            <div class="content">
              <div class="input-group input-lg">
                <input type="text" name="txtKullaniciAdi" class="form-control" placeholder="Kullanıcı Adı">
                <span class="input-group-addon">
                  <i class="zmdi zmdi-account-circle"></i>
                </span>
              </div>
              <div class="input-group input-lg">
                <input type="password" name="txtParola" placeholder="Parola" class="form-control" />
                <span class="input-group-addon">
                  <i class="zmdi zmdi-lock"></i>
                </span>
              </div>
            </div>
            <div class="footer text-center">
              <button type="submit" class="btn btn-primary btn-round btn-lg btn-block btnLoading">GİRİŞ YAP</button>
              <h5><a href="forgot-password.html" class="link">Parolanızı mı unuttunuz?</a></h5>
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
  <?php require $GLOBALS["yolPhp"].'arayuz/script.php'; ?>

  <script src="login.js"></script>
  <script>
  //=============================================================================
  $('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
  }).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
  });
</script>
</body>

</html>
