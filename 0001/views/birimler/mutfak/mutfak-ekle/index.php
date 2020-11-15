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
          <h2 id="pageName" >Mutfak Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Mutfaklar</a></li>
            <li class="breadcrumb-item active">Mutfak Ekle</li>
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
            <div class="body">
              <form id="frmMutfakEkle" method="post" action="">
                <label for="email_address">Mutfak Adı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtMutfakAdi" data-tablo-index="6" data-kolon-index="8" autocomplete="off" name="txtMutfakAdi" class="form-control dataSearch" required placeholder="Mutfak adını giriniz">
                  <ul class="dropdown-menu suggestion-menu inner">

                  </ul>
                </div>
                <label for="email_address">Mutfak Yazıcısı</label>
                <div class="input-group divSuggestion">
                  <select class="form-control select2 ms-tick" name="txtMutfakYaziciIdsi" id="txtMutfakYaziciIdsi">
                    <?php
                      for ($i=0; $i < count($this->yazicilar); $i++) {
                        echo
                        '<option id="'.$this->yazicilar[$i]["id"].'"  value="'.$this->yazicilar[$i]["id"].'">'.$this->yazicilar[$i]["yazici_adi"].'</option>';
                      }
                    ?>
                  </select>
                  <button type="button" class="btn btn-sm btn-default buttonInsideInput btnYaziciEkle" data-toggle="modal" data-target="#modalYeniYaziciEkle" name="button">Yazıcı Ekle</button>

                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>mutfak/mutfak-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- #END# Vertical Layout -->
    </div>
  </section>
  <div class="modal fade z1051" id="modalYeniYaziciEkle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form id="frmYeniYaziciEkle" method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="largeModalLabel">Yeni Yazıcı Ekle</h4>
          </div>
          <div class="modal-body">
            <label for="">Yazıcı Adı</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
              <input type="text" id="txtYaziciAdi" data-kolon-index="9" data-tablo-index="7" autocomplete="off" name="txtYaziciAdi" class="form-control dataSearch"  placeholder="Yazici adı giriniz">
              <ul class="dropdown-menu suggestion-menu inner">

              </ul>
            </div>
            <label for="">Yazıcı İp Adresi</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
              <input type="text" id="txtYaziciIpAdresi" name="txtYaziciIpAdresi" class="form-control"  placeholder="Yazici ip adresini giriniz. Örn: 192.168.1.5">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">AKTAR</button>
            <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">İPTAL</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/mutfak/mutfak-ekle/mutfak-ekle.js"></script>
</body>

</html>
