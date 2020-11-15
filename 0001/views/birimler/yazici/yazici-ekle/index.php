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
          <h2 id="pageName" >Yazıcı Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Yazıcılar</a></li>
            <li class="breadcrumb-item active">Yazıcı Ekle</li>
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
              <h2><strong>Yazıcı</strong> Bilgileri</h2>
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
              <div class="alert alert-info">
                Yazıcıyı sisteme ekleyebilmeniz için yazıcının statik ip adresi bilgisine sahip olmanız gerekmektedir.
                <ul>
                  <li><strong>POSSINESS</strong>  marka yazıcı ip değiştirme programı için tıklayınız <a href="<?php echo $this->yolHtml; ?>documents/dosyalar/possiness_w10.rar" download>tıklayınız</a></li>
                  <li><strong>POSSIFY</strong>  marka yazıcı ip değiştirme programı için <a href="<?php echo $this->yolHtml; ?>documents/dosyalar/possify_w10.rar" download>tıklayınız</a></li>
                </ul>
              </div>
              <form id="frmYaziciEkle" method="post" action="">
                <label for="email_address">Yazıcı Adı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtYaziciAdi" data-tablo-index="7" data-kolon-index="9" autocomplete="off" name="txtYaziciAdi" class="form-control dataSearch" required placeholder="Yazıcıyı adlandırabilirsiniz">
                  <ul class="dropdown-menu suggestion-menu inner">

                  </ul>
                </div>
                <label for="email_address">Yazıcı Ip Adresi</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtYaziciIpAdresi" name="txtYaziciIpAdresi" class="form-control" required placeholder="Yazici ip adresini giriniz. Örn: 192.168.1.5">

                </div>

                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>yazici/yazici-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
              </form>
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
  <script src="<?php echo $this->yolHtml ?>views/birimler/yazici/yazici-ekle/yazici-ekle.js"></script>
</body>

</html>
