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
          <h2 id="pageName" >ÖKC Ayarları</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Ayarlar</a></li>
            <li class="breadcrumb-item">ÖKC Ayarları</li>
            <li class="breadcrumb-item active">Departman Tanımlama</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong>Departman</strong> Tanımlama </h2>
            </div>
            <div class="body">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#kisim">KISIM</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#plu">PLU</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">KREDİ</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">KATEGORİ</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">KASİYER</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">KDV</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">FİŞ SONU NOTU</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane in active" id="kisim"> <b>Departman Tanımla</b>
                  <div class="table-responsive">
                    <table class="table tblDepartmanlar">
                      <thead>
                        <th>Departman ID</th>
                        <th>Departman Adı</th>
                        <th>Departman KDV No</th>
                        <th>Fiyat</th>
                        <th>Limit</th>
                        <th>Tartılabilir</th>
                        <th>İŞLEM</th>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                  <button type="button" class="btn btn-default btn-lg btnDepartmanlariAl" name="button">DEPARTMAN GETİR</button>
                  <button type="button" class="btn btn-default btn-lg btnBaglan" name="button">BAĞLAN</button>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="plu"> <b>PLU Tanımlama</b>
                    <p>
                      Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                      Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                      pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                      sadipscing mel.
                    </p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages"> <b>Message Content</b>
                      <p> Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                        sadipscing mel. </p>
                      </div>
                    </div>
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
        <script src="<?php echo $this->yolHtml ?>assets/js/pages/okc-websocket.js"></script>
        <script src="<?php echo $this->yolHtml; ?>views/ayarlar/departman-tanimlama/departman-tanimlama.js"></script>


      </body>

      </html>
