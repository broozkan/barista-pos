<!doctype html>
<html class="no-js " lang="tr">
<?php require $this->yolPhp."arayuz/head.php"; ?>
<link rel="stylesheet" href="<?php echo $this->yolHtml; ?>assets/css/timeline.css">


<body class="theme-blue ls-toggle-menu">
  <!-- Page Loader -->
  <?php require $this->yolPhp."arayuz/loader.php"; ?>
  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>
  <!-- Top Bar -->
  <?php require $this->yolPhp."arayuz/navbar.php"; ?>


  <!-- Left Sidebar -->
  <?php require $this->yolPhp."arayuz/aside.php"; ?>

  <section class="content">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2><?php echo $this->mutfakAdi; ?>
            <small>Hazır olan siparişe onay vererek garsonlara bildirim gönderebilirsiniz</small>
          </h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
            <i class="zmdi zmdi-plus"></i>
          </button>
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="index-2.html"><i class="zmdi zmdi-home"></i> Oreo</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Mutfaklar</a></li>
            <li class="breadcrumb-item active"><?php echo $this->mutfakAdi; ?></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="body">
              <input type="hidden" class="txtMutfakAdi" value="<?php echo $this->mutfakAdi; ?>">
              <input type="hidden" id="txtMutfakIdsi" value="<?php echo $this->mutfakIdsi; ?>">
              <audio id="myAudioElement" src="<?php echo $this->yolHtml; ?>assets/sounds/quite-impressed.ogg">
                <source  src="<?php echo $this->yolHtml; ?>assets/sounds/quite-impressed.ogg" type="audio/ogg">
              </audio>
              <?php
                for ($i=0; $i < count($this->mutfakUrunleri); $i++) {
                  echo
                  '<div class="row rowSiparisUrunleri" id="'.$this->mutfakUrunleri[$i]["id"].'">
                    <div class="col-lg-12 col-sm-12">
                      <ul class="cbp_tmtimeline">
                        <li>
                          <time class="cbp_tmtime" datetime="2017-11-04T03:45"><span>'.$this->mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"].'</span> <span>Bugün</span></time>
                          <div class="cbp_tmicon bg-info"><i class="zmdi zmdi-cutlery text-white"></i></div>

                          <div class="cbp_tmicon bg-danger btnSiparisiKaldir" style="top:30%;cursor:pointer"><i class="zmdi zmdi-delete text-white"></i></div>
                          <div class="cbp_tmlabel">
                            <div class="row">
                              <div class="col-6">
                                <h2><a href="javascript:void(0);">ÜRÜN ADI :</a> <span class="spanUrunAdi">'.$this->mutfakUrunleri[$i]["urun_adi"].'</span></h2>
                                <h2><a href="javascript:void(0);">GARSON ADI :</a> <span class="spanGarsonAdi">Burhan Özkan</span></h2>
                                <h2><a href="javascript:void(0);">ÜRÜN ADEDİ :</a> <span class="spanUrunAdedi" >'.$this->mutfakUrunleri[$i]["adisyon_urunleri_urun_adedi"].'</span></h2>
                                <h2><a href="javascript:void(0);">ÜRÜN NOTU :</a> <span class="spanUrunNotu" >'.$this->mutfakUrunleri[$i]["adisyon_urunleri_urun_notu"].'</span></h2>
                              </div>
                              <div class="col-3">';
                              if ($this->mutfakUrunleri[$i]["adisyon_urunleri_urun_teslim_durumu_idsi"] == "0") {
                                echo '<h3 class="h3TeslimDurumu"><span class="badge badge-info">Yeni</span></h3>';
                              }else {
                                echo '<h3 class="h3TeslimDurumu"><span class="badge badge-info" style="background-color:'.$this->mutfakUrunleri[$i]["teslim_durumu_rengi"].'">'.$this->mutfakUrunleri[$i]["teslim_durumu_adi"].'</span></h3>';
                              }

                              echo '
                              </div>
                              <div class="col-3 align-middle text-right">
                                <select class="form-control show-tick select2 ms txtTeslimDurumuIdsi">
                                  <option value="">--Seçiniz--</option>';
                                for ($a=0; $a < count($this->teslimDurumlari); $a++) {
                                  echo '<option value="'.$this->teslimDurumlari[$a]["id"].'" >'.$this->teslimDurumlari[$a]["teslim_durumu_adi"].'</option>';
                                }

                                echo '
                                </select>
                                <button type="button" class="btn g-bg-soundcloud btnSiparisHazir" id="'.$this->mutfakUrunleri[$i]["id"].'">
                                <span class="zmdi zmdi-check-circle zmdi-hc-3x"></span> </button>';
                                if ($this->mutfakUrunleri[$i]["masa_adi"] == null) {
                                  $this->mutfakUrunleri[$i]["masa_adi"] = "<span class='spanMasaAdi'>Hızlı Satış</span>";
                                }
                                echo'
                                <h3 class="mb-0"><span class="spanMasaAdi">'.$this->mutfakUrunleri[$i]["masa_adi"].'</span></h3>
                                <h2><span>'.$this->mutfakUrunleri[$i]["adisyon_urunleri_adisyon_idsi"].'</span></h2>

                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>';
                }
              ?>





            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <?php require $this->yolPhp."arayuz/modalDovizCevirici.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
  <script src="<?php echo $this->yolHtml ?>views/restoran/mutfaklar/mutfaklar.js"></script>
</body>

</html>
