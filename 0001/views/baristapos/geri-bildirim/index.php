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


  <section class="content inbox">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>Geri Bildirim
            <small>Program hakkında her türlü görüş, istek ve önerilerinizi buradan bizlere ulaştırabilir, programı daha da güzelleştirmemiz için bize yardımcı olabilirsiniz</small>
          </h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Barista Pos</a></li>
            <li class="breadcrumb-item active">Geri Bildirim</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">

      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="body">
              <form id="frmGeriBildirim" action="" method="post">
                <div class="row">
                  <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group form-float">
                      <input type="text" class="form-control" name="txtKonu" required placeholder="Konu:">
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-12">
                    <strong>Mesajınız:</strong>
                    <textarea id="ckeditor" class="form-control">
                      <h2>BARISTA Pos</h2>
                      <p>Program hakkında her türlü görüş, istek ve önerilerinizi buradan bizlere ulaştırabilir, programı daha da güzelleştirmemiz için bize yardımcı olabilirsiniz.</p>
                      <p>Paylaştığınız geri bildirimler bir sonraki güncelleme için dikkate alınacak ve eklenecektir.</p>
                      <h4>Lütfen mesaj gönderirken topluluk kurallarına uyunuz!</h4>
                      <h3>Geri bildiriminiz için şimdiden teşekkür ederiz.</h3>
                    </textarea>
                    <button type="submit" class="btn btn-primary btn-round waves-effect m-t-20 btnLoading">GÖNDER</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml; ?>assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->

  <script src="<?php echo $this->yolHtml; ?>views/baristapos/geri-bildirim/geri-bildirim.js"></script>
</body>

</html>
