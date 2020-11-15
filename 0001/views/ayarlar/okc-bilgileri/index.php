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
          <h2 id="pageName" >ÖKC Bilgileri</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Ayarlar</a></li>
            <li class="breadcrumb-item active">ÖKC Bilgileri</li>
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
              <h2><strong>ÖKC</strong> Bağlantı Bilgileri</h2>
            </div>
            <div class="body">
              <form id="frmOkcBilgileri" method="post" action="">
                <label for="email_address">ÖKC Aktif Mi</label>
                <div class="input-group">
                  <div class="form-group radioForm"  data-radio="<?php echo $this->okcBilgileri["okc_bilgileri_okc_aktif_mi"]; ?>">
                      <div class="radio inlineblock m-r-20 ">
                          <input type="radio" name="txtOkcAktifMi" id="male" class="with-gap" value="1">
                          <label for="male">Evet</label>
                      </div>
                      <div class="radio inlineblock">
                          <input type="radio" name="txtOkcAktifMi" id="Female" class="with-gap" value="0" checked="">
                          <label for="Female">Hayır</label>
                      </div>
                  </div>
                </div>
                <label for="email_address">ÖKC Port Adı</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input value="<?php echo $this->okcBilgileri["okc_bilgileri_port_adi"]; ?>" type="text" id="txtOkcPortAdi" name="txtOkcPortAdi" class="form-control" required placeholder="Örn: COM9">
                </div>
                <label for="email_address">ÖKC Baudrate</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input value="<?php echo $this->okcBilgileri["okc_bilgileri_baudrate"]; ?>" type="text" id="txtOkcBaudrate" name="txtOkcBaudrate" class="form-control" required placeholder="Örn: 115200">
                </div>
                <label for="email_address">ÖKC Sicil Numarası</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input value="<?php echo $this->okcBilgileri["okc_bilgileri_fiscal_idsi"]; ?>" type="text" id="txtOkcFiscalIdsi" name="txtOkcFiscalIdsi" class="form-control" required placeholder="">
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
  <script src="<?php echo $this->yolHtml; ?>views/ayarlar/okc-bilgileri/okc-bilgileri.js"></script>

</body>

</html>
