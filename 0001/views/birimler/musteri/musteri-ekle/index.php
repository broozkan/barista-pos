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
          <h2 id="pageName" >Müşteri Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Müşteriler</a></li>
            <li class="breadcrumb-item active">Müşteri Ekle</li>
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
              <h2><strong>Müşteri</strong> Bilgileri</h2>
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
              <form id="frmMusteriEkle" method="post" action="">
                <label for="email_address">Müşteri Adı Soyadı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtMusteriAdiSoyadi" data-tablo-index="10" data-kolon-index="12" autocomplete="off" name="txtMusteriAdiSoyadi" class="form-control dataSearch" required placeholder="Müşteri adını giriniz">
                  <ul class="dropdown-menu suggestion-menu inner">

                  </ul>
                </div>
                <label for="email_address">Müşteri Adresleri</label>
                <div class="input-group divMusteriAdresi">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtMusteriAdresleri" required name="txtMusteriAdresleri[]" class="form-control" placeholder="Müşteri birincil adresini giriniz">
                  <button type="button" class="btn btn-sm g-bg-cgreen buttonInsideInput btnAdresEkle" name="button">
                    <span class="zmdi zmdi-plus"></span>
                  </button>
                </div>

                <label for="email_address">Müşteri Telefon Numarası</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtMusteriTelefonNumarasi" required name="txtMusteriTelefonNumarasi" class="form-control mobile-phone-number" placeholder="+90 (000) 000 00 00">
                </div>
                <label for="email_address">Müşteri E-posta Adresi</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtMusteriEpostaAdresi" name="txtMusteriEpostaAdresi" class="form-control email" placeholder="ornek@ornek.com">
                </div>
                <label for="email_address">Müşteri Notları <span class="zmdi zmdi-help" data-toggle="tooltip" title="Müşteriye ait özel bir detay varsa girebilirsiniz. Örn: Çayı açık içer vs."></span> </label>
                <div class="input-group divSuggestion">
                  <textarea name="txtMusteriNotlari" class="form-control" style="resize:none" rows="4" cols="80" placeholder="Müşteri notlarını giriniz"></textarea>
                </div>
                <label for="email_address">Müşteri Adisyon İndirim Türü</label>
                <div class="input-group divSuggestion">
                  <select class="form-control show-tick ms select2" name="txtMusteriIndirimTuru" id="txtMusteriIndirimTuru" required>
                    <option value="0">Yüzde</option>
                    <option value="1">Miktar</option>
                  </select>
                </div>
                <label for="email_address">Müşteri Adisyon İndirim Miktarı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="number" step=".01" id="txtMusteriIndirimMiktari" required autocomplete="off" name="txtMusteriIndirimMiktari" class="form-control" placeholder="Belirlediğiniz indirim türünün miktarını giriniz">
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>musteri/musteri-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
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
  <script src="<?php echo $this->yolHtml ?>views/birimler/musteri/musteri-ekle/musteri-ekle.js"></script>
</body>

</html>
