<!doctype html>
<html class="no-js " lang="tr">
<?php require $this->yolPhp."arayuz/head.php"; ?>
<link rel="stylesheet" href="assets/css/timeline.css">


<body class="theme-blue ls-toggle-menu">
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
  <section class="content">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>Mutfak Ekranları
            <small>Siparişlerini görüntülemek istediğiniz mutfağa tıklayınız</small>
          </h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Yönetim Sekmesi</a></li>
            <li class="breadcrumb-item active">Mutfak Ekranları</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <?php
          for ($i=0; $i < count($this->mutfaklar); $i++) {
            echo
            '<div class="col-lg-3">
              <div class="card">
                <div class="body">
                  <a href="'.$this->yolHtml.'restoran/mutfaklar/'.$this->mutfaklar[$i]["id"].'">
                    <div class="card weather2">
                      <div class="city-selected body g-bg-blue">
                        <div class="row">
                          <div class="col-12">
                            <div class="city"><span>MUTFAK ADI:</span> '.$this->mutfaklar[$i]["mutfak_adi"].'</div>
                            <div class="night">YAZICI ADI : '.$this->mutfaklar[$i]["yazici_adi"].'</div>
                          </div>
                          <div class="info col-7">
                          </div>
                          <div class="icon col-5 text-right">
                            <span class="zmdi zmdi-cutlery zmdi-hc-5x"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>

                </div>
              </div>
            </div>';
          }
        ?>

      </div>
    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <?php require $this->yolPhp."arayuz/modalDovizCevirici.php"; ?>
  
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
  <script src="<?php echo $this->yolHtml ?>views/restoran/masalar/masalar.js"></script>
</body>

</html>
