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
          <h2>Vergi Grup Raporu
            <small>Ürünlerinizin vergi gruplarına göre analizlerine buradan ulaşabilirsiniz</small>
          </h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Rapor Merkezi</a></li>
            <li class="breadcrumb-item active">Vergi Grup Raporu</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-4 col-md-12">

        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card">
            <div class="header">
              <h2> Veri Aralığı Giriniz</h2>
            </div>
            <div class="body">
              <form action="" id="frmVergiRaporu" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Başlangıç Tarihi :</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="date" id="txtBaslangicTarihi" name="txtBaslangicTarihi" class="form-control" required placeholder="00-00-0000">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="">Bitiş Tarihi :</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="date" id="txtBitisTarihi" name="txtBitisTarihi" class="form-control" required placeholder="00-00-0000">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Başlangıç Saati :</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtBaslangicSaati" name="txtBaslangicSaati" class="form-control saat" required placeholder="sa-dk">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="">Bitiş Saati :</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtBitisSaati" name="txtBitisSaati" class="form-control saat" required placeholder="sa-dk">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="input-group demoMaskedInput">
                      <button type="button" class="btn btn-default btnDun" name="button">Dün</button>
                      <button type="button" class="btn btn-default btnBugun" name="button">Bugün</button>
                      <button type="button" class="btn btn-default btnSonHafta" name="button">Son Hafta</button>
                      <button type="button" class="btn btn-default btnSonAy" name="button">Son Ay</button>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="">Vergi Adı : <sup>Özel aramak istediğiniz vergi varsa adını giriniz</sup> </label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtVergiAdi" data-kolon-index="5" data-tablo-index="4" class="form-control dataSearch" placeholder="Vergi adı giriniz">
                      <ul class="dropdown-menu suggestion-menu inner stokVergiEkle">

                      </ul>
                    </div>
                  </div>

                </div>
                <div class="col-md-12 text-right">
                  <button class="btn btn-primary btn-round" type="submit">ARA</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" id="txtKurIsareti" value="<?php echo $this->varsayilanKurIsareti; ?>">
        <div class="row clearfix d-none rowVergiSatisRaporu">

          <div class="col-lg-6 col-md-12">
            <div class="card">
              <div class="header">
                <h2><strong>Vergi Grup</strong> Raporu</h2>
              </div>
              <div class="body">
                <canvas id="vergiAdetChart" height="150"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="card">
              <div class="header">
                <h2><strong>Vergi Grup</strong> Raporu</h2>
              </div>
              <div class="body">
                <div class="table-responsive">
                  <table class="table tblVergiSatisRaporu">
                    <thead>
                      <th>Vergi Adı</th>
                      <th>Toplam Satış Fiyatı</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="row clearfix d-none rowVergiSatisRaporu">

          <div class="col-lg-6 col-md-12"></div>

        </div>


    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml; ?>views/merkezler/rapor/vergi-grup-raporu/vergi-grup-raporu.js"></script>
  <script src="<?php echo $this->yolHtml; ?>assets/js/pages/table.js"></script>

  <script src="<?php echo $this->yolHtml; ?>assets/plugins/chartjs/Chart.bundle.js"></script> <!-- Chart Plugins Js -->
  <script src="<?php echo $this->yolHtml; ?>assets/plugins/chartjs/polar_area_chart.js"></script><!-- Polar Area Chart Js -->

  <script src="<?php echo $this->yolHtml; ?>assets/js/pages/charts/chartjs.js"></script>
  <script src="<?php echo $this->yolHtml; ?>assets/js/pages/charts/polar_area_chart.js"></script>
</body>

</html>
