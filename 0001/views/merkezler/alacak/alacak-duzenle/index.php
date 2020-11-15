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
          <h2 id="pageName" >Alacak Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Alacaklar</a></li>
            <li class="breadcrumb-item active">Alacak Düzenle </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form id="frmAlacakDuzenle" method="post" action="">
            <?php

              for ($i=0; $i < count($this->alacakBilgileri); $i++) {
                echo
                '<div class="card">
                  <div class="header">
                    <h2><strong>Alacak</strong> Bilgileri</h2>
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
                    <label for="email_address">Alacak Kodu</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->alacakBilgileri[$i]["alacakKodu"].'" id="'.$this->alacakBilgileri[$i]["alacakId"].'" data-tablo-index="19" data-kolon-index="21" autocomplete="off" name="txtAlacakKodu" class="txtAlacakKodu form-control dataSearch uppercase" required placeholder="Alacak kodu giriniz">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Alacaknin Yapılacağı Cari Hesap</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->alacakBilgileri[$i]["alacakCariAdi"].'" data-id="'.$this->alacakBilgileri[$i]["alacakCariIdsi"].'" id="txtAlacakCariIdsi" data-tablo-index="10" data-kolon-index="12" autocomplete="off" name="txtAlacakCariIdsi" class="form-control dataSearch txtAlacakCariIdsi" required placeholder="Cari adı giriniz">
                      <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

                      </ul>
                    </div>
                    <label for="email_address">Alacaknin Yapılacağı Kasa</label>
                    <div class="input-group divSuggestion">
                      <select data-id="'.$this->alacakBilgileri[$i]["alacakKasaIdsi"].'" class="form-control select2 ms show-tick txtAlacakKasaIdsi" name="txtAlacakKasaIdsi" id="txtAlacakKasaIdsi">
                        <option value="">--Kasa Seçiniz--</option>';

                          for ($a=0; $a < count($this->kasalar); $a++) {
                            echo
                            '<option value="'.$this->kasalar[$a]["id"].'">'.$this->kasalar[$a]["kasa_adi"].'</option>';
                          }
                          echo '
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKasaEkle" data-toggle="modal" data-target="#modalYeniKasaEkle" name="button">Kasa Ekle</button>
                    </div>
                    <label for="email_address">Alacak Tutarı</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input value="'.$this->alacakBilgileri[$i]["alacakTutari"].'" type="number" step=".01" id="txtAlacakTutari" name="txtAlacakTutari" class="form-control txtAlacakTutari" required placeholder="Alacak tutarını giriniz">
                    </div>
                    <label for="email_address">Alacak Açıklaması</label>
                    <div class="input-group divSuggestion">
                      <textarea name="txtAlacakAciklamasi" rows="4" class="form-control txtAlacakAciklamasi" cols="80" placeholder="Alacak açıklaması girebilirsiniz">'.$this->alacakBilgileri[$i]["alacakAciklamasi"].'</textarea>
                    </div>
                    </div>
                  </div>
                </div>';
              }
            ?>
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
            <a href="<?php echo $this->yolHtml; ?>alacak/alacak-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
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

  <script src="<?php echo $this->yolHtml ?>views/merkezler/alacak/alacak-duzenle/alacak-duzenle.js"></script>
</body>

</html>
