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
          <h2 id="pageName" >Menü Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Menüler</a></li>
            <li class="breadcrumb-item active">Menü Ekle</li>
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
              <h2><strong>Menü</strong> Bilgileri</h2>
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
              <form id="frmMenuEkle" method="post" action="">
                <label for="email_address">Menü Adı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtMenuAdi" name="txtMenuAdi" class="form-control" required placeholder="Menü adını giriniz">
                </div>
                <label for="email_address">Menü Görselleri</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="file" multiple id="txtMenuGorselleri" name="txtMenuGorselleri" class="form-control" >
                </div>
                <label for="">Menünün Gideceği Mutfaklar <span class="zmdi zmdi-help" data-toggle="tooltip" title="Eğer birbirinden ayrı mutfaklarınız varsa ve belirli ürünler belirli mutfaklardan çıkıyorsa buradan ürünün hangi mutfaklardan çıkacağını ayarlayabilirsiniz. Boş bırakırsanız ürün herhangi bir yazıcıdan çıkmaz."></span> <span class="zmdi zmdi-help" data-toggle="tooltip" title="Shift tuşuna basılı tutarak çoklu seçim yapabilirsiniz."></span></label>
                <div class="input-group divSuggestion">
                  <select class="form-control show-tick ms" multiple name="txtMenuMutfakIdleri[]" id="txtMenuMutfakIdleri">
                    <?php
                    for ($i=0; $i < count($this->mutfaklar); $i++) {
                      echo "<option value=".$this->mutfaklar[$i]["id"].">".$this->mutfaklar[$i]["mutfak_adi"]."</option>";
                    }
                    ?>
                  </select>
                  <button type="button" class="btn btn-sm btn-default buttonInsideInput btnMutfakEkle" data-toggle="modal" data-target="#modalYeniMutfakEkle" name="button">Mutfak Ekle</button>

                </div>
                <label for="email_address">Menü Ürünleri</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtMenuUrunuAra" data-tablo-index="4" data-kolon-index="5" autocomplete="off" class="form-control dataSearch" placeholder="Ürün adını giriniz">
                  <ul class="dropdown-menu suggestion-menu inner menuUrunleri">

                  </ul>
                </div>
                <div class="table-responsive">
                  <table class="table tblMenuUrunleri">
                    <thead>
                      <th>Ürün Adı</th>
                      <th>Ürün Adedi</th>
                      <th>Ürün Fiyati</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
                <h4>Seçtiğiniz ürünlerin toplamı : <span id="spanUrunToplamTutar">0.00</span></h4>
                <label for="email_address">Menü Fiyatı   </label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="number" step=".01" id="txtMenuToplamFiyati" name="txtMenuToplamFiyati" class="form-control" required placeholder="Menünün satılacağı tutarı giriniz">
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>menu/menu-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
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
  <script src="<?php echo $this->yolHtml ?>views/birimler/menu/menu-ekle/menu-ekle.js"></script>
</body>

</html>
