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
          <h2 id="pageName" >Kur Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Kurlar</a></li>
            <li class="breadcrumb-item active">Kur Düzenle </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form id="frmKurDuzenle" method="post" action="">
            <?php

              for ($i=0; $i < count($this->kurBilgileri); $i++) {
                echo
                '<div class="card">
                  <div class="header">
                    <h2><strong>Kur</strong> Bilgileri</h2>
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
                    <label for="email_address">Kur Adı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->kurBilgileri[$i]["kurAdi"].'" id="'.$this->kurBilgileri[$i]["kurId"].'" data-tablo-index="9" data-kolon-index="11" autocomplete="off" name="txtKurAdi" class="txtKurAdi form-control dataSearch" required placeholder="Kur adını giriniz">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Kur İşareti</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->kurBilgileri[$i]["kurIsareti"].'"  name="txtKurIsareti" class="txtKurIsareti form-control" placeholder="Kur işaretini giriniz">
                    </div>
                    <label for="email_address">Kur Kısaltması</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->kurBilgileri[$i]["kurKisaltmasi"].'"  name="txtKurKisaltmasi" class="txtKurKisaltmasi form-control" placeholder="Kur kısaltmasını giriniz">
                    </div>
                    <label for="email_address">Kur Aktivitesi <span class="zmdi zmdi-help" data-toggle="tooltip" title="Aktif işaretlemeniz durumunda birincil döviz kurunuz olur ve diğer tüm kurlar pasif moduna düşer."></span> </label>
                    <div class="input-group divSuggestion">
                      <select data-id="'.$this->kurBilgileri[$i]["kurAktifMi"].'" class="form-control ms show-tick txtKurAktifMi" name="txtKurAktifMi" id="txtKurAktifMi">
                        <option value="0">Pasif</option>
                        <option value="1">Aktif</option>
                      </select>
                    </div>

                    </div>
                  </div>
                </div>';
              }
            ?>
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
            <a href="<?php echo $this->yolHtml; ?>kur/kur-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
          </form>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/kur/kur-duzenle/kur-duzenle.js"></script>
</body>

</html>
