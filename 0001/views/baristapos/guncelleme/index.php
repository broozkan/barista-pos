<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>
<link rel="stylesheet" href="<?php echo $this->yolHtml; ?>assets/plugins/jquery-steps/jquery.steps.css">


<body class="theme-blue">
  <!-- Page Loader -->
  <?php require $this->yolPhp."arayuz/loader.php"; ?>


  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <!-- Top Bar -->
  <?php require $this->yolPhp."arayuz/navbar.php"; ?>


  <!-- Left Sidebar -->
  <?php require $this->yolPhp."arayuz/aside.php"; ?>

  <!-- Chat-launcher -->
  <?php require $this->yolPhp."arayuz/chat.php"; ?>


  <section class="content">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>Güncelleme
            <small>Sisteminizi en son sürüme yükseltmek için güncelleme sihirbazını takip edin. Güncelleme öncesi yedek almayı unutmayın!</small>
          </h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="index-2.html"><i class="zmdi zmdi-home"></i> Oreo</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
            <li class="breadcrumb-item active">Form Wizard</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">

      <!-- Advanced Form Example With Validation -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong>Dikkat!</strong> </h2>
            </div>
            <div class="body">
              <h5>Güncelleme öncesi lütfen şunlara dikkat ediniz;</h5>
              <ul>
                <li>İnternet bağlantınızı kontrol ediniz</li>
                <li>Güncelleme öncesi yedek alınız</li>
                <li>Güncellemeyi mesai saatleri dışında yapınız</li>
                <li>Eski versiyona dönemeyeceğinizi biliniz</li>
                <li>Güncelleme sırasında lütfen bilgisayarınızı veya internetinizi kapatmayınız</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong>Güncelleme</strong> Sihirbazı</h2>
            </div>
            <div class="body">
              <form id="wizard_with_validation" method="POST">
                <h3>Güncelleştirmeyi Kontrol Et</h3>
                <fieldset>
                  <div class="form-group form-float text-center divGuncellemeKontrolEt">
                    <h3>Yeni bir güncelleştirme olup olmadığını kontrol et</h3>
                    <button type="button" class="btn btn-lg btn-info btnGuncellestirmeKontrolEt btnLoading" name="button">Kontrol Et</button>
                  </div>
                  <input type="hidden" id="txtGuncellemeVarMi" value="0">
                  <input type="hidden" id="txtGuncellenecekVersiyonSurumu" value="">
                </fieldset>
                <h3>Yedek Al</h3>
                <fieldset>
                  <div class="form-group form-float text-center divYedekAl">
                    <h3>Mevcut verilerinizin yedeğini alınız</h3>
                    <label for="email_address">E-posta Adresi <sup>Yedekleme dosyasının bir kopyasını da size mail olarak gönderir. Boş bırakırsanız sadece yerelde depolanır</sup> </label>
                    <input type="text" id="txtEpostaAdresi" style="width:50%;margin:auto" name="txtEpostaAdresi" value="<?php echo $this->sirketEpostaAdresi; ?>" class="form-control email" placeholder="E-posta adresi giriniz">
                    <button type="button" class="btn btn-lg btn-info btnYedekAl btnLoadingYedek" name="button"><span class="zmdi zmdi-dns"></span> Şimdi Yedekle</button>
                  </div>
                  <input type="hidden" id="txtYedekAlindiMi" value="0">
                </fieldset>
                <h3>Güncellemeyi Gerçekleştir</h3>
                <fieldset>
                  <div class="form-group form-float text-center divGuncelle">
                    <h3>Güncellemeye hazır mısınız?</h3>
                    <button type="button" class="btn btn-lg g-bg-cgreen btnGuncelle btnLoadingGuncelle" name="button"><span class="zmdi zmdi-download"></span> GÜNCELLE</button>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- #END# Advanced Form Example With Validation -->
    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>

  <script src="<?php echo $this->yolHtml; ?>assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Jquery Validation Plugin Css -->
  <script src="<?php echo $this->yolHtml; ?>assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js -->

  <script src="<?php echo $this->yolHtml; ?>assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
  <script src="<?php echo $this->yolHtml; ?>assets/js/pages/forms/form-wizard.js"></script>

  <!-- <script src="<?php echo $this->yolHtml; ?>assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js --> -->


  <script src="<?php echo $this->yolHtml; ?>views/baristapos/guncelleme/guncelleme.js"></script>

</body>

</html>
