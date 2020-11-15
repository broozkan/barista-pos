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
          <h2 id="pageName" >Stok Ürünü Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Stok Merkezi</a></li>
            <li class="breadcrumb-item active">Stok Ürünü Ekle</li>
          </ul>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
          <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modalExceldenAktar" name="button"><span class="zmdi zmdi-file"></span> Excelden Aktar</button>
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
              <form id="frmStokUrunEkle" method="post" action="">
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Stok Ürün Kodu</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" lang="tr" id="txtStokUrunKodu" data-tablo-index="4" data-kolon-index="6" autocomplete="off" name="txtStokUrunKodu" class="form-control dataSearch uppercase"  placeholder="Stok Ürün kodu giriniz">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="email_address">Stok Ürün Barkodu</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtStokUrunBarkodu" autocomplete="off" name="txtStokUrunBarkodu" class="form-control"  placeholder="Stok Ürün barkodu giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="email_address">Stok Ürün Adı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtStokUrunAdi" data-tablo-index="4" data-kolon-index="5" autocomplete="off" required name="txtStokUrunAdi" class="form-control dataSearch"  placeholder="Stok Ürün adını giriniz">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Stok Ürün Birimi</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control select2 ms" name="txtStokUrunBirimIdsi" required>
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
                    <label for="email_address">Stok Ürün Adedi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtStokUrunAdedi" autocomplete="off" name="txtStokUrunAdedi" required class="form-control"  placeholder="Stok Ürün mevcut stok adedini giriniz">
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="">Stok Ürün Depo</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms select2" required name="txtStokUrunDepoIdsi">
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
                    <label for="">Stok Ürün Kategorisi</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms select2" required name="txtStokUrunKategoriIdsi">
                        <?php
                        for ($i=0; $i < count($this->urunKategoriBilgileri); $i++) {
                          echo "<option value=".$this->urunKategoriBilgileri[$i]["kategoriId"].">".$this->urunKategoriBilgileri[$i]["kategoriAdi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKategoriEkle" data-toggle="modal" data-target="#modalYeniKategoriEkle" name="button">Kategori Ekle</button>

                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Stok Ürün Alt Uyarı Değeri <span class="zmdi zmdi-help" data-toggle="tooltip" title="Stok Ürün, stoklarınızda bu seviyeye indiğinde sizi uyaracağız"></span> </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtStokUrunAltUyariDegeri" autocomplete="off" required name="txtStokUrunAltUyariDegeri" class="form-control"  placeholder="Stok Ürün alt uyarı değeri giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Stok Ürün Döviz Kuru</label>
                    <div class="input-group">
                      <div class="input-group">
                        <select class="form-control show-tick ms select2" data-id="<?php echo $this->birincilKurIdsi; ?>" required name="txtStokUrunKurIdsi" id="txtStokUrunKurIdsi">
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
                    <label for="email_address">Stok Ürün Alış Fiyatı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Stok Ürünün, birim fiyatının alış fiyatıdır. Örneğin birimini kg olarak seçtiyseniz 1 kg alımının fiyatını girmelisiniz"></span></label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtStokUrunAlisFiyati" autocomplete="off" required name="txtStokUrunAlisFiyati" class="form-control"  placeholder="Stok Ürün alış fiyatı giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Alış Vergisi</label>
                    <div class="input-group">
                      <select class="form-control show-tick ms select2" required name="txtStokUrunAlisVergiIdsi" id="txtStokUrunAlisVergiIdsi">
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
                    <label for="email_address">Stok Ürün Görselleri</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="file" multiple id="txtStokUrunGorseli" autocomplete="off" name="txtStokUrunGorseli" class="form-control"  placeholder="Stok Ürün rengini giriniz">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="email_address">Stok Ürün Rengi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtStokUrunRengi" autocomplete="off" name="txtStokUrunRengi" class="form-control"  placeholder="Stok Ürün rengini giriniz">
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>stok/stok-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
              </form>
            </div>
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

    <div class="modal fade" id="modalExceldenAktar" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <form id="frmExceldenAktar" method="post" action="">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title" id="largeModalLabel">Stok Ürünleri Excelden Aktar</h4>
            </div>
            <div class="modal-body">
              <div class="alert alert-info">
                Excelden içe aktarım yapabilmeniz için excel aktarım şablonunu indirip verilerinizi o şablona uygun girmeniz gerekmektedir. İndirmek için <a href="<?php echo $this->yolHtml."documents/sablonlar/urun_aktarma.xlsx" ?>" download>tıklayın</a>
              </div>
              <label for="">Excel Dosyası</label>
              <div class="input-group ">
                <input type="file" name="txtExcelDosyasi" id="txtExcelDosyasi" class="form-control">
              </div>
              <label for="">Şablonun Aktarılacağı Stok Ürün Kategorisi <span class="zmdi zmdi-help" data-toggle="tooltip" title="Excelden ürün aktarma işlemi için her kategoriye ayrı excel dosyası hazırlayıp yüklemeniz gerekmektedir"></span> </label>
              <div class="input-group divSuggestion">
                <select id="txtStokUrunKategoriIdsi" class="form-control show-tick ms select2" required name="txtStokUrunKategoriIdsi">
                  <?php
                  for ($i=0; $i < count($this->urunKategoriBilgileri); $i++) {
                    echo "<option value=".$this->urunKategoriBilgileri[$i]["kategoriId"].">".$this->urunKategoriBilgileri[$i]["kategoriAdi"]."</option>";
                  }
                  ?>
                </select>
                <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKategoriEkle" data-toggle="modal" data-target="#modalYeniKategoriEkle" name="button">Kategori Ekle</button>

              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="">Stok Ürün Kodu Kolonu</label>
                  <select class="form-control" name="txtStokUrunKoduKolonu">
                    <option value="0" selected>A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                    <option value="3">D</option>
                    <option value="4">E</option>
                    <option value="5">F</option>
                    <option value="6">G</option>
                    <option value="7">H</option>
                    <option value="8">J</option>
                    <option value="9">K</option>
                    <option value="10">L</option>
                    <option value="11">M</option>
                    <option value="12">N</option>
                    <option value="13">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Barkodu Kolonu</label>
                  <select class="form-control" name="txtStokUrunBarkoduKolonu">
                    <option value="0">A</option>
                    <option value="1" selected>B</option>
                    <option value="2">C</option>
                    <option value="3">D</option>
                    <option value="4">E</option>
                    <option value="5">F</option>
                    <option value="6">G</option>
                    <option value="7">H</option>
                    <option value="8">I</option>
                    <option value="9">J</option>
                    <option value="10">K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Adı Kolonu</label>
                  <select class="form-control" name="txtStokUrunAdiKolonu">
                    <option value="0">A</option>
                    <option value="1">B</option>
                    <option value="2" selected>C</option>
                    <option value="3">D</option>
                    <option value="4">E</option>
                    <option value="5">F</option>
                    <option value="6">G</option>
                    <option value="7">H</option>
                    <option value="8">I</option>
                    <option value="9">J</option>
                    <option value="10">K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Birimi Kolonu</label>
                  <select class="form-control" name="txtStokUrunBirimiKolonu">
                    <option value="0">A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                    <option value="3" selected>D</option>
                    <option value="4">E</option>
                    <option value="5">F</option>
                    <option value="6">G</option>
                    <option value="7">H</option>
                    <option value="8">I</option>
                    <option value="9">J</option>
                    <option value="10">K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Adedi Kolonu</label>
                  <select class="form-control" name="txtStokUrunAdediKolonu">
                    <option value="0">A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                    <option value="3">D</option>
                    <option value="4" selected>E</option>
                    <option value="5">F</option>
                    <option value="6">G</option>
                    <option value="7">H</option>
                    <option value="8">I</option>
                    <option value="9">J</option>
                    <option value="10">K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Rengi Kolonu</label>
                  <select class="form-control" name="txtStokUrunRengiKolonu">
                    <option value="0">A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                    <option value="3">D</option>
                    <option value="4">E</option>
                    <option value="5" selected>F</option>
                    <option value="6">G</option>
                    <option value="7">H</option>
                    <option value="8">I</option>
                    <option value="9">J</option>
                    <option value="10">K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Alt Uyarı Değeri Kolonu</label>
                  <select class="form-control" name="txtStokUrunAltUyariDegeriKolonu">
                    <option value="0">A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                    <option value="3">D</option>
                    <option value="4">E</option>
                    <option value="5">F</option>
                    <option value="6" selected>G</option>
                    <option value="7">H</option>
                    <option value="8">I</option>
                    <option value="9">J</option>
                    <option value="10">K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Alış Fiyatı Kolonu</label>
                  <select class="form-control" name="txtStokUrunAlisFiyatiKolonu">
                    <option value="0">A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                    <option value="3">D</option>
                    <option value="4">E</option>
                    <option value="5">F</option>
                    <option value="6">G</option>
                    <option value="7" selected>H</option>
                    <option value="8">I</option>
                    <option value="9">J</option>
                    <option value="10">K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Satış Fiyatı Kolonu</label>
                  <select class="form-control" name="txtStokUrunSatisFiyatiKolonu">
                    <option value="0">A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                    <option value="3">D</option>
                    <option value="4">E</option>
                    <option value="5">F</option>
                    <option value="6">G</option>
                    <option value="7">H</option>
                    <option value="8" selected>I</option>
                    <option value="9">J</option>
                    <option value="10">K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Alış KDV Miktarı Kolonu</label>
                  <select class="form-control" name="txtStokUrunAlisVergiIdsiKolonu">
                    <option value="0">A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                    <option value="3">D</option>
                    <option value="4">E</option>
                    <option value="5">F</option>
                    <option value="6">G</option>
                    <option value="7">H</option>
                    <option value="8">I</option>
                    <option value="9" selected>J</option>
                    <option value="10">K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">Stok Ürün Satış KDV Miktarı Kolonu</label>
                  <select class="form-control" name="txtStokUrunSatisVergiIdsiKolonu">
                    <option value="0">A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                    <option value="3">D</option>
                    <option value="4">E</option>
                    <option value="5">F</option>
                    <option value="6">G</option>
                    <option value="7">H</option>
                    <option value="8">I</option>
                    <option value="9">J</option>
                    <option value="10" selected>K</option>
                    <option value="11">L</option>
                    <option value="12">M</option>
                    <option value="13">N</option>
                    <option value="14">O</option>
                  </select>
                </div>
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
    <?php require $this->yolPhp."arayuz/modalYeniBirimEkle.php"; ?>
    <?php require $this->yolPhp."arayuz/modalYeniKurEkle.php"; ?>
    <?php require $this->yolPhp."arayuz/modalYeniVergiEkle.php"; ?>
    <?php require $this->yolPhp."arayuz/lock.php"; ?>

    <!-- Jquery Core Js -->
    <?php require $this->yolPhp."arayuz/script.php"; ?>
    <script src="<?php echo $this->yolHtml ?>views/merkezler/stok/stok-urunu-ekle/stok-urunu-ekle.js"></script>
    <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>

  </body>

  </html>
