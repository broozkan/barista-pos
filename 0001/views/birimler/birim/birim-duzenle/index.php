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
          <h2 id="pageName" >Birim Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Birimlar</a></li>
            <li class="breadcrumb-item active">Birim Düzenle </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form id="frmBirimDuzenle" method="post" action="">
            <?php

              for ($i=0; $i < count($this->birimBilgileri); $i++) {
                echo
                '<div class="card">
                  <div class="header">
                    <h2><strong>Birim</strong> Bilgileri</h2>
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
                    <label for="email_address">Birim Adı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->birimBilgileri[$i]["birimAdi"].'" id="'.$this->birimBilgileri[$i]["birimIdsi"].'" data-tablo-index="14" data-kolon-index="16" autocomplete="off" name="txtBirimAdi" class="txtBirimAdi form-control dataSearch" required placeholder="Birim adını giriniz">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Birim Kısaltması</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->birimBilgileri[$i]["birimKisaltmasi"].'" name="txtBirimKisaltmasi" class="txtBirimKisaltmasi form-control" required placeholder="Birim kısaltması giriniz">
                    </div>

                    </div>
                  </div>
                </div>';
              }
            ?>
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
            <a href="<?php echo $this->yolHtml; ?>birim/birim-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
          </form>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/birim/birim-duzenle/birim-duzenle.js"></script>
</body>

</html>
