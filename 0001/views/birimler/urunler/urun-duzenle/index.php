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
          <h2 id="pageName" >Ürün Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Ürünler</a></li>
            <li class="breadcrumb-item active">Ürün Düzenle</li>
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
              <form id="frmUrunDuzenle" method="post" action="">
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Kodu</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="<?php echo $this->urunBilgileri[0]["urunKodu"]; ?>" lang="tr" id="txtUrunKodu" data-tablo-index="4" data-kolon-index="6" autocomplete="off" name="txtUrunKodu" class="form-control dataSearch uppercase"  placeholder="Ürün kodu giriniz">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" name="txtUrunId" id="txtUrunId" value="<?php echo $this->urunBilgileri[0]["urunId"]; ?>">

                    <label for="email_address">Ürün Barkodu</label>
                    <div class="input-group divSuggestion">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="<?php echo $this->urunBilgileri[0]["urunBarkodu"]; ?>" id="txtUrunBarkodu" autocomplete="off" name="txtUrunBarkodu" class="form-control"  placeholder="Ürün barkodu giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="email_address">Ürün Adı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="<?php echo $this->urunBilgileri[0]["urunAdi"]; ?>" id="txtUrunAdi" data-tablo-index="4" data-kolon-index="5" autocomplete="off" required name="txtUrunAdi" class="form-control dataSearch"  placeholder="Ürün adını giriniz">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <label for="email_address">Ürün Birimi</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control select2 ms show-tick" data-id="<?php echo $this->urunBilgileri[0]["urunBirimIdsi"]; ?>" name="txtUrunBirimIdsi" required>
                        <?php
                        for ($i=0; $i < count($this->birimler); $i++) {
                          echo "<option value=".$this->birimler[$i]["id"].">".$this->birimler[$i]["birim_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnBirimDuzenle" data-toggle="modal" data-target="#modalYeniBirimDuzenle" name="button">Birim Duzenle</button>

                    </div>

                  </div>
                  <div class="col-md-4">
                    <label for="email_address">Ürün Adedi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" value="<?php echo $this->urunBilgileri[0]["urunAdedi"]; ?>" step=".01" id="txtUrunAdedi" autocomplete="off" name="txtUrunAdedi" required class="form-control"  placeholder="Ürün mevcut stok adedini giriniz">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="email_address">Ürün Rengi</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtUrunRengi" value="<?php echo $this->urunBilgileri[0]["urunRengi"]; ?>" autocomplete="off" name="txtUrunRengi" class="form-control"  placeholder="Ürün rengini giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="">Ürün Kategorisi</label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms select2" data-id="<?php echo $this->urunBilgileri[0]["urunKategoriIdsi"]; ?>" required name="txtUrunKategoriIdsi">
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
                  <div class="col-md-12">
                    <label for="">Ürünün Gideceği Mutfaklar <span class="zmdi zmdi-help" data-toggle="tooltip" title="Shift tuşuna basılı tutarak çoklu seçim yapabilirsiniz."></span></label>
                    <div class="input-group divSuggestion">
                      <select class="form-control show-tick ms" multiple required name="txtUrunMutfakIdleri[]" id="txtUrunMutfakIdleri">
                        <?php
                        for ($i=0; $i < count($this->urunMutfakBilgileri); $i++) {
                          echo "<option selected value=".$this->urunMutfakBilgileri[$i]["id"].">".$this->urunMutfakBilgileri[$i]["mutfak_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnMutfakDuzenle" data-toggle="modal" data-target="#modalYeniMutfakDuzenle" name="button">Mutfak Duzenle</button>

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
                      <input type="number" value="<?php echo $this->urunBilgileri[0]["urunAltUyariDegeri"]; ?>" step=".01" id="txtUrunAltUyariDegeri" autocomplete="off" required name="txtUrunAltUyariDegeri" class="form-control"  placeholder="Ürün alt uyarı değeri giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Döviz Kuru <span class="zmdi zmdi-help" data-toggle="tooltip" title="Farklı kur üzerinden satışını yaptığınız ürün varsa burayı değiştirebilirsiniz"></span> </label>
                    <div class="input-group">
                      <select class="form-control show-tick ms select2" data-id="<?php echo $this->urunBilgileri[0]["urunKurIdsi"]; ?>" required name="txtUrunKurIdsi" id="txtUrunKurIdsi">
                        <option value="">--Kur Seçiniz--</option>
                        <?php
                        for ($i=0; $i < count($this->kurlar); $i++) {
                          echo "<option value=".$this->kurlar[$i]["id"].">".$this->kurlar[$i]["kur_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKurDuzenle" data-toggle="modal" data-target="#modalYeniKurDuzenle" name="button">Kur Duzenle</button>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Kg Fiyatı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Gramajlı satış için gereklidir"></span> </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" value="<?php echo $this->urunBilgileri[0]["urunKgFiyati"]; ?>" step=".01" id="txtUrunKgFiyati" autocomplete="off" required name="txtUrunKgFiyati" class="form-control"  placeholder="Ürün kg fiyatı giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Alış Fiyatı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" value="<?php echo $this->urunBilgileri[0]["urunAlisFiyati"]; ?>" step=".01" id="txtUrunAlisFiyati" autocomplete="off" required name="txtUrunAlisFiyati" class="form-control"  placeholder="Ürün alış fiyatı giriniz">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="email_address">Ürün Satış Fiyatı</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" value="<?php echo $this->urunBilgileri[0]["urunSatisFiyati"]; ?>" step=".01" id="txtUrunSatisFiyati" autocomplete="off" required name="txtUrunSatisFiyati" class="form-control"  placeholder="Ürün satış fiyatı giriniz">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ürün Alış Vergisi</label>
                    <div class="input-group">
                      <select class="form-control show-tick ms select2 txtUrunAlisVergiIdsi" required data-id="<?php echo $this->urunBilgileri[0]["urunAlisVergiIdsi"]; ?>" name="txtUrunAlisVergiIdsi" id="txtUrunAlisVergiIdsi">
                        <option value="">--Vergi Seçiniz--</option>
                        <?php
                        for ($i=0; $i < count($this->vergiler); $i++) {
                          echo "<option value=".$this->vergiler[$i]["id"].">".$this->vergiler[$i]["vergi_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnVergiDuzenle" data-toggle="modal" data-target="#modalYeniVergiDuzenle" name="button">Vergi Duzenle</button>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="email_address">Ürün Satış Vergisi</label>
                    <div class="input-group">
                      <select class="form-control show-tick ms select2 txtUrunSatisVergiIdsi" data-id="<?php echo $this->urunBilgileri[0]["urunSatisVergiIdsi"]; ?>" required name="txtUrunSatisVergiIdsi" id="txtUrunSatisVergiIdsi">
                        <option value="">--Vergi Seçiniz--</option>
                        <?php
                        for ($i=0; $i < count($this->vergiler); $i++) {
                          echo "<option value=".$this->vergiler[$i]["id"].">".$this->vergiler[$i]["vergi_adi"]."</option>";
                        }
                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnVergiDuzenle" data-toggle="modal" data-target="#modalYeniVergiDuzenle" name="button">Vergi Duzenle</button>

                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Stok Takibi Yapılsın Mı? <span class="zmdi zmdi-help" data-toggle="tooltip" title="Alınan siparişlerinizle entegreli bir şekilde stok adetleriniz güncellenecektir."></span> </label>
                    <div class="input-group divStokTakibiYapilsinMi">
                      <div class="checkbox inlineblock ">
                        <input type="radio" name="txtStokTakibiYapilsinMi" <?php echo $this->yesChecked; ?> class="txtStokTakibiYapilsinMi" value="1"> Evet
                        <input type="radio" name="txtStokTakibiYapilsinMi" <?php echo $this->noChecked; ?> class="txtStokTakibiYapilsinMi" value="0"> Hayır
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row divStokTakibiBilgileri <?php echo $this->urunBilgileri[0]["stokDusmeCollapseClass"]; ?>">
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
                      <label for="email_address">Duzenle</label>
                      <button type="button" class="btn-sm btn g-bg-cgreen btnStokUrunBilgileriDuzenle"><span class="zmdi zmdi-plus"></span> </button>
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
                          <?php
                            for ($i=0; $i < count($this->urunBilgileri[0]["urunStokDusmeBilgileri"]); $i++) {
                              echo
                              '<tr id="'.$this->urunBilgileri[0]["urunStokDusmeBilgileri"][$i]["stoktan_dusulecek_urun_idsi"].'" data-id="'.$this->urunBilgileri[0]["urunStokDusmeBilgileri"][$i]["stoktan_dusum_miktari"].'">
                                <td>'.$this->urunBilgileri[0]["urunStokDusmeBilgileri"][$i]["urun_adi"].'</td>
                                <td>'.$this->urunBilgileri[0]["urunStokDusmeBilgileri"][$i]["stoktan_dusum_miktari"].'</td>
                                <td><button class="btn btn-sm bg-red btnStokUrunBilgileriSil"><span class="zmdi zmdi-minus"></span> </button></td>
                              </tr>';
                            }
                          ?>
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
                            <h4 class="panel-title"> <a role="button" id="aCollapseAltUrun" data-toggle="collapse" data-parent="#accordion_1" href="#collapseAltUrunDuzenle" aria-expanded="true" aria-controls="collapseOne_1"> Alt Ürün Duzenle <span class="zmdi zmdi-help" data-toggle="tooltip" title="Ürünün farklı ölçüleri veya farklı renkleri varsa buradan duzenleyiniz."></span>   </a> </h4>
                          </div>
                          <div id="collapseAltUrunDuzenle" class="panel-collapse collapse in <?php echo $this->urunBilgileri[0]["altUrunCollapseClass"]; ?>" role="tabpanel" aria-labelledby="headingOne_1">
                            <div class="divAltUrunDuzenleKapsayici">
                              <?php

                                for ($i=0; $i < count($this->urunBilgileri[0]["urunAltUrunBilgileri"]); $i++) {
                                  echo '<div class="panel-body divAltUrunDuzenle">
                                    <div class="row ">
                                      <div class="col-md-6">
                                        <label for="email_address">Alt Ürün Kodu</label>
                                        <div class="input-group divSuggestion">
                                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>

                                          <input type="text" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_kodu"].'" id="txtAltUrunKodu" data-tablo-index="4" data-kolon-index="6" autocomplete="off" class="form-control dataSearch txtAltUrunKodu uppercase"  placeholder="Alt Ürün kodu giriniz">
                                          <ul class="dropdown-menu suggestion-menu inner">

                                          </ul>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="email_address">Alt Ürün Barkodu</label>
                                        <div class="input-group divSuggestion">
                                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                          <input class="txtAltUrunIdsi" type="hidden" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["id"].'" />
                                          <input type="text" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_barkodu"].'" id="txtAltUrunBarkodu" autocomplete="off" class="form-control txtAltUrunBarkodu"  placeholder="Alt Ürün barkodu giriniz">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <label for="email_address">Alt Ürün Adı</label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                          <input type="text" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_adi"].'" id="txtAltUrunAdi" data-tablo-index="4" data-kolon-index="5" autocomplete="off" class="form-control dataSearch txtAltUrunAdi"  placeholder="Alt Ürün adını giriniz">
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
                                          <input type="number" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_adedi"].'" step=".01" id="txtAltUrunAdedi" autocomplete="off" class="form-control txtAltUrunAdedi"  placeholder="Alt Ürün mevcut stok adedini giriniz">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <label for="email_address">Alt Ürün Rengi</label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                          <input type="text" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_rengi"].'" id="txtAltUrunRengi" autocomplete="off" class="form-control txtAltUrunRengi"  placeholder="Alt Ürün rengini giriniz">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="email_address">Alt Ürün Alt Uyarı Değeri <span class="zmdi zmdi-help" data-toggle="tooltip" title="Alt Ürün, stoklarınızda bu seviyeye indiğinde uyarı alacaksınız"></span> </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                          <input type="number" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_alt_uyari_degeri"].'" step=".01" id="txtAltUrunAltUyariDegeri" autocomplete="off" class="form-control txtAltUrunAltUyariDegeri"  placeholder="Alt Ürün alt uyarı değeri giriniz">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="email_address">Alt Ürün Kg Fiyatı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Gramajlı satış için gereklidir."></span> </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                          <input type="number" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_kg_fiyati"].'" step=".01" id="txtAltUrunKgFiyati" autocomplete="off" class="form-control txtAltUrunKgFiyati"  placeholder="Alt Ürün kg fiyati giriniz">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="email_address">Alt Ürün Alış Fiyatı</label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                          <input type="number" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_alis_fiyati"].'" step=".01" id="txtAltUrunAlisFiyati" autocomplete="off" class="form-control txtAltUrunAlisFiyati"  placeholder="Alt Ürün alış fiyatı giriniz">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="email_address">Alt Ürün Satış Fiyatı</label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                                          <input type="number" value="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_satis_fiyati"].'" step=".01" id="txtAltUrunSatisFiyati" autocomplete="off" class="form-control txtAltUrunSatisFiyati"  placeholder="Alt Ürün satış fiyatı giriniz">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="email_address">Alt Ürün Alış Vergisi</label>
                                        <div class="input-group">
                                          <select data-id="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_alis_vergi_idsi"].'" class="form-control show-tick ms txtAltUrunAlisVergiIdsi" name="txtAltUrunAlisVergiIdsi" id="txtAltUrunAlisVergiIdsi">';

                                            for ($b=0; $b < count($this->vergiler); $b++) {
                                              echo "<option value=".$this->vergiler[$b]["id"].">".$this->vergiler[$b]["vergi_adi"]."</option>";
                                            }
                                            echo '
                                          </select>
                                          <button type="button" class="btn btn-sm btn-default buttonInsideInput btnVergiDuzenle" data-toggle="modal" data-target="#modalYeniVergiDuzenle" name="button">Vergi Duzenle</button>

                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="email_address">Alt Ürün Satış Vergisi</label>
                                        <div class="input-group">
                                          <select data-id="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["alt_urun_satis_vergi_idsi"].'" class="form-control show-tick ms txtAltUrunSatisVergiIdsi" name="txtAltUrunSatisVergiIdsi" id="txtAltUrunSatisVergiIdsi">
                                            ';
                                            for ($b=0; $b < count($this->vergiler); $b++) {
                                              echo "<option value=".$this->vergiler[$b]["id"].">".$this->vergiler[$b]["vergi_adi"]."</option>";
                                            }

                                            echo '
                                          </select>
                                          <button type="button" class="btn btn-sm btn-default buttonInsideInput btnVergiDuzenle" data-toggle="modal" data-target="#modalYeniVergiDuzenle" name="button">Vergi Duzenle</button>

                                        </div>
                                      </div>

                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="email_address">Stok Takibi Yapılsın Mı? <span class="zmdi zmdi-help" data-toggle="tooltip" title="Alınan siparişlerinizle entegreli bir şekilde stok adetleriniz güncellenecektir."></span> </label>
                                        <div class="input-group divAltUrunStokTakibiYapilsinMi">
                                          <div class="checkbox inlineblock ">';
                                          if (count($this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["altUrunStokDusmeBilgileri"][0]) > 0) {
                                            echo
                                            '<input type="radio" name="txtAltUrunStokTakibiYapilsinMi'.$i.'" checked class="txtAltUrunStokTakibiYapilsinMi" value="1"> Evet
                                            <input type="radio" name="txtAltUrunStokTakibiYapilsinMi'.$i.'" class="txtAltUrunStokTakibiYapilsinMi" value="0"> Hayır
                                            </div>

                                            </div>
                                            </div>
                                            </div>
                                            <div class="row divAltUrunStokTakibiBilgileri">
                                            ';
                                          }else {
                                            echo
                                            '<input type="radio" name="txtAltUrunStokTakibiYapilsinMi'.$i.'"  class="txtAltUrunStokTakibiYapilsinMi" value="1"> Evet
                                            <input type="radio" name="txtAltUrunStokTakibiYapilsinMi'.$i.'" checked class="txtAltUrunStokTakibiYapilsinMi" value="0"> Hayır

                                            </div>

                                          </div>
                                        </div>
                                      </div>
                                      <div class="row divAltUrunStokTakibiBilgileri d-none">';
                                          }
                                          echo '


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
                                          <label for="email_address">Duzenle</label>
                                          <button type="button" class="btn-sm btn g-bg-cgreen btnAltUrunStokUrunBilgileriDuzenle"><span class="zmdi zmdi-plus"></span> </button>
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
                                            <tbody>';
                                            for ($t=0; $t < count($this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["altUrunStokDusmeBilgileri"][0]); $t++) {
                                              echo '<tr id='.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["altUrunStokDusmeBilgileri"][0][$t]["stoktan_dusulecek_urun_idsi"].' data-id="'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["altUrunStokDusmeBilgileri"][0][$t]["stoktan_dusum_miktari"].'">
                                                  <td>'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["altUrunStokDusmeBilgileri"][0][$t]["urun_adi"].'</td>
                                                  <td>'.$this->urunBilgileri[0]["urunAltUrunBilgileri"][$i]["altUrunStokDusmeBilgileri"][0][$t]["stoktan_dusum_miktari"].'</td>
                                                  <td><button class="btn btn-sm bg-red btnStokUrunBilgileriSil"><span class="zmdi zmdi-minus"></span> </button></td>
                                                </tr>';
                                            }
                                              echo '
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>';

                                  echo "<hr>";
                                }
                              ?>

                            </div>

                            <button type="button" name="button" class="btn btn-sm btn-raised g-bg-cgreen btn-round waves-effect btnYeniAltUrunDuzenle"><span class="zmdi zmdi-plus"></span> Yeni Alt Ürün Duzenle</button>
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
    <div class="modal fade z1051" id="modalYeniMutfakDuzenle" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <form id="frmYeniMutfakDuzenle" method="post" action="">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title" id="largeModalLabel">Yeni Mutfak Duzenle</h4>
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
                <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKategoriDuzenle" data-toggle="modal" data-target="#modalYeniKategoriDuzenle" name="button">Kategori Duzenle</button>

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
    <?php require $this->yolPhp."arayuz/modalYeniKurEkle.php"; ?>
    <?php require $this->yolPhp."arayuz/modalYeniVergiEkle.php"; ?>

    <?php require $this->yolPhp."arayuz/lock.php"; ?>
    <!-- Jquery Core Js -->
    <?php require $this->yolPhp."arayuz/script.php"; ?>
    <script src="<?php echo $this->yolHtml ?>views/birimler/urunler/urun-duzenle/urun-duzenle.js"></script>
    <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>

  </body>

  </html>
