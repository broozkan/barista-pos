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
          <h2 id="pageName" >Çalışan Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Çalışanlar</a></li>
            <li class="breadcrumb-item active">Çalışan Ekle</li>
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
            <div class="body">
              <form id="frmCalisanEkle" method="post" action="">
                <label for="email_address">Çalışan Adı Soyadı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtCalisanAdiSoyadi" data-tablo-index="3" data-kolon-index="3" autocomplete="off" name="txtCalisanAdiSoyadi" class="form-control dataSearch" required placeholder="Çalışan adı soyadı giriniz">
                  <ul class="dropdown-menu suggestion-menu inner">

                  </ul>
                </div>
                <label for="email_address">Çalışan Adresi</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtCalisanAdresi" name="txtCalisanAdresi" class="form-control" placeholder="Çalışan adresi giriniz">
                </div>
                <label for="email_address">Çalışan Doğum Tarihi</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="date" id="txtCalisanDogumTarihi" name="txtCalisanDogumTarihi" class="form-control">
                </div>
                <label for="email_address">Çalışan Telefon Numarası</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtCalisanTelefonNumarasi" name="txtCalisanTelefonNumarasi" class="form-control mobile-phone-number" placeholder="+90 (000) 000 00 00">
                </div>
                <label for="email_address">Çalışan E-posta Adresi</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtCalisanEpostaAdresi" name="txtCalisanEpostaAdresi" class="form-control email" placeholder="ornek@ornek.com">
                </div>

                <label for="email_address">Çalışan Profil Fotoğrafı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="file" id="txtCalisanProfilFotosu" name="txtCalisanProfilFotosu" class="form-control">
                </div>

                <label for="email_address">Çalışan Statüsü</label>
                <div class="input-group divSuggestion">
                  <select class="form-control select2 ms show-tick" name="txtCalisanStatuIdsi" id="txtCalisanStatuIdsi">
                    <?php
                      for ($i=0; $i < count($this->statuler); $i++) {
                        echo
                        '<option value="'.$this->statuler[$i]["id"].'">'.$this->statuler[$i]["statu_adi"].'</option>';
                      }
                    ?>
                  </select>
                  <button type="button" class="btn btn-sm btn-default buttonInsideInput btnStatuEkle" data-toggle="modal" data-target="#modalYeniStatuEkle" name="button">Statü Ekle</button>

                </div>

                <label for="email_address">Çalışan Kullanıcı Adı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="text" id="txtCalisanKullaniciAdi" data-tablo-index="3" data-kolon-index="4" autocomplete="off" name="txtCalisanKullaniciAdi" class="form-control dataSearch" placeholder="Kullanıcı adı giriniz">
                  <ul class="dropdown-menu suggestion-menu inner ulKullaniciAdlari">

                  </ul>
                </div>
                <label for="email_address">Çalışan Parolası</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="password" id="txtCalisanParolasi" required autocomplete="off" name="txtCalisanParolasi" class="form-control" placeholder="Parola giriniz">
                </div>
                <label for="email_address">Çalışan Parola Tekrar</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="password" id="txtCalisanParolasiTekrar" required autocomplete="off" name="txtCalisanParolasiTekrar" class="form-control" placeholder="Parola giriniz (Tekrar)">
                </div>
                <label for="email_address">Çalışan Pini </label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="password" id="txtCalisanPini" required autocomplete="off" name="txtCalisanPini" class="form-control" placeholder="Sisteme giriş pini giriniz">
                </div>
                <label for="email_address">Çalışan Pini (Tekrar)</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="password" id="txtCalisanPiniTekrar" required autocomplete="off" name="txtCalisanPiniTekrar" class="form-control" placeholder="Sisteme giriş pini giriniz (Tekrar)">
                </div>
                <label for="email_address">Çalışan Adisyon İndirim Türü</label>
                <div class="input-group divSuggestion">
                  <select class="form-control show-tick ms select2" name="txtCalisanIndirimTuru" id="txtCalisanIndirimTuru" required>
                    <option value="0">Yüzde</option>
                    <option value="1">Miktar</option>
                  </select>
                </div>
                <label for="email_address">Çalışan Adisyon İndirim Miktarı</label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="number" step=".01" id="txtCalisanIndirimMiktari" required autocomplete="off" name="txtCalisanIndirimMiktari" class="form-control" placeholder="Belirlediğiniz indirim türünün miktarını giriniz">
                </div>
                <label for="email_address">Çalışan Günlük Harcama Sınırı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Çalışanınızın kendisine harcayabileceği miktarı kısıtlayabilirsiniz. Sınır koymak istemiyorsanız boş bırakabilirsiniz"></span> </label>
                <div class="input-group divSuggestion">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input type="number" step=".01" id="txtCalisanGunlukHarcamaSiniri" autocomplete="off" name="txtCalisanGunlukHarcamaSiniri" class="form-control" placeholder="Çalışan günlük sınırını giriniz">
                </div>
                <label for="email_address">Çalışan Hızlı Notları</label>
                <div class="input-group divSuggestion">
                  <input type="text" class="form-control" data-role="tagsinput" placeholder="Çalışan hızlı notları giriniz" items="">
                </div>

                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>calisan/calisan-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- #END# Vertical Layout -->
    </div>
  </section>



  <?php require $this->yolPhp."arayuz/modalYeniStatuEkle.php"; ?>
  <?php require $this->yolPhp."arayuz/modalYeniDepartmanEkle.php"; ?>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/calisanlar/calisan-ekle/calisan-ekle.js"></script>
  <script src="<?php echo $this->yolHtml ?>views/birimler/statu/statu-ekle/statu-ekle.js"></script>
</body>

</html>
