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
                  <h2><?php echo $this->calisan["calisan_adi_soyadi"] ?> Profili</h2>
              </div>
              <div class="col-lg-5 col-md-6 col-sm-12">
                  <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                      <i class="zmdi zmdi-plus"></i>
                  </button>
                  <ul class="breadcrumb float-md-right">
                      <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>calisan/calisan-listesi"><i class="zmdi zmdi-home"></i> Çalışanlar</a></li>
                      <li class="breadcrumb-item active">Çalışan Profili</li>
                  </ul>
              </div>
          </div>
      </div>
      <div class="container-fluid">
          <div class="row clearfix">
            <div class="col-lg-3"></div>
              <div class="col-lg-7 col-md-12">
                  <div class="card profile-header">
                      <div class="body">
                          <div class="row">
                              <div class="col-lg-4 col-md-4 col-12">
                                  <div class="profile-image float-md-right"> <img src="/local-assets/calisanlar/<?php echo $this->calisan["calisan_profil_fotosu"] ?>" alt=""> </div>
                              </div>
                              <div class="col-lg-8 col-md-8 col-12">
                                  <h4 class="m-t-0 m-b-0"><strong><?php echo $this->calisan["calisan_adi_soyadi"] ?></strong></h4>
                                  <span class="job_post"><?php echo $this->calisan["calisan_statu_adi"] ?></span>
                                  <p><?php echo $this->calisan["calisan_adresi"] ?></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3"></div>

              <div class="col-lg-7 col-md-12">
                  <div class="card">
                      <ul class="nav nav-tabs">
                          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#about">Çalışan Bilgileri</a></li>
                          <li class="nav-item"><a class="nav-link btnCalisanSatislari" data-toggle="tab" href="#mypost">Çalışan Satışları</a></li>
                          <li class="nav-item"><a class="nav-link btnHarcamaAdisyonlari" data-toggle="tab" href="#timeline">Çalışan Harcama Adisyonları</a></li>
                      </ul>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane body active" id="about">
                      <div class="card">
                        <div class="body">
                          <small class="text-muted">E-posta Adresi: </small>
                          <p><?php echo $this->calisan["calisan_eposta_adresi"] ?></p>
                          <hr>
                          <small class="text-muted">Telefon Numarası: </small>
                          <p><?php echo $this->calisan["calisan_telefon_numarasi"] ?></p>
                          <hr>
                          <small class="text-muted">Doğum Tarihi: </small>
                          <p class="m-b-0"><?php echo $this->calisan["calisan_dogum_tarihi"] ?></p>
                        </div>
                      </div>

                    </div>
                      <div role="tabpanel" class="tab-pane" id="mypost">
                          <div class="card">
                              <div class="body">
                                <canvas id="calisanAdetChart" height="150"></canvas>
                                <input type="hidden" id="txtCalisanIdsi" value="<?php echo $this->calisan["id"]; ?>">
                              </div>
                          </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="timeline">
                          <div class="card">
                              <div class="body">
                                <div class="table-responsive">
                                  <table class="table tblHarcamaAdisyonlari">
                                    <thead>
                                      <th>#</th>
                                      <th>Adisyon Tutarı</th>
                                      <th>Adisyon Tarihi</th>
                                      <th>İşlem</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                          </div>
                      </div>




                  </div>
              </div>
              <div class="col-lg-3"></div>
              <div class="col-lg-7 col-md-12">
                  <div class="card">
                      <ul class="row profile_state list-unstyled">
                          <li class="col-lg-4 col-md-4 col-6">
                              <div class="body">
                                  <i class="zmdi zmdi-money col-amber"></i>
                                  <h5 class="m-b-0 number count-to" data-from="0" data-to="<?php echo $this->calisanSatisBilgileri["urun_toplam_fiyati"]; ?>" data-speed="1000" data-fresh-interval="700"> </h5> <span class="spanKurIsareti">₺</span>
                                  <small>Toplam Satış</small>
                              </div>
                          </li>
                          <li class="col-lg-4 col-md-4 col-6">
                              <div class="body">
                                  <i class="zmdi zmdi-account col-red"></i>
                                  <h5 class="m-b-0 number count-to" data-from="0" data-to="<?php echo $this->calisanTuketimBilgileri["toplam_harcama"]; ?>" data-speed="1000" data-fresh-interval="700"></h5> <span class="spanKurIsareti">₺</span>
                                  <small>Toplam Harcama</small>
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="row clearfix">


          </div>
      </div>
  </section>

  <?php require $this->yolPhp."arayuz/lock.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/calisanlar/calisan-profil/calisan-profil.js"></script>
  <script src="<?php echo $this->yolHtml; ?>assets/js/pages/table.js"></script>

  <script src="<?php echo $this->yolHtml; ?>assets/plugins/chartjs/Chart.bundle.js"></script> <!-- Chart Plugins Js -->
  <script src="<?php echo $this->yolHtml; ?>assets/plugins/chartjs/polar_area_chart.js"></script><!-- Polar Area Chart Js -->

  <!-- <script src="<?php echo $this->yolHtml; ?>assets/bundles/mainscripts.bundle.js"></script> -->
  <script src="<?php echo $this->yolHtml; ?>assets/js/pages/charts/chartjs.js"></script>
  <script src="<?php echo $this->yolHtml; ?>assets/js/pages/charts/polar_area_chart.js"></script>
</body>

</html>
