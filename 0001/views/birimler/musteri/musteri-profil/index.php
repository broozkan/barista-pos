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


  <section class="content profile-page">
      <div class="block-header">
          <div class="row">
              <div class="col-lg-7 col-md-6 col-sm-12">
                  <h2><?php echo $this->musteri["musteri_adi_soyadi"] ?> Profili</h2>
              </div>
              <div class="col-lg-5 col-md-6 col-sm-12">
                  <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                      <i class="zmdi zmdi-plus"></i>
                  </button>
                  <ul class="breadcrumb float-md-right">
                      <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>musteri/musteri-listesi"><i class="zmdi zmdi-home"></i> Müşteriler</a></li>
                      <li class="breadcrumb-item active">Müşteri Profili</li>
                  </ul>
              </div>
          </div>
      </div>
      <div class="container-fluid">
          <div class="row clearfix">
              <div class="col-xl-6 col-lg-7 col-md-12">
                  <div class="card profile-header">
                      <div class="body">
                          <div class="row">
                              <div class="col-lg-4 col-md-4 col-12">
                                  <div class="profile-image float-md-right"> <img src="<?php echo $this->yolHtml ?>assets/images/profile.png" alt=""> </div>
                              </div>
                              <div class="col-lg-8 col-md-8 col-12">
                                  <h4 class="m-t-0 m-b-0"><strong><?php echo $this->musteri["musteri_adi_soyadi"] ?></strong></h4>
                                  <span class="job_post"><?php echo $this->musteri["musteri_telefon_numarasi"] ?></span>
                                  <span class="job_post"><?php echo $this->musteri["musteri_eposta_adresi"] ?></span>
                                  <p><?php echo $this->musteri["musteri_adresi"] ?></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-6 col-lg-5 col-md-12">
                  <div class="card">
                      <ul class="row profile_state list-unstyled">
                          <li class="col-lg-4 col-md-4 col-6">
                              <div class="body">
                                  <i class="zmdi zmdi-money col-amber"></i>
                                  <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000" data-fresh-interval="700">2365 ₺</h5>
                                  <small>Toplam Gelir</small>
                              </div>
                          </li>
                          <li class="col-lg-4 col-md-4 col-6">
                              <div class="body">
                                  <i class="zmdi zmdi-thumb-up col-blue"></i>
                                  <h5 class="m-b-0 number count-to" data-from="0" data-to="1203" data-speed="1000" data-fresh-interval="700">1203 ₺</h5>
                                  <small>Toplam Kâr</small>
                              </div>
                          </li>
                          <li class="col-lg-4 col-md-4 col-6">
                              <div class="body">
                                  <i class="zmdi zmdi-account col-red"></i>
                                  <h5 class="m-b-0 number count-to" data-from="0" data-to="324" data-speed="1000" data-fresh-interval="700">324</h5>
                                  <small>Toplam İkram/İptal Edilen Tutarı</small>
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="row clearfix">
              <div class="col-lg-4 col-md-12">
                  <div class="card">
                      <ul class="nav nav-tabs">
                          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#about">Bilgiler</a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane body active" id="about">
                              <small class="text-muted">E-posta Adresi: </small>
                              <p><?php echo $this->musteri["musteri_eposta_adresi"] ?></p>
                              <hr>
                              <small class="text-muted">Telefon Numarası: </small>
                              <p><?php echo $this->musteri["musteri_telefon_numarasi"] ?></p>
                              <hr>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-8 col-md-12">
                  <div class="card">
                      <ul class="nav nav-tabs">
                          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#mypost">Adisyonları</a></li>
                      </ul>
                  </div>
                  <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="mypost">
                          <div class="card">
                              <div class="body">
                                  <div class="table">
                                    <table class="table table-responsive">
                                      <thead>
                                        <tr>
                                          <th>Adisyon No</th>
                                          <th>Adisyon Tutarı</th>
                                          <th>Adisyon Tarihi</th>
                                          <th>Adisyon Garsonu</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <!-- ADİSYONLAR EKLENİNCE GELECEK -->
                                      </tbody>
                                    </table>
                                  </div>
                              </div>
                          </div>
                      </div>




                  </div>
              </div>
          </div>
      </div>
  </section>


  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
</body>

</html>
