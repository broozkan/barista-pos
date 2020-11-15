<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>
<style media="screen">
table input{
  height: 34px!important;
}
</style>
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


  <section class="content contact">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2 id="pageName">Satış Faturası Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Muhasebe Merkezi</a></li>
            <li class="breadcrumb-item active">Satış Faturası Düzenle</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="header">
              <h2><strong>Satış</strong> Faturası Düzenle</h2>
            </div>
            <div class="body">
              <form id="frmSatisFaturasiDuzenle" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Satış Faturası Kodu</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="hidden" name="txtSatisFaturasiIdsi" id="txtSatisFaturasiIdsi" required value="<?php echo $this->faturaBilgileri["id"]; ?>">
                      <input type="text" id="txtSatisFaturasiKodu" value="<?php echo $this->faturaBilgileri["satis_faturasi_kodu"]; ?>" data-kolon-index="18" data-tablo-index="16" autocomplete="off" name="txtSatisFaturasiKodu" class="form-control dataSearch" required placeholder="Satış faturası kodu giriniz">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="">Satış Faturası Seri Numarası</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" value="<?php echo $this->faturaBilgileri["satis_faturasi_seri_numarasi"]; ?>" id="txtSatisFaturasiSeriNumarasi" autocomplete="off" name="txtSatisFaturasiSeriNumarasi" class="form-control" placeholder="Satış faturası seri numarası giriniz">

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Satış Faturası Vade Tarihi</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="date" value="<?php echo $this->faturaBilgileri["satis_faturasi_vade_tarihi"]; ?>" id="txtSatisFaturasiVadeTarihi" name="txtSatisFaturasiVadeTarihi" class="form-control" required>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Satış Faturası Cari Hesap</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input
                      type="text"
                      data-id="<?php echo $this->faturaBilgileri["satis_faturasi_cari_idsi"]; ?>"
                      value="<?php echo $this->faturaBilgileri["satis_faturasi_cari_adi"]; ?>"
                      id="txtSatisFaturasiCariIdsi"
                      data-kolon-index="12"
                      data-tablo-index="10"
                      autocomplete="off"
                      name="txtSatisFaturasiCariIdsi"
                      class="form-control dataSearch"
                      required
                      placeholder="Cari adı giriniz"
                      >
                      <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Satış Faturası Kasası</label>
                    <div class="input-group demoMaskedInput">
                      <select class="form-control ms show-tick select2" required name="txtSatisFaturasiKasaIdsi" id="txtSatisFaturasiKasaIdsi" data-id="<?php echo $this->faturaBilgileri["satis_faturasi_kasa_idsi"]; ?>">
                        <?php
                        for ($i=0; $i < count($this->kasalar); $i++) {
                          echo '<option value="'.$this->kasalar[$i]["id"].'" >'.$this->kasalar[$i]["kasa_adi"].'</option>';
                        }

                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKasaEkle" data-toggle="modal" data-target="#modalYeniKasaEkle" name="button">Kasa Ekle</button>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Satış Faturası Döviz Kuru</label>
                    <div class="input-group demoMaskedInput">
                      <select class="form-control ms show-tick select2" required name="txtSatisFaturasiKurIdsi" id="txtSatisFaturasiKurIdsi" data-id="<?php echo $this->faturaBilgileri["satis_faturasi_kur_idsi"]; ?>">
                        <?php
                        for ($i=0; $i < count($this->kurlar); $i++) {
                          echo '<option data-currency-symbol="'.$this->kurlar[$i]["kur_isareti"].'" data-currency-short="'.$this->kurlar[$i]["kur_kisaltmasi"].'" value="'.$this->kurlar[$i]["id"].'" >'.$this->kurlar[$i]["kur_adi"].'</option>';
                        }

                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKurEkle" data-toggle="modal" data-target="#modalYeniKurEkle" name="button">Kur Ekle</button>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="">Satış Faturası Açıklaması</label>
                    <div class="input-group demoMaskedInput">
                      <textarea name="txtSatisFaturasiAciklamasi" id="txtSatisFaturasiAciklamasi" class="form-control" rows="2" cols="80" placeholder="Satış faturası açıklaması girebilirsiniz"><?php echo $this->faturaBilgileri["satis_faturasi_aciklamasi"]; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true">
                <div class="card" id="details">
                  <div class="body">
                    <div class="row">


                    </div>
                    <br>
                    <div class="mt-40"></div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Ürün Adı</th>
                                <th>Ürün Adedi</th>
                                <th>Ürün Birimi</th>
                                <th>Ürün Vergisi</th>
                                <th>Birim Fiyat</th>
                                <th>Tutar</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                for ($i=0; $i < count($this->faturaUrunleriBilgileri); $i++) {
                                  echo
                                  '<tr class="trUrunler">
                                    <td>
                                      <button type="button" class="btn bg-red btn-sm btnSatisFaturasiUrunSil" name="button"><span class="zmdi zmdi-delete"></span> </button></td>
                                      <td>
                                        <input type="text" value="'.$this->faturaUrunleriBilgileri[$i]["satis_faturasi_urun_adi"].'" data-id="'.$this->faturaUrunleriBilgileri[$i]["satis_faturasi_urun_idsi"].'" list="urunler'.$i.'" class="form-control txtSatisFaturasiUrunleriUrunAdi dataSearch faturaVerileriniGuncelle" required data-kolon-index="5" data-tablo-index="4">
                                        <datalist id="urunler'.$i.'" class="ulSatisFaturasiUrunleriUrunIsimleri">

                                        </datalist>
                                      </td>
                                      <td>
                                        <input type="number" step=".01" value="'.$this->faturaUrunleriBilgileri[$i]["satis_faturasi_urun_adedi"].'" class="form-control txtSatisFaturasiUrunleriUrunAdedi faturaVerileriniGuncelle" required value="1" min="1">
                                      </td>
                                      <td>
                                        <select data-id="'.$this->faturaUrunleriBilgileri[$i]["satis_faturasi_urun_birim_idsi"].'" class="form-control ms show-tick txtSatisFaturasiUrunleriUrunBirimIdsi faturaVerileriniGuncelle" required>';
                                          for ($a=0; $a < count($this->birimler); $a++) {
                                            echo '<option value="'.$this->birimler[$a]["id"].'" >'.$this->birimler[$a]["birim_adi"].'</option>';
                                          }
                                          echo '
                                        </select>
                                      </td>
                                      <td>
                                        <select data-id="'.$this->faturaUrunleriBilgileri[$i]["satis_faturasi_urun_vergi_idsi"].'" class="form-control ms show-tick txtSatisFaturasiUrunleriUrunVergiIdsi faturaVerileriniGuncelle" required>
                                          <option value="">--Vergi seçiniz--</option>';

                                          for ($a=0; $a < count($this->vergiler); $a++) {

                                            echo '<option tax-value="'.$this->vergiler[$a]["vergi_yuzdesi"].'" value="'.$this->vergiler[$a]["id"].'" >'.$this->vergiler[$a]["vergi_adi"].'</option>';
                                          }

                                          echo '
                                        </select>
                                      </td>
                                      <td>
                                        <input type="number" value="'.$this->faturaUrunleriBilgileri[$i]["satis_faturasi_urun_satis_fiyati"].'" step=".01" class="form-control txtSatisFaturasiUrunleriUrunBirimFiyati faturaVerileriniGuncelle" required value="0" min="0">
                                      </td>
                                      <td>
                                        <input type="number" value="'.$this->faturaUrunleriBilgileri[$i]["satis_faturasi_urun_tutari"].'" step=".01" class="form-control txtSatisFaturasiUrunleriUrunTutari" required readonly value="0" min="0">
                                      </td>
                                    </tr>';
                                }
                              ?>

                                <tr>
                                  <td colspan="7">
                                    <button type="button" class="btn g-bg-cgreen btn-sm btnSatisFaturasiUrunEkle" name="button"><span class="zmdi zmdi-plus"></span> </button></td>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-9">

                        </div>
                        <div class="col-md-3 text-right">
                          <p class="m-b-0 p-3"><b>Ara Toplam:</b> <span id="spanAraToplam"><?php echo $this->faturaBilgileri["satis_faturasi_ara_toplami"]; ?> </span> <span class="spanKurIsareti"></span> </p>
                          <p class="m-b-0 p-3"><b>İskonto (%): </b> <input type="number" step=".01" value="<?php echo $this->faturaBilgileri["satis_faturasi_iskonto"]; ?>" class="form-control faturaVerileriniGuncelle" style="width:80px;float:right" name="txtSatisFaturasiIskonto" id="txtSatisFaturasiIskonto" min="0" required value="0"> </p>
                          <div id="vergiGruplari">
                            <?php
                              for ($i=0; $i < count($this->faturaUrunleriBilgileri); $i++) {
                                echo '<p class="m-b-0"><b>'.$this->faturaUrunleriBilgileri[$i]["vergi_adi"].': </b> '.$this->faturaUrunleriBilgileri[$i]["satis_faturasi_urun_vergi_miktari"].'</p>';
                              }
                            ?>
                          </div>

                          <?php
                          // for ($i=0; $i < count($this->satisFaturasiUrunleri); $i++) {
                          //   echo '<p class="m-b-0"><b>'.$this->satisFaturasiUrunleri[$i]["vergi_adi"].': </b> '.$this->satisFaturasiUrunleri[$i]["satis_faturasi_urun_vergi_miktari"].'</p>';
                          // }
                          ?>
                          <h3 class="m-b-0 m-t-10"><span class="spanKurIsareti"></span> <span id="spanFaturaToplami"><?php echo $this->faturaBilgileri["satis_faturasi_tutari"]; ?></span> </h3>
                        </div>
                      </div>
                      <hr>
                      <div class="hidden-print col-md-12 text-right">
                        <button class="btn btn-primary btn-round" type="submit">KAYDET</button>
                        <a href="<?php echo $this->yolHtml; ?>fatura/satis-faturalari/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>


    <div class="modal fade" id="modalSatisFaturasiOdemeYap" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <form id="frmSatisFaturasiOdemeYap" method="post" action="">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title" id="largeModalLabel">Ödeme Yap</h4>
            </div>
            <div class="modal-body">
              <label for="">Ödenecek Miktar</label>
              <div class="input-group demoMaskedInput">
                <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                <input type="hidden" name="txtSatisFaturasiOdemeYapSatisFaturasiIdsi" value="<?php echo $this->satisFaturasiBilgileri["id"]; ?>" required>
                <input type="number" step=".01" value="<?php echo $this->satisFaturasiBilgileri["satis_faturasi_max_odenebilir_tutar"]; ?>" id="txtSatisFaturasiOdemeYapOdenecekMiktar" min="0" max="<?php echo $this->satisFaturasiBilgileri["satis_faturasi_max_odenebilir_tutar"]; ?>"  name="txtSatisFaturasiOdemeYapOdenecekMiktar" class="form-control" required placeholder="Ödemek istediğiniz miktarı giriniz">
              </div>
              <?php
              if ($this->satisFaturasiBilgileri["satis_faturasi_kasa_idsi"] == "0") {
                echo
                '<label for="">Ödemenin Yapılacağı Kasa</label>
                <div class="input-group demoMaskedInput">
                <select class="form-control ms show-tick select2" data-id="'.$this->birincilKasaIdsi.'" name="txtSatisFaturasiOdemeYapKasaIdsi" id="txtSatisFaturasiOdemeYapKasaIdsi">
                <option value="0" disabled selected>--Kasa Seçiniz--</option>';

                for ($i=0; $i < count($this->kasalar); $i++) {
                  echo
                  '<option value="'.$this->kasalar[$i]["id"].'">'.$this->kasalar[$i]["kasa_adi"].'</option>';
                }

                echo '
                </select>
                <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKasaEkle" data-toggle="modal" data-target="#modalYeniKasaEkle" name="button">Kasa Ekle</button>

                </div>';
              }else {
                echo '
                <input type="hidden" name="txtSatisFaturasiOdemeYapKasaIdsi" value="'.$this->satisFaturasiBilgileri["satis_faturasi_kasa_idsi"].'" required>
                ';
              }
              ?>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-round waves-effect btnLoading">ÖDEME YAP</button>
              <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">İPTAL</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php require $this->yolPhp."arayuz/modalYeniCariEkle.php"; ?>
    <?php require $this->yolPhp."arayuz/modalYeniKasaEkle.php"; ?>
    <?php require $this->yolPhp."arayuz/modalYeniKurEkle.php"; ?>
    <div class="modal fade" id="modalYeniKategoriEkle" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <form id="frmYeniKategoriEkle" method="post" action="">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="title" id="largeModalLabel">Yeni Kategori Ekle</h4>
            </div>
            <div class="modal-body">
              <label for="">Kategori Adı</label>
              <div class="input-group demoMaskedInput">
                <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                <input type="hidden" name="txtKategoriTabloAdi" value="<?php echo $this->searchTabloAdlari[2]; ?>">
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
    <?php require $this->yolPhp."arayuz/lock.php"; ?>

    <!-- Jquery Core Js -->
    <?php require $this->yolPhp."arayuz/script.php"; ?>
    <script src="<?php echo $this->yolHtml ?>views/merkezler/fatura/satis-faturasi-duzenle/satis-faturasi-duzenle.js"></script>
    <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
  </body>

  </html>
