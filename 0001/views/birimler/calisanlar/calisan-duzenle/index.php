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
          <h2 id="pageName" >Çalışan Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Çalışanlar</a></li>
            <li class="breadcrumb-item active">Çalışan Düzenle </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form id="frmCalisanDuzenle" method="post" action="">
            <?php

              for ($i=0; $i < count($this->calisanBilgileri); $i++) {
                echo
                '<div class="card">
                  <div class="header">
                    <h2><strong>Çalışan</strong> Bilgileri</h2>
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
                  <div class="row">
                    <div class="col-md-10">
                      <label for="email_address">Çalışan Adı Soyadı</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>

                        <input type="text" value="'.$this->calisanBilgileri[$i]["calisanAdiSoyadi"].'" id="'.$this->calisanBilgileri[$i]["calisanIdsi"].'" data-tablo-index="3" data-kolon-index="3" autocomplete="off" name="txtCalisanAdiSoyadi" class="txtCalisanAdiSoyadi form-control dataSearch" required placeholder="Çalışan adını giriniz">
                        <ul class="dropdown-menu suggestion-menu inner"></ul>
                      </div>
                      <label for="email_address">Çalışan Adresi</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>

                        <input type="text" value="'.$this->calisanBilgileri[$i]["calisanAdresi"].'" autocomplete="off" name="txtCalisanAdresi" class="txtCalisanAdresi form-control" placeholder="Çalışan adresi giriniz">
                        <ul class="dropdown-menu suggestion-menu inner"></ul>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <img src="/local-assets/calisanlar/'.$this->calisanBilgileri[$i]["calisanProfilFotosu"].'"  class="rounded-circle pull-right"/>
                    </div>
                  </div>

                    <label for="email_address">Çalışan Doğum Tarihi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>

                      <input type="date" value="'.$this->calisanBilgileri[$i]["calisanDogumTarihi"].'" name="txtCalisanDogumTarihi" class="txtCalisanDogumTarihi form-control">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Çalışan Telefon Numarası</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>

                      <input type="text" value="'.$this->calisanBilgileri[$i]["calisanTelefonNumarasi"].'" name="txtCalisanTelefonNumarasi" class="txtCalisanTelefonNumarasi form-control mobile-phone-number" placeholder="+90 (000) 000 00 00">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Çalışan E-posta Adresi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>

                      <input type="text" value="'.$this->calisanBilgileri[$i]["calisanEpostaAdresi"].'" name="txtCalisanEpostaAdresi" class="txtCalisanEpostaAdresi form-control email" placeholder="ornek@ornek.com">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Çalışan Profil Fotoğrafı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>

                      <input type="file" name="txtCalisanProfilFotosu" id="txtCalisanProfilFotosu" class="txtCalisanProfilFotosu form-control">
                      <ul class="dropdown-menu suggestion-menu inner"></ul>
                    </div>
                    <label for="email_address">Çalışan Statüsü</label>
                    <div class="input-group divSuggestion">
                      <select data-id="'.$this->calisanBilgileri[$i]["calisanStatuIdsi"].'" class="form-control select2 ms show-tick txtCalisanStatuIdsi" name="txtCalisanStatuIdsi" id="txtCalisanStatuIdsi">';

                          for ($a=0; $a < count($this->statuler); $a++) {
                            echo
                            '<option value="'.$this->statuler[$a]["id"].'">'.$this->statuler[$a]["statu_adi"].'</option>';
                          }
                          echo '
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnStatuEkle" data-toggle="modal" data-target="#modalYeniStatuEkle" name="button">Statü Ekle</button>

                    </div>
                    <label for="email_address">Çalışan Adisyon İndirim Türü</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms select2 txtCalisanIndirimTuru" data-id="'.$this->calisanBilgileri[$i]["calisanIndirimTuru"].'" name="txtCalisanIndirimTuru" id="txtCalisanIndirimTuru" required>
                        <option value="0">Yüzde</option>
                        <option value="1">Miktar</option>
                      </select>
                    </div>
                    <label for="email_address">Çalışan Adisyon İndirim Miktarı</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtCalisanIndirimMiktari" required autocomplete="off" value="'.$this->calisanBilgileri[$i]["calisanIndirimMiktari"].'" name="txtCalisanIndirimMiktari" class="form-control txtCalisanIndirimMiktari" placeholder="Belirlediğiniz indirim türünün miktarını giriniz">
                    </div>
                    <label for="email_address">Çalışan Günlük Harcama Sınırı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Çalışanınızın kendisine harcayabileceği miktarı kısıtlayabilirsiniz. Sınır koymak istemiyorsanız boş bırakabilirsiniz"></span> </label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtCalisanGunlukHarcamaSiniri" autocomplete="off" value="'.$this->calisanBilgileri[$i]["calisanGunlukHarcamaSiniri"].'" name="txtCalisanGunlukHarcamaSiniri" class="form-control txtCalisanGunlukHarcamaSiniri" placeholder="Çalışan günlük sınırını giriniz">
                    </div>
                  </div>
                </div>';
              }
            ?>
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
            <a href="<?php echo $this->yolHtml; ?>calisan/calisan-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
          </form>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <div class="modal fade z1051" id="modalYeniKategoriEkle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form id="frmYeniKategoriEkle" method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="largeModalLabel">Yeni Kategori Ekle</h4>
          </div>
          <div class="modal-body">
            <label for="">Kategori Adı</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
              <input type="hidden" name="txtKategoriTabloAdi" value="<?php echo $this->kategoriTabloAdi; ?>">
              <input type="text" id="txtKategoriAdi" data-kolon-index="0" data-tablo-index="0" autocomplete="off" name="txtKategoriAdi" class="form-control dataSearch" required placeholder="Kategori adı giriniz">
              <ul class="dropdown-menu suggestion-menu inner">

              </ul>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">KAYDET</button>
            <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">İPTAL</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php require $this->yolPhp."arayuz/modalYeniDepartmanEkle.php"; ?>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/calisanlar/calisan-duzenle/calisan-duzenle.js"></script>
</body>

</html>
