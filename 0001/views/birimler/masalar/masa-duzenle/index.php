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
          <h2 id="pageName" >Masa Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Masalar</a></li>
            <li class="breadcrumb-item active">Masa Düzenle </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form id="frmMasaDuzenle" method="post" action="">
            <?php

              for ($i=0; $i < count($this->masaBilgileri); $i++) {
                echo
                '<div class="card">
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
                  <div class="body formArea">
                    <label for="email_address">Masa Adı</label>
                    <input type="hidden" id="'.$this->masaBilgileri[$i]["masaId"].'" name="txtMasaId" class="txtMasaId">

                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->masaBilgileri[$i]["masaAdi"].'" id="'.$this->masaBilgileri[$i]["masaId"].'" data-tablo-index="1" data-kolon-index="1" autocomplete="off" name="txtMasaAdi" class="txtMasaAdi uppercase form-control dataSearch" required placeholder="Masa adını giriniz">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Masa Lokasyonu</label>
                    <div class="input-group">
                    <select data-id="'.$this->masaBilgileri[$i]["masaLokasyonIdsi"].'" class="form-control select2 ms txtMasaLokasyonIdsi" name="txtMasaLokasyonIdsi" id="txtMasaLokasyonIdsi" required>';

                        for ($a=0; $a < count($this->lokasyonlar); $a++) {
                          echo
                          '<option id="'.$this->lokasyonlar[$a]["id"].'" value="'.$this->lokasyonlar[$a]["id"].'" >'.$this->lokasyonlar[$a]["lokasyon_adi"].'</option>';
                        }
                      echo '
                    </select>
                    <button type="button" class="btn btn-sm btn-default buttonInsideInput btnLokasyonEkle" data-toggle="modal" data-target="#modalYeniLokasyonEkle" name="button">Lokasyon Ekle</button>
                    </div>
                    <label for="email_address">Masa Görselleri <span class="zmdi zmdi-help" data-toggle="tooltip" title="Müşteri masa numarasını hatırlayamazsa ona buraya yükleceyeciğiniz masa görsellerini göstererek hatırlamasına yardımcı olabilirsiniz."></span></label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="file" multiple id="txtMasaGorselleri" name="txtMasaGorselleri" class="form-control">
                    </div>
                    </div>
                  </div>
                </div>';
              }
            ?>
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
            <a href="<?php echo $this->yolHtml; ?>masa/masa-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
          </form>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <div class="modal fade" id="modalYeniKategoriEkle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form id="frmYeniKategoriEkle" method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="largeModalLabel">Yeni Kategori Ekle</h4>
          </div>
          <div class="modal-body">
            <label for="">Kategori Adı</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
              <input type="hidden" name="txtKategoriTabloAdi" value="<?php echo $this->kategoriTabloAdi; ?>">
              <input type="text" id="txtKategoriAdi" data-kolon-index="0" data-tablo-index="0" autocomplete="off" name="txtKategoriAdi" class="form-control dataSearch" required placeholder="Kategori adı giriniz">
              <ul class="dropdown-menu suggestion-menu inner">

              </ul>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">KAYDET</button>
            <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">İPTAL</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modalYeniLokasyonEkle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form id="frmYeniLokasyonEkle" method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="largeModalLabel">Yeni Lokasyon Ekle</h4>
          </div>
          <div class="modal-body">
            <label for="">Lokasyon Adı</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
              <input type="text" id="txtLokasyonAdi" data-kolon-index="7" data-tablo-index="5" autocomplete="off" name="txtLokasyonAdi" class="form-control dataSearch" required placeholder="Lokasyon adı giriniz">
              <ul class="dropdown-menu suggestion-menu inner">

              </ul>
            </div>
            <label for="">Lokasyon Katı</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
              <input type="number" id="txtLokasyonKati" autocomplete="off" name="txtLokasyonKati" class="form-control" required placeholder="Lokasyon katı giriniz">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">KAYDET</button>
            <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">İPTAL</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/mutfak-websocket.js"></script>

  <script src="<?php echo $this->yolHtml ?>views/birimler/masalar/masa-duzenle/masa-duzenle.js"></script>
</body>

</html>
