<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>
<style media="screen">
.card .header .header-dropdown{
  top: 0px;
  right: 0px;
}
a.active{
  color: white!important;
}
.card .body{
  padding: 0px!important;
}
.card .header{
  padding: 15px!important;
}
.card{
  margin-bottom: 10px!important;
}
.card .body h3{
  margin-bottom: 10px!important;
}
.cardKapali{
  border: 2px solid;
  border-color: #888897;
}
.cardAcik{
  border: 2px solid;
  border-color: #18ce0f;
}
.cardKilitli{
  border: 2px solid;
  border-color: #f96332;
}
.cardRezerve{
  border: 2px solid;
  border-color: #f96332;
}

</style>
<body class="theme-blue ls-toggle-menu">
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

  <!-- Main Content -->
  <section class="content">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 col-xs-12">
          <video id="preview" style="width:100%"></video>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <form id="frmQrMasa" method="post" action="<?php echo $this->yolHtml; ?>restoran/qr-adisyon">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="title" id="largeModalLabel">Qr Adisyon Sorgula</h4>
              </div>
              <div class="modal-body">
                <label for="">QR KOD</label>
                <div class="input-group demoMaskedInput">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtQrKod" autocomplete="off" autofocus name="txtQrKod" class="form-control" required placeholder="Qr kodu okutunuz">
                  <button type="button" class="btn btn-sm btn-default buttonInsideInput btnLoading btnQrKameraAc" name="button"> <span class="zmdi zmdi-search"></span> QR Kod Tara</button>

                </div>
                <div class="modal-footer">
                  <a href="http://<?php echo $this->ipAdresi; ?>/<?php echo $this->yolHtml; ?>restoran/masalar" class="btn bg-red waves-effect btnIptal">İPTAL</a>
                </div>
              </div>
            </form>

        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">



      </div>
    </div>
  </section>

  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <?php require $this->yolPhp."arayuz/modalDovizCevirici.php"; ?>


  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/instascan.min.js"></script>

  <script src="<?php echo $this->yolHtml ?>assets/js/pages/mutfak-websocket.js"></script>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
  <script src="<?php echo $this->yolHtml ?>views/restoran/qr-adisyon-sorgula/qr-adisyon-sorgula.js"></script>

</body>

</html>
