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
          <h2 id="pageName" >Masa Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Masalar</a></li>
            <li class="breadcrumb-item active">Masa Ekle</li>
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
              <h2><strong>Masa</strong> Bilgileri</h2>
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
              <form id="frmMasaEkle" method="post" action="">
                <label for="email_address">Masa Adı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtMasaAdi" data-tablo-index="1" data-kolon-index="1" autocomplete="off" name="txtMasaAdi" class="form-control dataSearch uppercase" required placeholder="Masa adını giriniz">
                  <ul class="dropdown-menu suggestion-menu inner">

                  </ul>
                </div>
                <label for="email_address">Masa Lokasyonu <span class="zmdi zmdi-help" data-toggle="tooltip" title="Masanın hangi bölgede olduğunu belirtebilirsiniz. Örn: Giriş,bahçe vs."></span> </label>
                <div class="input-group divSuggestion">
                  <select class="form-control select2 ms" name="txtMasaLokasyonIdsi" id="txtMasaLokasyonIdsi" required>
                    <?php
                      for ($i=0; $i < count($this->lokasyonlar); $i++) {
                        echo
                        '<option id="'.$this->lokasyonlar[$i]["id"].'" value="'.$this->lokasyonlar[$i]["id"].'" >'.$this->lokasyonlar[$i]["lokasyon_adi"].'</option>';
                      }
                    ?>
                  </select>
                  <button type="button" class="btn btn-sm btn-default buttonInsideInput btnLokasyonEkle" data-toggle="modal" data-target="#modalYeniLokasyonEkle" name="button">Lokasyon Ekle</button>

                </div>
                <label for="email_address">Masa Görselleri <span class="zmdi zmdi-help" data-toggle="tooltip" title="Müşteri masa numarasını hatırlayamazsa ona buraya yükleceyeciğiniz masa görsellerini göstererek hatırlamasına yardımcı olabilirsiniz."></span></label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="file" multiple id="txtMasaGorselleri" name="txtMasaGorselleri" class="form-control">
                </div>

                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>masa/masa-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- #END# Vertical Layout -->
    </div>
  </section>
  <?php require $this->yolPhp."arayuz/modalYeniLokasyonEkle.php"; ?>


  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/mutfak-websocket.js"></script>

  <script src="<?php echo $this->yolHtml ?>views/birimler/masalar/masa-ekle/masa-ekle.js"></script>
</body>

</html>
