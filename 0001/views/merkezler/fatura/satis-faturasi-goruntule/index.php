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


  <section class="content contact">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2 id="pageName">Satış Faturası Görüntüle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Muhasebe Merkezi</a></li>
            <li class="breadcrumb-item active">Satış Faturası Görüntüle</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="header">
              <h2><strong>Satış</strong> Faturası</h2>
            </div>
            <div class="body">
              <h5 class="m-b-0">Satış Faturası Kodu : <strong class="text-primary">#<?php echo $this->satisFaturasiBilgileri["satis_faturasi_kodu"]; ?></strong></h5>
              <h5 class="m-b-0">Satış Faturası Seri No : <strong class="text-primary">#<?php echo $this->satisFaturasiBilgileri["satis_faturasi_seri_numarasi"]; ?></strong></h5>
              <ul class="nav nav-tabs">
                <li class="nav-item inlineblock"><a class="nav-link active" href="<?php echo $this->yolHtml; ?>fatura/satis-faturalari/">Geri</a></li>
                <?php
                  if ($this->satisFaturasiBilgileri["satis_faturasi_odenmis_miktar"] != $this->satisFaturasiBilgileri["satis_faturasi_tutari"]) {
                    echo '<li class="nav-item inlineblock"><button type="button" data-toggle="modal" data-target="#modalSatisFaturasiOdemeYap" class="btn btn-primary btn-round" name="button">Ödeme Yap</button> </li>';
                  }
                ?>

              </ul>
            </div>
          </div>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true">
              <div class="card" id="details">
                <div class="body">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <address>
                        <strong><?php echo $this->satisFaturasiBilgileri["musteri_adi_soyadi"]; ?></strong><br>
                        <?php echo $this->satisFaturasiBilgileri["musteri_adresi"]; ?>
                        <br>
                        <abbr title="Phone">Tel:</abbr> <?php echo $this->satisFaturasiBilgileri["musteri_telefon_numarasi"]; ?>
                      </address>
                    </div>
                    <div class="col-md-6 col-sm-6 text-right">
                      <p class="m-b-0"><strong>Satış Faturası Vade Tarihi : </strong> <?php echo $this->satisFaturasiBilgileri["satis_faturasi_vade_tarihi"]; ?></p>
                      <p class="m-b-0"><strong>Satış Faturası İşlem Tarihi : </strong> <?php echo $this->satisFaturasiBilgileri["satis_faturasi_tarihi"]; ?></p>
                      <p class="m-b-0"><strong>Ödeme Durumu: </strong> <?php echo $this->satisFaturasiBilgileri["satis_faturasi_odeme_durumu"]; ?></p>
                      <p class="m-b-0"><strong>Ödenmiş Miktar: </strong> <?php echo $this->satisFaturasiBilgileri["satis_faturasi_odenmis_miktar"]; ?> <?php echo $this->satisFaturasiBilgileri["satis_faturasi_kur_isareti"]; ?></p>
                    </div>
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
                              <th width="60px">Ürün Adı</th>
                              <th>Ürün Adedi</th>
                              <th>Ürün Birimi</th>
                              <th>Birim Fiyat</th>
                              <th>Tutar</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              for ($i=0; $i < count($this->satisFaturasiUrunleri); $i++) {
                                echo
                                '<tr>
                                  <td>'.$this->satisFaturasiUrunleri[$i]["id"].'</td>
                                  <td>'.$this->satisFaturasiUrunleri[$i]["satis_faturasi_urun_adi"].'</td>
                                  <td>'.$this->satisFaturasiUrunleri[$i]["satis_faturasi_urun_adedi"].'</td>
                                  <td>'.$this->satisFaturasiUrunleri[$i]["satis_faturasi_urun_birimi"].'</td>
                                  <td>'.$this->satisFaturasiUrunleri[$i]["satis_faturasi_urun_satis_fiyati"].' '.$this->satisFaturasiBilgileri["satis_faturasi_kur_isareti"].'</td>
                                  <td>'.$this->satisFaturasiUrunleri[$i]["satis_faturasi_urun_tutari"].' '.$this->satisFaturasiBilgileri["satis_faturasi_kur_isareti"].'</td>
                                </tr>';
                              }
                            ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Açıklama</h5>
                      <p><?php echo $this->satisFaturasiBilgileri["satis_faturasi_aciklamasi"]; ?></p>
                    </div>
                    <div class="col-md-6 text-right">
                      <p class="m-b-0"><b>Ara Toplam:</b> <?php echo $this->satisFaturasiBilgileri["satis_faturasi_ara_toplami"]; ?></p>
                      <p class="m-b-0"><b>İskonto:</b> <?php echo $this->satisFaturasiBilgileri["satis_faturasi_iskonto"]; ?></p>
                      <?php
                        for ($i=0; $i < count($this->satisFaturasiUrunleri); $i++) {
                          echo '<p class="m-b-0"><b>'.$this->satisFaturasiUrunleri[$i]["vergi_adi"].': </b> '.$this->satisFaturasiUrunleri[$i]["satis_faturasi_urun_vergi_miktari"].'</p>';
                        }
                      ?>
                      <h3 class="m-b-0 m-t-10"><?php echo $this->satisFaturasiBilgileri["satis_faturasi_kur_kisaltmasi"]; ?> <?php echo $this->satisFaturasiBilgileri["satis_faturasi_tutari"]; ?></h3>
                    </div>
                  </div>
                  <hr>
                  <div class="hidden-print col-md-12 text-right">
                    <!-- <button class="btn btn-warning btn-icon  btn-icon-mini btn-round"><i class="zmdi zmdi-print"></i></button> -->
                    <!-- <button class="btn btn-primary btn-round">Submit</button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
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
            <label for="">Ödeme Miktarı</label>
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
              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
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
  <script src="<?php echo $this->yolHtml ?>views/merkezler/fatura/satis-faturasi-goruntule/satis-faturasi-goruntule.js"></script>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
</body>

</html>
