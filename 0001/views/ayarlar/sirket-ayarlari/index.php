<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>

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
          <h2 id="pageName" >İşletme Ayarları</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Ayarlar</a></li>
            <li class="breadcrumb-item active">İşletme Ayarları</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong>İşletme</strong> Bilgileri</h2>
            </div>
            <div class="body">
              <form id="frmSirketBilgileri" method="post" action="">
                <label for="email_address">İşletme Adı</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input value="<?php echo $this->sirketBilgileri["sirket_adi"]; ?>" type="text" id="txtSirketAdi" name="txtSirketAdi" class="form-control" required placeholder="İşletme adını giriniz">
                </div>
                <label for="email_address">İşletme Adresi</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-google-maps"></i></span>
                  <input value="<?php echo $this->sirketBilgileri["sirket_adresi"]; ?>" type="text" id="txtSirketAdresi" name="txtSirketAdresi" class="form-control" required placeholder="İşletme adresini giriniz">
                </div>
                <label for="email_address">İşletme E-posta Adresi</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                  <input value="<?php echo $this->sirketBilgileri["sirket_eposta_adresi"]; ?>" type="text" id="txtSirketEpostaAdresi" name="txtSirketEpostaAdresi" class="form-control email" placeholder="Örn: eposta@eposta.com">
                </div>
                <label for="email_address">İşletme Telefon Numarası</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
                  <input value="<?php echo $this->sirketBilgileri["sirket_telefonu"]; ?>" type="text" id="txtSirketTelefonu" name="txtSirketTelefonu" class="form-control mobile-phone-number" placeholder="Örn: +00 (000) 000-00-00">
                </div>
                <label for="email_address">İşletme Vergi Numarası</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-file-text"></i></span>
                  <input value="<?php echo $this->sirketBilgileri["sirket_vergi_numarasi"]; ?>" type="number" id="txtSirketVergiNumarasi" name="txtSirketVergiNumarasi" class="form-control" placeholder="İşletme vergi numarasını giriniz">
                </div>
                <label for="email_address">İşletme Logosu</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-file-text"></i></span>
                  <input type="file" id="txtSirketLogosu" name="txtSirketLogosu" class="form-control">
                </div>

                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml; ?>views/ayarlar/sirket-ayarlari/sirket-ayarlari.js"></script>

</body>

</html>
