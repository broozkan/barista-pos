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
          <h2 id="pageName" >Program Ayarları</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Ayarlar</a></li>
            <li class="breadcrumb-item active">Program Ayarları</li>
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
              <form id="frmProgramBilgileri" method="post" action="">
                <label for="email_address">Caller ID Entegrasyonu</label>
                <div class="input-group radioForm" data-radio="<?php echo $this->programAyarlari["caller_id_aktif_mi"]; ?>" >
                  <div class="radio">
                    <input type="radio" name="txtCallerId" id="radio1" class="txtCallerId" value="1">
                    <label for="radio1">
                      Açık
                    </label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="txtCallerId" id="radio2" class="txtCallerId" value="0" >
                    <label for="radio2">
                      Kapalı
                    </label>
                  </div>
                </div>

                <label for="email_address">Yazarkasa POS Entegrasyonu</label>
                <div class="input-group radioForm" data-radio="<?php echo $this->programAyarlari["yazarkasa_aktif_mi"]; ?>">
                  <div class="radio">
                    <input type="radio" name="txtYazarKasaPos" class="txtYazarKasaPos" id="radio3" value="1">
                    <label for="radio3">
                      Açık
                    </label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="txtYazarKasaPos" class="txtYazarKasaPos" id="radio4" value="0" >
                    <label for="radio4">
                      Kapalı
                    </label>
                  </div>
                </div>
                <label for="email_address">Yemeksepeti Entegrasyonu</label>
                <div class="input-group radioForm" data-radio="<?php echo $this->programAyarlari["yemeksepeti_aktif_mi"]; ?>">
                  <div class="radio">
                    <input type="radio" name="txtYemekSepeti" class="txtYemekSepeti" id="radio5" value="1">
                    <label for="radio5">
                      Açık
                    </label>
                    <input type="radio" name="txtYemekSepeti" class="txtYemekSepeti" id="radio6" value="0" >
                    <label for="radio6">
                      Kapalı
                    </label>
                  </div>
                  <div class="radio">

                  </div>
                </div>
                <label for="email_address">Program Başlangıç Saati</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input value="<?php echo $this->programAyarlari["program_baslangic_saati"]; ?>" type="text" id="txtProgramBaslangicSaati" name="txtProgramBaslangicSaati" class="form-control" required placeholder="sa:dk">
                </div>
                <label for="email_address">Program Bitiş Saati</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input value="<?php echo $this->programAyarlari["program_bitis_saati"]; ?>" type="text" id="txtProgramBitisSaati" name="txtProgramBitisSaati" class="form-control" required placeholder="sa:dk">
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
  <script src="<?php echo $this->yolHtml; ?>views/ayarlar/program-ayarlari/program-ayarlari.js"></script>

</body>

</html>
