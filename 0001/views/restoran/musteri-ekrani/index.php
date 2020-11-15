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
    <!-- <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>Müşteri Ekranı
            <small>Siparişinizin hazır olma durumunu buradan takip edebilirsiniz</small>
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
    </div> -->
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="body">
              <?php
                for ($i=0; $i < count($this->musteriSiparisleri); $i++) {
                  echo
                  '<div class="row rowSiparisUrunleri" id="'.$this->musteriSiparisleri[$i]["id"].'">
                    <div class="col-lg-2 d-none-sm"></div>
                    <div class="col-lg-8 col-sm-12">
                      <ul class="cbp_tmtimeline">
                        <li>
                          <time class="cbp_tmtime" datetime="2017-11-04T03:45"><span>'.$this->musteriSiparisleri[$i]["adisyon_urunleri_urun_siparis_saati"].'</span> <span>Bugün</span></time>
                          <div class="cbp_tmicon bg-info"><i class="zmdi zmdi-cutlery text-white"></i></div>
                          <div class="cbp_tmlabel">
                            <div class="row">
                              <div class="col-7">
                                <h2><a href="javascript:void(0);">MÜŞTERİ ADI :</a> <span class="spanMusteriAdi">Burhan Özkan</span></h2>
                                <h2><a href="javascript:void(0);">ADİSYON NUMARASI :</a> <span class="spanAdisyonNumarasi">'.$this->musteriSiparisleri[$i]["adisyon_urunleri_adisyon_idsi"].'</span></h2>
                              </div>
                              <div class="col-5 align-middle text-right">';
                              if ($this->musteriSiparisleri[$i]["adisyon_urunleri_urun_teslim_durumu_idsi"] == 0) {
                                $this->musteriSiparisleri[$i]["adisyon_urunleri_urun_teslim_durumu"] = '<span class="badge badge-warning"><h3 class="mb-0">Hazırlanıyor</h3></span>';
                              }else{
                                $this->musteriSiparisleri[$i]["adisyon_urunleri_urun_teslim_durumu"] = '<span class="badge badge-danger"><h3 class="mb-0">Hazır</h3></span>';
                              }
                              echo '
                              '.$this->musteriSiparisleri[$i]["adisyon_urunleri_urun_teslim_durumu"].'

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
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
  <script src="<?php echo $this->yolHtml ?>views/restoran/musteri-ekrani/musteri-ekrani.js"></script>
</body>

</html>
