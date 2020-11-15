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
          <h2 id="pageName" >Stok Ürünü Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Stok Merkezi</a></li>
            <li class="breadcrumb-item active">Stok Ürünü Düzenle</li>
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
              <h2><strong>Stok Ürün</strong> Bilgileri</h2>
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
              <form id="frmStokUrunDuzenle" method="post" action="">
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Kodu</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="<?php echo $this->stokUrunBilgileri[0]["urun_kodu"]; ?>" lang="tr" id="txtStokUrunKodu" data-tablo-index="4" data-kolon-index="6" autocomplete="off" name="txtStokUrunKodu" class="form-control dataSearch uppercase"  placeholder="Ürün kodu giriniz">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" name="txtStokUrunId" value="<?php echo $this->stokUrunBilgileri[0]["id"]; ?>">

                    <label for="email_address">Ürün Barkodu</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="<?php echo $this->stokUrunBilgileri[0]["urun_barkodu"]; ?>" id="txtStokUrunBarkodu" autocomplete="off" name="txtStokUrunBarkodu" class="form-control"  placeholder="Ürün barkodu giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="email_address">Ürün Adı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="<?php echo $this->stokUrunBilgileri[0]["urun_adi"]; ?>" id="txtStokUrunAdi" data-tablo-index="4" data-kolon-index="5" autocomplete="off" required name="txtStokUrunAdi" class="form-control dataSearch"  placeholder="Ürün adını giriniz">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Birimi</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control select2 ms" data-id="<?php echo $this->stokUrunBilgileri[0]["urun_birim_idsi"]; ?>" name="txtStokUrunBirimIdsi" required>
                        <?php
                        for ($i=0; $i < count($this->birimler); $i++) {
                          echo "<option value=".$this->birimler[$i]["id"].">".$this->birimler[$i]["birim_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnBirimEkle" data-toggle="modal" data-target="#modalYeniBirimEkle" name="button">Birim Ekle</button>

                    </div>

                  </div>
                  <div class="col-md-6">
                    <label for="email_address">Ürün Adedi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" value="<?php echo $this->stokUrunBilgileri[0]["urun_adedi"]; ?>" step=".01" id="txtStokUrunAdedi" autocomplete="off" name="txtStokUrunAdedi" required class="form-control"  placeholder="Ürün mevcut stok adedini giriniz">
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="">Stok Ürün Depo</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms select2" data-id="<?php echo $this->stokUrunBilgileri[0]["urun_depo_idsi"]; ?>" required name="txtStokUrunDepoIdsi">
                        <?php
                        for ($i=0; $i < count($this->depolar); $i++) {
                          echo "<option value=".$this->depolar[$i]["id"].">".$this->depolar[$i]["depo_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnDepoEkle" data-toggle="modal" data-target="#modalYeniDepoEkle" name="button">Depo Ekle</button>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="">Ürün Kategorisi</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms select2" data-id="<?php echo $this->stokUrunBilgileri[0]["urun_kategori_idsi"]; ?>" required name="txtStokUrunKategoriIdsi">
                        <?php
                        for ($i=0; $i < count($this->kategoriler); $i++) {
                          echo "<option value=".$this->kategoriler[$i]["id"].">".$this->kategoriler[$i]["kategori_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKategoriDuzenle" data-toggle="modal" data-target="#modalYeniKategoriDuzenle" name="button">Kategori Duzenle</button>

                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Alt Uyarı Değeri <span class="zmdi zmdi-help" data-toggle="tooltip" title="Ürün, stoklarınızda bu seviyeye indiğinde sizi uyaracağız"></span> </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" value="<?php echo $this->stokUrunBilgileri[0]["urun_alt_uyari_degeri"]; ?>" step=".01" id="txtStokUrunAltUyariDegeri" autocomplete="off" required name="txtStokUrunAltUyariDegeri" class="form-control"  placeholder="Ürün alt uyarı değeri giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Stok Ürün Döviz Kuru</label>
                    <div class="input-group">
                      <div class="input-group">
                        <select class="form-control show-tick ms select2" data-id="<?php echo $this->stokUrunBilgileri[0]["urun_kur_idsi"]; ?>" required name="txtStokUrunKurIdsi" id="txtStokUrunKurIdsi">
                          <option value="">--Kur Seçiniz--</option>
                          <?php
                          for ($i=0; $i < count($this->kurlar); $i++) {
                            echo "<option value=".$this->kurlar[$i]["id"].">".$this->kurlar[$i]["kur_adi"]."</option>";
                          }
                          ?>
                        </select>
                        <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKurEkle" data-toggle="modal" data-target="#modalYeniKurEkle" name="button">Kur Ekle</button>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Alış Fiyatı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" value="<?php echo $this->stokUrunBilgileri[0]["urun_alis_fiyati"]; ?>" step=".01" id="txtStokUrunAlisFiyati" autocomplete="off" required name="txtStokUrunAlisFiyati" class="form-control"  placeholder="Ürün alış fiyatı giriniz">
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Alış Vergisi</label>
                    <div class="input-group">
                      <select class="form-control show-tick ms select2" data-id="<?php echo $this->stokUrunBilgileri[0]["urun_alis_vergi_idsi"]; ?>" required name="txtStokUrunAlisVergiIdsi" id="txtStokUrunAlisVergiIdsi">
                        <option value="">--Vergi Seçiniz--</option>
                        <?php
                        for ($i=0; $i < count($this->vergiler); $i++) {
                          echo "<option value=".$this->vergiler[$i]["id"].">".$this->vergiler[$i]["vergi_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnVergiEkle" data-toggle="modal" data-target="#modalYeniVergiEkle" name="button">Vergi Ekle</button>

                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Görselleri</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="file" multiple id="txtStokUrunGorseli" autocomplete="off" name="txtStokUrunGorseli" class="form-control"  placeholder="Ürün rengini giriniz">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="email_address">Ürün Rengi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtStokUrunRengi" value="<?php echo $this->stokUrunBilgileri[0]["urun_rengi"]; ?>" autocomplete="off" name="txtStokUrunRengi" class="form-control"  placeholder="Ürün rengini giriniz">
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>stok/stok-listesi" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
              </form>
            </div>
          </div>
        </div>
        <!-- #END# Vertical Layout -->
      </div>
    </section>
    <div class="modal fade z1051" id="modalYeniKategoriDuzenle" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <form id="frmYeniKategoriDuzenle" method="post" action="">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title" id="largeModalLabel">Yeni Kategori Duzenle</h4>
            </div>
            <div class="modal-body">
              <label for="">Kategori Adı</label>
              <input type="hidden" name="txtKategoriTabloAdi" value="tbl_urunler" required>
              <div class="input-group demoMaskedInput">
                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                <input type="text" id="txtKategoriAdi" data-kolon-index="0" data-tablo-index="0" autocomplete="off" name="txtKategoriAdi" class="form-control dataSearch"  placeholder="Kategori adı giriniz">
                <ul class="dropdown-menu suggestion-menu inner">

                </ul>
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
    <div class="modal fade z1051" id="modalYeniDepoEkle" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <form id="frmYeniDepoEkle" method="post" action="">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title" id="largeModalLabel">Yeni Depo Ekle</h4>
            </div>
            <div class="modal-body">
              <label for="">Depo Adı</label>
              <div class="input-group demoMaskedInput">
                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                <input type="text" id="txtDepoAdi" data-kolon-index="12" data-tablo-index="14" autocomplete="off" name="txtDepoAdi" class="form-control dataSearch"  placeholder="Depo adı giriniz">
                <ul class="dropdown-menu suggestion-menu inner">

                </ul>
              </div>
              <label for="email_address">Depo Adresi</label>
              <div class="input-group divSuggestion">
                <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                <input type="text" id="txtDepoAdresi" autocomplete="off" name="txtDepoAdresi" class="form-control" placeholder="Depo adresini giriniz">
              </div>
              <label for="email_address">Depo Telefon Numarası</label>
              <div class="input-group divSuggestion">
                <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                <input type="text" id="txtDepoTelefonNumarasi" autocomplete="off" name="txtDepoTelefonNumarasi" class="form-control mobile-phone-number" placeholder="+90 (000) 000 00 00">
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
    <div class="modal fade z1051" id="modalYeniMutfakEkle" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <form id="frmYeniMutfakEkle" method="post" action="">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title" id="largeModalLabel">Yeni Mutfak Ekle</h4>
            </div>
            <div class="modal-body">
              <label for="">Mutfak Adı</label>
              <input type="hidden" name="txtMutfakTabloAdi" value="tbl_urunler" required>
              <div class="input-group demoMaskedInput">
                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                <input type="text" id="txtMutfakAdi" data-kolon-index="8" data-tablo-index="6" autocomplete="off" name="txtMutfakAdi" class="form-control dataSearch"  placeholder="Mutfak adı giriniz">
                <ul class="dropdown-menu suggestion-menu inner">

                </ul>
              </div>
              <label for="">Mutfak Yazıcısı</label>
              <div class="input-group demoMaskedInput">
                <select class="form-control select2 ms-tick" name="txtMutfakYaziciIdsi" id="txtMutfakYaziciIdsi">
                  <?php
                    for ($i=0; $i < count($this->yazicilar); $i++) {
                      echo
                      '<option id="'.$this->yazicilar[$i]["id"].'"  value="'.$this->yazicilar[$i]["id"].'">'.$this->yazicilar[$i]["yazici_adi"].'</option>';
                    }
                  ?>
                </select>
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
    <?php require $this->yolPhp."arayuz/modalYeniBirimEkle.php"; ?>
    <?php require $this->yolPhp."arayuz/modalYeniKurEkle.php"; ?>
    <?php require $this->yolPhp."arayuz/modalYeniVergiEkle.php"; ?>
    <?php require $this->yolPhp."arayuz/lock.php"; ?>

    <!-- Jquery Core Js -->
    <?php require $this->yolPhp."arayuz/script.php"; ?>
    <script src="<?php echo $this->yolHtml ?>views/merkezler/stok/stok-urunu-duzenle/stok-urunu-duzenle.js"></script>
    <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
  </body>

  </html>
