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
          <h2 id="pageName" >Ürün Ekle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Ürünler</a></li>
            <li class="breadcrumb-item active">Ürün Ekle</li>
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
              <h2><strong>Ürün</strong> Bilgileri</h2>
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
              <form id="frmUrunEkle" method="post" action="">
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Kodu</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" lang="tr" id="txtUrunKodu" data-tablo-index="4" data-kolon-index="6" autocomplete="off" name="txtUrunKodu" class="form-control dataSearch uppercase"  placeholder="Ürün kodu giriniz">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="email_address">Ürün Barkodu</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtUrunBarkodu" autocomplete="off" name="txtUrunBarkodu" class="form-control"  placeholder="Ürün barkodu giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="email_address">Ürün Adı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtUrunAdi" data-tablo-index="4" data-kolon-index="5" autocomplete="off" required name="txtUrunAdi" class="form-control dataSearch"  placeholder="Ürün adını giriniz">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <label for="email_address">Ürün Birimi</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control select2 ms show-tick" name="txtUrunBirimIdsi" required>
                        <?php
                        for ($i=0; $i < count($this->birimler); $i++) {
                          echo "<option value=".$this->birimler[$i]["id"].">".$this->birimler[$i]["birim_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnBirimEkle" data-toggle="modal" data-target="#modalYeniBirimEkle" name="button">Birim Ekle</button>

                    </div>

                  </div>
                  <div class="col-md-4">
                    <label for="email_address">Ürün Adedi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtUrunAdedi" autocomplete="off" name="txtUrunAdedi" required class="form-control"  placeholder="Ürün mevcut stok adedini giriniz">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="email_address">Ürün Rengi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtUrunRengi" autocomplete="off" name="txtUrunRengi" class="form-control"  placeholder="Ürün rengini giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="">Ürün Kategorisi</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms select2" required name="txtUrunKategoriIdsi">
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
                  <div class="col-md-12">
                    <label for="">Ürünün Gideceği Mutfaklar <span class="zmdi zmdi-help" data-toggle="tooltip" title="Eğer birbirinden ayrı mutfaklarınız varsa ve belirli ürünler belirli mutfaklardan çıkıyorsa buradan ürünün hangi mutfaklardan çıkacağını ayarlayabilirsiniz. Boş bırakırsanız ürün herhangi bir yazıcıdan çıkmaz."></span> <span class="zmdi zmdi-help" data-toggle="tooltip" title="Shift tuşuna basılı tutarak çoklu seçim yapabilirsiniz."></span></label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms" multiple name="txtUrunMutfakIdleri[]" id="txtUrunMutfakIdleri">
                        <?php
                        for ($i=0; $i < count($this->urunMutfakBilgileri); $i++) {
                          echo "<option value=".$this->urunMutfakBilgileri[$i]["id"].">".$this->urunMutfakBilgileri[$i]["mutfak_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnMutfakEkle" data-toggle="modal" data-target="#modalYeniMutfakEkle" name="button">Mutfak Ekle</button>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Görselleri</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="file" multiple id="txtUrunGorseli" autocomplete="off" name="txtUrunGorseli" class="form-control"  placeholder="Ürün rengini giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Alt Uyarı Değeri <span class="zmdi zmdi-help" data-toggle="tooltip" title="Ürün, stoklarınızda bu seviyeye indiğinde sizi uyaracağız"></span> </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtUrunAltUyariDegeri" autocomplete="off" required name="txtUrunAltUyariDegeri" class="form-control"  placeholder="Ürün alt uyarı değeri giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Döviz Kuru <span class="zmdi zmdi-help" data-toggle="tooltip" title="Farklı kur üzerinden satışını yaptığınız ürün varsa burayı değiştirebilirsiniz"></span> </label>
                    <div class="input-group">
                      <select class="form-control show-tick ms select2" data-id="<?php echo $this->birincilKurIdsi; ?>" required name="txtUrunKurIdsi" id="txtUrunKurIdsi">
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
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Kg Fiyatı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Gramajlı satış için gereklidir."></span> </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtUrunKgFiyati" autocomplete="off" required name="txtUrunKgFiyati" class="form-control"  placeholder="Ürün kg fiyatı giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Alış Fiyatı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtUrunAlisFiyati" autocomplete="off" required name="txtUrunAlisFiyati" class="form-control"  placeholder="Ürün alış fiyatı giriniz">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="email_address">Ürün Satış Fiyatı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" step=".01" id="txtUrunSatisFiyati" autocomplete="off" required name="txtUrunSatisFiyati" class="form-control"  placeholder="Ürün satış fiyatı giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Alış Vergisi</label>
                    <div class="input-group">
                      <select class="form-control show-tick ms" required name="txtUrunAlisVergiIdsi" id="txtUrunAlisVergiIdsi">
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
                  <div class="col-md-6">
                    <label for="email_address">Ürün Satış Vergisi</label>
                    <div class="input-group">
                      <select class="form-control show-tick ms" required name="txtUrunSatisVergiIdsi" id="txtUrunSatisVergiIdsi">
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
                    <label for="email_address">Stok Takibi Yapılsın Mı? <span class="zmdi zmdi-help" data-toggle="tooltip" title="Alınan siparişlerinizle entegreli bir şekilde stok adetleriniz güncellenecektir."></span> </label>
                    <div class="input-group divStokTakibiYapilsinMi">
                      <div class="checkbox inlineblock ">
                        <input type="radio" name="txtStokTakibiYapilsinMi" class="txtStokTakibiYapilsinMi" value="1"> Evet
                        <input type="radio" name="txtStokTakibiYapilsinMi" checked class="txtStokTakibiYapilsinMi" value="0"> Hayır
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row divStokTakibiBilgileri d-none">
                  <div class="col-md-3">
                    <label for="email_address">Stoktan Düşülecek Ürün <span class="zmdi zmdi-help" data-toggle="tooltip" title="Şu an bilgilerini girmekte olduğunuz ürün sipariş olarak girildiğinde buraya yazdığınız ürünün miktarından yan tarafa yazdığınız kadar düşülecektir."></span> </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtStoktanDusulecekUrunAra" autocomplete="off" name="txtStoktanDusulecekUrunAra" data-tablo-index="4" data-kolon-index="5" class="form-control dataSearch"  placeholder="Ürün adı yazınız">
                      <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="email_address">Düşülecek Miktar</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtStoktanDusulecekUrunMiktari" autocomplete="off" name="txtStoktanDusulecekUrunMiktari" class="form-control"  placeholder="Miktar yazınız">
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="input-group">
                      <label for="email_address">Ekle</label>
                      <br>
                      <button type="button" class="btn-sm btn g-bg-cgreen btnStokUrunBilgileriEkle"><span class="zmdi zmdi-plus"></span> </button>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="table">
                      <table id="tblStokTakibiBilgileri">
                        <thead>
                          <th>Ürün Adı</th>
                          <th>Stok Düşüm Miktarı</th>
                          <th>İşlem</th>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="col-md-12 col-lg-12">
                      <div class="panel-group p-4" id="accordion_1" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-primary">
                          <div class="panel-heading" role="tab" id="headingOne_1">
                            <h4 class="panel-title"> <a role="button" id="#CollapseAltUrun" data-toggle="collapse" data-parent="#accordion_1" href="#collapseAltUrunEkle" aria-expanded="true" aria-controls="collapseOne_1"> Alt Ürün Ekle <span class="zmdi zmdi-help" data-toggle="tooltip" title="Ürünün farklı ölçüleri veya farklı renkleri varsa buradan ekleyiniz."></span>   </a> </h4>
                          </div>
                          <div id="collapseAltUrunEkle" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                            <div class="divAltUrunEkleKapsayici">
                              <div class="panel-body divAltUrunEkle">
                                <div class="row ">
                                  <div class="col-md-6">
                                    <label for="email_address">Alt Ürün Kodu</label>
                                    <div class="input-group divSuggestion">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="text" id="txtAltUrunKodu" data-tablo-index="4" data-kolon-index="6" autocomplete="off" class="form-control dataSearch txtAltUrunKodu uppercase"  placeholder="Alt Ürün kodu giriniz">
                                      <ul class="dropdown-menu suggestion-menu inner">

                                      </ul>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="email_address">Alt Ürün Barkodu</label>
                                    <div class="input-group divSuggestion">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="text" id="txtAltUrunBarkodu" autocomplete="off" class="form-control txtAltUrunBarkodu"  placeholder="Alt Ürün barkodu giriniz">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label for="email_address">Alt Ürün Adı</label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="text" id="txtAltUrunAdi" data-tablo-index="4" data-kolon-index="5" autocomplete="off" class="form-control dataSearch txtAltUrunAdi"  placeholder="Alt Ürün adını giriniz">
                                      <ul class="dropdown-menu suggestion-menu inner">

                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    <label for="email_address">Alt Ürün Adedi</label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="number" step=".01" id="txtAltUrunAdedi" autocomplete="off" class="form-control txtAltUrunAdedi"  placeholder="Alt Ürün mevcut stok adedini giriniz">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <label for="email_address">Alt Ürün Rengi</label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="text" id="txtAltUrunRengi" autocomplete="off" class="form-control txtAltUrunRengi"  placeholder="Alt Ürün rengini giriniz">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="email_address">Alt Ürün Alt Uyarı Değeri <span class="zmdi zmdi-help" data-toggle="tooltip" title="Alt Ürün, stoklarınızda bu seviyeye indiğinde uyarı alacaksınız"></span> </label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="number" step=".01" id="txtAltUrunAltUyariDegeri" autocomplete="off" class="form-control txtAltUrunAltUyariDegeri"  placeholder="Alt Ürün alt uyarı değeri giriniz">
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="email_address">Alt Ürün Kg Fiyatı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Gramajlı satış için gereklidir."></span> </label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="number" step=".01" id="txtAltUrunKgFiyati" autocomplete="off" class="form-control txtAltUrunKgFiyati"  placeholder="Alt Ürün kg fiyati giriniz">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="email_address">Alt Ürün Alış Fiyatı</label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="number" step=".01" id="txtAltUrunAlisFiyati" autocomplete="off" class="form-control txtAltUrunAlisFiyati"  placeholder="Alt Ürün alış fiyatı giriniz">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="email_address">Alt Ürün Satış Fiyatı</label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="number" step=".01" id="txtAltUrunSatisFiyati" autocomplete="off" class="form-control txtAltUrunSatisFiyati"  placeholder="Alt Ürün satış fiyatı giriniz">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="email_address">Alt Ürün Alış Vergisi</label>
                                    <div class="input-group">
                                      <select class="form-control show-tick ms txtAltUrunAlisVergiIdsi" name="txtAltUrunAlisVergiIdsi" id="txtAltUrunAlisVergiIdsi">
                                        <?php
                                        for ($i=0; $i < count($this->vergiler); $i++) {
                                          echo "<option value=".$this->vergiler[$i]["id"].">".$this->vergiler[$i]["vergi_adi"]."</option>";
                                        }
                                        ?>
                                      </select>
                                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnVergiEkle" data-toggle="modal" data-target="#modalYeniVergiEkle" name="button">Vergi Ekle</button>

                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="email_address">Alt Ürün Satış Vergisi</label>
                                    <div class="input-group">
                                      <select class="form-control show-tick ms txtAltUrunSatisVergiIdsi" name="txtAltUrunSatisVergiIdsi" id="txtAltUrunSatisVergiIdsi">
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
                                    <label for="email_address">Stok Takibi Yapılsın Mı? <span class="zmdi zmdi-help" data-toggle="tooltip" title="Alınan siparişlerinizle entegreli bir şekilde stok adetleriniz güncellenecektir."></span> </label>
                                    <div class="input-group divAltUrunStokTakibiYapilsinMi">
                                      <div class="checkbox inlineblock ">
                                        <input type="radio" name="txtAltUrunStokTakibiYapilsinMi" class="txtAltUrunStokTakibiYapilsinMi" value="1"> Evet
                                        <input type="radio" name="txtAltUrunStokTakibiYapilsinMi" checked class="txtAltUrunStokTakibiYapilsinMi" value="0"> Hayır
                                      </div>

                                    </div>
                                  </div>
                                </div>
                                <div class="row divAltUrunStokTakibiBilgileri d-none">
                                  <div class="col-md-3">
                                    <label for="email_address">Stoktan Düşülecek Ürün <span class="zmdi zmdi-help" data-toggle="tooltip" title="Şu an bilgilerini girmekte olduğunuz ürün sipariş olarak girildiğinde buraya yazdığınız ürünün miktarından yan tarafa yazdığınız kadar düşülecektir."></span> </label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="text" id="txtAltUrunStoktanDusulecekUrunAra" autocomplete="off" name="txtAltUrunStoktanDusulecekUrunAra" data-tablo-index="4" data-kolon-index="5" class="form-control dataSearch"  placeholder="Ürün adı yazınız">
                                      <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

                                      </ul>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <label for="email_address">Düşülecek Miktar</label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                      <input type="text" id="txtAltUrunStoktanDusulecekUrunMiktari" autocomplete="off" name="txtAltUrunStoktanDusulecekUrunMiktari" class="form-control"  placeholder="Miktar yazınız">
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="input-group">
                                      <label for="email_address">Ekle</label>
                                      <button type="button" class="btn-sm btn g-bg-cgreen btnAltUrunStokUrunBilgileriEkle"><span class="zmdi zmdi-plus"></span> </button>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="table">
                                      <table class="tblAltUrunStokTakibiBilgileri">
                                        <thead>
                                          <th>Ürün Adı</th>
                                          <th>Stok Düşüm Miktarı</th>
                                          <th>İşlem</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <button type="button" name="button" class="btn btn-sm btn-raised g-bg-cgreen btn-round waves-effect btnYeniAltUrunEkle"><span class="zmdi zmdi-plus"></span> Yeni Alt Ürün Ekle</button>
                            <button type="button" name="button" class="btn btn-sm btn-raised bg-red btn-round waves-effect btnAltUrunSil"><span class="zmdi zmdi-minus"></span> Alt Ürün Sil</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
                <a href="<?php echo $this->yolHtml; ?>urun/urun-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
              </form>
            </div>
          </div>
        </div>
        <!-- #END# Vertical Layout -->
      </div>
    </section>
    <?php require $this->yolPhp."arayuz/modalYeniKategoriEkle.php"; ?>

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
              <h4 class="title" id="largeModalLabel">Ürünleri Excelden Aktar</h4>
            </div>
            <div class="modal-body">
              <div class="alert alert-info">
                Excelden içe aktarım yapabilmeniz için excel aktarım şablonunu indirip verilerinizi o şablona uygun girmeniz gerekmektedir. İndirmek için <a href="<?php echo $this->yolHtml."documents/sablonlar/urun_aktarma.xlsx" ?>" download>tıklayın</a>
              </div>
              <label for="">Excel Dosyası</label>
              <div class="input-group ">
                <input type="file" name="txtExcelDosyasi" id="txtExcelDosyasi" class="form-control">
              </div>
              <label for="">Şablonun Aktarılacağı Ürün Kategorisi <span class="zmdi zmdi-help" data-toggle="tooltip" title="Excelden ürün aktarma işlemi için her kategoriye ayrı excel dosyası hazırlayıp yüklemeniz gerekmektedir"></span> </label>
              <div class="input-group divSuggestion">
                <select id="txtUrunKategoriIdsi" class="form-control show-tick ms select2" required name="txtUrunKategoriIdsi">
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
                  <label for="">Ürün Kodu Kolonu</label>
                  <select class="form-control" name="txtUrunKoduKolonu">
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
                  <label for="">Ürün Barkodu Kolonu</label>
                  <select class="form-control" name="txtUrunBarkoduKolonu">
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
                  <label for="">Ürün Adı Kolonu</label>
                  <select class="form-control" name="txtUrunAdiKolonu">
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
                  <label for="">Ürün Birimi Kolonu</label>
                  <select class="form-control" name="txtUrunBirimiKolonu">
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
                  <label for="">Ürün Adedi Kolonu</label>
                  <select class="form-control" name="txtUrunAdediKolonu">
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
                  <label for="">Ürün Rengi Kolonu</label>
                  <select class="form-control" name="txtUrunRengiKolonu">
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
                  <label for="">Ürün Alt Uyarı Değeri Kolonu</label>
                  <select class="form-control" name="txtUrunAltUyariDegeriKolonu">
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
                  <label for="">Ürün Alış Fiyatı Kolonu</label>
                  <select class="form-control" name="txtUrunAlisFiyatiKolonu">
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
                  <label for="">Ürün Satış Fiyatı Kolonu</label>
                  <select class="form-control" name="txtUrunSatisFiyatiKolonu">
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
                  <label for="">Ürün Alış KDV Miktarı Kolonu</label>
                  <select class="form-control" name="txtUrunAlisKdvMiktariKolonu">
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
                  <label for="">Ürün Satış KDV Miktarı Kolonu</label>
                  <select class="form-control" name="txtUrunSatisKdvMiktariKolonu">
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
    <script src="<?php echo $this->yolHtml ?>views/birimler/urunler/urun-ekle/urun-ekle.js"></script>
    <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>

  </body>

  </html>
