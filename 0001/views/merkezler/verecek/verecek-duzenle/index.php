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
          <h2 id="pageName" >Verecek Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Verecekler</a></li>
            <li class="breadcrumb-item active">Verecek Düzenle </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form id="frmVerecekDuzenle" method="post" action="">
            <?php

              for ($i=0; $i < count($this->verecekBilgileri); $i++) {
                echo
                '<div class="card">
                  <div class="header">
                    <h2><strong>Verecek</strong> Bilgileri</h2>
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
                    <label for="email_address">Verecek Kodu</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->verecekBilgileri[$i]["verecekKodu"].'" id="'.$this->verecekBilgileri[$i]["verecekId"].'" data-tablo-index="15" data-kolon-index="17" autocomplete="off" name="txtVerecekKodu" class="txtVerecekKodu form-control dataSearch uppercase" required placeholder="Verecek kodu giriniz">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Vereceğin Yapılacağı Cari Hesap</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->verecekBilgileri[$i]["verecekCariAdi"].'" data-id="'.$this->verecekBilgileri[$i]["verecekCariIdsi"].'" id="txtVerecekCariIdsi" data-tablo-index="10" data-kolon-index="12" autocomplete="off" name="txtVerecekCariIdsi" class="form-control dataSearch txtVerecekCariIdsi" required placeholder="Cari adı giriniz">
                      <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

                      </ul>
                    </div>
                    <label for="email_address">Vereceğin Yapılacağı Kasa</label>
                    <div class="input-group divSuggestion">
                      <select data-id="'.$this->verecekBilgileri[$i]["verecekKasaIdsi"].'" class="form-control select2 ms show-tick txtVerecekKasaIdsi" name="txtVerecekKasaIdsi" id="txtVerecekKasaIdsi">
                        <option value="">--Kasa Seçiniz--</option>';

                          for ($a=0; $a < count($this->kasalar); $a++) {
                            echo
                            '<option value="'.$this->kasalar[$a]["id"].'">'.$this->kasalar[$a]["kasa_adi"].'</option>';
                          }
                          echo '
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKasaEkle" data-toggle="modal" data-target="#modalYeniKasaEkle" name="button">Kasa Ekle</button>
                    </div>
                    <label for="email_address">Verecek Tutarı</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input value="'.$this->verecekBilgileri[$i]["verecekTutari"].'" type="number" step=".01" id="txtVerecekTutari" name="txtVerecekTutari" class="form-control txtVerecekTutari" required placeholder="Verecek tutarını giriniz">
                    </div>
                    <label for="email_address">Verecek Açıklaması</label>
                    <div class="input-group divSuggestion">
                      <textarea name="txtVerecekAciklamasi" rows="4" class="form-control txtVerecekAciklamasi" cols="80" placeholder="Verecek açıklaması girebilirsiniz">'.$this->verecekBilgileri[$i]["verecekAciklamasi"].'</textarea>
                    </div>
                    </div>
                  </div>
                </div>';
              }
            ?>
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
            <a href="<?php echo $this->yolHtml; ?>verecek/verecek-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
          </form>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <?php require $this->yolPhp."arayuz/modalYeniKasaEkle.php"; ?>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>

  <script src="<?php echo $this->yolHtml ?>views/merkezler/verecek/verecek-duzenle/verecek-duzenle.js"></script>
</body>

</html>
