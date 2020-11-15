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
          <h2 id="pageName" >Statü Düzenle</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Statülar</a></li>
            <li class="breadcrumb-item active">Statü Düzenle </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form id="frmStatuDuzenle" method="post" action="">
            <?php

              for ($i=0; $i < count($this->statuBilgileri); $i++) {
                echo
                '<div class="card">
                  <div class="header">
                    <h2><strong>Statü</strong> Bilgileri</h2>
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
                  <label for="">Statü Adı</label>
                  <div class="input-group demoMaskedInput">
                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                    <input value="'.$this->statuBilgileri[$i]["statuAdi"].'" type="text" id="'.$this->statuBilgileri[$i]["statuId"].'" data-kolon-index="10" data-tablo-index="8" autocomplete="off" name="txtStatuAdi" class="form-control dataSearch txtStatuAdi" required placeholder="Statü adı giriniz. Örn: Barista">
                    <ul class="dropdown-menu suggestion-menu inner">

                    </ul>
                  </div>

                  <label for="">Statü Yetkileri</label>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="checkbox p-3">
                        <input id="cboxTumYetkiler" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][0]["cboxTumYetkiler"].'">
                        <label for="cboxTumYetkiler"> Tüm Yetkileri Ver</label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="input-group demoMaskedInput">
                    <div class="row" style="width:100%">
                      <div class="col-md-4 divYonetimYetkileri">
                        <label for=""><strong>Yönetim Yetkileri</strong></label>
                        <div class="checkbox p-3">
                          <input id="cboxYonetimTumYetkiler" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][1]["cboxYonetimTumYetkiler"].'">
                          <label for="cboxYonetimTumYetkiler"> Tüm Yönetim Yetkilerini Ver</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtSiparisAlabilir" name="txtSiparisAlabilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][2]["txtSiparisAlabilir"].'">
                          <label for="txtSiparisAlabilir"> Sipariş alabilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtOdemeAlabilir" name="txtOdemeAlabilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][3]["txtOdemeAlabilir"].'">
                          <label for="txtOdemeAlabilir"> Ödeme alabilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtHizliSatisYapabilir" name="txtHizliSatisYapabilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][4]["txtHizliSatisYapabilir"].'">
                          <label for="txtHizliSatisYapabilir"> Hızlı satış yapabilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtPaketServisYonetebilir" name="txtPaketServisYonetebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][5]["txtPaketServisYonetebilir"].'">
                          <label for="txtPaketServisYonetebilir"> Paket Servis Yönetebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtMutfakEkranlarinaGirebilir" name="txtMutfakEkranlarinaGirebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][6]["txtMutfakEkranlarinaGirebilir"].'">
                          <label for="txtMutfakEkranlarinaGirebilir"> Mutfak Ekranlarına Girebilir</label>
                        </div>
                      </div>
                      <div class="col-md-4 divMerkezYetkileri">
                        <label for=""><strong>Merkez Yetkileri</strong></label>
                        <div class="checkbox p-3">
                          <input id="cboxMerkezTumYetkiler" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][7]["cboxMerkezTumYetkiler"].'">
                          <label for="cboxMerkezTumYetkiler"> Tüm Merkez Yetkilerini Ver</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtStokMerkezineGirebilir" name="txtStokMerkezineGirebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][8]["txtStokMerkezineGirebilir"].'">
                          <label for="txtStokMerkezineGirebilir"> Stok Merkezine Girebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtMuhasebeMerkezineGirebilir" name="txtMuhasebeMerkezineGirebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][9]["txtMuhasebeMerkezineGirebilir"].'">
                          <label for="txtMuhasebeMerkezineGirebilir"> Muhasebe Merkezine Girebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtRaporMerkezineGirebilir" name="txtRaporMerkezineGirebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][10]["txtRaporMerkezineGirebilir"].'">
                          <label for="txtRaporMerkezineGirebilir"> Rapor Merkezine Girebilir</label>
                        </div>
                      </div>
                      <div class="col-md-4 divBirimYetkileri">
                        <label for=""><strong>Birim Yetkileri</strong></label>
                        <div class="checkbox p-3">
                          <input id="cboxBirimTumYetkiler" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][11]["cboxBirimTumYetkiler"].'">
                          <label for="cboxBirimTumYetkiler"> Tüm Birim Yetkilerini Ver</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtKasaEkleyebilir" name="txtKasaEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][12]["txtKasaEkleyebilir"].'">
                          <label for="txtKasaEkleyebilir"> Kasa ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtYaziciEkleyebilir" name="txtYaziciEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][13]["txtYaziciEkleyebilir"].'">
                          <label for="txtYaziciEkleyebilir"> Yazici ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtMutfakEkleyebilir" name="txtMutfakEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][14]["txtMutfakEkleyebilir"].'">
                          <label for="txtMutfakEkleyebilir"> Mutfak ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtLokasyonEkleyebilir" name="txtLokasyonEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][15]["txtLokasyonEkleyebilir"].'">
                          <label for="txtLokasyonEkleyebilir"> Lokasyon ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtMasaEkleyebilir" name="txtMasaEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][16]["txtMasaEkleyebilir"].'">
                          <label for="txtMasaEkleyebilir"> Masa ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtTeslimDurumuEkleyebilir" name="txtTeslimDurumuEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][17]["txtTeslimDurumuEkleyebilir"].'">
                          <label for="txtTeslimDurumuEkleyebilir"> Teslim Durumu ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtStatuEkleyebilir" name="txtStatuEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][18]["txtStatuEkleyebilir"].'">
                          <label for="txtStatuEkleyebilir"> Statü ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtCalisanEkleyebilir" name="txtCalisanEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][19]["txtCalisanEkleyebilir"].'">
                          <label for="txtCalisanEkleyebilir"> Çalışan ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtDepoEkleyebilir" name="txtDepoEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][20]["txtDepoEkleyebilir"].'">
                          <label for="txtDepoEkleyebilir"> Depo ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtVergiEkleyebilir" name="txtVergiEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][21]["txtVergiEkleyebilir"].'">
                          <label for="txtVergiEkleyebilir"> Vergi ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtKategoriEkleyebilir" name="txtKategoriEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][22]["txtKategoriEkleyebilir"].'">
                          <label for="txtKategoriEkleyebilir"> Kategori ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtBirimEkleyebilir" name="txtBirimEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][23]["txtBirimEkleyebilir"].'">
                          <label for="txtBirimEkleyebilir"> Birim ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtUrunEkleyebilir" name="txtUrunEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][24]["txtUrunEkleyebilir"].'">
                          <label for="txtUrunEkleyebilir"> Ürün ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtMenuEkleyebilir" name="txtMenuEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][25]["txtMenuEkleyebilir"].'">
                          <label for="txtMenuEkleyebilir"> Menü ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtMusteriEkleyebilir" name="txtMusteriEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][26]["txtMusteriEkleyebilir"].'">
                          <label for="txtMusteriEkleyebilir"> Müşteri ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtKurEkleyebilir" name="txtKurEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][27]["txtKurEkleyebilir"].'">
                          <label for="txtKurEkleyebilir"> Kur ekleyebilir</label>
                        </div>
                        <div class="checkbox p-3">
                          <input id="txtOdemeMetoduEkleyebilir" name="txtOdemeMetoduEkleyebilir" type="checkbox" data-bool="'.$this->statuBilgileri[$i]["statuYetkileri"][28]["txtOdemeMetoduEkleyebilir"].'">
                          <label for="txtOdemeMetoduEkleyebilir"> Ödeme Metodu ekleyebilir</label>
                        </div>
                      </div>
                    </div>

                  </div>';
              }
            ?>
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
            <a href="<?php echo $this->yolHtml; ?>statu/statu-listesi/" class="btn btn-raised btn-default btn-round waves-effect btnIptal">İPTAL</a>
          </form>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/statu/statu-duzenle/statu-duzenle.js"></script>
</body>

</html>
