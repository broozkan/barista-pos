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
          <h2 id="pageName" >Ödeme Metodu Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Ödeme Metodları</a></li>
            <li class="breadcrumb-item active">Ödeme Metodu Ekle</li>
          </ul>
        </div>
      </div>
    </div>
    <input type="hidden" id="txtOkcAktifMi" value="<?php echo $this->okcBilgileri["okc_bilgileri_okc_aktif_mi"]; ?>">
    <input type="hidden" id="txtOkcAktifMi" value="<?php echo $this->okcBilgileri["okc_bilgileri_okc_aktif_mi"]; ?>">
    <input type="hidden" id="txtOkcPortAdi" value="<?php echo $this->okcBilgileri["okc_bilgileri_port_adi"]; ?>">
    <input type="hidden" id="txtOkcBaudRate" value="<?php echo $this->okcBilgileri["okc_bilgileri_baudrate"]; ?>">
    <input type="hidden" id="txtOkcFiscalIdsi" value="<?php echo $this->okcBilgileri["okc_bilgileri_fiscal_idsi"]; ?>">
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong>Ödeme Metodu</strong> Bilgileri</h2>
              <ul class="header-dropdown">
                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                  <ul class="dropdown-menu">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else</a></li>
                  </ul>
                </li>
                <li class="remove">
                  <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                </li>
              </ul>
            </div>
            <div class="body">
              <form id="frmOdemeMetodEkle" metod="post" action="">
                <label for="email_address">Ödeme Metodu Adı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtOdemeMetodAdi" data-tablo-index="11" data-kolon-index="13" autocomplete="off" name="txtOdemeMetodAdi" class="form-control dataSearch" required placeholder="Ödeme metodu adını giriniz">
                  <ul class="dropdown-menu suggestion-menu inner">

                  </ul>
                </div>
                <label for="email_address">Ödeme Metodu Sırası</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="number" id="txtOdemeMetodSiralamasi" name="txtOdemeMetodSiralamasi" class="form-control" required placeholder="Ödeme metodu sırasını giriniz">
                </div>
                <label for="email_address">Ödeme Metodu Aktivitesi <span class="zmdi zmdi-help" data-toggle="tooltip" title="Ödeme seçeneğini pasif duruma alırsanız ödeme ekranında listelenmeyecektir."></span></label>
                <div class="input-group divSuggestion">
                  <select class="form-control ms show-tick" required name="txtOdemeMetodAktifMi" id="txtOdemeMetodAktifMi">
                    <option value="0">Pasif</option>
                    <option value="1">Aktif</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>odeme-metod/odeme-metod-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
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
  <script src="<?php echo $this->yolHtml ?>views/birimler/odemeMetod/odeme-metod-ekle/odeme-metod-ekle.js"></script>
</body>

</html>
