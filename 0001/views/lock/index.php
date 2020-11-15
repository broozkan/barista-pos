<!doctype html>
<html class="no-js " lang="tr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

  <title>Barista Pos</title>
  <!-- Favicon-->
  <link rel="icon" href="<?php echo $this->yolHtml ?>favicon.ico" type="image/x-icon">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?php echo $this->yolHtml ?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $this->yolHtml ?>assets/css/main.css">
  <link rel="stylesheet" href="<?php echo $this->yolHtml ?>assets/css/authentication.css">
  <link rel="stylesheet" href="<?php echo $this->yolHtml ?>assets/css/color_skins.css">
  <style media="screen">
  
  </style>
</head>

<body class="theme-purple authentication sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">
      <div class="navbar-translate n_logo">
        <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank">Barista Pos</a>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="page-header">
    <div class="page-header-image" style="background-image:url(<?php echo $this->yolHtml; ?>assets/images/coffeeshop.jpg)"></div>
    <div class="container mx-0" style="max-width:100%">
      <div class="col-md-12 col-xs-12 content-center" style="max-width:100%">
        <div class="card-plain">
          <form class="form" id="frmLock" method="post" action="">
            <div class="header">
              <div class="logo-container">
                <!-- <img src="<?php echo $this->yolHtml; ?>assets/images/logo.png" alt=""> -->
              </div>
              <span class="zmdi zmdi-lock zmdi-hc-5x"></span>
              <div class="flexContainer">
                <input type="password" class="form-control show-tick ms txtPin" autofocus maxlength="4" size="4" required placeholder="****" name="txtPin" value="">
                <button type="button" class="btn bg-red btnDelete m-0" name="button"><span class="zmdi zmdi-close"></span> </button>
              </div>
            </div>
            <div class="content numpad">
              <div class="row">
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">1</button>
                </div>
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">2</button>
                </div>
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">3</button>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">4</button>
                </div>
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">5</button>
                </div>
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">6</button>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">7</button>
                </div>
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">8</button>
                </div>
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">9</button>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <!-- <button type="button" class="btn btn-default" name="button"><span class="zmdi zmdi-arrow-left"></span> </button> -->

                </div>
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <button type="button" class="btn btn-default btnTusTakimi" name="button">0</button>
                </div>
                <div class="col-lg-4 col-sm-4 divNumpad">
                  <!-- <button type="button" class="btn btn-default" name="button"><span class="zmdi zmdi-close"></span> </button> -->

                </div>
              </div>
            </div>
            <div class="footer text-center">
              <button type="submit" class="btn g-bg-soundcloud btn-round btn-lg btn-block btnLoading">GİRİŞ YAP</button>
              <h5><a href="forgot-password.html" class="link">Parolanızı mı unuttunuz?</a></h5>
            </div>
          </form>
        </div>
      </div>
        <!-- <img src="<?php echo $this->yolHtml; ?>assets/images/logo.png" class="img img-responsive float-right" alt=""> -->
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
  <?php require $this->yolPhp.'arayuz/script.php'; ?>

  <script src="<?php echo $this->yolHtml; ?>views/lock/lock.js"></script>
</body>

</html>
