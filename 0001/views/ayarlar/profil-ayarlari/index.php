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
          <h2 id="pageName" >Profil Ayarları</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Ayarlar</a></li>
            <li class="breadcrumb-item active">Profil Ayarları</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-4">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
              <div class="header">
                <h2><strong>Profil</strong> Bilgileri</h2>
              </div>
              <div class="body">
                <form id="frmProfilGuncelle" method="post" action="">
                  <label for="email_address">Ad Soyad</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                    <input value="<?php echo $this->calisanBilgileri["calisan_adi_soyadi"]; ?>" type="text" id="txtCalisanAdiSoyadi" name="txtCalisanAdiSoyadi" class="form-control" required placeholder="Adınızı ve soyadınızı giriniz">
                  </div>
                  <label for="email_address">Adres</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-google-maps"></i></span>
                    <input value="<?php echo $this->calisanBilgileri["calisan_adresi"]; ?>" type="text" id="txtCalisanAdresi" name="txtCalisanAdresi" class="form-control" required placeholder="Adresini giriniz">
                  </div>
                  <label for="email_address">Doğum Tarihiniz</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                    <input value="<?php echo $this->calisanBilgileri["calisan_dogum_tarihi"]; ?>" type="date" id="txtCalisanDogumTarihi" name="txtCalisanDogumTarihi" class="form-control" placeholder="">
                  </div>
                  <label for="email_address">Telefon Numaranız</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
                    <input value="<?php echo $this->calisanBilgileri["calisan_telefon_numarasi"]; ?>" type="text" id="txtCalisanTelefonu" name="txtCalisanTelefonu" class="form-control mobile-phone-number" placeholder="Örn: +00 (000) 000-00-00">
                  </div>
                  <label for="email_address">E-posta Adresiniz</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                    <input value="<?php echo $this->calisanBilgileri["calisan_eposta_adresi"]; ?>" type="text" id="txtCalisanEpostaAdresi" name="txtCalisanEpostaAdresi" class="form-control email" placeholder="Örn: eposta@eposta.com">
                  </div>
                  <label for="email_address">Profil Fotoğrafınız</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                    <input value="<?php echo $this->calisanBilgileri["calisan_profil_fotosu"]; ?>" type="file" id="txtCalisanProfilFotosu" name="txtCalisanProfilFotosu" class="form-control" placeholder="">
                  </div>
                  <label for="email_address">Kullanıcı Adınız</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                    <input value="<?php echo $this->calisanBilgileri["calisan_kullanici_adi"]; ?>" data-tablo-index="3" data-kolon-index="4" type="text" id="txtCalisanKullaniciAdi" name="txtCalisanKullaniciAdi" class="form-control dataSearch" placeholder="">
                    <ul class="dropdown-menu suggestion-menu inner">

                    </ul>
                  </div>
                  <label for="email_address">Hızlı Notlarınız</label>
                  <div class="input-group divSuggestion">
                    <?php
                    $calisanHizliNotlari = json_decode($this->calisanBilgileri["calisan_hizli_notlari"],true);
                    for ($i=0; $i < count($calisanHizliNotlari); $i++) {
                      echo '<span class="tag badge badge-info">'.$calisanHizliNotlari[$i].'<span data-role="remove" class="zmdi zmdi-close"></span></span>';
                    }
                    ?>
                    <input type="text" class="form-control" data-role="tagsinput" placeholder="Çalışan hızlı notları giriniz" items="">
                  </div>

                  <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                <div class="header">
                  <h2><strong>Parola</strong> Değiştir</h2>
                </div>
                <div class="body">
                  <form id="frmParolaDegistir" method="post" action="">
                    <label for="email_address">Eski Parolanız</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="password" id="txtEskiParola" name="txtEskiParola" class="form-control" required placeholder="Eski parolanızı giriniz">
                    </div>
                    <label for="email_address">Yeni Parolanız</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="password" id="txtYeniParola" name="txtYeniParola" class="form-control" required placeholder="Yeni parolanızı giriniz">
                    </div>
                    <label for="email_address">Yeni Parolanız (Tekrar)</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="password" id="txtYeniParolaTekrar" name="txtYeniParolaTekrar" class="form-control" required placeholder="Yeni parolanızı tekrar giriniz">
                    </div>

                    <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                <div class="header">
                  <h2><strong>Pin</strong> Değiştir</h2>
                </div>
                <div class="body">
                  <form id="frmPinDegistir" method="post" action="">
                    <label for="email_address">Eski Pininiz</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="password" id="txtEskiPin" name="txtEskiPin" class="form-control" maxlength="4" size="4" required placeholder="Eski pininizi giriniz">
                    </div>
                    <label for="email_address">Yeni Pininiz</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="password" id="txtYeniPin" name="txtYeniPin" class="form-control" maxlength="4" size="4" required placeholder="Yeni pininizi giriniz">
                    </div>
                    <label for="email_address">Yeni Pininiz (Tekrar)</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="password" id="txtYeniPinTekrar" name="txtYeniPinTekrar" class="form-control" maxlength="4" size="4" required placeholder="Yeni pininizi tekrar giriniz">
                    </div>

                    <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                <div class="header">
                  <h2><strong>Varsayılanları</strong> Değiştir</h2>
                </div>
                <div class="body">
                  <form id="frmVarsayilanlariDegistir" method="post" action="">
                    <label for="email_address">Birincil Adisyon Fişi Yazıcısı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Adisyonu yazdırmak istediğinizde ve hızlı satışta siparişi tamamladığınızda buradan seçtiğiniz yazıcıdan çıkacaktır"></span></label>
                    <div class="input-group">
                      <select class="form-control ms show-tick select2" name="txtCalisanAdisyonYaziciIdsi" data-id="<?php echo $this->calisanBilgileri["calisan_adisyon_yazici_idsi"] ?>">
                        <?php
                        for ($i=0; $i < count($this->yazicilar) ; $i++) {
                          echo '<option value="'.$this->yazicilar[$i]["id"].'" >'.$this->yazicilar[$i]["yazici_adi"].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <label for="email_address">Birincil Paket Servis Fişi Yazıcısı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Paket servis fişini yazdırmak istediğinizde buradan seçtiğiniz yazıcıdan çıkacaktır"></span></label>
                    <div class="input-group">
                      <select class="form-control ms show-tick select2" name="txtCalisanPaketServisYaziciIdsi" data-id="<?php echo $this->calisanBilgileri["calisan_paket_servis_yazici_idsi"] ?>">
                        <?php
                        for ($i=0; $i < count($this->yazicilar) ; $i++) {
                          echo '<option value="'.$this->yazicilar[$i]["id"].'" >'.$this->yazicilar[$i]["yazici_adi"].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <label for="email_address">Birincil Hızlı Satış Fişi Yazıcısı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Hızlı satış fişini yazdırmak istediğinizde buradan seçtiğiniz yazıcıdan çıkacaktır"></span></label>
                    <div class="input-group">
                      <select class="form-control ms show-tick select2" name="txtCalisanHizliSatisYaziciIdsi" data-id="<?php echo $this->calisanBilgileri["calisan_hizli_satis_yazici_idsi"] ?>">
                        <?php
                        for ($i=0; $i < count($this->yazicilar) ; $i++) {
                          echo '<option value="'.$this->yazicilar[$i]["id"].'" >'.$this->yazicilar[$i]["yazici_adi"].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                  </form>
                </div>
              </div>
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
  <script src="<?php echo $this->yolHtml; ?>views/ayarlar/profil-ayarlari/profil-ayarlari.js"></script>

</body>

</html>
