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
          <h2 id="pageName" >Müşteri Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Müşterilar</a></li>
            <li class="breadcrumb-item active">Müşteri Düzenle </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form id="frmMusteriDuzenle" method="post" action="">
            <?php

              for ($i=0; $i < count($this->musteriBilgileri); $i++) {
                echo
                '<div class="card">
                  <div class="header">
                    <h2><strong>Müşteri</strong> Bilgileri</h2>
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
                    <label for="email_address">Müşteri Adı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->musteriBilgileri[$i]["musteriAdiSoyadi"].'" id="'.$this->musteriBilgileri[$i]["musteriIdsi"].'" data-tablo-index="0" data-kolon-index="0" autocomplete="off" name="txtMusteriAdiSoyadi" class="txtMusteriAdiSoyadi form-control dataSearch" required placeholder="Müşteri adını giriniz">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Müşteri Adresleri</label>';
                    if (count($this->musteriBilgileri[$i]["musteriAdresleri"]) > 0) {

                      for ($a=0; $a < count($this->musteriBilgileri[$i]["musteriAdresleri"]); $a++) {
                        if ($a == 0) {
                          echo
                          '<div class="input-group divMusteriAdresi">
                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                          <input type="text" value="'.$this->musteriBilgileri[$i]["musteriAdresleri"][$a]["musteri_adresleri_adres"].'" required name="txtMusteriAdresi[]" class="txtMusteriAdresleri form-control" placeholder="Müşteri birincil adresini giriniz">
                          <button type="button" class="btn btn-sm g-bg-cgreen buttonInsideInput btnAdresEkle" name="button">
                          <span class="zmdi zmdi-plus"></span>
                          </button>
                          </div>';
                        }else {
                          echo
                          '<div class="input-group divMusteriAdresi">
                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                          <input type="text" value="'.$this->musteriBilgileri[$i]["musteriAdresleri"][$a]["musteri_adresleri_adres"].'" required name="txtMusteriAdresi[]" class="txtMusteriAdresleri form-control" placeholder="Müşteri birincil adresini giriniz">
                          <button type="button" class="btn btn-sm bg-red buttonInsideInput btnAdresSil" name="button">
                          <span class="zmdi zmdi-minus"></span>
                          </button>
                          </div>';
                        }

                      }
                    }else {
                      echo
                      '<div class="input-group divMusteriAdresi">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="" required name="txtMusteriAdresi[]" class="txtMusteriAdresleri form-control" placeholder="Müşteri birincil adresini giriniz">
                      <button type="button" class="btn btn-sm g-bg-cgreen buttonInsideInput btnAdresEkle" name="button">
                      <span class="zmdi zmdi-plus"></span>
                      </button>
                      </div>';
                    }

                    echo '
                    <label for="email_address">Müşteri Telefon Numarası</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->musteriBilgileri[$i]["musteriTelefonNumarasi"].'" required name="txtMusteriTelefonNumarasi" class="txtMusteriTelefonNumarasi form-control mobile-phone-number" placeholder="+90 (000) 000 00 00">
                    </div>
                    <label for="email_address">Müşteri Eposta Adresi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="'.$this->musteriBilgileri[$i]["musteriEpostaAdresi"].'" name="txtMusteriEpostaAdresi" class="txtMusteriEpostaAdresi form-control email" placeholder="ornek@ornek.com">
                    </div>
                    <label for="email_address">Müşteri Notları</label>
                    <div class="input-group">
                      <textarea name="txtMusteriNotlari" class="form-control txtMusteriNotlari" style="resize:none" rows="4" cols="80" placeholder="Müşteri notlarını giriniz">'.$this->musteriBilgileri[$i]["musteriNotlari"].'</textarea>

                    </div>
                    <label for="email_address">Müşteri Adisyon İndirim Türü</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms select2 txtMusteriIndirimTuru" data-id="'.$this->musteriBilgileri[$i]["musteriIndirimTuru"].'" name="txtMusteriIndirimTuru" id="txtMusteriIndirimTuru" required>
                        <option value="0">Yüzde</option>
                        <option value="1">Miktar</option>
                      </select>
                    </div>
                    <label for="email_address">Müşteri Adisyon İndirim Miktarı</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtMusteriIndirimMiktari" required autocomplete="off" value="'.$this->musteriBilgileri[$i]["musteriIndirimMiktari"].'" name="txtMusteriIndirimMiktari" class="form-control txtMusteriIndirimMiktari" placeholder="Belirlediğiniz indirim türünün miktarını giriniz">
                    </div>

                    </div>
                  </div>
                </div>';
              }
            ?>
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
            <a href="<?php echo $this->yolHtml; ?>musteri/musteri-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
          </form>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/musteri/musteri-duzenle/musteri-duzenle.js"></script>
</body>

</html>
