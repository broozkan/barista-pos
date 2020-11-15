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
          <h2 id="pageName" >Ödeme Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Muhasebe Merkezi</a></li>
            <li class="breadcrumb-item active">Ödeme Ekle</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong>Ödeme</strong> Bilgileri</h2>
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
            <div class="body">
              <form id="frmOdemeEkle" method="post" action="">
                <label for="email_address">Ödeme Kodu</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtOdemeKodu" data-tablo-index="15" data-kolon-index="17" autocomplete="off" name="txtOdemeKodu" class="form-control dataSearch" required placeholder="Ödeme kodunu giriniz">
                  <ul class="dropdown-menu suggestion-menu inner">

                  </ul>
                </div>

                <label for="email_address">Ödemenin Yapılacağı Cari Hesap</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtOdemeCariIdsi" data-tablo-index="10" data-kolon-index="12" autocomplete="off" name="txtOdemeCariIdsi" class="form-control dataSearch" required placeholder="Cari adı giriniz">
                  <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

                  </ul>
                </div>
                <label for="email_address">Ödemenin Yapılacağı Kasa</label>
                <div class="input-group divSuggestion">
                  <select data-id="<?php echo $this->birincilKasaIdsi; ?>" class="form-control select2 ms show-tick" name="txtOdemeKasaIdsi" id="txtOdemeKasaIdsi">
                    <option value="">--Kasa Seçiniz--</option>
                    <?php
                      for ($i=0; $i < count($this->kasalar); $i++) {
                        echo
                        '<option value="'.$this->kasalar[$i]["id"].'">'.$this->kasalar[$i]["kasa_adi"].'</option>';
                      }

                    ?>
                  </select>
                  <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKasaEkle" data-toggle="modal" data-target="#modalYeniKasaEkle" name="button">Kasa Ekle</button>

                </div>
                <label for="email_address">Ödeme Tarihi</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="date" id="txtOdemeTarihi" name="txtOdemeTarihi" class="form-control" required placeholder="Ödeme tarihini giriniz">
                </div>
                <label for="email_address">Ödeme Tutarı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="number" step=".01" id="txtOdemeTutari" name="txtOdemeTutari" class="form-control" required placeholder="Ödeme tutarını giriniz">
                </div>
                <label for="email_address">Ödeme Açıklaması</label>
                <div class="input-group divSuggestion">
                  <textarea name="txtOdemeAciklamasi" rows="4" class="form-control" cols="80" placeholder="Ödeme açıklaması girebilirsiniz"></textarea>
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>odeme/odeme-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
              </form>
            </div>
          </div>
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
  <script src="<?php echo $this->yolHtml ?>views/merkezler/odeme/odeme-ekle/odeme-ekle.js"></script>
</body>

</html>
