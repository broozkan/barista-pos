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
          <h2 id="pageName" >Mutfak Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Mutfaklar</a></li>
            <li class="breadcrumb-item active">Mutfak Düzenle </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form id="frmMutfakDuzenle" method="post" action="">
            <?php

              for ($i=0; $i < count($this->mutfakBilgileri); $i++) {
                echo
                '<div class="card">
                  <div class="header">
                    <h2><strong>Mutfak</strong> Bilgileri</h2>
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
                    <label for="email_address">Mutfak Adı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->mutfakBilgileri[$i]["mutfakAdi"].'" id="'.$this->mutfakBilgileri[$i]["mutfakId"].'" data-tablo-index="6" data-kolon-index="8" autocomplete="off" name="txtMutfakAdi" class="txtMutfakAdi form-control dataSearch" required placeholder="Mutfak adını giriniz">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Mutfak Yazıcısı</label>
                    <div class="input-group divSuggestion">
                      <select data-id="'.$this->mutfakBilgileri[$i]["mutfakYaziciIdsi"].'" class="form-control  ms show-tick txtMutfakYaziciIdsi" name="txtMutfakYaziciIdsi" id="txtMutfakYaziciIdsi">';

                        for ($i=0; $i < count($this->yazicilar); $i++) {
                          echo
                          '<option id="'.$this->yazicilar[$i]["id"].'"  value="'.$this->yazicilar[$i]["id"].'">'.$this->yazicilar[$i]["yazici_adi"].'</option>';
                        }
                      echo '
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnYaziciEkle" data-toggle="modal" data-target="#modalYeniYaziciEkle" name="button">Yazıcı Ekle</button>

                    </div>

                    </div>
                  </div>
                </div>';
              }
            ?>
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
            <a href="<?php echo $this->yolHtml; ?>mutfak/mutfak-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
          </form>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/mutfak/mutfak-duzenle/mutfak-duzenle.js"></script>
</body>

</html>
