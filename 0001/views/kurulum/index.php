<!doctype html>
<html class="no-js " lang="tr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

  <title>Barista Pos</title>
  <!-- Favicon-->
  <link rel="icon" href="<?php echo $this->yolHtml; ?>favicon.ico" type="image/x-icon">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?php echo $this->yolHtml; ?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $this->yolHtml; ?>assets/css/main.css">
  <link rel="stylesheet" href="<?php echo $this->yolHtml; ?>assets/css/authentication.css">
  <link rel="stylesheet" href="<?php echo $this->yolHtml; ?>assets/css/color_skins.css">
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
    <div class="page-header-image" style="background-image:url(<?php echo $this->yolHtml; ?>assets/images/factory.jpg)"></div>
    <div class="container">
      <form class="form" id="frmKurulum" method="post" action="">
        <div class="row">
          <div class="col-md-12">
            <div class="card-plain">
              <div class="header">
                <div class="logo-container">
                  <img src="https://thememakker.com/templates/oreo/html/assets/images/logo.svg" alt="">
                </div>
                <h5>Kurulum</h5>
                <span>Brosoft Barista Pos Kurulum Ekranı </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card-plain">
              <div class="content">
                <div class="input-group">
                  <input type="text" required required class="form-control" name="txtVeritabaniYolu" placeholder="Veritabanı Yolu">
                  <span class="input-group-addon">
                    <i class="zmdi zmdi-folder-outline"></i>
                  </span>
                </div>
                <div class="input-group">
                  <input type="text" required required class="form-control" name="txtVeritabaniKullaniciAdi" placeholder="Veritabanı Kullanıcı Adı">
                  <span class="input-group-addon">
                    <i class="zmdi zmdi-account"></i>
                  </span>
                </div>

                <div class="input-group">
                  <input type="password" name="txtVeritabaniParola" placeholder="Veritabanı Parola" class="form-control" />
                  <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                  </span>
                </div>
              </div>
              <div class="input-group">
                <input type="text" required required name="txtVeritabaniAdi" class="form-control" placeholder="Veritabanı Adı">
                <span class="input-group-addon">
                  <i class="zmdi zmdi-chart"></i>
                </span>
              </div>
              <div class="input-group">
                <input type="text" required required name="txtKokDizin" class="form-control" placeholder="Kök Dizin">
                <span class="input-group-addon">
                  <i class="zmdi zmdi-folder"></i>
                </span>
              </div>
              <div class="input-group">
                <input type="text" required required name="txtVersiyonNo" class="form-control" placeholder="Versiyon No">
                <span class="input-group-addon">
                  <i class="zmdi zmdi-folder"></i>
                </span>
              </div>

            </div>
          </div>
          <div class="col-md-6">
            <div class="card-plain">
              <div class="content">
                <div class="input-group">
                  <input type="text" required name="txtSirketAdi" class="form-control" placeholder="Şirket Adı">
                  <span class="input-group-addon">
                    <i class="zmdi zmdi-bookmark"></i>
                  </span>
                </div>
                <div class="input-group">
                  <input type="text" required name="txtSirketAdresi" class="form-control" placeholder="Şirket Adresi">
                  <span class="input-group-addon">
                    <i class="zmdi zmdi-bookmark"></i>
                  </span>
                </div>
                <div class="input-group">
                  <input type="text" required name="txtSirketTelefonNumarasi" class="form-control mobile-phone-number" placeholder="+00 (000) 000-00-00">
                  <span class="input-group-addon">
                    <i class="zmdi zmdi-bookmark"></i>
                  </span>
                </div>
                <div class="input-group">
                  <input type="text" required name="txtSirketEpostaAdresi" class="form-control email" placeholder="eposta@eposta.com">
                  <span class="input-group-addon">
                    <i class="zmdi zmdi-bookmark"></i>
                  </span>
                </div>
                <div class="input-group">
                  <input type="number" required name="txtSirketVergiNumarasi" class="form-control" placeholder="Şirket Vergi Numarası">
                  <span class="input-group-addon">
                    <i class="zmdi zmdi-bookmark"></i>
                  </span>
                </div>
                <div class="input-group">
                  <select class="form-control show-tick ms select2" style="height: calc(2.25rem + 9px);" name="txtSirketVarsayilanDovizKuru" required>
                    <option value="TL" selected>TL</option>
                    <option value="USD">USD</option>
                    <option value="EURO">EURO</option>
                  </select>
                  <!-- <input type="text" required name="txtSirketVarsayilanDovizKuru" class="form-control" placeholder="Varsayılan Döviz Kuru"> -->
                  <span class="input-group-addon">
                    <i class="zmdi zmdi-bookmark"></i>
                  </span>
                </div>
                <div class="footer text-center">
                  <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light btnLoading">KURULUM YAP</button>
                </div>

              </div>
            </div>
          </div>
        </div>


      </form>


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

      <!-- Jquery Core Js -->
      <script src="<?php echo $this->yolHtml; ?>assets/bundles/libscripts.bundle.js"></script>
      <script src="<?php echo $this->yolHtml; ?>assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
      <script src="<?php echo $this->yolHtml; ?>assets/bundles/jquery.serializejson.js"></script>
      <script src="<?php echo $this->yolHtml; ?>assets/bundles/bootstrap-notify.min.js"></script>
      <script src="<?php echo $this->yolHtml; ?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
      <script src="<?php echo $this->yolHtml ?>assets/js/pages/index.js"></script>
      <script src="<?php echo $this->yolHtml; ?>views/kurulum/kurulum.js"></script>
    </body>

    </html>
