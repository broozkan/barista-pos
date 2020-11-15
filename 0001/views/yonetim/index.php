<!doctype html>
<html class="no-js " lang="tr">

<head>
  <?php require $this->yolPhp."arayuz/head.php"; ?>
</head>
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


  <!-- Main Content -->
  <section class="content home">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12">
          <h2 id="pageName">Yönetim</h2>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-12 text-right">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Barista POS</a></li>
            <li class="breadcrumb-item active">Yönetim</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong>Yönetim</strong> Özeti</h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                  <div class="card">
                    <div class="body text-center">
                      <input type="text" class="knob" value="<?php echo $this->masaDolulukOrani; ?>" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#cb8fe7" readonly>
                      <p class="text-muted m-b-0">MASA DOLULUK ORANI (%)</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                  <div class="card">
                    <div class="body text-center">
                      <input type="text" class="knob" value="<?php echo $this->acikMasaSayisi; ?>" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#cb8fe7" readonly>
                      <p class="text-muted m-b-0">AÇIK MASA SAYISI</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                  <div class="card">
                    <div class="body text-center">
                      <input type="text" class="knob" value="<?php echo $this->aktifCalisanSayisi; ?>" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#cb8fe7" readonly>
                      <p class="text-muted m-b-0">AKTİF ÇALIŞAN SAYISI</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                  <div class="body">
                    <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="<?php echo $this->toplamAdisyonTutari; ?>" data-speed="2000" data-fresh-interval="700"> ₺</h2> <h2><?php echo $this->varsayilanKurIsareti; ?></h2>
                    <p class="text-muted">Anlık Adisyon Toplamı</p>
                    <span id="linecustom3">1,5,3,6,6,3,6,8,4,2</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-sm-6">
          <div class="card">
            <div class="header">
              <h2><strong>Çalışan</strong> Haberleri</h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <?php
                  if (count($this->dogumGunuOlanCalisanlar) > 0) {
                    echo
                    '<div class="col-lg-2">
                      <img src="'.$this->yolHtml.'assets/images/konfeti.jpg" class="img" alt="">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 text-center">
                      <div class="card">
                        <div class="body text-center">

                          <h3>Bugün '.count($this->dogumGunuOlanCalisanlar).' kişinin doğum günü!  </h3>';

                          for ($i=0; $i <count($this->dogumGunuOlanCalisanlar) ; $i++) {
                            echo 'İyi ki doğdun <strong>'.$this->dogumGunuOlanCalisanlar[$i].'</strong>';
                          }

                          echo '
                          <br>
                          <small>Barista POS olarak sağlıklı güzel yıllar dileriz</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <img src="'.$this->yolHtml.'assets/images/konfeti2.png" class="img" alt="">
                    </div>';
                  }
                ?>

              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="header">
              <h2><strong>Önemli</strong> Günler</h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <?php
                  if (count($this->gununOnemliTarihleri) > 0) {
                    echo
                    '<div class="col-lg-2">
                      <img src="'.$this->yolHtml.'assets/images/tarih.png" class="img" alt="">
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 text-center">
                      <div class="card">
                        <div class="body text-center">';


                          for ($i=0; $i <count($this->gununOnemliTarihleri) ; $i++) {
                            echo '<h3>Bugün <strong>'.$this->gununOnemliTarihleri[$i].'</strong>!</h3>';
                          }

                          echo '
                        </div>
                      </div>
                    </div>';
                  }
                ?>

              </div>
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

  <script src="<?php echo $this->yolHtml; ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script> <!-- Jquery Knob Plugin Js -->

  <script src="<?php echo $this->yolHtml; ?>assets/js/pages/charts/jquery-knob.js"></script>

</body>

</html>
